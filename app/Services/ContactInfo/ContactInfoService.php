<?php

namespace App\Services\ContactInfo;

use App\Models\ContactInfo;
use App\Services\BaseServiceInterface;

class ContactInfoService implements BaseServiceInterface
{

    public function list()
    {
        // TODO: Implement list() method.
    }

    public function create(array $data)
    {
        ContactInfo::create($data);
    }

    public function update(array $data, $id)
    {
        ContactInfo::find($id)->update($data);
    }

    public function delete($id)
    {
        ContactInfo::find($id)->delete();
    }
}
