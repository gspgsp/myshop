<?php
namespace Home\Controller;
class MemberController extends HomeBaseController 
{
   public function regist()
   {
   		if(IS_POST)
   		{
   			$model = D('Member');
   			if($data = $model->create(I('post.'), 1))
   			{
   				$model->addtime = time();
   				$model->email_code = md5(uniqid());
   				$model->password = md5($data['password'] . C('MD5_KEY'));
   				$data['email_code'] = $model->email_code;
   				if($model->add())
   				{
   					// heredoc的语法，在微信开发中会经常使用的到
		$content =<<<HTML
		<p>欢迎您成为本站会员，请点击以下链接地址完成email验证。</p>
		<p><a href="http://www.shop.com/index.php/Home/Member/emailchk/code/{$data['email_code']}">点击完成验证</a></p>
HTML;
					// 把生成的验证码发到会员的邮箱中
					sendMail($data['email'], 'php34网email验证', $content);
   					$this->success('注册成功，请登录到您的邮件中完成验证！');
   					exit;
   				}
   			}
   			$this->error($model->getError());
   		}
   		// 设置页面标题等信息
   		$this->setPageInfo('会员注册', '会员注册', '会员注册', 1, array('login'));
   		$this->display();
   }
   public function login()
   {
   		if(IS_POST)
   		{
   			$model = D('Member');
   			//相当于是自己定义了验证时机
   			if($model->validate($model->_login_validate)->create(I('post.'), 9))
   			{
   				if($model->login())
   					if(!empty(session('returnUrl'))) redirect(session('returnUrl'));//其它页面登陆后的跳转
   					redirect('/');  // 登录成功之后直接跳到首页
   			}
   			$this->error($model->getError());
   		}
   		// 设置页面标题等信息
   		$this->setPageInfo('会员登录', '会员登录', '会员登录', 1, array('login'));
   		$this->display();
   }
    // 生成验证码的图片
	public function chkcode()
	{
		$Verify = new \Think\Verify(array(
			'length' => 2,
			'useNoise' => FALSE,
		));
		$Verify->entry();
	}
	public function emailchk()
	{
		// 接收会员传回来的验证码
		$code = I('get.code');
		if($code)
		{
			// 把这个验证码到数据库中比较一下即可
			$model = M('Member');
			$email = $model->where(array('email_code'=>array('eq', $code)))->find();
			if($email)
			{
				// 设置这个账号为已验证
				$model->where(array('id'=>array('eq', $email['id'])))->setField('email_code', '');
				$this->success('已经完成验证，现在可以去登录', U('login'));
				exit;
			}
		}
	}
	public function logout()
	{
		session(null);
		redirect('/');
	}
	public function ajaxChkLogin()
	{
		if(session('mid'))
		{
			$arr = array(
				'ok' => 1,
				'email' => session('email'),
			);
		}
		else
		{
			$arr = array('ok' => 0);
		}
		exit(json_encode($arr));
		// echo json_encode($arr);
	}
	//ajax获取引用链接
	public function saveAndLogin()
	{
		// 获取AJAX是从哪个页面发过来的
		session('returnUrl', $_SERVER['HTTP_REFERER']);
	}
}















