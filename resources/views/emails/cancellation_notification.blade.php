<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>

<body>
    <p class="info__text">キャンセル登録がありましたので、お知らせ致します。<p>

    <p class="content__ttl">詳細</p>
    <p class="top__partation">-------------------------</p>
    <p>施設名：{{ $nursing_care_office_name }}</p>
    <p>利用者：{{ $care_receiver_name }}<span class="title">様</span></p>
    <p>訪問日：{{ $date_of_visit }}</p>
    <p>理由：{{ $reason }}</p>
    <p>--------------------------</p>

    <p class="sender">Care</p>
</body>

</html>