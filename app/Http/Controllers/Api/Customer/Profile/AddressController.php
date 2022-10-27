<?php

namespace App\Http\Controllers\Api\Customer\Profile;

use App\Models\Province;
use App\Http\Controllers\Controller;

class AddressController extends Controller
{
    public function index()
    {
        $provinces = Province::all();
        return view('customer.profile.my-addresses', compact('provinces'));
    }
}
