<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Allproducts extends MY_Controller {

    function __construct() {

        parent::__construct();

        $this->load->library('session');

        $this->load->model('admin/Dashboard_Model');

        $this->load->model('Common_model');

        $this->tbl_name = 'products';

         

	}

	public function index() {

        $this->getPermission('admin/allproducts');

	    $url1 = $this->uri->segment(1);



        $url2 = $this->uri->segment(2);



        $url3 = $this->uri->segment(3);



        $url4 = $this->uri->segment(4);



        



	     



        $str = " SELECT `products`.*, `vender`.`fname`, `vender`.`lname` FROM `products` JOIN `vender` ON `vender`.`id` = `products`.`vender_id` WHERE products.id!=0 ";

        if ($_GET['category']) {

            $str .= ' AND FIND_IN_SET("'.$_GET['category'].'",cat_id)';

        }

        if ($_GET['sub_category']) {

            $str .= ' AND FIND_IN_SET("'.$_GET['sub_category'].'",cat_id)';

        }

        

        

        $str .= "  ORDER BY `products`.`id` DESC";

        $query = $str;



	    $list 	=  $this->db->query($query);



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



		$config["base_url"] = base_url().$url1.'/'.$url2.'/index';



		$config['suffix'] = '?' . http_build_query($_GET, '', "&");



		$config['first_url']=base_url().$url1.'/'.$url2.'/index/?'.http_build_query($_GET, '', "&");



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

        foreach ($post_list as $key => $value) {

            $catArray = explode(',', $value->cat_id);

            $catString = '';

            $catStringSlug = '';

            $i=0;

            foreach ($catArray as $key1 => $value1) {

                if ($value1) {

                 

                    $d = $this->common_model->get_all_details_query('category','WHERE id='.$value1.'')->row_array();

                    if ($d) {

                        if ($i>0) {

                            $catString .= ',';

                            $catStringSlug .= ',';

                        }

                        $catString .= $d['name'];

                        $catStringSlug .= $d['slug'];

                        $i++;

                    }

                }

            }

            $post_list[$key]->category_name = $catString;

            $post_list[$key]->category_slug = $catStringSlug;



            

        }

		$data['list'] = $post_list;



		



        



        $data['sizes'] = $this->db->get_where('product_size',['status'=>1])->result();



        



        $wh = ' WHERE parent_id = 0  ';

        $wh .= ' order by ui_order ASC';

        $rows = $this->common_model->get_all_details_query('category',$wh)->result_array();

        $data['parent_category'] = $rows;

        $rows = array();

        if (!empty($_GET['category'])) {

            $wh = ' WHERE parent_id = "'.$_GET['category'].'"  ';

            $wh .= ' order by ui_order ASC';

            $rows = $this->common_model->get_all_details_query('category',$wh)->result_array();

        }

        $data['parent_sub_category'] = $rows;



		$this->load->view($url1.'/template/header');



        $this->load->view($url1.'/'.$url2.'/list',$data);



        $this->load->view($url1.'/template/footer');



    }

	public function index_oooo() {

	    $url1 = $this->uri->segment(1);

        $url2 = $this->uri->segment(2);

        $url3 = $this->uri->segment(3);

        $url4 = $this->uri->segment(4);

        

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

		$config["base_url"] = base_url().$url1.'/'.$url2.'/index';

		$config['suffix'] = '?' . http_build_query($_GET, '', "&");

		$config['first_url']=base_url().$url1.'/'.$url2.'/index/?'.http_build_query($_GET, '', "&");

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

		$this->load->view($url1.'/template/header');

        $this->load->view($url1.'/'.$url2.'/list',$data);

        $this->load->view($url1.'/template/footer');

    }

    public function view($id=''){ 
        $this->getPermission('admin/allproducts/edit');
        $url1 = $this->uri->segment(1);

        $url2 = $this->uri->segment(2);

        $url3 = $this->uri->segment(3);

        $tbl_name = $this->tbl_name;

        $postData = $this->input->post();

        

        $data['title'] = 'Edit ';

        $data['list_heading'] = 'Edit';

        $data['right_heading'] = ' Subscription Question List';

        if (!$id) {

        	redirect($url1.'/'.$url2);

        }

        $record_detail  =  $this->common_model->get_all_details($tbl_name,array('id'=>$id))->row_array();

        $data['record_detail'] = $record_detail  ;  

    

        $this->load->view($url1.'/template/header');

        $this->load->view($url1.'/'.$url3.'/addedit',$data);

        $this->load->view($url1.'/template/footer');

    }

    public function delete($id){
        $this->getPermission('admin/allproducts/delete');
        $url1 = $this->uri->segment(1);

        $url2 = $this->uri->segment(2);

        $url3 = $this->uri->segment(3);



        $table = $this->tbl_name;

        $delete = $this->common_model->commonDelete($table,array('id'=>$id));

        if($delete) {

            $this->session->set_flashdata('success','Deleted successfully!!');

            redirect($url1.'/'.$url2);

        } else {

            $this->session->set_flashdata('error','Something Went Wrong, try again!!');

            redirect('admin/'.$url2);

        }

    }

    public function export_old(){

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

    public function export______(){

         

       

        $str = " SELECT `products`.id,`products`.product_name, `products`.description,`products`.slug,`products`.image,`products`.price, `vender`.`fname`, `vender`.`lname`, `category`.`name` as `category_name`, `category`.`slug` as `category_slug` FROM `products` JOIN `vender` ON `vender`.`id` = `products`.`vender_id` JOIN `category` ON `category`.`id` = `products`.`cat_id` ORDER BY `products`.`id` DESC";

	    $query 	=  $this->db->query($str);

	    $usersData = $query->result_array();

        //echo $this->db->last_query();die;

 

        $filename = 'register_stylist_data_'.date('Y-m-d-H-i-s').'.csv'; 

        header("Content-Description: File Transfer"); 

        header("Content-Disposition: attachment; filename=$filename"); 

        header("Content-Type: application/csv; ");

        

        

        

        $file = fopen('php://output', 'w');

        $header = array('id',"title","description","link","Image_link","availability", "price",'sale_price'); 

        fputcsv($file, $header);

        

        $product_order = 0;

        foreach ($usersData as $key=>$list){ 



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

			

			$id = 'SKU'.$serial_number1; 

			$link =  base_url('shop/'.$list['category_slug'].'/'.$list['slug']);

			$image_link= base_url('assets/images/product/'.$list['image']); 

			$price = $list['price']; 

			$discount_p = $list['discount']; 

			

			$lineArray = array();

			$lineArray['id'] = $id;

			$lineArray['title'] = $list['product_name'];

			$lineArray['description'] = strip_tags($list['description']);

			$lineArray['link'] = $link;

			$lineArray['Image_link'] = $image_link;

			$lineArray['availability'] = 'in_stock';

			$lineArray['price'] = number_format($price,2).' INR';

			

			

			

		 	$discount = '0'; 

			$discountAmt = '0'; 

			$saleAmt = $price; 

			if($discount_p) {

			 	$discount = ($discount_p / 100) * $price; 

			 	$discountAmt = ($discount_p / 100) * $price; 

			 	$saleAmt = round($price - $discount); 

			} 

			$lineArray['sale_price'] = number_format($saleAmt,2).' INR';

        

            fputcsv($file,$lineArray); 

        }

        fclose($file); 

        exit;  

        

        

        

	}

    public function export(){

         

       	$data['sizes'] =   $sizes = $this->db->get_where('product_size',['status'=>1])->result();

        $str = " SELECT `products`.id,`products`.product_name, `products`.description,`products`.slug,`products`.image,`products`.price,`products`.gender,`products`.size, `vender`.`fname`, `vender`.`lname`, `category`.`name` as `category_name`, `category`.`slug` as `category_slug` FROM `products` JOIN `vender` ON `vender`.`id` = `products`.`vender_id` JOIN `category` ON `category`.`id` = `products`.`cat_id` ORDER BY `products`.`id` DESC";

	    $query 	=  $this->db->query($str);

	    $usersData = $query->result_array();

        //echo $this->db->last_query();die;

 

        $filename = 'stylebuddy_product_'.date('Y-m-d-H-i-s').'.csv'; 

        header("Content-Description: File Transfer"); 

        header("Content-Disposition: attachment; filename=$filename"); 

        header("Content-Type: application/csv; ");

        

        

        

        $file = fopen('php://output', 'w');

        $header = array('id',"title","description","link","Image_link","availability", "price",'sale_price','gender','size'); 

        

        $c = 0;

        foreach ($usersData as $list) {

            $imgUrls = '';

			$gallary = $this->db->get_where('product_galary',['product_id'=> $list['id'] ])->num_rows();

			if($c<$gallary){

			    $c=$gallary;   

			}

        }

        for($i=0;$i<$c;$i++){

            $ss = 1+$i;

            array_push($header, 'additional_image_link_'.$ss);

        }





        fputcsv($file, $header);

        

        $product_order = 0;

        foreach ($usersData as $key=>$list){ 



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

			

			$id = 'SKU'.$serial_number1; 

			$link =  base_url('shop/'.$list['category_slug'].'/'.$list['slug']);

			$image_link =  ''; 

			if(!empty($list['image'])) {  

				$image_link= base_url('assets/images/product/'.$list['image']); 

			} 



			$price = $list['price']; 

			$discount_p = $list['discount']; 

			

			$lineArray = array();

			$lineArray['id'] = $id;

			$lineArray['title'] = $list['product_name'];

			$lineArray['description'] = strip_tags($list['description']);

			$lineArray['link'] = $link;

			$lineArray['Image_link'] = $image_link;

			$lineArray['availability'] = 'in_stock';

			$lineArray['price'] = number_format($price,2).' INR';

			

			

			

		 	$discount = '0'; 

			$discountAmt = '0'; 

			$saleAmt = $price; 

			if($discount_p) {

			 	$discount = ($discount_p / 100) * $price; 

			 	$discountAmt = ($discount_p / 100) * $price; 

			 	$saleAmt = round($price - $discount); 

			} 

			$lineArray['sale_price'] = number_format($saleAmt,2).' INR';





			if($list['gender'] == 1){

                $ab = 'MALE';

            }else if($list['gender'] == 2){

                $ab = 'FEMALE';

            }else{

                $ab = 'UNISEX';

            }

            $lineArray['gender'] = $ab;



            $values = ""; $arrayVal = explode(',',$list['size']); 

            foreach ($sizes as $size) { 

			    if( in_array($size->id , $arrayVal)) {  

			        $values .= ", $size->size_name"; 

			    } 

			}

			$arrayVal = explode(',',substr($values,1)); 

			$lineArray['size'] = $arrayVal[0];

			$lineArray['size'] = trim($values,',');



        	

        	$gallary = $this->db->get_where('product_galary',['product_id'=> $list['id'] ])->result();

			if(!empty($gallary)) { 

			    for($i=0;$i<$c;$i++){

			        $imgUrls =  ''; 

					if(!empty($gallary[$i]->gallery_image)) {  

						$imgUrls = base_url('assets/images/gallery/').$gallary[$i]->gallery_image; 

					}



			        $ss = 1+$i;

			        if($gallary[$i]->gallery_image){

			            $lineArray['additional_image_link_'.$ss] = trim($imgUrls,',');

			        }else{

			        	$lineArray['additional_image_link_'.$ss] = trim($imgUrls,',');

			        }

			    }

			}



            fputcsv($file,$lineArray); 

        }

        fclose($file); 

        exit;  

    }

}