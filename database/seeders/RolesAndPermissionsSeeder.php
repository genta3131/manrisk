<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash; // <-- Tambahkan baris ini

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Buat Roles
        $superAdminRole = Role::firstOrCreate(['name' => 'super admin']);
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $ownerRiskRole = Role::firstOrCreate(['name' => 'owner risk']);
        $pimpinanRole = Role::firstOrCreate(['name' => 'pimpinan']);

        // Menetapkan peran ke pengguna yang ada (contoh: pengguna 'tes123@gmail.com' dari UserSeeder)
        $user = User::where('email', 'tes123@gmail.com')->first();
        if ($user) {
            $user->assignRole($superAdminRole);
        }

        // Contoh membuat user baru dan langsung menetapkan peran
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'), // Sekarang Hash::make akan dikenali
                'email_verified_at' => now(),
            ]
        );
        $adminUser->assignRole($adminRole);

        $ownerRiskUser = User::firstOrCreate(
            ['email' => 'ownerrisk@example.com'],
            [
                'name' => 'Owner Risk User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $ownerRiskUser->assignRole($ownerRiskRole);

        $pimpinanUser = User::firstOrCreate(
            ['email' => 'pimpinan@example.com'],
            [
                'name' => 'Pimpinan User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $pimpinanUser->assignRole($pimpinanRole);
    }
}