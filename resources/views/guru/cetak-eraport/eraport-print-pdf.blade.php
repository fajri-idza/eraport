<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>E-Raport Siswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #000;
        }
        table {
            width: 100%;
            font-size: 10px;
            border-collapse: collapse;
            margin-bottom: 12px;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }
        .no-border td {
            border: none;
        }
        h2, h3 {
            text-align: center;
        }
        .section-title {
            margin-top: 20px;
            margin-bottom: 10px;
            font-weight: bold;
            text-align: left;
        }
    </style>
</head>
<body>

    <h2 style="line-height: 1.2; margin-bottom: 0;">LAPORAN HASIL BELAJAR</h2>
    <h2 style="line-height: 1.2; margin-top: 0;">(RAPOR)</h2>

<table class="no-border" style="margin-left: 15px;margin-right:15px;line-height:0.4;font-size:12px">
    <tr>
        <td style="width: 20%"><strong>Nama Peserta Didik</strong></td><td>: {{ $eraport->siswa->nama_peserta_didik }}</td>
        <td style="width: 6%"><strong>Kelas</strong></td><td>: {{ $eraport->kelas->nama_kelas }}</td>
    </tr>
    <tr>
        <td style="width: 6%"><strong>NISN</strong></td><td>: {{ $eraport->nisn }}</td>
        <td style="width: 6%"><strong>Fase</strong></td><td>: {{ $eraport->kelas->fase }}</td>
    </tr>
    <tr>
        <td><strong>Sekolah</strong></td><td>: {{ $kepsek->nama_sekolah }}</td>
        <td style="width: 6%"><strong>Semester</strong></td><td>: {{ $eraport->semester }}</td>
    </tr>
    <tr><td></td><td><td style="width: 20%"><strong>Tahun Pelajaran</strong></td><td>: {{ $eraport->tahun }}/{{ $eraport->tahun+1 }}</td></td></tr>
</table>

<table class="table table-bordered" style="font-size: 10px; padding: 1px">
    <thead>
        <tr>
            <th style="width: 3%">No</th>
            <th style="width: 25%">Muatan Pelajaran Pokok</th>
            <th style="width: 10%">KKM</th>
            <th style="width: 10%">Nilai Akhir</th>
            <th style="width: 10%">Predikat</th>
            <th style="width: 40%">Capaian Kompetensi</th>
        </tr>
    </thead>
    <tbody>
        @php
            $maxRows = 10;
            $headerMulokRow = 7; // baris ke-8
            $nomor = 1;
            $rowsUsed = 0;
        @endphp

        {{-- Tampilkan Pelajaran Pokok --}}
        @foreach($nilai as $index => $n)
            @if($rowsUsed == $headerMulokRow)
                {{-- Header Mulok di baris ke-7 --}}
                <tr>
                    <th style="width: 3%">No</th>
                    <th style="width: 25%">Muatan Pelajaran Mulok/Pilihan</th>
                       <th style="width: 10%">KKM</th>
                        <th style="width: 10%">Nilai Akhir</th>
                        <th style="width: 10%">Predikat</th>
                    <th style="width: 40%">Capaian Kompetensi</th>
                </tr>
                @php $rowsUsed++; @endphp
            @endif

            @if($rowsUsed < $maxRows)
                <tr>
                    <td>{{ $nomor++ }}</td>
                    <td>{{ $n->muatan->nama_muatan_pelajaran }}</td>
                     <td>{{ $n->muatan->kkm }}</td>
                    <td>{{ number_format($n->details->avg('nilai'), 2) }}</td>
                    <td>{{ $n->predikat() }}</td>
                    <td>{{ $n->capaianKompetensi() }}</td>
                </tr>
                @php $rowsUsed++; @endphp
            @endif
        @endforeach

        {{-- Jika sebelum baris ke-7, kita belum sampai, isi baris kosong sampai ke-7 --}}
        @while($rowsUsed < $headerMulokRow)
            <tr>
                <td>{{ $nomor++ }}</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            @php $rowsUsed++; @endphp
        @endwhile

        {{-- Header Mulok jika belum ditampilkan --}}
        @if($rowsUsed == $headerMulokRow)
            <tr>
                <th style="width: 3%">No</th>
                <th style="width: 25%">Muatan Pelajaran Mulok/Pilihan</th>
                   <th style="width: 10%">KKM</th>
                    <th style="width: 10%">Nilai Akhir</th>
                    <th style="width: 10%">Predikat</th>
                <th style="width: 40%">Capaian Kompetensi</th>
            </tr>
            @php $rowsUsed++; @endphp
        @endif

        {{-- Tampilkan max 2 data Mulok --}}
        @foreach($mulok as $i => $m)
            @if($rowsUsed < $maxRows)
                <tr>
                    <td>{{ $nomor++ }}</td>
                    <td>{{ $m->muatan->nama_muatan_pelajaran }}</td>
                    <td>{{ '75' }}</td>
                    <td>{{ number_format($m->details->avg('nilai'), 2) }}</td>
                    <td>{{ 'A' }}</td>
                    <td>{{ $m->muatan->capaian_kompetensi }}</td>
                </tr>
                @php $rowsUsed++; @endphp
            @endif
        @endforeach

        {{-- Tambah baris kosong jika kurang dari 9 --}}
        @while($rowsUsed < $maxRows)
            <tr>
                <td>{{ $nomor++ }}</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            @php $rowsUsed++; @endphp
        @endwhile
    </tbody>
