<?php
	session_start();
	require("../../connect.php");
	require("../../checklogin.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.:: ระบบการรับชำระเงิน ::.</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style></head>
<body>
<form name="frm_forcash">
  <?php
	require("../../function.inc.php");
	$strSelect = "SRHACTV,KEYDISC,CHGLOCAT,RPRN,BPRN,EDITPRN";
	$strTable = "PASSWRD";
	$strCondition = "USERID = '".trim($_SESSION["_userid"])."'";
	$objSelect = fncSelectRecord2($strSelect,$strTable,$strCondition);
	//echo $strCondition;
		if(!$objSelect){
			echo "Record not found. for passwrd. <br>";
			echo $strCondition."<br/>";
			echo "userid : ".$_SESSION["_userid"]."<br/>";
			$ErrorCount++;
		}else{
			$chglocat 		= trim(enc2($objSelect["CHGLOCAT"]));
			$keydata		= trim(enc2($objSelect["SRHACTV"]));//บันทึกย้อนหลัง
			$keydisct		= trim(enc2($objSelect["KEYDISC"]));
			$backprint		= trim(enc2($objSelect["RPRN"]));
			$savereceive	= trim(enc2($objSelect["BPRN"]));
			$editprint		= trim(enc2($objSelect["EDITPRN"]));
			//echo $strCondition."chglocat : ".$chglocat."<br/>";
		}
	//////////////////////////////////////////////////////
	$strSelect = "R_BILLNO,R_TMPBILL";
	$strTable = "DBCONFIG";
	$strCondition = "LOCATCD = '".trim($_SESSION["_locat"])."'";
	$objSelect = fncSelectRecord2($strSelect,$strTable,$strCondition);
		if(!$objSelect){
			//echo "Record not found. for dbconfig. <br/>";
			$run_billno 		= "";
			$run_tmpbill 		= "";
		}else{
			$run_billno		= trim($objSelect["R_BILLNO"]);
			$run_tmpbill	= trim($objSelect["R_TMPBILL"]);
		}
	/////////////////////////////////////////////
	$strSelect = "M_ACCESS,M_EDIT,M_INSERT,M_DELETE";
	$strTable = "MENUTRN";
	$strCondition = "USERID = '".trim($_SESSION["_userid"])."' AND MENUCODE = 'FIN01'";
	$objSelect = fncSelectRecord2($strSelect,$strTable,$strCondition);
		if(!$objSelect){
			//echo "55";
			if($_SESSION["_userid"] == "ADMINISTRATOR"){
				$edit = "T";
				$insert = "T";
				$delete = "T";
				$access = "T";
			}
		}else{
			$edit 		= trim($objSelect["M_EDIT"]);
			$insert		= trim($objSelect["M_INSERT"]);
			$delete		= trim($objSelect["M_DELETE"]);
			$access		= trim($objSelect["M_ACCESS"]);
			//echo $strCondition."chglocat : ".$chglocat."<br/>";
		}
	/////////////////////////////////////////////////////
	if($_SESSION["_status"] == "Admin" || $_SESSION["_status"] == "User" || $_SESSION["_status"] == "Guest"){
		if($access == "T"){
?>
  <div id="frmMain" align="center">
    <table width="600" border="0" cellspacing="2" cellpadding="0">
      <tr>
        <td><fieldset class="field_set">
            <legend><span class="f_form">&nbsp;&nbsp;&nbsp;&nbsp;ระบบการรับชำระเงิน</span></legend>
            <table width="600" border="0" cellspacing="2" cellpadding="0">
              <tr>
                <td width="107" align="right" valign="baseline"><span id="tmbilldt" class="f_form">วันที่รับชำระ&nbsp;:&nbsp;</span></td>
                <td width="190" align="left" valign="baseline"><input type="text" name="txt_day" id="txt_day" style="width: 25px; border-width: 1px 0 1px 1px; text-align:center" maxlength="2" onkeyup="clickDate('day',this.value);" onblur="chkDate('day',this.value);" value="<?php echo date('d');?>" /><input type="text" value="/" style="width: 5px; border-width: 1px 0 1px 0;" disabled="disabled" /><input type="text" name="txt_month" id="txt_month" style="width: 25px; border-width: 1px 0 1px 0; text-align:center" maxlength="2" onkeyup="clickDate('month',this.value);" onblur="chkDate('month',this.value);" value="<?php echo date('m');?>" /><input value="/" type="text" style="width: 5px; border-width: 1px 0 1px 0;" disabled="disabled" /><input type="text" name="txt_year" id="txt_year" style="width: 40px; border-width: 1px 1px 1px 0; text-align:center" maxlength="4" onblur="OnblurSearch_paid_back(this.id,this.value);" value="<?php echo date('Y');?>" /><input type="hidden" name="txt_tmbilldt" id="txt_tmbilldt" maxlength="8" value="<?=date('d/m/Y');?>" /></td>
                <td align="left" valign="baseline" colspan="2"><span id="txt_tmbilldtnm" class="f_form"></span>
                  <input type="hidden" name="chktmbilldt" id="chktmbilldt" />
                  <input type="hidden" name="rate_dt" id="rate_dt" value="<?php echo $rate_dt;?>" /></td>
              </tr>
              <tr>
                <td align="right" valign="baseline"><span id="locat" class="f_form">สาขาที่รับ&nbsp;:&nbsp;</span></td>
                <td align="left" valign="baseline"><input type="text" name="txt_locat" id="txt_locat" value="<?php echo trim($_SESSION["_locat"]);?>" <?php if($chglocat != "Y"){ ?> readonly="readonly"  <?php }else{ ?> onblur="OnblurSearch_forcash(this.id,this.value)" <?php } ?> />
                  
                  <span id="imgFindLocat"><?php if($chglocat=="Y"){ ?><a href="JavaScript:ShowSearch_forcash('showlocat');"><img src="images/search-icon.gif" border="0"/></a><?php } ?></span>
                  </td>
                <td align="left" valign="baseline" colspan="2"><span id="loadspan_locat" style="display:none;"><img src="../../images/circle_load.gif" border="0" /></span>&nbsp;<span id="txt_locatnm" class="f_form">
                  <?php echo ($_SESSION["_locatnm"]);?>
                  </span>
                  <input type="hidden" name="chklocat" id="chklocat" /></td>
              </tr>
              <tr>
                <td align="right" valign="baseline"><span id="tmbill" class="f_form">เลขที่ใบรับชั่วคราว&nbsp;:&nbsp;</span></td>
                <td align="left" valign="baseline"><input type="text" name="txt_tmbill" id="txt_tmbill" <?php if($run_tmpbill == "Y"){ ?> disabled="disabled" <?php } ?> onblur="OnblurSearch_forcash(this.id,this.value);" maxlength="20" /></td>
                <td align="left" valign="baseline" colspan="2"><span id="loadspan_tmbill" style="display:none;"><img src="../../images/circle_load.gif" border="0" /></span><span id="txt_tmbillnm" class="f_form">
                  <?php if($run_tmpbill == "Y"){ ?>
                  รันโดยอัตโนมัติ
                  <?php }else{ ?>
                  <font color="#FF0000">กรุณาระบุเลขที่ใบรับชั่วคราว</font>
                  <?php } ?>
                  </span>
                  <input type="hidden" name="chktmbill" id="chktmbill" />
                  <input type="hidden" name="chkrun_tmbill" id="chkrun_tmbill" value="<?php echo $run_tmpbill;?>" />
                  <input type="hidden" name="txt_canflag" id="txt_canflag" />
                  <input type="hidden" name="txt_xidno" id="txt_xidno" />
                  <input type="hidden" name="txt_flag" id="txt_flag" />
                  <input type="hidden" name="chkstat_onblurtmbill" id="chkstat_onblurtmbill" value="new" /></td>
              </tr>
              <tr>
                <td align="right" valign="baseline"><span id="billno" class="f_form">เลขที่ใบเสร็จ&nbsp;:&nbsp;</span></td>
                <td align="left" valign="baseline"><input type="text" name="txt_billno" id="txt_billno" <?php if($run_billno == "Y"){ ?> disabled="disabled" <?php } ?> onblur="OnblurSearch_forcash(this.id,this.value);" maxlength="20" /></td>
                <td align="left" valign="baseline" colspan="2"><span id="loadspan_billno" style="display:none;"><img src="../../images/circle_load.gif" border="0" /></span><span id="txt_billnonm" class="f_form">
                  <?php if($run_billno == "Y"){ ?>
                  รันโดยอัตโนมัติ
                  <?php }else{ ?>
                  <font color="#FF0000">กรุณาระบุเลขที่ใบเสร็จ</font>
                  <?php } ?>
                  </span>
                  <input type="hidden" name="chkbillno" id="chkbillno" />
                  <input type="hidden" name="chkrun_billno" id="chkrun_billno" value="<?php echo $run_billno;?>" />
                  <input type="hidden" name="chkstat_onblurbillno" id="chkstat_onblurbillno" value="new" /></td>
              </tr>
              <tr>
                <td align="right" valign="baseline"><span id="paytype" class="f_form">ชำระโดย&nbsp;:&nbsp;</span></td>
                <td align="left" valign="baseline"><select name="txt_paytype" id="txt_paytype" onchange="onChange_forcash(this.id,this.value);" style="width:146px;">
                    <?php
					$strSQL = "SELECT PAYCODE,PAYDESC FROM PAYTYP ORDER BY PAYCODE";
					$objExec = odbc_exec($conn,$strSQL) or die ("Error Execute [".$strSQL."]");
					while($result = odbc_fetch_array($objExec)){
				?>
                    <option value="<?php echo trim(enc2($result["PAYCODE"]))."|".trim(enc2($result["PAYDESC"]));?>" <?php if(trim(enc2($result["PAYCODE"])) == "01"){ ?> selected="selected" <?php } ?>>
                    <?php echo trim(enc2($result["PAYCODE"]))." : ".trim(enc2($result["PAYDESC"]));?>
                    </option>
                    <?php
					}
				?>
                  </select></td>
                <td align="left" valign="baseline" colspan="2"><span class="f_form" id="txt_paytypenm">เงินสด</span></td>
              </tr>
              <tr id="for00" style="display:none;">
                <td align="right" valign="baseline"><span id="resvno" class="f_form">เลขที่ใบจอง&nbsp;:&nbsp;</span></td>
                <td align="left" valign="baseline"><input type="text" name="txt_resvno" id="txt_resvno" onblur="OnblurSearch_forcash(this.id,this.value)" />
                  <a href="JavaScript:ShowSearch_forcash('showresvno');"><img src="images/search-icon.gif" border="0"/></a></td>
                <td align="left" colspan="2" valign="baseline"><span id="loadspan_resvno" style="display:none;"><img src="../../images/circle_load.gif" border="0" /></span>&nbsp;<span id="txt_resvnonm" class="f_form"></span>
                  <input type="hidden" name="chkresvno" id="chkresvno" /><input type="hidden" name="resvno_balance" id="resvno_balance" /></td>
              </tr>
              <tr id="for02_1" style="display:none;">
                <td align="right" valign="baseline"><span id="chqno" class="f_form">เลขที่เช็ค&nbsp;:&nbsp;</span></td>
                <td align="left" valign="baseline"><input type="text" name="txt_chqno" id="txt_chqno" onblur="OnblurSearch_forcash(this.id,this.value)" />
                  <a href="JavaScript:ShowSearch_forcash('showchqno');"><img src="images/search-icon.gif" border="0"/></a></td>
                <td align="left" valign="baseline" colspan="2"><span id="loadspan_chqno" style="display:none;"><img src="../../images/circle_load.gif" border="0" /></span><span id="txt_chqnonm" class="f_form">วันที่เช็คผ่าน&nbsp;:&nbsp;</span><input type="hidden" name="chkchqno" id="chkchqno" /><input type="hidden" name="chqno_balance" id="chqno_balance" /></td>
              </tr>
              <tr id="for02_2" style="display:none;">
                <td align="right" valign="baseline"><span id="txt_chqstatdt1" class="f_form"></span></td>
                <td align="left" valign="baseline"><span id="txt_chqstatdt2" class="f_form"></span></td>
                <td align="left" valign="baseline" colspan="2"><span id="txt_chqpay" class="f_form">ยอดเงินคงเหลือ&nbsp;:&nbsp;</span></td>
              </tr>
              <tr id="for03" style="display:none;">
                <td align="right" valign="baseline"><span id="trnpayment" class="f_form">เลขที่บัญชี&nbsp;:&nbsp;</span></td>
                <td align="left" valign="baseline"><input type="text" name="txt_trnpayment" id="txt_trnpayment" onblur="OnblurSearch_forcash(this.id,this.value)" />
                	<a href="JavaScript:ShowSearch_forcash('showtrnpayment');"><img src="images/search-icon.gif" border="0"/></a></td>
                <td align="left" valign="baseline" colspan="2"><span id="loadspan_trnpayment" style="display:none;"><img src="../../images/circle_load.gif" border="0" /></span><span id="txt_trnpaymentnm" class="f_form"></span></td>
              </tr>
              <tr>
                <td align="right" valign="baseline"><span id="payfor" class="f_form">รหัสชำระ&nbsp;:&nbsp;</span></td>
                <td align="left" valign="baseline"><select name="txt_payfor" id="txt_payfor" onchange="onChange_forcash(this.id,this.value);" style="width:146px;">
                    <option value="0|0">&nbsp;</option>
                    <?php
					$strSQL = "SELECT FORCODE,FORDESC FROM PAYFOR WHERE REGTYP = 'N' ORDER BY FORCODE";
					$objExec = odbc_exec($conn,$strSQL) or die ("Error Execute [".$strSQL."]");
					while($result = odbc_fetch_array($objExec)){
				?>
                    <option value="<?php echo trim(enc2($result["FORCODE"]))."|".trim(enc2($result["FORDESC"]));?>">
                    <?php echo trim(enc2($result["FORCODE"]))." : ".trim(enc2($result["FORDESC"]));?>
                    </option>
                    <?php
					}
				?>
                  </select></td>
                <td align="left" valign="baseline" colspan="2"><span class="f_form" id="txt_payfornm"></span></td>
              </tr>
              <tr>
                <td align="right" valign="baseline"><span id="contno" class="f_form">เลขที่สัญญา&nbsp;:&nbsp;</span></td>
                <td align="left" valign="baseline"><input type="text" name="txt_contno" id="txt_contno" onblur="OnblurSearch_forcash(this.id,this.value);" disabled="disabled" />
                  <span id="imgFindContno" style="display:none;"></span>
                  <input type="hidden" name="chkcontno" id="chkcontno" />
                  <input type="hidden" name="txt_xcontno" id="txt_xcontno" /></td>
                <td align="left" valign="baseline" colspan="2"><span id="loadspan_contno" style="display:none;"><img src="../../images/circle_load.gif" border="0" /></span><span class="f_form" id="txt_cuscod"></span><span id="txt_contnonm" style="display:none;"></span></td>
              </tr>
              <tr>
                <td align="right" valign="baseline">&nbsp;</td>
                <td align="left" valign="baseline"><span id="detail_contno" style="display:none;" class="f_form">
                  <input type="button" name="Detail" id="Detail" value="รายละเอียดสัญญา" onclick="ShowSearch_forcash('showcontract');" />
                  </span></td>
                <td align="left" valign="baseline" colspan="2"><span class="f_form" id="txt_cuscodnm"></span></td>
              </tr>
              <tr>
                <td align="right">&nbsp;</td>
                <td colspan="3" align="left"><span id="vw_alert" class="f_form"></span></td>
              </tr>
              <tr>
                <td align="right" valign="baseline"><span id="payamt" class="f_form">ยอดตัดลูกหนี้&nbsp;:&nbsp;</span></td>
                <td align="left" valign="baseline"><input type="text" name="txt_payamt" id="txt_payamt" onkeypress="return bannedKey(event);" onclick="OnClickMoney(this.id);" onselect="OnClickMoney(this.id);" onkeyup="onKeyUp_forcash(this.id,this.value);" onblur="blurMoney_forcash(this.id,this.value);" dir="rtl" />
                  <input type="hidden" name="chkpayamt" id="chkpayamt" /></td>
                <td align="left" valign="baseline" colspan="2"><span class="f_form" id="txt_payamtnm"></span></td>
              </tr>
              <tr>
                <td align="right" valign="baseline"><span id="disct" class="f_form">ส่วนลด&nbsp;:&nbsp;</span></td>
                <td align="left" valign="baseline"><input type="text" name="txt_disct" id="txt_disct" onkeypress="return bannedKey(event);" onclick="OnClickMoney(this.id);" onselect="OnClickMoney(this.id);" onkeyup="onKeyUp_forcash(this.id,this.value);" onblur="blurMoney_forcash(this.id,this.value);" dir="rtl" />
                  <input type="hidden" name="chkdisct" id="chkdisct" /></td>
                <td align="left" valign="baseline" colspan="2"><span id="txt_disctnm" class="f_form"></span></td>
              </tr>
              <tr>
                <td align="right" valign="baseline"><span id="netpay" class="f_form">รับสุทธิ&nbsp;:&nbsp;</span></td>
                <td align="left" valign="baseline"><input type="text" name="txt_netpay" id="txt_netpay" onkeypress="return bannedKey(event);" onclick="OnClickMoney(this.id);" onselect="OnClickMoney(this.id);" onblur="blurMoney_forcash(this.id,this.value);" readonly="readonly" dir="rtl" />
                  <input type="hidden" name="chknetpay" id="chknetpay" /></td>
                <td align="left" valign="baseline" colspan="2"><span id="txt_netpaynm" class="f_form"></span></td>
              </tr>
              <tr id="vwlist_pay">
                <td align="right" valign="baseline"><span class="f_form">รายการ&nbsp;:&nbsp;</span></td>
                <td align="left" valign="baseline" colspan="3"><input type="button" name="btAdd" id="btAdd" value="เพิ่มรายการ" onclick="chktotalMoney();confirmAddlist();" style="width:80px;" />
                  <span id="PayUpdate" style="display:none;">&nbsp;|&nbsp;
                  <input type="button" name="btUpd" id="btUpd" value="ปรับปรุง" onclick="PayUpdate('upd');" style="width:80px;" />
                  &nbsp;|&nbsp;
                  <input type="button" name="btDel" id="btDel" value="ลบ" onclick="PayUpdate('del');" style="width:80px;" />
                  &nbsp;|&nbsp;
                  <input type="button" name="btCanc" id="btCanc" value="ยกเลิก" onclick="PayUpdate('cancel');" style="width:80px;" />
                  </span></td>
              </tr>
              <tr>
                <td align="left" valign="baseline">&nbsp;</td>
                <td align="center" valign="baseline" colspan="3"><span id="txtPayUpdate" class="f_form"></span></td>
              </tr>
              <tr>
                <td colspan="4" align="center"><div id="imgLoadlistpay" align="center" style="display:none;"><img src="images/loader.gif"></div>
                  <span id="listpay"></span>
                  <input type="hidden" name="txt_listpay" id="txt_listpay" />
                  <input type="hidden" name="txt_listpayfor" id="txt_listpayfor" />
                  <input type="hidden" name="txt_payupdate" id="txt_payupdate" />
                  <input type="hidden" name="txt_chqmasid" id="txt_chqmasid" />
                  <input type="hidden" name="txt_totalrow" id="txt_totalrow" />
                  <input type="hidden" name="txt_select" id="txt_select" />
                  <input type="hidden" name="txt_payflag" id="txt_payflag" />
                  <input type="hidden" name="audit_contract" id="audit_contract" />
                  <input type="hidden" name="chkaudit" id="chkaudit" />
                  <input type="hidden" name="txt_tpayamt" id="txt_tpayamt" />
                  <input type="hidden" name="send_cuscod" id="send_cuscod" />
                  <input type="hidden" name="revoke" id="revoke" value="new" />
                  <input type="hidden" name="txt_rprn" id="txt_rprn" value="<?php echo $backprint;?>" /></td>
              </tr>
              <tr>
                <td align="right" valign="top"><span id="memo" class="f_form">หมายเหตุ&nbsp;:&nbsp;</span></td>
                <td align="left" valign="baseline" colspan="3"><textarea name="txt_memo" id="txt_memo" cols="45" rows="2" style="width:400px;"></textarea></td>
              </tr>
              <tr>
                <td colspan="4">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="4" align="center"><table width="300" border="0" cellspacing="2" cellpadding="0">
                    <tr>
                      <td id="NewPage" style="display:none;" align="center"><input type="button" name="btNewpage" id="btNewpage" value="เพิ่มรายการรับเงินใหม่" style="width:120px;" onclick="CallPage('frm_forcash','forcash','form');" /></td>
                      <td id="NewPage2" style="display:none;" align="center">&nbsp;|&nbsp;</td>
                      <td align="center"><input type="button" name="ntInsert" id="btInsert" value="บันทึก" style="width:80px;" onclick="chksubmit_forcash();" />
                        <input type="button" name="btUpdate" id="btUpdate" value="ปรับปรุง" style="display:none; width:80px;" /></td>
                      <td align="center"><input type="reset" name="btCancel" id="btCancel" value="ยกเลิก" style="width:80px;" onclick="CallPage('frm_forcash','forcash','form');" />
                        <input type="button" name="btRevoke" id="btRevoke" value="ยกเลิกรายการ" style="display:none; width:90px;" onclick="revokePage_forcash();" /></td>
                      <td align="center"><input type="button" name="btSearch" id="btSearch" value="ค้นหา" style="width:80px;" onclick="ShowSearch_forcash('showchqtran');" /></td>
                      <td align="center"><input type="button" name="btPrint" id="btPrint" value="พิมพ์" disabled="disabled" style="width:80px;" onclick="ChoosePrint('1');" /></td>
                    </tr>
                    <tr id="tb_print" style="display:none;">
                      <td><input type="text" name="txt_print" id="txt_print" value="1" style="display:none;" /></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td align="right"><input type="button" name="btPrint01" id="btPrint01" value="พิมพ์ใบรับเงิน" style="width:80px;" onclick="OnPrint_forcash('Vouchers');" /></td>
                      <td align="left"><input type="button" name="btPrint02" id="btPrint02" value="พิมพ์ใบเสร็จ" style="width:80px;" onclick="OnPrint_forcash('Receipt');" /></td>
                    </tr>
                  </table></td>
              </tr>
            </table>
          </fieldset></td>
      </tr>
    </table>
  </div>
  <!-- div id frmMain -->
  <div id="result" align="center">
    <div id="imgLoadInsert" align="center" style="display:none;"><img src="images/loader.gif" border="0" /></div>
    <span id="myInsert"></span> </div>
  <!-- result -->
  <div align="center"><span id="viewDisplay"></span></div>
  <!-- viewDisplay -->
  <div class="searchform" id="showlocat" style="display:none;">
    <input class="searchfield" type="text" name="selocat" id="selocat" value="ค้นหา..." onclick="ClickField(this.id);" onblur="BlurField(this.id);" />
    <input type="hidden" name="hid_selocat" id="hid_selocat" />
    <input class="searchbutton" type="button" value="Go" name="btLocat" id="btLocat" onclick="SearchAjax_forcash('locat');"/>
    <input class="searchbutton" type="button" name="btCancelLocat" id="btCancelLocat" value="back" onclick="BackToMain_forcash('locat');" />
    <input class="searchbutton" type="button" name="btOkLocat" id="btOkLocat" value="เลือก" onclick="Choose_forcash('locat','ok','val');" />
    <br/>
    <br/>
    <div align="center"><span id="txtShowlocat" class="f_form">ค้นหาสาขา</span></div>
    <br/>
    <div align="center"><span id="mySearchlocat"></span></div>
    <div id="imgLoadlocat" align="center" style="display:none;"><img src="images/loader.gif" alt=""></div>    
  </div>
  <!-- div id showlocat -->
  <div class="searchform" id="showcontno" style="display:none;" align="center">
    <table width="600" border="0" cellspacing="2" cellpadding="0">
      <tr>
        <td><table width="600" border="0" cellspacing="2" cellpadding="0">
            <tr>
              <td align="right" valign="baseline"><span class="f_form">สาขา&nbsp;:&nbsp;</span></td>
              <td align="left" valign="baseline"><input type="text" name="selocatsearch" id="selocatsearch" value="<?php echo trim($_SESSION["_locat"]);?>" <?php if($chglocat != "Y"){ ?> readonly="readonly"  <?php } ?> /></td>
              <td align="right" valign="baseline"><span class="f_form">เลขที่สัญญา&nbsp;:&nbsp;</span></td>
              <td align="left" valign="baseline"><input type="text" name="secontno" id="secontno" /></td>
            </tr>
            <tr>
              <td align="right" valign="baseline"><span class="f_form">รหัสลูกค้า&nbsp;:&nbsp;</span></td>
              <td align="left" valign="baseline"><input type="text" name="secuscod" id="secuscod" /></td>
              <td align="right" valign="baseline"><span class="f_form">ชื่อลูกค้า&nbsp;:&nbsp;</span></td>
              <td align="left" valign="baseline"><input type="text" name="secuscodnm" id="secuscodnm" /></td>
            </tr>
            <tr>
              <td align="right" valign="baseline"><span class="f_form">เลขที่ใบจอง&nbsp;:&nbsp;</span></td>
              <td align="left" valign="baseline"><input type="text" name="seresvno" id="seresvno" /></td>
              <td align="right" valign="baseline"><span class="f_form">เลขตัวถัง&nbsp;:&nbsp;</span></td>
              <td align="left" valign="baseline"><input type="text" name="sestrno" id="sestrno" /></td>
            </tr>
            <tr>
              <td colspan="4">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="4" align="center"><input type="button" name="btseBack" id="btseBack" value="กลับ" onclick="BackToMain_forcash('contno');" style="width:60px;" /><input type="hidden" name="hid_secontno" id="hid_secontno" />
                <input type="reset" name="btseClear" id="btseClear" value="เคลียร์" style="width:60px;" />
                <input type="button" name="btseSearch" id="btseSearch" value="ค้นหา" onclick="SearchAjax_forcash('contno');" style="width:60px;" />
                <input type="button" name="btOkContno" id="btOkContno" value="เลือก" onclick="Choose_forcash('contno','ok','val');" style="width:60px;" /></td>
            </tr>
            <tr>
              <td colspan="4" align="center"><div id="imgLoadSearch" align="center" style="display:none;"><img src="images/loader.gif" /></div>
                <span id="mySpanSearch"></span></td>
            </tr>
          </table></td>
      </tr>
    </table>
    <div align="center"><span id="txtShowcontno" class="f_form">ค้นหาเลขที่สัญญา</span></div>
    <div align="center"><span id="mySearchcontno"></span></div>
    <div id="imgLoadcontno" align="center" style="display:none;"><img src="images/loader.gif" alt=""></div>
  </div>
  <!-- div id showcontno -->
  <div id="showarothsale" class="searchform" align="center" style="display:none;">
    <table width="600" border="0" cellspacing="2" cellpadding="0">
      <tr>
        <td><table width="600" border="0" cellspacing="2" cellpadding="0">
            <tr>
              <td align="right" valign="baseline"><span class="f_form">สาขา&nbsp;:&nbsp;</span></td>
              <td align="left" valign="baseline"><input type="text" name="searothlocatsearch" id="searothlocatsearch" value="<?php echo trim($_SESSION["_locat"]);?>" <?php if($chglocat != "Y"){ ?> readonly="readonly"  <?php } ?> /></td>
              <td align="right" valign="baseline"><span class="f_form">เลขที่สัญญา&nbsp;:&nbsp;</span></td>
              <td align="left" valign="baseline"><input type="text" name="searothsale" id="searothsale" /></td>
            </tr>
            <tr>
              <td align="right" valign="baseline"><span class="f_form">รหัสลูกค้า&nbsp;:&nbsp;</span></td>
              <td align="left" valign="baseline"><input type="text" name="searothcuscod" id="searothcuscod" /></td>
              <td align="right" valign="baseline"><span class="f_form">ชื่อลูกค้า&nbsp;:&nbsp;</span></td>
              <td align="left" valign="baseline"><input type="text" name="searothcuscodnm" id="searothcuscodnm" /></td>
            </tr>
            <tr>
              <td colspan="4">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="4" align="center"><input type="button" name="btseBack" id="btseBack" value="กลับ" onclick="BackToMain_forcash('arothsale');" style="width:60px;" />
                <input type="reset" name="btseClear" id="btseClear" value="เคลียร์" style="width:60px;" />
                <input type="button" name="btseSearch" id="btseSearch" value="ค้นหา" onclick="SearchAjax_forcash('arothsale');" style="width:60px;" /></td>
            </tr>
            <tr>
              <td colspan="4" align="center"><div id="imgLoadSearch" align="center" style="display:none;"><img src="images/loader.gif" /></div>
                <span id="mySpanSearch"></span></td>
            </tr>
          </table></td>
      </tr>
    </table>
    <div align="center"><span id="txtShowarothsale" class="f_form">ค้นหาเลขที่สัญญา</span></div>
    <div id="imgLoadarothsale" align="center" style="display:none;"><img src="images/loader.gif" alt=""></div>
    <div align="center"><span id="mySearcharothsale"></span></div>
  </div>
  <!-- div id showarothsale -->
  <div id="showcustmast" class="searchform" align="center" style="display:none;">
    <table width="600" border="0" cellspacing="2" cellpadding="0">
      <tr>
        <td><table width="600" border="0" cellspacing="2" cellpadding="0">
            <tr>
              <td align="right" valign="baseline"><span class="f_form">รหัสลูกค้า&nbsp;:&nbsp;</span></td>
              <td align="left" valign="baseline"><input type="text" name="secustmast" id="secustmast" /></td>
              <td align="right" valign="baseline"><span class="f_form">เลขบัตรประจำตัว&nbsp;:&nbsp;</span></td>
              <td align="left" valign="baseline"><input type="text" name="secusnocard" id="secusnocard" /></td>
            </tr>
            <tr>
              <td align="right" valign="baseline"><span class="f_form">ชื่อลูกค้า&nbsp;:&nbsp;</span></td>
              <td align="left" valign="baseline"><input type="text" name="secusname1" id="secusname1" /></td>
              <td align="right" valign="baseline"><span class="f_form">นามสกุล&nbsp;:&nbsp;</span></td>
              <td align="left" valign="baseline"><input type="text" name="secusname2" id="secusname2" /></td>
            </tr>
            <tr>
              <td align="right" valign="baseline"><span class="f_form">กลุ่ม&nbsp;:&nbsp;</span></td>
              <td align="left" valign="baseline"><select name="secusgroup" id="secusgroup" style="width:132px;" >
                  <option value="" selected="selected"></option>
                  <?php
			$strSQL = "SELECT * FROM ARGROUP ORDER BY ARGCOD";
			$objExec = odbc_exec($conn,$strSQL) or die ("Error Execute [".$strSQL."]");
			while($result = odbc_fetch_array($objExec)){
		  ?>
                  <option value="<?php echo  trim(enc2($result["ARGCOD"])); ?>">
                  <?php echo  trim(enc2($result["ARGDES"])); ?>
                  </option>
                  <?php }
			  
		  ?>
                </select></td>
              <td align="right" valign="baseline"><span class="f_form">เกรด&nbsp;:&nbsp;</span></td>
              <td align="left" valign="baseline"><select name="secusgrade" id="secusgrade" style="width:132px;">
                  <option value="" selected="selected"></option>
                  <?php
				$strSQL = "SELECT * FROM SETGRADE WHERE GRDFLG = 'Y' ORDER BY GRDCOD";
				$objExec = odbc_exec($conn,$strSQL) or die ("Error Execute [".$strSQL."]");
				while($result = odbc_fetch_array($objExec)){
			  ?>
                  <option value="<?php echo  trim(enc2($result["GRDCOD"])); ?>">
                  <?php echo  trim(enc2($result["GRDDES"])); ?>
                  </option>
                  <?php 
			  	}				  
			  ?>
                </select></td>
            </tr>
            <tr>
              <td colspan="4">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="4" align="center"><input type="button" name="btseBack" id="btseBack" value="กลับ" onclick="BackToMain_forcash('custmast');" style="width:60px;" />
                <input type="reset" name="btseClear" id="btseClear" value="เคลียร์" style="width:60px;" />
                <input type="button" name="btseSearch" id="btseSearch" value="ค้นหา" onclick="SearchAjax_forcash('custmast');" style="width:60px;" /></td>
            </tr>
            <tr>
              <td colspan="4" align="center"><div id="imgLoadSearch" align="center" style="display:none;"><img src="images/loader.gif" /></div>
                <span id="mySpanSearch"></span></td>
            </tr>
          </table></td>
      </tr>
    </table>
    <div align="center"><span id="txtShowcustmast" class="f_form">ค้นหาลูกหนี้</span></div>
    <div id="imgLoadcustmast" align="center" style="display:none;"><img src="images/loader.gif" alt=""></div>
    <div align="center"><span id="mySearchcustmast"></span></div>
  </div>
  <!-- div id showcuscod -->
  <div id="showcontract" style="display:none;" align="center"><br/>
    <input type="hidden" name="txt_detail" id="txt_detail" />
    <input type="hidden" name="txt_payment" id="txt_payment" />
    <input type="hidden" name="txt_contract" id="txt_contract" />
    <input type="hidden" name="txt_guarantee" id="txt_guarantee" />
    <input type="hidden" name="txt_other" id="txt_other" />
    <div id="imgLoadviewcontract" align="center" style="display:none;"><img src="images/loader.gif" alt=""></div>
    <span id="view_contract"></span>
    <input type="button" name="tabBack" id="tabBack" value="กลับ" onclick="BackToMain_forcash('viewcontno');" style="width:60px;" />
  </div>
  <!-- div id showcontract -->
  <div id="showresvno" class="searchform" align="center" style="display:none;">
    <table width="600" border="0" cellspacing="2" cellpadding="0">
      <tr>
        <td><table width="600" border="0" cellspacing="2" cellpadding="0">
            <tr>
              <td align="right" valign="baseline"><span class="f_form">สาขา&nbsp;:&nbsp;</span></td>
              <td align="left" valign="baseline"><input type="text" name="seresvlocat" id="seresvlocat" value="<?php echo trim($_SESSION["_locat"]);?>" <?php if($chglocat != "Y"){ ?> readonly="readonly"  <?php } ?> /></td>
              <td align="right" valign="baseline"><span class="f_form">เลขที่ใบจอง&nbsp;:&nbsp;</span></td>
              <td align="left" valign="baseline"><input type="text" name="searresv" id="searresv" /></td>
            </tr>
            <tr>
              <td align="right" valign="baseline"><span class="f_form">รหัสลูกค้า&nbsp;:&nbsp;</span></td>
              <td align="left" valign="baseline"><input type="text" name="seresvcuscod" id="seresvcuscod" /></td>
              <td align="right" valign="baseline"><span class="f_form">ชื่อลูกค้า&nbsp;:&nbsp;</span></td>
              <td align="left" valign="baseline"><input type="text" name="seresvcustnm" id="seresvcustnm" /></td>
            </tr>
            <tr>
              <td colspan="4">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="4" align="center"><input type="button" name="btseBack" id="btseBack" value="กลับ" onclick="BackToMain_forcash('arothsale');" style="width:60px;" />
                <input type="reset" name="btseClear" id="btseClear" value="เคลียร์" style="width:60px;" />
                <input type="button" name="btseSearch" id="btseSearch" value="ค้นหา" onclick="SearchAjax_forcash('resvno');" style="width:60px;" /></td>
            </tr>
            <tr>
              <td colspan="4" align="center"><div id="imgLoadResvno" align="center" style="display:none;"><img src="images/loader.gif" /></div>
                <span id="mySpanResvno"></span></td>
            </tr>
          </table></td>
      </tr>
    </table>
    <div align="center"><span id="txtShowresvno" class="f_form">ค้นหาเลขที่ใบจอง</span></div>
    <div id="imgLoadresvno" align="center" style="display:none;"><img src="images/loader.gif" alt=""></div>
    <div align="center"><span id="mySearchresvno"></span></div>
  </div>
  <!-- div id showresvno -->
  <div id="showchqno" class="searchform" align="center" style="display:none;">
    <table width="600" border="0" cellspacing="2" cellpadding="0">
      <tr>
        <td><table width="600" border="0" cellspacing="2" cellpadding="0">
            <tr>
              <td align="right" valign="baseline"><span class="f_form">เลขที่เช็ค&nbsp;:&nbsp;</span></td>
              <td align="left" valign="baseline"><input type="text" name="sechqno" id="sechqno" /></td>
              <td align="right" valign="baseline"><span class="f_form">เลขที่ใบรับเช็ค&nbsp;:&nbsp;</span></td>
              <td align="left" valign="baseline"><input type="text" name="servchqno" id="servchqno" /></td>
            </tr>
            <tr>
              <td align="right" valign="baseline"><span class="f_form">รหัสลูกค้า&nbsp;:&nbsp;</span></td>
              <td align="left" valign="baseline"><input type="text" name="sechqcuscod" id="sechqcuscod" /></td>
              <td align="right" valign="baseline"><span class="f_form">ชื่อลูกค้า&nbsp;:&nbsp;</span></td>
              <td align="left" valign="baseline"><input type="text" name="sechqcustnm" id="sechqcustnm" /></td>
            </tr>
            <tr>
              <td colspan="4">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="4" align="center"><input type="button" name="btseBack" id="btseBack" value="กลับ" onclick="BackToMain_forcash('chqno');" style="width:60px;" />
                <input type="reset" name="btseClear" id="btseClear" value="เคลียร์" style="width:60px;" />
                <input type="button" name="btseSearch" id="btseSearch" value="ค้นหา" onclick="SearchAjax_forcash('chqno');" style="width:60px;" /></td>
            </tr>
            <tr>
              <td colspan="4" align="center"><div id="imgLoadChqno" align="center" style="display:none;"><img src="images/loader.gif" /></div>
                <span id="mySpanChqno"></span></td>
            </tr>
          </table></td>
      </tr>
    </table>
    <div align="center"><span id="txtShowchqno" class="f_form">ค้นหาเลขที่เช็ค</span></div>
    <div id="imgLoadchqno" align="center" style="display:none;"><img src="images/loader.gif" alt=""></div>
    <div align="center"><span id="mySearchchqno"></span></div>
  </div>
  <!-- div id showchqno -->
  <div id="showtrnpayment" class="searchform" align="center" style="display:none;">
    <table width="600" border="0" cellspacing="2" cellpadding="0">
      <tr>
        <td><table width="600" border="0" cellspacing="2" cellpadding="0">
            <tr>
              <td colspan="4">&nbsp;</td>
            </tr>
            <tr>
              <td align="right" valign="baseline"><span class="f_form">รหัสบัญชี&nbsp;:&nbsp;</span></td>
              <td align="left" valign="baseline"><input type="text" name="setrnpayment" id="setrnpayment" /></td>
              <td align="right" valign="baseline"><span class="f_form">รายการ&nbsp;:&nbsp;</span></td>
              <td align="left" valign="baseline"><input type="text" name="setrnpaymentnm" id="setrnpaymentnm" style="width:200px;" /></td>
            </tr>
            <tr>
              <td colspan="4">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="4" align="center"><input type="button" name="btseBack" id="btseBack" value="กลับ" onclick="BackToMain_forcash('trnpayment');" style="width:60px;" />
                <input type="reset" name="btseClear" id="btseClear" value="เคลียร์" style="width:60px;" />
                <input type="button" name="btseSearch" id="btseSearch" value="ค้นหา" onclick="SearchAjax_forcash('trnpayment');" style="width:60px;" /></td>
            </tr>
            <tr>
              <td colspan="4" align="center"><div id="imgLoadTrnpayment" align="center" style="display:none;"><img src="images/loader.gif" /></div>
                <span id="mySpanTrnpayment"></span></td>
            </tr>
          </table></td>
      </tr>
    </table>
    <div align="center"><span id="txtShowtrnpayment" class="f_form">ค้นหาเลขบัญชี</span></div>
    <div id="imgLoadtrnpayment" align="center" style="display:none;"><img src="images/loader.gif" alt=""></div>
    <div align="center"><span id="mySearchtrnpayment"></span></div>
  </div>
  <!-- div id showtrnpayment -->
  <div id="showchqtran" class="searchform" align="center" style="display:none;">
    <table width="600" border="0" cellspacing="2" cellpadding="0">
      <tr>
        <td><table width="600" border="0" cellspacing="2" cellpadding="0">
            <tr>
              <td align="right" valign="baseline"><span class="f_form">สาขา&nbsp;:&nbsp;</span></td>
              <td align="left" valign="baseline"><input type="text" name="sechqtranlocat" id="sechqtranlocat" value="<?php echo trim($_SESSION["_locat"]);?>" <?php if($chglocat != "Y"){ ?> readonly="readonly"  <?php } ?> /></td>
              <td align="right" valign="baseline"><span class="f_form">ประเภทการชำระ&nbsp;:&nbsp;</span></td>
              <td align="left" valign="baseline"><select name="sepayfor" id="sepayfor" style="width:142px;">
              	<option value="" selected="selected"></option>
                    <?php
					$strSQL = "SELECT FORCODE,FORDESC FROM PAYFOR WHERE REGTYP = 'N' ORDER BY FORCODE";
					$objExec = odbc_exec($conn,$strSQL) or die ("Error Execute [".$strSQL."]");
					while($result = odbc_fetch_array($objExec)){
				?>
                    <option value="<?php echo trim(enc2($result["FORCODE"]));?>">
                    <?php echo trim(enc2($result["FORCODE"]))." : ".trim(enc2($result["FORDESC"]));?>
                    </option>
                    <?php
					}
				?>
              </select></td>
            </tr>
            <tr>
              <td align="right" valign="baseline"><span class="f_form">เลขที่ใบรับชั่วคราว&nbsp;:&nbsp;</span></td>
              <td align="left" valign="baseline"><input type="text" name="sechqtran" id="sechqtran" /></td>
              <td align="right" valign="baseline"><span class="f_form">เลขที่ใบเสร็จ&nbsp;:&nbsp;</span></td>
              <td align="left" valign="baseline"><input type="text" name="sebillno" id="sebillno" /></td>
            </tr>
            
            <tr>
              <td align="right" valign="baseline"><span class="f_form">เลขที่ใบจอง&nbsp;:&nbsp;</span></td>
              <td align="left" valign="baseline"><input type="text" name="sechqtranresvno" id="sechqtranresvno" /></td>
              <td align="right" valign="baseline"><span class="f_form">เลขที่เช็ค&nbsp;:&nbsp;</span></td>
              <td align="left" valign="baseline"><input type="text" name="sechqtranchqno" id="sechqtranchqno" /></td>
            </tr>
            <tr>
              <td align="right" valign="baseline"><span class="f_form">รหัสลูกค้า&nbsp;:&nbsp;</span></td>
              <td align="left" valign="baseline"><input type="text" name="sechqtrancuscod" id="sechqtrancuscod" /></td>
              <td align="right" valign="baseline"><span class="f_form">ชื่อลูกค้า&nbsp;:&nbsp;</span></td>
              <td align="left" valign="baseline"><input type="text" name="sechqtrancustnm" id="sechqtrancustnm" /></td>
            </tr>
            <tr>
              <td colspan="4">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="4" align="center"><input type="button" name="btseBack" id="btseBack" value="กลับ" onclick="BackToMain_forcash('chqtran');" style="width:60px;" />
                <input type="reset" name="btseClear" id="btseClear" value="เคลียร์" style="width:60px;" />
                <input type="button" name="btseSearch" id="btseSearch" value="ค้นหา" onclick="SearchAjax_forcash('chqtran');" style="width:60px;" />
                <input type="button" name="btOkBillno" id="btOkBillno" value="เลือก" onclick="onClickChoose_forcash();" style="width:60px;" />
                <input type="hidden" name="txtval01" id="txtval01"  />
                <input type="hidden" name="txtval02" id="txtval02"  />
                <input type="hidden" name="txtval03" id="txtval03"  />
                <input type="hidden" name="txtval04" id="txtval04"  /></td>
            </tr>
            <tr>
              <td colspan="4" align="center"><div id="imgLoadChqtran" align="center" style="display:none;"><img src="images/loader.gif" /></div>
                <span id="mySpanBeforeChoose"></span><span id="mySpanChqtran"></span></td>
            </tr>
          </table></td>
      </tr>
    </table>
    <div align="center"><span id="txtShowchqtran" class="f_form">ค้นหาใบเสร็จรับเงิน</span></div>
    <div align="center"><span id="mySearchchqtran"></span></div>
    <div id="imgLoadchqtran" align="center" style="display:none;"><img src="images/loader.gif" alt=""></div>
  </div>
  <!-- div id showresvno -->
  <?php
		}else{
			echo "<div align='center'><font color='#333333'><b>คุณไม่มีสิทธิ ในการใช้งานระบบนี้<br/>โปรดติดต่อผู้ดูแลระบบ</b></font></div>";
		}
	}else{
		echo "<div align='center'><font color='#333333'><b>คุณไม่มีสิทธิในการบันทึกข้อมูลของระบบนี้ <br/><br/>รอสักครู่ </b><br/></font></div>";
	}
?>
</form>
</body>
</html>