<?php

/**
 * Controller ฟอร์ม และรายงาน
 */
class ReportController extends CController {

    public function actionInvlocat() {
        $mPDF1 = Yii::app()->ePdf->mpdf();
        $mPDF1 = new mPDF('th', 'A4', '0', 'THSarabun', '10', '10', '10', '10');
		$mPDF1->SetAutoFont();
        $mPDF1->WriteHTML($this->renderPartial('/report/rp.invlocat', array(), true));
        $mPDF1->Output();
    }

    public function actionSetgroup() {
        $mPDF1 = Yii::app()->ePdf->mpdf();
        $mPDF1 = new mPDF('th', 'A4', '0', 'THSarabun', '10', '10', '10', '10');
		$mPDF1->SetAutoFont();
        $mPDF1->WriteHTML($this->renderPartial('/report/rp.setgroup', array(), true));
        $mPDF1->Output();
    }

    public function actionPayfor() {
        $mPDF1 = Yii::app()->ePdf->mpdf();
        $mPDF1 = new mPDF('th', 'A4', '0', 'THSarabun', '10', '10', '10', '10');
        $mPDF1->SetAutoFont();
        $mPDF1->WriteHTML($this->renderPartial('/report/rp.payfor', array(), true));
        $mPDF1->Output();
    }

    public function actionPaytyp() {
        $mPDF1 = Yii::app()->ePdf->mpdf();
        $mPDF1 = new mPDF('th', 'A4', '0', 'THSarabun', '10', '10', '10', '10');
        $mPDF1->SetAutoFont();
        $mPDF1->WriteHTML($this->renderPartial('/report/rp.paytyp', array(), true));
        $mPDF1->Output();
    }

    public function actionSetgrade() {
        $mPDF1 = Yii::app()->ePdf->mpdf();
        $mPDF1 = new mPDF('th', 'A4', '0', 'THSarabun', '10', '10', '10', '10');
        $mPDF1->SetAutoFont();
        $mPDF1->WriteHTML($this->renderPartial('/report/rp.setgrade', array(), true));
        $mPDF1->Output();
    }

    public function actionSettumb() {
        $mPDF1 = Yii::app()->ePdf->mpdf();
        $mPDF1 = new mPDF('th', 'A4', '0', 'THSarabun', '10', '10', '10', '10');
        $mPDF1->SetAutoFont();
        $mPDF1->WriteHTML($this->renderPartial('/report/rp.settumb', array(), true));
        $mPDF1->Output();
    }

    public function actionSetaump() {
        $mPDF1 = Yii::app()->ePdf->mpdf();
        $mPDF1 = new mPDF('th', 'A4', '0', 'THSarabun', '10', '10', '10', '10');
        $mPDF1->SetAutoFont();
        $mPDF1->WriteHTML($this->renderPartial('/report/rp.setaump', array(), true));
        $mPDF1->Output();
    }

    public function actionSetprov() {
        $mPDF1 = Yii::app()->ePdf->mpdf();
        $mPDF1 = new mPDF('th', 'A4', '0', 'THSarabun', '10', '10', '10', '10');
        $mPDF1->SetAutoFont();
        $mPDF1->WriteHTML($this->renderPartial('/report/rp.setprov', array(), true));
        $mPDF1->Output();
    }

    public function actionTypecont() {
        $mPDF1 = Yii::app()->ePdf->mpdf();
        $mPDF1 = new mPDF('th', 'A4', '0', 'THSarabun', '10', '10', '10', '10');
        $mPDF1->SetAutoFont();
        $mPDF1->WriteHTML($this->renderPartial('/report/rp.typecont', array(), true));
        $mPDF1->Output();
    }

    public function actionSetzone() {
        $mPDF1 = Yii::app()->ePdf->mpdf();
        $mPDF1 = new mPDF('th', 'A4', '0', 'THSarabun', '10', '10', '10', '10');
        $mPDF1->SetAutoFont();
        $mPDF1->WriteHTML($this->renderPartial('/report/rp.setzone', array(), true));
        $mPDF1->Output();
    }

    public function actionOfficer() {
        $mPDF1 = Yii::app()->ePdf->mpdf();
        $mPDF1 = new mPDF('th', 'A4', '0', 'THSarabun', '10', '10', '10', '10');
        $mPDF1->SetAutoFont();
        $mPDF1->WriteHTML($this->renderPartial('/report/rp.officer', array(), true));
        $mPDF1->Output();
    }

    public function actionGarmast() {
        $mPDF1 = Yii::app()->ePdf->mpdf();
        $mPDF1 = new mPDF('th', 'A4', '0', 'THSarabun', '10', '10', '10', '10');
        $mPDF1->SetAutoFont();
        $mPDF1->WriteHTML($this->renderPartial('/report/rp.garmast', array(), true));
        $mPDF1->Output();
    }

}