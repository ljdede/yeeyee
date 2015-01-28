// Initialize your app
	var myApp = new Framework7({
		swipePanel: 'left',
		swipeBackPage: false,
		// cache: false,
	});

// Export selectors engine
	var $$ = Dom7;

// 信息流初始值
	var begin = 0;
	var offset = 6;
	var pointer = offset;
	var step = 4;
	var superPid = -1;
	var superCid = -1;

         

// Add view
	var mainView = myApp.addView('.view-main', {
		// Because we use fixed-through navbar we can enable dynamic navbar
		dynamicNavbar: true,
		domCache: true
	});



// 一切的开始
	// 加载信息流内容
	readInfo(-1, -1, begin, offset, function() {}, function() {}, function() {});
	// 加载栏目与分类
	setCategory();

	// 无线滚动加载flag
	var loading = false;
	// 注册'infinite'事件处理函数
	$$('.infinite-scroll').on('infinite', function () {
		$$('.infinite-scroll-preloader').show();
		// 如果正在加载，则退出
		if ( loading ) return;
		// 设置flag
		loading = true;
		// 加载
		readInfo(superPid, superCid, pointer, step, function() {
			loading = false;
			// alert(pointer)
			pointer = pointer + step;
		}, function() {
			myApp.detachInfiniteScroll($$('.infinite-scroll'));
			$$('.infinite-scroll-preloader').hide();
		}, function() {});
	}); 

	// 注册下拉刷新事件
	var ptrContent = $$('.pull-to-refresh-content');
	// 添加'refresh'监听器
	ptrContent.on('refresh', function (e) {
		$$('.views .pages .page_index .page-content .list-block ul li').remove();
		// 加载信息流内容
		pointer = offset;
		readInfo(superPid, superCid, begin, offset, function() {}, function() {}, function() {
			// 加载完毕需要重置
			myApp.pullToRefreshDone();
		});
		myApp.attachInfiniteScroll($$('.infinite-scroll'));

	});


	// 进入详细页面
	$$(document).on('click', ('.views .pages .page_index .page-content .list-block .info_entry .item-inner .entry_content .item-subtitle'), function() {
		// Load detail page:
		_id = $$(this).parents(".info_entry").attr('data_id');
		pid = $$(this).parents(".info_entry").attr('data_pid');

		myApp.showIndicator();

		$$.get('/Home/Login/getSession_uid', {}, function(data_uid) {
			if (data_uid == '') {
				// 如未登录，弹出框先登录
				myApp.hideIndicator();
				myApp.loginScreen();

			} else {
				$$.getJSON('/Home/Index/info_one', {"_id": _id, "pid": pid}, function(json) {
					setContactPanel_info(
						json._id, 
						json.avatar, 
						json.email,
						json.uid,
						json.username, 
						json.title, 
						json.time_created, 
						json.category_1,
						json.category_2,
						json.description_raw,
						json.img,
						json.price,
						json.url,
						json.url_raw
					);
					myApp.hideIndicator();
					mainView.router.load({pageName: 'detail'});
				});
			}
		});
		
	});
	$$(document).on('click', ('.views .pages .page-content .list-block .info_entry .item-inner .entry_content .item-contact'), function() {
		// Load detail page:
		_id = $$(this).parents(".info_entry").attr('data_id');
		pid = $$(this).parents(".info_entry").attr('data_pid');

		myApp.showIndicator();
		
		$$.getJSON('/Home/Index/info_one', {"_id": _id, "pid": pid}, function(json) {
			setContactPanel_info(
				json._id, 
				json.avatar, 
				json.email,
				json.uid,
				json.username, 
				json.title, 
				json.time_created, 
				json.category_1,
				json.category_2,
				json.description_raw,
				json.img,
				json.price,
				json.url,
				json.url_raw
			);
			myApp.hideIndicator();
			mainView.router.load({pageName: 'detail'});
		});
	});

	// 定义信息条目图片点击放大
	$$(document).on('click', ('.views .pages .page-content .list-block .info_entry .item-inner .entry_content .item-media img'), function() {
		myApp.photoBrowser({
			photos : [
				$$(this).attr('src'),
			]
		}).open();
	});


	var temp_pid = '';  //用于识别"全部""
	// left page and right page
	$$(document).on('click', ('.panel-left .list-block .categoryGroup ul li'), function() {
		pid = $$(this).attr('pid');
		if (pid == -1) {
			superPid = -1;
			superCid = -1;
			pointer = offset;
			$$('.views .pages .page_index .page-content .list-block ul li').remove();
			// 加载信息流内容
			readInfo(-1, -1, begin, offset, function() {}, function() {}, function() {});

			myApp.attachInfiniteScroll($$('.infinite-scroll'));
			$$('.infinite-scroll-preloader').show();
			myApp.closePanel();
		} else {
			temp_pid = pid;
			for (var i = 0; i < $$('.panel-right .list-block .list-group ul li').length; i++ ) {
				if ( $$('.panel-right .list-block .list-group ul li').eq(i).attr('pid') == pid ) {
					$$('.panel-right .list-block .list-group ul li').eq(i).show();
				} else {
					$$('.panel-right .list-block .list-group ul li').eq(i).hide();
				}
			}
			// $$('.panel-right .list-block .list-group ul li').eq(0).attr()
			$$('.panel-right .list-block .list-group ul li').eq(0).show();

		}
		
	});
	// 点击小分类加载对应信息
	$$(document).on('click', ('.panel-right .list-block .list-group ul li'), function() {
		// alert(temp_pid)
		// alert($$(this).attr('cid') == -1)
		if ($$(this).attr('cid') == -1) {
			superPid = temp_pid;
		} else {
			superPid = $$(this).attr('pid');
		}
		superCid = $$(this).attr('cid');
		pointer = offset;

		$$('.views .pages .page_index .page-content .list-block ul li').remove();
		
		myApp.closePanel();

		// 加载信息流内容
		readInfo(superPid, superCid, begin, offset, function() {}, function() {}, function() {});
		
		myApp.attachInfiniteScroll($$('.infinite-scroll'));
		

	});


