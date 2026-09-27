<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Success_Story extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = true; // Set this to true to enable automatic timestamps

    //Relation between working experince and user is many to one
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
