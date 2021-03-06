/**
 * 
 * 		Функции за динамично генериране на HTML елементи и съдаржание.
 * 
 * 		Функционалност:
 * 
 * 			1. addNewBook() - Създаване на форма за добавяне на нова книга.
 * 
 * 			2. controlPanel() - Създаване на контолен панел за клиента.
 * 
 * 			3. inportLibraryFromAJAX() - Създаване на клиентска библиотека.
 * 
 * 			4. inportSearchLibraryFromAJAX - Създаване на клиентска библиотека при специфично търсене.
 * 
 * 			5. createUserPanel() - Създаване на форма за регистриране на нов клиент.
 * 
 * 			6. LogInMenu() - Създаване на форма за вписване.
 * 
 * 			7. failReport() - Създаване на репорт за грешка.  
 * 
 * 			8. succsessReport() - Създаване на репорт за успех.
 * 
 * 
 */

					// =-=-=-=-=-=-=-=--=---=--==-=--=-----=--=- Add new book interface =-=-=--==-=--==-=--=-=-=--=-\\
function addNewBook() {
	
	$( "#container" ).empty()
	
	// =-=-=--=-=-=-=--=--==-=-=--=--=-= Creating the necessary DOM elements =-=-=-=--=-==--=-=-=-=-=--=--=-=-=-=\\
	
	var mainCont = $('<div class="container"></div>');
		
		var top = $('<div class="top" ></div>');
			var header = $('<h1>Please fill out all fields correctly!</h1>');
		
		
		var center = $('<div class="center" ></div>');	
			
			var leftCont = $('<div class="leftCont" ></div>');
						
				var titleField = $('<label for="bookTitle" class="rowTitle">Title: </label>'+'<input type="text" class="form-field" name="bookTitle" placeholder="Book title" id="bookTitle" tabindex="1">');			
			
				var fnameField = $('<label for="firstName" class="rowTitle">First name: </label>'+ '<input type="text" class="form-field" name="firstName" placeholder="First name.." id="firstName" tabindex="3">');			
					
				var pagesField = $('<label for="pages" class="rowTitle">Number of pages: </label>'+ '<input type="number" class="form-field" name="pages" placeholder="number of pages" id="pages" tabindex="5">');			
		
				var coverFile = $('<label for="cover" class="rowTitle">Cover photo: </label>'+ '<input type="file" name="cover" id="cover" class="inputfile" onchange="checkFile(this)" tabindex="7">');
				
			var rightCont = $('<div class="rightCont" ></div>');
				
				var isbnField = $('<label for="isbn" class="rowTitle">ISBN number: </label>'+ '<input type="number" class="form-field" name="isbn" placeholder="10 digit code" id="isbn" onblur ="checkISBN()" tabindex="2">');			
				
				var lnameField = $('<label for="lastName" class="rowTitle">Last name: </label>'+'<input type="text" class="form-field" name="lastName" placeholder="Last name.." id="lastName" tabindex="4">');
				
				var dateField = $('<label for="pubDate" class="rowTitle">Publishing date: </label>'+'<input type="text" class="form-field" name="pubDate" placeholder="1992-03-01" id="pubDate" onblur="checkDate()" tabindex="6">');
				
				var bookFile = $('<label for="bookFile" class="rowTitle" >Book file: </label>'+ '<input type="file" name="bookFile" id="bookFile" class="inputfile" onchange="checkFile(this)" tabindex="8">');
				
				
			
			var descriptionField = $('<p class="bookDesc">Book description: '+'<p>'+ '<textarea name="bookDesc" class="form-field" id="bookDesc" cols="30" rows="20" placeholder="Book description.." tabindex="9"></textarea>' +'</p>'+'</p>');
			
			
			
		var bottom = $('<div class="bottom" ></div>');
			
			var back = $('<button id="backBut" class="button" onclick="goTo(\'My-library\')" tabindex="11">Back</button>');
			var subbmith = $('<button id="subBut" class="button" onclick="addBookAJAX()" tabindex="10">Subbmith</button>');
	
			// =-=-=--=-=-=-=--=--==-=-=--=--=-= END of Creating the necessary DOM elements =-=-=-=--=-==--=-=-=-=-=--=--=-=-=-=\\
	
			
			// =-=--=-==-=-=-=---=-=-=-=-=-=-= Appending the elements to the Body ==-=-=--=-=--=-=--=-=-=-=-=-=-=--=-=-==-=-\\
	header.appendTo(top);
	top.appendTo(mainCont);
	
	titleField.appendTo(leftCont);
	fnameField.appendTo(leftCont);	
	pagesField.appendTo(leftCont);
	coverFile.appendTo(leftCont);
	
	leftCont.appendTo(center);
	
	isbnField.appendTo(rightCont);
	lnameField.appendTo(rightCont);
	dateField.appendTo(rightCont);
	bookFile.appendTo(rightCont);
	
	rightCont.appendTo(center);
	
	descriptionField.appendTo(center);
	
	center.appendTo(mainCont);
	
	back.appendTo(bottom);
	subbmith.appendTo(bottom);
	
	bottom.appendTo(mainCont);	
	
	mainCont.hide();
	mainCont.appendTo("#container").show('slow');
	
			// =-=--=-==-=-=-=---=-=-=-=-=-=-= END of Appending the elements to the Body ==-=-=--=-=--=-=--=-=-=-=-=-=-=--=-=-==-=-\\
	window.location.hash = "add-book";
	
	
}
				// =-=-=-=-=-=-=-=--=---=--==-=--=-----=--=- END of book interface =-=-=--==-=--==-=--=-=-=--=-\\








