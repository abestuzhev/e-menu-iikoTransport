<?
include_once "template/header.php";
?>


<div class="layout">

    <?
    //показ всех организаций
    show_code("reserveAllOrganizations", $_SESSION['reserveAllOrganizations']);

    //показ всех терминалов
    show_code("reserveAllRestaurantTerminal", $_SESSION['reserveAllRestaurantTerminal']);


    if(!empty($_SESSION["reserveInfoId"])){
        // id заказа банкета и id орагнизации, куда ушел банкет
        show_code("id заказа", $_SESSION["reserveInfoId"]);
        show_code("id организации", $_SESSION["reserveIdOrganization"]);
    }


    //показ всех терминалов
    show_code("reserveAllRestaurantSections", $_SESSION['reserveAllRestaurantSections']);
    ?>

</div>