<?php
namespace Admin\Model;
use Think\Model;
// use Think\Upload;
// use Think\Image;
use Think\Page;

class GoodsModel extends Model 
{
	protected $insertFields = array('goods_name','cat_id','brand_id','market_price','shop_price','jifen','jyz','jifen_price','promote_price','promote_start_time','promote_end_time','is_hot','is_new','is_best','is_on_sale','seo_keyword','seo_description','type_id','sort_num','is_delete','goods_desc','is_promote');
	protected $updateFields = array('id','goods_name','cat_id','brand_id','market_price','shop_price','jifen','jyz','jifen_price','promote_price','promote_start_time','promote_end_time','is_hot','is_new','is_best','is_on_sale','seo_keyword','seo_description','type_id','sort_num','is_delete','goods_desc','is_promote');
	// 定义表单验证的规则，控制器中的create方法时用
	protected $_validate = array(
		array('goods_name', 'require', '商品名称不能为空！', 1, 'regex', 3),
		array('goods_name', '1,45', '商品名称的值最长不能超过 45 个字符！', 1, 'length', 3),
		array('cat_id', 'require', '主分类的id不能为空！', 1, 'regex', 3),
		array('cat_id', 'number', '主分类的id必须是一个整数！', 1, 'regex', 3),
		array('brand_id', 'number', '品牌的id必须是一个整数！', 2, 'regex', 3),
		array('market_price', 'currency', '市场价必须是货币格式！', 2, 'regex', 3),
		array('shop_price', 'currency', '本店价必须是货币格式！', 2, 'regex', 3),
		array('jifen', 'require', '赠送积分不能为空！', 1, 'regex', 3),
		array('jifen', 'number', '赠送积分必须是一个整数！', 1, 'regex', 3),
		array('jyz', 'require', '赠送经验值不能为空！', 1, 'regex', 3),
		array('jyz', 'number', '赠送经验值必须是一个整数！', 1, 'regex', 3),
		array('jifen_price', 'require', '如果要用积分兑换，需要的积分数不能为空！', 1, 'regex', 3),
		array('jifen_price', 'number', '如果要用积分兑换，需要的积分数必须是一个整数！', 1, 'regex', 3),
		array('promote_price', 'currency', '促销价必须是货币格式！', 2, 'regex', 3),
		array('promote_start_time', 'number', '促销开始时间必须是一个整数！', 2, 'regex', 3),
		array('promote_end_time', 'number', '促销结束时间必须是一个整数！', 2, 'regex', 3),
		array('is_hot', 'number', '是否热卖必须是一个整数！', 2, 'regex', 3),
		array('is_new', 'number', '是否新品必须是一个整数！', 2, 'regex', 3),
		array('is_best', 'number', '是否精品必须是一个整数！', 2, 'regex', 3),
		array('is_on_sale', 'number', '是否上架：1：上架，0：下架必须是一个整数！', 2, 'regex', 3),
		array('seo_keyword', '1,150', 'seo优化_关键字的值最长不能超过 150 个字符！', 2, 'length', 3),
		array('seo_description', '1,150', 'seo优化_描述的值最长不能超过 150 个字符！', 2, 'length', 3),
		array('type_id', 'number', '商品类型id必须是一个整数！', 2, 'regex', 3),
		array('sort_num', 'number', '排序数字必须是一个整数！', 2, 'regex', 3),
		array('is_delete', 'number', '是否放到回收站：1：是，0：否必须是一个整数！', 2, 'regex', 3),
	);
	// TP在调用add方法之前会自动调用这个方法，我们可以把在插入数据库之前要执行的代码写到这里
	// 第一个参数：就是表单中的数据（要插入到数据库中的数据）是一个一维数组
	// 第二个参数：额外信息，：当前模型对应的实际的表名是什么
	// 说明：在这个函数中要改变这个函数外部的$data，需要按钮引用传递，否则修改也无效
	// 说明：如果return false是指控制器中的add方法返回了false
	protected function _before_insert(&$data, $option)
	{
		// 获取当前时间
		$data['addtime'] = time();
		// $data['goods_desc'] = strip_tags($data['goods_desc']);
		if(isset($_FILES['logo']) && $_FILES['logo']['error'] == 0){
			// 上传LOGO
			$result = createThumbImage('logo',C('IMG_SAVEPATH'),array(array(150,150)));
			if($result['err'] == 0){
				$data['logo'] = $result['image']['logo'];
		    	$data['sm_logo'] = $result['image']['thumb_1'];
			}else{
				$this->error = $result['msg'];
		        return FALSE; // 返回控制器
			}
		}
	}
	protected function _after_insert($data, $option)
	{
		/**************** 处理商品的扩展分类 ********************/
		$eci = I('post.ext_cat_id');
		if($eci)
		{
			$gcModel = M('GoodsCat');
			foreach ($eci as $v)
			{
				// 如果分类为空就跳过处理下一个
				if(empty($v))
					continue;
				$gcModel->add(array(
					'goods_id' => $data['id'],
					'cat_id' => $v,
				));
			}
		}
		/************* 处理会员价格 ************************/
		$mp = I('post.mp');
		if($mp)
		{
			$mpModel = M('MemberPrice');
			foreach ($mp as $k => $v)
			{
				if(empty($v))
					continue ;
				$mpModel->add(array(
					'goods_id' => $data['id'],
					'level_id' => $k,
					'price' => $v,
				));
			}
		}
		/******************** 处理商品属性的数据 *********************/
		$ga = I('post.ga');
		$ap = I('post.attr_price');
		if($ga)
		{
			$gaModel = M('GoodsAttr');
			foreach ($ga as $k => $v)
			{
				foreach ($v as $k1 => $v1)
				{
					if(empty($v1))
						continue ;
					$gaModel->add(array(
						'goods_id' => $data['id'],
						'attr_id' => $k,
						'attr_value' => $v1,
						'attr_price' => $ap[$k][$k1],
					));
				}
			}
		}
		/************************* 处理商品图片的代码 ***********************/
		// 判断有没有图片
		if(hasImage('pics'))
		{
			$gpModel = M('GoodsPics');
			// 批量上传之后的图片数组，改造成每个图片一个一维数组的形式
			$pics = array();
			foreach ($_FILES['pics']['name'] as $k => $v)
			{
				if($_FILES['pics']['size'][$k] == 0)
					continue ;
				$pics[] = array(
					'name' => $v,
					'type' => $_FILES['pics']['type'][$k],
					'tmp_name' => $_FILES['pics']['tmp_name'][$k],
					'error' => $_FILES['pics']['error'][$k],
					'size' => $_FILES['pics']['size'][$k],
				);
			}
			// 在后面调用uploadOne方法时会使用$_FILES数组上传图片，所以我们要把我们处理好的数组赎给$_FILES这样上传时使用的就是我们处理好的数组
			$_FILES = $pics;
			// 循环每张图片一个一个的上传
			foreach ($pics as $k => $v)
			{
				$ret = createThumbImage($k, C('IMG_SAVEPATH'), array(
					array(150, 150)
				));
				if($ret['err'] == 0)
				{
					$gpModel->add(array(
						'goods_id' => $data['id'],
						'pic' => $ret['image']['logo'],     // 原图存到pic字段
						'sm_pic' => $ret['image']['thumb_1'],  // 第一个缩略图存到sm_pic字段中
					));
				}
			}
		}
	}
	/**
	 * $option 是一个数组,包括的元素有:
	 * Array(
    [table] => php34_goods
    [model] => Goods
    [where] => Array
        (
            [id] => 10
        )
    )
	 * @param  [type] &$data  [description]
	 * @param  [type] $option [description]
	 * @return [type]         [description]
	 */
	protected function _before_update(&$data, $option)
	{
		// 获取当前时间
		$data['updatetime'] = time();
		// 上传LOGO
		$result = createThumbImage('logo',C('IMG_SAVEPATH'),array(array(150,150)));
		if($result['err'] == 0){
			$data['logo'] = $result['image']['logo'];
	    	$data['sm_logo'] = $result['image']['thumb_1'];
	    	// 先根据商品的ID取出这件商品的图片的路径
			$logo = $this->field('logo,sm_logo')->find($option['where']['id']);
			// 从配置文件取出图片所在目录
			$rp = C('IMG_ROOTPATH');
			// 删除图片
			@unlink($rp . $logo['logo']);
			@unlink($rp . $logo['sm_logo']);
		}else{
			$this->error = $result['msg'];
	        return FALSE; // 返回控制器
		}
	}
	public function search()
	{
		/************ 搜索 ****************/
		$where = array();  // 默认情况下的搜索条件为空
		// 商品名称的搜索
		$goodsName = I('get.goods_name');
		if($goodsName)
			$where['goods_name'] = array('like', "%$goodsName%");
		// 价格的搜索
		$startPrice = I('get.start_price');
		$endPrice = I('get.end_price');
		if($startPrice && $endPrice)
			$where['price'] = array('between', array($startPrice, $endPrice));
		elseif ($startPrice)
			$where['price'] = array('egt', $startPrice);
		elseif ($endPrice)
			$where['price'] = array('elt', $endPrice);
		// 上架的搜索
		$isOnSale = I('get.is_on_sale', -1);
		if($isOnSale != -1)
			$where['is_on_sale'] = array('eq', $isOnSale); 
		// 是否删除的搜索
		$isDelete = I('get.is_delete', -1);
		if($isDelete != -1)
			$where['is_delete'] = array('eq', $isDelete); 
		// 时间的搜索
		$startAddtime = I('get.start_addtime');
		$endAddtime = I('get.end_addtime');
		if($startAddtime && $endAddtime)
			$where['addtime'] = array('between', array(strtotime("$startAddtime 00:00:00"), strtotime("$endAddtime 23:59:59")));
		elseif ($startAddtime)
			$where['addtime'] = array('egt', strtotime("$startAddtime 00:00:00"));
		elseif ($endAddtime)
			$where['addtime'] = array('elt', strtotime("$endAddtime 23:59:59"));
		/***************** 排序 ******************/
		$orderby = 'id';  // 默认排序字段
		$orderway = 'desc'; // 默认排序方式
		$odby = I('get.odby');
		if($odby && in_array($odby, array('id_asc','id_desc','price_asc','price_desc')))
		{
			if($odby == 'id_asc')
				$orderway = 'asc';
			elseif ($odby == 'price_asc')
			{
				$orderby = 'price';
				$orderway = 'asc';
			}
			elseif ($odby == 'price_desc')
				$orderby = 'price';
		}
		/************ 翻页 *************/
		// 总的记录数
		$count = $this->where($where)->count();
		// 生成翻页对象
		$page = new Page($count, 3);
		$page->setConfig('next', '下一页');
		$page->setConfig('prev', '上一页');
		// 获取翻页字符串
		$pageString = $page->show();
		// 取出当前页的数据
		$data = $this->where($where)->limit($page->firstRow.','.$page->listRows)->order("$orderby $orderway")->select();
		// $data['data'] = $this->field('a.*,IFNULL(SUM(b.goods_number),0) gn')->alias('a')->join('LEFT JOIN php34_goods_number b ON a.id=b.goods_id')->where($where)->order('id DESC')->limit($page->firstRow.','.$page->listRows)->select();
		// echo $this->getLastSql();
		return array(
			'page' => $pageString,
			'data' => $data,
		);
	}
	// 在控制器中调用delete方法之前会自动调用
	protected function _before_delete($option)
	{
		// 先根据商品的ID取出这件商品的图片的路径
		$logo = $this->field('logo,sm_logo')->find($option['where']['id']);
		if(is_array($option['where']['id'])){
			$this->error = '不支持批量删除';
			return FALSE;
		}
		deleteImage($logo);
		// 从配置文件取出图片所在目录
		// $rp = C('IMG_ROOTPATH');
		// // 删除图片
		// unlink($rp . $logo['logo']);
		// unlink($rp . $logo['sm_logo']);
	}


