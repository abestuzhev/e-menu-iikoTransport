<? include_once "template/header.php" ?>

<div class="wrapper">

    <div class="order">
        <div class="order-card">
            <h3 class="order-card__title">Отправка тестового заказа</h3>

            <form action="order/doOrder.php" method="post" class="form">
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

<? include_once "template/footer.php" ?>