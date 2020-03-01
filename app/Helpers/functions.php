<?php

/**
 * 公用的方法  返回json数据，进行信息的提示
 * @param $status 状态
 * @param string $message 提示信息
 * @param array $data 返回数据
 */
 public function CreateTree($data,$parent_id=0,$level=0){
        if(!$data){
            return;
        }
        static $newarray=[];
        foreach ($data as $k=>$v){
            if($v->parent_id==$parent_id){
                $v->level=$level;
                $newarray[]=$v;
                //调用自身
               CreateTree($data,$v->cate_id,$level+1);
            }
        }
        return $newarray;
    }
//文件上传
    function uploads($filename){
        $photo=request()->file($filename);
        //判断上传过程有误错误
        if($photo()->isValid()){         
            //上传
            $store_result=$photo->store('uploads');
            return $store_result;
        } 
        exit("未获录取到上传文件 或者 上传过程出错");
    }
    function Moreuploads($filename){
        $photo=request()->file($filename);
        if(!is_array($photo)){
            return;
        }
        foreach($photo as $v){
            if($v->isValid()){
                $store_result[]=$v->store('uploads');
            }
        }
        return $store_result;
    }