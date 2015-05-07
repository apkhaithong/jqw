<h2><i class="fa fa-cog"></i> กำหนดข้อมูลรหัสการตลาด</h2>
<div id="setzoneTool"></div>
<br />
<div id="tbsetzone"></div>
<br />
<input type="hidden" id="viewsetzone" value="">
<input type="hidden" id="setzoneid" value="<?php echo $menucod ?>">

<script type="text/javascript">
	$(document).ready(function () {
		var theme = 'ui-redmond';
		var menucod = $("#setzoneid").val();
        var width = $(window).width();
        var height = $(window).height();        
		var url = 'setzone/datasetzone';
        var source =
        {
            datatype: "json",
            datafields: [
                { name: 'zonecode', type: 'string' },
                { name: 'zonedesc', type: 'string' }
            ],
            id: 'id',
            url: url
        };
        var dataAdapter = new $.jqx.dataAdapter(source);  

        $("#tbsetzone").jqxGrid(
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
                { text: 'รหัสการตลาด', datafield: 'zonecode', width: 120 },
                { text: 'คำอธิบาย', datafield: 'zonedesc', width: 180 }
            ],
            showtoolbar: true,
            rendertoolbar: function (toolbar) {
                    var container = $("<div style='margin: 5px;'></div>");
                    toolbar.append(container);
                    container.append('<input type="button" value="Export to Excel" id="'+menucod+'excelExport" />');
                    $("#"+menucod+"excelExport").jqxButton({ theme: theme });
                    //Export Data
                    $("#"+menucod+"excelExport").click(function () {
                        $("#tbsetzone").jqxGrid('exportdata', 'xls', 'ข้อมูลจังหวัด');           
                    });                 
            },            
            sortable: true,
            pageable: true,
            pagesize: 10,
            autoheight: true,
            columnsresize: true
        });
        $("#setzoneTool").jqxToolBar({ width: '100%', height: 50, theme: theme, tools: 'button | button | button | button | button ',
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
                            setzone_insert();
                        });
                        break;
                    case 1:
                        icon.addClass("fa fa-pencil-square-o fa-lg");
                        icon.attr("title", "แก้ไขข้อมูล");
                        icon.attr("id", menucod+"btnEdit");
                        icon.html("<p>แก้ไขข้อมูล</p>");
                        tool.append(icon);
                        tool.click(function() {
                            setzone_edit();
                        });
                        break;
                    case 2:
                        icon.addClass("fa fa-times fa-lg");
                        icon.attr("title", "ลบข้อมูล");
                        icon.attr("id", menucod+"btnDelete");
                        icon.html("<p>ลบข้อมูล</p>");
                        tool.append(icon);
                        tool.click(function() {
                            setzone_delete();
                        });
                        break;
                    case 3:
                        icon.addClass("fa fa-print fa-lg");
                        icon.attr("title", "พิมพ์รายงาน");
                        icon.attr("id", menucod+"btnPrint");
                        icon.html("<p>พิมพ์รายงาน</p>");
                        tool.append(icon);
                        tool.click(function() {
                            setzone_print();
                        });
                        break;
                    case 4:
                        icon.addClass("fa fa-power-off fa-lg");
                        icon.attr("title", "ปิดระบบ");
                        icon.attr("id", menucod+"btnClose");
                        icon.html("<p>ปิดระบบ</p>");
                        tool.append(icon);
                        tool.click(function() {
                            setzone_close();
                        });
                        break;
                }
            }
        });
        $("#setzoneTool").jqxToolBar("disableTool", 1);
        $("#setzoneTool").jqxToolBar("disableTool", 2);
        $('#tbsetzone').on('rowclick', function (event) {
            var args = event.args;
            var rowindex = args.rowindex;
            var data = $('#tbsetzone').jqxGrid('getrowdata', rowindex);
            $("#viewsetzone").val(data.zonecode);                                                                               
        });
        var setzone_insert = function() {
            $.get('setzone/create', { menucod: menucod }, function(data) {
                $("#"+menucod).html(data);
            });
        };
        var setzone_edit = function() {
            if ($("#viewsetzone").val() !== "") {
                $.get('setzone/update', { menucod: menucod, zonecode: $("#viewsetzone").val() }, function(data) {
                    $("#"+menucod).html(data);
                });
            }
        };
        var setzone_delete = function() {
            if ($("#viewsetzone").val() !== "") {
                $.when($.confirmdlg('ต้องการลบข้อมูล?', 'warning')).then(function() {
                    $('#ok').click(function(event) {
                        $.get('setzone/delete', { menucod: menucod, zonecode: $("#viewsetzone").val() }, function(data) {
                            $('#tbsetzone').jqxGrid('updatebounddata');
                        }); 
                    });
                });
            }
        };
        var setzone_close = function() {
            var selectedItem = $('#jqxTabs').jqxTabs('selectedItem');
            var disabledItems = $('#jqxTabs').jqxTabs('getDisabledTabsCount');
            var items = $('#jqxTabs').jqxTabs('length');
            if (items > disabledItems + 1) {
                $('#jqxTabs').jqxTabs('removeAt', selectedItem);
            }            
        };
        var setzone_print = function () {
            window.open('report/setzone', '', 'width='+width+', height='+height);
        };
	});
</script>