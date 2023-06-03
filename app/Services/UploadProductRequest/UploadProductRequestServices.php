<?php

namespace App\Services\UploadProductRequest;

use Exception;
use ZipArchive;
use App\Enums\ProductEnum;
use App\Models\SellerProduct;
use App\Imports\ImportProduct;
use App\Enums\UploadProductEnum;
use App\Services\ServiceInterface;
use Illuminate\Support\Facades\DB;
use App\Models\UploadProductRequest;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class UploadProductRequestServices implements ServiceInterface
{
    public function get(): Collection
    {
        return UploadProductRequest::query()->get();
    }

    public function findById($id, $checkStatus = false): Model
    {
        return UploadProductRequest::query()->findOrFail($id);
    }

    public function store($request)
    {
        // TODO: Implement store() method.
    }

    public function update($request, $id)
    {
        // TODO: Implement update() method.
    }

    public function destroy($id)
    {
        return DB::table(function () use ($id) {
            $productRequest = $this->findById($id);

            $productRequest->delete();
        });
    }

    public function accept($id)
    {
        return DB::table(function () use ($id) {
            $productRequest = $this->findById($id);

            if ($productRequest->status == 'accepted') {
                throw new Exception(__('Products already inserted'));
            }

            // EXCELSHEET
            $excelSheetUrl = $productRequest->getFirstMedia(UploadProductEnum::EXCELSHEET->name);
            $this->saveExcelSheet($excelSheetUrl, $productRequest->seller->id);

            // ZIP FILES
            $zipFile = $productRequest->getFirstMedia(UploadProductEnum::IMAGES->name);
            $this->saveImages($zipFile, $productRequest->seller->id);

            $productRequest->update([
                'status' => 'completed',
            ]);
        });
    }

    public function updateFiles($id)
    {
    }

    private function saveImages($url, $seller_id)
    {
        $zip = new ZipArchive();

        $zip->open($url->getPath());

        if ($zip->numFiles == 0) {
            throw new Exception(__('Please Upload Images in compressed file'));
        }
        for ($i = 0; $i < $zip->numFiles; $i++) {
            $state = $zip->statIndex($i);

            $imageName = $state['name'];

            $image = explode('.', $imageName);

            if (end($image) != 'jpg') {
                throw new Exception(__('Please Upload Images with extension of jpg only'));
            }
        }

        $zip->extractTo(storage_path('app/temp'));

        for ($i = 0; $i < $zip->numFiles; $i++) {
            $state = $zip->statIndex($i);
            $imageName = $state['name'];
            $image = explode('.', $imageName);

            $product = SellerProduct::query()->where('seller_id', $seller_id)->where('code', head($image))->first();

            $path = storage_path('app/temp/' . $imageName);

            if (! is_null($product)) {
                $product->addMedia($path)->toMediaCollection(ProductEnum::PRODUCT_IMAGE_COLLECTION->name);
            }
        }
    }

    private function saveExcelSheet($url, $seller_id)
    {
        Excel::import(new ImportProduct($seller_id), $url->getPath());
    }
}
