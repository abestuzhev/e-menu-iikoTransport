<? include_once '../core/init.php'; 

$orderBanquet = array();

$orderBanquet['organizationId']                = $organizations["organizations"][0]["id"]; //id организации Макси
$orderBanquet['terminalGroupId']               = "d16e8f7a-e116-4801-974a-1ee1b28da0d8"; //id терминала Зал
$orderBanquet['order']['items'][]              = array(
                                                    "type" => "Product",
                                                    "productId" => "d184abf4-31a5-47e5-baaf-7d2ee40e52b9", //id Соус томатный Хайнц
                                                    "amount" => "1"                                      
                                                );                              
$orderBanquet['comment']                       = "Тестирование нового меню, не готовить данный заказ!!!!";                
$orderBanquet['phone']                         = "+79506602664";
$orderBanquet['customer']['id']                = "00000000-0000-0000-0000-000000000000";
$orderBanquet['customer']['name']              = "Алексей Бестужев";
$orderBanquet['guestsCount']                   = 1;
$orderBanquet['durationInMinutes']             = 120;
$orderBanquet['shouldRemind']                  = false;
$orderBanquet['tableIds']                      = array("b8a53934-19a2-4a2f-9a76-439f7f124e60"); //стол №1 терминала "Зал"
$orderBanquet['estimatedStartTime']            = date("c"); //получаем в формате ISO 2020-06-24T14:22:00"


// show_code("Массив orderBanquet", $orderBanquet);

 // отправляем запрос и получаем ответ
$responseOrderBanquet = json_decode(
    createBanquet($server, $tokenKey, $orderBanquet, 50),
    true);

$_SESSION["reserveInfoId"][] = $responseOrderBanquet["reserveInfo"]["id"]; //id заказа
$_SESSION["reserveIdOrganization"] = $responseOrderBanquet["reserveInfo"]["organizationId"]; //id организации
$_SESSION["reserveCreationStatus"] = $responseOrderBanquet["reserveInfo"]["creationStatus"]; //status InProgress/Success

show_code("Responce заказа банкета", $responseOrderBanquet);


// информационная справка

// пример Responce создания банкета
// Array
// (
//     [correlationId] => fc388dac-d6fe-4e9c-9e57-00088a04e98c
//     [reserveInfo] => Array
//         (
//             [id] => 2beff7dc-5c4f-4f5a-905f-ef46dfabfe87
//             [organizationId] => dfae61dd-1666-4068-b3fb-3cc65be4e0fd
//             [timestamp] => 1592997657384
//             [creationStatus] => InProgress
//             [errorInfo] => 
//         )

// )

// Список действий по получению заказа из банкета для изменения типа оплаты
// 1. Проверка статуса создания банкета
// 2. После создания заказа повторная проверка
// 3. Получаем заказ банкета по id
?>