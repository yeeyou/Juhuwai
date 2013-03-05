<?php        
class Test extends CI_Controller
        {
		function __construct()
                {
                        parent::__construct();
                        $this->load->helper('url');
                }
 
        function index()
        {
		//echo "test";
        $this->load->view('test');
		}

		function load(){
		$this->load->view('weibo');
		
		
		}
		
		function weibo(){
		session_start();
		
		require_once(APPPATH.'libraries/weibo/config.php');
		require_once(APPPATH.'libraries/weibo/saetv2.ex.class.php');
		$o = new SaeTOAuthV2( WB_AKEY , WB_SKEY );
		$o->set_debug( DEBUG_MODE );

		// 生成state并存入SESSION，以供CALLBACK时验证使用
		$state = uniqid( 'weibo_', true);
		$_SESSION['weibo_state'] = $state;

		$code_url = $o->getAuthorizeURL( WB_CALLBACK_URL , 'code', $state );
		
		redirect($code_url);
		
		}
		
	function open(){
		session_start();
		
		require_once(APPPATH.'libraries/weibo/config.php');
		require_once(APPPATH.'libraries/weibo/saetv2.ex.class.php');
		
		$o = new SaeTOAuthV2( WB_AKEY , WB_SKEY );
		$o->set_debug( DEBUG_MODE );

		if (isset($_REQUEST['code'])) {
			$keys = array();

			// 验证state
			$state = $_REQUEST['state'];
			if ( empty($state) || $state !== $_SESSION['weibo_state'] ) {
				echo '非法请求！';
				exit;
			}
			unset($_SESSION['weibo_state']);

			$keys['code'] = $_REQUEST['code'];
			$keys['redirect_uri'] = WB_CALLBACK_URL;
			try {
				$token = $o->getAccessToken( 'code', $keys ) ;
			} catch (OAuthException $e) {
			}
		}

		if ($token) {
			$_SESSION['token'] = $token;
			setcookie( 'weibojs_'.$o->client_id, http_build_query($token) );
		
		echo "success";
		$c = new SaeTClientV2( WB_AKEY , WB_SKEY , $_SESSION['token']['access_token'] );
		$c->set_debug( DEBUG_MODE );
		$uid_get = $c->get_uid();
		$uid = $uid_get['uid'];
		$user = $c->show_user_by_id( $uid);//根据ID获取用户等基本信息
		echo $user['screen_name'];
		//利用一个方法将weibo_id存入users
		
		
		//利用一个方法将weibo个人信息存入info中
		
		} else {
			echo "fail";
		}
		
		}
		
	function id(){
	$this->load->model('m_open');
	$id='1111';
	if($this->m_open->is_id($id)){
	echo "success";}
	
	else echo "fail";
	
	}

	}
?>