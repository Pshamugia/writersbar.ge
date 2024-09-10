<?php

namespace App\Models;

use App\Models\Authors;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Articles extends Model
{
    use HasFactory;
    protected $fillable=['*'];

    protected $table = 'articles';

    public function category()
    {
        return $this->hasOne(Categories::class, 'id', 'category_id');

    }

    public function authors()
    {
        return $this->hasOne(Authors::class, 'id', 'author_id');

    }

    public function title()
    {
        return app()->isLocale('ka') ? $this->title_ka : $this->title_en;
    }

    public function descriptions()
    {
        return app()->isLocale('ka') ? $this->description_ka : $this->description_en;
    }

    public function full()
    {
        return app()->isLocale('ka') ? $this->full_ka : $this->full_en;
    }
}
