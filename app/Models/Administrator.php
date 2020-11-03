<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Parental\HasParent;

class Administrator extends User
{
    use HasFactory, HasParent;
}
