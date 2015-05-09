<?php

namespace App\Http\Controllers;

use App\Measurement;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class MeasurementController extends Controller{

	public function index(){

		$measurements = Measurement::all();
		return response()->json($measurements);

	}

}
