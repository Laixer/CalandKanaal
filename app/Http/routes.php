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
use App\Sensor;
use App\Measurement;

$app->get('/', function() {

	if (Auth::check())
		return view('dashboard');
	else
		return redirect('login');
});

$app->get('newmeasurement', function() {

	if (Auth::check())
        return view('newmeasurement');
    else
        return redirect('login');
});

$app->get('graph', function() {

	$list = Measurement::lists('recording_date', 'id');
	if (Auth::check())
        return view('graph')->with('list', $list);
    else
        return redirect('login');
});

$app->get('table', function() {

	$list = Measurement::lists('recording_date', 'id');
	if (Auth::check())
        return view('table')->with('list', $list);
    else
        return redirect('login');
});

$app->get('table/active_sensors/{id}', function($id) {

	$arr = array();
	$list = Measurement::find($id);
	if ($list->vecwsm_1) array_push($arr, 'vecwsm_1');
	if ($list->vecwsm_2) array_push($arr, 'vecwsm_2');
	if ($list->vecwsm_3) array_push($arr, 'vecwsm_3');
	if ($list->vecwsm_4) array_push($arr, 'vecwsm_4');
	if ($list->vecwsm_5) array_push($arr, 'vecwsm_5');
	if ($list->vecwsm_6) array_push($arr, 'vecwsm_6');
	if ($list->vecwsm_7) array_push($arr, 'vecwsm_7');
	if ($list->vecwsm_8) array_push($arr, 'vecwsm_8');
	if ($list->vecwsm_9) array_push($arr, 'vecwsm_9');
	if ($list->vecwsm_10) array_push($arr, 'vecwsm_10');
	if ($list->vecwsm_11) array_push($arr, 'vecwsm_11');
	if ($list->vecwsm_12) array_push($arr, 'vecwsm_12');
	if ($list->vecwsm_13) array_push($arr, 'vecwsm_13');
	if ($list->vecwsm_14) array_push($arr, 'vecwsm_14');
	if ($list->vecwsm_15) array_push($arr, 'vecwsm_15');
	if ($list->vecwsm_16) array_push($arr, 'vecwsm_16');

	if (Auth::check())
        return response()->json($arr);
    else
        return response()->json(array('error' => 1));
});

$app->get('table/sensors/{id}/{sensor}', function($id, $sensor) {
	$tarr = array();

	$name = explode('_', $sensor);

	$sensname_1 = 'VecWSM '.$name[1].'/0';
	$sensname_2 = 'VecWSM '.$name[1].'/1';

	$columns = array(
	array("sTitle" => "Measurement Time", "aTargets" => 0),
	array("sTitle" => $sensname_1, "aTargets" => 1),
	array("sTitle" => $sensname_2, "aTargets" => 2)
	);

	$rows = Sensor::where('measurement_id','=',$id)->get();
	foreach($rows as $row) {
		$arr = array($row->measurement_time, $row->{'val_'.$name[1].'_0'}, $row->{'val_'.$name[1].'_1'});
		array_push($tarr, $arr);
	}
	return response()->json(array("columns" => $columns, "data"=> $tarr));
});

$app->get('graph/active_sensors/{id}', function($id) {

	$arr = array();
	$list = Measurement::find($id);
	if ($list->vecwsm_1) array_push($arr, 'vecwsm_1');
	if ($list->vecwsm_2) array_push($arr, 'vecwsm_2');
	if ($list->vecwsm_3) array_push($arr, 'vecwsm_3');
	if ($list->vecwsm_4) array_push($arr, 'vecwsm_4');
	if ($list->vecwsm_5) array_push($arr, 'vecwsm_5');
	if ($list->vecwsm_6) array_push($arr, 'vecwsm_6');
	if ($list->vecwsm_7) array_push($arr, 'vecwsm_7');
	if ($list->vecwsm_8) array_push($arr, 'vecwsm_8');
	if ($list->vecwsm_9) array_push($arr, 'vecwsm_9');
	if ($list->vecwsm_10) array_push($arr, 'vecwsm_10');
	if ($list->vecwsm_11) array_push($arr, 'vecwsm_11');
	if ($list->vecwsm_12) array_push($arr, 'vecwsm_12');
	if ($list->vecwsm_13) array_push($arr, 'vecwsm_13');
	if ($list->vecwsm_14) array_push($arr, 'vecwsm_14');
	if ($list->vecwsm_15) array_push($arr, 'vecwsm_15');
	if ($list->vecwsm_16) array_push($arr, 'vecwsm_16');

	$endtime = Sensor::where('measurement_id','=',$id)->orderBy('measurement_time', 'desc')->first()['measurement_time'];;
	if (Auth::check())
        return response()->json(array("begin" => strtotime($list->recording_date), "end" => strtotime($endtime), "message" => $list->message, "data" => $arr));
    else
        return response()->json(array('error' => 1));
});

$app->get('graph/sensors/{id}/{sensor}', function($id, $sensor) {
    $tarr = array();

    $name = explode('_', $sensor);

    $sensname_1 = 'VecWSM '.$name[1].'/0';
    $sensname_2 = 'VecWSM '.$name[1].'/1';

    $columns = array(
	    array("sTitle" => "Measurement Time", "aTargets" => 0),
	    array("sTitle" => $sensname_1, "aTargets" => 1),
	    array("sTitle" => $sensname_2, "aTargets" => 2)
    );

    $rows = Sensor::where('measurement_id','=',$id)->get();
    foreach ($rows as $row) {
        $arr = array(strtotime($row->measurement_time), $row->{'val_'.$name[1].'_0'}, $row->{'val_'.$name[1].'_1'});
        array_push($tarr, $arr);
    }
    return response()->json(array("columns" => $columns, "data"=> $tarr));
});

$app->get('logout', function() {

	Auth::logout();
	return redirect('login');

});

$app->post('newmeasurement', 'App\Http\Controllers\ParserController@doNewmeasurement');

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
