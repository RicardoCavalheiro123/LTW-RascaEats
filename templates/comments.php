<?php 

    function output_comments($comment){ ?>
            <article class="comment">
            <span class="user"><?php echo $comment['username']; ?>Disse:</span>
            <p><?php echo $comment['text'] ?></p><?php
    }
    
?>