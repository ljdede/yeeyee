$(function(){
	// #InfoPlatform_mainLeft
		// 绑定左部居中动作
		autoYCenter($("#InfoPlatform_mainLeft"));
		autoYCenter($("#InfoPlatform_mainRight"));

		$(window).bind("resize",function(){
			// changeHeight_infoPanel();			// 联系面板调整
			autoYCenter($("#InfoPlatform_mainLeft"));
		});

		// 检测唯一email
		$("#InfoPlatform_mainRight .step_1 form").submit(function() {
			$thisform = $(this);
			if ($(this).find("input[type='text']").val() != "") {
				var url = $(this).attr('action');
				// 验证
				$.get(url, $(this).serialize(), function(data){
					// alert(data);
					if (data == 0) {
						$thisform.find(".alert-danger").show();	
						$thisform.find(".alert-warning").hide();

					} else if(data == -1){
						$thisform.find(".alert-warning").show();
						$thisform.find(".alert-danger").hide();	
					} else {
						$("#InfoPlatform_mainRight .step_2 .text b").text(data);
						$thisform.parent().hide(200);
						$("#InfoPlatform_mainRight .step_2").show(200);	

						// 生成邮箱网址
						$("#InfoPlatform_mainRight .step_3 .gotoEmail").attr("href", generateEmailWeb());
					};
				});
			} else {
				$(this).find(".alert-warning").show();
				$(this).find(".alert-danger").hide();	
			}
			return false;
		});

		$("#InfoPlatform_mainRight .step_2 form").submit(function() {
			$thisform = $(this);
			if ($(this).find("input[type='password']").val() == "") {
				$(this).find(".alert-warning").show();
				$(this).find(".alert-danger").hide();	
			} else if( !(/^[A-Za-z0-9_]{6,20}$/).test($(this).find("input[type='password']").val()) ) {
				$(this).find(".alert-warning").hide();
				$(this).find(".alert-danger").show();
			} else {
				var email = $("#InfoPlatform_mainRight .step_1 form").find("input[type='text']").val();
				var url = $(this).attr('action');
				// 验证
				$.get(url, {
					"email": email,
					"password": $(this).find("input[type='password']").val()
				}, function(data){
					// alert(data);
					if (data == 0) {
						$thisform.find(".alert-danger").show();	
						$thisform.find(".alert-warning").hide();
					} else if(data == -1){
						$thisform.find(".alert-warning").show();
						$thisform.find(".alert-danger").hide();	
					} else if(data == 1){
						// alert(1);
						$thisform.parent().hide(200);
						$("#InfoPlatform_mainRight .step_3").show(200);
					};
				});
			}
			return false;
		});

		$("#InfoPlatform_mainRight .step_2 form button[type='button']").click(function() {
			$(this).parents(".step_2").hide(200);
			$("#InfoPlatform_mainRight .step_3").show(200);
		});

		$(document).on('click', ("#InfoPlatform_mainRight .step_3 #toDetail"), function() {
			window.location.href = "/Home/setup";
		});
		$(document).on('click', ("#InfoPlatform_mainRight .step_3 #toIndex"), function() {
			window.location.href = "/";
		});


	// function area
	function generateEmailWeb() {
		var email = $("#InfoPlatform_mainRight .step_1 input[name='email']").val();
		var restpart = email.split('@')[1];
		var emailWeb = '';
		switch(restpart){
			case "126.com":
				emailWeb = "http://www.126.com";
				break;
			case "qq.com":
				emailWeb = "http://mail.qq.com";
				break;
			case "gmail.com":
				emailWeb = "http://gmail.google.com";
				break;
			case "163.com":
				emailWeb = "http://mail.163.com";
				break;
			case "sina.cn":
				emailWeb = "http://mail.sina.cn";
				break;
			case "sina.com":
				emailWeb = "http://mail.sina.com";
				break;
			case "hotmail.com":
				emailWeb="http://www.hotmail.com";
				break;
			case "sohu.com":
				emailWeb = "http://mail.sohu.com";
				break;
			case "yahoo.cn":
				emailWeb = "http://mail.yahoo.cn";
				break;
			case "139.com":
				emailWeb = "http://mail.139.com";
				break;
			case "189.cn":
				emailWeb ="http://mail.189.cn";
				break;
			default:
				emailWeb = "http://www." + restpart;
				break;
		}
		return emailWeb;
	}
})