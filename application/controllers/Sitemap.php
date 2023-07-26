<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');


class Sitemap extends CI_Controller {
    public function index(){
        $this->load->database();
         
        //header("Content-Type: text/xml;charset=iso-8859-1");
        $list = $this->db->query('select * from cms_pages where slug = "expertise" and status=1 order by id desc')->row();
        $data['select_service'] = $list;
         
        $our_services = $this->db->query('select * from our_services where status=1 order by id desc')->result(); 
        $data['our_services'] = $our_services; 
        
        $expertises = $this->db->query('select * from area_expertise_looking where status=1 order by id desc')->result(); 
        $data['expertises'] = $expertises; 
        
        $cms_pages = $this->db->query('select * from cms_pages where status=1 order by id desc')->result(); 
        $data['cms_pages'] = $cms_pages; 
        $data['cms_pages'] = array(); 
         
        $venders = $this->db->query("select * from vender where status = 1 AND display_status = 1 AND user_type = 2 order by experience desc")->result(); 
        $data['venders'] = $venders;
        
        $venders = $this->db->query("select * from blog where status = 1 order by id desc")->result(); 
        $data['blog'] = $venders;
        
        $products = $this->db->query("select * from products where status = 1 and vendor_status = 1 and admin_status = 1")->result(); 
        foreach ($products as $key => $productDetails) {
            $row = $this->common_model->get_all_details('category',array('id'=>$productDetails->cat_id))->row_array();
            $products[$key]->category_name = $row['name'];
            $products[$key]->category_slug = $row['slug'];
        }
        $data['products'] = $products;

        $this->load->view('sitemap-view', $data);
    }
}