<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Report;
use Auth;
use Session;

class ReportController extends Controller
{
    public function store(Request $request) {
    	$this->validate($request, [
    		'offense' => 'required|not_in:none',
    		'description' => 'required'
    	]);
        
        $report = New Report;
        $report->reporter = Auth::user()->id;
        $report->reported = $request->reported;
        $report->reason = $request->offense;
        $report->description = $request->description;
        $report->save();

        Session::flash('success', 'User has been reported!');
        return redirect()->back();
       
    }
}
