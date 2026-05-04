<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerScore extends Model
{
    use HasFactory;

    // TAMBAHKAN INI:
    protected $fillable = ['score'];
}