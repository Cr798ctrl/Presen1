@extends('layouts.presensi')
@section('content')
<style>
    body {
        background-color: #f5f7fa; /* Warna latar belakang yang lebih terang dan modern */
    }
    .logout {
        position: absolute;
        color: #616161; /* Warna ikon logout abu-abu gelap */
        font-size: 30px;
        text-decoration: none;
        right: 8px;
    }
    .logout:hover {
        color: #424242;
    }
    .card {
        background-color: #ffffff; /* Warna kartu putih bersih */
        box-shadow: 0 4px 8px rgba(0,0,0,0.1); /* Menambah bayangan lembut untuk kesan modern */
    }
    .gradasigreen {
        background: linear-gradient(45deg, #42A5F5, #1565C0); /* Gradasi biru yang elegan */
        color: white;
    }
    .gradasired {
        background: linear-gradient(45deg, #90A4AE, #546E7A); /* Gradasi abu-abu gelap yang profesional */
        color: white;
    }
    .green {
        color: #1976D2 !important; /* Warna biru tua untuk ikon profil */
    }
    .danger {
        color: #D32F2F !important; /* Warna merah marun untuk ikon cuti */
    }
    .warning {
        color: #689F38 !important; /* Warna hijau gelap untuk ikon histori */
    }
    .orange {
        color: #FBC02D !important; /* Warna emas gelap untuk ikon lokasi */
    }
    .badge-secondary {
        background-color: #424242 !important; /* Warna badge rekap presensi */
    }
    .text-primary-new {
        color: #5C6BC0 !important; /* Warna ungu untuk ikon hadir */
    }
    .text-success-new {
        color: #26A69A !important; /* Warna toska untuk ikon izin */
    }
    .text-warning-new {
        color: #FF9800 !important; /* Warna oranye untuk ikon sakit */
    }
    .text-info-new {
        color: #009688 !important; /* Warna hijau toska untuk ikon cuti */
    }
    .card-border-blue {
        border : 1px solid #90CAF9; /* Garis tepi kartu histori yang lebih lembut */
    }
    .text-late {
        color: #E57373; /* Warna merah muda untuk status terlambat */
    }
    .badge-square {
        position: absolute;
        top: 3px;
        right: 10px;
        font-size: 0.6rem;
        z-index: 999;
        background-color: #1a237e; /* Warna biru tua yang diminta */
        color: #fff;
        padding: 4px 6px;
        border-radius: 4px; /* Bentuk kotak bujur sangkar */
    }
    .card-recap-body {
        padding: 12px 12px !important;
        line-height: 0.8rem;
    }
    .avatar-leaderboard {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        object-fit: cover;
        cursor: pointer; /* Menambahkan pointer saat kursor mengarah ke foto */
    }
    /* Style untuk modal/pop-up */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.9);
    }
    .modal-content {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    .close {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
    }
    .close:hover,
    .close:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }
</style>
<div class="section" id="user-section">
    <a href="/proseslogout" class="logout">
        <ion-icon name="exit-outline"></ion-icon>
    </a>
    <div id="user-detail">
        <div class="avatar">
            @if (!empty(Auth::guard('karyawan')->user()->foto))
            @php
                $path = Storage::url('uploads/karyawan/' . Auth::guard('karyawan')->user()->foto);
            @endphp
            <img src="{{ url($path) }}" alt="avatar" class="imaged w64" style="height:60px">
            @else
            <img src="assets/img/sample/avatar/avatar1.jpg" alt="avatar" class="imaged w64 rounded">
            @endif
        </div>
        <div id="user-info">
            <h3 id="user-name">{{ Auth::guard('karyawan')->user()->nama_lengkap }}</h3>
            <span id="user-role">{{ Auth::guard('karyawan')->user()->jabatan }}</span>
            <span id="user-role">({{ $cabang->nama_cabang }})</span>
            <p style="margin-top: 15px">
                <span id="user-role">({{ $departemen->nama_dept }})</span>
            </p>
        </div>
    </div>
</div>

