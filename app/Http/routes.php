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
use App\User;
use Maatwebsite\Excel\Facades\Excel;

$app->get('/', function() {

	$users = User::count();
	$measurements = Measurement::count();
	$sensors = Sensor::count();
	if (Auth::check())
		return view('home')->with('users', $users)->with('measurements', $measurements)->with('sensors', $sensors);
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

	$list = Measurement::all();
	if (Auth::check())
        return view('graph')->with('list', $list);
    else
        return redirect('login');
});

$app->get('table', function() {

	$list = Measurement::all();
	if (Auth::check())
        return view('table')->with('list', $list);
    else
        return redirect('login');
});

$app->get('user', function() {

	$users = User::all();
	if (Auth::check())
		return view('user')->with('users', $users);
	else
		return redirect('login');

});

$app->get('newuser', function() {

	if (Auth::check())
		return view('newuser');
	else
		return redirect('login');

});

$app->get('profile', function() {

	if (Auth::check())
		return view('profile');
	else
		return redirect('login');

});

$app->get('measurement', function() {

	$measurements = Measurement::all();
	if (Auth::check())
		return view('measurement')->with('measurements', $measurements);
	else
		return redirect('login');

});

$app->post('user/delete', 'App\Http\Controllers\UserController@doDelete');

$app->post('user/disable', 'App\Http\Controllers\UserController@doDisable');

$app->post('user/enable', 'App\Http\Controllers\UserController@doEnable');

$app->post('user/resetpassword', 'App\Http\Controllers\UserController@doResetPassword');

$app->post('measurement/delete', 'App\Http\Controllers\MeasurementController@doDelete');

$app->get('table/active_sensors/{id}', function($id) {

	$arr = array();
	$list = Measurement::find($id);
	if ($list->vecwsm_1) array_push($arr, array('VecWSM 1', $list->vecwsm_1_name, 1));
	if ($list->vecwsm_2) array_push($arr, array('VecWSM 2', $list->vecwsm_2_name, 2));
	if ($list->vecwsm_3) array_push($arr, array('VecWSM 3', $list->vecwsm_3_name, 3));
	if ($list->vecwsm_4) array_push($arr, array('VecWSM 4', $list->vecwsm_4_name, 4));
	if ($list->vecwsm_5) array_push($arr, array('VecWSM 5', $list->vecwsm_5_name, 5));
	if ($list->vecwsm_6) array_push($arr, array('VecWSM 6', $list->vecwsm_6_name, 6));
	if ($list->vecwsm_7) array_push($arr, array('VecWSM 7', $list->vecwsm_7_name, 7));
	if ($list->vecwsm_8) array_push($arr, array('VecWSM 8', $list->vecwsm_8_name, 8));
	if ($list->vecwsm_9) array_push($arr, array('VecWSM 9', $list->vecwsm_9_name, 9));
	if ($list->vecwsm_10) array_push($arr, array('VecWSM 10', $list->vecwsm_10_name, 10));
	if ($list->vecwsm_11) array_push($arr, array('VecWSM 11', $list->vecwsm_11_name, 11));
	if ($list->vecwsm_12) array_push($arr, array('VecWSM 12', $list->vecwsm_12_name, 12));
	if ($list->vecwsm_13) array_push($arr, array('VecWSM 13', $list->vecwsm_13_name, 13));
	if ($list->vecwsm_14) array_push($arr, array('VecWSM 14', $list->vecwsm_14_name, 14));
	if ($list->vecwsm_15) array_push($arr, array('VecWSM 15', $list->vecwsm_15_name, 15));
	if ($list->vecwsm_16) array_push($arr, array('VecWSM 16', $list->vecwsm_16_name, 16));

	if (Auth::check())
        return response()->json($arr);
    else
        return response()->json(array('error' => 1));
});

