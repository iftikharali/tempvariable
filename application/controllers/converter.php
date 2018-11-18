<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Converter extends MY_Controller {


	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url','nav'));
		$this->load->model('convertormodel');
	}

	public function index() {
		$this->topNav = "templates/top_nav";
		$this->pageName = "converter";
		$this->template = "3columncontent";
		$this->title = "TempVariable| online free convertor for json,excel,sql,csv,user defined delimeter";
		$this->hasRightContent = True;
		$this->rightContent = "convert/right_content";
		$this->load->helper('url');
		$this->load->helper('nav');
		array_push($this->javascript,"addnewfield.js");
		$meta = array(
			"keyword"=>"online, free convertor, export, excel to CSV, csv to excel,json to excel, excel to json, json to csv, mock data, generate test data, software testing,sample file",
			"description" => "TempVariable|Online free convertor tool - A free online tool to convert excel,csv,json format file to excel, json, csv, sql, user defined delimeter file."
			);
		$this->meta = $meta;
			$this->_render('convert/upload');
		}


	public function upload() {
		$this->load->model('convertormodel');
		$config['upload_path'] = 'resources/uploads';
		$config['allowed_types'] = 'xls|xlsx|csv|txt|json';
		$config['max_size']	= '5000';
		$conversionType = $this->input->post('ctype');
		$tableName = "";
		if($conversionType == "1") {
			$tableName = $this->input->post('tableName');
			$this->convertormodel->setTableName($tableName);
		}
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
			$headerExist = $this->input->post("cheader");

			switch ($format) {
				case '.xlsx':
				    $cFileName = $this->convertormodel->readExcel($fileName,'excel7',$conversionType,$headerExist );
				   
					break;
				case '.csv':
					 $cFileName = $this->convertormodel->readCSV($fileName,$conversionType,$headerExist );
					 
				    break;
				case'.xls':
					 $cFileName = $this->convertormodel->readExcel($fileName,'excel3',$conversionType,$headerExist );
					 
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
}