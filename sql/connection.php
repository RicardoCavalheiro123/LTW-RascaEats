<?php 
    function getDatabaseConnection(){
        return new PDO('sqlite:sql/DATABASE.db');
    } 
?>