<?php

namespace App\Services\Contact;

use App\Models\Contact;
use App\Services\BaseServiceInterface;
use Illuminate\Support\Facades\Auth;

class ContactService implements BaseServiceInterface
{

    public function list(): array
    {
        return Contact::with('contactInfos')->where('user_id', Auth::id())->get()->toArray();
    }

    public function create(array $data): array
    {
        Contact::create($data);
        return $this->list();
    }

    public function update(array $data, $id)
    {
        Contact::find($id)->update($data);
        return $this->list();
    }

    public function delete($id)
    {
        Contact::find($id)->delete();
        return $this->list();
    }

    public function uploadPhoto($file): string
    {
        return $file->store('contacts');
    }
}
