<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Report;
use Auth;

class ReportController extends Controller
{
    public function store($id) {
        
        $report = New Report;
        $report->reporter = Auth::user()->id;
        $report->reported = $id;
        $report->save();
        return response()->json(['success' => 'User has been reported!']);
       
    }
}
