<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile_Detail extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'biography',
    ];

    public $timestamps = true; // Set this to true to enable automatic timestamps

    //Relation between personal skill and user is many to one
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
