<?php

use App\Models\Organization;
use App\Models\RequestJoinOrganization;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
   $this->user = User::factory()->create();
   $this->actingAs($this->user);
});

it('can create an organization', function () {
    $data = [
        'name' => "Virtus Test",
        'description' => "Virtus test organization description",
        'creator_id' => $this->user->id,
    ];

    $organization = $this->user->organizations()->create($data);
    expect($organization)->toBeInstanceOf(Organization::class);
});

it('can update an organization', function () {
    $data = [
        'name' => "Virtus Test",
        'description' => "Virtus test organization description",
        'creator_id' => $this->user->id,
    ];

    $updatedData = [
        'name' => "Virtus Test Updated",
    ];

    $organization = $this->user->organizations()->create($data);

    $organization->update($updatedData);

    $this->assertDatabaseHas('organizations', $updatedData);
});

it('can delete an organization', function () {
   $data = [
       'name' => "Virtus Test",
       'description' => "Virtus test organization description",
   ];
   $organization = $this->user->organizations()->create($data);
   $organization->delete();
   $this->assertDatabaseMissing('organizations', $data);
});

it('can view an organization', function () {
   $organization = Organization::factory()->create();
   $response = $this->get(route('dashboard.organizations.show', $organization));
   $response->assertStatus(200);
});

it('can request to join an organization', function () {
   $organization = Organization::factory()->create();
   $data = [
       'user_id' => $this->user->id,
       'organization_id' => $organization->id,
   ];
   RequestJoinOrganization::create($data);

   $this->assertDatabaseHas('request_join_organizations', $data);
});