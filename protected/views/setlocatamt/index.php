<h2><i class="fa fa-cog"></i> กำหนดยอดยกมาสาขา</h2>
<div id="setlocatamtTool"></div>
<br />
<div id="tbsetlocatamt"></div>
<br />
<input type="hidden" id="viewsetlocatamt" value="">
<input type="hidden" id="setlocatamtid" value="<?php echo $menucod ?>">

<script type="text/javascript">
	$(document).ready(function () {
		var theme = 'ui-redmond';
		var menucod = $("#setlocatamtid").val();
        var width = $(window).width();
        var height = $(window).height();        
		var url = 'setlocatamt/datasetlocatamt';
        var source =
        {
            datatype: "json",
            datafields: [
                { name: 'locatcd', type: 'string' },
                { name: 'locatnm', type: 'string' },
                { name: 'balance', type: 'float' },
                { name: 'bldate', type: 'date'}
            ],
            id: 'id',
            url: url
        };
        var dataAdapter = new $.jqx.dataAdapter(source);  

        $("#tbsetlocatamt").jqxGrid(
        {
            width: '100%',
            theme: theme,
            source: dataAdapter,
            editable: true,
            editmode: 'selectedcell',
            keyboardnavigation: true,
            columns: [           
                { text: 'รหัสสาขา', datafield: 'locatcd', width: 100, editable: false },
                { text: 'ชื่อสาขา', datafield: 'locatnm', width: 250, editable: false },
                { text: 'ยอดยกมา', datafield: 'balance', width: 100, cellsalign: 'right', cellsformat: 'f2' },
                { text: 'วันที่ยกมา', datafield: 'bldate', width: 100, columntype: 'datetimeinput', cellsalign: 'right', cellsformat: 'dd/MM/yyyy',
                    createeditor: function (row, cellvalue, editor) {
                        editor.jqxDateTimeInput({ width: 100, height: 23, formatString: 'dd/MM/yyyy' });
                    }
                }
            ],
            showtoolbar: true,
            rendertoolbar: function (toolbar) {
                    var container = $("<div style='margin: 5px;'></div>");
                    toolbar.append(container);
                    container.append('<input type="button" value="Export to Excel" id="'+menucod+'excelExport" />');
                    $("#"+menucod+"excelExport").jqxButton({ theme: theme });
                    //Export Data
                    $("#"+menucod+"excelExport").click(function () {
                        $("#tbsetlocatamt").jqxGrid('exportdata', 'xls', 'ข้อมูลยอดยกมาสาขา');           
                    });                 
            }            
        });
        $("#setlocatamtTool").jqxToolBar({ width: '100%', height: 50, theme: theme, tools: 'button | button ',
            initTools: function (type, index, tool, menuToolIninitialization) {
                var icon = $("<div class='buttonIcon'></div>");
                switch (index) {
                    case 0:
                        icon.addClass("fa fa-floppy-o fa-lg");
                        icon.attr("title", "บันทึกข้อมูล");
                        icon.attr("id", menucod+"btnSave");
                        icon.html("<p style='margin-top:3px;'>บันทึกข้อมูล</p>");
                        tool.append(icon);
                        tool.click(function() {
                            setlocatamt_save();
                        });
                        break;
                    case 1:
                        icon.addClass("fa fa-power-off fa-lg");
                        icon.attr("title", "ปิดระบบ");
                        icon.attr("id", menucod+"btnClose");
                        icon.html("<p>ปิดระบบ</p>");
                        tool.append(icon);
                        tool.click(function() {
                            setlocatamt_close();
                        });
                        break;                        
                }
            }
        });
        $("#setlocatamtTool").jqxToolBar("disableTool", 1);
        $("#setlocatamtTool").jqxToolBar("disableTool", 2);
        $('#tbsetlocatamt').on('rowclick', function (event) {
            var args = event.args;
            var rowindex = args.rowindex;
            var data = $('#tbsetlocatamt').jqxGrid('getrowdata', rowindex);
            $("#viewsetlocatamt").val(data.idno);                                                                               
        });
        var setlocatamt_save = function() {
            $.when($.confirmdlg('ต้องการบันทึกข้อมูล?', 'info')).then(function() {
                $('#ok').click(function(event) {
                    var rowscount = $("#tbsetlocatamt").jqxGrid('getdatainformation').rowscount;
                    var rows = [];
                    for (var i = 0; i < rowscount; i++) {
                        var data = $('#tbsetlocatamt').jqxGrid('getrowdata', i);
                        if (data.bldate !== null) {
                            var bldate = data.bldate.getDate()+'/'+(data.bldate.getMonth()+1)+'/'+data.bldate.getFullYear();
                        } else {
                            var bldate = null;
                        };
                        rows.push({ locatcd: data.locatcd, balance: data.balance, bldate: bldate });
                    }
                    var rowdata = JSON.stringify(rows);
                    $.ajax({
                        url: "setlocatamt/save",
                        data: { rowdata: rowdata },
                        type: 'POST',
                        success: function (data) {
                            $('#tbsetlocatamt').jqxGrid('updatebounddata');
                        }
                    });
                });
            });
        };
        var setlocatamt_close = function() {
            var selectedItem = $('#jqxTabs').jqxTabs('selectedItem');
            var disabledItems = $('#jqxTabs').jqxTabs('getDisabledTabsCount');
            var items = $('#jqxTabs').jqxTabs('length');
            if (items > disabledItems + 1) {
                $('#jqxTabs').jqxTabs('removeAt', selectedItem);
            }            
        };
	});
</script>