/**
 * 
 */
function chekingURL() {
	
	if (window.location.hash == '') {
		url = window.location.hash = 'logIn';
	}else{
		switch (window.location.hash) {
		
		case '#My-library':
			
			myLibrary();			
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
		}
	}
}


$(document).ready(chekingURL())

window.onhashchange = function() {	
	chekingURL()
}


