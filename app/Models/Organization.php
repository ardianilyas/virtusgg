<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Organization extends Model
{
    /** @use HasFactory<\Database\Factories\OrganizationFactory> */
    use HasFactory, HasUuids;

    protected $guarded = ['id'];

    protected function serializeDate(DateTimeInterface $date): string {
        return $date->setTimezone("Asia/Jakarta")->format("d F Y, H:i:s");
    }

    public function casts(): array {
        return [
            'created_at' => 'datetime:d F Y, H:i:s',
            'updated_at' => 'datetime:d F Y, H:i:s',
        ];
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
