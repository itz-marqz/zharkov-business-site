<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;

class ContactController extends Controller
{
    public function show()
    {
        $settings = (object) SiteSetting::query()->pluck('value', 'key')->all();

        return view('frontend.contacts', compact('settings'));
    }
}
