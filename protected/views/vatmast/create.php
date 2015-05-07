<h2><i class="fa fa-cog"></i> เพิ่มข้อมูลอัตราภาษี</h2>
<div id="vatmastTool"></div>
<input type="hidden" id="vatmastid" value="<?php echo $menucod ?>">
<br />
<form id="fmvatmast">
    <table class="vatmast-table">
        <tr>
            <td>จากวันที่</td>
            <td><div id="<?php echo $menucod ?>frmdate"></div></td>
        </tr>
        <tr>
            <td>ถึงวันที่</td>
            <td><div id="<?php echo $menucod ?>todate"></div></td>
        </tr>
        <tr>
            <td>อัตราภาษี (%)</td>
            <td><div id="<?php echo $menucod ?>vatrt"></div></td>
        </tr>
    </table>
</form>
<br />

<script type="text/javascript">
    $(document).ready(function () {
        var width = $(window).width();
        var height = $(window).height();
    	var theme = 'ui-redmond';
    	var menucod = $("#vatmastid").val();
    	$("#"+menucod+"frmdate").jqxDateTimeInput({ height: 23, width: 121, theme: theme });
        $("#"+menucod+"todate").jqxDateTimeInput({ height: 23, width: 121, theme: theme });
        $("#"+menucod+"vatrt").jqxNumberInput({ inputMode: 'simple', width: 121, height: 23, max: 99, spinButtons: true, theme: theme });
        $("#vatmastTool").jqxToolBar({ width: '100%', height: 50, theme: theme, tools: 'button | button ',
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
                            vatmast_back();
                        });
                        break;
                    case 1:
                        icon.addClass("fa fa-floppy-o fa-lg");
                        icon.attr("title", "บันทึกข้อมูล");
                        icon.attr("id", menucod+"btnSave");
                        icon.html("<p style='margin-top:3px;'>บันทึกข้อมูล</p>");
                        tool.append(icon);
                        tool.click(function() {
                            vatmast_save();
                        });
                        break;
                }
            }
        });

        $('#fmvatmast').jqxValidator({
            hintType: 'label',
            animationDuration: 0,
            closeOnClick: false,
            rules:  [
                        { input: '#'+menucod+'frmdate', message: 'กรุณาระบุวันที่เริ่มต้น!', action: 'keyup, blur', rule: 'required' },
                        { input: '#'+menucod+'todate', message: 'กรุณาระบุวันที่สิ้นสุด!', action: 'keyup, blur', rule: 'required' }
                    ]
        });

        //ปุ่มบันทึกข้อมูล
        var vatmast_save = function() {
            $('#fmvatmast').jqxValidator('validate', function (result) {
                if (result) {
                    $.when($.confirmdlg('ต้องการบันทึกข้อมูล?', 'info')).then(function() {
                        $('#ok').click(function(event) {
                            $.ajax({
                                url: "vatmast/save",
                                data: { menucod: menucod, idno: 0,frmdate: $("#"+menucod+"frmdate").val(), todate: $("#"+menucod+"todate").val(), vatrt: $("#"+menucod+"vatrt").val() },
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
        var vatmast_back = function(event) {
            $('#fmvatmast').jqxValidator('hide');
            $.ajax({
                url: "vatmast/index",
                data: { menucod: menucod },
                type: 'get',
                success: function(data) {
                    $("#"+menucod).html(data);
                }
            });
        };
    });
</script>