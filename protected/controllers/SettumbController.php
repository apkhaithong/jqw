<?php

/**
 * Controller Settumb กำหนดข้อมูลตำบล
 */
class SettumbController extends CController
{
    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('index', 'view'),
                'users' => array('@'),
            ),
            array('allow', 
                'actions' => array('create', 'update', 'delete', 'save', 'dataSettumb', 'validate'),
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

    public function actionUpdate($menucod,$tumbcode) {
        $settumb = Settumb::model()->findByAttributes(array('tumbcode' => $tumbcode));
        $this->renderPartial('update', array('menucod'=>$menucod, 'settumb'=>$settumb));  
    }

    public function actionDelete($menucod,$tumbcode) {
        if (!empty($tumbcode)) {
            Settumb::model()->deleteAllByAttributes(array('tumbcode'=>$tumbcode));
        }
    } 

    public function actionSave() {
        $menucod  = $_POST['menucod'];
        $tumbcode = $_POST['tumbcode'];
        $tumbdesc = $_POST['tumbdesc'];
        $aumpcode = $_POST['aumpcode'];
        $settumb = Settumb::model()->findByAttributes(array('tumbcode' => $tumbcode));
        if (empty($settumb)) {
            $settumb = new Settumb();
        }
        $settumb->tumbcode = $tumbcode;
        $settumb->tumbdesc = $tumbdesc;
        $settumb->aumpcode = $aumpcode;
        $settumb->save();
        $this->renderPartial('index', array('menucod'=>$menucod)); 
    }

    public function actionDataSettumb() {
        $settumb = Settumb::model()->findAll(array('order'=>'tumbcode'));
        echo CJSON::encode($settumb);
    }

    public function actionValidate($tumbcode) {
        $settumb = Settumb::model()->findByAttributes(array('tumbcode' => $tumbcode));
        if (empty($settumb)) {
            echo 'true';
        } else {
            echo 'false';
        }
    }
}