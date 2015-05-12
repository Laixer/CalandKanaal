<?php

namespace App\Http\Controllers;

use App\Measurement;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MeasurementController extends Controller{

	public function index(){

		$measurements = Measurement::all();
		return response()->json($measurements);

	}

	 public function doDelete(Request $request) {

		$filename = Measurement::find($request->input('messid'))->ascloc;
		File::delete($filename);

        Measurement::destroy($request->input('messid'));

        return response()->json(array('success' => 1));
    }

}
