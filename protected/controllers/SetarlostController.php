<?php

/**
 * Controller Setarlost กำหนดข้อมูลสถานะสัญญา
 */
class SetarlostController extends CController
{
    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('index', 'view'),
                'users' => array('@'),
            ),
            array('allow',
                'actions' => array('create', 'update', 'delete', 'save', 'dataSetarlost', 'validate'),
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

    public function actionUpdate($menucod,$arlostcode) {
        $setarlost = Setarlost::model()->findByAttributes(array('arlostcode' => $arlostcode));
        $this->renderPartial('update', array('menucod'=>$menucod, 'setarlost'=>$setarlost));
    }

    public function actionDelete($menucod,$arlostcode) {
        if (!empty($arlostcode)) {
            Setarlost::model()->deleteAllByAttributes(array('arlostcode'=>$arlostcode));
        }
    }

    public function actionSave() {
        $menucod  = $_POST['menucod'];
        $arlostcode = $_POST['arlostcode'];
        $arlostdesc = $_POST['arlostdesc'];

        $setarlost = Setarlost::model()->findByAttributes(array('arlostcode' => $arlostcode));
        if (empty($setarlost)) {
            $setarlost = new Setarlost();
        }
        $setarlost->arlostcode = $arlostcode;
        $setarlost->arlostdesc = $arlostdesc;
        $setarlost->save();
        $this->renderPartial('index', array('menucod'=>$menucod));
    }

    public function actionDataSetarlost() {
        $setarlost = Setarlost::model()->findAll(array('order'=>'arlostcode'));
        echo CJSON::encode($setarlost);
    }

    public function actionValidate($arlostcode) {
        $setarlost = Setarlost::model()->findByAttributes(array('arlostcode' => $arlostcode));
        if (empty($setarlost)) {
            echo 'true';
        } else {
            echo 'false';
        }
    }
}
