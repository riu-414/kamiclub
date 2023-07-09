@extends('layouts.layout')

@section('title')
    kamiclub
@endsection

@section('content')
    <div class="top-page d-flex flex-column justify-content-center align-items-center ">

        <img class="main-image" src="../images/main-image.jpg" alt="店の写真">

        <div class="content text-center">
            <p>新潟市西区にある美容室kamiclub</p>
            <p>完全予約、少人数の落ち着いたプライベートな空間で、癒しのサロンタイム体験</p>
            <p>M3D・G-UP縮毛矯正で圧倒的な仕上がりの差を実感。誰もがうらやむ輝く美髪へ</p>
            <p>その質と深さを、ぜひ一度ご体験ください</p>
        </div>

        <div class="container">
            <div class="item1">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3150.4206472581095!2d139.0020517763971!3d37.850446857796534!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x5ff4c73f9e39f9b3%3A0x3e8bf03bdf48b392!2z576O5a655a6ka2FtaWNsdWI!5e0!3m2!1sja!2sjp!4v1686666568386!5m2!1sja!2sjp" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

            <div class="item2 text-center">
                <p>~ ACCESS ~</p>
                <p>〒950-1115 新潟県新潟市西区鳥原2161-2
                <br>Tel : 025-333-8325
                <br>営業時間 : 9:00～18:00 土日祝 9:00～17:00
                <br>定休日 : 月曜日・第１火曜日・ 第3日曜日・月1日不定休
                <br>完全予約制
                </p>
                <a href="{{ route('user.register') }}" class="btn btn-secondary">このサイトから予約</a>
                <br>
                <a href="https://beauty.hotpepper.jp/slnH000061196/" class="btn btn-secondary">ホットペッパーから予約</a>
            </div>
        </div>

    </div>
@endsection
