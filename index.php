<? include_once "template/header.php" ?>


<?
// show_code("номенклатура", $_SESSION["numenclature"]["groups"]);
// show_code("номенклатура", $_SESSION["numenclature"]["products"]);


$modifierAll = array();
$menuCategory = $_SESSION["numenclature"]["groups"];
$products = $_SESSION["numenclature"]["products"];

// show_code("Тип оплаты", $_SESSION['paymentTypes']);
show_code("организации", $_SESSION["organizations"]);
show_code("товары", $_SESSION["numenclature"]);
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
                                                        
                                                        array_push($modifierAll, $itemModifire);
                                                        // usort($array, function($a, $b){
                                                        //     return ($a['price'] - $b['price']);
                                                        // });                                                        
                                                                                    
                                                        array_push($currentPrice, $itemModifire["sizePrices"][0]["price"]["currentPrice"]);                             
                                                        ?>
                                                        <?/*foreach($modifierAll as $item):*/?>
                                                            <div class="product-card-mode__item"  
                                                                data-modifier-id="<?=$itemModifire["id"]?>" 
                                                                data-modifier-price="<?=$itemModifire["sizePrices"][0]["price"]["currentPrice"]?>"
                                                            >
                                                                <?=$itemModifire["name"]?>
                                                            </div>
                                                        <?/*endforeach*/?>
                                                    <?endif?>
                                                <?endforeach?>

                                            
                                                
                                            <?endforeach?>
                                        <?endforeach?>
                                    </div>
                                <?endif?>
                                <div class="product-card__price">
                                    Цена: 
                                    <span class="product-card__price-value">
                                    <?
                                    if(!empty($item["groupModifiers"])){
                                        echo $currentPrice[0];
                                    }else {
                                        echo $item["sizePrices"][0]["price"]["currentPrice"];
                                    }
                                     
                                     ?>
                                     </span>
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

<script>

    const modes = document.querySelectorAll(".product-card-mode");
    console.log(modes);
    for(let i = 0; i < modes.length; i++) {
        modes[i].querySelector(".product-card-mode__item").classList.add("active");;
    } 

    
    const changePriceProduct = (event) => {   

        const $elem = event.target;
        if(!$elem.matches(".product-card-mode__item")) return; //проверка на нужный элемент

        const modifierPrice = $elem.dataset.modifierPrice;
        const $product = $elem.closest(".product-card");
        const $productPrice = $product.querySelector(".product-card__price-value");
        const modifirList = $product.querySelectorAll(".product-card-mode__item")

        
        console.log(modifirList);
        $productPrice.textContent = modifierPrice; //меняем цену в карточке

        // удаялем класс active у всех элементов
        for(let i = 0; i < modifirList.length; i++) {
            modifirList[i].classList.remove("active");
        }        
        $elem.classList.add("active");
    };

    document.addEventListener("click", changePriceProduct);


</script>
<? include_once "template/footer.php" ?>
