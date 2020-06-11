<? include_once '../core/init.php'; 

// show_code("Массив organizations", $_SESSION['organizations']);
// show_code("Id всех организаций", $_SESSION["allOrganizationsIds"]);
// show_code("Терминалы доставки", $_SESSION['terminals']);
// show_code("Терминалы резерва", $_SESSION['restaurantTerminal']);
// show_code("organizationsAccount", $_SESSION['organizationsAccount']);
// show_code("Секция ресторана", $_SESSION['restaurantSections']);


// show_code("Тип оплаты", $_SESSION['paymentTypes']);





$orderBanquet = array();
// show_code('Организация', $organizations["organizations"][0]["id"]);

$orderBanquet['organizationId']                = $organizations["organizations"][0]["id"]; //id организации Макси

$orderBanquet['order']['items'][]              = array(
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
                                                );                              
$orderBanquet['comment']                       = "Тестирование нового меню, не готовить данный заказ!!!!";                
$orderBanquet['phone']                         = "+79506602664";
$orderBanquet['customer']['id']                = "00000000-0000-0000-0000-000000000000";
$orderBanquet['customer']['name']              = "Алексей Бестужев";
$orderBanquet['guestsCount']                   = 1;
$orderBanquet['durationInMinutes']             = 120;
$orderBanquet['shouldRemind']                  = false;
// $orderBanquet['tableIds']                      = array("00000000-0000-0000-0000-000000000000");
$orderBanquet['estimatedStartTime']            = date("Y-m-d H:i");


// show_code("Массив orderBanquet", $orderBanquet);

 // отправляем запрос и получаем ответ
// $string = createBanquet($server, $tokenKey, $orderBanquet, 50);
// $responseOrderBanquet = json_decode($string, true);
// show_code("Responce заказа банкета", $responseOrderBanquet);

?>