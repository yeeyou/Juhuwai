<?php        
class Open extends CI_Controller
        {

	function test(){
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
		
	function get_info(){
		if ($this->dx_auth->is_logged_in()){
			echo "你已经登陆了";
		}
		else{
			$this->load->model('m_open');
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
			
			//echo "success";
			$c = new SaeTClientV2( WB_AKEY , WB_SKEY , $_SESSION['token']['access_token'] );
			$c->set_debug( DEBUG_MODE );
			$uid_get = $c->get_uid();
			$uid = $uid_get['uid'];
				if (!$uid){echo "error";}
				$user = $c->show_user_by_id( $uid);//根据ID获取用户等基本信息
				//echo $user['screen_name'];

				if($this->m_open->is_id($uid)){
					$this->m_open->login($uid);
					//echo "登陆";
					//echo $uid;
				//$c->update( "坑爹的api终于调好了");
					
					redirect('');
				}
			//else register
				else {
					$this->m_open->register($user);
					$this->m_open->create($user);
					//echo $uid;
					//echo "注册";
				
					redirect('');}
			}
			else {
				echo "fail";
			}
		}
		
	}
	
	function show_me(){
		
		//$weibo_info=$this->m_open->get_owner_weibo_info();
		echo $weibo_info->avatar_large;
	}
	
 }?>