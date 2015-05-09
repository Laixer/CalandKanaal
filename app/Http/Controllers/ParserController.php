<?php

namespace App\Http\Controllers;

use App\Measurement;
use App\Sensor;
use App\ASCParser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\Filesystem\Factory;

class ParserController extends Controller{

	private function numconv($denot) {
		return floatval(str_replace(',', '.', str_replace('.', '', $denot)));
	}

	public function index(){
	}

	public function doNewmeasurement(Request $request) {

		$newname = 'upload-'.time().'.asc';
		if ($request->hasFile('ascfile')) {
			$request->file('ascfile')->move('../storage', $newname);
		} else {
			return redirect()->back()->with('error', 'No ASC file uploaded');
		}

		$parser = new ASCParser('../storage/'.$newname);

		$measurement = new Measurement;
        $measurement->recording_date = date("Y-m-d H:i:s", $parser->getRecordDate());
		$measurement->message = $request->input('message');

		if ($request->input('val_1_0') != 'on') $measurement->vecwsm_1_0 = false;
		if ($request->input('val_1_1') != 'on') $measurement->vecwsm_1_1 = false;
		if ($request->input('val_2_0') != 'on') $measurement->vecwsm_2_0 = false;
		if ($request->input('val_2_1') != 'on') $measurement->vecwsm_2_1 = false;
		if ($request->input('val_3_0') != 'on') $measurement->vecwsm_3_0 = false;
		if ($request->input('val_3_1') != 'on') $measurement->vecwsm_3_1 = false;
		if ($request->input('val_4_0') != 'on') $measurement->vecwsm_4_0 = false;
		if ($request->input('val_4_1') != 'on') $measurement->vecwsm_4_1 = false;
		if ($request->input('val_5_0') != 'on') $measurement->vecwsm_5_0 = false;
		if ($request->input('val_5_1') != 'on') $measurement->vecwsm_5_1 = false;
		if ($request->input('val_6_0') != 'on') $measurement->vecwsm_6_0 = false;
		if ($request->input('val_6_1') != 'on') $measurement->vecwsm_6_1 = false;
		if ($request->input('val_7_0') != 'on') $measurement->vecwsm_7_0 = false;
		if ($request->input('val_7_1') != 'on') $measurement->vecwsm_7_1 = false;
		if ($request->input('val_8_0') != 'on') $measurement->vecwsm_8_0 = false;
		if ($request->input('val_8_1') != 'on') $measurement->vecwsm_8_1 = false;
		if ($request->input('val_9_0') != 'on') $measurement->vecwsm_9_0 = false;
		if ($request->input('val_9_1') != 'on') $measurement->vecwsm_9_1 = false;
		if ($request->input('val_10_0') != 'on') $measurement->vecwsm_10_0 = false;
		if ($request->input('val_10_1') != 'on') $measurement->vecwsm_10_1 = false;
		if ($request->input('val_11_0') != 'on') $measurement->vecwsm_11_0 = false;
		if ($request->input('val_11_1') != 'on') $measurement->vecwsm_11_1 = false;
		if ($request->input('val_12_0') != 'on') $measurement->vecwsm_12_0 = false;
		if ($request->input('val_12_1') != 'on') $measurement->vecwsm_12_1 = false;
		if ($request->input('val_13_0') != 'on') $measurement->vecwsm_13_0 = false;
		if ($request->input('val_13_1') != 'on') $measurement->vecwsm_13_1 = false;
		if ($request->input('val_14_0') != 'on') $measurement->vecwsm_14_0 = false;
		if ($request->input('val_14_1') != 'on') $measurement->vecwsm_14_1 = false;
		if ($request->input('val_15_0') != 'on') $measurement->vecwsm_15_0 = false;
		if ($request->input('val_15_1') != 'on') $measurement->vecwsm_15_1 = false;
		if ($request->input('val_16_0') != 'on') $measurement->vecwsm_16_0 = false;
		if ($request->input('val_16_1') != 'on') $measurement->vecwsm_16_1 = false;

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

		return view('newmeasurement');
	}

}
