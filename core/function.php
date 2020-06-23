<?







function UpdateOrderPaymentDetails($url, $token, $organizationId, $orderId, $timeOut){
    $headers = array(
        'Content-type: application/json; charset=utf-8',
        'Authorization: Bearer '. $token .'',
        'Timeout: '. $timeOut .''
    );
    return curl_post(
            $url . '/api/1/deliveries/update_order_payments',
            '
            {
                "organizationId": "'. $organizationId . '",
                "orderId": "'. $orderId .'",
                "paymentItems": [
                {
                    "sum": 440,
                    "paymentTypeId": "9e03de8c-1587-459e-b5ab-a839e8d842d9",
                    "isProcessedExternally": true
                    }
                ]
            }
            ',
            array( CURLOPT_HTTPHEADER => $headers )
            );

}


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

function createBanquet($url, $token, $orderBanquet, $timeOut){
    $headers = array(
        'Content-type: application/json; charset=utf-8',
        'Authorization: Bearer '. $token .'',
        'Timeout: '. $timeOut .''
    );

    return curl_post(
        $url.'/api/1/reserve/create', 
        json_encode( $orderBanquet ),
        array( CURLOPT_HTTPHEADER => $headers )
    );
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
// Запрос типов оплат
function paymentTypes($url, $token, $timeOut){
    $headers = array(
        'Content-type: application/json; charset=utf-8',
        'Authorization: Bearer '. $token .'',
        'Timeout: '. $timeOut .''
    );
    return curl_post(
        $url.'/api/1/payment_types', 
        '{
            "organizationIds": [
            "dfae61dd-1666-4068-b3fb-3cc65be4e0fd"
            ]
        }',
        array( CURLOPT_HTTPHEADER => $headers )
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
// dfae61dd-1666-4068-b3fb-3cc65be4e0fd - id Макси
function getTerminalGroups($url, $token){
    $headers = array(
        'Content-type: application/json; charset=utf-8',
        'Authorization: Bearer '. $token .''
    );
    return curl_post(
        $url.'/api/1/terminal_groups', 

        '{
            "organizationIds": [
                "dfae61dd-1666-4068-b3fb-3cc65be4e0fd"
            ]
        }',
        array( CURLOPT_HTTPHEADER => $headers )
    );
}

// --------------------------------------------------------------
// START RESERVES -----------------------------------------------------
// --------------------------------------------------------------
/* ------------------------------------------------------------------------------------ */

// Массив организаций, которые поддерживают резерв столов
// Доступно с версии 7.1.5
// Если передать по умолчанию весь массив организаций, 
// то выдает ошибку, т.к. организации с более ранними версиями не игнорируются
$organizationReserveAvailible = [
    "dfae61dd-1666-4068-b3fb-3cc65be4e0fd" //id Макси
];
// получение id организации через резерв
function getAllOrganizations($url, $token){
    $headers = array(
        'Content-type: application/json; charset=utf-8',
        'Authorization: Bearer '. $token .''
    );
    return curl_post(
        $url.'/api/1/reserve/available_organizations', 
        '{
            "organizationIds": null,
            "returnAdditionalInfo": false,
            "includeDisabled": false
        }',
        array( CURLOPT_HTTPHEADER => $headers )
    );
}

/* ------------------------------------------------------------------------------------ */
// id терминала макси
function getAllTerminalGroups($url, $token){
    $headers = array(
        'Content-type: application/json; charset=utf-8',
        'Authorization: Bearer '. $token .''
    );
    return curl_post(
        $url.'/api/1/reserve/available_terminal_groups', 
        '{
            "organizationIds": [
                "dfae61dd-1666-4068-b3fb-3cc65be4e0fd"
            ]
        }',
        array( CURLOPT_HTTPHEADER => $headers )
    );
}

/* ------------------------------------------------------------------------------------ */
// получаем столы с терминала
// d16e8f7a-e116-4801-974a-1ee1b28da0d8 - Макси Зал
// f9511a55-41d9-4730-aee9-f547f6f473de - Макси Доставка

$arr001 = [
    "d16e8f7a-e116-4801-974a-1ee1b28da0d8",
    "f9511a55-41d9-4730-aee9-f547f6f473de"
];

function getAllRestaurantSections ($url, $token){
    $headers = array(
        'Content-type: application/json; charset=utf-8',
        'Authorization: Bearer '. $token .''
    );
    return curl_post(
        $url.'/api/1/reserve/available_restaurant_sections', 
        '{
            "terminalGroupIds": '.json_encode($_SESSION["reserveAllOrganizationsIds"]).',
            "returnSchema": false
        }',
        array( CURLOPT_HTTPHEADER => $headers )
    );
}



// --------------------------------------------------------------
// END RESERVES -----------------------------------------------------
// --------------------------------------------------------------

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
    print_r ($elem);
    echo '</pre>';
    echo '--------------------------------';
    echo '<br/>';
    echo '<br/>';
}