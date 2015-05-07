<h2><i class="fa fa-cog"></i> กำหนดข้อมูลรหัสพนักงาน</h2>
<div id="officerTool"></div>
<br />
<div id="tbofficer"></div>
<br />
<input type="hidden" id="viewofficer" value="">
<input type="hidden" id="officerid" value="<?php echo $menucod ?>">

<script type="text/javascript">
	$(document).ready(function () {
		var theme = 'ui-redmond';
		var menucod = $("#officerid").val();
        var width = $(window).width();
        var height = $(window).height();        
		var url = 'officer/dataofficer';
        var source =
        {
            datatype: "json",
            datafields: [
                { name: 'code', type: 'string' },
                { name: 'name', type: 'string' },
                { name: 'surname', type: 'string' },
                { name: 'addr', type: 'string' },
                { name: 'telp', type: 'string' },
                { name: 'status', type: 'string' }
            ],
            id: 'id',
            url: url
        };
        var dataAdapter = new $.jqx.dataAdapter(source);  
        $("#tbofficer").jqxGrid(
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
                { text: 'รหัสพนักงาน', datafield: 'code', width: 90 },
                { text: 'ชื่อ', datafield: 'name', width: 150 },
                { text: 'นามสกุล', datafield: 'surname', width: 150 },
                { text: 'ที่อยู่', datafield: 'addr', width: 250 },
                { text: 'เบอร์โทร', datafield: 'telp', width: 150 },
                { text: 'สถานะ', datafield: 'status', width: 60 }
            ],
            showtoolbar: true,
            rendertoolbar: function (toolbar) {
                    var container = $("<div style='margin: 5px;'></div>");
                    toolbar.append(container);
                    container.append('<input type="button" value="Export to Excel" id="'+menucod+'excelExport" />');
                    $("#"+menucod+"excelExport").jqxButton({ theme: theme });
                    //Export Data
                    $("#"+menucod+"excelExport").click(function () {
                        $("#tbofficer").jqxGrid('exportdata', 'xls', 'ข้อมูลกลุ่มสินค้า');           
                    });                 
            },            
            sortable: true,
            pageable: true,
            pagesize: 10,
            autoheight: true,
            columnsresize: true
        });
        $("#officerTool").jqxToolBar({ width: '100%', height: 50, theme: theme, tools: 'button | button | button | button | button ',
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
                            officer_insert();
                        });
                        break;
                    case 1:
                        icon.addClass("fa fa-pencil-square-o fa-lg");
                        icon.attr("title", "แก้ไขข้อมูล");
                        icon.attr("id", menucod+"btnEdit");
                        icon.html("<p>แก้ไขข้อมูล</p>");
                        tool.append(icon);
                        tool.click(function() {
                            officer_edit();
                        });
                        break;
                    case 2:
                        icon.addClass("fa fa-times fa-lg");
                        icon.attr("title", "ลบข้อมูล");
                        icon.attr("id", menucod+"btnDelete");
                        icon.html("<p>ลบข้อมูล</p>");
                        tool.append(icon);
                        tool.click(function() {
                            officer_delete();
                        });
                        break;
                    case 3:
                        icon.addClass("fa fa-print fa-lg");
                        icon.attr("title", "พิมพ์รายงาน");
                        icon.attr("id", menucod+"btnPrint");
                        icon.html("<p>พิมพ์รายงาน</p>");
                        tool.append(icon);
                        tool.click(function() {
                            officer_print();
                        });
                        break;
                    case 4:
                        icon.addClass("fa fa-power-off fa-lg");
                        icon.attr("title", "ปิดระบบ");
                        icon.attr("id", menucod+"btnClose");
                        icon.html("<p>ปิดระบบ</p>");
                        tool.append(icon);
                        tool.click(function() {
                            officer_close();
                        });
                        break;
                }
            }
        });
        $("#officerTool").jqxToolBar("disableTool", 1);
        $("#officerTool").jqxToolBar("disableTool", 2);
        $('#tbofficer').on('rowclick', function (event) {
            var args = event.args;
            var rowindex = args.rowindex;
            var data = $('#tbofficer').jqxGrid('getrowdata', rowindex);
            $("#viewofficer").val(data.code);                                                                               
        });
        var officer_insert = function() {
            $.get('officer/create', { menucod: menucod }, function(data) {
                $("#"+menucod).html(data);
            });
        };
        var officer_edit = function() {
            if ($("#viewofficer").val() !== "") {
                $.get('officer/update', { menucod: menucod, code: $("#viewofficer").val() }, function(data) {
                    $("#"+menucod).html(data);
                });
            }
        };
        var officer_delete = function() {
            if ($("#viewofficer").val() !== "") {
                $.when($.confirmdlg('ต้องการลบข้อมูล?', 'warning')).then(function() {
                    $('#ok').click(function(event) {
                        $.get('officer/delete', { menucod: menucod, code: $("#viewofficer").val() }, function(data) {
                            $('#tbofficer').jqxGrid('updatebounddata');
                        });  
                    });
                });              
            }
        };
        var officer_close = function() {
            var selectedItem = $('#jqxTabs').jqxTabs('selectedItem');
            var disabledItems = $('#jqxTabs').jqxTabs('getDisabledTabsCount');
            var items = $('#jqxTabs').jqxTabs('length');
            if (items > disabledItems + 1) {
                $('#jqxTabs').jqxTabs('removeAt', selectedItem);
            }            
        };
        var officer_print = function () {
            window.open('report/officer', '', 'width='+width+', height='+height);
        };
	});
</script>