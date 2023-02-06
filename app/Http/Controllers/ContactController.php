<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Services\Contact\ContactService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    protected ContactService $contactService;

    public function __construct()
    {
        $this->contactService = new ContactService();
    }

    public function list()
    {
        $result = $this->contactService->list();
        return $this->response($result);
    }

    public function create(ContactRequest $request)
    {
        $path = $this->contactService->uploadPhoto($request->file('photo'));
        $data = [
            'user_id' => Auth::id(),
            'name' => $request->name,
            'last_name' => $request->last_name,
            'photo' => $path,
            'company' => $request->company
        ];
        $result = $this->contactService->create($data);
        return $this->response($result);
    }

    public function update(Request $request)
    {
        $data = $request->except('id');
        $result = $this->contactService->update($data, $request->id);
        return $this->response($result);
    }

    public function delete($id)
    {
        $result = $this->contactService->delete($id);
        return $this->response($result);
    }
}
