<?php
class User_libraryDAO {
	private $db;
	const GET_ENTIRE_USER_LIBRARY_SQL = '
			SELECT B.ISBN AS isbn, B.Book_Title AS title, B.Description AS description, B.Published AS published_date, B.Cover_url AS cover, B.Book_url AS location_url,
					B.Pages AS pages, A.F_name AS autor_Fname, A.L_name AS autor_Lname
			FROM library.books B JOIN library.autors A ON B.Autor_Id = A.Id 
			WHERE B.Uploader_Id = :data LIMIT 6 OFFSET :offset';
	
	const GET_USER_BOOKS_BY_AUTOR_SQL = ' SELECT B.ISBN AS isbn, B.Book_Title AS title, B.Description AS description, B.Published AS published_date, B.Cover_url AS cover, B.Book_url AS location_url,
					B.Pages AS pages, A.F_name AS autor_Fname, A.L_name AS autor_Lname 
	FROM library.books B JOIN library.autors A ON B.Autor_Id = A.Id 
    WHERE A.L_name REGEXP :data LIMIT 6 OFFSET :offset';
	public function __construct() {
		$this->db = DBConnection::getDb ();
	}
	
	public function get_user_library($user_id, $offset = 0) {
		
		$offset_num = $offset + 0;		
		$books = $this->user_books_query ( $user_id, $offset_num, self::GET_ENTIRE_USER_LIBRARY_SQL );
		
		if (! empty ( $books )) {
			foreach ( $books as $book ) {
				$user_book =  new User_library ( $book );
				$result [] = $user_book->jsonSerialize();
			}
			return $result;
		}else {
			return 'Няма намерени резултати!';
		}
	}
	
	public function books_by_autor_name($l_name, $offset = 0) {
	
		$offset_num = $offset + 0;		
		$books = $this->user_books_query ( $l_name, $offset_num, self::GET_USER_BOOKS_BY_AUTOR_SQL );
		
		if (! empty ( $books )) {
			foreach ( $books as $book ) {
				$result [] = new User_library ( $book );
			}
			return $result;
		}else {
			return 'Няма намерени резултати!';
		}
	}
	private function user_books_query($data, $offset, $sql_constant) {
		$pstmt = $this->db->prepare ( $sql_constant );
		$pstmt->bindValue ( ':offset', $offset, PDO::PARAM_INT );
		$pstmt->bindValue ( ':data', $data, PDO::PARAM_INT );
		$pstmt->execute ();
		
		$books = $pstmt->fetchAll ( PDO::FETCH_ASSOC );
		return $books;
	}
}
;

?>



