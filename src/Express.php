<?php

namespace Wjxcodes\Express;

use Wjxcodes\Express\Exceptions\HttpException;
use Wjxcodes\Express\Exceptions\InvalidArgumentException;


/**
* 聚合数据快递
*/
class Express
{

	protected $appkey;//申请的聚合数据物流接口AppKey
	
	private $queryUrl = 'http://v.juhe.cn/exp/index';

    private $comUrl = 'http://v.juhe.cn/exp/com';
	
	function __construct(string $appkey)
	{
		$this->appkey = $appkey;
	}
 
    
 
    /**
     * 返回支持的快递公司公司列表
     * @return array
     */
    public function getComs(){
        $params = 'key='.$this->appkey;
        $content = $this->juhecurl($this->comUrl,$params);
        
        return $this->_returnArray($content);
    }
 
    public function query($com,$no,$receiverPhone){

    	$com_arr = ['sf','sto','yt','yd','tt','ems','zto','ht','qf','db','gt','rfd','jd','zjs','emsg','fedex','yzgn','ups','ztky','jiaji','suer','xfwl','yousu','zhongyou','tdhy','axd','kuaijie','aae','dhl','dpex','ds','fedexcn','ocs','tnt','coe','cxwl','cs','cszx','aj','bfdf','chengguang','dsf','ctwl','feibao','malaysiaems','ane66','ztoky','ycgky','ycky','youzheng','bsky','suning','anneng','jiuye'];
    	if (!\in_array(\strtolower($com), $com_arr)) {
            throw new InvalidArgumentException('错误的快递公司编号: '.$com);
        }

        $params = array(
            'key' => $this->appkey,
            'com'  => $com,
            'no' => $no,
            'receiverPhone' => $receiverPhone
        );
        
        try {

			$content = $this->juhecurl($this->queryUrl,$params,1);

        	return $this->_returnArray($content);

		} catch (\Exception $e) {

			throw new HttpException($e->getMessage(), $e->getCode(), $e); 
		}
        
    }
 
    /**
     * 将JSON内容转为数据，并返回
     * @param string $content [内容]
     * @return array
     */
    public function _returnArray($content){
        return json_decode($content,true);
    }
 
    /**
     * 请求接口返回内容
     * @param  string $url [请求的URL地址]
     * @param  string $params [请求的参数]
     * @param  int $ipost [是否采用POST形式]
     * @return  string
     */
    public function juhecurl($url,$params=false,$ispost=0){
        $httpInfo = array();
        $ch = curl_init();
 
        curl_setopt( $ch, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1 );
        curl_setopt( $ch, CURLOPT_USERAGENT , 'JuheData' );
        curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT , 60 );
        curl_setopt( $ch, CURLOPT_TIMEOUT , 60);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER , true );
        if( $ispost )
        {
            curl_setopt( $ch , CURLOPT_POST , true );
            curl_setopt( $ch , CURLOPT_POSTFIELDS , $params );
            curl_setopt( $ch , CURLOPT_URL , $url );
        }
        else
        {
            if($params){
                curl_setopt( $ch , CURLOPT_URL , $url.'?'.$params );
            }else{
                curl_setopt( $ch , CURLOPT_URL , $url);
            }
        }
        $response = curl_exec( $ch );
        if ($response === FALSE) {
            //echo 'cURL Error: ' . curl_error($ch);
            return false;
        }
        $httpCode = curl_getinfo( $ch , CURLINFO_HTTP_CODE );
        $httpInfo = array_merge( $httpInfo , curl_getinfo( $ch ) );
        curl_close( $ch );
        return $response;
    }







}