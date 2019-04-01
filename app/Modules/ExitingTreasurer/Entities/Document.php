<?php

namespace App\Modules\ExitingTreasurer\Entities;

use App\Packages\ControlDB\Models\Group;
use App\User;
use Exception;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $table = 'exitingtreasurer_documents';

    protected $fillable = [
        'year',
        'title',
        'filename',
        'mime',
        'path',
        'size',
        'type',
        'uploaded',
        'group_id',
        'uploaded_by'
    ];

    protected $casts = [
        'uploaded' => 'boolean'
    ];

    public function group() {
        $group = Group::find($this->group_id);
        if($group === false) {
            throw new Exception('Could not find a group (id ' . $this->id .')');
        }
        return $group;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

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
