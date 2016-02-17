<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    //

	public function userLogin() {
		//接收app发送过来的参数
		$app = json_decode(file_get_contents('php://input'));
		if (isset($_POST['username']) && isset($_REQUEST['password'])) {
			$result = \App\Login::where('username', '=', $_POST['username'])
				->where('password', md5($_POST['username'].$_REQUEST['password']))
				->where('status', 1)
				->get();
			//找到该用户记录
			if (!empty($result)) {
				return $this->resultToJson(200, '操作成功', $result[0]->id);
			}

			//没有找到该用户。
			return $this->resultToJson(403, '用户名不存在或密码错误', null);
		}

		//app发送的数据格式不正确
		return $this->resultToJson(405, '数据格式错误', null);
	}

	/**
	 * Function: 把结果以json方式输出
	 * create: 2016/02/16
	 * @param $code 	状态码
	 * @param $msg 		提示信息
	 * @param $result 	用户ID
	**/ 
    public function resultToJson($code, $msg, $result) {
    	return json_encode(array(
    		'code' =>  $code,
    		'msg'  =>  $msg,
    		'id'   =>  $result
    		));
    }
}
