<?php

/**
 * Controller Garmast รหัสบริษัทประกัน
 */
class GarmastController extends CController
{
    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('index', 'view'),
                'users' => array('@'),
            ),
            array('allow', 
                'actions' => array('create', 'update', 'delete', 'save', 'dataGarmast', 'validate'),
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

    public function actionUpdate($menucod,$garcode) {
        $garmast = Garmast::model()->findByAttributes(array('garcode' => $garcode));
        $this->renderPartial('update', array('menucod'=>$menucod, 'garmast'=>$garmast));  
    }

    public function actionDelete($menucod,$garcode) {
        if (!empty($garcode)) {
            Garmast::model()->deleteAllByAttributes(array('garcode'=>$garcode));
        }
    } 

    public function actionSave() {
        $menucod  = $_POST['menucod'];
        $garcode  = $_POST['garcode'];
        $garname  = $_POST['garname'];
        $garaddr1 = $_POST['garaddr1'];
        $garaddr2 = $_POST['garaddr2'];
        $gartelp  = $_POST['gartelp'];
        $garmast  = Garmast::model()->findByAttributes(array('garcode' => $garcode));
        if (empty($garmast)) {
            $garmast = new Garmast();
        }
        $garmast->garcode  = $garcode;
        $garmast->garname  = $garname;
        $garmast->garaddr1 = $garaddr1;
        $garmast->garaddr2 = $garaddr2;
        $garmast->gartelp  = $gartelp;
        $garmast->save();
        $this->renderPartial('index', array('menucod'=>$menucod)); 
    }

    public function actionDataGarmast() {
        $garmast = Garmast::model()->findAll(array('order'=>'garcode'));
        echo CJSON::encode($garmast);
    }

    public function actionValidate($garcode) {
        $garmast = Garmast::model()->findByAttributes(array('garcode' => $garcode));
        if (empty($garmast)) {
            echo 'true';
        } else {
            echo 'false';
        }
    }
}