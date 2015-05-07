<h2><i class="fa fa-cog"></i> แก้ไขข้อมูลหรัสพนักงาน</h2>
<div id="officerTool"></div>
<input type="hidden" id="officerid" value="<?php echo $menucod ?>">
<br />
<form id="fmofficer">
    <table class="officer-table">
        <tr>
            <td>รหัสพนักงาน</td>
            <td><input type="text" id="<?php echo $menucod ?>code" value="<?php echo $officer->code; ?>"></td>
        </tr>
        <tr>
            <td>ชื่อ</td>
            <td><input type="text" id="<?php echo $menucod ?>name" value="<?php echo $officer->name; ?>"></td>
        </tr>
        <tr>
            <td>นามสกุล</td>
            <td><input type="text" id="<?php echo $menucod ?>surname" value="<?php echo $officer->surname; ?>"></td>
        </tr>
        <tr>
            <td>ที่อยู่</td>
            <td><input type="text" id="<?php echo $menucod ?>addr" value="<?php echo $officer->addr; ?>"></td>
        </tr>
        <tr>
            <td>เบอร์โทร</td>
            <td><input type="text" id="<?php echo $menucod ?>telp" value="<?php echo $officer->telp; ?>"></td>
        </tr>
        <tr>
            <td>สถานะ</td>
            <td>
                <input type="hidden" id="<?php echo $menucod ?>v-status" value="<?php echo $officer->status; ?>">
                <div id="status">
                <div style="float: left;" id='<?php echo $menucod ?>status1'>ปกติ</div>
                <div style="float: left;" id='<?php echo $menucod ?>status2'>ลาออก</div>
                <div style="clear: both;"></div>
                </div>
            </td>
        </tr>
    </table>
</form>
<script type="text/javascript">
    $(document).ready(function () {
        var theme = 'ui-redmond';
        var menucod = $("#officerid").val();

        $("#"+menucod+"code").jqxInput({ height: 23, width: 121, theme: theme, minLength: 1, maxLength: 10, disabled: true });
        $("#"+menucod+"name").jqxInput({ height: 23, width: 300, theme: theme, maxLength: 50 });
        $("#"+menucod+"surname").jqxInput({ height: 23, width: 300, theme: theme, maxLength: 50 });
        $("#"+menucod+"addr").jqxInput({ height: 23, width: 300, theme: theme, maxLength: 80 });
        $("#"+menucod+"telp").jqxInput({ height: 23, width: 300, theme: theme, maxLength: 50 });
        $("#"+menucod+"status1").jqxRadioButton({ height: 23, width: 80, theme: theme, groupName: 'status' });
        $("#"+menucod+"status2").jqxRadioButton({ height: 23, width: 80, theme: theme, groupName: 'status' });
        //สถานะ
        if ($("#"+menucod+"v-status").val() == 'Y') {
            $("#"+menucod+"status1").jqxRadioButton({ checked: true });
        } else {
            $("#"+menucod+"status2").jqxRadioButton({ checked: true });
        }
        $("#officerTool").jqxToolBar({ width: '100%', height: 50, theme: theme, tools: 'button | button ',
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
                            officer_back();
                        });
                        break;
                    case 1:
                        icon.addClass("fa fa-floppy-o fa-lg");
                        icon.attr("title", "บันทึกข้อมูล");
                        icon.attr("id", menucod+"btnSave");
                        icon.html("<p style='margin-top:3px;'>บันทึกข้อมูล</p>");
                        tool.append(icon);
                        tool.click(function() {
                            officer_save();
                        });
                        break;
                }
            }
        });
        $('#fmofficer').jqxValidator({
            hintType: 'label',
            animationDuration: 0,
            closeOnClick: false,
            rules:  [
                        { input: '#'+menucod+'code', message: 'กรุณาระบุรหัสพนักงาน!', action: 'keyup, blur', rule: 'required' },
                        { 
                            input: '#status', message: 'กรุณาเลือกสถานะการทำงาน', action: 'click', rule: function () {
                                var checked = $('#'+menucod+'status1').jqxRadioButton("checked") || $('#'+menucod+'status2').jqxRadioButton("checked");
                                return checked;
                            }
                        }
                    ]
        });
        function Validate_status(){
            var checked = $('#status');
            $('#fmofficer').jqxValidator('validate', checked);
        }
        $('#'+menucod+'status1').click(function () {
            Validate_status();
        });
        $('#'+menucod+'status2').click(function () {
            Validate_status();
        });
        //ปุ่มบันทึกข้อมูล
        var officer_save = function() {
            $('#fmofficer').jqxValidator('validate', function (result) {
                if (result) {
                    $.when($.confirmdlg('ต้องการบันทึกข้อมูล?', 'info')).then(function() {
                        $('#ok').click(function(event) {
                            var status = '';
                            if ($("#"+menucod+"status1").val() == true) {
                                status = 'Y';
                            } else {
                                status = 'N';
                            }
                            $.ajax({
                                url: "officer/save",
                                data: { menucod: menucod, code: $("#"+menucod+"code").val(), name: $("#"+menucod+"name").val(), surname: $("#"+menucod+"surname").val(), addr: $("#"+menucod+"addr").val(), telp: $("#"+menucod+"telp").val(), status: status },
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
        var officer_back = function(event) {
            $('#fmofficer').jqxValidator('hide');
            $.ajax({
                url: "officer/index",
                data: { menucod: menucod },
                type: 'get',
                success: function(data) {
                    $("#"+menucod).html(data);
                }
            });
        };
    });
</script>