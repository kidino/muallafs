<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Akuan Memeluk Islam</title>
    <style>
        body { margin: 0px; padding: 0px; background-color: #ccc;
            font-family: helvetica, arial, sans-serif;
        }
        body * { box-sizing: border-box; margin: 0px; padding: 0px; }
        .container {
            width: 210mm; height: 297mm;
            margin: auto;
            background-color: #fff;
            padding-top: 13mm;
            position: relative;
        }

        #photo {
            position: absolute;
            width: 35mm;
            height: auto;
            right: 20mm; top: 72mm;
            padding: 1mm; border: 0.1mm solid #000;
        }

        h1 { 
            text-transform: uppercase; 
            font-size: 14pt;
            text-align: center;
            margin-bottom: 1mm;
        }

        h3 { 
            font-weight: normal; font-size: 11pt; 
            text-align: center; 
            line-height: 14pt;
        }

        #title {
            border: 1mm solid #000;
            padding: 2mm;
            text-align: center; width: 90mm; margin: auto; margin-top:5mm;
            text-transform: uppercase;
        }

        #logo { display: block; width: 25mm; height: auto; 
        margin: auto; margin-bottom: 5mm; }

        .form-label, .form-label-1, .form-label-2, .form-label-3, .form-label-4 {
            font-weight: bold; font-size: 11pt; 
            position: relative; margin-top: 3mm; margin-left: 20mm; 
        }

        .form-label-1, .form-label-2, .form-label-3, .form-label-4 {
            margin-bottom: 4mm;
        }

        .form-input { font-size: 11pt; border-bottom: 1pt dotted #000; 
            padding: 1pt 3pt; 
            position: absolute; left: 15mm; width: 30mm; font-weight: normal;
        }

        .form-input-1 { font-size: 11pt; border-bottom: 1pt dotted #000; 
            padding: 1pt 3pt; 
            position: absolute; left: 40mm; width: 130mm; 
            font-weight: normal; font-size: 12pt;
        }

        .form-input-2 { font-size: 11pt; border-bottom: 1pt dotted #000; 
            padding: 1pt 3pt; 
            position: absolute; left: 40mm; width: 40mm; 
            font-weight: normal; font-size: 12pt;
        }

        .form-label-3 { 
            margin-top: -8mm; margin-left: 105mm;
        }
        .form-input-3 { font-size: 11pt; border-bottom: 1pt dotted #000; 
            padding: 1pt 3pt; 
            position: absolute; left: 20mm; width: 65mm; 
            font-weight: normal; font-size: 12pt;
        }

        .form-label-4 { 
            margin-top: -8mm; margin-left: 105mm;
        }
        .form-input-4 { font-size: 11pt; border-bottom: 1pt dotted #000; 
            padding: 1pt 3pt; 
            position: absolute; left: 40mm; width: 45mm; 
            font-weight: normal; font-size: 12pt;
        }

        .form-input-5 { font-size: 11pt; border-bottom: 1pt dotted #000; 
            padding: 1pt 3pt; 
            position: absolute; left: 40mm; width: 130mm; top: -1mm;
            font-weight: normal; font-size: 12pt; 
        }

        .form-input-5 .text {
            line-height: 24pt;
            overflow: visible;
            margin-top: -10mm;
            position: absolute; top: 9mm;
        }

        .form-input-6 { font-size: 11pt; border-bottom: 1pt dotted #000; 
            padding: 1pt 3pt; 
            position: absolute; left: 40mm; width: 130mm; 
            font-weight: normal; font-size: 12pt; height: 5.5mm;
        }


        .form-input-1::before, 
        .form-input-2::before, 
        .form-input-4::before, 
        .form-input-3::before { 
            content: ": "; font-size: 12pt; font-weight: bold; 
            margin-left: -3mm; margin-right: 5px;
        }

        .form-input-5::before { 
            content: ": "; font-size: 12pt; font-weight: bold; 
            margin-left: -3mm; margin-right: 5px; margin-bottom: 10mm;
        }


        .form-input-1, 
        .form-input-2, 
        .form-input-4, 
        .form-input-3 { 
            margin-top: -1mm;
        }

        .space-top { margin-top: 10mm; }
        .space-top-1 { margin-top: 15mm; }

        #perhatian {
            margin-left: 20mm;
            margin-top: 20mm; margin-bottom: 3mm;
        }

        ol#notice {
            margin-left: 20mm;
            margin-right: 20mm;
        }

        ol#notice li {
            margin-left: 10mm; padding-left: 1mm;
            margin-bottom: 2mm; font-size: 11pt; line-height: 1.5em;
        }

        #pegawai, #memeluk {
            margin-top: 5mm; font-size: 11pt;
            width: 50mm; border-top: 0.2mm dotted #000;
            text-align: center; position: absolute;
            padding-top: 2mm;
        }
        #pegawai {
            left: 20mm;
            bottom: 25mm
        }
        #memeluk { 
            right: 20mm;
            bottom: 25mm;
        }


    </style>

