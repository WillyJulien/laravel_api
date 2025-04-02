<?php

namespace App\Http\Controllers;

use App\Services\PublicSiteDataService;

class PublicSiteDataController extends Controller
{
    protected $publicSiteDataService;

    public function __construct(PublicSiteDataService $publicSiteDataService)
    {
        $this->publicSiteDataService = $publicSiteDataService;
    }

    public function index()
    {
        $data = $this->publicSiteDataService->index();

        return response()->json($data);
    }

}
