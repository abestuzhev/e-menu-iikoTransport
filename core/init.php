<?

session_start();
include_once 'function.php';


$server = "https://api-ru.iiko.services";
$_SESSION["server"] = $server;
$api_key = "00765d2c";


// получаем токен
$tokenResponse = json_decode(getToken($server, $api_key), true); ;
$tokenKey = $tokenResponse['token'];
// show_code('$tokenKey', $tokenKey);
$_SESSION["tokenKey"] = $tokenKey;


// получаем organizationIds
$organizations = json_decode(getOrganizationsId($server, $tokenKey), true);
// show_code('organizations', $organizations);
$_SESSION["organizations"] = $organizations;

// $_SESSION["organizationMaxi"] = $organizations["organizations"][1]["id"];
$_SESSION["organizations"] = $organizations["organizations"];

// Получаем только id всех организаций (необходимо для получения терминалов)
$allOrganizationsIds = array();
foreach($organizations["organizations"] as $item => $value) {
    $allOrganizationsIds[] = array($value["id"]);
}
$_SESSION["allOrganizationsIds"] = $allOrganizationsIds;


// получаем Terminal groups по всем организациям
$terminalResponce = getTerminalGroups(
    $_SESSION["server"], 
    $_SESSION["tokenKey"]
);
$terminalsMaxi = json_decode($terminalResponce, true);
$_SESSION['terminals'] = $terminalsMaxi;


// получаем типы оплат
$paymentTypesResponce = paymentTypes(
    $_SESSION["server"], 
    $_SESSION["tokenKey"],
    50
);
$paymentTypes = json_decode($paymentTypesResponce, true);
$_SESSION['paymentTypes'] = $paymentTypes;


// --------------------------------------------------------------
// RESERVES -----------------------------------------------------
// --------------------------------------------------------------

// получаем id restaurant 
$organizationsAccountResponce = getOrganizationsAccount(
    $_SESSION["server"], 
    $_SESSION["tokenKey"]
);
$organizationsAccount = json_decode($organizationsAccountResponce, true);
$_SESSION['organizationsAccount'] = $organizationsAccount;

// получаем restaurant sections
$restaurantSectionsResponce = getRestaurantSections(
    $_SESSION["server"], 
    $_SESSION["tokenKey"]
);
$restaurantSections = json_decode($restaurantSectionsResponce, true);
$_SESSION['restaurantSections'] = $restaurantSections;

// получаем restaurant terminal
$restaurantTerminalResponce = getRestaurantTerminal(
    $_SESSION["server"], 
    $_SESSION["tokenKey"]
);
$restaurantTerminal = json_decode($restaurantTerminalResponce, true);
$_SESSION['restaurantTerminal'] = $restaurantTerminal;






// получаем номенклатуру
$numenclature = json_decode(getNumenclature($server, $tokenKey, $organizations["organizations"][0]["id"]), true);
// show_code('$numenclature', $numenclature);
$_SESSION["numenclature"] = $numenclature;
    
?>



