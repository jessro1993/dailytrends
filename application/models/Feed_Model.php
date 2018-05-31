<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feed_Model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
	public function add($data)
	{
        $publisher = $data->title;
        
        for($i = 0; $i < 5; $i++) {
            $feed = array(
                'title'     => $data->item[$i]->title,
                'body'      => $data->item[$i]->description,
                'image'     => $data->item[$i]->enclosure['url'],
                'source'    => $data->item[$i]->link,
                'publisher' => $publisher
            );
            
            $this->db->insert('articles', $feed);
        }
    }
    
    public function add_simple($data)
	{           
        $this->db->insert('articles', $data);
    }
    
    public function get_last_id() {
        $this->db->select('MAX(id) as id');
        $this->db->from('articles');
        
        $id = $this->db->get()->row()->id;
        
        return $id;
    }
    
    
    public function delete($data)
    {
        
    }
    
    public function edit($data)
    {
        
    }

    public function get_feeds()
    {   
        $this->db->select('*');
        $this->db->from('articles');
        $this->db->order_by('date');
        
        $query = $this->db->get();
        
        return $query->result();
    }
    
}
