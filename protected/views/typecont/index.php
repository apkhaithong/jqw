<h2><i class="fa fa-cog"></i> กำหนดข้อมูลสถานะสัญญา</h2>
<div id="typecontTool"></div>
<br />
<div id="tbtypecont"></div>
<br />
<input type="hidden" id="viewtypecont" value="">
<input type="hidden" id="typecontid" value="<?php echo $menucod ?>">

<script type="text/javascript">
	$(document).ready(function () {
		var theme = 'ui-redmond';
		var menucod = $("#typecontid").val();
        var width = $(window).width();
        var height = $(window).height();        
		var url = 'typecont/datatypecont';
        var source =
        {
            datatype: "json",
            datafields: [
                { name: 'typecode', type: 'string' },
                { name: 'typedesc', type: 'string' },
                { name: 'alert', type: 'string' }
            ],
            id: 'id',
            url: url
        };
        var dataAdapter = new $.jqx.dataAdapter(source);  

        $("#tbtypecont").jqxGrid(
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
                { text: 'รหัสสถานะสัญญา', datafield: 'typecode', width: 120 },
                { text: 'คำอธิบาย', datafield: 'typedesc', width: 180 },
                { text: 'แจ้งเตือนเมื่อชำระ', datafield: 'alert', width: 120 }
            ],
            showtoolbar: true,
            rendertoolbar: function (toolbar) {
                    var container = $("<div style='margin: 5px;'></div>");
                    toolbar.append(container);
                    container.append('<input type="button" value="Export to Excel" id="'+menucod+'excelExport" />');
                    $("#"+menucod+"excelExport").jqxButton({ theme: theme });
                    //Export Data
                    $("#"+menucod+"excelExport").click(function () {
                        $("#tbtypecont").jqxGrid('exportdata', 'xls', 'ข้อมูลสถานะสัญญา');           
                    });                 
            },            
            sortable: true,
            pageable: true,
            pagesize: 10,
            autoheight: true,
            columnsresize: true
        });
        $("#typecontTool").jqxToolBar({ width: '100%', height: 50, theme: theme, tools: 'button | button | button | button | button ',
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
                            typecont_insert();
                        });
                        break;
                    case 1:
                        icon.addClass("fa fa-pencil-square-o fa-lg");
                        icon.attr("title", "แก้ไขข้อมูล");
                        icon.attr("id", menucod+"btnEdit");
                        icon.html("<p>แก้ไขข้อมูล</p>");
                        tool.append(icon);
                        tool.click(function() {
                            typecont_edit();
                        });
                        break;
                    case 2:
                        icon.addClass("fa fa-times fa-lg");
                        icon.attr("title", "ลบข้อมูล");
                        icon.attr("id", menucod+"btnDelete");
                        icon.html("<p>ลบข้อมูล</p>");
                        tool.append(icon);
                        tool.click(function() {
                            typecont_delete();
                        });
                        break;
                    case 3:
                        icon.addClass("fa fa-print fa-lg");
                        icon.attr("title", "พิมพ์รายงาน");
                        icon.attr("id", menucod+"btnPrint");
                        icon.html("<p>พิมพ์รายงาน</p>");
                        tool.append(icon);
                        tool.click(function() {
                            typecont_print();
                        });
                        break;
                    case 4:
                        icon.addClass("fa fa-power-off fa-lg");
                        icon.attr("title", "ปิดระบบ");
                        icon.attr("id", menucod+"btnClose");
                        icon.html("<p>ปิดระบบ</p>");
                        tool.append(icon);
                        tool.click(function() {
                            typecont_close();
                        });
                        break;
                }
            }
        });
        $("#typecontTool").jqxToolBar("disableTool", 1);
        $("#typecontTool").jqxToolBar("disableTool", 2);
        $('#tbtypecont').on('rowclick', function (event) {
            var args = event.args;
            var rowindex = args.rowindex;
            var data = $('#tbtypecont').jqxGrid('getrowdata', rowindex);
            $("#viewtypecont").val(data.typecode);                                                                               
        });
        var typecont_insert = function() {
            $.get('typecont/create', { menucod: menucod }, function(data) {
                $("#"+menucod).html(data);
            });
        };
        var typecont_edit = function() {
            if ($("#viewtypecont").val() !== "") {
                $.get('typecont/update', { menucod: menucod, typecode: $("#viewtypecont").val() }, function(data) {
                    $("#"+menucod).html(data);
                });
            }
        };
        var typecont_delete = function() {
            if ($("#viewtypecont").val() !== "") {
                $.when($.confirmdlg('ต้องการลบข้อมูล?', 'warning')).then(function() {
                    $('#ok').click(function(event) {
                        $.get('typecont/delete', { menucod: menucod, typecode: $("#viewtypecont").val() }, function(data) {
                            $('#tbtypecont').jqxGrid('updatebounddata');
                        }); 
                    });
                });
            }
        };
        var typecont_close = function() {
            var selectedItem = $('#jqxTabs').jqxTabs('selectedItem');
            var disabledItems = $('#jqxTabs').jqxTabs('getDisabledTabsCount');
            var items = $('#jqxTabs').jqxTabs('length');
            if (items > disabledItems + 1) {
                $('#jqxTabs').jqxTabs('removeAt', selectedItem);
            }            
        };
        var typecont_print = function () {
            window.open('report/typecont', '', 'width='+width+', height='+height);
        };
	});
</script>