// --------------------------------------------------------------------------------------------------------------------------------------------------------\\

			








// =-=-=-=--=-=--=-=--=-=-=--=--=-= Creating user control panel =--==-=-=-=-=--==-==-=--=-=\\

function controlPanel(userInfo) {
						// =-=-=--=-=-=--=-=--=-=--= Creating control panel elements =-=-=--==-=-==--==--=-=--=-=\\
	var container = $('<div class="control_panel" ></div>');
	
		var top = $('<div class="top" ></div>');
	
			var logo = $('<div class="logo" ></div>');						
			var addBook = $('<div class="button" onclick="goTo(\'add-book\')" ></div>');
			
		var center = $('<div class="center" ></div>');
		
			var info = $('<div class="user_info" ></div>');
			var search = $('<input type="text" name="search" placeholder="Search.." id="search" onkeypress="search(event)">');
			
		var bottom = $('<div class="bottom" ></div>');
			
			var pagination = $('<div class="pagination" ></div>')
		
							// =-=-=--=-=-=--=-=--=-=--= END of control panel elements =-=-=--==-=-==--==--=-=--=-=\\
		
					// =-=-=--=-=-=--=-=--=-=--= Create and append the inner HTML for the elements =-=-=--==-=-==--==--=-=--=-=\\
		$('<img src="./assets/images/website/wapi_logo.png"/>').appendTo(logo);
		$('<h1>Hello '+userInfo.first_name +'!</h1>').appendTo(info);		
		$('<p>+ Add Book</p>').appendTo(addBook);
		
				
		
			for (var i = 1; i <= userInfo.max_offset; i++) {
					$('<a class="navigation" onclick="pagination(this)" id="'+i+'">'+ i +'</a>').appendTo(pagination);
				}
			
		
		
	
		logo.appendTo(top);		
		addBook.appendTo(top);
		info.appendTo(center);
		search.appendTo(center)
		top.appendTo(container);
		center.appendTo(container);
		pagination.appendTo(bottom);
		bottom.appendTo(container);
		container.hide();
		$("#container").prepend(container.show('slow'));
		
					// =-=-=--=-=-=--=-=--=-=--= END of Create and append the inner HTML for the elements =-=-=--==-=-==--==--=-=--=-=\\
	
	}

							// =-=-=-=--=-=--=-=--=-=-=--=--=-=END of control panel =--==-=-=-=-=--==-==-=--=-=\\









// --------------------------------------------------------------------------------------------------------------------------------------------------------\\









					// =-=--=-=-=-=--=-=-=-=-=-=-=-=-=-=-=-=-= Creating visualization for user library =-=-=-=--=-=-=--=-=--=-=--=-=--=-\\

