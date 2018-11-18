<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}
	public function index()
	{
		$this->topNav = "templates/top_nav";
		$this->template = "3columncontent";
		$this->title = "TempVariable| free online generating json,sql,CSV,Excel file";
		$this->hasRightContent = True;
		$this->rightContent = "home/right_content";
		$this->load->helper('url');
		array_push($this->javascript,"addnewfield.js");
		$meta = array(
			"keyword"=>"online, test data generator, random data generator, csv generator,free, json generator, test data, mock data, generate test data, software testing, convert from excel to sql, excel to csv, excel to json",
			"description" => "TempVariable - A free online tool which is useful to generate sample data for testing in the form of json,excel,sql,txt,CSV, fixed width charecter file and many more, conversion from different type to different type"
			);
		$this->meta = $meta;
		$this->_render('home/home');
	}

	public function upload() {
		$this->load->model('convertormodel');
		$config['upload_path'] = 'resources/uploads';
		$config['allowed_types'] = 'xls|xlsx|csv|text/plain|json';
		$config['max_size']	= '100';
		$conversionType = $this->input->post('ctype');
		$format = "";
		$fileName = "";
		$cFileName = "";//Converted file name
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			$this->load->view("templates/upload_error",$error);
		}
		else
		{
		$data = $this->upload->data();
		$format = $data['file_ext'];
		$fileName = $data['file_name'];
		switch ($format) {
			case '.xlsx':
			    $cFileName = $this->convertormodel->readExcel($fileName,'excel7',$conversionType);
			   
				break;
			case '.csv':
				 $cFileName = $this->convertormodel->readCSV($fileName,$conversionType);
				 
			    break;
			case'.xls':
				 $cFileName = $this->convertormodel->readExcel($fileName,'excel3',$conversionType);
				 
				break;
			case'.json':
				 $cFileName = $this->convertormodel->readJson($fileName,$conversionType,true);
				 
				break;
		}
		/*$this->data['script'] = 'ifrm = document.createElement("IFRAME");'+
				         'ifrm.setAttribute("src", _baseUrl+"downloader/download?sfilename='+$cFileName+'&dfilename=tempvariable."+ext);'+
				         'ifrm.style.width = 1 + "px";'+
				         'ifrm.style.height = 1 + "px";'+
				         'document.body.appendChild(ifrm);'+
				         'setTimeout(function () { '+
				         '	document.body.removeChild(ifrm);'+
				         '}, 2000);';
		print_r($cFileName);*/
		//$fileName = $this->input->get("sfilename");
		//$dfileName = $this->input->get("dfilename");
		$ext = pathinfo($cFileName, PATHINFO_EXTENSION);
		header("Pragma: public");
		header("Expires: 0"); 
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Content-Type:".mime_content_type($cFileName));
		header("Content-Disposition: attachment;filename=\"tempvariable.".ltrim($ext)."\""); 
		readfile(ltrim($cFileName));

		}
	}
	public function uptest() {
		$this->topNav = "templates/top_nav";
		$this->template = "3columncontent";
		$this->title = "TempVariable| online free convertor";
		$this->hasRightContent = True;
		$this->rightContent = "home/right_content";
		$this->load->helper('url');
		array_push($this->javascript,"addnewfield.js");
		$meta = array(
			"keyword"=>"online, free convertor, export, excel to CSV, csv to excel,json to excel, excel to json, json to csv, mock data, generate test data, software testing",
			"description" => "TempVariable|Online free convertor tool - A free online tool to convert many type of row column data format file to many type"
			);
		$this->meta = $meta;
			$this->_render('upload/upload');
		}


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */