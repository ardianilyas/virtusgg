<?php

namespace App\Http\Controllers\Dashboard;

use App\Enum\OrganizationStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Organization\CreateOrganizationRequest;
use App\Http\Requests\Dashboard\Organization\JoinOrganizationRequest;
use App\Http\Requests\Dashboard\Organization\UpdateOrganizationRequest;
use App\Models\Organization;
use App\Models\OrganizationMember;
use App\Services\Dashboard\OrganizationService;

class OrganizationController extends Controller
{
    public function index(OrganizationService $organizationService) {
        $organizations = $organizationService->getLatestOrganizationsPaginate();
        return inertia('Dashboard/Organization/Index', compact('organizations'));
    }

    public function create() {
        return inertia('Dashboard/Organization/Create');
    }

    public function store(CreateOrganizationRequest $request, OrganizationService $organizationService) {
        $organization = $organizationService->createOrganization($request->validated());
        $organizationService->createOrganizationOwner($organization['id']);
        return redirect()->route('dashboard.organizations.index');
    }

    public function edit(Organization $organization) {
        $statuses = OrganizationStatusEnum::cases();
        return inertia('Dashboard/Organization/Edit', compact('organization', 'statuses'));
    }

    public function update(UpdateOrganizationRequest $request, Organization $organization) {
        $organization->update($request->validated());
        return redirect()->route('dashboard.organizations.index');
    }

    public function destroy(Organization $organization) {
        $organization->delete();
        return back();
    }

    public function join(JoinOrganizationRequest $request, OrganizationService $organizationService) {
        $organizationService->joinOrganization($request->validated());
        return back();
    }
}
