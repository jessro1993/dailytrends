<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Autofeed extends CI_Controller {
    public function __construct()
	{  
        parent::__construct();
        $this->data['feed'] = Array();
        $this->load->model('Feed_Model');
        $url_pais = 'http://ep00.epimg.net/rss/elpais/portada.xml';
        $url_mundo = 'http://estaticos.elmundo.es/elmundo/rss/portada.xml';
        
        $this->data['xml_pais'] = simplexml_load_file($url_pais);
        $this->data['xml_mundo'] = simplexml_load_file($url_mundo);
        
        $this->Feed_Model->add($this->data['xml_pais']->channel);
        $this->Feed_Model->add($this->data['xml_mundo']->channel);
    }
    
    public function index() {
        redirect('feed');
    }
}
