<?php
class LoginDAO {
	private $db;
	const GET_INI_INFO_SQL = 'SELECT Pass AS user_pass FROM library.users WHERE Email = ?';
	const GET_ACCOUNT_INFO_SQL = 'SELECT Id AS user_id, F_name, L_name FROM library.users WHERE Email = ? AND Pass = ?';
	const GET_BOOK_COUNT_SQL = 'SELECT COUNT(B.ISBN) FROM library.books B WHERE B.Uploader_Id = ?';
	public function __construct() {
		$this->db = DBConnection::getDb ();
	}
	public function request_info($login_mail, $login_pass) {
		
		// -=-=-=-=-=-=-=--==-=-=-=-=-=-= Hashing user E-mail for semi-authorization=-=-=-=-=-=-=-=-=--=-=--=--=-=-=\\
		$hash_email = hash ( 'sha256', $login_mail );
		// -=-=-=-=-=-=-=--==-=-=-=-=-=-= END of hashing =-=-=-=-=-=-=-=-=--=-=-=-=-=-=-=-=-=-=-=-=-=--=-=--=--=-=-=\\
		
		// -=-=-=-=-=-=-=--==-=-=-=-=-=-= Starting semi-authorization =-=-=-=-=-=-=-=-=--=-=-=-=-=-=-=-=-=-=-=-=-=--=-=--=--=-=-=\\
		$pstmt = $this->db->prepare ( self::GET_INI_INFO_SQL );
		$pstmt->execute ( array (
				$hash_email 
		) );
		
		$info = $pstmt->fetch ( PDO::FETCH_ASSOC );
		// -=-=-=-=-=-=-=--==-=-=-=-=-=-= END of semi-authorization =-=-=-=-=-=-=-=-=--=-=-=-=-=-=-=-=-=-=-=-=-=--=-=--=--=-=-=\\
		
		// -=-=-=-=-=-=-=--==-=-=-=-=-=-= Starting full-authorization and data retrieving=-=-=-=-=-=-=-=-=--=-=-=-=-=-=-=-=-=-=-=-=-=--=-=--=--=-=-=\\
		if (! empty ( $info )) {
			if (password_verify ( $login_pass, $info ['user_pass'] )) {
				
				
				$pstmt = $this->db->prepare ( self::GET_ACCOUNT_INFO_SQL );
				$pstmt->execute ( array (
						$hash_email,
						$info ['user_pass'] 
				) );
				
				$user_info = $pstmt->fetch ( PDO::FETCH_ASSOC );
				
				//-=-==--=-=--=-==-=--==-=-= Geting the number off books =-=-=--==-=--=-=-=--=--=\\
				$pstmt = $this->db->prepare ( self::GET_BOOK_COUNT_SQL);
				$pstmt->execute ( array ($user_info['user_id']) );
				
				$user_book_count =  $pstmt->fetchColumn();
				
				return new Login ( $user_info , $user_book_count);
				
			} else {
				throw new AutorizationException ( 'Грешно име или парола!' );
			}
		} else {
			throw new AutorizationException ( 'Грешно име или парола!' );
		}
		// -=-=-=-=-=-=-=--==-=-=-=-=-=-= END of full-authorization and data retrieving=-=-=-=-=-=-=-=-=--=-=-=-=-=-=-=-=-=-=-=-=-=--=-=--=--=-=-=\\
	}
}
