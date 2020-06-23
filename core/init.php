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
// $_SESSION["organizations"] = $organizations;
// получаем id организаций и приводим их понятному виду
// foreach($_SESSION["organizations"] as $item){
    // if($item["name"] == "Тула"){
    //     $_SESSION["org"]["tula"] = $item["id"];
    // }elseif ($item["name"] == "Макси") {
    //     $_SESSION["org"]["maxi"] = $item["id"];
    // } else {
        
    // }
    
// }

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
$_SESSION['reserveAllOrganizations'] = json_decode(
    getAllOrganizations(
        $_SESSION["server"], 
        $_SESSION["tokenKey"]
    ), 
    true);

// получаем restaurant terminal
$_SESSION['reserveAllRestaurantTerminal'] = json_decode(
    getAllTerminalGroups(
        $_SESSION["server"], 
        $_SESSION["tokenKey"]
    ), 
    true);
// получаем id всех терминалов для получения столов
$reserveAllOrganizationsIds = array();
foreach( $_SESSION['reserveAllRestaurantTerminal']["terminalGroups"][0]["items"] as $item => $value) {
    $reserveAllOrganizationsIds[] = $value["id"];
}
$_SESSION["reserveAllOrganizationsIds"] = $reserveAllOrganizationsIds;

// получаем restaurant sections у конкретного терминала
$_SESSION['reserveAllRestaurantSections'] = json_decode(
    getAllRestaurantSections(
        $_SESSION["server"], 
        $_SESSION["tokenKey"]
    ), 
    true);

// получаем номенклатуру
$numenclature = json_decode(getNumenclature($server, $tokenKey, $organizations["organizations"][0]["id"]), true);
// show_code('$numenclature', $numenclature);
$_SESSION["numenclature"] = $numenclature;
    
?>



