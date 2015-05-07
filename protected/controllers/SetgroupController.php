<?php

/**
 * Controller Setgroup กลุ่มสินค้า
 */
class SetgroupController extends CController
{
    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('index', 'view'),
                'users' => array('@'),
            ),
            array('allow', 
                'actions' => array('create', 'update', 'delete', 'save', 'dataSetgroup', 'validate'),
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

    public function actionUpdate($menucod,$gcode) {
        $setgroup = Setgroup::model()->findByAttributes(array('gcode' => $gcode));
        $this->renderPartial('update', array('menucod'=>$menucod, 'setgroup'=>$setgroup));  
    }

    public function actionDelete($menucod,$gcode) {
        if (!empty($gcode)) {
            Setgroup::model()->deleteAllByAttributes(array('gcode'=>$gcode));
        }
    } 

    public function actionSave() {
        $menucod = $_POST['menucod'];
        $gcode = $_POST['gcode'];
        $gdesc = $_POST['gdesc'];
        $setgroup = Setgroup::model()->findByAttributes(array('gcode' => $gcode));
        if (empty($setgroup)) {
            $setgroup = new Setgroup();
        }
        $setgroup->gcode = $_POST['gcode'];
        $setgroup->gdesc = $_POST['gdesc'];
        $setgroup->save();
        $this->renderPartial('index', array('menucod'=>$menucod)); 
    }

    public function actionDataSetgroup() {
        $setgroup = Setgroup::model()->findAll(array('order'=>'gcode'));
        echo CJSON::encode($setgroup);
    }

    public function actionValidate($gcode) {
        $setgroup = Setgroup::model()->findByAttributes(array('gcode' => $gcode));
        if (empty($setgroup)) {
            echo 'true';
        } else {
            echo 'false';
        }
    }
}