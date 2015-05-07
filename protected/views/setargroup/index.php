<h2><i class="fa fa-cog"></i> กำหนดข้อมูลกลุ่มลูกหนี้</h2>
<div id="setargroupTool"></div>
<br />
<div id="tbsetargroup"></div>
<br />
<input type="hidden" id="viewsetargroup" value="">
<input type="hidden" id="setargroupid" value="<?php echo $menucod ?>">

<script type="text/javascript">
	$(document).ready(function () {
		var theme = 'ui-redmond';
		var menucod = $("#setargroupid").val();
        var width = $(window).width();
        var height = $(window).height();
		var url = 'setargroup/datasetargroup';
        var source =
        {
            datatype: "json",
            datafields: [
                { name: 'argroupcode', type: 'string' },
                { name: 'argroupdesc', type: 'string' }
            ],
            id: 'id',
            url: url
        };
        var dataAdapter = new $.jqx.dataAdapter(source);

        $("#tbsetargroup").jqxGrid(
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
                { text: 'รหัสกลุ่มลูกหนี้', datafield: 'argroupcode', width: 120 },
                { text: 'คำอธิบาย', datafield: 'argroupdesc', width: 180 }
            ],
            showtoolbar: true,
            rendertoolbar: function (toolbar) {
                    var container = $("<div style='margin: 5px;'></div>");
                    toolbar.append(container);
                    container.append('<input type="button" value="Export to Excel" id="'+menucod+'excelExport" />');
                    $("#"+menucod+"excelExport").jqxButton({ theme: theme });
                    //Export Data
                    $("#"+menucod+"excelExport").click(function () {
                        $("#tbsetargroup").jqxGrid('exportdata', 'xls', 'ข้อมูลกลุ่มลูกหนี้');
                    });
            },
            sortable: true,
            pageable: true,
            pagesize: 10,
            autoheight: true,
            columnsresize: true
        });
        $("#setargroupTool").jqxToolBar({ width: '100%', height: 50, theme: theme, tools: 'button | button | button | button | button ',
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
                            setargroup_insert();
                        });
                        break;
                    case 1:
                        icon.addClass("fa fa-pencil-square-o fa-lg");
                        icon.attr("title", "แก้ไขข้อมูล");
                        icon.attr("id", menucod+"btnEdit");
                        icon.html("<p>แก้ไขข้อมูล</p>");
                        tool.append(icon);
                        tool.click(function() {
                            setargroup_edit();
                        });
                        break;
                    case 2:
                        icon.addClass("fa fa-times fa-lg");
                        icon.attr("title", "ลบข้อมูล");
                        icon.attr("id", menucod+"btnDelete");
                        icon.html("<p>ลบข้อมูล</p>");
                        tool.append(icon);
                        tool.click(function() {
                            setargroup_delete();
                        });
                        break;
                    case 3:
                        icon.addClass("fa fa-print fa-lg");
                        icon.attr("title", "พิมพ์รายงาน");
                        icon.attr("id", menucod+"btnPrint");
                        icon.html("<p>พิมพ์รายงาน</p>");
                        tool.append(icon);
                        tool.click(function() {
                            setargroup_print();
                        });
                        break;
                    case 4:
                        icon.addClass("fa fa-power-off fa-lg");
                        icon.attr("title", "ปิดระบบ");
                        icon.attr("id", menucod+"btnClose");
                        icon.html("<p>ปิดระบบ</p>");
                        tool.append(icon);
                        tool.click(function() {
                            setargroup_close();
                        });
                        break;
                }
            }
        });
        $("#setargroupTool").jqxToolBar("disableTool", 1);
        $("#setargroupTool").jqxToolBar("disableTool", 2);
        $('#tbsetargroup').on('rowclick', function (event) {
            var args = event.args;
            var rowindex = args.rowindex;
            var data = $('#tbsetargroup').jqxGrid('getrowdata', rowindex);
            $("#viewsetargroup").val(data.argroupcode);
        });
        var setargroup_insert = function() {
            $.get('setargroup/create', { menucod: menucod }, function(data) {
                $("#"+menucod).html(data);
            });
        };
        var setargroup_edit = function() {
            if ($("#viewsetargroup").val() !== "") {
                $.get('setargroup/update', { menucod: menucod, argroupcode: $("#viewsetargroup").val() }, function(data) {
                    $("#"+menucod).html(data);
                });
            }
        };
        var setargroup_delete = function() {
            if ($("#viewsetargroup").val() !== "") {
                $.when($.confirmdlg('ต้องการลบข้อมูล?', 'warning')).then(function() {
                    $('#ok').click(function(event) {
                        $.get('setargroup/delete', { menucod: menucod, argroupcode: $("#viewsetargroup").val() }, function(data) {
                            $('#tbsetargroup').jqxGrid('updatebounddata');
                        });
                    });
                });
            }
        };
        var setargroup_close = function() {
            var selectedItem = $('#jqxTabs').jqxTabs('selectedItem');
            var disabledItems = $('#jqxTabs').jqxTabs('getDisabledTabsCount');
            var items = $('#jqxTabs').jqxTabs('length');
            if (items > disabledItems + 1) {
                $('#jqxTabs').jqxTabs('removeAt', selectedItem);
            }
        };
        var setargroup_print = function () {
            window.open('report/setargroup', '', 'width='+width+', height='+height);
        };
	});
</script>
