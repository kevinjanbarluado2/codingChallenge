    <?php
    require "./classes/promotion.class.php";

    header('Content-type: application/json');
    $promotion = new Promotion();
    if (isset($_GET)) {
        
        $data=$_GET;
        echo $promotion->insert($_GET);
    }

    ?>