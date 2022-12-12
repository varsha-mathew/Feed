<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class feed_list extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'links',
        'description',
    ];
}
