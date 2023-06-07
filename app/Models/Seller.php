<?php

namespace App\Models;

use Carbon\Carbon;
use App\Enums\UserEnum;
use App\Enums\SellerEnum;
use ChristianKuri\LaravelFavorite\Traits\Favoriteable;
use Illuminate\Support\Str;
use App\Enums\FriedRequestEnum;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\NewAccessToken;
use App\Traits\HasProfileImageTrait;
use Illuminate\Support\Facades\Auth;
use App\Traits\HandleTransactionTrait;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Http\Resources\Seller\SellerResource;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Seller extends Authenticatable implements HasMedia
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasRoles;
    use InteractsWithMedia;
    use HasProfileImageTrait;
    use HandleTransactionTrait;
    use Favoriteable;

    // type seller => is_public_store => general_store = 1, private_store = 0, restaurant_store = 2

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function governorate(): BelongsTo
    {
        return $this->belongsTo(Governorate::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(UserEnum::USER_PROFILE_COLLECTION_NAME->value)->singleFile();
    }

    public function getAuthResource(): array
    {
        return [
            'access_token' => $this->createToken('user_access_token_' . Str::random(10))->plainTextToken,
            'seller' => SellerResource::make($this),
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

    public function categories(): HasMany
    {
        return $this->hasMany(SellerCategory::class);
    }

    public function classifications()
    {
        return $this->belongsToMany(Category::class, 'seller_categories');
    }

    public function products(): HasMany
    {
        return $this->hasMany(SellerProduct::class);
    }
    public function categoryProducts($id): HasMany
    {
        return $this->hasMany(SellerProduct::class)->where('category_id',$id);
    }

    public function newProducts(): HasMany
    {
        return $this->hasMany(SellerProduct::class)
            ->where('admin_approval', 1)
            ->where('new_product', 1);
    } 
    public function categoryNewProducts($id): HasMany
    {
        return $this->hasMany(SellerProduct::class)
            ->where('admin_approval', 1)
            ->where('new_product', 1)
            ->where('category_id',$id)
            ;
    }

    public function productPoints(): HasMany
    {
        return $this->hasMany(SellerProduct::class)
            ->where('admin_approval', 1)
            ->whereNotNull('points')
            ->orderBy('points', 'desc');
    }  
    public function categoryProductPoints($id): HasMany
    {
        return $this->hasMany(SellerProduct::class)
            ->where('admin_approval', 1)
            ->whereNotNull('points')
            ->orderBy('points', 'desc')
            ->where('category_id',$id)
            ;
    }

    public function otherProducts(): HasMany
    {
        return $this->hasMany(SellerProduct::class)
            ->where('admin_approval', 1)
            ->where('new_product', 0)
            ->whereNull('points');
    }
    public function categoryOtherProducts($id): HasMany
    {
        return $this->hasMany(SellerProduct::class)
            ->where('admin_approval', 1)
            ->where('new_product', 0)
            ->whereNull('points')
            ->where('category_id',$id)
            ;
    }

    public function subCategories(): HasMany
    {
        return $this->hasMany(SellerSubCategory::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function friendRequest(): HasMany
    {
        return $this->hasMany(FriendRequest::class);
    }

    public function sellerQrCode(): Attribute
    {
        return Attribute::get(function () {
            return $this->getFirstMediaUrl(SellerEnum::QR_CODE->name);
        });
    }

    public function showSellerPoints(): bool
    {
        $points = GeneralSetting::query()->first()->minimum_points_to_view_points_in_products;

        return $this->current_points >= $points;
    }

    public function scopePlanExpiredAt($query)
    {
        return $query->whereNull('plan_expired_at')->Orwhere('plan_expired_at', '>=', Carbon::today());
    }

    public function scopeSellerLocal($query)
    {
        return $query->where('is_public_store', 0);
    }

    public function _rating()
    {
        $reviews_count_total = $this->reviews()->count();
        if ($reviews_count_total > 0) {
            $reviews_sum_rating = (int)$this->reviews()->sum('rating');
            $reviews_maximum = $reviews_count_total * 5;
            $total = $reviews_sum_rating / $reviews_maximum;
            $reviews = $total > 0 ? $total * 5 : 0;

            return round($reviews, 2);
        }

        return 0;
    }

    public function reviews()
    {
        return $this->hasMany(SellerReviews::class, 'seller_id', 'id');
    }

    public function cardTransactions()
    {
        return $this->hasMany(CardTransaction::class, 'seller_id', 'id');
    }

    public function scopeSellerStuff($query)
    {
        return $query->where('parent_id', Auth::user()->id);
    }

    public function isOrdinaryFriendToSeller($store_seller_id): bool
    {
        return DB::table('seller_friend_requests')
            ->where('seller_id', $this->id)
            ->where('store_seller_id', $store_seller_id)
            ->where('friend_request_accepted_from_seller', 1)
            ->where('friendship_type', FriedRequestEnum::ORDINARY->name)
            ->exists();
    }

    public function isSpecialFriendToSeller($store_seller_id): bool
    {
        return DB::table('seller_friend_requests')
            ->where('seller_id', $this->id)
            ->where('store_seller_id', $store_seller_id)
            ->where('friend_request_accepted_from_seller', 1)
            ->where('friendship_type', FriedRequestEnum::SPECIAL->name)
            ->exists();
    }

    public function violations()
    {
        return $this->hasMany(SellerViolation::class, 'seller_id', 'id');
    }

    public function blueTag()
    {
        return $this->hasMany(BlueTag::class, 'seller_id', 'id');
    }
    public function offerProducts()
    {
        return $this->belongsToMany(SellerProduct::class, 'product_offers');
    }
}
