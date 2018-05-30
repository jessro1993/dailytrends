<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feed_Model extends CI_Model {

	public function add($data)
	{
        $feed = array();
        array_push($feed, $data);
        
        return $feed;
    }
}
