<?php

namespace App\Http\Controllers\Seller\Translation;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\SellerProduct;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;

class TranslationController extends Controller
{
    public function index()
    {
        return view('seller.pages.translation.index')->with([
            'translatable' => self::translatable(),
        ]);
    }

    public function show(Request $request)
    {
        $this->validate($request, [
            'model' => 'required',
            'id' => 'required',
            'columns' => 'required|array',
        ]);
        $model = app($request->model)->findOrFail($request->id);
        $columns = $request->columns;

        return view('seller.pages.translation.show')->with([
            'model' => $model,
            'columns' => $columns,
        ])->render();
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'model' => 'required|string',
            'model_id' => 'required',
        ]);

        $columns = (new Collection(self::translatable()))->values()->where('model', $request->model)->first();

        if (is_null($columns)) {
            $columns = collect((new Collection(self::translatable()))->values()->pluck('relations'))
                ->values()
                ->where('0.model', $request->model)
                ->firstOrFail()[0];
        }

        $model = app($request->model)->findOrFail($request->model_id);

        $attributes = [];
        foreach ($columns['columns'] as $key => $value) {
            $attributes[$key] = $request->all()[$key];
        }
        $model->update($attributes);

        return $this::sendSuccessResponse([
            'title' => $attributes[array_key_first($columns['columns'])]['ar'] ?? '',
        ], __('Updated Successfully'));
    }

    public static function translatable(): array
    {
        return [
            __('Categories') => [
                'model' => Category::class,
                'translatableColumn' => 'title',
                'columns' => [
                    'title' => [
                        'type' => 'text',
                        'rules' => 'required',
                    ],
                ],
            ],
            __('Sub Categories') => [
                'model' => SubCategory::class,
                'translatableColumn' => 'title',
                'columns' => [
                    'title' => [
                        'type' => 'text',
                        'rules' => 'required',
                    ],
                ],
            ],
            __('Products') => [
                'model' => SellerProduct::class,
                'translatableColumn' => 'title',
                'columns' => [
                    'title' => [
                        'type' => 'text',
                        'rules' => 'required',
                    ],
                    'description' => [
                        'type' => 'textarea',
                        'rules' => 'required',
                    ],
                ],
            ],
        ];
    }
}
