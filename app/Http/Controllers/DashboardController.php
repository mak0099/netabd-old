<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class DashboardController extends Controller {

    public function getDashboard() {
        $view = view('dashboard');
        if (Auth::user()->in_sub_unit()) {
            $announcement = \App\Announcement::where('publication_status', true)->orderBy('id', 'desc')->first();
            $view->with('announcement', $announcement);
        }
        return $view;
    }

}
