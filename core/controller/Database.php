<?php

class Database
{
    public static $db;
    public static $con;
    public static $DB_host = "localhost";
    public static $DB_name = "bibliotecaitsi";

    function Database()
    {
        $this->user = "root";
        $this->pass = "";
        $this->puerto = "3306";
        $this->host = "localhost";
        $this->ddbb = "bibliotecaitsi";
    }

    function connect()
    {
        try {
            $con = new PDO(
                "mysql:host=$this->host;dbname=$this->ddbb",
                $this->user,
                $this->pass,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
            );

            $con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            return $con;
        } catch (PDOException $e) {
            die("No se puede conectar a la base de datos" . $e->getMessage());
        }
    }

    public static function getCon()
    {
        if (self::$con == null && self::$db == null) {
            self::$db = new Database();
            self::$con = self::$db->connect();
        }
        return self::$con;
    }
}
