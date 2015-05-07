<h2><i class="fa fa-cog"></i> กำหนดข้อมูลรหัสอำเภอ</h2>
<div id="setaumpTool"></div>
<br />
<div id="tbsetaump"></div>
<br />
<input type="hidden" id="viewsetaump" value="">
<input type="hidden" id="setaumpid" value="<?php echo $menucod ?>">

<script type="text/javascript">
	$(document).ready(function () {
		var theme = 'ui-redmond';
		var menucod = $("#setaumpid").val();
        var width = $(window).width();
        var height = $(window).height();        
		var url = 'setaump/datasetaump';
        var source =
        {
            datatype: "json",
            datafields: [
                { name: 'aumpcode', type: 'string' },
                { name: 'aumpdesc', type: 'string' },
                { name: 'provcode', type: 'string' },
                { name: 'postcode', type: 'string' }
            ],
            id: 'id',
            url: url
        };
        var dataAdapter = new $.jqx.dataAdapter(source);  

        $("#tbsetaump").jqxGrid(
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
                { text: 'รหัสอำเภอ', datafield: 'aumpcode', width: 120 },
                { text: 'คำอธิบาย', datafield: 'aumpdesc', width: 180 },
                { text: 'รหัสจังหวัด', datafield: 'provcode', width: 120 },
                { text: 'รหัสไปรษณีย์', datafield: 'postcode', width: 120 }
            ],
            showtoolbar: true,
            rendertoolbar: function (toolbar) {
                    var container = $("<div style='margin: 5px;'></div>");
                    toolbar.append(container);
                    container.append('<input type="button" value="Export to Excel" id="'+menucod+'excelExport" />');
                    $("#"+menucod+"excelExport").jqxButton({ theme: theme });
                    //Export Data
                    $("#"+menucod+"excelExport").click(function () {
                        $("#tbsetaump").jqxGrid('exportdata', 'xls', 'ข้อมูลอำเภอ');           
                    });                 
            },            
            sortable: true,
            pageable: true,
            pagesize: 10,
            autoheight: true,
            columnsresize: true
        });
        $("#setaumpTool").jqxToolBar({ width: '100%', height: 50, theme: theme, tools: 'button | button | button | button | button ',
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
                            setaump_insert();
                        });
                        break;
                    case 1:
                        icon.addClass("fa fa-pencil-square-o fa-lg");
                        icon.attr("title", "แก้ไขข้อมูล");
                        icon.attr("id", menucod+"btnEdit");
                        icon.html("<p>แก้ไขข้อมูล</p>");
                        tool.append(icon);
                        tool.click(function() {
                            setaump_edit();
                        });
                        break;
                    case 2:
                        icon.addClass("fa fa-times fa-lg");
                        icon.attr("title", "ลบข้อมูล");
                        icon.attr("id", menucod+"btnDelete");
                        icon.html("<p>ลบข้อมูล</p>");
                        tool.append(icon);
                        tool.click(function() {
                            setaump_delete();
                        });
                        break;
                    case 3:
                        icon.addClass("fa fa-print fa-lg");
                        icon.attr("title", "พิมพ์รายงาน");
                        icon.attr("id", menucod+"btnPrint");
                        icon.html("<p>พิมพ์รายงาน</p>");
                        tool.append(icon);
                        tool.click(function() {
                            setaump_print();
                        });
                        break;
                    case 4:
                        icon.addClass("fa fa-power-off fa-lg");
                        icon.attr("title", "ปิดระบบ");
                        icon.attr("id", menucod+"btnClose");
                        icon.html("<p>ปิดระบบ</p>");
                        tool.append(icon);
                        tool.click(function() {
                            setaump_close();
                        });
                        break;
                }
            }
        });
        $("#setaumpTool").jqxToolBar("disableTool", 1);
        $("#setaumpTool").jqxToolBar("disableTool", 2);
        $('#tbsetaump').on('rowclick', function (event) {
            var args = event.args;
            var rowindex = args.rowindex;
            var data = $('#tbsetaump').jqxGrid('getrowdata', rowindex);
            $("#viewsetaump").val(data.aumpcode);                                                                               
        });
        var setaump_insert = function() {
            $.get('setaump/create', { menucod: menucod }, function(data) {
                $("#"+menucod).html(data);
            });
        };
        var setaump_edit = function() {
            if ($("#viewsetaump").val() !== "") {
                $.get('setaump/update', { menucod: menucod, aumpcode: $("#viewsetaump").val() }, function(data) {
                    $("#"+menucod).html(data);
                });
            }
        };
        var setaump_delete = function() {
            if ($("#viewsetaump").val() !== "") {
                $.when($.confirmdlg('ต้องการลบข้อมูล?', 'warning')).then(function() {
                    $('#ok').click(function(event) {
                        $.get('setaump/delete', { menucod: menucod, aumpcode: $("#viewsetaump").val() }, function(data) {
                            $('#tbsetaump').jqxGrid('updatebounddata');
                        }); 
                    });
                });
            }
        };
        var setaump_close = function() {
            var selectedItem = $('#jqxTabs').jqxTabs('selectedItem');
            var disabledItems = $('#jqxTabs').jqxTabs('getDisabledTabsCount');
            var items = $('#jqxTabs').jqxTabs('length');
            if (items > disabledItems + 1) {
                $('#jqxTabs').jqxTabs('removeAt', selectedItem);
            }            
        };
        var setaump_print = function () {
            window.open('report/setaump', '', 'width='+width+', height='+height);
        };
	});
</script>