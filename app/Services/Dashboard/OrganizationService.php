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

    public function getOrganization($code) {
        return Organization::where('code', $code)->first();
    }

    public function isAlreadyMember($organization, $userId) {
        return OrganizationMember::where('organization_id', $organization->id)->where('user_id', $userId)->exists();
    }

    public function joinOrganization($code) {
        $organization = $this->getOrganization($code);
        $isAlreadyMember = $this->isAlreadyMember($organization, Auth::id());

        if ($isAlreadyMember) {
            return back()->withErrors(['code', 'You have already joined the organization']);
        } else {
            return $this->createOrganizationMember($organization->id, Auth::id());
        }
    }

    public function createOrganizationMember($organizationId, $userId) {
        return OrganizationMember::create([
            'organization_id' => $organizationId,
            'user_id' => $userId,
        ]);
    }
}
