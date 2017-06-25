/**
 * 
 */

function search(event) {
	var keyCode = (event.keyCode ? event.keyCode : event.which);   
   
	if (keyCode == 13) {
    	
    	 var serializedData = {
    			 	search_submit : true,
    	    		search_input : $('#search').val()    	    		
    	    }
   	    
    	    request = $.ajax({
    	        url: "../controller/Search_controller.php",
    	        type: "post",
    	        data: serializedData
    	    });

    	  
    	    request.done(function (response){
    	      
    	    	  console.log(response)
    	    	
//    	    		var info = $.parseJSON(response)
//    	    		
//    	    		  		
//    	    		inportSearchLibraryFromAJAX(info[0]);
//    	    		
//    	    		
//    	    		document.location.hash = + "#search";
    	       
    	    });
    	    
    	   
    	    request.fail(function (jqXHR, textStatus, errorThrown){
    	        
    	        console.error(
    	            "The following error occurred: "+
    	            textStatus, errorThrown
    	        );
    	    });

    }
}