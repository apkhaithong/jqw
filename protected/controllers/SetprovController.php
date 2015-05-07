<?php

/**
 * Controller Setprov กำหนดข้อมูลจังหวัด
 */
class SetprovController extends CController
{
    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('index', 'view'),
                'users' => array('@'),
            ),
            array('allow', 
                'actions' => array('create', 'update', 'delete', 'save', 'dataSetprov', 'validate'),
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

    public function actionUpdate($menucod,$provcode) {
        $setprov = Setprov::model()->findByAttributes(array('provcode' => $provcode));
        $this->renderPartial('update', array('menucod'=>$menucod, 'setprov'=>$setprov));  
    }

    public function actionDelete($menucod,$provcode) {
        if (!empty($provcode)) {
            Setprov::model()->deleteAllByAttributes(array('provcode'=>$provcode));
        }
    } 

    public function actionSave() {
        $menucod  = $_POST['menucod'];
        $provcode = $_POST['provcode'];
        $provdesc = $_POST['provdesc'];
        $setprov = Setprov::model()->findByAttributes(array('provcode' => $provcode));
        if (empty($setprov)) {
            $setprov = new Setprov();
        }
        $setprov->provcode = $provcode;
        $setprov->provdesc = $provdesc;
        $setprov->save();
        $this->renderPartial('index', array('menucod'=>$menucod)); 
    }

    public function actionDataSetprov() {
        $setprov = Setprov::model()->findAll(array('order'=>'provcode'));
        echo CJSON::encode($setprov);
    }

    public function actionValidate($provcode) {
        $setprov = Setprov::model()->findByAttributes(array('provcode' => $provcode));
        if (empty($setprov)) {
            echo 'true';
        } else {
            echo 'false';
        }
    }
}