<?php

namespace App\Helper;

use Gate;
use Http;
use Exception;
use Vonage\Client;
use App\Models\Media;
use LaravelLocalization;
use App\Enums\SellerEnum;
use Illuminate\Support\Str;
use Vonage\SMS\Message\SMS;
use Intervention\Image\Image;
use App\Enums\TransactionEnum;
use App\Models\GeneralSetting;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Vonage\Client\Credentials\Basic;
use Laravel\Sanctum\PersonalAccessToken;
use Kutia\Larafirebase\Services\Larafirebase;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Symfony\Component\HttpFoundation\Response;

class Helper
{
    public static function setFileName($file): string
    {
        return time() . '-' . Str::random(100) . '.' . $file->extension();
    }

    public static function checkAccordionIsActive($url): bool
    {
        return url()->full() == $url;
    }

    public static function getModelMultiMediaUrls($model, $collectName): array
    {
        $links = [];
        if ($model->hasMedia($collectName)) {
            foreach ($model->getMedia($collectName) as $single_media) {
                $links[] = $single_media->getUrl();
            }
        }

        return $links;
    }

    public static function getFirstMediaUrl($model, $collectionName)
    {
        if ($model->hasMedia($collectionName)) {
            return $model->getFirstMediaUrl($collectionName);
        }
        $gs = GeneralSetting::query()->firstOrFail();

        return $gs->logo;
    }

    public static function notifications($className): array
    {
        $titles = [
            '' => '',
        ];

        return [
            'title' => $titles[$className],
        ];
    }

    public static function IsUpdateRequest(): bool
    {
        return in_array(strtolower(request()->getMethod()), ['put', 'patch']);
    }

    public static function abortPermission(string $permission)
    {
        if (request()->wantsJson()) {
            return response()->json([
                'success' => false,
                'data' => [],
                'message' => __('Permission Denied'),
            ], Response::HTTP_FORBIDDEN);
        }
        abort_unless(Gate::allows($permission), Response::HTTP_FORBIDDEN);
    }

    public static function setSlug($string, $separator = '-'): array|string|null
    {
        if (is_null($string)) {
            return '';
        }
        $string = trim($string);
        $string = str_replace([',', ' ',
            '?', '"', '.', '/', '|', '\\',
            '~', '+', '>', '<', '؟', '#',
            '/', '\\', ' ', '\'', '"', '`',
            '!', '@', '$', '%', '^', '&', '*',
            '(', ')', '='], '-', $string);
        $string = preg_replace("/[^a-z0-9_\sءاأإآؤئبتثجحخدذرزسشصضطظعغفقكلمنهويةى]#u/", '', $string);
        $string = preg_replace("/[\s-]+/", ' ', $string);

        return preg_replace("/[\s_]/", $separator, $string);
    }

