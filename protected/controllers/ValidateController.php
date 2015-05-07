<?php

class ValidateController extends CController {

	public function actionFindexit($table,$field,$code) {
		$sql = "select ".$field." from ".$table." where ".$field."='".$code."' ";
        $command = Yii::app()->db->createCommand($sql);
        $model = $command->queryAll();
        if (empty($model)) { echo 'false'; } else { echo 'true'; }
    }

	public function actionFindvalue($table,$field,$code,$fieldv) {
		$sql = "select ".$fieldv." from ".$table." where ".$field."='".$code."' ";
        $command = Yii::app()->db->createCommand($sql);
        $model = $command->query();
        $model->bindColumn(1, $value);
        $model->read();
        echo $value;
    }

}
