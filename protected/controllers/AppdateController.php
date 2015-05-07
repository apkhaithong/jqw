<?php

/**
 * Controller Appdate กำหนดวันที่ทำงานระบบ
 */
class AppdateController extends CController
{
    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('index', 'view'),
                'users' => array('@'),
            ),
            array('allow', 
                'actions' => array('create', 'update', 'delete', 'save'),
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
        $licen_no = '1';
        $condpay = Condpay::model()->findByAttributes(array('licen_no' => $licen_no));
        $this->renderPartial('index', array('menucod'=>$menucod, 'condpay'=>$condpay));  
    }

    public function actionSave() {
        $menucod  = $_POST['menucod'];
        $licen_no = $_POST['licen_no'];
        $appdate = Yii::app()->CMyClass->convertDate($_POST['appdate']);

        $condpay = Condpay::model()->findByAttributes(array('licen_no' => $licen_no));

        $condpay->appdate = $appdate;
        $condpay->save();
        $this->renderPartial('index', array('menucod'=>$menucod, 'condpay'=>$condpay));
    }

}