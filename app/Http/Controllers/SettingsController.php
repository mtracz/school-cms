<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\SettingsService;

class SettingsController extends Controller
{
    public function getSettings() {
        
        $settingsService = new SettingsService();

        $settingsData = $settingsService->getSettingsData();

        return $settingsData;
    }

    public function setSettings(Request $request) {
    	
    	
    }
}