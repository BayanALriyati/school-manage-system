<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Classroom extends Model
{

    use HasTranslations;
    public $translatable = ['Name_class'];


    protected $table = 'Classrooms';
    public $timestamps = true;
    protected $fillable=['Name_class','Grade_id'];



    public function Grades()
    {
        return $this->belongsTo('App\Models\Grade', 'Grade_id');
    }

}