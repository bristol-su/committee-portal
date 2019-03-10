<?php
/**
 * Created by PhpStorm.
 * User: toby
 * Date: 10/03/19
 * Time: 12:15
 */

namespace App\Packages\FileUpload;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

abstract class FileUploadController
{


    protected $fileModel;

    protected $noteModel;

    public function __construct()
    {
        $this->fileModel = $this->fileModel();
        $this->noteModel = $this->noteModel();
    }

    public function uploadFile(Request $request)
    {
        $request->validate([
            'file' => 'required|max:10000|mimes:pdf,doc,docx,odt,txt,xlsm,xls,csv',
            'title' => 'required|min:3|max:255'
        ]);

        $file = $request->file('file');
        $filename = $file->getClientOriginalName();

        // TODO Change from dev-documents
        if($path = $request->file('file')->store('/dev-documents')) {

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
            if($fileModel->save()) {
                $fileModel->load('user')->only(['forename', 'surname', 'email']);
                return response($fileModel, 200);
            }

        }
        return response()->json([
            'success' => false
        ], 500);
    }

    public function retrieveFile() {
        $file = $this->fileModel;
        return $file::where('group_id', getGroupID())->with('user:id,forename,surname,email')->get();
    }

    public function downloadFile($id) {
        $file = $this->fileModel::findOrFail($id);
        abort_if(getGroupID() !== $file->group_id, 403, 'Please log in as a member of this society.');
        return Storage::download($file->path, $file->getSafeFileName());
    }

    public function getNotes()
    {
        return $this->noteModel::where('group_id', getGroupID())->with('user:id,forename,surname,email')->get();
    }

    public function postNote(Request $request, $id)
    {
        $file = $this->fileModel::findOrFail($id);
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
        $note->file_id = $file->id;

        // Return
        if($note->save()) {
            return $note->load('user:id,forename,surname,email');
        }
        return response(['note' => 'Could not save the note'], 500);
    }


    /**
     * @return string
     */
    abstract protected function noteModel() : string;

    abstract protected function fileModel() : string;

}