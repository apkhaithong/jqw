<h2><i class="fa fa-cog"></i> เพิ่มข้อมูลรหัสอำเภอ</h2>
<div id="setaumpTool"></div>
<input type="hidden" id="setaumpid" value="<?php echo $menucod ?>">
<br />
<form id="fmsetaump">
    <table class="setaump-table">
        <tr>
            <td>รหัสอำเภอ</td>
            <td><input type="text" id="<?php echo $menucod ?>aumpcode"></td>
        </tr>
        <tr>
            <td>คำอธิบาย</td>
            <td><input type="text" id="<?php echo $menucod ?>aumpdesc"></td>
        </tr>
        <tr>
            <td>รหัสจังหวัด</td>
            <td>
                <div id="<?php echo $menucod ?>provcode" class="input-button">
                    <input type="text" id="<?php echo $menucod ?>v-provcode"/>
                    <div id="<?php echo $menucod ?>searchPrv"><img alt="search" width="16" height="16" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/search_lg.png" /></div>
                </div> 
                <div id="<?php echo $menucod ?>provdesc" class="input-desc"></div>           
            </td>
        </tr>
        <tr>
            <td>รหัสไปรษณีย์</td>
            <td><input type="text" id="<?php echo $menucod ?>postcode"></td>
        </tr>
    </table>
</form>
<br />
<?php echo $this->renderPartial('//layouts/search');  ?>
<script type="text/javascript">
    $(document).ready(function () {
        var width = $(window).width();
        var height = $(window).height();
    	var theme = 'ui-redmond';
    	var menucod = $("#setaumpid").val();
    	$("#"+menucod+"aumpcode").jqxInput({ height: 23, width: 121, theme: theme, minLength: 1, maxLength: 10 });
        $("#"+menucod+"aumpdesc").jqxInput({ height: 23, width: 300, theme: theme, maxLength: 60 });
        $("#"+menucod+"provcode").jqxInput({ height: 23, width: 129, theme: theme });
        $("#"+menucod+"postcode").jqxInput({ height: 23, width: 121, theme: theme, maxLength: 5 });

        $("#setaumpTool").jqxToolBar({ width: '100%', height: 50, theme: theme, tools: 'button | button ',
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
                            setaump_back();
                        });
                        break;
                    case 1:
                        icon.addClass("fa fa-floppy-o fa-lg");
                        icon.attr("title", "บันทึกข้อมูล");
                        icon.attr("id", menucod+"btnSave");
                        icon.html("<p style='margin-top:3px;'>บันทึกข้อมูล</p>");
                        tool.append(icon);
                        tool.click(function() {
                            setaump_save();
                        });
                        break;
                }
            }
        });
        $("#"+menucod+"searchPrv").click(function() {
            $("#result").load("search/index?show=setprov&returnid="+menucod+"provcode");
            $("#search").jqxWindow('open');
        });
        $('#fmsetaump').jqxValidator({
            hintType: 'label',
            animationDuration: 0,
            closeOnClick: false,
            rules:  [
                        { input: '#'+menucod+'aumpcode', message: 'กรุณาระบุรหัสอำเภอ!', action: 'keyup, blur', rule: 'required' },
                        { input: '#'+menucod+'aumpcode', message: 'ระบุรหัสอำเภอซ้ำ!', action: 'keyup, blur', rule: function (input, commit) {
                                var aumpcode = $("#"+menucod+"aumpcode").val();
                                if (aumpcode !== '') {
                                    $.ajax({
                                        url: "setaump/validate",
                                        type: 'get',
                                        data: { aumpcode: aumpcode },
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
                        { input: '#'+menucod+'provcode', message: 'กรุณาระบุรหัสจำงหวัด!', action: 'blur', rule: function () {
                                var checked = false;
                                if ($('#'+menucod+'v-provcode').val() !== '') {
                                    checked = true;
                                };
                                return checked;
                            }
                        },
                        { input: '#'+menucod+'provcode', message: 'ไม่พบรหัสนี้!', action: 'blur', rule: function (input, commit) {
                                var provcode = $("#"+menucod+"provcode").val();
                                if (provcode !== '') {
                                    $.ajax({
                                        url: "validate/findexit",
                                        type: 'get',
                                        data: { table: 'setprov', field: 'provcode', code: provcode },
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
                    ]
        });
        function Validate_provcode(){
            var checked = $('#'+menucod+'provcode');
            $('#fmsetaump').jqxValidator('validate', checked);
        }
        $('#'+menucod+'v-provcode').keyup(function () {
            Validate_provcode();
        });
        $('#'+menucod+'v-provcode').blur(function () {
            Validate_provcode();
            provdesc();
        });

        var provdesc = function() {
            $.ajax({
                url: "validate/findvalue",
                type: 'get',
                data: { table: 'setprov', field: 'provcode', code: $('#'+menucod+'v-provcode').val(), fieldv: 'provdesc' },
                success: function(data) {
                    $('#'+menucod+'provdesc').text(data);
                }
            });
        };
        //ปุ่มบันทึกข้อมูล
        var setaump_save = function() {
            $('#fmsetaump').jqxValidator('validate', function (result) {
                if (result) {
                    $.when($.confirmdlg('ต้องการบันทึกข้อมูล?', 'info')).then(function() {
                        $('#ok').click(function(event) {
                            $.ajax({
                                url: "setaump/save",
                                data: { menucod: menucod, aumpcode: $("#"+menucod+"aumpcode").val(), aumpdesc: $("#"+menucod+"aumpdesc").val(), provcode: $("#"+menucod+"provcode").val(), postcode: $("#"+menucod+"postcode").val() },
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
        var setaump_back = function(event) {
            $('#fmsetaump').jqxValidator('hide');
            $.ajax({
                url: "setaump/index",
                data: { menucod: menucod },
                type: 'get',
                success: function(data) {
                    $("#"+menucod).html(data);
                }
            });
        };
    });
</script>