<h2><i class="fa fa-cog"></i> กำหนดข้อมูลรหัสจังหวัด</h2>
<div id="setprovTool"></div>
<br />
<div id="tbsetprov"></div>
<br />
<input type="hidden" id="viewsetprov" value="">
<input type="hidden" id="setprovid" value="<?php echo $menucod ?>">

<script type="text/javascript">
	$(document).ready(function () {
		var theme = 'ui-redmond';
		var menucod = $("#setprovid").val();
        var width = $(window).width();
        var height = $(window).height();        
		var url = 'setprov/datasetprov';
        var source =
        {
            datatype: "json",
            datafields: [
                { name: 'provcode', type: 'string' },
                { name: 'provdesc', type: 'string' }
            ],
            id: 'id',
            url: url
        };
        var dataAdapter = new $.jqx.dataAdapter(source);  

        $("#tbsetprov").jqxGrid(
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
                { text: 'รหัสจังหวัด', datafield: 'provcode', width: 120 },
                { text: 'คำอธิบาย', datafield: 'provdesc', width: 180 }
            ],
            showtoolbar: true,
            rendertoolbar: function (toolbar) {
                    var container = $("<div style='margin: 5px;'></div>");
                    toolbar.append(container);
                    container.append('<input type="button" value="Export to Excel" id="'+menucod+'excelExport" />');
                    $("#"+menucod+"excelExport").jqxButton({ theme: theme });
                    //Export Data
                    $("#"+menucod+"excelExport").click(function () {
                        $("#tbsetprov").jqxGrid('exportdata', 'xls', 'ข้อมูลจังหวัด');           
                    });                 
            },            
            sortable: true,
            pageable: true,
            pagesize: 10,
            autoheight: true,
            columnsresize: true
        });
        $("#setprovTool").jqxToolBar({ width: '100%', height: 50, theme: theme, tools: 'button | button | button | button | button ',
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
                            setprov_insert();
                        });
                        break;
                    case 1:
                        icon.addClass("fa fa-pencil-square-o fa-lg");
                        icon.attr("title", "แก้ไขข้อมูล");
                        icon.attr("id", menucod+"btnEdit");
                        icon.html("<p>แก้ไขข้อมูล</p>");
                        tool.append(icon);
                        tool.click(function() {
                            setprov_edit();
                        });
                        break;
                    case 2:
                        icon.addClass("fa fa-times fa-lg");
                        icon.attr("title", "ลบข้อมูล");
                        icon.attr("id", menucod+"btnDelete");
                        icon.html("<p>ลบข้อมูล</p>");
                        tool.append(icon);
                        tool.click(function() {
                            setprov_delete();
                        });
                        break;
                    case 3:
                        icon.addClass("fa fa-print fa-lg");
                        icon.attr("title", "พิมพ์รายงาน");
                        icon.attr("id", menucod+"btnPrint");
                        icon.html("<p>พิมพ์รายงาน</p>");
                        tool.append(icon);
                        tool.click(function() {
                            setprov_print();
                        });
                        break;
                    case 4:
                        icon.addClass("fa fa-power-off fa-lg");
                        icon.attr("title", "ปิดระบบ");
                        icon.attr("id", menucod+"btnClose");
                        icon.html("<p>ปิดระบบ</p>");
                        tool.append(icon);
                        tool.click(function() {
                            setprov_close();
                        });
                        break;
                }
            }
        });
        $("#setprovTool").jqxToolBar("disableTool", 1);
        $("#setprovTool").jqxToolBar("disableTool", 2);
        $('#tbsetprov').on('rowclick', function (event) {
            var args = event.args;
            var rowindex = args.rowindex;
            var data = $('#tbsetprov').jqxGrid('getrowdata', rowindex);
            $("#viewsetprov").val(data.provcode);                                                                               
        });
        var setprov_insert = function() {
            $.get('setprov/create', { menucod: menucod }, function(data) {
                $("#"+menucod).html(data);
            });
        };
        var setprov_edit = function() {
            if ($("#viewsetprov").val() !== "") {
                $.get('setprov/update', { menucod: menucod, provcode: $("#viewsetprov").val() }, function(data) {
                    $("#"+menucod).html(data);
                });
            }
        };
        var setprov_delete = function() {
            if ($("#viewsetprov").val() !== "") {
                $.when($.confirmdlg('ต้องการลบข้อมูล?', 'warning')).then(function() {
                    $('#ok').click(function(event) {
                        $.get('setprov/delete', { menucod: menucod, provcode: $("#viewsetprov").val() }, function(data) {
                            $('#tbsetprov').jqxGrid('updatebounddata');
                        }); 
                    });
                });
            }
        };
        var setprov_close = function() {
            var selectedItem = $('#jqxTabs').jqxTabs('selectedItem');
            var disabledItems = $('#jqxTabs').jqxTabs('getDisabledTabsCount');
            var items = $('#jqxTabs').jqxTabs('length');
            if (items > disabledItems + 1) {
                $('#jqxTabs').jqxTabs('removeAt', selectedItem);
            }            
        };
        var setprov_print = function () {
            window.open('report/setprov', '', 'width='+width+', height='+height);
        };
	});
</script>