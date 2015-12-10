<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/5/5 0005
 * Time: 17:22
 */

class Model_Insurance extends  ORM {


    //获取某个接口商下的保险产品
    public static function getList($companyKey='huizhe')
    {
        $model=new self();
        return $model->where('companykey','=',$companyKey)->get_all();
    }
    public static function updateProduct($companyKey='huizhe',$dataArr)
    {
        $model=new self();
        $productCode=$dataArr['ProductCaseCode'];
        $model=$model->where('companykey','=',$companyKey)->and_where('productcode','=',$productCode)->find();
        $model->companykey=$companyKey;
        $model->productname=$dataArr['ProductDetailsResponse']['ProductDetails']['Product']['Name'];
        $model->defaultprice=$dataArr['DefaultPrice'];
        $model->productcode=$productCode;
        $model->content=serialize($dataArr);
        return $model->save();
    }
    //过滤产品信息，将需要的显示出来
    public static function filterProductInfo($productStr)
    {
        if(empty($productStr))
            return null;
        $productArr=unserialize($productStr);
        $newArr=array();
        $newArr[]=array('title'=>'产品名称','val'=>$productArr['ProductDetailsResponse']['ProductDetails']['Product']['Name']);
        $newArr[]=array('title'=>'默认价格','val'=>$productArr['DefaultPrice']);
        $newArr[]=array('title'=>'计划名称','val'=>$productArr['ProductDetailsResponse']['ProductDetails']['Product']['PlanName'][0]);
        $newArr[]=array('title'=>'产品摘要','val'=>$productArr['ProductDetailsResponse']['ProductDetails']['Product']['ShortDescription']);
        $newArr[]=array('title'=>'产品详情','val'=>$productArr['ProductDetailsResponse']['ProductDetails']['Product']['FullDescription'][0]);
        $newArr[]=array('title'=>'慧择提示','val'=>$productArr['ProductDetailsResponse']['ProductDetails']['Product']['HzInsTips'][0]);
        $newArr[]=array('title'=>'适用人群','val'=>$productArr['ProductDetailsResponse']['ProductDetails']['Product']['ForPeople']);
        return $newArr;
    }
    //判断当前站点是否有保险
    public static function hasInsurance($companyKey='huizhe')
    {
        $model=new self();
        return $model->where('companykey','=',$companyKey)->count_all();

    }
    public static function getNamePaires($idsStr)
    {
        if(empty($idsStr))
            return null;
        $idsArr=explode(',',$idsStr);
        $nameArr=array();
        foreach($idsArr as $v)
        {
            $model=new self($v);
            $nameArr[]=array('id'=>$v,'productname'=>$model->productname);
        }
        return $nameArr;
    }

}