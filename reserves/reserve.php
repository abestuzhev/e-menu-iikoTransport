<? include_once $_SERVER['DOCUMENT_ROOT'] . "/template/header.php" ?>


<div class="layout">
    <h1 class="title">Резерв стола</h1>
    
    <form action="">

    <?

    //показ всех организаций 
    show_code("reserveAllOrganizations", $_SESSION['reserveAllOrganizations']);
    
    //показ всех терминалов 
    show_code("reserveAllRestaurantTerminal", $_SESSION['reserveAllRestaurantTerminal']);

    // массив id терминалов
    show_code("id терминалов", $_SESSION["reserveAllOrganizationsIds"]);
    
    // id заказа банкета и id орагнизации, куда ушел банкет
    show_code("id заказа", $_SESSION["reserveInfoId"]);
    show_code("id организации", $_SESSION["reserveIdOrganization"]);  

    //показ всех терминалов 
    show_code("reserveAllRestaurantSections", $_SESSION['reserveAllRestaurantSections']);

    foreach($_SESSION['reserveAllOrganizations']["organizations"] as $item):?>
        
        <div class="info">
            <label>
                <div class="info-row">
                    <div class="info-label">
                        <input type="radio" value="<?= $item["id"]?>" name="organizations">
                    </div>
                    <div class="info-body">
                        <div class="info-title"><?= $item["name"]?></div>
                        <div class="info-id">id: <?= $item["id"]?></div>
                    </div>
                    
                </div>
                <div class="info-row">
                    <?foreach($_SESSION['reserveAllRestaurantTerminal']["terminalGroups"][0]["items"] as $terminal):?>
                        <div class="info-terminal">
                            <div class="info-subtitle"><?= $terminal["name"]?></div>
                            <div class="info-id">id: <?= $terminal["id"]?></div>
                        </div>
                    <?endforeach?>
                </div>
            </label>
        </div>
    <?endforeach?>
    
    </form>
    
</div>

<? include_once $_SERVER['DOCUMENT_ROOT'] . "/template/footer.php" ?>