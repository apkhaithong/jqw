<?php

/**
 * Controller Payforlocat รหัสการชำระเงิน
 */
class PayforlocatController extends CController
{
    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('index', 'view'),
                'users' => array('@'),
            ),
            array('allow',
                'actions' => array('create', 'update', 'delete', 'save', 'dataPayforlocat', 'validate'),
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
        $payforlocat = Payforlocat::model()->findByAttributes(array('forcode' => $forcode));
        $this->renderPartial('update', array('menucod'=>$menucod, 'payforlocat'=>$payforlocat));
    }

    public function actionDelete($menucod,$forcode) {
        if (!empty($forcode)) {
            Payforlocat::model()->deleteAllByAttributes(array('forcode'=>$forcode));
        }
    }

    public function actionSave() {
        $menucod   = $_POST['menucod'];
        $forcode   = $_POST['forcode'];
        $fordesc   = $_POST['fordesc'];
        //$taxfl     = $_POST['taxfl'];
        $typechk   = $_POST['typechk'];
        $block     = $_POST['block'];
        //$doctype   = $_POST['doctype'];
        $accmstcod = $_POST['accmstcod'];
        $payforlocat = Payforlocat::model()->findByAttributes(array('forcode' => $forcode));
        if (empty($payforlocat)) {
            $payforlocat = new Payforlocat();
        }
        $payforlocat->forcode   = $forcode;
        $payforlocat->fordesc   = $fordesc;
        //$payforlocat->taxfl     = $taxfl;
        $payforlocat->typechk   = $typechk;
        $payforlocat->block     = $block;
        //$payforlocat->doctype   = $doctype;
        $payforlocat->accmstcod = $accmstcod;
        $payforlocat->save();
        $this->renderPartial('index', array('menucod'=>$menucod));
    }

    public function actionDatapayforlocat() {
        $payforlocat = Payforlocat::model()->findAll(array('order'=>'forcode'));
        echo CJSON::encode($payforlocat);
    }

    public function actionValidate($forcode) {
        $payforlocat = Payforlocat::model()->findByAttributes(array('forcode' => $forcode));
        if (empty($payforlocat)) {
            echo 'true';
        } else {
            echo 'false';
        }
    }
}
