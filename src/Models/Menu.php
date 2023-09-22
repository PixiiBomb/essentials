<?php

namespace PixiiBomb\Essentials\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = ['alias', 'uin', 'vector'];
}
