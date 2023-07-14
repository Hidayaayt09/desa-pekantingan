@extends('template')

@section('app_contents')
    <div class="row top_tiles">
        <div class="col-sm-12">
            <div class="alert bg-success text-white mb-3">
                <p style="font-size: 20px; margin-bottom: 0">Selamat Datang <b>{{ Session::get('penduduk') ? Session::get('penduduk')->nama : auth()->user()->name }}</b></p>
            </div>
        @if (!Session::get('penduduk'))
        <div class="animated flipInY col-md-6">
            <div class="tile-stats">
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <div class="count">{{ $penduduk }}</div>
                <a href="{{ url('admin/penduduk/tetap') }}">
                    <h3>Jumlah Penduduk</h3>
                </a>
            </div>
            @include('widget.galeri')
        </div>
        <div class="animated flipInY col-md-6">
            <div class="tile-stats">
                <div class="icon">
                    <i class="fa fa-envelope"></i>
                </div>
                <div class="count">{{ $surat }}</div>
                <a href="{{ url('admin/surat/skd') }}">
                <h3>Jumlah Permintaan Surat</h3>
            </div>
           
            @include('widget.berita')
        
        </div>
        @else
       
        <div class="col-lg-50">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-bold">Sejarah Desa Pekantingan</h5>
                    <p class="card-text">
                        <img src="{{ url('login/images/cerbon.png') }}" width="300" alt="" style="float: left">
                    <div align="justify">
                        Krimun berasal dari tentara prajurit Mataram yang berkerumun ditempat ini sambil
                        memakai sarung setelah sembahyang yaitu prajurit Mataram yang kalah perang
                        dengan kompeni pulang dari Batavia dalam menyusun
                        kekuatan baru dengan cara bergerilya, melawan didaerah ini.
    
    
                        Jadi Krimun berasal dari kata berkerumun sambil memakai sarang. Sedang kata
                        Kriya menurut kata Jawa Kuno yang berarti perbuatan yang suci. Jadi tempat
                        berkerumunnya orang – orang yang akan berbuat suci terhadap bangsa dan
                        negaranya. Sehingga tanah Sarang Wetan disebut tanah Jidah oleh Ki Wanakerti
                        yang termasuk Tanah Mataram sebelah Barat, sedangkan sebelah Barat kali Sewo
                        disebutnya Tanah Mataram, yaitu daerah yang akan dikuasai kompeni.
    
    
                        Hal ini mengakibatkan adat masyarakat Krimun merupakan larangan untuk naik haji
                        ke mekkah ditambah dengan disebabkannya waktu Ki Wanakerti naik haji disangka
                        meninggal, padalah nyimpet atau menyelinap di tanah Suci Jidah. Akhirnya orang
                        beranggapan, bahwa anak putunya (anak putu isun) besuk tidak perlu lagi naik
                        haji ke Jidah, sedang tanah Krimun sendiri sudah termasuk dan disebut tanah
                        jidah. Jadi cukup berpengalam oleh orang tua saja yang terdahulu, itulah
                        sebabnya adat istiadat yang masih ada dan berlaku sekarang. Ada pribahasa wong
                        tua gawe kawitan wong enom darma nglakini.
    
    
                        Lambang desa Krimun adalah Wayang Hanoman lambang seorang pahlawan yang hidup
                        mengabdikan diri kepada kebenaran, yang terpisah dari golongannya, diam ditempat
                        baru dari daerah yang masih termasuk Mataram.
                    </div>
                    </p>
                </div>
            </div>
            @include('widget.berita')
        </div>
        @include('widget.galeri')
        @endif
        </div>
    </div>
@endsection
