<?php namespace App;

define("VALARRAYLEN", 34);

class ASCParser
{

	private $file;
	private $recdate;
	private $_eometa = false;
	private $_valline;

	function __construct($file) {
		$this->file = $file;
		$handle = fopen($file, "r");
		if ($handle) {
			$line = 0;
			while (($buffer = fgets($handle, 4096)) !== false) {

				/* Make sure at least the header exist */
				if ($line == 0) {
					if (strpos($buffer, 'DASYLab') === false) {
						break;
					}
				}

				/* Extract recording date */
				if (empty($this->recdate)) {
					$harr = explode(' : ', $buffer);
					if (trim($harr[0]) == "Recording date")
						$this->recdate = strtotime($harr[1]);
				}

				/* Mark the beginning of actual rows */
				if (!$this->_eometa) {
					if (strpos($buffer, 'Measurement time[hh:mm:ss];') !== false) {
						$this->_eometa = true;
						$this->_valline = ++$line;
						continue;
					}
				}
				$line++;
			}
			if (!feof($handle)) {
				echo "Error: unexpected fgets() fail\n";
			}
			fclose($handle);
		}
	}

	private function concattime($offset, $datetime) {
		$offset_time = strptime($offset, "%H:%M:%S");
        $offset_time['unparsed'] = round(ltrim($offset_time['unparsed'], ','), -3)/1000;
        return mktime(
			date("H", $datetime) + $offset_time['tm_hour'],
			date("i", $datetime) + $offset_time['tm_min'],
			date("s", $datetime) + $offset_time['tm_sec'] + $offset_time['unparsed'],
			date("n", $datetime),
			date("j", $datetime),
			date("Y", $datetime));
	}

	public function getRecordDate() {
		return $this->recdate;
	}

	public function getAllRows() {
		$arr = array();
		$handle = fopen($this->file, "r");
		if ($handle) {
			$line = 0;
			while (($buffer = fgets($handle, 4096)) !== false) {
				if ($line >= $this->_valline) {
					$barr = explode(';', $buffer);

					/* Must have 32 tracks */
					if (count($barr) == VALARRAYLEN) {
						$barr[0] = $this->concattime($barr[0], $this->recdate);
						array_push($arr, $barr);
					}
				}
				$line++;
			}
			if (!feof($handle)) {
				echo "Error: unexpected fgets() fail\n";
			}
			fclose($handle);
		}

		return $arr;
	}

}
