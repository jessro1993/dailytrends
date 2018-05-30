<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feed extends CI_Controller {
    public function __construct()
	{  
        parent::__construct();
        $this->load->model('Feed_Model');
    }
    
	public function create()
	{              
        $title = $this->input->post('title');
        $body = $this->input->post('body');
        $author = $this->input->post('author');
        
        $feed_item = array(
            'title' => $title,
            'body'  => $body,
            'author' => $author,
        );
        
        $this->load->view('Feeds/new_feed');
    }
}
