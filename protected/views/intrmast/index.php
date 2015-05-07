<h2><i class="fa fa-cog"></i> กำหนดข้อมูลอัตราเบี้ยปรับ MRR</h2>
<div id="intrmastTool"></div>
<br />
<div id="tbintrmast"></div>
<br />
<input type="hidden" id="viewintrmast" value="">
<input type="hidden" id="intrmastid" value="<?php echo $menucod ?>">

<script type="text/javascript">
	$(document).ready(function () {
		var theme = 'ui-redmond';
		var menucod = $("#intrmastid").val();
        var width = $(window).width();
        var height = $(window).height();        
		var url = 'intrmast/dataintrmast';
        var source =
        {
            datatype: "json",
            datafields: [
                { name: 'idno', type: 'integer' },
                { name: 'frmdate', type: 'date' },
                { name: 'todate', type: 'date' },
                { name: 'intr', type: 'float'}
            ],
            id: 'id',
            url: url
        };
        var dataAdapter = new $.jqx.dataAdapter(source);  

        $("#tbintrmast").jqxGrid(
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
                { text: 'อัตราเบี้ยปรับ (%)', datafield: 'intr', width: 120 }
            ],
            showtoolbar: true,
            rendertoolbar: function (toolbar) {
                    var container = $("<div style='margin: 5px;'></div>");
                    toolbar.append(container);
                    container.append('<input type="button" value="Export to Excel" id="'+menucod+'excelExport" />');
                    $("#"+menucod+"excelExport").jqxButton({ theme: theme });
                    //Export Data
                    $("#"+menucod+"excelExport").click(function () {
                        $("#tbintrmast").jqxGrid('exportdata', 'xls', 'ข้อมูลอัตาภาษี');           
                    });                 
            },            
            sortable: true,
            pageable: true,
            pagesize: 10,
            autoheight: true,
            columnsresize: true
        });
        $("#intrmastTool").jqxToolBar({ width: '100%', height: 50, theme: theme, tools: 'button | button | button | button ',
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
                            intrmast_insert();
                        });
                        break;
                    case 1:
                        icon.addClass("fa fa-pencil-square-o fa-lg");
                        icon.attr("title", "แก้ไขข้อมูล");
                        icon.attr("id", menucod+"btnEdit");
                        icon.html("<p>แก้ไขข้อมูล</p>");
                        tool.append(icon);
                        tool.click(function() {
                            intrmast_edit();
                        });
                        break;
                    case 2:
                        icon.addClass("fa fa-times fa-lg");
                        icon.attr("title", "ลบข้อมูล");
                        icon.attr("id", menucod+"btnDelete");
                        icon.html("<p>ลบข้อมูล</p>");
                        tool.append(icon);
                        tool.click(function() {
                            intrmast_delete();
                        });
                        break;
                    case 3:
                        icon.addClass("fa fa-power-off fa-lg");
                        icon.attr("title", "ปิดระบบ");
                        icon.attr("id", menucod+"btnClose");
                        icon.html("<p>ปิดระบบ</p>");
                        tool.append(icon);
                        tool.click(function() {
                            intrmast_close();
                        });
                        break;
                }
            }
        });
        $("#intrmastTool").jqxToolBar("disableTool", 1);
        $("#intrmastTool").jqxToolBar("disableTool", 2);
        $('#tbintrmast').on('rowclick', function (event) {
            var args = event.args;
            var rowindex = args.rowindex;
            var data = $('#tbintrmast').jqxGrid('getrowdata', rowindex);
            $("#viewintrmast").val(data.idno);                                                                               
        });
        var intrmast_insert = function() {
            $.get('intrmast/create', { menucod: menucod }, function(data) {
                $("#"+menucod).html(data);
            });
        };
        var intrmast_edit = function() {
            if ($("#viewintrmast").val() !== "") {
                $.get('intrmast/update', { menucod: menucod, idno: $("#viewintrmast").val() }, function(data) {
                    $("#"+menucod).html(data);
                });
            }
        };
        var intrmast_delete = function() {
            if ($("#viewintrmast").val() !== "") {
                $.when($.confirmdlg('ต้องการลบข้อมูล?', 'warning')).then(function() {
                    $('#ok').click(function(event) {
                        $.get('intrmast/delete', { menucod: menucod, idno: $("#viewintrmast").val() }, function(data) {
                            $('#tbintrmast').jqxGrid('updatebounddata');
                        }); 
                    });
                });
            }
        };
        var intrmast_close = function() {
            var selectedItem = $('#jqxTabs').jqxTabs('selectedItem');
            var disabledItems = $('#jqxTabs').jqxTabs('getDisabledTabsCount');
            var items = $('#jqxTabs').jqxTabs('length');
            if (items > disabledItems + 1) {
                $('#jqxTabs').jqxTabs('removeAt', selectedItem);
            }            
        };
	});
</script>