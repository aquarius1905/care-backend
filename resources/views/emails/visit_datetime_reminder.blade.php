<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <style>
        .destination,
        .text {
            margin-bottom: 30px;
        }

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
    <p class="destination">{{ $visit_datetime->getKeyPersonName() }}　様</p>

    <p class="text">
        ケアマネージャー訪問日の前日となりましたので、お知らせ致します。<br>
        訪問日時は以下の通りです。
    </p>

    <p class="top-partation">-------------------------</p>
    <p>被介護者：{{ $visit_datetime->getCareReceiverName() }}　様</p>
    <p>担当ケアマネージャー：{{ $visit_datetime->getCareManagerName() }}</p>
    <p>日付：{{ $visit_datetime->getFormattedVisitDate() }}</p>
    <p>時間：{{ $visit_datetime->time->format('H時i分') }}</p>
    <p>--------------------------
    <p>

    <p>以上、よろしくお願い致します。</p>

    <p class="sender">Care</p>
</body>

</html>