<?php
session_set_cookie_params ( 1200 );
session_start ();
function __autoload($className) {
	require_once '../model/' . $className . ".php";
}

try {
	
	if (isset ( $_POST ['create_user'] ) && $_POST ['create_user'] == true) {
		
		if (isset ( $_POST ['user_fname'] ) && isset ( $_POST ['user_lname'] ) && isset ( $_POST ['user_email'] ) && isset ( $_POST ['user_pass'] ) && isset ( $_POST ['user_rePass'] )) {
			
			// =-=--=-=-=-=--==--==-=-=-=-=-=-=-=- Data sterelization =--=--=-=--=-==-=-=--=-=-==-=--=\\
			unset ( $_POST ['create_user'] );
			
			$sterealized_info = array ();
			
			foreach ( $_POST as $key => $value ) {
				$sterealized_info[$key] = htmlentities ( trim ( $value ) );
			}
			
					
			// =-=--=-=-=-=--==--==-=-=-=-=-=-=-=- END of Data sterelization =--=--=-=--=-==-=-=--=-=-==-=--=\\
			
			
			// =-=--=-=-=-=--==--==-=-=-=-=-=-=-=- Data validation =--=--=-=--=-==-=-=--=-=-==-=--=\\
			$error = false;
						
			if (!filter_var($sterealized_info["user_email"], FILTER_VALIDATE_EMAIL)) {
				$error = "Невалидни входни данни!1";
			}			
			if ($sterealized_info["user_pass"] != $sterealized_info["user_rePass"]) {
				$error = "Невалидни входни данни!2";
			}
			if (count(explode(' ', $sterealized_info['user_fname'] )) > 1){
				$error = "Невалидни входни данни!3";
			}
			if (count(explode(' ', $sterealized_info['user_lname'] )) > 1){
				$error = "Невалидни входни данни!4";
			}
						
			// =-=--=-=-=-=--==--==-=-=-=-=-=-=-=- END of Data validation =--=--=-=--=-==-=-=--=-=-==-=--=\\
						
			
			if (!$error) {
				$dao = new CreateUserDAO();
				$dao->new_user($sterealized_info['user_fname'], $sterealized_info['user_lname'], $sterealized_info["user_email"], $sterealized_info["user_rePass"]);
			}else {
				echo json_encode ( $error );
				die();
			}	
			
			if (!$dao){
				$error = "Възникна проблем, опитайре по-късно!";
			}
			
			
			echo json_encode ( $error );
			
			
			
			
			
		} else {
			echo "Невалидни входни данни!";
		}
	} else {
		echo $_POST ['create_user'];
	}
} catch ( RuntimeException $e ) {
	
	echo $e->getMessage ();
} catch ( PDOException $e ) {
	echo $e->getMessage ();
}
?>