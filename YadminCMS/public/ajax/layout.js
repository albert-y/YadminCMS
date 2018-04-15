/**
 * Created by yuanjianqiu on 2018/3/26.
 */
$(document).ready(function () {
    $('.adminleft .admin-list-group li').click(function () {
        var url=$(this).children('a').attr('url');
       // alert(url);
        $('.adminright').empty().load(url);
    });
});


