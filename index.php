<!DOCTYPE html>
<html>
<head>
    <!-- CSS dan JavaScript lainnya -->
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-image: url('back.jpg'); /* Ganti 'background.jpg' dengan nama file gambar Anda */
            background-size: cover; /* Untuk mengisi seluruh area background */
            background-repeat: no-repeat; /* Agar gambar tidak diulang */
            background-color: #007BFF;

        }

        h1 {
            margin-top: 10px;
            color: #fff;
        }

        h2 {
            margin-top: 20px;
            color: #fff;
        }

        select#channelSelect {
            width: 200px;
            height: 30px;
            font-size: 14px;
        }

        #controls {
            margin-top: 10px;
        }

        #nextButton,
        #prevButton {
            margin: 0 10px;
        }

        select {
            width: 100%;
            padding: 5px;
        }

        button {
            padding: 10px 20px;
            background-color: #fff;
            border: none;
            color: #000;
            cursor: pointer;
            border-radius: 20px; /* Tombol menjadi rounded */
        }

        

        @media (max-width: 768px) {
            h1 {
                font-size: 24px;
            }

            h2 {
                font-size: 18px;
            }

            select#channelSelect {
                width: 150px;
            }
        }
    </style>
</head>
<body>
    <h1> ▌║█║▌│║▌│║▌║▌█║Aan's UNDERGROUND ▌│║▌║▌│║║▌█║▌║█</h1>

    <!-- Gantikan tautan dengan tombol untuk program radio dan program convert -->
    <h2> ▌║█║▌│║▌│║▌║▌█║Pilih Program : ▌│║▌║▌│║║▌█║▌║█</h2>
    <button onclick="window.location.href = 'radio.php';">Program Radio</button>
    <button onclick="window.location.href = 'converter.php';">Program Convert</button>

</body>
</html>
