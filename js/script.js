/*
 * JavaScript Pretty Date
 * Copyright (c) 2008 John Resig (jquery.com)
 * Licensed under the MIT license.
 */
function prettyDate(time){
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
}
/*end pretty date*/

function check(elem,type,mess){
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
}

function vote(id){
    var url=HTTP_SERVER_BASE+'ajax/vote_idea.php';
    var pars='&id='+id;
    $.get(url,pars,Response);
    
    function Response(data){
        $('#nr_votes_'+id).addClass('full').html(data);
        $('#do_vote_'+id).hide();
    }
}

function search(elem){
    var term=$(elem).val();
    var timeout = null;
    var keyDelay=400;
    if(!term.blank()){
        if (timeout){
            clearTimeout(timeout);
        }
        timeout = setTimeout(function(){
            var pars='&term='+term;
            var url=HTTP_SERVER_BASE+'ajax/give_results.php';
            $('#init_results').hide();
            $('#results').load(url,pars,Response).show();
        }, keyDelay);
    }else if($('#init_results').is(':hidden')){
        $('#results').hide();
        $('#init_results').show();
        $('#create_button').val('Cauta').attr("disabled","disabled");
    }
    function Response(){
        $('#create_button').val('Adauga Idea').attr("disabled","");
    }
}

function showNew(){
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
}
function closeNew(){
    $('#create_new, #blackout').hide();
}

function createIdea(){
    var valid=true;
    if(!check($('#title'),'blank','Can\'t be blank!'))
        valid=false;
    if(valid){
        var url=HTTP_SERVER_BASE+'ajax/create_idea.php';
        var pars='&title='+$('#title').val();
        pars+='&description='+$('#description').val();
        $.get(url,pars,Response);
    }
    function Response(data){
        var res=data.toQueryParams();
        window.location=res['url'];
    }
    return false;
}

function postComment(id){
    var valid=true;
    if(!check($('#comment'),'blank','Can\'t be blank!'))
        valid=false;

    if(valid){
        var url=HTTP_SERVER_BASE+'ajax/post_comment.php';
        var pars='&comment='+$('#comment').val();
        pars+='&idea_id='+id;
        $.get(url,pars,Response);
    }
    function Response(data){
        document.location.reload(true);
    }
}

function signup(){
    var valid=true;
    var username=$('#s_username').val();
    var email=$('#s_email').val();
    var password=$('#s_password').val();
    var rpassword=$('#s_rpassword').val();

    if(!check($('#s_username'),'blank','Can\'t be blank!'))
        valid=false;
    else if(!check($('#s_email'),'email'))
        valid=false;
    else if(!check($('#s_password'),'blank','Can\'t be blank!'))
        valid=false;
    else if(!check($('#s_rpassword'),'blank','Can\'t be blank!'))
        valid=false;
    else if(password!=rpassword){
        $('.error').remove();
        $('#s_password').after('<div class="error">This has to be the same with &darr;</div>').css({
            border:'1px solid red'
        }).focus();
        $('#s_rpassword').css({
            border:'1px solid red'
        });
        valid=false;
    }

    if(valid){
        var url=HTTP_SERVER_BASE+'ajax/getin.php';
        var pars='&action=signup';
        pars+='&username='+username;
        pars+='&email='+email;
        pars+='&password='+password;
        pars+='&rpassword='+rpassword;
        $.get(url,pars,Response);
    }
    function Response(data){
        $('#signup').html(data);
    }
    return false;
}

function login(){
    var valid=true;
    var username=$('#username').val();
    var password=$('#password').val();

    if(!check($('#username'),'blank','Can\'t be blank!'))
        valid=false;
    else if(!check($('#password'),'blank','Can\'t be blank!'))
        valid=false;

    if(valid){
        var url=HTTP_SERVER_BASE+'ajax/getin.php';
        var pars='&action=login';
        pars+='&username='+username;
        pars+='&password='+password;
        $.get(url,pars,Response);
    }
    function Response(data){
        var rec=data.toQueryParams();
        if(parseInt(rec['error'])){
            alert(rec['msg']);
        }else{
            document.location.href=HTTP_SERVER_BASE;
        }
    }
    return false;
}

function logout(){
    var url=HTTP_SERVER_BASE+'ajax/getin.php';
    var pars='&action=logout';
    $.get(url,pars,Response);
    function Response(data){
        document.location.reload(true);
    }
    return false;
}

function markIdea(id,status){
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
}

function deleteIdea(id){
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
}

$(document).ready(function(){
    jQuery.fn.prettyDate = function(){
        return this.each(function(){
            var date = prettyDate(this.title);
            if ( date )
                jQuery(this).text( date );
        });
    }
    $(".com_date").prettyDate();
    setInterval(function(){
        $(".com_date").prettyDate();
    }, 5000);
    
    $.string(String.prototype);
    if($('#search_form').length){
        $('#search_form')[0].reset();
        $('#create_button').val('Search').attr("disabled","disabled");
    }

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
                if($(this).attr('id')=='y_idea'){
                    $('#create_button').val('Search').attr("disabled","disabled");
                    $('#results').hide();
                    $('#init_results').show();
                }
            }
        });
    });
});
