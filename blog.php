<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Blog - My Simple Website</title>
    <link rel="stylesheet" href="blog.css" />
</head>
<body>

<header>
    <h1>Blog</h1>
    <nav>
        <a href="index.html">Home</a>
        <a href="gallery.html">Gallery</a>
        <a href="blog.php">Blog</a>
        <a href="contact.html">Contact</a>
    </nav>
    <div class="header-right">
        <div id="clock" title="Jam Sekarang"></div>
        <button id="toggleDarkMode" title="Toggle Dark Mode">🌓</button>
    </div>
</header>

<main>
    <h2>Artikel Blog</h2>

    <?php
    $koneksi = new mysqli("localhost", "root", "", "webku");

    if ($koneksi->connect_error) {
        die("Koneksi gagal: " . $koneksi->connect_error);
    }

    $sql = "SELECT * FROM blog ORDER BY tanggal DESC";
    $hasil = $koneksi->query($sql);

    if ($hasil->num_rows > 0) {
        while($row = $hasil->fetch_assoc()) {
            echo "<article>";
            echo "<h3>" . htmlspecialchars($row["judul"]) . "</h3>";
            echo "<small><i>" . htmlspecialchars($row["tanggal"]) . "</i></small>";
            echo "<p>" . nl2br(htmlspecialchars($row["isi"])) . "</p>";
            echo "<hr>";
            echo "</article>";
        }
    } else {
        echo "<p>Belum ada artikel.</p>";
    }

    $koneksi->close();
    ?>
</main>

<footer>
    <p>&copy; ALU SHIAU SIBARANI</p>
</footer>

<script>
    const toggleButton = document.getElementById('toggleDarkMode');
    const body = document.body;

    if (localStorage.getItem('darkMode') === 'enabled') {
        body.classList.add('dark-mode');
    }

    toggleButton.addEventListener('click', () => {
        body.classList.toggle('dark-mode');
        localStorage.setItem('darkMode', body.classList.contains('dark-mode') ? 'enabled' : 'disabled');
    });

    function updateClock() {
        const clock = document.getElementById('clock');
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        clock.textContent = `${hours}:${minutes}:${seconds}`;
    }

    setInterval(updateClock, 1000);
    updateClock();
</script>

</body>
</html>
