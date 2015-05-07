<h2><i class="fa fa-cog"></i> แก้ไขข้อมูลอัตราภาษี</h2>
<div id="intrmastTool"></div>
<input type="hidden" id="intrmastid" value="<?php echo $menucod ?>">
<br />
<form id="fmintrmast">
    <input type="hidden" id="<?php echo $menucod ?>v-idno" value="<?php echo $intrmast->idno; ?>">
    <table class="intrmast-table">
        <tr>
            <td>จากวันที่</td>
            <td>
                <div id="<?php echo $menucod ?>frmdate"></div>
                <input type="hidden" id="<?php echo $menucod ?>v-frmdate" value="<?php echo $intrmast->frmdate; ?>">
            </td>
        </tr>
        <tr>
            <td>ถึงวันที่</td>
            <td>
                <div id="<?php echo $menucod ?>todate"></div>
                <input type="hidden" id="<?php echo $menucod ?>v-todate" value="<?php echo $intrmast->todate; ?>">
            </td>
        </tr>
        <tr>
            <td>อัตราเบี้ยปรับ (%)</td>
            <td>
                <div id="<?php echo $menucod ?>intr"></div>
                <input type="hidden" id="<?php echo $menucod ?>v-intr" value="<?php echo $intrmast->intr; ?>">
            </td>
        </tr>
    </table>
</form>
<br />

<script type="text/javascript">
    $(document).ready(function () {
        var width = $(window).width();
        var height = $(window).height();
        var theme = 'ui-redmond';
        var menucod = $("#intrmastid").val();
        $("#"+menucod+"frmdate").jqxDateTimeInput({ height: 23, width: 121, theme: theme });
        $("#"+menucod+"todate").jqxDateTimeInput({ height: 23, width: 121, theme: theme });
        $("#"+menucod+"intr").jqxNumberInput({ inputMode: 'simple', width: 121, height: 23, max: 99, spinButtons: true, theme: theme });
        //จากวันที่
        $("#"+menucod+"frmdate").val($("#"+menucod+"v-frmdate").val());
        //ถึงวันที่
        $("#"+menucod+"todate").val($("#"+menucod+"v-todate").val());
        //อัตราภาษี
        $("#"+menucod+"intr").val($("#"+menucod+"v-intr").val());

        $("#intrmastTool").jqxToolBar({ width: '100%', height: 50, theme: theme, tools: 'button | button ',
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
                            intrmast_back();
                        });
                        break;
                    case 1:
                        icon.addClass("fa fa-floppy-o fa-lg");
                        icon.attr("title", "บันทึกข้อมูล");
                        icon.attr("id", menucod+"btnSave");
                        icon.html("<p style='margin-top:3px;'>บันทึกข้อมูล</p>");
                        tool.append(icon);
                        tool.click(function() {
                            intrmast_save();
                        });
                        break;
                }
            }
        });

        $('#fmintrmast').jqxValidator({
            hintType: 'label',
            animationDuration: 0,
            closeOnClick: false,
            rules:  [
                        { input: '#'+menucod+'frmdate', message: 'กรุณาระบุวันที่เริ่มต้น!', action: 'keyup, blur', rule: 'required' },
                        { input: '#'+menucod+'todate', message: 'กรุณาระบุวันที่สิ้นสุด!', action: 'keyup, blur', rule: 'required' }
                    ]
        });

        //ปุ่มบันทึกข้อมูล
        var intrmast_save = function() {
            $('#fmintrmast').jqxValidator('validate', function (result) {
                if (result) {
                    $.when($.confirmdlg('ต้องการบันทึกข้อมูล?', 'info')).then(function() {
                        $('#ok').click(function(event) {
                            $.ajax({
                                url: "intrmast/save",
                                data: { menucod: menucod, idno: $("#"+menucod+"v-idno").val(),frmdate: $("#"+menucod+"frmdate").val(), todate: $("#"+menucod+"todate").val(), intr: $("#"+menucod+"intr").val() },
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
        var intrmast_back = function(event) {
            $('#fmintrmast').jqxValidator('hide');
            $.ajax({
                url: "intrmast/index",
                data: { menucod: menucod },
                type: 'get',
                success: function(data) {
                    $("#"+menucod).html(data);
                }
            });
        };
    });
</script>