<!doctype html>
<html lang="">
<head>
    <title>msg</title>
    <style>
        table{
            position: relative;
            width: 100%;
            text-align: left;
            border-collapse: collapse;
            text-indent: 0.5rem;
        }
        table thead tr th{
            border: solid 1px #ddd;
            background: #cacec714;
            line-height: 30px;
            padding: 2px;
        }
        table tbody tr td{
            border: solid 1px #ddd;
            height: auto;
            line-height: 30px;
            word-break:break-all;
            padding: 2px;
        }
        a{
            text-decoration:none;
        }

        .mail-box{
            color: #555;
            margin: 10px;
            max-width: 1080px;
            border: #ddd 1px solid;
            padding: 10px;
        }
        .user-title{
            position: relative;
            margin: 10px 0 20px 0;
        }
        .user-titlesub span,.user-title span{
            position: relative;
            margin-left: 0.1rem;
            font-weight: 600;
        }
        .user-titlesub{
            position: relative;
            line-height: 22px;
        }
        .mtop20{
            margin: 20px 0;
        }
        .price{
            text-align: right;
        }
        .price span{
            font-weight: 600;
            color:#ff0000;
            margin-right: 20px;
        }
    </style>
</head>
<body>
<div class="mail-box">

    <div class="user-titlesub">
        Thanks you for your great support on us.<br />
        We have received your order
    </div>
    <div class="user-titlesub" style="margin: 10px 0;">

    </div>
    <div class="user-titlesub mtop20">
        <b color="red">{{$data}}</b>
    </div>

    <div class="user-titlesub mtop20 price">
        Total:  LKR
    </div>
    <div class="user-titlesub" style="margin: 10px 0;">

    </div>
    <div class="user-titlesub">
        Our customer team will confirm with you soon.<br />
        Please make your phone available.<br />
        After your confirmation,your product will be delivered to you about 7 days.<br />
        If you want to revise your information or cancel order, please inform us.<br />
    </div>
    <div class="user-titlesub mtop20 price" style="width: 85%;margin-bottom: 45px;">
        Thanks <br />
        Elinkmall
    </div>
</div>
</body>
</html>
