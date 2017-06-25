
//=--=-=-=-=-=--=-=--=-=-=-=-==-=-=-=-=-=-=-==-=- AJAX request for logIn =-=--=-=-=-=-=--=-=-=-=-=-=-==-=-=-=---=-=-\\

$("#login_button").click(function(event){
	
	
    
    event.preventDefault();

  
  
    var $form = $(this);

   
    var $inputs = $form.find("input");

   
    var serializedData = {
    		login_submission : true,
    		user_email : $('#username').val(),
    		user_pass : $('#password_login').val()
    }

    
    $inputs.prop("disabled", true);

    
    request = $.ajax({
        url: "../controller/logIn_controller.php",
        type: "post",
        data: serializedData
    });

  
    request.done(function (response){
      
    	  
    	
    		var info = $.parseJSON(response)
    		
    		  		
    		inportLibraryFromAJAX(info[0]);
    		controlPanel(info[1]);
    		
    		document.location.hash = "My-library";
       
    });
    
   
    request.fail(function (jqXHR, textStatus, errorThrown){
        
        console.error(
            "The following error occurred: "+
            textStatus, errorThrown
        );
    });

  
    request.always(function () {
        
        $inputs.prop("disabled", false);
    });

});

//=--=-=-=-=-=--=-=--=-=-=-=-==-=-=-=-=-=-=-==-=- END of AJAX request for logIn =-=--=-=-=-=-=--=-=-=-=-=-=-==-=-=-=---=-=-\\






//=--=-=-=-=-=--=-=--=-=-=-=-==-=-=-=-=-=-=-==-=- AJAX request for Adding Book =-=--=-=-=-=-=--=-=-=-=-=-=-==-=-=-=---=-=-\\

function addBookAJAX (){
	
	var formData = new FormData();
	
	var book_data = $('#bookFile')[0].files[0];
	var cover_data = $('#cover')[0].files[0];
	 
    var serializedData = {
    		book_submission : true,
    		
    		book_title : $('#bookTitle').val(),
    		book_isbn : $('#isbn').val(),
    		book_pages : $('#pages').val(),    		
    		book_pubDate : $('#pubDate').val(),
    		book_desc : $('#bookDesc').val(),
    		autor_Fname : $('#firstName').val(),
    		autor_Lname : $('#lastName').val(),   		
    		
    }
    
    formData.append('book_res', book_data);
	formData.append('book_cover', cover_data);	
	for ( var key in serializedData ) {
		formData.append(key, serializedData[key]);
	}
	
	
    var $form = $(this);
    
    var $inputs = $form.find("input");
    
    
    $inputs.prop("disabled", true);

    
    request = $.ajax({
        url: "../controller/AddingBooksController.php",
        type: "post",
        data: formData, 
        processData: false,
        contentType: false
    });

  
    request.done(function (response){
          
    	
    	
    	var info = $.parseJSON(response)
		
  	
		inportLibraryFromAJAX(info[1]);
   		controlPanel(info[0]);
		
		document.location.hash = "My-library";
       
    });
    
   
    request.fail(function (jqXHR, textStatus, errorThrown){
        
        console.error(
            "The following error occurred: "+
            textStatus, errorThrown
        );
    });

  
    request.always(function () {
        
        $inputs.prop("disabled", false);
    });

};

//=--=-=-=-=-=--=-=--=-=-=-=-==-=-=-=-=-=-=-==-=- END of AJAX request for adding book =-=--=-=-=-=-=--=-=-=-=-=-=-==-=-=-=---=-=-\\





