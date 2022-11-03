<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
</head>

<body>
    @if($pickup_flg)
        <p class="info__text">いつもお世話になっております。<br/>
            あと10分程でお迎えに伺います。<br/>
            よろしくお願い致します。<p>
    @else
        <p class="info__text">いつもお世話になっております。<br/>
            あと10分程で到着致します。<br/>
            よろしくお願い致します。<p>
    @endif

    <p class="content__ttl">詳細</p>
    <p class="top__partation">-------------------------</p>
    <p>利用者：{{ $care_receiver->name }}　様</p>
    <p>施設名：{{ $care_receiver->getNursingCareOfficeName() }}</p>
    <p>訪問日：{{ $care_receiver->getFormattedDate() }}</p>
    <p>--------------------------</p>

    <p class="sender">Care</p>
</body>

</html>