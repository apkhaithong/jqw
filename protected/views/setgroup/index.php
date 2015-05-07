<h2><i class="fa fa-cog"></i> กำหนดข้อมูลกลุ่มสินค้า</h2>
<div id="setgroupTool"></div>
<br />
<div id="tbsetgroup"></div>
<br />
<input type="hidden" id="viewsetgroup" value="">
<input type="hidden" id="setgroupid" value="<?php echo $menucod ?>">

<script type="text/javascript">
	$(document).ready(function () {
		var theme = 'ui-redmond';
		var menucod = $("#setgroupid").val();
        var width = $(window).width();
        var height = $(window).height();        
		var url = 'setgroup/dataSetgroup';
        var source =
        {
            datatype: "json",
            datafields: [
                { name: 'gcode', type: 'string' },
                { name: 'gdesc', type: 'string' }
            ],
            id: 'id',
            url: url
        };
        var dataAdapter = new $.jqx.dataAdapter(source);  

        $("#tbsetgroup").jqxGrid(
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
                { text: 'รหัสกลุ่มสินค้า', datafield: 'gcode', width: 90 },
                { text: 'คำอธิบาย', datafield: 'gdesc', width: 180 }
            ],
            showtoolbar: true,
            rendertoolbar: function (toolbar) {
                    var container = $("<div style='margin: 5px;'></div>");
                    toolbar.append(container);
                    container.append('<input type="button" value="Export to Excel" id="'+menucod+'excelExport" />');
                    $("#"+menucod+"excelExport").jqxButton({ theme: theme });
                    //Export Data
                    $("#"+menucod+"excelExport").click(function () {
                        $("#tbsetgroup").jqxGrid('exportdata', 'xls', 'ข้อมูลกลุ่มสินค้า');           
                    });                 
            },            
            sortable: true,
            pageable: true,
            pagesize: 10,
            autoheight: true,
            columnsresize: true
        });
        $("#setgroupTool").jqxToolBar({ width: '100%', height: 50, theme: theme, tools: 'button | button | button | button | button ',
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
                            setgroup_insert();
                        });
                        break;
                    case 1:
                        icon.addClass("fa fa-pencil-square-o fa-lg");
                        icon.attr("title", "แก้ไขข้อมูล");
                        icon.attr("id", menucod+"btnEdit");
                        icon.html("<p>แก้ไขข้อมูล</p>");
                        tool.append(icon);
                        tool.click(function() {
                            setgroup_edit();
                        });
                        break;
                    case 2:
                        icon.addClass("fa fa-times fa-lg");
                        icon.attr("title", "ลบข้อมูล");
                        icon.attr("id", menucod+"btnDelete");
                        icon.html("<p>ลบข้อมูล</p>");
                        tool.append(icon);
                        tool.click(function() {
                            setgroup_delete();
                        });
                        break;
                    case 3:
                        icon.addClass("fa fa-print fa-lg");
                        icon.attr("title", "พิมพ์รายงาน");
                        icon.attr("id", menucod+"btnPrint");
                        icon.html("<p>พิมพ์รายงาน</p>");
                        tool.append(icon);
                        tool.click(function() {
                            setgroup_print();
                        });
                        break;
                    case 4:
                        icon.addClass("fa fa-power-off fa-lg");
                        icon.attr("title", "ปิดระบบ");
                        icon.attr("id", menucod+"btnClose");
                        icon.html("<p>ปิดระบบ</p>");
                        tool.append(icon);
                        tool.click(function() {
                            setgroup_close();
                        });
                        break;
                }
            }
        });
        $("#setgroupTool").jqxToolBar("disableTool", 1);
        $("#setgroupTool").jqxToolBar("disableTool", 2);
        $('#tbsetgroup').on('rowclick', function (event) {
            var args = event.args;
            var rowindex = args.rowindex;
            var data = $('#tbsetgroup').jqxGrid('getrowdata', rowindex);
            $("#viewsetgroup").val(data.gcode);                                                                               
        });
        var setgroup_insert = function() {
            $.get('setgroup/create', { menucod: menucod }, function(data) {
                $("#"+menucod).html(data);
            });
        };
        var setgroup_edit = function() {
            if ($("#viewsetgroup").val() !== "") {
                $.get('setgroup/update', { menucod: menucod, gcode: $("#viewsetgroup").val() }, function(data) {
                    $("#"+menucod).html(data);
                });
            }
        };
        var setgroup_delete = function() {
            if ($("#viewsetgroup").val() !== "") {
                $.when($.confirmdlg('ต้องการลบข้อมูล?', 'warning')).then(function() {
                    $('#ok').click(function(event) {
                        $.get('setgroup/delete', { menucod: menucod, gcode: $("#viewsetgroup").val() }, function(data) {
                            $('#tbsetgroup').jqxGrid('updatebounddata');
                        }); 
                    });
                });
            }
        };
        var setgroup_close = function() {
            var selectedItem = $('#jqxTabs').jqxTabs('selectedItem');
            var disabledItems = $('#jqxTabs').jqxTabs('getDisabledTabsCount');
            var items = $('#jqxTabs').jqxTabs('length');
            if (items > disabledItems + 1) {
                $('#jqxTabs').jqxTabs('removeAt', selectedItem);
            }            
        };
        var setgroup_print = function () {
            window.open('report/setgroup', '', 'width='+width+', height='+height);
        };
	});
</script>