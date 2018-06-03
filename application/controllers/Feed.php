<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feed extends CI_Controller
{
    public function __construct()
	{  
        parent::__construct();
        $this->load->model('Feed_Model');
    }
    
    public function index()
    {   
        $url_pais = 'http://ep00.epimg.net/rss/elpais/portada.xml';
        $url_mundo = 'http://estaticos.elmundo.es/elmundo/rss/portada.xml';
        
        $data['xml_pais'] = simplexml_load_file($url_pais);
        $data['xml_mundo'] = simplexml_load_file($url_mundo);
        
        $this->Feed_Model->add($data['xml_pais']->channel);
        $this->Feed_Model->add($data['xml_mundo']->channel);

        $this->data['feeds_pais'] = $this->Feed_Model->get_feeds('país');
        $this->data['feeds_mundo'] = $this->Feed_Model->get_feeds('mundo');
        $this->data['feeds_daily'] = $this->Feed_Model->get_feeds('daily');

        $this->load->view('main_page', $this->data);
    }
    
    public function create()
	{   
        if(!$this->input->post())
        {
            $this->load->view('Feeds/new_feed');
        }
        else
        {
            $file = $_FILES['articleItem'];
            $upload = 'assets/uploads/';
            
            $image = $upload . basename($file['name']);

            move_uploaded_file($file['tmp_name'], $image);


            $title = $this->input->post('title');
            $body = $this->input->post('body');
            $id = (int) $this->Feed_Model->get_last_id() + 1;
            $publisher = $this->input->post('author');

            $feed_item = array(
                'id'        => $id,
                'title'     => $title,
                'body'      => $body,
                'image'     => $image,
                'source'    => base_url('feed/view/'.$id),
                'publisher' => $publisher
            );
            
            $this->Feed_Model->add_simple($feed_item);
            
            redirect('feed');
        }
    }

    public function list() 
    {
        $this->data['feeds'] = $this->Feed_Model->get_feeds();

        $this->load->view('Feeds/list', $this->data);
    }

    public function edit($id = null) 
    {
        if(!is_null($id))
        {   
            if($this->input->post())
            {
                $title = $this->input->post('title_e');
                $body = $this->input->post('body_e');
                
                $data = array(
                    'id'    => $id,
                    'title' => $title,
                    'body'  => $body
                );

                $this->Feed_Model->edit($data);

                redirect('feed/list');

            }
            else 
            {
                $this->data['feed'] = $this->Feed_Model->get_article($id);

                $this->load->view('Feeds/edit_feed', $this->data);        
            }
        }
        else 
        {
            redirect('feed/list');
        }
    }

    public function delete($id = null)
    {
        if(!is_null($id))
        {
            if($this->Feed_Model->delete($id)) {
                redirect('feed/list');
            } else {
                redirect('feed/list');
            }
        } 
        else
        {
            redirect('feed/list');
        }
    }
}
