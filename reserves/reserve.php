<? include_once $_SERVER['DOCUMENT_ROOT'] . "/template/header.php" ?>


<div class="layout">
    <h1 class="title">Резерв стола</h1>

    
    
    
    <form action="">

    <?
    show_code("Id всех организаций через резерв", $_SESSION["organizations"]);

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
    
    </form>
    
</div>

<? include_once $_SERVER['DOCUMENT_ROOT'] . "/template/footer.php" ?>