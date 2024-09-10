<?php

namespace App\Models;

use App\Models\GalleryFiles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable=['*'];

    protected $table = 'gallery';
    public function imagesx()
    {
        return $this->hasMany(GalleryFiles::class, 'idx', 'gallery_idx');

    }

}
