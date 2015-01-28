$(function(){
	// #InfoPlatform_mainLeft
		// 绑定左部居中动作
		autoYCenter($("#InfoPlatform_mainLeft"));
		autoYCenter($("#InfoPlatform_mainRight"));

		$(window).bind("resize",function(){
			// changeHeight_infoPanel();			// 联系面板调整
			autoYCenter($("#InfoPlatform_mainLeft"));
		});


	// #InfoPlatform_mainRight
	$(document).on('click', ("#InfoPlatform_mainRight .step #toDetail"), function() {
		// 检测是否登录
		$.get('/Home/Login/getSession_uid', {}, function(data_uid) {
			if (data_uid == '') {
				$("#InfoPlatform_header #userBox #login a").trigger("click");
			} else {
				window.location.href = "/Home/setup";
			}
		});
	});
	$(document).on('click', ("#InfoPlatform_mainRight .step #toIndex"), function() {
		// 检测是否登录
		$.get('/Home/Login/getSession_uid', {}, function(data_uid) {
			if (data_uid == '') {
				$("#InfoPlatform_header #userBox #login a").trigger("click");
			} else {
				window.location.href = "/";
			}
		});
	});
})