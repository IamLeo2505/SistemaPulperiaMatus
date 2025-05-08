<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        return view('livewire.dashboard.home', [
            'title' => 'Dashboard'
        ]);
    }
    
}
