<?php

namespace App\Http\Controllers;

use App\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function saveReport(Request $request)
    {

        //        return response()->json($request->all());
        if($request->get('password') != 'giorgi.kakhiani13@gmail.com')
        {
            return response()->json(['message' => 'password error','status' => false]);
        }

        $data = $request->all();

        Report::create([
//            'location'  => json_encode($data['location']),
            'emergency' => $data['emergency'],
            'address'   => $data['address'],
            'phone'    => $data['phone'],
            'description' => $data['description'],
            'lat' => $data['lat'],
            'lng' => $data['lng']
        ]);
        return response()->json(['message' => 'successfully submitted','status' => true]);
    }

    public function get()
    {
        $reports = Report::all();
        return $reports->toJson(JSON_PRETTY_PRINT);
        return response()->json($request->all());
    }
}
