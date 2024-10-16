<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Esport Club Ubaya</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="login-register" style="float:right">
            <?php
                if(isset($_COOKIE["usename"])){
                    echo "<h3>Login sebagai ".$_COOKIE["usename"]."</h3>";
                    echo "<a href=\"proses_logout.php\" class=\"btn\">Logout</a>";
                } else{
                    echo "<a href=\"login.php\" class=\"btn\">Login</a>";
                    echo "<a href=\"register.php\" class=\"btn\">Register</a>";
                }
            ?>    
              
                
              </div>
        <div class="container">
            <h1>Selamat Datang di Esport Club </h1>
            
        </div>
    </header>

    <main>
        <div class="container">
            <section class="about">
                <h2>Tentang eSoprts Kami</h2>
                <p>Esports club adalah komunitas atau tim yang fokus pada kompetisi game seperti Mobile Legends, Dota 2, PUBG, dan Valorant. Pemain berkumpul untuk latihan, ikut turnamen, dan mengasah keterampilan. Klub ini sering punya pelatih, sponsor, dan fasilitas khusus untuk membantu pemain bersaing di level tinggi, baik lokal maupun internasional.</p>
            </section>

            <?php
                if(isset($_COOKIE["usename"])){
                    echo "<section class=\"teams\">";
                    echo "<h2>Join a Team now!</h2>";
                    echo "<div class=\"event-grid\">";
                    echo "<a href=\"joinproposal.php\" class=\"btn\">JOIN NOW</a>";
                    echo "</div></section>";
                }
            ?>
            
            <section class="events">
                <h2>Kegiatan Kami</h2>
                <div class="event-grid">
                    <div class="event">
                        <img src="https://placehold.co/300x200" alt="Event 1">
                        <h3>Event 1</h3>
                        <p>Deskripsi singkat tentang event 1.</p>
                        <a href="#" class="btn">Selengkapnya</a>
                    </div>
                    <div class="event">
                        <img src="https://placehold.co/300x200" alt="Event 2">
                        <h3>Event 2</h3>
                        <p>Deskripsi singkat tentang event 2.</p>
                        <a href="#" class="btn">Selengkapnya</a>
                    </div>
                    <div class="event">
                        <img src="https://placehold.co/300x200" alt="Event 3">
                        <h3>Event 3</h3>
                        <p>Deskripsi singkat tentang event 3.</p>
                        <a href="#" class="btn">Selengkapnya</a>
                    </div>
                </div>
            </section>

            <section class="contact">
                <h2>Hubungi Kami</h2>
                <p>Jika Anda ingin bergabung dengan Club Informatics atau ingin bertanya tentang kegiatan kami, Anda dapat menghubungi kami melalui:</p>
                <ul>
                    <li>Email: esportclub@example.com</li>
                    <li>Instagram: @esportclub</li>
                    <li>Facebook: E-sport Club</li>
                </ul>
            </section>
        </div>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2023 Club Informatics</p>
        </div>
    </footer>
</body>
</html>