<?php

/* 
 	Контролер за създаване на нови потребители.
	
	Контролерът валидира и санитизира получените данни, след което те биват записани в DB.
	
*/


session_set_cookie_params ( 1200 );
session_start ();
function __autoload($className) {
	require_once '../model/' . $className . ".php";
}

try {
	
	if (isset ( $_POST ['create_user'] ) && $_POST ['create_user'] == true) {
		
		if (isset ( $_POST ['user_fname'] ) && isset ( $_POST ['user_lname'] ) && isset ( $_POST ['user_email'] ) && isset ( $_POST ['user_pass'] ) && isset ( $_POST ['user_rePass'] )) {
			
			// =-=--=-=-=-=--==--==-=-=-=-=-=-=-=- Стелиризиране на входящите полета =--=--=-=--=-==-=-=--=-=-==-=--=\\
			unset ( $_POST ['create_user'] );
			
			$sterealized_info = array ();
			
			foreach ( $_POST as $key => $value ) {
				$sterealized_info [$key] = htmlentities ( trim ( $value ) );
			}
			
			// =-=--=-=-=-=--==--==-=-=-=-=-=-=-=- Край на стерилизирането =--=--=-=--=-==-=-=--=-=-==-=--=\\
			
			// =-=--=-=-=-=--==--==-=-=-=-=-=-=-=- Валидиране на входните данни =--=--=-=--=-==-=-=--=-=-==-=--=\\
			$error = 200;
			
			if (! filter_var ( $sterealized_info ["user_email"], FILTER_VALIDATE_EMAIL )) {
				$error = 422;
			}
			if ($sterealized_info ["user_pass"] != $sterealized_info ["user_rePass"]) {
				$error = 422;
			}
			if (count ( explode ( ' ', $sterealized_info ['user_fname'] ) ) > 1) {
				$error = 422;
			}
			if (count ( explode ( ' ', $sterealized_info ['user_lname'] ) ) > 1) {
				$error = 422;
			}
			
			// =-=--=-=-=-=--==--==-=-=-=-=-=-=-=- Валидиране на входните данни =--=--=-=--=-==-=-=--=-=-==-=--=\\
			
			// =-=--=-=-=-=--==--==-=-=-=-=-=-=-=- Създаване на нов потребител =--=--=-=--=-==-=-=--=-=-==-=--=\\
			if (! $error) {
				$dao = new CreateUserDAO ();
				$dao->new_user ( $sterealized_info ['user_fname'], $sterealized_info ['user_lname'], $sterealized_info ["user_email"], $sterealized_info ["user_rePass"] );
			} else {
				echo json_encode ( $error );
				die ();
			}
			// =-=--=-=-=-=--==--==-=-=-=-=-=-=-=- Край на създаването на нов потребител =--=--=-=--=-==-=-=--=-=-==-=--=\\			
			
			
			// =-=--=-=-=-=--==--==-=-=-=-=-=-=-=- Проверка за успешно създаването на нов потребител =--=--=-=--=-==-=-=--=-=-==-=--=\\
			if (! $dao) {
				$error = 409;
			}
			// =-=--=-=-=-=--==--==-=-=-=-=-=-=-=- Край на проверката=--=--=-=--=-==-=-=--=-=-==-=--=\\
			
			echo json_encode ( $error );
			
		
		
		} else {
			$error = 422;
			echo json_encode ( $error );
		}
	} else {
		$error = 422;
		echo json_encode ( $error );
	}
} catch ( PDOException $e ) {
	$error = 500;
	echo json_encode ( $error );
}
?>