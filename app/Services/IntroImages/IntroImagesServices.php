<?php

namespace App\Services\IntroImages;

use App\Models\BaseModel;
use App\Models\IntroImages;
use App\Enums\IntroImagesEnum;
use App\Services\ServiceInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class IntroImagesServices implements ServiceInterface
{
    public function get(): Collection
    {
        return IntroImages::query()
            ->when(request()->filled('for_user'), function ($query) {
                return $query->where('for_seller', 'user');
            })
            ->when(request()->filled('for_seller'), function ($query) {
                return $query->where('for_seller', 'seller');
            })
            ->when(request()->filled('for_general_store'), function ($query) {
                return $query->where('for_seller', 'general_store');
            })
            ->when(request()->filled('for_pos'), function ($query) {
                return $query->where('for_seller', 'pos');
            })
            ->when(request()->filled('for_delivery'), function ($query) {
                return $query->where('for_seller', 'delivery');
            })
            ->enabled()
            ->get();
    }

    public function findById($id, $checkStatus = false): Model
    {
        if ($checkStatus) {
            return IntroImages::query()->enabled()->findOrFail($id);
        }

        return IntroImages::query()->findOrFail($id);
    }

    public function store($request)
    {
        return DB::transaction(function () use ($request) {
            $introImage = IntroImages::query()->create([
                'title' => $request->title,
                'description' => $request->description,
                'for_seller' => $request->type,
            ]);

            $this->handleImageUpload($request, $introImage);

            return $introImage;
        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $introImage = $this->findById($id);

            $introImage->update([
                'title' => $request->title,
                'description' => $request->description,
                'for_seller' => $request->type,
            ]);

            $this->handleImageUpload($request, $introImage);

            return $introImage;
        });
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {
            $introImage = $this->findById($id);

            $introImage->delete();
        });
    }

    private function handleImageUpload($request, Model|Builder|BaseModel $introImage)
    {
        if ($request->hasFile('image')) {
            $introImage->addMedia($request->image)->toMediaCollection(IntroImagesEnum::IMAGE->value);
        }
    }
}
