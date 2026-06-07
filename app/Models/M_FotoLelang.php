<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class M_FotoLelang extends Model
{
    protected $table = 'foto_lelangs';

    protected $fillable = ['lelang_id', 'path_foto', 'urutan'];
}
