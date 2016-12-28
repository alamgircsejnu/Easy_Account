<?php
namespace App;

class dbConnection{

    public function connect()
    {
        $conn = mysql_connect('localhost', 'root', 'acs_bl2016') or die("Server Not Found");
        mysql_select_db('easy_accounts') or die("Database Not Found");
    }


}