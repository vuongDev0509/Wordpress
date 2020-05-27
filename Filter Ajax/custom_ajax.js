(function($){
    $(document).ready(function(){
        $('.bt-btn-cate-product').click(function(e){
            e.preventDefault();
            var cate_id = $(this).data("id");
            console.log(cate_id);
            var term = [ ];
            term.push(cate_id);
             console.log(term)
            $.ajax({
                type : "post", //Phương thức truyền post hoặc get
                dataType : "json", //Dạng dữ liệu trả về xml, json, script, or html
                url :custom_ajax_params.ajaxurl,  //Đường dẫn chứa hàm xử lý dữ liệu. Mặc định của WP như vậy
                data : {
                    action: "loadpostt", //Tên action
                    id_cate: cate_id,
                },
                context: this,
                beforeSend: function(){
                    //Làm gì đó trước khi gửi dữ liệu vào xử lý
                },
                success: function(response) {
                    //Làm gì đó khi dữ liệu đã được xử lý
                    if(response.success) {
                        $('#bt-id-product').html(response.data);
                    }
                    else {
                        alert('Đã có lỗi xảy ra');
                    }
                },
                error: function( jqXHR, textStatus, errorThrown ){
                    //Làm gì đó khi có lỗi xảy ra
                    console.log( 'The following error occured: ' + textStatus, errorThrown );
                }
            })
            return false;
        })
    })
})(jQuery)
