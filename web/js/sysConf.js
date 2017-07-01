/**
 * Created by weixuan on 2017/7/1.
 */
/**
 * AJax文件添加
 * @param url
 * @param method
 * @param token
 * @param user_id
 * @param oldname
 * @param name
 * @param size
 * @param type
 * @param webURL
 * @param rootPath
 */
function fileUploadAdd(url,method,token,user_id,oldname,name,size,type,webURL,rootPath){
    $.ajax({
        url:url,
        type:method,
        data:{
            // "_csrf":"<?= Yii::$app->request->csrfToken ?>",
            "_csrf":token,
            "user_id":user_id,
            "oldname":oldname,
            "name":name,
            "size":size,
            "type":type,
            "url":webURL,
            "path":rootPath
        },
        success:function (result,status,xhr) {
            alert(result,status,xhr);
        }});
}

var bar = $('.bar');
var percent = $('.percent');
var showimg = $('#showimg');
var progress = $(".progress");
var files = $("#files");
var btn = $(".btn span");
var urlPOST = "/files/doAction7.php";

$("#fileupload").wrap(
    "<form id=\"myupload\" " +
    "action=\"" + urlPOST +
    "\" method='post' enctype='multipart/form-data'></form>"
);
$("#fileupload").change(function() {
    $("#myupload").ajaxSubmit({
        dataType: 'json',
        beforeSend: function() {
            showimg.empty();
            progress.show();
            var percentVal = "0%";
            bar.width(percentVal);
            percent.html(percentVal);
            btn.html("上传中...");
        },
        uploadProgress: function(event, position, total, percentComplete) {
            var percentVal = percentComplete + '%';
            bar.width(percentVal);
            percent.html(percentVal);
        },
        success: function(data) {
            var img = data.webURL;
            var name = data.name;
            var size = data.size;
            var type = data.type;
            var webURL = data.webURL;
            var rootPath = data.rootPath;
            jsonData.push(img);
            jsonAdd();
            btn.html("添加图片");
            fileUploadAdd(name,size,type,webURL,rootPath);
        },
        error:function(xhr){
            btn.html("重新添加");
            bar.width('0');
            files.html(xhr.responseText);
        }
    });
});