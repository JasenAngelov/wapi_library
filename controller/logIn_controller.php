<?php
session_set_cookie_params ( 1200 );
session_start ();
function __autoload($className) {
	require_once '../model/' . $className . ".php";
}

$error = 200;

if ( isset ( $_POST ['refresh'])) {	
	
	if (isset ( $_SESSION ['is_loged'] ) && time () - $_SESSION ['is_loged'] < 1200) {
		
		$_SESSION ['is_loged'] = time ();
				
		echo json_encode ( array (
				$error,
				$_SESSION ['user_library'],
				$_SESSION ['User_info']
		) );
		
		die ();
	}else {
		$error = 403;
		echo json_encode ( array (
				$error				
		) );
	}
}


// -=-=-=-=-=-=-=--==-=-=-=-=-=-= Submith control validation =-=-=-=-=--=-=--=--=-=--=-=-=--=\\
if (isset ( $_POST ['login_submission'] )) {
	if (! empty ( $_POST ['user_email'] ) && ! empty ( $_POST ['user_pass'] )) {
		
		// -=-=-=-=-=-=-=--==-=-=-=-=-=-= Sterilization of the client Input data =-=-=-=-=--=-=--=--=-=--=-=-=--=\\
		$user_email = htmlentities ( trim ( $_POST ['user_email'] ) );
		$user_pass = htmlentities ( trim ( $_POST ['user_pass'] ) );
		
		// -=-=-=-=-=-=-=--==-=-=-=-=-=-= END of Input data sterilization =-=-=-=-=-=-=-=-=--=-=--=--=-=--=-=-=--=\\
		
		try {
			// -=-=-=-=-=-=-=--==-=-=-=-=-=-= Retrieving client PROFIL information =-=-=-=-=-=-=-=-=--=-=--=--=-=--=-=-=--=\\
			
			$dao = new LoginDAO ();
			$user_account = $dao->request_info ( $user_email, $user_pass );
			if (!$user_account) {
				;
			}
			$_SESSION ['is_loged'] = time ();
			$_SESSION ['User_info'] = $user_account;
			
			// -=-=-=-=-=-=-=--==-=-=-=-=-=-= END of Retrieving client profil information =-=-=-=-=-=-=-=-=--=-=--=--=-=--=-\\
			
			// -=-=-=-=-=-=-=--==-=-=-=-=-=-= Retrieving client LIBRARY information =-=-=-=-=-=-=-=-=--=-=--=--=-=--=-=-=--=\\
			
			$dao = new User_libraryDAO ();
			$user_library = $dao->get_user_library ( $user_account->user_id );
			
			$_SESSION ['user_library'] = $user_library;
			
			echo json_encode ( array (
					$error,
					$_SESSION ['user_library'],
					$_SESSION ['User_info'] 
			) );
			
			// -=-=-=-=-=-=-=--==-=-=-=-=-=-= END of Retrieving client LIBRARY information =-=-=-=-=-=-=-=-=--=-=--=--=-=---=\\
		} catch ( PDOException $e ) {			
			$error = 500;
			echo json_encode ( array (
					$error
			) );
			
		} catch ( AutorizationException $e ) {			
			$error = 401;
			echo json_encode ( array (
					$error
			) );
		}
	} else {
		$error = 422;
		echo json_encode ( array (
				$error
		) );
	}
} else {
	
	$error = 422;
	echo json_encode ( array (
			$error			
	) );
}
// -=-=-=-=-=-=-=--==-=-=-=-=-=-= END of submith control validation =-=-=-=-=--=-=--=--=-=--=-=-=--=\\

?>