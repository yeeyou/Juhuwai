    <div class="container" >
      <div class="row-fluid">
        
        <div class="span9">
		
		  
         
          <div class="row-fluid">
		  
		    <a id="up" class="btn btn-danger btn-small" href="<?php echo site_url('news/up/'.$news->id)?>"><i class="icon-thumbs-up"></i> <?php echo $news->ups?></a>
            <a href="<?php echo $news->news_url?>"><?php echo $news->news_title;?></a><br/>
			
			<?php echo $news->created_by;?>|提交于<?php echo $news->posted?>
    
		  </div><!--/row-->
         
        </div><!--/span-->
		<div class="span3">
          
		  
		  
		  <a href="<?php echo site_url('news/submit')?>" class="btn btn-primary ">提交链接</a>
        </div><!--/span-->
	 </div><!--/row-->


	 