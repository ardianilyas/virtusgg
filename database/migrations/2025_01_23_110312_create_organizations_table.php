<?php

use App\Enum\OrganizationStatusEnum;
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
        Schema::create('organizations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('image')->nullable()->unique();
            $table->string('image_path')->nullable();
            $table->string('description');
            $table->foreignUuid('creator_id')->constrained('users')->onDelete('cascade');
            $table->string('code')->unique()->nullable();
            $table->enum('status', array_column(OrganizationStatusEnum::cases(), 'value'))->default(OrganizationStatusEnum::ACTIVE->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};
