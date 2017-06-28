<?php
class User_libraryDAO {
	private $db;
	
	const GET_ENTIRE_USER_LIBRARY_SQL = '
			SELECT B.ISBN AS isbn, B.Book_Title AS title, B.Description AS description, B.Published AS published_date, B.Cover_url AS cover, B.Book_url AS location_url,
					B.Pages AS pages, A.F_name AS autor_Fname, A.L_name AS autor_Lname
			FROM library.books B JOIN library.autors A ON B.Autor_Id = A.Id 
			WHERE B.Uploader_Id = :data LIMIT 6 OFFSET :offset';
	
	const GET_USER_BOOKS_BY_SEARCH_SQL = ' SELECT B.ISBN AS isbn, B.Book_Title AS title, B.Description AS description, B.Published AS published_date, B.Cover_url AS cover, B.Book_url AS location_url,
					B.Pages AS pages, A.F_name AS autor_Fname, A.L_name AS autor_Lname 
	FROM library.books B JOIN library.autors A ON B.Autor_Id = A.Id 
    WHERE b.Book_Title LIKE :title  OR a.F_name LIKE :fname OR a.L_name LIKE :lname AND b.Uploader_Id = :upId  LIMIT 6 OFFSET :offset';
	
	public function __construct() {
		$this->db = DBConnection::getDb ();
	}
	
	public function get_user_library($user_id, $offset = 0) {
		$offset_num = $offset + 0;
		$books = $this->user_books_query ( $user_id, $offset_num, self::GET_ENTIRE_USER_LIBRARY_SQL );
		
		if (! empty ( $books )) {
			foreach ( $books as $book ) {
				$user_book = new User_library ( $book );
				$result [] = $user_book->jsonSerialize ();
			}
			return $result;
		} else {
			return 'Няма намерени резултати!';
		}
	}
	
	public function books_by_search($data, $userId) {
				
		$offset = 0;
		
		if (count ( $data ) <= 3) {
			switch (count ( $data )) {
				case 1 :
					$title =  '%' . $data [0] . '%';
					$fname = '%' . $data [0] . '%';
					$lname = '%' . $data [0] . '%';
					break;
					
				case 2 :
					$title= '';
					$fname = '%' . $data [0] . '%';
					$lname = '%' . $data [1] . '%';
					break;
					
				case 3 :
					$title=  '%' . $data [0] . '%';
					$fname = '%' . $data [1] . '%';
					$lname = '%' . $data [2] . '%';
					break;
			}
		}
		
		$books = $this->user_serch_query ( $title, $fname, $lname, $userId, $offset, self::GET_USER_BOOKS_BY_SEARCH_SQL);
		
		if (! empty ( $books )) {
			foreach ( $books as $book ) {
				$result [] = new User_library ( $book );
			}
			return $result;
		} else {
			return "Няма намерени резултати!";
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
	
	private function user_serch_query($title, $fname, $lname, $userId, $offset, $statement) {
		$pstmt = $this->db->prepare ( $statement );
		$pstmt->bindValue ( ':title', $title, PDO::PARAM_STR);
		$pstmt->bindValue ( ':fname', $fname, PDO::PARAM_STR);
		$pstmt->bindValue ( ':lname', $lname, PDO::PARAM_STR );
		$pstmt->bindValue ( ':offset', $offset, PDO::PARAM_STR);
		$pstmt->bindValue ( ':upId', $userId, PDO::PARAM_STR);
		$pstmt->execute (array($title, $fname, $lname, $userId));
		
		$books = $pstmt->fetchAll ( PDO::FETCH_ASSOC );
		return $books;
	}
}
;

?>



