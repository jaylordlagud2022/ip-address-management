<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

final class AuditLog extends AbstractModel
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'action',
        'description',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'action' => 'string',
        'description' => 'string',  // Assuming details is stored as a JSON column
    ];

    /**
     * Get the user that owns the audit log.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

   public function getId(): int
    {
        return $this->getAttribute('id');
    }

    public function getAction(): string
    {
        return $this->getAttribute('action');
    }

    public function getDescription(): string
    {
        return $this->getAttribute('description');
    }
}
