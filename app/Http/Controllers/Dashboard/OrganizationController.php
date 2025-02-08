<?php

namespace App\Http\Controllers\Dashboard;

use App\Enum\OrganizationStatusEnum;
use App\Events\OrganizationJoinRequested;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Organization\CreateOrganizationRequest;
use App\Http\Requests\Dashboard\Organization\JoinOrganizationRequest;
use App\Http\Requests\Dashboard\Organization\UpdateOrganizationRequest;
use App\Mail\OrganizationJoinRequestMail;
use App\Mail\OrganizationJoinRequestUpdateMail;
use App\Models\Organization;
use App\Models\OrganizationMember;
use App\Models\RequestJoinOrganization;
use App\Services\Dashboard\OrganizationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OrganizationController extends Controller
{
    public function index(OrganizationService $organizationService, Request $request) {
        $organizations = [];
        if($request->has('search')) {
            $organizations = $organizationService->searchOrganizations($request->search);
        } else {
            $organizations = $organizationService->getLatestOrganizationsPaginate();
        }

        return inertia('Dashboard/Organization/Index', compact('organizations'));
    }

    public function create() {
        return inertia('Dashboard/Organization/Create');
    }

    public function show(Organization $organization, OrganizationService $organizationService) {
        $members = $organizationService->getOrganizationMembers($organization);
        return inertia('Dashboard/Organization/View', compact('organization', 'members'));
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

    public function updateForm(UpdateOrganizationRequest $request, Organization $organization, OrganizationService $organizationService) {
        $organizationService->updateOrganization($organization, $request->validated());

        return redirect()->route('dashboard.organizations.index');
    }

    public function destroy(Organization $organization) {
        $organization->delete();
        return back();
    }

    public function request(JoinOrganizationRequest $request, OrganizationService $organizationService) {
        $organizationService->requestToJoinOrganization($request->code);
        return back();
    }

    public function requests(Organization $organization) {
        $requesting_users = $organization->requestingUsers()->paginate(8);
        return inertia('Dashboard/Organization/Request', compact('organization', 'requesting_users'));
    }

    public function changeStatus(RequestJoinOrganization $requestJoin, $status, OrganizationService $organizationService) {
        $organizationService->updateRequestJoinStatus($requestJoin, $status);
        return back();
    }
}
