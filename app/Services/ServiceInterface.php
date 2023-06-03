<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

interface ServiceInterface
{
    public function get(): Collection;

    public function findById($id, $checkStatus = false): Model;

    public function store($request);

    public function update($request, $id);

    public function destroy($id);
}
