<?php

namespace App\Http\Controllers;

use App\Services\Contact\ContactService;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    protected $contactService;

    public function __construct()
    {
        $this->contactService = new ContactService();
    }

    public function list()
    {

    }
}
