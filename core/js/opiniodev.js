var OPN = (function($) {
    return {
        prettyDate:function(time){
            var date = new Date((time || "").replace(/-/g,"/").replace(/[TZ]/g," ")),
            diff = (((new Date()).getTime() - date.getTime()) / 1000),
            day_diff = Math.floor(diff / 86400);

            if ( isNaN(day_diff) || day_diff < 0 || day_diff >= 31 )
                return;

            return day_diff == 0 && (
                diff < 60 && "just now" ||
                diff < 120 && "1 minute ago" ||
                diff < 3600 && Math.floor( diff / 60 ) + " minutes ago" ||
                diff < 7200 && "1 hour ago" ||
                diff < 86400 && Math.floor( diff / 3600 ) + " hours ago") ||
            day_diff == 1 && "Yesterday" ||
            day_diff < 7 && day_diff + " days ago" ||
            day_diff < 31 && Math.ceil( day_diff / 7 ) + " weeks ago";
        },
        check:function(elem,type,mess){
            $('.error').remove();
            if(type=='blank'){
                if(elem.val().blank()){
                    elem.after('<div class="error">'+mess+'</div>').css({
                        border:'1px solid red'
                    }).focus();
                    return false;
                }else{
                    elem.css({
                        border:'1px solid #ccc'
                    });
                    return true;
                }
            }else if(type=='email'){
                if(elem.val().blank()){
                    $('.error').remove();
                    elem.after('<div class="error">Please enter email address!</div>').css({
                        border:'1px solid red'
                    }).focus();
                    return false;
                }else if(!elem.val().validEmail()){
                    $('.error').remove();
                    elem.after('<div class="error">The email is not valid!</div>').css({
                        border:'1px solid red'
                    }).focus();
                    return false;
                }else{
                    elem.css({
                        border:'1px solid #ccc'
                    });
                    return true;
                }
            }
            return true;
        },
        vote:function(id){
            var url=HTTP_SERVER_BASE+'ajax/vote_idea.php';
            var pars='&id='+id;
            $.get(url,pars,Response);
    
            function Response(data){
                $('#nr_votes_'+id).addClass('full').html(data);
                $('#do_vote_'+id).hide();
            }
        },
        logout:function(){
            var url=HTTP_SERVER_BASE+'modules/getin/ajax/getin.php';
            var pars='&action=logout';
            $.get(url,pars,Response);
            function Response(data){
                document.location.reload(true);
            }
            return false;
        },
        markIdea:function(id,status){
            var url=HTTP_SERVER_BASE+'ajax/mark_idea.php';
            var pars='&id='+id;
            pars+='&status='+status;
            $.get(url,pars,Response);
            function Response(data){
                var jsonObject = JSON.parse(data);
                var sts         = jsonObject.status;
                var adm_com         = jsonObject.adm_com;
                if($('#status_'+id).length>0)
                    $('#status_'+id).replaceWith(sts);
                else
                    $('.votes').append(sts);

                if($('#com_status_'+id).length>0)
                    $('#com_status_'+id).replaceWith(adm_com);
            }
            return false;
        },
        deleteIdea:function(id){
            var url=HTTP_SERVER_BASE+'ajax/delete_idea.php';
            var pars='&id='+id;
            $.get(url,pars,Response);
            function Response(data){
                if($('.search').length>0)
                    document.location.reload(true);
                else
                    document.location.href=HTTP_SERVER_BASE;
            }
            return false;
        },
        init_main: function() {
            $(document).ready(function(){
                $.fn.prettyDate = function(){
                    return this.each(function(){
                        var date = OPN.prettyDate(this.title);
                        if ( date )
                            $(this).text( date );
                    });
                }
                $(".com_date").prettyDate();
                setInterval(function(){
                    $(".com_date").prettyDate();
                }, 5000);
    
                $.string(String.prototype);

                $("input,textarea").each(function (type) {
                    $(this).focus(function () {
                        if($(this).val().blank())
                            $(this).prev("label").fadeTo('fast',0.45);
                    });

                    $(this).keypress(function () {
                        $(this).prev("label").fadeTo('fast',0);
                    });

                    $(this).blur(function () {
                        if($(this).val().blank()){
                            $(this).prev("label").fadeTo('fast',1);
                        }
                    });
                });
            });
        }
    };
// Pass in jQuery.
})(jQuery);
OPN.init_main();

