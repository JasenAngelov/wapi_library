/**
 * 
 */

function pagination(element) {
		
	var value = element.id
	
	
	
		
		switch (value) {	
		case '-':
			console.log('minus')
			window.location.hash = "#-1"
			break;
		case '+':
			console.log('plus')
			window.location.hash = "&+1"
			break;
		
		default:
			console.log(value)
			window.location.hash = "&"+value+""
			break;
		}
	
	
	    if(window.location.hash.contains('?')) {
	        var url = window.location.hash+"&success=yes";
	    }else{
	        var url = window.location.hash+"?success=yes";
	    }
	    window.location.hash = url;
	  
		
	
	
	
	
}