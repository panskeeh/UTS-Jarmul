<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-image: url('back.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            min-height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        h1 {
            margin-top: 10px;
            color: #fff;
        }

        #center-layer {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            display: inline-block;
        }

        select#formatSelect, select, input[type="number"], button, input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
        }

        button {
            border: none;
            cursor: pointer;
            font-size: 16px;
            border-radius: 20px;
            padding: 12px 40px;
            margin-top: 10px;
        }

        img#outputImage {
            max-width: 100%;
            max-height: 100%;
            margin-top: 20px;
        }

        a#downloadLink {
            display: none;
            border: 2px solid #fff;
            border-radius: 20px;
            padding: 12px 40px;
            color: #000;
            background-color: #d3d3d3;
            text-decoration: none;
            margin-top: 10px;
        }

        a#backButton {
            display: block;
            margin-top: 20px;
            border: 2px solid #fff;
            border-radius: 20px;
            padding: 12px 40px;
            color: #000;
            background-color: #d3d3d3;
            text-decoration: none;
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 24px;
            }

            #center-layer {
                background-color: #fff;
                padding: 10px;
            }

            select#formatSelect, select, input[type="number"], button, input[type="text"] {
                width: 100%;
                padding: 10px;
                margin: 5px 0;
            }
        }
    </style>

    <title>Image Converter</title>
</head>
<body>
    <h1>▌║█║▌│║▌│║▌║▌█║Aan's CONVERTER ▌│║▌║▌│║║▌█║▌║█</h1>
    <div id="center-layer">
        <input type="file" id="imageInput" accept="image/*">
        <select id="formatSelect">
            <option value="image/jpeg">JPEG</option>
            <option value="image/png">PNG</option>
            <option value="image/webp">WebP</option>
        </select>
        <label for="widthInput">Lebar :</label>
        <input type="number" id="widthInput" value="300">
        <label for="heightInput">Tinggi :</label>
        <input type="number" id="heightInput" value="200">
        <label for="qualityInput">Kualitas (0-100):</label>
        <input type="number" id="qualityInput" value="10" min="0" max="100">
        <button onclick="convertImage()">Convert</button>
        <a id="downloadLink" style="padding: 12px 40px; border-radius: 20px; width: 93.5%;">Download</a>
        <a id="backButton" href="index.php">Kembali</a>
    </div>
    <img id="outputImage">

    <script>
        async function convertImage() {
            const imageInput = document.getElementById("imageInput");
            const formatSelect = document.getElementById("formatSelect");
            const outputImage = document.getElementById("outputImage");
            const widthInput = document.getElementById("widthInput");
            const heightInput = document.getElementById("heightInput");
            const qualityInput = document.getElementById("qualityInput");
            const downloadLink = document.getElementById("downloadLink");

            const selectedFormat = formatSelect.value;
            const targetWidth = parseInt(widthInput.value, 10);
            const targetHeight = parseInt(heightInput.value, 10);
            const targetQuality = parseInt(qualityInput.value, 10);

            if (imageInput.files.length > 0) {
                const file = imageInput.files[0];
                const dataUrl = await readDataUrl(file);
                const compressedImage = await compressAndChangeQuality(dataUrl, selectedFormat, targetWidth, targetHeight, targetQuality);

                outputImage.src = compressedImage;
                outputImage.style.display = "block";

                downloadLink.style.display = "block";
                downloadLink.href = compressedImage;
                downloadLink.download = "converted_image." + (selectedFormat === "image/webp" ? "webp" : selectedFormat.split("/")[1]);
            }
        }

        function readDataUrl(file) {
            return new Promise((resolve) => {
                const reader = new FileReader();
                reader.onload = (e) => {
                    resolve(e.target.result);
                };
                reader.readAsDataURL(file);
            });
        }

        async function compressAndChangeQuality(dataUrl, format, targetWidth, targetHeight, quality) {
            return new Promise(async (resolve) => {
                const img = new Image();
                img.src = dataUrl;
                img.onload = async () => {
                    const canvas = document.createElement('canvas');
                    const ctx = canvas.getContext('2d');

                    const aspectRatio = img.width / img.height;
                    let newWidth, newHeight;

                    if (aspectRatio > 1) {
                        newWidth = targetWidth;
                        newHeight = targetWidth / aspectRatio;
                    } else {
                        newHeight = targetHeight;
                        newWidth = targetHeight * aspectRatio;
                    }

                    canvas.width = newWidth;
                    canvas.height = newHeight;

                    ctx.drawImage(img, 0, 0, newWidth, newHeight);

                    let newDataUrl;

                    if (format === "image/webp") {
                        newDataUrl = canvas.toDataURL("image/webp", quality / 100);
                    } else if (format === "image/jpeg" || format === "image/png") {
                        // Pengaturan kualitas untuk JPEG dan PNG
                        newDataUrl = canvas.toDataURL(format, quality / 100);
                    } else {
                        newDataUrl = canvas.toDataURL(format);
                    }

                    resolve(newDataUrl);
                };
            });
        }
    </script>
</body>
</html>
