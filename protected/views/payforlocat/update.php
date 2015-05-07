<h2><i class="fa fa-cog"></i> แก้ไขข้อมูลรหัสการชำระ</h2>
<div id="payforlocatTool"></div>
<input type="hidden" id="payforlocatid" value="<?php echo $menucod ?>">
<br />
<form id="fmPayforlocat">
    <table class="payforlocat-table">
        <tr>
            <td>รหัสการชำระ</td>
            <td><input type="text" id="<?php echo $menucod ?>forcode" value="<?php echo $payforlocat->forcode; ?>"></td>
        </tr>
        <tr>
            <td>คำอธิบาย</td>
            <td><input type="text" id="<?php echo $menucod ?>fordesc" value="<?php echo $payforlocat->fordesc; ?>"></td>
        </tr>
        <tr>
            <td></td>
            <td><div id="<?php echo $menucod ?>block">ระงับการใช้งาน</div><input type="hidden" id="<?php echo $menucod ?>v-block" value="<?php echo $payforlocat->block; ?>"></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>รหัสบัญชี</td>
            <td><input type="text" id="<?php echo $menucod ?>accmstcod" value="<?php echo $payforlocat->accmstcod; ?>"></td>
        </tr>
        <tr>
            <td>ประเภทรหัส</td>
            <td>
                <input type="hidden" id="<?php echo $menucod ?>v-typechk" value="<?php echo $payforlocat->typechk; ?>">
                <div style="float: left;" id='<?php echo $menucod ?>typechk1'>รับเข้า</div>
                <div style="float: left;" id='<?php echo $menucod ?>typechk2'>จ่ายออก</div>
            </td>
        </tr>
    </table>
</form>
<script type="text/javascript">
    $(document).ready(function () {
        var theme = 'ui-redmond';
        var menucod = $("#payforlocatid").val();
        var source = [
                        { text: "เอกสารค่างวด/ปิดบัญชี", value: 'H' },
                        { text: "เอกสารอื่นๆ มีภาษี", value: 'T' },
                        { text: "เอกสารอื่นๆ ไม่มีภาษี", value: 'N' }
                    ];
        $("#"+menucod+"forcode").jqxInput({ height: 23, width: 121, theme: theme, minLength: 1, maxLength: 10, disabled: true });
        $("#"+menucod+"fordesc").jqxInput({ height: 23, width: 300, theme: theme, maxLength: 60 });
        //$("#"+menucod+"doctype").jqxDropDownList({ height: 23, width: 150, source: source, displayMember: 'text', valueMember: 'value', theme: theme, dropDownHeight:80 });
        //$("#"+menucod+"taxfl").jqxCheckBox({ width: 130, theme: theme });
        $("#"+menucod+"block").jqxCheckBox({ width: 130, theme: theme });
        $("#"+menucod+"accmstcod").jqxInput({ height: 23, width: 121, theme: theme, maxLength: 60 });
        $("#"+menucod+"typechk1").jqxRadioButton({ height: 23, width: 80, theme: theme });
        $("#"+menucod+"typechk2").jqxRadioButton({ height: 23, width: 80, theme: theme });

        //ระงับการใช้งาน
        if ($("#"+menucod+"v-block").val() == 'Y') {
            $("#"+menucod+"block").jqxCheckBox({ checked: true });
        } else {
            $("#"+menucod+"block").jqxCheckBox({ checked: false });
        }
        //ประเภทรหัส
        if ($("#"+menucod+"v-typechk").val() == 'R') {
            $("#"+menucod+"typechk1").jqxRadioButton({ checked: true });
        } else if ($("#"+menucod+"v-typechk").val() == 'P') {
            $("#"+menucod+"typechk2").jqxRadioButton({ checked: true });
        }
        $("#payforlocatTool").jqxToolBar({ width: '100%', height: 50, theme: theme, tools: 'button | button ',
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
                            payforlocat_back();
                        });
                        break;
                    case 1:
                        icon.addClass("fa fa-floppy-o fa-lg");
                        icon.attr("title", "บันทึกข้อมูล");
                        icon.attr("id", menucod+"btnSave");
                        icon.html("<p style='margin-top:3px;'>บันทึกข้อมูล</p>");
                        tool.append(icon);
                        tool.click(function() {
                            payforlocat_save();
                        });
                        break;
                }
            }
        });
        $('#fmPayforlocat').jqxValidator({
            hintType: 'label',
            animationDuration: 0,
            closeOnClick: false,
            rules:  [
                        { input: '#'+menucod+'forcode', message: 'กรุณาระบุรหัสการชำระ!', action: 'keyup, blur', rule: 'required' },
                        {
                            input: '#'+menucod+'typechk2', message: 'กรุณาเลือกประเภทรหัส', action: 'change', rule: function () {
                                var checked = $('#'+menucod+'typechk1').jqxRadioButton("checked") || $('#'+menucod+'typechk2').jqxRadioButton("checked");
                                return checked;
                            }
                        }
                    ]
        });
        var payforlocat_save = function() {
            $('#fmPayforlocat').jqxValidator('validate', function (result) {
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
                                typechk = 'R';
                            } else if ($("#"+menucod+"typechk2").val() == true) {
                                typechk = 'P';
                            } 
                            $.ajax({
                                url: "payforlocat/save",
                                data: { menucod: menucod, forcode: $("#"+menucod+"forcode").val(), fordesc: $("#"+menucod+"fordesc").val(), block: block, accmstcod: $("#"+menucod+"accmstcod").val(), typechk: typechk },
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
        var payforlocat_back = function(event) {
            $('#fmPayforlocat').jqxValidator('hide');
            $.ajax({
                url: "payforlocat/index",
                data: { menucod: menucod },
                type: 'get',
                success: function(data) {
                    $("#"+menucod).html(data);
                }
            });
        };
    });
</script>
