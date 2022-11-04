<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>

<body>
    <p class="destination">{{ $keyperson_name }}<span class="title">様</span></p>

    <p class="text">
        ケアマネージャー訪問日の前日となりましたので、お知らせ致します。<br>
        訪問日時は以下の通りです。
    </p>

    <p class="top__partation">-------------------------</p>
    <p>被介護者：{{ $care_receiver_name }}<span class="title">様</span></p>
    <p>担当ケアマネージャー：{{ $care_manager_name }}</p>
    <p>日付：{{ $date }}</p>
    <p>時間：{{ $time }}</p>
    <p>--------------------------
    <p>

    <p>以上、よろしくお願い致します。</p>

    <p class="sender">Care</p>
</body>

</html>