<?php
// +----------------------------------------------------------------------
// | snake
// +----------------------------------------------------------------------
// | Copyright (c) 2016~2022 http://baiyf.cn All rights reserved.
// +----------------------------------------------------------------------
// +----------------------------------------------------------------------
namespace app\admin\controller;
use app\admin\model\UserModel;

class Cagents extends Base
{
	/**
	 * 省代列表
	 * @return [type] [description]
	 */
	public function indexCagents()
	{
		  if(request()->isAjax()){

            $param = input('param.');

            $limit = $param['pageSize'];
            $offset = ($param['pageNumber'] - 1) * $limit;

            $where = [];
            if (!empty($param['searchText'])) {
                $where['user_name'] = ['like', '%' . $param['searchText'] . '%'];
            }
            $where['role_status'] = 2;
            $where['role_id'] = 3;
            $user = new UserModel();
            $selectResult = $user->getUsersByWhere($where, $offset, $limit);

            $status = config('user_status');

            // 拼装参数
            foreach($selectResult as $key=>$vo){

                $selectResult[$key]['last_login_time'] = date('Y-m-d H:i:s', $vo['last_login_time']);
                $selectResult[$key]['status'] = $status[$vo['status']];

                if( 1 == $vo['id'] ){
                    $selectResult[$key]['operate'] = '';
                    continue;
                }
                $selectResult[$key]['operate'] = showOperate($this->makeButton($vo['id']));
            }

            $return['total'] = $user->getAllUsers($where);  //总数据
            $return['rows'] = $selectResult;

            return json($return);
        }

        return $this->fetch();
	}

	/**
	 * 新增省代
	 */
	public function addCagents()
	{
		if(request()->isPost()){

            $param = input('post.');

            $param['password'] = md5($param['password'] . config('salt'));
            $param['head'] = '/static/admin/images/profile_small.jpg'; // 默认头像
            $param['role_status'] = 2;
            $param['role_id'] = 3;
            $user = new UserModel();
            $flag = $user->insertUser($param,"cagents/indexcagents");

            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }
         $this->assign([
            'status' => config('user_status')
        ]);


        return $this->fetch();
	}

	/**
	 * 编辑
	 * @return [type] [description]
	 */
	public function updateCagents()
	{
		$user = new UserModel();

        if(request()->isPost()){

            $param = input('post.');

            if(empty($param['password'])){
                unset($param['password']);
            }else{
                $param['password'] = md5($param['password'] . config('salt'));
            }
            $flag = $user->editUser($param,"cagents/indexcagents");

            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }

        $id = input('param.id');

        $this->assign([
            'user' => $user->getOneUser($id),
            'status' => config('user_status'),
        ]);
        return $this->fetch();
	}

	/**
	 * 删除
	 */
	public function delCagents()
	{
		$id = input('param.id');

        $role = new UserModel();
        $flag = $role->delUser($id);
        return json(msg($flag['code'], $flag['data'], $flag['msg']));
	}


	/**
     * 拼装操作按钮
     * @param $id
     * @return array
     */
    private function makeButton($id)
    {
        return [
            '编辑' => [
                'auth' => 'cagents/updatecagents',
                'href' => url('cagents/updateCagents', ['id' => $id]),
                'btnStyle' => 'primary',
                'icon' => 'fa fa-paste'
            ],
            '删除' => [
                'auth' => 'cagents/delcagents',
                'href' => "javascript:userDel(" .$id .")",
                'btnStyle' => 'danger',
                'icon' => 'fa fa-trash-o'
            ]
        ];
    }
}