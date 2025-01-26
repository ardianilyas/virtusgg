<?php

namespace App\Http\Controllers\Dashboard;

use App\Enum\OrganizationStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CreateOrganizationRequest;
use App\Http\Requests\Dashboard\UpdateOrganizationRequest;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrganizationController extends Controller
{
    public function index() {
        $organizations = Auth::user()->organizations()->paginate(5);
        return inertia('Dashboard/Organization/Index', compact('organizations'));
    }

    public function create() {
        return inertia('Dashboard/Organization/Create');
    }

    public function store(CreateOrganizationRequest $request) {
        Auth::user()->organizations()->create($request->validated());
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
}
