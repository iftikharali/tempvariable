<?php
class Convertormodel extends CI_Model {
    protected $tableName = False;
    public function __construct()
    {
        parent::__construct();
    }


    public function setTableName($tableName) {
    	$this->tableName = $tableName;
    }
	public function readExcel($fileName,$fileType,$conversionType,$headerExists=False) {
		 $sourceFile = "resources/uploads/".$fileName;
		 $destinationFile = "resources/reports/".$fileName;
		$this->load->library('PHPExcel.php');

		// Create new PHPExcel object
		//$objPHPExcel = new PHPExcel();
		//$echo $file_name_with_complete_path;
		$objPHPExcel = PHPExcel_IOFactory::load($sourceFile);//The path and the file name is taking temporarily.
		$array_excel = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
		$fileData = array_values($array_excel);
		//$this->getValidatedData($fileData);
		switch ($conversionType) {
			case '1':
				# code...
				$destinationFile = $this->convertToSQL($fileData,$headerExists);
				break;
			case '2':
		$destinationFile = $this->convertToJson($fileData,$headerExists);
				# code...
				break;
			case '3':
				# code...
				$destinationFile = $this->convertToExcel($fileData,$headerExists);
				break;
			case '4':
		$destinationFile = $this->convertToCSV($fileData,$headerExists);
				break;
			
		}

		return $destinationFile;

	}
	
	/*public function getValidatedData($fileData) {
		$header = array_values($data[0]);
		$tempData = Array();
		$indexes = Array();
		for($index = 1; $index<count($header); $index++) {
			if($header[$index]==null || $header[$index]=="") {
				$indexes[] = $index;
			}
		}
		if(count($indexes) == 0) {
			return false;
		}
		foreach($data as $row) {
			$tempRow = Array();
			foreach($row as $column) {
				$tempRow[] = $column

			}
		}
	}*/
	public function readCSV($fileName,$conversionType,$headerExists=False) {
		 $sourceFile = "resources/uploads/".$fileName;
		 $destinationFile = "";
		 $file = fopen($sourceFile,"r");
		 $fileData = array();
		while(! feof($file))
		  {
			  $fileData[] = fgetcsv($file);
		  }
			fclose($file);
		switch ($conversionType) {
			case '1':
				# code...
				$destinationFile = $this->convertToSQL($fileData,$headerExists);
				break;
			case '2':
		$destinationFile = $this->convertToJson($fileData,$headerExists);
				# code...
				break;
			case '3':
				# code...
				$destinationFile = $this->convertToExcel($fileData,$headerExists);
				break;
			case '4':
		$destinationFile = $this->convertToCSV($fileData,$headerExists);
				break;
			
		}
		return $destinationFile;
	}

	public function readJson($fileName,$conversionType,$headerExists=False) {
		 $sourceFile = "resources/uploads/".$fileName;
		 $destinationFile = "";
		 $file = fopen($sourceFile,"r");
		 $contents = file_get_contents($sourceFile); 
		 $contents = utf8_encode($contents); 
		 $fileData = json_decode($contents,true);
		 if($headerExists) {
		 	$tempHeader = array_keys($fileData[0]);
		 	$fileData = array_merge(array($tempHeader),$fileData);
		 }
		switch ($conversionType) {
			case '1':
				# code...
				$destinationFile = $this->convertToSQL($fileData,$headerExists);
				break;
			case '2':
				$destinationFile = $this->convertToJson($fileData,$headerExists);
				# code...
				break;
			case '3':
				# code...
				$destinationFile = $this->convertToExcel($fileData,$headerExists);
				break;
			case '4':
				$destinationFile = $this->convertToCSV($fileData,$headerExists);
				break;
			
		}
		return $destinationFile;

	}


		
	public function convertToSQL($data,$headerExists=False) {
		$tableName="TempVariable";
		if($this->tableName) {
			$tableName = $this->tableName;
		}
		$output = "";
		$header = array();
		$queries = "insert into ".$tableName." (";
		if($headerExists) {
			$header = array_values($data[0]);
		} else {
			for($columnCount=0;$columnCount<count($data[0]);$columnCount++) {
				$header[] = "field".$columnCount;
			}
		}
		$rowIndex = 0;
		foreach($data as $row) {
			if($headerExists&&$rowIndex==0) {
				$rowIndex++;
				continue;
			}

			$columnNames="";
			$values="";
			$cellIndex = 0;
			if($row) {
			foreach($row as $cell) {
				$columnNames.="`".$header[$cellIndex]."`".",";
				$values .= "'".str_replace("'", "''", $cell)."',";
				$cellIndex++;
			}
			$columnNames = rtrim($columnNames,",");
			$values = rtrim($values,",");
			$output.=$queries.$columnNames.") values (".$values.");\n";
		}
		$rowIndex++;
		}
		$fp = fopen("resources/reports/myConvertedSQL.sql","wb");
		fwrite($fp,$output);
		fclose($fp);
	    return "resources/reports/myConvertedSQL.sql";
	}

	public function convertToJson($data,$headerExists=False) {
		$output = array();
		$header = array_values($data[0]);
		$rowIndex = 0;
		foreach($data as $row) {
			if($headerExists&&$rowIndex==0) {
				$rowIndex++;
				continue;
			}
			$cellIndex = 0;
			$outputRow = array();
			if($row) {
			foreach($row as $cell) {
				if($headerExists) {
					$outputRow[$header[$cellIndex]] = $cell;
				} else {
					$outputRow[] = $cell;
				}
				$cellIndex++;
			}
			$output[] = $outputRow;
			$rowIndex++;
		}
		}
		$fp = fopen("resources/reports/myConvertedJSON.json","wb");
		fwrite($fp,json_encode($output));
		fclose($fp);
	    return "resources/reports/myConvertedJSON.json";
	}

	public function convertToCSV($data,$headerExists=False) {
		$fp = fopen("resources/reports/myConvertedCSV.csv","wb");
		//print_r($fileData);
		$output = array();
		if($headerExists) {
			$header = $data[0];
			fputcsv($fp,$header);
		}
		$rowIndex = 0;
		foreach($data as $row) {
			if($headerExists&&$rowIndex==0) {
				$rowIndex++;
				continue;
			}
			$cellIndex = 0;
			$outputRow = array();
			if($row) {
			foreach($row as $cell) {
				$outputRow[] = $cell;
				$cellIndex++;
			}
			fputcsv($fp,$outputRow);
			$rowIndex++;
		}
		}
		fclose($fp);
		return 'resources/reports/myConvertedCSV.csv';
	}

	public function convertToExcel($data,$headerExists=False) {
		$output = array();
		$header = array_values($data[0]);

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

		$rowIndex = 1;
		foreach($data as $row) {
			if($headerExists&&$rowIndex==0) {
				$rowIndex++;
				continue;
			}
			$cellIndex = 'A';
			$outputRow = array();
			if($row) {
			foreach($row as $cell) {
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellIndex.$rowIndex, $cell);
				$cellIndex++;
			}
			$rowIndex++;
		}
		}



		
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


		$objWriter->save('resources/reports/myConvertedExcel.xlsx');
	    return "resources/reports/myConvertedExcel.xlsx";
	}
}