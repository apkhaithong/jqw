<h2><i class="fa fa-cog"></i> เพิ่มข้อมูลรหัสการชำระ</h2>
<div id="payforTool"></div>
<input type="hidden" id="payforid" value="<?php echo $menucod ?>">
<br />
<form id="fmPayfor">
    <table class="payfor-table">
        <tr>
            <td>รหัสการชำระ</td>
            <td><input type="text" id="<?php echo $menucod ?>forcode"></td>
        </tr>
        <tr>
            <td>คำอธิบาย</td>
            <td><input type="text" id="<?php echo $menucod ?>fordesc"></td>
        </tr>
        <tr>
            <td>ประเภทเอกสาร</td>
            <td><div id="<?php echo $menucod ?>doctype"></div></td>
        </tr>
        <tr>
            <td></td>
            <td><div id="<?php echo $menucod ?>taxfl">ออกใบกำกับภาษี</div></td>
        </tr>
        <tr>
            <td></td>
            <td><div id="<?php echo $menucod ?>block">ระงับการใช้งาน</div></td>
        </tr>
        <tr>
            <td>รหัสบัญชี</td>
            <td><input type="text" id="<?php echo $menucod ?>accmstcod"></td>
        </tr>
        <tr>
            <td>ประเภทรหัส</td>
            <td>
                <div id="typechk">
                <div style="float: left;" id='<?php echo $menucod ?>typechk1'>ค่างวด</div>
                <div style="float: left;" id='<?php echo $menucod ?>typechk2'>ปิดบัญชี</div>
                <div style="float: left;" id='<?php echo $menucod ?>typechk3'>รถยึด</div>
                <div style="float: left;" id='<?php echo $menucod ?>typechk4'>เบี้ยปรับ</div>
                <div style="float: left;" id='<?php echo $menucod ?>typechk5'>อื่นๆ</div>
                <div style="float: left;" id='<?php echo $menucod ?>typechk6'>ค่าติดตาม</div>
                <div style="clear: both;"></div>
                </div>
            </td>
        </tr>
    </table>
