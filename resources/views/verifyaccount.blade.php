<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verify your Mall Account</title>
</head>
<style>
    html,body,div{font-family:"微软雅黑"; font-size: 18px;padding: 0;margin: 0;color: #666; box-sizing:border-box;}
    /*.big_box{
        position:absolute;
        top:50%;
        left:50%;
        transform: translate(-50%,-50%);//通过变形来搞定
    }*/
    .title{font-size: 34px; margin-bottom: 15px; font-weight: bold;}
    .first_line{margin-bottom: 5px;}
    .second_line{margin-bottom: 15px;}
    .note{
        margin-top:5px;
        font-style: italic;
        font-size: 10px;
    }
    .note2{
        /*font-style: oblique;*/
        font-size: 10px;
        margin-top:5px;
        margin-bottom: 15px;
    }
    .thx{
        margin-bottom:5px;
    }
    .btn{
        border: none;
        color: white;
        padding: 10px 24px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 18px;
        margin: 4px 2px;
        cursor: pointer;
        background-color: #fd7e14;
    }
</style>
<body>
<div class="big_box">
    <div class="title">Dear Customer</div>
    <div class="first_line">
        Thanks for applying for a Mall account.
    </div>
    <div class="second_line">
        Please confirm your email address to complete your application.
    </div>
    <a href="https://{{$data['url']}}" target="_blank"><button class="btn">Confirm your email</button></a>
    <div class="note">please note: this confirmation only valid within 24 hours!!!</div>
    <div class="note2">if the above button doesn't work, please use this link: <a href="https://{{$data['url']}}" style="padding-left: 5px; padding-right: 10px;" target="_blank">https://{{$data['url']}}</a>for confirmation directly~~~</div>
    <div class="thx">
        Thanks!
    </div>
    <div class="end_line">
        The Mall Service Team
    </div>
</div>

</body>
</html>