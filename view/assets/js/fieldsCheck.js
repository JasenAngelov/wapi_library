/*
 * 
 * 	Функции за проверка на полетата.
 * 	
 *  Функционалност:
 *  
 * 		1. emailCheck() - Функция за проверка на E-mail. 
 * 
 * 		2. checkField() - Проверява дали всички полета са попълнени и ако има пропуск го оцветява в червено. 
 * 						  Използваме я като помощна функция към AJAX заявките.
 * 
 * 		3. checkISBN() - Проверява дали ISBN номерът е валиден. Използваме я и като помощна функция към AJAX заявките.
 * 
 * 		4. checkDate() - Проверява дали датата е валиден формат. Използваме я и като помощна функция към AJAX заявките.
 * 		
 * 		4. checkPass() - Проверява дали паролите съвпадат. Използваме я като помощна функция към AJAX заявките. 
 * 
 */



// -=-=--==--=-=-=--==--=-=-= Проверка за валиден E-mail -=-=--==-=-=-=-=-==-=--==--= \\
 function emailCheck(element) {
	
	function validateEmail(email) {
	    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	    var result = re.test(email);
	    return result;
	};
	
	var mailbox = element;
	var email = element.value;
	var test = validateEmail(email);
	if (test === false) {		
		mailbox.style.border = 'solid 1px red'
		if (!(document.getElementById('email-warning'))) {
			var warning = document.createElement('span');
			warning.innerHTML = 'Please enter valid E-mail!';
			warning.style.color = 'red';
			warning.style.fontSize = 11 +'px'			
			warning.id = 'email-warning'
			
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
// -=-=--==--=-=-=--==--=-=-= Край на проверката за валиден E-mail -=-=--==-=-=-=-=-==-=--==--= \\

//=-=-=-==-=--==-=--=--==-==-=- Проверка за попълнени полета =-=--=-=-=-=-=-=--=-=-=-=-=-=-\\

function checkField() {
    var valid = true;
    $('.form-field').each(function () {
        if ($(this).val() === '') {
            valid = false;
            $(this).css('border','1px solid #f00')           
        }
    });
    return valid
}

//=-=-=-==-=--==-=--=--==-==-=- Край на проверката за попълнени полета =-=--=-=-=-=-=-=--=-=-=-=-=-=-\\


//=-=-=-==-=--==-=--=--==-==-=- Проверка на ISBN номерът =-=--=-=-=-=-=-=--=-=-=-=-=-=-\\

function checkISBN() {
	
	var input = $('#isbn').val()
	
	if (input.match(/^[0-9]{10}$/)) {
		
		$('#isbn').css('border','none')
		return true;
	}	
	$('#isbn').css('border','1px solid #f00') 
	
	return false;
}

//=-=-=-==-=--==-=--=--==-==-=- Край на проверката =-=--=-=-=-=-=-=--=-=-=-=-=-=-\\


//-=-==--=-=-=-=--=-=-=--=-=--=-= Проверка за валидноста на датата -=-=--==-=-=--==-=-\\

function checkDate() {
var input = $('#pubDate').val()
	
	if (input.match(/^\d{4}-\d{2}-\d{2}$/)) {		
		$('#pubDate').css('border','none')
		return true;
	}

	$('#pubDate').css('border','1px solid #f00') 	
	return false;
	 
	  
	}

//=-=-=-==-=--==-=--=--==-==-=- Край на проверката =-=--=-=-=-=-=-=--=-=-=-=-=-=-\\


//-=-==--=-=-=-=--=-=-=--=-=-= Проверка за валидноста на паролата -=-=--==-=-=--==-=-\\

function checkPass() {
	
	var pass = $('#pass').val()
	var rePass = $('#pass').val()
	
	if (pass == rePass) {
		
		pass.css('border','none')
		rePass.css('border','none')
		return true;		
	}
	
	pass.css('border','1px solid #f00') 
	rePass.css('border','1px solid #f00') 
	return false;
	
}

//=-=-=-==-=--==-=--=--==-==-=- Край на проверката =-=--=-=-=-=-=-=--=-=-=-=-=-=-\\










