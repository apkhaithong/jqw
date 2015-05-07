<h2><i class="fa fa-cog"></i> รายละเอียดสาขา [<?php echo $invlocat->locatcd ?>]</h2>
<div id="invlocatTool"></div>
<input type="hidden" id="invlocatid" value="<?php echo $menucod ?>">
<br />
<form id="fmInvlocat">
    <table class="invlocat-table">
        <tr>
            <td>รหัสสาขา</td>
            <td><input type="hidden" id="<?php echo $menucod ?>idno" value="<?php echo $invlocat->idno; ?>" /><input type="text" id="<?php echo $menucod ?>locatcd" value="<?php echo $invlocat->locatcd; ?>"><input type="hidden" id="<?php echo $menucod ?>locatcd_id" value="<?php echo $invlocat->locatcd; ?>"></td>
        </tr>
        <tr>
            <td>ชื่อสาขา</td>
            <td><input type="text" id="<?php echo $menucod ?>locatnm" value="<?php echo $invlocat->locatnm; ?>"></td>
        </tr>
        <tr>
            <td>ที่อยู่สาขา</td>
            <td><input type="text" id="<?php echo $menucod ?>locaddr1" value="<?php echo $invlocat->locaddr1; ?>"></td>
        </tr>
        <tr>
            <td>ที่อยู่สาขา</td>
            <td><input type="text" id="<?php echo $menucod ?>locaddr2" value="<?php echo $invlocat->locaddr2; ?>"></td>
        </tr>
        <tr>
            <td>เบอร์โทร</td>
            <td><input type="text" id="<?php echo $menucod ?>telp" value="<?php echo $invlocat->telp; ?>"></td>
        </tr>
        <tr>
            <td>รหัสเอกสาร</td>
            <td><input type="text" id="<?php echo $menucod ?>shortl" value="<?php echo $invlocat->shortl; ?>"><input type="hidden" id="<?php echo $menucod ?>shortl_id" value="<?php echo $invlocat->shortl; ?>"></td>
        </tr>
        <tr>
            <td>รหัสอำเภอ</td>
            <td>
                <div id="<?php echo $menucod ?>aumpcod" class="input-button">
                    <input type="text" id="<?php echo $menucod ?>aumpcod1" value="<?php echo $invlocat->aumpcod; ?>"/>
                    <div id="<?php echo $menucod ?>searchAmp"><img alt="search" width="16" height="16" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/search_lg.png" /></div>
                </div>
                <div id="<?php echo $menucod ?>aumpdesc" class="input-desc"></div>
            </td>
        </tr>
        <tr>
            <td>รหัสจังหวัด</td>
            <td>
                <div id="<?php echo $menucod ?>provcod" class="input-button">
                    <input type="text" id="<?php echo $menucod ?>provcod1" value="<?php echo $invlocat->provcod; ?>"/>
                    <div id="<?php echo $menucod ?>searchPrv"><img alt="search" width="16" height="16" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/search_lg.png" /></div>
                </div>
                <div id="<?php echo $menucod ?>provdesc" class="input-desc"></div>
            </td>
        </tr>
        <tr>
            <td>รหัสไปรษณีย์</td>
            <td><input type="text" id="<?php echo $menucod ?>postcod" value="<?php echo $invlocat->postcod; ?>"></td>
        </tr>
        <tr>
            <td>รหัสบัญชีเงินปล่อยกู้</td>
            <td><input type="text" id="<?php echo $menucod ?>accmstcod" value="<?php echo $invlocat->accmstcod; ?>"></td>
        </tr>
        <tr>
            <td>รหัสบัญชีเงินสด</td>
            <td><input type="text" id="<?php echo $menucod ?>accmstcod2" value="<?php echo $invlocat->accmstcod2; ?>"></td>
        </tr>
    </table>
	<input type="hidden" id="<?php echo $menucod ?>locatcd_hd" value="" />
	<input type="hidden" id="<?php echo $menucod ?>shortl_hd" value="" />
    <input type="hidden" id="<?php echo $menucod ?>status_fmInvlocat" value="update" />
