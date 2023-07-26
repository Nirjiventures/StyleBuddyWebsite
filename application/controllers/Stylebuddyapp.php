<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stylebuddyapp extends MY_Controller {
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
    public function postid($id=''){
        ob_start();
        ?>
        <script type="text/javascript">
            var post_id = '<?=$id?>';
            
            var IosPackage = 'com.nirji.stylebuddy://';
            var androidPackage = 'com.nirji.stylebuddy://';
            
            var IosUrl = 'https://apps.apple.com/in/app/stylebuddy-india/id1619093846';
            var androidUrl = 'https://play.google.com/store/apps/details?id=com.gmt.stylebuddy';
            
            
            function getMobileOperatingSystem() {
                var userAgent = navigator.userAgent || navigator.vendor || window.opera;
                if (/windows phone/i.test(userAgent)) {
                    return "Windows";
                }
                if (/android/i.test(userAgent)) {
                    return "Android";
                }
                if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {
                    return "iOS";
                }
                return "unknown";
            }
            var a = getMobileOperatingSystem();
            var fallbackToStoreAndroid = function() {
                window.location.replace(androidUrl);
            };
            var openAppAndroid = function() {
                window.location.replace('intent://app/SplashScreen#Intent;scheme=acthub.studio;package=com.justactapp');
            };
            var triggerAppOpenAndroid = function() {
                openAppAndroid();
                setTimeout(fallbackToStoreAndroid, 5000);
            };
            var fallbackToStoreIos = function() {
                window.location.replace(IosUrl);
            };
            var openAppIos = function() {
                var redirectUrl = 'com.nirji.stylebuddy://login?post_id='+post_id;
                console.log(redirectUrl);
        	    //window.close();
        	    window.location.replace(redirectUrl);
        	};
            var triggerAppOpenIos = function() {
                if(post_id == ''){
                    setTimeout(fallbackToStoreIos, 500);
                }
                openAppIos();
                setTimeout(fallbackToStoreIos, 5000);
            };
            
            if(a == 'Android'){
                triggerAppOpenAndroid();
        	}else{
                triggerAppOpenIos();
        	}
        </script>
        
        <?php

    }
    public function userid($id=''){
        ob_start();
        ?>
        <script type="text/javascript">
            var post_id = '<?=$id?>';
            
            var IosPackage = 'com.nirji.stylebuddy://';
            var androidPackage = 'com.nirji.stylebuddy://';
            
            var IosUrl = 'https://apps.apple.com/in/app/stylebuddy-india/id1619093846';
            var androidUrl = 'https://play.google.com/store/apps/details?id=com.gmt.stylebuddy';
            
            
            function getMobileOperatingSystem() {
                var userAgent = navigator.userAgent || navigator.vendor || window.opera;
                if (/windows phone/i.test(userAgent)) {
                    return "Windows";
                }
                if (/android/i.test(userAgent)) {
                    return "Android";
                }
                if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {
                    return "iOS";
                }
                return "unknown";
            }
            var a = getMobileOperatingSystem();
            var fallbackToStoreAndroid = function() {
                window.location.replace(androidUrl);
            };
            var openAppAndroid = function() {
                window.location.replace('intent://app/SplashScreen#Intent;scheme=acthub.studio;package=com.justactapp');
            };
            var triggerAppOpenAndroid = function() {
                openAppAndroid();
                setTimeout(fallbackToStoreAndroid, 5000);
            };
            var fallbackToStoreIos = function() {
                window.location.replace(IosUrl);
            };
            var openAppIos = function() {
                var redirectUrl = 'com.nirji.stylebuddy://login?user_id='+post_id;
                console.log(redirectUrl);
        	    //window.close();
        	    window.location.replace(redirectUrl);
        	};
            var triggerAppOpenIos = function() {
                if(post_id == ''){
                    setTimeout(fallbackToStoreIos, 500);
                }
                openAppIos();
                setTimeout(fallbackToStoreIos, 5000);
            };
            
            if(a == 'Android'){
                triggerAppOpenAndroid();
        	}else{
                triggerAppOpenIos();
        	}
        </script>
        
        <?php

    }
}