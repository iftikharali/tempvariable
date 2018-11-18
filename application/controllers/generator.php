<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Generator extends MY_Controller {


	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url','nav'));
	}

	public function index()
	{
		$this->topNav = "templates/top_nav";
		$this->pageName = "generator";
		$this->template = "3columncontent";
		$this->title = "TempVariable| free online generating json,sql,CSV,Excel file";
		$this->hasRightContent = True;
		$this->rightContent = "home/right_content";
		$this->load->helper('url');
		array_push($this->javascript,"addnewfield.js");
		$meta = array(
			"keyword"=>"online, test data generator,fake data, name, email, sample, dummy random data generator, csv generator,free, json generator, test data, mock data, generate test data, software testing, convert from excel to sql, excel to csv, excel to json,sample file",
			"description" => "TempVariable - A free online tool which is useful to generate sample data for testing in the form of json,excel,sql,txt,CSV, fixed width charecter file and many more."
			);
		$this->meta = $meta;
		$this->_render('home/home');
	}

	public function generate($type="csv") 
	{
		$this->load->model('generatormodel');
		$column = $this->input->get("column");
		$type = $this->input->get("type");
		$formats = $this->input->get("formats");
		$limit = $this->input->get("numrow");
		$udelifield = $this->input->get("udelifield");
		$tableNameField = $this->input->get("userTableName");
		if($udelifield =="") {
			$udelifield = ":";
		}
		if($tableNameField =="") {
			$tableNameField = "tempvariable";
		}
		$content = $this->generatormodel->getFile($column,$type,$formats,$udelifield,$tableNameField,$limit);

		print_r(json_encode($content));
	}

	public function generateEmail() {
		$randomData = array(
				"a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z",
				"0","1","2","3","4","5","6","7","8","9",
				".","_","@"
			);
		for($num=0;$num<1000;$num++) {
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
			$email.="@";
			$email.=substr($emailTail,0,rand(2,(strlen($emailTail)<13?strlen($emailTail):13)));
			$email.=".";
			$email.=substr($emailTail,strlen($emailTail)-rand(2,3),strlen($emailTail));
			echo $email;
			//echo ':'.strlen($emailTail)-rand(2,3).' : '.strlen($emailTail).' : '.$emailTail;
			echo '<br>';
		}

	}
	public function rand($num=10) {
		for($i=0;$i<$num;$i++) {
		echo (rand(7000,9999)).(rand(1000,9999)).(rand(10,99));
		echo '<br>';
	}
	}
}