</form>
<br />
<div id="booklocat"></div>
<br />
<?php echo $this->renderPartial('//layouts/search');  ?>
<br />
<div id="popupWindow">
    <div>เลขบัญชีธนาคาร</div>
    <div style="overflow: hidden;">
		<form id="fmBooklocat">
			<table>
				<tr>
					<td align="right">เลขที่บัญชี : </td>
					<td align="left"><input id="bookcode" /></td>
				</tr>
				<tr>
					<td align="right">รายละเอียดบัญชี : </td>
					<td align="left"><input id="bookdesc" /></td>
				</tr>
				<tr>
					<td align="right">ยอดยกมา : </td>
					<td align="left"><div id="balance"></div></td>
				</tr>
				<tr>
					<td align="right">วันที่ยกมา : </td>
					<td align="left"><div id="datebalance"></div></td>
				</tr>
				<tr>
					<td align="right"></td>
					<td style="padding-top: 10px;" align="right"><input style="margin-right: 5px;" type="button" id="Save" value="บันทึก" /><input id="Cancel" type="button" value="ยกเลิก" /></td>
				</tr>
			</table>
			<input type="hidden" id="status" value="">
            <input type="hidden" id="bookcode_hd" value="">
			<input type="hidden" id="bookcode_chk" value="">
			<input type="hidden" id="bookcode_id" value="">
            <input type="hidden" id="bookcode_rowindex" value="">
		</form>
    </div>
