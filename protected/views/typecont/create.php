<h2><i class="fa fa-cog"></i> เพิ่มข้อมูลสถานะสัญญา</h2>
<div id="typecontTool"></div>
<input type="hidden" id="typecontid" value="<?php echo $menucod ?>">
<br />
<form id="fmtypecont">
    <table class="typecont-table">
        <tr>
            <td>รหัสสถานะสัญญา</td>
            <td><input type="text" id="<?php echo $menucod ?>typecode"></td>
        </tr>
        <tr>
            <td>คำอธิบาย</td>
            <td><input type="text" id="<?php echo $menucod ?>typedesc"></td>
        </tr>
        <tr>
            <td></td>
            <td><div id='<?php echo $menucod ?>alert'>แจ้งเตือนเมื่อชำระ</div></td>
        </tr>
    </table>
</form>
<br />

<script type="text/javascript">
    $(document).ready(function () {
        var width = $(window).width();
        var height = $(window).height();
    	var theme = 'ui-redmond';
    	var menucod = $("#typecontid").val();
    	$("#"+menucod+"typecode").jqxInput({ height: 23, width: 121, theme: theme, minLength: 1, maxLength: 10 });
        $("#"+menucod+"typedesc").jqxInput({ height: 23, width: 300, theme: theme, maxLength: 60 });
        $("#"+menucod+"alert").jqxCheckBox({ height: 23, width: 121, theme: theme });

        $("#typecontTool").jqxToolBar({ width: '100%', height: 50, theme: theme, tools: 'button | button ',
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
                            typecont_back();
                        });
                        break;
                    case 1:
                        icon.addClass("fa fa-floppy-o fa-lg");
                        icon.attr("title", "บันทึกข้อมูล");
                        icon.attr("id", menucod+"btnSave");
                        icon.html("<p style='margin-top:3px;'>บันทึกข้อมูล</p>");
                        tool.append(icon);
                        tool.click(function() {
                            typecont_save();
                        });
                        break;
                }
            }
        });

        $('#fmtypecont').jqxValidator({
            hintType: 'label',
            animationDuration: 0,
            closeOnClick: false,
            rules:  [
                        { input: '#'+menucod+'typecode', message: 'กรุณาระบุรหัสสถานะสัญญา!', action: 'keyup, blur', rule: 'required' },
                        { input: '#'+menucod+'typecode', message: 'ระบุรหัสสถานะสัญญาซ้ำ!', action: 'keyup, blur', rule: function (input, commit) {
                                var typecode = $("#"+menucod+"typecode").val();
                                if (typecode !== '') {
                                    $.ajax({
                                        url: "typecont/validate",
                                        type: 'get',
                                        data: { typecode: typecode },
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
        var typecont_save = function() {
            $('#fmtypecont').jqxValidator('validate', function (result) {
                if (result) {
                    $.when($.confirmdlg('ต้องการบันทึกข้อมูล?', 'info')).then(function() {
                        $('#ok').click(function(event) {
                            var alert = '';
                            if ($("#"+menucod+"alert").val() == true) {
                                alert = 'Y';
                            } else {
                                alert = 'N';
                            }
                            $.ajax({
                                url: "typecont/save",
                                data: { menucod: menucod, typecode: $("#"+menucod+"typecode").val(), typedesc: $("#"+menucod+"typedesc").val(), alert: alert},
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
        var typecont_back = function(event) {
            $('#fmtypecont').jqxValidator('hide');
            $.ajax({
                url: "typecont/index",
                data: { menucod: menucod },
                type: 'get',
                success: function(data) {
                    $("#"+menucod).html(data);
                }
            });
        };
    });
</script>