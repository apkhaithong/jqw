<h2><i class="fa fa-cog"></i> เพิ่มข้อมูลสาขา</h2>
<div id="invlocatTool"></div>
<input type="hidden" id="invlocatid" value="<?php echo $menucod ?>">
<br />
<form id="fmInvlocat">
    <table class="invlocat-table">
        <tr>
            <td>รหัสสาขา <font style="color:red">*</font></td>
            <td><input type="text" id="<?php echo $menucod ?>locatcd"></td>
        </tr>
        <tr>
            <td>ชื่อสาขา</td>
            <td><input type="text" id="<?php echo $menucod ?>locatnm"></td>
        </tr>
        <tr>
            <td>ที่อยู่สาขา</td>
            <td><input type="text" id="<?php echo $menucod ?>locaddr1"></td>
        </tr>
        <tr>
            <td>ที่อยู่สาขา</td>
            <td><input type="text" id="<?php echo $menucod ?>locaddr2"></td>
        </tr>
        <tr>
            <td>เบอร์โทร</td>
            <td><input type="text" id="<?php echo $menucod ?>telp"></td>
        </tr>
        <tr>
            <td>รหัสเอกสาร <font style="color:red">*</font></td>
            <td><input type="text" id="<?php echo $menucod ?>shortl"></td>
        </tr>
        <tr>
            <td>รหัสอำเภอ</td>
            <td>
                <div id="<?php echo $menucod ?>aumpcod" class="input-button">
                    <input type="text" id="<?php echo $menucod ?>aumpcod1" />
                    <div id="<?php echo $menucod ?>searchAmp"><img alt="search" width="16" height="16" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/search_lg.png" /></div>
                </div>
                <div id="<?php echo $menucod ?>aumpdesc" class="input-desc"></div>
            </td>
        </tr>
        <tr>
            <td>รหัสจังหวัด</td>
            <td>
                <div id="<?php echo $menucod ?>provcod" class="input-button">
                    <input type="text" id="<?php echo $menucod ?>provcod1"/>
                    <div id="<?php echo $menucod ?>searchPrv"><img alt="search" width="16" height="16" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/search_lg.png" /></div>
                </div>
                <div id="<?php echo $menucod ?>provdesc" class="input-desc"></div>
            </td>
        </tr>
        <tr>
            <td>รหัสไปรษณีย์</td>
            <td><input type="text" id="<?php echo $menucod ?>postcod"></td>
        </tr>
        <tr>
            <td>รหัสบัญชีเงินปล่อยกู้</td>
            <td><input type="text" id="<?php echo $menucod ?>accmstcod"></td>
        </tr>
        <tr>
            <td>รหัสบัญชีเงินสด</td>
            <td><input type="text" id="<?php echo $menucod ?>accmstcod2"></td>
        </tr>
    </table>
    <input type="hidden" id="<?php echo $menucod ?>status_fmInvlocat" value="create">
</form>
<br />
<div id="booklocat"></div>
<br />
<?php echo $this->renderPartial('//layouts/search');  ?>
<br />
<div id="window0">
    <div>เลขบัญชีธนาคาร</div>
    <div style="overflow: hidden;">
		<form id="fmBooklocat0">
			<table>
				<tr>
					<td align="right">เลขที่บัญชี : </td>
					<td align="left"><input id="bookcode0" /></td>
				</tr>
				<tr>
					<td align="right">รายละเอียดบัญชี : </td>
					<td align="left"><input id="bookdesc0" /></td>
				</tr>
				<tr>
					<td align="right">ยอดยกมา : </td>
					<td align="left"><div id="balance0"></div></td>
				</tr>
				<tr>
					<td align="right">วันที่ยกมา : </td>
					<td align="left"><div id="datebalance0"></div></td>
				</tr>
				<tr>
					<td align="right"></td>
					<td style="padding-top: 10px;" align="right"><input style="margin-right: 5px;" type="button" id="Save0" value="บันทึก" /><input id="Cancel0" type="button" value="ยกเลิก" /></td>
				</tr>
			</table>
			<input type="hidden" id="status0" value="">
            <input type="hidden" id="bookcode_hd0" value="">
			<input type="hidden" id="bookcode_chk0" value="">
			<input type="hidden" id="bookcode_id0" value="">
            <input type="hidden" id="bookcode_rowindex0" value="">
		</form>
    </div>
</div>

