<?php

class Config {
    public static function DB_HOST() {
        return '127.0.0.1';
    }

    public static function DB_USERNAME() {
        return 'root';
    }

    public static function DB_PASSWORD() {
        return '12345678';
    }

    public static function DB_PORT() 
    {
        return '3306';
    }
    public static function DB_SCHEMA() {
        return 'web';
    }
}

?>
