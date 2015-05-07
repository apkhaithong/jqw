<h2><i class="fa fa-cog"></i> กำหนดค่าคงที่ระบบ</h2>
<div id="condpayTool"></div>
<input type="hidden" id="viewcondpay" value="<?php echo $condpay->licen_no; ?>">
<input type="hidden" id="condpayid" value="<?php echo $menucod ?>">
<br />
<form id="fmcondpay">
    <table class="condpay-table">
        <tr>
            <td>ชื่อบริษัท</td>
            <td><input type="text" id="<?php echo $menucod ?>comp_nm" value="<?php echo $condpay->comp_nm; ?>"></td>
        </tr>
        <tr>
            <td>สถานที่ตั้งบริษัท</td>
            <td><input type="text" id="<?php echo $menucod ?>comp_adr1" value="<?php echo $condpay->comp_adr1; ?>"></td>
        </tr>
        <tr>
            <td> </td>
            <td><input type="text" id="<?php echo $menucod ?>comp_adr2" value="<?php echo $condpay->comp_adr2; ?>"></td>
        </tr>
        <tr>
            <td>เบอร์โทรศัพท์</td>
            <td><input type="text" id="<?php echo $menucod ?>telp" value="<?php echo $condpay->telp; ?>"></td>
        </tr>
        <tr>
            <td>เลขประจำตัวผู้เสียภาษี</td>
            <td><input type="text" id="<?php echo $menucod ?>taxid" value="<?php echo $condpay->taxid; ?>"></td>
        </tr>
        <tr>
            <td>ค่าดำเนินการ (บาท)</td>
            <td><input type="text" id="<?php echo $menucod ?>free_rate" value="<?php echo $condpay->free_rate; ?>"></td>
        </tr>
        <tr>
            <td>อัตราเบี้ยปรับล่าช้าต่อเดือน (%)</td>
            <td><input type="text" id="<?php echo $menucod ?>int_rate" value="<?php echo $condpay->int_rate; ?>"></td>
        </tr>
        <tr>
            <td>ค่าคงที่ (MRR)</td>
            <td><input type="text" id="<?php echo $menucod ?>intadd_rate" value="<?php echo $condpay->intadd_rate; ?>"></td>
        </tr>
        <tr>
            <td>จำนวนวันล่าช้าไม่คิดเบี้ยปรับ</td>
            <td><input type="text" id="<?php echo $menucod ?>delay_day" value="<?php echo $condpay->delay_day; ?>"></td>
        </tr>
        <tr>
            <td>อัตราส่วนค่าทำเนียม (บาท)</td>
            <td><input type="text" id="<?php echo $menucod ?>ratefee" value="<?php echo $condpay->ratefee; ?>"></td>
        </tr>
        <tr>
            <td>อัตราส่วนดอกเบี้ย (%)</td>
            <td><input type="text" id="<?php echo $menucod ?>rateprofit" value="<?php echo $condpay->rateprofit; ?>"></td>
        </tr>
        <tr>
            <td>Log Time out (Milli Second)</td>
            <td><input type="text" id="<?php echo $menucod ?>timeout" value="<?php echo $condpay->timeout; ?>"></td>
        </tr>
        <tr>
            <td>ค่าติดตามทวงถามต่องวด</td>
            <td><input type="text" id="<?php echo $menucod ?>colamt" value="<?php echo $condpay->colamt; ?>"></td>
        </tr>
        <tr>
            <td>อัตราภาษี ออกใบกำกับอัตโนมัติ</td>
            <td><input type="text" id="<?php echo $menucod ?>vatrate" value="<?php echo $condpay->vatrate; ?>"></td>
        </tr>
        <tr>
            <td>เวลาปิดงวดประจำวัน</td>
            <td><input type="text" id="<?php echo $menucod ?>closetime" value="<?php echo $condpay->closetime; ?>"></td>
        </tr>
        <tr>
            <td>การคิดเบี้ยปรับ</td>
            <td>
                <div id="<?php echo $menucod ?>calint">
                <div style="float: left;" id='<?php echo $menucod ?>calint1'>คิดแบบเปอร์เซ็นต์ต่อเดือน (รายวัน)</div>
                <div style="clear: both;"></div>
                <input type="hidden" id="<?php echo $menucod ?>v-calint" value="<?php echo $condpay->calint; ?>">
                </div>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <div style="float: left;" id='<?php echo $menucod ?>calint2'>คิดแบบเปอร์เซ็นต์ต่อเดือน (รายเดือน)</div>
            </td>
        </tr>
        <tr>
            <td>การคิดส่วนลดปิดบัญชี</td>
            <td>
                <div id="<?php echo $menucod ?>caldsc">
                <div style="float: left;" id='<?php echo $menucod ?>caldsc1'>จากดอกผลคงเหลือ</div>
                <div style="clear: both;"></div>
                <input type="hidden" id="<?php echo $menucod ?>v-caldsc" value="<?php echo $condpay->caldsc; ?>">
                </div>
            </td>
        </tr>
        <tr>
            <td> </td><td> </td>
        </tr>
        <tr>
            <td>ข่าวประกาศ</td>
            <td>
                <?php
                    $myfile = Yii::app()->file->set('protected/views/condpay/memo.txt', true);
                    if (Yii::app()->file->set('protected/views/condpay/memo.txt')->exists) {
                        //echo 'Bingo-bongo!';
                        //var_dump($myfile);  // You may dump object to see all its properties,
                        //echo $myfile->size;  // or get property,
                        //$myfile->permissions = 755;  // or set property,
                        //$myfile->copy('test2.txt');
                        //print_r($myfile->contents);
                    } else {
                        echo 'No-no-no.';
                    }
                ?>
                <textarea id="<?php echo $menucod ?>inform"><?php print_r($myfile->contents); ?></textarea>
            </td>
        </tr>
        <tr>
            <td> </td><td> </td>
        </tr>
    </table>
