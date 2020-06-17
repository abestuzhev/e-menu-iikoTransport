<? include_once "template/header.php" ?>


<?
// show_code("номенклатура", $_SESSION["numenclature"]["groups"]);
// show_code("номенклатура", $_SESSION["numenclature"]["products"][0]);

$menuCategory = $_SESSION["numenclature"]["groups"];
$products = $_SESSION["numenclature"]["products"];

// show_code("товары", $products);
// show_code("товары", $products[""]);
?>

<div class="layout">
    <h1 class="title-page">iikoTransport menu</h1>

    <div class="title-block">Меню категорий (groups)</div>
    <div class="menu-product">
        <?foreach($menuCategory as $item):?>
            <?if($item["isIncludedInMenu"]):?>
                <div class="menu-product__item" data-id="<?=$item["id"]?>"><?=$item["name"]?></div>
            <?endif?>
        <?endforeach?>
        
    </div>

    


    <div class="product-list">
        <?foreach($products as $item):?>
            <!-- задаем пока категорию пиццы -->
            <?if($item["parentGroup"] === "e44eb9f0-ca1d-44d0-97ed-8dde00b51ec6"):?>
                
                <div class="product-list__item">
                    <div class="product-card" data-id="<?= $item["id"]?>" data-type="<?= $item["type"]?>">
                        <div class="product-card__img">
                            <img src="<?= $item["imageLinks"][0]?>" alt="">
                        </div>
                        <div class="product-card__body">
                            <div class="product-card__title"><?= $item["name"]?></div>
                            <div class="product-card__text"><?= $item["description"]?></div>
                            
                            <div class="product-card__footer">
                                <?if(!empty($item["groupModifiers"])):?>
                                    <div class="product-card-mode">
                                        <?
                                        $currentPrice = array();
                                        ?>
                                        <?foreach($item["groupModifiers"] as $modifier):?>
                                            <?foreach($modifier["childModifiers"] as $modifierElement):?>                                           
                                                <?
                                                $modifierIdArray = array();
                                                array_push($modifierIdArray, $modifierElement["id"]);?>
                                                <?foreach($products as $itemModifire):?>
                                                    <?if( $itemModifire["id"] === $modifierElement["id"]):?>
                                                        <?
                                                        array_push($currentPrice, $itemModifire["sizePrices"][0]["price"]["currentPrice"]);                             
                                                        ?>
                                                        <div class="product-card-mode__item"  
                                                            data-modifier-id="<?=$itemModifire["id"]?>" 
                                                            data-modifier-price="<?=$itemModifire["sizePrices"][0]["price"]["currentPrice"]?>"
                                                        >
                                                            <span><?=$itemModifire["name"]?></span>
                                                        </div>
                                                    <?endif?>
                                                <?endforeach?>

                                            
                                                
                                            <?endforeach?>
                                        <?endforeach?>
                                    </div>
                                <?endif?>
                                <div class="product-card__price">
                                    Цена: 
                                    <?
                                    if(!empty($item["groupModifiers"])){
                                        echo $currentPrice[0];
                                    }else {
                                        echo $item["sizePrices"][0]["price"]["currentPrice"];
                                    }
                                     
                                     ?>
                                     руб.
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            
            <?endif?>
        <?endforeach?>
    </div>   
</div>

<? include_once "template/footer.php" ?>
