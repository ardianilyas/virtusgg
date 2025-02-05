<?php

namespace Database\Seeders;

use App\Enum\OrganizationMemberRoleEnum;
use App\Models\Organization;
use App\Models\OrganizationMember;
use App\Models\RequestJoinOrganization;
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

        $users = User::factory(10)->create();

        $developer = Role::create(['name' => 'developer']);
        $admin = Role::create(['name' => 'admin']);

        $dev->assignRole($developer);

        $organizations = Organization::factory(2)->create()->each(function ($organization) use ($users, $dev) {
            $organization->creator_id = $dev->id;
            $organization->save();

            OrganizationMember::create([
                'user_id' => $dev->id,
                'organization_id' => $organization->id,
                'is_creator' => true,
                'role' => OrganizationMemberRoleEnum::OWNER->value,
            ]);

            $members = $users->whereNotIn('id', [$dev->id])->random(rand(3, 8));
            foreach ($members as $member) {
                OrganizationMember::create([
                    'user_id' => $member->id,
                    'organization_id' => $organization->id,
                ]);
            }
        });

        RequestJoinOrganization::factory(20)->create();
    }
}
