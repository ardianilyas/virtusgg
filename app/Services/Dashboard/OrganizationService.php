<?php

namespace App\Services\Dashboard;

use App\Enum\OrganizationMemberRoleEnum;
use App\Events\OrganizationJoinRequested;
use App\Models\Organization;
use App\Models\OrganizationMember;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
        return Auth::user()->organizations()->withCount('members')->latest()->paginate(5);
    }

    public function getOrganizationMembers(Organization $organization) {
        return $organization->loadCount('members')->load('members');
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

    public function isAlreadyRequested(User $user, Organization $organization) {
        return $user->requestedOrganizations()->where('organization_id', $organization->id)->exists();
    }

    public function createJoinOrganizationRequest(User $user, Organization $organization): void {
        $user->requestedOrganizations()->attach($organization->id, [
            'id' => Str::uuid()->toString(),
        ]);
    }

    public function requestToJoinOrganization($code) {
        $organization = $this->getOrganization($code);
        $user = Auth::user();
        $isAlreadyMember = $this->isAlreadyMember($organization, $user->id);
        $isAlreadyRequested = $this->isAlreadyRequested($user, $organization);

        if ($isAlreadyMember) {
            return back()->withErrors(['code', 'You have already joined the organization']);
        } elseif ($isAlreadyRequested) {
            return back()->withErrors(['code', 'You have already requested to the organization, please wait until the owner approved']);
        } else {
            $this->createJoinOrganizationRequest($user, $organization);
            $this->sendEventRequestJoinOrganization($user, $organization);
        }
    }

    public function sendEventRequestJoinOrganization(User $user, Organization $organization) {
        return OrganizationJoinRequested::dispatch($user
        ,$organization);
    }

    public function createOrganizationMember($organizationId, $userId) {
        return OrganizationMember::create([
            'organization_id' => $organizationId,
            'user_id' => $userId,
        ]);
    }
}
