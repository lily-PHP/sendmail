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
    <div class="user-title">Dear <span> <?=$data->username ?> </span></div>
    <div class="user-titlesub">
        Thanks you for your great support on us.<br />
        Our customer team has already confirmed with you about your order.
    </div>
    <div class="user-titlesub" style="margin: 10px 0;">
        Order: <span><?=$data->orderId ?></span>
    </div>
    <div class="user-titlesub mtop20">
        <span style="margin-left: 0;"><a href="<?=$data->url ?>" target="_blank"><?=$data->advert ?></a></span>
    </div>
    <div class="box-table">
        <table  border="1" cellspacing="0" cellpadding="0">
            <thead>
            <tr>
                <th>Product</th>
                <th>Number</th>
                <th>Parameters</th>
                <th>Parameters</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($data->skuList as $k){
                echo '<tr>';
                echo '<td width="500">'.$k->product.'</td>';
                echo '<td width="100">'.$k->number.'</td>';
                echo '<td width="200">'.$k->Parameters1.'</td>';
                echo '<td width="200">'.$k->Parameters2.'</td>';
                echo '</tr>';
            }
            ?>
            </tbody>
        </table>
    </div>
    <div class="user-titlesub mtop20 price">
        Total:  LKR  <span><?=$data->price ?></span>
    </div>
    <div class="user-titlesub" style="margin: 10px 0;">
        <span><?=$data->address ?></span>
    </div>
    <div class="user-titlesub">
        We will delivered it as soon as possible.<br />
        Please make sure your phone available for we could connect with you once product arrive.<br />
        <br />
        Thanks again for yor support<br />
    </div>
    <div class="user-titlesub mtop20 price" style="width: 85%;margin-bottom: 45px;">
        Thanks <br />
        Elinkmall
    </div>
</div>
</body>
</html>
