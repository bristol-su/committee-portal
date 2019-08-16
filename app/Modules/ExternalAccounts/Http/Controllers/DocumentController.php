<?php


namespace App\Modules\ExternalAccounts\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Modules\ExternalAccounts\Entities\Document;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{

    public function download(Document $document)
    {
        $this->authorize('externalaccounts.documents.download');

        return Storage::cloud()->download($document->path, $document->getSafeFileName());
    }

}