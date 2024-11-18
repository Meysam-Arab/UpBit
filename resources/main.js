jQuery(document).ready(function($){

    var formModal_message = $('.cd-message-modal'),
        message_mainNav = $('.message-main-nav');

    //open message-form form
    message_mainNav.on('click', '.cd-message', message_selected);

    //close modal
    var formModal = $('.cd-user-modal');
    $(document.body).on('click', function(event){
        if( $(event.target).hasClass('cd-user-modal') || $(event.target).is('.close_popup') ) {
            //formModal.removeClass('is-visible');
            jQuery('.cd-user-modal').removeClass('is-visible');
        }
    });
    //close modal when clicking the esc keyboard button
    $(document).keyup(function(event){
        if(event.which=='27'){
            formModal.removeClass('is-visible');
        }
    });

    function message_selected(){
        formModal_message.addClass('is-visible');
    }

});
////////////copy2Clipboard
function copyToClipboard(element) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(element).text()).select();
    document.execCommand("copy");
    $temp.remove();
}
////main
function makelink(temp) {
    var token=document.getElementById("userBotToken").value;
    // var result01 = JSON.parse(temp);
    var result01 = temp;
    var formData = new FormData();
    var path="https://api.pwrtelegram.xyz/bot"+token+"/getFile?file_id="+result01.result.file_id;
    var oReq = new XMLHttpRequest();
    oReq.open("GET", path, true);
    oReq.onload = function(oEvent) {
        if (oReq.status == 200) {
            $('#p-link').css('display','block');
            var oOutput = document.getElementById("makenLink");
            var result02=JSON.parse(oReq.responseText);
            // var link="https://storage.pwrtelegram.xyz/"+result02.result.file_path;
            var link="http://upbit.ir/?link="+result02.result.file_path;
            oOutput.innerHTML =link;
            document.getElementById("link_href").setAttribute("href", link);
            $('#status').css('display','none');
        } else {
            $("#status").html('متاسفانه مشکلی پیش آمد./Unfortunately,there is a problem.');
        }
    };
    oReq.send(formData);
}
$( document ).ready(function() {
    $("#uploadBtn").click(function(){
        send();
    });
    $("#help_tb_r").click(function(){
        $('#p-message').css('display','block');
        $('#botFather').css('display','block');
        $('#botFather').css('float','left');
        $('#message').css('direction','rtl');
        $("#message").html('شما بایستی به ربات تلگرامی '+'<a href="https://telegram.me/BotFather">BotFather@</a>'+' مراجعه کرده و بعد از ساخت رباتی،توکنی به شما داده می شود که بایستی در قسمت پایین قرار دهید.');
    });
    $("#help_tb_l").click(function(){
        $('#p-message').css('display','block');
        $('#botFather').css('display','block');
        $('#botFather').css('float','right');
        $('#message').css('direction','ltr');
        $("#message").html('You should use '+'<a href="https://telegram.me/BotFather">@BotFather</a>'+' to make a bot.after making a bot,this robot will give you a token for accessing HTTP.use it below.');
    });
    $("#x-message").click(function(){
        clearMessage();
    });
});
$('#up_vid').bind('change', function() {
    if(this.files[0].size>1358252810){
        $('#p-message').css('display','block');
        $("#message").html('File must be under 1.35gb/فایل بایستی کمتر از 1.35گیگ باشد');
    }else{
        clearMessage();
    }
});
function send() {
    var formData = new FormData($('#data')[0]);
    var token=document.getElementById("userBotToken").value;
    saveToken(token);
    if(token==""){
        $('#p-message').css('display','block');
        $("#message").html('Please insert token of your bot/لطفا توکن ربات خود را وارد کنید');
        return;
    }else{
        clearMessage();
    }
    if(typeof document.getElementById("up_vid").files[0] === 'undefined')
        return;
    if(document.getElementById("up_vid").files[0].size>1358252810 | document.getElementById("up_vid").files[0].size<1)
        return;
    $('#p-link').css('display','none');
    $('#status').css('display','block');
    $('#status').html('<img id="imgPercent" src="resources/loader.gif"><span id="percent">0%</span>');
    console.log(formData);
    $.ajax({
        url: "https://api.pwrtelegram.xyz/bot"+token+"/uploadDocument",
        type: 'POST',
        data: formData,
        xhr: function() {
            var xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener("progress", function(evt) {
                if (evt.lengthComputable) {
                    var percentComplete = evt.loaded / evt.total;
                    console.log(percentComplete);
                    $('#percent').html((Math.round(percentComplete*100)) + '%');
                }
            }, false);
            return xhr;},
        success: function (data) {
            // var result01 = JSON.parse(data);
            result01=data;
            if(result01.ok==true){
                $("#status").html('در حال ساخت لینک/Making Link');
                makelink(data);
            }else{
                if(result01.hasOwnProperty("description") && result01.description.indexOf("Set a custom backend") !== -1){
                    validateToken();
                }else{
                    $("#status").html('متاسفانه سرویس بسیار مشغول است./Unfortunately,our server is too busy.');
                }
            }
        },
        error: function (data) {
            $("#status").html('متاسفانه سرویس بسیار مشغول است./Unfortunately,our server is too busy.');
        },
        cache: false,
        contentType: false,
        processData: false
    });
}
function validateToken() {
    var token=document.getElementById("userBotToken").value;
    $.ajax({
        url: "https://api.pwrtelegram.xyz/bot"+token+"/setbackend?backend_token=144779332:H2fZQZwTf9rC1ibeC_cCBY4uwHzRAqHTNgoCKxm1NOc",
        type: 'POST',
        success: function (data) {
            result01=data;
            if(result01.ok==true){
                $("#status").html('ربات شما،ثبت شد.لطفا سایت را باز و بسته و دوباره شروع به آپلودگیری کنید!/Your token was successfully registered,Now reload the website and upload your file again.');
            }else{
              $("#status").html('متاسفانه سرویس بسیار مشغول است./Unfortunately,our server is too busy.');
            }
        },
        error: function (data) {
            $("#status").html('متاسفانه سرویس بسیار مشغول است./Unfortunately,our server is too busy.');
        },
        cache: false,
        contentType: false,
        processData: false
    });
}
function clearMessage() {
    $('#p-message').css('display','none');
    $('#botFather').css('display','none');
    $("#message").html('');
}
function setCookie(){
    document.getElementById('userBotToken').value = document.cookie.substr(document.cookie.indexOf("=")+1);
    serverStatus();
}
function saveToken(token) {
    if(token!=document.cookie.substr(document.cookie.indexOf("=")+1)) {
        document.cookie = "token=; expires=Thu, 01 Jan 1970 00:00:00 UTC;";
        document.cookie = "token="+ token + "; expires=Fri, 31 Dec 9999 23:59:59 GMT;";
    }
}
function serverStatus() {
    if(document.getElementById('userBotToken').value){
        $.ajax({
            url: "https://api.pwrtelegram.xyz/bot"+document.getElementById('userBotToken').value+"/getChat?chat_id=@jili_pili",
            type: 'POST',
            success: function (data) {
                $("#serverStatusEn").html('OK');
                $("#serverStatusFa").html('سالم');
            },
            error: function (data) {
                $("#serverStatusEn").html('busy');
                $("#serverStatusFa").html('شلوغ');
            },
            cache: false,
            contentType: false,
            processData: false
        });
    }else{
        $("#serverStatusEn").html('unknown');
        $("#serverStatusFa").html('نامشخص');
    }
}