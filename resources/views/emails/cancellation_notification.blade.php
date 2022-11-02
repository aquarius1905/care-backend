<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <p class="info__text">キャンセル登録がありましたので、お知らせ致します。<p>

    <p class="content__ttl">詳細</p>
    <p class="top__partation">-------------------------</p>
    <p>利用者：{{ $cancellation->getCareReceiverName() }}　様</p>
    <p>施設名：{{ $cancellation->getNursingCareOfficeName() }}</p>
    <p>訪問日：{{ $cancellation->getFormattedDate() }}</p>
    <p>理由：{{ $cancellation->reason }}</p>
    <p>--------------------------</p>

    <p class="sender">Care</p>
</body>

</html>