    public static function getImageFromUrl($path, $width, $height)
    {
        $extension = File::extension($path);
        $saved_path = public_path('temp/' . Str::random(10) . '.' . $extension);

        try {
            $image = Image::make($path);
            $image->resize($width, $height);
            $image->save($saved_path);
            $image->destroy();

            return $saved_path;
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

    public static function price($price, $with_currency = true, $currency = 'dollar'): float|string
    {
        if ($currency == 'dollar') {
            if ($with_currency) {
                return number_format($price, 2) . ' ' . __('Dollar');
            }

            return floatval($price);
        }
        if ($with_currency) {
            return number_format($price, 2) . ' ' . __('ID');
        }

        return floatval($price);
    }

    public static function months(): array
    {
        return [
            'jan' => [
                'title' => __('January'),
                'date' => Carbon::now()->firstOfYear()->format('Y-m-d H:i:s'),
            ],
            'feb' => [
                'title' => __('February'),
                'date' => Carbon::now()->firstOfYear()->addMonth()->format('Y-m-d H:i:s'),
            ],
            'mar' => [
                'title' => __('March'),
                'date' => Carbon::now()->firstOfYear()->addMonths(2)->format('Y-m-d H:i:s'),
            ],
            'apr' => [
                'title' => __('April'),
                'date' => Carbon::now()->firstOfYear()->addMonths(3)->format('Y-m-d H:i:s'),
            ],
            'may' => [
                'title' => __('May'),
                'date' => Carbon::now()->firstOfYear()->addMonths(4)->format('Y-m-d H:i:s'),
            ],
            'june' => [
                'title' => __('June'),
                'date' => Carbon::now()->firstOfYear()->addMonths(5)->format('Y-m-d H:i:s'),
            ],
            'july' => [
                'title' => __('July'),
                'date' => Carbon::now()->firstOfYear()->addMonths(6)->format('Y-m-d H:i:s'),
            ],
            'aug' => [
                'title' => __('August'),
                'date' => Carbon::now()->firstOfYear()->addMonths(7)->format('Y-m-d H:i:s'),
            ],
            'sept' => [
                'title' => __('September'),
                'date' => Carbon::now()->firstOfYear()->addMonths(8)->format('Y-m-d H:i:s'),
            ],
            'oct' => [
                'title' => __('October'),
                'date' => Carbon::now()->firstOfYear()->addMonths(9)->format('Y-m-d H:i:s'),
            ],
            'nov' => [
                'title' => __('November'),
                'date' => Carbon::now()->firstOfYear()->addMonths(10)->format('Y-m-d H:i:s'),
            ],
            'dec' => [
                'title' => __('December'),
                'date' => Carbon::now()->firstOfYear()->addMonths(11)->format('Y-m-d H:i:s'),
            ],
        ];
    }

    public static function formatDate($data, $format = 'Y-m-d H:i:s'): string
    {
        return Carbon::parse($data)->format($format);
    }

    public static function setLang($value, $enableTranslation = false): array
    {
        $languages = config('laravellocalization.supportedLocales');
        $data = [];
        foreach ($languages as $locale => $lanValue) {
            if ($enableTranslation) {
                $data[$locale] = Helper::translate($locale, $value);
            } else {
                $data[$locale] = $value;
            }
        }

        return $data;
    }

    public static function translate($to, $word, $from = null): ?string
    {
        if (! is_null($word)) {
            $googleTranslate = new GoogleTranslate();
            if ($from == null) {
                $googleTranslate->setSource();
            } else {
                $googleTranslate->setSource($from);
            }
            $googleTranslate->setTarget($to);

            return $googleTranslate->translate($word);
        }

        return $word ?? '';
    }

    public static function imageRules($isUpdateAction = false): array
    {
        if ($isUpdateAction) {
            return [
                'nullable',
                'mimetypes:' . implode(',', Media::$IMAGES_MIMES_TYPES),
            ];
        }

        return [
            'required',
            'mimetypes:' . implode(',', Media::$IMAGES_MIMES_TYPES),
        ];
    }

    public static function getLocationDetailsFromGoogleMapApi($fromLat, $fromLng, $toLat, $toLng): array
    {
        $googleMapApi = config('services.google_map.api');
        $url = 'https://maps.googleapis.com/maps/api/distancematrix/json?language=' . LaravelLocalization::getCurrentLocale() . "&destinations=$fromLat,$fromLng&origins=$toLat,$toLng&key=$googleMapApi";
        $response = Http::get($url);
        if ($response->status() == 200 && isset($response['rows']) && $response['status'] == 'OK') {
            $response = $response->json();

            if ($response['rows'][0]['elements'][0]['status'] == 'ZERO_RESULTS') {
                return [
                    'distanceText' => 0,
                    'distanceValue' => 0,
                    'durationText' => 0,
                    'durationValue' => 0,
                ];
            }

            return [
                'distanceText' => $response['rows'][0]['elements'][0]['distance']['text'],
                'distanceValue' => $response['rows'][0]['elements'][0]['distance']['value'] / 1000,
                'durationText' => $response['rows'][0]['elements'][0]['duration']['text'],
                'durationValue' => $response['rows'][0]['elements'][0]['duration']['value'] / 60,
            ];
        } else {
            return [
                'distanceText' => 0,
                'distanceValue' => 0,
                'durationText' => 0,
                'durationValue' => 0,
            ];
        }
    }

    public static function sendOTP($phone, $code): void
    {
        $gs = GeneralSetting::query()->first();
        $basic = new Basic($gs->vonage_api_key, $gs->vonage_api_secret);
        $client = new Client($basic);
        $client->sms()->send(new SMS($phone, $gs->vonage_brand_name, __('Your OTP Code is : ') . $code));
    }

    public static function sendTextMessageToWhatsapp($phone, $text)
    {
        $gs = GeneralSetting::query()->first();
        $from = $gs->vonage_whatsapp_from_number;
        $baseUrl = config('app.vonage_base_url');

        return Http::withBasicAuth($gs->vonage_api_key, $gs->vonage_api_secret)->post($baseUrl, [
            'from' => Str::remove('+', $from),
            'to' => $phone,
            'message_type' => 'text',
            'text' => $text,
            'channel' => 'whatsapp',
        ])->json();
    }

    public static function sendFileMessageToWhatsapp($phone, $url, $captain): void
    {
        $gs = GeneralSetting::query()->first();
        $from = $gs->vonage_whatsapp_from_number;
        $baseUrl = config('app.vonage_base_url');
        $response = Http::withBasicAuth($gs->vonage_api_key, $gs->vonage_api_secret)->post($baseUrl, [
            'from' => Str::remove('+', $from),
            'to' => $phone,
            'message_type' => 'file',
            'file' => [
                'url' => $url,
                'caption' => $captain,
            ],
            'channel' => 'whatsapp',
        ])->json();
        Log::info(json_encode($response));
    }

    public static function getHtmlOptions($data, $value = 'id', $valueData = 'title'): string
    {
        $html = "<option disabled selected value=''>" . __('Select an option') . '</option>';
        foreach ($data as $single_data) {
            $html .= "<option value='" . $single_data->$value . "'>" . $single_data->$valueData . '</option>';
        }

        return $html;
    }

    public static function getAuthUserFromAccessToken()
    {
        if (! request()->hasHeader('Authorization')) {
            return null;
        }

        $access_token = Str::remove('Bearer ', request()->header('Authorization'));

        $user = PersonalAccessToken::findToken($access_token);

        if (is_null($user)) {
            return null;
        }

        return $user?->tokenable;
    }

    public static function createDynamicLink($for, $id, $type)
    {
        $gs = GeneralSetting::query()->first();
        $prefix = $gs->dynamic_link;
        $link = $prefix . "/$for?id=$id&type=$type";
        $androidPackageName = $gs->android_package_name;
        $iosPackageName = $gs->ios_package_name;
        $iosAppStoreId = $gs->ios_store_id;
        $firebase_app_key = $gs->firebase_api_key;
        $shortLink = Http::post("https://firebasedynamiclinks.googleapis.com/v1/shortLinks?key=$firebase_app_key", [
            'dynamicLinkInfo' => [
                'domainUriPrefix' => $prefix,
                'link' => $link,
                'androidInfo' => [
                    'androidPackageName' => $androidPackageName,
                ],
                'iosInfo' => [
                    'iosBundleId' => $iosPackageName,
                    'iosAppStoreId' => $iosAppStoreId,
                ],
            ],
            'suffix' => [
                'option' => 'SHORT',
            ],
        ])->json();

        return $shortLink['shortLink'] ?? null;
    }

    public static function TransactionTypeText($type): string
    {
        $transactionType = match ($type) {
            TransactionEnum::CREDIT->name => __('Credit'),
            TransactionEnum::DEBIT->name => __('Debit'),
            TransactionEnum::TRANSFER_POINT_TO_USER->name => __('Transfer points to user'),
            TransactionEnum::TRANSFER_POINT_TO_SELLER->name => __('Transfer points to seller'),
            TransactionEnum::TRANSFER_POINT_TO_POS->name => __('Transfer points to pos'),
            TransactionEnum::SELLER_SUBSCRIPTION->name => __('Seller Subscription'),
            TransactionEnum::SELLER_SEND_NOTIFICATION_SERVICE->name => __('Notification service'),
            TransactionEnum::SELLER_ADD_PRODUCT_TO_SLIDER->name => __('Add Product to slider service'),
            TransactionEnum::SELLER_ADD_PRODUCT_TO_OFFER->name => __('Add Product to offer service'),
            TransactionEnum::SELLER_UPLOAD_PRODUCT->name => __('Upload product service'),
            TransactionEnum::POS_CREATING_CARDS->name, TransactionEnum::AGENT_CREATING_CARDS->name => __('Create Charging Card'),
            TransactionEnum::CREDIT_USER_BY_CHARGING_CARD->name, TransactionEnum::CREDIT_SELLER_BY_CHARGING_CARD->name => __('Charging Card'),
            TransactionEnum::CREDIT_USER_DUE_COMPLETE_ORDER->name => __('Complete Order'),
            TransactionEnum::TRANSFER_POINTS_DUE_TO_COMPLETE_ORDER->name => __('Transfer to user due completing order'),
            TransactionEnum::COMPLETED_GIFT_ORDER->name => __('Complete Gift Order'),
            TransactionEnum::WITHDRAWAL->name => __('Withdrawal'),
            default => '--'
        };

        if ($type == TransactionEnum::CREDIT->name) {
            return "<span class='badge badge-success'>" . $transactionType . '</span>';
        }

        return "<span class='badge badge-info'>" . $transactionType . '</span>';
    }

    public static function randomNDigitNumber($digits = 16): int|string
    {
        $card_number = mt_rand(1, 9);

        while (strlen($card_number) < $digits) {
            $card_number .= mt_rand(0, 9);
        }

        if (DB::table('charging_cards')->where('card_number', $card_number)->exists()) {
            self::randomNDigitNumber();
        }

        return $card_number;
    }

    public static function sellerPrice($currency, $price): string
    {
        if (LaravelLocalization::getCurrentLocale() == 'ar') {
            return ($currency == SellerEnum::ID ? __('Iraqi Dinar') : '$') . $price;
        } else {
            return $price . '' . ($currency == SellerEnum::ID ? __('Iraqi Dinar') : '$');
        }
    }

    public static function sendFirebaseNotification($device_token, $title, $content): void
    {
        if (! is_null($device_token) && $device_token != '') {
            Log::info($device_token);
            (new Larafirebase())->fromRaw([
                'registration_ids' => [$device_token],
                'priority' => 'high',
                'notification' => [
                    'title' => $title,
                    'body' => $content,
                    'sound' => 'default',
                ],
            ])->send();
        }
    }

    public static function isSellerPointGreaterThanSetting(int $points): bool
    {
        return $points > (int)GeneralSetting::query()
            ->first()
                ->minimum_points_to_view_points_in_products;
    }

    public static function typeStoreSeller($type)
    {
        $data = [
            0 => __('Is Private Store'),
            1 => __('Is Public Store'),
            2 => __('Is Restaurant Store'),
        ];

        return $data[$type];
    }

    public static function OperNowStore($time_from, $time_to)
    {
        $currentTime = \Carbon\Carbon::now();
        $timeFrom = Carbon::parse($time_from);
        $timeTo = Carbon::parse($time_to);
        $isOpenNow = $currentTime->between($timeFrom, $timeTo);

        if ($isOpenNow == true) {
            return __('Now Open');
        } else {
            return __('Now Close');
        }
    }

    public static function combinations($arrays)
    {
        $result = [[]];
        foreach ($arrays as $property => $property_values) {
            $tmp = [];
            foreach ($result as $result_item) {
                foreach ($property_values as $property_value) {
                    $tmp[] = array_merge($result_item, [$property => $property_value]);
                }
            }
            $result = $tmp;
        }

        return $result;
    }

    public static function typeSeller($type)
    {
        $data = [
            'general' => __('General'),
            'private' => __('Private'),
        ];

        return $data[$type];
    }

    public static function typeDeliveryRate($type)
    {
        $data = [
            'country' => __('Country'),
            'governorate' => __('Governorate'),
            'country_governorate' => __('Country Governorate'),

        ];

        return $data[$type];
    }

    public static function getSwitchValue($checkbox_name, $input)
    {
        return array_key_exists($checkbox_name, $input) && $input[$checkbox_name] === 'on' ? 1 : 0;
    }
}
