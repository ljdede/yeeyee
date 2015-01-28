$(function(){
	// #InfoPlatform_mainLeft
		// 绑定左部居中动作
		autoYCenter($("#InfoPlatform_mainLeft"));
		autoYCenter($("#InfoPlatform_mainRight"));

		$(window).bind("resize",function(){
			// changeHeight_infoPanel();			// 联系面板调整
			autoYCenter($("#InfoPlatform_mainLeft"));
		});
})