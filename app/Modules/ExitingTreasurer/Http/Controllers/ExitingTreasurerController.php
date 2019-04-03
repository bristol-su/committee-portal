<?php

namespace App\Modules\ExitingTreasurer\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\ExitingTreasurer\Entities\Correction;
use App\Modules\ExitingTreasurer\Entities\Document;
use App\Modules\ExitingTreasurer\Entities\MissingIncomeAndExpenditure;
use App\Modules\ExitingTreasurer\Entities\Note;
use App\Modules\ExitingTreasurer\Entities\NoteTemplate;
use App\Modules\ExitingTreasurer\Entities\OutstandingInvoice;
use App\Modules\ExitingTreasurer\Entities\Submission;
use App\Modules\ExitingTreasurer\Entities\TreasurerSignOffDocument;
use App\Modules\ExitingTreasurer\Entities\UnauthorizedExpenseClaim;
use App\Packages\ControlDB\Models\Group;
use App\Packages\ControlDB\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ExitingTreasurerController extends Controller
{

    public function downloadTreasurerDocument($id)
    {
        $this->authorize('exitingtreasurer.download-treasurer-document');

        // TODO Route Model Bind
        $file = TreasurerSignOffDocument::findOrFail($id);

        abort_if(getGroupID() !== $file->group()->id, 403, 'Please log in as a member of this society.');

        return Storage::cloud()->download($file->path, $file->getSafeFileName());
    }

    public function adminDownloadTreasurerDocument($id)
    {
        $this->authorize('exitingtreasurer.download-treasurer-document-admin');

        // TODO Route Model Bind
        $file = TreasurerSignOffDocument::findOrFail($id);

        return Storage::cloud()->download($file->path, $file->group()->name.'_'.$file->getSafeFileName());
    }

    public function downloadReport($id)
    {
        $this->authorize('exitingtreasurer.download-report');

        // TODO Route Model Bind
        $file = Document::findOrFail($id);

        abort_if(getGroupID() !== $file->group_id, 403, 'Please log in as a member of this society.');

        return Storage::cloud()->download($file->path, $file->getSafeFileName());
    }

    public function adminDownloadReport($id)
    {
        $this->authorize('exitingtreasurer.download-report-admin');

        // TODO Route Model Bind
        $file = Document::findOrFail($id);

        return Storage::cloud()->download($file->path, $file->group()->name.'_'.$file->getSafeFileName());
    }

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

    public function isComplete()
    {
if(!$this->actingAsStudent()) { return false; } ;
        $submissions = Submission::where([
            'year' => getReaffiliationYear(),
            'group_id' => Auth::user()->getCurrentRole()->group->id
        ])->get();

        if(count($submissions) > 0) {
            return $submissions->map(function($submission) {
                return $this->submissionWithRelationships($submission);
            });
        }

        return response('No submissions found', 400);
    }

    private function submissionWithRelationships(Submission $submission)
    {
        $submission->load([
            'user',
            'correction',
            'correction.treasurerSignOffDocuments',
            'missingIncomeAndExpenditure',
            'missingIncomeAndExpenditure.treasurerSignOffDocuments',
            'outstandingInvoice',
            'outstandingInvoice.invoice',
            'outstandingInvoice.treasurerSignOffDocuments',
            'unauthorizedExpenseClaim',
        ]);
        $submission->group = $submission->group()->toArray();
        $submission->position = (($submission->position() instanceof Position)?$submission->position()->toArray():$submission->position());
        return $submission;
    }

    public function submissions() {
        $this->authorize('exitingtreasurer.see-submissions');

        return Submission::where([
            'group_id' => Auth::user()->getCurrentRole()->group->id
        ])->get()->map(function($submission) {
            return $this->submissionWithRelationships($submission);
        });
    }

    public function allSubmissions() {
        $this->authorize('exitingtreasurer.view-admin');

        return Submission::all()->map(function($submission) {
            return $this->submissionWithRelationships($submission);
        });
    }
    /*
     * Note Templates
     */

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

    public function newSubmission(Request $request)
    {
        $this->authorize('exitingtreasurer.approve');

        $v = Validator::make($request->all(), [
            'corrections.present' => 'required|boolean',

            'missing_i_and_e.present' => 'required|boolean',

            'outstanding_invoices.present' => 'required|boolean',
            'outstanding_invoices.data.*' => 'exists:exitingtreasurer_outstanding_invoices,id',

            'unauthorized_expense_claims.present' => 'required|boolean',
            'unauthorized_expense_claims.data.*' => 'exists:exitingtreasurer_unauthorized_expense_claims,id',
        ]);
        $v->sometimes('corrections.data.id', 'exists:exitingtreasurer_corrections,id', function ($input) {
            return $input->corrections['present'];
        });
        $v->sometimes('missing_i_and_e.data.id', 'exists:exitingtreasurer_missing_income_and_expenditures,id', function ($input) {
            return $input->missing_i_and_e['present'];
        });
        $v->sometimes('outstanding_invoices.data', 'array|between:1,100', function ($input) {
            return $input->outstanding_invoices['present'];
        });
        $v->sometimes('unauthorized_expense_claims.data', 'array|between:1,100', function ($input) {
            return $input->unauthorized_expense_claims['present'];
        });
        if ($v->fails()) {
            throw ValidationException::withMessages($v->errors()->toArray());
        }

        $submission = new Submission([
            'user_id' => Auth::user()->id,
            'group_id' => Auth::user()->getCurrentRole()->group->id,
            'position_id' => Auth::user()->getCurrentRole()->position->id,
            'year' => getReaffiliationYear(),
            'has_unauthorized_expense_claims' => $request->input('unauthorized_expense_claims.present'),
            'has_outstanding_invoices' => $request->input('outstanding_invoices.present'),
            'has_missing_income_and_expenditure' => $request->input('missing_i_and_e.present'),
            'has_corrections' => $request->input('corrections.present'),
        ]);

        $submission->save();
        if ($request->input('corrections.present')) {
            $correction = Correction::findOrFail($request->input('corrections.data.id'));
            $correction->submission()->associate($submission);
            $correction->save();
        }
        if ($request->input('missing_i_and_e.present')) {
            $missingIAndE = MissingIncomeAndExpenditure::findOrFail($request->input('missing_i_and_e.data.id'));
            $missingIAndE->submission()->associate($submission);
            $missingIAndE->save();
        }
        if ($request->input('outstanding_invoices.present')) {
            foreach ($request->input('outstanding_invoices.data') as $invoiceId) {
                $invoice = OutstandingInvoice::findOrFail($invoiceId);
                $invoice->submission()->associate($submission);
                $invoice->save();
            }
        }
        if ($request->input('unauthorized_expense_claims.present')) {
            foreach ($request->input('unauthorized_expense_claims.data') as $claimId) {
                $claim = UnauthorizedExpenseClaim::findOrFail($claimId);
                $claim->submission()->associate($submission);
                $claim->save();
            }
        }

        return $this->submissionWithRelationships($submission);
    }

    public function postNote(Request $request, $id)
    {
        $this->authorize('exitingtreasurer.post-note');
        // Validate
        $request->validate([
            'note' => 'required|min:3|max:10000'
        ]);

        // Save
        $note = new Note();
        $note->note = $request->input('note');
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

    public function adminPostNote(Request $request, $id)
    {
        $this->authorize('exitingtreasurer.post-note-admin');

        // Validate
        $request->validate([
            'note' => 'required|min:3|max:10000'
        ]);

        // Save
        $note = new Note();
        $note->note = $request->input('note');
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

        $this->authorize('exitingtreasurer.upload-document');
        $request->validate([
            'document' => 'required|mimes:bin,pdf,doc,dotm,dotx,zip,docx,pptx,ppt,odt,txt,xlsx,xls,csv,ods,otp',
            'title' => 'required|min:3|max:255'
        ]);

        $document = $request->file('document');

        if ($path = Storage::cloud()->put('exitingtreasurer-document-uploads', $request->file('document'))) {

            $documentModel->title = $request->input('title');
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
