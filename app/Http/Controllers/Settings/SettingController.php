<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\Settings\SettingService;
use Illuminate\Http\Request;

class SettingController extends Controller
{

    function __construct(SettingService $service)
    {
        parent::__construct($service);
    }

    public function save(Request $request)
    {
        return $this->service->save($request);
    }
}