</form>
<script type="text/javascript">
    $(document).ready(function () {
    	var theme = 'ui-redmond';
    	var menucod = $("#payforid").val();
        var source = [
                        { text: "เอกสารค่างวด/ปิดบัญชี", value: 'H' },
                        { text: "เอกสารอื่นๆ มีภาษี", value: 'T' },
                        { text: "เอกสารอื่นๆ ไม่มีภาษี", value: 'N' }
                    ];
    	$("#"+menucod+"forcode").jqxInput({ height: 23, width: 121, theme: theme, minLength: 1, maxLength: 10 });
        $("#"+menucod+"fordesc").jqxInput({ height: 23, width: 300, theme: theme, maxLength: 60 });
        $("#"+menucod+"doctype").jqxDropDownList({ height: 23, width: 150, source: source, displayMember: 'text', valueMember: 'value', theme: theme, dropDownHeight:80 });
        $("#"+menucod+"taxfl").jqxCheckBox({ width: 130, theme: theme });
        $("#"+menucod+"block").jqxCheckBox({ width: 130, theme: theme });
        $("#"+menucod+"accmstcod").jqxInput({ height: 23, width: 121, theme: theme, maxLength: 60 });
        $("#"+menucod+"typechk1").jqxRadioButton({ height: 23, width: 80, theme: theme, groupName: 'typechk' });
        $("#"+menucod+"typechk2").jqxRadioButton({ height: 23, width: 80, theme: theme, groupName: 'typechk' });
        $("#"+menucod+"typechk3").jqxRadioButton({ height: 23, width: 80, theme: theme, groupName: 'typechk' });
        $("#"+menucod+"typechk4").jqxRadioButton({ height: 23, width: 80, theme: theme, groupName: 'typechk' });
        $("#"+menucod+"typechk5").jqxRadioButton({ height: 23, width: 80, theme: theme, groupName: 'typechk' });
        $("#"+menucod+"typechk6").jqxRadioButton({ height: 23, width: 80, theme: theme, groupName: 'typechk' });
        $("#payforTool").jqxToolBar({ width: '100%', height: 50, theme: theme, tools: 'button | button ',
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
                            payfor_back();
                        });
                        break;
                    case 1:
                        icon.addClass("fa fa-floppy-o fa-lg");
                        icon.attr("title", "บันทึกข้อมูล");
                        icon.attr("id", menucod+"btnSave");
                        icon.html("<p style='margin-top:3px;'>บันทึกข้อมูล</p>");
                        tool.append(icon);
                        tool.click(function() {
                            payfor_save();
                        });
                        break;
                }
            }
        });
        $('#fmPayfor').jqxValidator({
            hintType: 'label',
            animationDuration: 0,
            closeOnClick: false,
            rules:  [
                        { input: '#'+menucod+'forcode', message: 'กรุณาระบุรหัสการชำระ!', action: 'keyup, blur', rule: 'required' },
                        { 
                            input: '#'+menucod+'forcode', message: 'ระบุรหัสการชำระซ้ำ!', action: 'keyup, blur', rule: function (input, commit) {
                                var forcode = $("#"+menucod+"forcode").val();
                                if (forcode !== '') {
                                    $.ajax({
                                        url: "payfor/validate",
                                        type: 'get',
                                        data: { forcode: forcode },
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
                                }
                            }
                        },
                        { 
                            input: '#typechk', message: 'กรุณาเลือกประเภทรหัส', action: 'click', rule: function () {
                                var checked = $('#'+menucod+'typechk1').jqxRadioButton("checked") || $('#'+menucod+'typechk2').jqxRadioButton("checked") || $('#'+menucod+'typechk3').jqxRadioButton("checked") || $('#'+menucod+'typechk4').jqxRadioButton("checked") || $('#'+menucod+'typechk5').jqxRadioButton("checked") || $('#'+menucod+'typechk6').jqxRadioButton("checked");
                                return checked;
                            }
                        }
                    ]
        });
        function Validate_typechk(){
            var checked = $('#typechk');
            $('#fmPayfor').jqxValidator('validate', checked);
        }
        $('#'+menucod+'typechk1').click(function () {
            Validate_typechk();
        });
        $('#'+menucod+'typechk2').click(function () {
            Validate_typechk();
        });
        $('#'+menucod+'typechk3').click(function () {
            Validate_typechk();
        });
        $('#'+menucod+'typechk4').click(function () {
            Validate_typechk();
        });
        $('#'+menucod+'typechk5').click(function () {
            Validate_typechk();
        });
        $('#'+menucod+'typechk6').click(function () {
            Validate_typechk();
        });
        //ปุ่มบันทึกข้อมูล
        var payfor_save = function() {
            $('#fmPayfor').jqxValidator('validate', function (result) {
                if (result) {
                    $.when($.confirmdlg('ต้องการบันทึกข้อมูล?', 'info')).then(function() {
                        $('#ok').click(function(event) {
                            var taxfl = '';
                            var block = '';
                            var typechk = '';
                            if ($("#"+menucod+"taxfl").val() == true) {
                                taxfl = 'Y';
                            } else {
                                taxfl = 'N';
                            }
                            if ($("#"+menucod+"block").val() == true) {
                                block = 'Y';
                            } else {
                                block = 'N';
                            }
                            if ($("#"+menucod+"typechk1").val() == true) {
                                typechk = '1';
                            } else if ($("#"+menucod+"typechk2").val() == true) {
                                typechk = '2';
                            } else if ($("#"+menucod+"typechk3").val() == true) {
                                typechk = '3';
                            } else if ($("#"+menucod+"typechk4").val() == true) {
                                typechk = '4';
                            } else if ($("#"+menucod+"typechk5").val() == true) {
                                typechk = '5';
                            } else {
                                typechk = '6';
                            }
                            $.ajax({
                                url: "payfor/save",
                                data: { menucod: menucod, forcode: $("#"+menucod+"forcode").val(), fordesc: $("#"+menucod+"fordesc").val(), doctype: $("#"+menucod+"doctype").val(), taxfl: taxfl, block: block, accmstcod: $("#"+menucod+"accmstcod").val(), typechk: typechk },
                                type: 'POST',
                                success: function (data) {
                                    $("#"+menucod).html(data);
                                }
                            });
                        });
                    });
                }
            });
        }; 
        var payfor_back = function(event) {
            $('#fmPayfor').jqxValidator('hide');
            $.ajax({
                url: "payfor/index",
                data: { menucod: menucod },
                type: 'get',
                success: function(data) {
                    $("#"+menucod).html(data);
                }
            });
        };
    });
</script>