<?
include_once "template/header.php";

$modifierAll = array();
$menuCategory = $_SESSION["numenclature"]["groups"];
$products = $_SESSION["numenclature"]["products"];

// show_code("Тип оплаты", $_SESSION['paymentTypes']);
// show_code("организации", $_SESSION["organizations"]);
// show_code("товары", $_SESSION["numenclature"]);
// show_code("товары", $products[""]);
?>

<!-- **************************************** -->
<!-- **************************************** -->
<!-- **************************************** -->
<!-- Сортировка по порядку и скрытие ненужных категорий -->
<?
$menuCategoryShow = array();
foreach ($menuCategory as $item) {
    $additionalInfo = json_decode($item["additionalInfo"], true);
    $isHide = $additionalInfo["eMenu"]["isHide"]; // признак по которому прячем группы из внешнего меню

    $isGroupModifier = $item["isGroupModifier"]; //группа не является группой модификаторов
    if (!$isHide && !$isGroupModifier) {
        array_push($menuCategoryShow, $item);
    }
}
//сортировка массива по признаку order
$numOrder = array_column($menuCategoryShow, 'order');
array_multisort($numOrder, SORT_ASC, $menuCategoryShow);
//    show_code("menuCategoryShow", $menuCategoryShow);
?>

<!-- **************************************** -->
<!-- **************************************** -->
<!-- **************************************** -->


<div class="layout">
   <div class="menu-product">
       <? foreach ($menuCategoryShow as $item): ?>
          <a href="#<?= $item["id"] ?>" class="menu-product__item" data-id="<?= $item["id"] ?>"><?= $item["name"] ?></a>
       <? endforeach ?>
   </div>

   <!-- **************************************** -->
   <!-- **************************************** -->
   <!-- **************************************** -->
   <!-- Сортировка в категории, по порядку и скрытие ненужных блюд -->
    <?

    $menuProductsShow = [];//общий массив блюд

    foreach ($menuCategoryShow as $key => $category) {
        $menuItems = []; //временный массив блюд, выбранных для одной категории

        foreach ($products as $item) {

            //проверка на скрытие блюда в поле техническая инофрмация в iiko
            $itemAdditionalInfo = json_decode($item["additionalInfo"], true);
            $isHide = $itemAdditionalInfo["eMenu"]["isHide"]; // признак по которому прячем группы из внешнего меню
            $isGroupModifier = $item["isGroupModifier"]; //группа не является группой модификаторов, иначе появляются ненужные группы

            //проверка на скрытие по признаку isHide: true
            if (!$isHide && !$isGroupModifier) {

               // проверка на соответствие блюда определенной категории
                if ($category["id"] === $item["parentGroup"]) {
                    array_push($menuItems, $item);
                }
            }
        }

        //сортировка массива по признаку order (чтобы была сортировка как во внешнем меню)
        $menuItemsOrder = array_column($menuItems, 'order');
        array_multisort($menuItemsOrder, SORT_ASC, $menuItems);


        //формируют общий массив данными
        $menuProductsShow[$key]["category"]["id"] = $category["id"]; //id категории
        $menuProductsShow[$key]["category"]["title"] = $category["name"]; // название категории
        $menuProductsShow[$key]["products"] = $menuItems; //список блюд, соответствующей категории
    }

    ?>
   <!-- **************************************** -->
   <!-- **************************************** -->
   <!-- **************************************** -->

   <div class="products">
       <? foreach ($menuProductsShow as $menuItem): ?>
          <div class="products-item" id="<?= $menuItem["category"]["id"] ?>">

             <h2 class="products-item__title">
                 <?= $menuItem["category"]["title"] ?>
             </h2>

             <div class="product-list">
                <!-- задаем пока категорию пиццы -->
                 <? foreach ($menuItem["products"] as $item): ?>


                    <div class="product-list__item">
                       <div class="product-card" data-id="<?= $item["id"] ?>" data-type="<?= $item["type"] ?>">
                          <div class="product-card__img">
                             <img src="<?= $item["imageLinks"][0] ?>" alt="">
                          </div>
                          <div class="product-card__body">
                             <div class="product-card__title"><?= $item["name"] ?></div>
                             <div class="product-card__text"><?= $item["description"] ?></div>

                             <div class="product-card__footer">
                                 <? if (!empty($item["groupModifiers"])): ?>
                                    <div class="product-card-mode">
                                        <?
                                        $currentPrice = array();
                                        ?>
                                        <? foreach ($item["groupModifiers"] as $modifier): ?>
                                            <? foreach ($modifier["childModifiers"] as $modifierElement): ?>
                                                <?
                                                $modifierIdArray = array();
                                                array_push($modifierIdArray, $modifierElement["id"]); ?>
                                                <? foreach ($products as $itemModifire): ?>
                                                    <? if ($itemModifire["id"] === $modifierElement["id"]): ?>
                                                        <?

                                                        array_push($modifierAll, $itemModifire);
                                                        // usort($array, function($a, $b){
                                                        //     return ($a['price'] - $b['price']);
                                                        // });

                                                        array_push($currentPrice, $itemModifire["sizePrices"][0]["price"]["currentPrice"]);
                                                        ?>
                                                        <? /*foreach($modifierAll as $item):*/ ?>
                                                    <div class="product-card-mode__item"
                                                         data-modifier-id="<?= $itemModifire["id"] ?>"
                                                         data-modifier-price="<?= $itemModifire["sizePrices"][0]["price"]["currentPrice"] ?>"
                                                    >
                                                        <?= $itemModifire["name"] ?>
                                                    </div>
                                                        <? /*endforeach*/ ?>
                                                    <? endif ?>
                                                <? endforeach ?>


                                            <? endforeach ?>
                                        <? endforeach ?>
                                    </div>
                                 <? endif ?>
                                <div class="product-card__price">
                                   Цена:
                                   <span class="product-card__price-value">
                                 <?
                                 if (!empty($item["groupModifiers"])) {
                                     echo $currentPrice[0];
                                 } else {
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

                 <? endforeach ?>
             </div>
          </div>
       <? endforeach ?>
   </div>


</div>

<script>

   //скрипт переключения размеров пицц

   const modes = document.querySelectorAll(".product-card-mode");
   console.log(modes);
   for (let i = 0; i < modes.length; i++) {
      modes[i].querySelector(".product-card-mode__item").classList.add("active");

   }


   const changePriceProduct = (event) => {

      const $elem = event.target;
      if (!$elem.matches(".product-card-mode__item")) return; //проверка на нужный элемент

      const modifierPrice = $elem.dataset.modifierPrice;
      const $product = $elem.closest(".product-card");
      const $productPrice = $product.querySelector(".product-card__price-value");
      const modifirList = $product.querySelectorAll(".product-card-mode__item");


      console.log(modifirList);
      $productPrice.textContent = modifierPrice; //меняем цену в карточке

      // удаялем класс active у всех элементов
      for (let i = 0; i < modifirList.length; i++) {
         modifirList[i].classList.remove("active");
      }
      $elem.classList.add("active");
   };

   document.addEventListener("click", changePriceProduct);


</script>
<? include_once "template/footer.php" ?>
