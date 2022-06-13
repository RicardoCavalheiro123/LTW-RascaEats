<?php

    class Answers{
        public int $commentId;
        public string $comment;


        public function __construct(int $commentId,  string $comment)
        {
            $this->commentId = $commentId;
            $this->comment = $comment;
        }

        static function getAnswers($db){
            $stmt = $db->prepare('SELECT * FROM Answer');
            $stmt->execute();
            return $stmt->fetchAll();
        }
        static function setAnswer($db){
            if(isset($_POST['commentSubmit'])){
    
                $answerId = $_POST['answerId'];
                $answer = $_POST['answer'];

                $stmt = $db->prepare('INSERT INTO Answer (commentId, comment) VALUES (?, ?)');
    
                $stmt->execute(array($answerId, $answer));

                echo "<meta http-equiv='refresh' content='0'>";

    
            }
        }


    }



?>
