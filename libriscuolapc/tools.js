/*
 * tools.js for libriscuolapc - version 1.0 
 *
 */
$(function(){
	$("#bookdata").find('input,textarea,select').prop('disabled',true);
});

//richesta ajax libro
function chiudilibro(){
	$("#book_sell").slideUp();
	$("#bookinfo").slideUp();
	$("#bookdata").find('input,textarea,select').prop('disabled',true);
}

$(document).on('submit','#booksearch',function(event){
	event.preventDefault();
	checkisbn();
	
});
function cercalibro(){
	//alert($("#isbn").val());
    var url = "getbook.php"; // the script where you handle the form input.
    $.ajax({
           type: "GET",
           url: url,
           beforeSend: chiudilibro,
           data: $("#booksearch").serialize(),// serializes the form's elements.
           success : function (response) {
			$("#bookinfo").html(response).slideDown();
			if (document.getElementById("theisbn")) {
				$("#book_sell").slideDown();
				$("#bookdata").find('input,textarea,select').prop('disabled',false);
			}
			} 
        });
}

//checkISBN
function checkisbn(){
	isbn=$("#isbn").val();
	if(isValidISBN10(isbn)||isValidISBN13(isbn)){
		//alert("valido!");
		cercalibro();
	}
	else{
		//alert("non valido!");
		chiudilibro();
		$("#bookinfo").html("<p>ISBN non valido! Ricontrolla!</p>");
		$("#bookinfo").slideDown();
	}
}
function isValidISBN10(a) {
    var c, b;
    if (10 != a.length) return !1;
    for (b = c = 0; 10 > b; b++)
        if ("X" == a[b] || "x" == a[b]) c += 10 * (10 - b);
        else if ($.isNumeric(a[b])) c += parseInt(a[b]) * (10 - b);
    else return !1;
    return 0 == c % 11
}

function isValidISBN13(a) {
    var c, b;
    if (13 != a.length) return !1;
    a = a.replace(/[-\s]/g, "");
    for (b = c = 0; 13 > b; b += 2) c += +a[b];
    for (b = 1; 12 > b; b += 2) c += 3 * +a[b];
    return 0 === c % 10
}

//controlli form
function check_form(event)
{
	var err=0;
	var errlist="";
	if($("#prezzo")=="") //prezzo non nullo
	{
			event.preventDefault();
			err=1;
			errlist="<p>inserisci un prezzo!</p>";
			$("#form_errlist").html(errlist).slideDown();
			
			return false;
	}
	else if(!($.isNumeric($("#prezzo").val()))) //prezzo numerico
		{
			event.preventDefault();
			err=1;
			errlist="Il prezzo deve essere un numero!";
			$("#form_errlist").html(errlist).fadeIn(100);
			$("#form_errlist").html(errlist).fadeOut(2000);
			
			return false;
		}
		else{
			return true;
		}
}

//counter notes
$(function() {
    //set up text length counter
    $('#notes').on("keypress", function() {
        update_chars_left(300, $('#notes')[0], $('#counter'));
    });
    //and fire it on doc ready, too
    update_chars_left(300, $('#notes')[0], $('#counter'));

});

function update_chars_left(max_len, target_input, display_element) {
   var text_len = target_input.value.length;
   if (text_len >= max_len) {
       target_input.value = target_input.value.substring(0, max_len); // truncate
       display_element.html("0");
   } else {
       display_element.html(max_len - text_len);
   }
}

$(document).on('submit','#bookdata',function(event){
	check_form(event);
});
