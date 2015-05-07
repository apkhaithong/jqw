<h2><i class="fa fa-cog"></i> แก้ไขข้อมูลบริษัทประกันภัย</h2>
<div id="garmastTool"></div>
<input type="hidden" id="garmastid" value="<?php echo $menucod ?>">
<br />
<form id="fmgarmast">
    <table class="garmast-table">
        <tr>
            <td>รหัสบริษัทประกัน</td>
            <td><input type="text" id="<?php echo $menucod ?>garcode" value="<?php echo $garmast->garcode; ?>"></td>
        </tr>
        <tr>
            <td>ชื่อบริษัท</td>
            <td><input type="text" id="<?php echo $menucod ?>garname" value="<?php echo $garmast->garname; ?>"></td>
        </tr>
        <tr>
            <td>ที่อยู่1</td>
            <td><input type="text" id="<?php echo $menucod ?>garaddr1" value="<?php echo $garmast->garaddr1; ?>"></td>
        </tr>
        <tr>
            <td>ที่อยู่2</td>
            <td><input type="text" id="<?php echo $menucod ?>garaddr2" value="<?php echo $garmast->garaddr2; ?>"></td>
        </tr>
        <tr>
            <td>เบอร์โทร</td>
            <td><input type="text" id="<?php echo $menucod ?>gartelp" value="<?php echo $garmast->gartelp; ?>"></td>
        </tr>
    </table>
</form>
<script type="text/javascript">
    $(document).ready(function () {
        var theme = 'ui-redmond';
        var menucod = $("#garmastid").val();

        $("#"+menucod+"garcode").jqxInput({ height: 23, width: 121, theme: theme, minLength: 1, maxLength: 10, disabled: true });
        $("#"+menucod+"garname").jqxInput({ height: 23, width: 300, theme: theme, maxLength: 100 });
        $("#"+menucod+"garaddr1").jqxInput({ height: 23, width: 300, theme: theme, maxLength: 100 });
        $("#"+menucod+"garaddr2").jqxInput({ height: 23, width: 300, theme: theme, maxLength: 100 });
        $("#"+menucod+"gartelp").jqxInput({ height: 23, width: 300, theme: theme, maxLength: 50 });

        $("#garmastTool").jqxToolBar({ width: '100%', height: 50, theme: theme, tools: 'button | button ',
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
                            garmast_back();
                        });
                        break;
                    case 1:
                        icon.addClass("fa fa-floppy-o fa-lg");
                        icon.attr("title", "บันทึกข้อมูล");
                        icon.attr("id", menucod+"btnSave");
                        icon.html("<p style='margin-top:3px;'>บันทึกข้อมูล</p>");
                        tool.append(icon);
                        tool.click(function() {
                            garmast_save();
                        });
                        break;
                }
            }
        });
        $('#fmgarmast').jqxValidator({
            hintType: 'label',
            animationDuration: 0,
            closeOnClick: false,
            rules:  [
                        { input: '#'+menucod+'garcode', message: 'กรุณาระบุรหัสบริษัทประกัน!', action: 'keyup, blur', rule: 'required' }
                    ]
        });
        function Validate_status(){
            var checked = $('#status');
            $('#fmgarmast').jqxValidator('validate', checked);
        }
        $('#'+menucod+'status1').click(function () {
            Validate_status();
        });
        $('#'+menucod+'status2').click(function () {
            Validate_status();
        });
        //ปุ่มบันทึกข้อมูล
        var garmast_save = function() {
            $('#fmgarmast').jqxValidator('validate', function (result) {
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
                                url: "garmast/save",
                                data: { menucod: menucod, garcode: $("#"+menucod+"garcode").val(), garname: $("#"+menucod+"garname").val(), garaddr1: $("#"+menucod+"garaddr1").val(), garaddr2: $("#"+menucod+"garaddr2").val(), gartelp: $("#"+menucod+"gartelp").val() },
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
        var garmast_back = function(event) {
            $('#fmgarmast').jqxValidator('hide');
            $.ajax({
                url: "garmast/index",
                data: { menucod: menucod },
                type: 'get',
                success: function(data) {
                    $("#"+menucod).html(data);
                }
            });
        };
    });
</script>