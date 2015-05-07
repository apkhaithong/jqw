<h2><i class="fa fa-cog"></i> กำหนดข้อมูลประเภทการชำระ</h2>
<div id="paytypTool"></div>
<br />
<div id="tbpaytyp"></div>
<br />
<input type="hidden" id="viewpaytyp" value="">
<input type="hidden" id="paytypid" value="<?php echo $menucod ?>">

<script type="text/javascript">
	$(document).ready(function () {
		var theme = 'ui-redmond';
		var menucod = $("#paytypid").val();
        var width = $(window).width();
        var height = $(window).height();        
		var url = 'paytyp/dataPaytyp';
        var source =
        {
            datatype: "json",
            datafields: [
                { name: 'paycode', type: 'string' },
                { name: 'paydesc', type: 'string' },
                { name: 'ptype', type: 'string' },
                { name: 'accmstcod', type: 'string' }
            ],
            id: 'id',
            url: url
        };
        var dataAdapter = new $.jqx.dataAdapter(source);  

        $("#tbpaytyp").jqxGrid(
        {
            width: '100%',
            theme: theme,
            source: dataAdapter,
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
                { text: 'รหัสประเภทการชำระ', datafield: 'paycode', width: 120 },
                { text: 'คำอธิบาย', datafield: 'paydesc', width: 180 },
                { text: 'อ้งอิง', datafield: 'ptype', width: 80 },
                { text: 'รหัสบัญชี', datafield: 'accmstcod', width: 90 }
            ],
            showtoolbar: true,
            rendertoolbar: function (toolbar) {
                    var container = $("<div style='margin: 5px;'></div>");
                    toolbar.append(container);
                    container.append('<input type="button" value="Export to Excel" id="'+menucod+'excelExport" />');
                    $("#"+menucod+"excelExport").jqxButton({ theme: theme });
                    //Export Data
                    $("#"+menucod+"excelExport").click(function () {
                        $("#tbpaytyp").jqxGrid('exportdata', 'xls', 'ข้อมูลประเภทการชำระ');           
                    });                 
            },            
            sortable: true,
            pageable: true,
            pagesize: 10,
            autoheight: true,
            columnsresize: true
        });
        $("#paytypTool").jqxToolBar({ width: '100%', height: 50, theme: theme, tools: 'button | button | button | button | button ',
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
                            paytyp_insert();
                        });
                        break;
                    case 1:
                        icon.addClass("fa fa-pencil-square-o fa-lg");
                        icon.attr("title", "แก้ไขข้อมูล");
                        icon.attr("id", menucod+"btnEdit");
                        icon.html("<p>แก้ไขข้อมูล</p>");
                        tool.append(icon);
                        tool.click(function() {
                            paytyp_edit();
                        });
                        break;
                    case 2:
                        icon.addClass("fa fa-times fa-lg");
                        icon.attr("title", "ลบข้อมูล");
                        icon.attr("id", menucod+"btnDelete");
                        icon.html("<p>ลบข้อมูล</p>");
                        tool.append(icon);
                        tool.click(function() {
                            paytyp_delete();
                        });
                        break;
                    case 3:
                        icon.addClass("fa fa-print fa-lg");
                        icon.attr("title", "พิมพ์รายงาน");
                        icon.attr("id", menucod+"btnPrint");
                        icon.html("<p>พิมพ์รายงาน</p>");
                        tool.append(icon);
                        tool.click(function() {
                            paytyp_print();
                        });
                        break;
                    case 4:
                        icon.addClass("fa fa-power-off fa-lg");
                        icon.attr("title", "ปิดระบบ");
                        icon.attr("id", menucod+"btnClose");
                        icon.html("<p>ปิดระบบ</p>");
                        tool.append(icon);
                        tool.click(function() {
                            paytyp_close();
                        });
                        break;
                }
            }
        });
        $("#paytypTool").jqxToolBar("disableTool", 1);
        $("#paytypTool").jqxToolBar("disableTool", 2);
        $('#tbpaytyp').on('rowclick', function (event) {
            var args = event.args;
            var rowindex = args.rowindex;
            var data = $('#tbpaytyp').jqxGrid('getrowdata', rowindex);
            $("#viewpaytyp").val(data.paycode);                                                                               
        });
        var paytyp_insert = function() {
            $.get('paytyp/create', { menucod: menucod }, function(data) {
                $("#"+menucod).html(data);
            });
        };
        var paytyp_edit = function() {
            if ($("#viewpaytyp").val() !== "") {
                $.get('paytyp/update', { menucod: menucod, paycode: $("#viewpaytyp").val() }, function(data) {
                    $("#"+menucod).html(data);
                });
            }
        };
        var paytyp_delete = function() {
            if ($("#viewpaytyp").val() !== "") {
                $.when($.confirmdlg('ต้องการลบข้อมูล?', 'warning')).then(function() {
                    $('#ok').click(function(event) {
                        $.get('paytyp/delete', { menucod: menucod, paycode: $("#viewpaytyp").val() }, function(data) {
                            $('#tbpaytyp').jqxGrid('updatebounddata');
                        }); 
                    });
                });
            }
        };
        var paytyp_close = function() {
            var selectedItem = $('#jqxTabs').jqxTabs('selectedItem');
            var disabledItems = $('#jqxTabs').jqxTabs('getDisabledTabsCount');
            var items = $('#jqxTabs').jqxTabs('length');
            if (items > disabledItems + 1) {
                $('#jqxTabs').jqxTabs('removeAt', selectedItem);
            }            
        };
        var paytyp_print = function () {
            window.open('report/paytyp', '', 'width='+width+', height='+height);
        };
	});
</script>