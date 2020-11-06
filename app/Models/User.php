<?php

namespace App\Models;

use App\Enums\UserRoleEnum;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Parental\HasChildren;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasChildren;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'title',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'role' => UserRoleEnum::class,
    ];

    /** @var array $childTypes */
    protected $childTypes = [
        UserRoleEnum::ADMINISTRATOR => Administrator::class,
        UserRoleEnum::TEACHER => Teacher::class
    ];

    /** @var string $childColumn */
    protected $childColumn = 'role';

    /**
    * Get the user's name.
    *
    * @return string
    */
    public function getNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
    * Get the user's full name.
    *
    * @return string
    */
    public function getFullNameAttribute()
    {
        return "{$this->title } {$this->first_name} {$this->last_name}";
    }

    /**
    * Get the user's full name when being listed.
    *
    * @return string
    */
    public function getFullNameListingAttribute()
    {
        return "{$this->last_name}, {$this->title } {$this->first_name}";
    }

    /**
    * Get the user's first name initial.
    *
    * @return string
    */
    public function getFirstNameInitialAttribute()
    {
        return substr($this->first_name, 0, 1);
    }
}
