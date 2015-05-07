<?php

class InvlocatController extends Controller {

    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('index', 'view'),
                'users' => array('@'),
            ),
            array('allow',
                'actions' => array('create', 'update', 'delete', 'save', 'DataInvlocat', 'DataBooklocat', 'Addbookcode', 'Delbookcode', 'Editbookcode', 'Getbookcode', 'Getbookcode2', 'Validbooklocat', 'Validatedata', 'TestSec','loadModelbooklocat'),
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
        unset(Yii::app()->session['databooklc']);
		unset(Yii::app()->session['databooklc_chk']);
        $this->renderPartial('index', array('menucod'=>$menucod));
    }

    public function actionCreate($menucod) {
        $this->renderPartial('create', array('menucod'=>$menucod));
    }

    public function actionView($menucod,$locatcd) {
        //$locatcd = $_POST['locatcd'];
        if (isset($locatcd)) {
            $this->renderPartial('view', array('invlocat' => $this->loadModel($locatcd),'menucod'=>$menucod));
        }
    }

	public function actionUpdate($menucod,$locatcd) {

		//$locatcd = $_POST['locatcd'];
        if (isset($locatcd)) {
            $this->renderPartial('update', array('invlocat' => $this->loadModel($locatcd),'menucod'=>$menucod));
        }
    }

    public function actionDelete() {
		$locatcd = $_POST['locatcd'];
        $menucod = $_POST['menucod'];
        if (!empty($locatcd)) {//ตรวจสอบว่าได้ส่งค่ามาให้ลบหรือไม่
            //Invlocat::model()->deleteByPk($locatcd);
            //echo $locatcd;
			Invlocat::model()->deleteAllByAttributes(array('locatcd'=>$locatcd));
			//$this->renderPartial('index', array('menucod'=>$menucod));
		}
    }

    public function actionDataInvlocat() {
        $invlocat = Invlocat::model()->findAll();
        echo CJSON::encode($invlocat);
    }

    public function actionDataBooklocat($locatcd){
        // $criteria = new CDbCriteria();
		// $criteria->select = "bookcode";
        // $criteria->condition = "locatcd =:locatcd";
        // $criteria->params = array(':locatcd' => $locatcd);
        // $booklocat = Booklocat::model()->findAll($criteria);
		//$booklocat = Booklocat::model()->findAllbySql("select bookcode from booklocat where locatcd='$locatcd'");
		$sql = "select bookcode,bookdesc,balance,datebalance,'view' as status,bookcode as bookcode_chk from booklocat where locatcd='$locatcd' order by locatcd";
        $command = Yii::app()->db->createCommand($sql);
        $booklocat = $command->queryAll();
		if(!empty($booklocat)){
			Yii::app()->session['databooklc'] = $booklocat;
			Yii::app()->session['databooklc_chk'] = $booklocat;
		}
        echo CJSON::encode($booklocat);
		//print_r($booklocat);
    }

	public function actionValidatedata(){
		$data1 = $_POST["data1"];
		$data2 = $_POST["data2"];
		$frmTable = $_POST["frmTable"];
		$frmField = $_POST["frmField"];
		$status = $_POST["status"];
        $rowindex = $_POST["rowindex"];

        if($frmTable=='booklocat'){
            $data1 = $this ->loadModelbooklocat($data2);
            //$data1 = $idno_booklocat ->idno;
        }
        //$booklocat->locatcd = $_POST['locatcd'];
		if((isset($_POST['data1'])) && (isset($_POST['data2']))){
            $z = 0;
            $y = 0;
            if (Yii::app()->session['databooklc'] == null) {
                $databooklc = array();
            } else {
                $databooklc = Yii::app()->session['databooklc'];
            }
            // foreach ($databooklc as $row) {
            //     if ($data2 == $row['bookcode'] && $data1 != $rowindex) {
            //        $z++;
            //     }
            // }
            $size = count($databooklc);
            for ($i=0; $i<$size; $i++) {
                if (isset($databooklc[$i])) {
                    //print_r($data2." / ".$databooklc[$i]["bookcode"]." :::: ".$i." / ".$rowindex);
                    //echo "<br/>";
                    if ($data2 == $databooklc[$i]["bookcode"] && $i != $rowindex) {
                        $z++;
                        //echo "z : ".$z;
                    }
                }
            }
            // $size_chk = count($databooklc_chk);
            // for ($j=0; $j < $size_chk; $j++) {
            //     if (isset($databooklc_chk[$j])) {
            //         if ($data2 == $databooklc_chk[$j]["bookcode_chk"] && $j != $rowindex) {
            //             $y++;
            //         }
            //     }
            // }
            // echo $j;
            if($z==0){
    			$sql = "select * from $frmTable where idno<>$data1 and $frmField='$data2'";
                //print_r($sql);
                //echo "<br/>";
    			$command = Yii::app()->db->createCommand($sql);
    			$booklocat = $command->queryAll();

    			if(empty($booklocat)){
                    echo "true";
    			}else{
    				echo "false3";
    			}
            }else{
                echo "false2";
            }
		}else{
			echo "false1";
		}
        //echo $rowindex;
	}

    public function actionTestSec(){
        $transaction = Yii::app()->db->beginTransaction();
        try{

            $sql = "delete from booklocat where bookcode ='T1-002'";
            $command = Yii::app()->db->createCommand($sql);
            $booklocat = $command->query();

            $sql = "INSERT INTO booklocat (locatcd, bookcode, bookdesc) VALUES ('TEST1', 'T1-002', 'T1-0022')";
            $command = Yii::app()->db->createCommand($sql);
            $booklocat = $command->query();

            $transaction->commit();
        }
        catch (Exception $e) {
            $transaction->rollback();
            //Yii::log('Unable to save order: '.$e->getMessage(), \CLogger::LEVEL_ERROR, 'core.models.store.Order');
            echo $e;
        }

    }

    public function actionSave() {
		$chkstatus = $_POST['chkstatus'];
        $menucod = $_POST['menucod'];
		if($chkstatus == 'insert'){
			$invlocat = new Invlocat();
		}else if($chkstatus =='update'){
			$invlocat = $this->loadModel($_POST['locatcd_id']);
		}
		$invlocat->locatcd    = $_POST['locatcd'];
		$invlocat->locatnm    = $_POST['locatnm'];
		$invlocat->locaddr1   = $_POST['locaddr1'];
		$invlocat->locaddr2   = $_POST['locaddr2'];
		$invlocat->telp       = $_POST['telp'];
		$invlocat->shortl     = $_POST['shortl'];
		$invlocat->aumpcod    = $_POST['aumpcod'];
		$invlocat->provcod    = $_POST['provcod'];
		$invlocat->postcod    = $_POST['postcod'];
		$invlocat->accmstcod  = $_POST['accmstcod'];
		$invlocat->accmstcod2 = $_POST['accmstcod2'];

        if (Yii::app()->session['databooklc'] == null) {
            $databooklc = array();
        } else {
            $databooklc = Yii::app()->session['databooklc'];
        }
		if (Yii::app()->session['databooklc_chk'] == null) {
			$databooklc_chk = array();
        } else {
			$databooklc_chk = Yii::app()->session['databooklc_chk'];
        }

		//$arrdiff = array_udiff($databooklc_chk,$databooklc,create_function('$a,$b','if ($a===$b){ return 0; } return ($a>$b)?1:-1;'));
		//$newData = array_udiff($data,$attributeNames,create_function('$x,$y','return !is_string($x) || !is_string($y) ? -1 : strcmp($x,$y);'));
		//print_r($arrdiff);
		//echo "<br/>---------<br/>";

        $transaction = Yii::app()->db->beginTransaction();
        try {
            if ($invlocat->save()) {
                foreach ($databooklc_chk as $row){
					$chk = Booklocat::model()->findByAttributes(array('bookcode' => $row['bookcode_chk']));

                    //print_r($chk." vs ".$row['bookcode_chk']);

					if((!empty($chk)) && ($row['status'] === 'delete')){
						$booklocat = Booklocat::model()->findByAttributes(array('bookcode' => $row['bookcode_chk']));
						$booklocat->delete();
					}else if((!empty($chk)) && ($row['status'] === 'update')){
						$booklocat = Booklocat::model()->findByAttributes(array('bookcode' => $row['bookcode_chk']));
						$booklocat->locatcd = $_POST['locatcd'];
						$booklocat->bookcode = $row['bookcode'];
						$booklocat->bookdesc = $row['bookdesc'];
						$booklocat->balance = $row['balance'];
						$booklocat->datebalance = Yii::app()->CMyClass->convertDate($row['datebalance']);
						$booklocat->save();
					}else if((empty($chk)) && ($row['status'] === 'insert' || $row['status'] === 'update')) {
						$booklocat = new Booklocat();
						$booklocat->locatcd = $_POST['locatcd'];
						$booklocat->bookcode = $row['bookcode'];
						$booklocat->bookdesc = $row['bookdesc'];
						$booklocat->balance = $row['balance'];
						$booklocat->datebalance = Yii::app()->CMyClass->convertDate($row['datebalance']);
						$booklocat->save();
					}
                }
                $transaction->commit();
                unset(Yii::app()->session['databooklc']);
				unset(Yii::app()->session['databooklc_chk']);
                //$this->renderPartial('view', array('invlocat' => $invlocat->locatcd));
            }
        } catch (Exception $e) {
            $transaction->rollback();
        }
        $this->renderPartial('index', array('menucod'=>$menucod));
    }

    public function actionAddbookcode() {
        $z = 0;
        $bookcode = $_POST['bookcode'];
        $bookdesc = $_POST['bookdesc'];
        if ($_POST['balance'] == '') {
            $balance = 0;
        } else {
            $balance = $_POST['balance'];
        }
        $datebalance = $_POST['datebalance'];
		$status = $_POST['status'];
        $bookcode_chk = $_POST['bookcode'];
        // $balance = '';
        // $datebalance = '';
        // $status = '';
        // $bookcode_chk = '';

        if (!empty($bookcode)) {
            $chk = Booklocat::model()->findByAttributes(array('bookcode' => $bookcode));
            if (Yii::app()->session['databooklc'] == null) {
                $databooklc = array();
                $databooklc_chk = array();
            } else {
                $databooklc = Yii::app()->session['databooklc'];
                $databooklc_chk = Yii::app()->session['databooklc_chk'];
            }
            foreach ($databooklc as $row) {
                if ($bookcode == $row['bookcode']) {
                   $z++;
                }
            }
            // for session bookcode_chk
            // if (Yii::app()->session['databooklc_chk'] == null) {
            //     $databooklc_chk = array();
            // }else {
			// 	$databooklc = Yii::app()->session['databooklc_chk'];
            // }
            // foreach ($databooklc_chk as $row) {
            //     if ($bookcode == $row['bookcode']) {
            //        $z++;
            //     }
            // }


            if (empty($chk) && ($z == 0)){
                $session = array('bookcode' => $bookcode,
                    'bookdesc' => $bookdesc,
                    'balance' => $balance,
                    'datebalance' => $datebalance,
					'status' => $status,
					'bookcode_chk' => $bookcode_chk);

                $size = count($databooklc);
                $databooklc[$size] = $session;
                $size_chk = count($databooklc_chk);
                $databooklc_chk[$size_chk] = $session;
                Yii::app()->session['databooklc'] = $databooklc;
				Yii::app()->session['databooklc_chk'] = $databooklc_chk;
                echo 'true';
            } else {
                echo 'false';
            }
        }
    }

    public function actionDelbookcode() {
        $rowindex = $_POST['rowindex'];
		$status = $_POST['status'];
        $newdatabooklc = array();
        if (Yii::app()->session['databooklc'] == null) {
            $databooklc = array();
        } else {
            $databooklc = Yii::app()->session['databooklc'];
        }

		if (Yii::app()->session['databooklc_chk'] == null) {
            $databooklc_chk = array();
        } else {
			$databooklc_chk = Yii::app()->session['databooklc_chk'];

			$databooklc_chk[$rowindex]['status'] = 'delete';
			Yii::app()->session['databooklc_chk'] = $databooklc_chk;
        }

        $size = count($databooklc);
        unset($databooklc[$rowindex]);
        $j = 0;
        for ($i=0; $i < $size; $i++) {
            if (isset($databooklc[$i])) {
                $newdatabooklc[$j] = $databooklc[$i];
                $j++;
            }
        }
        Yii::app()->session['databooklc'] = $newdatabooklc;
        echo 'true';
    }

    public function actionEditbookcode() {
        $rowindex = $_POST['rowindex'];
        $bookcode = $_POST['bookcode'];
        $bookdesc = $_POST['bookdesc'];
        if ($_POST['balance'] == '') {
            $balance = 0;
        } else {
            $balance = $_POST['balance'];
        }
        $datebalance = $_POST['datebalance'];
		$status = $_POST['status'];
		$bookcode_chk = $_POST['bookcode_chk'];

        if (Yii::app()->session['databooklc'] == null) {
            $databooklc = array();
        } else {
            $databooklc = Yii::app()->session['databooklc'];
			//$databooklc_chk = Yii::app()->session['databooklc_chk'];
        }
        if (Yii::app()->session['databooklc_chk'] == null) {
            $databooklc_chk = array();
        } else {
			$databooklc_chk = Yii::app()->session['databooklc_chk'];
        }
        $databooklc[$rowindex]['bookcode']    = $bookcode;
        $databooklc[$rowindex]['bookdesc']    = $bookdesc;
        $databooklc[$rowindex]['balance']     = $balance;
        $databooklc[$rowindex]['datebalance'] = $datebalance;
		$databooklc[$rowindex]['status'] = $status;
		$databooklc[$rowindex]['bookcode_chk'] = $bookcode_chk;
		Yii::app()->session['databooklc'] = $databooklc;

		$databooklc_chk[$rowindex]['bookcode']    = $bookcode;
        $databooklc_chk[$rowindex]['bookdesc']    = $bookdesc;
        $databooklc_chk[$rowindex]['balance']     = $balance;
        $databooklc_chk[$rowindex]['datebalance'] = $datebalance;
		$databooklc_chk[$rowindex]['status'] = $status;
		$databooklc_chk[$rowindex]['bookcode_chk'] = $bookcode_chk;
		Yii::app()->session['databooklc_chk'] = $databooklc_chk;

        echo 'true';
    }

    public function actionGetbookcode() {
        if (Yii::app()->session['databooklc'] == null) {
            $databooklc = array();
        } else {
            $databooklc = Yii::app()->session['databooklc'];
        }
		if (Yii::app()->session['databooklc_chk'] == null) {
			$databooklc_chk = array();
        } else {
			$databooklc_chk = Yii::app()->session['databooklc_chk'];
        }
        echo CJSON::encode($databooklc);
		//echo "<br/>";
		//print_r($databooklc_chk);
    }

	public function actionGetbookcode2() {
		if (Yii::app()->session['databooklc'] == null) {
            $databooklc = array();
        } else {
            $databooklc = Yii::app()->session['databooklc'];
        }
		if (Yii::app()->session['databooklc_chk'] == null) {
			$databooklc_chk = array();
        } else {
			$databooklc_chk = Yii::app()->session['databooklc_chk'];
        }
		$arrdiff = array_udiff($databooklc_chk,$databooklc,create_function('$a,$b','if ($a===$b){ return 0; } return ($a>$b)?1:-1;'));

		echo CJSON::encode($databooklc);
		echo "<br/>--------------<br/>";
        echo CJSON::encode($databooklc_chk);
		echo "<br/>--------------<br/>";
        echo CJSON::encode($arrdiff);
		//echo "<br/>";
		//print_r($databooklc_chk);
    }

    // Uncomment the following methods and override them if needed

    public function filters() {
        // return the filter configuration for this controller, e.g.:
        return array(
            'accessControl',
            'postOnly + delete',
        );
    }

    //โหลดข้อมูลสาขา
    public function loadModel($locatcd) {
        $model = Invlocat::model()->findByPk($locatcd);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    //โหลดข้อมูล booklocat
    public function loadModelbooklocat($bookcode) {
        //$model = Booklocat::model()->findByAttributes(array('bookcode' => $bookcode));
        $sql = "select idno from booklocat where bookcode='$bookcode'";
        //print_r($sql);
        $command = Yii::app()->db->createCommand($sql);
        $booklocat = $command->query();
        $booklocat->bindColumn(1, $idno);
        if($idno==''){
            $idno=0;
        }
        return $idno;
    }

    //ฟังก์ชั่นตรวจสอบค่าที่ส่งมา
    function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] == 'invlocat') {
            echo TbActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
