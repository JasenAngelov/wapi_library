//=-=-=-=-=-=-=-=--=---=--==-=--=-----=--=- Checking file size and type functions =-=-=--==-=--==-=--=-=-=--=-\\

function checkFile(currentElement) {
		
		var  elem = currentElement;
		var  file = currentElement.files[0];
		var  name = file.name;
	    var  size = file.size;
	    var  type = file.type;
	    
	    if (elem.id == 'cover') {
			
	    	var extension = name.replace(/^.*\./, '');
	    	
	    	if (extension == name) {
	    		extension = '';
			} else {
				extension = extension.toLowerCase();
			}
	    	  switch (extension) {
	            case 'jpg':
	            case 'jpeg':
	            case 'png':	                
                break;

	            default:
	                // Cancel the form submission
	            	
	            	alert("Unsupported type of file!");
	            	elem.val('')
	           
	        }
	    	  if (size > 2000000) {
	    		  alert("The file is too big!");
	            	elem.val('')
			}
	    	
		} else {
			
			var extension = name.replace(/^.*\./, '');
				    	
	    	if (extension == name) {
	    		extension = '';
			} else {
				extension = extension.toLowerCase();
			}
	    	  switch (extension) {	            
	            case 'pdf':	   
	            case 'txt':
                break;

	            default:
	                // Cancel the form submission
	            	
	            	alert("Unsupported type of file!");
	            	elem.val('')
	           
	        }
	    	  if (size > 2000000) {
	    		  alert("The file is too big!");
	            	elem.val('')
			}
				
			
		}
	    
	   
	       
	    
	    
	};

	
	
	// =-=-=-=-=-=-=-=--=---=--==-=--=-----=--=- END of Checking functions =-=-=--==-=--==-=--=-=-=--=-\\