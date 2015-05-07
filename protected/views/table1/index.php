<h2><i class="fa fa-cog"></i> กำหนดข้อมูลส่วนลดปิดบัญชี</h2>
<div id="table1Tool"></div>
<br />
<div id="tbtable1"></div>
<br />
<input type="hidden" id="viewtable1" value="">
<input type="hidden" id="table1id" value="<?php echo $menucod ?>">

<script type="text/javascript">
	$(document).ready(function () {
		var theme = 'ui-redmond';
		var menucod = $("#table1id").val();
        var width = $(window).width();
        var height = $(window).height();        
		var url = 'table1/datatable1';
        var source =
        {
            datatype: "json",
            datafields: [
                { name: 'idno', type: 'integer' },
                { name: 'nopay', type: 'float' },
                { name: 'perd60', type: 'float' },
                { name: 'perd54', type: 'float'},
                { name: 'perd48', type: 'float'},
                { name: 'perd42', type: 'float'},
                { name: 'perd36', type: 'float'},
                { name: 'perd30', type: 'float'},
                { name: 'perd24', type: 'float'},
                { name: 'perd18', type: 'float'},
                { name: 'perd12', type: 'float'},
                { name: 'perd10', type: 'float'}
            ],
            addrow: function (rowid, rowdata, position, commit) {
                commit(true);
            },
            deleterow: function (rowid, commit) {
                commit(true);
            },
            updaterow: function (rowid, newdata, commit) {
                commit(true);
            },
            id: 'id',
            url: url
        };
        var dataAdapter = new $.jqx.dataAdapter(source);  

        $("#tbtable1").jqxGrid(
        {
            width: '100%',
            theme: theme,
            source: dataAdapter,
            editable: true,
            editmode: 'selectedcell',
            keyboardnavigation: true,
            columns: [           
                { text: 'จำนวนงวด', datafield: 'nopay', width: 100 },
                { text: 'จน. < 6 งวด', datafield: 'perd10', width: 100, cellsalign: 'right' },
                { text: 'จน. < 12 งวด', datafield: 'perd12', width: 100, cellsalign: 'right' },
                { text: 'จน. < 18 งวด', datafield: 'perd18', width: 100, cellsalign: 'right' },
                { text: 'จน. < 24 งวด', datafield: 'perd24', width: 100, cellsalign: 'right' },
                { text: 'จน. < 30 งวด', datafield: 'perd30', width: 100, cellsalign: 'right' },
                { text: 'จน. < 36 งวด', datafield: 'perd36', width: 100, cellsalign: 'right' },
                { text: 'จน. < 42 งวด', datafield: 'perd42', width: 100, cellsalign: 'right' },
                { text: 'จน. < 48 งวด', datafield: 'perd48', width: 100, cellsalign: 'right' },
                { text: 'จน. < 54 งวด', datafield: 'perd54', width: 100, cellsalign: 'right' },
                { text: 'จน. < 60 งวด', datafield: 'perd60', width: 100, cellsalign: 'right' }
            ],
            showtoolbar: true,
            rendertoolbar: function (toolbar) {
                    var container = $("<div style='margin: 5px;'></div>");
                    toolbar.append(container);
                    container.append('<input type="button" value="Export to Excel" id="'+menucod+'excelExport" />');
                    $("#"+menucod+"excelExport").jqxButton({ theme: theme });
                    //Export Data
                    $("#"+menucod+"excelExport").click(function () {
                        $("#tbtable1").jqxGrid('exportdata', 'xls', 'ข้อมูลส่วนลดปิดบัญชี');           
                    });                 
            }            
        });
        $("#table1Tool").jqxToolBar({ width: '100%', height: 50, theme: theme, tools: 'button | button | button | button ',
            initTools: function (type, index, tool, menuToolIninitialization) {
                var icon = $("<div class='buttonIcon'></div>");
                switch (index) {
                    case 0:
                        icon.addClass("fa fa-plus fa-lg");
                        icon.attr("title", "เพิ่มแถว");
                        icon.attr("id", menucod+"btnInsert");
                        icon.html("<p>เพิ่มแถว</p>");
                        tool.append(icon);
                        tool.click(function() {
                            table1_addrow();
                        });
                        break;
                    case 1:
                        icon.addClass("fa fa-times fa-lg");
                        icon.attr("title", "ลบแถว");
                        icon.attr("id", menucod+"btnDelete");
                        icon.html("<p>ลบแถว</p>");
                        tool.append(icon);
                        tool.click(function() {
                            table1_deleterow();
                        });
                        break;
                    case 2:
                        icon.addClass("fa fa-floppy-o fa-lg");
                        icon.attr("title", "บันทึกข้อมูล");
                        icon.attr("id", menucod+"btnSave");
                        icon.html("<p style='margin-top:3px;'>บันทึกข้อมูล</p>");
                        tool.append(icon);
                        tool.click(function() {
                            table1_save();
                        });
                        break;
                    case 3:
                        icon.addClass("fa fa-power-off fa-lg");
                        icon.attr("title", "ปิดระบบ");
                        icon.attr("id", menucod+"btnClose");
                        icon.html("<p>ปิดระบบ</p>");
                        tool.append(icon);
                        tool.click(function() {
                            table1_close();
                        });
                        break;
                }
            }
        });
        $("#table1Tool").jqxToolBar("disableTool", 1);
        $("#table1Tool").jqxToolBar("disableTool", 2);
        $('#tbtable1').on('rowclick', function (event) {
            var args = event.args;
            var rowindex = args.rowindex;
            var data = $('#tbtable1').jqxGrid('getrowdata', rowindex);
            $("#viewtable1").val(data.idno);                                                                               
        });
        var table1_addrow = function() {
            var datarow = { nopay: 0, perd60: 0, perd54: 0, perd48: 0, perd42: 0, perd36: 0, perd30: 0, perd24: 0, perd18: 0, perd12: 0, perd10: 0};
            var commit = $("#tbtable1").jqxGrid('addrow', null, datarow);
            if (commit) {
                var rows = $('#tbtable1').jqxGrid('getrows');
                $("#tbtable1").jqxGrid('selectrow',rows.length-1);
                $("#tbtable1").jqxGrid('ensurerowvisible',rows.length-1);
            };
        };
        var table1_deleterow = function() {
            var selectedrowindex = $("#tbtable1").jqxGrid('getselectedrowindex');
            var rowscount = $("#tbtable1").jqxGrid('getdatainformation').rowscount;
            if (selectedrowindex >= 0 && selectedrowindex < rowscount) {
                var id = $("#tbtable1").jqxGrid('getrowid', selectedrowindex);
                var commit = $("#tbtable1").jqxGrid('deleterow', id);
            }
        };
        var table1_save = function() {
            $.when($.confirmdlg('ต้องการบันทึกข้อมูล?', 'info')).then(function() {
                $('#ok').click(function(event) {
                    var rowscount = $("#tbtable1").jqxGrid('getdatainformation').rowscount;
                    var rows = [];
                    for (var i = 0; i < rowscount; i++) {
                        var data = $('#tbtable1').jqxGrid('getrowdata', i);
                        rows.push({ nopay: data.nopay, perd60: data.perd60, perd54: data.perd54, perd48: data.perd48, perd42: data.perd42, perd36: data.perd36, perd30: data.perd30, perd24: data.perd24, perd18: data.perd18, perd12: data.perd12, perd10: data.perd10, menucod: menucod });
                    }
                    var rowdata = JSON.stringify(rows);
                    $.ajax({
                        url: "table1/save",
                        data: { rowdata: rowdata },
                        type: 'POST',
                        success: function (data) {
                            $('#tbtable1').jqxGrid('updatebounddata');
                        }
                    });
                });
            });
        };
        var table1_close = function() {
            var selectedItem = $('#jqxTabs').jqxTabs('selectedItem');
            var disabledItems = $('#jqxTabs').jqxTabs('getDisabledTabsCount');
            var items = $('#jqxTabs').jqxTabs('length');
            if (items > disabledItems + 1) {
                $('#jqxTabs').jqxTabs('removeAt', selectedItem);
            }            
        };
	});
</script>