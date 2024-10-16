-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Okt 2024 pada 06.17
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `esport`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `achievement`
--

CREATE TABLE `achievement` (
  `idachievement` int(11) NOT NULL,
  `idteam` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `achievement`
--

INSERT INTO `achievement` (`idachievement`, `idteam`, `name`, `date`, `description`) VALUES
(8, 1, 'Juara 1 Second', '2024-10-01', 'gfdsdaa'),
(9, 1, 'Ubaya Games', '2024-10-02', 'sadasf'),
(10, 3, 'sdasf', '2024-10-04', 'aWQSA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `event`
--

CREATE TABLE `event` (
  `idevent` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `date` date NOT NULL,
  `description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `event`
--

INSERT INTO `event` (`idevent`, `name`, `date`, `description`) VALUES
(2, 'Jakarta Esport ', '2024-09-03', '\"Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...\"\r\n\"There is no one who loves pain itself, who seeks after it and wants to have it, simply because it is '),
(4, 'Chicago Esport Fest Vol 3', '2023-06-14', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...\"'),
(5, 'LALACOST', '2024-10-01', 'MOBILE LEGEND'),
(6, 'Championship B', '2024-12-15', 'Kejuaraan terbesar untuk game MOBA, mempertemukan tim-tim terbaik.'),
(7, 'League of Legends Mid-Season Cup', '2024-06-20', 'Turnamen di tengah musim untuk tim League of Legends.'),
(8, 'Dota 2 International', '2024-08-10', 'Kompetisi Dota 2 terbesar di dunia dengan hadiah miliaran.'),
(9, 'PUBG Global Series', '2024-09-05', 'Seri turnamen PUBG dengan tim dari seluruh dunia.'),
(10, 'Valorant Masters', '2024-10-12', 'Turnamen Valorant dengan tim profesional terkemuka.'),
(11, 'FIFA World Cup eSports', '2024-11-30', 'Kejuaraan dunia FIFA dalam format esports.'),
(12, 'Rocket League Championship', '2024-07-15', 'Kejuaraan resmi untuk game Rocket League.'),
(13, 'Apex Legends Arena', '2024-05-20', 'Turnamen arena Apex Legends dengan berbagai mode permainan.'),
(14, 'Overwatch League Grand Finals', '2024-08-25', 'Final besar untuk liga Overwatch, mempertandingkan tim terbaik.'),
(15, 'Tekken World Tour', '2024-06-15', 'Kompetisi internasional untuk penggemar game fighting.'),
(16, 'Call of Duty Championship', '2024-09-25', 'Kejuaraan untuk game Call of Duty dengan hadiah besar.'),
(17, 'Mobile Legends Southeast Asia Cup', '2024-12-01', 'Kejuaraan Mobile Legends untuk kawasan Asia Tenggara.'),
(18, 'Fortnite World Cup', '2024-10-10', 'Turnamen dunia untuk Fortnite dengan pemain profesional.'),
(19, 'Hearthstone Masters', '2024-11-05', 'Kompetisi Hearthstone untuk pemain profesional di seluruh dunia.'),
(20, 'FIFA eWorld Cup', '2024-07-22', 'Kejuaraan dunia FIFA untuk permainan sepak bola virtual.'),
(21, 'World Cyber Games', '2024-08-15', 'Kompetisi global untuk berbagai jenis game.'),
(22, 'Esports Battle Royale', '2024-09-20', 'Turnamen battle royale dengan berbagai game terpopuler.'),
(23, 'The International Dota 2', '2024-10-30', 'Kompetisi Dota 2 dengan tim-tim terbaik dari seluruh dunia.'),
(24, 'League of Legends World Championship', '2024-11-15', 'Kejuaraan dunia untuk League of Legends.'),
(25, 'CS:GO Major Tournament', '2024-12-12', 'Turnamen besar untuk Counter-Strike: Global Offensive.'),
(26, 'Rainbow Six Siege Invitational', '2024-08-05', 'Kompetisi resmi untuk game Rainbow Six Siege.'),
(27, 'Street Fighter V Championship', '2024-07-18', 'Turnamen untuk pemain Street Fighter V di seluruh dunia.'),
(28, 'Smash Bros Ultimate Tournament', '2024-09-15', 'Turnamen untuk penggemar Super Smash Bros Ultimate.'),
(29, 'World of Warcraft Classic Championship', '2024-10-05', 'Kompetisi untuk penggemar World of Warcraft Classic.'),
(30, 'Tekken 7 Global Tournament', '2024-11-20', 'Turnamen global untuk penggemar Tekken 7.'),
(31, 'Valorant Global Championship', '2024-12-05', 'Kejuaraan dunia untuk Valorant dengan hadiah besar.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `event_teams`
--

CREATE TABLE `event_teams` (
  `idevent` int(11) NOT NULL,
  `idteam` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `event_teams`
--

INSERT INTO `event_teams` (`idevent`, `idteam`) VALUES
(2, 1),
(5, 14),
(6, 14),
(8, 3),
(9, 4),
(10, 11),
(17, 3),
(26, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `game`
--

CREATE TABLE `game` (
  `idgame` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `game`
--

INSERT INTO `game` (`idgame`, `name`, `description`) VALUES
(1, 'Mobile Legend', ' Pemain membentuk tim yang terdiri dari lima orang dan berusaha menghancurkan basis lawan sembari melindungi basis mereka sendiri. Setiap pemain memilih hero dengan kemampuan berbeda untuk bertarung d'),
(2, 'Valorant ', ' Dalam game ini, pemain dibagi menjadi dua tim dengan lima pemain di setiap tim. Setiap pemain memilih karakter yang disebut \"Agent,\" yang memiliki kemampuan unik. Tujuan utama biasanya adalah menanam'),
(3, 'Counter-Strike: Global Offensive', 'A multiplayer first-person shooter game.'),
(4, 'Dota 2', 'A multiplayer online battle arena (MOBA) game.'),
(5, 'StarCraft II', 'A real-time strategy game.'),
(6, 'Overwatch', 'A team-based first-person shooter game.'),
(7, 'Rainbow Six Siege', 'A tactical shooter video game.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `join_proposal`
--

CREATE TABLE `join_proposal` (
  `idjoin_proposal` int(11) NOT NULL,
  `idmember` int(11) NOT NULL,
  `idteam` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `status` enum('waiting','approved','rejected') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `member`
--

CREATE TABLE `member` (
  `idmember` int(11) NOT NULL,
  `fname` varchar(45) NOT NULL,
  `lname` varchar(45) NOT NULL,
  `usename` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `profile` enum('admin','member','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `member`
--

INSERT INTO `member` (`idmember`, `fname`, `lname`, `usename`, `password`, `profile`) VALUES
(1, 'John', 'Doe', 'johndoe', 'password123', 'admin'),
(2, 'Aliyah', 'Rheina', 'lia', 'lia123', 'member'),
(3, 'Re', 'Doe', 'redoe', 'adminpass1', 'admin'),
(4, 'Alice', 'Smith', 'alicesmith', 'adminpass2', 'admin'),
(5, 'Robert', 'Johnson', 'robertjohnson', 'adminpass3', 'admin'),
(6, 'Emma', 'Williams', 'emmawilliams', 'adminpass4', 'admin'),
(7, 'Liam', 'Brown', 'liambrown', 'memberpass1', 'member'),
(8, 'Olivia', 'Jones', 'oliviajones', 'memberpass2', 'member'),
(9, 'Noah', 'Garcia', 'noahgarcia', 'memberpass3', 'member'),
(10, 'Ava', 'Martinez', 'avamartinez', 'memberpass4', 'member'),
(11, 'Elijah', 'Rodriguez', 'elijahrodriguez', 'memberpass5', 'member'),
(12, 'Isabella', 'Lopez', 'isabellalopez', 'memberpass6', 'member'),
(13, 'James', 'Gonzalez', 'jamesgonzalez', 'memberpass7', 'member'),
(14, 'Sophia', 'Wilson', 'sophiawilson', 'memberpass8', 'member'),
(15, 'Benjamin', 'Anderson', 'benjaminanderson', 'memberpass9', 'member'),
(16, 'Amelia', 'Thomas', 'ameliathomas', 'memberpass10', 'member'),
(17, 'Lucas', 'Moore', 'lucasmoore', 'memberpass11', 'member'),
(18, 'Mia', 'Martin', 'miamartin', 'memberpass12', 'member'),
(19, 'Henry', 'Jackson', 'henryjackson', 'memberpass13', 'member'),
(20, 'Evelyn', 'Lee', 'evelynlee', 'memberpass14', 'member'),
(21, 'Alexander', 'Perez', 'alexanderperez', 'memberpass15', 'member'),
(22, 'Caca', 'Cu', 'cacacu', 'cacacu123', 'member');

-- --------------------------------------------------------

--
-- Struktur dari tabel `team`
--

CREATE TABLE `team` (
  `idteam` int(11) NOT NULL,
  `idgame` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `team`
--

INSERT INTO `team` (`idteam`, `idgame`, `name`) VALUES
(1, 1, 'Kakao'),
(2, 2, 'NYX '),
(3, 1, 'Helios'),
(4, 3, 'Phoenix'),
(5, 3, 'Dragons'),
(6, 4, 'Titans'),
(7, 4, 'Warriors'),
(8, 5, 'Legends'),
(9, 5, 'Mavericks'),
(10, 6, 'Gladiators'),
(11, 6, 'Rangers'),
(12, 7, 'Knights'),
(13, 7, 'Pioneers'),
(14, 3, 'Spartans'),
(15, 4, 'Challengers'),
(16, 5, 'Fighters'),
(17, 6, 'Saviors'),
(18, 7, 'Champions'),
(19, 4, 'Ubaya Teams');

-- --------------------------------------------------------

--
-- Struktur dari tabel `team_members`
--

CREATE TABLE `team_members` (
  `idteam` int(11) NOT NULL,
  `idmember` int(11) NOT NULL,
  `description` varchar(75) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `achievement`
--
ALTER TABLE `achievement`
  ADD PRIMARY KEY (`idachievement`),
  ADD KEY `fk_achievement_team1_idx` (`idteam`);

--
-- Indeks untuk tabel `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`idevent`);

--
-- Indeks untuk tabel `event_teams`
--
ALTER TABLE `event_teams`
  ADD PRIMARY KEY (`idevent`,`idteam`),
  ADD KEY `fk_event_has_team_team1_idx` (`idteam`),
  ADD KEY `fk_event_has_team_event1_idx` (`idevent`);

--
-- Indeks untuk tabel `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`idgame`);

--
-- Indeks untuk tabel `join_proposal`
--
ALTER TABLE `join_proposal`
  ADD PRIMARY KEY (`idjoin_proposal`);

--
-- Indeks untuk tabel `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`idmember`);

--
-- Indeks untuk tabel `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`idteam`),
  ADD KEY `fk_team_game1_idx` (`idgame`);

--
-- Indeks untuk tabel `team_members`
--
ALTER TABLE `team_members`
  ADD PRIMARY KEY (`idteam`,`idmember`),
  ADD KEY `fk_team_has_member_member1_idx` (`idmember`),
  ADD KEY `fk_team_has_member_team_idx` (`idteam`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `achievement`
--
ALTER TABLE `achievement`
  MODIFY `idachievement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `event`
--
ALTER TABLE `event`
  MODIFY `idevent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `game`
--
ALTER TABLE `game`
  MODIFY `idgame` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `join_proposal`
--
ALTER TABLE `join_proposal`
  MODIFY `idjoin_proposal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `member`
--
ALTER TABLE `member`
  MODIFY `idmember` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `team`
--
ALTER TABLE `team`
  MODIFY `idteam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `achievement`
--
ALTER TABLE `achievement`
  ADD CONSTRAINT `fk_achievement_team1` FOREIGN KEY (`idteam`) REFERENCES `team` (`idteam`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `event_teams`
--
ALTER TABLE `event_teams`
  ADD CONSTRAINT `fk_event_has_team_event1` FOREIGN KEY (`idevent`) REFERENCES `event` (`idevent`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_event_has_team_team1` FOREIGN KEY (`idteam`) REFERENCES `team` (`idteam`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `team`
--
ALTER TABLE `team`
  ADD CONSTRAINT `fk_team_game1` FOREIGN KEY (`idgame`) REFERENCES `game` (`idgame`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `team_members`
--
ALTER TABLE `team_members`
  ADD CONSTRAINT `fk_team_has_member_member1` FOREIGN KEY (`idmember`) REFERENCES `member` (`idmember`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_team_has_member_team` FOREIGN KEY (`idteam`) REFERENCES `team` (`idteam`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
