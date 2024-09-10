<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Authors extends Model
{
    use HasFactory;
    protected $fillable=['*'];

    protected $table = 'authors';

    public function author_name()
    {
        return app()->isLocale('ka') ? $this->author_ka : $this->author_en;
    }
}
