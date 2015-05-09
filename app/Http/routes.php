<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use Illuminate\Http\Request;

$app->get('/', function() {

	if (Auth::check())
		return view('dashboard');
	else
		return redirect('login');
});

$app->get('api/test','App\Http\Controllers\MeasurementController@index');

$app->get('test/parser','App\Http\Controllers\ParserController@index');

$app->get('/login', function() {
    return view('login');
});

$app->post('login', function(Request $request) {

    if (Auth::attempt($request->only('email', 'password'))) {
		return response()->json(array('error' => 0, 'location' => '/'));
    } else {
		return response()->json(array('error' => 1));
	}

});
