<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
</head>

<body>
    <p class="info__text">キャンセル登録がありましたので、お知らせ致します。<p>

    <p class="content__ttl">詳細</p>
    <p class="top__partation">-------------------------</p>
    <p>施設名：{{ $nursingCareOfficeName }}</p>
    <p>利用者：{{ $careReceiverName }}<span class="title">様</span></p>
    <p>訪問日：{{ $dateOfVisit }}</p>
    <p>理由：{{ $reason }}</p>
    <p>--------------------------</p>

    <p class="sender">Care</p>
</body>

</html>