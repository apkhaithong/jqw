function createElements() {
	var theme = 'ui-redmond';
    $('#confirmdlg').jqxWindow({
        maxHeight: 150, maxWidth: 280, minHeight: 30, minWidth: 250, height: 145, width: 270,
        resizable: false, isModal: true, modalOpacity: 0.3, theme: theme,
        okButton: $('#ok'), cancelButton: $('#cancel'),
        initContent: function () {
            $('#ok').jqxButton({ width: '65px', theme: theme, template: "success" });
            $('#cancel').jqxButton({ width: '65px', theme: theme, template: "danger" });
            $('#ok').focus();
        }
    });
    $('#confirmdlg').jqxWindow('open');
}
$(document).ready(function () {
	$.confirmdlg = function (message, type) {
		var info     = '<i class="fa fa-info-circle fa-3x" style="vertical-align: middle; color: #1F4788;"></i>&nbsp;&nbsp;';
		var warning  = '<i class="fa fa-exclamation-triangle fa-3x" style="vertical-align: middle; color: #FFA400;"></i>&nbsp;&nbsp;';
		var error    = '<i class="fa fa-times-circle fa-3x" style="vertical-align: middle; color: #C3272B;"></i>&nbsp;&nbsp;';
		var dlgtype  = '';
		var dlgtitle = '';
		if (type == 'info') {
			dlgtype = info;
			dlgtitle = 'ยืนยัน';
		} else if (type == 'warning') {
			dlgtype = warning;
			dlgtitle = 'แจ้งเตือน';
		} else if (type == 'error') {
			dlgtype = error;
			dlgtitle = 'Error';
		} else {
			dlgtype  = '';
			dlgtitle = '';
		}
		$("#confirmdlg").remove();
		$("#content").append('<div id="confirmdlg"><div style="color: #2e6e9e;">'+dlgtitle+'</div><div><div style="width: 265px; height: 75px; text-align: center; padding-top: 15px; font-size: 14px">'+dlgtype+message+'</div><div><div style="float: left;"><input type="button" id="ok" value="ตกลง" style="margin-right: 10px; margin-left: 65px;" /><input type="button" id="cancel" value="ยกเลิก" /></div></div></div></div>');
		createElements();
    }
});
