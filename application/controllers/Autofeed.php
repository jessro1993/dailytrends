<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Autofeed extends CI_Controller {
    public function __construct()
	{  
        parent::__construct();
    }
    
	public function index()
	{   
        $url_pais = 'http://ep00.epimg.net/rss/elpais/portada.xml';
        $url_mundo = 'http://estaticos.elmundo.es/elmundo/rss/portada.xml';
        
        $this->data['xml_pais'] = simplexml_load_file($url_pais);
        $this->data['xml_mundo'] = simplexml_load_file($url_mundo);
         
		$this->load->view('main_page', $this->data);
	}
}
