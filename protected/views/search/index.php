<input type="hidden" id="show" value="<?php echo $show;?>">
<input type="hidden" id="returnid" value="<?php echo $returnid;?>">
<input type="hidden" id="returnvalue" value="">
<div id="tbSearch"></div>
<script>
    function keyPressed(e) {
        if(e.keyCode==13) {
            $("#searchButton").click();
        }
    }    
    $(function() {
        var width = $(document).width();
        var height = $(document).height();
        var theme = 'ui-redmond'; 
        var sqltxt = "";
        var fields = [];
        var keyno = "";
        var data = [];
        var source = {};
        var source =
        {
            localdata: data,
            datatype: 'json'
        };
        var gridDataAdapter = new $.jqx.dataAdapter(source);

        //ตรวจสอบว่าจะค้นหาข้อมูลอะไร พร้อมระบุ Field ที่จะแสดง
        if ($('#show').val() === 'setaump') {
            sqltxt = 'select * from setaump where upper(aumpcode||aumpdesc) like :param1 order by aumpcode';
            fields = [{ text: 'รหัสอำเภอ', datafield: 'aumpcode', width: 250 },
                      { text: 'คำอธิบาย', datafield: 'aumpdesc', width: 250 }];
            keyno = 'aumpcode';
        }
        if ($('#show').val() === 'setprov') {
            sqltxt = 'select * from setprov where upper(provcode||provdesc) like :param1 order by provcode';
            fields = [{ text: 'รหัสจังหวัด', datafield: 'provcode', width: 250 },
                      { text: 'คำอธิบาย', datafield: 'provdesc', width: 250 }];
            keyno = 'provcode';
        }
        
        $("#tbSearch").jqxGrid({
            width: width-35,
            height: height-100,
            sortable: true,
            source: gridDataAdapter,
            theme: theme,
            columns: fields
        });

        //ฟังก์ชั่น คลิกปุ่มค้นหา และแสดงรายการที่ค้นหาพบ
        $("#searchButton").click(function() {
            $('#tbSearch').jqxGrid('showloadelement');
            $.ajax({
                url: "search/searchtext",
                data: {sqltxt: sqltxt, param1: $('#searchInput').val()},
                type: 'POST',
                dataType: 'json',
                success: function (data) {
                    source.localdata = data;
                    $('#tbSearch').jqxGrid('updatebounddata');
                    $('#tbSearch').jqxGrid('hideloadelement');
                }
            });
        });
        $('#tbSearch').on('rowclick', function (event) {
            var args = event.args;
            var rowindex = args.rowindex;
            var data = $('#tbSearch').jqxGrid('getcellvalue', rowindex, keyno);
            $('#okButton').jqxButton({disabled: false });
            $("#returnvalue").val(data);                                                                               
        });
        $('#okButton').click(function() {
            var id = '#'+$("#returnid").val();
            $(id).val($("#returnvalue").val());
            $('#search').jqxWindow('close');
            $(id).jqxInput('focus');
        });
        $('#tbSearch').on('rowdoubleclick', function (event) {
             $('#okButton').click();
        });
    }); 
</script>
