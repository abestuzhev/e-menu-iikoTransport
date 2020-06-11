<?
    
    include_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';

    $menu_page = array(
        "Главная" => "index.php",
        "Отправка заказа" => "order/order.php",
        "Резерв" => "reserves/reserve.php"
    );
        
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?$_SERVER['DOCUMENT_ROOT'] ?>/template/css/reset.css">
    <link rel="stylesheet" href="<?$_SERVER['DOCUMENT_ROOT'] ?>/template/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <title>iikoTransport</title>
</head>
<body>
    
<div class="wrapper">


    <div class="menu">
        <?foreach ($menu_page as $name => $href):?>
        <div class="menu-item">
            <a href="<?= $href ?>"><?= $name ?></a>
        </div>
        <?endforeach?>
    </div>