</table>






<table>
    <thead>
        <tr>
            <th style="width: 3%;padding: 2px;">No</th>
            <th style="width: 25%;padding: 2px;">Ekstrakurikuler</th>
            <th style="width: 50%;padding: 2px;">Keterangan</th>
        </tr>
    </thead>
    <tbody>
        @foreach($eraport->ekstrakurikuler->take(2) as $key => $ekstra)
            <tr>
                <td style="padding: 2px; line-height: 1;">{{ $key+1 }}</td>
                <td style="padding: 2px; line-height: 1;">{{ $ekstra->nama_ekstrakurikuler }}</td>
                <td style="padding: 2px; line-height: 1;">{{ $ekstra->nilai }}</td>
            </tr>
        @endforeach

        <!-- Tampilkan row kosong jika data ekstrakurikuler kurang dari 2 -->
        @if ($eraport->ekstrakurikuler->count() < 2)
            <tr>
                <td style="padding: 2px; line-height: 1;">{{ $eraport->ekstrakurikuler->count() + 1 }}</td>
                <td style="padding: 2px; line-height: 1;"></td>
                <td style="padding: 2px; line-height: 1;"></td>
            </tr>
        @endif
    </tbody>
</table>

<table>
    <thead>
        <tr>
            <th style="width: 3%;padding: 2px;">No</th>
            <th style="width: 25%;padding: 2px;">Prestasi</th>
            <th style="width: 50%;padding: 2px;">Keterangan</th>
        </tr>
    </thead>
    <tbody>
        @foreach($eraport->prestasi->take(2) as $key => $ekstra)
            <tr>
                <td style="padding: 2px; line-height: 1;">{{ $key+1 }}</td>
                <td style="padding: 2px; line-height: 1;">{{ $ekstra->nama_prestasi }}</td>
                <td style="padding: 2px; line-height: 1;">{{ $ekstra->nilai }}</td>
            </tr>
        @endforeach

        <!-- Tampilkan row kosong jika data ekstrakurikuler kurang dari 2 -->
        @if ($eraport->prestasi->count() < 2)
            <tr>
                <td style="padding: 2px; line-height: 1;">{{ $eraport->prestasi->count() + 1 }}</td>
                <td style="padding: 2px; line-height: 1;"></td>
                <td style="padding: 2px; line-height: 1;"></td>
            </tr>
        @endif
    </tbody>
</table>

