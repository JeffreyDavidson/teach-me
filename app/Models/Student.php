<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Parental\HasParent;

class Student extends User
{
    use HasFactory, HasParent;
}
