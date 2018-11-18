<?php
class Generatormodel extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }


	Public function getFile($columns,$type,$formats,$udeli,$tableName,$limit=100)
	{
		//$result = $this->db->query("select id,name from person_name limit 1000");
		$query = "select ";                   
		$column_type = array(
				"1"=>'serial_number',
				"2"=>'number',//rand(10,9999),
				"3"=>'name',
				"4"=>'name',
				"5"=>'name',
				"6"=>'name',
				"7"=>'name',
				"8"=>'name',
				"9"=>'name',
				"10"=>'date',//rand(10,9999),
				"11"=>'country',
				"12"=>'location',
				"13"=>'email',
				"14"=>'mobile'
			);
		$data = array();
		for($index=0;$index<count($columns);$index++) {
			switch ($column_type[$type[$index]]) {
				case 'serial_number':
					$data[$columns[$index]] = $this->getSerialNumber($columns[$index],$limit);
					break;
				case 'number':
					$data[$columns[$index]] = $this->getRandomNumber($columns[$index],$limit);
					break;
				case 'mobile':
					$data[$columns[$index]] = $this->getMobileNumber($columns[$index],$limit);
					break;
				case 'name':
				    $tables = "person_name as l";
				    $countQuery = $this->db->query("select count(*) as count from person_name");
				    $count = $countQuery->row();
				    $count = (int)$count->count;
				    if($count<$limit) {
				    	$tables .= ",person_name as p";
				    }
				    $query = $this->db->query("select l.name as `".$columns[$index]."` from ".$tables." order by rand() limit ".$limit);
					$data[$columns[$index]] = $query->result();
					break;
				case 'date':
					$data[$columns[$index]] = $this->getDate($columns[$index],$limit);
					break;
				case 'email':
					$data[$columns[$index]] = $this->getEmail($columns[$index],$limit);
					break;
				case 'country':
				    $tables = "location as l";
				    $countQuery = $this->db->query("select count(*) as count from location");
				    $count = $countQuery->row();
				    $count = (int)$count->count;
				    if($count<$limit) {
				    	$tables .= ",location as p";
				    }
				    $query = $this->db->query("select l.name as `".$columns[$index]."` from ".$tables." order by rand() limit ".$limit);
					$data[$columns[$index]] = $query->result();
					break;
				case 'location':
				    $tables = "location as l";
				    $countQuery = $this->db->query("select count(*) as count from location");
				    $count = $countQuery->row();
				    $count = (int)$count->count;
				    if($count<$limit) {
				    	$tables .= ",location as p";
				    }
					$query = $this->db->query("select lname as `".$columns[$index]."` from ".$tables." order by rand() limit ".$limit);
					$data[$columns[$index]] = $query->result();
					break;
			}
			
		}
		$files = Array();
		foreach ($formats as $format) {
			
			switch ($format) {
				case 'csv':
					array_push($files,$this->getCSV($data,$limit));
					break;
				case 'json':
				    array_push($files,$this->getJSON($data,$limit));
				    break;
				case 'sql':
				    array_push($files,$this->getSQL($data,$tableName,$limit));
				    break;
				case 'excel2003':
				    array_push($files,$this->getExcel3($data,$limit));
				    break;
				case 'excel2007':
				    array_push($files,$this->getExcel7($data,$limit));
				    break;
				case 'udeli':
				    array_push($files,$this->getUdeli($data,$udeli,$limit));
				    break;
			}
		}

		return $files;
		
		
    }

    private function getSerialNumber($columnName,$limit=100) {
    	$number = Array();
		$row = Array();
    	for($count=0;$count<=$limit;$count++) {
    		$row[$columnName] = $count+1;
    		$number[$count] = $row;
    	}
    	return $number;
    }
    private function getMobileNumber($columnName,$limit=100) {
    	$number = Array();
		$row = Array();
    	for($count=0;$count<=$limit;$count++) {
    		$row[$columnName] = (rand(7000,9999)).(rand(1000,9999)).(rand(10,99));
    		$number[$count] = $row;
    	}
    	return $number;
    }
	private function getRandomNumber($columnName,$limit=100) {
		$number = Array();
		$row = Array();
		for($count=0;$count<=$limit;$count++) {
			$row[$columnName] = rand(1000,9999);
    		$number[$count] = $row;
    	}
    	return $number;
    }
    private function getDate($columnName,$limit=100) {
    	$date = Array();
    	$row = Array();
		for($count=0;$count<=$limit;$count++) {
    		$row[$columnName] = date("Y-m-d",mt_rand(0000020000,1592055681));
    		$date[$count] = $row;
    	}
    	return $date;
    }

    public function getEmail($columnName,$limit=100) {
    	$emailData = array();

    	$randomData = array(
				"a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z",
				"0","1","2","3","4","5","6","7","8","9",
				".","_","@"
			);
		for($num=0;$num<$limit;$num++) {
			$row = Array();
			$emailBodyLength = rand(3,16);
			$email = $randomData[rand(0,25)];
			$emailTail = "";
			for($count=0;$count<$emailBodyLength;$count++) {
				$randomArrayIndex = rand(0,8);
				$randomChar = rand(0,25);
				$randomDigit = rand(26,35);
				$randomSymbol = rand(36,37);
				$emailTail .= $randomData[rand(0,25)];
				switch ($randomArrayIndex) {
					case 0:
						$email.=$randomData[$randomChar];
						break;
					case 1:
						$email.=$randomData[$randomDigit];
						break;
					case 2:
						$email.=$randomData[$randomSymbol];
						break;
					default:
					    $email.=$randomData[$randomChar];
						break;
				}
			}
			$email = preg_replace('/\.+/', '.', $email);
			$email = preg_replace('/_+/', '_', $email);
			$email.="@";
			$email.=substr($emailTail,0,rand(2,(strlen($emailTail)<13?strlen($emailTail):13)));
			$email.=".";
			$email.=substr($emailTail,strlen($emailTail)-rand(2,3),strlen($emailTail));
			$row[$columnName] = $email;
			$emailData[$num] = $row;
			
		}
		return $emailData;

    }
	
	public function getCSV($data,$limit=100) {
		$fp = fopen("resources/reports/myCSV.csv","wb");
		$keys = array_keys($data);
		$output = Array();
		fputcsv($fp,$keys);
		for($count=0;$count<$limit;$count++) {
			$row = array();
			foreach($keys as $key) {
				$row[$key] = (is_array($data[$key][$count]))?$data[$key][$count][$key]:$data[$key][$count]->{$key};
				
			}
		fputcsv($fp,$row);
		}
		fclose($fp);
	    return "resources/reports/myCSV.csv";
	}

	public function getUdeli($data,$deli=":",$limit=100) {
		$fp = fopen("resources/reports/myUdeli.txt","wb");
		$keys = array_keys($data);
		$output = "";
		foreach($keys as $key) {
			$output.=$key.$deli;
		}
		$output = rtrim($output,$deli);
		$output.="\r\n";
		for($count=0;$count<$limit;$count++) {
			foreach($keys as $key) {
				$output.= ((is_array($data[$key][$count]))?$data[$key][$count][$key]:$data[$key][$count]->{$key}).$deli;
			}
		
		$output = rtrim($output,$deli);
		$output.="\r\n";
		}

		fwrite($fp,$output);
		fclose($fp);
	    return "resources/reports/myUdeli.txt";
	}

	public function getJSON($data,$limit=100) {
		$fp = fopen("resources/reports/myJSON.json","wb");
		$keys = array_keys($data);
		$output = Array();
		for($count=0;$count<$limit;$count++) {
			$row = array();
			foreach($keys as $key) {
				$row[$key] = (is_array($data[$key][$count]))?$data[$key][$count][$key]:$data[$key][$count]->{$key};
				
			}
		array_push($output,$row);
		}
		fwrite($fp,json_encode($output));
		fclose($fp);
	    return "resources/reports/myJSON.json";
	}
	public function getSQL($data,$tableName,$limit=100) {
		$fp = fopen("resources/reports/mySQL.sql","wb");
		$keys = array_keys($data);
		$output = "";
		$queries = "insert into ".$tableName." (";
		for($count=0;$count<$limit;$count++) {
			$columnNames = "";
			$values = "";
			foreach($keys as $key) {
				$columnNames.="`".$key."`".",";
				$values .= (is_array($data[$key][$count]))?"'".str_replace("'", "''", $data[$key][$count][$key])."',":"'".str_replace("'", "''", $data[$key][$count]->{$key})."',";
				
			}
		$columnNames = rtrim($columnNames,",");
		$values = rtrim($values,",");
		$output.=$queries.$columnNames.") values (".$values.");\n";
		}
		fwrite($fp,$output);
		fclose($fp);
	    return "resources/reports/mySQL.sql";
	}
	public function getExcel3($data,$limit=100) {
		$this->excel($data,$limit);
	    return "resources/reports/myExcel.xlsx";
	}

	public function excel($data,$limit=100) {
		if (PHP_SAPI == 'cli')
			die('This example should only be run from a Web Browser');

		/** Include PHPExcel */
		$this->load->library('PHPExcel.php');


		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();

		// Set document properties
		$objPHPExcel->getProperties()->setCreator("TempVariable")
									 ->setLastModifiedBy("TempVariable")
									 ->setTitle("Office 2007 dummy data")
									 ->setSubject("Office 2007 dummy data")
									 ->setDescription("Test document for Office 2007 XLSX, generated using TempVariable.com.")
									 ->setKeywords("office 2007 openxml php")
									 ->setCategory("Sample excel file");


		// Add some data
		$keys = array_keys($data);
		
		$excel_data_from_server = $data;
		if(count($excel_data_from_server)>0) {
		   $header_column = array_keys((array)$data);
		}
		/*
		echo '<pre>';
		print_r($header_column);
		print_r($excel_data_from_server);
		echo '<pre>';
		
		/**Defining the variables for excel row and column index**/
		
		$excel_row = 1;
		$excel_column = "A";
		
		/**Creating the headers in the excel sheet that is first row **/
		foreach($header_column as $header) {
		    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($excel_column.$excel_row, $header);
			$excel_column++;
		}
		$excel_row++;
		/**Inserting the data in the excell sheet**/
		
		for($count=0;$count<$limit;$count++) { //iterating for row
		    
			$excel_column="A";
			foreach($keys as $key) { //iterating for columns for each row
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($excel_column.$excel_row, (is_array($data[$key][$count]))?$data[$key][$count][$key]:$data[$key][$count]->{$key});
				$excel_column++;
			}
			$excel_row++;
		}


		
		/*
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A1', 'Hello')
					->setCellValue('B2', 'world!')
					->setCellValue('C1', 'Hello')
					->setCellValue('D2', 'world!');

		// Miscellaneous glyphs, UTF-8
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A4', 'Miscellaneous glyphs')
					->setCellValue('A5', 'éàèùâêîôûëïüÿäöüç');
		*/
		
		
		// Rename worksheet
		$objPHPExcel->getActiveSheet()->setTitle('TempVariable');


		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);

/*
		// Redirect output to a client’s web browser (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="generatedExcel.xlsx"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0
*/
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		//$objWriter->save('php://output');
		/*
			$config = Array(
			  'protocol' => 'smtp',
			  'smtp_host' => 'ssl://smtp.googlemail.com',
			  'smtp_port' => 465,
			  'smtp_user' => 'iftikharali4@gmail.com', // change it to yours
			  'smtp_pass' => 'passwordwrong', // change it to yours
			  'mailtype' => 'html',
			  'charset' => 'iso-8859-1',
			  'wordwrap' => TRUE
			);

			$this->load->library('email', $config);
			$message = '';
			$this->email->set_newline("\r\n");
			$this->email->from('iftikharali4@gmail.com'); // change it to yours
			$this->email->to('iftikhar.ali@preranaconsulting.com');// change it to yours
			$this->email->subject('Resume from JobsBuddy for your Job posting');
			$this->email->message($message);
			$this->email->attach('D:/test/generatedExcel.xlsx');
			if($this->email->send())
			 {
			  echo 'Email sent.';
			 }
			 else
			{
			 show_error($this->email->print_debugger());
			}*/

		$objWriter->save('resources/reports/myExcel.xlsx');
		
	}


}


?> 