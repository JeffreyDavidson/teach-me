<?php

namespace App\Enums;

use MadWeb\Enum\Enum;

/**
 * @method static UserRoleEnum ADMINISTRATOR()
 * @method static UserRoleEnum TEACHER()
 * @method static UserRoleEnum STUDENT()
 */
final class UserRoleEnum extends Enum
{
    const __default = self::ADMINISTRATOR;

    const ADMINISTRATOR = 'administrator';
    const TEACHER = 'teacher';
    const STUDENT = 'student';
}
