<?php

namespace App\Models;

use App\Enums\ShippingEnum;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Laravel\Sanctum\NewAccessToken;
use App\Traits\HasProfileImageTrait;
use App\Traits\HandleTransactionTrait;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Http\Resources\ShippingCompany\ShippingCompanyResource;

class ShippingCompany extends Authenticatable implements HasMedia
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasRoles;
    use InteractsWithMedia;
    use HasProfileImageTrait;
    use HandleTransactionTrait;


    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(ShippingEnum::SHIPPING_COMPANY_PROFILE_COLLECTION->value)->singleFile();
    }

    public function getAuthResource(): array
    {
        return [
            'access_token' => $this->createToken('shipping_company_access_token_' . Str::random(10))->plainTextToken,
            'shipping_company' => ShippingCompanyResource::make($this),
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

    public function orders()
    {
        return $this->hasMany(Order::class, 'shipping_company_id', 'id');
    }

    public function deliveries()
    {
        return $this->hasMany(ShippingDelivery::class, 'shipping_company_id', 'id');
    }

    public function cardTransactions(): HasMany
    {
        return $this->hasMany(CardTransaction::class, 'shipping_company_id', 'id');
    }

    public function shippingTransaction(): HasMany
    {
        return $this->hasMany(ShippingTransaction::class);
    }
}
