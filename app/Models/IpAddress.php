<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

final class IpAddress extends AbstractModel
{
    use HasFactory;

    protected $fillable = [
        'ip_address',
        'label',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'ip_address' => 'string',
        'label' => 'string',
    ];

   public function getId(): int
    {
        return $this->getAttribute('id');
    }

    public function getLabel(): string
    {
        return $this->getAttribute('label');
    }

    public function getIpAddress(): string
    {
    return $this->getAttribute('ip_address');
    }
}
