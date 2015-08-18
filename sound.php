<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE ^ E_DEPRECATED);
$clientId="10795ee3fb0bc2f1ba76f33d92e75ac7";
$clientSecret="b1bb0d93211f90dd1648a76947bd4b9d";
$callback="http://localhost/sound/sound.php";

require_once 'lib/Soundcloud.php';

$soundcloud = new Services_Soundcloud($clientId, $clientSecret, $callback);

$soundcloud->setDevelopment(false);
$soundcloud->setCurlOptions(array(CURLOPT_FOLLOWLOCATION => 1 ,CURLOPT_SSL_VERIFYPEER => 0));


$authorizeUrl = $soundcloud->getAuthorizeUrl();
?>


  <a class="login"href="<?php echo $authorizeUrl; ?>">Connect to Souncloud</a>


<?php

    try {

        // if(!isset($_SESSION['token']))
        // {
        //      print_r($_SESSION);
              $accessToken = $soundcloud->accessToken($_GET['code']);
        //       $_SESSION['token'] = $accessToken['access_token'];
        // }
        // else
        // {
        //     print_r($_SESSION);
        //     $soundcloud->setAccessToken($_SESSION['token']);
        //     print_r($accessToken);
        // }


       echo '<pre>';

    } catch (Services_Soundcloud_Invalid_Http_Response_Code_Exception $e) {
        exit($e->getMessage());
    }

        try {
        $me = json_decode($soundcloud->get('me'), true);
        print_r($me);
        $tracks = json_decode($soundcloud->get('tracks',array('user_id' => $me['id'])), true);
        print_r($tracks);
        $track_url = 'https://soundcloud.com/ankit-bhatt-9/test-4';
        $embed_info = json_decode($soundcloud->get('oembed', array('url' => $track_url)));
        print_r($embed_info->html);
    } catch (Services_Soundcloud_Invalid_Http_Response_Code_Exception $e) {
        exit($e->getMessage());
    }


try {

    $url = 'I:\XAMPP\htdocs\sound\synup.mp3';

   $mytrack =array(
                  'track[title]' => 'sync',
                'track[asset_data]' => '@'.$url
                 );
   $soundcloud->setAccessToken($access_token);
  $track = json_decode($soundcloud->post('/tracks', $mytrack));
      echo '<p><b>Congrats your file successfully uploaded to <a target="_blank" href="'.$track->permalink_url.'">'.$track->permalink_url.'</a>';
}
catch (Services_Soundcloud_Invalid_Http_Response_Code_Exception $e) {
        exit($e->getMessage());
    }
