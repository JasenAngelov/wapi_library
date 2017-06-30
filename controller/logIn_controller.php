<?php
session_set_cookie_params ( 1200 );
session_start ();
function __autoload($className) {
	require_once '../model/' . $className . ".php";
}

$error = 200;

if (isset ( $_POST ['refresh'] )) {
	
	if (isset ( $_SESSION ['is_loged'] ) && time () - $_SESSION ['is_loged'] < 1200) {
		
		$_SESSION ['is_loged'] = time ();
		$user_account = $_SESSION ['User_info'];
		$offset = $_SESSION ['offset'];
		
		if (isset ( $_POST ['offset'] )) {
			
			$input_data = htmlentities ( trim ( $_POST ['offset'] ) );
			
			// -=-=-=-=-=-=-=--==-=-=-=-=-=-= Validating Input data =-=-=-=-=--=-=--=--=-=--=-=-=--=\\
			
			
			switch (true) {
				case is_int ( $input_data ) :
					$offset = $input_data - 1;
					break;
				case $input_data == 'prev' :
					$offset = $offset - 1;
					break;
				
				case $input_data == 'next' :
					$offset = $offset + 1;
					break;
			}
			
			if ($offset < 0 || $offset >= $user_account->max_offset) {
				$offset = $_SESSION ['offset'];
			}
						
			// -=-=-=-=-=-=-=--==-=-=-=-=-=-= END of Validating Input data =-=-=-=-=--=-=--=--=-=--=-=-=--=\\
		}
			
		$dao = new User_libraryDAO ();
		$result = $dao->get_user_library ( $user_account->user_id, $offset );		
		$user_library = $result[0];
		$_SESSION ['user_library'] = $user_library;
		
		$_SESSION ['offset'] = $result[1];
		echo json_encode ( array (
				$error,
				$_SESSION ['user_library'],
				$_SESSION ['User_info'] 
		) );
		
		die ();
	} else {
		$error = 403;
		echo json_encode ( array (
				$error 
		) );
		die ();
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
			if (! $user_account) {
				;
			}
			$_SESSION ['is_loged'] = time ();
			$_SESSION ['User_info'] = $user_account;
			
			// -=-=-=-=-=-=-=--==-=-=-=-=-=-= END of Retrieving client profil information =-=-=-=-=-=-=-=-=--=-=--=--=-=--=-\\
			
			// -=-=-=-=-=-=-=--==-=-=-=-=-=-= Retrieving client LIBRARY information =-=-=-=-=-=-=-=-=--=-=--=--=-=--=-=-=--=\\
			
			$dao = new User_libraryDAO ();
			$result = $dao->get_user_library ( $user_account->user_id);
			$user_library = $result[0];
			$_SESSION ['user_library'] = $user_library;
			
			$_SESSION ['offset'] = $result[1];
			
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