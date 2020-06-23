<? include_once $_SERVER['DOCUMENT_ROOT'] . "/template/header.php" ?>
<?
show_code("organizations", $_SESSION["organizations"]);
// show_code("org", $_SESSION["org"]);
?>

<?/*show_code("Id всех организаций через резерв", $_SESSION["organizations"]);*/

foreach($_SESSION["organizations"] as $item):?>
    
    <div class="info">
        <label>
            <div class="info-row">
                <div class="info-label">
                    <input type="radio" value="<?= $item["id"]?>" name="organizations">
                </div>
                <div class="info-body">
                    <div class="info-title"><?= $item["name"]?></div>
                    <div class="info-id"><?= $item["id"]?></div>
                </div>
            </div>
        </label>
    </div>
<?endforeach?>

<div class="wrapper">

    <div class="order">
        <div class="order-card">
            <h3 class="order-card__title">Отправка тестового заказа</h3>

            <form action="/order/doOrder.php" method="post" class="form">
                <input type="submit" class="c-btn" value="Отправить заказ">
            </form>
        </div>
        <div class="order-card">
            <h3 class="order-card__title">Изменение типа оплаты у заказа</h3>
            <div class="order-card__text">
                <p>Меняем тип оплаты с "Cash" на "Card"</p>
            </div>
            
            <form action="order/orderPaymentChange.php" method="post">
                <input type="submit" class="c-btn" value="Отправить изменения">
            </form>
        </div>
        
    </div>
    
</div>

<? include_once $_SERVER['DOCUMENT_ROOT'] . "/template/footer.php" ?>