<?php

/**
 * Class SSF_Google_Recaptcha
 *
 * Add reCAPTCHA v3 on the website
 *
 * Register reCAPTCHA v3 keys https://g.co/recaptcha/v3
 */

class SSF_Google_Recaptcha {

    private $site_verify_url = 'https://www.google.com/recaptcha/api/siteverify';  // API request verification URL
    private $api_js_url      = 'https://www.google.com/recaptcha/api.js';          // JavaScript API URL
    private $site_key        = '6Lfrj-kUAAAAABjVcvgAUP8WhCrqNpwtbmjfaM9S';                                                 // Site key
    private $secret_key      = '6Lfrj-kUAAAAAO7tQG69wNogfojimAt40XAWes__';                                                 // Secret key
    private $score           = 0.5;                                                // Request score, 1.0 is very likely a good interation, 0.0 is very likely a bot

    public function __construct() {
        $this->add_recaptcha_api_js();
    }

    public function add_field() {
        echo '<input type="hidden" name="g_recaptcha_response" id="g-recaptcha-response">';
    }

    public function add_form_script($action) {
    ?>
        <script>
            grecaptcha.ready(function(){
                grecaptcha.execute("<?php echo $this->site_key; ?>", { action: "<?php echo $action; ?>" }).then(function(token){
                    var recaptcha_response = document.getElementById('g-recaptcha-response');
                    if (recaptcha_response){
                        recaptcha_response.value = token;
                    }
                });
            });
        </script>
    <?php
    }

    public function add_recaptcha_api_js() {
        $url = add_query_arg( array( 'render' => $this->site_key ), $this->api_js_url );
        wp_enqueue_script( 'g-recaptcha-js', $url, array(), null, false );
    }

    public function verify_response() {
        if ( 'POST' === $_SERVER['REQUEST_METHOD'] && isset( $_POST['g_recaptcha_response'] ) ) {
            $url = add_query_arg(
                array(
                    'secret'   => $this->secret_key,
                    'response' => $_POST['g_recaptcha_response']
                ),
                $this->site_verify_url
            );

            $response = file_get_contents( $url );

            $response = json_decode( $response );

            if ( $response->score >= $this->score ) {
                return true;
            }
        }
        return false;
    }
}
