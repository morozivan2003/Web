<?php

namespace App\core;

use PDO;
use PDOException;

class Database
{
    private static ?PDO $pdo = null;

    public static function connect(): PDO
    {
        if (self::$pdo === null) {
            $config = parse_ini_file(DIR . '/../../.env');
            try {
                self::$pdo = new PDO(
                    "mysql:host={$config['DB_HOST']};dbname={$config['DB_NAME']};charset=utf-8",
                    $config['DB_USER'],
                    $config['DB_PASSWORD'],
                    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
                );
            } catch (\Throwable $th) {
                die("Ты инвалид");
            }
        }
        return self::$pdo;
    }
}