// 登录
	// 登录框弹出时关闭侧边栏
	$$(document).on('click', ('.panel-left .list-block .loginBox'), function() {
		myApp.closePanel();
		
	});
	// 检测登录状态
	getSession();
	// 登录框登录
	$$(document).on('click', ('.login-screen .view .page .login-screen-content form .loginButton'), function() {
		email = $$('.login-screen .view .page .login-screen-content form input[name="email"]').val();
		password = $$('.login-screen .view .page .login-screen-content form input[name="password"]').val();
		$$.post('/Home/Login/', {'email': email, 'password': password}, function(data) {
			if (data == 1) {
				// 改变登录状态
				getSession();
				myApp.closeModal('.login-screen');
				
			}
		})
	});
	
	// setup page***************************************************
	// setup page 退出登录
	$$(document).on('click', ('.page_setup .logout'), function() {
		$$.getJSON('/Home/Login/logout', {}, function(json) {
			if (json.username == null) {
				$$('.panel-left .list-block .loginBox .userinfo .userimg img').attr('src', '');
				$$('.panel-left .list-block .loginBox .userinfo .username').text('');
				$$('.panel-left .list-block .loginBox .item-title').show();
				$$('.panel-left .list-block .loginBox .userinfo').hide();

				$$('.panel-left .list-block .loginBox .loginBox_controll').addClass('open-login-screen');
				$$('.panel-left .list-block .loginBox .loginBox_controll').attr('href', '');
				myApp.alert('你已退出~', ' ');
			}
		})
	})

// toolbar
	$$(document).on('click', ('.views .toolbar a'), function() {
		$$('.views .toolbar a').removeClass('active');
		$$(this).addClass('active');
	})



	

