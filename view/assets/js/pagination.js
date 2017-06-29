/**
 * 
 */

function pagination(element) {
		
	var value = element.id
	
	
	
		
		switch (value) {	
		case '-':			
			var offset = "prev"
			break;
		case '+':
			var offset = "next"
			break;
		
		default:
			console.log(value)
			var offset = value
			break;
		}
	
		var url = 	window.location.hash
		var new_url = url.substring(0, url.indexOf('?'));
	 
	        url = new_url+"?offset=" + offset;	   
	        window.location.hash = url;
	  
		
	
	
	
	
}