<?
    include_once '../core/init.php'; 
?>

<?
$string = UpdateOrderPaymentDetails(
    $_SESSION["server"], 
    $_SESSION["tokenKey"], 
    10, 
    $_SESSION["reserveIdOrganization"], 
    $_SESSION["reserveInfoId"], 
    50
);

show_code('reserveInfoId', $_SESSION["reserveInfoId"]);
show_code('reserveIdOrganization', $_SESSION["reserveIdOrganization"]);

$paymentResponse = json_decode($string, true);
show_code('paymentResponse', $paymentResponse);

// список полей в пункции
// UpdateOrderPaymentDetails(
// $url, 
// $token, 
// $price,
// $reserveIdOrganization, 
// $reserveInfoId, 
// $timeOut);
?>