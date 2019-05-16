<?php
// +----------------------------------------------------------------------
// | snake
// +----------------------------------------------------------------------
// | Copyright (c) 2016~2022 http://baiyf.cn All rights reserved.
// +----------------------------------------------------------------------
// +----------------------------------------------------------------------
namespace app\admin\controller;
use app\admin\model\CompanyModel;

class Company extends Base
{
	/**
	 * 企业账号列表
	 * @return [type] [description]
	 */
	public function index()
	{
		  if(request()->isAjax()){

            $param = input('param.');

            $limit = $param['pageSize'];
            $offset = ($param['pageNumber'] - 1) * $limit;

            $where = [];
            if (!empty($param['searchText'])) {
                $where['username'] = ['like', '%' . $param['searchText'] . '%'];
            }
            $user = new CompanyModel();
            $selectResult = $user->getCompanyUserByWhere($where, $offset, $limit);

            $status = config('user_status');

            // 拼装参数
            foreach($selectResult as $key=>$vo){
            	 $selectResult[$key]['create_time'] = date('Y-m-d H:i:s', $vo['create_time']);
                $selectResult[$key]['status'] = $status[$vo['status']];

                $selectResult[$key]['operate'] = showOperate($this->makeButton($vo['id'],$vo['status']));
            }

            $return['total'] = $user->getAllCompanyUser($where);  //总数据
            $return['rows'] = $selectResult;

            return json($return);
        }

        return $this->fetch();
	}

	/**
	 * 新增企业账号
	 */
	public function add()
	{
		if(request()->isPost()){

            $param = input('post.');

            $param['password'] = md5($param['password'] . config('salt'));
            $param['create_time'] = time();
            $param['status'] = 1;
            $param['pic'] = '/static/admin/images/profile_small.jpg'; // 默认头像
            $param['pid'] = empty(session('id')) ? 0 : session('id');
            $param['check_status'] = 1;

            //var_dump($param);die;

            $user = new CompanyModel();
            $flag = $user->addCompanyUser($param);

            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }
        $this->assign([
            'status' => config('user_status')
        ]);


        return $this->fetch();
	}


	// 编辑
    public function edit()
    {
        $user = new CompanyModel();

        if(request()->isPost()){

            $param = input('post.');

            if(empty($param['password'])){
                unset($param['password']);
            }else{
                $param['password'] = md5($param['password'] . config('salt'));
            }
            $flag = $user->editCompany($param);

            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }

        $id = input('param.id');

        $this->assign([
            'user' => $user->getOneCompanyUser($id),
            'status' => config('user_status'),
        ]);
        return $this->fetch();
    }

    /**
     * 审核企业
     * @return [type] [description]
     */
    public function check()
    {

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
                'auth' => 'company/edit',
                'href' => url('company/edit', ['id' => $id]),
                'btnStyle' => 'primary',
                'icon' => 'fa fa-paste'
            ],
            "审核" => [
                'auth' => 'company/check',
                'href' => "javascript:userDel(" .$id .")",
                'btnStyle' => 'danger',
                'icon' => 'fa fa-trash-o'
            ]
        ];
    }

}