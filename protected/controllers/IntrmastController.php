<?php

/**
 * Controller Intrmast กำหนดข้อมูลอัตราภาษี
 */
class IntrmastController extends CController
{
    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('index', 'view'),
                'users' => array('@'),
            ),
            array('allow', 
                'actions' => array('create', 'update', 'delete', 'save', 'dataIntrmast'),
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

    public function actionUpdate($menucod,$idno) {
        $intrmast = Intrmast::model()->findByAttributes(array('idno' => $idno));
        $this->renderPartial('update', array('menucod'=>$menucod, 'intrmast'=>$intrmast));  
    }

    public function actionDelete($menucod,$idno) {
        if (!empty($idno)) {
            Intrmast::model()->deleteAllByAttributes(array('idno'=>$idno));
        }
    } 

    public function actionSave() {
        $menucod  = $_POST['menucod'];
        $idno = $_POST['idno'];
        $frmdate = Yii::app()->CMyClass->convertDate($_POST['frmdate']);
        $todate  = Yii::app()->CMyClass->convertDate($_POST['todate']);
        $intr    = $_POST['intr'];
        $intrmast = Intrmast::model()->findByAttributes(array('idno' => $idno));
        if (empty($intrmast)) {
            $intrmast = new Intrmast();
        }
        $intrmast->frmdate = $frmdate;
        $intrmast->todate  = $todate;
        $intrmast->intr    = $intr;
        $intrmast->save();
        $this->renderPartial('index', array('menucod'=>$menucod)); 
    }

    public function actionDataIntrmast() {
        $intrmast = Intrmast::model()->findAll(array('order'=>'idno'));
        echo CJSON::encode($intrmast);
    }

}