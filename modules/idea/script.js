var IDE = (function($) {
    return {
        
        postComment:function(){
            var valid=true;
            if(!OPN.check($('#comment'),'blank','Can\'t be blank!'))
                valid=false;

            if(valid){
                var url=HTTP_SERVER_BASE+'modules/idea/ajax/post_comment.php';
                var pars=$('#post_comment').serialize();
                $.get(url,pars,Response);
            }
            function Response(data){
                document.location.reload(true);
            }
        },
        
        deleteComment:function(id){
            var url=HTTP_SERVER_BASE+'modules/idea/ajax/delete_comment.php';
            var pars='&id='+id;
            $.get(url,pars,Response);
            function Response(data){
                document.location.reload(true);
            }
            return false;
        },
        init_main: function() {
            $(document).ready(function(){
                $('#post_comment').submit(function(){
                    IDE.postComment(); 
                });
            });
        }
    };
// Pass in jQuery.
})(jQuery);
IDE.init_main();

