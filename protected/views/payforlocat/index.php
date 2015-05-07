<h2><i class="fa fa-cog"></i> กำหนดข้อมูลรหัสการชำระเงินสาขา</h2>
<div id="payforlocatTool"></div>
<br />
<div id="tbpayforlocat"></div>
<br />
<input type="hidden" id="viewpayforlocat" value="">
<input type="hidden" id="payforlocatid" value="<?php echo $menucod ?>">

<script type="text/javascript">
	$(document).ready(function () {
		var theme = 'ui-redmond';
		var menucod = $("#payforlocatid").val();
        var width = $(window).width();
        var height = $(window).height();
		var url = 'payforlocat/datapayforlocat';
        var source =
        {
            datatype: "json",
            datafields: [
                { name: 'forcode', type: 'string' },
                { name: 'fordesc', type: 'string' },
                { name: 'doctype', type: 'string' },
                { name: 'block', type: 'string' },
                { name: 'accmstcod', type: 'string' },
                { name: 'typechk', type: 'string' }
            ],
            id: 'id',
            url: url
        };
        var dataAdapter = new $.jqx.dataAdapter(source, {
            beforeLoadComplete: function (data) {
                for (var i = 0; i < dataAdapter.records.length; i++) {
                    //ออกใบกำกับภาษี
                    if (data[i]["taxfl"] == 'Y') {
                        data[i]["taxfl"] = true;
                    } else {
                        data[i]["taxfl"] = false;
                    }
                    //ระงับการใช้งาน
                    if (data[i]["block"] == 'Y') {
                        data[i]["block"] = true;
                    } else {
                        data[i]["block"] = false;
                    }
                    //ประเภทรหัสการชำระ
                    if (data[i]["typechk"] == 'R'){
                        data[i]["typechk"]  = 'รับเข้า';
                    } else if (data[i]["typechk"]  == 'P'){
                        data[i]["typechk"]  = 'จ่ายออก';
                    }

                    //ประเภทเอกสาร
                    if (data[i]["doctype"] == 'H'){
                        data[i]["doctype"] = 'เอกสารค่างวด/ปิดบัญชี';
                    } else if (data[i]["doctype"] == 'T') {
                        data[i]["doctype"] = 'เอกสารอื่นๆ มีภาษี';
                    } else if (data[i]["doctype"] == 'N') {
                        data[i]["doctype"] = 'เอกสารอื่นๆ ไม่มีภาษี';
                    } else {
                        data[i]["doctype"] = '';
                    }
                }
                return data;
            }
        });
        $("#tbpayforlocat").jqxGrid(
        {
            width: '100%',
            theme: theme,
            source: dataAdapter,
			showfilterrow: true,
            filterable: true,
            columnsresize: true,
            columns: [
                {
                    text: '#', sortable: false, filterable: false, editable: false,
                    groupable: false, draggable: false, resizable: false,
                    datafield: '', columntype: 'number', width: 50,
                    cellsrenderer: function (row, column, value) {
                        return "<div style='margin:4px;'>" + (value + 1) + "</div>";
                    }
                },
                { text: 'รหัสการชำระ', datafield: 'forcode', width: 90 },
                { text: 'คำอธิบาย', datafield: 'fordesc', width: 350 },
                { text: 'รหัสบัญชี', datafield: 'accmstcod', width: 90 },
                { text: 'ประเภทรหัส', datafield: 'typechk', width: 90 },
				{ text: 'ระงับการใช้งาน', datafield: 'block', width: 90, columntype: 'checkbox' }
            ],
            showtoolbar: true,
            rendertoolbar: function (toolbar) {
                    var container = $("<div style='margin: 5px;'></div>");
                    toolbar.append(container);
                    container.append('<input type="button" value="Export to Excel" id="'+menucod+'excelExport" />');
                    $("#"+menucod+"excelExport").jqxButton({ theme: theme });
                    //Export Data
                    $("#"+menucod+"excelExport").click(function () {
                        $("#tbpayforlocat").jqxGrid('exportdata', 'xls', 'ข้อมูลกลุ่มสินค้า');
                    });
            },
            sortable: true,
            pageable: true,
            pagesize: 10,
            autoheight: true,
            columnsresize: true
        });
        $("#payforlocatTool").jqxToolBar({ width: '100%', height: 50, theme: theme, tools: 'button | button | button | button | button ',
            initTools: function (type, index, tool, menuToolIninitialization) {
                var icon = $("<div class='buttonIcon'></div>");
                switch (index) {
                    case 0:
                        icon.addClass("fa fa-plus fa-lg");
                        icon.attr("title", "เพิ่มข้อมูล");
                        icon.attr("id", menucod+"btnInsert");
                        icon.html("<p>เพิ่มข้อมูล</p>");
                        tool.append(icon);
                        tool.click(function() {
                            payforlocat_insert();
                        });
                        break;
                    case 1:
                        icon.addClass("fa fa-pencil-square-o fa-lg");
                        icon.attr("title", "แก้ไขข้อมูล");
                        icon.attr("id", menucod+"btnEdit");
                        icon.html("<p>แก้ไขข้อมูล</p>");
                        tool.append(icon);
                        tool.click(function() {
                            payforlocat_edit();
                        });
                        break;
                    case 2:
                        icon.addClass("fa fa-times fa-lg");
                        icon.attr("title", "ลบข้อมูล");
                        icon.attr("id", menucod+"btnDelete");
                        icon.html("<p>ลบข้อมูล</p>");
                        tool.append(icon);
                        tool.click(function() {
                            payforlocat_delete();
                        });
                        break;
                    case 3:
                        icon.addClass("fa fa-print fa-lg");
                        icon.attr("title", "พิมพ์รายงาน");
                        icon.attr("id", menucod+"btnPrint");
                        icon.html("<p>พิมพ์รายงาน</p>");
                        tool.append(icon);
                        tool.click(function() {
                            payforlocat_print();
                        });
                        break;
                    case 4:
                        icon.addClass("fa fa-power-off fa-lg");
                        icon.attr("title", "ปิดระบบ");
                        icon.attr("id", menucod+"btnClose");
                        icon.html("<p>ปิดระบบ</p>");
                        tool.append(icon);
                        tool.click(function() {
                            payforlocat_close();
                        });
                        break;
                }
            }
        });
        $("#payforlocatTool").jqxToolBar("disableTool", 1);
        $("#payforlocatTool").jqxToolBar("disableTool", 2);
        $('#tbpayforlocat').on('rowclick', function (event) {
            var args = event.args;
            var rowindex = args.rowindex;
            var data = $('#tbpayforlocat').jqxGrid('getrowdata', rowindex);
            $("#viewpayforlocat").val(data.forcode);
        });
        var payforlocat_insert = function() {
            $.get('payforlocat/create', { menucod: menucod }, function(data) {
                $("#"+menucod).html(data);
            });
        };
        var payforlocat_edit = function() {
            if ($("#viewpayforlocat").val() !== "") {
                $.get('payforlocat/update', { menucod: menucod, forcode: $("#viewpayforlocat").val() }, function(data) {
                    $("#"+menucod).html(data);
                });
            }
        };
        var payforlocat_delete = function() {
            if ($("#viewpayforlocat").val() !== "") {
                $.when($.confirmdlg('ต้องการลบข้อมูล?', 'warning')).then(function() {
                    $('#ok').click(function(event) {
                        $.get('payforlocat/delete', { menucod: menucod, forcode: $("#viewpayforlocat").val() }, function(data) {
                            $('#tbpayforlocat').jqxGrid('updatebounddata');
                        });
                    });
                });
            }
        };
        var payforlocat_close = function() {
            var selectedItem = $('#jqxTabs').jqxTabs('selectedItem');
            var disabledItems = $('#jqxTabs').jqxTabs('getDisabledTabsCount');
            var items = $('#jqxTabs').jqxTabs('length');
            if (items > disabledItems + 1) {
                $('#jqxTabs').jqxTabs('removeAt', selectedItem);
            }
        };
        var payforlocat_print = function () {
            window.open('report/payforlocat', '', 'width='+width+', height='+height);
        };
	});
</script>
