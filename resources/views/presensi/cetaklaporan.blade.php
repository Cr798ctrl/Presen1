<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Cetak Laporan</title>

    <!-- Normalize or reset CSS with your favorite library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

    <!-- Load paper.css for happy printing -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

    <!-- Set page size here: A5, A4 or A3 -->
    <style>
        @page {
            size: A3;
        }

        #title {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 18px;
            font-weight: bold;
        }

        .tabeldatakaryawan {
            margin-top: 10px;
        }

        .tabeldatakaryawan tr td {
            padding: 2px;
        }

        .tabelpresensi {
            width: 100%;
            margin-top: 1px;
            border-collapse: collapse;
        }

        .tabelpresensi tr th, .tabelpresensi tr td {
            border: 1px solid #131212;
            padding: 5px;
            font-size: 14px;
        }

        .tabelpresensi tr th {
            background-color: #dbdbdb;
        }

        .foto {
            width: 27px;
            height: 36px;
        }
        
        body.A4.Portrait .sheet { 
            width: 297mm !important; 
            height: auto !important; 
        }
    </style>
</head>

<body class="A3">
    <section class="sheet padding-10mm">
        <table style="width: 100%">
            <tr>
                <td style="width: 30px">
                    <img src="{{ asset('assets/img/OIP.jfif') }}" width="70" height="83" alt="">
                </td>
                <td>
                    <span id="title">
                        LAPORAN PRESENSI PEGAWAI<br>
                        PERIODE {{ strtoupper($namabulan[$bulan]) }} {{ $tahun }}<br>
                        SMK Negeri 2 Langsa<br>
                    </span>
                    <span><i>Jl. A. Yani, Kecamatan Langsa Baro, Kota Langsa, Aceh.</i></span>
                </td>
            </tr>
        </table>
        <table class="tabeldatakaryawan">
            <tr>
                <td rowspan="4">
                    @php
                        $path = Storage::url('uploads/karyawan/' . $karyawan->foto);
                    @endphp
                    <img src="{{ url($path) }}" alt="" width="72px" height="90">
                </td>
            </tr>
            <tr>
                <td>NIP/NPPPK</td>
                <td>:</td>
                <td>{{ $karyawan->nik }}</td>
            </tr>
            <tr>
                <td>Nama Pegawai</td>
                <td>:</td>
                <td>{{ $karyawan->nama_lengkap }}</td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td>:</td>
                <td>{{ $karyawan->jabatan }}</td>
            </tr>
        </table>
        <table class="tabelpresensi">
            <tr>
                <th>No.</th>
                <th>Tanggal</th>
                <th>Jam Masuk</th>
                <th>Foto</th>
                <th>Jam Pulang</th>
                <th>Foto</th>
                <th>Status</th>
                <th>Keterangan</th>
            </tr>

             @foreach ($presensi as $d)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ \Carbon\Carbon::parse($d->tgl_presensi)->translatedFormat('d F Y') }}</td>
                    <td>{{ $d->jam_in }}</td>
                    <td><img src="{{ url(Storage::url('uploads/absensi/' . $d->foto_in)) }}" alt="" class="foto"></td>
                    <td>{{ $d->jam_out ?? 'Belum Absen' }}</td>
                    <td><img src="{{ $d->jam_out ? url(Storage::url('uploads/absensi/' . $d->foto_out)) : asset('assets/img/camera.jpg') }}" alt="" class="foto"></td>
                    <td style="text-align: center">{{ $d->status }}</td>
                    <td>{{ $d->jam_in > $d->jam_masuk ? 'Terlambat ' . hitungjamterlambatdesimal($d->jam_masuk, $d->jam_in) . ' Jam' : 'Tepat Waktu' }}</td>
                </tr>
            @endforeach
        </table>

        <table width="100%" style="margin-top:20px">
            <tr>
                <td></td> </th>
                <th> <td></td> </th>
                <th><td></td></th>
                </td><td><th> <td></td> </th>
                <th> <td></td> </th>
                <th><td></td></th>
                </td><td><th> <td></td> </th>
                <th> <td></td> </th>
                <th><td></td></th>
                </td>
                <td><th>                <td colspan="2" style="text-align: left">
                    Mengetahui,<br>
                    Kepala Sekolah<br><br><br><br>
                    <u>JUARI, ST., S.Pd</u><br>
                    NIP. 196506051989021004
                </td> </th>
                <th> <td></td> </th>
                <th><td></td></th>
                </td> <td><th> <td></td> </th>
                <th> <td></td> </th>
                <th><td></td></th>
                </td><td><th> <td></td> </th>
                <th> <td></td> </th>
                <th><td></td></th>
                </td><td><th> <td></td> </th>
                <th> <td></td> </th>
                <th><td></td></th>
                </td><td><th> <td></td> </th>
                <th> <td></td> </th>
                <th><td></td></th>
                </td><td><th> <td></td> </th>
                <th> <td></td> </th>
                <th><td></td></th>
                </td><td><th> <td></td> </th>
                <th> <td></td> </th>
                <th><td></td></th>
                </td><td><th> <td></td> </th>
                <th> <td></td> </th>
                <th><td></td></th>
                </td><td><th> <td></td> </th>
                <th> <td></td> </th>
                <th><td></td></th>
                </td><td><th> <td></td> </th>
                <th> <td></td> </th>
                <th><td></td></th>
                </td><td><th> <td></td> </th>
                <th> <td></td> </th>
                <th><td></td></th>
                </td><td><th> <td></td> </th>
                <th> <td></td> </th>
                <th><td></td></th>
                </td><td><th> <td></td> </th>
                <th> <td></td> </th>
                <th><td></td></th>
                </td>
               <td colspan="2" style="text-align: left">
                    Langsa, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}<br>
                    Pegawai<br><br><br><br>
                    <u>{{ $karyawan->nama_lengkap }}</u><br>
                    NIP/NPPPK. {{ $karyawan->nik }}
                </td>
            </tr>
        </table>
    </section>
</body>
</html>