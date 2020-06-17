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

    <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
    <link rel="manifest" href="/favicon/site.webmanifest">
    <link rel="mask-icon" href="/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#b91d47">
    <meta name="theme-color" content="#ffffff">

    <meta property="og:url" content="https://pizzapresto.ru">
    <meta property="og:title" content="Быстрая доставка пиццы и роллов «Престо»"/>
    <meta property="og:description" content="Быстрая доставка пиццы, роллов, WOK, салатов и горячих блюд!"/>
    <meta property="og:image" content="https://pizzapresto.ru/bitrix/templates/light2/img/og-img.jpg"/>

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