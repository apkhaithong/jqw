<h2><i class="fa fa-cog"></i> กำหนดข้อมูลเกรดลูกค้า</h2>
<div id="setgradeTool"></div>
<br />
<div id="tbsetgrade"></div>
<br />
<input type="hidden" id="viewsetgrade" value="">
<input type="hidden" id="setgradeid" value="<?php echo $menucod ?>">

<script type="text/javascript">
	$(document).ready(function () {
		var theme = 'ui-redmond';
		var menucod = $("#setgradeid").val();
        var width = $(window).width();
        var height = $(window).height();        
		var url = 'setgrade/dataSetgrade';
        var source =
        {
            datatype: "json",
            datafields: [
                { name: 'grdcode', type: 'string' },
                { name: 'grddesc', type: 'string' },
                { name: 'grdcal', type: 'float' },
                { name: 'grdflg', type: 'string' }
            ],
            id: 'id',
            url: url
        };
        var dataAdapter = new $.jqx.dataAdapter(source);  

        $("#tbsetgrade").jqxGrid(
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
                { text: 'รหัสเกรดลูกค้า', datafield: 'grdcode', width: 120 },
                { text: 'คำอธิบาย', datafield: 'grddesc', width: 180 },
                { text: 'จำนวนงวดค้าง', datafield: 'grdcal', width: 110 },
                { text: 'การปล่อยสินเชื่อ', datafield: 'grdflg', width: 110 }
            ],
            showtoolbar: true,
            rendertoolbar: function (toolbar) {
                    var container = $("<div style='margin: 5px;'></div>");
                    toolbar.append(container);
                    container.append('<input type="button" value="Export to Excel" id="'+menucod+'excelExport" />');
                    $("#"+menucod+"excelExport").jqxButton({ theme: theme });
                    //Export Data
                    $("#"+menucod+"excelExport").click(function () {
                        $("#tbsetgrade").jqxGrid('exportdata', 'xls', 'ข้อมูลเกรดลูกหนี้');           
                    });                 
            },            
            sortable: true,
            pageable: true,
            pagesize: 10,
            autoheight: true,
            columnsresize: true
        });
        $("#setgradeTool").jqxToolBar({ width: '100%', height: 50, theme: theme, tools: 'button | button | button | button | button ',
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
                            setgrade_insert();
                        });
                        break;
                    case 1:
                        icon.addClass("fa fa-pencil-square-o fa-lg");
                        icon.attr("title", "แก้ไขข้อมูล");
                        icon.attr("id", menucod+"btnEdit");
                        icon.html("<p>แก้ไขข้อมูล</p>");
                        tool.append(icon);
                        tool.click(function() {
                            setgrade_edit();
                        });
                        break;
                    case 2:
                        icon.addClass("fa fa-times fa-lg");
                        icon.attr("title", "ลบข้อมูล");
                        icon.attr("id", menucod+"btnDelete");
                        icon.html("<p>ลบข้อมูล</p>");
                        tool.append(icon);
                        tool.click(function() {
                            setgrade_delete();
                        });
                        break;
                    case 3:
                        icon.addClass("fa fa-print fa-lg");
                        icon.attr("title", "พิมพ์รายงาน");
                        icon.attr("id", menucod+"btnPrint");
                        icon.html("<p>พิมพ์รายงาน</p>");
                        tool.append(icon);
                        tool.click(function() {
                            setgrade_print();
                        });
                        break;
                    case 4:
                        icon.addClass("fa fa-power-off fa-lg");
                        icon.attr("title", "ปิดระบบ");
                        icon.attr("id", menucod+"btnClose");
                        icon.html("<p>ปิดระบบ</p>");
                        tool.append(icon);
                        tool.click(function() {
                            setgrade_close();
                        });
                        break;
                }
            }
        });
        $("#setgradeTool").jqxToolBar("disableTool", 1);
        $("#setgradeTool").jqxToolBar("disableTool", 2);
        $('#tbsetgrade').on('rowclick', function (event) {
            var args = event.args;
            var rowindex = args.rowindex;
            var data = $('#tbsetgrade').jqxGrid('getrowdata', rowindex);
            $("#viewsetgrade").val(data.grdcode);                                                                               
        });
        var setgrade_insert = function() {
            $.get('setgrade/create', { menucod: menucod }, function(data) {
                $("#"+menucod).html(data);
            });
        };
        var setgrade_edit = function() {
            if ($("#viewsetgrade").val() !== "") {
                $.get('setgrade/update', { menucod: menucod, grdcode: $("#viewsetgrade").val() }, function(data) {
                    $("#"+menucod).html(data);
                });
            }
        };
        var setgrade_delete = function() {
            if ($("#viewsetgrade").val() !== "") {
                $.when($.confirmdlg('ต้องการลบข้อมูล?', 'warning')).then(function() {
                    $('#ok').click(function(event) {
                        $.get('setgrade/delete', { menucod: menucod, grdcode: $("#viewsetgrade").val() }, function(data) {
                            $('#tbsetgrade').jqxGrid('updatebounddata');
                        }); 
                    });
                });
            }
        };
        var setgrade_close = function() {
            var selectedItem = $('#jqxTabs').jqxTabs('selectedItem');
            var disabledItems = $('#jqxTabs').jqxTabs('getDisabledTabsCount');
            var items = $('#jqxTabs').jqxTabs('length');
            if (items > disabledItems + 1) {
                $('#jqxTabs').jqxTabs('removeAt', selectedItem);
            }            
        };
        var setgrade_print = function () {
            window.open('report/setgrade', '', 'width='+width+', height='+height);
        };
	});
</script>