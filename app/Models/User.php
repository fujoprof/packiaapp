<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use SoftDeletes;
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'address',
        'phone_number',
        'date_of_birth',
        'gender',
		'google_id',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Relation between users and working experince is one to many
    public function workingExperiences()
    {
        return $this->hasMany(Working_Experience::class);
    }

    //Relation between users and personal skills is one to many
    public function personalSkills()
    {
        return $this->hasMany(Personal_Skill::class);
    }

    //Relation between users and personal skills is one to many
    public function interestedArea()
    {
        return $this->hasMany(Interested_Area::class);
    }

    //Relation between users and personal skills is one to many
    public function successStory()
    {
        return $this->hasMany(Success_Story::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'user__permissions', 'user_id', 'permission_id');
    }

    public function userPermission() {
        return $this->hasMany(User_Permission::class);
    }

    public function profileDetail() {
        return $this->hasMany(Profile_Detail::class);
    }

}
