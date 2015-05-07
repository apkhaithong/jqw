<h2><i class="fa fa-cog"></i> เพิ่มข้อมูลรหัสการชำระสาขา</h2>
<div id="payforlocatTool"></div>
<input type="hidden" id="payforlocatid" value="<?php echo $menucod ?>">
<br />
<form id="fmPayfor">
    <table class="payforlocat-table">
        <tr>
            <td>รหัสการชำระ</td>
            <td><input type="text" id="<?php echo $menucod ?>forcode"></td>
        </tr>
        <tr>
            <td>คำอธิบาย</td>
            <td><input type="text" id="<?php echo $menucod ?>fordesc"></td>
        </tr>
        <tr>
            <td></td>
            <td><div id="<?php echo $menucod ?>block">ระงับการใช้งาน</div></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>รหัสบัญชี</td>
            <td><input type="text" id="<?php echo $menucod ?>accmstcod"></td>
        </tr>
        <tr>
            <td>ประเภทรหัส</td>
            <td>
                <div id="typechk">
                <div style="float: left;" id='<?php echo $menucod ?>typechk1'>รับเข้า</div>
                <div style="float: left;" id='<?php echo $menucod ?>typechk2'>จ่ายออก</div>
                <div style="clear: both;"></div>
                </div>
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
    	$("#"+menucod+"forcode").jqxInput({ height: 23, width: 121, theme: theme, minLength: 1, maxLength: 10 });
        $("#"+menucod+"fordesc").jqxInput({ height: 23, width: 300, theme: theme, maxLength: 60 });
        //$("#"+menucod+"doctype").jqxDropDownList({ height: 23, width: 150, source: source, displayMember: 'text', valueMember: 'value', theme: theme, dropDownHeight:80 });
        //$("#"+menucod+"taxfl").jqxCheckBox({ width: 130, theme: theme });
        $("#"+menucod+"block").jqxCheckBox({ width: 130, theme: theme });
        $("#"+menucod+"accmstcod").jqxInput({ height: 23, width: 121, theme: theme, maxLength: 60 });
        $("#"+menucod+"typechk1").jqxRadioButton({ height: 23, width: 80, theme: theme, groupName: 'typechk' });
        $("#"+menucod+"typechk2").jqxRadioButton({ height: 23, width: 80, theme: theme, groupName: 'typechk' });
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
                                        url: "payforlocat/validate",
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
                                var checked = $('#'+menucod+'typechk1').jqxRadioButton("checked") || $('#'+menucod+'typechk2').jqxRadioButton("checked");
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
        var payforlocat_save = function() {
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
            $('#fmPayfor').jqxValidator('hide');
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
