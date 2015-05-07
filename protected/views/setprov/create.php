<h2><i class="fa fa-cog"></i> เพิ่มข้อมูลรหัสจังหวัด</h2>
<div id="setprovTool"></div>
<input type="hidden" id="setprovid" value="<?php echo $menucod ?>">
<br />
<form id="fmsetprov">
    <table class="setprov-table">
        <tr>
            <td>รหัสจังหวัด</td>
            <td><input type="text" id="<?php echo $menucod ?>provcode"></td>
        </tr>
        <tr>
            <td>คำอธิบาย</td>
            <td><input type="text" id="<?php echo $menucod ?>provdesc"></td>
        </tr>
    </table>
</form>
<br />

<script type="text/javascript">
    $(document).ready(function () {
        var width = $(window).width();
        var height = $(window).height();
    	var theme = 'ui-redmond';
    	var menucod = $("#setprovid").val();
    	$("#"+menucod+"provcode").jqxInput({ height: 23, width: 121, theme: theme, minLength: 1, maxLength: 10 });
        $("#"+menucod+"provdesc").jqxInput({ height: 23, width: 300, theme: theme, maxLength: 60 });

        $("#setprovTool").jqxToolBar({ width: '100%', height: 50, theme: theme, tools: 'button | button ',
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
                            setprov_back();
                        });
                        break;
                    case 1:
                        icon.addClass("fa fa-floppy-o fa-lg");
                        icon.attr("title", "บันทึกข้อมูล");
                        icon.attr("id", menucod+"btnSave");
                        icon.html("<p style='margin-top:3px;'>บันทึกข้อมูล</p>");
                        tool.append(icon);
                        tool.click(function() {
                            setprov_save();
                        });
                        break;
                }
            }
        });

        $('#fmsetprov').jqxValidator({
            hintType: 'label',
            animationDuration: 0,
            closeOnClick: false,
            rules:  [
                        { input: '#'+menucod+'provcode', message: 'กรุณาระบุรหัสจังหวัด!', action: 'keyup, blur', rule: 'required' },
                        { input: '#'+menucod+'provcode', message: 'ระบุรหัสจังหวัดซ้ำ!', action: 'keyup, blur', rule: function (input, commit) {
                                var provcode = $("#"+menucod+"provcode").val();
                                if (provcode !== '') {
                                    $.ajax({
                                        url: "setprov/validate",
                                        type: 'get',
                                        data: { provcode: provcode },
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
                        }
                    ]
        });

        //ปุ่มบันทึกข้อมูล
        var setprov_save = function() {
            $('#fmsetprov').jqxValidator('validate', function (result) {
                if (result) {
                    $.when($.confirmdlg('ต้องการบันทึกข้อมูล?', 'info')).then(function() {
                        $('#ok').click(function(event) {
                            $.ajax({
                                url: "setprov/save",
                                data: { menucod: menucod, provcode: $("#"+menucod+"provcode").val(), provdesc: $("#"+menucod+"provdesc").val() },
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
        var setprov_back = function(event) {
            $('#fmsetprov').jqxValidator('hide');
            $.ajax({
                url: "setprov/index",
                data: { menucod: menucod },
                type: 'get',
                success: function(data) {
                    $("#"+menucod).html(data);
                }
            });
        };
    });
</script>