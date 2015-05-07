<h2><i class="fa fa-cog"></i> เพิ่มข้อมูลประเภทการชำระ</h2>
<div id="paytypTool"></div>
<input type="hidden" id="paytypid" value="<?php echo $menucod ?>">
<br />
<form id="fmPaytyp">
    <table class="paytyp-table">
        <tr>
            <td>รหัสประเภทการชำระ</td>
            <td><input type="text" id="<?php echo $menucod ?>paycode"></td>
        </tr>
        <tr>
            <td>คำอธิบาย</td>
            <td><input type="text" id="<?php echo $menucod ?>paydesc"></td>
        </tr>
        <tr>
            <td>รหัสบัญชี</td>
            <td><input type="text" id="<?php echo $menucod ?>accmstcod"></td>
        </tr>
        <tr>
            <td>อ้างอิง</td>
            <td>
                <div id="<?php echo $menucod ?>ptype">
                <div style="float: left;" id='<?php echo $menucod ?>ptype1'>เงินสด</div>
                <div style="float: left;" id='<?php echo $menucod ?>ptype2'>เช็ค</div>
                <div style="float: left;" id='<?php echo $menucod ?>ptype3'>ธนาคาร</div>
                <div style="clear: both;"></div>
                </div>
            </td>
        </tr>
    </table>
</form>
<script type="text/javascript">
    $(document).ready(function () {
    	var theme = 'ui-redmond';
    	var menucod = $("#paytypid").val();
    	$("#"+menucod+"paycode").jqxInput({ height: 23, width: 121, theme: theme, minLength: 1, maxLength: 10 });
        $("#"+menucod+"paydesc").jqxInput({ height: 23, width: 300, theme: theme, maxLength: 60 });
        $("#"+menucod+"accmstcod").jqxInput({ height: 23, width: 121, theme: theme, maxLength: 10 });
        $("#"+menucod+"ptype1").jqxRadioButton({ height: 23, width: 80, theme: theme, groupName: 'ptype' });
        $("#"+menucod+"ptype2").jqxRadioButton({ height: 23, width: 80, theme: theme, groupName: 'ptype' });
        $("#"+menucod+"ptype3").jqxRadioButton({ height: 23, width: 80, theme: theme, groupName: 'ptype' });
        $("#paytypTool").jqxToolBar({ width: '100%', height: 50, theme: theme, tools: 'button | button ',
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
                            paytyp_back();
                        });
                        break;
                    case 1:
                        icon.addClass("fa fa-floppy-o fa-lg");
                        icon.attr("title", "บันทึกข้อมูล");
                        icon.attr("id", menucod+"btnSave");
                        icon.html("<p style='margin-top:3px;'>บันทึกข้อมูล</p>");
                        tool.append(icon);
                        tool.click(function() {
                            paytyp_save();
                        });
                        break;
                }
            }
        });
        $('#fmPaytyp').jqxValidator({
            hintType: 'label',
            animationDuration: 0,
            closeOnClick: false,
            rules:  [
                       { input: '#'+menucod+'paycode', message: 'กรุณาระบุรหัสประเภทการชำระ!', action: 'keyup, blur', rule: 'required' },
                       { input: '#'+menucod+'paycode', message: 'ระบุรหัสประเภทการชำระซ้ำ!', action: 'keyup, blur', rule: function (input, commit) {
                                var paycode = $("#"+menucod+"paycode").val();
                                if (paycode !== '') {
                                    $.ajax({
                                        url: "paytyp/validate",
                                        type: 'get',
                                        data: { paycode: paycode },
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
                            input: '#'+menucod+'ptype', message: 'กรุณาเลือกรหัสอ้งอิง', action: 'click', rule: function () {
                                var checked = $('#'+menucod+'ptype1').jqxRadioButton("checked") || $('#'+menucod+'ptype2').jqxRadioButton("checked") || $('#'+menucod+'ptype3').jqxRadioButton("checked");
                                return checked;
                            }
                        }
                    ]
        });
        function Validate_ptype(){
            var checked = $('#'+menucod+'ptype');
            $('#fmPaytyp').jqxValidator('validate', checked);
        }
        $('#'+menucod+'ptype1').click(function () {
            Validate_ptype();
        });
        $('#'+menucod+'ptype2').click(function () {
            Validate_ptype();
        });
        $('#'+menucod+'ptype3').click(function () {
            Validate_ptype();
        });
        //ปุ่มบันทึกข้อมูล
        var paytyp_save = function() {
            $('#fmPaytyp').jqxValidator('validate', function (result) {
                if (result) {
                    $.when($.confirmdlg('ต้องการบันทึกข้อมูล?', 'info')).then(function() {
                        $('#ok').click(function(event) {
                            var ptype = '';
                            if ($("#"+menucod+"ptype1").val() == true) {
                                ptype = 'C';
                            } else if ($("#"+menucod+"ptype2").val() == true) {
                                ptype = 'H';
                            } else if ($("#"+menucod+"ptype3").val() == true) {
                                ptype = 'B';
                            }
                            $.ajax({
                                url: "paytyp/save",
                                data: { menucod: menucod, paycode: $("#"+menucod+"paycode").val(), paydesc: $("#"+menucod+"paydesc").val(), ptype: ptype, accmstcod: $("#"+menucod+"accmstcod").val(), },
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
        var paytyp_back = function(event) {
            $('#fmPaytyp').jqxValidator('hide');
            $.ajax({
                url: "paytyp/index",
                data: { menucod: menucod },
                type: 'get',
                success: function(data) {
                    $("#"+menucod).html(data);
                }
            });
        };
    });
</script>