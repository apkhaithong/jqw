<div id="search">
    <div id="searchHeader">
        <span id="captureContainer" style="float: left">ค้นหาข้อมูล...</span>
    </div>
    <div id="searchContent" style="overflow: hidden">
        <div style="margin: 10px">
            ข้อความค้นหา
            <input type="text" id="searchInput" onkeyup="keyPressed(event)" />
            <input type="button" value="ค้นหา" id="searchButton" />
            <input type="button" value="ตกลง" id="okButton" />
            <input type="button" value="ยกเลิก" id="cancelButton" />
            <div id="panel1" style="margin-top: 10px;">
                <div id="result"></div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function () {
    var width = $(document).width();
    var height = $(document).height();
    var theme = 'ui-redmond';
    //ค้นหา
    // $("#panel1").jqxPanel({ width: width-30, height: height-90, autoUpdate: true, theme: theme});
    $('#search').jqxWindow({
        width: width-5,
        height: height-10,
        maxWidth: width,
        maxHeight: height,
        resizable: false,
        isModal: true,
        autoOpen: false,
        showCollapseButton: true,
        theme: theme,
        cancelButton: $('#cancelButton'),
        initContent: function () {
            $('#search').jqxWindow('focus');
            $("#searchInput").jqxInput({ height: 23, width: width-400, theme: theme });
            $('#searchButton').jqxButton({ width: '80px', theme: theme });
            $('#okButton').jqxButton({ width: '80px', theme: theme, template: "success" });
            $('#cancelButton').jqxButton({ width: '80px', theme: theme, template: "danger" });
        }
    });
  
    $('#search').on('open', function (event) {
        $('#searchInput').jqxInput('focus'); 
    });

    $('#search').on('close', function (event) {
        $("#searchInput").val('');
    });    
               
});
</script>