<div class="section" id="menu-section">
    <div class="card">
        <div class="card-body text-center">
            <div class="list-menu">
                <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a href="/editprofile" class="green" style="font-size: 40px;">
                            <ion-icon name="person-sharp"></ion-icon>
                        </a>
                    </div>
                    <div class="menu-name">
                        <span class="text-center">Profil</span>
                    </div>
                </div>
                <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a href="/presensi/izin" class="danger" style="font-size: 40px;">
                            <ion-icon name="calendar-number"></ion-icon>
                        </a>
                    </div>
                    <div class="menu-name">
                        <span class="text-center">Cuti</span>
                    </div>
                </div>
                <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a href="/presensi/histori" class="warning" style="font-size: 40px;">
                            <ion-icon name="document-text"></ion-icon>
                        </a>
                    </div>
                    <div class="menu-name">
                        <span class="text-center">Histori</span>
                    </div>
                </div>
                <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a href="" class="orange" style="font-size: 40px;">
                            <ion-icon name="location"></ion-icon>
                        </a>
                    </div>
                    <div class="menu-name">
                        Lokasi
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="section mt-2" id="presence-section">
    <div class="todaypresence">
        <div class="row">
            <div class="col-6">
                <div class="card gradasigreen">
                    <div class="card-body">
                        <div class="presencecontent">
                            <div class="iconpresence">
                                @if ($presensihariini != null)
                                    @if ($presensihariini->foto_in != null)
                                        @php
                                            $path = Storage::url('uploads/absensi/' . $presensihariini->foto_in);
                                        @endphp
                                        <img src="{{ url($path) }}" alt="" class="imaged w48">
                                    @else
                                        <ion-icon name="camera"></ion-icon>
                                    @endif
                                @else
                                    <ion-icon name="camera"></ion-icon>
                                @endif
                            </div>
                            <div class="presencedetail">
                                <h4 class="presencetitle">Masuk</h4>
                                <span>{{ $presensihariini != null ? $presensihariini->jam_in : 'Belum Absen' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card gradasired">
                    <div class="card-body">
                        <div class="presencecontent">
                            <div class="iconpresence">
                                @if ($presensihariini != null && $presensihariini->jam_out != null)
                                    @if ($presensihariini->foto_out != null)
                                        @php
                                            $path = Storage::url('uploads/absensi/' . $presensihariini->foto_out);
                                        @endphp
                                        <img src="{{ url($path) }}" alt="" class="imaged w48">
                                    @else
                                        <ion-icon name="camera"></ion-icon>
                                    @endif
                                @else
                                    <ion-icon name="camera"></ion-icon>
                                @endif
                            </div>
                            <div class="presencedetail">
                                <h4 class="presencetitle">Pulang</h4>
                                <span>{{ $presensihariini != null && $presensihariini->jam_out != null ? $presensihariini->jam_out : 'Belum Absen' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="rekappresensi">
        <h3>Rekap Presensi Bulan {{ $namabulan[$bulanini] }} Tahun {{ $tahunini }}</h3>
        <div class="row">
            <div class="col-3">
                <div class="card">
                    <div class="card-body text-center card-recap-body">
                        <span class="badge-square">{{ $rekappresensi->jmlhadir }}</span>
                        <ion-icon name="accessibility-outline" style="font-size: 1.6rem;"
                            class="text-primary-new mb-1"></ion-icon>
                        <br>
                        <span style="font-size: 0.8rem; font-weight:500">Hadir</span>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body text-center card-recap-body">
                        <span class="badge-square">
                            {{ $rekappresensi->jmlizin }}
                        </span>
                        <ion-icon name="newspaper-outline" style="font-size: 1.6rem;"
                            class="text-success-new mb-1"></ion-icon>
                        <br>
                        <span style="font-size: 0.8rem; font-weight:500">Izin</span>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body text-center card-recap-body">
                        <span class="badge-square">
                            {{ $rekappresensi->jmlsakit }}</span>
                        <ion-icon name="medkit-outline" style="font-size: 1.6rem;"
                            class="text-warning-new mb-1"></ion-icon>
                        <br>
                        <span style="font-size: 0.8rem; font-weight:500">Sakit</span>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body text-center card-recap-body">
                        <span class="badge-square">
                            {{ $rekappresensi->jmlcuti }}
                        </span>
                        <ion-icon name="document-outline" style="font-size: 1.6rem;"
                            class="text-info-new mb-1"></ion-icon>
                        <br>
                        <span style="font-size: 0.8rem; font-weight:500">Cuti</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="presencetab mt-2">
        <div class="tab-pane fade show active" id="pilled" role="tabpanel">
            <ul class="nav nav-tabs style1" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#home" role="tab">
                        Bulan Ini
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#profile" role="tab">
                        Leaderboard
                    </a>
                </li>
            </ul>
        </div>
        <div class="tab-content mt-2" style="margin-bottom:100px;">
            <div class="tab-pane fade show active" id="home" role="tabpanel">
                @foreach ($historibulanini as $d)
                    @if ($d->status == 'h')
                        <div class="card mb-1 card-border-blue">
                            <div class="card-body">
                                <div class="historicontent">
                                    <div class="iconpresensi">
                                        <ion-icon name="finger-print-outline" style="font-size: 48px;"
                                            class="text-success-new"></ion-icon>
                                    </div>
                                    <div class="datapresensi">
                                        <h3 style="line-height: 3px">{{ $d->nama_jam_kerja }}</h3>
                                        <h4 style="margin:0px !important">
                                            {{ date('d-m-Y', strtotime($d->tgl_presensi)) }}</h4>
                                        <span style="color:green">{{ date('H:i', strtotime($d->jam_masuk)) }} -
                                            {{ date('H:i', strtotime($d->jam_pulang)) }}</span>
                                        <br>
                                        <span>
                                            {!! $d->jam_in != null ? date('H:i', strtotime($d->jam_in)) : '<span class="text-danger">Belum Scan</span>' !!}
                                        </span>
                                        <span>
                                            {!! $d->jam_out != null
                                                ? '-' . date('H:i', strtotime($d->jam_out))
                                                : '<span class="text-danger">- Belum Scan</span>' !!}
                                        </span>
                                        <br>
                                        @php
                                            //Jam Ketika dia Absen
                                            $jam_in = date('H:i', strtotime($d->jam_in));
                                            //Jam Jadwal Masuk
                                            $jam_masuk = date('H:i', strtotime($d->jam_masuk));
                                            $jadwal_jam_masuk = $d->tgl_presensi . ' ' . $jam_masuk;
                                            $jam_presensi = $d->tgl_presensi . ' ' . $jam_in;
                                        @endphp
                                        @if ($jam_in > $jam_masuk)
                                            @php
                                                $jmlterlambat = hitungjamterlambat($jadwal_jam_masuk, $jam_presensi);
                                                $jmlterlambatdesimal = hitungjamterlambatdesimal($jadwal_jam_masuk, $jam_presensi);
                                            @endphp
                                            <span class="text-late">Terlambat {{ $jmlterlambat }}
                                                ({{ $jmlterlambatdesimal }} Jam)
                                            </span>
                                        @else
                                            <span style="color:green">Tepat Waktu</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif($d->status == 'i')
                        <div class="card mb-1">
                            <div class="card-body">
                                <div class="historicontent">
                                    <div class="iconpresensi">
                                        <ion-icon name="document-outline" style="font-size: 48px;"
                                            class="text-warning-new"></ion-icon>
                                    </div>
                                    <div class="datapresensi">
                                        <h3 style="line-height: 3px">IZIN - {{ $d->kode_izin }}</h3>
                                        <h4 style="margin:0px !important">
                                            {{ date('d-m-Y', strtotime($d->tgl_presensi)) }}</h4>
                                        <span>
                                            {{ $d->keterangan }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif($d->status == 's')
                        <div class="card mb-1">
                            <div class="card-body">
                                <div class="historicontent">
                                    <div class="iconpresensi">
                                        <ion-icon name="medkit-outline" style="font-size: 48px;"
                                            class="text-primary-new"></ion-icon>
                                    </div>
                                    <div class="datapresensi">
                                        <h3 style="line-height: 3px">SAKIT - {{ $d->kode_izin }}</h3>
                                        <h4 style="margin:0px !important">
                                            {{ date('d-m-Y', strtotime($d->tgl_presensi)) }}</h4>
                                        <span>
                                            {{ $d->keterangan }}
                                        </span>
                                        <br>
                                        @if (!empty($d->doc_sid))
                                            <span style="color: blue">
                                                <ion-icon name="document-attach-outline"></ion-icon> SID
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif($d->status == 'c')
                        <div class="card mb-1">
                            <div class="card-body">
                                <div class="historicontent">
                                    <div class="iconpresensi">
                                        <ion-icon name="document-outline" style="font-size: 48px;"
                                            class="text-info-new"></ion-icon>
                                    </div>
                                    <div class="datapresensi">
                                        <h3 style="line-height: 3px">CUTI - {{ $d->kode_izin }}</h3>
                                        <h4 style="margin:0px !important">
                                            {{ date('d-m-Y', strtotime($d->tgl_presensi)) }}</h4>
                                        <span class="text-info">
                                            {{ $d->nama_cuti }}
                                        </span>
                                        <br>
                                        <span>
                                            {{ $d->keterangan }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel">
                <ul class="listview image-listview">
                    @foreach ($leaderboard as $d)
                        <li>
                            <div class="item">
                                @php
                                    $fotoInPath = !empty($d->foto_in) ? Storage::url('uploads/absensi/' . $d->foto_in) : 'assets/img/sample/avatar/avatar1.jpg';
                                    $fotoKaryawanPath = !empty($d->foto) ? Storage::url('uploads/karyawan/' . $d->foto) : 'assets/img/sample/avatar/avatar1.jpg';
                                @endphp
                                <img src="{{ url($fotoKaryawanPath) }}" alt="image" class="image avatar-leaderboard" data-fotoin="{{ url($fotoInPath) }}">
                                <div class="in">
                                    <div>
                                        <b>{{ $d->nama_lengkap }}</b><br>
                                        <small class="text-muted">{{ $d->jabatan }}</small>
                                    </div>
                                    <span class="badge {{ $d->jam_in < '07:30' ? 'bg-success' : 'bg-danger' }}">
                                        {{ $d->jam_in }}
                                    </span>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

<div id="myModal" class="modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="img01">
</div>

@endsection

@push('myscript')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var modal = document.getElementById("myModal");
        var modalImg = document.getElementById("img01");
        var closeBtn = document.getElementsByClassName("close")[0];
        
        var images = document.querySelectorAll('.avatar-leaderboard');
        images.forEach(function(img) {
            img.onclick = function() {
                var fotoInUrl = this.getAttribute('data-fotoin');
                if (fotoInUrl) {
                    modal.style.display = "block";
                    modalImg.src = fotoInUrl;
                } else {
                    alert('Foto presensi tidak tersedia.');
                }
            }
        });

        closeBtn.onclick = function() { 
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    });
</script>
@endpush