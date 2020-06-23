<?

include_once '../core/init.php';

// id орагинизации
// Тула - 96f69088-1469-41ae-954b-390c86eac4bf
// Макси - dfae61dd-1666-4068-b3fb-3cc65be4e0fd


// создание заказа
$order = array();
// show_code('Организация', $organizations["organizations"][0]["id"]);

$order['organizationId']                = "96f69088-1469-41ae-954b-390c86eac4bf"; //id орагинизации в Туле
// $order['terminalGroupId']               = "d16e8f7a-e116-4801-974a-1ee1b28da0d8";
$order['order']['date']                 = date("Y-m-d H:i:s", strtotime("+60 minute"));
$order['order']['items']                = array(
                                            array(
                                              "type" => "Product",
                                              "productId" => "fcc21e12-7f36-4b43-9815-d3c32db89ab1", //id пиццы dish Маргарита
                                              "amount" => "1",
                                              "modifiers" => [
                                                  [
                                                      "productId" => "81d519b8-d856-4fd4-87e8-25be784a0110", //id пиццы modifier 28см Маргарита
                                                      "amount" => 1,
                                                      "productGroupId" => "aa7498d1-8c95-4613-bbfe-b13208302dde" //id категории пиццы Маргарита
                                                  ]
                                              ]                                                
                                            ),
                                            array(
                                              "type" => "Product",
                                              "productId" => "d9ed3ce2-83b1-4928-a9b4-a6d439801280", //id пиццы dish Сан-Доменико
                                              "amount" => "1",
                                              "modifiers" => [
                                                  [
                                                      "productId" => "5643cbb9-7db9-4765-a33e-3686d26f57bb", //id пиццы modifier 28см Сан-Доменико
                                                      "amount" => 1,
                                                      "productGroupId" => "6938f81c-9f18-4ca1-ad2c-b6dc2e6937e6" //id категории пиццы Сан-Доменико
                                                  ]
                                              ]                                                
                                            )  
                                          );  
                                        
// $order['order']['payments']          = array(
//                                             "paymentTypeKind" => "Cash",
//                                             "sum" => 310,
//                                             "paymentTypeId" => "09322f46-578a-d210-add7-eec222a08871", //id типа оплаты Cash
//                                             "isProcessedExternally" => true
//                                         );                            
$order['order']['comment']              = "Тестовый заказ, не готовить!!!!Идет тестирование нового меню";                            
$order['order']['orderServiceType']     = "DeliveryByClient";                            
$order['order']['phone']                = "+79506602664";
$order['order']['customer']['id']       = "00000000-0000-0000-0000-000000000000";
$order['order']['customer']['name']     = "Алексей Бестужев";


 // отправляем запрос и получаем ответ
$string = doOrder($server, $tokenKey, $order, 50);
$responseOrder = json_decode($string, true);


$orderId = $responseOrder["orderInfo"]["id"]; //id заказа
$orderIdOrganization = $responseOrder["orderInfo"]["organizationId"]; //id организации

$_SESSION["orderId"] = $orderId;
$_SESSION["orderIdOrganization"] = $orderIdOrganization;

show_code("responseOrder", $responseOrder);
// show_code("Сам заказ", $order);

?>

<!-- 
структура ответа 10-06-2020 12:59

array(2) {
  ["correlationId"]=>
  string(36) "4dae4c6a-7d18-44ec-aba3-2be989960073"
  ["orderInfo"]=>
  array(6) {
    ["id"]=>
    string(36) "1b7317a9-6ab7-2349-bc0a-5e80c5f971f9"
    ["organizationId"]=>
    string(36) "96f69088-1469-41ae-954b-390c86eac4bf"
    ["timestamp"]=>
    float(1591783814899)
    ["creationStatus"]=>
    string(10) "InProgress"
    ["errorInfo"]=>
    NULL
    ["order"]=>
    NULL
  }
}


 -->