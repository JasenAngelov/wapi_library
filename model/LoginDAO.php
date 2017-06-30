<?php

/*
	Дата обект, който вписва клиента в профила му.
	
	Функционалност:
	
	1. request_info - Извлича първоначална информация от DB на базата на клиентският E-mail. Информацията се използва за по нататъчна валидация.
	
*/


class LoginDAO {
	private $db;
	const GET_INI_INFO_SQL = 'SELECT Pass AS user_pass FROM library.users WHERE Email = ?';
	const GET_ACCOUNT_INFO_SQL = 'SELECT Id AS user_id, F_name, L_name FROM library.users WHERE Email = ? AND Pass = ?';
	const GET_BOOK_COUNT_SQL = 'SELECT COUNT(B.ISBN) FROM library.books B WHERE B.Uploader_Id = ?';
	public function __construct() {
		$this->db = DBConnection::getDb ();
	}
	public function request_info($login_mail, $login_pass) {
		
		// -=-=-=-=-=-=-=--==-=-=-=-=-=-= Хеширане на Мейл =-=-=-=-=-=-=-=-=--=-=--=--=-=-=\\
		$hash_email = hash ( 'sha256', $login_mail );
		// -=-=-=-=-=-=-=--==-=-=-=-=-=-= Край на хеширането =-=-=-=-=-=-=-=-=--=-=-=-=-=-=-=-=-=-=-=-=-=--=-=--=--=-=-=\\
		
		// -=-=-=-=-=-=-=--==-=-=-=-=-=-= Междинна верификация =-=-=-=-=-=-=-=-=--=-=-=-=-=-=-=-=-=-=-=-=-=--=-=--=--=-=-=\\
		$pstmt = $this->db->prepare ( self::GET_INI_INFO_SQL );
		$pstmt->execute ( array (
				$hash_email 
		) );
		
		$info = $pstmt->fetch ( PDO::FETCH_ASSOC );
		// -=-=-=-=-=-=-=--==-=-=-=-=-=-= Край на междинната верификация =-=-=-=-=-=-=-=-=--=-=-=-=-=-=-=-=-=-=-=-=-=--=-=--=--=-=-=\\
		
		// -=-=-=-=-=-=-=--==-=-=-=-=-=-= Пълна верификация g=-=-=-=-=-=-=-=-=--=-=-=-=-=-=-=-=-=-=-=-=-=--=-=--=--=-=-=\\
		if (! empty ( $info )) {
			if (password_verify ( $login_pass, $info ['user_pass'] )) {
				
				
				$pstmt = $this->db->prepare ( self::GET_ACCOUNT_INFO_SQL );
				$pstmt->execute ( array (
						$hash_email,
						$info ['user_pass'] 
				) );
				
				$user_info = $pstmt->fetch ( PDO::FETCH_ASSOC );
				
				//-=-==--=-=--=-==-=--==-=-= Извличане на общия брой на книгите на клиента =-=-=--==-=--=-=-=--=--=\\
				$pstmt = $this->db->prepare ( self::GET_BOOK_COUNT_SQL);
				$pstmt->execute ( array ($user_info['user_id']) );
				
				$user_book_count =  $pstmt->fetchColumn();
				
				//-=-==--=-=--=-==-=--==-=-= Край на извличането =-=-=--==-=--=-=-=--=--=\\
				
				return new Login ( $user_info , $user_book_count);
				
			} else {
				throw new AutorizationException ( 'Грешно име или парола!' );
			}
		} else {
			throw new AutorizationException ( 'Грешно име или парола!' );
		}
		// -=-=-=-=-=-=-=--==-=-=-=-=-=-= Край на пълната верификация=-=-=-=-=-=-=-=-=--=-=-=-=-=-=-=-=-=-=-=-=-=--=-=--=--=-=-=\\
	}
}
