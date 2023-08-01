<?php

namespace PixiiBomb\Essentials\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vector extends Model
{
    use HasFactory;

    protected $table = 'vectors';

    protected $fillable = ['alias', 'uin', 'vector'];
}
