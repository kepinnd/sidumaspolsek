<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Surat Laporan Pengaduan - {{ $pengaduan->id }}</title>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; font-size: 12px; line-height: 1.6; color: #333; }
        .container { width: 100%; margin: 0 auto; padding: 20px; }
        .header { text-align: center; margin-bottom: 30px; }
        .header h1 { margin: 0; font-size: 18px; text-transform: uppercase; }
        .header h2 { margin: 5px 0; font-size: 16px; }
        .header p { margin: 0; font-size: 12px; }
        .content-table { width: 100%; margin-bottom: 20px; }
        .content-table td { padding: 5px 0; }
        .content-table .label { font-weight: bold; width: 180px; vertical-align: top; }
        .content-table .separator { width: 10px; vertical-align: top; }
        .isi-laporan { border: 1px solid #eee; padding: 10px; margin-top: 5px; background-color: #f9f9f9; white-space: pre-wrap; text-align: justify; }
        .footer { margin-top: 50px; }
        .footer .signature-block { margin-top: 60px; }
        .footer .signature-block .name { margin-top: 70px; font-weight: bold; }
        .left-block { float: left; width: 45%; }
        .right-block { float: right; width: 45%; text-align: center;}
        .clear { clear: both; }
        hr { border: 0; border-top: 1px solid #ccc; margin: 20px 0; }
        .logo { /* Jika ada logo, bisa ditambahkan style-nya di sini atau embed gambar */ }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>KEPOLISIAN SEKTOR CIKEUSAL</h1>
            <h2>RESOR POLRES SERANG DAERAH BANTEN</h2>
            <p>JL. Cikeusal, Telp. (021) XXXXXXX, Email: cikeusal@polri.go.id</p>
            <hr style="border-width: 1.5px; border-color: black; margin-top:10px;">
            <h3 style="text-align: center; margin-top:20px; text-decoration: underline;">SURAT TANDA BUKTI LAPORAN PENGADUAN</h3>
            <p style="text-align: center;">Nomor: STBLP/{{ $pengaduan->id }}/{{ $pengaduan->created_at->format('m/Y') }}/SPKT/POLSEK-CIKEUSAL</p>
        </div>

        <p>Yang bertanda tangan di bawah ini, Petugas SPKT Polsek Cikeusal, menerangkan bahwa pada:</p>
        <table class="content-table">
            <tr>
                <td class="label">Hari dan Tanggal</td>
                <td class="separator">:</td>
                <td>{{ $pengaduan->created_at->translatedFormat('l, d F Y') }}</td>
            </tr>
            <tr>
                <td class="label">Jam</td>
                <td class="separator">:</td>
                <td>{{ $pengaduan->created_at->format('H:i') }} WIB</td>
            </tr>
        </table>

        <p>Telah diterima laporan pengaduan dari seorang masyarakat:</p>
        <table class="content-table">
            <tr>
                <td class="label">Nama Lengkap</td>
                <td class="separator">:</td>
                <td>{{ $masyarakat->name }}</td>
            </tr>
            <tr>
                <td class="label">Nomor Induk Kependudukan (NIK)</td>
                <td class="separator">:</td>
                <td>{{ $masyarakat->nik }}</td>
            </tr>
            <tr>
                <td class="label">Alamat</td>
                <td class="separator">:</td>
                <td>{{ $masyarakat->alamat }}</td>
            </tr>
            <tr>
                <td class="label">Nomor Telepon</td>
                <td class="separator">:</td>
                <td>{{ $masyarakat->no_telp }}</td>
            </tr>
        </table>

        <p>Mengenai dugaan tindak kriminal sebagai berikut:</p>
        <table class="content-table">
            <tr>
                <td class="label">Judul Laporan</td>
                <td class="separator">:</td>
                <td>{{ $pengaduan->judul_laporan }}</td>
            </tr>
            <tr>
                <td class="label">Tanggal Pengaduan Dibuat</td>
                <td class="separator">:</td>
                <td>{{ $pengaduan->tgl_pengaduan->translatedFormat('d F Y') }}</td>
            </tr>
             <tr>
                <td class="label">Lokasi Kejadian Perkara</td>
                <td class="separator">:</td>
                <td>{{ $pengaduan->lokasi_kejadian }}</td>
            </tr>
            <tr>
                <td class="label" style="vertical-align: top;">Isi Laporan / Uraian Kejadian</td>
                <td class="separator" style="vertical-align: top;">:</td>
                <td style="vertical-align: top;">
                    <div class="isi-laporan">
                        {{ $pengaduan->isi_laporan }}
                    </div>
                </td>
            </tr>
            <tr>
                <td class="label">Status Pengaduan Saat Ini</td>
                <td class="separator">:</td>
                <td><strong>{{ ucfirst($pengaduan->status) }}</strong></td>
            </tr>
             @if($pengaduan->tanggapan)
            <tr>
                <td class="label" style="vertical-align: top;">Tanggapan / Tindak Lanjut Petugas</td>
                <td class="separator" style="vertical-align: top;">:</td>
                 <td style="vertical-align: top;">
                    <div class="isi-laporan" style="background-color: #e9f5ff;">
                         {{ $pengaduan->tanggapan }}
                         @if($pengaduan->petugas)
                         <br><em>(Ditangani oleh: {{ $pengaduan->petugas->name }})</em>
                         @endif
                    </div>
                </td>
            </tr>
            @endif
        </table>

        <p>Demikian Surat Tanda Bukti Laporan Pengaduan ini dibuat untuk dapat dipergunakan sebagaimana mestinya.</p>

        <div class="footer">
            <div class="left-block">
                <p style="text-align: center;">Pelapor,</p>
                <div class="signature-block" style="text-align: center;">
                    <p class="name">({{ $masyarakat->name }})</p>
                </div>
            </div>
            <div class="right-block">
                <p>Kota Serang, {{ $tanggal_cetak }}</p>
                <p>Petugas SPKT Polsek Cikeusal Yang Menerima,</p>
                 <div class="signature-block" style="text-align: center;">
                    <p class="name">
                        @if($pengaduan->petugas_id && $pengaduan->status != 'pending')
                            ({{ $pengaduan->petugas->name ?? '_____________________' }})
                            <br>
                            {{-- Jika ada Pangkat/NRP bisa ditambahkan --}}
                            {{-- PANGKAT / NRP. XXXXXX --}}
                        @else
                            (_____________________)
                            {{-- Belum ada petugas yang menangani atau masih pending --}}
                        @endif
                    </p>
                </div>
            </div>
            <div class="clear"></div>
        </div>
         <div style="text-align: center; margin-top: 50px; font-size:10px; color: #777;">
            Dokumen ini dicetak melalui Sistem Pengaduan Masyarakat Online Polsek Cikeusal pada tanggal {{ $tanggal_cetak }}.
        </div>
    </div>
</body>
</html>