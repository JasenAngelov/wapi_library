<?php
session_set_cookie_params ( 1200 );
session_start ();
function __autoload($className) {
	require_once '../model/' . $className . ".php";
}
$error = 200;
// -=-=-=-=-=-=-=--==-=-=-=-=-=-= Submith control validation =-=-=-=-=--=-=--=--=-=--=-=-=--=\\

if (isset ( $_SESSION ['is_loged'] ) && time () - $_SESSION ['is_loged'] < 1200 && isset ( $_POST ['search_submit'] )) {
	if (! empty ( $_POST ['search_input'] )) {
		
		// -=-=-=-=-=-=-=--==-=-=-=-=-=-= Sterilization of the client Input data =-=-=-=-=--=-=--=--=-=--=-=-=--=\\
		$input = htmlentities ( trim ( $_POST ['search_input'] ) );
		
		$input = explode ( ' ', $input );
		
		$user_account = $_SESSION ['User_info'];
		
		if (isset ( $_POST ['offset'] )) {
			$offset = $_POST ['offset'];
		} else {
			$offset = 0;
		}
		
		// -=-=-=-=-=-=-=--==-=-=-=-=-=-= END of Input data sterilization =-=-=-=-=-=-=-=-=--=-=--=--=-=--=-=-=--=\\
		
		try {
			
			// -=-=-=-=-=-=-=--==-=-=-=-=-=-= Retrieving client LIBRARY information =-=-=-=-=-=-=-=-=--=-=--=--=-=--=-=-=--=\\
			
			$dao = new User_libraryDAO ();
			$user_library = $dao->books_by_search ( $input, $user_account->user_id );
			
			echo json_encode ( array (
					$error,
					$user_library 
			) );
			// -=-=-=-=-=-=-=--==-=-=-=-=-=-= END of Retrieving client LIBRARY information =-=-=-=-=-=-=-=-=--=-=--=--=-=---=\\
		} catch ( PDOException $e ) {
			$error =  422;
			echo json_encode ( array (
					$error 
			) );
		}
	} else {
		echo json_encode ( array (
				$error,
				$_SESSION ['user_library'] 
		) );
	}
} else {
	$error =  401;
	echo json_encode ( array (
			$error 
	) );
}
// -=-=-=-=-=-=-=--==-=-=-=-=-=-= END of submith control validation =-=-=-=-=--=-=--=--=-=--=-=-=--=\\

?>