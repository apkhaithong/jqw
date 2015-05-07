<h2><i class="fa fa-cog"></i> รายละเอียดสาขา [<?php echo $invlocat->locatcd ?>]</h2>
<div id="invlocatTool"></div>
<input type="hidden" id="invlocatid" value="<?php echo $menucod ?>">
<br />
<input type="hidden" id="<?php echo $menucod ?>locatcd" value="<?php echo $invlocat->locatcd ?>">
<table class="invlocat-table" id="tableV-invlocat">
	<thead>
		<tr>
			<th align="left">AA</th>
			<th align="left">BB</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>รหัสสาขา</td>
			<td><?php echo $invlocat->locatcd; ?></td>
		</tr>
		<tr>
			<td>ชื่อสาขา</td>
			<td><?php echo $invlocat->locatnm; ?></td>
		</tr>
		<tr>
			<td>ที่อยู่สาขา</td>
			<td><?php echo $invlocat->locaddr1; ?></td>
		</tr>
		<tr>
			<td>ที่อยู่สาขา</td>
			<td><?php echo $invlocat->locaddr2; ?></td>
		</tr>
		<tr>
			<td>เบอร์โทร</td>
			<td><?php echo $invlocat->telp; ?></td>
		</tr>
		<tr>
			<td>รหัสเอกสาร</td>
			<td><?php echo $invlocat->shortl; ?></td>
		</tr>
		<tr>
			<td>รหัสอำเภอ</td>
			<td><?php echo $invlocat->aumpcod; ?></td>
		</tr>
		<tr>
			<td>รหัสจังหวัด</td>
			<td><?php echo $invlocat->provcod; ?></td>
		</tr>
		<tr>
			<td>รหัสไปรษณีย์</td>
			<td><?php echo $invlocat->postcod; ?></td>
		</tr>
		<tr>
			<td>รหัสบัญชีเงินปล่อยกู้</td>
			<td><?php echo $invlocat->accmstcod; ?></td>
		</tr>
		<tr>
			<td>รหัสบัญชีเงินสด</td>
			<td><?php echo $invlocat->accmstcod2; ?></td>
		</tr>
	</tbody>
