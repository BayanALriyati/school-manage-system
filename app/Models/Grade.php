<?php

namespace App\Models;
use Spatie\Translatable\HasTranslations;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model 
{
    use HasTranslations;
    public $translatable = ['Name','Notes'];
    protected $fillable = ['Name','Notes'];
    protected $table = 'Grades';
    public $timestamps = true;

}