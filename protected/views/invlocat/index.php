<h2><i class="fa fa-cog"></i> กำหนดข้อมูลสาขา</h2>
<div id="invlocatTool"></div>
<br />
<div id="tbinvlocat"></div>
<br />
<input type="hidden" id="viewinvlocat" value="">
<input type="hidden" id="invlocatid" value="<?php echo $menucod ?>">
<script type="text/javascript">

    function keyPressed(event) {
        if(event.keyCode==13) {
            $("#searchButton").click();
        }
    };
    $(document).ready(function () {
        //var theme = 'darkblue';
        var theme = 'ui-redmond';
        var url = 'invlocat/dataInvlocat';
        var menucod = $("#invlocatid").val();
        var width = $(window).width();
        var height = $(window).height();
        // prepare the data
        var source =
        {
            datatype: "json",
            datafields: [
                { name: 'locatcd', type: 'string' },
                { name: 'locatnm', type: 'string' },
                { name: 'locaddr1', type: 'string' },
                { name: 'locaddr2', type: 'string' },
                { name: 'telp', type: 'string' },
                { name: 'shortl', type: 'string' },
                { name: 'aumpcod', type: 'string' },
                { name: 'provcod', type: 'string' },
                { name: 'postcod', type: 'string' },
                { name: 'accmstcod', type: 'string' },
                { name: 'accmstcod2', type: 'string' }
            ],
            id: 'id',
            url: url,
			sortcolumn: 'locatcd',
            sortdirection: 'asc'
        };
        var dataAdapter = new $.jqx.dataAdapter(source);

        $("#tbinvlocat").jqxGrid(
        {
            width: '100%',
            theme: theme,
            source: dataAdapter,
            showfilterrow: true,
            filterable: true,
            columnsresize: true,
            selectionmode: 'singlecell',
            columns: [
                {
                    text: '#', sortable: false, filterable: false, editable: false,
                    groupable: false, draggable: false, resizable: false,
                    datafield: '', columntype: 'number', width: 50,
                    cellsrenderer: function (row, column, value) {
                        return "<div style='margin:4px;'>" + (value + 1) + "</div>";
                    }
                },
                { text: 'รหัสสาขา', datafield: 'locatcd', width: 90 },
                { text: 'ชื่อสาขา', datafield: 'locatnm', width: 180 },
                { text: 'ที่อยู่1', datafield: 'locaddr1', width: 250 },
                { text: 'ที่อยู่2', datafield: 'locaddr2', width: 250 },
                { text: 'เบอร์โทรศัพท์', datafield: 'telp', width: 120 },
                { text: 'รหัสเอกสาร', datafield: 'shortl', width: 70 }
            ],
            showtoolbar: true,
            rendertoolbar: function (toolbar) {
                    var me = this;
                    var container = $("<div style='margin: 5px;'></div>");
                    toolbar.append(container);
                    container.append('<input type="button" value="Export to Excel" id="'+menucod+'excelExport" />');
                    $("#"+menucod+"excelExport").jqxButton({ theme: theme });
                    //Export Data
                    $("#"+menucod+"excelExport").click(function () {
                        $("#tbinvlocat").jqxGrid('exportdata', 'xls', 'ข้อมูลสาขา');
                    });
            },
            sortable: true,
            pageable: true,
            pagesize: 10,
            autoheight: true,
            columnsresize: true
        });

        $("#invlocatTool").jqxToolBar({ width: '100%', height: 50, theme: theme, tools: 'button | button | button | button | button | button',
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
                            invlocat_insert();
                        });
                        break;
                    case 1:
                        icon.addClass("fa fa-eye fa-lg");
                        icon.attr("title", "ดูรายละเอียด");
                        icon.attr("id", menucod+"btnView");
                        icon.html("<p>ดูรายละเอียด</p>");
                        tool.append(icon);
                        tool.click(function() {
                            invlocat_view();
                        });
                        break;
                    case 2:
                        icon.addClass("fa fa-pencil-square-o fa-lg");
                        icon.attr("title", "แก้ไขข้อมูล");
                        icon.attr("id", menucod+"btnEdit");
                        icon.html("<p>แก้ไขข้อมูล</p>");
                        tool.append(icon);
                        tool.click(function() {
                            invlocat_edit();
                        });
                        break;
                    case 3:
                        icon.addClass("fa fa-times fa-lg");
                        icon.attr("title", "ลบข้อมูล");
                        icon.attr("id", menucod+"btnDelete");
                        icon.html("<p>ลบข้อมูล</p>");
                        tool.append(icon);
                        tool.click(function() {
                            invlocat_delete();
                        });
                        break;
                    case 4:
                        icon.addClass("fa fa-print fa-lg");
                        icon.attr("title", "พิมพ์รายงาน");
                        icon.attr("id", menucod+"btnPrint");
                        icon.html("<p>พิมพ์รายงาน</p>");
                        tool.append(icon);
                        tool.click(function() {
                            invlocat_print();
                        });
                        break;
                    case 5:
                        icon.addClass("fa fa-power-off fa-lg");
                        icon.attr("title", "ปิดระบบ");
                        icon.attr("id", menucod+"btnClose");
                        icon.html("<p>ปิดระบบ</p>");
                        tool.append(icon);
                        tool.click(function() {
                            invlocat_close();
                        });
                        break;
                }
            }
        });
        $("#invlocatTool").jqxToolBar("disableTool", 1);
        $("#invlocatTool").jqxToolBar("disableTool", 2);
        $('#tbinvlocat').on('rowclick', function (event) {
            var args = event.args;
            var rowindex = args.rowindex;
            var data = $('#tbinvlocat').jqxGrid('getrowdata', rowindex);
            $("#viewinvlocat").val(data.locatcd);
        });
        var invlocat_insert = function() {
            $.get('invlocat/create', {menucod: menucod}, function(data) {
                $("#"+menucod).html(data);
            });
            // $.ajax({
            //     url: "invlocat/create",
            //     cache: false,
            //     data: {menucod: menucod},
            //     success: function(data) {
            //         $("#"+menucod).html(data);
            //     }
            // });
        };
        var invlocat_view = function() {
            if ($("#viewinvlocat").val() !== '') {
                $.get('invlocat/view', {locatcd: $("#viewinvlocat").val(),menucod: menucod}, function(data, textStatus, xhr) {
                    $("#"+menucod).html(data);
                });
            }
        };
        $('#tbinvlocat').on('rowdoubleclick', function (event) {
			$.get('invlocat/view', {locatcd: $("#viewinvlocat").val(), menucod: menucod}, function(data, textStatus, xhr) {
                $("#"+menucod).html(data);
            });
		});
		var invlocat_edit = function() {
            if ($("#viewinvlocat").val() !== '') {
                $.ajax({
                    url: "invlocat/update",
                    type: "GET",
                    cache: false,
                    data: { locatcd: $("#viewinvlocat").val(), menucod: menucod}
                })
                .done(function(data) {
                    //console.log("success");
                    $("#"+menucod).html(data);
                })
                .fail(function(data) {
                    //console.log("error");
                })
                .always(function(data) {
                    //console.log("complete");
                });

            }
        };
		var invlocat_delete = function() {
            if ($("#viewinvlocat").val() !== "") {
				//if (confirm('คุณต้องการที่จะลบข้อมูล สาขา : '+$("#viewinvlocat").val()+' ?')) {
                $.when($.confirmdlg('ต้องการลบข้อมูล สาขา?', 'warning')).then(function() {
                    $('#ok').click(function(event) {
    					$.post('invlocat/delete', { locatcd: $("#viewinvlocat").val(), menucod: menucod }, function(data) {
    						//alert('ลบข้อมูล สาขา : '+$("#viewinvlocat").val()+' เรียบร้อย');
    						//$("#"+menucod).html(data);
                            $('#tbinvlocat').jqxGrid('updatebounddata','sort');
    					});
                    });//end if ok
				});//end if warning
            }
        };
        var invlocat_close = function() {
            var selectedItem = $('#jqxTabs').jqxTabs('selectedItem');
            var disabledItems = $('#jqxTabs').jqxTabs('getDisabledTabsCount');
            var items = $('#jqxTabs').jqxTabs('length');
            if (items > disabledItems + 1) {
                $('#jqxTabs').jqxTabs('removeAt', selectedItem);
            }
        };
        var invlocat_print = function () {
            window.open('report/invlocat', '', 'width='+width+', height='+height);
        };
    });
</script>
