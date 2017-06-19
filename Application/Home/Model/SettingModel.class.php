<?php
/**
*配置项模型
*@author gsp <[<email address>]>
*/
namespace Home\Model;
use Think\Model;
use Think\Cache;

class SettingModel extends Model{
	/**
	 * 获取系统设置
	 * @access public
	 * @return array
	 */
	public function getSetting(){
		$_key = 'setting';
		$cache = Cache::getInstance();
		$cache->delete($_key);
		$data = $cache->get($_key);
		if(empty($data)){
			$arr = $this->select();
			foreach ($arr as $k => $v) {
				$value = $v['value'];//取出value值s
				if($value && $value{0} == '{'){
					$value = json_decode($value,true);
				}
				$data[$v['code']] = $value;
			}
			$cache->set($_key,$data,86400);
		}
		return $data;
	}
	/**
	 * 获取单个设置
	 * @return [type] [description]
	 */
	public function getSinSetting($code){
		$_key = 'setting_'.$code;
		$cache = Cache::getInstance();
		$data=$cache->get($_key);
		if(empty($data)){
			$data = $this->where("code = '{$code}'")->getField("value");
			$data = json_decode($data,true);
			$cache->set($_key,$data,86400);
		}
		return $data;
	}
}