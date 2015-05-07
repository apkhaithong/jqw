<?php

/**
 * Controller Setargroup กำหนดข้อมูลสถานะสัญญา
 */
class SetargroupController extends CController
{
    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('index', 'view'),
                'users' => array('@'),
            ),
            array('allow',
                'actions' => array('create', 'update', 'delete', 'save', 'dataSetargroup', 'validate'),
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

    public function actionUpdate($menucod,$argroupcode) {
        $setargroup = Setargroup::model()->findByAttributes(array('argroupcode' => $argroupcode));
        $this->renderPartial('update', array('menucod'=>$menucod, 'setargroup'=>$setargroup));
    }

    public function actionDelete($menucod,$argroupcode) {
        if (!empty($argroupcode)) {
            Setargroup::model()->deleteAllByAttributes(array('argroupcode'=>$argroupcode));
        }
    }

    public function actionSave() {
        $menucod  = $_POST['menucod'];
        $argroupcode = $_POST['argroupcode'];
        $argroupdesc = $_POST['argroupdesc'];

        $setargroup = Setargroup::model()->findByAttributes(array('argroupcode' => $argroupcode));
        if (empty($setargroup)) {
            $setargroup = new Setargroup();
        }
        $setargroup->argroupcode = $argroupcode;
        $setargroup->argroupdesc = $argroupdesc;
        $setargroup->save();
        $this->renderPartial('index', array('menucod'=>$menucod));
    }

    public function actionDataSetargroup() {
        $setargroup = Setargroup::model()->findAll(array('order'=>'argroupcode'));
        echo CJSON::encode($setargroup);
    }

    public function actionValidate($argroupcode) {
        $setargroup = Setargroup::model()->findByAttributes(array('argroupcode' => $argroupcode));
        if (empty($setargroup)) {
            echo 'true';
        } else {
            echo 'false';
        }
    }
}
