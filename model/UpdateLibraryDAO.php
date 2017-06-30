<?php

/*
	Дата обект за промяна на библиотеката на клиента.
	Използваме го за да добавяме нови книи и автори.
	
	Функционалност:
	
	1. insert_new_book - Вписване на нова книга в DB.
	
	2. check_autor - Проверка дали авторът съществува в DB. При съществуването му, взема неговото ID в противен случай го създава.
	
	3. check_isbn - Проверка за дублаж на ISBN-ът на книгата.

*/

class UpdateLibraryDAO {
	private $db;
	const INSERT_USER_LIBRARY_SQL = '
			INSERT INTO library.books (ISBN, Book_Title, Description, Published, Cover_url, Book_url, Pages, Autor_Id, Uploader_Id) 
			VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';
	const CHECK_IF_AUTOR_EXIST_SQL = 'SELECT a.Id AS autor_id FROM library.autors a WHERE a.F_name =? AND a.L_name = ?';
	const CHECK_IF_ISBN_EXIST_SQL = 'SELECT b.ISBN FROM library.books b WHERE b.ISBN =?';
	const INSERT_NEW_AUTOR_AND_SELECT_NEW_ID_SQL = 'INSERT INTO library.autors (F_name, L_name )VALUES (? , ?); SELECT LAST_INSERT_ID();';
	public function __construct() {
		$this->db = DBConnection::getDb ();
	}
	public function insert_new_book($user_id, $book_info) {
		$fName = $book_info ['autor_Fname'];
		$lName = $book_info ['autor_Lname'];
		
		$this->check_isbn($book_info ['book_isbn']);
		
		$autorId = $this->check_autor ( $fName, $lName );
		
		$pstmt = $this->db->prepare ( self::INSERT_USER_LIBRARY_SQL );
		$pstmt->execute ( array (
				$book_info ['book_isbn'],
				$book_info ['book_title'],
				$book_info ['book_desc'],
				$book_info ['book_pubDate'],
				$book_info ['book_cover'],
				$book_info ['book_res'],
				$book_info ['book_pages'],
				$autorId [0],
				$user_id 
		) );
		
		return $pstmt;
	}
	private function check_autor($fname, $lName) {
		$pstmt = $this->db->prepare ( self::CHECK_IF_AUTOR_EXIST_SQL );
		$pstmt->execute ( array (
				$fname,
				$lName 
		) );
		
		$autorID = $pstmt->fetch ();
		
		if (empty ( $autorID )) {
			
			$pstmt = $this->db->prepare ( self::INSERT_NEW_AUTOR_AND_SELECT_NEW_ID_SQL );
			$pstmt->execute ( array (
					$fname,
					$lName 
			) );
			$autorID = $pstmt->fetch ();
		}
		return $autorID;
	}
	private function check_isbn($isbn) {
		$pstmt = $this->db->prepare ( self::CHECK_IF_ISBN_EXIST_SQL );
		$pstmt->execute ( array ($isbn) );
		
		$isbn_existe = $pstmt->fetchColumn();
		
		if ($isbn_existe != 0) {
			throw new PDOException('Съществуващ ISBN');			
		}
		return;
	}
}
;

?>