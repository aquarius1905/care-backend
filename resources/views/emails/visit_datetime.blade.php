<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>

<body>
    <p class="destination">{{ $keyperson_name }}<span class="title">様</span></p>

    <p class="info__text">
        次回のケアマネージャー訪問日時をお知らせ致します。
    <p>
        
    <p class="content__ttl">訪問日時</p>
    <p class="top__partation">-------------------------</p>
    <p>被介護者：{{ $care_receiver_name }}<span class="title">様</span></p>
    <p>担当ケアマネージャー：{{ $care_manager_name }}</p>
    <p>訪問日：{{ $date_of_visit }}</p>
    <p>時間：{{ $time }}</p>
    <p>--------------------------</p>

    <p>ご都合が悪くなった場合は、担当ケアマネージャーにご連絡ください。</p>
    <p>以上、よろしくお願い致します。</p>

    <p class="sender">Care</p>
</body>

</html>