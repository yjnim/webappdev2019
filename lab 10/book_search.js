window.onload = function() {
    $("b_xml").onclick=function(){
		//construct a Prototype Ajax.request object
		new Ajax.Request("./books.php", {
			method: "GET",
			parameters: {category: getCheckedRadio($$('input[type="radio"]'))},
			onSuccess: showBooks_XML,
			onFailure: ajaxFailed,
			onException: ajaxFailed
		});
    }
    $("b_json").onclick=function(){
		//construct a Prototype Ajax.request object
		new Ajax.Request("./books_json.php", {
			method: "GET",
			parameters: {category: getCheckedRadio($$('input[type="radio"]'))},
			onSuccess: showBooks_JSON,
			onFailure: ajaxFailed,
			onException: ajaxFailed
		});
    }
};

function getCheckedRadio(radio_button){
	for (var i = 0; i < radio_button.length; i++) {
		if(radio_button[i].checked){
			return radio_button[i].value;
		}
	}
	return undefined;
}

function showBooks_XML(ajax) {
	$('books').innerHTML = "";

	var books = ajax.responseXML.getElementsByTagName("book");
	for (var i=0; i<books.length; i++) {
		var li = document.createElement("li");
		li.innerHTML = books[i].getElementsByTagName("title")[0].firstChild.nodeValue
			+ ", by " + books[i].getElementsByTagName("author")[0].firstChild.nodeValue
			+ " (" + books[i].getElementsByTagName("year")[0].firstChild.nodeValue + ")";
		$('books').appendChild(li);
	}
}

function showBooks_JSON(ajax) {
	$('books').innerHTML = "";

	var data = JSON.parse(ajax.responseText);
	console.log(data);
	for (var i=0; i < data.books.length; i++) {
		var li = document.createElement("li");
		li.innerHTML = data.books[i].title + ", by " + data.books[i].author + " (" + data.books[i].year + ")";
		$('books').appendChild(li);
	}
}

function ajaxFailed(ajax, exception) {
	var errorMessage = "Error making Ajax request:\n\n";
	if (exception) {
		errorMessage += "Exception: " + exception.message;
	} else {
		errorMessage += "Server status:\n" + ajax.status + " " + ajax.statusText + 
		                "\n\nServer response text:\n" + ajax.responseText;
	}
	alert(errorMessage);
}
