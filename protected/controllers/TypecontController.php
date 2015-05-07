<?php

/**
 * Controller Typecont กำหนดข้อมูลสถานะสัญญา
 */
class TypecontController extends CController
{
    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('index', 'view'),
                'users' => array('@'),
            ),
            array('allow', 
                'actions' => array('create', 'update', 'delete', 'save', 'dataTypecont', 'validate'),
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

    public function actionUpdate($menucod,$typecode) {
        $typecont = Typecont::model()->findByAttributes(array('typecode' => $typecode));
        $this->renderPartial('update', array('menucod'=>$menucod, 'typecont'=>$typecont));  
    }

    public function actionDelete($menucod,$typecode) {
        if (!empty($typecode)) {
            Typecont::model()->deleteAllByAttributes(array('typecode'=>$typecode));
        }
    } 

    public function actionSave() {
        $menucod  = $_POST['menucod'];
        $typecode = $_POST['typecode'];
        $typedesc = $_POST['typedesc'];
        $alert    = $_POST['alert'];
        $typecont = Typecont::model()->findByAttributes(array('typecode' => $typecode));
        if (empty($typecont)) {
            $typecont = new Typecont();
        }
        $typecont->typecode = $typecode;
        $typecont->typedesc = $typedesc;
        $typecont->alert    = $alert;
        $typecont->save();
        $this->renderPartial('index', array('menucod'=>$menucod)); 
    }

    public function actionDataTypecont() {
        $typecont = Typecont::model()->findAll(array('order'=>'typecode'));
        echo CJSON::encode($typecont);
    }

    public function actionValidate($typecode) {
        $typecont = Typecont::model()->findByAttributes(array('typecode' => $typecode));
        if (empty($typecont)) {
            echo 'true';
        } else {
            echo 'false';
        }
    }
}