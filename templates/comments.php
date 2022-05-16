<?php 

    function output_comments($comments){
            
        foreach($comments as $comment ){?>

            <article class="comment">
                <p><?php echo $comment['username'] ?> disse: </p>
                <p><?php echo $comment['comment'] ?></p>
            </article>
<?php   }
    }
    
?>