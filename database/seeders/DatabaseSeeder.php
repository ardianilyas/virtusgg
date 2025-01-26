<?php

namespace Database\Seeders;

use App\Models\Organization;
use App\Models\OrganizationMember;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $dev = User::factory()->create([
            'name' => 'Ardian Ilyas',
            'email' => 'ardian@virtus.gg',
            'password' => bcrypt('developer')
        ]);

        $developer = Role::create(['name' => 'developer']);
        $admin = Role::create(['name' => 'admin']);

        $dev->assignRole($developer);

        OrganizationMember::factory(3)->create();
    }
}
