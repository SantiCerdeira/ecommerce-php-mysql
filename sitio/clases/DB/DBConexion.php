<?php

namespace FutHistory\DB;

use PDO;
use Exception;

// class DBConexion {
//     public const DB_HOST = '127.0.0.1:3308';
//     public const DB_USER = 'root';
//     public const DB_PASS = '';
//     public const DB_BASE = 'dw3_cerdeira_santiago';
//     public const DB_DSN  = 'mysql:host=' . self::DB_HOST . ';dbname=' . self::DB_BASE . ';charset=utf8mb4';
//     protected static ?PDO $db = null;

//     private static function conectar() {
//         try {
//             self::$db = new PDO(self::DB_DSN, self::DB_USER, self::DB_PASS);
//             self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//         } catch (Exception $e) {
//             require_once __DIR__ . '/../../secciones/error.php' ;
//             exit;
//         }
//     }

//     public static function getConexion(): PDO {
//         if(self::$db === null) {
//             self::conectar();
//         }

//         return self::$db;
//     }
// }

class DBConexion {
    public const DB_HOST = 'sql300.epizy.com';
    public const DB_USER = 'epiz_34278228';
    public const DB_PASS = 'bkj2MB22oiL0vo';
    public const DB_BASE = 'epiz_34278228_dw3_cerdeira_santiago';
    public const DB_DSN  = 'mysql:host=' . self::DB_HOST . ';dbname=' . self::DB_BASE . ';charset=utf8mb4';
    protected static ?PDO $db = null;

    private static function conectar() {
        try {
            self::$db = new PDO(self::DB_DSN, self::DB_USER, self::DB_PASS);
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            require_once __DIR__ . '/../../secciones/error.php' ;
            exit;
        }
    }

    public static function getConexion(): PDO {
        if(self::$db === null) {
            self::conectar();
        }

        return self::$db;
    }
}