    <div class="container" >
      <div class="row-fluid">
        
        <div class="span9">
		<div class="hero-unit">
            <h2>你好，旅行者</h2>
            <p>一条线路不是简单的连接起点和终点，而是探索未知领域的线索</p>
            
          </div>
		  
          <?php foreach($lines->result() as $line) {?>
          <div class="row-fluid">
		  
		  
            <a href="<?php echo site_url('line/show/'.$line->line_id)?>"><h3><?php echo $line->line_title;?><small><?php echo $line->line_start;?>-<?php echo $line->line_end?></small></h3></a>
			<p><?php echo $this->m_line->typename($line->type)?> | <?php echo $this->m_line->get_area($line->area)?> | 全程<?php echo $line->line_length;?>公里 | 需<?php echo $line->line_days;?>天左右</p>
			<p><?php echo mb_substr($line->line_des,0,90,'utf-8')."...";?></p>
          
		  </div><!--/row-->
         <?php }?>
        </div><!--/span-->
		<div class="span3">
          
		  
		  
		  <a href="<?php echo site_url('line/new_line')?>" class="btn btn-primary ">添加线路 </a>
        </div><!--/span-->
	 </div><!--/row-->

