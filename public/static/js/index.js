/**
 *  index.js
 */

$(document).ready(function(){
	$("#button").click(function(){
		alert("click me");
	});
});

$(document).ready(function(){
	$("#refreshCaptcha").click(function(){
		$("#captcha img").attr("src",captchaSrc);		
	});
});

$(document).ready(function(){
	$("#submit").click(function(){
		var captchaValue = $("#captchaValue").val();
		$.ajax({
			url: checkCaptcha,
			data: {"captchaValue":captchaValue},
			success: function(data){
				if(data){
					$("#msg").html("success");
				}else{
					$("#msg").html("error");
				}
			}
		});
	});
});