<?php
/**
 * Created by PhpStorm.
 * User: toby
 * Date: 11/03/19
 * Time: 08:19
 */

namespace App\Packages\FileUpload;


use Illuminate\Database\Eloquent\Model;

abstract class NoteTemplateModel extends Model
{

    public $timestamps = true;

    protected $fillable = [
        'name',
        'description',
        'template'
    ];

    public function __construct(array $attributes = [])
    {
        $this->table = $this->getModuleName().'_file_note_templates';
        parent::__construct($attributes);
    }

    /**
     * Get the name of the module
     *
     * @return string
     */
    abstract protected function getModuleName(): string;

    abstract protected function getModelNamespace(): string;

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}