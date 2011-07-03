var GIN = (function($) {
    return {
        signup:function(){
            var valid=true;
            var username=$('#s_username').val();
            var email=$('#s_email').val();
            var password=$('#s_password').val();
            var rpassword=$('#s_rpassword').val();

            if(!OPN.check($('#s_username'),'blank','Can\'t be blank!'))
                valid=false;
            else if(!OPN.check($('#s_email'),'email'))
                valid=false;
            else if(!OPN.check($('#s_password'),'blank','Can\'t be blank!'))
                valid=false;
            else if(!OPN.check($('#s_rpassword'),'blank','Can\'t be blank!'))
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
                var url=HTTP_SERVER_BASE+'modules/getin/ajax/getin.php';
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
        },
        login:function(){
            var valid=true;
            var username=$('#username').val();
            var password=$('#password').val();

            if(!OPN.check($('#username'),'blank','Can\'t be blank!'))
                valid=false;
            else if(!OPN.check($('#password'),'blank','Can\'t be blank!'))
                valid=false;

            if(valid){
                var url=HTTP_SERVER_BASE+'modules/getin/ajax/getin.php';
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
        },
        init_main: function() {
            $(document).ready(function(){
                $('#login_form').submit(function(){
                    GIN.login();
                });
                $('#register_form').submit(function(){
                    GIN.signup();
                });
            });
        }
    };
// Pass in jQuery.
})(jQuery);
GIN.init_main();