function inportLibraryFromAJAX(response, offset = 0) {
	$( "#container" ).empty()	
	
	var container = $('<form id="form-1" action="#"></form>');
	var books1 = $('<div class="books1" ></div>');	
	var books2 = $('<div class="books2" ></div>');
	
	if ($.isArray(response)){
		
		for (var i = 0; i < response.length; i++) {	
		
		var bookCont =	$('<div class="bookCont" ></div>');
		var book = $('<div class="book" id="book'+ i +'"></div>');	
		var download = $('<a href="'+response[i].location_url+'" download="'+response[i].title+'"></a>');	
		var cover = $('<img src="'+ response[i].cover +'"/>');
		var describtion =  $('<div class="desc" ></div>');
		var title = $('<p>Title: '+ '<strong>'+response[i].title +'</strong>'+'</p>');
		var pubDate = $('<p>Pub. Date: '+ '<strong>'+response[i].published_date +'</strong>'+'</p>');
		var isbn = $('<p>ISBN: '+ '<strong>'+response[i].isbn +'</strong>'+'</p>');
		var pages = $('<p>Pages: '+ '<strong>'+response[i].pages +'</strong>'+'</p>');
		var autor = $('<p>Autor: '+ '<strong>' +response[i].autor_Fname[0] +". "+response[i].autor_Lname+'</strong>'+'</p>');
		
		
				// =-=-=--=-=-=--=-=--=-=--= Aappend DOM elements =-=-=--==-=-==--==--=-=--=-=\\
		
		isbn.appendTo(describtion);
		title.appendTo(describtion);
		pubDate.appendTo(describtion);
		pages.appendTo(describtion);
		autor.appendTo(describtion);	
		cover.appendTo(download);
		download.appendTo(book);
		book.appendTo(bookCont);
		describtion.appendTo(bookCont);	
		if (i < 3) {
			bookCont.hide();
			bookCont.appendTo(books1).show('slow');
		}else {
			bookCont.hide();
			bookCont.appendTo(books2).show('slow');
		}	
		books1.hide();
		books1.appendTo(container).show('slow');
		books2.hide();
		books2.appendTo(container).show('slow');
		}
	}else{  
		var phpResponse = $('<p>'+'<strong>'+response+'</strong>'+'</p>');	 
		phpResponse.hide();
		phpResponse.appendTo(container).show('slow');
		container.css("text-align", "center");
		
	}
	
	
	container.hide();
	container.appendTo("#container").show('slow');
			
			// =-=-=--=-=-=--=-=--=-=--= END of append =-=-=--==-=-==--==--=-=--=-=\\
	
};


						// =-=--=-=-=-=--=-=-=-=-=-=-=-=-=-=-=-=-= END of user library =-=-=-=--=-=-=--=-=--=-=--=-=--=-\\





function inportSearchLibraryFromAJAX(response, offset = 0) {
	
	$( "#form-1" ).empty()	
	
	var container = $("#form-1");
	var books1 = $('<div class="books1" ></div>');	
	var books2 = $('<div class="books2" ></div>');
	
	if ($.isArray(response)){
		
		for (var i = 0; i < response.length; i++) {	
		
		var bookCont =	$('<div class="bookCont" ></div>');
		var book = $('<div class="book" id="book'+ i +'"></div>');	
		var download = $('<a href="'+response[i].location_url+'" download="'+response[i].title+'"></a>');	
		var cover = $('<img src="'+ response[i].cover +'"/>');
		var describtion =  $('<div class="desc" ></div>');
		var title = $('<p>Title: '+ '<strong>'+response[i].title +'</strong>'+'</p>');
		var pubDate = $('<p>Pub. Date: '+ '<strong>'+response[i].published_date +'</strong>'+'</p>');
		var isbn = $('<p>ISBN: '+ '<strong>'+response[i].isbn +'</strong>'+'</p>');
		var pages = $('<p>Pages: '+ '<strong>'+response[i].pages +'</strong>'+'</p>');
		var autor = $('<p>Autor: '+ '<strong>' +response[i].autor_Fname[0] +". "+response[i].autor_Lname+'</strong>'+'</p>');
		
		
				// =-=-=--=-=-=--=-=--=-=--= Aappend DOM elements =-=-=--==-=-==--==--=-=--=-=\\
		
		isbn.appendTo(describtion);
		title.appendTo(describtion);
		pubDate.appendTo(describtion);
		pages.appendTo(describtion);
		autor.appendTo(describtion);	
		cover.appendTo(download);
		download.appendTo(book);
		book.appendTo(bookCont);
		describtion.appendTo(bookCont);	
		if (i < 3) {
			
			bookCont.appendTo(books1)
		}else {
			
			bookCont.appendTo(books2)
		}	
		
		books1.appendTo(container)
		
		books2.appendTo(container)
		}
	}else{  
		var phpResponse = $('<p>'+'<strong>'+response+'</strong>'+'</p>');	 
		phpResponse.hide();
		phpResponse.appendTo(container).show('slow');
		container.css("text-align", "center");
		
		
	}
			
			// =-=-=--=-=-=--=-=--=-=--= END of append =-=-=--==-=-==--==--=-=--=-=\\
	
}






