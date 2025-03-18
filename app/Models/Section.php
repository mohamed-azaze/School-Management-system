<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Section extends Model
{
    use HasTranslations;
    public $translatable = ['section_name'];

    protected $fillable = ['section_name', 'grade_id', 'class_id'];

    protected $table   = 'sections';
    public $timestamps = true;

    public function Grades()
    {
        return $this->belongsTo('App\Models\Grade', 'grade_id');
    }

    public function Classrooms()
    {
        return $this->belongsTo('App\Models\Classroom', 'class_id');
    }

    public function Teachers()
    {
        return $this->belongsToMany('App\Models\Teacher', 'teacher_section');
    }

}