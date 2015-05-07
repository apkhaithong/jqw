<?php

/**
 * Controller Setzone กำหนดข้อมูลรหัสการตลาด
 */
class SetzoneController extends CController
{
    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('index', 'view'),
                'users' => array('@'),
            ),
            array('allow', 
                'actions' => array('create', 'update', 'delete', 'save', 'dataSetzone', 'validate'),
                'users' => array('@'),
            ),
            array('allow', 
                'actions' => array('admin'),
                'users' => array('admin'),
            ),
            array('deny', 
                'users'=>array('*'),
            ),            
        );
    }
    public function actionIndex($menucod) {
        $this->renderPartial('index', array('menucod'=>$menucod));  
    }

    public function actionCreate($menucod) {
        $this->renderPartial('create', array('menucod'=>$menucod));  
    }

    public function actionUpdate($menucod,$zonecode) {
        $setzone = Setzone::model()->findByAttributes(array('zonecode' => $zonecode));
        $this->renderPartial('update', array('menucod'=>$menucod, 'setzone'=>$setzone));  
    }

    public function actionDelete($menucod,$zonecode) {
        if (!empty($zonecode)) {
            Setzone::model()->deleteAllByAttributes(array('zonecode'=>$zonecode));
        }
    } 

    public function actionSave() {
        $menucod  = $_POST['menucod'];
        $zonecode = $_POST['zonecode'];
        $zonedesc = $_POST['zonedesc'];
        $setzone = Setzone::model()->findByAttributes(array('zonecode' => $zonecode));
        if (empty($setzone)) {
            $setzone = new Setzone();
        }
        $setzone->zonecode = $zonecode;
        $setzone->zonedesc = $zonedesc;
        $setzone->save();
        $this->renderPartial('index', array('menucod'=>$menucod)); 
    }

    public function actionDataSetzone() {
        $setzone = Setzone::model()->findAll(array('order'=>'zonecode'));
        echo CJSON::encode($setzone);
    }

    public function actionValidate($zonecode) {
        $setzone = Setzone::model()->findByAttributes(array('zonecode' => $zonecode));
        if (empty($setzone)) {
            echo 'true';
        } else {
            echo 'false';
        }
    }
}