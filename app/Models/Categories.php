<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    protected $fillable=['*'];

    protected $table = 'categories';

    public function name()
    {
        return app()->isLocale('ka') ? $this->name_ka : $this->name_en;
    }
}
