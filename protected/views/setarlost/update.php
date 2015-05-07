<h2><i class="fa fa-cog"></i> แก้ไขข้อมูลรหัสสาเหตุหนี้สูญ</h2>
<div id="setarlostTool"></div>
<input type="hidden" id="setarlostid" value="<?php echo $menucod ?>">
<br />
<form id="fmsetarlost">
    <table class="setarlost-table">
        <tr>
            <td>รหัสสาเหตุหนี้สูญ</td>
            <td><input type="text" id="<?php echo $menucod ?>arlostcode" value="<?php echo $setarlost->arlostcode; ?>"></td>
        </tr>
        <tr>
            <td>คำอธิบาย</td>
            <td><input type="text" id="<?php echo $menucod ?>arlostdesc" value="<?php echo $setarlost->arlostdesc; ?>"></td>
        </tr>
    </table>
</form>
<br />

<script type="text/javascript">
    $(document).ready(function () {
        var width = $(window).width();
        var height = $(window).height();
        var theme = 'ui-redmond';
        var menucod = $("#setarlostid").val();
        $("#"+menucod+"arlostcode").jqxInput({ height: 23, width: 121, theme: theme, minLength: 1, maxLength: 10, disabled: true });
        $("#"+menucod+"arlostdesc").jqxInput({ height: 23, width: 300, theme: theme, maxLength: 60 });
        $("#setarlostTool").jqxToolBar({ width: '100%', height: 50, theme: theme, tools: 'button | button ',
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
                            setarlost_back();
                        });
                        break;
                    case 1:
                        icon.addClass("fa fa-floppy-o fa-lg");
                        icon.attr("title", "บันทึกข้อมูล");
                        icon.attr("id", menucod+"btnSave");
                        icon.html("<p style='margin-top:3px;'>บันทึกข้อมูล</p>");
                        tool.append(icon);
                        tool.click(function() {
                            setarlost_save();
                        });
                        break;
                }
            }
        });

        $('#fmsetarlost').jqxValidator({
            hintType: 'label',
            animationDuration: 0,
            closeOnClick: false,
            rules:  [
                        { input: '#'+menucod+'arlostcode', message: 'กรุณาระบุรหัสสาเหตุหนี้สูญ!', action: 'keyup, blur', rule: 'required' }
                    ]
        });

        //ปุ่มบันทึกข้อมูล
        var setarlost_save = function() {
            $('#fmsetarlost').jqxValidator('validate', function (result) {
                if (result) {
                    $.when($.confirmdlg('ต้องการบันทึกข้อมูล?', 'info')).then(function() {
                        $('#ok').click(function(event) {
                            $.ajax({
                                url: "setarlost/save",
                                data: { menucod: menucod, arlostcode: $("#"+menucod+"arlostcode").val(), arlostdesc: $("#"+menucod+"arlostdesc").val() },
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
        var setarlost_back = function(event) {
            $('#fmsetarlost').jqxValidator('hide');
            $.ajax({
                url: "setarlost/index",
                data: { menucod: menucod },
                type: 'get',
                success: function(data) {
                    $("#"+menucod).html(data);
                }
            });
        };
    });
</script>
