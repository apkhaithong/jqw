<?php

/**
 * Controller Vatmast กำหนดข้อมูลอัตราภาษี
 */
class VatmastController extends CController
{
    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('index', 'view'),
                'users' => array('@'),
            ),
            array('allow', 
                'actions' => array('create', 'update', 'delete', 'save', 'dataVatmast'),
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
        $vatmast = Vatmast::model()->findByAttributes(array('idno' => $idno));
        $this->renderPartial('update', array('menucod'=>$menucod, 'vatmast'=>$vatmast));  
    }

    public function actionDelete($menucod,$idno) {
        if (!empty($idno)) {
            Vatmast::model()->deleteAllByAttributes(array('idno'=>$idno));
        }
    } 

    public function actionSave() {
        $menucod  = $_POST['menucod'];
        $idno = $_POST['idno'];
        $frmdate = Yii::app()->CMyClass->convertDate($_POST['frmdate']);
        $todate  = Yii::app()->CMyClass->convertDate($_POST['todate']);
        $vatrt   = $_POST['vatrt'];
        $vatmast = Vatmast::model()->findByAttributes(array('idno' => $idno));
        if (empty($vatmast)) {
            $vatmast = new Vatmast();
        }
        $vatmast->frmdate = $frmdate;
        $vatmast->todate  = $todate;
        $vatmast->vatrt   = $vatrt;
        $vatmast->save();
        $this->renderPartial('index', array('menucod'=>$menucod)); 
    }

    public function actionDataVatmast() {
        $vatmast = Vatmast::model()->findAll(array('order'=>'idno'));
        echo CJSON::encode($vatmast);
    }

}