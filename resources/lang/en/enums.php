<?php

use App\Enums\UserRoleEnum;

return [
    UserRoleEnum::class => [
        UserRoleEnum::ADMINISTRATOR => 'Administrator',
        UserRoleEnum::TEACHER => 'Teacher',
        UserRoleEnum::STUDENT => 'Student',
    ],
];
