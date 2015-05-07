<?php

class SearchController extends Controller {

    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('searchtext'),
                'users' => array('@'),
            ),
            array('deny',
                'users'=>array('*'),
            ),            
        );
    }
    
    public function actionIndex() {
        $model = array();
        $show = $_GET['show'];
        $returnid = $_GET['returnid'];
        $this->renderPartial('index', array(
            'model' => $model,
            'show' => $show,
            'returnid' => $returnid,
        ));
    }
    
    public function actionSearchtext() {
        $sqltxt = $_POST['sqltxt'];
        $param1 = "%".strtoupper($_POST['param1'])."%";
        $oDbConnection = Yii::app()->db;
        $oCommand = $oDbConnection->createCommand($sqltxt);
        $oCommand->bindParam(':param1', $param1, PDO::PARAM_STR);
        $oCDbDataReader = $oCommand->queryAll();
        echo CJSON::encode($oCDbDataReader);
    }

}
