<?php
/**
*积分商品模型
*
*/
namespace Home\Model;
use Think\Model;
use Think\Page;

class PointsGoodsModel extends Model{
	/**
	 *  初始化数据库模型
	 */
	public function __construct(){
		parent::__construct('points_goods');
	}
	/**
	 * 获取商品信息
	 * @return [type] [description]
	 */
	public function getPointsGoods($cate_id=0,$size=10,$sortField='sort',$sortOrder='desc'){
		$where = "status=1 and is_mobile=0";
		if($sortField == 'points'){
			$sortOrder='asc';
		}
		switch ($cate_id) {
			case 0:
				$where.= " and cate_id in(1,2,3)";;
				break;
			case 1:
				$where.= " and cate_id = 1";
				break;
			case 2:
				$where.= " and cate_id = 2";
				break;
		}
		$count = $this->where($where)->count();
		$page = new Page($count,$size);
		$show = $page->show();
		$result = $this->field('id,thumb,name,points')
			->where($where)
			->limit($page->firstRow.','.$page->listRows)
			->order("$sortField $sortOrder")
			->select();
		return $result;

	}

}