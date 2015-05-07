<h2><i class="fa fa-cog"></i> แก้ไขข้อมูลรหัสการชำระ</h2>
<div id="payforTool"></div>
<input type="hidden" id="payforid" value="<?php echo $menucod ?>">
<br />
<form id="fmPayfor">
    <table class="payfor-table">
        <tr>
            <td>รหัสการชำระ</td>
            <td><input type="text" id="<?php echo $menucod ?>forcode" value="<?php echo $payfor->forcode; ?>"></td>
        </tr>
        <tr>
            <td>คำอธิบาย</td>
            <td><input type="text" id="<?php echo $menucod ?>fordesc" value="<?php echo $payfor->fordesc; ?>"></td>
        </tr>
        <tr>
            <td>ประเภทเอกสาร</td>
            <td><div id="<?php echo $menucod ?>doctype"></div><input type="hidden" id="<?php echo $menucod ?>v-doctype" value="<?php echo $payfor->doctype; ?>"></td>
        </tr>
        <tr>
            <td></td>
            <td><div id="<?php echo $menucod ?>taxfl">ออกใบกำกับภาษี</div><input type="hidden" id="<?php echo $menucod ?>v-taxfl" value="<?php echo $payfor->taxfl; ?>"></td>
        </tr>
        <tr>
            <td></td>
            <td><div id="<?php echo $menucod ?>block">ระงับการใช้งาน</div><input type="hidden" id="<?php echo $menucod ?>v-block" value="<?php echo $payfor->block; ?>"></td>
        </tr>
        <tr>
            <td>รหัสบัญชี</td>
            <td><input type="text" id="<?php echo $menucod ?>accmstcod" value="<?php echo $payfor->accmstcod; ?>"></td>
        </tr>
        <tr>
            <td>ประเภทรหัส</td>
            <td>
                <input type="hidden" id="<?php echo $menucod ?>v-typechk" value="<?php echo $payfor->typechk; ?>">
                <div style="float: left;" id='<?php echo $menucod ?>typechk1'>ค่างวด</div>
                <div style="float: left;" id='<?php echo $menucod ?>typechk2'>ปิดบัญชี</div>
                <div style="float: left;" id='<?php echo $menucod ?>typechk3'>รถยึด</div>
                <div style="float: left;" id='<?php echo $menucod ?>typechk4'>เบี้ยปรับ</div>
                <div style="float: left;" id='<?php echo $menucod ?>typechk5'>อื่นๆ</div>
                <div style="float: left;" id='<?php echo $menucod ?>typechk6'>ค่าติดตาม</div>
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
        $("#"+menucod+"forcode").jqxInput({ height: 23, width: 121, theme: theme, minLength: 1, maxLength: 10, disabled: true });
        $("#"+menucod+"fordesc").jqxInput({ height: 23, width: 300, theme: theme, maxLength: 60 });
        $("#"+menucod+"doctype").jqxDropDownList({ height: 23, width: 150, source: source, displayMember: 'text', valueMember: 'value', theme: theme, dropDownHeight:80 });
        $("#"+menucod+"taxfl").jqxCheckBox({ width: 130, theme: theme });
        $("#"+menucod+"block").jqxCheckBox({ width: 130, theme: theme });
        $("#"+menucod+"accmstcod").jqxInput({ height: 23, width: 121, theme: theme, maxLength: 60 });
        $("#"+menucod+"typechk1").jqxRadioButton({ height: 23, width: 80, theme: theme });
        $("#"+menucod+"typechk2").jqxRadioButton({ height: 23, width: 80, theme: theme });
        $("#"+menucod+"typechk3").jqxRadioButton({ height: 23, width: 80, theme: theme });
        $("#"+menucod+"typechk4").jqxRadioButton({ height: 23, width: 80, theme: theme });
        $("#"+menucod+"typechk5").jqxRadioButton({ height: 23, width: 80, theme: theme });
        $("#"+menucod+"typechk6").jqxRadioButton({ height: 23, width: 80, theme: theme });
        //ประเภทเอกสาร
        if ($("#"+menucod+"v-doctype").val() == 'H') {
            $("#"+menucod+"doctype").jqxDropDownList('selectIndex',0);
        } else if ($("#"+menucod+"v-doctype").val() == 'T') {
            $("#"+menucod+"doctype").jqxDropDownList('selectIndex',1);
        } else if ($("#"+menucod+"v-doctype").val() == 'N') {
            $("#"+menucod+"doctype").jqxDropDownList('selectIndex',2);
        } else {
            $("#"+menucod+"doctype").jqxDropDownList('clearSelection');
        }
        //ออกใบกำกับภาษี
        if ($("#"+menucod+"v-taxfl").val() == 'Y') {
            $("#"+menucod+"taxfl").jqxCheckBox({ checked: true });
        } else {
            $("#"+menucod+"taxfl").jqxCheckBox({ checked: false });
        }
        //ระงับการใช้งาน
        if ($("#"+menucod+"v-block").val() == 'Y') {
            $("#"+menucod+"block").jqxCheckBox({ checked: true });
        } else {
            $("#"+menucod+"block").jqxCheckBox({ checked: false });
        }
        //ประเภทรหัส
        if ($("#"+menucod+"v-typechk").val() == '1') {
            $("#"+menucod+"typechk1").jqxRadioButton({ checked: true });
        } else if ($("#"+menucod+"v-typechk").val() == '2') {
            $("#"+menucod+"typechk2").jqxRadioButton({ checked: true });
        } else if ($("#"+menucod+"v-typechk").val() == '3') {
            $("#"+menucod+"typechk3").jqxRadioButton({ checked: true });
        } else if ($("#"+menucod+"v-typechk").val() == '4') {
            $("#"+menucod+"typechk4").jqxRadioButton({ checked: true });
        } else if ($("#"+menucod+"v-typechk").val() == '5') {
            $("#"+menucod+"typechk5").jqxRadioButton({ checked: true });
        } else {
            $("#"+menucod+"typechk6").jqxRadioButton({ checked: true });
        }
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
                            input: '#'+menucod+'typechk6', message: 'กรุณาเลือกประเภทรหัส', action: 'change', rule: function () {
                                var checked = $('#'+menucod+'typechk1').jqxRadioButton("checked") || $('#'+menucod+'typechk2').jqxRadioButton("checked") || $('#'+menucod+'typechk3').jqxRadioButton("checked") || $('#'+menucod+'typechk4').jqxRadioButton("checked") || $('#'+menucod+'typechk5').jqxRadioButton("checked") || $('#'+menucod+'typechk6').jqxRadioButton("checked");
                                return checked;
                            }
                        } 
                    ]
        });
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