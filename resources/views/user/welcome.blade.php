@extends('layouts.layout')

@section('title')
    kamiclub
@endsection

@section('content')
    <div class="top-page d-flex flex-column justify-content-center align-items-center ">

        <img class="main-image" src="../images/main-image.jpg" alt="店の写真">

        <div class="content text-center">
            <p>新潟市西区にある美容室kamiclub(カミクラブ)</p>
            <p>丁寧で確かな技術店内は「癒し」をテーマにしたくつろぎの異空間</p>
            <p>完全予約、マンツーマン対応の大人のプライベートサロンです</p>
            <p>その質と深さを、ぜひ一度ご体験ください</p>
        </div>

        <div class="container">
            <div class="item1">
                <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d787.5940821925617!2d139.002868269649!3d37.85148405718964!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMzfCsDUxJzA1LjMiTiAxMznCsDAwJzEyLjYiRQ!5e0!3m2!1sja!2sjp!4v1686583933041!5m2!1sja!2sjp" width="450" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

            <div class="item2 text-center">
                <p>~ ACCESS ~</p>
                <p>〒123-4567 新潟市西区○○○○1-2-3
                <br>Tel : 123-456-789
                <br>営業時間 : 9:00～18:00 土日祝 9:00～18:00
                <br>定休日 : 月曜日 第3日曜日
                <br>完全予約制
                </p>
                <a href="{{ route('user.register') }}" class="btn btn-success">無料で登録して予約する</a>
            </div>
        </div>

    </div>
@endsection
