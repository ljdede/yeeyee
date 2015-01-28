// $(function() {
	$$(document).on('click', ('.pages .page_creator .creatorSubmit'), function() {


		// 建立form对象
		var $$tempObject = $$('.pages .page_creator .uploadFile form');
		
		// 检查是否有图片文件
		if ($$tempObject.find('input[name="file"]').val() != '') {

			// 若有，先检查图片
			var file = $$tempObject.find('input[name="file"]')[0].files[0];
			size = file.size;

			// 图片大小过大
			if (size >= 5500000) {
				alert("图片超大，小一点可以么？");
				return false;
			}

			// 正常的话，继续发布
			var uploadUrl = $$tempObject.attr('action');
			myApp.showPreloader('发布中 请稍等哦');
			var formData = new FormData($$tempObject[0]);
			$$.ajax({
				url: uploadUrl,  //server script to process data
				type: 'POST',
				xhr: function() {  
					
				},
				//Ajax事件
				// beforeSend: beforeSendHandler,
				success: function(data) {
					var json = eval("("+data+")");
					// alert(response)
					var path = json.rootpath.split('.')[1] + json.savepath + json.savename;

					$$('.pages .page_creator .uploadFile input[name="img"]').val(path);

					// 发布的函数
					creatorUpload();
					
				},
				error: function(data) {
					alert(data);
				},
				// Form数据
				data: formData,
				//Options to tell JQuery not to process data or worry about content-type
				cache: false,
				contentType: false,
				processData: false
			});
		} else {
			creatorUpload();
		}
		
	})




// 自定义函数
	function creatorUpload() {
	
		var pass = 1;
		var pid_cid = $$('.pages .page_creator .pid_cid').val();
		var tempArray = pid_cid.split('_');
		var pid = tempArray[0];
		var cid = tempArray[1];

		// 建立form对象
		var $$tempObject = $$('.pages .page_creator');

		$$title = $$tempObject.find("input[name='title']");
		$$price = $$tempObject.find("input[name='price']");
		$$description = $$tempObject.find("textarea[name='description']");
		$$url = $$tempObject.find("input[name='url']");
		$$img = $$tempObject.find("input[name='img']");

		// 字段检测
		if($$title.val() == ""){
			pass = 0;
			myApp.alert("标题忘了写哦", 'I\'m sorry');
		} else {
		}
		if(isNaN($$price.val())){
			pass = 0;
			myApp.alert("价格不是数字哦", 'I\'m sorry');
		} else {
		}
		if($$description.val() == ""){
			pass = 0;
			myApp.alert("描述呢描述呢", 'I\'m sorry');
		} else {
		}

		if(pass == 1) {
			// myApp.showPreloader('发布中 请稍等哦');
			$$.post('/Home/Index/creator', {
				'title': $$title.val(),
				'price': $$price.val(),
				'description': $$description.val(),
				'pid': pid,
				'cid': cid,
				'url': $$url.val(),
				'img': $$img.val()
			}, function(data) {
				myApp.hidePreloader();

				if(data == -1) {
					// 如未登录，弹出框先登录
					myApp.loginScreen();

				} else if (data == -3) {
					myApp.alert("你还没激活账户，请根据你的注册邮件进行激活。", 'I\'m sorry');
				} else if (data == 0) {
					myApp.alert("发布信息不完整，请完善。", 'I\'m sorry');
				} else if (data == -2) {
					myApp.alert("系统失败，请重试。", 'I\'m sorry');
				} else {
					myApp.alert('请静候佳音~', '发布成功!');
				}

			})
		} else {
			pass = 1;
		}
	}
// })