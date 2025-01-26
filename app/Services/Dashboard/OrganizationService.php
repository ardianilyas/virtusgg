<?php

namespace App\Services\Dashboard;

use App\Enum\OrganizationMemberRoleEnum;
use App\Models\Organization;
use App\Models\OrganizationMember;
use Illuminate\Support\Facades\Auth;

class OrganizationService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getLatestOrganizationsPaginate() {
        return Auth::user()->organizations()->latest()->paginate(5);
    }

    public function createOrganization($data) {
        return Auth::user()->organizations()->create($data);
    }

    public function createOrganizationOwner($organizationId) {
        return OrganizationMember::create([
            'organization_id' => $organizationId,
            'user_id' => Auth::id(),
            'role' => OrganizationMemberRoleEnum::OWNER->value,
            'is_creator' => true
        ]);
    }

    public function createOrganizationMember($data) {

    }
}
