<?php

/**
 * Controller Setgrade กำหนดข้อมูลเกรดลูกค้า
 */
class SetgradeController extends CController
{
    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('index', 'view'),
                'users' => array('@'),
            ),
            array('allow', 
                'actions' => array('create', 'update', 'delete', 'save', 'dataSetgrade', 'validate'),
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

    public function actionUpdate($menucod,$grdcode) {
        $setgrade = Setgrade::model()->findByAttributes(array('grdcode' => $grdcode));
        $this->renderPartial('update', array('menucod'=>$menucod, 'setgrade'=>$setgrade));  
    }

    public function actionDelete($menucod,$grdcode) {
        if (!empty($grdcode)) {
            Setgrade::model()->deleteAllByAttributes(array('grdcode'=>$grdcode));
        }
    } 

    public function actionSave() {
        $menucod = $_POST['menucod'];
        $grdcode = $_POST['grdcode'];
        $grddesc = $_POST['grddesc'];
        $grdcal  = $_POST['grdcal'];
        $grdflg  = $_POST['grdflg'];
        $setgrade = Setgrade::model()->findByAttributes(array('grdcode' => $grdcode));
        if (empty($setgrade)) {
            $setgrade = new Setgrade();
        }
        $setgrade->grdcode = $grdcode;
        $setgrade->grddesc = $grddesc;
        $setgrade->grdcal  = $grdcal;
        $setgrade->grdflg  = $grdflg;
        $setgrade->save();
        $this->renderPartial('index', array('menucod'=>$menucod)); 
    }

    public function actionDataSetgrade() {
        $setgrade = Setgrade::model()->findAll(array('order'=>'grdcode'));
        echo CJSON::encode($setgrade);
    }

    public function actionValidate($grdcode) {
        $setgrade = Setgrade::model()->findByAttributes(array('grdcode' => $grdcode));
        if (empty($setgrade)) {
            echo 'true';
        } else {
            echo 'false';
        }
    }
}