$(function(){
    $('.btn-delete-post').on('click',function(){
        let id = $(this).attr('data-postId');
        let url = $("#confirm-delete").attr('href');
        let subUrl = url.substr(0, 26);
        url = subUrl + id;
        $("#confirm-delete").attr('href', url);
    });

    $('.btn-delete-category').on('click',function(){
        let id = $(this).attr('data-categorId');
        let url = $("#confirm-delete").attr('href');
        let subUrl = url.substr(0, 31);
        url = subUrl + id;
        $("#confirm-delete").attr('href', url);
    });

    $('.btn-delete-author').on('click',function(){
        let id = $(this).attr('data-authorId');
        console.log(id);
        let url = $("#confirm-delete").attr('href');
        console.log(url);
        let subUrl = url.substr(0, 28);
       
        url = subUrl + id;
        $("#confirm-delete").attr('href', url);
    });
});