// -=-=--==--=-=-=--==--=-=-=LogIn E-mail verification-=-=--==-=-=-=-=-==-=--==--= \\
document.getElementById('username').onblur = function() {
	
	function validateEmail(email) {
	    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	    var result = re.test(email);
	    return result;
	};
	
	var mailbox = document.getElementById('username');
	var email = document.getElementById('username').value;
	var test = validateEmail(email);
	if (test === false) {		
		mailbox.style.border = 'solid 1px red'
		if (!(document.getElementById('email-warning'))) {
			var warning = document.createElement('span');
			warning.innerHTML = 'Please enter valid E-mail!';
			warning.style.color = 'red';
			warning.style.fontSize = 11 +'px'			
			warning.id = 'email-warning'
			var element = document.getElementById('username');
			element.parentNode.insertBefore(warning, element);
		}
	}else{
		if ( (document.getElementById('email-warning'))) {
			var warning = document.getElementById('email-warning');
			warning.parentNode.removeChild(warning);
			mailbox.style.border = 'solid 1px black'
				
				
		}
		
	}
	
}
// -=-=--==--=-=-=--==--=-=-=END of LogIn E-mail verification-=-=--==-=-=-=-=-==-=--==--= \\































