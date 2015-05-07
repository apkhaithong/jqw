<h2><i class="fa fa-cog"></i> กำหนดข้อมูลรหัสอัตราภาษี</h2>
<div id="vatmastTool"></div>
<br />
<div id="tbvatmast"></div>
<br />
<input type="hidden" id="viewvatmast" value="">
<input type="hidden" id="vatmastid" value="<?php echo $menucod ?>">

<script type="text/javascript">
	$(document).ready(function () {
		var theme = 'ui-redmond';
		var menucod = $("#vatmastid").val();
        var width = $(window).width();
        var height = $(window).height();        
		var url = 'vatmast/datavatmast';
        var source =
        {
            datatype: "json",
            datafields: [
                { name: 'idno', type: 'integer' },
                { name: 'frmdate', type: 'date' },
                { name: 'todate', type: 'date' },
                { name: 'vatrt', type: 'float'}
            ],
            id: 'id',
            url: url
        };
        var dataAdapter = new $.jqx.dataAdapter(source);  

        $("#tbvatmast").jqxGrid(
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
                { text: 'จากวันที่', datafield: 'frmdate', width: 120, columntype: 'datetimeinput', cellsformat: 'dd/MM/yyyy' },
                { text: 'ถึงวันที่', datafield: 'todate', width: 120, columntype: 'datetimeinput', cellsformat: 'dd/MM/yyyy' },
                { text: 'อัตราภาษี (%)', datafield: 'vatrt', width: 120 }
            ],
            showtoolbar: true,
            rendertoolbar: function (toolbar) {
                    var container = $("<div style='margin: 5px;'></div>");
                    toolbar.append(container);
                    container.append('<input type="button" value="Export to Excel" id="'+menucod+'excelExport" />');
                    $("#"+menucod+"excelExport").jqxButton({ theme: theme });
                    //Export Data
                    $("#"+menucod+"excelExport").click(function () {
                        $("#tbvatmast").jqxGrid('exportdata', 'xls', 'ข้อมูลอัตาภาษี');           
                    });                 
            },            
            sortable: true,
            pageable: true,
            pagesize: 10,
            autoheight: true,
            columnsresize: true
        });
        $("#vatmastTool").jqxToolBar({ width: '100%', height: 50, theme: theme, tools: 'button | button | button | button ',
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
                            vatmast_insert();
                        });
                        break;
                    case 1:
                        icon.addClass("fa fa-pencil-square-o fa-lg");
                        icon.attr("title", "แก้ไขข้อมูล");
                        icon.attr("id", menucod+"btnEdit");
                        icon.html("<p>แก้ไขข้อมูล</p>");
                        tool.append(icon);
                        tool.click(function() {
                            vatmast_edit();
                        });
                        break;
                    case 2:
                        icon.addClass("fa fa-times fa-lg");
                        icon.attr("title", "ลบข้อมูล");
                        icon.attr("id", menucod+"btnDelete");
                        icon.html("<p>ลบข้อมูล</p>");
                        tool.append(icon);
                        tool.click(function() {
                            vatmast_delete();
                        });
                        break;
                    case 3:
                        icon.addClass("fa fa-power-off fa-lg");
                        icon.attr("title", "ปิดระบบ");
                        icon.attr("id", menucod+"btnClose");
                        icon.html("<p>ปิดระบบ</p>");
                        tool.append(icon);
                        tool.click(function() {
                            vatmast_close();
                        });
                        break;
                }
            }
        });
        $("#vatmastTool").jqxToolBar("disableTool", 1);
        $("#vatmastTool").jqxToolBar("disableTool", 2);
        $('#tbvatmast').on('rowclick', function (event) {
            var args = event.args;
            var rowindex = args.rowindex;
            var data = $('#tbvatmast').jqxGrid('getrowdata', rowindex);
            $("#viewvatmast").val(data.idno);                                                                               
        });
        var vatmast_insert = function() {
            $.get('vatmast/create', { menucod: menucod }, function(data) {
                $("#"+menucod).html(data);
            });
        };
        var vatmast_edit = function() {
            if ($("#viewvatmast").val() !== "") {
                $.get('vatmast/update', { menucod: menucod, idno: $("#viewvatmast").val() }, function(data) {
                    $("#"+menucod).html(data);
                });
            }
        };
        var vatmast_delete = function() {
            if ($("#viewvatmast").val() !== "") {
                $.when($.confirmdlg('ต้องการลบข้อมูล?', 'warning')).then(function() {
                    $('#ok').click(function(event) {
                        $.get('vatmast/delete', { menucod: menucod, idno: $("#viewvatmast").val() }, function(data) {
                            $('#tbvatmast').jqxGrid('updatebounddata');
                        }); 
                    });
                });
            }
        };
        var vatmast_close = function() {
            var selectedItem = $('#jqxTabs').jqxTabs('selectedItem');
            var disabledItems = $('#jqxTabs').jqxTabs('getDisabledTabsCount');
            var items = $('#jqxTabs').jqxTabs('length');
            if (items > disabledItems + 1) {
                $('#jqxTabs').jqxTabs('removeAt', selectedItem);
            }            
        };
	});
</script>