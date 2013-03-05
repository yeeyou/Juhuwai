    <div class="container" >
      <div class="row-fluid">
        
        <div class="span9">
		
		  
          <?php foreach($comments->result() as $comment) {?>
          <div class="row-fluid">
		  <?php $news=$this->m_news->find_news($comment->id)?>
		  <?php $weibo_id=$comment->weibo_id; $user_info=$this->m_open->get_user_info($weibo_id)->row();?>
        <div class="gray" >
		  <?php echo $user_info->screen_name .'&nbsp;&nbsp;' . $this->m_help->nice_time($comment->posted);?> 评论了 
			<a class="gray" href="<?php echo site_url('news/show/'.$news->id)?>"><?php echo $news->news_title;?>
			<?php $comment_num=$this->m_news->get_comments($news->id)->num_rows(); echo "讨论(".$comment_num.")";?></a>
		</div>	
		<p><?php echo $comment->comment?></p>
		
		  </div><!--/row-->
         <?php }?>
        </div><!--/span-->
		<div class="span3">
			   
		  
		  
		  
        </div><!--/span-->
	 </div><!--/row-->


	 