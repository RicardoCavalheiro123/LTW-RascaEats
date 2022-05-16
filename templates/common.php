<?php 
    declare(strict_types = 1); 
?>


<?php function drawLogoutForm(string $name) { ?>
  <form action="actionlogout.php" method="post" class="logout">
  <a href="profilePage.php"><?=$name?></a>
    <button type="submit">Logout</button>
  </form>
<?php } ?>