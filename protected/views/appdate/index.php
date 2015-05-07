<h2><i class="fa fa-cog"></i> กำหนดวันที่ทำงานระบบ</h2>
<div id="appdateTool"></div>
<br />
<form id="fmappdate">
    <table class="appdate-table">
        <tr>
            <td>วันที่ทำงานระบบ</td>
            <td>
                <div id="<?php echo $menucod ?>appdate"></div>
                <input type="hidden" id="<?php echo $menucod ?>licen_no" value="<?php echo $condpay->licen_no; ?>">
            </td>
        </tr>
    </table>
</form>
<br />
<input type="hidden" id="appdateid" value="<?php echo $menucod ?>">

<script type="text/javascript">
    $(document).ready(function () {
        var width = $(window).width();
        var height = $(window).height();
        var theme = 'ui-redmond';
        var menucod = $("#appdateid").val();
        $("#"+menucod+"appdate").jqxDateTimeInput({ height: 23, width: 121, theme: theme });
        $("#"+menucod+"appdate").val('<?php echo $condpay->appdate; ?>');
        $("#appdateTool").jqxToolBar({ width: '100%', height: 50, theme: theme, tools: 'button | button ',
            initTools: function (type, index, tool, menuToolIninitialization) {
                var icon = $("<div class='buttonIcon'></div>");
                switch (index) {
                    case 0:
                        icon.addClass("fa fa-floppy-o fa-lg");
                        icon.attr("title", "บันทึกข้อมูล");
                        icon.attr("id", menucod+"btnSave");
                        icon.html("<p style='margin-top:3px;'>บันทึกข้อมูล</p>");
                        tool.append(icon);
                        tool.click(function() {
                            appdate_save();
                        });
                        break;
                    case 1:
                        icon.addClass("fa fa-power-off fa-lg");
                        icon.attr("title", "ปิดระบบ");
                        icon.attr("id", menucod+"btnClose");
                        icon.html("<p>ปิดระบบ</p>");
                        tool.append(icon);
                        tool.click(function() {
                            appdate_close();
                        });
                        break;                        
                }
            }
        });

        $('#fmappdate').jqxValidator({
            hintType: 'label',
            animationDuration: 0,
            closeOnClick: false,
            rules:  [
                        { input: '#'+menucod+'appdate', message: 'กรุณาระบุวันที่ทำงานระบบ!', action: 'keyup, blur', rule: 'required' }
                    ]
        });

        //ปุ่มบันทึกข้อมูล
        var appdate_save = function() {
            $('#fmappdate').jqxValidator('validate', function (result) {
                if (result) {
                    $.when($.confirmdlg('ต้องการบันทึกข้อมูล?', 'info')).then(function() {
                        $('#ok').click(function(event) {
                            $.ajax({
                                url: "appdate/save",
                                data: { menucod: menucod, idno: 0, licen_no: $("#"+menucod+"licen_no").val(), appdate: $("#"+menucod+"appdate").val() },
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
        var appdate_close = function() {
            var selectedItem = $('#jqxTabs').jqxTabs('selectedItem');
            var disabledItems = $('#jqxTabs').jqxTabs('getDisabledTabsCount');
            var items = $('#jqxTabs').jqxTabs('length');
            if (items > disabledItems + 1) {
                $('#jqxTabs').jqxTabs('removeAt', selectedItem);
            }            
        };
    });
</script>