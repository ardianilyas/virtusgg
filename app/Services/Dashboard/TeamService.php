<?php

namespace App\Services\Dashboard;

use App\Models\Organization;
use App\Models\OrganizationMember;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;

class TeamService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function showOrganizationByRoleProjectManager() {
        $userId = Auth::id();

        $orgMembers = OrganizationMember::query()->where('user_id', $userId)->whereIn('role', ['owner', 'project manager'])->get();

        $organizations = [];

        foreach ($orgMembers as $orgMember) {
            $condition = Organization::query()->where('id', $orgMember->organization_id)->first();

            if($condition) {
                $organizations[] = $condition;
            }
        }

        return $organizations;
    }

    public function createTeam($data) {
        return Team::query()->create([
            'name' => $data['name'],
            'organization_id' => $data['organization_id'],
            'user_id' => Auth::id(),
        ]);
    }
}
