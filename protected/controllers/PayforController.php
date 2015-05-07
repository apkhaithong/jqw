<?php

/**
 * Controller Payfor รหัสการชำระเงิน
 */
class PayforController extends CController
{
    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('index', 'view'),
                'users' => array('@'),
            ),
            array('allow', 
                'actions' => array('create', 'update', 'delete', 'save', 'dataPayfor', 'validate'),
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

    public function actionUpdate($menucod,$forcode) {
        $payfor = Payfor::model()->findByAttributes(array('forcode' => $forcode));
        $this->renderPartial('update', array('menucod'=>$menucod, 'payfor'=>$payfor));  
    }

    public function actionDelete($menucod,$forcode) {
        if (!empty($forcode)) {
            Payfor::model()->deleteAllByAttributes(array('forcode'=>$forcode));
        }
    } 

    public function actionSave() {
        $menucod   = $_POST['menucod'];
        $forcode   = $_POST['forcode'];
        $fordesc   = $_POST['fordesc'];
        $taxfl     = $_POST['taxfl'];
        $typechk   = $_POST['typechk'];
        $block     = $_POST['block'];
        $doctype   = $_POST['doctype'];
        $accmstcod = $_POST['accmstcod'];
        $payfor = Payfor::model()->findByAttributes(array('forcode' => $forcode));
        if (empty($payfor)) {
            $payfor = new Payfor();
        }
        $payfor->forcode   = $forcode;
        $payfor->fordesc   = $fordesc;
        $payfor->taxfl     = $taxfl;
        $payfor->typechk   = $typechk;
        $payfor->block     = $block;
        $payfor->doctype   = $doctype;
        $payfor->accmstcod = $accmstcod;
        $payfor->save();
        $this->renderPartial('index', array('menucod'=>$menucod)); 
    }

    public function actionDataPayfor() {
        $payfor = Payfor::model()->findAll(array('order'=>'forcode'));
        echo CJSON::encode($payfor);
    }

    public function actionValidate($forcode) {
        $payfor = Payfor::model()->findByAttributes(array('forcode' => $forcode));
        if (empty($payfor)) {
            echo 'true';
        } else {
            echo 'false';
        }
    }
}