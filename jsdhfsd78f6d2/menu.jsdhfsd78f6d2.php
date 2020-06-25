<?
include_once $_SERVER['DOCUMENT_ROOT'] . '/jsdhfsd78f6d2/function.jsdhfsd78f6d2.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/jsdhfsd78f6d2/index.jsdhfsd78f6d2.php';

// получаем номенклатуру
$numenclature = json_decode( 
    getNumenclature( "https://iiko.biz:9900", trim($_SESSION["token"],'"'), $_SESSION["organizationId"])
    , true); 

// { "deliveryMobile": 
//       "isHide": true,
//       "TimeOfAction: to: , from: " 
// } 
// }

{ 
    "deliveryMobile": { "isHide": true } 
    "iikoTransport": {
        "isHide": true,
        "TimeOfAction": { "to": "value", "from": "value" }
    }
}


//фильтруем скрытые категории и фыормируем массив нужных категорий меню
$menuCategory = array();
foreach($numenclature["groups"] as $groupItem){
    $additionalInfo = json_decode($groupItem["additionalInfo"], true);
    $isHide = $additionalInfo["deliveryMobile"]["isHide"];
    if(!$isHide && $groupItem["isIncludedInMenu"]) {
        array_push($menuCategory, $groupItem);
    }
}
// сформировали новый массив категорий
// если сделать админку, то можно управлять этим меню из интерфейса
$_SESSION["menuCategory"] = $menuCategory;
show_code("Меню без скрытый групп", $_SESSION["menuCategory"]);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Номенклатура </title>
</head>
<body>
<div class="menu">
    <? foreach($_SESSION["menuCategory"] as $item): ?>
        <a href="#" data-id="<?=$item["id"]?>"><?= $item["name"]?></a>

    <?endforeach?>
</div>


<style>
    body {
        font-family: Arial, sans-serif;
        font-size: 16px;
    }
    .menu {
        display: flex;
        flex-flow: row wrap;
        justify-content: flex-start;
        align-items: center;
    }

    .menu a {
        padding: 8px 10px;
        display: inline-block;
        text-decoration: none;
        color: #333;
    }
</style>
    
</body>
</html>