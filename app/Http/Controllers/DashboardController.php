<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $role = auth()->user()->role;

        return match ($role) {
            'admin'  => view('dashboards.admin'),
            'coach'  => view('dashboards.coach'),
            'player' => view('dashboards.player'),
            default  => view('dashboards.fan'),
        };
    }
}
