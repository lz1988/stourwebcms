<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Advertise extends ORM {

   public function delete()
   {
       $pic = $this->picurl;
      // Common::deleteRelativeImage($pic);
       parent::delete();
   }

    //删除以前广告
   public  function deleteRepeat($webid,$adposition)
   {

         $model = $this->where('webid','=',$webid)->and_where('adposition','=',$adposition)->find();
         if($model->loaded() && isset($model->id))
         {
            $model->delete();//删除
         }


   }





}