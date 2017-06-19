<?php
/**
* 只是一个全文搜索的类
*/
namespace Home\Controller;
use Think\Controller;

class ElasController extends Controller
{
	function __construct()
	{	
		parent::__construct();
		// 使用composer自动加载器
        require $_SERVER['DOCUMENT_ROOT'].__ROOT__.'/vendor/autoload.php';
        $host=['192.168.1.120:9200'];
        $this->client = \Elasticsearch\ClientBuilder::create()->setSSLVerification(false)->setHosts($host)->build();
	}
	public function create_index()
    {
        $params = [
		    'index' => 'my_index',
		    'type' => 'my_type',
		    'id' => 'my_id',
		    'body' => ['testField' => 'abc']
		];
		$response = $this->client->index($params);
		print_r($response);
    }
    // public function add_document()
    // {
    //     $params = array();
    //     $params['body'] = array(
    //         'testField' => 'dfdsfdsf'
    //     );
    //     $params['index'] = 'my_index';
    //     $params['type'] = 'my_index';
    //     $params['id'] = 'w1231313';
    //     $ret = $this->client->index($params);
    // }
    public function delete_index()
    {
        $deleteParams['index'] = 'my_index';
        $this->client->indices()->delete($deleteParams);
    }
    public function delete_document()
    {
        $deleteParams = array();
        $deleteParams['index'] = 'my_index';
        $deleteParams['type'] = 'my_index';
        $deleteParams['id'] = 'AU4Kmmj-WOmOrmyOj2qf';
        $retDelete = $this->client->delete($deleteParams);
    }
    public function update_document()
    {
        $updateParams = array();
        $updateParams['index'] = 'my_index';
        $updateParams['type'] = 'my_index';
        $updateParams['id'] = 'my_id';
        $updateParams['body']['doc']['asas']  = '111111';
       $response = $this->client->update($updateParams);
    }
    public function search()
    {
        $searchParams['index'] = 'my_index';
        $searchParams['type'] = 'my_index';
        $searchParams['from'] = 0;
        $searchParams['size'] = 100;
        $searchParams['sort'] = array(
            '_score' => array(
                'order' => 'desc'
            )
        );
        // $searchParams['body']['query']['match']['testField'] = 'abc';
        $retDoc = $this->client->search($searchParams);
        print_r($retDoc);
    }
    public function get_document()
    {
        $getParams = array();
        $getParams['index'] = 'my_index';
        $getParams['type'] = 'my_index';
        $getParams['id'] = 'AU4Kn-knWOmOrmyOj2qg';
        $retDoc = $this->client->get($getParams);
        print_r($retDoc);
    }

}