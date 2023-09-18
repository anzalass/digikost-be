-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2023 at 09:03 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `digikost`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategoris`
--

CREATE TABLE `kategoris` (
  `kodeBarang` varchar(20) NOT NULL,
  `namaBarang` varchar(255) DEFAULT NULL,
  `kategori` varchar(255) DEFAULT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `updated_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategoris`
--

INSERT INTO `kategoris` (`kodeBarang`, `namaBarang`, `kategori`, `created_at`, `updated_at`) VALUES
('B002', 'CCTV', 'yoosee', '2023-08-31', '2023-08-31'),
('B003', 'Jam Tangan', 'curren', '2023-08-31', '2023-08-31'),
('B005', 'Kipas', NULL, '2023-09-02', '2023-09-13');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pemeliharaans`
--

CREATE TABLE `pemeliharaans` (
  `kodePemeliharaan` int(20) NOT NULL,
  `kodeBarang` varchar(20) NOT NULL,
  `kodeRuang` varchar(20) NOT NULL,
  `idUser` bigint(20) DEFAULT NULL,
  `jumlah` int(20) NOT NULL,
  `buktiPembayaran` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL,
  `harga` int(20) NOT NULL,
  `keterangan` text NOT NULL,
  `created_at` date DEFAULT current_timestamp(),
  `updated_at` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pengadaans`
--

CREATE TABLE `pengadaans` (
  `id` int(20) NOT NULL,
  `kodeBarang` varchar(20) NOT NULL,
  `kodeRuang` varchar(20) NOT NULL,
  `namaBarang` varchar(255) DEFAULT NULL,
  `merek` varchar(255) NOT NULL,
  `hargaBarang` int(20) NOT NULL,
  `quantity` int(5) NOT NULL,
  `spesifikasi` text NOT NULL,
  `tanggalPembelian` date NOT NULL DEFAULT current_timestamp(),
  `ruang` varchar(10) NOT NULL,
  `supplier` varchar(255) NOT NULL,
  `buktiNota` varchar(255) NOT NULL,
  `linkBarcode` text NOT NULL,
  `updated_at` date DEFAULT current_timestamp(),
  `created_at` date DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `is_active` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 2, 'token', '377ffcbe8317674f3b2c8b6d3aac9af0261bf1ba5a49d82b9184b16d76e25ad5', '[\"*\"]', NULL, '2023-09-07 05:12:30', '2023-09-07 05:12:30'),
(2, 'App\\Models\\User', 2, 'token', '5b5f7c1024376eede72e62b889eea8182c4ba46504f3d4aaa40764ba3e1a2bb0', '[\"*\"]', NULL, '2023-09-07 05:12:48', '2023-09-07 05:12:48'),
(3, 'App\\Models\\User', 2, 'token', '7780758dd9c7cd38df4760c1aaa17b1f281bb44cf51e97eec77522b889ee0dec', '[\"*\"]', NULL, '2023-09-07 05:13:20', '2023-09-07 05:13:20'),
(4, 'App\\Models\\User', 2, 'token', '770c6979b26de6e4f6b8a9da41b3c6a807ba13589305ec46f21fb8b76c7d2c49', '[\"*\"]', NULL, '2023-09-07 05:14:04', '2023-09-07 05:14:04'),
(5, 'App\\Models\\User', 2, 'token', '8d8f6d72096075856a434066c2ad6d2372439a1ad135f5903cb7256020479687', '[\"*\"]', NULL, '2023-09-07 05:15:55', '2023-09-07 05:15:55'),
(6, 'App\\Models\\User', 2, 'token', 'bcc349d7883b6c0cbff33b3f5e04c66548bbef74cee4056712590a90a41d9c96', '[\"*\"]', NULL, '2023-09-07 05:17:50', '2023-09-07 05:17:50'),
(7, 'App\\Models\\User', 2, 'token', '6173970246e4a0d49e89a308517f2aac66dc331989ce3ee9caf50a2f0f90a8b8', '[\"*\"]', NULL, '2023-09-07 05:36:06', '2023-09-07 05:36:06'),
(8, 'App\\Models\\User', 2, 'token', '6348be9f876cc46406ac7ffdd56417f4880e667e900c124db5b396aa0a0f22cd', '[\"*\"]', NULL, '2023-09-07 05:37:00', '2023-09-07 05:37:00'),
(9, 'App\\Models\\User', 2, 'token', '6e4293062c4c6c7b14f46798308851a962fa2ab73d70418f85fa22661b3e56c0', '[\"*\"]', NULL, '2023-09-07 05:38:40', '2023-09-07 05:38:40'),
(10, 'App\\Models\\User', 2, 'token', '18db2f4a0a49120fbff3bd401d31538bb83333513c4c7c45e7a8065e46392b76', '[\"*\"]', NULL, '2023-09-07 07:18:59', '2023-09-07 07:18:59'),
(11, 'App\\Models\\User', 2, 'token', 'bb0b603731437fe6e329c1fce6cc232ed05ea3a5349639985335cee06e63398a', '[\"*\"]', NULL, '2023-09-07 07:19:10', '2023-09-07 07:19:10'),
(12, 'App\\Models\\User', 2, 'token', '3c4ee1c570cad2c1f019e0a2a502d466068fc7adf319d7ab495889a1b1ca11e2', '[\"*\"]', NULL, '2023-09-07 07:23:17', '2023-09-07 07:23:17'),
(13, 'App\\Models\\User', 2, 'token', '416c00b867103e4e06cd0e34eaaddbdbd89d376eabd26f60061f2449ebc073be', '[\"*\"]', NULL, '2023-09-07 07:23:27', '2023-09-07 07:23:27'),
(14, 'App\\Models\\User', 2, 'token', '33cb9c57e6a99ef46785d4d87182697fee7fd75a467ff3db066be664bea49c65', '[\"*\"]', NULL, '2023-09-07 07:23:29', '2023-09-07 07:23:29'),
(15, 'App\\Models\\User', 2, 'token', '1c332f4c4d38bf06d63c1af1f1711cdce2760a6014d9cfb184231196d3ae3298', '[\"*\"]', NULL, '2023-09-07 07:25:40', '2023-09-07 07:25:40'),
(16, 'App\\Models\\User', 2, 'token', '5faf016cbad12ca5de868ab69c93fc5377a12e7bedf076a68180e55b851cecf8', '[\"*\"]', NULL, '2023-09-07 07:27:34', '2023-09-07 07:27:34'),
(17, 'App\\Models\\User', 2, 'token', 'df1f5c7c3852f8126455808b3cecd64f937a6d56149a2e4cda5cdffb9c4e412f', '[\"*\"]', NULL, '2023-09-07 07:29:17', '2023-09-07 07:29:17'),
(18, 'App\\Models\\User', 2, 'token', '950d2098d9831f001413f3632022378b0c3b0657f0b7e7e934c5447a9da02bc5', '[\"*\"]', NULL, '2023-09-07 07:56:47', '2023-09-07 07:56:47'),
(19, 'App\\Models\\User', 2, 'token', 'b4e514a331c36f2006ca8f19563c2963869f8689ab745dabd2e6a4599eaacdf0', '[\"*\"]', NULL, '2023-09-07 20:27:33', '2023-09-07 20:27:33'),
(20, 'App\\Models\\User', 2, 'token', '0779fdffee89e8b212a0d716e57872526e698bc66d843cd2bc7392b6cf9de400', '[\"*\"]', NULL, '2023-09-07 22:58:23', '2023-09-07 22:58:23'),
(21, 'App\\Models\\User', 2, 'token', '14a5ca238645fb1d9ac66e0100efc900d6bee83bbba1a99555a893c8280c19be', '[\"*\"]', NULL, '2023-09-07 23:35:13', '2023-09-07 23:35:13'),
(22, 'App\\Models\\User', 2, 'token', '2ba4c07b45893ec92601bd5926cc2ec42291049af9f0e12ce047d0a9a6e94bb1', '[\"*\"]', NULL, '2023-09-07 23:35:21', '2023-09-07 23:35:21'),
(23, 'App\\Models\\User', 2, 'token', '103021f6ef4ce90432d89c69cbce9a418314419bc32232da6c4ea2c0c8ec6efa', '[\"*\"]', NULL, '2023-09-07 23:51:05', '2023-09-07 23:51:05'),
(24, 'App\\Models\\User', 2, 'token', 'eec51611690d0e1de4a1a61e9125c052048d76a27a7d18fbac4da12a78a62c69', '[\"*\"]', NULL, '2023-09-08 00:38:54', '2023-09-08 00:38:54'),
(25, 'App\\Models\\User', 2, 'token', '763546531060ed1bbb64a1375aeb32516de675267314b1bf7da476eb76a65fb1', '[\"*\"]', NULL, '2023-09-08 00:43:40', '2023-09-08 00:43:40'),
(26, 'App\\Models\\User', 2, 'token', '4057aeb30cff30e4d1d82c2aaa001d3a432910320e247a8563e1ff0c83cecbbc', '[\"*\"]', NULL, '2023-09-08 00:45:57', '2023-09-08 00:45:57'),
(27, 'App\\Models\\User', 2, 'token', '6b624ec474121881eb280cddd8abfa20638af8a09bb65ba4aae158f3efa97fbc', '[\"*\"]', NULL, '2023-09-08 01:05:30', '2023-09-08 01:05:30'),
(28, 'App\\Models\\User', 2, 'token', '9533093aa3f6a089e05a2d651d6141c4682363c95fa0043003a406f189459906', '[\"*\"]', '2023-09-12 12:12:49', '2023-09-08 01:09:10', '2023-09-12 12:12:49'),
(29, 'App\\Models\\User', 2, 'token', '59a5cb3320f99203341e783a627a072b0e8fc8c25916c046af01a09db08c8cb9', '[\"*\"]', '2023-09-09 05:52:02', '2023-09-09 04:44:21', '2023-09-09 05:52:02'),
(30, 'App\\Models\\User', 2, 'token', '437caead1f672e9c781b281a97a9fae2e525a13050a2de5ba31caa2cce5d9b82', '[\"*\"]', NULL, '2023-09-09 04:55:07', '2023-09-09 04:55:07'),
(31, 'App\\Models\\User', 2, 'token', 'd25fff8caba033951aa3e9ec7e9c1b07d7a17754369583c591a852bb75d935bb', '[\"*\"]', NULL, '2023-09-09 04:56:22', '2023-09-09 04:56:22'),
(32, 'App\\Models\\User', 2, 'token', '4c583be4367c16921784dae4bb15bfe4ccb7fe911e1ee51d9177c0ccef593415', '[\"*\"]', NULL, '2023-09-09 04:59:46', '2023-09-09 04:59:46'),
(33, 'App\\Models\\User', 2, 'token', 'e4d317544eb019d271422396144eb10c7cc8f43e036a4bbcd829436f686e32cd', '[\"*\"]', NULL, '2023-09-09 05:07:11', '2023-09-09 05:07:11'),
(34, 'App\\Models\\User', 2, 'token', 'cb9287603c66030e799d8138eff78ec467b0dc56ce219328998ddb0857cb1e71', '[\"*\"]', NULL, '2023-09-10 05:04:16', '2023-09-10 05:04:16'),
(35, 'App\\Models\\User', 2, 'token', '3d2f3657ed09785a8b838e2aa14d8b24f3cd58876f479c90b9c00be05f3a4d53', '[\"*\"]', NULL, '2023-09-10 05:07:35', '2023-09-10 05:07:35'),
(36, 'App\\Models\\User', 2, 'token', 'b4235381a1c1556f5f05900dceba96d39395d7fb3f4cbc51178922f1f5f448ce', '[\"*\"]', NULL, '2023-09-10 06:13:07', '2023-09-10 06:13:07'),
(37, 'App\\Models\\User', 2, 'token', '1b8c7aec64871874119e0b7cb5699e9d2382736e69e6643f33572f0f9a44bd80', '[\"*\"]', NULL, '2023-09-10 06:27:27', '2023-09-10 06:27:27'),
(38, 'App\\Models\\User', 2, 'token', '0b30dba1e031ee12b13a2c8db759a963c942951b8c37312fa389846d9e6ee9ab', '[\"*\"]', NULL, '2023-09-10 08:25:56', '2023-09-10 08:25:56'),
(39, 'App\\Models\\User', 2, 'token', 'aa48cc1cf1331e8afc583d2340bd118ffa16929185d239add1cccb07e1849137', '[\"*\"]', '2023-09-10 21:23:50', '2023-09-10 08:31:40', '2023-09-10 21:23:50'),
(40, 'App\\Models\\User', 2, 'token', '2dc64e71b623a9c0d44996ef6a837d5587956022af8544aa7441d8db78fdc77e', '[\"*\"]', NULL, '2023-09-10 12:22:13', '2023-09-10 12:22:13'),
(41, 'App\\Models\\User', 2, 'token', 'dfa8eefaaa4be8895de58562591aa6d6bf95484ab0ef5617fb314f999541103f', '[\"*\"]', NULL, '2023-09-10 12:24:31', '2023-09-10 12:24:31'),
(42, 'App\\Models\\User', 2, 'token', '06b8d00964c85151d54164d00b8763409ed0a5c053a21487ddf21f0fb5f1430a', '[\"*\"]', NULL, '2023-09-10 12:25:48', '2023-09-10 12:25:48'),
(43, 'App\\Models\\User', 2, 'token', 'd5321ab0873982bccc45dabbb285d260207d7899aa9b3c3f54f5f0d716932ceb', '[\"*\"]', NULL, '2023-09-10 12:28:56', '2023-09-10 12:28:56'),
(44, 'App\\Models\\User', 2, 'token', '4d86925ad1cfee3704010f8c661c9986fa53023546caa5046b9b4e362b77a82c', '[\"*\"]', NULL, '2023-09-10 12:30:13', '2023-09-10 12:30:13'),
(45, 'App\\Models\\User', 2, 'token', '0a53731173fae6299d85360a1d9e16f94d7801441d649b66bca509c4c5f40277', '[\"*\"]', NULL, '2023-09-10 19:29:52', '2023-09-10 19:29:52'),
(46, 'App\\Models\\User', 2, 'token', '315fd277b450836b12febd3e05abc890283159a1800c1a4b089a0eb6ffdaf541', '[\"*\"]', NULL, '2023-09-10 19:30:47', '2023-09-10 19:30:47'),
(47, 'App\\Models\\User', 2, 'token', '1b0ca77f457c04aca5d7a71948e2127e0fbd34eae949a65bdefc29c586816472', '[\"*\"]', NULL, '2023-09-10 19:31:16', '2023-09-10 19:31:16'),
(48, 'App\\Models\\User', 2, 'token', '6ce1ea28ac2894777fed4bf7e1403ce9058cca5a06bbe1fdc6812e5b921801a7', '[\"*\"]', NULL, '2023-09-10 19:31:48', '2023-09-10 19:31:48'),
(49, 'App\\Models\\User', 2, 'token', '3e83b0d1cc87b748d6c6189b7a9b73de3d361d7b172d0d1b3a3f4f4389b0d78d', '[\"*\"]', NULL, '2023-09-10 19:34:15', '2023-09-10 19:34:15'),
(50, 'App\\Models\\User', 2, 'token', '5e1be4a51e612c1d605c1388a498b3b1c9081729043258c34c31694ee0f0b2f1', '[\"*\"]', NULL, '2023-09-10 19:35:25', '2023-09-10 19:35:25'),
(51, 'App\\Models\\User', 2, 'token', 'bc3c7ad6337294d232251d567c43ad68cf70e2345efedb18420aa9808a72d0e7', '[\"*\"]', NULL, '2023-09-10 19:35:43', '2023-09-10 19:35:43'),
(52, 'App\\Models\\User', 2, 'token', 'b382954e4da0d2795259eabf23e0a1b64e548805fa45860db0f9d510cda7ec66', '[\"*\"]', NULL, '2023-09-10 19:44:41', '2023-09-10 19:44:41'),
(53, 'App\\Models\\User', 2, 'token', 'f02ed42e22dfc6b26787e4fa7be4d57efc28c45e034f4c8b35785d1121a52294', '[\"*\"]', NULL, '2023-09-10 19:46:05', '2023-09-10 19:46:05'),
(54, 'App\\Models\\User', 2, 'token', 'afc517959c382c5ce5a34b5b44a52175f675411eb0ffa17f11516b04a3e514d8', '[\"*\"]', '2023-09-10 21:26:31', '2023-09-10 20:00:11', '2023-09-10 21:26:31'),
(55, 'App\\Models\\User', 7, 'token', '5fd0c7e8cceaf9858dc8a73be9001e140638963757f1e058af117e7af6a0c9d6', '[\"*\"]', '2023-09-10 21:32:42', '2023-09-10 21:26:49', '2023-09-10 21:32:42'),
(56, 'App\\Models\\User', 2, 'token', 'b8626b02ccfa877f25b08656678612813f89d7713da1d3e05e8f9c8191df0254', '[\"*\"]', '2023-09-11 04:38:43', '2023-09-10 21:32:50', '2023-09-11 04:38:43'),
(57, 'App\\Models\\User', 2, 'token', '9028a2593405fc08d7236887752680069039363c8b4201d6f137bc68002fe219', '[\"*\"]', '2023-09-12 12:14:08', '2023-09-11 05:53:13', '2023-09-12 12:14:08'),
(58, 'App\\Models\\User', 2, 'token', '8566329077854497d5c7e595faa732e72093fb80159281cf8aa8c16a4eac6e42', '[\"*\"]', '2023-09-12 12:13:29', '2023-09-12 12:13:02', '2023-09-12 12:13:29'),
(59, 'App\\Models\\User', 2, 'token', 'd74a3b44940f220d7f5155d62db0d8b0a193a2811a4627fb7575361ebd110ed0', '[\"*\"]', NULL, '2023-09-12 12:31:24', '2023-09-12 12:31:24'),
(60, 'App\\Models\\User', 2, 'token', '322db26762a0d0a8a6bcc494f5d07d3a2c61fd357857fed6d1afd7e680c6cb7d', '[\"*\"]', '2023-09-12 12:32:37', '2023-09-12 12:31:28', '2023-09-12 12:32:37'),
(61, 'App\\Models\\User', 2, 'token', '40bad71b9027def1530f256e274e616f2d676412eff6f2e103b6839ecb56bf6b', '[\"*\"]', '2023-09-12 12:34:06', '2023-09-12 12:33:28', '2023-09-12 12:34:06'),
(62, 'App\\Models\\User', 2, 'token', '8481b510e1fd7e6e4c5fba48c82a7a31a1b370a69161ccf1c72e50b72f5efdc6', '[\"*\"]', '2023-09-12 12:34:59', '2023-09-12 12:34:24', '2023-09-12 12:34:59'),
(63, 'App\\Models\\User', 2, 'token', '5c250ba617212f2f27e6d6fece2a7da761ed569931c2a622b4cebbdccc7cc862', '[\"*\"]', '2023-09-12 12:39:14', '2023-09-12 12:35:11', '2023-09-12 12:39:14'),
(64, 'App\\Models\\User', 2, 'token', '518417b03be658898a78ace5eaa69088cc70078f99985abeede324e1dfcf2b8b', '[\"*\"]', '2023-09-12 12:41:49', '2023-09-12 12:40:39', '2023-09-12 12:41:49'),
(65, 'App\\Models\\User', 2, 'token', '858afa39644c32a10a02564fa1658013f2770e0286845f0af7a478265f8267f1', '[\"*\"]', '2023-09-12 19:52:51', '2023-09-12 19:52:49', '2023-09-12 19:52:51'),
(66, 'App\\Models\\User', 2, 'token', 'd1841e1f4dda4f6daa0affe867be6aff406995691a66ad1ab9c2ef665a6a72ab', '[\"*\"]', '2023-09-12 20:01:44', '2023-09-12 19:56:36', '2023-09-12 20:01:44'),
(67, 'App\\Models\\User', 2, 'token', '329a55211ddd54ca5db4f9d9b52d0a82fa917675a88e627ed1cef64efa9d4ee3', '[\"*\"]', '2023-09-12 20:03:45', '2023-09-12 20:03:43', '2023-09-12 20:03:45'),
(68, 'App\\Models\\User', 2, 'token', 'f6f02183305ccbeef08b9e5b36df66ba34bce148aba1d4802063d79eef0a309f', '[\"*\"]', '2023-09-12 20:05:34', '2023-09-12 20:05:20', '2023-09-12 20:05:34'),
(69, 'App\\Models\\User', 2, 'token', 'abb159ef32548c4260b6cf0a18990cdaaa4b2964ef84df670a27a6e4d6e17678', '[\"*\"]', '2023-09-12 20:45:07', '2023-09-12 20:08:07', '2023-09-12 20:45:07'),
(70, 'App\\Models\\User', 2, 'token', '281b70a74db1f1d3f2fec16810e94f7922972af070ef5f1d699ca8af7dbfcc23', '[\"*\"]', '2023-09-13 19:02:01', '2023-09-12 20:45:59', '2023-09-13 19:02:01'),
(71, 'App\\Models\\User', 2, 'token', '6323cb75a5ca6666dc9be0961cf0e7388d4b6e8cdf4475c3a11ae0a09ff5f0c4', '[\"*\"]', '2023-09-14 23:26:12', '2023-09-13 19:02:23', '2023-09-14 23:26:12'),
(72, 'App\\Models\\User', 2, 'token', '1bfccfc612f887b00318ae98175ff930fb596a24b4b1e7d8325c1f81db0b3c1c', '[\"*\"]', '2023-09-15 00:46:15', '2023-09-15 00:46:10', '2023-09-15 00:46:15'),
(73, 'App\\Models\\User', 2, 'token', '964677c9367b49107dce693419a54e48aed18eeb4bab881e87ef871f7263afea', '[\"*\"]', '2023-09-16 03:57:56', '2023-09-16 03:50:02', '2023-09-16 03:57:56'),
(74, 'App\\Models\\User', 2, 'token', '0be7b0c8f079ab7df85551447f514bd9654b8f9328e4ae6c85111dafe10fb1de', '[\"*\"]', '2023-09-16 03:58:17', '2023-09-16 03:58:14', '2023-09-16 03:58:17'),
(75, 'App\\Models\\User', 2, 'token', 'ec367cc2c4668ff63110258ea274d6dba7a17032061a3b9eb1b35917d1577111', '[\"*\"]', '2023-09-16 06:56:22', '2023-09-16 03:58:44', '2023-09-16 06:56:22'),
(76, 'App\\Models\\User', 2, 'token', '0c9c37d327dfa973cdbe458efd0308ba4f71df9a87c6748c3906d7bd95425a18', '[\"*\"]', '2023-09-17 23:11:20', '2023-09-16 07:13:23', '2023-09-17 23:11:20');

-- --------------------------------------------------------

--
-- Table structure for table `ruangs`
--

CREATE TABLE `ruangs` (
  `kodeRuang` varchar(20) NOT NULL,
  `ruang` varchar(5) DEFAULT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `updated_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ruangs`
--

INSERT INTO `ruangs` (`kodeRuang`, `ruang`, `created_at`, `updated_at`) VALUES
('R001', '1', '2023-09-18', '2023-09-18'),
('R002', '2', '2023-09-17', '2023-09-17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(1) NOT NULL,
  `noHP` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `noHP`, `remember_token`, `created_at`, `updated_at`) VALUES
(7, 'gondes', 'gondes@gmail.com', NULL, '$2y$10$Vll6PNiM284QFpo6/jrfAeGKWdA0mkFiV5ltRNNiuoAOS66Qj82w2', 2, '08992515319', NULL, '2023-09-10 21:26:07', '2023-09-10 21:26:07'),
(12, 'vapeinstore', 'azizi@gmail.com', NULL, '$2y$10$5.gtZnVA1IJUaFhaoMOozOI9huET.4NoC3izZ3EfzY9WnyIjIziwK', 2, '08889232', NULL, '2023-09-16 23:20:16', '2023-09-16 23:20:16'),
(14, 'azizi shafa asadel', 'aziziku@gmail.com', NULL, '$2y$10$D2eGDC9T7XiFyMFI5y.ksOhQ/fWTDqkxPBbAzCGzzODJCoIpp9uBS', 1, '0859102604165', NULL, '2023-09-16 23:39:38', '2023-09-16 23:39:38'),
(27, 'adil', 'kurniawanadi3108@gmail.com', NULL, '$2y$10$9choptIS4ESY4yMNtAd7V.jUtN.24j8wdtnjD4ufwn7MgJmqHP4ZG', 1, '08292819', NULL, '2023-09-17 23:18:37', '2023-09-17 23:18:37'),
(28, 'jaung', 'jaung9401@gmail.com', NULL, '$2y$10$RTYsvS/gnbRQFSU8rmXoPuUmPl46sg8wdLQtCi9LLMLp6806AItTy', 1, '0892838382', NULL, '2023-09-17 23:19:28', '2023-09-17 23:19:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `kategoris`
--
ALTER TABLE `kategoris`
  ADD PRIMARY KEY (`kodeBarang`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pemeliharaans`
--
ALTER TABLE `pemeliharaans`
  ADD PRIMARY KEY (`kodePemeliharaan`);

--
-- Indexes for table `pengadaans`
--
ALTER TABLE `pengadaans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `ruangs`
--
ALTER TABLE `ruangs`
  ADD PRIMARY KEY (`kodeRuang`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pemeliharaans`
--
ALTER TABLE `pemeliharaans`
  MODIFY `kodePemeliharaan` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pengadaans`
--
ALTER TABLE `pengadaans`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
