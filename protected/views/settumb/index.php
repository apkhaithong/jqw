<h2><i class="fa fa-cog"></i> กำหนดข้อมูลรหัสตำบล</h2>
<div id="settumbTool"></div>
<br />
<div id="tbsettumb"></div>
<br />
<input type="hidden" id="viewsettumb" value="">
<input type="hidden" id="settumbid" value="<?php echo $menucod ?>">

<script type="text/javascript">
	$(document).ready(function () {
		var theme = 'ui-redmond';
		var menucod = $("#settumbid").val();
        var width = $(window).width();
        var height = $(window).height();        
		var url = 'settumb/dataSettumb';
        var source =
        {
            datatype: "json",
            datafields: [
                { name: 'tumbcode', type: 'string' },
                { name: 'tumbdesc', type: 'string' },
                { name: 'aumpcode', type: 'string' }
            ],
            id: 'id',
            url: url
        };
        var dataAdapter = new $.jqx.dataAdapter(source);  

        $("#tbsettumb").jqxGrid(
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
                { text: 'รหัสตำบล', datafield: 'tumbcode', width: 120 },
                { text: 'คำอธิบาย', datafield: 'tumbdesc', width: 180 },
                { text: 'รหัสอำเภอ', datafield: 'aumpcode', width: 120 }
            ],
            showtoolbar: true,
            rendertoolbar: function (toolbar) {
                    var container = $("<div style='margin: 5px;'></div>");
                    toolbar.append(container);
                    container.append('<input type="button" value="Export to Excel" id="'+menucod+'excelExport" />');
                    $("#"+menucod+"excelExport").jqxButton({ theme: theme });
                    //Export Data
                    $("#"+menucod+"excelExport").click(function () {
                        $("#tbsettumb").jqxGrid('exportdata', 'xls', 'ข้อมูลตำบล');           
                    });                 
            },            
            sortable: true,
            pageable: true,
            pagesize: 10,
            autoheight: true,
            columnsresize: true
        });
        $("#settumbTool").jqxToolBar({ width: '100%', height: 50, theme: theme, tools: 'button | button | button | button | button ',
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
                            settumb_insert();
                        });
                        break;
                    case 1:
                        icon.addClass("fa fa-pencil-square-o fa-lg");
                        icon.attr("title", "แก้ไขข้อมูล");
                        icon.attr("id", menucod+"btnEdit");
                        icon.html("<p>แก้ไขข้อมูล</p>");
                        tool.append(icon);
                        tool.click(function() {
                            settumb_edit();
                        });
                        break;
                    case 2:
                        icon.addClass("fa fa-times fa-lg");
                        icon.attr("title", "ลบข้อมูล");
                        icon.attr("id", menucod+"btnDelete");
                        icon.html("<p>ลบข้อมูล</p>");
                        tool.append(icon);
                        tool.click(function() {
                            settumb_delete();
                        });
                        break;
                    case 3:
                        icon.addClass("fa fa-print fa-lg");
                        icon.attr("title", "พิมพ์รายงาน");
                        icon.attr("id", menucod+"btnPrint");
                        icon.html("<p>พิมพ์รายงาน</p>");
                        tool.append(icon);
                        tool.click(function() {
                            settumb_print();
                        });
                        break;
                    case 4:
                        icon.addClass("fa fa-power-off fa-lg");
                        icon.attr("title", "ปิดระบบ");
                        icon.attr("id", menucod+"btnClose");
                        icon.html("<p>ปิดระบบ</p>");
                        tool.append(icon);
                        tool.click(function() {
                            settumb_close();
                        });
                        break;
                }
            }
        });
        $("#settumbTool").jqxToolBar("disableTool", 1);
        $("#settumbTool").jqxToolBar("disableTool", 2);
        $('#tbsettumb').on('rowclick', function (event) {
            var args = event.args;
            var rowindex = args.rowindex;
            var data = $('#tbsettumb').jqxGrid('getrowdata', rowindex);
            $("#viewsettumb").val(data.tumbcode);                                                                               
        });
        var settumb_insert = function() {
            $.get('settumb/create', { menucod: menucod }, function(data) {
                $("#"+menucod).html(data);
            });
        };
        var settumb_edit = function() {
            if ($("#viewsettumb").val() !== "") {
                $.get('settumb/update', { menucod: menucod, tumbcode: $("#viewsettumb").val() }, function(data) {
                    $("#"+menucod).html(data);
                });
            }
        };
        var settumb_delete = function() {
            if ($("#viewsettumb").val() !== "") {
                $.when($.confirmdlg('ต้องการลบข้อมูล?', 'warning')).then(function() {
                    $('#ok').click(function(event) {
                        $.get('settumb/delete', { menucod: menucod, tumbcode: $("#viewsettumb").val() }, function(data) {
                            $('#tbsettumb').jqxGrid('updatebounddata');
                        }); 
                    });
                });
            }
        };
        var settumb_close = function() {
            var selectedItem = $('#jqxTabs').jqxTabs('selectedItem');
            var disabledItems = $('#jqxTabs').jqxTabs('getDisabledTabsCount');
            var items = $('#jqxTabs').jqxTabs('length');
            if (items > disabledItems + 1) {
                $('#jqxTabs').jqxTabs('removeAt', selectedItem);
            }            
        };
        var settumb_print = function () {
            window.open('report/settumb', '', 'width='+width+', height='+height);
        };
	});
</script>