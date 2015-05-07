<?php

/**
 * Controller Paytyp ประเภทการชำระ
 */
class PaytypController extends CController
{
    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('index', 'view'),
                'users' => array('@'),
            ),
            array('allow', 
                'actions' => array('create', 'update', 'delete', 'save', 'dataPaytyp', 'validate'),
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

    public function actionUpdate($menucod,$paycode) {
        $paytyp = Paytyp::model()->findByAttributes(array('paycode' => $paycode));
        $this->renderPartial('update', array('menucod'=>$menucod, 'paytyp'=>$paytyp));  
    }

    public function actionDelete($menucod,$paycode) {
        if (!empty($paycode)) {
            Paytyp::model()->deleteAllByAttributes(array('paycode'=>$paycode));
        }
    } 

    public function actionSave() {
        $menucod   = $_POST['menucod'];
        $paycode   = $_POST['paycode'];
        $paydesc   = $_POST['paydesc'];
        $ptype     = $_POST['ptype'];
        $accmstcod = $_POST['accmstcod'];
        $paytyp = Paytyp::model()->findByAttributes(array('paycode' => $paycode));
        if (empty($paytyp)) {
            $paytyp = new Paytyp();
        }
        $paytyp->paycode   = $paycode;
        $paytyp->paydesc   = $paydesc;
        $paytyp->ptype     = $ptype;
        $paytyp->accmstcod = $accmstcod;
        $paytyp->save();
        $this->renderPartial('index', array('menucod'=>$menucod)); 
    }

    public function actionDataPaytyp() {
        $paytyp = Paytyp::model()->findAll(array('order'=>'paycode'));
        echo CJSON::encode($paytyp);
    }

    public function actionValidate($paycode) {
        $paytyp = Paytyp::model()->findByAttributes(array('paycode' => $paycode));
        if (empty($paytyp)) {
            echo 'true';
        } else {
            echo 'false';
        }
    }
}