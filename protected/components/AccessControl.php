<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class AccessControl extends CApplicationComponent {
    public static function check_access($level){
        if(Yii::app()->user->id){
            $return = false;
            $model = Passwrd::model()->findByAttributes(array('userid'=>Yii::app()->user->name));
            
            if(!empty($model)){
                if($level){
                    if(trim($model->level) == $level){
                        $return = true;
                    }
                }
                if(is_array($level)){
                    foreach ($level as $value) {
                        if($model->level == $value){
                            $return = true;
                        }
                    }
                }
            }
            return $return;
        }else{
            return false;
        }
    }
}