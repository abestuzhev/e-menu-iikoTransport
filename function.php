<?


function doOrder($url, $token, $order, $timeOut){

    $headers = array(
        'Content-type: application/json; charset=utf-8',
        'Authorization: Bearer '. $token .'',
        'Timeout: '. $timeOut .''
    );
    $order['order']['id']=   getGUID();
    return curl_post(
            $url . '/api/1/deliveries/create',
            json_encode( $order ),
            array( CURLOPT_HTTPHEADER => $headers )
            );

}

function getGUID(){
    if (function_exists('com_create_guid')){
        return com_create_guid();
    }else{
        mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
        $charId = md5(uniqid(rand(), true));
        $hyphen = chr(45);// "-"
        $uuid =substr($charId, 0, 8).$hyphen
        .substr($charId, 8, 4).$hyphen
        .substr($charId,12, 4).$hyphen
        .substr($charId,16, 4).$hyphen
        .substr($charId,20,12);
        return $uuid;
    }

}

/* ------------------------------------------------------------------------------------ */
/* ------------------------------------------------------------------------------------ */
/* ------------------------------------------------------------------------------------ */
// iikoTransport token
function getToken($url,$api_key){
    return curl_post(
        $url.'/api/1/access_token', 
        '{"apiLogin":"' . $api_key. '"}',
        array(CURLOPT_HTTPHEADER=> array('Content-Type: application/json; charset=utf-8') )// это важно, если не передать Content-Type сервер доставки бросит исключение о недопустимом формате
    );
}

/* ------------------------------------------------------------------------------------ */
function getOrganizationsId($url, $token){
    $headers = array(
        'Content-type: application/json; charset=utf-8',
        'Authorization: Bearer '. $token .'',
        'Timeout: 10'
    );
    return curl_post(
        $url.'/api/1/organizations', 
        '{
            "organizationIds": null,
            "returnAdditionalInfo": false
        }',
        array( CURLOPT_HTTPHEADER => $headers )
    );
}

/* ------------------------------------------------------------------------------------ */
function getNumenclature($url, $token, $organizationId){
    $headers = array(
        'Content-type: application/json; charset=utf-8',
        'Authorization: Bearer '. $token .''
    );
    return curl_post(
        $url.'/api/1/nomenclature', 
        '{
            "organizationId": "'. $organizationId .'",
            "startRevision": 0
        }',
        array( CURLOPT_HTTPHEADER => $headers )
    );
}

/* ------------------------------------------------------------------------------------ */
function curl_post($url, $post = null, array $options = array()) {
    $defaults = array(
                        CURLOPT_POST => 1,
                        CURLOPT_HEADER => 0,
                        CURLOPT_URL => $url,
                        CURLOPT_FRESH_CONNECT => 1,
                        CURLOPT_RETURNTRANSFER => 1,
                        CURLOPT_FORBID_REUSE => 1,
                        CURLOPT_SSL_VERIFYHOST =>0,//unsafe, but the fastest solution for the error " SSL certificate problem, verify that the CA cert is OK"
                        CURLOPT_SSL_VERIFYPEER=>0, //unsafe, but the fastest solution for the error " SSL certificate problem, verify that the CA cert is OK"
                        CURLOPT_POSTFIELDS => $post
                    );
    $ch = curl_init();
    curl_setopt_array($ch, ($options + $defaults));
    if( ! $result = curl_exec($ch)){
        trigger_error(curl_error($ch));
    }
    curl_close($ch);
    return $result;
}

/* ------------------------------------------------------------------------------------ */
function show_code ($title, $elem) {
    echo $title;    
    echo '<pre>';
    var_dump ($elem);
    echo '</pre>';
    echo '--------------------------------';
    echo '<br/>';
    echo '<br/>';
}

?>