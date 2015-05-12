<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\Filesystem\Factory;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller{

	public function doNew(Request $request) {

		$user = new User;
		$user->firstname = $request->input('firstname');
		$user->lastname = $request->input('lastname');
		$user->email = $request->input('email');
		$user->password = Hash::make($request->input('password'));
		$user->save();

        return redirect()->back()->with('success', 'User is created');
	}

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

	public function doResetPassword(Request $request) {

		$user = User::find($request->input('userid'));
		$user->password = Hash::make('ABC@123');
		$user->save();

		return response()->json(array('success' => 1));
	}

}
