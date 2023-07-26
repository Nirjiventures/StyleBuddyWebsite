<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Common_model extends MY_Model {

    function __construct() {
        parent::__construct();
    }
    public function check_admin_login_status() {
		if($this->session->userdata('admin_id') && $this->session->userdata('user_id')){
				return true;
		}
        $_id = $this->session->userdata('user_id'); 
        $user_type  = $this->session->userdata('user_type');
        if (!empty($_id)) {
			$isTrue = $this->permission($user_type);
			if($isTrue){
				return true;	
			}else{
			    return false;
			}	           
        } else {
            return false;
        }
    } 
    public function permission($user_type=''){
		$cName = $this->router->fetch_class();
		$methodName = $this->router->fetch_method();
		$checkCM = $cName.'/'.$methodName;
		$_id = $this->session->userdata('user_id'); 
        $rrr = 	$this->common_model->get_all_details('users',array('id'=>$_id))->row_array();
		$permissionA = unserialize($rrr['permission']);
		if($user_type){
			if(in_array($checkCM,$permissionA)){
				return true;
			}else{
			   return false;	
			}
		}else{
			$permissionA = array('auth/login');
		}
	}
	function get_brand($id='') {
		$this->db->select('id,name,icon,created_at,updated_at,slug');
		$this->db->from('product_brand');
		if($id)$this->db->where('id', $id);
		$query = $this->db->get();
		$result = $query->result();
		if (!empty($result)) {
		   return $result;
		} else {
			return false;
		}      
	}
	public function getLayout($tbl,$user_role){
	    $query = "select * from $tbl where user_role = '$user_role'";
	    $query = $this->db->query($query);
		$result = $query->result();
		 if ($result) {
				return $result;
		} else {
			$result;
		}
	}
	
	public function getMetaValue($tbl,$user_role,$m_key){
	    $query = "select m_value from $tbl where user_role = '$user_role' AND m_key = '$m_key'";
	    $query = $this->db->query($query);
		$result = $query->result();
		 if ($result) {
				return $result;
		} else {
			$result;
		}
	}
	
	public function getSelectedFamily($tbl,$reference){
	    $query = "select * from $tbl WHERE reference = '$reference'";
	    $query = $this->db->query($query);
		$result = $query->result();
		 if ($result) {
				return $result;
		} else {
			$result;
		}
	}
    public function getParentChildAttribute($tblattr,$typeattr){
        $query = "select * FROM $tblattr where cat_type = '$typeattr' AND parent_id = '0' AND slug!='color' AND slug!='tags' AND slug!='replacement' ORDER BY id ASC";
        $query = $this->db->query($query);
        $results = $query->result_array();
        
        foreach($results as $key => $result){
            $parentId = $result['id'];
            $query1 = "select * FROM $tblattr where cat_type = '$typeattr' AND parent_id = '$parentId' ORDER BY id ASC";
            $query1 = $this->db->query($query1);
            $results1 = $query1->result_array();
            //$count = 1;
            $results[$key]['child'] = $results1;
            foreach($results1 as $result1){
                $temp['id'] = $result1->id;
                $temp['name'] = $result1->name;
                $temp['slug'] = $result1->slug;
                $temp['parent_id'] = $parentId;
                //$count++;
            }
        }
        return $results;
    }
}
