// JavaScript Document
	var HttPRequest = false;
	   function LTrim(str){
			if (str==null){
				return null;
			}
			for(var i=0;str.charAt(i)==" ";i++);
			return str.substring(i,str.length);
		}
		function RTrim(str){
			if (str==null){
				return null;
			}
			for(var i=str.length-1;str.charAt(i)==" ";i--);
			return str.substring(0,i+1);
		}
		function Trim(str){
			return LTrim(RTrim(str));
		}

	   function doSearchAjax_forcash(Mode,Type,Stat,Search) {
		  HttPRequest = false;
		  if (window.XMLHttpRequest) { // Mozilla, Safari,...
			 HttPRequest = new XMLHttpRequest();
			 if (HttPRequest.overrideMimeType) {
				HttPRequest.overrideMimeType('text/html');
			 }
		  } else if (window.ActiveXObject) { // IE
			 try {
				HttPRequest = new ActiveXObject("Msxml2.XMLHTTP");
			 } catch (e) {
				try {
				   HttPRequest = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e) {}
			 }
		  } 
		  
		  if (!HttPRequest) {
			 alert('Cannot create XMLHTTP instance');
			 return false;
		  }
		  
		  if(Mode == "SearchOnClick"){
		  	  var url = 'Billing_Systems/recive_cash/find_data.php';
			  var pmeters = "tFind=" + encodeURI(document.getElementById("txt_locat").value) +
			  		"&tPayfor="		+ encodeURI(document.getElementById("txt_payfor").value) +
					"&tLocat="		+ encodeURI(document.getElementById("selocatsearch").value) +
					"&tContno="		+ encodeURI(document.getElementById("secontno").value) +
					"&tCuscod="		+ encodeURI(document.getElementById("secuscod").value) +
					"&tName="		+ encodeURI(document.getElementById("secuscodnm").value) +
					"&tResvno="		+ encodeURI(document.getElementById("seresvno").value) +
					"&tStrno="		+ encodeURI(document.getElementById("sestrno").value) +
					"&tTmbilldt="	+ encodeURI(document.getElementById("txt_tmbilldt").value) +
					"&tRlocat="		+ encodeURI(document.getElementById("searothlocatsearch").value) +
					"&tRarcont="	+ encodeURI(document.getElementById("searothsale").value) +
					"&tRcuscod="	+ encodeURI(document.getElementById("searothcuscod").value) +
					"&tRcuscodnm="	+ encodeURI(document.getElementById("searothcuscodnm").value) +
					"&tCcustmast="	+ encodeURI(document.getElementById("secustmast").value) +
					"&tCnocard="	+ encodeURI(document.getElementById("secusnocard").value) +
					"&tCcusname="	+ encodeURI(document.getElementById("secusname1").value) +
					"&tCcuslname="	+ encodeURI(document.getElementById("secusname2").value) +
					"&tCgroup="		+ encodeURI(document.getElementById("secusgroup").value) +
					"&tCgrade="		+ encodeURI(document.getElementById("secusgrade").value) +
					"&tRElocat="	+ encodeURI(document.getElementById("seresvlocat").value) +
					"&tREresvno="	+ encodeURI(document.getElementById("searresv").value) +
					"&tREcuscod="	+ encodeURI(document.getElementById("seresvcuscod").value) +
					"&tREcustnm="	+ encodeURI(document.getElementById("seresvcustnm").value) +
					"&tChqno="		+ encodeURI(document.getElementById("sechqno").value) +
					"&tChqrvchq="	+ encodeURI(document.getElementById("servchqno").value) +
					"&tChqcuscod="	+ encodeURI(document.getElementById("sechqcuscod").value) +
					"&tChqname="	+ encodeURI(document.getElementById("sechqcustnm").value) +
					"&tTrnpayment="	+ encodeURI(document.getElementById("setrnpayment").value) +
					"&tTrnpaymentnm="	+ encodeURI(document.getElementById("setrnpaymentnm").value) +
					"&tChqtran="		+ encodeURI(document.getElementById("sechqtran").value) +
					"&tChqtranlocat="	+ encodeURI(document.getElementById("sechqtranlocat").value) +
					"&tChqtranpayfor="	+ encodeURI(document.getElementById("sepayfor").value) +
					"&tChqtranbillno="	+ encodeURI(document.getElementById("sebillno").value) +
					"&tChqtranresvno="	+ encodeURI(document.getElementById("sechqtranresvno").value) +
					"&tChqtranchqno="	+ encodeURI(document.getElementById("sechqtranchqno").value) +
					"&tChqtrancuscod="	+ encodeURI(document.getElementById("sechqtrancuscod").value) +
					"&tChqtrannm="	+ encodeURI(document.getElementById("sechqtrancustnm").value) +
			  		"&tType="		+ Type +
					"&tStat="		+ Stat +
					"&tSearch="		+ Search +
					"&tMode="		+ Mode;
		  }else if(Mode == "SearchOnClickPaging"){
		  	  var url = 'Billing_Systems/recive_cash/find_data.php';
			  var pmeters = "tFind=" + encodeURI(document.getElementById("txt_locat").value) +
			  		"&tFind2=" 		+ encodeURI(document.getElementById("se"+Type).value) +
					"&tPayfor="		+ encodeURI(document.getElementById("txt_payfor").value) +
					"&tLocat="		+ encodeURI(document.getElementById("selocatsearch").value) +
					"&tContno="		+ encodeURI(document.getElementById("secontno").value) +
					"&tCuscod="		+ encodeURI(document.getElementById("secuscod").value) +
					"&tName="		+ encodeURI(document.getElementById("secuscodnm").value) +
					"&tResvno="		+ encodeURI(document.getElementById("seresvno").value) +
					"&tStrno="		+ encodeURI(document.getElementById("sestrno").value) +
					"&tTmbilldt="	+ encodeURI(document.getElementById("txt_tmbilldt").value) +
					"&tRlocat="		+ encodeURI(document.getElementById("searothlocatsearch").value) +
					"&tRarcont="	+ encodeURI(document.getElementById("searothsale").value) +
					"&tRcuscod="	+ encodeURI(document.getElementById("searothcuscod").value) +
					"&tRcuscodnm="	+ encodeURI(document.getElementById("searothcuscodnm").value) +
					"&tCcustmast="	+ encodeURI(document.getElementById("secustmast").value) +
					"&tCnocard="	+ encodeURI(document.getElementById("secusnocard").value) +
					"&tCcusname="	+ encodeURI(document.getElementById("secusname1").value) +
					"&tCcuslname="	+ encodeURI(document.getElementById("secusname2").value) +
					"&tCgroup="		+ encodeURI(document.getElementById("secusgroup").value) +
					"&tCgrade="		+ encodeURI(document.getElementById("secusgrade").value) +
					"&tRElocat="	+ encodeURI(document.getElementById("seresvlocat").value) +
					"&tREresvno="	+ encodeURI(document.getElementById("searresv").value) +
					"&tREcuscod="	+ encodeURI(document.getElementById("seresvcuscod").value) +
					"&tREcustnm="	+ encodeURI(document.getElementById("seresvcustnm").value) +
					"&tChqno="		+ encodeURI(document.getElementById("sechqno").value) +
					"&tChqrvchq="	+ encodeURI(document.getElementById("servchqno").value) +
					"&tChqcuscod="	+ encodeURI(document.getElementById("sechqcuscod").value) +
					"&tChqname="	+ encodeURI(document.getElementById("sechqcustnm").value) +
					"&tTrnpayment="	+ encodeURI(document.getElementById("setrnpayment").value) +
					"&tTrnpaymentnm="	+ encodeURI(document.getElementById("setrnpaymentnm").value) +
					"&tChqtran="		+ encodeURI(document.getElementById("sechqtran").value) +
					"&tChqtranlocat="	+ encodeURI(document.getElementById("sechqtranlocat").value) +
					"&tChqtranpayfor="	+ encodeURI(document.getElementById("sepayfor").value) +
					"&tChqtranbillno="	+ encodeURI(document.getElementById("sebillno").value) +
					"&tChqtranresvno="	+ encodeURI(document.getElementById("sechqtranresvno").value) +
					"&tChqtranchqno="	+ encodeURI(document.getElementById("sechqtranchqno").value) +
					"&tChqtrancuscod="	+ encodeURI(document.getElementById("sechqtrancuscod").value) +
					"&tChqtrannm="	+ encodeURI(document.getElementById("sechqtrancustnm").value) +
			  		"&tType="		+ Type +
					"&tStat="		+ Stat +
					"&tSearch="		+ Search +
					"&tMode="		+ Mode;
		  }else if(Mode == "addPaytoList"){
			  var url = 'Billing_Systems/recive_cash/frm_forcash_ss.php';
			  var pmeters = 
			  		"tType="		+ Type +
					"&tStat="		+ Stat +
					"&tSearch="		+ Search +
					"&tMode="		+ Mode;
		  }else if(Mode == "SearchOnBlur"){
			  var url = 'Billing_Systems/recive_cash/find_data.php';
			  var pmeters = "tLocat=" + encodeURI(document.getElementById("txt_locat").value) +
			  		"&tPayfor="		+ encodeURI(document.getElementById("txt_payfor").value) +
			  		"&tXidno=" 		+ encodeURI(document.getElementById("txt_xidno").value) +
					"&tTmbilldt=" 	+ encodeURI(document.getElementById("txt_tmbilldt").value) +
					"&tContno="		+ encodeURI(document.getElementById("txt_contno").value) +
					"&tType="		+ Type +
					"&tStat="		+ Stat +
					"&tSearch="		+ Search +
					"&tMode="		+ Mode;
		  }else if(Mode == "ViewDetail"){
			  var url = 'Billing_Systems/recive_cash/viewcontract.php';
			  var pmeters = "tContno=" + encodeURI(document.getElementById("txt_contno").value) +
			  		"&tPayfor="		+ encodeURI(document.getElementById("txt_payfor").value) +
					"&tLocat=" 		+ encodeURI(document.getElementById("txt_locat").value) +
					"&tTmbilldt="	+ encodeURI(document.getElementById("txt_tmbilldt").value) +
					"&tType="		+ Type +
					"&tStat="		+ Stat +
					"&tSearch="		+ Search +
					"&tMode="		+ Mode;
		  }else if(Mode == "MoneyToText"){
			  var url = 'Billing_Systems/recive_cash/find_data.php';
			  var pmeters = "tLocat=" + encodeURI(document.getElementById("txt_locat").value) +
					"&tType="		+ Type +
					"&tStat="		+ Stat +
					"&tSearch="		+ Search +
					"&tMode="		+ Mode;
		  }else if(Mode == "totalMoneyToText"){
			  var url = 'Billing_Systems/recive_cash/find_data.php';
			  var pmeters = 
					"tType="		+ Type +
					"&tStat="		+ Stat +
					"&tSearch="		+ Search +
					"&tMode="		+ Mode;
		  }else if(Mode == "AuditContract"){
			  var url = 'Billing_Systems/recive_cash/find_data.php';
			  var pmeters = 
					"tType="		+ Type +
					"&tStat="		+ Stat +
					"&tSearch="		+ Search +
					"&tMode="		+ Mode;
		  }else if(Mode == "INSERT"){
			  var url = 'Billing_Systems/recive_cash/frm_forcash_ss.php';
			  var pmeters = "tTmbilldt=" + encodeURI(document.getElementById("txt_tmbilldt").value) +
					"&tLocat=" 		+ encodeURI(document.getElementById("txt_locat").value) +
					"&tPaytype="	+ encodeURI(document.getElementById("txt_paytype").value) +
					"&tPayfor="		+ encodeURI(document.getElementById("txt_payfor").value) +
					"&tTmbill=" 	+ encodeURI(document.getElementById("txt_tmbill").value) +
					"&tBillno=" 	+ encodeURI(document.getElementById("txt_billno").value) +
					"&tListpay=" 	+ encodeURI(document.getElementById("txt_listpay").value) +				
					"&tMemo=" 		+ encodeURI(document.getElementById("txt_memo").value) +
					"&tTpayamt="	+ encodeURI(document.getElementById("txt_tpayamt").value) +
					"&tCuscod="		+ encodeURI(document.getElementById("send_cuscod").value) +
					"&tResvno="		+ encodeURI(document.getElementById("txt_resvno").value) +
					"&tChqno="		+ encodeURI(document.getElementById("txt_chqno").value) +
					"&tTrnpayment="	+ encodeURI(document.getElementById("txt_trnpayment").value) +
			  		"&tType="		+ Type +
					"&tStat="		+ Stat +
					"&tSearch="		+ Search +
					"&tMode="		+ Mode;
		  }else if(Mode == "UPDATE"){
			  var url = 'Billing_Systems/recive_cash/frm_forcash_ss.php';
			  var pmeters = "tSdate=" + encodeURI(document.getElementById("txt_sdate").value) +
			  		"&tType="		+ Type +
					"&tStat="		+ Stat +
					"&tSearch="		+ Search +
					"&tMode="		+ Mode;
		  }else if(Mode == "REVOKE"){
			  var url = 'Billing_Systems/recive_cash/frm_forcash_ss.php';
			  var pmeters = "tXidno=" + encodeURI(document.getElementById("txt_xidno").value) +
			  		"&tTmbill=" 	+ encodeURI(document.getElementById("txt_tmbill").value) +
					"&tBillno=" 	+ encodeURI(document.getElementById("txt_billno").value) +
					"&tListpayfor=" + encodeURI(document.getElementById("txt_listpayfor").value) +
			  		"&tType="		+ Type +
					"&tStat="		+ Stat +
					"&tSearch="		+ Search +
					"&tMode="		+ Mode;
		  }else if(Mode == "SearchBill"){
			  var url = 'Billing_Systems/recive_cash/frm_cashsale_ss.php';
			  var pmeters = "tCuscod=" + encodeURI(document.getElementById("txt_secuscod").value) +
					"&tContno=" 	+ encodeURI(document.getElementById("txt_secontno").value) +
					"&tName=" 		+ encodeURI(document.getElementById("txt_secuscodnm").value) +
					"&tLocat=" 		+ encodeURI(document.getElementById("txt_selocat").value) +
					"&tResvno=" 	+ encodeURI(document.getElementById("txt_seresvno").value) +
					"&tStrno="	 	+ encodeURI(document.getElementById("txt_sestrno").value) +
			  		"&tType="		+ Type +
					"&tStat="		+ Stat +
					"&tSearch="		+ Search +
					"&tMode="		+ Mode;
		  }else if(Mode == "SearchBillPaging"){
			  var url = 'Billing_Systems/recive_cash/frm_cashsale_ss.php';
			  var pmeters = "tCuscod=" + encodeURI(document.getElementById("txt_secuscod").value) +
					"&tContno=" 	+ encodeURI(document.getElementById("txt_secontno").value) +
					"&tName=" 		+ encodeURI(document.getElementById("txt_secuscodnm").value) +
					"&tLocat=" 		+ encodeURI(document.getElementById("txt_selocat").value) +
					"&tResvno=" 	+ encodeURI(document.getElementById("txt_seresvno").value) +
					"&tStrno="	 	+ encodeURI(document.getElementById("txt_sestrno").value) +
			  		"&tType="		+ Type +
					"&tStat="		+ Stat +
					"&tSearch="		+ Search +
					"&tMode="		+ Mode;
		  }else if(Mode == "NextPage"){
			  var url = 'Billing_Systems/recive_cash/find_data.php';
			  var pmeters = "tChqtran="		+ encodeURI(document.getElementById("sechqtran").value) +
					"&tChqtranlocat="	+ encodeURI(document.getElementById("sechqtranlocat").value) +
					"&tChqtranpayfor="	+ encodeURI(document.getElementById("sepayfor").value) +
					"&tChqtranbillno="	+ encodeURI(document.getElementById("sebillno").value) +
					"&tChqtranresvno="	+ encodeURI(document.getElementById("sechqtranresvno").value) +
					"&tChqtranchqno="	+ encodeURI(document.getElementById("sechqtranchqno").value) +
					"&tChqtrancuscod="	+ encodeURI(document.getElementById("sechqtrancuscod").value) +
					"&tChqtrannm="	+ encodeURI(document.getElementById("sechqtrancustnm").value) +
					"&tTmbilldt="	+ encodeURI(document.getElementById("txt_tmbilldt").value) +
					"&tPayfor="		+ encodeURI(document.getElementById("txt_payfor").value) +
					"&tRlocat="		+ encodeURI(document.getElementById("searothlocatsearch").value) +
					"&tRarcont="	+ encodeURI(document.getElementById("searothsale").value) +
					"&tRcuscod="	+ encodeURI(document.getElementById("searothcuscod").value) +
					"&tRcuscodnm="	+ encodeURI(document.getElementById("searothcuscodnm").value) +
					"&tCcustmast="	+ encodeURI(document.getElementById("secustmast").value) +
					"&tCnocard="	+ encodeURI(document.getElementById("secusnocard").value) +
					"&tCcusname="	+ encodeURI(document.getElementById("secusname1").value) +
					"&tCcuslname="	+ encodeURI(document.getElementById("secusname2").value) +
					"&tCgroup="		+ encodeURI(document.getElementById("secusgroup").value) +
					"&tCgrade="		+ encodeURI(document.getElementById("secusgrade").value) +
					"&tLocat="		+ encodeURI(document.getElementById("selocatsearch").value) +
					"&tContno="		+ encodeURI(document.getElementById("secontno").value) +
					"&tCuscod="		+ encodeURI(document.getElementById("secuscod").value) +
					"&tName="		+ encodeURI(document.getElementById("secuscodnm").value) +
					"&tResvno="		+ encodeURI(document.getElementById("seresvno").value) +
					"&tStrno="		+ encodeURI(document.getElementById("sestrno").value) +
			  		"&tType="		+ Type +
					"&tStat="		+ Stat +
					"&tSearch="		+ Search +
					"&tMode="		+ Mode;
		  }else if(Mode == "PreviousPage"){
			  var url = 'Billing_Systems/recive_cash/find_data.php';
			  var pmeters = "tChqtran="		+ encodeURI(document.getElementById("sechqtran").value) +
					"&tChqtranlocat="	+ encodeURI(document.getElementById("sechqtranlocat").value) +
					"&tChqtranpayfor="	+ encodeURI(document.getElementById("sepayfor").value) +
					"&tChqtranbillno="	+ encodeURI(document.getElementById("sebillno").value) +
					"&tChqtranresvno="	+ encodeURI(document.getElementById("sechqtranresvno").value) +
					"&tChqtranchqno="	+ encodeURI(document.getElementById("sechqtranchqno").value) +
					"&tChqtrancuscod="	+ encodeURI(document.getElementById("sechqtrancuscod").value) +
					"&tChqtrannm="	+ encodeURI(document.getElementById("sechqtrancustnm").value) +
					"&tTmbilldt="	+ encodeURI(document.getElementById("txt_tmbilldt").value) +
					"&tPayfor="		+ encodeURI(document.getElementById("txt_payfor").value) +
					"&tRlocat="		+ encodeURI(document.getElementById("searothlocatsearch").value) +
					"&tRarcont="	+ encodeURI(document.getElementById("searothsale").value) +
					"&tRcuscod="	+ encodeURI(document.getElementById("searothcuscod").value) +
					"&tRcuscodnm="	+ encodeURI(document.getElementById("searothcuscodnm").value) +
					"&tCcustmast="	+ encodeURI(document.getElementById("secustmast").value) +
					"&tCnocard="	+ encodeURI(document.getElementById("secusnocard").value) +
					"&tCcusname="	+ encodeURI(document.getElementById("secusname1").value) +
					"&tCcuslname="	+ encodeURI(document.getElementById("secusname2").value) +
					"&tCgroup="		+ encodeURI(document.getElementById("secusgroup").value) +
					"&tCgrade="		+ encodeURI(document.getElementById("secusgrade").value) +
					"&tLocat="		+ encodeURI(document.getElementById("selocatsearch").value) +
					"&tContno="		+ encodeURI(document.getElementById("secontno").value) +
					"&tCuscod="		+ encodeURI(document.getElementById("secuscod").value) +
					"&tName="		+ encodeURI(document.getElementById("secuscodnm").value) +
					"&tResvno="		+ encodeURI(document.getElementById("seresvno").value) +
					"&tStrno="		+ encodeURI(document.getElementById("sestrno").value) +
			  		"&tType="		+ Type +
					"&tStat="		+ Stat +
					"&tSearch="		+ Search +
					"&tMode="		+ Mode;
		  }else if(Mode == "PrintForm"){
			  var url = 'Billing_Systems/recive_cash/frmprint.php';
			  var pmeters = "tXidno=" + encodeURI(document.getElementById("txt_xidno").value) +
			  		"&tTmbill=" 	+ encodeURI(document.getElementById("txt_tmbill").value) +
			  		"&tType="		+ Type +
					"&tStat="		+ Stat +
					"&tSearch="		+ Search +
					"&tMode="		+ Mode;
		  }

			HttPRequest.open('POST',url,true);

			HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			HttPRequest.setRequestHeader("Content-length", pmeters.length);
			HttPRequest.setRequestHeader("Connection", "close");
			HttPRequest.send(pmeters);
			
			
			HttPRequest.onreadystatechange = function(){

				 if(HttPRequest.readyState == 3){
					 if(Mode == "SearchLocat"){
						 document.getElementById("mySearchLocat").value = "Now is Loading...";
					 }else if(Mode == "SearchOnClick"){
					 	 document.getElementById("mySearch"+Type).value = "Now is Loading...";
					 }else if(Mode == "SearchOnClickPaging"){
						 document.getElementById("mySearch"+Type).value	= "Now is Loading...";
					 }else if(Mode == "addPaytoList"){
						 document.getElementById("listpay").innerHTML = "now is loading...";
					 }else if(Mode == "SearchOnBlur"){
					 	var txtnm = Type+"nm";
						document.getElementById(txtnm).innerHTML	= "...";
					 }else if(Mode == "ViewDetail"){
						 document.getElementById("view_contract").innerHTML		= "now is loading...";
					 }else if(Mode == "MoneyToText"){
						 var nm = Stat+"nm";
						 document.getElementById(nm).innerHTML = "";
					 }else if(Mode == "totalMoneyToText"){
						 document.getElementById("txt_payamtnm").innerHTML = "";
					 }else if(Mode == "AuditContract"){
						 document.getElementById("chkaudit").innerHTML	= "";
					 }else if(Mode == "INSERT"){
						 document.getElementById("myInsert").innerHTML = "now is Loading...";
					 }else if(Mode == "UPDATE"){
						 document.getElementById("myInsert").innerHTML = "now is Loading...";
					 }else if(Mode == "REVOKE"){
						 document.getElementById("myInsert").innerHTML = "now is Loading...";
					 }else if(Mode == "SearchBill"){
						 document.getElementById("mySpanSearch").innerHTML = "now is loading...";
					 }else if(Mode == "SearchBillPaging"){
						 document.getElementById("mySpanSearch").innerHTML = "now is Loading...";
					 }else if(Mode == "NextPage"){
						 document.getElementById("mySearch"+Type).innerHTML	= "Now is Loading...";
					 }else if(Mode == "PreviousPage"){
						 document.getElementById("mySearch"+Type).innerHTML	= "Now is Loading...";
					 }else if(Mode == "PrintForm"){
						 document.getElementById("myInsert").innerHTML	= "now is loading...";
					 }
				 }// HttPRequest.readyState == 3

				if(HttPRequest.readyState == 4){ // Return Request
					
					if(Mode == "SearchOnClick"){
						document.getElementById("mySearch"+Type).innerHTML 		= HttPRequest.responseText;
						document.getElementById("imgLoad"+Type).style.display		= "none";
					}// SearchOnClick
					else if(Mode == "SearchOnClickPaging"){
						document.getElementById("mySearch"+Type).innerHTML 		= HttPRequest.responseText;
						document.getElementById("imgLoad"+Type).style.display		= "none";
					}//end SearchOnClickPaging
					else if(Mode == "addPaytoList"){
						document.getElementById("imgLoadlistpay").style.display		= "none";
						document.getElementById("listpay").innerHTML	= HttPRequest.responseText;
						var data = document.getElementById("listpay").innerHTML;
						var result = data.split("forMain");
						document.getElementById("listpay").innerHTML		= result[0];
						document.getElementById("txt_totalrow").value		= result[1];
						document.getElementById("txt_listpay").value		= result[2];
						document.getElementById("audit_contract").value		= result[3];
						document.getElementById("txt_tpayamt").value		= result[4];
						document.getElementById("send_cuscod").value		= result[5];
						////////////////////
						document.getElementById("txt_locat").readOnly		= true;
						document.getElementById("imgFindLocat").style.display	= "none";
						document.getElementById("txt_paytype").disabled		= true;
						document.getElementById("txt_contno").disabled		= true;
						document.getElementById("imgFindContno").style.display	= "none";
						document.getElementById("chkstat_onblurtmbill").value	= "addlist";
						document.getElementById("chkstat_onblurbillno").value	= "addlist";
					}//end addAddrtoList
					else if(Mode == "SearchOnBlur"){
						if(Type == "txt_locat"){
							document.getElementById("loadspan_locat").style.display = "none";
							document.getElementById("txt_locatnm").innerHTML		= HttPRequest.responseText;
							var chkstat_onblurtmbill = document.getElementById("chkstat_onblurtmbill").value;
							var chkstat_onblurbillno = document.getElementById("chkstat_onblurbillno").value;
							var data = document.getElementById("txt_locatnm").innerHTML;
							var result = data.split("|");
							if(data != ""){
								if(result[1] == "Xlocat"){
									document.getElementById("txt_locatnm").innerHTML = "<font color='#FF0000'>ไม่พบสาขา "+result[0]+"</font>";
									document.getElementById("locat").innerHTML = "<font color='#FF0000'>สาขาที่รับ&nbsp;:&nbsp;</font>";
									document.getElementById("chklocat").value	= "X";
								}else{
									document.getElementById("txt_locatnm").innerHTML = result[4];
									document.getElementById("locat").innerHTML = "สาขาที่รับ&nbsp;:&nbsp;";
									document.getElementById("chkrun_tmbill").value	= result[1];
									document.getElementById("chkrun_billno").value	= result[2];
									if(chkstat_onblurtmbill == "new"){
										if(result[1] == "Y"){
											document.getElementById("txt_tmbill").value		= "";
											document.getElementById("txt_tmbill").readOnly	= true;
											document.getElementById("txt_tmbill").disabled	= true;
											document.getElementById("txt_tmbillnm").innerHTML	= "รันโดยอัตโนมัติ";
											document.getElementById("chktmbill").value		= "X";
										}else{
											document.getElementById("txt_tmbill").value		= "";
											document.getElementById("txt_tmbill").readOnly	= false;
											document.getElementById("txt_tmbill").disabled	= false;
											document.getElementById("txt_tmbillnm").innerHTML	= "<font color='#FF0000'>กรุณาระบุเลขที่ใบรับชั่วคราว</font>";
											document.getElementById("chktmbill").value		= "";
										}//chk result[2] == "Y"
									}//chkstat_onblurtmbill
									if(chkstat_onblurbillno == "new"){
										if(result[2] == "Y"){
											document.getElementById("txt_billno").value		= "";
											document.getElementById("txt_billno").readOnly	= true;
											document.getElementById("txt_billno").disabled	= true;
											document.getElementById("txt_billnonm").innerHTML	= "รันโดยอัตโนมัติ";
											document.getElementById("chkbillno").value		= "X";
										}else{
											document.getElementById("txt_billno").value		= "";
											document.getElementById("txt_billno").readOnly	= false;
											document.getElementById("txt_billno").disabled	= false;
											document.getElementById("txt_billnonm").innerHTML	= "<font color='#FF0000'>กรุณาระบุเลขที่ใบเสร็จ</font>";
											document.getElementById("chkbillno").value		= "";
										}//chk result[3] == "Y"
									}//chkstat_onblurbillno
								}//chk result[0] == "Xlocat"
							}//chk data != ""
						}//type = txt_locat
						else if(Type == "txt_tmbilldt"){
							document.getElementById("txt_tmbilldtnm").innerHTML		= HttPRequest.responseText;
							var data = document.getElementById("txt_tmbilldtnm").innerHTML;
							var result = data.split("|");
							if(data != "|"){
								if(result[1] == "Xdate"){
									document.getElementById("txt_tmbilldtnm").innerHTML = "<font color='#FF0000'>กรุณาระบุวันที่ให้ถูกต้อง</font>";
									document.getElementById("tmbilldt").innerHTML = "<font color='#FF0000'>วันที่รับชำระ&nbsp;:&nbsp;</font>";
									document.getElementById("chktmbilldt").value	= "X";
								}else{
									document.getElementById("txt_tmbilldtnm").innerHTML = "";
									document.getElementById("tmbilldt").innerHTML = "วันที่รับชำระ&nbsp;:&nbsp;";
									document.getElementById("chktmbilldt").value	= "";
								}
							}
						}//Type txt_tmbilldt
						else if(Type == "txt_tmbill"){
							document.getElementById("loadspan_tmbill").style.display = "none";							
							document.getElementById("txt_tmbillnm").innerHTML		= HttPRequest.responseText;
							var data = document.getElementById("txt_tmbillnm").innerHTML;
							var result = data.split("|");
							//alert(data);
							if(data != "|"){
								var chkonblur = document.getElementById("chkstat_onblurtmbill").value;
								//alert(chkonblur);
								if(chkonblur == "new"){
									if(result[1] != "Ytmbill"){
										document.getElementById("txt_tmbillnm").innerHTML = "<font color='#FF0000'>เลขที่ "+result[0]+" นี้ถูกใช้แล้ว</font>";
										document.getElementById("tmbill").innerHTML = "<font color='#FF0000'>เลขที่ใบรับชั่วคราว&nbsp;:&nbsp;</font>";
										document.getElementById("chktmbill").value	= "X";
									}else{
										document.getElementById("txt_tmbillnm").innerHTML = result[0];
										document.getElementById("tmbill").innerHTML = "เลขที่ใบรับชั่วคราว&nbsp;:&nbsp;";
										document.getElementById("chktmbill").value	= "";
									}
								}else if(chkonblur == "revoke"){
									document.getElementById("txt_tmbillnm").innerHTML = "<font color='#FF0000'>"+result[0]+"</font>";
								}else if(chkonblur == "addlist"){
									document.getElementById("txt_tmbillnm").innerHTML = result[0];
									document.getElementById("tmbill").innerHTML = "เลขที่ใบรับชั่วคราว&nbsp;:&nbsp;";
									document.getElementById("chktmbill").value	= "";
								}
							}//chk data != ""
							else{
								document.getElementById("txt_tmbillnm").innerHTML = "<font color='#FF0000'>กรุณาระบุเลขที่ใบรับชั่วคราว       </font>";
							}
						}//Type = txt_tmbill
						else if(Type == "txt_billno"){
							document.getElementById("loadspan_billno").style.display = "none";
							document.getElementById("txt_billnonm").innerHTML		= HttPRequest.responseText;
							var data = document.getElementById("txt_billnonm").innerHTML;
							var result = data.split("|");
							if(data != "|"){
								var chkonblur = document.getElementById("chkstat_onblurbillno").value;
								if(chkonblur == "new"){
									if(result[1] != "Ybillno"){
										document.getElementById("txt_billnonm").innerHTML = "<font color='#FF0000'>เลขที่ "+result[0]+" นี้ถูกใช้แล้ว</font>";
										document.getElementById("billno").innerHTML = "<font color='#FF0000'>เลขที่ใบเสร็จ&nbsp;:&nbsp;</font>";
										document.getElementById("chkbillno").value	= "X";
									}else{
										document.getElementById("txt_billnonm").innerHTML = result[0];
										document.getElementById("billno").innerHTML = "เลขที่ใบเสร็จ&nbsp;:&nbsp;";
										document.getElementById("chkbillno").value	= "";
									}
								}else if(chkonblur == "revoke"){
									document.getElementById("txt_billnonm").innerHTML = "<font color='#FF0000'>"+result[0]+" </font>";
								}else if(chkonblur == "addlist"){
									document.getElementById("txt_billnonm").innerHTML = result[0];
									document.getElementById("billno").innerHTML = "เลขที่ใบเสร็จ&nbsp;:&nbsp;";
									document.getElementById("chkbillno").value	= "";
								}
							}//chk data != ""
							else{
								document.getElementById("txt_billnonm").innerHTML = "<font color='#FF0000'>กรุณาระบุเลขที่ใบเสร็จ</font>";
							}
						}//Type = txt_billno
						else if(Type == "txt_contno"){
							document.getElementById("loadspan_contno").style.display = "none";
							document.getElementById("txt_cuscod").innerHTML		= HttPRequest.responseText;
							var data = document.getElementById("txt_cuscod").innerHTML;
							var result = data.split("|");
							if(data != "|"){
								if(result[1] == "Xcontno"){
									document.getElementById("txt_cuscod").innerHTML = "<font color='#FF0000'>ไม่พบเลขที่สัญญา "+result[0]+"</font>";
									document.getElementById("contno").innerHTML = "<font color='#FF0000'>เลขที่สัญญา&nbsp;:&nbsp;</font>";
									document.getElementById("chkcontno").value	= "X";
									document.getElementById("txt_cuscodnm").innerHTML	= "";
									document.getElementById("txt_payamt").value			= "";
									document.getElementById("txt_payamtnm").innerHTML	= "";
									document.getElementById("txt_xcontno").value		= "";
									//document.getElementById("detail_contno").style.display = "";
								}else if(result[1] == "Xfull"){
									document.getElementById("txt_cuscod").innerHTML = "<font color='#FF0000'>"+result[2]+"</font>";
									document.getElementById("contno").innerHTML = "<font color='#FF0000'>เลขที่สัญญา&nbsp;:&nbsp;</font>";
									document.getElementById("chkcontno").value	= "X";
									document.getElementById("txt_cuscodnm").innerHTML	= "";
									document.getElementById("txt_payamt").value			= "";
									document.getElementById("txt_payamtnm").innerHTML	= "";
									document.getElementById("txt_xcontno").value		= "";
									//document.getElementById("detail_contno").style.display = "";
								}else if(result[1] == "Xempty"){
									document.getElementById("txt_cuscod").innerHTML = "<font color='#FF0000'>"+result[2]+"</font>";
									document.getElementById("contno").innerHTML = "<font color='#FF0000'>เลขที่สัญญา&nbsp;:&nbsp;</font>";
									document.getElementById("chkcontno").value	= "X";
									document.getElementById("txt_cuscodnm").innerHTML	= "";
									document.getElementById("txt_payamt").value			= "";
									document.getElementById("txt_payamtnm").innerHTML	= "";
									document.getElementById("txt_xcontno").value		= "";
									//document.getElementById("detail_contno").style.display = "";
								}else if(result[1] == "Xcancel"){
									document.getElementById("txt_cuscod").innerHTML = "<font color='#FF0000'>"+result[2]+"</font>";
									document.getElementById("contno").innerHTML = "<font color='#FF0000'>เลขที่สัญญา&nbsp;:&nbsp;</font>";
									document.getElementById("chkcontno").value	= "X";
									document.getElementById("txt_cuscodnm").innerHTML	= "";
									document.getElementById("txt_payamt").value			= "";
									document.getElementById("txt_payamtnm").innerHTML	= "";
									document.getElementById("txt_xcontno").value		= "";
									//document.getElementById("detail_contno").style.display = "";
								}else if(result[1] == "Xystat"){
									document.getElementById("txt_cuscod").innerHTML = "<font color='#FF0000'>"+result[2]+"</font>";
									document.getElementById("contno").innerHTML = "<font color='#FF0000'>เลขที่สัญญา&nbsp;:&nbsp;</font>";
									document.getElementById("chkcontno").value	= "X";
									document.getElementById("txt_cuscodnm").innerHTML	= "";
									document.getElementById("txt_payamt").value			= "";
									document.getElementById("txt_payamtnm").innerHTML	= "";
									document.getElementById("txt_xcontno").value		= "";
									//document.getElementById("detail_contno").style.display = "";
								}else if(result[1] == "Xstopv"){
									document.getElementById("txt_cuscod").innerHTML = "<font color='#FF0000'>"+result[2]+"</font>";
									document.getElementById("contno").innerHTML = "<font color='#FF0000'>เลขที่สัญญา&nbsp;:&nbsp;</font>";
									document.getElementById("chkcontno").value	= "X";
									document.getElementById("txt_cuscodnm").innerHTML	= "";
									document.getElementById("txt_payamt").value			= "";
									document.getElementById("txt_payamtnm").innerHTML	= "";
									document.getElementById("txt_xcontno").value		= "";
									//document.getElementById("detail_contno").style.display = "";
								}else if(result[1] == "Xdate"){
									document.getElementById("txt_cuscod").innerHTML = "<font color='#FF0000'>"+result[2]+"</font>";
									document.getElementById("contno").innerHTML = "<font color='#FF0000'>เลขที่สัญญา&nbsp;:&nbsp;</font>";
									document.getElementById("chkcontno").value	= "X";
									document.getElementById("txt_cuscodnm").innerHTML	= "";
									document.getElementById("txt_payamt").value			= "";
									document.getElementById("txt_payamtnm").innerHTML	= "";
									document.getElementById("txt_xcontno").value		= "";
									//document.getElementById("detail_contno").style.display = "";
								}else{
									document.getElementById("txt_cuscod").innerHTML 	= result[2];
									document.getElementById("txt_cuscodnm").innerHTML	= result[3];
									document.getElementById("txt_payamt").value			= result[4];
									document.getElementById("txt_payamtnm").innerHTML	= result[5];
									document.getElementById("txt_xcontno").value		= result[6];
									//document.getElementById("detail_contno").style.display = "";
									document.getElementById("contno").innerHTML = "เลขที่สัญญา&nbsp;:&nbsp;";
									document.getElementById("chkcontno").value	= "";
								}
							}//chk data != ""
							else{
								document.getElementById("txt_cuscod").innerHTML 	= "";
								document.getElementById("txt_cuscodnm").innerHTML	= "";
								document.getElementById("txt_payamt").value			= "";
								document.getElementById("txt_payamtnm").innerHTML	= "";
								document.getElementById("txt_xcontno").value		= "";
								//document.getElementById("detail_contno").style.display = "none";
								document.getElementById("contno").innerHTML = "<font color='#FF0000'>เลขที่สัญญา&nbsp;:&nbsp;</font>";
								document.getElementById("chkcontno").value	= "X";
							}
						}//Type = txt_contno
						else if(Type == "txt_resvno"){
							document.getElementById("loadspan_resvno").style.display = "none";
							document.getElementById("txt_resvnonm").innerHTML		= HttPRequest.responseText;
							var data = document.getElementById("txt_resvnonm").innerHTML;
							var result = data.split("|");
							if(data != "|"){
								if(result[1] == "Xresvno"){
									document.getElementById("txt_resvnonm").innerHTML = "<font color='#FF0000'>ไม่พบเลขที่ใบจอง</font>";
									document.getElementById("resvno").innerHTML = "<font color='#FF0000'>เลขที่ใบจอง&nbsp;:&nbsp;</font>";
									document.getElementById("chkresvno").value	= "X";
									document.getElementById("txt_cuscodnm").innerHTML	= "";
									document.getElementById("txt_payamt").value			= "";
									document.getElementById("txt_payamtnm").innerHTML	= "";
									document.getElementById("txt_xcontno").value		= "";
									//document.getElementById("detail_contno").style.display = "";
								}else if(result[1] == "Xfull"){
								}else if(result[1] == "Xempty"){
								}else if(result[1] == "Xcancel"){
								}else{
									document.getElementById("txt_resvno").value			= result[1];
									document.getElementById("txt_resvnonm").innerHTML	= "ยอดเงินที่ใช้ชำระได้ : <font color='#00CC00'>"+result[2]+"</font>";
									document.getElementById("txt_contno").value			= result[4];
									document.getElementById("txt_cuscod").innerHTML		= result[3];
									document.getElementById("txt_cuscodnm").innerHTML	= result[5];
									document.getElementById("resvno_balance").value		= result[6];
									document.getElementById("txt_contno").disabled		= false;
									document.getElementById("txt_contno").readOnly		= true;
									//document.getElementById("detail_contno").style.display	= "";
								}
							}//chk data != "|"
							else{
								document.getElementById("txt_resvnonm").innerHTML	= "";
								document.getElementById("txt_contno").value			= "";
								document.getElementById("txt_cuscod").innerHTML	= "";
								document.getElementById("txt_cuscodnm").innerHTML	= "";
								//document.getElementById("detail_contno").style.display	= "none";
								document.getElementById("resvno").innerHTML		= "เลขที่ใบจอง&nbsp;:&nbsp;";
								document.getElementById("chkresvno").value	= "";
							}
						}//Type == txt_resvno
						else if(Type == "txt_chqno"){
							document.getElementById("loadspan_chqno").style.display = "none";
							document.getElementById("txt_chqnonm").innerHTML	= HttPRequest.responseText;
							var data = document.getElementById("txt_chqnonm").innerHTML;
							var result = data.split("|");
							if(data != "|"){
								if(result[1] == "Xchqno"){
									document.getElementById("txt_chqnonm").innerHTML	= "<font color='#FF0000'>ไม่พบเลขที่เช็ค</font>";
									document.getElementById("chqno").innerHTML			= "<font color='#FF0000'>เลขที่เช็ค&nbsp;:&nbsp;</font>";
									document.getElementById("txt_chqstatdt1").innerHTML	= "วันที่เช็ค&nbsp;:&nbsp;";
									document.getElementById("txt_chqpay").innerHTML		= "ยอดเงินในเช็ค&nbsp;:&nbsp;-";
									document.getElementById("chkchqno").value		= "X";
									document.getElementById("txt_cuscod").innerHTML		= "";
									document.getElementById("txt_cuscodnm").innerHTML	= "";
									document.getElementById("txt_contno").value			= "";
									document.getElementById("txt_contno").disabled		= true;
									document.getElementById("txt_payamt").value			= "";
									document.getElementById("txt_payamtnm").innerHTML	= "";
									document.getElementById("txt_xcontno").value		= "";
									//document.getElementById("detail_contno").style.display = "";
								}else if(result[1] == "Xonhand" || result[1] == "Xreonhand"){
									document.getElementById("txt_chqnonm").innerHTML	= "<font color='#FF0000'>"+result[2]+"</font>";
									document.getElementById("chqno").innerHTML			= "เลขที่เช็ค&nbsp;:&nbsp;";
									document.getElementById("chkchqno").value			= "H";
									document.getElementById("txt_chqpay").innerHTML		= "ยอดเงินในเช็ค&nbsp;:&nbsp;-";
									document.getElementById("txt_chqstatdt1").innerHTML	= "วันที่เช็ค&nbsp;:&nbsp;";
								}else if(result[1] == "Xpayin"){
									document.getElementById("txt_chqnonm").innerHTML	= "<font color='#FF0000'>"+result[2]+"</font>";
									document.getElementById("chqno").innerHTML			= "เลขที่เช็ค&nbsp;:&nbsp;";
									document.getElementById("chkchqno").value			= "B";
									document.getElementById("txt_chqpay").innerHTML		= "ยอดเงินในเช็ค&nbsp;:&nbsp;-";
									document.getElementById("txt_chqstatdt1").innerHTML	= "วันที่เช็ค&nbsp;:&nbsp;";
								}else if(result[1] == "Xfull"){
									document.getElementById("txt_chqnonm").innerHTML	= "<font color='#FF0000'>"+result[2]+"</font>";
									document.getElementById("chqno").innerHTML			= "เลขที่เช็ค&nbsp;:&nbsp;";
									document.getElementById("chkchqno").value			= "F";
									document.getElementById("txt_chqpay").innerHTML		= "<font color='#FF0000'>ยอดเงินในเช็ค&nbsp;:&nbsp;0</font>";
									document.getElementById("txt_chqstatdt1").innerHTML	= "วันที่เช็ค&nbsp;:&nbsp;";
								}else{
									document.getElementById("txt_chqnonm").innerHTML	= "วันที่เช็ค&nbsp;:&nbsp;"+result[2];
									document.getElementById("chqno").innerHTML			= "เลขที่เช็ค&nbsp;:&nbsp;";
									document.getElementById("chkchqno").value			= "F";
									document.getElementById("txt_chqpay").innerHTML		= "ยอดเงินในเช็ค&nbsp;:&nbsp;"+result[4];
									document.getElementById("chqno_balance").value		= result[8];
									document.getElementById("txt_chqstatdt1").innerHTML	= "วันที่เช็คผ่าน&nbsp;:&nbsp;";
									document.getElementById("txt_chqstatdt2").innerHTML	= "&nbsp;"+result[3];
									document.getElementById("txt_cuscod").innerHTML		= result[5];
									document.getElementById("txt_cuscodnm").innerHTML	= result[6];
									document.getElementById("txt_contno").value			= result[7];
									document.getElementById("txt_contno").disabled		= false;
									document.getElementById("txt_contno").readOnly		= true;
								}
							}//chk data != "|"
							else{
								document.getElementById("txt_chqnonm").innerHTML	= "วันที่เช็ค&nbsp;:&nbsp;";
								document.getElementById("chqno").innerHTML			= "เลขที่เช็ค&nbsp;:&nbsp;";
								document.getElementById("chkchqno").value			= "F";
								document.getElementById("txt_chqpay").innerHTML		= "ยอดเงินในเช็ค&nbsp;:&nbsp;";
								document.getElementById("chqno_balance").value		= "";
								document.getElementById("txt_chqstatdt1").innerHTML	= "วันที่เช็คผ่าน&nbsp;:&nbsp;";
								document.getElementById("txt_chqstatdt2").innerHTML	= "";
								document.getElementById("txt_cuscod").innerHTML		= "";
								document.getElementById("txt_cuscodnm").innerHTML	= "";
							}
						}//type == txt_chqno
						else if(Type == "txt_trnpayment"){
							document.getElementById("loadspan_trnpayment").style.display = "none";
							document.getElementById("txt_trnpaymentnm").innerHTML	= HttPRequest.responseText;
							var data = document.getElementById("txt_trnpaymentnm").innerHTML;
							var result = data.split("|");
							if(data != "|"){
								if(result[1] == "Xtrnpayment"){
									document.getElementById("trnpayment").innerHTML		= "<font color='#FF0000'>เลขที่บัญชี&nbsp;:&nbsp;</font>";
									document.getElementById("txt_trnpaymentnm").innerHTML	= "<font color='#FF0000'>ไม่พบเลขที่บัญชี</font>";
								}else{
									document.getElementById("trnpayment").innerHTML		= "เลขที่บัญชี&nbsp;:&nbsp;";
									document.getElementById("txt_trnpaymentnm").innerHTML	= result[2];
								}
							}//chk data != "|"
							else{
								document.getElementById("trnpayment").innerHTML		= "เลขที่บัญชี&nbsp;:&nbsp;";
								document.getElementById("txt_trnpaymentnm").innerHTML	= "";
							}
						}//Type == txt_trnpayment
					}//Mode SearchOnBlur
					else if(Mode == "MoneyToText"){
						var nm = Stat + "nm";
						document.getElementById(nm).innerHTML = HttPRequest.responseText;
						var data = document.getElementById(nm).innerHTML;
						var result = data.split("|");				
						var id = Stat.split("_");
						var chk = "chk" + id[1];
						//document.getElementById(nm).innerHTML 	= result[0]; //แสดงจำนวนเงินเป็นตัวหนังสือ text
						
						if(result[1] == "X"){
							if(Stat == "txt_payamt"){
								document.getElementById("payamt").innerHTML = "<font color='#FF0000'>ยอดตัดลูกหนี้&nbsp;:&nbsp;</font>";
								document.getElementById("chkpayamt").value	= "X";
								document.getElementById(nm).innerHTML = "<font color='#FF0000'>"+result[0]+"</font>";
							}else if(Stat == "txt_disct"){
								document.getElementById("disct").innerHTML = "<font color='#FF0000'>ส่วนลด&nbsp;:&nbsp;</font>";
								document.getElementById("chkdisct").value	= "X";
								document.getElementById(nm).innerHTML = "<font color='#FF0000'>"+result[0]+"</font>";
							}else if(Stat == "txt_netpay"){
								document.getElementById("netpay").innerHTML = "<font color='#FF0000'>รับสุทธิ&nbsp;:&nbsp;</font>";
								document.getElementById("chknetpay").value	= "X";
								document.getElementById(nm).innerHTML = "<font color='#FF0000'>"+result[0]+"</font>";
							}
						}else{							
							if(Stat == "txt_payamt"){
								document.getElementById("payamt").innerHTML = "ยอดตัดลูกหนี้&nbsp;:&nbsp;";
								document.getElementById("chkpayamt").value	= "";
								document.getElementById(nm).innerHTML = result[0];
							}else if(Stat == "txt_disct"){
								document.getElementById("disct").innerHTML = "ส่วนลด&nbsp;:&nbsp;";
								document.getElementById("chkdisct").value	= "";
								document.getElementById(nm).innerHTML = result[0];
							}else if(Stat == "txt_netpay"){
								document.getElementById("netpay").innerHTML = "รับสุทธิ&nbsp;:&nbsp;";
								document.getElementById("chknetpay").value	= "";
								document.getElementById(nm).innerHTML = result[0];
							}
						}
					}//Mode = MoneyToText
					else if(Mode == "totalMoneyToText"){
						document.getElementById("txt_netpaynm").innerHTML = HttPRequest.responseText;
						var data = document.getElementById("txt_netpaynm").innerHTML;
						//alert(data);
						var result = data.split("|");
						document.getElementById("txt_payamtnm").innerHTML 	= result[0];
						document.getElementById("txt_disctnm").innerHTML	= result[1];
						document.getElementById("txt_netpaynm").innerHTML	= result[2];
					}//Mode == totalMoneyToText
					else if(Mode == "AuditContract"){
						document.getElementById("chkaudit").value = HttPRequest.responseText;
						var data = document.getElementById("chkaudit").value;
						var result = data.split("|");
						//alert(data);
					}//Mode == AuditContract
					else if(Mode == "INSERT"){
						document.getElementById("imgLoadInsert").style.display	= "none";
						document.getElementById("myInsert").innerHTML = HttPRequest.responseText;						
						var data = document.getElementById("myInsert").innerHTML;
						var result = data.split("forinsert");
						document.getElementById("myInsert").innerHTML 			= "<b>"+result[0]+"</b>";
						document.getElementById("txt_tmbill").disabled			= false;
						document.getElementById("txt_tmbill").readOnly			= true;
						document.getElementById("txt_billno").disabled			= false;
						document.getElementById("txt_billno").readOnly			= true;
						document.getElementById("txt_tmbill").value				= result[1];
						document.getElementById("txt_tmbillnm").innerHTML		= result[1];
						document.getElementById("txt_billno").value				= result[2];
						document.getElementById("txt_billnonm").innerHTML		= result[2];
						document.getElementById("txt_xidno").value				= result[3];
						document.getElementById("vwlist_pay").style.display		= "none";
						document.getElementById("NewPage").style.display		= "";
						document.getElementById("NewPage2").style.display		= "";
						document.getElementById("btInsert").style.display		= "none";
						document.getElementById("btCancel").style.display		= "none";
						document.getElementById("btRevoke").style.display		= "";
						document.getElementById("btPrint").disabled				= false;
					}//mode INSERT
					else if(Mode == "UPDATE"){
						document.getElementById("myInsert").innerHTML = HttPRequest.responseText;
						document.getElementById("imgLoadInsert").style.display	= "none";
						var data = document.getElementById("myInsert").innerHTML;												
					}//mode UPDATE
					else if(Mode == "REVOKE"){
						document.getElementById("imgLoadInsert").style.display		= "none";
						document.getElementById("myInsert").innerHTML	= HttPRequest.responseText;
						var data = document.getElementById("myInsert").innerHTML;
						var result = data.split("forrevoke");
						document.getElementById("myInsert").innerHTML		= "<font color='#FF0000'><b>"+result[0]+"</b></font>";
						document.getElementById("txt_tmbilldtnm").innerHTML	= "<font color='#FF0000'>"+result[1]+"</font>";
						document.getElementById("txt_tmbillnm").innerHTML 	= "<font color='#FF0000'>"+result[2]+"</font>";
						document.getElementById("txt_billnonm").innerHTML	= "<font color='#FF0000'>"+result[3]+"</font>";
						document.getElementById("btRevoke").style.display 	= "none";
					}//mode RevokePage
					else if(Mode == "SearchBill"){
						document.getElementById("imgLoadSearch").style.display	= "none";
						document.getElementById("mySpanSearch").innerHTML	= HttPRequest.responseText;
					}//mode SearchCashsell
					else if(Mode == "SearchBillPaging"){
						document.getElementById("mySpanSearch").innerHTML	= HttPRequest.responseText;
						document.getElementById("imgLoadSearchPaging").style.display	= "none";
					}//mode SearchCashsellPaging
					else if(Mode == "NextPage"){
						document.getElementById("imgLoad"+Type).style.display	= "none";
						document.getElementById("mySearch"+Type).innerHTML		= HttPRequest.responseText;
						document.getElementById("chkstat_onblurtmbill").value		= "upd";
						document.getElementById("chkstat_onblurbillno").value		= "upd";
					}//mode NextPage
					else if(Mode == "PreviousPage"){
						document.getElementById("imgLoad"+Type).style.display	= "none";
						document.getElementById("mySearch"+Type).innerHTML	= HttPRequest.responseText;
						document.getElementById("chkstat_onblurtmbill").value		= "upd";
						document.getElementById("chkstat_onblurbillno").value		= "upd";
					}//mode PreviousPage
					else if(Mode == "PrintForm"){
						document.getElementById("imgLoadInsert").style.display		= "none";
						document.getElementById("myInsert").innerHTML	= HttPRequest.responseText;
						if(Type == "Vouchers"){
							setTimeout("popup('Billing_Systems/recive_cash/MyPDF/Vouchers.pdf','form',800,600)",1000);
						}else if(Type == "Receipt"){
							setTimeout("popup('Billing_Systems/recive_cash/MyPDF/Receipt.pdf','form',800,600)",1000);
						}
					}//mode PrintForm
			}// HttPRequest.readyState == 4
		}//HttPRequest.onreadystatechange
	}
	function BackToMain_forcash(id){
		document.getElementById("showlocat").style.display		= "none";
		document.getElementById("showcontno").style.display		= "none";
		document.getElementById("showcontract").style.display	= "none";
		document.getElementById("showarothsale").style.display 	= "none";
		document.getElementById("showcustmast").style.display	= "none";
		document.getElementById("showresvno").style.display		= "none";
		document.getElementById("showchqno").style.display		= "none";
		document.getElementById("showtrnpayment").style.display	= "none";
		document.getElementById("showchqtran").style.display	= "none";
		document.getElementById("frmMain").style.display		= "";
		document.getElementById("viewDisplay").innerHTML		= "";
		document.getElementById("myInsert").innerHTML			= "";
		
	}
	function ShowSearch_forcash(id){		
		var payfor = document.getElementById("txt_payfor").value;
		var result = payfor.split("|");
		var txt	= "";
			if(id == "showcontract"){
				document.getElementById("imgLoadviewcontract").style.display = "";
				doSearchAjax_paid_back('ViewDetail','Type','Stat','Search');
				document.getElementById("txt_detail").value 	= "1";
				document.getElementById("txt_payment").value 	= "0";
				document.getElementById("txt_contract").value 	= "0";
				document.getElementById("txt_guarantee").value 	= "0";
				document.getElementById("txt_other").value 		= "0";
			}else if(id == "showlocat" || id == "showchqtran"){
				
			}else{
				if(result[0] == "001"){
					txt = "เลขที่สัญญาขายสินค้าเงินสด";
				}else if(result[0] == "002" || result[0] == "006" || result[0] == "007"){
					txt = "เลขที่สัญญาขายผ่อนเช่าซื้อ";
				}else if(result[0] == "005"){
					txt = "เลขที่สัญญาขายอุปกรณ์";
				}else if(result[0] == "008"){
					txt = "ใบจองสินค้า";
				}else if(result[0] == "901"){
					txt = "เลขที่สัญญาขายผ่อนเช่าซื้อ";
				}else if(result[0] == "301" || result[0] == "104" || result[0] == "201" || result[0] == "206" || result[0] == "207" || result[0] == "303" || result[0] == "304" || result[0] == "305" || result[0] == "301" || result[0] == "302" || result[0] == "902" || result[0] == "903" || result[0] == "904" || result[0] == "905" || result[0] == "906" || result[0] == "907" || result[0] == "908" || result[0] == "910" || result[0] == "911" || result[0] == "912" || result[0] == "932"){
					var date = document.getElementById("txt_tmbilldt").value;
					if(date != ""){
						if(confirm("ทำการตั้งลูกหนี้อื่นไว้แล้วหรือไม่ !!!") == true){
							txt = "เลขที่สัญญาขายผ่อนเช่าซื้อ";
							id = "showarothsale";
						}else{
							txt = "รหัสลูกค้า";
							id = "showcustmast";
						}
					}else{
						alert("กรุณาระบุวันที่ก่อน.");
					}
				}
			}
			
		document.getElementById("txtShowcontno").innerHTML	= "ค้นหา "+txt;
		document.getElementById("frmMain").style.display	= "none";
		document.getElementById(id).style.display	= "";
	}
	function SearchAjax_forcash(id){
		var nm = "";
		if(id == "locat"){
			nm = "สาขา";
		}else if(id == "contno"){
			nm = "เลขที่สัญญา";
		}else if(id == "arothsale"){
			nm = "เลขที่สัญญา";
		}else if(id == "custmast"){
			nm = "ลูกหนี้";
		}else if(id == "resvno"){
			nm = "เลขที่ใบจอง";
		}else if(id == "chqno"){
			nm = "เลขที่เช็ค";
		}else if(id == "trnpayment"){
			nm = "รหัสบัญชี";
		}else if(id == "chqtran"){
			nm = "ใบเสร็จรับเงิน";
		}
		document.getElementById("myInsert").innerHTML = "";
		var dataSearch = document.getElementById("se"+id).value;
		document.getElementById("imgLoad"+id).style.display 	= "";
		//document.getElementById("txtShow"+id).innerHTML		= "<font color='#FF6633'>ดับเบิ้ลคลิกเพื่อเลือก </font>"+nm;
		doSearchAjax_forcash('SearchOnClick',id,'Stat',dataSearch);
	}
	function nextPage_forcash(id,page,type,mode){
		document.getElementById("imgLoad"+mode).style.display 	= "";
		if(type == 'advance'){
			doSearchAjax_forcash('SearchOnClickPaging',mode,page,id);
		}else if(type == 'normal'){
			doSearchAjax_forcash('SearchOnClickPaging',mode,page,id);
		}
	}
	function SendDatatoMain_forcash(id,type,val){
		var result = val.split("|"); // ทำการแยก value ที่รับมา
		if(id == "locat"){
			document.getElementById("txt_locat").value 			= result[0];
			document.getElementById("txt_locatnm").innerHTML	= result[1];
			document.getElementById("chkrun_tmbill").value		= result[2];
			document.getElementById("chkrun_billno").value		= result[3];
				if(result[2] == "Y"){
					document.getElementById("txt_tmbill").value			= "";
					document.getElementById("txt_tmbill").disabled		= true;
					document.getElementById("txt_tmbillnm").innerHTML	= "รันโดนอัตโนมัติ";
					document.getElementById("chktmbill").value			= "";					
				}else{
					document.getElementById("txt_tmbill").value			= "";
					document.getElementById("txt_tmbill").disabled		= false;
					document.getElementById("txt_tmbillnm").innerHTML	= "<font color='#FF0000'>กรุณาระบุเลขที่ใบรับชั่วคราว</font>";
					document.getElementById("chktmbill").value			= "";				
				}
				if(result[3] == "Y"){
					document.getElementById("txt_billno").value			= "";
					document.getElementById("txt_billno").disabled		= true;
					document.getElementById("txt_billnonm").innerHTML	= "รันโดนอัตโนมัติ";
					document.getElementById("chkbillno").value			= "";
				}else{
					document.getElementById("txt_billno").value			= "";
					document.getElementById("txt_billno").disabled		= false;
					document.getElementById("txt_billnonm").innerHTML	= "<font color='#FF0000'>กรุณาระบุเลขที่ใบเสร็จ</font>";
					document.getElementById("chkbillno").value			= "";
				}
			document.getElementById("chklocat").value		= "";
			document.getElementById("locat").innerHTML	= "สาขาที่รับ&nbsp;:&nbsp;";
			BackToMain_forcash(id);
		}else if(id == "contno"){
			if(type == "001"){
				if(result[9] == "X"){
					alert("ไม่สามารถชำระเงินก่อนวันทำสัญญา");
				}else{
					if(result[5] == "C" || result[5] =="X"){
						alert("สัญญานี้ ถูกยกเลิกแล้ว !!!");
					}else if(result[5] == "B"){
						alert("สัญญานี้ ชำระเงินครบแล้ว !!!");
					}else{
						//document.getElementById("detail_contno").style.display	= "";
						document.getElementById("txt_contno").value			= result[0];
						document.getElementById("txt_cuscod").innerHTML		= result[1];
						document.getElementById("txt_cuscodnm").innerHTML	= result[2];
						document.getElementById("txt_payamt").value			= result[6];
						document.getElementById("txt_payamtnm").innerHTML	= result[7];
						document.getElementById("contno").innerHTML = "เลขที่สัญญา&nbsp;:&nbsp;";
						document.getElementById("chkcontno").value	= "";
						BackToMain_forcash(id);
					}
				}
			}else if(type == "002"){
				if(result[9] == "X"){
					alert("ไม่สามารถชำระเงินก่อนวันชำระล่าสุด");
				}else{
					if(result[5] == "C" || result[5] =="X"){
						alert("สัญญานี้ ถูกยกเลิกแล้ว !!!");
					}else if(result[5] == "D"){
						alert("สัญญานี้ ชำระเงินดาวน์ครบแล้ว !!!");
					}else if(result[5] == "A"){
						alert("สัญญานี้ ไม่ได้ระบุเงินดาวน์ !!!");
					}else{
						//document.getElementById("detail_contno").style.display	= "";
						document.getElementById("txt_contno").value			= result[0];
						document.getElementById("txt_cuscod").innerHTML		= result[1];
						document.getElementById("txt_cuscodnm").innerHTML	= result[2];
						document.getElementById("txt_payamt").value			= result[6];
						document.getElementById("txt_payamtnm").innerHTML	= result[7];
						document.getElementById("vw_alert").innerHTML		= "<font color='#FF0000'>"+result[8]+"</font>";
						document.getElementById("contno").innerHTML = "เลขที่สัญญา&nbsp;:&nbsp;";
						document.getElementById("chkcontno").value	= "";
						BackToMain_forcash(id);
					}
				}
			}else if(type == "003"){
				if(result[9] == "X"){
					alert("ไม่สามารถชำระเงินก่อนวันชำระล่าสุด");
				}else{
					if(result[5] == "C" || result[5] =="X"){
						alert("สัญญานี้ ถูกยกเลิกแล้ว !!!");
					}else if(result[5] == "D"){
						alert("สัญญานี้ ชำระเงินครบแล้ว !!!");
					}else{
						//document.getElementById("detail_contno").style.display	= "";
						document.getElementById("txt_contno").value			= result[0];
						document.getElementById("txt_cuscod").innerHTML		= result[1];
						document.getElementById("txt_cuscodnm").innerHTML	= result[2];
						document.getElementById("txt_payamt").value			= result[6];
						document.getElementById("txt_payamtnm").innerHTML	= result[7];
						document.getElementById("vw_alert").innerHTML		= "<font color='#FF0000'>"+result[8]+"</font>";
						document.getElementById("contno").innerHTML = "เลขที่สัญญา&nbsp;:&nbsp;";
						document.getElementById("chkcontno").value	= "";
						BackToMain_forcash(id);
					}
				}
			}else if(type == "004"){
				if(result[9] == "X"){
					alert("ไม่สามารถชำระเงินก่อนวันชำระล่าสุด");
				}else{
					if(result[5] == "C" || result[5] =="X"){
						alert("สัญญานี้ ถูกยกเลิกแล้ว !!!");
					}else if(result[5] == "D"){
						alert("สัญญานี้ ชำระเงินครบแล้ว !!!");
					}else{
						//document.getElementById("detail_contno").style.display	= "";
						document.getElementById("txt_contno").value			= result[0];
						document.getElementById("txt_cuscod").innerHTML		= result[1];
						document.getElementById("txt_cuscodnm").innerHTML	= result[2];
						document.getElementById("txt_payamt").value			= result[6];
						document.getElementById("txt_payamtnm").innerHTML	= result[7];
						document.getElementById("vw_alert").innerHTML		= "<font color='#FF0000'>"+result[8]+"</font>";
						document.getElementById("contno").innerHTML = "เลขที่สัญญา&nbsp;:&nbsp;";
						document.getElementById("chkcontno").value	= "";
						BackToMain_forcash(id);
					}
				}
			}else if(type == "005"){
				if(result[9] == "X"){
					alert("ไม่สามารถชำระเงินก่อนวันชำระล่าสุด");
				}else{
					if(result[5] == "C" || result[5] =="X"){
						alert("สัญญานี้ ถูกยกเลิกแล้ว !!!");
					}else if(result[5] == "D"){
						alert("สัญญานี้ ชำระเงินครบแล้ว !!!");
					}else{
						//document.getElementById("detail_contno").style.display	= "";
						document.getElementById("txt_contno").value			= result[0];
						document.getElementById("txt_cuscod").innerHTML		= result[1];
						document.getElementById("txt_cuscodnm").innerHTML	= result[2];
						document.getElementById("txt_payamt").value			= result[6];
						document.getElementById("txt_payamtnm").innerHTML	= result[7];
						document.getElementById("vw_alert").innerHTML		= "<font color='#FF0000'>"+result[8]+"</font>";
						document.getElementById("contno").innerHTML = "เลขที่สัญญา&nbsp;:&nbsp;";
						document.getElementById("chkcontno").value	= "";
						BackToMain_forcash(id);
					}
				}
			}else if(type == "006"){
				if(result[9] == "X"){
					alert("ไม่สามารถชำระเงินก่อนวันชำระล่าสุด");
				}else{
					if(result[5] == "C" || result[5] =="X"){
						alert("สัญญานี้ ถูกยกเลิกแล้ว !!!");
					}else if(result[5] == "B"){
						alert("สัญญานี้ เป็นสัญญาที่รถถูกยึด !!!");
					}else if(result[5] == "D"){
						alert("สัญญานี้ เป็นสัญญาที่ถูกหยุดภาษี กรุณายกเลิกการหยุดภาษีก่อน !!!");
					}else if(result[5] == "E"){
						alert("สัญญานี้ ชำระเงินค่างวดครบแล้ว");
					}else{
						//document.getElementById("detail_contno").style.display	= "";
						document.getElementById("txt_contno").value			= result[0];
						document.getElementById("txt_cuscod").innerHTML		= result[1];
						document.getElementById("txt_cuscodnm").innerHTML	= result[2];
						document.getElementById("txt_payamt").value			= result[6];
						document.getElementById("txt_payamtnm").innerHTML	= result[7];
						document.getElementById("vw_alert").innerHTML		= "<font color='#FF0000'>"+result[8]+"</font>";
						document.getElementById("contno").innerHTML = "เลขที่สัญญา&nbsp;:&nbsp;";
						document.getElementById("chkcontno").value	= "";
						BackToMain_forcash(id);
					}
				}
			}else if(type == "007"){
				if(result[9] == "X"){
					alert("ไม่สามารถชำระเงินก่อนวันชำระล่าสุด");
				}else{					
					if(result[5] == "C" || result[5] =="X"){
						alert("สัญญานี้ ถูกยกเลิกแล้ว !!!");
					}else if(result[5] == "A"){
						alert("สัญญานี้ เป็นสัญญาที่รถถูกยึด !!!");
					}else if(result[5] == "B"){
						alert("สัญญานี้ เป็นสัญญาที่ถูกหยุดภาษี กรุณายกเลิกการหยุดภาษีก่อน !!!");
					}else{
						//document.getElementById("detail_contno").style.display	= "";
						document.getElementById("txt_contno").value			= result[0];
						document.getElementById("txt_cuscod").innerHTML		= result[1];
						document.getElementById("txt_cuscodnm").innerHTML	= result[2];
						document.getElementById("txt_payamt").value			= result[6];
						document.getElementById("txt_payamtnm").innerHTML	= result[7];
						document.getElementById("vw_alert").innerHTML		= "<font color='#FF0000'>"+result[8]+"</font>";
						document.getElementById("contno").innerHTML = "เลขที่สัญญา&nbsp;:&nbsp;";
						document.getElementById("chkcontno").value	= "";
						BackToMain_forcash(id);
					}
				}
			}else if(type == "008"){
				if(result[9] == "X"){
					alert("ไม่สามารถชำระเงินก่อนวันทำสัญญา");
				}else{
					if(result[5] == "C" || result[5] =="X"){
						alert("สัญญานี้ ถูกยกเลิกแล้ว !!!");
					}else if(result[5] == "D"){
						alert("สัญญานี้ เป็นสัญญาที่รถถูกยึด !!!");
					}else if(result[5] == "B"){
						alert("สัญญานี้ เป็นสัญญาที่ถูกหยุดภาษี กรุณายกเลิกการหยุดภาษีก่อน !!!");
					}else{
						//document.getElementById("detail_contno").style.display	= "";
						document.getElementById("txt_contno").value			= result[0];
						document.getElementById("txt_cuscod").innerHTML		= result[1];
						document.getElementById("txt_cuscodnm").innerHTML	= result[2];
						document.getElementById("txt_payamt").value			= result[6];
						document.getElementById("txt_payamtnm").innerHTML	= result[7];
						document.getElementById("vw_alert").innerHTML		= "<font color='#FF0000'>"+result[8]+"</font>";
						document.getElementById("contno").innerHTML = "เลขที่สัญญา&nbsp;:&nbsp;";
						document.getElementById("chkcontno").value	= "";
						BackToMain_forcash(id);
					}
				}
			}else if(type == "901"){
				if(result[5] == "C" || result[5] =="X"){
					alert("สัญญานี้ ถูกยกเลิกแล้ว !!!");
				}else if(result[5] == "D"){
					alert("สัญญานี้ เป็นสัญญาที่รถถูกยึด !!!");
				}else if(result[5] == "B"){
					alert("สัญญานี้ เป็นสัญญาที่ถูกหยุดภาษี กรุณายกเลิกการหยุดภาษีก่อน !!!");
				}else{
					//document.getElementById("detail_contno").style.display	= "";
					document.getElementById("txt_contno").value			= result[0];
					document.getElementById("txt_cuscod").innerHTML		= result[1];
					document.getElementById("txt_cuscodnm").innerHTML	= result[2];
					document.getElementById("txt_payamt").value			= result[6];
					document.getElementById("txt_payamtnm").innerHTML	= result[7];
					document.getElementById("vw_alert").innerHTML		= "<font color='#FF0000'>"+result[8]+"</font>";
					document.getElementById("contno").innerHTML = "เลขที่สัญญา&nbsp;:&nbsp;";
					document.getElementById("chkcontno").value	= "";
					BackToMain_forcash(id);
				}
			}
		}else if(id == "arothsale"){
			if(result[9] == "X"){
					alert("ไม่สามารถชำระเงินก่อนวันทำสัญญา");
			}else{
				if(type == "902" || type == "903"){
					if(result[5] == "C"){
						alert("สัญญานี้ ชำระเงินครบแล้ว !!!");
					}else if(result[5] == "X"){
						alert("สัญญานี้ มีข้อผิดผลาดกรุณาตรวจสอบ !!!");
					}else{
						//document.getElementById("detail_contno").style.display	= "";
						document.getElementById("txt_contno").value			= result[0];
						document.getElementById("txt_cuscod").innerHTML		= result[1];
						document.getElementById("txt_cuscodnm").innerHTML	= result[2];
						document.getElementById("txt_payamt").value			= result[6];
						document.getElementById("txt_payamtnm").innerHTML	= result[7];
						document.getElementById("contno").innerHTML = "เลขที่สัญญา&nbsp;:&nbsp;";
						document.getElementById("chkcontno").value	= "";
						BackToMain_forcash(id);
					}
				}
			}
		}else if(id == "custmast"){
			if(type == "902" || type == "903"){
				//document.getElementById("detail_contno").style.display	= "";
				document.getElementById("txt_contno").value			= result[0];
				document.getElementById("txt_cuscod").innerHTML		= result[1];
				document.getElementById("txt_cuscodnm").innerHTML	= result[2];
				document.getElementById("txt_payamt").value			= result[6];
				document.getElementById("contno").innerHTML = "เลขที่สัญญา&nbsp;:&nbsp;";
				document.getElementById("chkcontno").value	= "";
				BackToMain_forcash(id);
			}
		}else if(id == "resvno"){
			//document.getElementById("detail_contno").style.display	= "";
			document.getElementById("txt_resvno").value			= result[0];
			document.getElementById("txt_resvnonm").innerHTML	= "ยอดเงินที่ใช้ชำระได้ : <font color='#00CC00'>"+result[1]+"</font>";
			document.getElementById("txt_contno").value			= result[2];
			document.getElementById("txt_cuscod").innerHTML		= result[3];
			document.getElementById("txt_cuscodnm").innerHTML	= result[4];
			document.getElementById("resvno_balance").value		= result[5];
			document.getElementById("txt_contno").disabled		= false;
			document.getElementById("txt_contno").readOnly		= true;
			document.getElementById("resvno").innerHTML = "เลขที่ใบจอง&nbsp;:&nbsp;";
			document.getElementById("chkresvno").value	= "";
			BackToMain_forcash(id);
		}else if(id == "chqno"){
			if(result[8] == "C"){
				alert("เช็คใบนี้ ถูกยกเลิกแล้ว");
			}else if(result[8] == "B"){
				alert("เช็คใบนี้ เป็นเช็ค on hand");
			}else if(result[8] == "D"){
				alert("เช็คใบนี้ เป็นเช็ค payin");
			}else if(result[8] == "Z"){
				alert("เช็คใบนี้ ยอดเงินคงเหลือเป็นศูนย์");
			}else{
				//document.getElementById("detail_contno").style.display	= "";
				document.getElementById("txt_chqno").value			= result[0];
				document.getElementById("txt_chqpay").innerHTML		= "ยอดเงินในเช็ค&nbsp;:&nbsp;"+result[1];
				document.getElementById("txt_chqnonm").innerHTML	= "วันที่เช็ค&nbsp;:&nbsp;"+result[6];
				document.getElementById("txt_chqstatdt1").innerHTML	= "วันที่เช็คผ่าน&nbsp;:&nbsp;";
				document.getElementById("txt_chqstatdt2").innerHTML	= "&nbsp;"+result[7];
				document.getElementById("chqno_balance").value		= result[2];
				document.getElementById("txt_contno").value			= result[3];
				document.getElementById("txt_cuscod").innerHTML		= result[4];
				document.getElementById("txt_cuscodnm").innerHTML	= result[5];
				document.getElementById("txt_contno").disabled		= false;
				document.getElementById("txt_contno").readOnly		= true;
				document.getElementById("chqno").innerHTML			= "เลขที่เช็ค&nbsp;:&nbsp;";
				document.getElementById("chkchqno").value			= "";
				BackToMain_forcash(id);
			}
		}else if(id == "trnpayment"){
			document.getElementById("txt_trnpayment").value			= result[0];
			document.getElementById("txt_trnpaymentnm").innerHTML	= result[1];
			BackToMain_forcash(id);
		}else if(id == "chqtran"){
			
		}
	}
	function Choose_forcash(id,type,val){
		if(type == "ok"){
			if(id == "locat"){
				var result = document.getElementById("hid_selocat").value;
				result = result.split("|");
				document.getElementById("txt_locat").value 			= result[0];
				document.getElementById("txt_locatnm").innerHTML	= result[1];		
				document.getElementById("chklocat").value			= "";
				document.getElementById("locat").innerHTML			= "สาขา&nbsp;:&nbsp;";
				BackToMain_forcash(id);
			}else if(id == "contno"){
				var result = document.getElementById("hid_secontno").value;
				result = result.split("|");
				document.getElementById("txt_contno").value 			= result[0];
				document.getElementById("txt_contnonm").innerHTML	= result[1];
				document.getElementById("txt_contno").focus();
				//document.getElementById("txt_payamt").value			= result[6];	
				document.getElementById("chkcontno").value			= "";
				document.getElementById("contno").innerHTML			= "เลขที่สัญญา&nbsp;:&nbsp;";
				BackToMain_forcash(id);
				document.getElementById("txt_contno").focus();
			}
		}else if(type == "choose"){
			var result = val.split("|");
			if(id == "locat"){
				document.getElementById("hid_selocat").value = val;
				document.getElementById("txtShowlocat").innerHTML		= "เลือก <font color='#FF6633'>"+result[1]+"</font>";
			}else if(id == "contno"){
				document.getElementById("hid_secontno").value = val;
				document.getElementById("txtShowcontno").innerHTML		= "เลือก <font color='#FF6633'>"+result[0]+"</font>";
			}
		}
	}
	function onChange_forcash(id,val){
		var result = val.split("|");
		if(id == "txt_paytype"){			
			if(result[0] == "00"){
				document.getElementById("for00").style.display		= "";
				document.getElementById("for02_1").style.display	= "none";
				document.getElementById("for02_2").style.display	= "none";
				document.getElementById("for03").style.display		= "none";
			}else if(result[0] == "02"){
				document.getElementById("for00").style.display		= "none";
				document.getElementById("for02_1").style.display	= "";
				document.getElementById("for02_2").style.display	= "";
				document.getElementById("for03").style.display		= "none";
			}else if(result[0] == "03"){
				document.getElementById("for00").style.display		= "none";
				document.getElementById("for02_1").style.display	= "none";
				document.getElementById("for02_2").style.display	= "none";
				document.getElementById("for03").style.display		= "";
			}else if(result[0] == "10"){
				document.getElementById("for00").style.display		= "none";
				document.getElementById("for02_1").style.display	= "none";
				document.getElementById("for02_2").style.display	= "none";
				document.getElementById("for03").style.display		= "none";
			}else if(result[0] == "20"){
				document.getElementById("for00").style.display		= "none";
				document.getElementById("for02_1").style.display	= "none";
				document.getElementById("for02_2").style.display	= "none";
				document.getElementById("for03").style.display		= "none";
			}else{
				document.getElementById("for00").style.display		= "none";
				document.getElementById("for02_1").style.display	= "none";
				document.getElementById("for02_2").style.display	= "none";
				document.getElementById("for03").style.display		= "none";
			}
			document.getElementById("txt_paytypenm").innerHTML = result[1];
		}else if(id == "txt_payfor"){
			var result = val.split("|");
			if(result[0] == "0"){
				document.getElementById("imgFindContno").style.display = "none";
				document.getElementById("txt_payfornm").innerHTML = "";
				document.getElementById("txt_contno").disabled = true;
			}else{
				document.getElementById("txt_contno").disabled = false;
				document.getElementById("txt_contno").readOnly = false;
				document.getElementById("txt_contno").value		= "";
				if(result[0] == "902" || result[0] == "903"){
					document.getElementById("imgFindContno").style.display = "";
					document.getElementById("txt_payfornm").innerHTML = result[1];
					document.getElementById("imgFindContno").innerHTML = "<a href=\"JavaScript:ShowSearch_forcash('showarothsale');\"><img src='images/search-icon.gif' border='0'/></a>";
				}else{
					document.getElementById("imgFindContno").style.display = "";
					document.getElementById("txt_payfornm").innerHTML = result[1];
					document.getElementById("imgFindContno").innerHTML = "<a href=\"JavaScript:ShowSearch_forcash('showcontno');\"><img src='images/search-icon.gif' border='0'/></a>";
					if(result[0] == "007"){
						document.getElementById("txt_payamt").readOnly = true;
						document.getElementById("txt_disct").readOnly = true;
					}else{
						document.getElementById("txt_payamt").readOnly = false;
						document.getElementById("txt_disct").readOnly = false;
					}
				}
			}
			//document.getElementById("txt_contno").value			= "";
			//document.getElementById("txt_cuscod").innerHTML		= "";
			//document.getElementById("txt_cuscodnm").innerHTML	= "";
			//document.getElementById("txt_payamt").value			= "";
			//document.getElementById("txt_payamtnm").innerHTML	= "";
			document.getElementById("txt_disct").value			= "";
			document.getElementById("txt_disctnm").innerHTML	= "";
			document.getElementById("txt_netpay").value			= "";
			document.getElementById("txt_netpaynm").innerHTML	= "";
			document.getElementById("mySearchcontno").innerHTML = "";
		}
	}
	function viewList_forcash(val,id){
		if(val == "detail"){
			document.getElementById("showDetail").style.display 		= "";
			document.getElementById("showPayment").style.display 		= "none";
			document.getElementById("showContract").style.display 		= "none";
			document.getElementById("showGuarantee").style.display 		= "none";
			document.getElementById("showOther").style.display 			= "none";
			//document.getElementById("LoadDetail").style.display			= "";
			//doSearch('SearchAddress',id,'Type','Stat');
		}else if(val == "payment"){
			document.getElementById("showDetail").style.display 		= "none";
			document.getElementById("showPayment").style.display 		= "";
			document.getElementById("showContract").style.display 		= "none";
			document.getElementById("showGuarantee").style.display 		= "none";
			document.getElementById("showOther").style.display 			= "none";
		}else if(val == "contract"){
			document.getElementById("showDetail").style.display 		= "none";
			document.getElementById("showPayment").style.display 		= "none";
			document.getElementById("showContract").style.display 		= "";
			document.getElementById("showGuarantee").style.display 		= "none";
			document.getElementById("showOther").style.display 			= "none";
		}else if(val == "guarantee"){
			document.getElementById("showDetail").style.display 		= "none";
			document.getElementById("showPayment").style.display 		= "none";
			document.getElementById("showContract").style.display 		= "none";
			document.getElementById("showGuarantee").style.display 		= "";
			document.getElementById("showOther").style.display 			= "none";
		}else if(val == "other"){
			document.getElementById("showDetail").style.display 		= "none";
			document.getElementById("showPayment").style.display 		= "none";
			document.getElementById("showContract").style.display 		= "none";
			document.getElementById("showGuarantee").style.display 		= "none";
			document.getElementById("showOther").style.display 			= "";
		}
	}
	function changeColorTb_forcash(id,val){
		var a1 = document.getElementById("txt_detail").value;
		var a2 = document.getElementById("txt_payment").value;
		var a3 = document.getElementById("txt_contract").value;
		var a4 = document.getElementById("txt_guarantee").value;
		var a5 = document.getElementById("txt_other").value;
		if(val == "click"){
			if(id == "tab_detail"){
				document.getElementById("tab_detail").style.backgroundColor 	= "#99FF33";
				document.getElementById("tab_payment").style.backgroundColor	= "#88C4FF";
				document.getElementById("tab_contract").style.backgroundColor	= "#88C4FF";
				document.getElementById("tab_guarantee").style.backgroundColor	= "#88C4FF";
				document.getElementById("tab_other").style.backgroundColor		= "#88C4FF";
				document.getElementById("txt_detail").value 		= "1";
				document.getElementById("txt_payment").value 		= "0";
				document.getElementById("txt_contract").value 		= "0";
				document.getElementById("txt_guarantee").value		= "0";
				document.getElementById("txt_other").value 			= "0";
			}else if(id=="tab_payment"){
				document.getElementById("tab_detail").style.backgroundColor 	= "#88C4FF";
				document.getElementById("tab_payment").style.backgroundColor	= "#99FF33";
				document.getElementById("tab_contract").style.backgroundColor	= "#88C4FF";
				document.getElementById("tab_guarantee").style.backgroundColor	= "#88C4FF";
				document.getElementById("tab_other").style.backgroundColor		= "#88C4FF";
				document.getElementById("txt_detail").value 		= "0";
				document.getElementById("txt_payment").value 		= "1";
				document.getElementById("txt_contract").value 		= "0";
				document.getElementById("txt_guarantee").value		= "0";
				document.getElementById("txt_other").value 			= "0";
			}else if(id == "tab_contract"){
				document.getElementById("tab_detail").style.backgroundColor 	= "#88C4FF";
				document.getElementById("tab_payment").style.backgroundColor	= "#88C4FF";
				document.getElementById("tab_contract").style.backgroundColor	= "#99FF33";
				document.getElementById("tab_guarantee").style.backgroundColor	= "#88C4FF";
				document.getElementById("tab_other").style.backgroundColor		= "#88C4FF";
				document.getElementById("txt_detail").value 		= "0";
				document.getElementById("txt_payment").value 		= "0";
				document.getElementById("txt_contract").value 		= "1";
				document.getElementById("txt_guarantee").value		= "0";
				document.getElementById("txt_other").value 			= "0";
			}else if(id == "tab_guarantee"){
				document.getElementById("tab_detail").style.backgroundColor 	= "#88C4FF";
				document.getElementById("tab_payment").style.backgroundColor	= "#88C4FF";
				document.getElementById("tab_contract").style.backgroundColor	= "#88C4FF";
				document.getElementById("tab_guarantee").style.backgroundColor	= "#99FF33";
				document.getElementById("tab_other").style.backgroundColor		= "#88C4FF";
				document.getElementById("txt_detail").value 		= "0";
				document.getElementById("txt_payment").value 		= "0";
				document.getElementById("txt_contract").value 		= "0";
				document.getElementById("txt_guarantee").value		= "1";
				document.getElementById("txt_other").value 			= "0";
			}else if(id == "tab_other"){
				document.getElementById("tab_detail").style.backgroundColor 	= "#88C4FF";
				document.getElementById("tab_payment").style.backgroundColor	= "#88C4FF";
				document.getElementById("tab_contract").style.backgroundColor	= "#88C4FF";
				document.getElementById("tab_guarantee").style.backgroundColor	= "#88C4FF";
				document.getElementById("tab_other").style.backgroundColor		= "#99FF33";
				document.getElementById("txt_detail").value 		= "0";
				document.getElementById("txt_payment").value 		= "0";
				document.getElementById("txt_contract").value 		= "0";
				document.getElementById("txt_guarantee").value		= "0";
				document.getElementById("txt_other").value 			= "1";
			}
		}else if(val == "move"){
			if(id == "tab_detail" && a1 == "0"){
				document.getElementById("tab_detail").style.backgroundColor 		= "#3399FF";
			}else if(id == "tab_payment" && a2 == "0"){
				document.getElementById("tab_payment").style.backgroundColor 		= "#3399FF";
			}else if(id == "tab_contract" && a3 == "0"){
				document.getElementById("tab_contract").style.backgroundColor 		= "#3399FF";
			}else if(id == "tab_guarantee" && a4 == "0"){
				document.getElementById("tab_guarantee").style.backgroundColor 		= "#3399FF";
			}else if(id == "tab_other" && a4 == "0"){
				document.getElementById("tab_other").style.backgroundColor 			= "#3399FF";
			}
		}else if(val == "out"){
			if(id == "tab_detail" && a1 == "0"){
				document.getElementById("tab_detail").style.backgroundColor 		= "#88C4FF";
			}else if(id == "tab_payment" && a2 == "0"){
				document.getElementById("tab_payment").style.backgroundColor 		= "#88C4FF";
			}else if(id == "tab_contract" && a3 == "0"){
				document.getElementById("tab_contract").style.backgroundColor 		= "#88C4FF";
			}else if(id == "tab_guarantee" && a4 == "0"){
				document.getElementById("tab_guarantee").style.backgroundColor 		= "#88C4FF";
			}else if(id == "tab_other" && a4 == "0"){
				document.getElementById("tab_other").style.backgroundColor 			= "#88C4FF";
			}
		}
	}
	function OnblurSearch_forcash(id,val){
		if(id == "txt_locat"){
			document.getElementById("loadspan_locat").style.display	= "";
			document.getElementById("txt_locatnm").innerHTML	= "";
		}else if(id == "txt_tmbill"){
			document.getElementById("loadspan_tmbill").style.display = "";
			document.getElementById("txt_tmbillnm").innerHTML	= "";
		}else if(id == "txt_billno"){
			document.getElementById("loadspan_billno").style.display = "";
			document.getElementById("txt_billnonm").innerHTML	= "";
		}else if(id == "txt_contno"){
			document.getElementById("loadspan_contno").style.display	= "";
			document.getElementById("txt_cuscod").innerHTML	= "";
		}else if(id == "txt_resvno"){
			document.getElementById("loadspan_resvno").style.display	= "";
			document.getElementById("txt_resvnonm").innerHTML	= "";
		}else if(id == "txt_chqno"){
			document.getElementById("loadspan_chqno").style.display		= "";
			document.getElementById("txt_chqnonm").innerHTML	= "";
		}else if(id == "txt_trnpayment"){
			document.getElementById("loadspan_trnpayment").style.display = "";
			document.getElementById("txt_trnpaymentnm").innerHTML	= "";
		}
		///////////////////////////////////////////
		doSearchAjax_forcash('SearchOnBlur',id,'Stat',val);
	}
	function blurMoney_forcash(id,val){
		var payamt = parseFloat(strMoney(document.getElementById("txt_payamt").value));
			if(document.getElementById("txt_disct").value == ""){
				document.getElementById("txt_disct").value	= 0;
			}
		var disct = parseFloat(strMoney(document.getElementById("txt_disct").value));		
		if(id == "txt_payamt"){
			doSearchAjax_forcash('MoneyToText',formatMoney(val),'txt_payamt',val);
			document.getElementById("txt_payamt").value = formatMoney(payamt);
			if(disct == "" || disct == 0){
				document.getElementById("txt_netpay").value = formatMoney(payamt);
			}else{
				var netpay = payamt - disct;
				document.getElementById("txt_netpay").value = formatMoney(netpay);
			}
		}else if(id == "txt_disct"){
			var payamt = strMoney(document.getElementById("txt_payamt").value);
			doSearchAjax_forcash('MoneyToText',formatMoney(payamt),'txt_payamt',payamt);
			var netpay = payamt - disct;
			document.getElementById("txt_netpay").value = formatMoney(netpay);
			doSearchAjax_forcash('MoneyToText',formatMoney(val),id,val);
		}else if(id == "txt_netpay"){
			var netpay = payamt - disct;
			document.getElementById("txt_netpay").value = formatMoney(netpay);
			doSearchAjax_forcash('MoneyToText',formatMoney(val),id,val);
		}
	}
	function onKeyUp_forcash(id,val){
		var payamt = parseFloat(strMoney(document.getElementById("txt_payamt").value));
		if(document.getElementById("txt_disct").value == ""){
			document.getElementById("txt_disct").value	= 0;
		}
		var disct = parseFloat(strMoney(document.getElementById("txt_disct").value));
		/////////////////////////
		if(id == "txt_payamt"){
			if(disct == "" || disct == 0){
				document.getElementById("txt_netpay").value = formatMoney(payamt);
				doSearchAjax_forcash('MoneyToText',formatMoney(val),'txt_netpay',val);
			}else{
				var netpay = payamt - disct;
				document.getElementById("txt_netpay").value = formatMoney(netpay);
				doSearchAjax_forcash('MoneyToText',formatMoney(netpay),'txt_netpay',netpay);
			}			
		}else if(id == "txt_disct"){
			var netpay = payamt - disct;
			document.getElementById("txt_netpay").value = formatMoney(netpay);
			doSearchAjax_forcash('MoneyToText',formatMoney(netpay),'txt_netpay',netpay);
		}
	}
	function CalNetpay(id,val){
		doSearchAjax_forcash('MoneyToText',formatMoney(val),id,val);
	}
	function addListPay(){
		var paytype 	= document.getElementById("txt_paytype").value;
		var payfor 		= document.getElementById("txt_payfor").value;
		var ss 			= payfor.split("|");
		var xpayfor 	= ss[0];
		var contno 		= document.getElementById("txt_contno").value;
		var chkcontno 	= document.getElementById("chkcontno").value;
		var payamt 		= document.getElementById("txt_payamt").value;
		var xpayamt		= parseFloat(document.getElementById("txt_payamt").value);
		var chkpayamt	= document.getElementById("chkpayamt").value;
		var disct 		= document.getElementById("txt_disct").value;
		var xdisct 		= parseFloat(document.getElementById("txt_disct").value);
		var chkdisct	= document.getElementById("chkdisct").value;
		var netpay 		= document.getElementById("txt_netpay").value;
		var xnetpay 	= parseFloat(document.getElementById("txt_netpay").value);
		var chknetpay 	= document.getElementById("chknetpay").value;
		var chqmasid	= document.getElementById("txt_chqmasid").value;
		var payflag		= "D";
		var paystatus	= "new";
		var cuscod		= document.getElementById("txt_cuscod").innerHTML;
		var cuscodnm	= document.getElementById("txt_cuscodnm").innerHTML;
		var strpaytype	= document.getElementById("txt_paytypenm").innerHTML;
		var strpayfor	= document.getElementById("txt_payfornm").innerHTML;
		var strpayamt	= document.getElementById("txt_payamtnm").innerHTML;
		var strdisct	= document.getElementById("txt_disctnm").innerHTML;
		var strnetpay	= document.getElementById("txt_netpaynm").innerHTML;
		//////////
		var listpay 	= document.getElementById("txt_listpay").value;
		var listpayfor 	= document.getElementById("txt_listpayfor").value;
		var audit 		= document.getElementById("audit_contract").value;
		var xaudit		= audit.split("^");
		var chkaudit	= document.getElementById("chkaudit").value;
		//////////
		if(paytype == ""){
			alert("กรุณาระบุ ชำระโดย");
			document.getElementById("txt_paytype").focus();
		}else if(payfor == "0|0"){
			alert("กรุณาระบุ รหัสชำระ");
			document.getElementById("txt_payfor").focus();
		}else if(contno == ""){
			alert("กรุณาระบุ เลขที่สัญญา");
			document.getElementById("txt_contno").focus();
		}else if(chkcontno == "X"){
			alert("กรุณาตรวจสอบ เลขที่สัญญา");
			document.getElementById("txt_contno").focus();
		}else if(payamt == ""){
			alert("กรุณาระบุ ยอดตัดลูกหนี้");
			document.getElementById("txt_payamt").focus();
		}else if(chkpayamt == "X"){
			alert("กรุณาตรวจสอบ ยอดตัดลูกหนี้");
			document.getElementById("txt_payamt").focus();
		}else if(chkdisct == "X"){
			alert("กรุณาตรวจสอบ ส่วนลด");
			document.getElementById("txt_disct").focus();
		}else if(netpay == ""){
			alert("กรุณาระบุ รับสุทธิ");
			document.getElementById("txt_netpay").focus();
		}else if(chknetpay == "X"){
			alert("กรุณาตรวจสอบ รับสุทธิ");
			document.getElementById("txt_netpay").focus();
		}else if(xpayamt <= 0){
			alert("ยอดตัดลูกหนี้ห้ามน้อยกว่า ศูนย์");
		}else if(xdisct < 0){
			alert("ส่วนลดห้ามน้อยกว่า ศูนย์");
		}else if(xnetpay <= 0){
			alert("รับสุทธิห้ามน้อยกว่า ศูนย์");
		}else{
			if(chkCodePayFor(listpayfor,xpayfor) == "Y"){
				if(chkStrCompare(listpayfor,xpayfor) == "Y"){
					if(chkaudit == "Y"){
						var pay = paytype+"^"+payfor+"^"+contno+"^"+payamt+"^"+disct+"^"+netpay+"^"+chqmasid+"^"+payflag+"^"+paystatus+"^"+cuscod+"^"+cuscodnm+"^"+strpayamt+"^"+strdisct+"^"+strnetpay+"^"+strpaytype+"^"+strpayfor;
						//alert(pay);
						var xlistpay = listpay+"#"+pay;
						var xlistpayfor = listpayfor+"#"+xpayfor;
						document.getElementById("txt_listpay").value = xlistpay;
						document.getElementById("txt_listpayfor").value = xlistpayfor;
						//document.getElementById("audit_contract").value	= Xaudit;
						addPaidtoList(xlistpay);
					}else{
						alert("เลขที่สัญญา "+contno+" นี้ไม่สัมพันธ์กับเลขสัญญา "+xaudit[0]);
						document.getElementById("txt_contno").focus();
					}
				}else{
					alert("รายการชำระซ้ำกัน กรุณาตรวจสอบรหัสชำระ.");
					document.getElementById("txt_payfor").focus();
				}
			}else{
				alert("ไม่สามารถชำระ "+payfor+" พร้อมกับรายการอื่นได้");
				document.getElementById("txt_payfor").focus();
			}
		}
	}
	function chktotalMoney(){
		var a = document.getElementById("txt_payamt").value;
		var b = document.getElementById("txt_disct").value;
		var c = document.getElementById("txt_netpay").value;
		doSearchAjax_forcash('totalMoneyToText',a,b,c);
	}
	function audit_contract(xcontno,xpayfor,contno,payfor){
		var audit 		= document.getElementById("audit_contract").value;
		if(audit != ""){
			doSearchAjax_forcash('AuditContract',xcontno,xpayfor,contno+"^"+payfor);
		}else{
			document.getElementById("chkaudit").value = "Y";
		}
	}
	function confirmAddlist(){
		var audit 		= document.getElementById("audit_contract").value;
		var xaudit		= audit.split("^");
		var payfor		= document.getElementById("txt_payfor").value;
		var ss 			= payfor.split("|");
		var xpayfor 	= ss[0];
		var contno 		= document.getElementById("txt_contno").value;
		audit_contract(xaudit[0],xaudit[1],contno,xpayfor);
		var paytype		= document.getElementById("txt_paytype").value;
		var xs			= paytype.split("|");
		var xpaytype	= xs[0];
		if(xpaytype == "00"){
			var balance = parseFloat(document.getElementById("resvno_balance").value);
			var payamt	= parseFloat(strMoney(document.getElementById("txt_payamt").value));
			if(payamt > balance){
				alert("ยอดตัดลูกหนี้ มากกว่ายอดเงินจองที่สามารถใช้ชำระได้.");
			}else{
				if(payfor != "0|0"){
					if(confirm("เพิ่มรายการ "+payfor) == true){
						document.getElementById("btAdd").focus();
						addListPay();
					}
				}else{
					alert("กรุณาเลือกรหัสชำระ.");
					document.getElementById("txt_payfor").focus();
				}
			}
		}else if(xpaytype == "01"){
			if(payfor != "0|0"){
				if(confirm("เพิ่มรายการ "+payfor) == true){
					document.getElementById("btAdd").focus();
					addListPay();
				}
			}else{
				alert("กรุณาเลือกรหัสชำระ.");
				document.getElementById("txt_payfor").focus();
			}
		}else if(xpaytype == "02"){
			var balance = parseFloat(document.getElementById("chqno_balance").value);
			var payamt	= parseFloat(strMoney(document.getElementById("txt_payamt").value));
			if(payamt > balance){
				alert("ยอดตัดลูกหนี้ มากกว่ายอดเงินในเช็ค.");
			}else{
				if(paytype != "0|0"){
					if(confirm("เพิ่มรายการ "+payfor) == true){
						document.getElementById("btAdd").focus();
						addListPay();
					}
				}else{
					alert("กรุณาเลือกรหัสชำระ.");
					document.getElementById("txt_payfor").focus();
				}
			}
		}
	}
	function addPaidtoList(val){
		document.getElementById("imgLoadlistpay").style.display = "";
		doSearchAjax_forcash('addPaytoList','Type','Stat',val);
		ClearText_forcash();
	}
	function ClearText_forcash(){
		document.getElementById("txt_payfor").value			= "0|0";
		document.getElementById("txt_payfornm").innerHTML	= "";
		document.getElementById("txt_contno").value			= "";
		document.getElementById("txt_cuscod").innerHTML		= "";
		document.getElementById("txt_cuscodnm").innerHTML	= "";
		document.getElementById("txt_payamt").value			= "";
		document.getElementById("txt_payamtnm").innerHTML	= "";
		document.getElementById("txt_disct").value			= "";
		document.getElementById("txt_disctnm").innerHTML	= "";
		document.getElementById("txt_netpay").value			= "";
		document.getElementById("txt_netpaynm").innerHTML	= "";
		document.getElementById("detail_contno").style.display = "none";
		document.getElementById("vw_alert").style.display	= "none";
		document.getElementById("PayUpdate").style.display	= "none";
	}
	function chkCodePayFor(data,chk){
		if(data != ""){
			if(chk == "001"){
				if(chkStrCompare(data,"002") != "Y"){
					return "X";
				}else if(chkStrCompare(data,"003") != "Y"){
					return "X";
				}else if(chkStrCompare(data,"004") != "Y"){
					return "X";
				}else if(chkStrCompare(data,"006") != "Y"){
					return "X";
				}else if(chkStrCompare(data,"007") != "Y"){
					return "X";
				}else if(chkStrCompare(data,"008") != "Y"){
					return "X";
				}else if(chkStrCompare(data,"901") != "Y"){
					return "X";
				}else if(chkStrCompare(data,"902") != "Y"){
					return "X";
				}else if(chkStrCompare(data,"903") != "Y"){
					return "X";
				}else{
					return "Y";
				}
			}else if(chk == "002"){
				if(chkStrCompare(data,"001") != "Y"){
					return "X";
				}else if(chkStrCompare(data,"003") != "Y"){
					return "X";
				}else if(chkStrCompare(data,"004") != "Y"){
					return "X";
				}else if(chkStrCompare(data,"007") != "Y"){
					return "X";
				}else if(chkStrCompare(data,"008") != "Y"){
					return "X";
				}else if(chkStrCompare(data,"902") != "Y"){
					return "X";
				}else if(chkStrCompare(data,"903") != "Y"){
					return "X";
				}else{
					return "Y";
				}
			}else if(chk == "003"){
				if(chkStrCompare(data,"001") != "Y"){
					return "X";
				}else if(chkStrCompare(data,"002") != "Y"){
					return "X";
				}else if(chkStrCompare(data,"006") != "Y"){
					return "X";
				}else if(chkStrCompare(data,"007") != "Y"){
					return "X";
				}else if(chkStrCompare(data,"008") != "Y"){
					return "X";
				}else if(chkStrCompare(data,"901") != "Y"){
					return "X";
				}else if(chkStrCompare(data,"902") != "Y"){
					return "X";
				}else if(chkStrCompare(data,"903") != "Y"){
					return "X";
				}else{
					return "Y";
				}
			}else if(chk == "004"){
				if(chkStrCompare(data,"001") != "Y"){
					return "X";
				}else if(chkStrCompare(data,"002") != "Y"){
					return "X";
				}else if(chkStrCompare(data,"006") != "Y"){
					return "X";
				}else if(chkStrCompare(data,"007") != "Y"){
					return "X";
				}else if(chkStrCompare(data,"008") != "Y"){
					return "X";
				}else if(chkStrCompare(data,"901") != "Y"){
					return "X";
				}else if(chkStrCompare(data,"902") != "Y"){
					return "X";
				}else if(chkStrCompare(data,"903") != "Y"){
					return "X";
				}else{
					return "Y";
				}
			}else if(chk == "005"){
				if(chkStrCompare(data,"008") != "Y"){
					return "X";
				}else{
					return "Y";
				}
			}else if(chk == "006"){
				if(chkStrCompare(data,"001") != "Y"){
					return "X";
				}else if(chkStrCompare(data,"003") != "Y"){
					return "X";
				}else if(chkStrCompare(data,"004") != "Y"){
					return "X";
				}else if(chkStrCompare(data,"007") != "Y"){
					return "X";
				}else if(chkStrCompare(data,"008") != "Y"){
					return "X";
				}else{
					return "Y";
				}
			}else if(chk == "007"){
				if(chkStrCompare(data,"001") != "Y"){
					return "X";
				}else if(chkStrCompare(data,"003") != "Y"){
					return "X";
				}else if(chkStrCompare(data,"004") != "Y"){
					return "X";
				}else if(chkStrCompare(data,"006") != "Y"){
					return "X";
				}else if(chkStrCompare(data,"008") != "Y"){
					return "X";
				}else{
					return "Y";
				}
			}else if(chk == "008"){
				if(chkStrCompare(data,"001") != "Y"){
					return "X";
				}else if(chkStrCompare(data,"002") != "Y"){
					return "X";
				}else if(chkStrCompare(data,"003") != "Y"){
					return "X";
				}else if(chkStrCompare(data,"004") != "Y"){
					return "X";
				}else if(chkStrCompare(data,"005") != "Y"){
					return "X";
				}else if(chkStrCompare(data,"006") != "Y"){
					return "X";
				}else if(chkStrCompare(data,"007") != "Y"){
					return "X";
				}else if(chkStrCompare(data,"901") != "Y"){
					return "X";
				}else if(chkStrCompare(data,"902") != "Y"){
					return "X";
				}else if(chkStrCompare(data,"903") != "Y"){
					return "X";
				}else{
					return "Y";
				}
			}else if(chk == "901"){
				if(chkStrCompare(data,"001") != "Y"){
					return "X";
				}else if(chkStrCompare(data,"003") != "Y"){
					return "X";
				}else if(chkStrCompare(data,"004") != "Y"){
					return "X";
				}else if(chkStrCompare(data,"005") != "Y"){
					return "X";
				}else if(chkStrCompare(data,"008") != "Y"){
					return "X";
				}else{
					return "Y";
				}
			}else if(chk == "902"){
				if(chkStrCompare(data,"001") != "Y"){
					return "X";
				}else if(chkStrCompare(data,"003") != "Y"){
					return "X";
				}else if(chkStrCompare(data,"004") != "Y"){
					return "X";
				}else if(chkStrCompare(data,"005") != "Y"){
					return "X";
				}else if(chkStrCompare(data,"008") != "Y"){
					return "X";
				}else{
					return "Y";
				}

			}else if(chk == "903"){
				if(chkStrCompare(data,"001") != "Y"){
					return "X";
				}else if(chkStrCompare(data,"003") != "Y"){
					return "X";
				}else if(chkStrCompare(data,"004") != "Y"){
					return "X";
				}else if(chkStrCompare(data,"005") != "Y"){
					return "X";
				}else if(chkStrCompare(data,"008") != "Y"){
					return "X";
				}else{
					return "Y";
				}
			}else{
				return "Y";
			}
		}else{
			return "Y";
		}
	}
	function ClickViewListPay(count,id,val,type){
		var count = document.getElementById("txt_totalrow").value;
		//alert(count);
		//////////////
		for(var i=1;i<=count;i++){
			if(type == "click"){
				//////////////////
				//document.getElementById("LoadviewPay").style.display = "";
				document.getElementById("txt_payupdate").value	= id+":"+val;
				//alert(val);
				var result = val.split("^");				
				document.getElementById("txt_paytype").value		= result[0];
				document.getElementById("txt_paytypenm").innerHTML	= result[14];
				document.getElementById("txt_payfor").value			= result[1];
				document.getElementById("txt_payfornm").innerHTML	= result[15];
				document.getElementById("txt_contno").readOnly		= true;
				document.getElementById("txt_contno").disabled		= false;
				document.getElementById("txt_contno").value			= result[2];
				document.getElementById("txt_payamt").value			= result[3];
				document.getElementById("txt_payamtnm").innerHTML	= result[11];
				document.getElementById("txt_disct").value			= result[4];
				document.getElementById("txt_disctnm").innerHTML	= result[12];
				document.getElementById("txt_netpay").value			= result[5];
				document.getElementById("txt_netpaynm").innerHTML	= result[13];
				document.getElementById("txt_cuscod").innerHTML		= result[9];
				document.getElementById("txt_cuscodnm").innerHTML	= result[10];
				//document.getElementById("detail_contno").style.display = "";
				///////////////////////////////				
				if(result[8] == "del"){
					document.getElementById("PayUpdate").style.display	= "none";
					document.getElementById("txtPayUpdate").innerHTML	= "<font color='#FF0000'>รายการนี้ถูกยกเลิกแล้ว ไม่สามารถปรับปรุงได้</font>";
				}else if(result[8] == "can"){
					document.getElementById("PayUpdate").style.display	= "none";
					document.getElementById("txtPayUpdate").innerHTML 	= "<font color='#FF99FF'>รายการนี้ถูกยกเลิกแล้ว ไม่สามารถปรับปรุงได้</font>";
				}else{
					document.getElementById("PayUpdate").style.display	= "";
					document.getElementById("txtPayUpdate").innerHTML	= "";
				}
				
				//////////////////////////////
				if(i == id){
					//alert(i+" "+id);
					document.getElementById("xRow["+i+"]").style.backgroundColor = "#CCFF66";
					document.getElementById("txt_select").value	= "choose,"+id;
					var selectrow = document.getElementById("txt_select").value;
					var result = selectrow.split(",");
					if(id != result[1]){						
						if((i%2)==0){
							document.getElementById("xRow["+i+"]").style.backgroundColor = "#B0E2FF";
						}else{
							document.getElementById("xRow["+i+"]").style.backgroundColor = "#FFFFFF";
						}
					}
				}else{
					if((i%2)==0){
						document.getElementById("xRow["+i+"]").style.backgroundColor = "#B0E2FF";
					}else{
						document.getElementById("xRow["+i+"]").style.backgroundColor = "#FFFFFF";
					}
				}
			}else if(type == "over"){
				var data = document.getElementById("txt_select").value;
				var result = data.split(",");

				if(i == id){
					if(i == result[1]){
						document.getElementById("xRow["+i+"]").style.backgroundColor = "#CCFF66";
					}else{
						document.getElementById("xRow["+i+"]").style.backgroundColor = "#FFCC99";
						if(data != ""){
							document.getElementById("xRow["+result[1]+"]").style.backgroundColor = "#CCFF66";
						}
					}
				}else{
					if((i%2)==0){
						//alert(count+" "+id+" "+val+" "+type);
						//alert(i+"%2 = "+i%2);
						document.getElementById("xRow["+i+"]").style.backgroundColor = "#B0E2FF";
						if(data != ""){
							document.getElementById("xRow["+result[1]+"]").style.backgroundColor = "#CCFF66";
						}
					}else{
						document.getElementById("xRow["+i+"]").style.backgroundColor = "#FFFFFF";
						if(data != ""){
							document.getElementById("xRow["+result[1]+"]").style.backgroundColor = "#CCFF66";
						}
					}
				}
			}else if(type == "out"){
				var data = document.getElementById("txt_select").value;
				var result = data.split(",");
				
				if((i%2)==0){
					document.getElementById("xRow["+i+"]").style.backgroundColor = "#B0E2FF";
					if(data != ""){
						document.getElementById("xRow["+result[1]+"]").style.backgroundColor = "#CCFF66";
					}
				}else{
					document.getElementById("xRow["+i+"]").style.backgroundColor = "#FFFFFF";
					if(data != ""){
						document.getElementById("xRow["+result[1]+"]").style.backgroundColor = "#CCFF66";
					}
				}
			}
		}
	}
	function PayUpdate(id){
		chktotalMoney();
		var Xpay = document.getElementById("txt_payupdate").value;
		//alert(Xpay);
		var data = Xpay.split(":");
		Xpay = data[1];
		var result = Xpay.split("^");
		var listpay = document.getElementById("txt_listpay").value;		
		var listpayfor = document.getElementById("txt_listpayfor").value;
		///////////////////////////////////////////
		var paytype		= document.getElementById("txt_paytype").value;
		var payfor		= document.getElementById("txt_payfor").value;
		var ss = payfor.split("|");
		var xpayfor = ss[0];
		var contno		= document.getElementById("txt_contno").value;
		var payamt		= document.getElementById("txt_payamt").value;
		var disct 		= document.getElementById("txt_disct").value;
		var netpay		= document.getElementById("txt_netpay").value;
		var chqmasid	= document.getElementById("txt_chqmasid").value;
		var payflag 	= document.getElementById("txt_payflag").value;
		var cuscod		= document.getElementById("txt_cuscod").innerHTML;
		var cuscodnm	= document.getElementById("txt_cuscodnm").innerHTML;
		var strpaytype	= document.getElementById("txt_paytypenm").innerHTML;
		var strpayfor	= document.getElementById("txt_payfornm").innerHTML;
		var strpayamt	= document.getElementById("txt_payamtnm").innerHTML;
		var strdisct	= document.getElementById("txt_disctnm").innerHTML;
		var strnetpay	= document.getElementById("txt_netpaynm").innerHTML;
		//////////////////
		if(id == "cancel"){
			document.getElementById("PayUpdate").style.display	= "none";
			document.getElementById("txt_select").value			= "";
			addPaidtoList(listpay);
		}else if(id == "upd"){
			var paystatus	= "upd";
			/////////////////
			var pay = paytype+"^"+payfor+"^"+contno+"^"+payamt+"^"+disct+"^"+netpay+"^"+chqmasid+"^"+payflag+"^"+paystatus+"^"+cuscod+"^"+cuscodnm+"^"+strpayamt+"^"+strdisct+"^"+strnetpay+"^"+strpaytype+"^"+strpayfor;
			var tpayfor = result[1].split("|");
			//alert(Xpay+" \n\n"+listpay+"\n\n"+pay);
			if(confirm("ต้องการปรับปรุงรายการจ่าย "+result[1]) == true){
				document.getElementById("imgLoadlistpay").style.display = "";
				listpay = listpay.replace(Xpay,pay);
				document.getElementById("txt_listpay").value = listpay;
				listpayfor = listpayfor.replace(tpayfor[0],xpayfor);
				document.getElementById("txt_listpayfor").value = listpayfor;
				addPaidtoList(listpay);
				document.getElementById("PayUpdate").style.display	= "none";
				document.getElementById("txt_select").value			= "";
			}
		}else if(id == "del"){
			var paystatus	= "del";
			var payflag		= "C";
			/////////////////
			var pay = paytype+"^"+payfor+"^"+contno+"^"+payamt+"^"+disct+"^"+netpay+"^"+chqmasid+"^"+payflag+"^"+paystatus+"^"+cuscod+"^"+cuscodnm+"^"+strpayamt+"^"+strdisct+"^"+strnetpay+"^"+strpaytype+"^"+strpayfor;
			//alert(Xpay+" \n\n"+listpay+"\n\n"+pay);
			var tpayfor = result[1].split("|");
			if(confirm("ต้องการลบรายการ "+result[1]) == true){
				document.getElementById("imgLoadlistpay").style.display = "";
				listpay = listpay.replace(Xpay,pay);
				document.getElementById("txt_listpay").value = listpay;
				listpayfor = listpayfor.replace("#"+tpayfor[0],"");
				document.getElementById("txt_listpayfor").value = listpayfor;
				addPaidtoList(listpay);
				document.getElementById("PayUpdate").style.display	= "none";
				document.getElementById("txt_select").value			= "";
				ClearText_forcash();
			}
		}
	}
	function chksubmit_forcash(){
		var tmbilldt		= document.getElementById("txt_tmbilldt").value;
		var locat 			= document.getElementById("txt_locat").value;
		var tmbill			= document.getElementById("txt_tmbill").value;
		var chkrun_tmbill	= document.getElementById("chkrun_tmbill").value;
		var billno			= document.getElementById("txt_billno").value;
		var chkrun_billno	= document.getElementById("chkrun_billno").value;
		var listpayfor		= document.getElementById("txt_listpayfor").value;
		if(tmbilldt == ""){
			alert("กรุณาระบุ วันที่รับชำระเงิน");
		}else if(locat == ""){
			alert("กรุณาระบุ สาขาที่รับชำระเงิน");
		}else if(chkrun_tmbill != "Y" && tmbill == ""){
			alert("กรุณาระบุ เลขที่ใบรับชั่วคราว");
		}else if(chkrun_billno != "Y" && billno == ""){
			alert("กรุณาระบุ เลขที่ใบเสร็จ");
		}else if(listpayfor == ""){
			alert("ยังไม่มีรายการที่จะทำการชำระ");
		}else{
			if(confirm("ต้องการบันทึกรายการ.") == true){
				doSearchAjax_forcash('INSERT','Type','Stat','Search');
				document.getElementById("imgLoadInsert").style.display = "";
			}
		}
	}
	function revokePage_forcash(){
		var tmbill	= document.getElementById("txt_tmbill").value;
		var billno	= document.getElementById("txt_billno").value;
		var listpayfor	= document.getElementById("txt_listpayfor").value;
		var chkrevoke = document.getElementById("revoke").value;
		var flag = document.getElementById("txt_flag").value;
		
		if(flag != "C"){
			if((listpayfor.match("006")) || (listpayfor.match("007"))){
				alert("กรุณาใช้เมนูยกเลิกค่างวดและยกเลิกค่างวดตัดสด.");
			}else if(confirm("ต้องการยกเลิกใบรับเงิน "+tmbill) == true){
				document.getElementById("imgLoadInsert").style.display 	= "";
				document.getElementById("chkstat_onblurbillno").value	= "revoke";
				document.getElementById("chkstat_onblurtmbill").value	= "revoke";
				doSearchAjax_forcash('REVOKE','Type','Stat','Search');
			}
		}else{
			alert("ใบเสร็จรับเงินใบนี้ได้ถูกยกเลิกแล้ว.");
		}
	}
	function before_OnViewData_forcash(val,taddr,tban,count){
		document.getElementById("txtval01").value	= val;
		document.getElementById("txtval02").value	= taddr;
		document.getElementById("txtval03").value	= tban;
		document.getElementById("txtval04").value	= count;
		var result = val.split("|");
		document.getElementById("mySpanBeforeChoose").innerHTML = result[5];
	}
	function onClickChoose_forcash(){
		var data1 = document.getElementById("txtval01").value;
		var data2 = document.getElementById("txtval02").value;
		var data3 = document.getElementById("txtval03").value;
		var data4 = document.getElementById("txtval04").value;
		document.getElementById("mySpanBeforeChoose").innerHTML = "";
		OnViewData_forcash(data1,data2,data3,data4);
	}
	function OnViewData_forcash(val,tcar,tstrno,count){
		//alert(val+" "+tcar+" "+tstrno+" "+count);
		var result = val.split("|");
		document.getElementById("txt_xidno").value			= result[0];
		document.getElementById("txt_tmbilldt").value 		= result[1];		
		if(result[11] == "C"){
			document.getElementById("txt_tmbilldtnm").innerHTML	= "<font color='#FF0000'>"+result[2]+"</font>";
			document.getElementById("txt_tmbillnm").innerHTML	= "<font color='#FF0000'>"+result[5]+"</font>";
			document.getElementById("txt_billnonm").innerHTML	= "<font color='#FF0000'>"+result[6]+"</font>";
		}else{
			document.getElementById("txt_tmbilldtnm").innerHTML	= result[2];
			document.getElementById("txt_tmbillnm").innerHTML	= result[5];
			document.getElementById("txt_billnonm").innerHTML	= result[6];
		}
		document.getElementById("txt_locat").value 			= result[3];
		document.getElementById("txt_locatnm").innerHTML	= result[4];
		document.getElementById("txt_tmbill").value			= result[5];		
		document.getElementById("txt_billno").value			= result[6];		
		document.getElementById("txt_paytype").value		= result[7];
		document.getElementById("txt_paytypenm").innerHTML	= result[8];
		
		var memo = result[10].split("^");
		var txtmemo = "";
		for(i=1;i<memo.length;i++){
			txtmemo = txtmemo + memo[i]+"\n";
		}
		document.getElementById("txt_memo").value			= txtmemo;
		document.getElementById("txt_flag").value			= result[11];
		
		document.getElementById("txt_listpay").value		= tcar;
		document.getElementById("txt_listpayfor").value		= tstrno;
		//document.getElementById("txt_getlist1").innerHTML	= count;
		BackToMain_forcash('chqtran');
		addPaidtoList(tcar);
		document.getElementById("txt_tmbill").disabled			= false;
		document.getElementById("txt_tmbill").readOnly			= true;
		document.getElementById("txt_billno").disabled			= false;
		document.getElementById("txt_billno").readOnly			= true;
		document.getElementById("vwlist_pay").style.display		= "none";
		document.getElementById("NewPage").style.display		= "";
		document.getElementById("NewPage2").style.display		= "";
		document.getElementById("btInsert").style.display		= "none";
		document.getElementById("btCancel").style.display		= "none";
		document.getElementById("btRevoke").style.display		= "";
		document.getElementById("btPrint").disabled				= false;
	}
	function ChoosePrint(){
		var id = document.getElementById("txt_print").value;
		if(id == "1"){
			var chkstat = document.getElementById("txt_rprn").value;
			document.getElementById("txt_print").value		= "2";
			if(chkstat == "Y"){
				document.getElementById("tb_print").style.display	= "";
			}else{
				alert("คุณไม่มีสิทธ์ในการปริ้นย้อนหลัง");
			}
		}else{
			document.getElementById("tb_print").style.display	= "none";
			document.getElementById("txt_print").value		= "1";
		}
	}
	function OnPrint_forcash(id){
		//var tmbill = ChangeTheSign(document.getElementById("txt_tmbill").value);		
		//alert(tmbill);
		if(id == "Vouchers"){
			document.getElementById("imgLoadInsert").style.display = "";
			doSearchAjax_forcash('PrintForm','Vouchers','Stat','Search');
		}else if(id == "Receipt"){
			document.getElementById("imgLoadInsert").style.display = "";
			doSearchAjax_forcash('PrintForm','Receipt','Stat','Search');
		}
	}
	function chkDay_forcash(id,val){
		if(val <= 31){
			alert("วันที่ต้องน้อยกว่าวันที่ 31");
		}
	}
	function PreviousPage_forcash(id,type,stat){
		var id = id.replace(/\+/gi,"0*2B");
		document.getElementById("imgLoad"+stat).style.display	= "";
		doSearchAjax_forcash('PreviousPage',stat,'Stat',id);
	}
	function NextPage_forcash(id,type,stat){
		var id = id.replace(/\+/gi,"0*2B");
		document.getElementById("imgLoad"+stat).style.display	= "";
		doSearchAjax_forcash('NextPage',stat,'Stat',id);
	}
	$(function(){
		// แทรกโค้ต jquery
		$("#txt_tmbilldt").datepicker({ dateFormat: 'dd/mm/yy' });
		// รูปแบบวันที่ที่ได้จะเป็น 23-12-2009
	});