function myLibrary() {	
	
	 var serializedData = {
			 refresh : true,	    		
	    }
	 
	 request = $.ajax({
	        url: "../controller/logIn_controller.php",
	        type: "post",
	        data: serializedData
	    });	
	  
	    request.done(function (response){	        	
	    	
	    	
	    		var info = $.parseJSON(response)
	    			    			    		
	    		inportLibraryFromAJAX(info[0]);
	    		controlPanel(info[1]);	    		
	    			       
	    });
	    
	   
	    request.fail(function (jqXHR, textStatus, errorThrown){
	        
	        console.error(
	            "The following error occurred: "+
	            textStatus, errorThrown
	        );
	    });
	
}