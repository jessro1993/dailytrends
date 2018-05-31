<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feed extends CI_Controller {
    public function __construct()
	{  
        parent::__construct();
        $this->load->model('Feed_Model');
    }
    
    public function index()
    {
        $this->data['feeds'] = $this->Feed_Model->get_feeds();
        $this->load->view('main_page', $this->data);
    }
    
    public function subscribe() {
        $this->data['feeds'] = $this->Feed_Model->get_feeds();
        
        $this->load->view('Feeds/view_feed', $this->data);
    }
    
    public function create()
	{   
        if(!$this->input->post()) {
            $this->load->view('Feeds/new_feed');
        } else {
            $title = $this->input->post('title');
            $body = $this->input->post('body');
            $id = (int) $this->Feed_Model->get_last_id() + 1;
            $publisher = $this->input->post('author');

            $feed_item = array(
                'title'     => $title,
                'body'      => $body,
                'source'    => base_url('feed/view/'.$id),
                'publisher' => $publisher
            );
            
            $this->Feed_Model->add_simple($feed_item);
            
            redirect('feed');

        }
    }
    
    public function add() 
    {
        
        redirect('Feed/create');
    }
}
