<h2><i class="fa fa-cog"></i> กำหนดข้อมูลอาชีพลูกค้า</h2>
<div id="setoccupTool"></div>
<br />
<div id="tbsetoccup"></div>
<br />
<input type="hidden" id="viewsetoccup" value="">
<input type="hidden" id="setoccupid" value="<?php echo $menucod ?>">

<script type="text/javascript">
	$(document).ready(function () {
		var theme = 'ui-redmond';
		var menucod = $("#setoccupid").val();
        var width = $(window).width();
        var height = $(window).height();
		var url = 'setoccup/datasetoccup';
        var source =
        {
            datatype: "json",
            datafields: [
                { name: 'occupcode', type: 'string' },
                { name: 'occupdesc', type: 'string' }
            ],
            id: 'id',
            url: url
        };
        var dataAdapter = new $.jqx.dataAdapter(source);

        $("#tbsetoccup").jqxGrid(
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
                { text: 'รหัสอาชีพ', datafield: 'occupcode', width: 120 },
                { text: 'คำอธิบาย', datafield: 'occupdesc', width: 180 }
            ],
            showtoolbar: true,
            rendertoolbar: function (toolbar) {
                    var container = $("<div style='margin: 5px;'></div>");
                    toolbar.append(container);
                    container.append('<input type="button" value="Export to Excel" id="'+menucod+'excelExport" />');
                    $("#"+menucod+"excelExport").jqxButton({ theme: theme });
                    //Export Data
                    $("#"+menucod+"excelExport").click(function () {
                        $("#tbsetoccup").jqxGrid('exportdata', 'xls', 'ข้อมูลรหัสอาชีพ');
                    });
            },
            sortable: true,
            pageable: true,
            pagesize: 10,
            autoheight: true,
            columnsresize: true
        });
        $("#setoccupTool").jqxToolBar({ width: '100%', height: 50, theme: theme, tools: 'button | button | button | button | button ',
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
                            setoccup_insert();
                        });
                        break;
                    case 1:
                        icon.addClass("fa fa-pencil-square-o fa-lg");
                        icon.attr("title", "แก้ไขข้อมูล");
                        icon.attr("id", menucod+"btnEdit");
                        icon.html("<p>แก้ไขข้อมูล</p>");
                        tool.append(icon);
                        tool.click(function() {
                            setoccup_edit();
                        });
                        break;
                    case 2:
                        icon.addClass("fa fa-times fa-lg");
                        icon.attr("title", "ลบข้อมูล");
                        icon.attr("id", menucod+"btnDelete");
                        icon.html("<p>ลบข้อมูล</p>");
                        tool.append(icon);
                        tool.click(function() {
                            setoccup_delete();
                        });
                        break;
                    case 3:
                        icon.addClass("fa fa-print fa-lg");
                        icon.attr("title", "พิมพ์รายงาน");
                        icon.attr("id", menucod+"btnPrint");
                        icon.html("<p>พิมพ์รายงาน</p>");
                        tool.append(icon);
                        tool.click(function() {
                            setoccup_print();
                        });
                        break;
                    case 4:
                        icon.addClass("fa fa-power-off fa-lg");
                        icon.attr("title", "ปิดระบบ");
                        icon.attr("id", menucod+"btnClose");
                        icon.html("<p>ปิดระบบ</p>");
                        tool.append(icon);
                        tool.click(function() {
                            setoccup_close();
                        });
                        break;
                }
            }
        });
        $("#setoccupTool").jqxToolBar("disableTool", 1);
        $("#setoccupTool").jqxToolBar("disableTool", 2);
        $('#tbsetoccup').on('rowclick', function (event) {
            var args = event.args;
            var rowindex = args.rowindex;
            var data = $('#tbsetoccup').jqxGrid('getrowdata', rowindex);
            $("#viewsetoccup").val(data.occupcode);
        });
        var setoccup_insert = function() {
            $.get('setoccup/create', { menucod: menucod }, function(data) {
                $("#"+menucod).html(data);
            });
        };
        var setoccup_edit = function() {
            if ($("#viewsetoccup").val() !== "") {
                $.get('setoccup/update', { menucod: menucod, occupcode: $("#viewsetoccup").val() }, function(data) {
                    $("#"+menucod).html(data);
                });
            }
        };
        var setoccup_delete = function() {
            if ($("#viewsetoccup").val() !== "") {
                $.when($.confirmdlg('ต้องการลบข้อมูล?', 'warning')).then(function() {
                    $('#ok').click(function(event) {
                        $.get('setoccup/delete', { menucod: menucod, occupcode: $("#viewsetoccup").val() }, function(data) {
                            $('#tbsetoccup').jqxGrid('updatebounddata');
                        });
                    });
                });
            }
        };
        var setoccup_close = function() {
            var selectedItem = $('#jqxTabs').jqxTabs('selectedItem');
            var disabledItems = $('#jqxTabs').jqxTabs('getDisabledTabsCount');
            var items = $('#jqxTabs').jqxTabs('length');
            if (items > disabledItems + 1) {
                $('#jqxTabs').jqxTabs('removeAt', selectedItem);
            }
        };
        var setoccup_print = function () {
            window.open('report/setoccup', '', 'width='+width+', height='+height);
        };
	});
</script>
