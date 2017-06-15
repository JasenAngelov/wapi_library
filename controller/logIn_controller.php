<?php
session_set_cookie_params ( 1200 );
session_start ();
function __autoload($className) {
	require_once '../model/' . $className . ".php";
}

if (isset ( $_SESSION ['is_loged'] ) && time () - $_SESSION ['is_loged'] < 1200) {
	
	$_SESSION ['is_loged'] = time ();
	
	echo json_encode ( array($_SESSION ['user_library'], $_SESSION['User_info'] ));
	
	die ();
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
			$_SESSION ['is_loged'] = time ();
			$_SESSION ['User_info'] = $user_account;
			
			// -=-=-=-=-=-=-=--==-=-=-=-=-=-= END of Retrieving client profil information =-=-=-=-=-=-=-=-=--=-=--=--=-=--=-\\
			
			// -=-=-=-=-=-=-=--==-=-=-=-=-=-= Retrieving client LIBRARY information =-=-=-=-=-=-=-=-=--=-=--=--=-=--=-=-=--=\\
			
			$dao = new User_libraryDAO ();
			$user_library = $dao->get_user_library ( $user_account->user_id );
			$_SESSION ['user_library'] = $user_library;			
			
			
			
			echo json_encode(array($user_library, $user_account));
			
			
			
			// -=-=-=-=-=-=-=--==-=-=-=-=-=-= END of Retrieving client LIBRARY information =-=-=-=-=-=-=-=-=--=-=--=--=-=---=\\
		} catch ( PDOException $e ) {
			echo $e->getMessage ();
		} catch ( AutorizationException $e ) {
			
			echo $e->getMessage () . var_dump ( $_POST );
		}
	} else {
		// напиши какво ще стане ако не са въвели парола или мейл!!!!!!!!!!!
		echo "Невалидни входни данни!";
	}
} else {
	// Izprati 404 page i iztrii sesiqta
	echo "Моля влезте в профила си!";
}
// -=-=-=-=-=-=-=--==-=-=-=-=-=-= END of submith control validation =-=-=-=-=--=-=--=--=-=--=-=-=--=\\

?>