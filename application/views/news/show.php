    <div class="container" >
      <div class="row-fluid">
        
        <div class="span9">
		
		  
         
          <div class="row-fluid">
		  
		    <a id="up" class="btn btn-danger btn-small" href="<?php echo site_url('news/up/'.$news->id)?>"><i class="icon-thumbs-up"></i> <?php echo $news->ups?></a>
            <a href="<?php echo $news->news_url?>"><?php echo $news->news_title;?></a>
			<small>(<?php echo $this->m_help->get_url_host($news->news_url)?>)</small>
			<br/>
			<div class="gray">
			<?php echo $news->created_by;?>|<?php echo $this->m_help->nice_time($news->posted);?>提交
			<a href="<?php echo site_url('news/show/').'/'.$news->id?>">
			<?php $comment_num=$this->m_news->get_comments($news->id)->num_rows(); echo "讨论(".$comment_num.")";?></a>
			</div >
			<hr>
			<p>大家在说</p>
			<form action="<?php echo site_url('news/comment/'.$this->uri->segment(3))?>" method="post">
				<textarea type="text" placeholder="说点什么" name="comment" class="span12"></textarea>
					<?php if(!$this->dx_auth->is_logged_in()){?>
						请<a href="<?php echo site_url('open/weibo')?>">登录</a>
					<?php }?>
				<button type="submit" class="btn">发表</button>
				<div ><?php echo form_error('comment'); ?> </div>
			</form>
			<?php foreach($comments->result() as $comment) { ?>
			<?php $weibo_id=$comment->weibo_id; $user_info=$this->m_open->get_user_info($weibo_id)->row();?>
			<div class="row-fluid">
			<div class="span1">
			<img src="<?php echo $user_info->avatar_large?>" style="width:48px;">
			</div>
			<div class="span11">
			<small><?php echo $user_info->screen_name .'&nbsp;&nbsp;' . $comment->posted?></small>
			<p><?php echo $comment->comment ?> </p>
			</div>
			</div>
			<hr>
			<?php }?>
			
		  </div><!--/row-->
         
        </div><!--/span-->
		<div class="span3">
				<form action="<?php echo site_url('news/create')?>" method="post">
					<fieldset>
					<legend>快速提交链接</legend>
					<label>标题</label>
					<input type="text" name="news_title" placeholder="它的名字">
					<label>链接</label>
					<input type="text" placeholder="url">
					<?php if(!$this->dx_auth->is_logged_in()){?>
						请<a href="<?php echo site_url('open/weibo')?>">登录</a>
					<?php }?>
					<button type="submit" name="news_url" class="btn btn-primary">立即提交</button>
					
					</fieldset>
				</form>
        </div><!--/span-->
	 </div><!--/row-->


	 