<?php

/**
 * Controller Setaump กำหนดข้อมูลอำเภอ
 */
class SetaumpController extends CController
{
    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('index', 'view'),
                'users' => array('@'),
            ),
            array('allow', 
                'actions' => array('create', 'update', 'delete', 'save', 'dataSetaump', 'validate'),
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

    public function actionUpdate($menucod,$aumpcode) {
        $setaump = Setaump::model()->findByAttributes(array('aumpcode' => $aumpcode));
        $this->renderPartial('update', array('menucod'=>$menucod, 'setaump'=>$setaump));  
    }

    public function actionDelete($menucod,$aumpcode) {
        if (!empty($aumpcode)) {
            Setaump::model()->deleteAllByAttributes(array('aumpcode'=>$aumpcode));
        }
    } 

    public function actionSave() {
        $menucod  = $_POST['menucod'];
        $aumpcode = $_POST['aumpcode'];
        $aumpdesc = $_POST['aumpdesc'];
        $provcode = $_POST['provcode'];
        $postcode = $_POST['postcode'];
        $setaump = Setaump::model()->findByAttributes(array('aumpcode' => $aumpcode));
        if (empty($setaump)) {
            $setaump = new Setaump();
        }
        $setaump->aumpcode = $aumpcode;
        $setaump->aumpdesc = $aumpdesc;
        $setaump->provcode = $provcode;
        $setaump->postcode = $postcode;
        $setaump->save();
        $this->renderPartial('index', array('menucod'=>$menucod)); 
    }

    public function actionDataSetaump() {
        $setaump = Setaump::model()->findAll(array('order'=>'aumpcode'));
        echo CJSON::encode($setaump);
    }

    public function actionValidate($aumpcode) {
        $setaump = Setaump::model()->findByAttributes(array('aumpcode' => $aumpcode));
        if (empty($setaump)) {
            echo 'true';
        } else {
            echo 'false';
        }
    }
}