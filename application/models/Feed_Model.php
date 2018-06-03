<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feed_Model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
	public function add($data)
	{
        $publisher = $data->title;

        $articles = $this->db->select('*')->from('articles')->get()->result();
        $this->db->reset_query();

        for($i = 0; $i < 5; $i++)
        {
            if($articles[$i]->title != $data->item[$i]->title)
            {
                $id = (int) $this->Feed_Model->get_last_id() + 1;

                $feed = array(
                    'id'        => $id,
                    'title'     => $data->item[$i]->title,
                    'body'      => $data->item[$i]->description,
                    'image'     => $data->item[$i]->enclosure['url'],
                    'source'    => explode("#", $data->item[$i]->link)[0],
                    'publisher' => $publisher
                );
                
                $insert_query = $this->db->insert_string('articles', $feed);
                $insert_query = str_replace('INSERT INTO', 'INSERT IGNORE INTO', $insert_query);
                $this->db->query($insert_query);
            }
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
        $this->db->where('id', $data);

        if($this->db->delete('articles'))
        {
            return true;
        } else
        {
            return false;
        }
    }
    
    public function edit($data)
    {
        $id = $data['id'];

        $item = array(
            'title' => $data['title'],
            'body'  => $data['body']
        );

        $this->db->where('id', $id);
        $this->db->update('articles', $item);
    }

    public function get_feeds($source = null)
    {   
        if(is_null($source)) {
            $this->db->select('*');
            $this->db->from('articles');
            $this->db->order_by('date', 'DESC');            
            
            $query = $this->db->get();
        
            return $query->result();
        } else {
            $this->db->select('*');
            $this->db->from('articles');
            $this->db->where('source LIKE ', '%' . $source .'%');
            $this->db->order_by('date', 'DESC');
            $this->db->limit('5');
    
            $query = $this->db->get();
            
            return $query->result();
        }
    }

    public function get_article($id) 
    {
        $this->db->select('*');
        $this->db->from('articles');
        $this->db->where('id', $id);

        return $this->db->get()->row();
    }
    
}
