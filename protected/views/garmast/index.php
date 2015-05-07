<h2><i class="fa fa-cog"></i> กำหนดข้อมูลบริษัทประกันภัย</h2>
<div id="garmastTool"></div>
<br />
<div id="tbgarmast"></div>
<br />
<input type="hidden" id="viewgarmast" value="">
<input type="hidden" id="garmastid" value="<?php echo $menucod ?>">

<script type="text/javascript">
	$(document).ready(function () {
		var theme = 'ui-redmond';
		var menucod = $("#garmastid").val();
        var width = $(window).width();
        var height = $(window).height();        
		var url = 'garmast/datagarmast';
        var source =
        {
            datatype: "json",
            datafields: [
                { name: 'garcode', type: 'string' },
                { name: 'garname', type: 'string' },
                { name: 'garaddr1', type: 'string' },
                { name: 'garaddr2', type: 'string' },
                { name: 'gartelp', type: 'string' }
            ],
            id: 'id',
            url: url
        };
        var dataAdapter = new $.jqx.dataAdapter(source);  
        $("#tbgarmast").jqxGrid(
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
                { text: 'รหัสบริษัทประกัน', datafield: 'garcode', width: 100 },
                { text: 'ชื่อบริษัท', datafield: 'garname', width: 250 },
                { text: 'ที่อยู่1', datafield: 'garaddr1', width: 250 },
                { text: 'ที่อยู่2', datafield: 'garaddr2', width: 250 },
                { text: 'เบอร์โทร', datafield: 'gartelp', width: 150 }
            ],
            showtoolbar: true,
            rendertoolbar: function (toolbar) {
                    var container = $("<div style='margin: 5px;'></div>");
                    toolbar.append(container);
                    container.append('<input type="button" value="Export to Excel" id="'+menucod+'excelExport" />');
                    $("#"+menucod+"excelExport").jqxButton({ theme: theme });
                    //Export Data
                    $("#"+menucod+"excelExport").click(function () {
                        $("#tbgarmast").jqxGrid('exportdata', 'xls', 'ข้อมูลกลุ่มสินค้า');           
                    });                 
            },            
            sortable: true,
            pageable: true,
            pagesize: 10,
            autoheight: true,
            columnsresize: true
        });
        $("#garmastTool").jqxToolBar({ width: '100%', height: 50, theme: theme, tools: 'button | button | button | button | button ',
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
                            garmast_insert();
                        });
                        break;
                    case 1:
                        icon.addClass("fa fa-pencil-square-o fa-lg");
                        icon.attr("title", "แก้ไขข้อมูล");
                        icon.attr("id", menucod+"btnEdit");
                        icon.html("<p>แก้ไขข้อมูล</p>");
                        tool.append(icon);
                        tool.click(function() {
                            garmast_edit();
                        });
                        break;
                    case 2:
                        icon.addClass("fa fa-times fa-lg");
                        icon.attr("title", "ลบข้อมูล");
                        icon.attr("id", menucod+"btnDelete");
                        icon.html("<p>ลบข้อมูล</p>");
                        tool.append(icon);
                        tool.click(function() {
                            garmast_delete();
                        });
                        break;
                    case 3:
                        icon.addClass("fa fa-print fa-lg");
                        icon.attr("title", "พิมพ์รายงาน");
                        icon.attr("id", menucod+"btnPrint");
                        icon.html("<p>พิมพ์รายงาน</p>");
                        tool.append(icon);
                        tool.click(function() {
                            garmast_print();
                        });
                        break;
                    case 4:
                        icon.addClass("fa fa-power-off fa-lg");
                        icon.attr("title", "ปิดระบบ");
                        icon.attr("id", menucod+"btnClose");
                        icon.html("<p>ปิดระบบ</p>");
                        tool.append(icon);
                        tool.click(function() {
                            garmast_close();
                        });
                        break;
                }
            }
        });
        $("#garmastTool").jqxToolBar("disableTool", 1);
        $("#garmastTool").jqxToolBar("disableTool", 2);
        $('#tbgarmast').on('rowclick', function (event) {
            var args = event.args;
            var rowindex = args.rowindex;
            var data = $('#tbgarmast').jqxGrid('getrowdata', rowindex);
            $("#viewgarmast").val(data.garcode);                                                                               
        });
        var garmast_insert = function() {
            $.get('garmast/create', { menucod: menucod }, function(data) {
                $("#"+menucod).html(data);
            });
        };
        var garmast_edit = function() {
            if ($("#viewgarmast").val() !== "") {
                $.get('garmast/update', { menucod: menucod, garcode: $("#viewgarmast").val() }, function(data) {
                    $("#"+menucod).html(data);
                });
            }
        };
        var garmast_delete = function() {
            if ($("#viewgarmast").val() !== "") {
                $.when($.confirmdlg('ต้องการลบข้อมูล?', 'warning')).then(function() {
                    $('#ok').click(function(event) {
                        $.get('garmast/delete', { menucod: menucod, garcode: $("#viewgarmast").val() }, function(data) {
                            $('#tbgarmast').jqxGrid('updatebounddata');
                        });  
                    });
                });              
            }
        };
        var garmast_close = function() {
            var selectedItem = $('#jqxTabs').jqxTabs('selectedItem');
            var disabledItems = $('#jqxTabs').jqxTabs('getDisabledTabsCount');
            var items = $('#jqxTabs').jqxTabs('length');
            if (items > disabledItems + 1) {
                $('#jqxTabs').jqxTabs('removeAt', selectedItem);
            }            
        };
        var garmast_print = function () {
            window.open('report/garmast', '', 'width='+width+', height='+height);
        };
	});
</script>