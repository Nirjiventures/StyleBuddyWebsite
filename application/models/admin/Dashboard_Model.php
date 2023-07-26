<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_Model extends CI_Model {
    
    
    public function common_all($table)
    { 
        // $this->db->from($table);
        // $this->db->order_by("id", "DESC");
        // $this->db->get(); 
        // return $query->result();
        //return $this->db->last_query();
        return $this->db->get($table)->result();
    }
    
    public function common_insert($data,$table)
    {
         return $this->db->insert($table,$data);
    }
    
    public function common_row($id,$table)
    {
        return $this->db->get_where($table,['id'=>$id])->row();
    }
    
    public function common_update($id,$data,$table)
    {
        return $this->db->where('id',$id)->update($table,$data);
    }
    
    public function common_delete($id,$table)
    {
       return $this->db->where('id',$id)->delete($table);
    }
    
    public function common_join($table1,$table2,$table3) 
    {
        $this->db->select("$table2.category,$table3.subcategory,$table1.*");
        $this->db->from($table1);
        $this->db->join($table2, "$table1.cat_id = $table2.id");
        $this->db->join($table3, "$table1.subcat_id = $table3.id");
       // $this->db->where("$table1.status",1);
        $this->db->order_by("$table1.id", "DESC");
        return  $this->db->get()->result();
         // $this->db->last_query(); 
    }
    
    
    
    
}