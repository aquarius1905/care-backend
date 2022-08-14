<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <style>
        .destination,
        .info-text {
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
    <p class="destination">{{ $care_receiver->getKeyPersonName() }}&emsp;様</p>

    <p class="info-text">いつもお世話にになっております。<br>
        次回のケアマネージャー訪問日時をお知らせ致します。
    <p>

    <p class="content-ttl">訪問日時</p>
    <p class="top-partation">-------------------------</p>
    <p>被介護者：{{ $care_receiver->name }}　様</p>
    <p>担当ケアマネージャー：{{ $care_receiver->getCareManagerName() }}</p>
    <p>訪問日：{{ $care_receiver->getVisitDate()->format('Y年m月d日') }}</p>
    <p>時間：{{ $care_receiver->getVisitTime()->format('H時i分') }}</p>
    <p>--------------------------</p>

    <p>ご都合が悪くなった場合は、担当ケアマネージャーにご連絡ください。</p>
    <p>以上、よろしくお願い致します。</p>

    <p class="sender">Care</p>
</body>

</html>