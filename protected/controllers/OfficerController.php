<?php

/**
 * Controller Officer รหัสพนักงาน
 */
class OfficerController extends CController
{
    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('index', 'view'),
                'users' => array('@'),
            ),
            array('allow', 
                'actions' => array('create', 'update', 'delete', 'save', 'dataOfficer', 'validate'),
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

    public function actionUpdate($menucod,$code) {
        $officer = Officer::model()->findByAttributes(array('code' => $code));
        $this->renderPartial('update', array('menucod'=>$menucod, 'officer'=>$officer));  
    }

    public function actionDelete($menucod,$code) {
        if (!empty($code)) {
            Officer::model()->deleteAllByAttributes(array('code'=>$code));
        }
    } 

    public function actionSave() {
        $menucod = $_POST['menucod'];
        $code    = $_POST['code'];
        $name    = $_POST['name'];
        $surname = $_POST['surname'];
        $addr    = $_POST['addr'];
        $telp    = $_POST['telp'];
        $status  = $_POST['status'];
        $officer = Officer::model()->findByAttributes(array('code' => $code));
        if (empty($officer)) {
            $officer = new Officer();
        }
        $officer->code    = $code;
        $officer->name    = $name;
        $officer->surname = $surname;
        $officer->addr    = $addr;
        $officer->telp    = $telp;
        $officer->status  = $status;
        $officer->save();
        $this->renderPartial('index', array('menucod'=>$menucod)); 
    }

    public function actionDataOfficer() {
        $officer = Officer::model()->findAll(array('order'=>'code'));
        echo CJSON::encode($officer);
    }

    public function actionValidate($code) {
        $officer = Officer::model()->findByAttributes(array('code' => $code));
        if (empty($officer)) {
            echo 'true';
        } else {
            echo 'false';
        }
    }
}