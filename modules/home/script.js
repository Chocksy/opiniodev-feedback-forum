var HOM = (function($) {
    return {
        search:function(elem){
            var term=$(elem).val();
            var timeout = null;
            var keyDelay=400;
            if(!term.blank()){
                if (timeout){
                    clearTimeout(timeout);
                }
                timeout = setTimeout(function(){
                    var pars='&term='+term;
                    var url=HTTP_SERVER_BASE+'modules/home/ajax/give_results.php';
                    $('#init_results').hide();
                    $('#results').load(url,pars,Response).show();
                }, keyDelay);
            }else if($('#init_results').is(':hidden')){
                $('#results').hide();
                $('#init_results').show();
                $('#create_button').val('Search').attr("disabled","disabled");
            }
            function Response(){
                $('#create_button').val('Add Idea').attr("disabled","");
            }
        },
        showNew:function(){
            var your_height=$(window).height();
            var your_width=$(window).width();
            var create_width=$('#create_new').css('width');
            //var create_height=$('#create_new').css('height');
            var create_height=270; //we set this from here to keep the css one for auto
            var set_placeh=(your_height-parseInt(create_height))/2;
            var set_placew=(your_width-parseInt(create_width))/2;
            $('#create_new').css({
                top:set_placeh+'px',
                left:set_placew+'px'
            });
            $('#title').val($('#y_idea').val());
            $('#create_new, #blackout').show();
        },
        closeNew:function(){
            $('#create_new, #blackout').hide();
        },
        createIdea:function(){
            var valid=true;
            if(!OPN.check($('#title'),'blank','Can\'t be blank!'))
                valid=false;
            if(valid){
                var url=HTTP_SERVER_BASE+'modules/home/ajax/create_idea.php';
                var pars='&title='+$('#title').val();
                pars+='&description='+$('#description').val();
                $.get(url,pars,Response);
            }
            function Response(data){
                var res=data.toQueryParams();
                window.location=res['url'];
            }
            return false;
        },
        init_main: function() {
            $(document).ready(function(){
                $.string(String.prototype);
                if($('#search_form').length){
                    $('#search_form')[0].reset();
                    $('#create_button').val('Search').attr("disabled","disabled");
                }

                $('input').blur(function () {
                    if($(this).val().blank()){
                        if($(this).attr('id')=='y_idea'){
                            $('#create_button').val('Search').attr("disabled","disabled");
                            $('#results').hide();
                            $('#init_results').show();
                        }
                    }
                });
            });
        }
    };
// Pass in jQuery.
})(jQuery);
OPN.init_main();

