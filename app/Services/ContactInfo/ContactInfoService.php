<?php

namespace App\Services\ContactInfo;

use App\Models\Contact;
use App\Models\ContactInfo;
use App\Services\BaseServiceInterface;
use Illuminate\Support\Facades\Auth;

class ContactInfoService implements BaseServiceInterface
{

    public function list($id)
    {
        return Contact::where('uuid', $id)->where('user_id', Auth::id())->with('contactInfos')->first()->toArray();
    }

    public function create(array $data)
    {
        $contactInfo = ContactInfo::create($data);
        return $this->list($contactInfo->contact_id);
    }

    public function update(array $data, $id)
    {
        $contactInfo = ContactInfo::find($id)->update($data);
        return $this->list($contactInfo->contact_id);
    }

    public function delete($id)
    {
        $contactInfo = ContactInfo::find($id)->delete();
        return $this->list($contactInfo->contact_id);
    }

    public function filter($type, $value, $select = ['*']): array
    {
        return ContactInfo::query()->
        where('info_type', $type)->
        where('info_value', $value)->
        withCount('contact')->
        with('contact')->
        get($select)->toArray();
    }
}
