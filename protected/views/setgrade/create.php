<h2><i class="fa fa-cog"></i> เพิ่มข้อมูลเกรดลูกค้า</h2>
<div id="setgradeTool"></div>
<input type="hidden" id="setgradeid" value="<?php echo $menucod ?>">
<br />
<form id="fmSetgrade">
    <table class="setgrade-table">
        <tr>
            <td>รหัสเกรดลูกค้า</td>
            <td><input type="text" id="<?php echo $menucod ?>grdcode"></td>
        </tr>
        <tr>
            <td>คำอธิบาย</td>
            <td><input type="text" id="<?php echo $menucod ?>grddesc"></td>
        </tr>
        <tr>
            <td>จำนวนงวดค้าง</td>
            <td><div id="<?php echo $menucod ?>grdcal"></div></td>
        </tr>
        <tr>
            <td>การปล่อยสินเชื่อ</td>
            <td>
                <div id="<?php echo $menucod ?>grdflg">
                <div style="float: left;" id='<?php echo $menucod ?>grdflg1'>ปล่อยสินเชื่อ</div>
                <div style="float: left;" id='<?php echo $menucod ?>grdflg2'>ไม่ปล่อยสินเชื่อ</div>
                <div style="clear: both;"></div>
                </div>
            </td>
        </tr>
    </table>
</form>
<script type="text/javascript">
    $(document).ready(function () {
    	var theme = 'ui-redmond';
    	var menucod = $("#setgradeid").val();
    	$("#"+menucod+"grdcode").jqxInput({ height: 23, width: 121, theme: theme, minLength: 1, maxLength: 10 });
        $("#"+menucod+"grddesc").jqxInput({ height: 23, width: 300, theme: theme, maxLength: 60 });
        $("#"+menucod+"grdcal").jqxNumberInput({ spinMode: 'simple', inputMode: 'simple', width: 121, height: 23, min: 0, max: 99, spinButtons: true, theme: theme, decimalDigits: 0, groupSeparator: '' });
        $("#"+menucod+"grdflg1").jqxRadioButton({ height: 23, width: 120, theme: theme, groupName: 'grdcal' });
        $("#"+menucod+"grdflg2").jqxRadioButton({ height: 23, width: 120, theme: theme, groupName: 'grdcal' });
        $("#setgradeTool").jqxToolBar({ width: '100%', height: 50, theme: theme, tools: 'button | button ',
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
                            setgrade_back();
                        });
                        break;
                    case 1:
                        icon.addClass("fa fa-floppy-o fa-lg");
                        icon.attr("title", "บันทึกข้อมูล");
                        icon.attr("id", menucod+"btnSave");
                        icon.html("<p style='margin-top:3px;'>บันทึกข้อมูล</p>");
                        tool.append(icon);
                        tool.click(function() {
                            setgrade_save();
                        });
                        break;
                }
            }
        });
        $('#fmSetgrade').jqxValidator({
            hintType: 'label',
            animationDuration: 0,
            closeOnClick: false,
            rules:  [
                        { input: '#'+menucod+'grdcode', message: 'กรุณาระบุรหัสเกรดลูกค้า!', action: 'keyup, blur', rule: 'required' },
                        { input: '#'+menucod+'grdcode', message: 'ระบุรหัสประเภทการชำระซ้ำ!', action: 'keyup, blur', rule: function (input, commit) {
                                var grdcode = $("#"+menucod+"grdcode").val();
                                if (grdcode !== '') {
                                    $.ajax({
                                        url: "setgrade/validate",
                                        type: 'get',
                                        data: { grdcode: grdcode },
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
                            input: '#'+menucod+'grdflg', message: 'กรุณาเลือกเงือนไขการปล่อยสินเชื่อ', action: 'click', rule: function () {
                                var checked = $('#'+menucod+'grdflg1').jqxRadioButton("checked") || $('#'+menucod+'grdflg2').jqxRadioButton("checked");
                                return checked;
                            }
                        }
                    ]
        });
        function Validate_grdflg(){
            var checked = $('#'+menucod+'grdflg');
            $('#fmSetgrade').jqxValidator('validate', checked);
        }
        $('#'+menucod+'grdflg1').click(function () {
            Validate_grdflg();
        });
        $('#'+menucod+'grdflg2').click(function () {
            Validate_grdflg();
        });
        //ปุ่มบันทึกข้อมูล
        var setgrade_save = function() {
            $('#fmSetgrade').jqxValidator('validate', function (result) {
                if (result) {
                    $.when($.confirmdlg('ต้องการบันทึกข้อมูล?', 'info')).then(function() {
                        $('#ok').click(function(event) {
                            var grdflg = '';
                            if ($("#"+menucod+"grdflg1").val() == true) {
                                grdflg = 'Y';
                            } else if ($("#"+menucod+"grdflg2").val() == true) {
                                grdflg = 'N';
                            }
                            $.ajax({
                                url: "setgrade/save",
                                data: { menucod: menucod, grdcode: $("#"+menucod+"grdcode").val(), grddesc: $("#"+menucod+"grddesc").val(), grdcal: $("#"+menucod+"grdcal").val(), grdflg: grdflg },
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
        var setgrade_back = function(event) {
            $('#fmSetgrade').jqxValidator('hide');
            $.ajax({
                url: "setgrade/index",
                data: { menucod: menucod },
                type: 'get',
                success: function(data) {
                    $("#"+menucod).html(data);
                }
            });
        };
    });
</script>