</div>
<script type="text/javascript">
	$(document).ready(function () {
        $.ajaxSetup({ cache: false });
        var theme = 'ui-redmond';
        var menucod = $("#invlocatid").val();
		var width = $(window).width();
        var height = $(window).height();
		var locatcd = $("#"+menucod+"locatcd").val();
        var url = 'invlocat/dataBooklocat?locatcd='+locatcd;
        // prepare the data
        var source =
        {
            datatype: "json",
            datafields: [
                { name: 'idno', type: 'integer' },
				{ name: 'bookcode', type: 'string' },
                { name: 'bookdesc', type: 'string' },
                { name: 'balance', type: 'float' },
                { name: 'datebalance', type: 'date' },
				{ name: 'status', type: 'string' },
				{ name: 'bookcode_chk', type: 'string' }
            ],
            addrow: function (rowid, rowdata, position, commit) {
                commit(true);
            },
            deleterow: function (rowid, commit) {
                commit(true);
            },
            updaterow: function (rowid, newdata, commit) {
                commit(true);
            },
            id: 'id',
            url: url,
			sortcolumn: 'bookcode',
            sortdirection: 'asc'
        };

        var dataAdapter = new $.jqx.dataAdapter(source);

        $("#booklocat").jqxGrid(
        {
            width: '100%',
            theme: theme,
            source: dataAdapter,
            columnsresize: true,
            columns: [
                {
                    text: '#', sortable: false, filterable: false, editable: false,
                    groupable: false, draggable: false, resizable: false,
                    datafield: '', columntype: 'number', width: 50,
                    cellsrenderer: function (row, column, value) {
                        return "<div style='margin:4px;'>" + (value + 1) + "</div>";
                    }
                },
                { text: 'เลขที่บัญชี', datafield: 'bookcode', width: 120 },
                { text: 'รายละเอียดบัญชี', datafield: 'bookdesc', width: 400 },
                { text: 'ยอดยกมา', datafield: 'balance', width: 100, cellsalign: 'right', columntype: 'numberinput', cellsformat: 'd2' },
                { text: 'วันที่ยกมา', datafield: 'datebalance', width: 100, columntype: 'datetimeinput', cellsformat: 'dd/MM/yyyy' },
                //{ text: 'x1', datafield: 'bookcode_chk', width: 100 },
                //{ text: 'x2', datafield: 'status', width: 100 }
            ],
            showtoolbar: true,
            rendertoolbar: function (toolbar) {
                var me = this;
                var container = $("<div style='margin: 5px;'></div>");
                toolbar.append(container);
                container.append('<div id="addrow" class="fa fa-plus toolsbtn"> เพิ่มข้อมูล</div>');
                container.append('<div style="margin-left: 5px;" id="deleterow" class="fa fa-minus toolsbtn"> ลบข้อมูล</div>');
                container.append('<div style="margin-left: 5px;" id="updaterow" class="fa fa-pencil toolsbtn"> แก้ไขข้อมูล</div>');
                $("#addrow").jqxButton({ width: 80, theme: theme });
                $("#deleterow").jqxButton({ width: 80, theme: theme });
                $("#updaterow").jqxButton({ width: 80, theme: theme });
                // create new row.
                $("#addrow").on('click', function () {
                    $("#status").val('insert');
                    $("#bookcode").jqxInput({ disabled:false });
                    $("#popupWindow").jqxWindow('open');
                    $('#fmBooklocat').jqxValidator({
                        rules: [
                            { input: '#bookcode', message: 'รหัสบัญชี ซ้ำ !', action: 'keyup, blur',
    								rule: function (input, commit) {
                                        if($("#bookcode_id").val() == ''){
                                            $("#bookcode_id").val('0');
                                        }
                                        if($("#bookcode_rowindex").val()==''){
                                            $("#bookcode_rowindex").val('0');
                                        }

    									$.ajax({
    										url: "invlocat/validatedata",
    										type: 'POST',
    										data: {data1: $("#bookcode_id").val(), data2: $("#bookcode").val(), status: $("#status").val(), frmTable:'booklocat', frmField:'bookcode',rowindex:$("#bookcode_rowindex").val()},
    										success: function(data){
    											if (data == "true"){
    												commit(true);
    											}else commit(false);
    										},
    										error: function(){
    											commit(false);
    										}
    									});
    								}
    						}
                        ]
                    });
                    return false;
                });
                // delete row.
                $("#deleterow").on('click', function () {
					var selectedrowindex = $("#booklocat").jqxGrid('getselectedrowindex');
					var rowscount = $("#booklocat").jqxGrid('getdatainformation').rowscount;
					var id = $("#booklocat").jqxGrid('getrowid', selectedrowindex);
					var rowindex = $('#booklocat').jqxGrid('getselectedrowindex');
					var data = $('#booklocat').jqxGrid('getrowdata', rowindex);
                    if(rowindex>=0){
					    $("#bookcode_hd").val(data.bookcode);
    					//if (confirm('คุณต้องการที่จะลบข้อมูล เลขที่บัญชี : '+$("#bookcode_hd").val()+' ?')) {
                        $.when($.confirmdlg('คุณต้องการที่จะลบ เลขที่บัญชี?', 'warning')).then(function(){
                            $('#ok').click(function(event) {
        						$("#status").val('delete');
        						if (selectedrowindex >= 0 && selectedrowindex < rowscount) {
        							//console.log(rowindex);
        							$.post('invlocat/delbookcode', {status: $("#status").val(),rowindex: rowindex}, function(data, textStatus, xhr) {
        								//console.log(data);
        								if (data === 'true') {
        									var commit = $("#booklocat").jqxGrid('deleterow', id);
        								}
        							});
        						}
                            });
    					});
                    }
                });
                // update row.
                $("#updaterow").on('click', function () {
                    $("#status").val('update');
                    var rowindex = $('#booklocat').jqxGrid('getselectedrowindex');
                    var data = $('#booklocat').jqxGrid('getrowdata', rowindex);
                    if(rowindex>=0){
                        $("#bookcode").val(data.bookcode);
                        $("#bookcode").jqxInput({ disabled:true });
                        $("#bookdesc").val(data.bookdesc);
                        $("#balance").val(data.balance);
                        $("#datebalance").val(data.datebalance);
    					$("#bookcode_chk").val(data.bookcode_chk);
    					$("#bookcode_id").val(rowindex);
                        $("#bookcode_rowindex").val(rowindex);
                        //alert(rowindex+' '+$("#bookcode_chk").val());
                        $("#popupWindow").jqxWindow('open');
                        return false;
                    }
                });
            },
            sortable: true,
            pageable: true,
            pagesize: 10,
            autoheight: true,
            columnsresize: true
        });
		$("#"+menucod+"locatcd").jqxInput({ height: 23, width: 121, theme: theme, minLength: 1, maxLength: 8 });
        $("#"+menucod+"locatnm").jqxInput({ height: 23, width: 300, theme: theme });
        $("#"+menucod+"locaddr1").jqxInput({ height: 23, width: 300, theme: theme });
        $("#"+menucod+"locaddr2").jqxInput({ height: 23, width: 300, theme: theme });
        $("#"+menucod+"telp").jqxInput({ height: 23, width: 150, theme: theme });
        $("#"+menucod+"shortl").jqxInput({ height: 23, width: 121, theme: theme, minLength: 1, maxLength: 2 });
        $("#"+menucod+"aumpcod").jqxInput({ height: 23, width: 129, theme: theme });
        $("#"+menucod+"provcod").jqxInput({ height: 23, width: 129, theme: theme });
        $("#"+menucod+"postcod").jqxInput({ height: 23, width: 121, theme: theme });
        $("#"+menucod+"accmstcod").jqxInput({ height: 23, width: 121, theme: theme });
        $("#"+menucod+"accmstcod2").jqxInput({ height: 23, width: 121, theme: theme });
        //"สำหรับการแก้ไข จะไม่สามารถแก้ไข รหัสสาขา และ รหัสเอกสารได้"
        $("#"+menucod+"locatcd").jqxInput({ disabled:true });
        //$("#shortl").jqxInput({ disabled:true });

        //save booklocat
        $("#Save").click(function () {
            //$.ajaxSetup({ cache: false });
            //alert($("#status_fmInvlocat").val()+' - '+$("#status").val());
            if($("#"+menucod+"status_fmInvlocat").val()==='update'){
                //alert('create');
                var row = { bookcode: $("#bookcode").val(), bookdesc: $("#bookdesc").val(), balance: parseFloat($("#balance").jqxNumberInput('decimal')), datebalance: $("#datebalance").val(),status: $("#status").val(), bookcode_chk: $("#bookcode").val()};

                $('#fmBooklocat').jqxValidator('validate', function (result) {
                    if(result===true){
                        //alert('You have filled the form correctly! ');
            			//alert($("#status").val());
                        if($("#"+menucod+"status_fmInvlocat").val()==='update'){
                            if ($("#status").val() === 'insert') {
                                $.post('invlocat/addbookcode', {bookcode: $("#bookcode").val(), bookdesc: $("#bookdesc").val(), balance: parseFloat($("#balance").jqxNumberInput('decimal')), datebalance: $("#datebalance").val(),status: $("#status").val(), bookcode_chk: $("#bookcode").val() }, function(data, textStatus, xhr){
                                    if (data === 'true') {
                                        var commit = $('#booklocat').jqxGrid('addrow', null, row);
                                    }
                                });

                            }else if ($("#status").val() === 'update') {
                                var rowindex = $("#booklocat").jqxGrid('getselectedrowindex');
                                var rowscount = $("#booklocat").jqxGrid('getdatainformation').rowscount;
                                if (rowindex >= 0 && rowindex < rowscount) {
                                    var id = $("#booklocat").jqxGrid('getrowid', rowindex);

                                    $.post('invlocat/editbookcode', { bookcode: $("#bookcode").val(), bookdesc: $("#bookdesc").val(), balance: parseFloat($("#balance").jqxNumberInput('decimal')), datebalance: $("#datebalance").val(), status: $("#status").val(), bookcode_chk: $("#bookcode_chk").val(), rowindex: rowindex }, function(data, textStatus, xhr) {
                                        //console.log(data);
                                        if (data === 'true') {
                                            var commit = $("#booklocat").jqxGrid('updaterow', id, row);
                                            $("#booklocat").jqxGrid('ensurerowvisible', rowindex);
                                        } // end chk data = true
                                    }); // end post
                                }// end if chk rowindex >= 0 && rowindex < rowscount
                            }
                        }
                        $('#fmBooklocat').jqxValidator('hide');
                        $("#popupWindow").jqxWindow('close');
                    }
                });

            }
		});


        //Popup Edit & Button
        $("#bookcode").jqxInput({ width: 380, height: 23, theme: theme });
        $("#bookdesc").jqxInput({ width: 380, height: 23, theme: theme });
        $("#balance").jqxNumberInput({ spinMode: 'simple', width: 380, height: 23, min: 0, spinButtons: true, theme: theme });
        $("#datebalance").jqxDateTimeInput({ width: 380, height: 23, theme: theme });
        $("#Cancel").jqxButton({ theme: theme });
        $("#Save").jqxButton({ theme: theme });

        //Popup Window
        $("#popupWindow").jqxWindow({
            theme: theme,
            width: 500,
            height: 180,
            resizable: false,
            isModal: true,
            autoOpen: false,
            cancelButton: $("#Cancel"),
            modalOpacity: 0.01
        });

        $('#popupWindow').on('close', function (event) {
            $("#bookcode").val('');
            $("#bookdesc").val('');
            $("#balance").val(0);
            $("#datebalance").jqxDateTimeInput({ value: new Date() });
            //$("#status").val('');
            $("#bookcode_chk").val('');
            //alert("close update");
        });

        $("#"+menucod+"searchAmp").click(function() {
            $("#result").load('search/index?show=setaump&returnid='+menucod+'aumpcod');
            $("#search").jqxWindow('open');
        });
        $("#"+menucod+"searchPrv").click(function() {
            $("#result").load('search/index?show=setprov&returnid='+menucod+'provcod');
            $("#search").jqxWindow('open');
        });

        $("#invlocatTool").jqxToolBar({ width: '100%', height: 50, theme: theme, tools: 'button | button ',
            initTools: function (type, index, tool, menuToolIninitialization) {
                var icon = $("<div class='buttonIcon'></div>");
                switch (index) {
                    case 0:
                        icon.addClass("fa fa-arrow-left fa-lg");
                        icon.attr("title", "ย้อนกลับ");
                        icon.attr("id", menucod+"btnBack");
                        icon.html("<p>ย้อนกลับ</p>");
                        tool.append(icon);
                        tool.click(function() {
                            invlocat_back();
                        });
                        break;
                    case 1:
                        icon.addClass("fa fa-floppy-o fa-lg");
                        icon.attr("title", "บันทึกข้อมูล");
                        icon.attr("id", menucod+"btnSave");
                        icon.html("<p style='margin-top:3px;'>บันทึกข้อมูล</p>");
                        tool.append(icon);
                        tool.click(function() {
                            invlocat_save();
                        });
                        break;
                }
            }
        });
		$('#fmInvlocat').jqxValidator({
            hintType: 'label',
            animationDuration: 0,
            rules:  [
						{ input: '#'+menucod+'locatcd', message: 'กรุณาระบุรหัสสาขา !', action: 'keyup, blur', rule: 'required' },
						{ input: '#'+menucod+'shortl', message: 'กรุณาระบุรหัสเอกสาร !', action: 'keyup, blur', rule: 'required' },
						{ input: '#'+menucod+'shortl', message: 'ระบุรหัสเอกสาร ซ้ำ !', action: 'keyup, blur',
							rule: function (input, commit) {
                                    if($("#bookcode_rowindex").val()==''){
                                        $("#bookcode_rowindex").val('0');
                                    }
									$.ajax({
										url: "invlocat/validatedata",
										type: 'POST',
										data: {data1: $("#"+menucod+"idno").val(), data2: $("#"+menucod+"shortl").val(), status: 'update', frmTable:'invlocat', frmField:'shortl',rowindex:$("#bookcode_rowindex").val()},
										success: function(data){
											if (data == "true"){
												commit(true);
											}else commit(false);
										},
										error: function(){
											commit(false);
										}
									});
							}
						},
                        { input: '#'+menucod+'aumpcod', message: 'ไม่พบรหัสนี้!', action: 'blur', rule: function (input, commit) {
                                var aumpcode = $("#"+menucod+"aumpcod").val();
                                if (aumpcode !== '') {
                                    $.ajax({
                                        url: "validate/findexit",
                                        type: 'get',
                                        data: { table: 'setaump', field: 'aumpcode', code: aumpcode },
                                        success: function(data) {
                                            if (data == "true") {
                                                commit(true);
                                            }
                                            else commit(false);
                                        },
                                        error: function() {
                                            commit(false);
                                        }
                                    });
                                }else{
                                    commit(true);
                                }
                            }
                        },
                        { input: '#'+menucod+'provcod', message: 'ไม่พบรหัสนี้!', action: 'blur', rule: function (input, commit) {
                                var provcode = $("#"+menucod+"provcod").val();
                                if (provcode !== '') {
                                    $.ajax({
                                        url: "validate/findexit",
                                        type: 'get',
                                        data: { table: 'setprov', field: 'provcode', code: provcode },
                                        success: function(data) {
                                            if (data == "true") {
                                                commit(true);
                                            }
                                            else commit(false);
                                        },
                                        error: function() {
                                            commit(false);
                                        }
                                    });
                                }else{
                                    commit(true);
                                }
                            }
                        }
                    ]
        });

		$('#fmBooklocat').jqxValidator({
            hintType: 'label',
            animationDuration: 0,
            rules:  [
						{ input: '#bookcode', message: 'กรุณาระบุรหัสบัญชี !', action: 'keyup, blur', rule: 'required' }
                    ]
        });

        //validate data
        function Valid_prov_aump(type){
            if(type == "aump"){
                //var checked = $('#'+menucod+'aumpcod');
                //$('#'+menucod+'aumpcod1').jqxValidator('validate', checked);
                $('#fmInvlocat').jqxValidator('validateInput', '#'+menucod+'aumpcod');
            }
            if(type == "prov"){
                $('#fmInvlocat').jqxValidator('validateInput', '#'+menucod+'provcod');
            }
        }
        $('#'+menucod+'aumpcod1').keyup(function () {
            Valid_prov_aump("aump");
        });
        $('#'+menucod+'aumpcod1').blur(function () {
            Valid_prov_aump("aump");
        });

        $('#'+menucod+'provcod1').keyup(function () {
            Valid_prov_aump("prov");
        });
        $('#'+menucod+'provcod1').blur(function () {
            Valid_prov_aump("prov");
        });

        $('#'+menucod+'aumpcod1').blur(function () {
            $.when(provcod()).then(function(){
                aumpdesc();
            });
        });

        $('#'+menucod+'provcod1').blur(function () {
            provdesc();
        });

        var provcod = function() {
            $.ajax({
                url: "validate/findvalue",
                type: 'get',
                data: { table: 'setaump', field: 'aumpcode', code: $('#'+menucod+'aumpcod1').val(), fieldv: 'provcode' },
                success: function(data) {
                    $('#'+menucod+'provcod1').val(data);
                    provdesc();
                }
            });
        };

        var aumpdesc = function() {
            $.ajax({
                url: "validate/findvalue",
                type: 'get',
                data: { table: 'setaump', field: 'aumpcode', code: $('#'+menucod+'aumpcod1').val(), fieldv: 'aumpdesc' },
                success: function(data) {
                    $('#'+menucod+'aumpdesc').text(data);
                }
            });
        };

        var provdesc = function() {
            $.ajax({
                url: "validate/findvalue",
                type: 'get',
                data: { table: 'setprov', field: 'provcode', code: $('#'+menucod+'provcod1').val(), fieldv: 'provdesc' },
                success: function(data) {
                    $('#'+menucod+'provdesc').text(data);
                }
            });
        };
        aumpdesc();
        provdesc();
        
        var invlocat_save = function() {
            $('#fmInvlocat').jqxValidator('validate', function (result) {
                if(result){
                    $.when($.confirmdlg('คุณต้องการที่จะบันทึกข้อมูล สาขา ?', 'info')).then(function(){
                        $('#ok').click(function(event){
                            $.ajax({
                                url: "invlocat/save",
                                data: {locatcd: $("#"+menucod+"locatcd").val(), locatnm: $("#"+menucod+"locatnm").val(), locaddr1: $("#"+menucod+"locaddr1").val(),
                                       locaddr2: $("#"+menucod+"locaddr2").val(), telp: $("#"+menucod+"telp").val(), shortl: $("#"+menucod+"shortl").val(),
                                       aumpcod: $("#"+menucod+"aumpcod").val(), provcod: $("#"+menucod+"provcod").val(), postcod: $("#"+menucod+"postcod").val(),
                                       accmstcod: $("#"+menucod+"accmstcod").val(), accmstcod2: $("#"+menucod+"accmstcod2").val(), locatcd_id: $("#"+menucod+"locatcd_id").val(), chkstatus: "update", menucod: menucod},
                                type: 'POST',
                                success: function (data) {
                                    //alert('บันทึกรายการแล้ว !');
                                    $("#"+menucod).html(data);
                					// $.ajax({
                					// 	url: "invlocat/index",
                					// 	success: function(data) {
                					// 		$("#"+menucod).html(data);
                                    //         $("#status").val('');
                					// 	}
                					// });
                                }
                            });
                        });//end if ok
                    });//end if
                }
            });
        };
		$("#"+menucod+"btnDelete").click(function() {
            if ($("#"+menucod+"locatcd").val() !== '') {
				//if (confirm('คุณต้องการที่จะลบข้อมูล สาขา ?')) {
                $.when($.confirmdlg('คุณต้องการที่จะลบ สาขา?', 'warning')).then(function(){
                    $('#ok').click(function(event) {
    					$.post('invlocat/delete', {locatcd: $("#"+menucod+"locatcd").val(), menucod: menucod}, function(data, textStatus, xhr) {
    						//alert('ลบข้อมูล สาขา : '+$("#locatcd").val()+' เรียบร้อย');
    						//$("#"+menucod).html(data);
                            $.ajax({
                                url: "invlocat/index",
                                data: { menucod: menucod },
                                type: 'get',
                                success: function(data) {
                                    $("#"+menucod).html(data);
                                }
                            });
    					});
                    });
				});
            }
        });
        var invlocat_back = function(event) {
            $('#fmInvlocat').jqxValidator('hide');
            $.ajax({
                url: "invlocat/index",
                data: { menucod: menucod },
                type: 'get',
                success: function(data) {
                    $("#"+menucod).html(data);
                }
            });
        };
	});
</script>
