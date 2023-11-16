<?php
// Koneksi ke database (ganti dengan informasi koneksi yang sesuai)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aanradio";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check koneksi
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}

// Menambahkan channel
if (isset($_POST['addChannel'])) {
    $name = $_POST['channelName'];
    $link = $_POST['channelLink'];
    $sql = "INSERT INTO channels (name, link) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $name, $link);
    $stmt->execute();
}

// Menghapus channel
if (isset($_POST['deleteChannel'])) {
    $channelLink = $_POST['selectedChannel']; // Mengambil link channel dari POST data
    $sql = "DELETE FROM channels WHERE link = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $channelLink);
    if ($stmt->execute() === TRUE) {
        // Jika penghapusan berhasil
        header("Location: " . $_SERVER['PHP_SELF']); // Redirect kembali ke halaman ini
    } else {
        echo "Error: " . $stmt->error;
    }
}

// Mengambil daftar channel dari database
$sql = "SELECT * FROM channels";
$result = $conn->query($sql);
$channels = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $channels[] = $row;
    }
}

// Tutup koneksi ke database
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
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
        #prevButton,
        #backButton,
        button {
            margin: 10px;
            padding: 10px 20px;
            background-color: #fff;
            border: none;
            color: #000; /* Mengubah warna teks menjadi hitam */
            cursor: pointer;
            border-radius: 20px; /* Tombol menjadi rounded */
        }

        
        select {
            width: 100%;
            padding: 5px;
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

    <!-- Tambahkan script hls.js -->
    <script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
</head>
<body>
    <h1> ▌║█║▌│║▌│║▌║▌█║Aan's UNDERGROUND RADIO▌│║▌║▌│║║▌█║▌║█</h1>
    
    <!-- Form untuk menambahkan channel -->
    <form method="post">
        <input type="text" name="channelName" placeholder="Nama Channel" required>
        <br>
        <input type="text" name="channelLink" placeholder="Link Channel" required>
        <br>
        <button type="submit" name="addChannel">Tambah Channel</button>
    </form>

    
    <!-- Daftar channel dari database -->
    <audio id="audioPlayer" controls></audio>
    
    <!-- Seleksi channel dropdown -->
    <h2> ▌║█║▌│║▌│║▌║▌█║Pilih Channel : ▌│║▌║▌│║║▌█║▌║█</h2>
    <form method="post">
        <select name="selectedChannel" style="width: 150px;">
            <?php foreach ($channels as $channel): ?>
                <option value="<?php echo $channel['link']; ?>"><?php echo $channel['name']; ?></option>
                <?php endforeach; ?>
            </select>
            <input type="submit" name="deleteChannel" value="Hapus">
        </form>
        
        <div id="controls">
            <button id="prevButton">Previous</button>
            <button id="nextButton">Next</button>
            <br><br>
            <!-- Tombol kembali ke index.php -->
            <a id="backButton" href="index.php">Kembali</a>
    </div>

    <script>
        const audio = document.getElementById("audioPlayer");
        const channelSelect = document.querySelector("select[name='selectedChannel']");
        const nextButton = document.getElementById("nextButton");
        const prevButton = document.getElementById("prevButton");

        let currentChannelIndex = 0;
        const initialChannels = <?php echo json_encode($channels); ?>;

        // Memuat channel pertama
        if (initialChannels.length > 0) {
            audio.src = initialChannels[0].link;
            audio.load();
            audio.play();
        }

        channelSelect.addEventListener("change", function () {
            audio.src = channelSelect.value;
            audio.load();
            audio.play();
        });

        nextButton.addEventListener("click", function () {
            currentChannelIndex = (currentChannelIndex + 1) % initialChannels.length;
            audio.src = initialChannels[currentChannelIndex].link;
            audio.load();
            audio.play();
            channelSelect.selectedIndex = currentChannelIndex;
        });

        prevButton.addEventListener("click", function () {
            currentChannelIndex = (currentChannelIndex - 1 + initialChannels.length) % initialChannels.length;
            audio.src = initialChannels[currentChannelIndex].link;
            audio.load();
            audio.play();
            channelSelect.selectedIndex = currentChannelIndex;
        });
    </script>
</body>
</html>
