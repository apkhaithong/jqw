<?php

/**
 * Controller Setlocatamt กำหนดข้อมูลส่วนลดปิดบัญชี
 */
class SetlocatamtController extends CController
{
    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('index', 'view'),
                'users' => array('@'),
            ),
            array('allow', 
                'actions' => array('save', 'dataSetlocatamt'),
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

    public function actionSave() {
        $decodedJSON = json_decode($_POST['rowdata']);
        print_r($decodedJSON);
        /*** cast the object ***/    
        foreach($decodedJSON as $key => $value) {
            $decodedJSON[$key] = (array) $value;
        }   
        $transaction = Yii::app()->db->beginTransaction();
        try {
            foreach ($decodedJSON as $row) {
                $setlocatamt = Invlocat::model()->findByAttributes(array('locatcd' => $row['locatcd']));
                $setlocatamt->balance = $row['balance'];
                if (!empty($row['bldate'])) {
                    $setlocatamt->bldate  = Yii::app()->CMyClass->convertDate($row['bldate']);
                }
                $setlocatamt->save();  
            }
            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollback();
        }
    }

    public function actionDataSetlocatamt() {
        $setlocatamt = Invlocat::model()->findAll(array('order'=>'locatcd'));
        echo CJSON::encode($setlocatamt);
    }

}