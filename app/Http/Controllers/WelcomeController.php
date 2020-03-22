<?php

namespace App\Http\Controllers;

use App\Report;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
//        $reports = Report::all();
        return View('welcome',
        [
//            'reports' => $reports
        ]);
    }
}