function createUserPanel() {
	$('#container').empty()
	
	//=-=-=-=-=-=-=-=-=-=-=-=-=--=-=-= Creating elements =-=-=-=-=-=-=--=-=-=-=-==-=-=\\
	
	var form = $('<form id="form-2" ></form>')
		var header = $('<h1>Sign Up</h1>')
		
		var fieldset = $('<fieldset></fieldset>')			
			var legend = $('<legend>'+'<span class="number"></span>Your basic info'+'</legend>')
			
			var fname_label = $('<label for="name">First name:</label> ')
			var fname_inp = $('<input class="form-field" type="text" id="fname" name="f_name"> ')
			
			var lname_label = $('<label for="name">Last name:</label> ')
			var lname_inp = $('<input class="form-field" type="text" id="lname" name="l_name"> ')
			
			var email_label = $('<label for="name">E-mail:</label> ')
			var email_inp = $('<input class="form-field" type="text" id="email" name="email" onblur="emailCheck(this)"> ')
			
			var pass_label = $('<label for="name">Password:</label> ')
			var pass_inp = $('<input class="form-field" type="password" id="pass" name="pass"> ')
			
			var rePass_label = $('<label for="name">Repeate password:</label> ')
			var rePass_inp = $('<input class="form-field" type="password" id="rePass" name="rePass" onblur="checkPass()"> ')
			
		var back = $('<button id="backBut" class="button" onclick="goTo(\'logIn\')">Back</button>');
		var subbmith = $('<button id="subBut" class="button" onclick="createUserAJAX()" >Subbmith</button>');
		
		//=-=-=-=-=-=-=-=-=-=-=-=-=--=-=-= END of Creating elements =-=-=-=-=-=-=--=-=-=-=-==-=-=\\
		
		//=-=-=-=-=-=-=-=-=-=-=-=-=--=-=-= Appending elements =-=-=-=-=-=-=--=-=-=-=-==-=-=\\
	
	legend.appendTo(fieldset)
	fname_label.appendTo(fieldset)
	fname_inp.appendTo(fieldset)
	lname_label.appendTo(fieldset)
	lname_inp.appendTo(fieldset)
	email_label.appendTo(fieldset)
	email_inp.appendTo(fieldset)
	pass_label.appendTo(fieldset)
	pass_inp.appendTo(fieldset)
	rePass_label.appendTo(fieldset)
	rePass_inp.appendTo(fieldset)
	header.appendTo(form)
	fieldset.appendTo(form)
	back.appendTo(form)
	subbmith.appendTo(form)
	form.hide()
	form.appendTo('#container').show('slow');
}









function LogInMenu() {
	$('#container').empty()
	
	//=-=-=-=-=-=-=-=-=-=-=-=-=--=-=-= Creating elements =-=-=-=-=-=-=--=-=-=-=-==-=-=\\
	
	var form = $('<form id="form-1" class="login-form" enctype="multipart/form-data"></form>')
		var divEmail = $('<div id="email_login">'+'<input class="form-field" id="username" type="text" placeholder="username" onblur="emailCheck(this)"/>'+'</div>')
		
		var divPass = $('<div id="pass_login">'+'<input class="form-field" id="password_login" type="password" placeholder="password" />'+'</div>')			
			
		var button = $('<button id="login_button" name="login_button" type="submit" onclick="logInAJAX()">login</button>')
			
		var register = $('<p class="message">Not registered? ' +'<span  id="creation" onclick = "goTo(\'signUp\')">Create an account</span>'+'</p>')
			
		
		//=-=-=-=-=-=-=-=-=-=-=-=-=--=-=-= END of Creating elements =-=-=-=-=-=-=--=-=-=-=-==-=-=\\
		
		//=-=-=-=-=-=-=-=-=-=-=-=-=--=-=-= Appending elements =-=-=-=-=-=-=--=-=-=-=-==-=-=\\
	
	divEmail.appendTo(form)
	divPass.appendTo(form)
	button.appendTo(form)
	register.appendTo(form)
	
	form.hide()
	form.appendTo('#container').show('slow');
}




function failReport(message) {
	$('#container').empty()
	
	var divPic = $('<div id="errorDiv">'+'<img id="errorPic" src="./assets/images/website/error.png" alt="error"/>'+'</div>')
		
		var divPass = $('<div id="errorMsg">'+'<p>'+message+'</p>'+'</div>')			
			
		var button = $('<button id="errorButton" name="login_button" type="submit" onclick="goTo(\'logIn\')">Към начална страница</button>')
	
	divPic.appendTo('#container')		
	divPass.appendTo('#container')	
	button.appendTo('#container')
		
}





function succsessReport(message) {
	$('#container').empty()
	
	var divPic = $('<div id="errorDiv">'+'<img id="errorPic" src="./assets/images/website/succsess.png" alt="error"/>'+'</div>')
		
		var divPass = $('<div id="errorMsg">'+'<p>'+message+'</p>'+'</div>')			
			
		var button = $('<button id="errorButton" name="login_button" type="submit" onclick="goTo(\'logIn\')">Към начална страница</button>')
	
	divPic.appendTo('#container')		
	divPass.appendTo('#container')	
	button.appendTo('#container')
		
}












