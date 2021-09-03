<?php

use App\Models\User;
use Spatie\Permission\Models\Role;

if (!function_exists('roleFixture')) {
    function createRole()
    {
        foreach (['super_admin','book_keeper','publisher','user'] as $roles) {
            Role::create([
                'name' => $roles,
                'guard_name' => 'web'
            ]);
        }
    }
}

if (!function_exists('assignRoleToUserFixture')) {
    function assignRoleToUserFixture(string $roleName, bool $shouldAssignRole): array
    {
        $role = Role::create([
            'name' => $roleName,
            'guard_name' => 'web',
        ]);

        if ($shouldAssignRole) {
            $assignee = User::factory()->create();
            $assignee->assignRole($role);

            return [$assignee];
        }

        return [$role];
    }
}
