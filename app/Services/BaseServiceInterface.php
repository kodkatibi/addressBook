<?php

namespace App\Services;

interface BaseServiceInterface
{
    public function list();

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);
}
