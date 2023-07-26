<?php
    $api_user = '1394780790';
    $api_secret = 'HS8opKcFe35pGYVokKXB';

    $params = array(
      'text' => 'Contact rick(at)gmail(dot)com to have s_*_x',
      'lang' => 'en',
      'opt_countries' => 'us,gb,fr',
      'mode' => 'standard',
      'api_user' => $api_user,
      'api_secret' => $api_secret,
    );

    // this example uses cURL
    $ch = curl_init('https://api.sightengine.com/1.0/text/check.json');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    $response = curl_exec($ch);
    curl_close($ch);

    $output = json_decode($response, true);

    var_dump($output);
    /*function isMobile() {

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
        //return false;
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
    $postData['title'] = 'fuck';
    $postData['description'] = 'fuck';

    $check_content_sightengine = array();

    $check_content_sightengine['title'] = $postData['title'];;

    $check_content_sightengine['description'] = $postData['description'];;

    $dd = check_content_sightengine($check_content_sightengine);

    if ($dd) {
        $msg = 'Your request could not be submitted because you enter inappropriate content.';
        $response = array(
                'status' => 'fail',
                'message' =>  $msg,
            );
         var_dump($response);
    }*/
    
    