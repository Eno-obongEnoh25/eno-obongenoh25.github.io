<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $certificates = Certificate::query()
            ->orderByDesc('issued_at')
            ->orderByDesc('id')
            ->get();

        return view('home', [
            'certificates' => $certificates,
        ]);
    }
}

