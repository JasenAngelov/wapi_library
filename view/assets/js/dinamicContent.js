/**
 * 
 */

					// =-=-=-=-=-=-=-=--=---=--==-=--=-----=--=- Add new book interface =-=-=--==-=--==-=--=-=-=--=-\\
function addNewBook() {
	
	$( "body" ).empty()
	
	//=-=-=--=-=-=-=--=--==-=-=--=--=-= Creating the necessary DOM elements =-=-=-=--=-==--=-=-=-=-=--=--=-=-=-=\\
	
	var mainCont = $('<div class="container" ></div>');
		
		var top = $('<div class="top" ></div>');
			var header = $('<h1>Please fill out all fields correctly!</h1>');
		
		
		var center = $('<div class="center" ></div>');	
			
			var leftCont = $('<div class="leftCont" ></div>');
						
				var titleField = $('<label for="bookTitle" class="rowTitle">Title: </label>'+'<input type="text" name="bookTitle" placeholder="Book title" id="bookTitle">');			
			
				var fnameField = $('<label for="firstName" class="rowTitle">First name: </label>'+ '<input type="text" name="firstName" placeholder="First name.." id="firstName">');			
					
				var pagesField = $('<label for="pages" class="rowTitle">Number of pages: </label>'+ '<input type="number" name="pages" placeholder="number of pages" id="pages">');			
		
				var coverFile = $('<label for="cover" class="rowTitle">Cover photo: </label>'+ '<input type="file" name="cover" id="cover" class="inputfile" onchange="checkFile(this)">');
				
			var rightCont = $('<div class="rightCont" ></div>');
				
				var isbnField = $('<label for="isbn" class="rowTitle">ISBN number: </label>'+ '<input type="number" name="isbn" placeholder="8-13 digit code" id="isbn">');			
				
				var lnameField = $('<label for="lastName" class="rowTitle">Last name: </label>'+'<input type="text" name="lastName" placeholder="Last name.." id="lastName">');
				
				var dateField = $('<label for="pubDate" class="rowTitle">Publishing date: </label>'+'<input type="text" name="pubDate" placeholder="1992-03-01" id="pubDate">');
				
				var bookFile = $('<label for="bookFile" class="rowTitle" >Book file: </label>'+ '<input type="file" name="bookFile" id="bookFile" class="inputfile" onchange="checkFile(this)">');
				
				
			
			var descriptionField = $('<p class="bookDesc">Book description: '+'<p>'+ '<textarea name="bookDesc" id="bookDesc" cols="30" rows="20" placeholder="Book description.."></textarea>' +'</p>'+'</p>');
			
			
			
		var bottom = $('<div class="bottom" ></div>');
			
			var back = $('<button id="backBut" class="button" >Back</button>');
			var subbmith = $('<button id="subBut" class="button" onclick="addBookAJAX()" >Subbmith</button>');
	
			//=-=-=--=-=-=-=--=--==-=-=--=--=-= END of Creating the necessary DOM elements =-=-=-=--=-==--=-=-=-=-=--=--=-=-=-=\\
	
			
			//=-=--=-==-=-=-=---=-=-=-=-=-=-= Appending the elements to the Body ==-=-=--=-=--=-=--=-=-=-=-=-=-=--=-=-==-=-\\
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
	mainCont.appendTo("body").show('slow');
			//=-=--=-==-=-=-=---=-=-=-=-=-=-= END of Appending the elements to the Body ==-=-=--=-=--=-=--=-=-=-=-=-=-=--=-=-==-=-\\
	
	
	
}
				// =-=-=-=-=-=-=-=--=---=--==-=--=-----=--=- END of book interface  =-=-=--==-=--==-=--=-=-=--=-\\








//--------------------------------------------------------------------------------------------------------------------------------------------------------\\

			








//=-=-=-=--=-=--=-=--=-=-=--=--=-= Creating user control panel =--==-=-=-=-=--==-==-=--=-=\\

function controlPanel(userInfo) {
						// =-=-=--=-=-=--=-=--=-=--= Creating control panel elements  =-=-=--==-=-==--==--=-=--=-=\\
	var container = $('<div class="control_panel" ></div>');
	
		var top = $('<div class="top" ></div>');
	
			var logo = $('<div class="logo" ></div>');						
			var addBook = $('<div class="button" onclick = "addNewBook()"></div>');
			
		var center = $('<div class="center" ></div>');
		
			var info = $('<div class="user_info" ></div>');
			var search = $('<input type="text" name="search" placeholder="Search.." id="search">');
			
		var bottom = $('<div class="bottom" ></div>');
			
			var pagination = $('<div class="pagination" ></div>')
		
							// =-=-=--=-=-=--=-=--=-=--= END of control panel elements =-=-=--==-=-==--==--=-=--=-=\\
		
					// =-=-=--=-=-=--=-=--=-=--= Create and append the inner HTML for the elements =-=-=--==-=-==--==--=-=--=-=\\
		$('<img src="./assets/images/website/wapi_logo.png"/>').appendTo(logo);
		$('<h1>Hello, '+userInfo.first_name +'</h1>').appendTo(info);
		$('<p>+ Add Book</p>').appendTo(addBook);
		$('<a href="#">&laquo; Previus</a>').appendTo(pagination);		
		
			for (var i = 1; i <= userInfo.max_offset; i++) {
					$('<a href="#">'+ i +'</a>').appendTo(pagination);
				}
			
		$('<a href="#">Next &raquo;</a>').appendTo(pagination);
		
	
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









//--------------------------------------------------------------------------------------------------------------------------------------------------------\\









					//=-=--=-=-=-=--=-=-=-=-=-=-=-=-=-=-=-=-= Creating visualization for user library =-=-=-=--=-=-=--=-=--=-=--=-=--=-\\

function inportLibraryFromAJAX(response, offset = 0) {
	$( "#container" ).empty()	
	
	var container = $('<form id="form-1" class="login-form" action="#"></form>');
	var books1 = $('<div class="books1" ></div>');	
	var books2 = $('<div class="books2" ></div>');
	
	for (var i = 0; i < response.length; i++) {	
	
	var bookCont =	$('<div class="bookCont" ></div>');
	var book = $('<div class="book" id="book'+ i +'"></div>');	
	var download = $('<a href="'+response[i].location_url+'" download="'+response[i].title+'"></a>');	
	var cover = $('<img src="./assets/images'+ response[i].cover +'"/>');
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
	container.hide();
	container.appendTo("#container").show('slow');
			
			// =-=-=--=-=-=--=-=--=-=--= END of append  =-=-=--==-=-==--==--=-=--=-=\\
	
};


						// =-=--=-=-=-=--=-=-=-=-=-=-=-=-=-=-=-=-= END of user library =-=-=-=--=-=-=--=-=--=-=--=-=--=-\\














