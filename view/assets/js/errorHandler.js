/**
 * 
 */

function errorHandler(errorCode) {
	var message = '';
	
	switch (errorCode) {
	case 200:
			message = 'Succsess!'
		
			
		break;
	case 403:
			goTo('errorLog')
			message = 'Моля влезте в профила си!'
			failReport(message)			
			break;
	case 422:
			goTo('errorLog')
			message = 'Невалидни входни данни!'
			failReport(message)
		
		break;
			
	case 500:
			goTo('errorLog')
			message = 'Нещо се обърка!'
			failReport(message)
	
	break;
			
	case 401:
			goTo('errorLog')
			message = 'Грешно име или парола!'
			failReport(message)

break;		
	
	
	}
}