$app->get('table/sensors/{id}/{sensor}', function($id, $sensor) {
	$tarr = array();

	$sensname_1 = 'VecWSM '.$sensor.'/0';
	$sensname_2 = 'VecWSM '.$sensor.'/1';

	$columns = array(
		array("sTitle" => "Measurement Time", "aTargets" => 0),
		array("sTitle" => $sensname_1, "aTargets" => 1),
		array("sTitle" => $sensname_2, "aTargets" => 2)
	);

	$rows = Sensor::where('measurement_id','=',$id)->get();
	foreach($rows as $row) {
		$arr = array($row->measurement_time, $row->{'val_'.$sensor.'_0'}, $row->{'val_'.$sensor.'_1'});
		array_push($tarr, $arr);
	}
	return response()->json(array("columns" => $columns, "data"=> $tarr));
});

$app->get('table/exportcsv/{id}', function($id) {
    $table = Sensor::where('measurement_id','=',$id)->get();
    $filename = "../storage/export.csv";
    $handle = fopen($filename, 'w+');
    fputcsv($handle, array(
		'Measurement time',
		'vecwsm 1/0',
		'vecwsm 1/1',
		'vecwsm 2/0',
		'vecwsm 2/1',
		'vecwsm 3/0',
		'vecwsm 3/1',
		'vecwsm 4/0',
		'vecwsm 4/1',
		'vecwsm 5/0',
		'vecwsm 5/1',
		'vecwsm 6/0',
		'vecwsm 6/1',
		'vecwsm 7/0',
		'vecwsm 7/1',
		'vecwsm 8/0',
		'vecwsm 8/1',
		'vecwsm 9/0',
		'vecwsm 9/1',
		'vecwsm 10/0',
		'vecwsm 10/1',
		'vecwsm 11/0',
		'vecwsm 11/1',
		'vecwsm 12/0',
		'vecwsm 12/1',
		'vecwsm 13/0',
		'vecwsm 13/1',
		'vecwsm 14/0',
		'vecwsm 14/1',
		'vecwsm 15/0',
		'vecwsm 15/1',
		'vecwsm 16/0',
		'vecwsm 16/1'
	));

    foreach($table as $row) {
        fputcsv($handle, array(
			$row['measurement_time'],
			$row['val_1_0'],
			$row['val_1_1'],
			$row['val_2_0'],
			$row['val_2_1'],
			$row['val_3_0'],
			$row['val_3_1'],
			$row['val_4_0'],
			$row['val_4_1'],
			$row['val_5_0'],
			$row['val_5_1'],
			$row['val_6_0'],
			$row['val_6_1'],
			$row['val_7_0'],
			$row['val_7_1'],
			$row['val_8_0'],
			$row['val_8_1'],
			$row['val_9_0'],
			$row['val_9_1'],
			$row['val_10_0'],
			$row['val_10_1'],
			$row['val_11_0'],
			$row['val_11_1'],
			$row['val_12_0'],
			$row['val_12_1'],
			$row['val_13_0'],
			$row['val_13_1'],
			$row['val_14_0'],
			$row['val_14_1'],
			$row['val_15_0'],
			$row['val_15_1'],
			$row['val_16_0'],
			$row['val_16_1']
		));
    }

    fclose($handle);

    $headers = array(
        'Content-Type' => 'text/csv',
    );

    header('Content-Description: File Transfer');
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename='.basename($filename));
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filename));

	readfile($filename);
	unlink($filename);
	exit();
});

$app->get('table/exportasc/{id}', function($id) {
    $rec = Measurement::find($id);

    $headers = array(
        'Content-Type' => 'text/plain',
    );

	$filename = $rec->ascloc;
    header('Content-Description: File Transfer');
    header('Content-Type: text/plain');
    header('Content-Disposition: attachment; filename='.basename($filename));
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filename));

    readfile($filename);
    exit();
});

