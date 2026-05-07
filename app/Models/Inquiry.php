<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    protected $fillable = ['name', 'partner', 'email', 'phone', 'date', 'package', 'venue', 'message', 'status'];
}
