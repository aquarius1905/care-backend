<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <style>
        .sender {
            margin-top: 30px;
        }

        .content-ttl {
            margin-bottom: 0;
        }

        .top-partation {
            margin-top: 0;
        }
    </style>
</head>

<body>
    <p class="destination">{{ $cancellation->getKeyPersonName() }}&emsp;様</p>

    <p class="info-text">キャンセル登録が完了しました。<p>

    <p class="content-ttl">詳細</p>
    <p class="top-partation">-------------------------</p>
    <p>利用者：{{ $cancellation->getCareReceiverName() }}　様</p>
    <p>施設名：{{ $cancellation->getNursingCareOfficeName() }}</p>
    <p>訪問日：{{ $cancellation->getFormattedDate() }}</p>
    <p>理由：{{ $cancellation->reason }}</p>
    <p>--------------------------</p>

    <p>以上、よろしくお願い致します。</p>

    <p class="sender">Care</p>
</body>

</html>