<table style="width: 50%; border-collapse: collapse; font-size: 10px;">
    <thead>
        <tr>
            <th colspan="3" style="text-align: center; border: 0.5px solid #000; padding: 2px;">Kehadiran</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style="width: 72%; border: 0.5px solid #000; padding: 2px; line-height: 1;">Sakit</td>
            <td style="border: 0.5px solid #000; padding: 2px; line-height: 1;">{{ $eraport->sakit }}</td>
            <td style="border: 0.5px solid #000; padding: 2px; line-height: 1;">Hari</td>
        </tr>
        <tr>
            <td style="width: 72%; border: 0.5px solid #000; padding: 2px; line-height: 1;">Izin</td>
            <td style="border: 0.5px solid #000; padding: 2px; line-height: 1;">{{ $eraport->izin }}</td>
            <td style="border: 0.5px solid #000; padding: 2px; line-height: 1;">Hari</td>
        </tr>
        <tr>
            <td style="width: 72%; border: 0.5px solid #000; padding: 2px; line-height: 1;">Tanpa Keterangan</td>
            <td style="border: 0.5px solid #000; padding: 2px; line-height: 1;">{{ $eraport->tanpa_keterangan }}</td>
            <td style="border: 0.5px solid #000; padding: 2px; line-height: 1;">Hari</td>
        </tr>
    </tbody>
</table>

{{-- <div class="section-title">C. Prestasi</div>
<table>
    <thead>
        <tr>
            <th>Prestasi</th>
            <th>Nilai</th>
        </tr>
    </thead>
    <tbody>
        @foreach($eraport->prestasi as $prestasi)
            <tr>
                <td>{{ $prestasi->nama_prestasi }}</td>
                <td>{{ $prestasi->nilai }}</td>
            </tr>
        @endforeach
    </tbody>
</table> --}}

<table>
    <tr>
        <td style="height: 40px;vertical-align: top;">Catatan : {{ $eraport->catatan }}</td>
    </tr>
</table>

@if($eraport->semester === 2)
<div style="width: 100%;">
    <div style="width: 60%; float: left;">
        <!-- Kosong atau isi jika perlu konten di kiri -->
    </div>
    <div style="width: 40%; float: right; text-align: right;">
        <table style="margin-left: auto;">
            <tr><td style="vertical-align: middle; padding: 0.5px 0;"><span style="margin-left: 5px">Berdasarkan hasil Capaian Pembelajaran</span></td></tr>
            <tr><td style="vertical-align: middle; padding: 0.5px 0;"> <span style="margin-left: 5px">dan penilaian akhir Semester I dan II.</span></td></tr>
            <tr><td style="vertical-align: middle; padding: 0.5px 0;"> <span style="margin-left: 5px">Ananda : {{$eraport->siswa->nama_peserta_didik}}</span></td></tr>
            <tr><td style="vertical-align: middle; padding: 0.5px 0;"><strong style="margin-left: 5px"> Naik ke Kelas :</strong> {{$eraport->naik_kelas}}</td></tr>
            <tr><td style="vertical-align: middle; padding: 0.5px 0;"><strong style="margin-left: 5px"> Tinggal di Kelas :</strong> {{$eraport->tinggal_kelas}}</td></tr>
        </table>
    </div>
</div>
@endif
<div style="clear: both;"></div>

<table class="no-border" style="width: 100%;font-size:12px">
    <tr>
        <td style="width: 40%; text-align: center;">
            Orang Tua/Wali
        </td>
        <td style="width: 40%; text-align: center;">
            Wali Kelas, {{ \Carbon\Carbon::parse($eraport->tanggal_cetak)->translatedFormat('j F Y') }}
        </td>
    </tr>
    <tr>
        <td style="height: 20px;"></td>
        <td style="height: 20px;"></td>
    </tr>
    <tr>
        <td style="text-align: center;">
            {{ $eraport->siswa->nama_orang_tua ?? $eraport->siswa->wali_peserta_didik  }}
        </td>
        <td style="text-align: center;">
            <p style="text-decoration: underline; margin-bottom: 0;">{{ $eraport->kelas->guru->nama }}</p>
            <p style="margin-top: 0;">NIP: {{ $eraport->kelas->guru->nip }}</p>
        </td>
    </tr>
</table>

<table class="no-border" style="width: 100%; margin-top: 40px;font-size:12px">
    <tr>
        <td style="text-align: center;">
            <p style="line-height:0.4">Mengetahui,</p>
            <p style="line-height:0.4">Kepala Sekolah</p>
            <br><br>
            <p style="text-decoration: underline; margin-bottom: 0;">{{ $kepsek->nama_kepala_sekolah }}</p>
            <p style="margin-top: 0;">NIP: {{ $kepsek->nip_kepala_sekolah }}</p>
        </td>
    </tr>
</table>
<script>
    window.onload = function () {
        window.print();
    };
</script>

</body>
</html>