</table>
<br />
<div id="booklocat"></div>
<script type="text/javascript">
    $(document).ready(function () {
		var menucod = $("#invlocatid").val();
        var locatcd = $("#"+menucod+"locatcd").val();
		var theme = 'ui-redmond';
        var url = 'invlocat/dataBooklocat?locatcd='+locatcd;
        // prepare the data
        var source =
        {
            datatype: "json",
            datafields: [
                { name: 'bookcode', type: 'string' },
                { name: 'bookdesc', type: 'string' },
                { name: 'balance', type: 'float' },
                { name: 'datebalance', type: 'date' }
            ],
            id: 'id',
            url: url,
			sortcolumn: 'bookcode',
            sortdirection: 'asc'
        };
        var dataAdapter = new $.jqx.dataAdapter(source);

        $("#booklocat").jqxGrid(
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
                { text: 'เลขที่บัญชี', datafield: 'bookcode', width: 120 },
                { text: 'รายละเอียดบัญชี', datafield: 'bookdesc', width: 400 },
                { text: 'ยอดยกมา', datafield: 'balance', width: 100, cellsalign: 'right', columntype: 'numberinput', cellsformat: 'd2' },
                { text: 'วันที่ยกมา', datafield: 'datebalance', width: 100, columntype: 'datetimeinput', cellsformat: 'dd/MM/yyyy' }
            ],
            showtoolbar: true,
            rendertoolbar: function (toolbar) {
                    var me = this;
                    var container = $("<div style='margin: 5px;'></div>");
                    toolbar.append(container);
                    container.append('<input type="button" value="Export to Excel" id="excelExport" />');
                    $("#excelExport").jqxButton({ theme: theme });
                    //Export Data
                    $("#excelExport").click(function () {
                        $("#invlocat").jqxGrid('exportdata', 'xls', 'ข้อมูลบัญชีธนาคาร');
                    });
            },
            sortable: true,
            pageable: true,
            pagesize: 10,
            autoheight: true,
            columnsresize: true
        });
		$("#tableV-invlocat").jqxDataTable({
                altRows: true,
				showHeader:false,
                sortable: true,
                editable: true,
                selectionMode: 'singleRow',
				theme : theme,
                columns: [
                  { text: 'รายละเอียดสาขา', dataField: 'AA', width: 130 },
                  { text: '', dataField: 'BB', width: 250 }
                ]
        });
        $("#invlocatTool").jqxToolBar({ width: '100%', height: 50, theme: theme, tools: 'button | button | button',
            initTools: function (type, index, tool, menuToolIninitialization) {
                var icon = $("<div class='buttonIcon'></div>");
                switch (index) {
                    case 0:
                        icon.addClass("fa fa-arrow-left fa-lg");
                        icon.attr("title", "ย้อนกลับ");
                        icon.attr("id", menucod+"btnBack");
                        icon.html("<p>ย้อนกลับ</p>");
                        tool.append(icon);
                        tool.click(function() {
                            invlocat_back();
                        });
                        break;
                    case 1:
                        icon.addClass("fa fa-pencil-square-o fa-lg");
                        icon.attr("title", "แก้ไขข้อมูล");
                        icon.attr("id", menucod+"btnEdit");
                        icon.html("<p>แก้ไขข้อมูล</p>");
                        tool.append(icon);
                        tool.click(function() {
                            invlocat_edit();
                        });
                        break;
					case 2:
                        icon.addClass("fa fa-times fa-lg");
                        icon.attr("title", "ลบข้อมูล");
                        icon.attr("id", menucod+"btnDelete");
                        icon.html("<p style='margin-top:3px;'>ลบข้อมูล</p>");
                        tool.append(icon);
                        tool.click(function() {
                            invlocat_delete();
                        });
                        break;
                }
            }
        });
		var invlocat_edit = function() {
            if ($("#"+menucod+"locatcd").val() !== '') {
                // $.post('invlocat/update', {locatcd: "<?php echo $invlocat->locatcd; ?>"}, function(data, textStatus, xhr) {
                //     $("#showform").html(data);
                // });
				$.ajax({
                    url: "invlocat/update",
                    type: "GET",
                    cache: false,
                    data: { locatcd: $("#"+menucod+"locatcd").val(), menucod: menucod}
                })
                .done(function(data) {
                    console.log("success");
                    $("#"+menucod).html(data);
                })
                .fail(function(data) {
                    console.log("error");
                })
                .always(function(data) {
                    console.log("complete");
                });
            }
        };
		var invlocat_delete = function() {
			if ($("#"+menucod+"locatcd").val() !== '') {
				//if (confirm('คุณต้องการที่จะลบข้อมูล สาขา ?')) {
                $.when($.confirmdlg('คุณต้องการที่จะลบ สาขา?', 'warning')).then(function(){
                    $('#ok').click(function(event) {
    					$.post('invlocat/delete', {locatcd: $("#"+menucod+"locatcd").val(), menucod: menucod}, function(data, textStatus, xhr) {
    						//alert('ลบข้อมูล สาขา : '+$("#locatcd").val()+' เรียบร้อย');
    						//$("#"+menucod).html(data);
                            $.ajax({
                                url: "invlocat/index",
                                data: { menucod: menucod },
                                type: 'get',
                                success: function(data) {
                                    $("#"+menucod).html(data);
                                }
                            });
    					});
                    });
				});
            }
        };
        var invlocat_back = function(event) {
			$.ajax({
                url: "invlocat/index",
                data: { menucod: menucod },
                type: 'get',
                success: function(data) {
                    $("#"+menucod).html(data);
                }
            });
        };
    });
</script>
