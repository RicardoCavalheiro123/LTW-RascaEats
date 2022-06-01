<?php 

    function output_cart(){
        require_once('sql/connection.php');

        $db = getDatabaseConnection();
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $total = 0.0;

        $requests = $_SESSION['cart'][$_GET['id']]; ?>

        <section id = "cart">
        <table>
            <thead>
                <tr><th>Produto</th><th>Quantidade</th><th>Price</th><th>Total</th><th>Remove</th></tr>
            </thead>
                
            
<?php
        foreach(array_keys($requests) as $request){ 
            $qt = $requests[$request];
            $stmt = $db->prepare('SELECT * FROM Dish WHERE dishId = ?');
            $stmt->execute(array($request)); 
            $dish = $stmt->fetch();
            $total += $qt*$dish['price'];
            if($qt <= 0){
                continue;
            }
            ?>
            <tr><td><?=$dish['dishName']?></td><td><?=$qt?></td><td><?=$dish['price']?></td>
            <td><?=$qt*$dish['price']?></td><td><a href="action_remove_from_cart.php?id=<?=$_GET['id']?>&dishId=<?=$request?>">X</a></td></tr>
    <?php } ?>
    <tfoot>
        <tr><th colspan="3">Total:</th><th><?=$total?></th><th></th></tr>
    </tfoot>
    </table>
    <a href="action_place_order.php?id=<?=$_GET['id']?>">Encomendar</a>

    </section> <?php
     }

?>