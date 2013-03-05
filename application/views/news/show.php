    <div class="container" >
      <div class="row-fluid">
        
        <div class="span9">
		
		  
         
          <div class="row-fluid">
		  
		    <a id="up" class="btn btn-danger btn-small" href="<?php echo site_url('news/up/'.$news->id)?>"><i class="icon-thumbs-up"></i> <?php echo $news->ups?></a>
            <a href="<?php echo $news->news_url?>"><?php echo $news->news_title;?></a>
			<small>(<?php echo $this->m_help->get_url_host($news->news_url)?>)</small>
			<br/>
			
			<?php echo $news->created_by;?>|提交于<?php echo $news->posted?>
			<hr>
			<p>大家在说</p>
			<form action="<?php echo site_url('news/comment/'.$this->uri->segment(3))?>" method="post">
				<textarea type="text" placeholder="说点什么" name="comment" class="span12"></textarea>
				<button type="submit" class="btn">发表</button>
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
          
		  
		  
		  <a href="<?php echo site_url('news/submit')?>" class="btn btn-primary ">提交链接</a>
        </div><!--/span-->
	 </div><!--/row-->


	 