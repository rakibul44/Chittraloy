<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    protected $fillable = ['tag', 'title', 'subtitle', 'bg', 'btn1', 'btn2'];
}
