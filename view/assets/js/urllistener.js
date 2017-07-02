/**
 * 		Функции, които слушат за промени в URL-а.
 * 		
 * 		Функционалност:
 * 
 * 			1. 	chekingURL() - Проверява URL адресът и извиква съответните функции.
 * 
 * 			 
 * 
 * 
 */
function chekingURL() {
	
	if (window.location.hash == '') {
		url = window.location.hash = 'logIn';
		document.title = 'LogIn';
	}else{
		switch (window.location.hash) {
		
		case '#My-library':
			
			if ($( "#form-1" ).length == 0) {
				refreshLibrary();				
			}
			document.title = 'My Library';
			break;
		
		case '#add-book':	
			
			addNewBook();
			document.title = 'Add Book';
			break;
			
		case '#signUp':				
			createUserPanel();
			
			$('#backBut').click(function(event){
			    event.preventDefault();
			});
			document.title = 'SignUp';			
			break;
			
		case '#logIn':				
			LogInMenu()
			$('#login_button').click(function(event){
			    event.preventDefault();
			});
			document.title = 'LogIn';
			break;	
			
		default :
				
			break;
		}
	}
}


$(document).ready(chekingURL())

window.onhashchange = function() {	
	chekingURL()
}


