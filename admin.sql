-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 11 Nis 2023, 10:53:14
-- Sunucu sürümü: 10.4.25-MariaDB
-- PHP Sürümü: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `admin`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ayarlar`
--

CREATE TABLE `ayarlar` (
  `id` varchar(36) NOT NULL DEFAULT uuid(),
  `SiteTitle` text CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `SiteDescription` text CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `SiteKeyword` text CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `SiteMeta` text CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `SiteAuthor` text CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `logo` text CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `SiteFavicon` text CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `SiteCopyright` text CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `ayarlar`
--

INSERT INTO `ayarlar` (`id`, `SiteTitle`, `SiteDescription`, `SiteKeyword`, `SiteMeta`, `SiteAuthor`, `logo`, `SiteFavicon`, `SiteCopyright`) VALUES
('52d77346-a083-42a4-87f0-9bf7943b6126', 'Başlık', 'Description', 'Keyword', 'Meta', 'Author', '397667974-title.png', '397667974-title.png', 'Copyright');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `contacts`
--

CREATE TABLE `contacts` (
  `id` varchar(36) NOT NULL DEFAULT uuid(),
  `Telefon1` varchar(11) DEFAULT NULL,
  `Telefon2` varchar(11) DEFAULT NULL,
  `Whatsapp` varchar(11) DEFAULT NULL,
  `Email1` varchar(50) DEFAULT NULL,
  `Email2` varchar(50) DEFAULT NULL,
  `Adres1` varchar(50) DEFAULT NULL,
  `Adres2` varchar(50) DEFAULT NULL,
  `GoogleMaps` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `contacts`
--

INSERT INTO `contacts` (`id`, `Telefon1`, `Telefon2`, `Whatsapp`, `Email1`, `Email2`, `Adres1`, `Adres2`, `GoogleMaps`) VALUES
('c158822e-d6a5-11ed-a862-244bfe7ca436', '5050000000', '5050000002', '50500000003', 'demo@demo.com', '2demo@demo.com', 'Adres 1', 'Adres 2', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d50931.85909916286!2d36.20793718793701!3d37.07556195626268!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x152f21ccb453a189%3A0x2abadcd26e05d60c!2sOsmaniye%2C%20Osmaniye%20Merkez%2');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kategori`
--

