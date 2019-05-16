<?php

namespace app\admin\model;

use think\Model;

class CompanyModel extends Model
{
	protected $name = 'company_user';

	/**
     * 列表文章
     * @param $where
     * @param $offset
     * @param $limit
     */
	public function getCompanyUserByWhere($where, $offset, $limit)
	{
		return $this->where($where)->limit($offset, $limit)->order('id desc')->select();
	}

	/**
     * 根据搜索条件获取所有的数量
     * @param $where
     */
    public function getAllCompanyUser($where)
    {
        return $this->where($where)->count();
    }

    /**
     * 添加企业账号
     * @param $param
     */
    public function addCompanyUser($param)
    {

        try{
            $result = $this->validate('CompanyValidate')->save($param);

            if(false === $result){
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            }else{

                return msg(1, url('Company/index'), '添加成功');
            }
        }catch (\Exception $e){
            return msg(-2, '', $e->getMessage());
        }
    }

     /**
     * 编辑
     * @param $param
     */
    public function editCompany($param)
    {
        try{
        	
            $result = $this->validate('CompanyValidate')->save($param, ['id' => $param['id']]);
            if(false === $result || $result === 0){
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            }else{

                return msg(1, url('Company/index'), '编辑成功');
            }
        }catch(\Exception $e){
            return msg(-2, '', $e->getMessage());
        }
    }


    /**
     * 根据管理员id获取角色信息
     * @param $id
     */
    public function getOneCompanyUser($id)
    {
        return $this->where('id', $id)->find();
    }

    /**
     * 删除
     * @param $id
     */
    public function delCompany($id)
    {
        try{

            $this->where('id', $id)->delete();
            return msg(1, '', '删除成功');

        }catch(\Exception $e){
            return msg(-1, '', $e->getMessage());
        }
    }



}