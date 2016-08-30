<?php
function sellus_all_header_scripts(){


    wp_enqueue_style( 'filmmed_styles', get_template_directory_uri() . '/modules/sellup/sellup.css' );
    //wp_enqueue_style( 'box_slide_styles', get_template_directory_uri() . '/modules/sellup/lib/jquery.bxslider.css' );

    //wp_enqueue_script( 'box_slide_scripts', get_template_directory_uri() . '/modules/sellup/lib/jquery.bxslider.min.js', array("jquery"). "1.0.0", true);
    wp_enqueue_script( 'filmmed_scripts', get_template_directory_uri() . '/modules/sellup/sellup.js', array("jquery"). "1.0.0", true);



}
add_action('wp_enqueue_scripts', 'sellus_all_header_scripts');


add_action('wp_head','sellip_ajaxurl');
function sellip_ajaxurl() {
    ?>
    <script type="text/javascript">
        var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
    </script>
    <?php
}


add_action('wp_ajax_nopriv_add_subscriber', 'sellup_add_subscriber' );
add_action('wp_ajax_add_subscriber', 'sellup_add_subscriber');
function sellup_add_subscriber () {

    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        echo "Please type valid email address!";
        die();
    }

    $xml_post_string = '<?xml version="1.0" encoding="utf-8"?><soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:soap="http://soap.service.eway">
    <soapenv:Header />
    <soapenv:Body>
    <soap:login>
    <soap:username>soapapi-9282</soap:username>
    <soap:password>Eway12345</soap:password>
    </soap:login>
    </soapenv:Body>
    </soapenv:Envelope>';

    $headers = array(
        "POST /package/package_1.3/packageservices.asmx HTTP/1.1",
        "Host: privpakservices.schenker.nu",
        "Content-Type: application/soap+xml; charset=utf-8",
        "Content-Length: ".strlen($xml_post_string)
    );

    $url = "https://soap.ixs1.net/1/Session";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $response = curl_exec($ch);
    curl_close($ch);

    //echo $response;

    $doc = new DOMDocument();
    $doc->loadXML( $response );

    $LoginResults = $doc->getElementsByTagName( "out" );
    $LoginResult = $LoginResults->item(0)->nodeValue;
    if(!$LoginResult) {
        echo 'The subscription was unsuccessful';
    } else {
        $xml_post_string = '<?xml version="1.0" encoding="utf-8"?><soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/"    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
        <soap:Body>
        <addSubscriber xmlns="http://soap.service.eway">
        <sessionId>'.$LoginResult.'</sessionId>
        <email>'.$_POST["email"].'</email>
        <subscriberData xsi:nil="true"></subscriberData>
        <handlerId>32174</handlerId>
        <handlerData xsi:nil="true" />
        </addSubscriber>
        </soap:Body>
        </soap:Envelope>';
        $headers = array(
            "POST /package/package_1.3/packageservices.asmx HTTP/1.1",
            "Host: privpakservices.schenker.nu",
            "Content-Type: application/soap+xml; charset=utf-8",
            "Content-Length: ".strlen($xml_post_string)
        );
        $url = "https://soap.ixs1.net/1/Subscriber";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($ch);
        curl_close($ch);
        //echo "\n".$response;
        $doc = new DOMDocument();
        $doc->loadXML( $response );
        $SubscribeResultFault = $doc->getElementsByTagName( "Fault" );
        $SubscribeResultFault = $SubscribeResultFault->item(0)->nodeValue;
        if($SubscribeResultFault) {
            echo "\n".'The subscription was unsuccessful';
        } else {
            echo "\n".'The subscription was successful';
        }

    }


    die();
}
?>
