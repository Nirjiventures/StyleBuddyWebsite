<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page_Model extends CI_Model {
    
    public function allController ()
    {
        $this->db->from('site_setting');
        return $this->db->get()->row(); 
    }
    public function stylist()
    {
        $data['stylist'] = $this->db->order_by("id", "desc")->get_where('personal_stylist',['status'=> 1])->result();
        return $data;
    }
    public function common_all()
    { 
        // $this->db->select('*');
        // $this->db->from('category');
        // $this->db->where("category.status",1);
        // $categorys = $this->db->get()->result();
        
        // foreach ($categorys as $key => $value) {
        //     $this->db->select('*');
        //     $this->db->from('subcategory');
        //     $this->db->where("status",1);
        //     $this->db->where("category",$value->id);
        //     $subCategory = $this->db->get()->result();
        //     $categorys[$key]->sub_category = $subCategory;
        // }
        // $data['category'] = $categorys;
        
         $this->db->select('*');  
         $this->db->where('status', 1);$this->db->order_by('id','desc'); $this->db->limit(6); 
         $data['stylists'] = $this->db->get('vender')->result(); 
          
         $this->db->select('*');  
         $this->db->where('status', 1);$this->db->order_by('id','desc'); $this->db->limit(8); 
         $data['latestProducts'] = $this->db->get('products')->result(); 
        
        $this->db->select('*');
        $this->db->from('slider');
        $this->db->where("slider.status",1);
        $data['slider'] = $this->db->get()->result();
        
        $data['fashionService'] = $this->db->get_where('our_services',['status'=> 1])->result();
        $data['testimonial'] = $this->db->get_where('testimonial',['status'=> 1])->result();
        
        
        return $data;
    }
    public function fetch_all($table){
        return $this->db->get_where($table,['status'=> 1])->result();
    }
    public function fetch_row(){
        return $this->db->get_where($table,['status'=> 1])->result();
    }
    public function login_chk ($email ,$password,$table) {
        
    	 $this->db->where('email', $email);
    	 $this->db->where('password', $password); 
         $this->db->from($table);
         $query = $this->db->get();
    
           if($query->num_rows() == 1) {
              return $query->row();
          } else {
          	return false;
          }
      }
    public function common_update($data,$where,$table)
    {
        $this->db->where($where);
        $update = $this->db->update($table,$data);
       // return $update;
       return $this->db->last_query();
    }
    public function stylists($limit, $offset)
    {
       $this->db->order_by('id',"desc"); 
       $this->db->limit($limit, $offset); 
       $data= $this->db->get('vender'); 
       //return $this->db->last_query();
       return $data->result(); 
    }
    public function list($limit, $offset, $where_in = false, $orderBy= false)
    {
      $this->db->select("*");
      $this->db->from('products');
      if($where_in) {
        $this->db->where_in('cat_id',(23));
      }
      $this->db->limit($limit, $offset);
      //$this->db->order_by('id','desc');
      $this->db->order_by('price', $orderBy);
      $query = $this->db->get();
      return $query->result();
      //return $this->db->last_query();
    }
    public function count_all($cat_id, $gender) {
        
        $query = " SELECT * FROM products WHERE status = '1' ";
        
        if(isset($cat_id)) {
            $cat_filter = implode("','", $cat_id);
            $query .= " AND cat_id IN('".$cat_filter."')";
          }
          
       if(isset($gender)) {
           $gender = implode("','", $gender);
            $query .= " AND gender = '".$gender."' ";
          }   
        
         $data = $this->db->query($query);
         return $data->num_rows();
        //return  $this->db->where(['cat_id'=> $cat_id, 'gender'=> $gender])->from("products")->count_all_results();
        
    }
    public function  fetch_data($limit, $start, $cat_id, $gender) {
        
        $query = " SELECT * FROM products WHERE status = '1' ";
        
        if(isset($cat_id)) {
            $cat_filter = implode("','", $cat_id);
            $query .= " AND cat_id IN('".$cat_filter."')";
          }
          
       if(isset($gender)) {
            $gender = implode("','", $gender);
            $query .= " AND gender = '".$gender."' ";
          }    
        
        $query .= ' LIMIT '.$start.', ' . $limit;
        
    $data = $this->db->query($query);    
    $output = '';
    if($data->num_rows() > 0) {
  
   foreach($data->result_array() as $row) {
  
    $output .= '<div class="col-6 col-sm-4">';
     $output .= '<div class="pdt_box">';
        $output .= '<div class="pdt_inner">';
             $output .= '<img src="'.base_url().'assets/images/product/'. $row['image'] .'" class="img-fluid">';
             $output .= '<div class="prd_title text-center">';
             $output .= '<h4><a href="'.base_url().'product-detail/'.$row['slug'] .'"> '.mb_strimwidth($row['product_name'],0,20, '....') .'</a></h4>';
        $output .= '</div>';
       $output .= '<a href="'.base_url().'product-detail/'.$row['slug'] .'" class="link-cart">Quick View</a>';
    $output .= '</div>';
     $output .= '<div class="prd_price">';
      $output .= '<span>'.$this->site->currency.' '.number_format($row['price']) .'</span>';	
     $output .= '</div>';
    $output .= '<button type="button" class="btn btn-price"><a class="text-white" href="'.base_url().'product-detail/'.$product->slug .'">Buy Now</a></button>';
  $output .= '</div>';  
  $output .= '</div>';       
   }
  }
  else
  {
   $output = '<h3>No Data Found</h3>';
  }
  return $output;

    }
}    