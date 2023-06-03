<?php

namespace App\Services\Page;

use DB;
use App\Models\Page;
use App\Services\ServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class PageServices implements ServiceInterface
{
    public function get(): Collection
    {
        return Page::query()->enabled()->get();
    }

    public function findById($id, $checkStatus = false): Model
    {
        if ($checkStatus) {
            return Page::query()->enabled()->findOrFail($id);
        }

        return Page::query()->findOrFail($id);
    }

    public function store($request): Page
    {
        return DB::transaction(function () use ($request) {
            return Page::query()->create([
                'title' => $request->title,
                'description' => $request->description,
            ]);
        });
    }

    public function update($request, $id): Page
    {
        return DB::transaction(function () use ($request, $id) {
            $page = $this->findById($id);

            $page->update([
                'title' => $request->title,
                'description' => $request->description,
            ]);

            return $page;
        });
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {
            $page = $this->findById($id);
            $page->delete();
        });
    }
}
