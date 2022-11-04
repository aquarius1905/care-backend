<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>

<body>
    <p class="info__text">日誌のご家庭での状況が更新されました。</p>

    <p class="content__ttl">更新内容</p>
    <p class="top__partation">-------------------------</p>
    <p>事業所名：{{ $nursing_care_office_name }}</p>
    <p>日誌の日付：{{ $diary_date }}</p>
    <p>被介護者：{{ $care_receiver_name }}<span class="title">様</span></p>
    <p>ご家庭での状況：{{ $situation_at_Home }}</p>
    <p>--------------------------</p>

    <p class="sender">Care</p>
</body>

</html>