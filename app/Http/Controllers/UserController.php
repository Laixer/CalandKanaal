<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\Filesystem\Factory;

class UserController extends Controller{

	public function doDelete(Request $request) {

		User::destroy($request->input('userid'));

		return response()->json(array('success' => 1));
	}

	public function doDisable(Request $request) {

		$user = User::find($request->input('userid'));
		$user->active = 0;
		$user->save();

		return response()->json(array('success' => 1));
	}

	public function doEnable(Request $request) {

		$user = User::find($request->input('userid'));
		$user->active = 1;
		$user->save();

		return response()->json(array('success' => 1));
	}

}
