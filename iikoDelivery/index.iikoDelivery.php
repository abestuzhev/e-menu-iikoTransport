<?

include 'function.php';

    // $order = array();

    
    // $order['organization']              = '44e4dda6-02c4-11e5-80c1-d8d385655247';
    // $order['order']['marketingSource']  = 'e-menu';
    // $order['order']['date']             = date("Y-m-d H:i:s", strtotime("+60 minute"));
    // $order['order']['comment']          = 'Тестирование e-menu';
    // $order['order']['address']['city']  = 'Архангельск';
    // $order['order']['address']['street']= "пр. Дзержинского";
    // $order['order']['address']['home']  = "1";
    // $order['order']['phone']            = '+79506602664';
    // $order['order']['fullSum']          = "20";
    // $order['order']['items'][]          = array(
    //                                         "id"=> "d184abf4-31a5-47e5-baaf-7d2ee40e52b9",
    //                                         "code"=> "2240129",
    //                                         "name"=> "Соус Хайнц томатный 25мл",
    //                                         "amount"=> "1"
    //                                     );
    // $order['customer']['id']            = "9fd34160-8fef-11e4-80d7-002590dc3769";
    // $order['customer']['name']          = "Алексей Бестужев";
    // $order['customer']['phone']         = "+79506602664";



    // d184abf4-31a5-47e5-baaf-7d2ee40e52b9 - соус томатный Heinze

    // получаем токен
    // https://api-ru.iiko.services/api/1/access_token
    $token = getToken("https://iiko.biz:9900","DeliveryPresto","Presto2015");

    // отправляем запрос и получаем ответ
    // $string = doOrder("https://iiko.biz:9900",trim($token,'"'),$order,50);
    $json = json_decode($string, true);

    var_dump($json);


// {
// 	"organization": "1721531da-7ed5-4cf8-3ad1f-370031d2e6b1",
// 	"customer": {
// 		"id": "88529d26-efa5-48e2-af5e-96c245f62d26",
// 		"name": "Client",
// 		"phone": "Phone"
// 	},
// 	"order": {
// 		"id": "76da34ed-7952-49e3-a2fa-4a0283d510b8",
// 		"phone": "Phone",
// 		“isSelfService”: false,
// 		"address": {
// 			"street": "Street-1",
// 			"home": "1"
// 		},
// 		"date": "2011-09-20 18:30:00",
// 		“personsCount”: ”3”,
// 		"items": [{
// 			"id": "040adebb-695a-4687-93bc-4ad30b370b83",
// 			"name": "Пицца",
// 			"amount": "1",
// 			"modifiers": [{
// 				"id": "8a5b6dce-c5d1-4932-9c61-073b3dd57645",
// 				"name": "Топпинг",
// 				"amount": "3",
// 				"groupId": "35e3d0c0-cb19-4bf1-b760-fe8c0061f4d1",
// 				"groupName": "Топпинги для пиццы"
// 			}]
// 		}]
// 	}
// }

?>
