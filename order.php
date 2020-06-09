<?

include 'function.php';

$server = "https://api-ru.iiko.services";
$api_key = "00765d2c";

// получаем токен
$tokenResponse = json_decode(getToken($server, $api_key), true); ;
$tokenKey = $tokenResponse['token'];
// show_code('$tokenKey', $tokenKey);


// получаем organizationIds
$organizations = json_decode(getOrganizationsId($server, $tokenKey), true);
// show_code('organizations', $organizations);

// получаем номенклатуру
$numenclature = json_decode(getNumenclature($server, $tokenKey, $organizations["organizations"][0]["id"]), true);
// show_code('$numenclature', $numenclature);

// создание заказа
$order = array();

// show_code('Организация', $organizations["organizations"][0]["id"]);

$order['organizationId']                = $organizations["organizations"][0]["id"];
$order['order']['date']                 = date("Y-m-d H:i:s", strtotime("+60 minute"));
$order['order']['items'][]              = array(
                                            "type" => "Product",
                                            "productId" => "d184abf4-31a5-47e5-baaf-7d2ee40e52b9",
                                            "price" => "20",
                                            "amount" => "1"
                                        );                         
$order['order']['comment']              = "Тестовый заказ, не готовить";                            
$order['order']['orderServiceType']     = "DeliveryByClient";                            
$order['order']['phone']                = "+79506602664";
$order['order']['customer']['id']       = "00000000-0000-0000-0000-000000000000";
$order['order']['customer']['name']     = "Алексей Бестужев";


 // отправляем запрос и получаем ответ
$string = doOrder($server, $tokenKey, $order, 50);
$json = json_decode($string, true);

var_dump($json);

?>