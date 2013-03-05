<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_news extends CI_Model {

	function M_news()
	{
		parent::__construct();

	}
	function add($data){
		$this->db->insert('news',$data);
	}
	
	function get_news($id){
		$this->db->where('id',$id);
		$query=$this->db->get('news');
		return $query->row();
	}
	function update($id,$data){
		$this->db->where('id',$id);
		$this->db->update('news',$data);
	}
	
	function delete($id){
		$this->db->where('id',$id);
		$this->db->delete('news');
	}
	
	function all(){
		$this->db->order_by('rank','desc');
		$query=$this->db->get('news');
		return $query;
	}
	function fresh(){
		$this->db->order_by('posted','desc');
		$query=$this->db->get('news');
		return $query;
	}
	
	function has_voted($id){
		$weibo_id=$this->m_open->gowi()->weibo_id;
		$this->db->where('news_id',$id);
		$this->db->where('weibo_id',$weibo_id);
		$query=$this->db->get('user_news');
		$num=$query->num_rows();
			
		if ($num != 1){return true;}
		if ($num == 0){return false;}
	}
	
	function up($id){
		$created_by=$this->m_open->gowi()->screen_name;
		$this->db->where('id',$id);
		$query=$this->db->get('news');
		$news=$query->row();
		$ups=$news->ups;
		$ups=$ups+1;
		$posted=$news->posted;
		$downvotes=0;
		$rank=$this->hotness($ups,$downvotes,$posted);
		$data=array('ups'=>$ups,
					'rank'=>$rank);
		$this->update($id,$data);
		$data1=array('weibo_id'=>$this->m_open->gowi()->weibo_id,
					'news_id'=>$id,
					'vote_at'=>date('Y-m-d H:i:s',time()));
		$this->vote_log($data1);
	}
	
	function vote_log($data){
		$this->db->insert('user_news',$data);
	}
	
	function comment($data){
		$this->db->insert('comment',$data);
	}
	function get_comments($news_id){
		$this->db->where('news_id',$news_id);
		$this->db->order_by('posted','desc');
		$query=$this->db->get('comment');
		return $query;
	}
	
	function comments(){
		$this->db->order_by('posted','desc');
		$query=$this->db->get('comment');
		return $query;
	}
	
	function find_news($comment_id){
		$this->db->where('id',$comment_id);
		$comment=$this->db->get('comment')->row();
		$news_id=$comment->news_id;
		$news=$this->get_news($news_id);
		return $news;
		
	}
	//github ranking reddit
	/**
     * calculates the score for a link (upvotes - downvotes)
     * 
     * @access  private
     * @since   0.1
     * @param   int $upvotes, int $downvotes
     * @return  int
     */
    private function _score($upvotes = 0, $downvotes = 0) {
        return $upvotes - $downvotes;
    }
    
    /**
     * calculates the hotness of an article
     * 
     * @access  private
     * @since   0.1
     * @param   int $upvotes, int $downvotes, int $posted
     * @return  float
     */
    private function _hotness($upvotes = 0, $downvotes = 0, $posted = 0) {
        $s = $this->_score($upvotes, $downvotes);
        $order = log(max(abs($s), 1), 3);//old 10
        
        if($s > 0) {
            $sign = 1;
        } elseif($s < 0) {
            $sign = -1;
        } else {
            $sign = 0;
        }
        
        $seconds = strtotime($posted) - 1362405600;//2013-03-04 22:00:00
        
        return round($order + (($sign * $seconds)/(12.5*60*60)), 7);
    }
    
	
	
    /**
     *  confidence sort based on http://www.evanmiller.org/how-not-to-sort-by-average-rating.html
     * 
     * @since   0.1
     * @access  private
     * @param   int $upvotes, int $downvotes
     * @return  double
     * @see     http://www.evanmiller.org/how-not-to-sort-by-average-rating.html
     */
    private function _confidence($upvotes = 0, $downvotes = 0) {
        $n = $upvotes + $downvotes;
        
        if($n === 0) {
            return 0;
        }
        
        $z = 1.281551565545; // 80% confidence
        $p = floor($upvotes) / $n;
        
        $left = $p + 1/(2*$n)*$z*$z;
        $right = $z*sqrt($p*(1-$p)/$n + $z*$z/(4*$n*$n));
        $under = 1+1/$n*$z*$z;
        
        return ($left - $right) / $under;
    }
    
    /**
     * calculates the controversy score for a link
     * 
     * @since   0.1
     * @param   int $upvotes, int $downvotes
     * @access  public
     * @return  float
     */
    public function controversy($upvotes = 0, $downvotes = 0) {
        return ($upvotes + $downvotes) / max(abs($this->_score($upvotes, $downvotes)), 1);
    }
    
    /**
     * public method to calculate a post's hotness
     * 
     * @since   0.1
     * @param   int $upvotes, int $downvotes, int $posted
     * @access  public
     * @return  float
     */
    public function hotness($upvotes, $downvotes, $posted) {
        return $this->_hotness($upvotes, $downvotes, $posted);
    }
    
    /**
     * public method to calculate a posts confidence
     * 
     * @since   0.1
     * @param   int $upvotes, int $downvotes
     * @access  public
     * @return  double
     */
    public function confidence($upvotes, $downvotes) {
        return $this->_confidence($upvotes, $downvotes);
    }
	
}