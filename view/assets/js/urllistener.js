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
	}else{
		switch (window.location.hash) {
		
		case '#My-library':
			
			if ($( "#form-1" ).length == 0) {
				refreshLibrary();				
			}						
			break;
		
		case '#add-book':	
			
			addNewBook();
			break;
			
		case '#signUp':				
			createUserPanel();
			
			$('#backBut').click(function(event){
			    event.preventDefault();
			});
			
			break;
			
		case '#logIn':				
			LogInMenu()
			$('#login_button').click(function(event){
			    event.preventDefault();
			});
			
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


