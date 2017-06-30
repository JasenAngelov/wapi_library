<?php
/*  
 *
	Дата обект за обработка и записване на данни.
	Използваме го за създаване на нови клиенти.
	
	Функционалности:
	
	1. __construct - създава нов обект от клас DBConnection, който се занимава с връзкъта към DB.
	
	2. new_user - Хешира входните данни и ги записва в сървъра.
	
 * 
 */


class CreateUserDAO {
	private $db;
	
	const CREATE_USER_SQL = 'INSERT INTO library.users  (F_name, L_name, Email, Pass) VALUES(?, ?, ?, ?)';
	
	
	public function __construct() {
		$this->db = DBConnection::getDb ();
	}
	public function new_user($fname, $lname, $mail, $pass) {
		
		// -=-=-=-=-=-=-=--==-=-=-=-=-=-= Хеширане на входните данни=-=-=-=-=-=-=-=-=--=-=--=--=-=-=\\
		$hash_email = hash ( 'sha256', $mail);		
		$hash_pass = password_hash($pass, PASSWORD_BCRYPT );		
		// -=-=-=-=-=-=-=--==-=-=-=-=-=-= Край на хеширането =-=-=-=-=-=-=-=-=--=-=-=-=-=-=-=-=-=-=-=-=-=--=-=--=--=-=-=\\
		
		// -=-=-=-=-=-=-=--==-=-=-=-=-=-= Записване на даннире в сървъра =-=-=-=-=-=-=-=-=--=-=-=-=-=-=-=-=-=-=-=-=-=--=-=--=--=-=-=\\
		$pstmt = $this->db->prepare ( self::CREATE_USER_SQL);
		$pstmt->execute ( array (
				$fname,
				$lname,
				$hash_email,
				$hash_pass		
		) );		
		// -=-=-=-=-=-=-=--==-=-=-=-=-=-= Край на записването =-=-=-=-=-=-=-=-=--=-=-=-=-=-=-=-=-=-=-=-=-=--=-=--=--=-=-=\\
		
		
		return $pstmt;
		
	}
}
?>