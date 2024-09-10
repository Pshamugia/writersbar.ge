<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quizz extends Model
{
    use HasFactory;

    protected $table = 'quizz';

    public function category()
    {
        return $this->hasOne(Categories::class, 'id', 'category_id');

    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'quizz_id', 'id')->orderBy('id', 'ASC');

    }

    public function mainTitle()
    {
        return app()->isLocale('ka') ? $this->mainTitle_ka : $this->mainTitle_en;
    }
    public function main_description()
    {
        return app()->isLocale('ka') ? $this->mainDescription_ka : $this->mainDescription_en;
    }
}
