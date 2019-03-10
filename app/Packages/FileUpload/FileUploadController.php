<?php
/**
 * Created by PhpStorm.
 * User: toby
 * Date: 10/03/19
 * Time: 12:15
 */

namespace App\Packages\FileUpload;


use App\Packages\ControlDB\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

abstract class FileUploadController
{


    protected $fileModel;

    protected $noteModel;

    public function __construct()
    {
        $this->fileModel = $this->fileModel();
        $this->noteModel = $this->noteModel();
    }

    abstract protected function fileModel(): string;

    /**
     * @return string
     */
    abstract protected function noteModel(): string;

    public function uploadFile(Request $request)
    {
        $request->validate([
            'file' => 'required|max:10000|mimes:pdf,doc,docx,odt,txt,xlsm,xls,csv',
            'title' => 'required|min:3|max:255'
        ]);

        $file = $request->file('file');
        $filename = $file->getClientOriginalName();

        // TODO Change from dev-documents
        if ($path = $request->file('file')->store('/dev-documents')) {

            $fileModel = new $this->fileModel;
            $fileModel->fill([
                'filename' => $filename,
                'mime' => $file->getClientMimeType(),
                'path' => $path,
                'size' => $file->getSize(),
                'year' => getReaffiliationYear(),
                'title' => $request->get('title'),
                'status' => 'awaiting approval'
            ]);

            $fileModel->user_id = Auth::user()->id;
            $fileModel->group_id = getGroupID();
            $fileModel->position_id = (Auth::user()->getCurrentRole()->position->id !== 'admin' ? Auth::user()->getCurrentRole()->position->id : null);
            if ($fileModel->save()) {
                return $this->getFileWithRelations($fileModel->id);
            }

        }
        return response()->json([
            'success' => false
        ], 500);
    }

    public function retrieveFile()
    {
        return $this->getFileWithRelations()->filter(function($file) {
            return $file->group_id === getGroupID();
        });
    }

    public function downloadFile($id)
    {
        $file = $this->fileModel::findOrFail($id);
        abort_if(getGroupID() !== $file->group_id, 403, 'Please log in as a member of this society.');
        return Storage::download($file->path, $file->getSafeFileName());
    }

    public function postNote(Request $request, $id)
    {
        // Validate
        $request->validate([
            'note' => 'required|min:3|max:10000'
        ]);

        // Save
        $note = new $this->noteModel;
        $note->note = $request->get('note');
        $note->user_id = Auth::user()->id;
        $note->group_id = getGroupID();
        $note->position_id = (Auth::user()->getCurrentRole()->position->id === 'admin' ? null : Auth::user()->getCurrentRole()->position->id);
        $note->file_id = $id;

        // Return
        if ($note->save()) {
            return $this->getFileWithRelations($id);
        }
        return response(['note' => 'Could not save the note'], 500);
    }

    public function adminRetrieveFile(Request $request)
    {
        return $this->getFileWithRelations();
    }

    public function adminDownloadFile(Request $request, $id)
    {
        $file = $this->fileModel::findOrFail($id);
        return Storage::download($file->path, $file->getSafeFileName());
    }

    public function adminPostNote(Request $request, $id)
    {
        // Validate
        $request->validate([
            'note' => 'required|min:3|max:10000'
        ]);

        // Save
        $note = new $this->noteModel;
        $note->note = $request->get('note');
        $note->user_id = Auth::user()->id;
        $note->group_id = null;
        $note->position_id = null;
        $note->file_id = $id;

        // Return
        if ($note->save()) {
            return $this->getFileWithRelations($id);
        }
        return response(['note' => 'Could not save the note'], 500);
    }

    public function adminChangeFileStatus(Request $request, $id)
    {
        $request->validate([
            'status' => [
                'required',
                Rule::in([
                    'awaiting approval',
                    'approved',
                    'rejected'
                ])
            ]
        ]);

        $status = $request->get('status');

        $file = $this->fileModel::find($id);

        if($file->status !== $status) {
            $file->status = $status;
            if($file->save()) {
                // TODO Fire event

            }
        }

        return $file->status;
    }

    /**
     * @param null $id
     * @return mixed
     */
    private function getFileWithRelations($id=null)
    {
        $with = [
            'user:id,forename,surname,email',
            'notes',
            'notes.user:id,forename,surname,email',
        ];
        if($id === null ) {
            $files = $this->fileModel::with($with)->get();
            return $files->map(function($file) {
                $file->group = Group::find($file->group_id)->toArray();
                return $file;
            });
        } else {

            $file = $this->fileModel::with($with)->findOrFail($id);
            $file->group = Group::find($file->group_id)->toArray();
            return $file;
        }
    }
}