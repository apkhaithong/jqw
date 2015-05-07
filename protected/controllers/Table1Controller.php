<?php

/**
 * Controller Table1 กำหนดข้อมูลส่วนลดปิดบัญชี
 */
class Table1Controller extends CController
{
    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('index', 'view'),
                'users' => array('@'),
            ),
            array('allow', 
                'actions' => array('create', 'update', 'delete', 'save', 'dataTable1', 'validate'),
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

    public function actionUpdate($menucod,$nopay) {
        $table1 = Table1::model()->findByAttributes(array('nopay' => $nopay));
        $this->renderPartial('update', array('menucod'=>$menucod, 'Table1'=>$table1));  
    }

    public function actionDelete($menucod,$nopay) {
        if (!empty($nopay)) {
            Table1::model()->deleteAllByAttributes(array('nopay'=>$nopay));
        }
    } 

    public function actionSave() {
        $decodedJSON = json_decode($_POST['rowdata']);
        //print_r($decodedJSON);
        /*** cast the object ***/    
        foreach($decodedJSON as $key => $value) {
            $decodedJSON[$key] = (array) $value;
        }   
        $transaction = Yii::app()->db->beginTransaction();
        try {
            Table1::model()->deleteAll();
            foreach ($decodedJSON as $row) {
                if ($row['nopay'] > 0) {
                    $table1 = new Table1();
                    $table1->nopay  = $row['nopay'];
                    $table1->perd60 = $row['perd60'];
                    $table1->perd54 = $row['perd54'];
                    $table1->perd48 = $row['perd48'];
                    $table1->perd42 = $row['perd42'];
                    $table1->perd36 = $row['perd36'];
                    $table1->perd30 = $row['perd30'];
                    $table1->perd24 = $row['perd24'];
                    $table1->perd18 = $row['perd18'];
                    $table1->perd12 = $row['perd12'];
                    $table1->perd10 = $row['perd10'];
                    $table1->save(); 
                }  
            }
            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollback();
        }
    }

    public function actionDataTable1() {
        $table1 = Table1::model()->findAll(array('order'=>'nopay'));
        echo CJSON::encode($table1);
    }

    public function actionValidate($nopay) {
        $table1 = Table1::model()->findByAttributes(array('nopay' => $nopay));
        if (empty($table1)) {
            echo 'true';
        } else {
            echo 'false';
        }
    }
}