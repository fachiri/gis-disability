<?php

namespace App\Utils;

use App\Constants\UserRole;

class AuthUtils
{
    public static function getRole($user)
    {
        if ($user->admin) {
          $role = UserRole::ADMIN;
        }

        if ($user->manager) {
          $role = UserRole::MANAGER;
        }

        if ($user->relawan) {
          $role = UserRole::RELAWAN;
        }

        return $role ?? UserRole::USER;
    }
}