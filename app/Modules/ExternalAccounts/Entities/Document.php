<?php

namespace App\Modules\ExternalAccounts\Entities;

use App\Packages\ControlDB\Models\Group;
use App\User;
use Exception;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $table = 'externalaccounts_documents';

    protected $fillable = [
        'title',
        'filename',
        'mime',
        'path',
        'size'
    ];

    public function getSafeFileName()
    {
        return mb_convert_encoding(
                str_replace([
                    '/', '\\', '%'
                ],
                    '_',
                    $this->title
                ), 'ASCII').
            $this->getExtension();
    }

    public function getExtension()
    {
        $extensionArray = explode('.', $this->filename);
        if(count($extensionArray) <= 1) {
            return '';
        }
        $extension = last($extensionArray);
        return ('.'.$extension ?: '');
    }
}
