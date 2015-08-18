/*
 * Soundcloud Controller
 */

class Soundcloud extends CI_Controller {


    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();
        require APPPATH.'/libraries/php-soundcloud-master/Services/Soundcloud.php';
        $this->soundcloud = new Services_Soundcloud('api key', 'api key', 'redirect uri');

    }

    function index(){
        $authorizeUrl = $this->soundcloud->getAuthorizeUrl();
        // Redirect to authorize url
        echo '<a href="' . $authorizeUrl . '">Connect with SoundCloud</a>';
    }

    function getme(){

        $url = $_SERVER['DOCUMENT_ROOT'] . '/' . APPPATH . 'libraries/php-soundcloud-master/test/test.mp3';
        try {
            $accessToken = $this->soundcloud->accessToken($_GET['code']);
        } catch (Services_Soundcloud_Invalid_Http_Response_Code_Exception $e) {
            exit($e->getMessage());
        }

        /*
        $this->soundcloud->setCurlOptions(array(
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0
        ));
        */
        try {
            $me = json_decode($this->soundcloud->get('me'), true);
        } catch (Services_Soundcloud_Invalid_Http_Response_Code_Exception $e) {
            exit($e->getMessage());
        }

// this will print out all my data fine
        echo "<pre>";
            print_r($me);
        echo "</pre>";
        $track_data = array(
            //'track[sharing]' => 'private',
            'track[title]' => 'Testing API',
            //'track[tags]' => null,
            'track[asset_data]' => '@' . $url
        );
        // perform the actual upload to soundcloud.
        try {
            $response = json_decode(
                $this->soundcloud->post('tracks', $track_data),
                true
            );
        } catch (Services_Soundcloud_Invalid_Http_Response_Code_Exception $e) {
            show_error($e->getMessage());
        }

    }