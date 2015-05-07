<?php

/**
 * Controller Appdate กำหนด Running เอกสาร
 */
class DbconfigController extends CController
{
    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('index', 'view'),
                'users' => array('@'),
            ),
            array('allow', 
                'actions' => array('create', 'update', 'delete', 'save', 'dataDbconfig', 'dataInvlocat'),
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
        $locatcd     = $_POST['locatcd'];
        $decodedJSON = json_decode($_POST['rowdata']);
        //print_r($decodedJSON);
        /*** cast the object ***/    
        foreach($decodedJSON as $key => $value) {
            $decodedJSON[$key] = (array) $value;
        }   
        $transaction = Yii::app()->db->beginTransaction();
        try {
            Dbconfig::model()->deleteAllByAttributes(array('locatcd'=>$locatcd));
            foreach ($decodedJSON as $row) {
                $dbconfig = new Dbconfig();
                $dbconfig->locatcd = $row['locatcd'];
                $dbconfig->docno   = $row['docno'];
                $dbconfig->run     = $row['run'];
                $dbconfig->save();  
            }
            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollback();
        }
    }

    public function actionDataDbconfig($locatcd) {
        $sql = "select a.locatcd, a.docno, b.docdesc, a.run from dbconfig a, document b where a.docno = b.docno and a.locatcd ='$locatcd' order by a.docno";
        $command = Yii::app()->db->createCommand($sql);
        $dbconfig = $command->queryAll();
        echo CJSON::encode($dbconfig);
    }

    public function actionDataInvlocat() {
        $invlocat = Invlocat::model()->findAll(array('order'=>'locatcd'));
        echo CJSON::encode($invlocat);
    }

}