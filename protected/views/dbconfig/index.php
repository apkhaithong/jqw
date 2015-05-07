<h2><i class="fa fa-cog"></i> กำหนด Running เอกสาร</h2>
<div id="dbconfigTool"></div>
<br />
<form id="fmdbconfig">
    <table class="dbconfig-table">
        <tr>
            <td>สาขา</td>
            <td>
                <div id="<?php echo $menucod ?>locatcd"></div>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <br />
                <div id="tbdbconfig"></div>
            </td>
        </tr>
    </table>
</form>
<input type="hidden" id="dbconfigid" value="<?php echo $menucod ?>">

<script type="text/javascript">
    $(document).ready(function () {
        var width = $(window).width();
        var height = $(window).height();
        var theme = 'ui-redmond';
        var menucod = $("#dbconfigid").val();
        var url = "dbconfig/dataInvlocat";
        // prepare the data
        var source =
        {
            datatype: "json",
            datafields: [
                { name: 'locatcd' },
                { name: 'locatnm' }
            ],
            url: url,
            async: false
        };
        var dataAdapter = new $.jqx.dataAdapter(source);
        $("#"+menucod+"locatcd").jqxDropDownList({ height: 23, width: 300, source: dataAdapter, displayMember: 'locatnm', valueMember: 'locatcd', theme: theme, dropDownHeight:200 });

        $("#"+menucod+"locatcd").change(function (event) {
            var urldbconfig = 'dbconfig/dataDbconfig';
            var sourcedbconfig =
            {
                datatype: "json",
                datafields: [
                    { name: 'locatcd', type: 'string' },
                    { name: 'docno', type: 'integer' },
                    { name: 'docdesc', type: 'string' },
                    { name: 'run', type: 'string'}
                ],
                id: 'id',
                url: urldbconfig+'?locatcd='+$("#"+menucod+"locatcd").val()
            };
            var dataAdapter2 = new $.jqx.dataAdapter(sourcedbconfig, {
                beforeLoadComplete: function (data) {
                    for (var i = 0; i < dataAdapter2.records.length; i++) {
                        //ออกใบกำกับภาษี
                        if (data[i]["run"] == 'Y') {
                            data[i]["run"] = true;
                        } else {
                            data[i]["run"] = false;
                        }
                    }
                    return data;
                }
            });  

            $("#tbdbconfig").jqxGrid(
            {
                width: '300',
                height: '300',
                theme: theme,
                source: dataAdapter2,
                editable: true,
                editmode: 'selectedcell',
                keyboardnavigation: true,
                columns: [ 
                    {
                        text: '#', sortable: false, filterable: false, editable: false,
                        groupable: false, draggable: false, resizable: false,
                        datafield: '', columntype: 'number', width: 30,
                        cellsrenderer: function (row, column, value) {
                            return "<div style='margin:4px;'>" + (value + 1) + "</div>";
                        }
                    }, 
                    { text: 'รายการเอกสาร', datafield: 'docdesc', width: 165, editable: false },
                    { text: 'สถานะ Run', datafield: 'run', width: 75, columntype: 'checkbox' }
                ]         
            });
        });
        $("#dbconfigTool").jqxToolBar({ width: '100%', height: 50, theme: theme, tools: 'button | button ',
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
                            dbconfig_save();
                        });
                        break;
                    case 1:
                        icon.addClass("fa fa-power-off fa-lg");
                        icon.attr("title", "ปิดระบบ");
                        icon.attr("id", menucod+"btnClose");
                        icon.html("<p>ปิดระบบ</p>");
                        tool.append(icon);
                        tool.click(function() {
                            dbconfig_close();
                        });
                        break;                        
                }
            }
        });

        //ปุ่มบันทึกข้อมูล
        var dbconfig_save = function() {
            if ($("#"+menucod+"locatcd").val() !== '') {
                $.when($.confirmdlg('ต้องการบันทึกข้อมูล?', 'info')).then(function() {
                    $('#ok').click(function(event) {
                        var rowscount = $("#tbdbconfig").jqxGrid('getdatainformation').rowscount;
                        var rows = [];
                        var run = '';
                        for (var i = 0; i < rowscount; i++) {
                            var data = $('#tbdbconfig').jqxGrid('getrowdata', i);
                            if (data.run) {
                                run = 'Y';
                            } else {
                                run = 'N';
                            };
                            rows.push({ locatcd: data.locatcd, docno: data.docno, run: run });
                        }
                        var rowdata = JSON.stringify(rows);
                        $.ajax({
                            url: "dbconfig/save",
                            data: { locatcd : $("#"+menucod+"locatcd").val(), rowdata: rowdata },
                            type: 'POST',
                            success: function (data) {
                                $('#tbdbconfig').jqxGrid('updatebounddata');
                            }
                        });
                    });
                });
            };
        };
        var dbconfig_close = function() {
            var selectedItem = $('#jqxTabs').jqxTabs('selectedItem');
            var disabledItems = $('#jqxTabs').jqxTabs('getDisabledTabsCount');
            var items = $('#jqxTabs').jqxTabs('length');
            if (items > disabledItems + 1) {
                $('#jqxTabs').jqxTabs('removeAt', selectedItem);
            }            
        };
    });
</script>