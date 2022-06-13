<?php 

    function output_comments($comments){ 
        
        if(is_null($comments)){ ?>

            <h3>Comentários:</h3>

        <?php } ?>

        <?php foreach($comments as $comment ){?>

            <article class="comments">

                <br>
                <span class="username"><p><?php echo $comment['username'] ?></p></span>
                <span class ="rating"><p><?php echo $comment['rating'] ?></p></span>
                <span class="date"><?=date('Y-m-d', strtotime($comment['published']))?></span>
                <span class ="comment"><p><?php echo $comment['comment'] ?></p></span>
                    
            </article>
<?php   }

    }

    function output_comments_answers($comments){

        if(is_null($comments)){ ?>

            <h3>Comentários:</h3>

        <?php } ?>

        <?php foreach($comments as $comment ){?>

            <article class="comments">

                <br>
                <span class="username"><p><?php echo $comment['username'] ?></p></span>
                <span class ="rating"><p><?php echo $comment['rating'] ?></p></span>
                <span class="date"><?=date('Y-m-d', strtotime($comment['published']))?></span>
                <span class ="comment"><p><?php echo $comment['comment'] ?></p></span>
                    
            </article>
            <section class="answer">

                <form>
                    <textarea name='answer'></textarea><br>
                </form>

            </section>
<?php   }

    }
    
?>