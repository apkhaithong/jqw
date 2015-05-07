<h2><i class="fa fa-cog"></i> แก้ไขข้อมูลกลุ่มลูกหนี้</h2>
<div id="setargroupTool"></div>
<input type="hidden" id="setargroupid" value="<?php echo $menucod ?>">
<br />
<form id="fmsetargroup">
    <table class="setargroup-table">
        <tr>
            <td>รหัสกลุ่มลูกหนี้</td>
            <td><input type="text" id="<?php echo $menucod ?>argroupcode" value="<?php echo $setargroup->argroupcode; ?>"></td>
        </tr>
        <tr>
            <td>คำอธิบาย</td>
            <td><input type="text" id="<?php echo $menucod ?>argroupdesc" value="<?php echo $setargroup->argroupdesc; ?>"></td>
        </tr>
    </table>
</form>
<br />

<script type="text/javascript">
    $(document).ready(function () {
        var width = $(window).width();
        var height = $(window).height();
        var theme = 'ui-redmond';
        var menucod = $("#setargroupid").val();
        $("#"+menucod+"argroupcode").jqxInput({ height: 23, width: 121, theme: theme, minLength: 1, maxLength: 10, disabled: true });
        $("#"+menucod+"argroupdesc").jqxInput({ height: 23, width: 300, theme: theme, maxLength: 60 });
        $("#setargroupTool").jqxToolBar({ width: '100%', height: 50, theme: theme, tools: 'button | button ',
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
                            setargroup_back();
                        });
                        break;
                    case 1:
                        icon.addClass("fa fa-floppy-o fa-lg");
                        icon.attr("title", "บันทึกข้อมูล");
                        icon.attr("id", menucod+"btnSave");
                        icon.html("<p style='margin-top:3px;'>บันทึกข้อมูล</p>");
                        tool.append(icon);
                        tool.click(function() {
                            setargroup_save();
                        });
                        break;
                }
            }
        });

        $('#fmsetargroup').jqxValidator({
            hintType: 'label',
            animationDuration: 0,
            closeOnClick: false,
            rules:  [
                        { input: '#'+menucod+'argroupcode', message: 'กรุณาระบุรหัสกลุ่มลูกหนี้!', action: 'keyup, blur', rule: 'required' }
                    ]
        });

        //ปุ่มบันทึกข้อมูล
        var setargroup_save = function() {
            $('#fmsetargroup').jqxValidator('validate', function (result) {
                if (result) {
                    $.when($.confirmdlg('ต้องการบันทึกข้อมูล?', 'info')).then(function() {
                        $('#ok').click(function(event) {
                            $.ajax({
                                url: "setargroup/save",
                                data: { menucod: menucod, argroupcode: $("#"+menucod+"argroupcode").val(), argroupdesc: $("#"+menucod+"argroupdesc").val() },
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
        var setargroup_back = function(event) {
            $('#fmsetargroup').jqxValidator('hide');
            $.ajax({
                url: "setargroup/index",
                data: { menucod: menucod },
                type: 'get',
                success: function(data) {
                    $("#"+menucod).html(data);
                }
            });
        };
    });
</script>