<script type="text/javascript"> 
    $(document).ready(function () {
        $.ajaxSetup({ cache: false });

        var width = $(window).width();
        var height = $(window).height();
        var theme = 'ui-redmond';
        var url = 'invlocat/getbookcode';
        var menucod = $("#invlocatid").val();
        // prepare the data
        var source =
        {
            datatype: "json",
            datafields: [
                { name: 'bookcode', type: 'string' },
                { name: 'bookdesc', type: 'string' },
                { name: 'balance', type: 'float' },
                { name: 'datebalance', type: 'date' },
				{ name: 'status', type: 'string' },
				{ name: 'bookcode_chk', type: 'string' }
            ],
            addrow: function (rowid, rowdata, position, commit) {
                //alert(rowid+rowdata+position+commit);
                // $.post('invlocat/addbookcode', {bookcode: rowdata.bookcode, bookdesc: rowdata.bookdesc, balance: rowdata.balance, datebalance: rowdata.datebalance, status:rowdata.status, bookcode_chk: rowdata.bookcode_chk}, function(data, textStatus, xhr) {
                //     //console.log(data);
                //     if (data === 'true') {
                //         commit(true);
                //     } else {
                //         commit(false);
                //     }
                // });
                commit(true);
            },
            deleterow: function (rowid, commit) {
                commit(true);
            },
            updaterow: function (rowid, newdata, commit) {
                commit(true);
            },
            id: 'id',
            url: url
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
                { text: 'วันที่ยกมา', datafield: 'datebalance', width: 100, columntype: 'datetimeinput', cellsformat: 'dd/MM/yyyy' }
            ],
            showtoolbar: true,
            rendertoolbar: function (toolbar) {
                var me = this;
                var container = $("<div style='margin: 5px;'></div>");
                toolbar.append(container);
                container.append('<div id="addrow1" class="fa fa-plus toolsbtn"> เพิ่มข้อมูล</div>');
                container.append('<div style="margin-left: 5px;" id="deleterow" class="fa fa-minus toolsbtn"> ลบข้อมูล</div>');
                container.append('<div style="margin-left: 5px;" id="updaterow" class="fa fa-pencil toolsbtn"> แก้ไขข้อมูล</div>');

                // create new row.
                $("#addrow1").on('click', function () {
                    $("#status0").val('insert');
                    $("#window0").jqxWindow('open');
                    //$("#bookcode0").jqxInput({ disabled:false });
                    //alert($("#status").val()+' create');
                    return false;
                });

                // delete row.
                $("#deleterow").on('click', function () {
					$("#status0").val('delete');
                    var selectedrowindex = $("#booklocat").jqxGrid('getselectedrowindex');
                    var rowscount = $("#booklocat").jqxGrid('getdatainformation').rowscount;
                    if (selectedrowindex >= 0 && selectedrowindex < rowscount) {
                        var id = $("#booklocat").jqxGrid('getrowid', selectedrowindex);
                        var rowindex = $('#booklocat').jqxGrid('getselectedrowindex');
                        //console.log(rowindex);
                        $.post('invlocat/delbookcode', {status: $("#status0").val(), bookcode_chk: $("#bookcode_chk0").val(), rowindex: rowindex}, function(data, textStatus, xhr) {
                            //console.log(data);
                            if (data === 'true') {
                                var commit = $("#booklocat").jqxGrid('deleterow', id);
                            }
                        });
                    }
                });
                // update row.
                $("#updaterow").on('click', function () {
                    $("#status0").val('update');
                    var rowindex = $('#booklocat').jqxGrid('getselectedrowindex');
                    var data = $('#booklocat').jqxGrid('getrowdata', rowindex);
                    $("#bookcode0").val(data.bookcode);
                    //$("#bookcode0").jqxInput({ disabled:true });
                    $("#bookcode_chk0").val(data.bookcode_chk);
                    $("#bookdesc0").val(data.bookdesc);
                    $("#balance0").val(data.balance);
                    $("#datebalance0").val(data.datebalance);
					//$("#status").val(data.status);
                    $("#bookcode_rowindex0").val(rowindex);
                    $("#window0").jqxWindow('open');
                    return false;
                });

                $("#addrow1").jqxButton({ width: 80, theme: theme });
                $("#deleterow").jqxButton({ width: 80, theme: theme });
                $("#updaterow").jqxButton({ width: 80, theme: theme });
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

        //function save on click
        $("#Save0").click(function () {
            //$.ajaxSetup({ cache: false });
            //alert($("#status_fmInvlocat").val()+' XXXX- '+$("#status0").val());
            if($("#"+menucod+"status_fmInvlocat").val()==='create'){
                var row = { bookcode: $("#bookcode0").val(), bookdesc: $("#bookdesc0").val(), balance: parseFloat($("#balance0").jqxNumberInput('decimal')), datebalance: $("#datebalance0").val(),status: $("#status0").val(), bookcode_chk: $("#bookcode0").val()};

                $('#fmBooklocat0').jqxValidator('validate', function (result) {
                    if(result===true){
                        //alert('You have filled the form correctly! ');
            			//alert($("#status").val());
                        if($("#"+menucod+"status_fmInvlocat").val()==='create'){

                            if ($("#status0").val() === 'insert') {
                                //alert("createXXX insert");
                                $.post('invlocat/addbookcode', {bookcode: $("#bookcode0").val(), bookdesc:$("#bookdesc0").val(), balance: parseFloat($("#balance0").jqxNumberInput("decimal")), datebalance: $("#datebalance0").val(),status: $("#status0").val(), bookcode_chk: $("#bookcode0").val() }, function(data, textStatus, xhr){
                                    if (data === 'true') {
                                        var commit = $('#booklocat').jqxGrid('addrow', null, row);
                                    }
                                });

                            }else if ($("#status0").val() === 'update') {
                                var rowindex = $("#booklocat").jqxGrid('getselectedrowindex');
                                var rowscount = $("#booklocat").jqxGrid('getdatainformation').rowscount;
                                if (rowindex >= 0 && rowindex < rowscount) {
                                    var id = $("#booklocat").jqxGrid('getrowid', rowindex);
                                    //alert(rowindex);
                                    $.post('invlocat/editbookcode', { bookcode: $("#bookcode0").val(), bookdesc:$("#bookdesc0").val(), balance: parseFloat($("#balance0").jqxNumberInput("decimal")), datebalance: $("#datebalance0").val(), status: $("#status0").val(), bookcode_chk: $("#bookcode_chk0").val(), rowindex: rowindex }, function(data, textStatus, xhr) {
                                        //console.log(data);
                                        if (data === 'true') {
                                            var commit = $("#booklocat").jqxGrid('updaterow', id, row);
                                            $("#booklocat").jqxGrid('ensurerowvisible', rowindex);
                                        } // end chk data = true
                                    }); // end post
                                }// end if chk rowindex >= 0 && rowindex < rowscount
                            }
                        }
                        $('#fmBooklocat0').jqxValidator('hide');
                        $("#window0").jqxWindow('close');
                    }
                });

            }else{
                alert("false");
            }
		});


        $('#window0').on('close', function (event) {
            $("#bookcode0").val('');
            $("#bookdesc0").val('');
            $("#balance0").val(0);
            $("#datebalance0").jqxDateTimeInput({ value: new Date() });
            //$("#status").val('');
            //alert("close create");
        });

        //Popup Edit & Button
        $("#bookcode0").jqxInput({ width: 380, height: 23, theme: theme });
        $("#bookdesc0").jqxInput({ width: 380, height: 23, theme: theme });
        $("#balance0").jqxNumberInput({ spinMode: 'simple', width: 380, height: 23, min: 0, spinButtons: true, theme: theme });
        $("#datebalance0").jqxDateTimeInput({ width: 380, height: 23, theme: theme });

        $("#Cancel0").jqxButton({ theme: theme });
        $("#Save0").jqxButton({ theme: theme });

        //Popup Window
        $("#window0").jqxWindow({
            theme: theme,
            width: 500,
            height: 180,
            resizable: false,
            isModal: true,
            autoOpen: false,
            cancelButton: $("#Cancel0"),
            modalOpacity: 0.01
        });

        $("#"+menucod+"searchAmp").click(function() {
            $('#result').load('search/index?show=setaump&returnid='+menucod+'aumpcod');
            $('#search').jqxWindow('open');
        });
        $("#"+menucod+"searchPrv").click(function() {
            $('#result').load('search/index?show=setprov&returnid='+menucod+'provcod');
            $('#search').jqxWindow('open');
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
            closeOnClick: false,
            focus: false,
            animationDuration: 0,
            rules:  [
                       { input: '#'+menucod+'locatcd', message: 'กรุณาระบุรหัสสาขา !', action: 'keyup, blur', rule: 'required' },
                       { input: '#'+menucod+'locatcd', message: 'ระบุรหัสสาขา ซ้ำ !', action: 'keyup, blur',
                           rule: function (input, commit) {
                               if($("#bookcode_rowindex0").val()==''){
                                   $("#bookcode_rowindex0").val('0');
                               }
                               $.ajax({
                                   url: "invlocat/validatedata",
                                   type: 'POST',
                                   data: {data1: "0", data2: $("#"+menucod+"locatcd").val(), status: 'update', frmTable:'invlocat', frmField:'locatcd',rowindex:$("#bookcode_rowindex0").val()},
                                   success: function(data){
                                       if (data == "true"){
                                           commit(true);
                                       }else commit(false);
                                   },
                                   error: function(){
                                       commit(false);
                                   }
                               });
                               // $.post('invlocat/validatedata', { data1: $("#idno").val(), data2: $("#locatcd").val(), status: 'update', frmTable:'invlocat', frmField:'locatcd'}, function(data) {
                               //     if (data == "true"){
                               //         commit(true);
                               //     }else commit(false);
                               // });
                           }
                       },
                       { input: '#'+menucod+'shortl', message: 'กรุณาระบุรหัสเอกสาร !', action: 'keyup, blur', rule: 'required' },
                       { input: '#'+menucod+'shortl', message: 'ระบุรหัสเอกสาร ซ้ำ !', action: 'keyup, blur',
                           rule: function (input, commit) {
                                   if($("#bookcode_rowindex0").val()==''){
                                       $("#bookcode_rowindex0").val('0');
                                   }
                                   $.ajax({
                                       url: "invlocat/validatedata",
                                       type: 'POST',
                                       data: {data1: "0", data2: $("#"+menucod+"shortl").val(), status: 'insert', frmTable:'invlocat', frmField:'shortl',rowindex:$("#bookcode_rowindex0").val()},
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
		$('#fmBooklocat0').jqxValidator({
            hintType: 'label',
            closeOnClick: false,
            focus: false,
            animationDuration: 0,
            rules:  [
						{ input: '#bookcode0', message: 'กรุณาระบุรหัสบัญชี !', action: 'keyup, blur', rule: 'required' },
                        { input: '#bookcode0', message: 'รหัสบัญชี ซ้ำ !', action: 'keyup, blur',
								rule: function (input, commit) {
                                    if($("#bookcode_id0").val() == ''){
                                        $("#bookcode_id0").val('0');
                                    }
                                    if($("#bookcode_rowindex0").val()==''){
                                        $("#bookcode_rowindex0").val('0');
                                    }

									$.ajax({
										url: "invlocat/validatedata",
										type: 'POST',
										data: {data1: $("#bookcode_id0").val(), data2: $("#bookcode0").val(), status: $("#status0").val(), frmTable:'booklocat', frmField:'bookcode',rowindex:$("#bookcode_rowindex0").val()},
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
                    postcode();
                    provdesc();
                }
            });
        };

        var postcode = function() {
            $.ajax({
                url: "validate/findvalue",
                type: 'get',
                data: { table: 'setaump', field: 'aumpcode', code: $('#'+menucod+'aumpcod1').val(), fieldv: 'postcode' },
                success: function(data) {
                    $('#'+menucod+'postcod').val(data);
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

        //save data
        var invlocat_save = function() {
            //$('#fmInvlocat').jqxValidator('validate');

            $('#fmInvlocat').jqxValidator('validate', function (result) {
                if(result){
                    $.when($.confirmdlg('คุณต้องการที่จะบันทึกข้อมูล สาขา ?', 'info')).then(function(){
                        $('#ok').click(function(event){
                            $.ajax({
                                url: "invlocat/save",
                                data: {locatcd: $("#"+menucod+"locatcd").val(), locatnm: $("#"+menucod+"locatnm").val(), locaddr1: $("#"+menucod+"locaddr1").val(),
                                       locaddr2: $("#"+menucod+"locaddr2").val(), telp: $("#"+menucod+"telp").val(), shortl: $("#"+menucod+"shortl").val(),
                                       aumpcod: $("#"+menucod+"aumpcod").val(), provcod: $("#"+menucod+"provcod").val(), postcod: $("#"+menucod+"postcod").val(),
                                       accmstcod: $("#"+menucod+"accmstcod").val(), accmstcod2: $("#"+menucod+"accmstcod2").val(),chkstatus: "insert", menucod: menucod},
                                type: 'POST',
                                success: function (data) {
                                    //alert('บันทึกรายการแล้ว !');
                                    $("#"+menucod).html(data);
                					// $.ajax({
                					// 	url: "invlocat/index",
                					// 	success: function(data) {
                					// 		$("#showform").html(data);
                					// 	}
                					// });
                                }
                            });
                        });
                    });
                };
            });
        };

        //back to invlocat
        var invlocat_back = function(event) {
            $('#fmInvlocat').jqxValidator('hide');
            $.ajax({
                url: "invlocat/index",
                data: { menucod: menucod },
                type: 'get',
                cache: false,
                success: function(data) {
                    $("#"+menucod).html(data);
                }
            });
        };
    });
</script>
