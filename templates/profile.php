<?php function output_profile_page_pfp($photoSelected, $photo){ ?>

    <div class="header">

        <h1>Profile Page</h1>

        <?php 
        if($photoSelected){ ?>
            <img class="avatar" src=<?php echo $photo ?> alt="Avatar">
                    
                    
            <form action="../pages/photo_select.php" method="post" class="ph">
                        <button class="button-4" role="button">Choose foto</button>
                    </form>    

            <?php
        }
        else{ ?>
            <span class="bold"><p>You didn't select a photo yet!</p></span>
            <div class="photo">
                <form action="../pages/photo_select.php" method="post" class="">
                    <button class="button-4" role="button">Choose foto</button>
                </form>
            </div>
            
            <?php
        }

        ?>

    </div>

<?php } ?>


<?php function output_profile_page_details($name, $username, $email, $adress, $phoneNumber){ ?>

    <div class="details">
        <h1>Details</h1>
        <div class="row">
            <span class="bold">Name:</span> <p><?=$name?></p>
            <form action="../pages/edit_profile.php" method="post" class="logout">
                <button class="button-3" name = "name1" role="button">Edit <i class="fa-solid fa-pen-to-square"></i></button>
            </form>
        </div>
        <div class="row">
            <span class="bold">Username:</span> <p><?=$username?></p>
            <form action="../pages/edit_profile.php" method="post" class="logout">
                <button class="button-3" name = "username" role="button">Edit <i class="fa-solid fa-pen-to-square"></i></button>
            </form>
        </div>
        <div class="row">
            <span class="bold">Email:</span> <p><?=$email?></p>
            <form action="../pages/edit_profile.php" method="post" class="logout">
                <button class="button-3" name = "email" role="button">Edit <i class="fa-solid fa-pen-to-square"></i></button>
            </form>
        </div>
        <div class="row">
            <span class="bold">Password:</span> <p>****</p>
            <form action="../pages/edit_profile.php" method="post" class="logout">
                <button class="button-3"  name = "password" role="button">Edit <i class="fa-solid fa-pen-to-square"></i></button>
            </form>
        </div>
        <div class="row">
            <span class="bold">Address:</span> <p><?=$adress?></p>
            <form action="../pages/edit_profile.php" method="post" class="logout">
                <button class="button-3" name = "adress" role="button">Edit <i class="fa-solid fa-pen-to-square"></i></button>
            </form>
        </div>
        <div class="row">
            <span class="bold">Phone Number:</span> <p><?=$phoneNumber?></p>
            <form action="../pages/edit_profile.php" method="post" class="logout">
                <button class="button-3" name = "phoneNumber" role="button">Edit <i class="fa-solid fa-pen-to-square"></i> </button>
            </form>
        </div>
    </div>

<?php } ?>



