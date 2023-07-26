<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vender extends MY_Controller {
	
	function __construct()
	{
        parent::__construct();
        $this->load->library('session');
        $this->load->model('admin/Dashboard_Model');
        $this->load->model('Common_model');
        $this->logged_in();
    }
	private function logged_in()
	{
        if (!$this->session->userdata('authenticated')) {
            redirect('stylebuddy-admin');
        }
	} 
	public function venderDetails() 
	{   $this->getPermission('admin/register-vendors');
        $url1 = $this->uri->segment(1);
        $url2 = $this->uri->segment(2);
        $url3 = $this->uri->segment(3);
        $data['country'] = $this->db->order_by('name', 'asc')->get('countries')->result();
        $data['states'] =  array();
        $data['cities'] = array();
        
        if ($this->input->get('country')) {
            $data['states'] = $this->db->order_by('name', 'asc')->get_where('states',['country_id'=> $this->input->get('country')])->result();
        }
        if ($this->input->get('state')) {
            $data['cities'] = $this->db->order_by('name', 'asc')->get_where('cities',['state_id'=> $this->input->get('state')])->result();
        }

        
        $tbl_name = 'vender';
        $condition = " WHERE user_type = '2' ";
        
        if($_GET['search_text'] && !empty($_GET['search_text'])){
            $condition .= ' AND (email like "%'.$_GET['search_text'].'%" OR fname like "%'.$_GET['search_text'].'%" OR mobile like "%'.$_GET['search_text'].'%") ';
        }
        if($this->input->get('status') == '0' || $this->input->get('status') == '1'){
            $condition .= ' AND status = '.$_GET['status'];
        }
        if($this->input->get('profile_update_ratio')){
            $condition .= ' AND profile_update_ratio = '.$this->input->get('profile_update_ratio');
        }
        if($this->input->get('experience')){
            $condition .= ' AND experience = '.$this->input->get('experience');
        }
        if($this->input->get('gender')){
            $condition .= ' AND gender = '.$this->input->get('gender');
        }
        if($this->input->get('country')){
            $condition .= ' AND country = '.$this->input->get('country');
        }
        if($this->input->get('state')){
            $condition .= ' AND state = '.$this->input->get('state');
        }
        if($this->input->get('city')){
            $condition .= ' AND city = '.$this->input->get('city');
        }
        if(!empty($this->input->get('expertise'))){
            $i=0;
            $str = '';
            foreach ($this->input->get('expertise') as $key => $value) {
                if ($value) {
                    if ($i>0) {
                        $str .= ' OR ';
                    }
                    $str .= ' FIND_IN_SET("'.trim($value).'",expertise)';
                }
            }
            if ($str) {
                $condition .= ' AND ('.$str.')';
            }
        }
        $condition .= " order by id DESC";
        $query = $this->db->query('SELECT * FROM vender'.$condition);
        $numRows = $query->num_rows();

         
        $data['numRows'] = $numRows;
        
        $this->per_page = 15;
        $config = array();
        $config['total_rows'] = $numRows;
        $config['per_page'] = $this->per_page;
        $config['full_tag_open'] = '';
        $config['full_tag_close'] = '';
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['uri_segment'] = 3;
        $config['use_page_numbers'] = TRUE;
        $config["base_url"] = base_url().$url1.'/'.$url2.'/';
        $config['suffix'] = '?' . http_build_query($_GET, '', "&");
        $config['first_url']=base_url().$url1.'/'.$url2.'/?'.http_build_query($_GET, '', "&");
        $this->pagination->initialize($config);
        $links = $this->pagination->create_links();
        $start_from = $this->uri->segment($config['uri_segment']);
        if (!empty($start_from)) {
            $start = $config['per_page'] * ($start_from - 1);
        } else {
            $start = 0;
        }
        $limit['l1'] = $start;
        $limit['l2'] = $config["per_page"];

        
        
        $per_page = $config["per_page"];
        $rows = $this->db->query('SELECT * FROM vender'.$condition.' limit '.$start.' ,'.$per_page);
       // echo $this->db->last_query();
        $list = $rows->result();

        $data['links'] = $links;
        $data['start_limit'] = $limit['l1'];
        $end_limit = $limit['l2'] + $limit['l1'];
        if($numRows > $end_limit){
            $data['end_limit'] = $end_limit;
        }else{
            $data['end_limit'] = $numRows;
        }
        $data['title'] = 'Stylist List';
        $data['list_heading'] = 'Stylist List';
        $data['right_heading'] = 'Add';
        $data['datas'] =  $list;


        //var_dump($list);

	     //$data['datas'] = $query = $this->db->order_by('ID', 'DESC')->get('vender')->result();
	     $data['expertises'] = $this->Dashboard_Model->common_all('area_expertise');
         $this->load->view('admin/template/header');
         $this->load->view('admin/vender/view',$data);
         $this->load->view('admin/template/footer');   
	}
	public function vendorExport()
	{
        $filename = 'register_stylist_data_'.date('Y-m-d-H-i-s').'.csv'; 
        header("Content-Description: File Transfer"); 
        header("Content-Disposition: attachment; filename=$filename"); 
        header("Content-Type: application/csv; ");
        
        $tbl_name = 'vender';
        $condition = " WHERE user_type = '2' ";
        
        if($_GET['search_text'] && !empty($_GET['search_text'])){
            $condition .= ' AND (email like "%'.$_GET['search_text'].'%" OR fname like "%'.$_GET['search_text'].'%" OR mobile like "%'.$_GET['search_text'].'%") ';
        }
        if($this->input->get('status') == '0' || $this->input->get('status') == '1'){
            $condition .= ' AND status = '.$_GET['status'];
        }
        if(!empty($this->input->get('expertise'))){
            $i=0;
            $str = '';
            foreach ($this->input->get('expertise') as $key => $value) {
                if ($value) {
                    if ($i>0) {
                        $str .= ' OR ';
                    }
                    $str .= ' FIND_IN_SET("'.trim($value).'",expertise)';
                }
            }
            if ($str) {
                $condition .= ' AND ('.$str.')';
            }
        }
        $condition .= " order by id DESC";
        $query = $this->db->query('SELECT fname, lname, email, mobile,address,city_name,state_name,instagram_nlink,created_at FROM vender'.$condition);
        $usersData = $query->result_array();


        /*$this->db->select('fname, lname, email, mobile,address,created_at');
        $this->db->where('status',1);
        $usersData = $this->db->get('vender')->result_array();*/
       
        $file = fopen('php://output', 'w');
 
        $header = array("First Name","Last Name","Email","Mobile No","Address","City Name","State Name","Istagram Link","Date"); 
        fputcsv($file, $header);
        foreach ($usersData as $key=>$line){ 
            fputcsv($file,$line); 
        }
        fclose($file); 
        exit; 
	}
	public function venderDetail($id) {
	    
        $data['vender'] = $this->db->get_where('vender',['id'=> $id ])->row();
        $stateId = $data['vender']->state;  
        $cityId = $data['vender']->city; 
        $expertiseID = $data['vender']->expertise; 
        $expertise = $this->db->get('area_expertise')->result();
        
        if(!empty($stateId)) {
            $data['state'] =  $this->db->get_where('states',['id'=> $stateId])->row();    
        } 
        if(!empty($cityId)) {
            $data['city'] =  $this->db->get_where('cities',['id'=> $cityId])->row();    
        }
        $values = '';
        if(!empty($expertiseID)) {
            $arrayVal = explode(',',$expertiseID);
            foreach($expertise as $expertises) {
                if( in_array($expertises->id , $arrayVal)) {  $values .= ", $expertises->name"; }
            }
        }
        $data['expertise'] = substr($values,1);
        $this->load->view('admin/vender/viewDetails',$data); 
	}
	public function venderProtfolio($id) {
        $data['datas'] = $this->db->get_where('ideas',['vender_id'=> $id ])->result();
        $data['tags'] = $this->db->get('idea_tag')->result();
        $this->load->view('admin/vender/viewIdea',$data);
	}
	public function display_statusUpdate()
	{
	    $id = $this->input->post('id');
	    $status = $this->input->post('display_status'); $data = ['display_status'=>$status];
	    $update = $this->Dashboard_Model->common_update($id,$data,'vender');
	    echo $update;   
	}
	public function venderStatusUpdate()
	{
	    $id = $this->input->post('id');
	    $status = $this->input->post('status');
	    $data = array();
	    $data['status'] = $status;
	    //if($status){
	        $data['email_verification'] = 1;
	    //}
	    
	    $update = $this->Dashboard_Model->common_update($id,$data,'vender');
	    echo $update;   
	}
    public function allProducts(){
        $segment1 = $this->uri->segment(1);
		$segment2 = $this->uri->segment(2);
		$segment3 = $this->uri->segment(3);
		$segment4 = $this->uri->segment(4);
		
        //$data['expertises'] = $this->Dashboard_Model->common_all('products');
        
        /*$this->db->select('products.*,vender.fname,vender.lname,category.name as category_name,category.slug as category_slug');
        $this->db->from('products');
        $this->db->join('vender', 'vender.id = products.vender_id');
        $this->db->join('category', 'category.id = products.cat_id');
        $this->db->order_by('products.id', 'DESC');
        $data['list'] = $this->db->get()->result();
        echo $this->db->last_query();
        die;*/
         
		$str = " SELECT `products`.*, `vender`.`fname`, `vender`.`lname`, `category`.`name` as `category_name`, `category`.`slug` as `category_slug` FROM `products` JOIN `vender` ON `vender`.`id` = `products`.`vender_id` JOIN `category` ON `category`.`id` = `products`.`cat_id` ORDER BY `products`.`id` DESC";
	    $list 	=  $this->db->query($str);
		$numRows =  $list->num_rows();
		$data['numRows'] = $numRows;
		$this->load->library('pagination');
		$config = array();
		$config['total_rows'] = $numRows;
		$config['per_page'] = 50;
		$config['full_tag_open'] = '';
		$config['full_tag_close'] = '';
        $config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['uri_segment'] = 4;
		$config['use_page_numbers'] = TRUE;
		$config["base_url"] = base_url().$segment1.'/'.$segment2.'/index';
		$config['suffix'] = '?' . http_build_query($_GET, '', "&");
		$config['first_url']=base_url().$segment1.'/'.$segment2.'/index/?'.http_build_query($_GET, '', "&");
		$this->pagination->initialize($config);
		$links = $this->pagination->create_links();
		$start_from = $this->uri->segment($config['uri_segment']);
		if (!empty($start_from)) {
            $start = $config['per_page'] * ($start_from - 1);
        } else {
            $start = 0;
        }
         
        $limit['l1'] = $start;
		$limit['l2'] = $config["per_page"];
		$str .= ' LIMIT '.$start.' ,'.$config["per_page"];
        $query 	=  $this->db->query($str);
        $this->db->last_query(); 
		$post_list = $query->result();
		
		$data['links'] = $links;
		$data['start_limit'] = $limit['l1'];
		$end_limit = $limit['l2'] + $limit['l1'];
		if($numRows > $end_limit){
			$data['end_limit'] = $end_limit;
		}else{
			$data['end_limit'] = $numRows;
			
		}
		$data['list'] = $post_list;
		
        
        $data['sizes'] = $this->db->get_where('product_size',['status'=>1])->result();
        $this->load->view('admin/vender/allProducts',$data);
    }
    
    public function allProductsExcel(){
        /*ini_set('display_startup_errors',1);
        ini_set('display_errors',1);
        error_reporting(E_ALL);*/
        $data['expertises'] = $this->Dashboard_Model->common_all('products');
        $this->db->select('products.*,vender.fname,vender.lname,category.name as category_name,category.slug as category_slug');
        $this->db->from('products');
        $this->db->join('vender', 'vender.id = products.vender_id');
        $this->db->join('category', 'category.id = products.cat_id');
        $this->db->order_by('products.id', 'ASC');
        $data['list'] = $listInfo = $this->db->get()->result();
        $data['sizes'] =   $sizes = $this->db->get_where('product_size',['status'=>1])->result();
        
		
        
        $fileName = 'data-'.time().'.xlsx';  
        // load excel library
        $this->load->library('excel');
         
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'id');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'title');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'description');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'link');       
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'image_link');       
        //$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'additional_image_link');       
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'availability');       
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'price');       
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'sale_price');       
        /*$objPHPExcel->getActiveSheet()->SetCellValue('J1', 'google_product_category');       
        $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'product_type');       
        $objPHPExcel->getActiveSheet()->SetCellValue('L1', 'brand');       
        $objPHPExcel->getActiveSheet()->SetCellValue('M1', 'age_group');       
        $objPHPExcel->getActiveSheet()->SetCellValue('N1', 'color'); */      
        
        $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'gender');       
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'size');       
        
        $c = 0;
        foreach ($listInfo as $list) {
            $imgUrls = '';
			$gallary = $this->db->get_where('product_galary',['product_id'=> $list->id ])->num_rows();
			if($c<$gallary){
			    $c=$gallary;   
			}
        }
        for($i=0;$i<$c;$i++){
            $ss = 75+$i;
            $objPHPExcel->getActiveSheet()->SetCellValue(chr($ss).'1', 'additional_image_link');      
        }
        //echo $c;
        //echo $this->db->last_query();die;
        $rowCount = 2;
        $product_order = 0;
        //var_dump($listInfo[0]);die;
        foreach ($listInfo as $list) {
            
            //$catRow = $this->db->get_where('category',['id'=> $list->cate_id ])->row();
            
            $product_order++;
            
            if(strlen($product_order) == 1){
				$serial_number1 = '000'.$product_order;
			}else if(strlen($product_order) == 2){
				$serial_number1 = '00'.$product_order;
			}else if(strlen($product_order) == 3){
				$serial_number1 = '0'.$product_order;
			}else{
				$serial_number1 = $product_order;
			}
			
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, 'SKU'.$serial_number1.$product_order);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $list->product_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, preg_replace('/[^A-Za-z0-9\-]/', ' ', html_entity_decode(strip_tags($list->description),ENT_QUOTES)));
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, base_url('shop/'.$list->category_slug.'/'.$list->slug));
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, base_url('/assets/images/product/'.$list->image));		        
			/*$imgUrls = '';
			$gallary = $this->db->get_where('product_galary',['product_id'=> $list->id ])->result();
			if(!empty($gallary)) { 
			    foreach($gallary as $gallari) {
			        	$imgUrls .= ','.base_url('assets/images/gallery/').$gallari->gallery_image;
			    }
			}
			$objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, trim($imgUrls,','));	*/	 
			
			$gallary = $this->db->get_where('product_galary',['product_id'=> $list->id ])->result();
			if(!empty($gallary)) { 
			    for($i=0;$i<$c;$i++){
			        $imgUrls = base_url('assets/images/gallery/').$gallary[$i]->gallery_image;
			        $ss = 75+$i;
			        if($gallary[$i]->gallery_image){
			            $objPHPExcel->getActiveSheet()->SetCellValue(chr($ss) . $rowCount, trim($imgUrls,','));
			        }else{
			           $objPHPExcel->getActiveSheet()->SetCellValue(chr($ss) . $rowCount, '');
			        }
			    }
			}
			$objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, 'in_stock');
            
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, number_format($list->price,2).' INR');
            $discount = '0'; 
			$discountAmt = '0'; 
			$saleAmt = $list->price; 
			if($list->discount) {
			 	$discount = ($list->discount / 100) * $list->price; 
			 	$discountAmt = ($list->discount / 100) * $list->price; 
			 	$saleAmt = round($list->price - $discount); 
			} 
			
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, number_format($saleAmt,2).' INR');
            /*$objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $list->category_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, 'Product');
            $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, '');
            $objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, '');
            $objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, '');*/
            
            if($list->gender == 1){
                $ab = 'MALE';
            }else if($list->gender == 2){
                $ab = 'FEMALE';
            }else{
                $ab = 'UNISEX';
            }
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $ab);
            
            $values = ""; $arrayVal = explode(',',$list->size); 
            foreach ($sizes as $size) { 
			    if( in_array($size->id , $arrayVal)) {  
			        $values .= ", $size->size_name"; 
			        //$values = $size->size_name; 
			    } 
			}
			$arrayVal = explode(',',substr($values,1)); 
			//$objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, substr($values,1));		        
		    $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $arrayVal[0]);		        
		    
            
            $rowCount++;
        }
       /* $filename = "stylebuddy-product-". date("Y-m-d-H-i-s").".csv";
        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0'); 
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');  
        $objWriter->save('php://output'); */
        
        $filename = "stylebuddy-product-2022.csv";
        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0'); 
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');  
        

        $objWriter->save(FCPATH.$filename);
        $objWriter->save ( getcwd ().'/'.$filename);
        $objWriter->save('php://output'); 
        
        die;
        
       // $this->load->view('admin/vender/allProducts',$data);
    }
    
    
    
    public function productStatusUpdate()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status'); $data = ['admin_status'=>$status];
        $update = $this->Dashboard_Model->common_update($id,$data,'products');
        echo $update;   
    }
    public function service_orders()
    {
        $this->db->select ( '*'); 
        $this->db->from ( 'services_booking' );
        $this->db->order_by("id", "DESC");
        $data['val'] = $this->db->get()->result();

        //$data['val'] = $this->Dashboard_Model->common_all('user_order');
        $this->load->view('admin/template/header');
        $this->load->view('admin/order/order-service',$data);
        $this->load->view('admin/template/footer'); 
    }
    public function userOrderExport(){
        $filename = 'user_order_data_'.date('Y-m-d-H-i-s').'.csv'; 
         
        header("Content-Description: File Transfer"); 
        header("Content-Disposition: attachment; filename=$filename"); 
        header("Content-Type: application/csv; ");
        
        $this->db->select ( '*'); 
        $this->db->from ( 'user_order' );
        $this->db->order_by("id", "DESC");
        $usersData = $this->db->get()->result();

        $file = fopen('php://output', 'w');
        $header = array("Order id","Name","Email","Sub Total","Date","Coupon Code","Coupon Price","Qty","Price","Total Price","Name"); 
        fputcsv($file, $header);
        foreach ($usersData as $k=>$v){ 
            $date = strtotime($v->created_at); 
            $fdate = date('d M, Y',$date);

            

            $id = $v->id;
            $this->db->select ( 'user_order.*, user_order_details.*'); 
            $this->db->from ( 'user_order' );
            $this->db->join ( 'user_order_details','user_order_details.invoiceNo = user_order.id');
            $this->db->order_by("user_order_details.id", "DESC");
            $this->db->where ( 'user_order_details.orderId',$id);
            $user_order_details = $this->db->get()->result();
            $i=0;
            foreach ($user_order_details as $key => $value) {
                 
                $line = array();
                if ($i==0) {
                    $line['order_id'] = $v->order_id;
                    $line['name'] = ucfirst($v->fname.' '.$v->lname);
                    $line['email'] = $v->user_email;
                    $line['total_price'] = number_format($v->total_price);
                    $line['date'] = $fdate ;
                    $line['coupon_code'] = $v->coupon_code ;
                    $line['coupon_price'] = ($v->coupon_value)?$v->coupon_value:'' ;
                }else{
                    $line['order_id'] = '';
                    $line['name'] = '';
                    $line['email'] = '';
                    $line['total_price'] = '';
                    $line['date'] = '' ;
                    $line['coupon_code'] = '' ;
                    $line['coupon_price'] = '' ;
                }
                $line['qty'] = $value->productQty ;
                $line['product_price'] = $value->productPrice;
                $line['p_qty'] = $value->productPrice * $value->productQty ;
                $line['product_name'] = $value->productName;
                fputcsv($file,$line); 
                $i++;
            } 
            
            $line = array();
            $line['order_id'] = '';
            $line['name'] = '';
            $line['email'] = '';
            $line['total_price'] = '';
            $line['date'] = '' ;
            $line['coupon_code'] = '' ;
            $line['coupon_price'] = '' ;
            
            $line['qty'] = '';
            $line['product_price'] = '';
            $line['p_qty'] = '';
            $line['product_name'] = '';
            fputcsv($file,$line); 
        }
        fclose($file); 
        exit; 
    }
     
    public function userOrder()
    {   $this->getPermission('admin/user-order');
        /*$this->db->select ( '*'); 
        $this->db->from ( 'user_order' );
        $this->db->order_by("id", "DESC");
        $data['val'] = $this->db->get()->result();*/
        $str = " WHERE UPPER(order_status) != 'UNFINISHED ORDER' ORDER BY id desc";
        $query = $this->common_model->get_all_details_query('user_order',$str);
        $data['val'] = $query->result();
        
        //$data['val'] = $this->Dashboard_Model->common_all('user_order');
        $this->load->view('admin/template/header');
        $this->load->view('admin/order/order',$data);
        $this->load->view('admin/template/footer'); 
    }
    public function userOrderDetails($id){
        if(!empty($this->input->post('payment_status'))){
            $status = trim($this->input->post('payment_status'));
            $this->db->where ( 'id',$id);
            $this->db->update('user_order',['payment_status'=> $status]);
            
            $this->db->where ( 'orderId',$id);
            $this->db->update('user_order_details',['payment_status'=> $status]);
        }

        $order = $this->db->get_where('user_order',['id'=> $id])->row();
        if(!empty($this->input->post('order_status'))){
            $status = trim($this->input->post('order_status'));
            if ($status == 'Delivered') {
                if ($order->payment_status == 'APPROVED') {
                    $this->db->where ( 'id',$id);
                    $this->db->update('user_order',['order_status'=> $status]);
                    
                    $this->db->where ( 'orderId',$id);
                    $this->db->update('user_order_details',['order_status'=> $status]);
                }else{
                    $this->session->set_flashdata('success','<span class="text-dander bg-info p-2">Please complete payment status first</span><br/><br/>');
                    redirect(base_url('admin/user-order-details/'.$id));
                }
                
            }else{
                $this->session->set_flashdata('success','<span class="text-dander bg-info p-2">Please status updated  successfully</span><br/><br/>');
                $this->db->update('user_order',['order_status'=> $status]);
            }
        }

        $data['order'] = $this->db->get_where('user_order',['id'=> $id])->row();
        
        $this->db->select ( 'user_order.*, user_order_details.*'); 
        //$this->db->select ( 'user_order.*, user_order_details.*,vender.fname,vender.lname'); 
        $this->db->from ( 'user_order' );
        $this->db->join ( 'user_order_details','user_order_details.invoiceNo = user_order.id');
        //$this->db->join ( 'vender','vender.id = user_order_details.venderId');
        $this->db->order_by("user_order_details.id", "DESC");
        $this->db->where ( 'user_order_details.orderId',$id);
        $user_order_details = $this->db->get()->result();
        foreach ($user_order_details as $key => $value) {
            $venderRow = $this->db->get_where('vender',['id'=> $value->venderId])->row();
            $user_order_details[$key]->fname = $venderRow->fname;
            $user_order_details[$key]->lname = $venderRow->lname;
        }
        $data['val'] = $user_order_details;
 

        $this->db->select ( '*'); 
        $this->db->from ( 'payment_status' );
        //$this->db->order_by("id", "DESC");
        $data['payment_status_list'] = $this->db->get()->result();


        $this->db->select ( '*'); 
        $this->db->from ( 'order_status' );
        //$this->db->order_by("id", "DESC");
        $data['status_list'] = $this->db->get()->result();



         $this->load->view('admin/template/header');
         $this->load->view('admin/order/order_details',$data);
         $this->load->view('admin/template/footer'); 
 
    }
	public function blogs()
	{
           $this->db->select('blog.*, vender.fname,vender.lname'); 
           $this->db->from('blog');
           $this->db->join('vender', 'vender.id = blog.vender_id');
           $this->db->where(['blog.status'=>1]);
           $data['datas']  = $this->db->get()->result();
        
          $this->load->view('admin/template/header');
          $this->load->view('admin/vender/allBlogs',$data);
          $this->load->view('admin/template/footer'); 
	} 
	public function registerUser(){
        $url1 = $this->uri->segment(1); 
        $url2 = $this->uri->segment(2);
        $url3 = $this->uri->segment(3);

		$condition = " WHERE user_type = 3 order by id desc ";
        $r = $this->common_model->get_all_details_query('vender',$condition)->result();
        $all['datas'] = $r;

        $tbl_name = 'vender';
        $condition = " WHERE user_type = '3' ";
        
        if($_GET['search_text'] && !empty($_GET['search_text'])){
            $condition .= ' AND (email like "%'.$_GET['search_text'].'%" OR fname like "%'.$_GET['search_text'].'%" OR mobile like "%'.$_GET['search_text'].'%") ';
        }
        if($this->input->get('status') == '0' || $this->input->get('status') == '1'){
            $condition .= ' AND status = '.$_GET['status'];
        }
         
        if($this->input->get('country')){
            $condition .= ' AND country = '.$this->input->get('country');
        }
        if($this->input->get('state')){
            $condition .= ' AND state = '.$this->input->get('state');
        }
        if($this->input->get('city')){
            $condition .= ' AND city = '.$this->input->get('city');
        }
        if($this->input->get('referral')){
            $condition .= ' AND referral_id = '.$this->input->get('referral');
        }
         
        $condition .= " order by id DESC";
        $query = $this->db->query('SELECT * FROM vender'.$condition);
        $numRows = $query->num_rows();

         
        $data['numRows'] = $numRows;
        
        $this->per_page = 50;
        $config = array();
        $config['total_rows'] = $numRows;
        $config['per_page'] = $this->per_page;
        $config['full_tag_open'] = '';
        $config['full_tag_close'] = '';
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['uri_segment'] = 3;
        $config['use_page_numbers'] = TRUE;
        $config["base_url"] = base_url().$url1.'/'.$url2.'/';
        $config['suffix'] = '?' . http_build_query($_GET, '', "&");
        $config['first_url']=base_url().$url1.'/'.$url2.'/?'.http_build_query($_GET, '', "&");
        $this->pagination->initialize($config);
        $links = $this->pagination->create_links();
        $start_from = $this->uri->segment($config['uri_segment']);
        if (!empty($start_from)) {
            $start = $config['per_page'] * ($start_from - 1);
        } else {
            $start = 0;
        }
        $limit['l1'] = $start;
        $limit['l2'] = $config["per_page"];

        
        
        $per_page = $config["per_page"];
        $rows = $this->db->query('SELECT * FROM vender'.$condition.' limit '.$start.' ,'.$per_page);
       // echo $this->db->last_query();
        $list = $rows->result();

        $data['links'] = $links;
        $data['start_limit'] = $limit['l1'];
        $end_limit = $limit['l2'] + $limit['l1'];
        if($numRows > $end_limit){
            $data['end_limit'] = $end_limit;
        }else{
            $data['end_limit'] = $numRows;
        }
        $data['title'] = 'Stylist List';
        $data['list_heading'] = 'Stylist List';
        $data['right_heading'] = 'Add';
        $data['datas'] =  $list;

        $data['referral'] = $this->common_model->get_all_details('referral',array())->result_array();

        


	    $this->load->view('admin/template/header');
        $this->load->view('admin/page/registeruser',$data);
        $this->load->view('admin/template/footer');
	}
	public function registerUser____(){
        $url1 = $this->uri->segment(1); 
        $url2 = $this->uri->segment(2);
        $url3 = $this->uri->segment(3);

		$condition = " WHERE user_type = 3 order by id desc ";
        $r = $this->common_model->get_all_details_query('vender',$condition)->result();
        $all['datas'] = $r;

        $tbl_name = 'vender';
        $condition = " WHERE user_type = '3' ";
        
        if($_GET['search_text'] && !empty($_GET['search_text'])){
            $condition .= ' AND (email like "%'.$_GET['search_text'].'%" OR fname like "%'.$_GET['search_text'].'%" OR mobile like "%'.$_GET['search_text'].'%") ';
        }
        if($this->input->get('status') == '0' || $this->input->get('status') == '1'){
            $condition .= ' AND status = '.$_GET['status'];
        }
         
        if($this->input->get('country')){
            $condition .= ' AND country = '.$this->input->get('country');
        }
        if($this->input->get('state')){
            $condition .= ' AND state = '.$this->input->get('state');
        }
        if($this->input->get('city')){
            $condition .= ' AND city = '.$this->input->get('city');
        }
         
        $condition .= " order by id DESC";
        $query = $this->db->query('SELECT * FROM vender'.$condition);
        $numRows = $query->num_rows();

         
        $data['numRows'] = $numRows;
        
        $this->per_page = 50;
        $config = array();
        $config['total_rows'] = $numRows;
        $config['per_page'] = $this->per_page;
        $config['full_tag_open'] = '';
        $config['full_tag_close'] = '';
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['uri_segment'] = 3;
        $config['use_page_numbers'] = TRUE;
        $config["base_url"] = base_url().$url1.'/'.$url2.'/';
        $config['suffix'] = '?' . http_build_query($_GET, '', "&");
        $config['first_url']=base_url().$url1.'/'.$url2.'/?'.http_build_query($_GET, '', "&");
        $this->pagination->initialize($config);
        $links = $this->pagination->create_links();
        $start_from = $this->uri->segment($config['uri_segment']);
        if (!empty($start_from)) {
            $start = $config['per_page'] * ($start_from - 1);
        } else {
            $start = 0;
        }
        $limit['l1'] = $start;
        $limit['l2'] = $config["per_page"];

        
        
        $per_page = $config["per_page"];
        $rows = $this->db->query('SELECT * FROM vender'.$condition.' limit '.$start.' ,'.$per_page);
       // echo $this->db->last_query();
        $list = $rows->result();

        $data['links'] = $links;
        $data['start_limit'] = $limit['l1'];
        $end_limit = $limit['l2'] + $limit['l1'];
        if($numRows > $end_limit){
            $data['end_limit'] = $end_limit;
        }else{
            $data['end_limit'] = $numRows;
        }
        $data['title'] = 'Stylist List';
        $data['list_heading'] = 'Stylist List';
        $data['right_heading'] = 'Add';
        $data['datas'] =  $list;

	    $this->load->view('admin/template/header');
        $this->load->view('admin/page/registeruser',$data);
        $this->load->view('admin/template/footer');
	}
	public function userStatusUpdate()
    {
        $id = $this->input->post('id');
	    $status = $this->input->post('status'); $data = ['status'=>$status];
	    $update = $this->Dashboard_Model->common_update($id,$data,'vender');
	    echo $update;
    }
    public function userDelete(){ 
	    $id = $this->input->post('id');
	        $delete = $this->common_model->commonDelete('vender',array('id'=>$id));
	        //$delete = $this->Dashboard_Model->common_delete($id,'vender');
            if($delete) {
                $this->session->set_flashdata('success','Record deleted Successfully!!');
                //redirect('admin/register-user');
            } else {
                $this->session->set_flashdata('error','Something Went Wrong, try again!!');
                //redirect('admin/register-user');
            }
	}
	public function boutiqueUser(){
        $this->getPermission('admin/register-boutique');
		$condition = " WHERE user_type = 4 order by id desc ";
        $r = $this->common_model->get_all_details_query('vender',$condition)->result();
        $all['datas'] = $r;
	    $this->load->view('admin/template/header');
        $this->load->view('admin/page/registeruser-boutique',$all);
        $this->load->view('admin/template/footer');
	}
    public function postJobUser(){
        $this->getPermission('admin/register-postJobUser');
		$condition = " WHERE user_type = 5 order by id desc ";
        $r = $this->common_model->get_all_details_query('vender',$condition)->result();
        $all['datas'] = $r;
	    $this->load->view('admin/template/header');
        $this->load->view('admin/page/registeruser-postJob',$all);
        $this->load->view('admin/template/footer');
	}
	public function userExport(){
        $filename = 'register_user_data_'.date('Y-m-d-H-i-s').'.csv'; 
        header("Content-Description: File Transfer"); 
        header("Content-Disposition: attachment; filename=$filename"); 
        header("Content-Type: application/csv; ");
        
        $tbl_name = 'vender';
        $condition = " WHERE user_type = '3' ";
        
        if($_GET['search_text'] && !empty($_GET['search_text'])){
            $condition .= ' AND (email like "%'.$_GET['search_text'].'%" OR fname like "%'.$_GET['search_text'].'%" OR mobile like "%'.$_GET['search_text'].'%") ';
        }
        if($this->input->get('status') == '0' || $this->input->get('status') == '1'){
            $condition .= ' AND status = '.$_GET['status'];
        }
        if(!empty($this->input->get('expertise'))){
            $i=0;
            $str = '';
            foreach ($this->input->get('expertise') as $key => $value) {
                if ($value) {
                    if ($i>0) {
                        $str .= ' OR ';
                    }
                    $str .= ' FIND_IN_SET("'.trim($value).'",expertise)';
                }
            }
            if ($str) {
                $condition .= ' AND ('.$str.')';
            }
        }
        if($this->input->get('referral')){
            $condition .= ' AND referral_id = '.$this->input->get('referral');
        }
         
        $condition .= " order by id DESC";
        $query = $this->db->query('SELECT fname, email, mobile,created_at FROM vender'.$condition);
        $usersData = $query->result_array();
        $file = fopen('php://output', 'w');
        $header = array("Name","Email","Mobile No","Date"); 
        fputcsv($file, $header);
        foreach ($usersData as $key=>$line){ 
            fputcsv($file,$line); 
        }
        fclose($file); 
        exit; 
	}

    public function boutiqueExport(){
        $filename = 'register_boutique_'.date('Y-m-d-H-i-s').'.csv'; 
        header("Content-Description: File Transfer"); 
        header("Content-Disposition: attachment; filename=$filename"); 
        header("Content-Type: application/csv; ");
        
        $tbl_name = 'vender';
        $condition = " WHERE user_type = '4' ";
        
        if($_GET['search_text'] && !empty($_GET['search_text'])){
            $condition .= ' AND (email like "%'.$_GET['search_text'].'%" OR fname like "%'.$_GET['search_text'].'%" OR mobile like "%'.$_GET['search_text'].'%") ';
        }
        if($this->input->get('status') == '0' || $this->input->get('status') == '1'){
            $condition .= ' AND status = '.$_GET['status'];
        }
        if(!empty($this->input->get('expertise'))){
            $i=0;
            $str = '';
            foreach ($this->input->get('expertise') as $key => $value) {
                if ($value) {
                    if ($i>0) {
                        $str .= ' OR ';
                    }
                    $str .= ' FIND_IN_SET("'.trim($value).'",expertise)';
                }
            }
            if ($str) {
                $condition .= ' AND ('.$str.')';
            }
        }
        $condition .= " order by id DESC";
        $query = $this->db->query('SELECT fname, email, mobile,created_at FROM vender'.$condition);
        $usersData = $query->result_array();
        $file = fopen('php://output', 'w');
        $header = array("Name","Email","Mobile No","Date"); 
        fputcsv($file, $header);
        foreach ($usersData as $key=>$line){ 
            fputcsv($file,$line); 
        }
        fclose($file); 
        exit; 
	}
    public function postJobExport(){
        $filename = 'register_postJob_'.date('Y-m-d-H-i-s').'.csv'; 
        header("Content-Description: File Transfer"); 
        header("Content-Disposition: attachment; filename=$filename"); 
        header("Content-Type: application/csv; ");
        
        $tbl_name = 'vender';
        $condition = " WHERE user_type = '5' ";
        
        if($_GET['search_text'] && !empty($_GET['search_text'])){
            $condition .= ' AND (email like "%'.$_GET['search_text'].'%" OR fname like "%'.$_GET['search_text'].'%" OR mobile like "%'.$_GET['search_text'].'%") ';
        }
        if($this->input->get('status') == '0' || $this->input->get('status') == '1'){
            $condition .= ' AND status = '.$_GET['status'];
        }
        if(!empty($this->input->get('expertise'))){
            $i=0;
            $str = '';
            foreach ($this->input->get('expertise') as $key => $value) {
                if ($value) {
                    if ($i>0) {
                        $str .= ' OR ';
                    }
                    $str .= ' FIND_IN_SET("'.trim($value).'",expertise)';
                }
            }
            if ($str) {
                $condition .= ' AND ('.$str.')';
            }
        }
        $condition .= " order by id DESC";
        $query = $this->db->query('SELECT fname, email, mobile,created_at FROM vender'.$condition);
        $usersData = $query->result_array();
        $file = fopen('php://output', 'w');
        $header = array("Name","Email","Mobile No","Date"); 
        fputcsv($file, $header);
        foreach ($usersData as $key=>$line){ 
            fputcsv($file,$line); 
        }
        fclose($file); 
        exit; 
	}

}	