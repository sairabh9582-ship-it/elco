<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        // Placeholder
        return view('admin.dashboard')->with('error', 'Coupon management is coming soon.');
    }
}
