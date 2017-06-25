<?php
session_set_cookie_params(1200);
session_start ();

function __autoload($className) {
	require_once '../model/' . $className . ".php";
}

// -=-=-=-=-=-=-=--==-=-=-=-=-=-= Submith control validation =-=-=-=-=--=-=--=--=-=--=-=-=--=\\

if (isset($_SESSION['is_loged']) && time() - $_SESSION['is_loged'] < 1200 && isset ( $_POST ['search_submit'] )) {
	if (!empty ( $_POST ['search_input'] )) {
		
		// -=-=-=-=-=-=-=--==-=-=-=-=-=-= Sterilization of the client Input data =-=-=-=-=--=-=--=--=-=--=-=-=--=\\
		$input = htmlentities(trim($_POST['search_submit']));
		
		$input = explode(' ', $input);
		
		$user_account = $_SESSION['User_info']; 
		
		// -=-=-=-=-=-=-=--==-=-=-=-=-=-= END of Input data sterilization =-=-=-=-=-=-=-=-=--=-=--=--=-=--=-=-=--=\\
		
		try {		
			
			// -=-=-=-=-=-=-=--==-=-=-=-=-=-= Retrieving client LIBRARY information =-=-=-=-=-=-=-=-=--=-=--=--=-=--=-=-=--=\\
			
			
				$dao = new User_libraryDAO();
				$user_library = $dao->get_user_library($user_account->user_id, $offset);
						
			
			// -=-=-=-=-=-=-=--==-=-=-=-=-=-= END of Retrieving client LIBRARY information =-=-=-=-=-=-=-=-=--=-=--=--=-=---=\\
			
			
			
		} catch ( PDOException $e ) {
			echo $e->getMessage ();
		} catch ( AutorizationException $e ) {
			echo $e->getMessage ();
			
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