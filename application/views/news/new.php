
    <div class="container" >
      <div class="row-fluid">
        
        <div class="span9">
         
          <h3>提交链接</h3>
<form class="form-horizontal" action="<?php echo site_url('news/create')?>" method="post">
  <div class="control-group">
    <label class="control-label" for="inputEmail">标题</label>
    <div class="controls">
      <input type="text" class="span9" id="" name="news_title" placeholder="标题">
	  <div ><?php echo form_error('news_title'); ?> </div>
    </div>
  
  </div>
  
    <div class="control-group">
    <label class="control-label" for="inputEmail">url</label>
    <div class="controls">
      <input type="text" class="span9" id="" name="news_url" placeholder="url">
	  <div ><?php echo form_error('news_url'); ?> </div>
    </div>
  
  </div>

  
  
  <div class="control-group">
    <div class="controls">
      
      <button type="submit" class="btn">提交</button>
    </div>
  </div>
</form>
        </div><!--/span-->
		<div class="span3">
          <p>hiahia</p>
        </div><!--/span-->
	 </div><!--/row-->

