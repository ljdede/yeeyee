$(function(){
	// #InfoPlatform_mainLeft
		// 绑定左部居中动作
		autoYCenter($("#InfoPlatform_mainLeft"));
		autoYCenter($("#InfoPlatform_mainRight"));

		$(window).bind("resize",function(){
			// changeHeight_infoPanel();			// 联系面板调整
			autoYCenter($("#InfoPlatform_mainLeft"));
			autoYCenter($("#InfoPlatform_mainRight"));
		});

		// 标签页切换动画
		$("#InfoPlatform_mainRight .settingTabs .nav-tabs a").click(function() {
			$("#InfoPlatform_mainRight .settingTabs .alert-success").hide();
			$("#InfoPlatform_mainRight .settingTabs .alert-danger").hide();
			setTimeout(function(){
				autoYCenter($("#InfoPlatform_mainRight"));
			}, 500);
		});

		// 各标签页提交
		// 用户设置
		$("#InfoPlatform_mainRight .settingTabs .tab-content #setting_user form").submit(function() {
			$this = $(this);
			var url = $(this).attr('action');
			$.post(url, $(this).serialize(), function(data) {
				if(data == 1){
					$("#InfoPlatform_mainRight .settingTabs .alert-success").show(200);
					$("#InfoPlatform_mainRight .settingTabs .alert-danger").hide();
					// alert($("#InfoPlatform_mainLeft #welcomePanel .userBox .userName").text())
					$("#InfoPlatform_mainLeft #welcomePanel .userBox .userName").text($this.find("input[name='username']").val());
					$("#InfoPlatform_header #userBox #username b").text($this.find("input[name='username']").val());
				}else{
					$("#InfoPlatform_mainRight .settingTabs .alert-success").hide(200);
					$("#InfoPlatform_mainRight .settingTabs .alert-danger").text("不能为空！");
					$("#InfoPlatform_mainRight .settingTabs .alert-danger").show(200);
				}
			});
			return false;
		});
		// 密码设置
		$("#InfoPlatform_mainRight .settingTabs .tab-content #setting_password form").submit(function() {
			$this = $(this);
			var url = $(this).attr('action');
			$.post(url, $(this).serialize(), function(data) {
				if(data == 1){
					$("#InfoPlatform_mainRight .settingTabs .alert-success").show(200);
					$("#InfoPlatform_mainRight .settingTabs .alert-danger").hide();
				}else if(data == 0){
					$("#InfoPlatform_mainRight .settingTabs .alert-success").hide();
					$("#InfoPlatform_mainRight .settingTabs .alert-danger").text("原密码不正确，请检查！");
					$("#InfoPlatform_mainRight .settingTabs .alert-danger").show(200);
				}else if(data == -1){
					$("#InfoPlatform_mainRight .settingTabs .alert-success").hide();
					$("#InfoPlatform_mainRight .settingTabs .alert-danger").text("新密码两次输入不一致！");
					$("#InfoPlatform_mainRight .settingTabs .alert-danger").show(200);
				}else if(data == -2){
					$("#InfoPlatform_mainRight .settingTabs .alert-success").hide();
					$("#InfoPlatform_mainRight .settingTabs .alert-danger").text("新密码应该为6到20位！");
					$("#InfoPlatform_mainRight .settingTabs .alert-danger").show(200);
				}
			});
			return false;
		});
		// 联系设置
		$("#InfoPlatform_mainRight .settingTabs .tab-content #setting_contact form").submit(function() {
			$this = $(this);
			var url = $(this).attr('action');


			$mobileNumber = $(this).find("input[name='mobileNumber']");
			$mobileNumber_short = $(this).find("input[name='mobileNumber_short']");
			$qq = $(this).find("input[name='qq']");

			var pass = 1;

			if(isNaN($mobileNumber.val())){
				$mobileNumber.addClass('alertShadow');
				pass = 0;
			} else {
				$mobileNumber.removeClass('alertShadow');
			}
			
			if(isNaN($mobileNumber_short.val())){
				$mobileNumber_short.addClass('alertShadow');
				pass = 0;
			} else {
				$mobileNumber_short.removeClass('alertShadow');
			}
			if(isNaN($qq.val())){
				$qq.addClass('alertShadow');
				pass = 0;
			} else {
				$qq.removeClass('alertShadow');
			}

			if (pass == 0){
				alert("信息有误，请检查。");
			} else if (pass == 1) {
				$.post(url, $(this).serialize(), function(data) {
					if(data == 1){
						$("#InfoPlatform_mainRight .settingTabs .alert-success").show(200);
						$("#InfoPlatform_mainRight .settingTabs .alert-danger").hide();
					}else{
						$("#InfoPlatform_mainRight .settingTabs .alert-success").hide(200);
						$("#InfoPlatform_mainRight .settingTabs .alert-danger").text("错误，请重试！");
						$("#InfoPlatform_mainRight .settingTabs .alert-danger").show(200);
					}
				});
			}
			return false;
		});
		// 个人资料
		$("#InfoPlatform_mainRight .settingTabs .tab-content #setting_profile form").submit(function() {
			$this = $(this);
			var url = $(this).attr('action');
			$.post(url, $(this).serialize(), function(data) {
				if(data == 1){
					$("#InfoPlatform_mainRight .settingTabs .alert-success").show(200);
					$("#InfoPlatform_mainRight .settingTabs .alert-danger").hide();
				}else{
					$("#InfoPlatform_mainRight .settingTabs .alert-success").hide(200);
					$("#InfoPlatform_mainRight .settingTabs .alert-danger").text("错误，请重试！");
					$("#InfoPlatform_mainRight .settingTabs .alert-danger").show(200);
				}
			});
			return false;
		});


	// 图片上传插件的配置
		Dropzone.options.myAwesomeDropzone = {
			// paramName: "file", // The name that will be used to transfer the file
			maxFilesize: 5, // MB
			uploadMultiple: false,
			maxFiles: 1,
			addRemoveLinks: true,
			acceptedFiles: ".jpg,.gif,.png,.jpeg",
			dictCancelUpload: '取消上传',
			dictRemoveFile: '删除文件',
			dictDefaultMessage: "拖曳文件到这里上传",
			dictFallbackMessage: "你的浏览器不支持拖曳上传",
			dictFallbackText: "Please use the fallback form below to upload your files like in the olden days.",
			dictFileTooBig: "文件过大 ({{filesize}}MiB). 最大限制: {{maxFilesize}}MiB.",
			dictInvalidFileType: "不可上传这种文件类型.",
			dictResponseError: "Server responded with {{statusCode}} code.",
			dictCancelUpload: "取消上传",
			dictCancelUploadConfirmation: "确定取消上传过程？",
			dictRemoveFile: "删除文件",
			dictMaxFilesExceeded: "不能上传更多文件.",

			init: function() {
					this.on("success", function(event, response){
						var json = eval("("+response+")");
						// // alert(response)
						var path = json.rootpath.split('.')[1] + json.savepath + json.savename;
						// alert(response)
						$("#InfoPlatform_mainLeft #welcomePanel .userBox .userImg img").attr('src', path);
						$("#InfoPlatform_header #userBox #userimg img").attr('src', path);
					});

					this.on("removedfile", function(event, response){
						var url = "/Home/Setup/upload_delete";
						// alert(url)
						var src = '.' + $("#InfoPlatform_mainLeft #welcomePanel .userBox .userImg img").attr('src');
						// alert(src)
						$.getJSON(url, {'src': src}, function(json) {
							if(json.unlink){
								$("#InfoPlatform_mainLeft #welcomePanel .userBox .userImg img").attr('src', json.img);
								$("#InfoPlatform_header #userBox #userimg img").attr('src', json.img);
							}else{
								alert(json.unlink);
							}
						});
					});
				}
		};
});