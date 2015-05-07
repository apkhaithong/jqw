<?php

/**
 * Controller Setoccup กำหนดข้อมูลสถานะสัญญา
 */
class SetoccupController extends CController
{
    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('index', 'view'),
                'users' => array('@'),
            ),
            array('allow',
                'actions' => array('create', 'update', 'delete', 'save', 'dataSetoccup', 'validate'),
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

    public function actionUpdate($menucod,$occupcode) {
        $setoccup = Setoccup::model()->findByAttributes(array('occupcode' => $occupcode));
        $this->renderPartial('update', array('menucod'=>$menucod, 'setoccup'=>$setoccup));
    }

    public function actionDelete($menucod,$occupcode) {
        if (!empty($occupcode)) {
            Setoccup::model()->deleteAllByAttributes(array('occupcode'=>$occupcode));
        }
    }

    public function actionSave() {
        $menucod  = $_POST['menucod'];
        $occupcode = $_POST['occupcode'];
        $occupdesc = $_POST['occupdesc'];

        $setoccup = Setoccup::model()->findByAttributes(array('occupcode' => $occupcode));
        if (empty($setoccup)) {
            $setoccup = new Setoccup();
        }
        $setoccup->occupcode = $occupcode;
        $setoccup->occupdesc = $occupdesc;
        $setoccup->save();
        $this->renderPartial('index', array('menucod'=>$menucod));
    }

    public function actionDataSetoccup() {
        $setoccup = Setoccup::model()->findAll(array('order'=>'occupcode'));
        echo CJSON::encode($setoccup);
    }

    public function actionValidate($occupcode) {
        $setoccup = Setoccup::model()->findByAttributes(array('occupcode' => $occupcode));
        if (empty($setoccup)) {
            echo 'true';
        } else {
            echo 'false';
        }
    }
}
