$(function(){
	// #InfoPlatform_mainLeft
		// 绑定左部居中动作
		autoYCenter($("#InfoPlatform_mainLeft"));
		autoYCenter($("#InfoPlatform_mainRight"));

		$(window).bind("resize",function(){
			autoYCenter($("#InfoPlatform_mainLeft"));
		});


	// #InfoPlatform_mainRight
	$(document).on('click', ("#InfoPlatform_mainRight .step #mailpassword"), function() {
		// 检测是否登录
		$.get('/Home/Login/getSession_uid', {}, function(data_uid) {
			if (data_uid == '') {
				var email = $.trim($("#InfoPlatform_mainRight .step .controller .form-group input[type='email']").val());
				if (email == '') {
					alert("email为空，请检查！");
				} else {
					$.get('/Home/Login/newPassword', {
						'email': email
					}, function(data) {
						if (data == -1) {
							alert("email输入有误，请检查");
						} else if (data == 0){
							alert("重置新密码成功！请登录。");
							$("#InfoPlatform_header #userBox #login a").trigger("click");
						} else {
							alert(data);
						}
					})
				}
			} else {
				alert("你已登录...");
			}
		});
	});
})