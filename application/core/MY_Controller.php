<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller{
	
	//Page info
	protected $data = Array();
	protected $pageName = FALSE;
	protected $template = "homepage";
	protected $hasTopNav = True;
	protected $topNav = "templates/top_nav";
	protected $hasRightNav = True;
	protected $rightNav = "templates/right_nav";
	protected $enable_blocks = FALSE;
	protected $enable_sidebar = FALSE;
	protected $block = "";
	protected $hasPageModal = FALSE;
	protected $pageModal = "";
	protected $hasPageHeader = FALSE;
	protected $pageHeader = "";
	protected $hasRightContent = FALSE;
	protected $rightContent="";
	protected $meta = Array();
	
	//Page contents
	protected $javascript = array(
			/*'bootstrapvalidator/dist/js/bootstrapValidator.min.js',
			'custom/autoload.js'*/
	);
	protected $css = array(
	
	/*	'bootstrapvalidator/dist/css/bootstrapValidator.min.css'		
			'custom/custom.css',
			'custom/mandatory_indication.css',*/
		);
	protected $fonts = array(
			
	);
	
	//Page Meta
	protected $title = FALSE;
	protected $body_class = "homepage";
	protected $description = FALSE;
	protected $keywords = FALSE;
	protected $author = FALSE;
	
	function __construct()
	{	

		parent::__construct();
		$this->data["uri_segment_1"] = $this->uri->segment(1);
		$this->data["uri_segment_2"] = $this->uri->segment(2);
		$this->title = $this->config->item('site_title');
		$this->description = $this->config->item('site_description');
		$this->keywords = $this->config->item('site_keywords');
		$this->author = $this->config->item('site_author');
		
		$this->pageName = strToLower(get_class($this));
	}
	 
	
	protected function _render($view,$renderData="FULLPAGE") {

        switch ($renderData) {
        case "AJAX"     :
            $this->load->view($view,$this->data);
        break;
        case "JSON"     :
            echo json_encode($this->data);
        break;
        case "FULLPAGE" :
        default         : 
		//static
		$toTpl["javascript"] = $this->javascript;
		$toTpl["css"] = $this->css;
		$toTpl["fonts"] = $this->fonts;
		
		//meta
		$toTpl["title"] = $this->title;
		$toTpl["body_class"] = $this->body_class;
		$toTpl["description"] = $this->description;
		$toTpl["keywords"] = $this->keywords;
		$toTpl["author"] = $this->author;
		
		//data
		if( ($this->enable_sidebar == TRUE) and ($this->enable_blocks == TRUE)){
			$toBody["sidebar_content"] = $this->load->view($this->block,array_merge($this->data,$toTpl),true);
		}
		//student page headers
		
		$toTpl["page_modal"] = "";
		if($this->hasPageHeader) {
		    $toBody["page_header"] = $this->load->view($this->pageHeader,$this->data,true);	
		}
		if($this->hasPageModal) {
			$toTpl["page_modal"] = $this->load->view($this->pageModal,'',true);
		}else {
		    $toTpl["page_modal"] = "";
		}
		$toContent["right_content"] = "";
		$toBody["content"] = $this->load->view("page/".$view,array_merge($this->data,$toContent),true);
		//$toBody["right_nav"] = $this->load->view($this->nav,$toMenu,true);
		if($this->hasRightContent) {
			$toBody["right_content"] = $this->load->view("page/".$this->rightContent,$toContent,true);
		}
		//nav menu
		$toMenu["pageName"] = $this->pageName;
		$toBody["topNavigation"] = $this->load->view($this->topNav,$toMenu,true);
		
		if($this->hasRightNav) {
			$toBody["rightNavigation"] = $this->load->view($this->rightNav,$toMenu,true);
		}
		
		$toHeader["basejs"] = $this->load->view("templates/basejs",$this->data,true);		
		$toBody["header"] = $this->load->view("templates/top_nav",$toHeader,true);
		
		$toBody["footer"] = $this->load->view("templates/footer",'',true);		
		$toTpl["body_content"] = $this->load->view("templates/".$this->template,$toBody,true);
		$toTpl["meta"] = $this->meta;
        	
		
		//render view
		$this->load->view("templates/skeleton",$toTpl);
		 break;
    }
	}
}
