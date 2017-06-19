<?php
/**
* 资源库模型
* @author gsp <[<email address>]>
*/
namespace Home\Model;
use Think\Model;
use Think\Page;

class ResourceModel extends Model
{
	function __construct()
	{
		parent::__construct('resourcelib');
	}
	/**
	 * 获取sphinx来的资源库id对应的资源
	 * @param  [type] $ids [description]
	 * @return [type]      [description]
	 */
	public function getSearch($ids,$keywords){
		$count = $this->where("id in($ids)")->count();
		$page = new Page($count,10);
		$show = $page->show();
		// $this->where(array('id'=>array('in',$ids)))->order("input_time desc")->select();
		$list = $this->where("id in($ids)")->limit($page->firstRow.','.$page->listRows)->order("input_time desc")->select();
		foreach ($list as &$value) {
			$value['content'] = str_replace($keywords, '<font style="color:#F00;">'.$keywords.'</font>', $value['content']);
		}
		return array('page'=>$show,'list'=>$list);
	}
	/**
	 * [getList description]
	 * @param  [type] $type [description]
	 * @return [type]       [description]
	 */
	public function getList($type){
		if($type == 2){
			$where = " type in (0,1) ";
		}else{
			$where = " type = $type ";
		}
		$count = $this->where($where)->count();
		$page = new Page($count,10);
		$show = $page->show();
		$list = $this->where($where)->limit($page->firstRow.','.$page->listRows)->order("input_time desc")->select();
		return array('page'=>$show,'list'=>$list);
	}
}