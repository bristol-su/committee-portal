<?php
/**
 * Created by PhpStorm.
 * User: toby
 * Date: 10/03/19
 * Time: 12:10
 */

namespace App\Packages\FileUpload;


use Illuminate\Database\Eloquent\Model;

abstract class NoteModel extends Model
{

    protected $fillable = [
        'note'
    ];

    public function __construct(array $attributes = [])
    {
        $this->table = $this->getModuleName() . '_file_notes';
        parent::__construct($attributes);
    }

    /**
     * Get the name of the module
     *
     * @return string
     */
    abstract protected function getModuleName(): string;

    public function file()
    {
        return $this->belongsTo('App\Modules\ExecutiveSummary\Entities\File');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}