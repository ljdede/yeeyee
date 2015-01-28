(function($){
	$.fn.autoTextarea=function(option){
		var opt=$.extend(true,{
					onResize:function(){},//事件触发函数
					animate:true,
					animateDuration:150,
					animateCallback:function(){},//动画完成后的回调函数
					extraSpace:20,
					Maxlimit:1000,
					namespace:"f2er"//命名空间
				},option);
		this.filter('textarea').each(function(){
			var textarea=$(this).css({resize:"none",'overflow-y':"hidden"}),
				origHeight=textarea.height(),//原始高度
				clone=(function(){//复制一份textarea
					var props = ['height','width','lineHeight','textDecoration','letterSpacing'],
						propOb={};
					$.each(props,function(i,prop){
						propOb[prop]=textarea.css(prop);
					});
					return textarea.clone().removeAttr('id').removeAttr('name').css({
						position:'absolute',
						top:0,
						left:-9999
					}).css(propOb).attr('tabIndex',-1).insertBefore(textarea);//返回textarea
				})(),
			lastScrollTop=null,//计算最后滚动高度
			updateResize=function(){
				clone.height(0).val($(this).val()).scrollTop(10000);//隐藏的textarea滚动条位置设置为10000,如果超过这个值,就不会自适应
				//console.log(clone.scrollTop())
				//查找文字的高度
				var scrollTop=Math.max(clone.scrollTop(),origHeight)+opt.extraSpace,
					toChange=$(this).add(clone);//jquery元素组合,这样做有什么意义
				if(lastScrollTop===scrollTop){ return;}//在高度范围内,不做任何改变
				lastScrollTop=scrollTop;
				if(scrollTop>opt.Maxlimit){//超出限制最高限制就出现滚动条
					$(this).css({"overflow-y":""});
					return ;
				}
				opt.onResize.call(this);
				opt.animate && textarea.css('display')==="block"?
					toChange.stop().animate({height:scrollTop}, opt.animateDuration, opt.animateCallback)
                        : toChange.height(scrollTop);
			};
			textarea.unbind('.'+opt.namespace)//通过命名空间解除绑定
					.bind('keyup.'+opt.namespace,updateResize)
					.bind('keydown.'+opt.namespace,updateResize)
					.bind('change.'+opt.namespace,updateResize)
		});
		return this;
	}
})(jQuery)