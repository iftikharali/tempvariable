<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Downloader extends MY_Controller {

	public function download() 
	{
		
		$fileName = $this->input->get("sfilename");
		$dfileName = $this->input->get("dfilename");
		header("Pragma: public");
		header("Expires: 0"); 
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Content-Type:".mime_content_type($fileName));
		header("Content-Disposition: attachment;filename=\"".ltrim($dfileName)."\""); 
		readfile(ltrim($fileName));
	}

}