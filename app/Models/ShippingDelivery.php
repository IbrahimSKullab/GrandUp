<?php

namespace App\Models;

use App\Http\Resources\ShippingDelivery\ShippingDeliveryResource;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\NewAccessToken;
use App\Traits\HandleTransactionTrait;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Http\Resources\ShippingCompany\ShippingCompanyResource;

class ShippingDelivery extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasRoles;
    use HandleTransactionTrait;

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getAuthResource(): array
    {
        return [
            'access_token' => $this->createToken('shipping_delivery_access_token_' . Str::random(10))->plainTextToken,
            'shipping_delivery' => ShippingDeliveryResource::make($this),
        ];
    }

    public function createToken(string $name, array $abilities = ['*']): NewAccessToken
    {
        $token = $this->tokens()->create([
            'name' => $name,
            'token' => hash('sha256', $plainTextToken = Str::random(150)),
            'abilities' => $abilities,
        ]);

        return new NewAccessToken($token, $token->getKey() . '|' . $plainTextToken);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function governorate(): BelongsTo
    {
        return $this->belongsTo(Governorate::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'shipping_company_id', 'id');
    }
}
