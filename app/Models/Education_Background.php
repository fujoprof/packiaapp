<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Education_Background extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = true; // Set this to true to enable automatic timestamps

}
