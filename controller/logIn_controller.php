<?php

/*
 Конторлер за вписване на потребител в системата.
 
 Контролерът валидира и санитизира входните данни, както и следи за състоянието на сесията.
 
 Използван за следните функционалности:
 
 1. Опресняване на сесията и клиентската библиотека.
 
 2. Вписване на клиента в клиентският му профил и запазване на данните му в сесия.
 
 */



session_set_cookie_params ( 1200 );
session_start ();
function __autoload($className) {
	require_once '../model/' . $className . ".php";
}

$error = 200;



// -=-=-=-=-=-=-=--==-=-=-=-=-=-= Функционалност 1. (Опресняване на сесията и клиентската библиотека.) =-=-=-=-=--=-=--=--=-=--=-=-=--=\\


// -=-=-=-=-=-=-=--==-=-=-=-=-=-= Проверка и валидиране при наличието на заявка за опресняване =-=-=-=-=--=-=--=--=-=--=-=-=--=\\

if (isset ( $_POST ['refresh'] )) {
	
	if (isset ( $_SESSION ['is_loged'] ) && time () - $_SESSION ['is_loged'] < 1200) {
		
		$_SESSION ['is_loged'] = time ();
		$user_account = $_SESSION ['User_info'];
		$offset = $_SESSION ['offset'];
		
		if (isset ( $_POST ['offset'] )) {
			
			// -=-=-=-=-=-=-=--==-=-=-=-=-=-= Валидиране и санитизиране на данните от пагинацията =-=-=-=-=--=-=--=--=-=--=-=-=--=\\
			
			$input_data = htmlentities ( trim ( $_POST ['offset'] ) );			
			
			switch (true) {
				case is_int ( $input_data + 0 ) :
					$offset = $input_data ;
					break;
				case $input_data == 'prev' :
					$offset = $offset - 1;
					break;
				
				case $input_data == 'next' :
					$offset = $offset + 1;
					break;
			}
			
			if ($offset < 0 || $offset > $user_account->max_offset) {
				$offset = $_SESSION ['offset'];
			}
						
			// -=-=-=-=-=-=-=--==-=-=-=-=-=-= Край на валидирането и санитизирането на данните от пагинацията =-=-=-=-=--=-=--=--=-=--=-=-=--=\\
		}
			
		// -=-=-=-=-=-=-=--==-=-=-=-=-=-= Опресняване на библиотеката на клиента =-=-=-=-=--=-=--=--=-=--=-=-=--=\\
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
		
		// -=-=-=-=-=-=-=--==-=-=-=-=-=-= Край на опресняването на библиотеката на клиента =-=-=-=-=--=-=--=--=-=--=-=-=--=\\
	
	} else {
		$error = 403;
		echo json_encode ( array (
				$error 
		) );
		die ();
	}
};
// -=-=-=-=-=-=-=--==-=-=-=-=-=-= Край на проверката и валидирането при наличието на заявка за опресняване =-=-=-=-=--=-=--=--=-=--=-=-=--=\\


				// -=-=-=-=-=-=-=--==-=-=-=-=-=-= Край на Функционалност 1.  =-=-=-=-=--=-=--=--=-=--=-=-=--=\\




// -=-=-=-=-=-=-=--==-=-=-=-=-=-= Функционалност 2. (Вписване на клиента в клиентският му профил.) =-=-=-=-=--=-=--=--=-=--=-=-=--=\\




if (isset ( $_POST ['login_submission'] )) {
	if (! empty ( $_POST ['user_email'] ) && ! empty ( $_POST ['user_pass'] )) {
		
		// -=-=-=-=-=-=-=--==-=-=-=-=-=-= Стерилизиране на входните данни =-=-=-=-=--=-=--=--=-=--=-=-=--=\\
		$user_email = htmlentities ( trim ( $_POST ['user_email'] ) );
		$user_pass = htmlentities ( trim ( $_POST ['user_pass'] ) );
		
		// -=-=-=-=-=-=-=--==-=-=-=-=-=-= Край на стерилизирането =-=-=-=-=-=-=-=-=--=-=--=--=-=--=-=-=--=\\
		
		try {
			// -=-=-=-=-=-=-=--==-=-=-=-=-=-= Вписване на клиента профилът му =-=-=-=-=-=-=-=-=--=-=--=--=-=--=-=-=--=\\
			
			$dao = new LoginDAO ();
			$user_account = $dao->request_info ( $user_email, $user_pass );
			if (! $user_account) {
				;
			}
			$_SESSION ['is_loged'] = time ();
			$_SESSION ['User_info'] = $user_account;
			
			// -=-=-=-=-=-=-=--==-=-=-=-=-=-= Край на вписването =-=-=-=-=-=-=-=-=--=-=--=--=-=--=-\\
			
			// -=-=-=-=-=-=-=--==-=-=-=-=-=-= Извличане на клиентската библиотека =-=-=-=-=-=-=-=-=--=-=--=--=-=--=-=-=--=\\
			
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
			
			// -=-=-=-=-=-=-=--==-=-=-=-=-=-= Край на извличането =-=-=-=-=-=-=-=-=--=-=--=--=-=---=\\
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
				// -=-=-=-=-=-=-=--==-=-=-=-=-=-= Край на Функционалност 2. =-=-=-=-=--=-=--=--=-=--=-=-=--=\\

?>