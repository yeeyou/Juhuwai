    <div class="container" >
      <div class="row-fluid">
        
        <div class="span9">
          
          <div class="row-fluid">
		  
		  
            <h3><?php echo $line->line_title;?><small><?php echo $line->line_start;?>-<?php echo $line->line_end?></small></h3>
			<div class="row-fluid">
			<div class="span6">
			<p>所在区域：<?php $area=$line->area;if($area!=100){echo $this->m_line->get_area($area);}else echo "X(跨区域)" ?>
			<p>线路类型：<?php $type=$line->type;echo $this->m_line->typename($type)?>
			<p>全程：<?php echo $line->line_length;?>公里 </p>
			<p>历时：<?php echo $line->line_days;?>天左右</p>
			<!-- 这里是喜欢按钮-->
			<?php if (!$this->m_like->if_liked_line($line->line_id)) { ?>
			<a id="like_line" class="btn btn-danger" href="<?php echo site_url('like/like_line/'.$line->line_id)?>"><i class="icon-heart icon-white"></i> 赞</a>
			<?php } else {?>
		    <a id="unlike_line" class="btn btn-default" href="<?php echo site_url('like/unlike_line/'.$line->line_id)?>"><i class="icon-heart "></i> 已赞</a>
			<?php } ?>
			<?php echo $this->m_like->like_line_num($line->line_id)?>人
			
			<?php if ($this->dx_auth->is_logged_in()){ if($this->m_line->is_owner($this->uri->segment(3),$this->m_open->gowi()->weibo_id)){?>
			<a href="<?php echo site_url('line/edit/'.$this->uri->segment(3));?>">编辑</a>
			<?php } }?>
			</div>
			<div class="span6">
			
			<a href="<?php echo site_url('line/album/').'/'.$line->line_id ?>">
			
			<img style="height:150px;" src='<?php echo $this->m_line->line_pic($line->line_id)?>' class="img-polaroid ">
			
			</a>
			</div>
			</div>
			
			<hr>
			<h5>介绍</h5>
			<p><?php echo $this->m_help->nltobr($line->line_des);?></p>
            <h5>途经地点</h5>
			<p><?php echo $line->line_places;?></p>
			<h5>出行准备</h5>
			<p><?php echo $line->line_prepare;?></p>
		  </div><!--/row-->
			
			<!--以下是短评-->
			<h5>大家在说</h5>
				<form action="<?php echo site_url('line/add_comment/'.$this->uri->segment(3))?>" method="post">
				<textarea type="text" placeholder="说点什么" name="content" class="span12"></textarea>
				<button type="submit" class="btn">发表</button>
				</form>
			<?php $comments=$this->m_line->get_first_ten_comment($this->uri->segment(3));
			foreach($comments->result() as $comment) { if($comment->show){?>
			<?php $weibo_id=$comment->weibo_id; $user_info=$this->m_open->get_user_info($weibo_id)->row();?>
			<div class="row-fluid">
			<div class="span1">
			<img src="<?php echo $user_info->avatar_large?>" style="width:48px;">
			</div>
			<div class="span11">
			<small><?php echo $user_info->screen_name .'&nbsp;&nbsp;' . $comment->up_time?></small>
			<p><?php echo $comment->content ?> </p>
			
			<?php if ($this->m_line->is_cmt_owner($comment->id)){?>
			<a href="<?php echo site_url('line/delete_comment/'.$comment->id.'/'.$this->uri->segment(3))?>">删除</a>
			<?php }?>
			</div>
			</div>
			<hr>
			<?php }}?>
			

		
        </div><!--/span-->
		
		
		
		<div class="span3">
		<a href="<?php echo site_url('upload/open').'/'.$this->uri->segment(3)?>">上传图片</a>
		<br><br>
		<a href="<?php echo site_url('line/album').'/'.$this->uri->segment(3)?>">查看相册</a>
        </div><!--/span-->
		
	 </div><!--/row-->

