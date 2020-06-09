<?
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
function doOrder($url,$token,$order,$timeOut){
//		$order['customer']['id']=getGUID();//у покупателя должен быть guid, сгенерируем его
    $order['order']['id']=   getGUID();// у заказа должен быть guid, сгенерируем его
//	$order['order']['date'] = date('Y-m-d H:i:s');//у заказа должна быть дата в данном формате 2014-04-15 12:15:20
    return curl_post(
                $url.'/api/0/orders/add?access_token='.$token.'&requestTimeout='.$timeOut,
                json_encode($order),
                array(CURLOPT_HTTPHEADER=> array('Content-Type: application/json; charset=utf-8') )// это важно, если не передать Content-Type сервер доставки бросит исключение о недопустимом формате
                );

}
/* ------------------------------------------------------------------------------------ */
function getOrderInfo($url,$organization,$token,$orderID,$timeOut){
    return curl_get($url.'/api/0/orders/info?access_token='.$token.'&organization='.$organization.'&order='.$orderID.'&request_timeout='.$timeOut);
}
/* ------------------------------------------------------------------------------------ */
function getToken($url,$user,$secret){
    return curl_get($url.'/api/0/auth/access_token',array('user_id'=>$user,'user_secret'=>$secret));
}
/* ------------------------------------------------------------------------------------ */
function getNomenclature($url,$organization,$token){
    return curl_get($url.'/api/0/nomenclature/'.$organization,array('access_token'=>$token));
}
/* ------------------------------------------------------------------------------------ */
function addUser($url,$organization,$token,$user_name,$user_phone){
    return curl_post(
        $url.'/api/0/customers/create_or_update?access_token='.$token.'&organization='.$organization,
		'{"customer":{"phone":"'.$user_phone.'","name":"'.$user_name.'"}}',
		array(CURLOPT_HTTPHEADER=> array('Content-Type: application/json; charset=utf-8') )// это важно, если не передать Content-Type сервер доставки бросит исключение о недопустимом формате
	);
}

/* ------------------------------------------------------------------------------------ */
function curl_get($url, array $get = NULL, array $options = array()) {
    $defaults = array(
                       CURLOPT_URL => $url . (strpos($url, '?') === FALSE ? '?' : '') . http_build_query($get) ,
                       CURLOPT_HEADER => 0,
                       CURLOPT_RETURNTRANSFER => TRUE,
                       CURLOPT_DNS_USE_GLOBAL_CACHE => false,
                       CURLOPT_SSL_VERIFYHOST => 0, //unsafe, but the fastest solution for the error " SSL certificate problem, verify that the CA cert is OK"
                       CURLOPT_SSL_VERIFYPEER => 0, //unsafe, but the fastest solution for the error " SSL certificate problem, verify that the CA cert is OK"
                      );
    $ch = curl_init();
    curl_setopt_array($ch, ($options + $defaults));
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


    if (!$result = curl_exec($ch)) {
        trigger_error(curl_error($ch));
    }

    curl_close($ch);
    return $result;
}

    