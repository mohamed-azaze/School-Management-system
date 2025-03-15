<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Classroom extends Model
{
    use HasTranslations;
    public $translatable = ['class_name'];
    protected $table     = 'classrooms';
    public $timestamps   = true;
    protected $fillable  = ['class_name', 'grade_id'];

    public function Grades()
    {
        return $this->belongsTo('App\Models\Grade', 'grade_id');
    }

}