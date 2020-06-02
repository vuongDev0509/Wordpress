(function($){
    $(document).ready(function(){
        // js filter checkbox
        $('.bt-btn-filter').click(function(eg){
            var checkbox = document.getElementsByName('cate-product');
            var term = [ ];
            for (var i = 0; i < checkbox.length; i++){
                if (checkbox[i].checked === true){
                    var cate_id = $(checkbox[i]).data("id");
                term.push(cate_id);
                }
            }
            $.ajax({
                type : "post",
                dataType : "json",
                url :custom_ajax_params.ajaxurl,
                data : {
                    action: "loadproductck",
                    term_id: term,
                },
                context: this,
                beforeSend: function(){

                },
                success: function(response) {
                    // Do something when the data has been processed
                    if(response.success) {
                        $('#bt-id-product').html(response.data);
                    }
                    else {
                        alert('An error has occurred');
                    }
                },
                error: function( jqXHR, textStatus, errorThrown ){
                // Do something when an error occurs
                console.log( 'The following error occured: ' + textStatus, errorThrown );
                }
            })
        });

        // js filter radio
        var loading_ui = $("<div class='bt-loading_ui'><img src='http://beplusprojects.com/wpvuong/wp-content/uploads/2020/05/Spinner-1s-200px.gif' /> </div>")
        $('html body').prepend(loading_ui);
        $('.bt-btn-cate-product').click(function(e){
            var cate_id = $(this).data("id");
            $(this).addClass("loading");
            setTimeout( function() {
                 $('.bt-btn-cate-product').removeClass("loading");
            }, 500);
            $.ajax({
                type : "post",
                dataType : "json",
                url :custom_ajax_params.ajaxurl,
                data : {
                    action: "loadproduct",
                    id_cate: cate_id,
                },
                context: this,
                beforeSend: function(){
                    loading_ui.addClass("active")
                    setTimeout( function() {
                         loading_ui.removeClass("active");
                    }, 1000);
                },
                success: function(response) {
                    // Do something when the data has been processed
                    if(response.success) {
                        $('#bt-id-product').html(response.data);
                    }
                    else {
                        alert('An error has occurred');
                    }
                },
                error: function( jqXHR, textStatus, errorThrown ){
                    // Do something when an error occurs
                    console.log( 'The following error occured: ' + textStatus, errorThrown );
                }
            })
        })
    })
})(jQuery)
