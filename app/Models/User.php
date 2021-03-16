<?php

namespace App\Models;

use App\Enums\UserRoleEnum;
use App\Models\Administrator;
use App\Models\Teacher;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
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
        'title',
        'first_name',
        'last_name',
        'suffix',
        'email',
        'school_email',
        'phone',
        'password',
        'role',
        'street',
        'city',
        'state',
        'zip',
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

    /** @var array */
    protected $childTypes = [
        UserRoleEnum::ADMINISTRATOR => Administrator::class,
        UserRoleEnum::TEACHER => Teacher::class,
    ];

    /** @var string */
    protected $childColumn = 'role';

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Get the user's full name with title.
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

    /**
     * Set the user's password.
     *
     * @param  void
     * @return void
     */
    public function setPasswordAttribute()
    {
        $this->attributes['password'] = Hash::make(Str::random(10));
    }

    /**
     * Remove specific characters from phone user's phone number.
     *
     * @param  string  $value
     * @return void
     */
    public function setPhoneAttribute($value)
    {
        $this->attributes['phone'] = preg_replace('/[^0-9]/', '', $value);
    }

    /**
     * Get the user's formatted phone number.
     *
     * @return string
     */
    public function getFormattedPhoneAttribute()
    {
        return '('.substr($this->phone, 0, 3).') '.substr($this->phone, 3, 3).'-'.substr($this->phone, 6, 4);
    }
}
