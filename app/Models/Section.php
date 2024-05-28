<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Section extends Model 
{
    use HasTranslations;
    public $translatable = ['Name_Section'];
    protected $fillable=['Name_Section','Status','Grade_id','Class_id'];
    protected $table = 'sections';
    public $timestamps = true;

    // public function Grades()
    // {
    //     return $this->belongsTo('Grade', 'Grade_id');
    // }

    public function My_classs()
    {
        return $this->belongsTo('App\Models\Classroom', 'Class_id');
    }

}