	/**
	 * 前台调用的方法
	 */
	// 获取当前正处在促销期间的商品
	public function getPromoteGoods($limit = 5)
	{
		$now = time();
		return $this->field('id,goods_name,promote_price,sm_logo')->where(array(
			'is_on_sale' => array('eq', 1),  // 上架
			'is_delete' => array('eq', 0),   // 不在回收站
			'is_promote' => array('eq', 1),  // 促销的商品
			'promote_start_time' => array('elt', $now),
			'promote_end_time' => array('egt', $now),
		))->limit($limit)->order('sort_num ASC')->select();
	}
	// 最新的
	public function getNew($limit = 5)
	{
		$now = time();
		return $this->field('id,goods_name,shop_price,sm_logo')->where(array(
			'is_on_sale' => array('eq', 1),  // 上架
			'is_delete' => array('eq', 0),   // 不在回收站
			'is_new' => array('eq', 1),  // 最新
		))->limit($limit)->order('sort_num desc')->select();
	}
	public function getHot($limit = 5)
	{
		$now = time();
		return $this->field('id,goods_name,shop_price,sm_logo')->where(array(
			'is_on_sale' => array('eq', 1),  // 上架
			'is_delete' => array('eq', 0),   // 不在回收站
			'is_hot' => array('eq', 1),  // 热卖
		))->limit($limit)->order('sort_num ASC')->select();
	}
	public function getBest($limit = 5)
	{
		$now = time();
		return $this->field('id,goods_name,shop_price,sm_logo')->where(array(
			'is_on_sale' => array('eq', 1),  // 上架
			'is_delete' => array('eq', 0),   // 不在回收站
			'is_best' => array('eq', 1),  // 精品
		))->limit($limit)->order('sort_num asc')->select();
	}
	// 计算会员价格
	public function getMemberPrice($goodsId)
	{
		$now = time();
		// 先判断是否有促销价格
		$price = $this->field('shop_price,is_promote,promote_price,promote_start_time,promote_end_time')->find($goodsId);
		if($price['is_promote'] == 1 && ($price['promote_start_time'] < $now && $price['promote_end_time'] > $now))
		{
			return $price['promote_price'];
		}
		// 如果会员没登录直接使用本店价
		$memberId = session('mid');
		if(!$memberId)
			return $price['shop_price'];
		// 计算会员价格
		$mpModel = M('MemberPrice');
		$mprice = $mpModel->field('price')->where(array('goods_id'=>array('eq', $goodsId), 'level_id'=>array('eq', session('level_id'))))->find();		
		// 如果有会员价格就直接使用会员价格
		if($mprice)
			return $mprice['price'];
		else 
			// 如果没有设置会员价格，就按这个级别的折扣率来算
			return session('rate') * $price['shop_price'];
	}
	/**
	 * 转化商品属性ID为商品属性字符串
	 *
	 */
	public function convertGoodsAttrIdToGoodsAttrStr($gaid)
	{
		if($gaid)
		{
			$sql = 'SELECT GROUP_CONCAT( CONCAT( b.attr_name,  ":", a.attr_value ) SEPARATOR  "<br />" ) gastr FROM php34_goods_attr a LEFT JOIN php34_attribute b ON a.attr_id = b.id WHERE a.id IN ('.$gaid.')';

			$ret = $this->query($sql);
			return $ret[0]['gastr'];
		}
		else 
			return '';
	}
}










