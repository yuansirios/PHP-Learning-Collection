<?php 
    class Response{
        //默认是json格式
        const JSON='json';
        public static function show($success,$errCode,$errMsg='',$body=array(),$type){
    
            if(!is_numeric($errCode)){
                return '';
            }
            //为前端开发人员提供接口
            $type=isset($_REQUEST['format'])?$_REQUEST['format']:self::JSON;
            $result=array(
                'success'=>$success,
                'errCode'=>$errCode,
                'errMsg'=>$errMsg,
                'body'=>$body
                );
            if($type=='json'){
                self::jsonEncode($success,$errCode,$errMsg,$body);
                exit;
            }elseif($type=='array'){
                //调试
                var_dump($result);
                exit;
            }elseif($type=="xml"){
                self::xmlEncode($success,$errCode,$errMsg,$body);
                exit;
            }else{
                //html
                exit;
            }
        }

        /**
         * 获取所有 以 HTTP开头的header参数
         * @return array
         */
        public static function getAllHeaders(){
            // 忽略获取的header数据
            $ignore = array('host','accept','content-length','content-type');

            $headers = array();

            foreach($_SERVER as $key=>$value){
                if(substr($key, 0, 5)==='HTTP_'){
                    $key = substr($key, 5);
                    $key = str_replace('_', ' ', $key);
                    $key = str_replace(' ', '-', $key);
                    $key = strtolower($key);

                    if(!in_array($key, $ignore)){
                        $headers[$key] = $value;
                    }
                }
            }
            return $headers;
        }
    
        public static function jsonEncode($success,$errCode,$errMsg='',$body=array()){
            if(!is_numeric($errCode)){
                return '';
            }
            //把要返回给前端的数据组合 
            $result=array(
                'success'=>$success,
                'errCode'=>$errCode,
                'errMsg'=>$errMsg,
                'body'=>$body
                );
            //array => json
            echo json_encode($result,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
            exit;
        }
        
        
        public static function xmlEncode($success,$errCode,$errMsg='',$body=array()){
            if(!is_numeric($code)){
                return '';
            }
            //告诉浏览器该格式为xml
            header("Content-Type:text/xml");
            $result=array(
                'success'=>$success,
                'errCode'=>$errCode,
                'errMsg'=>$errMsg,
                'body'=>$body     
                );
                $xml='';
                //xml声明是必要的
                $xml.="<?xml version='1.0' encoding='UTF-8'?>";
                //根节点是必要的
                $xml.="<root>";
                $xml.=self::xmlToEncoding($result);
                $xml.="</root>";
                echo $xml;
        }

      public static function xmlToEncoding($result){
            foreach($result as $key=>$val){
                 //处理根节点为数字 xml是不允许的 所以使用id号来区别
                  if(is_numeric($key)){
                      $attr="id='{$key}'";
                      $key="item";
                 }
                $xml.="<{$key} {$attr}>";
                $attr='';
                $xml.=is_array($val)?self::xmlToEncoding($val):$val;
                $xml.="</{$key}>";     
            }
            return $xml;
      }
    }
?>