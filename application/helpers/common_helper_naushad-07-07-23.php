<?php



    function isMobile() {



        return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);



    }

    function check_image_sightengine($content){

        $api_user = '1394780790';

        $api_secret = 'HS8opKcFe35pGYVokKXB';

        $model = 'nudity-2.0,text-content';

        return false;

        if (is_array($content)) {

            foreach($content as $k=>$v){

                $params = array(

                    'url' =>  $v,

                    'models' => $model,

                    'api_user' => $api_user,

                    'api_secret' => $api_secret,

                );

                $ch = curl_init('https://api.sightengine.com/1.0/check.json?'.http_build_query($params));

                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                $response = curl_exec($ch);

                curl_close($ch);



                $output = json_decode($response, true);

                $nudity = $output['nudity']['none'] * 100;

                if ($nudity < 20) {

                     return true;

                }

            }

            return false;

        }else{

            $params = array(

                'url' =>  $content,

                'models' => $model,

                'api_user' => $api_user,

                'api_secret' => $api_secret,

            );

            $ch = curl_init('https://api.sightengine.com/1.0/check.json?'.http_build_query($params));

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($ch);

            curl_close($ch);



            $output = json_decode($response, true); 

            $nudity = $output['nudity']['none'] * 100;

            if ($nudity < 20) {

                 return true;

            }

            return false;

        }

    }

    function check_content_sightengine($content){

        $api_user = '1394780790';

        $api_secret = 'HS8opKcFe35pGYVokKXB';

        return false;

        if (is_array($content)) {

            foreach($content as $k=>$v){



                $params = array(



                  'text' => $v,



                  'lang' => 'en',



                  'opt_countries' => 'us,gb,fr',



                  'mode' => 'standard',



                  'api_user' => $api_user,



                  'api_secret' => $api_secret,



                );











                $ch = curl_init('https://api.sightengine.com/1.0/text/check.json');



                curl_setopt($ch, CURLOPT_POST, true);



                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);



                curl_setopt($ch, CURLOPT_POSTFIELDS, $params);



                $response = curl_exec($ch);



                curl_close($ch);







                $output = json_decode($response, true);



                if ($output['profanity']['matches']) {



                     return $output['profanity']['matches'];



                } 



            }



            return false;



        }else{



           $params = array(



              'text' => $content,



              'lang' => 'en',



              'opt_countries' => 'us,gb,fr',



              'mode' => 'standard',



              'api_user' => $api_user,



              'api_secret' => $api_secret,



            );











            $ch = curl_init('https://api.sightengine.com/1.0/text/check.json');



            curl_setopt($ch, CURLOPT_POST, true);



            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);



            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);



            $response = curl_exec($ch);



            curl_close($ch);







            $output = json_decode($response, true); 



            //return $output;



            if ($output['profanity']['matches']) {



                 return $output['profanity']['matches'];



            }







            return false;



        }



        



        



    }    



 



    function cleanString($text) {



        $convert = Array(



            'ä'=>'a',



            'Ä'=>'A',



            'á'=>'a',



            'Á'=>'A',



            'à'=>'a',



            'À'=>'A',



            'ã'=>'a',



            'Ã'=>'A',



            'â'=>'a',



            'Â'=>'A',



            'č'=>'c',



            'Č'=>'C',



            'ć'=>'c',



            'Ć'=>'C',



            'ď'=>'d',



            'Ď'=>'D',



            'ě'=>'e',



            'Ě'=>'E',



            'é'=>'e',



            'É'=>'E',



            'ë'=>'e',



        );



        return $string = strtr($text , $convert );



    }



    







    function getParentCategory() {



        $CI = & get_instance();



        $CI->db->select('*');



        $CI->db->where('parent_id', 0);



        $CI->db->where('status', 1);



        $CI->db->order_by('ui_order');



        $query = $CI->db->get('category');



        $rows = $query->result_array();







        foreach ($rows as $k => $v) {



            /*$CI->db->select('*');



            $CI->db->where('parent_id', $v['id']);



            $CI->db->where('status', 1);

            $CI->db->where('is_sub_menu', 1);

            $CI->db->order_by('ui_order');

            $query = $CI->db->get('category');*/

            $sql = 'select * from category WHERE FIND_IN_SET(parent_id,'.$v['id'].') AND status = 1 order by ui_order asc';

            $query=$CI->db->query($sql);

            //echo $CI->db->last_query();



            $rs = $query->result_array();



            $rows[$k]['child'] = $rs;



            foreach($rs as $k1=>$v1){



                $rows[$k]['child'][$k1]['child']  = recursive('category',$k1,$v1['id']);



            }



        }



        return $rows;



    }



    function recursive($tbl_name,$k,$parent_id) {



        $CI = & get_instance();



        /*$CI->db->select('*');



        $CI->db->where('parent_id', $parent_id);



        $CI->db->where('status', 1);



        $CI->db->order_by('ui_order');



        $query = $CI->db->get('category');*/

        $sql = 'select * from category WHERE FIND_IN_SET(parent_id,'.$parent_id.') AND status = 1 order by ui_order asc';

        $query=$CI->db->query($sql);

        //echo $CI->db->last_query();

        $rs = $query->result_array();



        if($rs){



            foreach($rs as $key=>$value){



                $rs[$key]['child'] = recursive($tbl_name,$k,$value['id']);



            }



        }else{



            $rs = array();



        }



        return $rs;



    }







    function getCurrency() {



        $CI = & get_instance();



        $query = $CI->db->get_where('countries',array('is_active'=>1));



        if ($query->num_rows() > 0) {



            return $query;



        } else {



            return false;



        }



        return false;



    }



    function get_price($val, $toCurrency = CURRENT_CURRENCY) {



        $CI = & get_instance();



    



        $fromCurrency = CURRENT_CURRENCY;



        if($fromCurrency == $toCurrency){



            return $val;



        }else{



            $fromRow = $CI->db->get_where('currency_rates',array('currency'=>$fromCurrency))->row_array();



            $fromValue = $fromRow['value'];



            $toRow = $CI->db->get_where('currency_rates',array('currency'=>$toCurrency))->row_array();



            $toValue = $toRow['value'];



            



            $v = ($toValue * $val ) / $fromValue;



            return $v;



        }



    }



    function getWebsiteDetail() {



        $CI = & get_instance();



        



        $query = $CI->db->get_where('site_setting',array('id'=>1));



        if ($query->num_rows() > 0) {



            return $query;



        } else {



            return false;



        }



        return false;



    }



    



    function getWebsiteDesignDetail() {



        $CI = & get_instance();



        $user_type = 2;



        if($CI->session->userdata('user_type')){



            $user_type = $CI->session->userdata('user_type');



        }



        $aaa['user_role'] = $user_type;



        $query = $CI->db->get_where('layout',$aaa);



        if ($query->num_rows() > 0) {



            $array = array();



            $results = $query->result();



            foreach($results as $result){



                $m_key = $result->m_key;



                $a[$m_key] = $result->m_value;



                array_push($array,$a);



            }



            $layouts = end($array);



            return $layouts;



        } else {



            return false;



        }



        return false;



    }



    



    function getUserPermission() {



        $CI = & get_instance();



        $_id = $CI->session->userdata('adminEmail'); 



        $query = $CI->db->get_where('user_master',array('email'=>$_id));



        $CI->db->last_query();



        if ($query->num_rows() > 0) {



            return $query->row_array();



        } else {



            return false;



        }



    }



    function removeExtraspace($str) {



        $trimstr = trim($str);



        return $new_str = preg_replace('/\s+/', ' ', $trimstr);



    }



    



    function dump($array = array(), $line = '') {



        echo '<pre>';



        if (!empty($line)) {



            echo 'Debug Line is ' . $line . '<br>';



        }



    



        print_r($array);



        echo '</pre>';



    }



    



    function numberFormat($val,$toCurrency = CURRENT_CURRENCY){



        $fromCurrency = CURRENT_CURRENCY;



        return number_format($val,2);



        



    }



    



    



    function getRealIpAddr() {



        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {   //check ip from share internet



            $ip = $_SERVER['HTTP_CLIENT_IP'];



        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {   //to check ip is pass from proxy



            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];



        } else {



            $ip = $_SERVER['REMOTE_ADDR'];



        }



        return $ip;



    }



    



    



    



    function checkAccess($accessLabelId, $curentControler, $controlerMethod) {



        $CI = & get_instance();



        return $CI->ion_auth->check_authentication($accessLabelId, $curentControler, $controlerMethod);



    }



    function valid_url($url) {



        if (!filter_var($url, FILTER_VALIDATE_URL)) {



            $this->form_validation->set_message('valid_url', 'The %s field invalid');



            return FALSE;



        }



        return TRUE;



    }



    function valid_phone($input) {



        $pattern = '/^[0-9-+()\s]+$/';



        $vld = preg_match($pattern, $input) ? true : false;



        if (!$vld) {



            $this->form_validation->set_message('valid_phone', 'The %s field invalid');



            return FALSE;



        }



        return TRUE;



    }



    



    function trim_str($string, $length = 60) {



        if (!empty($string)) {



            if (mb_strlen($string, 'utf-8') > $length) {



                $stringLength = mb_strlen($string, 'utf-8');



                $string .= ' ';



                $strPos = mb_strpos($string, ' ', $length, 'utf-8');



                $strPos = (empty($strPos) ? $length : $strPos);



                $string = mb_substr($string, 0, $strPos, 'utf-8') . (($stringLength > $strPos) ? ('...') : NULL);



            }



        }



        $string = trim($string);



        return $string;



    }



    



    function removeRow($tableName = null, $condition = null) {



        $CI = & get_instance();



        if (empty($tableName)) {



            return false;



        }



        if ($condition != null) {



            $records = $CI->db->where($condition)->delete($tableName);



            try {



                if ($records) {



                    return true;



                } else {



                    return false;



                }



            } catch (Exception $ex) {



                return 'Records Fetching Errors ' . $ex->getMessage();



            }



        }



    }



    



    



    function getCountries() {



        $countryOptions = array();



        $CI = & get_instance();



        $CI->db->select('id,name');



        $CI->db->where('show_home', 1);



        $CI->db->where('is_featured', 1);



        $CI->db->order_by('countries.name');



        $query = $CI->db->get('countries');



        if ($query->num_rows() > 0) {



            $countryList = $query->result();



            foreach ($countryList as $country) {



                $countryOptions[$country->id] = $country->name;



            }



            return $countryOptions;



        } else {



            return false;



        }



    }



    



    function returnValidData($tableName = null, $data = array()) {



        $CI = & get_instance();



        if (empty($tableName)) {



            return false;



        }



        $return = array();



        $fields = $CI->db->list_fields($tableName);



        if ($fields) {



            foreach ($fields as $index => $column) {



                if (array_key_exists($column, $data)) {



                    $return[$column] = $data[$column];



                }



            }



            return $return;



        }



    }



    



    



    



    



    function getUserNameById($id = null){



        $result = array();



        $CI = & get_instance();



        $CI->db->select('*');



        $CI->db->where('users.id', $id);



        $query = $CI->db->get('users');



        if ($query->num_rows() > 0) {



            $result = $query->row();



            return $result;



        } else {



            return $result;



        }



    }



    



    function setMessage($message = '', $type = 'info') {



        $CI = & get_instance();



        if (!empty($message)) {



            //dump($CI->session);



            if (isset($CI->session)) {



                $CI->session->set_flashdata('message', $type . '::' . $message);



            }



            $flashdata = array(



                'message_type' => $type,



                'message' => $message



            );



            $CI->session->set_userdata($flashdata);



        }



    }



    



    function customBreadcrumb($link_array = array()) {



        $CI = & get_instance();



        $CI->load->library('breadcrumbs');



        if (!empty($link_array)) {



            foreach ($link_array as $key => $link) {



                $CI->breadcrumbs->push($key, '/' . $link);



            }



    



            $CI->breadcrumbs->unshift('Home', '/');



        }



    



        return $CI->breadcrumbs->show();



    }



    



    function getIdBySlug($table_name = null, $slug = null) {



        $id = '';



        if (!empty($table_name) && !empty($slug)) {



            $CI = & get_instance();



            $CI->db->select('id');



            $CI->db->where($table_name . '.url', $slug);



            $query = $CI->db->get($table_name);



            if ($query->num_rows() > 0) {



                $res = $query->row();



                $id = !empty($res->id) ? $res->id : null;



                return $id;



            } else {



                return false;



            }



        }



    



        return false;



    }



    



    function isUnique($tableName = null, $condition = null, $id = 0) {



        $CI = & get_instance();



        if ($tableName != null && !empty($condition)) {



            if (empty($id)) {



                $check = $CI->db->where($condition)->get($tableName)->result_array();



                try {



                    if ($check) {



                        return false;



                    } else {



                        return true;



                    }



                } catch (Exception $ex) {



                    



                }



            }



            if (!empty($id) && is_numeric($id)) {



                $check = $CI->db->where($condition)->where('id !=' . $id)->get($tableName)->result_array();



                try {



                    if ($check) {



                        return false;



                    } else {



                        return true;



                    }



                } catch (Exception $ex) {



                    



                }



            }



        }



    }



    



    



    



    



    function objToArray($obj, &$arr){



    



        if(!is_object($obj) && !is_array($obj)){



            $arr = $obj;



            return $arr;



        }



    



        foreach ($obj as $key => $value)



        {



            if (!empty($value))



            {



                $arr[$key] = array();



                objToArray($value, $arr[$key]);



            }



            else



            {



                $arr[$key] = $value;



            }



        }



        return $arr;



    }



    



    



    



    function youtube_id_from_url($url) {



        $pattern = '%^# Match any youtube URL



            (?:https?://)?  # Optional scheme. Either http or https



            (?:www\.)?      # Optional www subdomain



            (?:             # Group host alternatives



              youtu\.be/    # Either youtu.be,



            | youtube\.com  # or youtube.com



              (?:           # Group path alternatives



                /embed/     # Either /embed/



              | /v/         # or /v/



              | .*v=        # or /watch\?v=



              )             # End path alternatives.



            )               # End host alternatives.



            ([\w-]{10,12})  # Allow 10-12 for 11 char youtube id.



            ($|&).*         # if additional parameters are also in query string after video id.



            $%x';



        $result = preg_match($pattern, $url, $matches);



        if (false !== $result) {



            return isset($matches[1]) ? $matches[1] : false;



        }



        return false;



    }



    



    function checkVideoUrl($url) {



        $regex_pattern = "/(youtube.com|youtu.be)\/(watch)?(\?v=)?(\S+)?/";



        $match;



        if (preg_match($regex_pattern, $url, $match)) {



            return true;



        } else {



            return false;



        }



    }



    



    function paginationHtml($s,$segment,$segment3,$GET){



        if($s > 1){



            echo '<li><a class="black_c" href="'.base_url().$segment.'/'.$i.'" data-ci-pagination-page="1"><img src="'.base_url().'assets/ui/images/back_black.png"></a></li>';



            for ($i=1; $i <= $s ; $i++) { 



                $ac = ( $segment3 ) ? $segment3 : 1 ;



                if($ac == $i){



                    echo '<li><a class="sle_page" href="'.base_url().$segment.'/'.$i.'?'.http_build_query($GET, '', "&").'" data-ci-pagination-page="'.$i.http_build_query($GET, '', "&").'">'.$i.'</a></li>';



                }else{



                    echo '<li><a href="'.base_url().$segment.'/'.$i.'?'.http_build_query($GET, '', "&").'" data-ci-pagination-page="'.$i.http_build_query($GET, '', "&").'">'.$i.'</a></li>';



                }



            }



            echo '<li><a class="black_c" href="'.base_url().$segment.'/'.$i.'" data-ci-pagination-page="'.$s.'"><img src="'.base_url().'assets/ui/images/next_black.png"></a></li>';



        }



    }



    function stylist_div($vender){



        $ci = &get_instance();



        ?>



        <?php $review = $vender->review;?>







        <?php $url =  base_url('stylists/').base64_encode($vender->id).'/'.strtolower($vender->fname.'-'.$vender->lname.'-'.str_replace(' ', '-', $vender->area_expertiseRow->name).'-in-'.str_replace(' ', '-',$vender->city_name)) ?>



        <?php $url =  base_url('stylists/').base64_encode($vender->id).'/'.strtolower($vender->fname.'-'.$vender->lname) ?>



        



            <?php $img =  'assets/images/no-image.jpg';?>



            <?php if(!empty($vender->image))  {?>



                <?php 



                    $img1 =  'assets/images/vandor/'.$vender->image; 



                    if (file_exists($img1)) {



                        $img = $img1;



                    }



                ?>



            <?php } ?>



            <div class="col-sm-3">



                <div class="my_stylish_t2 color_white">



                    <a href="<?= $url ?>">

                        <!--<img src="<?php //echo base_url($img);?>" class="img-fluid">-->

                        <img src="<?php echo base_url('resize_image.php?new_width=300&new_height=400&image='.$img);?>" class="img-fluid">

                    </a>



                    <div class="trd_data">



                        <div class="statt"><i class="fa fa-star"></i> <span><?=($review->rating)?number_format($review->rating,1):0.0 ?></span></div>



                        <!-- <div class="hidden_star_pointer ratingss my_star">



                            <input value="<?=$review->rating?>" type="hidden" class="rating" style="pointer-events:none" data-min=0 data-max=5 data-step=0.2>(Reviews <?=$vender->feedbackCount?>) 



                        </div> -->



                        <h4><?= ucwords($vender->fname.' '.$vender->lname) ?></h4>



                        <p style="display: none;"><small>Projects Delivered: <?=$vender->project_deliverd?></small></p>



                        <p style="display: none;"><?= $vender->designation ?></p>



                        <p>Experience: <?=$vender->experience?> Years</p>



                        <?php if(isset($vender->city_name) && (!empty($vender->city_name)) ) {  ?>



                            <p>Location: <?= $vender->city_name ?></p>



                        <?php } ?>



                        <p class="portfolio_total"><i class="fa fa-eye"></i> <?=$vender->count_view;?> Views</p>



                        <div class="col-12"><a href="<?= $url ?>" class="action_bt2">Discover</a></div>



                    </div>



                </div>



            </div>



        <?php



    }

    function stylist_div_home($vender){



        $ci = &get_instance();



        ?>



        <?php $review = $vender->review;?>







        <?php $url =  base_url('stylists/').base64_encode($vender->id).'/'.strtolower($vender->fname.'-'.$vender->lname.'-'.str_replace(' ', '-', $vender->area_expertiseRow->name).'-in-'.str_replace(' ', '-',$vender->city_name)) ?>



        <?php $url =  base_url('stylists/').base64_encode($vender->id).'/'.strtolower($vender->fname.'-'.$vender->lname) ?>



        



            <?php $img =  'assets/images/no-image.jpg';?>



            <?php if(!empty($vender->image))  {?>



                <?php 



                    $img1 =  'assets/images/vandor/'.$vender->image; 



                    if (file_exists($img1)) {



                        $img = $img1;



                    }



                ?>



            <?php } ?>



            <div class="col-sm-3">



                <div class="my_stylish_list color_white">



                    <a href="<?= $url ?>">



                        



                        <img src="<?=base_url('resize_image.php?new_width=300&new_height=400&image='.$img);?>" class="img-fluid">







                    </a>



                    <div class="trd_data">



                        <div class="statt"><i class="fa fa-star"></i> <span><?=($review->rating)?number_format($review->rating,1):0.0 ?></span></div>



                        <!-- <div class="hidden_star_pointer ratingss my_star">



                            <input value="<?=$review->rating?>" type="hidden" class="rating" style="pointer-events:none" data-min=0 data-max=5 data-step=0.2>(Reviews <?=$vender->feedbackCount?>) 



                        </div> -->



                        <h4><?= ucwords($vender->fname.' '.$vender->lname) ?></h4>



                        <p style="display: none;"><small>Projects Delivered: <?=$vender->project_deliverd?></small></p>



                        <p style="display: none;"><?= $vender->designation ?></p>



                        <p>Experience: <?=$vender->experience?> Years</p>



                        <?php if(isset($vender->city_name) && (!empty($vender->city_name)) ) {  ?>



                            <p>Location: <?= $vender->city_name ?></p>



                        <?php } ?>



                        <!--<p class="portfolio_total"><i class="fa fa-eye"></i> <?=$vender->count_view;?> Views</p>-->



                        <div class="col-12"><a href="<?= $url ?>" class="action_bt44 ">Discover</a></div>



                    </div>



                </div>



            </div>



        <?php



    }



    function product_div($product){



        $ci = &get_instance();



        $discount = '0'; 







        $discountAmt = '0'; 







        $saleAmt = $product->price; 







        if($product->discount) { 







            $discount = ($product->discount / 100) * $product->price; 







            $saleAmt = round($product->price - $discount); 







            $discountAmt = round($discount); 







        }







        $productUrl  =  base_url('shop/'.$product->category_slug.'/'.$product->slug);







        $gallary = $product->gallary;







        ?>



        <div class="new_pro_data">







            <div class="pro_photo_pp">







                <?php if($product->discount) { ?>







                    <div class='ribbon-wrapper-3'>







                        <div class='ribbon-3'><?= ($product->discount)?"($product->discount% OFF)":"" ?></div>







                    </div>







                <?php } ?>







                <div class="my_wish_l"> 







                <?php if($product->wishListStatus){$wishClass = 'fa-heart';}else{$wishClass = 'fa-heart-o';}?>







                <?php if($ci->session->userdata('userId')){ ?>







                        <a style="cursor: pointer;"  class="btn_wish" data-venderid="<?= $product->vender_id ?>" data-catid="<?= $product->cat_id ?>" data-id="<?= $product->id ?>" data-loggedid="<?=$ci->session->userdata('userId')?>"><i id="btn_wish_<?= $product->id ?>" class="fa <?=$wishClass?>" aria-hidden="true"></i> </a>







                <?php }else{ ?>







                    







                    <a href="<?php echo base_url('login')?>"  class="btn_wish" data-venderid="<?= $product->vender_id ?>" data-catid="<?= $product->cat_id ?>" data-id="<?= $product->id ?>" data-loggedid="<?=$ci->session->userdata('userId')?>"><i id="btn_wish_<?= $product->id ?>" class="fa <?=$wishClass?>" aria-hidden="true"></i> </a>







                <?php }?>



















                </div>







                <a  href="<?= $productUrl?>">



                    <?php $img =  'assets/images/no-image.jpg';?>







                    <?php if(!empty($product->image))  {?>



                        <?php 



                            $img1 =  'assets/images/product/'.$product->image; 



                            if (file_exists($img1)) {



                                $img = $img1;



                            }



                        ?>



                    <?php } ?>



                    <!--<img src="<?php //echo base_url($img);?>" class="img-fluid">-->

                    <img src="<?php echo base_url('resize_image.php?new_width=300&new_height=400&image='.$img);?>" class="img-fluid">



                </a>







               







                <?php $review = $product->review;?>





                <?php $st = '';if($ci->uri->segment(2) && $ci->uri->segment(2) == 'user-wishlist'){$st='display:none';}?>

                <div class="quick_shop" style="<?=$st;?>"><a  class="link-cart sidenav_open" data-rating="<?=number_format($review->rating,1)?>" data-designby="<?= strtoupper($product->boutique_fname.' '.$product->boutique_lname) ?>" data-gallaryimage='<?= ($gallary)?json_encode($gallary):json_encode(array()) ?>' data-discountprice="<?= ($discountAmt)?$discountAmt:'0' ?>" data-discount="<?= ($product->discount)?$product->discount:'0' ?>" data-price="<?= $saleAmt ?>" data-mrpprice="<?= $product->price ?>" data-venderid="<?= $product->vender_id ?>" data-catid="<?= $product->cat_id ?>" data-image="<?= base_url($img) ?>" data-id="<?= $product->id ?>" data-name="<?= $product->product_name ?>" data-slug="<?= $product->slug ?>" data-seeFullUrl="<?= $productUrl ?>" data-sizes='<?= json_encode($product->sizesArray) ?>'><i class="fa fa-shopping-bag" aria-hidden="true"></i> Quick Shop</a></div>







            </div>















            <div class="prd_title_new">







                <h4><a href="<?=$productUrl ?>"><?= mb_strimwidth($product->product_name,0,30, '....') ?></a></h4>







            </div>















            















            <?php if(!empty($product->sizesArray)) { ?>







            <div class="size_pp">Size : 







                <?php foreach($product->sizesArray as $size)  { ?> 







                    <span for="swatch-0-<?= $size->size_name ?>">







                        







                      <?= $size->size_name ?>







                    </span>







                <?php } ?>







            </div>







            <?php } ?>















            















            <div class="prd_price">







                <?php if($product->discount) { ?>







                    <span><?= $product->site_currency.' '.number_format($saleAmt) ?></span> <del><?= $site_currency->currency.''.number_format($product->price) ?></del>







                <?php }else { ?>







                    <span><?= $product->site_currency.' '.number_format($product->price) ?></span> 







                <?php } ?>







            </div>















            







        </div>



        <?php



    }



    function service_div($value,$k=1){



        $ci = &get_instance();



        $price = $value->price;



        $mrpprice = $value->mrp_price;



        $discountAmt = $mrpprice - $price;



        //$discount_ = ($discountAmt*100/$mrpprice);

        if(empty($mrpprice)){

		    $discount_ = 0; 

		}else{

		    $discount_ = ($discountAmt*100/$mrpprice);   

		}

        ?>



        <div class="my_ssv g<?=$k?>" <?=$i?>>



            <?php $img =  'assets/images/no-image.jpg';?>



            <?php if(!empty($value->image))  {?>



                <?php 



                    $img1 =  'assets/images/services/'.$value->image; 



                    if (file_exists($img1)) {



                        $img = $img1;



                    }



                ?>



            <?php } ?>



            <img src="<?=base_url($img);?>" class="img-fluid">







            <h4><?= $value->title ?></h4>



            <?= $value->short_description ?> 



            <a href="<?=base_url('services/'.$value->slug)?>" class="action_bt2">Read More</a>



            <div class="row align-items-center cart_qty_row justify-content-between">



                <div class="col-sm-12 ">



                    <div class="my_info_bg">



                        



                        



                        <input type="hidden" name="qtybutton" value="1">

                        <?php if(empty($mrpprice)){ ?>

						    <a class="whtss" title="Book Now"  href="https://wa.link/stfnoe"> WhatsApp <i class="fa fa-whatsapp" aria-hidden="true"></i></a>

						<?php }else{ ?>
                            <div class="price_servvv">

                                <?php if ($ci->session->userdata('userType') && $ci->session->userdata('userType') == 6) { ?>

                                    <?php if(!empty($price)){ ?>

                                        <i class="fa fa-inr"></i> <?= $price;?>

                                    <?php } ?>

                                <?php }else{ ?>

                                    <?php if(!empty($price)){ ?>
                                        
                                        <i class="fa fa-inr"></i> <?= $price;?>/- <span>Per Session</span> <?php if(!empty($mrpprice)){ ?> <?php } ?>

                                    <?php } ?>

                                <?php } ?>

                            </div>
						    <a class="action_bt4 service_add" title="Add"  data-id="<?= $value->id ?>"  data-price="<?= $value->price ?>" data-mrp_price="<?= $value->mrp_price ?>"> Try Now</a>

						<?php } ?>

						

                        



                        <a href="<?=base_url('services/'.$value->slug)?>" class="action_bt4 mobile_b">Read More</a>



                       



                    </div>



                </div>


                <?php $couponRow =  $value->couponRow; ?>
                <?php //if($mrpprice > $price){ ?>
                    <div class="col-sm-12 ">
                        <div class="my_info_bg1">
                            <!--<div class="off60"><?=(int)$discount_?>% <br>Off</div>-->
                            <?php if($couponRow){ ?>
                                <div class="col-sm-12 ">
                                    <div class="message_offer">
                                       Get <span><?php echo $couponRow['name'];?></span> Discount using coupon code
                                    </div>
                                </div>

                                <div class="get_serv_off2" style="display: none;">
                                    <p>Use coupon </p>
                                    <div class="copy-button">
                                        <span id="copyvalue_<?php echo $value->id;?>"><?php echo $couponRow['gift_code'];?></span>
                                        <button onclick="copyToClipboard('copybtn_<?php echo $value->id;?>','copyvalue_<?php echo $value->id;?>')" class="copybtn"  id="copybtn_<?php echo $value->id;?>">COPY</button>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php //}?>

                 

            </div>
        </div>
        <?php
    } 



    function stylist_review_div($vender){



        $ci = &get_instance();



        ?>



        <?php $review = $vender->review;?>







        <?php $url =  base_url('stylists/').base64_encode($vender->id).'/'.strtolower($vender->fname.'-'.$vender->lname.'-'.str_replace(' ', '-', $vender->area_expertiseRow->name).'-in-'.str_replace(' ', '-',$vender->city_name)) ?>



        <?php $url =  base_url('stylists/').base64_encode($vender->id).'/'.strtolower($vender->fname.'-'.$vender->lname) ?>



        <?php $img =  'assets/images/no-image.jpg';?>



        <?php if(!empty($vender->image))  {?>



            <?php 



                $img1 =  'assets/images/vandor/'.$vender->image; 



                if (file_exists($img1)) {



                    $img = $img1;



                }



            ?>



        <?php } ?>



        <div class="text_box">



            <div class="row m-0">



                <div class="col-sm-4 col-4 p-0">



                    <div class="test_photo">



                        <a href="<?= $url ?>">

                            <!--<img src="<?php //echo base_url($img);?>" class="img-fluid">-->

                            <img src="<?php echo base_url('resize_image.php?new_width=300&new_height=400&image='.$img);?>" class="img-fluid"> 

                        </a>



                    </div>



                </div>



                <div class="col-sm-8 col-8 ">



                    <div class="test_name">



                        <h4><?= ucwords($vender->fname.' '.$vender->lname) ?> <!--<br> Experience: <?=$vender->experience?> Yrs--></h4>



                        <div class="stk__">



                            <div class="hidden_star_pointer ratingss my_star">



                                <input value="<?=$review->rating?>" type="hidden" class="rating" style="pointer-events:none" data-min=0 data-max=5 data-step=0.2>



                            </div>



                        </div>







                    </div>



                </div>



                <div class="test_datat">



                    <p><?php echo substr($vender->review->comment, 0,100).'...';?></p>



                    <span>- <?php echo ($vender->review->name);?></span>



                </div>



            </div>



        </div>



        <?php



    }



    function product_home_div($product){



        $ci = &get_instance();



        $discount = '0'; 



        $discountAmt = '0'; 



        $saleAmt = $product->price; 



        if($product->discount) { 



            $discount = ($product->discount / 100) * $product->price; 



            $saleAmt = round($product->price - $discount); 



            $discountAmt = round($discount); 



        }



        $productUrl  =  base_url('shop/'.$product->category_slug.'/'.$product->slug);



        ?>



        <?php $img =  'assets/images/no-image.jpg';?>



        <?php if(!empty($product->image))  {?>



            <?php 



                $img1 =  'assets/images/product/'.$product->image; 



                if (file_exists($img1)) {



                    $img = $img1;



                }



            ?>



        <?php } ?>







        <div class="my_outfits">



            <a  href="<?= $productUrl?>">



                <img src="<?= base_url($img) ?>"  class="img-fluid">



            </a> 



            <p><a href="<?=$productUrl ?>"><?= mb_strimwidth($product->product_name,0,25, '....') ?></a></p>



            <div class="hot">



                <img src="<?=base_url()?>assets/images/fire.png"> Recommended by <?=$product->recommended_count?> stylists



            </div>



            <a href="<?=$productUrl ?>" class="action_bt4">Buy Now</a>



        </div>



         



        <?php



    }







    function image_exist($image,$path = 'assets/images/product/'){



        $img =  'assets/images/no-image.jpg'; 



        if(!empty($image))  { 



            $img1 =  $path.$image; 



            if (file_exists($img1)) {



                $img = $img1;



            }



        }



        return $img;



    }



    function random_strings($length_of_string){



        //$str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';



        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';



        return substr(str_shuffle($str_result), 0, $length_of_string);



    }

    function random_number($length_of_string){

        $str_result = '0123456789';

        return substr(str_shuffle($str_result), 0, $length_of_string);

    }

    function mailHtmlHeader__($siteRecord){



        //$site = $siteRecord;



        $mailHeader  = '<html>';



        $mailHeader .= '<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;800&display=swap" rel="stylesheet">';



        $mailHeader .= '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">';







        $mailHeader .= '<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@600;700;800&display=swap" rel="stylesheet">';



        $mailHeader .= '<link href="https://fonts.googleapis.com/css2?family=Khand:wght@300;500&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">';







        



        $mailHeader .= '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">';



        $mailHeader .= '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />';



        $mailHeader .= '<script src="https://kit.fontawesome.com/ce0ebae40f.js" crossorigin="anonymous"></script>';







        $mailHeader .= '<body style="margin:0px;">';



            $mailHeader .= '<div style="background: linear-gradient( 180deg, #742ea0 30%, #f0f0f0 10%); width:100%;  padding: 50px 0px 10px 0px; margin: auto;">';



                $mailHeader .= '<div style="width: 80%;margin: 40px auto;background: #FFFFFF;font-family: \'Poppins\', sans-serif; padding: 20px;border-radius: 20px;">';



                    $mailHeader .= '<p style="text-align: center; "><img src="'.base_url('assets/images/'.$siteRecord->logo).'" style="width: 160px;"></p>';



                    $mailHeader .= '<h2 style="text-align: center;text-transform: uppercase;letter-spacing: 2px;color: #f62ac1;">Welcome to StyleBuddy</h2>';



                            



        return $mailHeader;



    



    }



    function mailHtmlFooter__($site){



                    /*$mailFooter = '<div style="margin-top: 50px;">';



                        $mailFooter .= '<p style="margin: 0px;"><b>Thank you,</b></p>';



                        $mailFooter .= '<p style="margin: 0px;">Stylebuddy Team</p>';



                        $mailFooter .= '<p style="margin: 0px;">Call: '.$site->mobile.'</p>';



                        $mailFooter .= '<p style="margin: 0px;">Email: '.$site->email.'</p>';



                        $mailFooter .= '<p style="margin: 0px;">Address: '.$site->address.'</p>';



                        $mailFooter .= '<p style="text-align: left; padding-left: 0px; margin-top: 10px;"><img src="'.base_url('assets/images/'.$site->logo).'" style="width: 160px;"></p>';



                    $mailFooter .= '</div>';



                    $mailFooter .= '<div style="margin-top:20px;padding-bottom: 1px;background: #ffffff;display: block;">';



                        $mailFooter .= '<p style=" font-size:20px;line-height: 28px;margin-bottom: 15px;">Follow Us </p>';



                        $socialArray=   array( array('image'=>'fb.png','name'=>$site->facebook), array('image'=>'youtube.png','name'=>$site->youtube),array('image'=>'insta.png','name'=>$site->instagram), array('image'=>'linke.png','name'=>$site->linkedin));



                        $mailFooter .= '<p style="margin-top: 0px;">';



                            foreach($socialArray as $p=>$w){



                                    $mailFooter .= '<a target="_blank" href="'.$w['name'].'"><img src="'.base_url('assets/images/'.$w['image']).'" style="width: 40px;"></a>';



                            }



                        $mailFooter .= '</p>';



                    $mailFooter .= '</div>';*/







                    $mailFooter = '<div style="">';



                        $mailFooter .= '<p style="margin: 0px;"><b>Regards,</b></p>';



                        $mailFooter .= '<p style="margin: 0px;">Team StyleBuddy</p>';



                        $mailFooter .= '<p style="margin: 0px;">'.base_url().'</p>';



                        $mailFooter .= '<p style="margin: 0px;">WhatsAPP: '.$site->mobile.'</p>';



                    $mailFooter .= '</div>';











                $mailFooter .= '</div>';



            $mailFooter .= '</div>';



        $mailFooter .= '</body></html>';



        return $mailFooter;



    }



    function mailHtmlHeader($site){



 



        $mailHeader  = '<!DOCTYPE html>';



          $mailHeader.='<html xmlns="http://www.w3.org/1999/xhtml">';



          $mailHeader.='<head>';



            $mailHeader.='<title>Forgot PW email</title>';



            $mailHeader.='<meta charset="utf-8">';



            $mailHeader.='<meta name="viewport" content="width=device-width, initial-scale=1">';







            $mailHeader.='<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">';



            $mailHeader.='<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>';



            $mailHeader.='<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">';



            $mailHeader.='<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">';



            /*$mailHeader.='<style>';



              $mailHeader.='@media screen and (min-width: 500px) {



                          {font-family: \'Open Sans\', sans-serif!important; color:#000000!important; background:#f6fcfd;}



                          .common_w{width:620px; margin:auto;}



                          .header_email{background: #000000; padding:25px; }



                          .header_email img{width: 40%;}



                          .header_email span {color: #fff; font-size: 15px; display: inline-block; position: relative; top: 8px; left: 15px; }



                          



                          }';



            $mailHeader.='</style>';*/



          $mailHeader.='</head>';



          $mailHeader.='<body style="font-family: \'Open Sans\', sans-serif!important; color:#000000!important; background:#FFFA00;">';



            $mailHeader .= '<div class="common_w header_email" style="background:#000000; padding: 20px 20px;">';



                //$mailHeader .= '<div class="social_mm">';



                    $mailHeader.='<img style="width: 40%; " src="'.base_url('assets/images/'.$site->logo).'" class="img-fluid">';



                    $mailHeader.='<span style="color: #fff; font-size: 12px; display: inline-block; position: relative; top: 24px; left: 12px;">Enhance your personal style today!</span>';



                //$mailHeader .= '</div>';



            $mailHeader .= '</div>';







        return $mailHeader;



    }



    function mailHtmlFooter($site){



                $mailFooter = '<style>';



                    $mailFooter .= '@media screen and (min-width: 500px) {



                                .footer{ background:#ffffff;}



                                .social_mm ul { padding: 0px; margin: 0px; list-style: none; }  



                                .social_mm ul li { display: inline-block; }  



                                .social_mm ul li a { color: #fff; border: 1px solid #fff; width: 30px; height: 30px; display: block; border-radius: 100px; text-align: center;padding-top:6px; line-height: 28px; }



                               .thanku{padding: 30px 40px;}



                               .thanku p{font-size:13px;}



                               



                               .foot_g img { width: 100%; height: 234px; object-fit: cover; }



                               .foot_logo{ background:#000000; padding: 10px 40px;}



                               .foot_logo img {width: 26%; margin-right:30px;}



                               .need{background: #DAE9EE; padding: 15px 40px; font-size: 13px; line-height: 18px;}



                               .footer .row{align-items: self-end;}



                               .social_mm { display: inline-flex; }



                                }



                                @media screen and (min-width: 200px) and (max-width: 768px) { 



                                    .common_w{width:100%; margin:auto; }



                                    .header_email img {width: 70%;}



                                    .header_email span {left: 0px;}



                                    .banner h1 {padding: 15px; font-size: 20px; text-align: center;}



                                    .banner img {width: 100%; height: auto; object-fit: cover; }



                                    .meddle_content p {width: 100%;}



                                    .foot_g img { width: 100%; height: 164px; object-fit: cover; object-position: center; }



                                    .foot_logo img { width: 53%; }



                                    .thanku {padding: 30px 0px 30px 40px;}



                                    .header_email {text-align: center;}



                                    .social_mm {display: block;}



                                    .foot_logo img {margin-bottom:10px;}



                                    .meddle_content {padding: 30px 30px;}



                                    .view_to {margin-top: 20px;}



                                }



                                ';



                $mailFooter .= '</style>'; 



                $mailFooter .= '<div class="common_w footer" style="background:#ffffff;">';



                    $mailFooter .= '<div class="row m-0" style="background:#ffffff;width:100%;">';



                        $mailFooter .= '<div class="col-sm-6 p-0 col-9" style="background:#ffffff;width:100%;">';



                            $mailFooter .= '<div class="thanku" style="padding: 2px 40px 2px 40px;">';



                                $mailFooter .= '<p style="font-size:13px;">



                                        Thank you,<br>



                                        Stylebuddy Team<br>



                                        Call: '.$site->mobile.'<br>



                                        Email: '.$site->email.'<br>



                                        '.base_url().'



                                        </p>';



                                $mailFooter .= '<div class="social_mm">';



                                    $socialArray=   array( array('image'=>'fb.png','name'=>$site->facebook), array('image'=>'youtube.png','name'=>$site->youtube),array('image'=>'insta.png','name'=>$site->instagram), array('image'=>'linke.png','name'=>$site->linkedin));



                                    $mailFooter .= '<ul style="padding: 0px; margin: 0px; list-style: none; ">';



                                        foreach($socialArray as $p=>$w){



                                                $mailFooter .= '<li style="display: inline-block;"><a style="" target="_blank" href="'.$w['name'].'">';



                                                    //$mailFooter .= '<i class="fa fa-'.$w['image'].'" aria-hidden="true"></i>';



                                                    $mailFooter .= '<img src="'.base_url('assets/images/'.$w['image']).'" style="width: 40px;">';



                                                $mailFooter .= '</a></li>';



                                        }



                                    $mailFooter .= '</ul>';



                                $mailFooter .= '</div>';



                            $mailFooter .= '</div>';



                            



                        $mailFooter .= '</div>';



                        



                    $mailFooter .= '</div>';



                    $mailFooter .= '<div class="foot_logo" style="background:#000000; padding: 10px 40px;">';



                        $mailFooter .= '<div class="social_mm" style="display: inline-flex; ">';



                            $mailFooter .= '<img style="width: 30%; " src="'.base_url('assets/images/'.$site->logo).'" class="img-fluid">';



                        $mailFooter .= '</div>';



                    $mailFooter .= '</div>';



                    



                    $mailFooter .= '<div class="need" style="background: #DAE9EE; padding: 15px 40px; font-size: 13px; line-height: 18px;">';



                        $mailFooter .= 'Need any help? If you have any troubles registering or have a query,<br> please send an email to '.$site->email.'';



                    $mailFooter .= '</div>';



                $mailFooter .= '</div>';



            $mailFooter .= '</body>';



        $mailFooter .= '</html>';



        return $mailFooter;



    }



    



    function mailHtmlHeader_New($site){



 



        $mailHeader  = '<!DOCTYPE html>';



          $mailHeader.='<html xmlns="http://www.w3.org/1999/xhtml">';



          $mailHeader.='<head>';



            $mailHeader.='<title>Forgot PW email</title>';



            $mailHeader.='<meta charset="utf-8">';



            $mailHeader.='<meta name="viewport" content="width=device-width, initial-scale=1">';







            $mailHeader.='<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">';



            $mailHeader.='<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>';



            $mailHeader.='<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">';



            $mailHeader.='<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">';



            



          $mailHeader.='</head>';



          $mailHeader.='<body style="font-family: \'Open Sans\', sans-serif!important; color:#000000!important;">';



            $mailHeader .= '<div class="common_w header_email" style="background:#000000; padding: 20px 20px;">';



                //$mailHeader .= '<div class="social_mm">';



                    $mailHeader.='<img style="width: 40%; " src="'.base_url('assets/images/'.$site->logo).'" class="img-fluid">';



                    $mailHeader.='<span style="color: #fff; font-size: 12px; display: inline-block; position: relative; top: 24px; left: 12px;">Enhance your personal style today!</span>';



                //$mailHeader .= '</div>';



            $mailHeader .= '</div>';







        return $mailHeader;



    }



    function mailHtmlFooter_New_1($site){



                $mailFooter = '<style>';



                    $mailFooter .= '@media screen and (min-width: 500px) {



                                .footer{ background:#ffffff;}



                                .social_mm ul { padding: 0px; margin: 0px; list-style: none; }  



                                .social_mm ul li { display: inline-block; }  



                                .social_mm ul li a { color: #fff; border: 1px solid #fff; width: 30px; height: 30px; display: block; border-radius: 100px; text-align: center;padding-top:6px; line-height: 28px; }



                               .thanku{padding: 30px 40px;}



                               .thanku p{font-size:13px;}



                               



                               .foot_g img { width: 100%; height: 234px; object-fit: cover; }



                               .foot_logo{ background:#000000; padding: 10px 40px;}



                               .foot_logo img {width: 26%; margin-right:30px;}



                               .need{background: #DAE9EE; padding: 15px 40px; font-size: 13px; line-height: 18px;}



                               .footer .row{align-items: self-end;}



                               .social_mm { display: inline-flex; }



                                }



                                @media screen and (min-width: 200px) and (max-width: 768px) { 



                                    .common_w{width:100%; margin:auto; }



                                    .header_email img {width: 70%;}



                                    .header_email span {left: 0px;}



                                    .banner h1 {padding: 15px; font-size: 20px; text-align: center;}



                                    .banner img {width: 100%; height: auto; object-fit: cover; }



                                    .meddle_content p {width: 100%;}



                                    .foot_g img { width: 100%; height: 164px; object-fit: cover; object-position: center; }



                                    .foot_logo img { width: 53%; }



                                    .thanku {padding: 30px 0px 30px 40px;}



                                    .header_email {text-align: center;}



                                    .social_mm {display: block;}



                                    .foot_logo img {margin-bottom:10px;}



                                    .meddle_content {padding: 30px 30px;}



                                    .view_to {margin-top: 20px;}



                                }



                                ';



                $mailFooter .= '</style>'; 



                $mailFooter .= '<div class="common_w footer" style="background:#ffffff;">';



                    $mailFooter .= '<div class="row m-0" style="background:#ffffff;width:100%;">';



                        $mailFooter .= '<div class="col-sm-6 p-0 col-9" style="background:#ffffff;width:100%;">';



                            $mailFooter .= '<div class="thanku" style="padding: 2px 40px 2px 40px;">';



                                $mailFooter .= '<p style="font-size:13px;">



                                        Thank you,<br>



                                        Stylebuddy Team<br>



                                        Call: '.$site->mobile.'<br>



                                        Email: '.$site->email.'<br>



                                        '.base_url().'



                                        </p>';



                                $mailFooter .= '<div class="social_mm">';



                                    $socialArray=   array( array('image'=>'fb.png','name'=>$site->facebook), array('image'=>'youtube.png','name'=>$site->youtube),array('image'=>'insta.png','name'=>$site->instagram), array('image'=>'linke.png','name'=>$site->linkedin));



                                    $mailFooter .= '<ul style="padding: 0px; margin: 0px; list-style: none; ">';



                                        foreach($socialArray as $p=>$w){



                                                $mailFooter .= '<li style="display: inline-block;"><a style="" target="_blank" href="'.$w['name'].'">';



                                                    //$mailFooter .= '<i class="fa fa-'.$w['image'].'" aria-hidden="true"></i>';



                                                    $mailFooter .= '<img src="'.base_url('assets/images/'.$w['image']).'" style="width: 40px;">';



                                                $mailFooter .= '</a></li>';



                                        }



                                    $mailFooter .= '</ul>';



                                $mailFooter .= '</div>';



                            $mailFooter .= '</div>';



                            



                        $mailFooter .= '</div>';



                        



                    $mailFooter .= '</div>';



                    $mailFooter .= '<div class="foot_logo" style="background:#000000; padding: 10px 40px;">';



                        $mailFooter .= '<div class="social_mm" style="display: inline-flex; ">';



                            $mailFooter .= '<img style="width: 30%; " src="'.base_url('assets/images/'.$site->logo).'" class="img-fluid">';



                        $mailFooter .= '</div>';



                    $mailFooter .= '</div>';



                    



                    $mailFooter .= '<div class="need" style="background: #DAE9EE; padding: 15px 40px; font-size: 13px; line-height: 18px;">';



                        $mailFooter .= 'Need any help? If you have any troubles registering or have a query,<br> please send an email to '.$site->email.'';



                    $mailFooter .= '</div>';



                $mailFooter .= '</div>';



            $mailFooter .= '</body>';



        $mailFooter .= '</html>';



        return $mailFooter;



    }



    function mailHtmlFooter_New_2($site){



                $mailFooter = '<style>';



                    $mailFooter .= '@media screen and (min-width: 500px) {



                                .footer{ background:#ffffff;}



                                .social_mm ul { padding: 0px; margin: 0px; list-style: none; }  



                                .social_mm ul li { display: inline-block; }  



                                .social_mm ul li a { color: #fff; border: 1px solid #fff; width: 30px; height: 30px; display: block; border-radius: 100px; text-align: center;padding-top:6px; line-height: 28px; }



                               .thanku{padding: 30px 40px;}



                               .thanku p{font-size:13px;}



                               



                               .foot_g img { width: 100%; height: 234px; object-fit: cover; }



                               .foot_logo{ background:#000000; padding: 10px 40px;}



                               .foot_logo img {width: 26%; margin-right:30px;}



                               .need{background: #DAE9EE; padding: 15px 40px; font-size: 13px; line-height: 18px;}



                               .footer .row{align-items: self-end;}



                               .social_mm { display: inline-flex; }



                                }



                                @media screen and (min-width: 200px) and (max-width: 768px) { 



                                    .common_w{width:100%; margin:auto; }



                                    .header_email img {width: 70%;}



                                    .header_email span {left: 0px;}



                                    .banner h1 {padding: 15px; font-size: 20px; text-align: center;}



                                    .banner img {width: 100%; height: auto; object-fit: cover; }



                                    .meddle_content p {width: 100%;}



                                    .foot_g img { width: 100%; height: 164px; object-fit: cover; object-position: center; }



                                    .foot_logo img { width: 53%; }



                                    .thanku {padding: 30px 0px 30px 40px;}



                                    .header_email {text-align: center;}



                                    .social_mm {display: block;}



                                    .foot_logo img {margin-bottom:10px;}



                                    .meddle_content {padding: 30px 30px;}



                                    .view_to {margin-top: 20px;}



                                }



                                ';



                $mailFooter .= '</style>'; 



                $mailFooter .= '<div class="common_w footer" style="background:#ffffff;">';



                    $mailFooter .= '<div class="row m-0" style="background:#ffffff;width:100%;">';



                        $mailFooter .= '<div class="col-sm-6 p-0 col-9" style="background:#ffffff;width:100%;">';



                            $mailFooter .= '<div class="thanku" style="padding: 2px 40px 2px 40px;">';



                                $mailFooter .= '<p style="font-size:13px;">



                                        Thank you,<br>



                                        Stylebuddy Team<br>



                                        Call: '.$site->mobile.'<br>



                                        Email: '.$site->email.'<br>



                                        '.base_url().'



                                        </p>';



                                $mailFooter .= '<div class="social_mm">';



                                    $socialArray=   array( array('image'=>'fb.png','name'=>$site->facebook), array('image'=>'youtube.png','name'=>$site->youtube),array('image'=>'insta.png','name'=>$site->instagram), array('image'=>'linke.png','name'=>$site->linkedin));



                                    $mailFooter .= '<ul style="padding: 0px; margin: 0px; list-style: none; ">';



                                        foreach($socialArray as $p=>$w){



                                                $mailFooter .= '<li style="display: inline-block;"><a style="" target="_blank" href="'.$w['name'].'">';



                                                    //$mailFooter .= '<i class="fa fa-'.$w['image'].'" aria-hidden="true"></i>';



                                                    $mailFooter .= '<img src="'.base_url('assets/images/'.$w['image']).'" style="width: 40px;">';



                                                $mailFooter .= '</a></li>';



                                        }



                                    $mailFooter .= '</ul>';



                                $mailFooter .= '</div>';



                            $mailFooter .= '</div>';



                            



                        $mailFooter .= '</div>';



                        



                    $mailFooter .= '</div>';



                    $mailFooter .= '<div class="foot_logo" style="background:#000000; padding: 10px 40px;">';



                        $mailFooter .= '<div class="social_mm" style="display: inline-flex; ">';



                            $mailFooter .= '<img style="width: 30%; margin-right:30px;" src="'.base_url('assets/images/'.$site->logo).'" class="img-fluid">';



                        $mailFooter .= '</div>';



                    $mailFooter .= '</div>';



                    



                    $mailFooter .= '<div class="need" style="background: #DAE9EE; padding: 15px 40px; font-size: 13px; line-height: 18px;">';



                        $mailFooter .= 'Need any help? If you have any troubles registering or have a query,<br> please send an email to '.$site->email.'';



                    $mailFooter .= '</div>';



                $mailFooter .= '</div>';



            $mailFooter .= '</body>';



        $mailFooter .= '</html>';



        return $mailFooter;



    }



