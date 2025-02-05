<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RequestJoinOrganization extends Model
{
    /** @use HasFactory<\Database\Factories\RequestJoinOrganizationFactory> */
    use HasFactory, HasUuids;

    protected $guarded = ['id'];

    public function organization(): BelongsTo {
        return $this->belongsTo(Organization::class);
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
