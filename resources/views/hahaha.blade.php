<!doctype html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>msg</title>
    <style>
        table{
            position: relative;
            width: 100%;
            height: 250px;
        }
        table thead tr th{
            border: solid 1px #ddd;
        }
        table tbody tr td{
            border: solid 1px #f00;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    <h1>哈哈哈哈哈哈哈啊哈和</h1>
    <h1>呵呵呵呵呵呵呵呵</h1>

    <h1><?= $data['username'] ?></h1>
    <h1><?= $data['sex'] ?></h1>
    <h1><?= $data['age'] ?></h1>
</div>
</body>
</html>
