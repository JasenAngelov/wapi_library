<?php
class CreateUserDAO {
	private $db;
	
	const CREATE_USER_SQL = 'INSERT INTO library.users  (F_name, L_name, Email, Pass) VALUES(?, ?, ?, ?)';
	
	
	public function __construct() {
		$this->db = DBConnection::getDb ();
	}
	public function new_user($fname, $lname, $mail, $pass) {
		
		// -=-=-=-=-=-=-=--==-=-=-=-=-=-= Hashing user E-mail and Pass for DB storring=-=-=-=-=-=-=-=-=--=-=--=--=-=-=\\
		$hash_email = hash ( 'sha256', $mail);		
		$hash_pass = password_hash($pass, PASSWORD_BCRYPT );		
		// -=-=-=-=-=-=-=--==-=-=-=-=-=-= END of hashing =-=-=-=-=-=-=-=-=--=-=-=-=-=-=-=-=-=-=-=-=-=--=-=--=--=-=-=\\
		
		// -=-=-=-=-=-=-=--==-=-=-=-=-=-= Starting data transfer =-=-=-=-=-=-=-=-=--=-=-=-=-=-=-=-=-=-=-=-=-=--=-=--=--=-=-=\\
		$pstmt = $this->db->prepare ( self::CREATE_USER_SQL);
		$pstmt->execute ( array (
				$fname,
				$lname,
				$hash_email,
				$hash_pass		
		) );		
		// -=-=-=-=-=-=-=--==-=-=-=-=-=-= END of data transfer =-=-=-=-=-=-=-=-=--=-=-=-=-=-=-=-=-=-=-=-=-=--=-=--=--=-=-=\\
		
		
		return $pstmt;
		
	}
}
?>