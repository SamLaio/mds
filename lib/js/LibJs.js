$(document).ready(function(){
	$('#login').on('click', function(){
		document.location = 'login';
	});
	$('#logout').on('click', function(){
		//document.location = 'login';
		$.post('cgi/login/Logout',function(){
			document.location = 'index';
		});
	});
});
