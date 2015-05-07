<?php

/**
 * Controller Condpay กำหนดข้อมูลจังหวัด
 */
class CondpayController extends CController
{
    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('index', 'view'),
                'users' => array('@'),
            ),
            array('allow',
                'actions' => array('create', 'update', 'delete', 'save', 'dataCondpay', 'validate'),
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
        $licen_no = '1';
        $condpay = Condpay::model()->findByAttributes(array('licen_no' => $licen_no));
        $this->renderPartial('index', array('menucod'=>$menucod, 'condpay'=>$condpay));
    }

    public function actionCreate($menucod) {
        $this->renderPartial('create', array('menucod'=>$menucod));
    }

    public function actionUpdate($menucod,$licen_no) {
        $condpay = Condpay::model()->findByAttributes(array('licen_no' => $licen_no));
        $this->renderPartial('update', array('menucod'=>$menucod, 'condpay'=>$condpay));
    }

    public function actionDelete($menucod,$comp_nm) {
        if (!empty($comp_nm)) {
            Condpay::model()->deleteAllByAttributes(array('comp_nm'=>$comp_nm));
        }
    }

    public function actionSave() {
        $menucod  = $_POST['menucod'];
        $licen_no = $_POST['licen_no'];
        $comp_nm = $_POST['comp_nm'];
        $comp_adr1 = $_POST['comp_adr1'];
        $comp_adr2 = $_POST['comp_adr2'];
        $telp = $_POST['telp'];
        $taxid = $_POST['taxid'];
        $free_rate = $_POST['free_rate'];
        $int_rate = $_POST['int_rate'];
        $intadd_rate = $_POST['intadd_rate'];
        $delay_day = $_POST['delay_day'];
        $ratefee = $_POST['ratefee'];
        $rateprofit = $_POST['rateprofit'];
        $timeout = $_POST['timeout'];
        $colamt = $_POST['colamt'];
        $vatrate = $_POST['vatrate'];
        $closetime = $_POST['closetime'];
        $calint = $_POST['calint'];
        $caldsc = $_POST['caldsc'];
        $inform = $_POST['inform'];


        $condpay = Condpay::model()->findByAttributes(array('licen_no' => $licen_no));
        if (empty($condpay)) {
            $condpay = new Condpay();
        }
        $condpay->comp_nm = $comp_nm;
        $condpay->comp_adr1 = $comp_adr1;
        $condpay->comp_adr2 = $comp_adr2;
        $condpay->telp = $telp;
        $condpay->taxid = $taxid;
        $condpay->free_rate = $free_rate;
        $condpay->int_rate = $int_rate;
        $condpay->intadd_rate = $intadd_rate;
        $condpay->delay_day = $delay_day;
        $condpay->ratefee = $ratefee;
        $condpay->rateprofit = $rateprofit;
        $condpay->timeout = $timeout;
        $condpay->colamt = $colamt;
        $condpay->vatrate = $vatrate;
        $condpay->closetime = $closetime;
        $condpay->calint = $calint;
        $condpay->caldsc = $caldsc;

        //write path
        $strFileName = "protected/views/condpay/memo.txt";
        //save path to db
        $condpay->inform = $strFileName;
        //save text to memo.txt
        $objFopen = fopen($strFileName, 'w');
        $strText1 = $inform."\r\n";
        fwrite($objFopen, $strText1);
        fclose($objFopen);

        $condpay->save();
        $this->renderPartial('index', array('menucod'=>$menucod, 'condpay'=>$condpay));
    }

    public function actionDataCondpay() {
        $condpay = Condpay::model()->findAll(array('order'=>'comp_nm'));
        echo CJSON::encode($condpay);
    }

    public function actionValidate($comp_nm) {
        $condpay = Condpay::model()->findByAttributes(array('comp_nm' => $comp_nm));
        if (empty($condpay)) {
            echo 'true';
        } else {
            echo 'false';
        }
    }
}
