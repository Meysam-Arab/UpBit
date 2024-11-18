<?php
/**
 * Created by PhpStorm.
 * User: Amir
 * Date: 3/9/2017
 * Time: 7:28 PM
 */
$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
if (isset($_GET['link'])) {
    $s="https://storage.pwrtelegram.xyz/".$_GET['link'];
    header("Location: ".$s);
}
//$listOfBotToken=["300974265:AAGqKQ04kWjliAyYPEtVX4MorNWmYeIahu0",
//                 "331504193:AAH48sJOrQvF20Ah-_OvAeCo4lXucuIgIm4",
//                 "350231374:AAGOx7JYszt9Yb8_KMDOfmS_QWqyraUn-z4",
//                 "371540588:AAFLCkGQePfL9nc5bqV2N1dZ-wiGqolnn_s",
//                 "312524868:AAF1dQlZQQETyhR8fXvuoH9Hl4UeL60oxpg",
//                 "344778152:AAFjPkVtGhWu8OYJXk6iIAOCjHiG-qcNepg",
//                 "356915612:AAFWo7b5A0wiwYEY3uqbaE0VLHD3DUTPn2M"];
//$rndTemp=rand(0,count($listOfBotToken)-1);
?>
<html>
<header>
    <title>آپ بیت - آپلودسنتر رایگان</title>
    <link rel="stylesheet" type="text/css" href="resources/style.css">
    <link rel="stylesheet" type="text/css" href="resources/minPopUp.css">
</header>
<body onload="setCookie();">
<!--message popup-->
<div class="cd-user-modal cd-message-modal">
    <div class="cd-user-modal-container" style="background-color: transparent !important">
        <div id="cd-message" class="addNewLink">
            <div id="p-message">
                <fieldset>
                    <span id="x-message" style="font-weight: 600">X</span>
                    <p id="message"></p>
                    <img id="botFather" src="resources/botFather.png">
                    <div style="float: right;font-size: small;width: 100%;margin-bottom: 10px"><a style="float: right" href="http://upbit.ir/fa_help.html" target="_blank">آموزش ساخت ربات تلگرام در چند ثانیه</a></div>
                    <div style="float: left;font-size: small;width: 100%;margin-bottom: 10px"><a style="float: left" href="http://upbit.ir/en_help.html" target="_blank">Making telegram bot in a flash</a></div>
                </fieldset>
            </div>
            <div id="p-upload" style="margin-top:15px;margin-bottom: 15px ">
                <fieldset><legend>آپلود/upload</legend>
                    <div id="fileChoicer" style="margin-bottom: 20px">
                        <form id="data" method="post" enctype="multipart/form-data">
                            <div style="margin-bottom: 20px">
                                <label dir="ltr" style="float: left">Your Telegram bot token:</label>
                                <img src="resources/help_tb.png" style="width: 25px" id="help_tb_l">
                                <label dir="rtl" style="float: right">کد ربات تلگرامی شما:</label>
                                <img src="resources/help_tb.png" style="width: 25px;float: right" id="help_tb_r">
                                <input type="text" name="filelabel" id="userBotToken" size="50" maxlength="50" /><br />
                            </div>
                            <label dir="ltr" style="float: left">Choose file:</label>
                            <label dir="rtl" style="float: right">انتخاب فایل:</label>
                            <input name="document" class="button black" type="file" id="up_vid"/>
                            <div class="bg_upload">
                                <div style="width: 100%">
                                    <p id="termL">When you upload this file you are agree with terms of service.</p>
                                    <p id="termR">با آپلود فایل،یعنی قوانین انتشار را قبول دارید.</p>
                                </div>
                                <div style="text-align:center;width: 100%;margin-top: 70px">
                                    <a id="uploadBtn" class="button black">Begin Upload/شروع آپلود</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id="status">
                        <img id="imgPercent" src="resources/loader.gif">
                        <span id="percent">0%</span>
                    </div>
                </fieldset>
            </div>
            <div id="p-link">
                <fieldset><legend>لینک دانلود/Target Link</legend>
                    <a href="" id="link_href" target="_blank"><p id="makenLink"></p></a>
                    <button id="copyLinkCB" onclick="copyToClipboard('#makenLink')"><img src="resources/CopyLink.png"></button>
                </fieldset>
            </div>
        </div>
    </div>
</div>
<!--main-->
<div id="mainDiv">
    <div id="header">
        <img id="logo" src="resources/logo01.png">
    </div>
    <div id="body" class="message-main-nav">
        <div style="width: 100%;float: left">
            <a class="button black cd-message">آپلود/upload</a>
        </div>
        <div style="width: 100%;float: left;margin-top: 40px;">
            <div style="width: 45%;direction: ltr;float: left"><div style="float: right">Server status:<span id="serverStatusEn">in process...</span></div></div>
            <div style="width: 45%;direction: rtl;float: right"><div style="float: left">وضعیت سرور:<span id="serverStatusFa">در حال بررسی...</span></div></div>
        </div>
        <div style="width:100%;padding-top: 40px;float: left">
            <div style="width: 66%;padding:0% 2%;margin:0 auto">
                <table class="table-fill">
                    <thead>
                    <tr>
                        <th class="text-left">Why Upbit.ir?</th>
                        <th class="text-left fa-text-left">چرا آپ بیت؟</th>
                    </tr>
                    </thead>
                    <tbody class="table-hover">
                    <tr>
                        <td class="text-left">100% free!</td>
                        <td class="text-left fa-text-left">کاملا رایگان!</td>
                    </tr>
                    <tr>
                        <td class="text-left">Upload upto 1.35GB</td>
                        <td class="text-left fa-text-left">آپلود فایل تا سایز 1.35گیگابایت</td>
                    </tr>
                    <tr>
                        <td class="text-left">Direct link for files</td>
                        <td class="text-left fa-text-left">لینک مستقیم برای فایل ها</td>
                    </tr>
                    <tr>
                        <td class="text-left">Highest speed of Telegram server</td>
                        <td class="text-left fa-text-left">استفاده از سرورهای پر سرعت تلگرام</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div id="footer">
        <div class="fa">
            تمامی حقوق برای تیم
            <a href="http://www.telegram.org" style="color: #2d59b2" target="_blank">تلگرام</a>
            و شرکت
            <a href="http://www.fardan7eghlim.ir" style="color: darkslategray" target="_blank">هوش مصنوعی فردان هفت اقلیم</a>
            محفوظ است.
        </div>
        <div class="eng">
            Copyright © 2017-
            <a href="http://www.telegram.org" style="color: #2d59b2" target="_blank">Telegram</a>
            And
            <a href="http://www.fardan7eghlim.ir" style="color: darkslategray" target="_blank">fardan 7 eghlim</a>
            . All Rights Reserved.
        </div>
    </div>
</div>
<script src="resources/jquery-3.1.1.min.js"></script>
<script src="resources/main.js"></script>
</body>
</html>