CREATE TABLE `kategori` (
  `id` varchar(36) NOT NULL DEFAULT uuid(),
  `KategoriAd` varchar(150) DEFAULT NULL,
  `KategoriResim` text DEFAULT NULL,
  `KategoriEklenme` datetime DEFAULT NULL,
  `KategoriSira` int(11) DEFAULT NULL,
  `KategoriDurum` int(11) DEFAULT 1,
  `KategoriSeo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `kategori`
--

INSERT INTO `kategori` (`id`, `KategoriAd`, `KategoriResim`, `KategoriEklenme`, `KategoriSira`, `KategoriDurum`, `KategoriSeo`) VALUES
('e44c4265-d6d1-11ed-a862-244bfe7ca436', 'Fincan Takımı', '649301268-fincan-takimi.png', '2023-04-09 15:27:28', 2, 1, 'fincan-takimi');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ourteams`
--

CREATE TABLE `ourteams` (
  `id` varchar(36) NOT NULL DEFAULT uuid(),
  `TeamName` varchar(50) NOT NULL DEFAULT uuid(),
  `TeamDescription` varchar(50) NOT NULL DEFAULT uuid(),
  `TeamRow` int(11) NOT NULL,
  `TeamImage` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `socialmedia`
--

CREATE TABLE `socialmedia` (
  `id` varchar(36) NOT NULL DEFAULT uuid(),
  `Facebook` text DEFAULT NULL,
  `Instagram` text DEFAULT NULL,
  `Youtube` text DEFAULT NULL,
  `Twitter` text DEFAULT NULL,
  `Linkedin` text DEFAULT NULL,
  `Whatsapp` text DEFAULT NULL,
  `Telegram` text DEFAULT NULL,
  `Tiktok` text DEFAULT NULL,
  `Messenger` text DEFAULT NULL,
  `Snapchat` text DEFAULT NULL,
  `Pinterest` text DEFAULT NULL,
  `WebUrl` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `socialmedia`
--

INSERT INTO `socialmedia` (`id`, `Facebook`, `Instagram`, `Youtube`, `Twitter`, `Linkedin`, `Whatsapp`, `Telegram`, `Tiktok`, `Messenger`, `Snapchat`, `Pinterest`, `WebUrl`) VALUES
('963df5fa-d46a-11ed-8a2d-244bfe7ca436', 'Facebook', 'Instagram', 'Youtube', 'Twitter', 'Linkedin', 'Whatsapp', 'Telegram', 'Tiktok', 'Facebook Messenger', 'Snapchat', 'Pinterest', 'Bağlantı');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urunler`
--

CREATE TABLE `urunler` (
  `id` varchar(36) NOT NULL DEFAULT uuid(),
  `UrunIsim` varchar(150) NOT NULL,
  `UrunKategoriId` varchar(36) NOT NULL,
  `UrunOnAciklama` varchar(150) NOT NULL,
  `UrunSeo` varchar(150) NOT NULL,
  `UrunEklenmeTarihi` datetime NOT NULL,
  `UrunGuncellemeTarihi` datetime NOT NULL,
  `UrunFiyat` decimal(10,2) NOT NULL,
  `UrunAciklama` text NOT NULL,
  `UrunResim` text NOT NULL,
  `UrunSira` int(11) NOT NULL,
  `UrunDurum` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `urunler`
--

INSERT INTO `urunler` (`id`, `UrunIsim`, `UrunKategoriId`, `UrunOnAciklama`, `UrunSeo`, `UrunEklenmeTarihi`, `UrunGuncellemeTarihi`, `UrunFiyat`, `UrunAciklama`, `UrunResim`, `UrunSira`, `UrunDurum`) VALUES
('a73d7dc6-d785-11ed-a28b-244bfe7ca436', 'Fincan Takımı', 'e44c4265-d6d1-11ed-a862-244bfe7ca436', 'Ürün Ön Açıklama', 'fincan-takimi', '2023-04-10 12:54:15', '2023-04-11 11:14:46', '30.54', 'Ürün Açıklama\r\n', '45299366-fincan-takimi.png', 2, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` varchar(36) NOT NULL DEFAULT uuid(),
  `Email` varchar(50) NOT NULL,
  `Isim` varchar(50) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Pass` varchar(150) NOT NULL,
  `LastLogin` datetime DEFAULT NULL,
  `sifre` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `Email`, `Isim`, `Username`, `Pass`, `LastLogin`, `sifre`) VALUES
('defae573-d845-11ed-a28b-244bfe7ca436', 'demo@demo.com', 'Fatih Yüzügüldü', 'demo', 'df01968fda8d361a07b96a8633ec1441c9149c05005a081ef60a4d97093b3d4e', '2023-04-11 11:51:29', NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `verify`
--

CREATE TABLE `verify` (
  `id` varchar(36) NOT NULL DEFAULT uuid(),
  `User_Id` varchar(36) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Code` varchar(50) NOT NULL,
  `LastLogin` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `verify`
--

INSERT INTO `verify` (`id`, `User_Id`, `Email`, `Code`, `LastLogin`) VALUES
('00d2cd1e-d846-11ed-a28b-244bfe7ca436', 'defae573-d845-11ed-a28b-244bfe7ca436', 'demo@demo.com', '619943', '2023-04-11 11:51:08');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `ayarlar`
--
ALTER TABLE `ayarlar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `ourteams`
--
ALTER TABLE `ourteams`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `socialmedia`
--
ALTER TABLE `socialmedia`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `urunler`
--
ALTER TABLE `urunler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `verify`
--
ALTER TABLE `verify`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