</head>
<body>
    
    <div class="container">
        <img src="/assets/img/perkim_logo.png" id="logo" alt="">
        <h1>Pertubuhan Kebajikan Islam Malaysia (PERKIM)<br>BAHAGIAN NEGERI SELANOR</h1>
        <h3>Masjid Sultan Salahuddin Abdul Aziz Shah, Persiaran Masjid, 40000 Shah Alam.</h3>
        <h3>Tel : 03-5512 1450 &nbsp; &nbsp; &nbsp; Fax : 03-5512 1420</h3>
        <h4 id="title">Surat Akuan<br>Memeluk Agama Islam Sementara</h4>

        <img id="photo" src="{{$muallaf->foto}}" alt="">

        <p class="form-label space-top">Bil : <span class="form-input">{{$muallaf->no_siri}}</span></p>
        <p class="form-label">Tarikh : <span class="form-input">{{date('j/n/Y')}}</span></p>

        <p class="form-label-1 space-top-1">Nama Asal <span class="form-input-1">{{$muallaf->nama_asal}}</span></p>
        <p class="form-label-1">Nama Islam <span class="form-input-1">{{$muallaf->nama_islam}}</span></p>
        <p class="form-label-1">No. KP/Passport <span class="form-input-1">{{$muallaf->kp_passport}}</span></p>
        <p class="form-label-2">Jantina <span class="form-input-2">{{$muallaf->jantina}}</span></p>

        <p class="form-label-3">Bangsa <span class="form-input-3">{{$muallaf->bangsa}}</span></p>

        <p class="form-label-2">Tarikh Lahir <span class="form-input-2">{{$muallaf->tarikh_lahir}}</span></p>

        <p class="form-label-4">Tarikh Masuk Islam <span class="form-input-4">{{$muallaf->tarikh_islam}}</span></p>


        <p class="form-label-2">No. Telefon <span class="form-input-2">{{$muallaf->no_telefon}}</span></p>

        <p class="form-label-3">E-mail <span class="form-input-3">{{$muallaf->email}}</span></p>

        <p class="form-label-1">Alamat Tempat<br>Tinggal 
            <span class="form-input-5">
                <span class="text">
                {{$muallaf->alamat}}
                </span>
            </span><br>
            <span class="form-input-6"></span>
            </p>


        <p id="perhatian"><strong>PERHATIAN</strong></p>
        <ol id="notice">
            <li>Surat akuan ini adalah untuk sementara sahaja sehingga kad akuan memeluk agama Islam dikeluarkan oleh Jabatan Agama Islam Negeri.</li>
            <li>Sebarang pertanyaan sila hubung PERKIM Bahagian Negeri Selangor mmelalui nombor telefon: 03-5512 1450 atau fax: 03-5512 1420.</li>
        </ol>


        <div id="pegawai">
            Tandatangan Pegawai<br>Yang Mengislamkan
        </div>

        <div id="memeluk">
            Tandatangan Yang<br>Memeluk Agama Islam
        </div>


    </div>

</body>
</html>