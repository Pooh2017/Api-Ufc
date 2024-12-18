<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Fighter extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'nickname',
        'division',
        'wins',
        'losses',
        'knockouts',
        'submissions',
        'gender',
        'image',
    ];

}
