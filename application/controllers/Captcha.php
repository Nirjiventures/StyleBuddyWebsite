<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Captcha extends CI_Controller
{
    function __construct() {
        parent::__construct();
        if (!file_exists('assets/captcha_images')) {
            mkdir('assets/captcha_images', 0777, true);
        }
        
    }
    public function refresh(){
        $configArray = array(
            'img_path'      => 'assets/captcha_images/',
            'img_url'       => base_url().'assets/captcha_images/',
            'font_path'     => FCPATH.'system/fonts/texb.ttf',
            'img_width'     => '180',
            'img_height'    => 40,
            'word_length'   => 6,
            'class'   => 'code_c',
            'pool'   => 'ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789',
            'font_size'     => 18,
            'colors'        => array(
                    'background' => array(255, 255, 255),
                    'border' => array(255, 255, 255),
                    'text' => array(0, 0, 0),
                    'grid' => array(255, 225, 255)
            )
        );
        $captcha = create_captcha($configArray);
        $this->session->unset_userdata('captchaTextCode');
        $this->session->set_userdata('captchaTextCode',$captcha['word']);
        $cc['image'] =  $captcha['image'];
        $cc['word'] =  $captcha['word'];
        echo json_encode($cc);
    }
}