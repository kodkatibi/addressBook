<?php

namespace App\Http\Controllers;

use App\Services\Report\ReportService;

class ReportController extends Controller
{
    protected ReportService $reportService;

    public function __construct()
    {
        $this->reportService = new ReportService();
    }

    public function baseLocation($location)
    {
        $result = $this->reportService->sameLocation($location);
        return $this->response($result);
    }

    public function sameLocationWithPhone($location)
    {
        $result = $this->reportService->sameLocationWithPhone($location);
        return $this->response($result);
    }
}
