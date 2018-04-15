/**
 * Created by lsyjq on 2018/1/6.
 */

$('').change(function () {
    var resdata=getDataAjax(data);
});

$('').change(function () {

});




function getDataAjax(url,data) {
    $.ajax({
        url:url,
        data:data,
        type:"POST",
        dataType:"JSON",
        success:function (data) {
            return data;
        }
    });
}