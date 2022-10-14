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
    <p class="info-text">キャンセル登録がありましたので、お知らせ致します。<p>

    <p class="content-ttl">詳細</p>
    <p class="top-partation">-------------------------</p>
    <p>利用者：{{ $cancellation->getCareReceiverName() }}　様</p>
    <p>施設名：{{ $cancellation->getNursingCareOfficeName() }}</p>
    <p>訪問日：{{ $cancellation->getFormattedDate() }}</p>
    <p>理由：{{ $cancellation->reason }}</p>
    <p>--------------------------</p>

    <p class="sender">Care</p>
</body>

</html>