<?php 

    function output_comments($comments){
            
        foreach($comments as $comment ){?>

            <article class="comments">

                <br>
                <span class="username"><p><?php echo $comment['username'] ?></p></span>
                <span class ="comment"><p><?php echo $comment['comment'] ?></p></span>
                    
            </article>
<?php   }

    }
    
?>