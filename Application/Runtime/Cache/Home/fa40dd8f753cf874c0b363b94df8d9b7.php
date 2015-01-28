<?php if (!defined('THINK_PATH')) exit();?><!-- Top Navbar-->

<div class="navbar">
	<div class="navbar-inner">
		<!-- <div class="left">
			<a href="#index" class="link">
				<i class="icon-chevron-left"></i>
				
			</a>
		</div> -->
		<div class="center sliding">发布信息</div>
		<!-- <div class="right">
			<a href="#" class="link">
				<span>确定 </span>
				<i class="icon-ok"></i>
			</a>
		</div> -->
	</div>
</div>
<div class="pages">
	<div data-page="creator" class="page page_creator">
		<div class="page-content">
			<div class="content-block-title">基本信息</div>
			<div class="list-block inset">
				<ul>
					<li>
						<div class="item-content">
							<div class="item-inner">
								<div class="item-title label">标题</div>
								<div class="item-input">
									<input class="textInput" type="text" name="title" placeholder="输入信息名称">
								</div>
							</div>
						</div>
					</li>
					<li>
						<div class="item-content">
							<div class="item-inner">
								<div class="item-title label">价格</div>
								<div class="item-input">
									<input class="textInput" type="text" name="price" placeholder="输入价格，免费则留空">
								</div>
							</div>
						</div>
					</li>
					<!-- Select -->
					<li>
						<a href="#" class="item-link smart-select" data-back-onselect="true" data-back-text=" ">
							<select name="pid_cid" class="pid_cid">

								<?php if(is_array($category)): $i = 0; $__LIST__ = $category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$catgy): $mod = ($i % 2 );++$i;?><optgroup label="<?php echo ($catgy["name"]); ?>" pid="<?php echo ($catgy["_id"]); ?>">
										<?php if(is_array($catgy['children'])): $i = 0; $__LIST__ = $catgy['children'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$catgy_chdr): $mod = ($i % 2 );++$i;?><option value="<?php echo ($catgy["_id"]); ?>_<?php echo ($catgy_chdr["_id"]); ?>"><?php echo ($catgy_chdr["subname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
									</optgroup><?php endforeach; endif; else: echo "" ;endif; ?>


							</select>
							<div class="item-content">
								<div class="item-inner">
									<div class="item-title">栏目分类</div>
									<div class="item-after"></div>
								</div>
							</div>
						</a>
					</li>
					<li>
						<div class="item-content">
							<div class="item-inner">
								<div class="item-title label">链接</div>
								<div class="item-input">
									<input class="textInput" type="url" name="url" placeholder="输入相关的网址">
								</div>
							</div>
						</div>
					</li>
				</ul>
			</div>
			<div class="content-block-title">正文说明</div>
			<div class="list-block inset">
				<ul>
					<li>
						<div class="item-content">
							<div class="item-inner">
								<div class="item-input">
									<textarea name="description" placeholder="输入正文说明"></textarea>
								</div>
							</div>
						</div>
					</li>
				</ul>
			</div>
			<div class="content-block-title">上传照片</div>
			<div class="list-block inset">
				<ul>
					<li>
						<div class="item-content uploadFile">
							<div class="item-inner">
								<div class="item-input">
									<form action="/Home/Index/upload" method="post" enctype="multipart/form-data">
										<input type="file" name="file" accept="image/*">
									</form>
									<input type="hidden" name="img" value="">
								</div>
							</div>
						</div>
					</li>
				</ul>
			</div>
			<div class="list-block inset">
				<ul>
					<li>
						<a href="#" class="button button-round button-big creatorSubmit">发布</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>