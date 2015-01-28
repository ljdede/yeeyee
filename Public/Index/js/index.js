$(function(){
	// all
		// 信息流初始值
		var begin = 0;
		var offset = 6;
		var pointer = offset;
		var step = 4;
		var superPid = -1;
		var superCid = -1;

		var delayScrollLoad = 0;

		$(window).scroll(function(){
			y1 = $(window).scrollTop();
			h2 = $(window).height();
			h1 = $("#InfoPlatform_mainRight").height();

			// if (delayScrollLoad == 0) {
			if (h1 - (y1 + h2) < 100) {
				readInfo(superPid, superCid, pointer, step);
				pointer = pointer + step;
			}
				// delayScrollLoad = 1;
			// } else if (delayScrollLoad == 1) {
				// alert(9)
				// delayRun(function() {
				// 	// alert($("#InfoPlatform_mainRight")[0].scrollHeight - 10)
					
				// 	delayScrollLoad = 0;
				// }, 100)
			// }

		});
		
		// 获取并设置栏目与分类
		setCategory();

	// #InfoPlatform_mainLeft
		// #InfoPlatform_mainLeft all
			// 绑定左部居中动作
			changeHeight_infoPanel();
			autoYCenter($("#InfoPlatform_mainLeft"));

			$(window).bind("resize",function(){
				changeHeight_infoPanel();			// 联系面板调整
				autoYCenter($("#InfoPlatform_mainLeft"));
			});

		// #InfoPlatform_mainLeft #panel
			$(document).on("click", ("#InfoPlatform_mainLeft #panel .header ul li a"), function(){
				$("#InfoPlatform_mainLeft #panel .header ul li a").removeClass('active');
				$(this).addClass('active');

				var id = $(this).attr('id');

				if(id == -1){
					$.each($("#InfoPlatform_mainLeft #panel .body ul li a"), function(index, val) {
							$(this).parent().show();
					});
				}else{
					$.each($("#InfoPlatform_mainLeft #panel .body ul li a"), function(index, val) {
						if( $(this).attr("pid") == id ){
							$(this).parent().show();
						}else{
							$(this).parent().hide();
						}
					});

				}
				$("#InfoPlatform_mainLeft #panel .body ul li a").removeClass('active');
				$("#InfoPlatform_mainLeft #panel input[name='info_get_pid']").val(id);
				$("#InfoPlatform_mainLeft #panel input[name='info_get_cid']").val(-1);
				// 删除旧数据
				if($("#InfoPlatform_mainRight .entry").length > 1){
					$("#InfoPlatform_mainRight .entry:last").siblings('.entry').remove();
				}
				superPid = id;
				pointer = offset;
				readInfo(id, -1, begin, offset);
				
			});
			$(document).on("click", ("#InfoPlatform_mainLeft #panel .body ul li a"), function(){
				$("#InfoPlatform_mainLeft #panel .body ul li a").removeClass('active');
				$(this).addClass('active');
				// alert($(this).attr('cid'));
				$("#InfoPlatform_mainLeft #panel input[name='info_get_cid']").val($(this).attr('cid'));

				// 删除旧数据
				if($("#InfoPlatform_mainRight .entry").length > 1){
					$("#InfoPlatform_mainRight .entry:last").siblings('.entry').remove();
				}
				superPid = $(this).attr('pid');
				superCid = $(this).attr('cid');
				pointer = offset;
				readInfo($(this).attr('pid'), $(this).attr('cid'), begin, offset);

				
			});

		// #InfoPlatform_mainLeft #contactPanel
			// 联系面板展开信息
			$("#InfoPlatform_mainLeft #contactPanel .profileBox .input-group .alert-info").click(function() {
				if( $(this).parent().siblings().is(":hidden") ) {
					$(this).parent().nextAll().show('200');
				} else {
					$(this).parent().nextAll().hide('200');
				}
			});

			// 联系面板发送联系信息
			$(document).on("click", ("#InfoPlatform_mainLeft #contactPanel .controllerBox button[type='submit']"), function() {
				// 数据数字检查
				var pass = 1;

				var $mobileNumber = $("#InfoPlatform_mainLeft #contactPanel .profileBox input[name='mobileNumber']");
				var mobileNumber_val = '';
				if( $mobileNumber.next().children().is(':checked') == true ) {
					if(isNaN($mobileNumber.val())){
						$mobileNumber.addClass('alertShadow');
						pass = 0;
					} else {
						$mobileNumber.removeClass('alertShadow');
						mobileNumber_val = $mobileNumber.val();
					}
				}
				var $realname = $("#InfoPlatform_mainLeft #contactPanel .profileBox input[name='realname']");
				var realname_val = '';
				if( $realname.next().children().is(':checked') == true ) {
					realname_val = $realname.val();
				}
				var $mobileNumber_short = $("#InfoPlatform_mainLeft #contactPanel .profileBox input[name='mobileNumber_short']");
				var mobileNumber_short_val = '';
				if( $mobileNumber_short.next().children().is(':checked') == true ) {
					if(isNaN($mobileNumber_short.val())){
						$mobileNumber_short.addClass('alertShadow');
						pass = 0;
					} else {
						$mobileNumber_short.removeClass('alertShadow');
						mobileNumber_short_val = $mobileNumber_short.val();
					}
				}
				var $qq = $("#InfoPlatform_mainLeft #contactPanel .profileBox input[name='qq']");
				var qq_val = '';
				if( $qq.next().children().is(':checked') == true ) {
					if(isNaN($qq.val())){
						$qq.addClass('alertShadow');
						pass = 0;
					} else {
						$qq.removeClass('alertShadow');
						qq_val = $qq.val();
					}
				}
				var $weixin = $("#InfoPlatform_mainLeft #contactPanel .profileBox input[name='weixin']");
				var weixin_val = '';
				if( $weixin.next().children().is(':checked') == true ) {
					weixin_val = $weixin.val();
				}
				var $weibo = $("#InfoPlatform_mainLeft #contactPanel .profileBox input[name='weibo']");
				var weibo_val = '';
				if( $weibo.next().children().is(':checked') == true ) {
					weibo_val = $weibo.val();
				}
				var $notes = $("#InfoPlatform_mainLeft #contactPanel .profileBox input[name='notes']");
				var notes_val = '';
				if( $notes.next().children().is(':checked') == true ) {
					notes_val = $notes.val();
				}
				if (pass == 0) {
					alert("信息有误，请检查。");
				} else if (pass == 1) {
					$.get('/Home/Index/sendEmail/', {
						'email': $("#InfoPlatform_mainLeft #contactPanel .profileBox input[name='email']").val(),
						'mobileNumber': mobileNumber_val,
						'realname': realname_val,
						'mobileNumber_short': mobileNumber_short_val,
						'qq': qq_val,
						'weixin': weixin_val,
						'weibo': weibo_val,
						'notes': notes_val,

						'title': $("#InfoPlatform_mainLeft #contactPanel .infoBox ul li:eq(0) > span:eq(1)").text(), 
						'time_created': $("#InfoPlatform_mainLeft #contactPanel .infoBox ul li:eq(1) > span:eq(1)").text(),
						'category': $("#InfoPlatform_mainLeft #contactPanel .infoBox ul li:eq(2) > span:eq(1)").text(),

						'email_orignal': $("#InfoPlatform_mainLeft #contactPanel input[name='email_orignal']").val()
						// 'description_compressed': $("#InfoPlatform_mainLeft #contactPanel .contentBox .text").text()
					}, function(data) {
						if (data) {
							alert("邮件发送成功，对方会尽快回复你的！");
						} else {
							alert("邮件发送不成功，等等吧，等等吧…");
						}
					});
				}
			})
			
			// 隐藏联系面板
			$("#InfoPlatform_mainLeft #contactPanel .controllerBox button[type='button']").click(function() {
				$("#InfoPlatform_mainLeft #panel").show();
				$("#InfoPlatform_mainLeft #contactPanel").hide();
				autoYCenter($("#InfoPlatform_mainLeft"));
			});

			// 联系面板打开私信窗口
			$(document).on("click", ("#InfoPlatform_mainLeft #contactPanel .userBox .userMessage"), function() {

				var targetUserInfo = {};
				targetUserInfo["username"] = $("#InfoPlatform_mainLeft #contactPanel .userBox .userName").text();
				targetUserInfo["uid"] = $("#InfoPlatform_mainLeft #contactPanel input[name='uid']").val();
				
				
				// 不重复出现脚标
				var i = 1;
				$.each($("#InfoPlatform_smsRemind ul li"), function() {
					if ($(this).find("input[name='uid']").val() == targetUserInfo["uid"]) {
						i = 0;
						$(this).trigger("click");
					}
				})
				if (i == 1) {
					// 增加私信脚标
					addSmsIcon(targetUserInfo["username"], targetUserInfo["uid"]);
				}
			})
			

	// #InfoPlatform_mainRight
		// 编辑器点击展开动作
		$("#InfoPlatform_mainRight .creator #titleBox_title").click(function() {
			$("#InfoPlatform_mainRight .creator .textBox").show(200);
			$("#InfoPlatform_mainRight .creator .optionBox").show(200);
			$("#InfoPlatform_mainRight .creator .titleBox #titleBox_title").animate({
				'width': '68%'},
				100);
			$("#InfoPlatform_mainRight .creator .titleBox #titleBox_price").show(100);
		});
		// 编辑器点击收起动作
		$("#InfoPlatform_mainRight .creator .controllerBox button[type='button']").click(function() {
			$("#InfoPlatform_mainRight .creator .titleBox #titleBox_title").animate({
				'width': '100%'},
				100);
			$("#InfoPlatform_mainRight .creator .titleBox #titleBox_price").hide(100);

			$("#InfoPlatform_mainRight .creator .textBox").hide(200);
			$("#InfoPlatform_mainRight .creator .optionBox").hide(200);
		});
		// 栏目分类动作
		// 使用on事件流处理原理绑定新元素动作
		$(document).on("click", ("#InfoPlatform_mainRight .creator .optionBox .categoryBox .body .category_1 .dropdown-menu li a"), function(){
			var glyphiconStatus = new Array();
			// glyphiconStatus[0] = "glyphicon-folder-open";
			glyphiconStatus[1] = "glyphicon-ok";
			$(this).parent().parent().siblings("a").html( creat_rawhtml(glyphiconStatus[1], $(this).text()) );
			// 填写表单
			var pid = $(this).attr("id");
			$(this).parent().parent().siblings("input[type='hidden']").val(pid);

			// 切换category_2的选项
				// 标记第一位
				var first = 1;
			$.each($("#InfoPlatform_mainRight .creator .optionBox .categoryBox .body .category_2 .dropdown-menu li a"), function(index, val) {
				 $(this).parent().hide();
				 // alert(pid)
				 if($(this).attr('pid') == pid){
				 	$(this).parent().show();
				 	if(first == 1){
				 		$(this).trigger('click');
				 		first = 0;
				 	}
				 }
			});

		});
		$(document).on("click", ("#InfoPlatform_mainRight .creator .optionBox .categoryBox .body .category_2 .dropdown-menu li a"), function(){
			var glyphiconStatus = new Array();
			// glyphiconStatus[0] = "glyphicon-align-left";
			glyphiconStatus[1] = "glyphicon-ok";
			$(this).parent().parent().siblings("a").html( creat_rawhtml(glyphiconStatus[1], $(this).text()) );
			// 填写表单
			$(this).parent().parent().siblings("input[type='hidden']").val($(this).attr("cid"));
		});
		
		// 编辑器的textarea自适应变动大小插件
		$("#InfoPlatform_mainRight .creator .textBox #textBox_text").autoTextarea({
			onResize:function(){
				$(this).css({opacity:0.8});
			},
			animateCallback:function(){
				$(this).css({opacity:1});
			},
			animateDuration:200,
			// More extra space:
			extraSpace:10
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
						// alert(response)
						var path = json.rootpath.split('.')[1] + json.savepath + json.savename;

						$("#InfoPlatform_mainRight .creator .optionBox .pictureBox table img").attr('src', path);
						$("#InfoPlatform_mainRight .creator .optionBox .pictureBox table input[type='hidden']").val(path);
						$("#InfoPlatform_mainRight .creator .optionBox .pictureBox > a").hide();

						updatePictureBox();

						$("#InfoPlatform_mainRight .creator .optionBox .pictureBox table").show();
						setTimeout(function(){
							$('#pictureBox_uploadBox').modal('hide');
						}, 1000);
					});

					// 被触发删除动作，主删除动作不是这个，是X
					var _this = this;
					$("#InfoPlatform_mainRight .creator .optionBox .pictureBox  table a").click(function() {
						_this.removeAllFiles();
					});

				}
		};
		// 删除上传的图片
		$("#InfoPlatform_mainRight .creator .optionBox .pictureBox  table a").click(function() {
			// alert(9)
			if($("#InfoPlatform_mainRight .creator .optionBox .pictureBox table input[type='hidden']").val() != ''){
				var url = "/Home/Index/upload_delete";
				// alert(url)
				var src = '.' + $("#InfoPlatform_mainRight .creator .optionBox .pictureBox table input[type='hidden']").val();
				// alert(src)
				$.post(url, {'src': src}, function(data) {
					// alert(data)
					if(data == 1){
						$("#InfoPlatform_mainRight .creator .optionBox .pictureBox table input[type='hidden']").val('');
						$("#InfoPlatform_mainRight .creator .optionBox .pictureBox form .dz-remove").trigger("click");
						$("#InfoPlatform_mainRight .creator .optionBox .pictureBox > a").show();
						$("#InfoPlatform_mainRight .creator .optionBox .pictureBox table").hide();
					}
				});
			} else {
				$("#InfoPlatform_mainRight .creator .optionBox .pictureBox table input[type='hidden']").val('');
				$("#InfoPlatform_mainRight .creator .optionBox .pictureBox form .dz-remove").trigger("click");
				$("#InfoPlatform_mainRight .creator .optionBox .pictureBox > a").show();
				$("#InfoPlatform_mainRight .creator .optionBox .pictureBox table").hide();
			}
		});


		// setInterval(function() {
		// 	// $("#InfoPlatform_mainRight .creator").find("form").submit();
		// }, 2000);
		// setTimeout(function() {
			// alert("开始了！");
			// for (counter = 0; counter < 6000; counter++) {
			// 	$("#InfoPlatform_mainRight .creator").find("form").submit();
			// }
		// }, 10000);
		

		// 编辑器发布
		$("#InfoPlatform_mainRight .creator").find("form").submit(function(){
			var pass = 1;
			$tempThis = $(this);
			$title = $tempThis.find("input[name='title']");
			$price = $tempThis.find("input[name='price']");
			$description = $tempThis.find("textarea[name='description']");
			$pid = $tempThis.find("input[name='pid']");
			$cid = $tempThis.find("input[name='cid']");

			// alert($pid.val());
			// return false;

			// 字段检测
			if($title.val() == ""){
				$title.addClass('alertShadow');
				pass = 0;
			} else {
				$title.removeClass('alertShadow');
			}
			if(isNaN($price.val())){
				$price.addClass('alertShadow');
				pass = 0;
			} else {
				$price.removeClass('alertShadow');
			}
			if($description.val() == ""){
				$description.addClass('alertShadow');
				pass = 0;
			} else {
				$description.removeClass('alertShadow');
			}
			if($pid.val() == -1){
				$pid.siblings('a').addClass('alertColor');
				pass = 0;
			} else {
				$pid.siblings('a').removeClass('alertColor');
			}
			if($cid.val() == -1){
				$cid.siblings('a').addClass('alertColor');
				pass = 0;
			} else {
				$cid.siblings('a').removeClass('alertColor');
			}

			// 最后准行
			if(pass == 1){
				var url = $(this).attr('action');
				$.post(url, $(this).serialize(), function(data) {
					// alert(data)
					if(data == -1) {
						$("#InfoPlatform_header #userBox #login a").trigger("click");
					} else if (data == -3) {
						alert("你还没激活账户，请根据你的注册邮件进行激活。");
					} else if (data == 0) {
						alert("发布信息不完整，请完善。");
					} else if (data == -2) {
						alert("系统失败，请重试。");
					} else {
						$("#InfoPlatform_mainRight .creator .optionBox .pictureBox table input[type='hidden']").val('');
						// alert("发布成功~");
						setCategory();
						$("#InfoPlatform_mainRight .creator .optionBox .pictureBox  table a").trigger('click');

						
						// 收起发布
						$("#InfoPlatform_mainRight .creator .controllerBox button[type='button']").trigger("click");

						$tempThis.find("input[name='title']").val("");
						$tempThis.find("input[name='price']").val("");
						$tempThis.find("textarea[name='description']").val("");
						$tempThis.find("input[name='url']").val("");

						// 刷新信息
						// 删除旧数据
						if($("#InfoPlatform_mainRight .entry").length > 1){
							$("#InfoPlatform_mainRight .entry:last").siblings('.entry').remove();
						}
						readInfo(superPid, superCid, begin, offset);
					}
				});
			}

			return false;
		});


		var info_get_pid = $("#InfoPlatform_mainLeft #panel input[name='info_get_pid']").val();
		var info_get_cid = $("#InfoPlatform_mainLeft #panel input[name='info_get_cid']").val();



		// 获取info entry******************************************************
		// 删除旧数据
		if($("#InfoPlatform_mainRight .entry").length > 1){
			$("#InfoPlatform_mainRight .entry:last").siblings('.entry').remove();
		}
		readInfo(-1, -1, begin, offset);

		// 定义提示新信息
		$(document).on('click', ("#InfoPlatform_mainRight .entry_mark"), function() {
			// 删除旧数据
			if($("#InfoPlatform_mainRight .entry").length > 1){
				$("#InfoPlatform_mainRight .entry:last").siblings('.entry').remove();
			}
			pointer = offset;
			readInfo(superPid, superCid, begin, step);

			$(this).hide();
		})

		// 信息条目的信息图片放大缩小
		$(document).on("click", "#InfoPlatform_mainRight .entry table .entry_main .pictureBox", function(){
			// alert($(this).attr('height'));
			// alert($(this).children('input').val());
			if($(this).width() <= 400){
				// 要放大了
				var this_width_height = new Array();
				this_width_height[0] = $(this).width();
				this_width_height[1] = $(this).height();

				$(this).children('input').val(this_width_height[0] + '.' + this_width_height[1]);
				// 把pictureBox放大
				$(this).css({
					width: this_width_height[0] * 2.54,
					height: this_width_height[1] * 2.54
				});
				// 若图片未填满，则填满，然后调整pictureBox的高度
				// alert($(this).width())
				// alert($(this).find('img').width())
				if( $(this).find('img').width() < $(this).width() ){
					$(this).find('img').css({
						height: 'auto',
						width: '100%'
					});
					$(this).height($(this).find('img').height());
				} else {
					$(this).height($(this).find('img').height());
				}

				// 调整infoBox的宽度
				$(this).siblings('.infoBox').css('width', '100%');
			}else{
				// 要缩小了
				var this_width_height = new Array();
				this_width_height = $(this).children('input').val().split('.');
				// 把pictureBox缩小
				$(this).css({
					width: this_width_height[0],
					height: this_width_height[1]
				});

				var ra_box = this_width_height[0] / this_width_height[1];
				var ra_img = $(this).find('img').width() / $(this).find('img').height();
				if( ra_img < ra_box){
					$(this).find('img').css({
						height: '100%',
						width: 'auto'
					});
				} else {
					$(this).find('img').css({
						height: 'auto',
						width: '100%'
					});
				}

				$(this).siblings('.infoBox').css('width', '60%');
			}
		});

		// 联系ta按钮动作
		$(document).on("click", "#InfoPlatform_mainRight .entry table .entry_contact button", function(){
			$tempThis = $(this);
			if ($tempThis.find("input[name='mine']").val() == 1) {
				// $tempThis.css("cursor", "default");
				return false;
			}
			$.get('/Home/Login/getSession_uid', {}, function(data_uid) {
				if (data_uid == '') {
					$("#InfoPlatform_header #userBox #login a").trigger("click");
				} else {
					var _id = $tempThis.parents('.entry').children('input[name="_id"]').val();
					var pid = $tempThis.parents('.entry').find('input[name="info_get_pid"]').val();
					$.getJSON('/Home/Index/info_one', {"_id": _id, "pid": pid}, function(json) {
						if (json.uid == data_uid) {
							// 本人
							sms_status = 0;
						} else {
							// 非本人
							sms_status = 1;
							// 收起panel，展开contactPanel，并居中
							$("#InfoPlatform_mainLeft #panel").hide();
							$("#InfoPlatform_mainLeft #contactPanel").show();
							autoYCenter($("#InfoPlatform_mainLeft"));
						}
						setContactPanel_info(
							json._id, 
							json.avatar, 
							json.email, 
							json.uid, 
							json.username, 
							sms_status, 
							json.title, 
							json.time_created, 
							json.category_1, 
							json.category_2, 
							json.description_compressed
						);

						changeHeight_infoPanel();
						// 获取联系面板的用户数据
						getContactPanel_user();

						$("#InfoPlatform_mainLeft #contactPanel .contentBox .more").unbind("click")
						$("#InfoPlatform_mainLeft #contactPanel .contentBox .more").click(function() {

							$.each($("#InfoPlatform_mainRight .entry"), function() {
								if ($(this).find('input[name="_id"]').val() == $("#InfoPlatform_mainLeft #contactPanel input[name='_id']").val()) {
									$(this).find(".moreBox").trigger("click");
								}
							})
							
						})
					});
				}
			})
			
		});
	

	// InfoPlatform_sms
		// 关闭私信窗口
		$(document).on("click", ("#InfoPlatform_sms .header .close"), function() {
			$("#InfoPlatform_sms").hide();
			$.each($("#InfoPlatform_smsRemind ul li"), function() {
				$(this).removeClass("clicked");
			});
		})
		// 定义输入私信框的字数限制
		$(document).on("keyup", ("#InfoPlatform_sms .input textarea"), function() {
			var strlen = 0;
			var limitNum = 140;
			var text = $.trim($("#InfoPlatform_sms .input textarea").val());
			// alert(text)
			for (var i = 0; i < text.length; i++) {
				if (isChinese(text.charAt(i)) == true) {
					// 中文，加2
					strlen += 2;
				} else {
					// 英文，统计加1
					strlen += 1;
				}
			}
			// 除以2取整数
			strlen = Math.ceil(strlen / 2);
			// 字数变化
			var currentNum = limitNum - strlen;
			if (currentNum >= 0) {
				$("#InfoPlatform_sms .controller .tips_2").hide();
				$("#InfoPlatform_sms .controller .tips_1").show();				
				$("#InfoPlatform_sms .controller .tips_1 b").text(currentNum);
			} else {
				$("#InfoPlatform_sms .controller .tips_1").hide();
				$("#InfoPlatform_sms .controller .tips_2").show();
				$("#InfoPlatform_sms .controller .tips_2 b").text(0 - currentNum);
			}

		});
		// 快捷键发送
		$(document).on("keydown", ("#InfoPlatform_sms .input textarea"), function(e) {
			 if(e.keyCode==13&&e.ctrlKey){
				e.preventDefault();
				$("#InfoPlatform_sms .controller .submit button").trigger("click");
			}
		});
		// 按发送键发送
		$(document).on("click", ("#InfoPlatform_sms .controller .submit button"), function() {
			var uid = $("#InfoPlatform_sms .header input[name='uid']").val();
			var content = $("#InfoPlatform_sms .input textarea").val();
			// alert(content)
			if ($.trim(content) == "") {
				alert("不能发送空内容");
			} else {
				$.getJSON('Home/Sms/sendSms', {
					'uid': uid,
					'content': content
				}, function(json) {
					// alert(json)
					if (json == -3) {
						alert("你还没激活账户，请根据你的注册邮件进行激活。");
					} else if (json != false) {
						$("#InfoPlatform_sms .input textarea").val('');
						$("#InfoPlatform_sms .input textarea").trigger("keyup");
						loadSms(uid);
						// alert("发送成功！");
					} else {
						alert(json);
					}
				})
			}
			
		})
		// 点击私信脚标打开私信窗口
		$(document).on("click", ("#InfoPlatform_smsRemind ul li"), function() {
			var targetUserInfo = {};
			targetUserInfo["username"] = $(this).find(".username").text();
			targetUserInfo["uid"] = $(this).find("input").val();

			$.each($("#InfoPlatform_smsRemind ul li"), function() {
				$(this).removeClass("clicked");
			});
			$(this).addClass("clicked");

			// 打开私信窗口
			loadSms(targetUserInfo["uid"]);
			showSms(targetUserInfo["username"], targetUserInfo["uid"]);
			
			// 把私信标记为已读
			$.get('Home/Sms/readSms', {'uid': targetUserInfo["uid"]}, function(data) {

			});
		})



		// 定时脚本
		setInterval(function() {
			// 私信提醒
			$.getJSON('Home/Sms/checkSms_tryRead', {}, function(json) {
				$.each(json, function(i, v_i) {
					if ($("#InfoPlatform_smsRemind ul li").length > 0) {
						$.each($("#InfoPlatform_smsRemind ul li"), function() {
							if ($(this).find("input[name='uid']").val() != v_i.uid) {
							$("#InfoPlatform_smsRemind ul").append( create_sms_icon(v_i.username, v_i.uid) );
							}
						});
					} else {
						$("#InfoPlatform_smsRemind ul").append( create_sms_icon(v_i.username, v_i.uid) );
					}
				});
			});
			// 采取一次取信，分员派送的方式
			if ($("#InfoPlatform_smsRemind ul li").length > 0) {
				var users = '';
				$.each($("#InfoPlatform_smsRemind ul li"), function() {
					users = users + '-' + $(this).find("input[name='uid']").val();
				});
				$.get('Home/Sms/checkSms_array', {
					'users': users,
				}, function(data) {
					// alert(data)
					var usersArray = new Array();
					usersArray = data.split('-');
					$.each(usersArray, function(i, v_i) {
						if (v_i == 0) {
							$("#InfoPlatform_smsRemind ul li:eq(" + i + ") .badge").text('');
						} else {
							$("#InfoPlatform_smsRemind ul li:eq(" + i + ") .badge").text(v_i);
						}
					})
				});
			}
			// 定时显示新私信
			if ($("#InfoPlatform_sms").is(':hidden')) {
				// alert(23);
			} else {
				var currentuid = $("#InfoPlatform_sms .header input[name='uid']").val();
				$.each($("#InfoPlatform_smsRemind ul li"), function() {
					if($(this).find("input[name='uid']").val() == currentuid) {
						$(this).trigger('click');
					}
				});
			}
			// 定时检测新信息
			if ($("#InfoPlatform_mainRight .entry").length > 1) {
				$.get('Home/Index/info_checkNew', {
					'pid': superPid, 
					'cid': superCid, 
					'time_created_raw': $("#InfoPlatform_mainRight .entry:first input[name='time_created_raw']").val()
				}, function(data) {
					if (data > 0) {
						$("#InfoPlatform_mainRight .entry_mark b").text(data);
						$("#InfoPlatform_mainRight .entry_mark").show();
					} else {
						$("#InfoPlatform_mainRight .entry_mark").hide();
					}
				})
			}
		}, 2000)

		
	

