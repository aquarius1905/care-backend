<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
    <p>利用者：{{ $care_receiver_name }}<span class="title">様</span></p>
    <p>施設名：{{ $nursing_care_office_name }}</p>
    <p>--------------------------</p>

    <p class="sender">Care</p>
</body>

</html>