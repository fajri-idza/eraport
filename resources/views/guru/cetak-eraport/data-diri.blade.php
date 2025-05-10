<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>eRapor</title>
    <style>
    @media print {
        .page-break {
            page-break-before: always;
        }
    }

    body {
        font-family: "Arial", sans-serif;
        margin: 0;
        padding: 0;
    }

    .a4 {
        padding: 20mm;
        box-sizing: border-box;
        width: 100%;
    }

    .cover {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .logo img {
        height: 120px;
    }

    h2, h3, p {
        text-align: center;
    }

    .nama-box, .nisn-box {
        border: 2px solid black;
        padding: 6px;
        text-align: center;
        width: 100%;
    }

    .nisn-box {
        width: 70%;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10mm;
    }

    table, th, td {
        border: 1px solid black;
    }

    th, td {
        padding: 5px;
         text-align: left;
        vertical-align: top; /* opsional agar teks sejajar atas */
        border: none;
        border-collapse: collapse;
        padding-left: 50px
    }
</style>
</head>
<body onload="window.print()">

    <!-- Halaman 1: Cover -->
    <div class="a4 cover">
        <div class="logo">
            <img src="{{ asset('img/tutwurihandayani.png') }}" alt="Logo">
        </div>
        <h2>RAPOR<br>PESERTA DIDIK<br>SEKOLAH DASAR <br>(SD)</h2>
        <h3>Nama Peserta Didik</h3>
        <div class="nama-box">
            <h2>{{ $siswa->nama_peserta_didik }}</h2>
        </div>
        <h3 style="margin-top: 20mm;">NISN / NIS</h3>
        <div class="nisn-box">
            <p>{{ $siswa->nisn }} / {{ $siswa->nis }}</p>
        </div>
        <h2 style="margin-top: 30mm;">KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN REPUBLIK INDONESIA</h2>
    </div>

    <!-- Pemisah halaman -->
    <div class="page-break"></div>

    <!-- Halaman 2: Data -->
    <div class="a4 cover">
        <h2>Identitas Peserta Didik</h2>
        <table style="text-align: left;border: none; border-collapse: collapse;">
            <tbody>
                <tr>
                    <td style="width: 40%">Nama Peserta Didik</td>
                    <td style="width: 5%">:</td>
                    <td style="width: 55%">{{ $siswa->nama_peserta_didik ?? '-' }}</td>
                </tr>
                 <tr>
                    <td style="width: 40%"></td>
                    <td style="width: 5%"></td>
                    <td style="width: 55%"></td>
                </tr>
                 <tr>
                    <td style="width: 40%">NISN/NIS</td>
                    <td style="width: 5%">:</td>
                    <td style="width: 55%">{{ $siswa->nisn ?? '-' }} / {{ $siswa->nis ?? '-' }}</td>
                </tr>
                 <tr>
                    <td style="width: 40%">Tempat, Tanggal lahir</td>
                    <td style="width: 5%">:</td>
                    <td style="width: 55%">{{ $siswa->tempat_lahir ?? '-' }}, {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->translatedFormat('j F Y') }}</td>
                </tr>
                 <tr>
                    <td style="width: 40%">Jenis Kelamin</td>
                    <td style="width: 5%">:</td>
                    <td style="width: 55%">{{ $siswa->jenis_kelamin ?? '-' }}</td>
                </tr>
                 <tr>
                    <td style="width: 40%">Agama</td>
                    <td style="width: 5%">:</td>
                    <td style="width: 55%">{{ $siswa->agama ?? '-' }}</td>
                </tr>
                 <tr>
                    <td style="width: 40%">Pendidikan Sebelumnya</td>
                    <td style="width: 5%">:</td>
                    <td style="width: 55%">{{ $siswa->pendidikan_sebelumnya ?? '-' }}</td>
                </tr>
                 <tr>
                    <td style="width: 40%">Alamat Peserta Didik</td>
                    <td style="width: 5%">:</td>
                    <td style="width: 55%">{{ $siswa->alamat_peserta_didik ?? '-' }}</td>
                </tr>
                 <tr>
                    <td style="width: 40%">Nama Orang Tua</td>
                    <td style="width: 5%">:</td>
                    <td style="width: 55%">{{ $siswa->nama_orang_tua ?? '-' }}</td>
                </tr>
                 <tr>
                    <td style="width: 40%">Alamat Orang Tua</td>
                    <td style="width: 5%">:</td>
                    <td style="width: 55%">{{ $siswa->alamat_orang_tua ?? '-' }}</td>
                </tr>
                   <tr>
                    <td style="width: 40%">Wali Peserta Didik</td>
                    <td style="width: 5%"></td>
                    <td style="width: 55%"></td>
                </tr>
                 <tr>
                    <td style="width: 40%">Nama</td>
                    <td style="width: 5%">:</td>
                    <td style="width: 55%">{{ $siswa->wali_peserta_didik ?? '-' }}</td>
                </tr>
                 <tr>
                    <td style="width: 40%">Alamat</td>
                    <td style="width: 5%">:</td>
                    <td style="width: 55%">{{ $siswa->alamat_wali_peserta_didik ?? '-' }}</td>
                </tr>
                 <tr>
                    <td style="width: 40%"></td>
                    <td style="width: 5%"></td>
                    <td style="width: 55%"></td>
                </tr>
                 <tr>
                    <td style="width: 40%"></td>
                    <td style="width: 5%"></td>
                    <td style="width: 55%"></td>
                </tr>
                 <tr>
                    <td style="width: 40%"></td>
                    <td style="width: 5%"></td>
                    <td style="width: 55%"></td>
                </tr>
                 <tr>
                    <td style="width: 40%"></td>
                    <td style="width: 5%"></td>
                    <td style="width: 55%">
                        <p>Bengkulu, {{ \Carbon\Carbon::parse($eraport->tanggal_cetak)->translatedFormat('j F Y') }}</p>
                        <p>Kepala Sekolah, <br><br><br><br><br>
                        <p style="text-decoration: underline; margin-bottom: 0;">{{ $kepsek->nama_kepala_sekolah }}</p>
                        <p style="margin-top: 0;">NIP {{ $kepsek->nip_kepala_sekolah }}</p></p></td>
                </tr>

                <!-- Tambahkan baris lain sesuai kebutuhan -->
            </tbody>
        </table>
    </div>

</body>
</html>
