<?php
	if(!isset($_SESSION))
		session_start();
?>
$(document).ready(function(){
	$('#goIndex').on('click', function(){
		PageChange('index');
	});
	$('#flow').on('click', function(){
		PageChange('flow');
	});
	$('#plan').on('click', function(){
		PageChange('plan');
	});
	
	$('#login').on('click', function(){
		PageChange('login');
	});
	$('#logout').on('click', function(){
		$.post('<?php echo $_SESSION['SiteUrl'];?>cgi/login/Logout',function(){
			document.location = '<?php echo $_SESSION['SiteUrl'];?>';
		});
	});
});
function PageChange(page){
	$.post('<?php echo $_SESSION['SiteUrl'];?>body/'+page,function(e){
		$('#BodyMain').html(e);
		$("head").append("<scr" + "ipt type=\"text/javascript\" src=\"<?php echo $_SESSION['SiteUrl'];?>js/Lang\"></scr" + "ipt>");
	});
}