</form>
<br />

<script type="text/javascript">
    $(document).ready(function () {
        var width = $(window).width();
        var height = $(window).height();
        var theme = 'ui-redmond';
        var menucod = $("#condpayid").val();
        $("#"+menucod+"comp_nm").jqxInput({ height: 23, width: 400, theme: theme, maxLength: 100 });
        $("#"+menucod+"comp_adr1").jqxInput({ height: 23, width: 400, theme: theme, maxLength: 100 });
        $("#"+menucod+"comp_adr2").jqxInput({ height: 23, width: 400, theme: theme, maxLength: 100 });
        $("#"+menucod+"telp").jqxInput({ height: 23, width: 400, theme: theme, maxLength: 100 });
        $("#"+menucod+"taxid").jqxInput({ height: 23, width: 400, theme: theme, maxLength: 15 });
        $("#"+menucod+"free_rate").jqxInput({ height: 23, width: 250, theme: theme, maxLength: 6, rtl: true });
        $("#"+menucod+"int_rate").jqxInput({ height: 23, width: 250, theme: theme, maxLength: 6, rtl: true });
        $("#"+menucod+"intadd_rate").jqxInput({ height: 23, width: 250, theme: theme, maxLength: 6, rtl: true });
        $("#"+menucod+"delay_day").jqxInput({ height: 23, width: 250, theme: theme, maxLength: 6, rtl: true });
        $("#"+menucod+"ratefee").jqxInput({ height: 23, width: 250, theme: theme, maxLength: 12, rtl: true });
        $("#"+menucod+"rateprofit").jqxInput({ height: 23, width: 250, theme: theme, maxLength: 12, rtl: true });
        $("#"+menucod+"timeout").jqxInput({ height: 23, width: 250, theme: theme, maxLength: 20, rtl: true });
        $("#"+menucod+"colamt").jqxInput({ height: 23, width: 250, theme: theme, maxLength: 12, rtl: true });
        $("#"+menucod+"vatrate").jqxInput({ height: 23, width: 250, theme: theme, maxLength: 6, rtl: true });
        $("#"+menucod+"closetime").jqxInput({ height: 23, width: 250, theme: theme, maxLength: 12, rtl: true });
        //$("#"+menucod+"inform").jqxInput({ height: 150, width: 300, theme: theme, maxLength: 60 });
        //radio group
        $("#"+menucod+"calint1").jqxRadioButton({ height: 23, width: 200, theme: theme, groupName: 'calint' });
        $("#"+menucod+"calint2").jqxRadioButton({ height: 23, width: 200, theme: theme, groupName: 'calint' });
        $("#"+menucod+"caldsc1").jqxRadioButton({ height: 23, width: 200, theme: theme, groupName: 'caldsc' });

        //check data from db
        if ($("#"+menucod+"v-calint").val() == '2') {
            $("#"+menucod+"calint1").jqxRadioButton({ checked: true });
        }else if($("#"+menucod+"v-calint").val() == '3'){
            $("#"+menucod+"calint2").jqxRadioButton({ checked: true });
        }
        if ($("#"+menucod+"v-caldsc").val() == '1') {
            $("#"+menucod+"caldsc1").jqxRadioButton({ checked: true });
        }

        $("#"+menucod+"inform").jqxEditor({
            theme: theme,
            height: 300,
            width: 600,
            lineBreak: "div",
            tools: 'bold italic underline | format font size | color background | left center right'
        });

        $("#condpayTool").jqxToolBar({ width: '100%', height: 50, theme: theme, tools: 'button | button | button ',
            initTools: function (type, index, tool, menuToolIninitialization) {
                var icon = $("<div class='buttonIcon'></div>");
                switch (index) {
                    case 0:
                        icon.addClass("fa fa-arrow-left fa-lg");
                        icon.attr("title", "ยกเลิก");
                        icon.attr("id", menucod+"btnBack");
                        icon.html("<p>ยกเลิก</p>");
                        tool.append(icon);
                        tool.click(function() {
                            invlocat_back();
                        });
                        break;
                    case 1:
                        icon.addClass("fa fa-floppy-o fa-lg");
                        icon.attr("title", "บันทึกข้อมูล");
                        icon.attr("id", menucod+"btnSave");
                        icon.html("<p style='margin-top:3px;'>บันทึกข้อมูล</p>");
                        tool.append(icon);
                        tool.click(function() {
                            invlocat_save();
                        });
                        break;
                    case 2:
                        icon.addClass("fa fa-power-off fa-lg");
                        icon.attr("title", "ปิดระบบ");
                        icon.attr("id", menucod+"btnClose");
                        icon.html("<p>ปิดระบบ</p>");
                        tool.append(icon);
                        tool.click(function() {
                            invlocat_close();
                        });
                        break;
                }
            }
        });

        $('#fmcondpay').jqxValidator({
            hintType: 'label',
            animationDuration: 0,
            closeOnClick: false,
            rules:  [
                        { input: '#'+menucod+'comp_nm', message: 'กรุณาระบุชื่อบริษัท!', action: 'keyup, blur', rule: 'required' }
                    ]
        });

        //ปุ่มบันทึกข้อมูล
        //$("#"+menucod+"btnSave").click(function() {
        var invlocat_save = function(event){
            $('#fmcondpay').jqxValidator('validate', function (result) {
                if (result) {
                    $.when($.confirmdlg('ต้องการบันทึกข้อมูล?', 'info')).then(function() {
                        $('#ok').click(function(event) {
                            var calint = '';
                            if ($("#"+menucod+"calint1").val() == true) {
                                calint = '2';
                            }else if($("#"+menucod+"calint2").val() == true) {
                                calint = '3'
                            }
                            var caldsc = '1';
                            if ($("#"+menucod+"caldsc1").val() == true) {
                                caldsc = '1';
                            }

                            $.ajax({
                                url: "condpay/save",
                                data: { menucod: menucod, licen_no: $("#viewcondpay").val(), comp_nm: $("#"+menucod+"comp_nm").val(), comp_adr1: $("#"+menucod+"comp_adr1").val(), comp_adr2: $("#"+menucod+"comp_adr2").val(), telp: $("#"+menucod+"telp").val(), taxid: $("#"+menucod+"taxid").val(), free_rate: $("#"+menucod+"free_rate").val(), int_rate: $("#"+menucod+"int_rate").val(), intadd_rate: $("#"+menucod+"intadd_rate").val(), delay_day: $("#"+menucod+"delay_day").val(), ratefee: $("#"+menucod+"ratefee").val(), rateprofit: $("#"+menucod+"rateprofit").val(), timeout: $("#"+menucod+"timeout").val(), colamt: $("#"+menucod+"colamt").val(), vatrate: $("#"+menucod+"vatrate").val(), closetime: $("#"+menucod+"closetime").val(), calint: calint, caldsc: caldsc, inform: $("#"+menucod+"inform").val() },
                                type: 'POST',
                                success: function (data) {
                                    //alert("บันทึกข้อมูลเรียบร้อย");
                                    $("#"+menucod).html(data);
                                }
                            });
                        });
                    });
                }
            });
        };

        //back to home
        var invlocat_back = function(event) {
            $('#fmcondpay').jqxValidator('hide');
            $.ajax({
                url: "condpay/index",
                data: { menucod: menucod },
                type: 'get',
                success: function(data) {
                    $("#"+menucod).html(data);
                }
            });
        };
        // $("#"+menucod+"btnBack").click(function(event) {
        //     $('#fmcondpay').jqxValidator('hide');
        //     $.ajax({
        //         url: "condpay/index",
        //         data: { menucod: menucod },
        //         type: 'get',
        //         success: function(data) {
        //             $("#"+menucod).html(data);
        //         }
        //     });
        // });
        var invlocat_close = function() {
            var selectedItem = $('#jqxTabs').jqxTabs('selectedItem');
            var disabledItems = $('#jqxTabs').jqxTabs('getDisabledTabsCount');
            var items = $('#jqxTabs').jqxTabs('length');
            if (items > disabledItems + 1) {
                $('#jqxTabs').jqxTabs('removeAt', selectedItem);
            }
        };
    });
</script>
