<?php 
    function getDatabaseConnection(){
        return new PDO('sqlite:sql/database.db');
    } 
?>