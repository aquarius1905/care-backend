<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
</head>

<body>
    <p class="destination">{{ $cancellation->getKeyPersonName() }}&emsp;様</p>

    <p class="info__text">キャンセル登録が完了しました。<p>

    <p class="content__ttl">詳細</p>
    <p class="top__partation">-------------------------</p>
    <p>利用者：{{ $cancellation->getCareReceiverName() }}　様</p>
    <p>施設名：{{ $cancellation->getNursingCareOfficeName() }}</p>
    <p>訪問日：{{ $cancellation->getFormattedDate() }}</p>
    <p>理由：{{ $cancellation->reason }}</p>
    <p>--------------------------</p>

    <p>以上、よろしくお願い致します。</p>

    <p class="sender">Care</p>
</body>

</html>