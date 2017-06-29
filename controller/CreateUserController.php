<?php
session_set_cookie_params ( 1200 );
session_start ();
function __autoload($className) {
	require_once '../model/' . $className . ".php";
}

try {
	
	if (isset ( $_SESSION ['is_loged'] ) && time () - $_SESSION ['is_loged'] < 1200) {
		
		if ($_POST ['book_submission'] && ! isset ( $_POST ['book_res'] ) && ! isset ( $_POST ['book_cover'] )) {
			
			unset ( $_POST ['book_submission'] );
			
			$book_info = array ();
			
			foreach ( $_POST as $key => $value ) {
				$book_info [$key] = htmlentities ( trim ( $value ) );
			}
			
			if (! isset ( $_FILES ['book_res'] ['error'] ) || is_array ( $_FILES ['book_res'] ['error'] ) || ! isset ( $_FILES ['book_res'] ['error'] ) || is_array ( $_FILES ['book_res'] ['error'] )) {
				
				throw new RuntimeException ( 'Invalid parameters.' );
			} else {
				
				foreach ( $_FILES as $key => $value ) {
					
					$file [$key] = $value;
					
					switch ($file [$key] ['error']) {
						case UPLOAD_ERR_OK :
							break;
						case UPLOAD_ERR_NO_FILE :
							throw new RuntimeException ( 'No file sent.' );
						case UPLOAD_ERR_INI_SIZE :
						case UPLOAD_ERR_FORM_SIZE :
							throw new RuntimeException ( 'Exceeded filesize limit.' );
						default :
							throw new RuntimeException ( 'Unknown errors.' );
					}
					if ($file [$key] ['size'] > 2000000) {
						throw new RuntimeException ( 'Exceeded filesize limit.' );
					}
				}
				
				// =-=-=-=-=-=-=-=--=-=--=-=-=-=-=-==- Checkong the MIME type =-=-=-=-=-=---=-=-=-=--==-\\
				
				$finfo = new finfo ( FILEINFO_MIME_TYPE );
				
				$mime1 = array_search ( $finfo->file ( $_FILES ['book_cover'] ['tmp_name'] ), array (
						'jpg' => 'image/jpeg',
						'png' => 'image/png',
						'gif' => 'image/gif'
				), true );
				
				$mime2 = array_search ( $finfo->file ( $_FILES ['book_res'] ['tmp_name'] ), array (
						'pdf' => 'application/pdf',
						'txt' => 'text/plain'
				), true );
				
				if ($mime1 === false || $mime2 === false) {
					
					throw new RuntimeException ( 'Invalid file format.' );
				}
				// =-=-=-=-=-=-=-=--=-=--=-=-=-=-=-==- END of checkong the MIME type =-=-=-=-=-=---=-=-=-=--==-\\
				
				// =-=--=-=-=-=--==--==-=-=-=-=-=-=-=- Moving the uploaded file =--=--=-=--=-==-=-=--=-=-==-=--=\\
				$hash_file_name = sha1_file ( $_FILES ['book_res'] ['tmp_name'] );
				$book_address = sprintf ( './assets/books/%s.%s', $hash_file_name, $mime2 );
				
				$hash_file_name = sha1_file ( $_FILES ['book_cover'] ['tmp_name'] );
				$cover_address = sprintf ( './assets/images/user_pics/%s.%s', $hash_file_name, $mime1 );
				
				$user_info = $_SESSION ['User_info'];
				$book_info ['book_res'] = $book_address;
				$book_info ['book_cover'] = $cover_address;
				
				$dao = new UpdateLibraryDAO ();
				$dao->insert_new_book ( $user_info->user_id, $book_info );
				
				if ($dao) {
					if (! move_uploaded_file ( $_FILES ['book_cover'] ['tmp_name'], sprintf ( '../view/assets/images/user_pics/%s.%s', sha1_file ( $_FILES ['book_cover'] ['tmp_name'] ), $mime1 ) )) {
						
						throw new RuntimeException ( 'Failed to move uploaded file.' );
					}
					
					if (! move_uploaded_file ( $_FILES ['book_res'] ['tmp_name'], sprintf ( '../view/assets/books/%s.%s', sha1_file ( $_FILES ['book_res'] ['tmp_name'] ), $mime2 ) )) {
						
						throw new RuntimeException ( 'Failed to move uploaded file.' );
					}
				}
				;
				
				// =-=--=-=-=-=--==--==-=-=-=-=-=-=-=- END of Moving the uploaded file =--=--=-=--=-==-=-=--=-=-==-=--=\\
			}
		} else {
			echo "Невалидни входни данни!";
		}
	} else {
		echo "Моля влезте в профила си!";
	}
} catch ( RuntimeException $e ) {
	
	echo $e->getMessage ();
} catch ( PDOException $e ) {
	var_dump ( $e );
}
?>