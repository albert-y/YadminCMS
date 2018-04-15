/**
 * Created by yuanjianqiu on 2018/4/6.
 */
$(document).ready(function () {
    InitMainTable();
});

    //初始化bootstrap-table的内容
    function InitMainTable() {
        //记录页面bootstrap-table全局变量$tabel,方便使用
        $('#userlist').bootstrapTable('destroy');
        $('#userlist').bootstrapTable({
            method: "POST",
            url: "{:Url('Users/getUserList')}",
            striped: true,  //表格显示条纹
            pagination: true, //启动分页
            pageSize: 15,  //每页显示的记录数
            pageNumber: 1, //当前第几页
            pageList: [5, 10, 15, 20, 25],  //记录数可选列表
            search: false,  //是否启用查询
            searchAlign: 'left',//设置搜索框位置
            showColumns: false,  //显示下拉框勾选要显示的列
            showRefresh: false,  //显示刷新按钮
            paginationPreText: '上一页',
            paginationNextText: '下一页',
            paginationDetailHAlign: 'right',
            paginationHAlign: 'left',
            uniqueId: "id",  //每一行的唯一标识，一般为主键列
            sidePagination: "client", //表示服务端请求
            //设置为undefined可以获取pageNumber，pageSize，searchText，sortName，sortOrder
            //设置为limit可以获取limit, offset, search, sort, order
            checkboxHeader: true,
            toolbar: '#toolbar',
            showPaginationSwitch: false,
            //sortOrder: 'desc',
            showToggle: false,
            queryParamsType: "undefined",
            //exportDataType:  'basic' ,
            columns: [{
                checkbox: 'true'
            },{
                field: 'id',//这里的名字就是json数据里的键名
                title: 'id',
                align : 'center'
            }, {
                field: 'username',
                title: '用户名',
                align : 'center'
            }, {
                field: 'realname',
                title: '昵称',
                align: 'center'
            }]
        });


    }

