<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rss extends CI_Controller 
{
    
    public function __construct()
    {
        parent::__construct();
        
        $this->load->helper('xml');
        $this->load->helper('text');

        $this->load->model('Feed_Model');
    }

    public function index() 
    {   
        $this->load->view('Rss/list');
    }

    public function view($news = null) 
    {
        if(!is_null($news))
        {
            $this->data['feed_name'] = 'DailyTrends';
            $this->data['encoding'] = 'utf-8';
            $this->data['feed_url'] = 'http://localhost/DailyTrends/Rss' . $news;
            $this->data['page_description'] = 'Periódico de las principales notícias.';
            $this->data['page_language'] = 'es-ES';
            $this->data['creator_email'] = 'jesusrosaleny@gmail.com';            
            $this->data['feeds'] = $this->Feed_Model->get_feeds($news);

            header("Content-Type: application/rss+xml");

            $this->load->view('Rss/view_rss', $this->data);
        } else
        {
            redirect('Rss');
        }
    }
}