$app->get('graph/active_sensors/{id}', function($id) {

	$arr = array();
	$list = Measurement::find($id);
    if ($list->vecwsm_1) array_push($arr, array('VecWSM 1', $list->vecwsm_1_name, 1));
    if ($list->vecwsm_2) array_push($arr, array('VecWSM 2', $list->vecwsm_2_name, 2));
    if ($list->vecwsm_3) array_push($arr, array('VecWSM 3', $list->vecwsm_3_name, 3));
    if ($list->vecwsm_4) array_push($arr, array('VecWSM 4', $list->vecwsm_4_name, 4));
    if ($list->vecwsm_5) array_push($arr, array('VecWSM 5', $list->vecwsm_5_name, 5));
    if ($list->vecwsm_6) array_push($arr, array('VecWSM 6', $list->vecwsm_6_name, 6));
    if ($list->vecwsm_7) array_push($arr, array('VecWSM 7', $list->vecwsm_7_name, 7));
    if ($list->vecwsm_8) array_push($arr, array('VecWSM 8', $list->vecwsm_8_name, 8));
    if ($list->vecwsm_9) array_push($arr, array('VecWSM 9', $list->vecwsm_9_name, 9));
    if ($list->vecwsm_10) array_push($arr, array('VecWSM 10', $list->vecwsm_10_name, 10));
    if ($list->vecwsm_11) array_push($arr, array('VecWSM 11', $list->vecwsm_11_name, 11));
    if ($list->vecwsm_12) array_push($arr, array('VecWSM 12', $list->vecwsm_12_name, 12));
    if ($list->vecwsm_13) array_push($arr, array('VecWSM 13', $list->vecwsm_13_name, 13));
    if ($list->vecwsm_14) array_push($arr, array('VecWSM 14', $list->vecwsm_14_name, 14));
    if ($list->vecwsm_15) array_push($arr, array('VecWSM 15', $list->vecwsm_15_name, 15));
    if ($list->vecwsm_16) array_push($arr, array('VecWSM 16', $list->vecwsm_16_name, 16));

	$endtime = Sensor::where('measurement_id','=',$id)->orderBy('measurement_time', 'desc')->first()['measurement_time'];;
	if (Auth::check())
        return response()->json(array("begin" => strtotime($list->recording_date), "end" => strtotime($endtime), "message" => $list->message, "data" => $arr));
    else
        return response()->json(array('error' => 1));
});

$app->get('graph/sensors/{id}/{sensor}', function($id, $sensor) {
    $tarr = array();

    $sensname_1 = 'VecWSM '.$sensor.'/0';
    $sensname_2 = 'VecWSM '.$sensor.'/1';

    $columns = array(
	    array("sTitle" => "Measurement Time", "aTargets" => 0),
	    array("sTitle" => $sensname_1, "aTargets" => 1),
	    array("sTitle" => $sensname_2, "aTargets" => 2)
    );

    $rows = Sensor::where('measurement_id','=',$id)->get();
    foreach ($rows as $row) {
        $arr = array(strtotime($row->measurement_time), $row->{'val_'.$sensor.'_0'}, $row->{'val_'.$sensor.'_1'});
        array_push($tarr, $arr);
    }
    return response()->json(array("columns" => $columns, "data"=> $tarr));
});

$app->get('logout', function() {

	Auth::logout();
	return redirect('login');

});

$app->post('newmeasurement', 'App\Http\Controllers\ParserController@doNewmeasurement');

$app->post('graph', 'App\Http\Controllers\ParserController@doUpdateMessage');

$app->post('newuser', 'App\Http\Controllers\UserController@doNew');

$app->post('profile', 'App\Http\Controllers\UserController@doNewPassword');

$app->get('/login', function() {
    return view('login');
});

$app->post('login', function(Request $request) {

	if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'active' => 1])) {

		Auth::user()->last_login = date("Y-m-d H:i:s");
		Auth::user()->save();

		return response()->json(array('error' => 0, 'location' => '/'));
    } else {
		return response()->json(array('error' => 1));
	}

});
