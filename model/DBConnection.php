<?php
/*
 * The DB password should be kept in a file on the server. That noted I added the pasword in a file on the prject for more convinience!
 */
class DBConnection {
	private static $db = null;
	const DB_HOST = 'localhost';
	const DB_NAME = 'library';
	const DB_USER = 'root';
	public static function getDb() {
		if (self::$db === null) {
			try {
				
// 				$pass = trim ( file_get_contents ( 'C:\xampp\htdocs\FinalProject\db__credentials\client-pass.txt' ) );
				$pass = '';
				
				self::$db = new PDO ( "mysql:host=" . self::DB_HOST . ";dbname=" . self::DB_NAME, self::DB_USER, $pass );
				self::$db->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			} catch ( PDOException $e ) {
				throw new PDOException ( $e );
			}
		}
		return self::$db;
	}
}

?>