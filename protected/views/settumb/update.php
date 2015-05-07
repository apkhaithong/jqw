<h2><i class="fa fa-cog"></i> แก้ไขข้อมูลรหัสตำบล</h2>
<div id="settumbTool"></div>
<input type="hidden" id="settumbid" value="<?php echo $menucod ?>">
<br />
<form id="fmsettumb">
    <table class="settumb-table">
        <tr>
            <td>รหัสตำบล</td>
            <td><input type="text" id="<?php echo $menucod ?>tumbcode" value="<?php echo $settumb->tumbcode; ?>" ></td>
        </tr>
        <tr>
            <td>คำอธิบาย</td>
            <td><input type="text" id="<?php echo $menucod ?>tumbdesc" value="<?php echo $settumb->tumbdesc; ?>" ></td>
        </tr>
        <tr>
            <td>รหัสอำเภอ</td>
            <td>
                <div id="<?php echo $menucod ?>aumpcode" class="input-button">
                    <input type="text" id="<?php echo $menucod ?>v-aumpcode" value="<?php echo $settumb->aumpcode; ?>" />
                    <div id="<?php echo $menucod ?>searchAmp"><img alt="search" width="16" height="16" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/search_lg.png" /></div>
                </div> 
                <div id="<?php echo $menucod ?>aumpdesc" class="input-desc"></div>            
            </td>
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
        var menucod = $("#settumbid").val();
        $("#"+menucod+"tumbcode").jqxInput({ height: 23, width: 121, theme: theme, minLength: 1, maxLength: 10, disabled: true });
        $("#"+menucod+"tumbdesc").jqxInput({ height: 23, width: 300, theme: theme, maxLength: 60 });
        $("#"+menucod+"aumpcode").jqxInput({ height: 23, width: 129, theme: theme });

        $("#settumbTool").jqxToolBar({ width: '100%', height: 50, theme: theme, tools: 'button | button ',
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
                            settumb_back();
                        });
                        break;
                    case 1:
                        icon.addClass("fa fa-floppy-o fa-lg");
                        icon.attr("title", "บันทึกข้อมูล");
                        icon.attr("id", menucod+"btnSave");
                        icon.html("<p style='margin-top:3px;'>บันทึกข้อมูล</p>");
                        tool.append(icon);
                        tool.click(function() {
                            settumb_save();
                        });
                        break;
                }
            }
        });
        $("#"+menucod+"searchAmp").click(function() {
            $("#result").load("search/index?show=setaump&returnid="+menucod+"aumpcode");
            $("#search").jqxWindow('open');
        });
        $('#fmsettumb').jqxValidator({
            hintType: 'label',
            animationDuration: 0,
            closeOnClick: false,
            rules:  [
                        { input: '#'+menucod+'tumbcode', message: 'กรุณาระบุรหัสตำบล!', action: 'keyup, blur', rule: 'required' },
                        { input: '#'+menucod+'aumpcode', message: 'กรุณาระบุรหัสอำเภอ!', action: 'blur', rule: function () {
                                var checked = false;
                                if ($('#'+menucod+'v-aumpcode').val() !== '') {
                                    checked = true;
                                };
                                return checked;
                            }
                        },
                        { input: '#'+menucod+'aumpcode', message: 'ไม่พบรหัสนี้!', action: 'blur', rule: function (input, commit) {
                                var aumpcode = $("#"+menucod+"aumpcode").val();
                                if (aumpcode !== '') {
                                    $.ajax({
                                        url: "validate/findexit",
                                        type: 'get',
                                        data: { table: 'setaump', field: 'aumpcode', code: aumpcode },
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
        function Validate_aumpcode(){
            var checked = $('#'+menucod+'aumpcode');
            $('#fmsettumb').jqxValidator('validate', checked);
        }
        $('#'+menucod+'v-aumpcode').keyup(function () {
            Validate_aumpcode();
        });
        $('#'+menucod+'v-aumpcode').blur(function () {
            Validate_aumpcode();
            aumpdesc();
        });

        var aumpdesc = function() {
            $.ajax({
                url: "validate/findvalue",
                type: 'get',
                data: { table: 'setaump', field: 'aumpcode', code: $('#'+menucod+'v-aumpcode').val(), fieldv: 'aumpdesc' },
                success: function(data) {
                    $('#'+menucod+'aumpdesc').text(data);
                }
            });
        };
        aumpdesc();
        //ปุ่มบันทึกข้อมูล
        var settumb_save = function() {
            $('#fmsettumb').jqxValidator('validate', function (result) {
                if (result) {
                    $.when($.confirmdlg('ต้องการบันทึกข้อมูล?', 'info')).then(function() {
                        $('#ok').click(function(event) {
                            $.ajax({
                                url: "settumb/save",
                                data: { menucod: menucod, tumbcode: $("#"+menucod+"tumbcode").val(), tumbdesc: $("#"+menucod+"tumbdesc").val(), aumpcode: $("#"+menucod+"aumpcode").val() },
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
        var settumb_back = function(event) {
            $('#fmsettumb').jqxValidator('hide');
            $.ajax({
                url: "settumb/index",
                data: { menucod: menucod },
                type: 'get',
                success: function(data) {
                    $("#"+menucod).html(data);
                }
            });
        };
    });
</script>