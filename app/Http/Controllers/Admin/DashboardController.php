<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\ContactMessage;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'certificateCount' => Certificate::query()->count(),
            'messageCount' => ContactMessage::query()->count(),
        ]);
    }
}