// 函数定义
	// 生成rawhtml
	function creat_rawhtml(status, text){
		var rawhtml = '<span class="glyphicon ' + status + '"></span> ' + text;
		return rawhtml;
	}

	// 调整联系面板高度
	function changeHeight_infoPanel(){
		var winHeight = $(window).height();
		var headerHeight = $("#InfoPlatform_header").height();
		var footerHeight = $("#InfoPlatform_footer").height();

		var objectHeight = winHeight - headerHeight - footerHeight - 40;
		$("#InfoPlatform_mainLeft #contactPanel").height(objectHeight);

		var profileBoxHeight = objectHeight - 23 - 
		  $("#InfoPlatform_mainLeft #contactPanel .userBox").height() 
		- $("#InfoPlatform_mainLeft #contactPanel .infoBox").height() 
		- $("#InfoPlatform_mainLeft #contactPanel .contentBox").height() 
		- $("#InfoPlatform_mainLeft #contactPanel .tipsBox").height() 
		- $("#InfoPlatform_mainLeft #contactPanel .controllerBox").height();
		// alert(profileBoxHeight);

		$("#InfoPlatform_mainLeft #contactPanel .profileBox").height(profileBoxHeight);
	}

	// 上传图片的动作更新
	function updatePictureBox(){
		var $target = $("#InfoPlatform_mainRight .creator .optionBox .pictureBox table img");
		var $inbox = $("#InfoPlatform_mainRight .creator .optionBox .pictureBox");
		$target.load(function(){
			var imgWidth = $target.width();
			var imgHeight = $target.height();
			var boxWidth = $inbox.width();
			var boxHeight = $inbox.height();
			// alert(imgHeight)
			if(imgWidth < 140){
				$target.height(73);
			} else {
				var ra = 140 / imgWidth;
				$target.height(imgHeight * ra);
			}
		})
	}

	// 获取并设置栏目分类
	function setCategory(){
		$.getJSON('/Home/Index/category_get/', "", function(json) {
			var display = '';
			var last_v_i_id = '';

			// 清空本来的栏目和分类信息
			$("#InfoPlatform_mainLeft .header ul li:eq(0)").siblings().remove();
			$("#InfoPlatform_mainLeft .body ul").empty();
			$("#InfoPlatform_mainRight .creator .optionBox .detailBox .categoryBox .body .category_1 .dropdown .dropdown-menu ").empty();
			$("#InfoPlatform_mainRight .creator .optionBox .detailBox .categoryBox .body .category_2 .dropdown .dropdown-menu").empty();
			// 生成分类
			$.each(json, function(i, v_i){
				// alert(v_i._id)
				$("#InfoPlatform_mainLeft .header ul").append(
					'<li>' + 
						'<a href="javascript:void(0)" id="' + v_i._id +'">' + v_i.name + '</a>' + 
					'</li>'
				);
				$("#InfoPlatform_mainRight .creator .optionBox .detailBox .categoryBox .body .category_1 .dropdown .dropdown-menu ").append(
					'<li>' + 
						'<a href="javascript:void(0)" id="' + v_i._id +'">' + v_i.name + '</a>' + 
					'</li>'
				);
				$.each(v_i, function(j, v_j){
					// alert(v_j)
					if(j == "children"){
						$.each(v_j, function(k, v_k){
							// $.each(v_k, function(l, v_l){
								if(last_v_i_id != '' && last_v_i_id != v_i._id){
									// display = 'style="display:none;"'
									display = '';
								}
								last_v_i_id = v_i._id;
								$("#InfoPlatform_mainLeft .body ul").append(
									'<li ' + display + '>' + 
										'<a href="javascript:void(0)" pid="' + v_i._id + '" cid="' + v_k._id + '">' + v_k.subname + ' （<span>' + v_k.total + '</span>）</a>' + 
									'</li>'
								);
								$("#InfoPlatform_mainRight .creator .optionBox .detailBox .categoryBox .body .category_2 .dropdown .dropdown-menu").append(
									'<li ' + display + '>' + 
										'<a href="javascript:void(0)" pid="' + v_i._id + '" cid="' + v_k._id + '">' + v_k.subname + '</a>' + 
									'</li>'
								);
								
							// });
						});
					}
				});
			});
		});
 		
	}

	// 获取info entry
	function readInfo(pid, cid, begin, offset){
		// if($("#InfoPlatform_mainRight .entry").length > 1){
		// 	$("#InfoPlatform_mainRight .entry:last").siblings('.entry').remove();
		// }
		$.getJSON('/Home/Index/info/', {'pid': pid, 'cid': cid, 'begin': begin, 'offset': offset}, function(json) {
				$.each(json, function(i, v_i){
					// alert(v_i.title)
					var infoHtml = create_infoHtml(
						v_i.username, 
						v_i.avatar, 
						v_i.title, 
						v_i.price, 
						v_i.description_compressed, 
						v_i.description_raw, 
						v_i.img, 
						v_i.time_created, 
						v_i.time_created_raw, 
						v_i.category_1, 
						v_i.category_2, 
						v_i.url, 
						v_i.url_raw, 
						v_i._id, 
						v_i.uid,
						v_i.currentuid,
						v_i.price, 
						v_i.pid
					);

					$tempFisrt = $("#InfoPlatform_mainRight .entry:last");
					$tempEntry = $tempFisrt;
					// alert($tempFisrt.html())
					// 第一个（基准）entry的时间戳
					time_created_raw_first = $tempFisrt.find('input[name="time_created_raw"]').val();
					time_created_raw_temp = time_created_raw_first;

					// 信息流时间排序
					// alert(9)
					$tempFisrt.before(infoHtml);
					$tempNew = $tempFisrt.prev();
					
					// 图片的显示控制
					var $current = $tempNew.find(".pictureBox");
					
					if($current.length > 0){
						// alert(v_i.img)
						$current.find("img").load(function(){
							// alert($(this).height());

							if ( $(this).height() > $current.height() ){
								// alert(9)
								$(this).css({
									width: 'auto',
									height: '100%'
								});
							}
						});
					}

					// 判断是否需要出现“阅读全文”按钮
					contentHeight_now = $tempNew.find(".contentBox").height();
					// 这个是在css文件里确定的contentBox的max-height，暂为110px
					contentHeight_set = 110;
					contentHeight_max = 10000;
					var tempText = "";
					if (contentHeight_now >= contentHeight_set) {
						// 显示more
						$thisMoreBox = $tempNew.find(".moreBox");
						$thisMoreBox.show();
						// 配置more的动作
						$thisMoreBox.click(function() {
							$thisContentBox = $(this).siblings(".contentBox");
							// 判断详细描述的打开状态
							if ($(this).children("input").val() == 0) {
								// 状态取反
								$(this).children("input").val(1);

								$thisContentBox.css("max-height", contentHeight_max + "px");
								// 暂存变换的信息
								tempText = $thisContentBox.children(".text").html();
								$thisContentBox.children(".text").html($thisContentBox.children("input").val());
								$thisContentBox.children("input").val(tempText);

								// 变换more按钮字样
								$(this).find(".label").text("收起文字");

								// 滚动界面
								$("html, body").animate({scrollTop:$thisContentBox.children(".text").offset().top - 87}, 200);

							} else {
								// 状态取反
								$(this).children("input").val(0);

								$thisContentBox.css("max-height", contentHeight_set + "px");
								// 暂存变换的信息
								tempText = $thisContentBox.children(".text").html();
								$thisContentBox.children(".text").html($thisContentBox.children("input").val());
								$thisContentBox.children("input").val(tempText);

								// 变换more按钮字样
								$(this).find(".label").text("阅读全文");

								// 滚动界面
								$("html, body").animate({scrollTop:$thisContentBox.children(".text").offset().top - 80}, 200);
							}
						})
					}


					
				});
		// alert(json)
		});
	}
	function create_infoHtml(username, avatar, title, price, description_compressed, description_raw, img, time, time_created_raw, category_1, category_2, url, url_raw, _id, uid, currentuid, price, pid){
		// 前端字段处理
		var pictureBox = "";
		var infoBoxWidth = "";
		var urlBox = "";
		var contactMark = "";

		if(img != ""){
			pictureBox = '<div class="pictureBox">' + 
								'<img style="width:100%;" src="' + img + '" alt="" />' + 
								'<input type="hidden" value="" />' + 
							'</div>';
		} else {
			infoBoxWidth = 'style="width:100%"';
		}
		if(url != ""){
			urlBox = '<li><span class="title">相关链接 <span class="glyphicon glyphicon-globe"></span></span><span><a href="' + url_raw + ' " target="_blank">' + url + '</a></span></li>';
		}
		if (price != 0) {
			priceMark = '<span class="glyphicon glyphicon-shopping-cart"></span>  <b>' + price + '</b> 元';
		} else {
			priceMark = '<span class="glyphicon glyphicon-thumbs-up"></span>  <b style="color: #FDEF8E;">免费</b> ';
		}

		if ( currentuid == uid ) {
			contactMark = '<button type="button" class="btn btn-success"> ' +
				priceMark + 
				' <br/>我的信息' +
				'<input type="hidden" name="mine" value="1" />' +
				'</button>';
		} else {
			contactMark = '<button type="button" class="btn btn-info"> ' +
				priceMark + 
				' <br/>联系TA' +
				'<input type="hidden" name="mine" value="0" />' +
				'</button>';
		}
		

		return 	'<div class="infoStream entry" >' + 
						'<input type="hidden" name="_id" value="' + _id + '" />' +
						'<input type="hidden" name="time_created_raw" value="' + time_created_raw + '" />' +
						'<input type="hidden" name="uid" value="' + uid + '" />' +
							'<table>' + 
								'<tr>' + 
									'<td colspan="2" class="entry_top"><!-- entry_top --></td>' + 
								'</tr>' + 
								'<tr>' + 
									'<td class="entry_user">' + 
										'<img src="' + avatar + '" alt="" />' + 
									'</td>' + 
									'<td rowspan="2" class="entry_main">' + 
										'<div class="contentBox">' + 
											'<span class="username">' + username + '</span>' + 
											'<span class="text">' + description_compressed + '</span>' + 
											'<input type="hidden" name="description_temp" value="' + description_raw + '" />' +
										'</div>' + 
										'<div class="moreBox">'+
											'<input type="hidden" name="moreMark" value="0" />' +
											'<a href="javascript:void()">... <span class="label label-default">阅读全文</span></a>' +
										'</div>' + 
										'<div class="lineBox"></div>' + 
											pictureBox +
										'<div class="infoBox" ' + infoBoxWidth + '>' + 
											'<ul>' + 
												'<li class="infoTitle"><span class="title">信息名称 <span class="glyphicon glyphicon-align-left"></span></span><span>' + title + '</span></li>' + 
												'<li><span class="title">发布时间 <span class="glyphicon glyphicon-time"></span></span><span>' + time + '</span></li>' + 
												'<li><input type="hidden" name="info_get_pid" value="' + pid + '" /><span class="title">栏目分类 <span class="glyphicon glyphicon-folder-open"></span></span><span>' + category_1 + '-' + category_2 + '</span></li>' + 
												urlBox + 
											'</ul>' + 
										'</div>' + 
									'</td>' + 
								'</tr>' + 
								'<tr>' + 
									'<td class="entry_contact">' + 
										contactMark +
									'</td>' + 
								'</tr>' + 
								'<tr>' + 
									'<td colspan="2" class="entry_bottom"><!-- entry_bottom --></td>' + 
								'</tr>' + 
							'</table>' + 
						'</div>';
	}

	// 设置联系面板的信息数据
	function setContactPanel_info(_id, avatar, email, uid, username, sms_status, title, time_created, category_1, category_2, description_compressed){
		$("#InfoPlatform_mainLeft #contactPanel input[name='_id']").val(_id);
		$("#InfoPlatform_mainLeft #contactPanel input[name='email_orignal']").val(email);
		$("#InfoPlatform_mainLeft #contactPanel input[name='uid']").val(uid);
		$("#InfoPlatform_mainLeft #contactPanel .userBox .userImg img").attr('src', avatar);
		$("#InfoPlatform_mainLeft #contactPanel .userBox .userName").text(username);

		if (sms_status == 1) {
			$("#InfoPlatform_mainLeft #contactPanel .userBox .userMessage").show();
		} else if (sms_status == 0){
			$("#InfoPlatform_mainLeft #contactPanel .userBox .userMessage").hide();
		}
		$("#InfoPlatform_mainLeft #contactPanel .infoBox ul li:eq(0) > span:eq(1)").text(title);
		$("#InfoPlatform_mainLeft #contactPanel .infoBox ul li:eq(1) > span:eq(1)").text(time_created);
		$("#InfoPlatform_mainLeft #contactPanel .infoBox ul li:eq(2) > span:eq(1)").text(category_1 + '-' + category_2);

		$("#InfoPlatform_mainLeft #contactPanel .contentBox .text").text(description_compressed);
	}
	// 获取联系面板的用户数据
	function getContactPanel_user(){
		$.getJSON('/Home/Index/info_one_user', "", function(json) {
			setContactPanel_user(json.email, json.mobileNumber, json.realname, json.mobileNumber_short, json.qq, json.weixin, json.weibo, json.notes);
		});
	} 
	// 设置联系面板的用户数据
	function setContactPanel_user(email, mobileNumber, realname, mobileNumber_short, qq, weixin, weibo, notes){
		$("#InfoPlatform_mainLeft #contactPanel .profileBox input[name='email']").val(email);
		$("#InfoPlatform_mainLeft #contactPanel .profileBox input[name='mobileNumber']").val(mobileNumber);

		$("#InfoPlatform_mainLeft #contactPanel .profileBox input[name='realname']").val(realname);
		$("#InfoPlatform_mainLeft #contactPanel .profileBox input[name='mobileNumber_short']").val(mobileNumber_short);
		$("#InfoPlatform_mainLeft #contactPanel .profileBox input[name='qq']").val(qq);
		$("#InfoPlatform_mainLeft #contactPanel .profileBox input[name='weixin']").val(weixin);
		$("#InfoPlatform_mainLeft #contactPanel .profileBox input[name='weibo']").val(weibo);
		$("#InfoPlatform_mainLeft #contactPanel .profileBox input[name='notes']").val(notes);
	}

	// 联系面板打开sms
		// 显示sms窗口
		function showSms(username, uid) {
			$("#InfoPlatform_sms").show();
			$("#InfoPlatform_sms .header .title b").text(username);
			$("#InfoPlatform_sms .header input[name='uid']").val(uid);
			
		}
		// 生成私信脚标
		function addSmsIcon(username, uid) {
			$("#InfoPlatform_smsRemind ul").append( create_sms_icon(username, uid) );
			$.each($("#InfoPlatform_smsRemind ul li"), function() {
				if ($(this).find("input[name='uid']").val() == $("#InfoPlatform_mainLeft #contactPanel input[name='uid']").val()) {
					$(this).trigger("click")
				}
			});
		}

		// 加载私信
		function loadSms(uid) {
			var olduid = $("#InfoPlatform_sms .header input[name='uid']").val();
			if (uid != olduid) {
				$("#InfoPlatform_sms .content").empty();
				$("#InfoPlatform_sms .header input[name='lastSmsTime']").val(0);
			}
			
			// alert($("#InfoPlatform_sms .header input[name='lastSmsTime']").val())
			$.getJSON('Home/Sms/getSms', {
				'uid': uid,
				'lastSmsTime': $("#InfoPlatform_sms .header input[name='lastSmsTime']").val()
			}, function(json) {
				if (json != '') {
					$.each(json, function(i, v_i) {
						var smsid_unique = 1;
						if ($("#InfoPlatform_sms .content .sms_one").length > 0) {
							$.each($("#InfoPlatform_sms .content .sms_one"), function() {
								if ($(this).find("input[name='smsid']").val() ==  v_i._id) {
									smsid_unique = 0;
								}
							});
						}
						if (smsid_unique == 1) {
							$("#InfoPlatform_sms .content").append(create_sms_one(v_i.toOrFrom_type, v_i._id, v_i.avatar, v_i.send_time, v_i.content));
							$("#InfoPlatform_sms .header input[name='lastSmsTime']").val(v_i.send_time_raw);
						}					
					})
					
					$("#InfoPlatform_sms .content").stop().animate({scrollTop: $("#InfoPlatform_sms .content")[0].scrollHeight }, 200);
				}
			})
		}

	// 私信判断是否为中文
	function isChinese(str) {
		var reCh = /[u00-uff]/;
		return !reCh.test(str);
	}
	// 生成私信条目
	function create_sms_one(toOrFrom_type, smsid, img, send_time, content) {
		if (toOrFrom_type == 0) {
			toOrFrom = " from";
		} else if (toOrFrom_type == 1) {
			toOrFrom = " to";
		}
		return '<div class="sms_one ' + toOrFrom + '">' +
			'<input type="hidden" name="smsid" value="' + smsid + '" />' +
			'<div class="content_user_img">' +
				'<img src="' + img + '" alt="">' +
			'</div>' +
			'<div class="content_body">' +				
				'<div class="time">' + send_time + '</div>' +
				'<div class="text">' +
					content +
				'</div>' +
			'</div>' +
		'</div>';
	}
	// 生成私信脚标
	function create_sms_icon(username, uid) {
		return '<li><input type="hidden" name="uid" value="' + uid + '" /><span class="glyphicon glyphicon-envelope"></span> <span class="username">' + username + '</span> <span class="badge"></span></li>';
	}

	//延时运行函数
	function delayRun(code,time) {
		var t = setTimeout(code,time);
	}
});