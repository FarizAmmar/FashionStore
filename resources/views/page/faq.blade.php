@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row bg-primer">
        <div class="col-12">
            <h5 class="display-2 pt-5 d-flex justify-content-center">
                <b>FAQ</b>
            </h5>
            <h5 class="pb-5 d-flex justify-content-center">
                Butuh jawaban? Temukan jawaban anda disini.....
            </h5>
        </div>
    </div>
    <div class="row mt-5 pt-3 mb-5 justify-content-center">
        <div class="col-6">
            <div class="accordion" id="accordionPanelsStayOpenExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                        <button class="accordion-button collapsed show" type="button" data-bs-toggle="collapse"
                            data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="false"
                            aria-controls="panelsStayOpen-collapseOne">
                            1. Apa itu toko jahit <span style="font-weight: 900">Mama Abil</span> collection ?
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
                        aria-labelledby="panelsStayOpen-headingOne" style="">
                        <div class="accordion-body">
                            Toko jahit berbasis website yang menjual produk-produk jahitan melalui platform online,
                            seperti website atau aplikasi mobile. Konsumen dapat memesan produk pakaian dengan sistem
                            pre order dan menampilkan bebrapa informasi jenis-jenis kain yang cocok untuk dibuat
                            pakaian.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                            aria-controls="panelsStayOpen-collapseTwo">
                            2. Apa saja produk yang biasanya dijual di toko jahit berbasis website?
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse"
                        aria-labelledby="panelsStayOpen-headingTwo" style="">
                        <div class="accordion-body">
                            Produk-produk yang biasanya dijual di toko jahit berbasis website antara lain pakaian dengan
                            banyak model dan juga celana.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false"
                            aria-controls="panelsStayOpen-collapseThree">
                            3. Apakah toko jahit berbasis website memiliki jaminan kualitas produk?
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse"
                        aria-labelledby="panelsStayOpen-headingThree">
                        <div class="accordion-body">
                            Toko jahit berbasis website biasanya memberikan jaminan kualitas produk, seperti produk yang
                            dikirimkan sesuai dengan deskripsi, kondisi barang yang baik, dan garansi pembelian jika
                            ukuran kurang sesuai.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection