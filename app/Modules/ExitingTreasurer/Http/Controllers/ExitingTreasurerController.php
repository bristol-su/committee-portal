<?php

namespace App\Modules\ExitingTreasurer\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\ExitingTreasurer\Entities\Document;
use App\Modules\ExitingTreasurer\Entities\Note;
use App\Modules\ExitingTreasurer\Entities\NoteTemplate;
use App\Packages\ControlDB\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Storage;

class ExitingTreasurerController extends Controller
{

    public function showUserPage()
    {

        $this->authorize('exitingtreasurer.view');

        return view('exitingtreasurer::exitingtreasurer');
    }

    public function showAdminPage()
    {

        $this->authorize('exitingtreasurer.view-admin');

        return view('exitingtreasurer::admin');
    }

    public function getDocuments()
    {
        $this->authorize('exitingtreasurer.view-upload-documents');

        return $this->getDocumentWithRelations();
    }


    /*
     * Note Templates
     */



    public function postNote(Request $request, $id)
    {
        $this->authorize('exitingtreasurer.post-note');
        // Validate
        $request->validate([
            'note' => 'required|min:3|max:10000'
        ]);

        // Save
        $note = new Note();
        $note->note = $request->get('note');
        $note->user_id = Auth::user()->id;
        $note->group_id = getGroupID();
        $note->position_id = (Auth::user()->getCurrentRole()->position->id === 'admin' ? null : Auth::user()->getCurrentRole()->position->id);
        $note->document_id = $id;

        // Return
        if ($note->save()) {
            return $this->getDocumentWithRelations($id);
        }
        return response(['note' => 'Could not save the note'], 500);
    }




    public function adminCreateNoteTemplate(Request $request)
    {
        $this->authorize('exitingtreasurer.create-note-template');
        $request->validate([
            'name' => 'required|min:3|max:255',
            'description' => 'required|min:3|max:255',
            'template' => 'required|min:10|max:65000'
        ]);

        $template = NoteTemplate::create($request->only([
            'name',
            'description',
            'template'
        ]));

        if ($template->exists) {
            return $template;
        }

        return response('Template could not be saved', 500);

    }

    public function adminUpdateNoteTemplate(Request $request, $id)
    {
        $this->authorize('exitingtreasurer.update-note-template');
        $request->validate([
            'name' => 'sometimes|min:3|max:255',
            'description' => 'sometimes|min:3|max:255',
            'template' => 'sometimes|min:10|max:65000'
        ]);

        $template = NoteTemplate::findOrFail($id);

        if ($template->update($request->only([
            'name',
            'description',
            'template'
        ]))) {
            return $template;
        }

        return response('Template could not be saved', 500);
    }

    public function adminDeleteNoteTemplate($id)
    {
        $this->authorize('exitingtreasurer.delete-note-template');
        if (NoteTemplate::destroy($id)) {
            return response('', 200);
        }
        return response('Could not delete the template', 500);
    }

    public function adminGetNoteTemplates()
    {
        $this->authorize('exitingtreasurer.view-note-templates');

        return NoteTemplate::all();
    }



    private function getDocumentWithRelations($id = null)
    {
        $with = [
            'user:id,forename,surname,email',
            'notes',
            'notes.user:id,forename,surname,email',
        ];
        if ($id === null) {
            $documents = Document::with($with)->get();
            return $documents->map(function ($document) {
                $document->group = Group::find($document->group_id)->toArray();
                return $document;
            });
        } else {

            $document = Document::with($with)->findOrFail($id);
            $document->group = Group::find($document->group_id)->toArray();
            return $document;
        }
    }


    public function adminPostNote(Request $request, $id)
    {
        $this->authorize('exitingtreasurer.post-note-admin');

        // Validate
        $request->validate([
            'note' => 'required|min:3|max:10000'
        ]);

        // Save
        $note = new Note();
        $note->note = $request->get('note');
        $note->user_id = Auth::user()->id;
        $note->group_id = null;
        $note->position_id = null;
        $note->document_id = $id;

        // Return
        if ($note->save()) {
            return $this->getDocumentWithRelations($id);
        }
        return response(['note' => 'Could not save the note'], 500);
    }

    public function uploadDocument(Request $request, Document $documentModel)
    {
        $request->validate([
            'document' => 'required|mimes:bin,pdf,doc,dotm,dotx,zip,docx,pptx,ppt,odt,txt,xlsx,xls,csv,ods,otp',
            'title' => 'required|min:3|max:255'
        ]);

        $document = $request->file('document');

        if ($path = Storage::cloud()->put('exitingtreasurer-document-uploads', $request->file('document'))) {

            $documentModel->title = $request->get('title');
            $documentModel->filename = $document->getClientOriginalName();
            $documentModel->mime = $document->getClientMimeType();
            $documentModel->path = $path;
            $documentModel->size = $document->getSize();
            $documentModel->uploaded = true;
            $documentModel->uploaded_by = Auth::user()->id;

            if ($documentModel->save()) {
                Event::dispatch('exitingtreasurer.documentUploadedForReview', $documentModel);
                return $this->getDocumentWithRelations($documentModel->id);
            }

        }
        return response()->json([
            'success' => false
        ], 500);
    }

//
//    public function retrieveDocument()
//    {
//        $this->authorize('exitingtreasurer.view');
//
//        $documents = $this->getDocumentWithRelations();
//        $documents = $documents->filter(function ($document) {
//            return $document->group_id === getGroupID();
//        });
//        return $documents->values();
//    }
//
//    public function downloadDocument($id)
//    {
//        $this->authorize('exitingtreasurer.download');
//
//        $document = Document::findOrFail($id);
//        abort_if(getGroupID() !== $document->group_id, 403, 'Please log in as a member of this society.');
//        return Storage::cloud()->download($document->path, $document->getSafeDocumentName());
//    }
//
//    public function downloadAll($year)
//    {
//        $documents = Document::where([
//            'year' => $year,
//            'status' => 'approved'
//        ])->get();
//
//        $zipDocument = new \PhpZip\ZipDocument();
//
//        $documents->each(function ($document) use (&$zipDocument) {
//            $zipDocument->addDocument(Storage::cloud()->get($document->path));
//        });
//
//        $documentname = 'approved-' . $this->getModuleName() . '-' . $year . '/' . substr($year + 1, 2, 2);
//        $zipDocument->outputAsAttachment($documentname);
//
//        $zipDocument->close();
//    }
}
