	// 定义居中动作
	function autoYCenter($object){
		var winHeight = $(window).height();
		var headerHeight = $("#InfoPlatform_header").height();
		var footerHeight = $("#InfoPlatform_footer").height();
		var objectHeight = $object.height();

		if((winHeight) < (objectHeight + headerHeight + 10 + 10 + footerHeight )){
			ntop = 0 + headerHeight;
		}else{
			ntop = (winHeight - headerHeight - footerHeight - objectHeight) / 2 + headerHeight;
		}

		$object.animate({"top": ntop}, 400);
	}
	// alert(9);
$(function(){
	// 检测登录状态
	getSession();

	// 登陆框提交行为
	$("#userBox_loginBox form").submit(function() {
		$thisform = $(this);
		var url = $(this).attr('action');
		// 验证
		$.post(url, $(this).serialize(), function(data){
			// alert(data);
			if (data == 1) {
				// 登录情况提示
				$thisform.find(".alert-success").show();
				$thisform.find(".alert-warning").hide();

				// 改变登录状态
				getSession();
				
				// 隐藏登录框
				setTimeout(function(){
					$('#userBox_loginBox').modal('hide');
					$thisform.find(".alert-success").hide();
					$thisform.find(".alert-warning").hide();
				}, 500);
			} else {
				// 登录情况提示
				$thisform.find(".alert-success").hide();
				$thisform.find(".alert-warning").show();
			};
		});
		return false;
	});

	// 用户设置框 注销行为
	$("#userBox_manageBox form").submit(function() {
		$thisform = $(this);
		var url = $(this).attr('action');
		// 验证
		$.getJSON(url, '', function(data){
			 // alert(data);
			if(data.username == null) {
				// 登录情况提示
				$thisform.find(".alert-success").show();
				$thisform.find(".alert-warning").hide();

				$("#InfoPlatform_header #userBox #signup").show();
				$("#InfoPlatform_header #userBox #login").show();
				$("#InfoPlatform_header #userBox #userimg").hide();
				$("#InfoPlatform_header #userBox #username").hide();

				// 隐藏登录框
				setTimeout(function(){
					$('#userBox_manageBox').modal('hide');
					$thisform.find(".alert-success").hide();
					$thisform.find(".alert-warning").hide();
				}, 1000);

				// getContactPanel_user();
				
			} else {
				// 登录情况提示
				$thisform.find(".alert-success").hide();
				$thisform.find(".alert-warning").show();
			};
		});
		return false;
	});

	//返回顶部
	var $backToTopEle = $('<div id ="backToTop"></div>').appendTo($("body")).animate({opacity:0.5},0).click(function() {
			$("html, body").animate({scrollTop:0},200);
    	});
	function backToTopFun() {
		var st = $(document).scrollTop();
		(st > 0) ? $backToTopEle.show(0) : $backToTopEle.hide(0);
		$backToTopEle.css({"right": 20, 'bottom': 40});
	};
	$(window).bind("scroll",backToTopFun);

	// 函数定义
	function getSession(){
		// 登录成功后获取session信息
		$.getJSON("/Home/Login/getSession", "", function(data){
			if(data.username != null){
				$("#InfoPlatform_header #userBox #signup").hide();
				$("#InfoPlatform_header #userBox #login").hide();
				$("#InfoPlatform_header #userBox #userimg").show();
				$("#InfoPlatform_header #userBox #username").show();

				// 改头像和名字信息
				$("#InfoPlatform_header #userBox #username b").text(data.username);
				// alert(data.avatar);
				$("#InfoPlatform_header #userBox #userimg img").attr('src', data.avatar);
			}
		});
	}

	
});
	


	