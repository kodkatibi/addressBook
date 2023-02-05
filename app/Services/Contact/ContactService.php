<?php

namespace App\Services\Contact;

use App\Models\Contact;
use App\Services\BaseServiceInterface;
use Illuminate\Support\Facades\Auth;

class ContactService implements BaseServiceInterface
{

    public function list()
    {
        $data = Auth::user()->contacts();
    }

    public function create(array $data)
    {
        Contact::create($data);
    }

    public function update(array $data, $id)
    {
        Contact::find($id)->update($data);
    }

    public function delete($id)
    {
        Contact::find($id)->delete();
    }
}
