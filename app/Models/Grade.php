<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Grade extends Model
{

    use HasTranslations;

    public $translatable = ['name'];
    protected $fillable  = ['name', 'note'];
    protected $table     = 'grades';

    public $timestamps = true;

    public function Sections()
    {
        return $this->hasMany('App\Models\Section', 'grade_id');
    }

}