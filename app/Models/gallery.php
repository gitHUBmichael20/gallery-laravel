<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class gallery extends Model
{
    //
    use HasFactory;
    protected $table = 'gallery';
    protected $primary = 'id';
    protected $fillable = [
        'name', 
        'image', 
    ];
}