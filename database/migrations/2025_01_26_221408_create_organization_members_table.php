<?php

use App\Enum\OrganizationMemberRoleEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('organization_members', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('organization_id')->references('id')->on('organizations')->cascadeOnDelete();
            $table->foreignUuid('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->string('role')->default(OrganizationMemberRoleEnum::MEMBER->value);
            $table->boolean('is_creator')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organization_members');
    }
};
