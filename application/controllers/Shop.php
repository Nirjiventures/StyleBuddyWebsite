<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Shop extends MY_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('Page_Model');
        $this->site = $this->Page_Model->allController();
        $this->style = $this->Page_Model->stylist();
        $this->load->library('PHPMailer_Lib');
        $this->mail = $this->phpmailer_lib->load();
        $this->load->model('common_model');
        $this->userID = $this->session->userdata('userId');
        $this->venderId = $this->session->userdata('venderId');
    }
    public function index(){   
        $postData = $this->input->get();
        $segment1 = $this->uri->segment(1);
        $segment2 = $this->uri->segment(2);
        $segment3 = $this->uri->segment(3);
        $uri_segment = 3;
        $paginationPrefix = $segment1.'/';
        $query = "select * from products where status = 1 and vendor_status = 1 and admin_status = 1 ";
        $where_in = '';
         
        $orderBy = $this->input->post('orderBy');
        if(isset($catid)) {
            $where_in = implode(',', $catid);
            $query .= "AND cat_id IN ($where_in)";
        }
        if(isset($gender)){
             $query .= "AND gender = $gender";
        } 
        if ($this->input->get('catid')) {
            $catid =  $this->input->get('catid');
            $i=0;
            $str = '';
            foreach ($catid as $key => $value) {
                if ($i>0) {
                    $str .= ' OR '; 
                }
                $str .= ' cat_id = '.$value;
                $i++;
            }
            $query .= " AND (". $str.") ";
        }
        if ($this->input->get('price')) {
            $catid =  $this->input->get('price');
            $i=0;
            $str = '';
            foreach ($catid as $key => $value) {
                if ($i>0) {
                    $str .= ' OR '; 
                }
                $f = explode('-',$value);
                $str .= ' ( price >= "'.$f[0].'" AND price <= "'.$f[1].'") ' ;
                $i++;
            }
            $query .= " AND (". $str.") ";
        }
        if ($this->input->get('discount')) {
            $catid =  $this->input->get('discount');
            $i=0;
            $str = '';
            foreach ($catid as $key => $value) {
                if ($i>0) {
                    $str .= ' OR '; 
                }
                //$str .= " ( discount != '' AND discount <= '".$value."') " ;
                $str .= ' discount = '.$value;
                $i++;
            }
            $query .= " AND (". $str.") ";
        }
        
        if ($this->input->get('gender')) {
            $catid =  $this->input->get('gender');
            $i=0;
            $str = '';
            foreach ($catid as $key => $value) {
                if ($i>0) {
                    $str .= ' OR '; 
                }
                $str .= ' gender = '.$value;
                $i++;
            }
            $query .= " AND (". $str.") ";
        } 
        $sortBy = ' order by id desc';
        if ($this->input->get('orderBy')) {
            $sortBy = ' order by price '.$this->input->get('orderBy');
        }
        $query .= $sortBy;
        $result = $this->db->query($query);
        $data['all'] =  $result->result();
        $rowCount  = $result->num_rows();
        $uriSegment = 3; $par_page = 6;
        $this->load->library('pagination');
        $config = array();
        $config['full_tag_open']    = '<div class="pagging "><nav><ul class="pagination justify-content-center ">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tag_close']  = '<span aria-hidden="true"></span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tag_close']  = '</span></li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tag_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tag_close']  = '</span></li>';
        $config['total_rows'] = $rowCount;
        $config['per_page']    = $par_page;
        $config["base_url"] = base_url().$paginationPrefix;
        $config['suffix'] = '?' . http_build_query($_GET, '', "&");
        $config['first_url'] = base_url() .$paginationPrefix. '?' . http_build_query($_GET, '', "&");
        $config['uri_segment'] = $uriSegment;
        $config['use_page_numbers'] = TRUE;

        $this->pagination->initialize($config); 
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        if($page != 0){ $page = ($page-1) * $par_page; }
        $query .= ' LIMIT '.$page.','.$par_page;
        $result = $this->db->query($query);
        $data['products'] =  $result->result();

        $wh = ' WHERE parent_id = 0 and status= 1 order by ui_order ASC';
        $rows = $this->common_model->get_all_details_query('category',$wh)->result_array();
        foreach ($rows as $k => $v) {
            $rs = array();
            $wh1 = ' WHERE parent_id = '.$v['id'].' and status= 1 order by ui_order ASC';
            $rs = $this->common_model->get_all_details_query('category',$wh1)->result_array();
            $rows[$k]['child'] = $rs;
            foreach($rs as $k1=>$v1){
                $rows[$k]['child'][$k1]['child']  = $this->recursive('category',$k1,$v1['id']);
            }

        }
        $data['parentCategory'] = $rows;

        $wh = ' WHERE featured = 1 order by ui_order ASC';
        $rows = $this->common_model->get_all_details_query('category',$wh)->result_array();
        $data['featuredCategory'] = $rows;

        $list = $this->db->query('select meta_title,meta_keyword,meta_description from cms_pages where slug = "shop" and status=1')->row();

        if($list) {

            $data['seoData'] = $list;

        }
        $data['seoData'] = array();
        $list = $this->db->query('select * from cms_pages where slug = "stylist-curated-outfits" and status=1')->row();
        if($list) {
            $data['seoData'] = $list;
        }
        $this->load->view('front/template/header',$data);
        $this->load->view('front/shop/shop-main',$data);
        $this->load->view('front/template/footer',$data);
    }
    
    public function shopcategory(){  
        $postData = $this->input->get();
        $segment1 = $this->uri->segment(1);
        $segment2 = $this->uri->segment(2);
        $segment3 = $this->uri->segment(3);
        $paginationPrefix = $segment1.'/'.$segment2.'/';
        $query = "select * from products where status = 1 and vendor_status = 1 and admin_status = 1 ";
        
        $where_in = '';
        $orderBy = $this->input->post('orderBy');
        
        if ($this->input->get('price')) {
            $catid =  $this->input->get('price');
            $i=0;
            $str = '';
            foreach ($catid as $key => $value) {
                if ($i>0) {
                    $str .= ' OR '; 
                }
                $f = explode('-',$value);
                if(strtoupper($f[1]) == 'ABOVE'){
                    $str .= ' ( price >= "'.$f[0].'" AND price <= "100000") ' ;
                }else{
                    $str .= ' ( price >= "'.$f[0].'" AND price <= "'.$f[1].'") ' ;
                }
                $i++;
            }
            $query .= " AND (". $str.") ";
        }
        if ($this->input->get('size')) {
            $catid =  $this->input->get('size');
            if (is_array($catid)) {
                $i=0;
                $str = '';
                foreach ($catid as $key => $value) {
                    if ($i>0) {
                        $str .= ' OR '; 
                    }
                    $str .= ' FIND_IN_SET("'.$value.'",size) ';
                    $i++;
                }
            }else{
                $str .= ' FIND_IN_SET("'.$catid.'",size) ';
            }
            $query .= " AND (". $str.") ";
        }
        if ($this->input->get('color')) {
            $catid =  $this->input->get('color');
            if (is_array($catid)) {
                $i=0;
                $str = '';
                foreach ($catid as $key => $value) {
                    if ($i>0) {
                        $str .= ' OR '; 
                    }
                    $str .= ' FIND_IN_SET("'.$value.'",color) ';
                    $i++;
                }
            }else{
                $str .= ' FIND_IN_SET("'.$catid.'",color) ';
            }
            $query .= " AND (". $str.") ";
        }
        if ($this->input->get('discount')) {
            $catid =  $this->input->get('discount');
            $i=0;
            $str = '';
            foreach ($catid as $key => $value) {
                if ($i>0) {
                    $str .= ' OR '; 
                }
                $f = explode('-',$value);
                if(strtoupper($f[1]) == 'ABOVE'){
                    $str .= ' ( discount >= "'.$f[0].'" AND discount <= "100000") ' ;
                }else{
                    $str .= ' ( discount >= "'.$f[0].'" AND discount <= "'.$f[1].'") ' ;
                }
                $i++;
            }
            if ($str) {
                $query .= " AND (". $str.") ";
            }
            
        }
        if ($this->input->get('catid')) {
            $catid =  $this->input->get('catid');
            if (is_array($catid)) {
                $i=0;
                $str = '';
                foreach ($catid as $key => $value) {
                    if ($i>0) {
                        $str .= ' OR '; 
                    }
                    $str .= ' FIND_IN_SET("'.$value.'",cat_id)';
                    //$str .= ' cat_id = '.$value;
                    $i++;
                }
                $query .= " AND (". $str.") ";
            }else{
            
                $wh = ' WHERE parent_id = "'.$catid.'" order by ui_order ASC';
                $rowsCatF = $this->common_model->get_all_details_query('category',$wh)->result_array();
                foreach ($rowsCatF as $k => $v) {
                    $rs = array();
                    $wh1 = ' WHERE parent_id = "'.$v['id'].'" order by ui_order ASC';
                    $rs = $this->common_model->get_all_details_query('category',$wh1)->result_array();
                    $rowsCatF[$k]['child'] = $rs;
                    foreach($rs as $k1=>$v1){
                        $rowsCatF[$k]['child'][$k1]['child']  = $this->recursive('category',$k1,$v1['id']);
                    }
                }
                if ($rowsCatF) {
                    $i=0;
                    $str = '';
                    foreach ($rowsCatF as $key => $value) {
                        if ($i>0) {
                            $str .= ' OR '; 
                        }
                        $str .= ' FIND_IN_SET("'.$value['id'].'",cat_id)';
                        foreach ($value['child'] as $key1 => $value1) {
                            $str .= ' OR '; 
                            $str .= ' FIND_IN_SET("'.$value1['id'].'",cat_id)';
                            foreach ($value1['child'] as $key2 => $value2) {
                                $str .= ' OR '; 
                                $str .= ' FIND_IN_SET("'.$value2['id'].'",cat_id)';
                                $i++;
                            }
                            $i++;
                        }
                        $i++;
                    }
                    if ($str) {
                        $query .= " AND (". $str." OR  FIND_IN_SET('".$catid."',cat_id) ) ";
                    }
                }else{
                    $query .= ' AND FIND_IN_SET("'.$catid.'",cat_id)';
                }
            }
        }
        $sortBy = ' order by id desc';
        if ($this->input->get('orderBy')) {
            $sortBy = ' order by price '.$this->input->get('orderBy');
        }

        $rowsCatF = array(); 
        if ($this->input->get('catid')) {
            $catid =  $this->input->get('catid');
            if (is_array($catid)) {
                
            }else{
                $wh = ' WHERE id = "'.$catid.'" order by ui_order ASC';
                $rowsCatF = $this->common_model->get_all_details_query('category',$wh)->result_array();
                foreach ($rowsCatF as $k => $v) {
                    $rs = array();
                    $wh1 = ' WHERE id = "'.$v['parent_id'].'" order by ui_order ASC';
                    $rs = $this->common_model->get_all_details_query('category',$wh1)->result_array();
                    $rowsCatF[$k]['child'] = $rs;
                    foreach($rs as $k1=>$v1){
                        $rowsCatF[$k]['child'][$k1]['child']  = $this->recursiveParent('category',$k1,$v1['parent_id']);
                    }
                }
            }
        }



        $data['catRecords'] = $catRecords = $rowsCatF;

        $query .= $sortBy;
        $result = $this->db->query($query);
        $data['all'] =  $result->result();
        $rowCount  = $result->num_rows();
        $uriSegment = 3; 

        $par_page = 20;
        $this->load->library('pagination');
        $config = array();
        $config['full_tag_open']    = '<div class="pagging "><nav><ul class="pagination justify-content-center ">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tag_close']  = '<span aria-hidden="true"></span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tag_close']  = '</span></li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tag_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tag_close']  = '</span></li>';
        $config['total_rows'] = $rowCount;
        $config['per_page']    = $par_page;
        $config["base_url"] = base_url().$paginationPrefix;
        $config['suffix'] = '?' . http_build_query($_GET, '', "&");
        $config['first_url'] = base_url() .$paginationPrefix. '?' . http_build_query($_GET, '', "&");
        $config['uri_segment'] = $uriSegment;
        $config['use_page_numbers'] = TRUE;
        $this->pagination->initialize($config); 
        
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        if($page != 0){ $page = ($page-1) * $par_page; }
        $query .= ' LIMIT '.$page.','.$par_page;
        $result = $this->db->query($query);
        
        
        $data['start_limit'] = $page;
		$end_limit = $page + $par_page;
		if($rowCount > $end_limit){
			$data['end_limit'] = $end_limit;
		}else{
			$data['end_limit'] = $rowCount;
		}
		
        $data['total_rows'] =  $rowCount;
        $products =  $result->result();

        foreach ($products as $key => $productDetails) {
            $wishListStatus = 0;
            if($this->session->userdata('session_user_id_temp')){
                $wishListStatusRow = $this->db->get_where('wishlist',['product_id' => $productDetails->id,'user_id' => $this->session->userdata('session_user_id_temp') ])->row();
                if ($wishListStatusRow) {
                    $wishListStatus = 1;
                }
            }
            $products[$key]->wishListStatus = $wishListStatus;
            
            $review = $this->db->query('SELECT AVG(rating) as rating, count(rating) as feedbackCount from product_review'." WHERE status = 1 and  product_id = ".$productDetails->id)->row();
            $products[$key]->feedbackRating = ($review->rating)?$review->rating:0;
    
            $products[$key]->feedbackCount = $review->feedbackCount;
    
            $products[$key]->review = $review;
    
            $reviews = $this->db->query('select * from product_review'." WHERE status = 1 AND product_id = ".$productDetails->id.' order by id DESC')->result_array();
    
            foreach ($reviews as $ke => $val11) { 
                $reviewUser = array();
                if ($val11['from_user_id']) {
                    $reviewUser = $this->db->query('select * from vender'." WHERE id = ".$val11['from_user_id'])->row_array();
                    //echo $this->db->last_query();
                }
                $reviews[$ke]['reviewUser'] = $reviewUser;
            }
            $products[$key]->reviews = $reviews;
            
            $row = $this->common_model->get_all_details('vender',array('id'=>$productDetails->user_id))->row_array();
            $products[$key]->boutique_fname = $row['fname'];
            $products[$key]->boutique_lname = $row['lname'];
            
            $row = $this->common_model->get_all_details('vender',array('id'=>$productDetails->vender_id))->row_array();
            $products[$key]->fname = $row['fname'];
            $products[$key]->lname = $row['lname'];
            
            $row = $this->common_model->get_all_details('category',array('id'=>$productDetails->cat_id))->row_array();
            $products[$key]->category_name = $row['name'];
            $products[$key]->category_slug = $row['slug'];
            
            if($productDetails->size){
                $this->db->select('*');  
                $this->db->where_in('id',$productDetails->size,false);
                $this->db->order_by("ui_order", "asc");
                $products[$key]->sizesArray = $this->db->get('product_size')->result();  
            }else{
                $products[$key]->sizesArray = array();  
            }
            if($productDetails->color){
                $this->db->select('*');  
                $this->db->where_in('id',$productDetails->color,false);
                $this->db->order_by("ui_order", "asc");
                $products[$key]->colorsArray = $this->db->get('product_color')->result();  
            }else{
                $products[$key]->colorsArray = array();  
            }
            

        }
        $data['products'] =  $products;
        $data['catLists'] =  $this->db->order_by('name','ASC')->get_where('category',['status'=>1])->result();
        
        $this->db->order_by("ui_order", "asc");
        $data['sizes'] = $this->db->get('product_size')->result(); 
        $this->db->order_by("ui_order", "asc");
        $data['colors'] = $this->db->get('product_color')->result(); 

         
        
        $wh = ' WHERE id = "'.$this->input->get('catid').'" order by ui_order ASC';
        $row = $this->common_model->get_all_details_query('category',$wh)->row();

        if ($row) {
            $meta_title = $row->meta_title; 
            $list = array();
            $list['meta_title'] = $row->meta_title;
            $list['meta_description'] = strip_tags($row->description);
            $list['meta_keyword'] = strip_tags($row->description);
            if(!empty($row->cat_image ))  { 
                $img1 =  ''.$row->cat_image ; 
                if (file_exists($img1)) {
                    $img = $img1;
                }
            }

            $list['meta_image'] = $img;
            $data['seoData'] = (object)$list;

        }else{
            
        
            $aaaa = array();
            foreach ($catRecords as $key => $value) { 
            
                $ab = array();
                $ab['id'] = $value['id'];
                $ab['slug'] = $value['slug'];
                $ab['name'] = $value['name'];
                $ab['label'] = 1;
                array_push($aaaa,$ab);
                foreach ($value['child'] as $key1 => $value1) { 
                
                    $ab = array();
                    $ab['id'] = $value1['id'];
                    $ab['slug'] = $value1['slug'];
                    $ab['name'] = $value1['name'];
                    $ab['label'] = 2;
                    array_push($aaaa,$ab);
                    
                    foreach ($value1['child'] as $key2 => $value2) {  
                    
                        $ab = array();
                        $ab['id'] = $value2['id'];
                        $ab['slug'] = $value2['slug'];
                        $ab['name'] = $value2['name'];
                        $ab['label'] = 3;
                        array_push($aaaa,$ab);
                    
                    }  
                }  
            }  
             
            array_multisort( array_column($aaaa, "label"), SORT_DESC, $aaaa ); 
            if ($aaaa) {
                foreach ($aaaa as $key => $value) {
                    $meta_title =  $value['name']; 
                    $list = array();
                    $list['meta_title'] = $meta_title;
                    $list['meta_description'] = strip_tags($productDetails->description);
                    $list['meta_keyword'] = strip_tags($productDetails->description); 
                    $data['seoData'] = (object)$list;
                }  
    		}else{
    		    $data['seoData'] = array();
                $list = $this->db->query('select * from cms_pages where slug = "shop" and status=1')->row();
                if($list) {
                    $data['seoData'] = $list;
                }
    		}
		}
		
        
    
         

        $this->load->view('front/template/header',$data);
        $this->load->view('front/shop/shop-category',$data);
        $this->load->view('front/template/footer',$data);
         
    }
    public function productDetailsnew(){   
        
        $slug = $this->uri->segment(3);
        
        $this->db->order_by('ui_order','asc');
        $data['sizes'] =  $this->db->get_where('product_size',array('status'=>1))->result();
        $this->db->order_by('ui_order','asc');
        $data['colors'] =  $this->db->get_where('product_color',array('status'=>1))->result();

        //$data['sizes']  = $this->Page_Model->fetch_all('product_size');
        $this->db->select('products.*, vender.fname,vender.lname'); 

        $this->db->from('products');

        $this->db->join('vender', 'vender.id = products.vender_id');

        $this->db->where('products.slug', $slug);
        $this->db->where('products.vendor_status', 1);
        $this->db->where('products.admin_status', 1);
        $this->db->where('products.status', 1);

        $productDetails  = $this->db->get()->row();
        if(!$productDetails){
            redirect(base_url('shop'));
        }


        $wishListStatus = 0;

        if($this->session->userdata('userId')){

            $wishListStatusRow = $this->db->get_where('wishlist',['product_id' => $productDetails->id,'user_id' => $this->session->userdata('userId') ])->row();

            if ($wishListStatusRow) {

                $wishListStatus = 1;

            }

        }

        $productDetails->wishListStatus = $wishListStatus;
        $review = $this->db->query('SELECT AVG(rating) as rating, count(rating) as feedbackCount from product_review'." WHERE status = 1 and  product_id = ".$productDetails->id)->row();
        $productDetails->feedbackRating = ($review->rating)?$review->rating:0;
        $productDetails->feedbackCount = $review->feedbackCount;
        $productDetails->review = $review;
        $reviews = $this->db->query('select * from product_review'." WHERE status = 1 AND product_id = ".$productDetails->id.' order by id DESC')->result_array();

        foreach ($reviews as $ke => $val11) { 
            $reviewUser = array();
            if ($val11['from_user_id']) {
                $reviewUser = $this->db->query('select * from vender'." WHERE id = ".$val11['from_user_id'])->row_array();
                //echo $this->db->last_query();
            }
            $reviews[$ke]['reviewUser'] = $reviewUser;
        }
        $productDetails->reviews = $reviews;

        $row = $this->common_model->get_all_details('vender',array('id'=>$productDetails->user_id))->row_array();
        $productDetails->boutique_fname = $row['fname'];
        $productDetails->boutique_lname = $row['lname'];
            
        $data['productDetails']  = $productDetails;

        $catRow = $this->common_model->get_all_details('category',array('id'=>$productDetails->cat_id))->row_array();
        $meta_title = $catRow['name'].' | '.$productDetails->product_name; 
        $list = array();
        $list['meta_title'] = $meta_title;
        $list['meta_description'] = strip_tags($productDetails->description);
        $list['meta_keyword'] = strip_tags($productDetails->description);
        if(!empty($productDetails->image ))  { 
            $img1 =  'assets/images/product/'.$productDetails->image ; 
            if (file_exists($img1)) {
                $img = $img1;
            }
        }

        $list['meta_image'] = $img;
        $data['seoData'] = (object)$list;
    
        $rowsCatF = array(); 
        if ($productDetails->cat_id) {
            $catArray = explode(',', $productDetails->cat_id);
            $cat_id =  $catArray[0];
            $wh = ' WHERE id = '.$cat_id.' order by ui_order ASC';
            $rowsCatF = $this->common_model->get_all_details_query('category',$wh)->result_array();
            foreach ($rowsCatF as $k => $v) {
                $rs = array();
                $wh1 = ' WHERE id = '.$v['parent_id'].' order by ui_order ASC';
                $rs = $this->common_model->get_all_details_query('category',$wh1)->result_array();
                $rowsCatF[$k]['child'] = $rs;
                foreach($rs as $k1=>$v1){
                    $rowsCatF[$k]['child'][$k1]['child']  = $this->recursiveParent('category',$k1,$v1['parent_id']);
                }
            }
        }
        $data['catRecords'] =  $rowsCatF;

        $data['gallary'] = $this->db->get_where('product_galary',['product_id'=> $data['productDetails']->id ])->result();

        /*$this->db->select('*');  
        $this->db->where_in('id',$data['productDetails']->size,false);

        $data['sizes'] = $this->db->get('product_size')->result(); 
        */
        if($data['productDetails']->size){
            $this->db->select('*'); 
            $this->db->where_in('id',$data['productDetails']->size,false);
            $this->db->order_by('ui_order','asc');
            $data['sizes'] =  $this->db->get_where('product_size',array('status'=>1))->result();
        }else{
            $data['sizes'] = array();
        }
        if($data['productDetails']->color){
            $this->db->select('*'); 
            $this->db->where_in('id',$data['productDetails']->color,false);
            $this->db->order_by('ui_order','asc');
            $data['colors'] =  $this->db->get_where('product_color',array('status'=>1))->result();
        }else{
            $data['colors'] = array();
        }
        

        $catArray = explode(',', $productDetails->cat_id);
        
        $cat_id =  $catArray[0];
            
        /*$this->db->select('*');  
        $this->db->where('id !=', $data['productDetails']->id);
        $this->db->where('cat_id', $cat_id); 
        $this->db->limit(4);
        $products = $this->db->get('products')->result(); */
        
        $wh1 = ' WHERE id != '.$data['productDetails']->id.' and status= 1 and vendor_status = 1 and admin_status = 1';
        $ab=0;
        $st = '';
        foreach ($catArray as $v) {
            if($ab>0){
                $st .= ' OR ';
            }
            $st .= ' cat_id = '.$v;
            $ab++;
        }
        if($st){
            $wh1 .= ' AND ('.$st.') ';
        }
        $wh1 .= ' ORDER BY RAND() ';
        $wh1 .= ' limit 4';
        
        $products = $this->common_model->get_all_details_query('products',$wh1)->result();
        //echo $this->db->last_query();
        
        foreach($products as $key => $productDetails){
            $wishListStatus = 0;
            if($this->session->userdata('session_user_id_temp')){
                $wishListStatusRow = $this->db->get_where('wishlist',['product_id' => $productDetails->id,'user_id' => $this->session->userdata('session_user_id_temp') ])->row();
                if ($wishListStatusRow) {
                    $wishListStatus = 1;
                }
            }
            $products[$key]->wishListStatus = $wishListStatus;
            
            $review = $this->db->query('SELECT AVG(rating) as rating, count(rating) as feedbackCount from product_review'." WHERE status = 1 and  product_id = ".$productDetails->id)->row();
            $products[$key]->feedbackRating = ($review->rating)?$review->rating:0;
    
            $products[$key]->feedbackCount = $review->feedbackCount;
    
            $products[$key]->review = $review;
    
            $reviews = $this->db->query('select * from product_review'." WHERE status = 1 AND product_id = ".$productDetails->id.' order by id DESC')->result_array();
    
            foreach ($reviews as $ke => $val11) { 
                $reviewUser = array();
                if ($val11['from_user_id']) {
                    $reviewUser = $this->db->query('select * from vender'." WHERE id = ".$val11['from_user_id'])->row_array();
                    //echo $this->db->last_query();
                }
                $reviews[$ke]['reviewUser'] = $reviewUser;
            }
            $products[$key]->reviews = $reviews;
            
            $row = $this->common_model->get_all_details('vender',array('id'=>$productDetails->user_id))->row_array();
            $products[$key]->boutique_fname = $row['fname'];
            $products[$key]->boutique_lname = $row['lname'];

            $row = $this->common_model->get_all_details('vender',array('id'=>$productDetails->vender_id))->row_array();
            $products[$key]->fname = $row['fname'];
            $products[$key]->lname = $row['lname'];
            
            $catArray = explode(',', $productDetails->cat_id);
            $cat_id =  $catArray[0];
        
            $row = $this->common_model->get_all_details('category',array('id'=>$cat_id))->row_array();
            $products[$key]->category_name = $row['name'];
            $products[$key]->category_slug = $row['slug'];
            
            if($productDetails->size){
                $this->db->select('*');  
                $this->db->where_in('id',$productDetails->size,false);
                $this->db->order_by("ui_order", "asc");
                $products[$key]->sizesArray = $this->db->get('product_size')->result();  
            }else{
                $products[$key]->sizesArray = array();  
            }
             
        }
        $data['relatedProducts'] = $products; 
        
        
        
         
        $data['parentCategory'] = $this->data['parentCategory'];
        $this->load->view('front/template/header',$data);
        $this->load->view('front/shop/shop-details',$data);
        $this->load->view('front/template/footer',$data);
    }
    
    public function product_search(){
        $currLanguage = $this->session->userdata('site_lang');
        $suffix= '';
        if ($currLanguage == 'ar') {
            $suffix= '_'.$currLanguage;
        }
        
        $postData = $this->input->get();
        $sort = array(array('field'=>'id','type'=>'DESC'));
        if(!empty($postData['key']) && !empty($postData['value'])){
            $sort = array(array('field'=>$postData['key'],'type'=>$postData['value']));
        }
        $str = '';
        $search_text1 = utf8_decode($postData['term']);
        $search_text = $postData['term'];
        if($postData['term']){ 
            $str .= " AND (  LOWER(product_name) LIKE '%".$search_text1."%')"; 
        }
        
        $sort1 = ' order by id DESC';
        if(!empty($postData['orderby'])){
            $a = explode('=', $postData['orderby']);
            $sort1 = ' order by '.$a[0].' '.$a[1];
        }
        $condition = ' where  status = 1 '.$str.$sort1;
        
        $query = $this->common_model->get_all_details_query('products',$condition);
        //echo $this->db->last_query();
        
        $rows = $query->result_array();
        
        $result1 = array();
        foreach ($rows as $company) {
            $companyLabel['value'] = html_entity_decode($company["product_name".$suffix]);
            //$companyLabel['id'] = ($company[ "slug" ]);
            //$companyLabel['id'] = ($company[ "slug" ]);
            
            $row = $this->common_model->get_all_details('category',array('id'=>$company['cat_id']))->row_array();
            //$companyLabel['category_slug'] = $row['category_slug'];
            $companyLabel['id'] = ($row['slug'].'/'.$company[ "slug" ]);
           
            array_push( $result1, $companyLabel);
        }
        echo json_encode( $result1 );
    }
    public function cart(){

        $this->cartupdateAjax();
        $wh = ' WHERE user_id = "'.$this->session->userdata('session_user_id_temp').'"';
        $rs = $this->common_model->get_all_details_query('user_cart',$wh)->result();
        $data['cartArray'] = $rs;

        if($rs) {
            $str = '';
            $i=0;
            foreach($rs as $k=>$v){
                if($v->cart_type == 'service'){
                    if ($i>0) {
                        $str .= ' OR ';
                    }
                    $str .= ' service = "'.$v->product_id.'"';
                    $i++;
                }
            }
            $couponRow = array();
            if ($str) {
                $condition = '  WHERE status = 1 AND display_status = 1';  
                $condition .= '  AND ('.$str.')';
                $condition .= '  AND start_date <= "'.date('Y-m-d').'" AND end_date >= "'.date('Y-m-d').'"';
                $condition .= " order by id DESC";
                $query = $this->common_model->get_all_details_query('coupon',$condition);
                //echo $this->db->last_query();
                $couponRow = $query->result_array();

                foreach ($couponRow as $key => $value) {
                    $table = 'coupon';
                    $condition = '  WHERE status = 1 ';  
                    $condition .= '  AND id = "'.$value['service'].'"';
                    $condition .= " order by id DESC";
                    $query = $this->common_model->get_all_details_query('our_services',$condition);
                    //echo $this->db->last_query();
                    $r = $query->row_array();
                    $couponRow[$key]['services'] = $r;
                }

            }
            $data['couponRow'] = $couponRow; 


            if($this->session->userdata('userType')) {
                $data['user'] = $this->db->get_where('vender',['id'=> $this->session->userdata('userId')])->row(); 
            }else{
                $data['user'] = array(); 
            }
            
            $wh = ' WHERE user_id = "'.$this->session->userdata('session_user_id_temp').'"';
            $rs = $this->common_model->get_all_details_query('user_cart_session',$wh)->row_array();
            $data['user_cart_session'] = $rs;
            
            $data['seoData'] = array();
            $list = $this->db->query('select * from cms_pages where slug = "cart" and status=1')->row();
            if($list) {
                $data['seoData'] = $list;
            }

            $this->load->view('front/template/header',$data);
            $this->load->view('front/shop/cart',$data);
            $this->load->view('front/template/footer',$data);

        } else {

            redirect();

        }

    }
    public function cartUpdate(){

        $rowid = $this->input->post('rowid');
        $price = $this->input->post('price');
        $mrpprice = $this->input->post('mrpprice');
        if(!$mrpprice){
           $mrpprice = $price; 
        }
        $qty = $this->input->post('qty');
        $data = array( 'rowid' => $rowid, 'price' => $price, 'qty' => $qty );
        //$this->cart->update($data);
        //echo $this->db->last_query();
        
        
        $discount_total = $mrpprice-$price;
        $data = array(
            'discount_total' => $discount_total * $qty,
            'mrp_price_total' => $mrpprice * $qty,
            'sale_price' => $price,
            'price' => $price,
            'quantity' => $qty,
            'total' => $qty * $price,
        );              
        $this->common_model->commonUpdate('user_cart',$data,array('id'=>$rowid));
        //echo $this->db->last_query();
        echo true; 
    }
    public function cartupdateAjax(){
        $user_id = $this->session->userdata('session_user_id_temp');
        $postData['user_id'] = $user_id;
         
        $cartArray = $this->common_model->get_all_details('user_cart',array('user_id'=>$user_id,'in_stock'=>1))->result_array();
        $bag_total= 0;
        $bag_mrp_price_total= 0;
        $totalcount= 0;
        $coupon_id = 0;
        $coupon_code = '';
        $coupon_value = '';
        $coupon_price = 0;
        $discount_total = 0;
        $redeem_point = 0;
        $redeem_record = '';
        foreach($cartArray as $key=>$value){
            if($value['in_stock']){
                $totalcount += $value['quantity'];
                $bag_total += $value['total'];
                $discount_total += $value['discount_total'];
                $bag_mrp_price_total += $value['mrp_price_total'];
            }
        }
        $this->data['totalcount'] = $totalcount;
         
        
        
        $shipping_total = 0;

        $display_total = $shipping_total + $bag_total;
        $display_mrp_price_total = $shipping_total + $bag_mrp_price_total;

        $cart_record = array();
        
        $cart_record['bag_total'] = numberFormat($bag_total);
        $cart_record['discount_total'] = numberFormat($discount_total);
        $cart_record['sub_total'] = numberFormat($bag_total);
        $cart_record['bag_mrp_price_total'] = numberFormat($bag_mrp_price_total);
        $cart_record['display_bag_total'] = numberFormat($bag_total);
        $cart_record['display_discount_total'] = numberFormat($discount_total);
        $cart_record['display_sub_total'] = numberFormat($bag_total);
        $cart_record['display_bag_mrp_price_total'] = numberFormat($bag_mrp_price_total);
        $cart_record['shipping_total'] = numberFormat($shipping_total);
        $cart_record['total'] = numberFormat($display_total);
        $cart_record['mrp_price_total'] = numberFormat($display_mrp_price_total);
        $cart_record['display_shipping_total'] = numberFormat($shipping_total);
        $cart_record['display_total'] = numberFormat($display_total);
        $cart_record['display_mrp_price_total'] = numberFormat($display_mrp_price_total);
        
        $sess_array = array();
        $sess_array['user_id'] = $user_id;
        $sess_array['cart_record'] = json_encode($cart_record);
        $sess_array['coupon_id'] = $coupon_id;
        $sess_array['coupon_code'] = $coupon_code;
        $sess_array['coupon_value'] = $coupon_value;
        $sess_array['coupon_price'] = numberFormat($coupon_price);
        $sess_array['redeem_point'] = $redeem_point;
        $sess_array['redeem_record'] = $redeem_record;
        $sess_array['created_at'] = date('Y-m-d h:i:s');
        

        $conSession = array('user_id'=>$user_id);
        $sessionRow = $this->common_model->get_all_details('user_cart_session',$conSession);
        //echo $this->db->last_query();
        $num_rows = $sessionRow->num_rows();
        if ($num_rows) {
            $this->common_model->commonDelete('user_cart_session',$conSession);
            $this->common_model->simple_insert('user_cart_session',$sess_array);
        }else {
            $this->common_model->simple_insert('user_cart_session',$sess_array);
            //echo $this->db->last_query();
        }
    }
    public function checkout(){  
        $postData = $this->input->post();
        $data['lastPage'] = base_url('checkout');
        $cart = $this->cart->contents();

        $wh = ' WHERE user_id = "'.$this->session->userdata('session_user_id_temp').'"';
        $rs = $this->common_model->get_all_details_query('user_cart',$wh)->result();
        $data['cartArray'] = $rs;
        
        if($this->session->userdata('userType')) {
            $user = $this->db->get_where('vender',['id'=> $this->session->userdata('userId')])->row(); 
            $data['user'] = $user; 
            if ($user->current_address_id) {
                $user = $this->db->get_where('user_shipping_address',['id'=> $user->current_address_id])->row(); 
                $data['user_shipping_address'] = $user; 
            }else{
                $data['user_shipping_address'] = $user; 
            }
        }
        $data['callback_url']       = base_url().'razorpay/userOrder';
        $data['surl']               = base_url().'razorpay/success';;
        $data['furl']               = base_url().'razorpay/failed';;
        $data['currency_code']      = 'INR';
        
        $wh = ' WHERE user_id = "'.$this->session->userdata('session_user_id_temp').'"';
        $rs = $this->common_model->get_all_details_query('user_cart_session',$wh)->row_array();
        $data['user_cart_session'] = $rs;

        $data['seoData'] = array();
        $list = $this->db->query('select * from cms_pages where slug = "checkout" and status=1')->row();
        if($list) {
            $data['seoData'] = $list;
        }
         
        $data['country'] = $this->db->get('countries')->result();
        $data['states'] = $this->db->get_where('states',['country_id'=> 101 ])->result();
        $this->load->view('front/template/header',$data);
        $this->load->view('front/shop/checkout',$data);
        $this->load->view('front/template/footer',$data);
    }
    public function cartRemove(){
        $row_id = $this->input->post('row_id');
        $data = array( 'rowid'  => $row_id,  'qty'  => 0  );
        $this->cart->update($data);

        $postData = $this->input->post();
        $this->common_model->commonDelete('user_cart',array('id'=>$row_id));


        echo true;
    }
    public function cartProcess(){
        $id = $this->input->post('id');
        $product_id = $this->input->post('product_id');
        $price = $this->input->post('price');
        $name = $this->input->post('name');
        $qty  = $this->input->post('qty');
        $image = $this->input->post('image');
        $catId = $this->input->post('catId');
        $discount = ($this->input->post('discount'))?$this->input->post('discount'):0;
        $discountPrice = ($this->input->post('discountPrice'))?(int)$this->input->post('discountPrice'):0;
        $venderId = $this->input->post('venderId');
        $size = $this->input->post('size');
        $color = $this->input->post('color');
        $mrpprice = $this->input->post('mrpprice');

        $data = array(
            'user_id' => $user_id,
            'product_id' => $id,
            'size' => $size,
            'color' => $color);

        $cartRow = $this->common_model->get_all_details('user_cart',$data)->row();
        if ($cartRow) {
            $qty = $qty + (int)$cartRow->quantity;
        }
        $data = array(
            'id' => $id,
            'name' => $name,
            'mrpprice' => $mrpprice,
            'price' => $price,
            'discount' => $discount,
            'discountPrice' => $discountPrice,
            'qty' => $qty,
            'options' => array (
            'image' => $image, 'catId' => $catId,'discount'=>$discount,'discountPrice' => $discountPrice,'mrpprice' => $mrpprice,'venderId'=>$venderId,'size' =>$size,'color' =>$color) 
        );
        $user_id = $this->session->userdata('session_user_id_temp');
        $optionArray = array (
            'image' => $image, 'catId' => $catId,'discount'=>$discount,'discountPrice' => $discountPrice,'mrpprice' => $mrpprice,'venderId'=>$venderId,'size' =>$size,'color' =>$color);
        $data = array(
            'user_id' => $user_id,
            'product_image' => $image,
            'product_id' => $id,
            'name' => $name,
            'size' => $size,
            'color' => $color,
            'mrp_price' => $mrpprice,
            'sale_price' => $price,
            'price' => $price,
            'discount' => $discount,
            'discount_price' => $discountPrice,
            'quantity' => $qty,
            'created_at' => date('Y-m-d h:i:s'),
            'total' => $qty * $price,
            'mrp_price_total' => $qty * $mrpprice,
            'discount_total' => $qty * $discountPrice,
            'options' => json_encode($optionArray),
        );              
        $this->common_model->simple_insert('user_cart',$data);
        $uID = $this->session->userdata('session_user_id_temp');
        $c['user_id'] = $uID;
        $cartRows = $this->common_model->get_all_details_field('*','user_cart',$c)->result();
        $cart_qty = 0;
        $cart_price = 0;
        foreach ($cartRows as $key => $value) {
            if($value->in_stock){
                $cart_price += $value->total;
                $cart_qty += $value->quantity;
            }
        }
        if(!empty($cartRows)) {
            $img =  'assets/images/no-image.jpg'; 
            if(!empty($image))  { 
                $img1 =  'assets/images/product/'.$image; 
                if (file_exists($img1)) {
                    $img = $img1;
                }
            }  

            $msg = ['success'=>true, 'rowCount'=> $cart_qty ,'src'=> base_url($img)];

        }  else {

           $msg = ['error'=>true, 'message'=> 'something went wrong' ];     

        }
        echo json_encode($msg);

    }
    public function product_review(){
        $postData = $this->input->post();
        $id =  $postData['id'];
        $name =  $postData['name'];
        $email =  $postData['email'];
        $comment =  $postData['comment'];
        $rating =  $postData['rating'];
        $curlPost['product_id'] = $id;
        $curlPost['email'] = $email;
        $reviewRow = $this->db->query("select * from product_review where product_id =  '".$id."' and email =  '".$email."'")->row();

        if ($reviewRow) {
            $msg = 'You have aready given rating';
        }else{
            $curlPost['from_user_id'] = $this->session->userdata('userId');
            $curlPost['name'] = $name;
            $curlPost['comment'] = $comment;
            $curlPost['rating'] = $rating;
            $curlPost['created_at'] = date('Y-m-d h:i:s');
            $this->db->insert('product_review',$curlPost);
            $msg = 'Thanks you for given feedback!';
        }
        echo $msg;
    }
}
?>