<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class OrganizationMember extends Model
{
    /** @use HasFactory<\Database\Factories\OrganizationMemberFactory> */
    use HasFactory, HasUuids;

    protected $guarded = ['id'];

    public function organization(): BelongsTo {
        return $this->belongsTo(Organization::class);
    }
}
