<?
    include_once '../core/init.php'; 
?>

<?
$string = UpdateOrderPaymentDetails(
    $_SESSION["server"], 
    $_SESSION["tokenKey"], 
    440,
    $_SESSION["orderIdOrganization"], 
    $_SESSION["orderId"], 
    50
);

show_code('server',  $_SESSION["server"]);
show_code('tokenKey',   $_SESSION["tokenKey"]);
show_code('orderIdOrganization',  $_SESSION["orderIdOrganization"]);
show_code('orderId',  $_SESSION["orderId"]);


$paymentRespomse = json_decode($string, true);
show_code('paymentRespomse', $paymentRespomse);

?>