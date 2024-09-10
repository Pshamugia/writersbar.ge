<?php

namespace App\Models;

use App\Models\Menu;
use App\Models\Avtorebi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\KulturaPassword;

class KulturaCxrili extends Model
{
    use HasFactory;
    protected $table = 'kultura_cxrili';

    public function avtorebi()
    {
        return $this->hasOne(Avtorebi::class, 'id', 'avtori');
    }
    public function menuTitle()
    {
        return $this->hasOne(Menu::class, 'id', 'kategory');
    }

    public function editors()
    {
        return $this->hasOne(KulturaPassword::class, 'id', 'editor');
    }
  }
