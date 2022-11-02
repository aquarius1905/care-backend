<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <p class="info__text">ご家庭での状況が更新されました。</p>

    <p class="content__ttl">更新内容</p>
    <p class="top__partation">-------------------------</p>
    <p>被介護者：{{ $diary->getCareReceiverName() }}<span class="title">様</span></p>
    <p>日誌の日付：{{ $diary->getFormattedDate() }}</p>
    <p>ご家庭での状況：{{ $diary->situation_at_home }}</p>
    <p>--------------------------</p>

    <p class="sender">Care</p>
</body>

</html>