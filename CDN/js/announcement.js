var localUrl = window.location.href;  
var regex = new RegExp("^https?://(test-)?blog\.ccknbc.cc(/?|/index[(.|_)].*|/?[?].*)$", "i");
if(regex.test(localUrl)==true){
    Snackbar.show({
        text: '本站统计已更换为【51.LA】',
        backgroundColor: '#696969',
        textColor: '#8FBC8F',
        duration: 8e3,
        pos: 'bottom-center',
        actionText: '查看隐私政策',
        actionTextColor: '#4CAF50',
        onActionClick: function () {
            window.open('/privacy-policy', 'newwindow', 'height=480, width=720, left='+ (screen.availWidth-720)/2 +',top=' + (screen.availHeight-480)/2 + ';toolbar=no,menubar=no,scrollbars=no,resizable=no,location=no,status=no')
        }
    })
}