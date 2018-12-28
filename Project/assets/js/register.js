$(document).ready(function(){
$('.message a').click(function(){
    $('form').animate({height:"toggle" , opacity:"toggle"} , "slow");
});

// document.getElementById("#btncheck").disabled = true;
// $('#check').change(function () {
//     $('#btncheck').prop("disabled", false);
// }).change()

$('#sign-academy-btn').click(function(){
	$('#sign-insttructor-btn').css({"background" : "#fafbfc" , "border-right" : "1px solid #dbe2e8" , "border-bottom" : "1px solid #dbe2e8"});
	$('#sign-academy-btn').css({"background" : "#fff" , "border": "none"});
	$('#sign-academy-btn:focus').css("outline" , "0");
    // $('#sign-insttructor-btn').css("box-shadow" , "0px 0px 20px 0px rgba(0, 0, 0, 0.1)");
    $('#sign-insttructor').hide();
    $('#sign-academy').show();
});

$('#sign-insttructor-btn').click(function(){
	$('#sign-insttructor-btn').css({"background" : "#fff" , "border": "none"});
	$('#sign-academy-btn').css({"background" : "#fafbfc" , "border-left" : "1px solid #dbe2e8" , "border-bottom" : "1px solid #dbe2e8"});
    $('#sign-insttructor-btn:focus').css("outline" , "0");
    // $('#sign-academy-btn').css("box-shadow" , "0px 0px 20px 0px rgba(0, 0, 0, 0.1)");
    $('#sign-insttructor').show();
    $('#sign-academy').hide();
});
});