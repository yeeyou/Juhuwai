    <div class="container" >
      <div class="row-fluid">
        
        <div class="span9">
		
		  
          <?php foreach($newses->result() as $news) {?>
          <div class="row-fluid">
		  
		    <a id="up" class="btn btn-danger btn-small" href="<?php echo site_url('news/up/'.$news->id)?>"><i class="icon-thumbs-up"></i> <?php echo $news->ups?></a>
            <a href="<?php echo $news->news_url?>"><?php echo $news->news_title;?></a>
			<small>(<?php echo $this->m_help->get_url_host($news->news_url)?>)</small><br/>
			<div class="gray">
				<?php echo $news->created_by;?>|<?php echo $this->m_help->nice_time($news->posted);?>提交
				<a href="<?php echo site_url('news/show/').'/'.$news->id?>">
				<?php $comment_num=$this->m_news->get_comments($news->id)->num_rows(); echo "讨论(".$comment_num.")";?></a>
			</div>
		  </div><!--/row-->
		  <br>
         <?php }?>
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


	 