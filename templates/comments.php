<?php 

    function output_comments($comments,$answers,$Owner,$db){
            
        foreach($comments as $comment ){?>

            <article class="comments">

                <br>
                <span class="username"><p><?php echo $comment['username'] ?></p></span>
                <span class ="rating"><p><?php echo $comment['rating'] ?></p></span>
                <span class="date"><?=date('Y-m-d', strtotime($comment['published']))?></span>
                <span class ="comment"><p><?php echo $comment['comment'] ?></p></span>
                    
            </article>
            
            <?php
                $hadAnswer = False; 
                foreach($answers as $answer){
                if($answer['commentId'] == $comment['commentId']){
                    $hadAnswer = True;
                    ?>
                    <article class="comments">

                        <br>
                        <span class="usernameOwner"><p>Restaurant Owner</p></span>
                        <span class ="commentOwner"><p><?php echo $answer['comment'] ?></p></span>
                            
                    </article>
                <?php
                    }
                }
                if(!$hadAnswer && $Owner){ ?>
                    <h4>Responder ao comentário do cliente - </h4>

                        <?php
                            echo "<form method='POST' action='".Answers::setAnswer($db)."'> "?>
                            <input type='hidden' name='answerId' value= <?php echo $comment['commentId'] ?> >

                            <textarea name='answer'></textarea><br>

                            <button type='submit' name='commentSubmit'>Comment</button>

                        </form>
                <?php  
                }
                else if($hadAnswer && $Owner){ ?>
                    <form action="delete_answer.php?id=<?php echo $comment['commentId'];?>" method="post" class="deleteAnswer">
                        <button class="button-4" name= "deleteAnswer" id = "deleteAnswer" role="button">Delete Answer</button>
                    </form>
                    <?php
                }

            }

        }

    
    
?>