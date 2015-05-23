<?php

namespace App\Http\Controllers;

use App\Measurement;
use App\Sensor;
use App\ASCParser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\Filesystem\Factory;

class ParserController extends Controller{

	private $uploaddir = '../storage/';

	private function numconv($denot) {
		return floatval(str_replace(',', '.', str_replace('.', '', $denot)));
	}

	public function doNewmeasurement(Request $request) {

		$newname = 'upload-'.time().'.asc';
		$newloc = $this->uploaddir.$newname;
		if ($request->hasFile('ascfile')) {
			$request->file('ascfile')->move($this->uploaddir, $newname);
		} else {
			return redirect()->back()->with('error', 'No ASC file uploaded');
		}

		$parser = new ASCParser($newloc);

		$measurement = new Measurement;
		$measurement->recording_date = date("Y-m-d H:i:s", $parser->getRecordDate());
		$measurement->message = $request->input('message');
		$measurement->name = $request->input('name');
		$measurement->ascloc = $newloc;

		if ($request->input('val_1') != 'on') $measurement->vecwsm_1 = false;
		if ($request->input('val_2') != 'on') $measurement->vecwsm_2 = false;
		if ($request->input('val_3') != 'on') $measurement->vecwsm_3 = false;
		if ($request->input('val_4') != 'on') $measurement->vecwsm_4 = false;
		if ($request->input('val_5') != 'on') $measurement->vecwsm_5 = false;
		if ($request->input('val_6') != 'on') $measurement->vecwsm_6 = false;
		if ($request->input('val_7') != 'on') $measurement->vecwsm_7 = false;
		if ($request->input('val_8') != 'on') $measurement->vecwsm_8 = false;
		if ($request->input('val_9') != 'on') $measurement->vecwsm_9 = false;
		if ($request->input('val_10') != 'on') $measurement->vecwsm_10 = false;
		if ($request->input('val_11') != 'on') $measurement->vecwsm_11 = false;
		if ($request->input('val_12') != 'on') $measurement->vecwsm_12 = false;
		if ($request->input('val_13') != 'on') $measurement->vecwsm_13 = false;
		if ($request->input('val_14') != 'on') $measurement->vecwsm_14 = false;
		if ($request->input('val_15') != 'on') $measurement->vecwsm_15 = false;
		if ($request->input('val_16') != 'on') $measurement->vecwsm_16 = false;

		$measurement->vecwsm_1_name = $request->input('val_1_name');
		$measurement->vecwsm_2_name = $request->input('val_2_name');
		$measurement->vecwsm_3_name = $request->input('val_3_name');
		$measurement->vecwsm_4_name = $request->input('val_4_name');
		$measurement->vecwsm_5_name = $request->input('val_5_name');
		$measurement->vecwsm_6_name = $request->input('val_6_name');
		$measurement->vecwsm_7_name = $request->input('val_7_name');
		$measurement->vecwsm_8_name = $request->input('val_8_name');
		$measurement->vecwsm_9_name = $request->input('val_9_name');
		$measurement->vecwsm_10_name = $request->input('val_10_name');
		$measurement->vecwsm_11_name = $request->input('val_11_name');
		$measurement->vecwsm_12_name = $request->input('val_12_name');
		$measurement->vecwsm_13_name = $request->input('val_13_name');
		$measurement->vecwsm_14_name = $request->input('val_14_name');
		$measurement->vecwsm_15_name = $request->input('val_15_name');
		$measurement->vecwsm_16_name = $request->input('val_16_name');

		$measurement->save();

		foreach($parser->getAllRows() as $row) {
            $sensor = new Sensor;
            $sensor->measurement_time = date("Y-m-d H:i:s", $row[0]);
            $sensor->measurement_id = $measurement->id;
            $sensor->val_1_0 = $this->numconv($row[1]);
            $sensor->val_1_1 = $this->numconv($row[2]);
            $sensor->val_2_0 = $this->numconv($row[3]);
            $sensor->val_2_1 = $this->numconv($row[4]);
            $sensor->val_3_0 = $this->numconv($row[5]);
            $sensor->val_3_1 = $this->numconv($row[6]);
            $sensor->val_4_0 = $this->numconv($row[7]);
            $sensor->val_4_1 = $this->numconv($row[8]);
            $sensor->val_5_0 = $this->numconv($row[9]);
            $sensor->val_5_1 = $this->numconv($row[10]);
            $sensor->val_6_0 = $this->numconv($row[11]);
            $sensor->val_6_1 = $this->numconv($row[12]);
            $sensor->val_7_0 = $this->numconv($row[13]);
            $sensor->val_7_1 = $this->numconv($row[14]);
            $sensor->val_8_0 = $this->numconv($row[15]);
            $sensor->val_8_1 = $this->numconv($row[16]);
            $sensor->val_9_0 = $this->numconv($row[17]);
            $sensor->val_9_1 = $this->numconv($row[18]);
            $sensor->val_10_0 = $this->numconv($row[19]);
            $sensor->val_10_1 = $this->numconv($row[20]);
            $sensor->val_11_0 = $this->numconv($row[21]);
            $sensor->val_11_1 = $this->numconv($row[22]);
            $sensor->val_12_0 = $this->numconv($row[23]);
            $sensor->val_12_1 = $this->numconv($row[24]);
            $sensor->val_13_0 = $this->numconv($row[25]);
            $sensor->val_13_1 = $this->numconv($row[26]);
            $sensor->val_14_0 = $this->numconv($row[27]);
            $sensor->val_14_1 = $this->numconv($row[28]);
            $sensor->val_15_0 = $this->numconv($row[29]);
            $sensor->val_15_1 = $this->numconv($row[30]);
            $sensor->val_16_0 = $this->numconv($row[31]);
            $sensor->val_16_1 = $this->numconv($row[32]);
            $sensor->save();
        }

		return redirect()->back()->with('success', 'File is uploaded and parsed');
	}

	public function doUpdateMessage(Request $request) {

		$measurement = Measurement::find($request->input('messid'));
		$measurement->message = $request->input('message');
		$measurement->save();

		return redirect()->back()->with('success', 'Message updated');
	}

	public function doSplit(Request $request) {

		$measurement = Measurement::find($request->input('messid'));
		$measurement->{'vecwsm_'.$request->input('sensorid').'_begin'} = date("Y-m-d H:i:s", ($request->input('begin')/1000));
		$measurement->{'vecwsm_'.$request->input('sensorid').'_end'} = date("Y-m-d H:i:s", ($request->input('end')/1000));
		$measurement->save();

		return response()->json(array('succes' => 1));
	}
}
