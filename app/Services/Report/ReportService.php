<?php

namespace App\Services\Report;

use App\Services\Contact\ContactService;
use App\Services\ContactInfo\ContactInfoService;

class ReportService
{
    protected ContactInfoService $contactInfoService;

    public function sameLocation($location): array
    {
        $this->contactInfoService = new ContactInfoService();
        return $this->contactInfoService->filter('location', $location);
    }

    public function sameLocationWithPhone($location): array
    {
        return $this->sameLocation($location);

    }

}
