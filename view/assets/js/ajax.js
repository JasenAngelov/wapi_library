/*
 * 	JS Функции за извършването на AJAX заявки. 
 * 	
 * 	Функционалност:
 * 	
 * 		1. logInAJAX() - Функция за изпращане на заявка за първоначално вписване на клиент.
 * 
 * 		2. addBookAJAX() - Функция за изпращане на заявка за добавяне на нова книга в библиотеката на клиента.
 * 
 * 		3. createUserAJAX() - Функция за изпращане на заявка за създаване на нов клиент.
 * 
 * 		4. search() - Функция за изпращане на заявка за търсене по критерии.
 * 
 * 		5. refreshLibrary() - Функция за изпращане на заявка за обновяване на библиотеката (сесията).
 * 
 * 		6. nextList() - Функция за изпращане на заявка за различна страница от библиотеката (пагинацията). 
 * 
 */

//=--=-=-=-=-=--=-=--=-=-=-=-==-=-=-=-=-=-=-==-=- AJAX request for logIn =-=--=-=-=-=-=--=-=-=-=-=-=-==-=-=-=---=-=-\\

function logInAJAX(){	
    
	var fieldCheck = checkField()
	
	
     if (!fieldCheck) {
		alert('Моля попълнете всички полета!')
	}else {	
  
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
	    		
	    		if (info[0] == 200) {	    			
		    			inportLibraryFromAJAX(info[1]);
			    		controlPanel(info[2]); 
			    		url = window.location.hash = 'My-library';
					
		    		}else{					
						errorHandler(info[0])
						}			
	    		
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
		}
};

//=--=-=-=-=-=--=-=--=-=-=-=-==-=-=-=-=-=-=-==-=- END of AJAX request for logIn =-=--=-=-=-=-=--=-=-=-=-=-=-==-=-=-=---=-=-\\






//=--=-=-=-=-=--=-=--=-=-=-=-==-=-=-=-=-=-=-==-=- AJAX request for Adding Book =-=--=-=-=-=-=--=-=-=-=-=-=-==-=-=-=---=-=-\\

function addBookAJAX (){
	
	
	var fieldCheck = checkField()
	var isbnCheck = checkISBN()
	var dateCheck = checkDate()
	
	
    if (!fieldCheck && !isbnCheck && !dateCheck) {
		alert('Моля попълнете всички полета коректно!!')
	}else {	
		
			
	var fieldCheck = checkField()
	
    if (!fieldCheck) {
		alert('Моля попълнете всички полета!')
	}else {
	
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
		 		
		 		if (info[0] == 200) { 	
		 			
		 			alert('Успешно добавихте нова книга!')
		 			
		 			inportSearchLibraryFromAJAX(info[1]); 
		 			controlPanel(info[2]);
				}else{					
					errorHandler(info[0])
				}	  	
		    	
		
		
		       
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
		} 
	
	}

};

//=--=-=-=-=-=--=-=--=-=-=-=-==-=-=-=-=-=-=-==-=- END of AJAX request for adding book =-=--=-=-=-=-=--=-=-=-=-=-=-==-=-=-=---=-=-\\


function createUserAJAX() {
	
	var fieldCheck = checkField()
	var emailCheck = emailCheck($('#email'))
	var passCheck = checkPass()
	
    if (!fieldCheck && !passCheck && !emailCheck) {
		alert('Моля попълнете всички полета!')
	}else {
      
	    event.preventDefault();  
	    
	    var $form = $(this);
	
	   
	    var $inputs = $form.find("input");
	
	   
	    var serializedData = {
	    		create_user : true,    		
	    		user_fname : $('#fname').val(),
	    		user_lname : $('#lname').val(),
	    		user_email : $('#email').val(),    		
	    		user_pass : $('#pass').val(),
	    		user_rePass : $('#rePass').val()
	    }
	
	    
	    $inputs.prop("disabled", true);
	
	    
	    request = $.ajax({
	        url: "../controller/CreateUserController.php",
	        type: "post",
	        data: serializedData
	    });
	
	    
	    request.done(function (response){
	    	
	    	var info = $.parseJSON(response)     	
	    	errorHandler(info[0])
	    			       
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

	}
    
}

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
    	        	    	
 	    		var info = $.parseJSON(response) 
 	    		
 	    		if (info[0] == 200) { 	 	    			
 	    			inportSearchLibraryFromAJAX(info[1]); 
				}else{					
					errorHandler(info[0])
				}
   	    		  		
   	    		  	    		
   	    		  	    		
    	       
    	    });
    	    
    	   
    	    request.fail(function (jqXHR, textStatus, errorThrown){
    	        
    	        console.error(
    	            "The following error occurred: "+
    	            textStatus, errorThrown
    	        );
    	    });

    }
}


function refreshLibrary(offset = 0) {	
	
	 var serializedData = {
			 refresh : true,
			 offset : offset
	    }
	 
	 request = $.ajax({
	        url: "../controller/logIn_controller.php",
	        type: "post",
	        data: serializedData
	    });	
	  
	    request.done(function (response){	        	
	    	
	    		var info = $.parseJSON(response)
	    		    		
	    		if (info[0] == 200) {	    			
	    			inportLibraryFromAJAX(info[1]);
		    		controlPanel(info[2]); 
		    						
	    		}else{					
					errorHandler(info[0])
				}	    		
	    		
	    			    		
	    			       
	    });
	    
	   
	    request.fail(function (jqXHR, textStatus, errorThrown){
	        
	        console.error(
	            "The following error occurred: "+
	            textStatus, errorThrown
	        );
	    });
	
}


function nextList(offset) {	
	
	 var serializedData = {
			 refresh : true,
			 offset : offset
	    }
	 
	 request = $.ajax({
	        url: "../controller/logIn_controller.php",
	        type: "post",
	        data: serializedData
	    });	
	  
	    request.done(function (response){	        	
	    	    
	    		var info = $.parseJSON(response)
	    			    		
	    		if (info[0] == 200) {	    			
	    			inportSearchLibraryFromAJAX(info[1]);
		    						
	    		}else{					
					errorHandler(info[0])
				}	    		
	    		
	    			    		
	    			       
	    });
	    
	   
	    request.fail(function (jqXHR, textStatus, errorThrown){
	        
	        console.error(
	            "The following error occurred: "+
	            textStatus, errorThrown
	        );
	    });
	
}


