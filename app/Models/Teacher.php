<?php

namespace App\Models;

use App\Models\User;
use Parental\HasParent;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Teacher extends User
{
    use HasFactory, HasParent;
}