// 自定义函数
	// 读取信息
	function readInfo(pid, cid, begin, offset, callbacks_before, callbacks_after, callbacks_pullrefresh){
		callbacks_before();
		$$.getJSON('/Home/Index/info/', {'pid': pid, 'cid': cid, 'begin': begin, 'offset': offset}, function(json) {

					if ( json == '' ) {
						callbacks_after();
					}

					for (var i = 0; i < json.length; i++ ) {
						// alert(json[i].username)

						var infoHtml = create_infoHtml(
							json[i]._id,
							json[i].pid,
							json[i].uid,
							json[i].username, 
							json[i].avatar, 
							json[i].title,
							json[i].description_compressed,
							json[i].price,
							json[i].img,
							json[i].time_created,
							json[i].currentuid
						);
						// alert(json[i].price)
						$$('.views .pages .page_index .page-content .list-block ul').append(infoHtml);

						callbacks_pullrefresh();
					}

		});
	}
	// 生成信息条目html
	function create_infoHtml(_id, pid, uid, username, avatar, title, description_compressed, price, img, time_created, currentuid) {
		if (img != "") {
			pictureBox = '<div class="item-media">' +
							'<img src="' + img + '">' +
						'</div>';
		} else {
			pictureBox = '';
		}

		if (price != 0) {
			priceMark = '<b> ' + price + ' </b>元';
		} else {
			priceMark = ' <b>免费</b>';
		}
		return '<li data_id="' + _id + '" data_uid="' + uid + '" data_pid="' + pid + '" class="item-content info_entry">' +
			'<div class="item-inner">' +
				'<div class="entry_header">' +
					'<div class="avatar">' +
						'<img data-avatarid="01" src="' + avatar + '">' +
					'</div>' +
					'<div class="detail">' +
						'<p class="username">' + username + '</p>' +
						'<p data-time="1404709434" class="time_created">' + time_created + '</p>' +
					'</div>' +
				'</div>' +
				'<div class="entry_content">' +
					'<div class="item-title">' +
						'<b>' + title + '</b>' +
					'</div>' +
					'<div class="item-subtitle"><i class="icon-caret-right"></i> ' + description_compressed +
					'</div>' +
					pictureBox +
					'<div class="item-contact">' +
						'<div class="price">' + priceMark + '</div>' +
						'<div class="contact">联系TA <i class="icon-angle-right"></i></div>' +
					'</div>' +
				'</div>' +
			'</div>' +
		'</li>';
	}

	// 加载栏目与分类
	function setCategory() {
		$$.getJSON('/Home/Index/category_get/', "", function(json) {
			var display_left = '';
			var display_right = '';
			var display_mark = 1;
			var display_mark_html = '';

			// 清空本来的栏目和分类信息
			$$(".panel-left .list-block .categoryGroup ul li").remove();
			$$(".panel-right .list-block .list-group ul li").remove();

			display_left = '<li pid="-1">' +
								'<a href="" class="">' +
									'<div class="item-content">' +
										'<div class="item-inner"><div class="item-title">全部</div></div>' +
									'</div>' +
								'</a>' +
							'</li>';
			display_right = '<li cid="-1">' +
								'<a href="" class="">' +
									'<div class="item-content">' +
										'<div class="item-inner"><div class="item-title">全部</div>' +
											// <span class="badge bg-yellow">115</span>
										'</div>' +
									'</div>' +
								'</a>' +
							'</li>';

			for (var i in json) {
				display_left = display_left +
							'<li pid="' + json[i]['_id'] + '">' +
								'<a href="" class="item-link open-panel" data-panel="right" >' +
									'<div class="item-content">' +
										'<div class="item-inner"><div class="item-title">' + json[i]['name'] + '</div></div>' +
									'</div>' +
								'</a>' +
							'</li>';
							
				for (var j in json[i]) {
					if (j == 'children') {
						for (var k in json[i][j]) {
							if (display_mark != 1) {
								display_mark_html = 'style="display:none;"';
							}
							display_right = display_right + '<li ' + display_mark_html + 'pid="' + json[i]['_id'] + '" cid="' + json[i][j][k]['_id'] + '">' +
								'<a href="" class="">' +
									'<div class="item-content">' +
										'<div class="item-inner"><div class="item-title">' + json[i][j][k]['subname'] + '</div><span class="badge bg-yellow">' + json[i][j][k]['total'] + '</span></div>' +
									'</div>' +
								'</a>' +
							'</li>';
						}
					}
				}
				display_mark = 0;
			}
			$$(".panel-left .list-block .categoryGroup ul").append(display_left);
			$$(".panel-right .list-block .list-group ul").append(display_right);
		});
	}

	// 设置联系面板的信息数据
	function setContactPanel_info(_id, avatar, email, uid, username, title, time_created, category_1, category_2, description_raw, img, price, url, url_raw){
		// alert($$('.views .pages .page_detail .page-content .block_main .item-content .item-inner .entry_header .detail .username').html())
		$$('.views .pages .page_detail .page-content .block_main .item-content .item-inner .entry_header .avatar img').attr('src', avatar);

		$$('.views .pages .page_detail .page-content .block_main .item-content .item-inner .entry_header .detail .username').text(username);

		$$('.views .pages .page_detail .page-content .block_main .item-content .item-inner .entry_header .detail .time_created').text(time_created);
		$$('.views .pages .page_detail .page-content .block_main .item-content .item-inner .entry_content .item-title b').text(title);

		$$('.views .pages .page_detail .page-content .block_main .item-content .item-inner .entry_content .item-subtitle div').html(description_raw);

		if (img != "") {
			$$('.views .pages .page_detail .page-content .block_main .item-content .item-inner .entry_content .item-media img').attr('src', img);
			$$('.views .pages .page_detail .page-content .block_main .item-content .item-inner .entry_content .item-media').show();
		} else {
			$$('.views .pages .page_detail .page-content .block_main .item-content .item-inner .entry_content .item-media img').attr('src', '');
			$$('.views .pages .page_detail .page-content .block_main .item-content .item-inner .entry_content .item-media').hide();
		}

		if (price != 0) {
			$$('.views .pages .page_detail .block_contact .price .text').html(price + ' 元');
		} else {
			$$('.views .pages .page_detail .block_contact .price .text').html('免费');
		}
		// block_contact
		$$('.views .pages .page_detail .page-content .block_contact .time .text').text(time_created);
		$$('.views .pages .page_detail .page-content .block_contact .category .text').text(category_1 + '-' + category_2);

		if (url != "") {
			$$('.views .pages .page_detail .page-content .block_contact .link .text a').text(url);
			$$('.views .pages .page_detail .page-content .block_contact .link .text a').attr('href', url_raw);
			// sepcial display
			$$('.views .pages .page_detail .page-content .block_contact .link').css('display', 'flex');

			// $$('.views .pages .page_detail .page-content .block_contact .link').show();
		} else {
			$$('.views .pages .page_detail .page-content .block_contact .link .text a').text('');
			$$('.views .pages .page_detail .page-content .block_contact .link').hide();
		}


		getContactPanel_user();
	}


	// 改变登录状态
	function getSession() {
		$$.getJSON("/Home/Login/getSession", "", function(json){
			if(json.username != null){
				$$('.panel-left .list-block .loginBox .userinfo .userimg img').attr('src', json.avatar);
				$$('.panel-left .list-block .loginBox .userinfo .username').text(json.username);
				$$('.panel-left .list-block .loginBox .item-title').hide();
				$$('.panel-left .list-block .loginBox .userinfo').show();

				$$('.panel-left .list-block .loginBox .loginBox_controll').removeClass('open-login-screen');
				$$('.panel-left .list-block .loginBox .loginBox_controll').attr('href', '/Home/setup/');
			}
		});
	}

	// 获取联系面板的用户数据
	function getContactPanel_user(){
		$$.getJSON('/Home/Index/info_one_user', "", function(json) {
			setContactPanel_user(json.email, json.mobileNumber, json.realname, json.mobileNumber_short, json.qq, json.weixin, json.weibo, json.notes);
		});
	}
	// 设置联系面板的用户数据
	function setContactPanel_user(email, mobileNumber, realname, mobileNumber_short, qq, weixin, weibo, notes){
		$$(".views .pages .page_detail .page-content .block_contact input[name='email']").val(email);
		$$(".views .pages .page_detail .page-content .block_contact input[name='mobileNumber']").val(mobileNumber);

		$$(".views .pages .page_detail .page-content .block_contact input[name='realname']").val(realname);
		$$(".views .pages .page_detail .page-content .block_contact input[name='mobileNumber_short']").val(mobileNumber_short);
		$$(".views .pages .page_detail .page-content .block_contact input[name='qq']").val(qq);
		$$(".views .pages .page_detail .page-content .block_contact input[name='weixin']").val(weixin);
		$$(".views .pages .page_detail .page-content .block_contact input[name='weibo']").val(weibo);
		$$(".views .pages .page_detail .page-content .block_contact input[name='notes']").val(notes);
	}