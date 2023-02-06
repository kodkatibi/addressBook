<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactInfoRequest;
use App\Services\ContactInfo\ContactInfoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactInfoController extends Controller
{
    protected ContactInfoService $contactInfoService;

    public function __construct()
    {
        $this->contactInfoService = new ContactInfoService();
    }

    public function list($contactId)
    {
        return $this->contactInfoService->list($contactId);
    }

    public function create(ContactInfoRequest $request, $contactId)
    {
        $data = [
            'contact_id' => $contactId,
            'info_type' => $request->info_type,
            'info_value' => $request->info_value,
        ];
        $result = $this->contactInfoService->create($data);
        return $this->response($result);
    }

    public function update(Request $request)
    {
        $data = $request->except('id');
        $result = $this->contactInfoService->update($data, $request->id);
        return $this->response($result);
    }

    public function delete($id)
    {
        $result = $this->contactInfoService->delete($id);
        return $this->response($result);
    }

}
