-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2016 at 04:55 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mshrm`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_cuti`
--

CREATE TABLE `data_cuti` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status_cuti` varchar(64) DEFAULT NULL,
  `nama_lengkap` varchar(512) DEFAULT NULL,
  `nip` varchar(128) DEFAULT NULL,
  `pengganti_nama` varchar(512) DEFAULT NULL,
  `pengganti_nip` varchar(128) DEFAULT NULL,
  `supervisor_nama` varchar(512) DEFAULT NULL,
  `supervisor_nama_akun` varchar(512) DEFAULT NULL,
  `supervisor_nip` varchar(128) DEFAULT NULL,
  `penyetuju_nama_akun` varchar(512) DEFAULT NULL,
  `penyetuju_nip` varchar(128) DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `alasan_cuti` text,
  `waktu_pengajuan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `waktu_disetujui` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `supervisor` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_cuti`
--

INSERT INTO `data_cuti` (`id`, `status_cuti`, `nama_lengkap`, `nip`, `pengganti_nama`, `pengganti_nip`, `supervisor_nama`, `supervisor_nama_akun`, `supervisor_nip`, `penyetuju_nama_akun`, `penyetuju_nip`, `tanggal_mulai`, `tanggal_selesai`, `alasan_cuti`, `waktu_pengajuan`, `waktu_disetujui`, `created_at`, `updated_at`, `supervisor`) VALUES
(7, 'APPROVED', 'MENIKAR MURIP ', '14102007', 'SOSTENES PULANDA', '14102008', 'Taufiq Bahruddin', 'Taufiq Bahruddin', '1306413952', NULL, NULL, '2016-06-10', '2016-06-17', 'Break Reason 1', '2016-06-26 14:23:46', '0000-00-00 00:00:00', '2016-06-26 05:40:13', '2016-06-26 05:40:13', '1306413952'),
(8, 'DENIED', 'STEFEN ASEM', '14102009', 'DAVID NAKIAYA', '14102010', 'Taufiq Bahruddin', 'Taufiq Bahruddin', '1306413952', NULL, NULL, '2016-06-10', '2016-06-17', 'Break Reason 2', '2016-06-26 14:24:13', '0000-00-00 00:00:00', '2016-06-26 05:40:49', '2016-06-26 05:40:49', ''),
(9, 'APPROVED', 'MENIKAR MURIP ', '14102007', 'SOSTENES PULANDA', '14102008', 'Taufiq Bahruddin', 'Taufiq Bahruddin', '1306413952', NULL, NULL, '2016-06-01', '2016-06-03', 'Reason 1', '2016-06-29 17:06:25', '0000-00-00 00:00:00', '2016-06-29 09:08:55', '2016-06-29 09:08:55', '1306413952'),
(10, 'APPROVED', 'MENIKAR MURIP ', '14102007', 'SOSTENES PULANDA', '14102008', 'tev', 'Taufiq Bahruddin', '1306413952', NULL, NULL, '2016-06-02', '2016-06-24', 'rst1', '2016-06-29 21:38:47', '0000-00-00 00:00:00', '2016-06-29 14:37:49', '2016-06-29 14:37:49', '1306413952');

-- --------------------------------------------------------

--
-- Table structure for table `data_kota`
--

CREATE TABLE `data_kota` (
  `id` varchar(4) NOT NULL,
  `id_provinsi` varchar(2) NOT NULL,
  `name` varchar(256) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_kota`
--

INSERT INTO `data_kota` (`id`, `id_provinsi`, `name`) VALUES
('1101', '11', 'KABUPATEN SIMEULUE'),
('1102', '11', 'KABUPATEN ACEH SINGKIL'),
('1103', '11', 'KABUPATEN ACEH SELATAN'),
('1104', '11', 'KABUPATEN ACEH TENGGARA'),
('1105', '11', 'KABUPATEN ACEH TIMUR'),
('1106', '11', 'KABUPATEN ACEH TENGAH'),
('1107', '11', 'KABUPATEN ACEH BARAT'),
('1108', '11', 'KABUPATEN ACEH BESAR'),
('1109', '11', 'KABUPATEN PIDIE'),
('1110', '11', 'KABUPATEN BIREUEN'),
('1111', '11', 'KABUPATEN ACEH UTARA'),
('1112', '11', 'KABUPATEN ACEH BARAT DAYA'),
('1113', '11', 'KABUPATEN GAYO LUES'),
('1114', '11', 'KABUPATEN ACEH TAMIANG'),
('1115', '11', 'KABUPATEN NAGAN RAYA'),
('1116', '11', 'KABUPATEN ACEH JAYA'),
('1117', '11', 'KABUPATEN BENER MERIAH'),
('1118', '11', 'KABUPATEN PIDIE JAYA'),
('1171', '11', 'KOTA BANDA ACEH'),
('1172', '11', 'KOTA SABANG'),
('1173', '11', 'KOTA LANGSA'),
('1174', '11', 'KOTA LHOKSEUMAWE'),
('1175', '11', 'KOTA SUBULUSSALAM'),
('1201', '12', 'KABUPATEN NIAS'),
('1202', '12', 'KABUPATEN MANDAILING NATAL'),
('1203', '12', 'KABUPATEN TAPANULI SELATAN'),
('1204', '12', 'KABUPATEN TAPANULI TENGAH'),
('1205', '12', 'KABUPATEN TAPANULI UTARA'),
('1206', '12', 'KABUPATEN TOBA SAMOSIR'),
('1207', '12', 'KABUPATEN LABUHAN BATU'),
('1208', '12', 'KABUPATEN ASAHAN'),
('1209', '12', 'KABUPATEN SIMALUNGUN'),
('1210', '12', 'KABUPATEN DAIRI'),
('1211', '12', 'KABUPATEN KARO'),
('1212', '12', 'KABUPATEN DELI SERDANG'),
('1213', '12', 'KABUPATEN LANGKAT'),
('1214', '12', 'KABUPATEN NIAS SELATAN'),
('1215', '12', 'KABUPATEN HUMBANG HASUNDUTAN'),
('1216', '12', 'KABUPATEN PAKPAK BHARAT'),
('1217', '12', 'KABUPATEN SAMOSIR'),
('1218', '12', 'KABUPATEN SERDANG BEDAGAI'),
('1219', '12', 'KABUPATEN BATU BARA'),
('1220', '12', 'KABUPATEN PADANG LAWAS UTARA'),
('1221', '12', 'KABUPATEN PADANG LAWAS'),
('1222', '12', 'KABUPATEN LABUHAN BATU SELATAN'),
('1223', '12', 'KABUPATEN LABUHAN BATU UTARA'),
('1224', '12', 'KABUPATEN NIAS UTARA'),
('1225', '12', 'KABUPATEN NIAS BARAT'),
('1271', '12', 'KOTA SIBOLGA'),
('1272', '12', 'KOTA TANJUNG BALAI'),
('1273', '12', 'KOTA PEMATANG SIANTAR'),
('1274', '12', 'KOTA TEBING TINGGI'),
('1275', '12', 'KOTA MEDAN'),
('1276', '12', 'KOTA BINJAI'),
('1277', '12', 'KOTA PADANGSIDIMPUAN'),
('1278', '12', 'KOTA GUNUNGSITOLI'),
('1301', '13', 'KABUPATEN KEPULAUAN MENTAWAI'),
('1302', '13', 'KABUPATEN PESISIR SELATAN'),
('1303', '13', 'KABUPATEN SOLOK'),
('1304', '13', 'KABUPATEN SIJUNJUNG'),
('1305', '13', 'KABUPATEN TANAH DATAR'),
('1306', '13', 'KABUPATEN PADANG PARIAMAN'),
('1307', '13', 'KABUPATEN AGAM'),
('1308', '13', 'KABUPATEN LIMA PULUH KOTA'),
('1309', '13', 'KABUPATEN PASAMAN'),
('1310', '13', 'KABUPATEN SOLOK SELATAN'),
('1311', '13', 'KABUPATEN DHARMASRAYA'),
('1312', '13', 'KABUPATEN PASAMAN BARAT'),
('1371', '13', 'KOTA PADANG'),
('1372', '13', 'KOTA SOLOK'),
('1373', '13', 'KOTA SAWAH LUNTO'),
('1374', '13', 'KOTA PADANG PANJANG'),
('1375', '13', 'KOTA BUKITTINGGI'),
('1376', '13', 'KOTA PAYAKUMBUH'),
('1377', '13', 'KOTA PARIAMAN'),
('1401', '14', 'KABUPATEN KUANTAN SINGINGI'),
('1402', '14', 'KABUPATEN INDRAGIRI HULU'),
('1403', '14', 'KABUPATEN INDRAGIRI HILIR'),
('1404', '14', 'KABUPATEN PELALAWAN'),
('1405', '14', 'KABUPATEN S I A K'),
('1406', '14', 'KABUPATEN KAMPAR'),
('1407', '14', 'KABUPATEN ROKAN HULU'),
('1408', '14', 'KABUPATEN BENGKALIS'),
('1409', '14', 'KABUPATEN ROKAN HILIR'),
('1410', '14', 'KABUPATEN KEPULAUAN MERANTI'),
('1471', '14', 'KOTA PEKANBARU'),
('1473', '14', 'KOTA D U M A I'),
('1501', '15', 'KABUPATEN KERINCI'),
('1502', '15', 'KABUPATEN MERANGIN'),
('1503', '15', 'KABUPATEN SAROLANGUN'),
('1504', '15', 'KABUPATEN BATANG HARI'),
('1505', '15', 'KABUPATEN MUARO JAMBI'),
('1506', '15', 'KABUPATEN TANJUNG JABUNG TIMUR'),
('1507', '15', 'KABUPATEN TANJUNG JABUNG BARAT'),
('1508', '15', 'KABUPATEN TEBO'),
('1509', '15', 'KABUPATEN BUNGO'),
('1571', '15', 'KOTA JAMBI'),
('1572', '15', 'KOTA SUNGAI PENUH'),
('1601', '16', 'KABUPATEN OGAN KOMERING ULU'),
('1602', '16', 'KABUPATEN OGAN KOMERING ILIR'),
('1603', '16', 'KABUPATEN MUARA ENIM'),
('1604', '16', 'KABUPATEN LAHAT'),
('1605', '16', 'KABUPATEN MUSI RAWAS'),
('1606', '16', 'KABUPATEN MUSI BANYUASIN'),
('1607', '16', 'KABUPATEN BANYU ASIN'),
('1608', '16', 'KABUPATEN OGAN KOMERING ULU SELATAN'),
('1609', '16', 'KABUPATEN OGAN KOMERING ULU TIMUR'),
('1610', '16', 'KABUPATEN OGAN ILIR'),
('1611', '16', 'KABUPATEN EMPAT LAWANG'),
('1612', '16', 'KABUPATEN PENUKAL ABAB LEMATANG ILIR'),
('1613', '16', 'KABUPATEN MUSI RAWAS UTARA'),
('1671', '16', 'KOTA PALEMBANG'),
('1672', '16', 'KOTA PRABUMULIH'),
('1673', '16', 'KOTA PAGAR ALAM'),
('1674', '16', 'KOTA LUBUKLINGGAU'),
('1701', '17', 'KABUPATEN BENGKULU SELATAN'),
('1702', '17', 'KABUPATEN REJANG LEBONG'),
('1703', '17', 'KABUPATEN BENGKULU UTARA'),
('1704', '17', 'KABUPATEN KAUR'),
('1705', '17', 'KABUPATEN SELUMA'),
('1706', '17', 'KABUPATEN MUKOMUKO'),
('1707', '17', 'KABUPATEN LEBONG'),
('1708', '17', 'KABUPATEN KEPAHIANG'),
('1709', '17', 'KABUPATEN BENGKULU TENGAH'),
('1771', '17', 'KOTA BENGKULU'),
('1801', '18', 'KABUPATEN LAMPUNG BARAT'),
('1802', '18', 'KABUPATEN TANGGAMUS'),
('1803', '18', 'KABUPATEN LAMPUNG SELATAN'),
('1804', '18', 'KABUPATEN LAMPUNG TIMUR'),
('1805', '18', 'KABUPATEN LAMPUNG TENGAH'),
('1806', '18', 'KABUPATEN LAMPUNG UTARA'),
('1807', '18', 'KABUPATEN WAY KANAN'),
('1808', '18', 'KABUPATEN TULANGBAWANG'),
('1809', '18', 'KABUPATEN PESAWARAN'),
('1810', '18', 'KABUPATEN PRINGSEWU'),
('1811', '18', 'KABUPATEN MESUJI'),
('1812', '18', 'KABUPATEN TULANG BAWANG BARAT'),
('1813', '18', 'KABUPATEN PESISIR BARAT'),
('1871', '18', 'KOTA BANDAR LAMPUNG'),
('1872', '18', 'KOTA METRO'),
('1901', '19', 'KABUPATEN BANGKA'),
('1902', '19', 'KABUPATEN BELITUNG'),
('1903', '19', 'KABUPATEN BANGKA BARAT'),
('1904', '19', 'KABUPATEN BANGKA TENGAH'),
('1905', '19', 'KABUPATEN BANGKA SELATAN'),
('1906', '19', 'KABUPATEN BELITUNG TIMUR'),
('1971', '19', 'KOTA PANGKAL PINANG'),
('2101', '21', 'KABUPATEN KARIMUN'),
('2102', '21', 'KABUPATEN BINTAN'),
('2103', '21', 'KABUPATEN NATUNA'),
('2104', '21', 'KABUPATEN LINGGA'),
('2105', '21', 'KABUPATEN KEPULAUAN ANAMBAS'),
('2171', '21', 'KOTA B A T A M'),
('2172', '21', 'KOTA TANJUNG PINANG'),
('3101', '31', 'KABUPATEN KEPULAUAN SERIBU'),
('3171', '31', 'KOTA JAKARTA SELATAN'),
('3172', '31', 'KOTA JAKARTA TIMUR'),
('3173', '31', 'KOTA JAKARTA PUSAT'),
('3174', '31', 'KOTA JAKARTA BARAT'),
('3175', '31', 'KOTA JAKARTA UTARA'),
('3201', '32', 'KABUPATEN BOGOR'),
('3202', '32', 'KABUPATEN SUKABUMI'),
('3203', '32', 'KABUPATEN CIANJUR'),
('3204', '32', 'KABUPATEN BANDUNG'),
('3205', '32', 'KABUPATEN GARUT'),
('3206', '32', 'KABUPATEN TASIKMALAYA'),
('3207', '32', 'KABUPATEN CIAMIS'),
('3208', '32', 'KABUPATEN KUNINGAN'),
('3209', '32', 'KABUPATEN CIREBON'),
('3210', '32', 'KABUPATEN MAJALENGKA'),
('3211', '32', 'KABUPATEN SUMEDANG'),
('3212', '32', 'KABUPATEN INDRAMAYU'),
('3213', '32', 'KABUPATEN SUBANG'),
('3214', '32', 'KABUPATEN PURWAKARTA'),
('3215', '32', 'KABUPATEN KARAWANG'),
('3216', '32', 'KABUPATEN BEKASI'),
('3217', '32', 'KABUPATEN BANDUNG BARAT'),
('3218', '32', 'KABUPATEN PANGANDARAN'),
('3271', '32', 'KOTA BOGOR'),
('3272', '32', 'KOTA SUKABUMI'),
('3273', '32', 'KOTA BANDUNG'),
('3274', '32', 'KOTA CIREBON'),
('3275', '32', 'KOTA BEKASI'),
('3276', '32', 'KOTA DEPOK'),
('3277', '32', 'KOTA CIMAHI'),
('3278', '32', 'KOTA TASIKMALAYA'),
('3279', '32', 'KOTA BANJAR'),
('3301', '33', 'KABUPATEN CILACAP'),
('3302', '33', 'KABUPATEN BANYUMAS'),
('3303', '33', 'KABUPATEN PURBALINGGA'),
('3304', '33', 'KABUPATEN BANJARNEGARA'),
('3305', '33', 'KABUPATEN KEBUMEN'),
('3306', '33', 'KABUPATEN PURWOREJO'),
('3307', '33', 'KABUPATEN WONOSOBO'),
('3308', '33', 'KABUPATEN MAGELANG'),
('3309', '33', 'KABUPATEN BOYOLALI'),
('3310', '33', 'KABUPATEN KLATEN'),
('3311', '33', 'KABUPATEN SUKOHARJO'),
('3312', '33', 'KABUPATEN WONOGIRI'),
('3313', '33', 'KABUPATEN KARANGANYAR'),
('3314', '33', 'KABUPATEN SRAGEN'),
('3315', '33', 'KABUPATEN GROBOGAN'),
('3316', '33', 'KABUPATEN BLORA'),
('3317', '33', 'KABUPATEN REMBANG'),
('3318', '33', 'KABUPATEN PATI'),
('3319', '33', 'KABUPATEN KUDUS'),
('3320', '33', 'KABUPATEN JEPARA'),
('3321', '33', 'KABUPATEN DEMAK'),
('3322', '33', 'KABUPATEN SEMARANG'),
('3323', '33', 'KABUPATEN TEMANGGUNG'),
('3324', '33', 'KABUPATEN KENDAL'),
('3325', '33', 'KABUPATEN BATANG'),
('3326', '33', 'KABUPATEN PEKALONGAN'),
('3327', '33', 'KABUPATEN PEMALANG'),
('3328', '33', 'KABUPATEN TEGAL'),
('3329', '33', 'KABUPATEN BREBES'),
('3371', '33', 'KOTA MAGELANG'),
('3372', '33', 'KOTA SURAKARTA'),
('3373', '33', 'KOTA SALATIGA'),
('3374', '33', 'KOTA SEMARANG'),
('3375', '33', 'KOTA PEKALONGAN'),
('3376', '33', 'KOTA TEGAL'),
('3401', '34', 'KABUPATEN KULON PROGO'),
('3402', '34', 'KABUPATEN BANTUL'),
('3403', '34', 'KABUPATEN GUNUNG KIDUL'),
('3404', '34', 'KABUPATEN SLEMAN'),
('3471', '34', 'KOTA YOGYAKARTA'),
('3501', '35', 'KABUPATEN PACITAN'),
('3502', '35', 'KABUPATEN PONOROGO'),
('3503', '35', 'KABUPATEN TRENGGALEK'),
('3504', '35', 'KABUPATEN TULUNGAGUNG'),
('3505', '35', 'KABUPATEN BLITAR'),
('3506', '35', 'KABUPATEN KEDIRI'),
('3507', '35', 'KABUPATEN MALANG'),
('3508', '35', 'KABUPATEN LUMAJANG'),
('3509', '35', 'KABUPATEN JEMBER'),
('3510', '35', 'KABUPATEN BANYUWANGI'),
('3511', '35', 'KABUPATEN BONDOWOSO'),
('3512', '35', 'KABUPATEN SITUBONDO'),
('3513', '35', 'KABUPATEN PROBOLINGGO'),
('3514', '35', 'KABUPATEN PASURUAN'),
('3515', '35', 'KABUPATEN SIDOARJO'),
('3516', '35', 'KABUPATEN MOJOKERTO'),
('3517', '35', 'KABUPATEN JOMBANG'),
('3518', '35', 'KABUPATEN NGANJUK'),
('3519', '35', 'KABUPATEN MADIUN'),
('3520', '35', 'KABUPATEN MAGETAN'),
('3521', '35', 'KABUPATEN NGAWI'),
('3522', '35', 'KABUPATEN BOJONEGORO'),
('3523', '35', 'KABUPATEN TUBAN'),
('3524', '35', 'KABUPATEN LAMONGAN'),
('3525', '35', 'KABUPATEN GRESIK'),
('3526', '35', 'KABUPATEN BANGKALAN'),
('3527', '35', 'KABUPATEN SAMPANG'),
('3528', '35', 'KABUPATEN PAMEKASAN'),
('3529', '35', 'KABUPATEN SUMENEP'),
('3571', '35', 'KOTA KEDIRI'),
('3572', '35', 'KOTA BLITAR'),
('3573', '35', 'KOTA MALANG'),
('3574', '35', 'KOTA PROBOLINGGO'),
('3575', '35', 'KOTA PASURUAN'),
('3576', '35', 'KOTA MOJOKERTO'),
('3577', '35', 'KOTA MADIUN'),
('3578', '35', 'KOTA SURABAYA'),
('3579', '35', 'KOTA BATU'),
('3601', '36', 'KABUPATEN PANDEGLANG'),
('3602', '36', 'KABUPATEN LEBAK'),
('3603', '36', 'KABUPATEN TANGERANG'),
('3604', '36', 'KABUPATEN SERANG'),
('3671', '36', 'KOTA TANGERANG'),
('3672', '36', 'KOTA CILEGON'),
('3673', '36', 'KOTA SERANG'),
('3674', '36', 'KOTA TANGERANG SELATAN'),
('5101', '51', 'KABUPATEN JEMBRANA'),
('5102', '51', 'KABUPATEN TABANAN'),
('5103', '51', 'KABUPATEN BADUNG'),
('5104', '51', 'KABUPATEN GIANYAR'),
('5105', '51', 'KABUPATEN KLUNGKUNG'),
('5106', '51', 'KABUPATEN BANGLI'),
('5107', '51', 'KABUPATEN KARANG ASEM'),
('5108', '51', 'KABUPATEN BULELENG'),
('5171', '51', 'KOTA DENPASAR'),
('5201', '52', 'KABUPATEN LOMBOK BARAT'),
('5202', '52', 'KABUPATEN LOMBOK TENGAH'),
('5203', '52', 'KABUPATEN LOMBOK TIMUR'),
('5204', '52', 'KABUPATEN SUMBAWA'),
('5205', '52', 'KABUPATEN DOMPU'),
('5206', '52', 'KABUPATEN BIMA'),
('5207', '52', 'KABUPATEN SUMBAWA BARAT'),
('5208', '52', 'KABUPATEN LOMBOK UTARA'),
('5271', '52', 'KOTA MATARAM'),
('5272', '52', 'KOTA BIMA'),
('5301', '53', 'KABUPATEN SUMBA BARAT'),
('5302', '53', 'KABUPATEN SUMBA TIMUR'),
('5303', '53', 'KABUPATEN KUPANG'),
('5304', '53', 'KABUPATEN TIMOR TENGAH SELATAN'),
('5305', '53', 'KABUPATEN TIMOR TENGAH UTARA'),
('5306', '53', 'KABUPATEN BELU'),
('5307', '53', 'KABUPATEN ALOR'),
('5308', '53', 'KABUPATEN LEMBATA'),
('5309', '53', 'KABUPATEN FLORES TIMUR'),
('5310', '53', 'KABUPATEN SIKKA'),
('5311', '53', 'KABUPATEN ENDE'),
('5312', '53', 'KABUPATEN NGADA'),
('5313', '53', 'KABUPATEN MANGGARAI'),
('5314', '53', 'KABUPATEN ROTE NDAO'),
('5315', '53', 'KABUPATEN MANGGARAI BARAT'),
('5316', '53', 'KABUPATEN SUMBA TENGAH'),
('5317', '53', 'KABUPATEN SUMBA BARAT DAYA'),
('5318', '53', 'KABUPATEN NAGEKEO'),
('5319', '53', 'KABUPATEN MANGGARAI TIMUR'),
('5320', '53', 'KABUPATEN SABU RAIJUA'),
('5321', '53', 'KABUPATEN MALAKA'),
('5371', '53', 'KOTA KUPANG'),
('6101', '61', 'KABUPATEN SAMBAS'),
('6102', '61', 'KABUPATEN BENGKAYANG'),
('6103', '61', 'KABUPATEN LANDAK'),
('6104', '61', 'KABUPATEN MEMPAWAH'),
('6105', '61', 'KABUPATEN SANGGAU'),
('6106', '61', 'KABUPATEN KETAPANG'),
('6107', '61', 'KABUPATEN SINTANG'),
('6108', '61', 'KABUPATEN KAPUAS HULU'),
('6109', '61', 'KABUPATEN SEKADAU'),
('6110', '61', 'KABUPATEN MELAWI'),
('6111', '61', 'KABUPATEN KAYONG UTARA'),
('6112', '61', 'KABUPATEN KUBU RAYA'),
('6171', '61', 'KOTA PONTIANAK'),
('6172', '61', 'KOTA SINGKAWANG'),
('6201', '62', 'KABUPATEN KOTAWARINGIN BARAT'),
('6202', '62', 'KABUPATEN KOTAWARINGIN TIMUR'),
('6203', '62', 'KABUPATEN KAPUAS'),
('6204', '62', 'KABUPATEN BARITO SELATAN'),
('6205', '62', 'KABUPATEN BARITO UTARA'),
('6206', '62', 'KABUPATEN SUKAMARA'),
('6207', '62', 'KABUPATEN LAMANDAU'),
('6208', '62', 'KABUPATEN SERUYAN'),
('6209', '62', 'KABUPATEN KATINGAN'),
('6210', '62', 'KABUPATEN PULANG PISAU'),
('6211', '62', 'KABUPATEN GUNUNG MAS'),
('6212', '62', 'KABUPATEN BARITO TIMUR'),
('6213', '62', 'KABUPATEN MURUNG RAYA'),
('6271', '62', 'KOTA PALANGKA RAYA'),
('6301', '63', 'KABUPATEN TANAH LAUT'),
('6302', '63', 'KABUPATEN KOTA BARU'),
('6303', '63', 'KABUPATEN BANJAR'),
('6304', '63', 'KABUPATEN BARITO KUALA'),
('6305', '63', 'KABUPATEN TAPIN'),
('6306', '63', 'KABUPATEN HULU SUNGAI SELATAN'),
('6307', '63', 'KABUPATEN HULU SUNGAI TENGAH'),
('6308', '63', 'KABUPATEN HULU SUNGAI UTARA'),
('6309', '63', 'KABUPATEN TABALONG'),
('6310', '63', 'KABUPATEN TANAH BUMBU'),
('6311', '63', 'KABUPATEN BALANGAN'),
('6371', '63', 'KOTA BANJARMASIN'),
('6372', '63', 'KOTA BANJAR BARU'),
('6401', '64', 'KABUPATEN PASER'),
('6402', '64', 'KABUPATEN KUTAI BARAT'),
('6403', '64', 'KABUPATEN KUTAI KARTANEGARA'),
('6404', '64', 'KABUPATEN KUTAI TIMUR'),
('6405', '64', 'KABUPATEN BERAU'),
('6409', '64', 'KABUPATEN PENAJAM PASER UTARA'),
('6411', '64', 'KABUPATEN MAHAKAM HULU'),
('6471', '64', 'KOTA BALIKPAPAN'),
('6472', '64', 'KOTA SAMARINDA'),
('6474', '64', 'KOTA BONTANG'),
('6501', '65', 'KABUPATEN MALINAU'),
('6502', '65', 'KABUPATEN BULUNGAN'),
('6503', '65', 'KABUPATEN TANA TIDUNG'),
('6504', '65', 'KABUPATEN NUNUKAN'),
('6571', '65', 'KOTA TARAKAN'),
('7101', '71', 'KABUPATEN BOLAANG MONGONDOW'),
('7102', '71', 'KABUPATEN MINAHASA'),
('7103', '71', 'KABUPATEN KEPULAUAN SANGIHE'),
('7104', '71', 'KABUPATEN KEPULAUAN TALAUD'),
('7105', '71', 'KABUPATEN MINAHASA SELATAN'),
('7106', '71', 'KABUPATEN MINAHASA UTARA'),
('7107', '71', 'KABUPATEN BOLAANG MONGONDOW UTARA'),
('7108', '71', 'KABUPATEN SIAU TAGULANDANG BIARO'),
('7109', '71', 'KABUPATEN MINAHASA TENGGARA'),
('7110', '71', 'KABUPATEN BOLAANG MONGONDOW SELATAN'),
('7111', '71', 'KABUPATEN BOLAANG MONGONDOW TIMUR'),
('7171', '71', 'KOTA MANADO'),
('7172', '71', 'KOTA BITUNG'),
('7173', '71', 'KOTA TOMOHON'),
('7174', '71', 'KOTA KOTAMOBAGU'),
('7201', '72', 'KABUPATEN BANGGAI KEPULAUAN'),
('7202', '72', 'KABUPATEN BANGGAI'),
('7203', '72', 'KABUPATEN MOROWALI'),
('7204', '72', 'KABUPATEN POSO'),
('7205', '72', 'KABUPATEN DONGGALA'),
('7206', '72', 'KABUPATEN TOLI-TOLI'),
('7207', '72', 'KABUPATEN BUOL'),
('7208', '72', 'KABUPATEN PARIGI MOUTONG'),
('7209', '72', 'KABUPATEN TOJO UNA-UNA'),
('7210', '72', 'KABUPATEN SIGI'),
('7211', '72', 'KABUPATEN BANGGAI LAUT'),
('7212', '72', 'KABUPATEN MOROWALI UTARA'),
('7271', '72', 'KOTA PALU'),
('7301', '73', 'KABUPATEN KEPULAUAN SELAYAR'),
('7302', '73', 'KABUPATEN BULUKUMBA'),
('7303', '73', 'KABUPATEN BANTAENG'),
('7304', '73', 'KABUPATEN JENEPONTO'),
('7305', '73', 'KABUPATEN TAKALAR'),
('7306', '73', 'KABUPATEN GOWA'),
('7307', '73', 'KABUPATEN SINJAI'),
('7308', '73', 'KABUPATEN MAROS'),
('7309', '73', 'KABUPATEN PANGKAJENE DAN KEPULAUAN'),
('7310', '73', 'KABUPATEN BARRU'),
('7311', '73', 'KABUPATEN BONE'),
('7312', '73', 'KABUPATEN SOPPENG'),
('7313', '73', 'KABUPATEN WAJO'),
('7314', '73', 'KABUPATEN SIDENRENG RAPPANG'),
('7315', '73', 'KABUPATEN PINRANG'),
('7316', '73', 'KABUPATEN ENREKANG'),
('7317', '73', 'KABUPATEN LUWU'),
('7318', '73', 'KABUPATEN TANA TORAJA'),
('7322', '73', 'KABUPATEN LUWU UTARA'),
('7325', '73', 'KABUPATEN LUWU TIMUR'),
('7326', '73', 'KABUPATEN TORAJA UTARA'),
('7371', '73', 'KOTA MAKASSAR'),
('7372', '73', 'KOTA PAREPARE'),
('7373', '73', 'KOTA PALOPO'),
('7401', '74', 'KABUPATEN BUTON'),
('7402', '74', 'KABUPATEN MUNA'),
('7403', '74', 'KABUPATEN KONAWE'),
('7404', '74', 'KABUPATEN KOLAKA'),
('7405', '74', 'KABUPATEN KONAWE SELATAN'),
('7406', '74', 'KABUPATEN BOMBANA'),
('7407', '74', 'KABUPATEN WAKATOBI'),
('7408', '74', 'KABUPATEN KOLAKA UTARA'),
('7409', '74', 'KABUPATEN BUTON UTARA'),
('7410', '74', 'KABUPATEN KONAWE UTARA'),
('7411', '74', 'KABUPATEN KOLAKA TIMUR'),
('7412', '74', 'KABUPATEN KONAWE KEPULAUAN'),
('7413', '74', 'KABUPATEN MUNA BARAT'),
('7414', '74', 'KABUPATEN BUTON TENGAH'),
('7415', '74', 'KABUPATEN BUTON SELATAN'),
('7471', '74', 'KOTA KENDARI'),
('7472', '74', 'KOTA BAUBAU'),
('7501', '75', 'KABUPATEN BOALEMO'),
('7502', '75', 'KABUPATEN GORONTALO'),
('7503', '75', 'KABUPATEN POHUWATO'),
('7504', '75', 'KABUPATEN BONE BOLANGO'),
('7505', '75', 'KABUPATEN GORONTALO UTARA'),
('7571', '75', 'KOTA GORONTALO'),
('7601', '76', 'KABUPATEN MAJENE'),
('7602', '76', 'KABUPATEN POLEWALI MANDAR'),
('7603', '76', 'KABUPATEN MAMASA'),
('7604', '76', 'KABUPATEN MAMUJU'),
('7605', '76', 'KABUPATEN MAMUJU UTARA'),
('7606', '76', 'KABUPATEN MAMUJU TENGAH'),
('8101', '81', 'KABUPATEN MALUKU TENGGARA BARAT'),
('8102', '81', 'KABUPATEN MALUKU TENGGARA'),
('8103', '81', 'KABUPATEN MALUKU TENGAH'),
('8104', '81', 'KABUPATEN BURU'),
('8105', '81', 'KABUPATEN KEPULAUAN ARU'),
('8106', '81', 'KABUPATEN SERAM BAGIAN BARAT'),
('8107', '81', 'KABUPATEN SERAM BAGIAN TIMUR'),
('8108', '81', 'KABUPATEN MALUKU BARAT DAYA'),
('8109', '81', 'KABUPATEN BURU SELATAN'),
('8171', '81', 'KOTA AMBON'),
('8172', '81', 'KOTA TUAL'),
('8201', '82', 'KABUPATEN HALMAHERA BARAT'),
('8202', '82', 'KABUPATEN HALMAHERA TENGAH'),
('8203', '82', 'KABUPATEN KEPULAUAN SULA'),
('8204', '82', 'KABUPATEN HALMAHERA SELATAN'),
('8205', '82', 'KABUPATEN HALMAHERA UTARA'),
('8206', '82', 'KABUPATEN HALMAHERA TIMUR'),
('8207', '82', 'KABUPATEN PULAU MOROTAI'),
('8208', '82', 'KABUPATEN PULAU TALIABU'),
('8271', '82', 'KOTA TERNATE'),
('8272', '82', 'KOTA TIDORE KEPULAUAN'),
('9101', '91', 'KABUPATEN FAKFAK'),
('9102', '91', 'KABUPATEN KAIMANA'),
('9103', '91', 'KABUPATEN TELUK WONDAMA'),
('9104', '91', 'KABUPATEN TELUK BINTUNI'),
('9105', '91', 'KABUPATEN MANOKWARI'),
('9106', '91', 'KABUPATEN SORONG SELATAN'),
('9107', '91', 'KABUPATEN SORONG'),
('9108', '91', 'KABUPATEN RAJA AMPAT'),
('9109', '91', 'KABUPATEN TAMBRAUW'),
('9110', '91', 'KABUPATEN MAYBRAT'),
('9111', '91', 'KABUPATEN MANOKWARI SELATAN'),
('9112', '91', 'KABUPATEN PEGUNUNGAN ARFAK'),
('9171', '91', 'KOTA SORONG'),
('9401', '94', 'KABUPATEN MERAUKE'),
('9402', '94', 'KABUPATEN JAYAWIJAYA'),
('9403', '94', 'KABUPATEN JAYAPURA'),
('9404', '94', 'KABUPATEN NABIRE'),
('9408', '94', 'KABUPATEN KEPULAUAN YAPEN'),
('9409', '94', 'KABUPATEN BIAK NUMFOR'),
('9410', '94', 'KABUPATEN PANIAI'),
('9411', '94', 'KABUPATEN PUNCAK JAYA'),
('9412', '94', 'KABUPATEN MIMIKA'),
('9413', '94', 'KABUPATEN BOVEN DIGOEL'),
('9414', '94', 'KABUPATEN MAPPI'),
('9415', '94', 'KABUPATEN ASMAT'),
('9416', '94', 'KABUPATEN YAHUKIMO'),
('9417', '94', 'KABUPATEN PEGUNUNGAN BINTANG'),
('9418', '94', 'KABUPATEN TOLIKARA'),
('9419', '94', 'KABUPATEN SARMI'),
('9420', '94', 'KABUPATEN KEEROM'),
('9426', '94', 'KABUPATEN WAROPEN'),
('9427', '94', 'KABUPATEN SUPIORI'),
('9428', '94', 'KABUPATEN MAMBERAMO RAYA'),
('9429', '94', 'KABUPATEN NDUGA'),
('9430', '94', 'KABUPATEN LANNY JAYA'),
('9431', '94', 'KABUPATEN MAMBERAMO TENGAH'),
('9432', '94', 'KABUPATEN YALIMO'),
('9433', '94', 'KABUPATEN PUNCAK'),
('9434', '94', 'KABUPATEN DOGIYAI'),
('9435', '94', 'KABUPATEN INTAN JAYA'),
('9436', '94', 'KABUPATEN DEIYAI'),
('9471', '94', 'KOTA JAYAPURA');

-- --------------------------------------------------------

--
-- Table structure for table `data_pegawai`
--

CREATE TABLE `data_pegawai` (
  `nip` varchar(128) NOT NULL,
  `branch` varchar(128) NOT NULL,
  `supervisor` varchar(128) DEFAULT NULL,
  `nama_lengkap` varchar(512) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` varchar(8) DEFAULT NULL,
  `no_telp` varchar(32) DEFAULT NULL,
  `no_hp` varchar(32) DEFAULT NULL,
  `email` varchar(256) DEFAULT NULL,
  `status_pernikahan` varchar(16) DEFAULT NULL,
  `kewarganegaraan` varchar(256) DEFAULT NULL,
  `no_ktp` varchar(32) DEFAULT NULL,
  `alamat` varchar(1024) DEFAULT NULL,
  `provinsi` varchar(8) DEFAULT NULL,
  `provinsi_nama` varchar(128) DEFAULT NULL,
  `kota` varchar(8) DEFAULT NULL,
  `kota_nama` varchar(128) DEFAULT NULL,
  `kecamatan` varchar(128) DEFAULT NULL,
  `kelurahan` varchar(128) DEFAULT NULL,
  `kode_pos` varchar(32) DEFAULT NULL,
  `suku` varchar(128) DEFAULT NULL,
  `literasi_membaca` varchar(8) DEFAULT NULL,
  `literasi_menulis` varchar(8) DEFAULT NULL,
  `pendidikan` varchar(16) DEFAULT NULL,
  `riwayat_penyakit` varchar(2048) DEFAULT NULL,
  `bpjs_kesehatan` varchar(64) DEFAULT NULL,
  `bpjs_ketenagakerjaan` varchar(64) DEFAULT NULL,
  `asurasi` varchar(512) DEFAULT NULL,
  `jenis_jabatan` int(11) DEFAULT NULL,
  `jenis_jabatan_nama` varchar(256) DEFAULT NULL,
  `jenis_divisi` int(11) DEFAULT NULL,
  `jenis_divisi_nama` varchar(256) DEFAULT NULL,
  `nama_pasangan` varchar(512) DEFAULT NULL,
  `jumlah_anak` smallint(6) DEFAULT NULL,
  `nama_anak_1` varchar(512) DEFAULT NULL,
  `nama_anak_2` varchar(512) DEFAULT NULL,
  `nama_anak_3` varchar(512) DEFAULT NULL,
  `nama_ibu` varchar(512) DEFAULT NULL,
  `nama_ayah` varchar(512) DEFAULT NULL,
  `kontak_keluarga_1` varchar(128) DEFAULT NULL,
  `kontak_keluarga_2` varchar(128) DEFAULT NULL,
  `instansi_terakhir` varchar(256) DEFAULT NULL,
  `pangkat` varchar(256) DEFAULT NULL,
  `jabatan` varchar(256) DEFAULT NULL,
  `status` varchar(64) DEFAULT NULL,
  `catatan_kinerja` text,
  `masa_kontrak_mulai` date DEFAULT NULL,
  `masa_kontrak_selesai` date DEFAULT NULL,
  `tanggal_bergabung` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_pegawai`
--

INSERT INTO `data_pegawai` (`nip`, `branch`, `supervisor`, `nama_lengkap`, `tanggal_lahir`, `jenis_kelamin`, `no_telp`, `no_hp`, `email`, `status_pernikahan`, `kewarganegaraan`, `no_ktp`, `alamat`, `provinsi`, `provinsi_nama`, `kota`, `kota_nama`, `kecamatan`, `kelurahan`, `kode_pos`, `suku`, `literasi_membaca`, `literasi_menulis`, `pendidikan`, `riwayat_penyakit`, `bpjs_kesehatan`, `bpjs_ketenagakerjaan`, `asurasi`, `jenis_jabatan`, `jenis_jabatan_nama`, `jenis_divisi`, `jenis_divisi_nama`, `nama_pasangan`, `jumlah_anak`, `nama_anak_1`, `nama_anak_2`, `nama_anak_3`, `nama_ibu`, `nama_ayah`, `kontak_keluarga_1`, `kontak_keluarga_2`, `instansi_terakhir`, `pangkat`, `jabatan`, `status`, `catatan_kinerja`, `masa_kontrak_mulai`, `masa_kontrak_selesai`, `tanggal_bergabung`, `created_at`, `updated_at`) VALUES
('14102007', 'MS', '1306413952', 'MENIKAR MURIP ', '2016-04-20', 'PRIA', '555', '', '', 'TK', 'INDONESIA', '', '', '17', 'BENGKULU', '1701', 'KABUPATEN BENGKULU SELATAN', NULL, NULL, '', '', 'YA', 'YA', 'TIDAK SEKOLAH', '', '', '', '', 2, 'GEN FORMAN', 1, 'TERMINAL', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', '2016-06-29 21:35:22', '2016-06-29 14:35:22'),
('14102008', 'MS', '', 'SOSTENES PULANDA', '0000-00-00', '', '', '', '', '', '', '', '', '36', 'BANTEN', '3603', 'KABUPATEN TANGERANG', NULL, NULL, '', '', '', '', '', '', '', '', '', 1, 'ANGGOTA', 1, 'TERMINAL', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', '2016-06-07 13:03:14', '2016-06-07 06:03:14'),
('14102009', 'MS', '', 'STEFEN ASEM', '0000-00-00', '', '', '', '', 'K1', 'INDONESIA', '', '', '17', 'BENGKULU', '1701', 'KABUPATEN BENGKULU SELATAN', NULL, NULL, '', '', '', '', '', '', '', '', '', 1, 'ANGGOTA', 1, 'TERMINAL', '', 2, '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-20 16:41:53', '2016-04-20 09:41:53'),
('14102010', 'MS', '', 'DAVID NAKIAYA', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102011', 'MS', '', 'HENGKY MOSES MOFU', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102012', 'MS', '', 'ALFINUS THOMAS ERICK PSAKOR', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102013', 'MS', '', 'ANTON CS KBAREK', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102014', 'MS', '', 'ANTONIUS KAMEYAU', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102015', 'MS', '', 'WES MAGAI', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102016', 'MS', '', 'YOHANES Y. MUKA', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102017', 'MS', '', 'CLEMENS F.E. METAWEYAU', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102018', 'MS', '', 'FREDRIK YOBI', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102019', 'MS', '', 'JOHANES WARWER', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102020', 'MS', '', 'DAVID WEPAOTAH', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102021', 'MS', '', 'YOSEPH MUKURU', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102022', 'MS', '', 'BARNABAS ARURI', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102023', 'MS', '', 'YAKOBUS INGGAMER', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102024', 'MS', '', 'YOHANES RUMPAMPONO', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102025', 'MS', '', 'YULIANUS OKYARE', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102026', 'MS', '', 'LEUNART REWANG', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102027', 'MS', '', 'SYORS FERI I.M', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102028', 'MS', '', 'TADIUS MAWAPOKA', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102029', 'MS', '', 'FALLENTINUS MAIWIPA', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102030', 'MS', '', 'MELIANUS PEKEY', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102031', 'MS', '', 'SANDY RUMBIAK', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102032', 'MS', '', 'ZAKEUS DEREK TIBERI', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102033', 'MS', '', 'HENDRIKUS MAURI', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102034', 'MS', '', 'CHARLES MIKEL WAIPUMI', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102035', 'MS', '', 'ELLIAS YARANGGA', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102036', 'MS', '', 'FENCE CHRISTIAN MORIN', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102037', 'MS', '', 'FERNANDO TUTUPIA', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102038', 'MS', '', 'GEORGORIUS USAPMEN', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102039', 'MS', '', 'HENDRIKUS MAMEPAYAUTA', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102040', 'MS', '', 'IVAN HARLEX AWISIRRI', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102041', 'MS', '', 'JEMBRIS NAUW', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102042', 'MS', '', 'JHON YANSEN MARADONA YOKU', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102043', 'MS', '', 'PHILEAN FERDINAN DULLAH', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102044', 'MS', '', 'RAYMOND SROYER', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102045', 'MS', '', 'RIKSON MERAWEYAU', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102046', 'MS', '', 'YOHANES SAMUEL BURDAM', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102047', 'MS', '', 'YOHANIS MUKURU', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102048', 'MS', '', 'EDMONTON CRISTOMAS AFAAR', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102049', 'MS', '', 'FERRY RUMAROPEN', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102050', 'MS', '', 'APO WANDAGAU', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102051', 'MS', '', 'ATINUS ALOM', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102052', 'MS', '', 'DEMI KARAGANAL', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102053', 'MS', '', 'DEMINUS TABUNI', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102054', 'MS', '', 'ENOS TIPAGAU', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102055', 'MS', '', 'GUS MAGAI', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102056', 'MS', '', 'IRON WANIMBO', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102057', 'MS', '', 'MELIANUS NATKIME', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102058', 'MS', '', 'PERINUS MAGAI', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102059', 'MS', '', 'PONAIR WEYA ', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102060', 'MS', '', 'TERVI MAGAI', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102061', 'MS', '', 'TINUS DOLAME', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102062', 'MS', '', 'TEROPIANUS', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102063', 'MS', '', 'YAKUB MAGAI', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102064', 'MS', '', 'YUBALUAK MURIB', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102065', 'MS', '', 'YULIUS WANDIK', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102066', 'MS', '', 'AKINAS WANDAGAI', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102067', 'MS', '', 'ABAS TABUNI', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102068', 'MS', '', 'ANTON WENDA. A', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102069', 'MS', '', 'ANTON WENDA. B', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102070', 'MS', '', 'ATINUS KOGOYA', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102071', 'MS', '', 'DINAIR KOGOYA', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102072', 'MS', '', 'DOMI KIWAK', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102073', 'MS', '', 'ELPIN MAGAI', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102074', 'MS', '', 'ISMAEL ALOM', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102075', 'MS', '', 'ISSAK SAMPE', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102076', 'MS', '', 'JARAMPING PIRRIN', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102077', 'MS', '', 'LAKIUS MOSIP', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102078', 'MS', '', 'LARIUS JARINAP', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102079', 'MS', '', 'MAIKO KOBOGAU', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102080', 'MS', '', 'NERIUS WENDA', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102081', 'MS', '', 'OBINUS KIWAK', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102082', 'MS', '', 'TINUS KOGOYA', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102083', 'MS', '', 'YEKIUS YEKWA', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102084', 'MS', '', 'YODIANUS MAGAI', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102085', 'MS', '', 'YONGKY WANDIK', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102086', 'MS', '', 'YORMIN WENDA', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102087', 'MS', '', 'YUSMAN WENDA', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102088', 'MS', '', 'ANIS MAGAI', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102089', 'MS', '', 'DEPANUS JIKWA', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102090', 'MS', '', 'EREBEAM KUM', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102091', 'MS', '', 'ESAU MAGAI', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102092', 'MS', '', 'HARUN WENDA ', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102093', 'MS', '', 'KANGGO ALOM ', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102094', 'MS', '', 'LANDA IMING', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102095', 'MS', '', 'NATAN WANDAGAU', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102096', 'MS', '', 'NELIUS TABUNI', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102097', 'MS', '', 'HUBUNGGA WAKER', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102098', 'MS', '', 'PINIUS MAGAI ', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102099', 'MS', '', 'UMAN WAKER', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102100', 'MS', '', 'WANUS MOSIP', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102101', 'MS', '', 'WELLISON EMEYAUTA', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102102', 'MS', '', 'WENDIS ALOM', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102103', 'MS', '', 'YUSAK KOGOYA', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102104', 'MS', '', 'ANTON BEANAL', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102105', 'MS', '', 'DINUS MURIB', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102106', 'MS', '', 'DONIUS WENDA', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102107', 'MS', '', 'HERMAN WENDA', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102108', 'MS', '', 'PETRUS KORA', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102109', 'MS', '', 'TERI LABENE', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102110', 'MS', '', 'WENDIRON WENDA', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102111', 'MS', '', 'YANCE YOHANES TENOUYE', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102112', 'MS', '', 'ARDI WENDA', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102113', 'MS', '', 'AYUB KOBOGAU', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102114', 'MS', '', 'ELIGIUS SIEP', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102115', 'MS', '', 'ERSON ZONDEGAU', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102116', 'MS', '', 'JHON NAKIAYA', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102117', 'MS', '', 'YUMANUS WAKER', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102118', 'MS', '', 'JUNI MAGAI', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102119', 'MS', '', 'MALUK KOGOYA', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102120', 'MS', '', 'MESAK WENDA', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102121', 'MS', '', 'OPEN SELEGANI', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('14102122', 'MS', '', 'TOMI DIWITAU', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', 0, '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:06:59', '2016-04-18 07:06:59'),
('80002191', 'MAWAR11', '', 'JOAN HENDRIKO KOMALING', '0000-00-00', 'Pria', '', '82198080626', '', 'TK', 'Indonesia', '7.10E+15', 'Desa Tounglet Kec.Kakas Minahasa Sulut', '71', 'Sulawesi Utara', '', 'KAKAS', NULL, NULL, '95682', 'Non Papua', 'YA', 'YA', 'SMA', '', '000.1243.796635', '', '', 1, 'ANGGOTA', 4, 'RIDGE CAMP', '', 0, '', '', '', 'REINNY LUMI', 'HERMAN KOMALING', '85255998022', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80002195', 'MAWAR11', '', 'ASIS', '0000-00-00', 'Pria', '', '85244109678', '', 'K1', 'Indonesia', '7.17E+15', 'Lingkungan IV,004,Sario KotaBaru', '71', 'Sulawesi Utara', '', 'Sario', NULL, NULL, '', 'Non Papua', 'YA', 'YA', 'SMA', '', '1243796949', '', '', 1, 'ANGGOTA', 2, 'GORONG-GORONG', 'RANI C.BINANGAL', 0, '', '', '', 'WA PILI', 'RAFLES', '81330529645', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80002208', 'MAWAR11', '', 'RIVANDY PIAY', '0000-00-00', 'Pria', '', '85256988188', 'IVANPIAY87@GMAIL.COM', 'TK', 'Indonesia', '7.10E+15', 'Paslaten Jaga 3', '71', 'Sulawesi Utara', '', 'KAKAS', NULL, NULL, '95682', 'Non Papua', 'YA', 'YA', 'SMA', '', '1243796624', '', '', 1, 'ANGGOTA', 3, 'MULKI', '', 0, '', '', '', 'DETTY KAMASI', 'ADRIANUS PIAY (ALM)', '85256676980', '85396265044', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80005109', 'MAWAR11', '', 'ANDRE BRENHARD', '0000-00-00', 'Pria', '', '82198342208', 'KOMALINGLUMBAA@GMAIL.COM', 'K1', 'Indonesia', '3.17E+15', 'Kalibata Selatan 005/004 ', '31', 'Dki Jakarta', '', 'PANCORAN', NULL, NULL, '', 'Non Papua', 'YA', 'YA', 'SMA', '', '1243796872', '', '', 2, 'GEN FORMAN', 5, 'FAMILY SHOOPING', 'YULI WINARSIH', 1, 'ANANDA KEYVINO LUMBAA', '', '', 'RAHAYU', 'YOHANES LUMBAA (ALM)', '81219628502', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80005141', 'MAWAR11', '', 'MUSTAR', '0000-00-00', 'Pria', '', '82248008356', '', 'K2', 'Indonesia', '7.31E+15', 'Kalumbangara', '73', 'Sulawesi Selatan', '', 'Polong Bangkeng Selatan', NULL, NULL, '', 'Non Papua', 'YA', 'YA', 'SMA', '', '1243797063', '', '', 1, 'ANGGOTA', 2, 'GORONG-GORONG', 'MARBIATI', 1, 'RAJAMUDDIN M. NUR', '', '', 'M DG SOMPA', 'L DG NURU', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80005142', 'MAWAR11', '', 'ALFAUZAN NAIM JATI KUSUMA', '0000-00-00', 'Pria', '', '81248624229', '', 'TK', 'Indonesia', '1.87E+15', 'Jl. Teluk Ambon 6 Rajawali no.32 RT. 002 lk. III Pidada Panjang ', '16', 'Sumatera Selatan', '', 'PANJANG', NULL, NULL, '35421', 'Non Papua', 'YA', 'YA', 'SMK', '', '1243796714', '', '', 1, 'ANGGOTA', 4, 'RIDGE CAMP', '', 0, '', '', '', 'WIWIK HERAWATI', 'SARJI', '85269017788', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80005144', 'MAWAR11', '', 'ALFIN PRADA SAPUTRA', '0000-00-00', 'Pria', '', '81284166798', '', 'TK', 'Indonesia', '3.37E+15', 'Kp. Jagalan rt.002 Rw.15 Jebres Surakarta Solo Jateng', '33', 'Jawa Tengah', '', 'JEBRES', NULL, NULL, '57124', 'Non Papua', 'YA', 'YA', 'STM', '', '1243796207', '', '', 1, 'ANGGOTA', 4, 'RIDGE CAMP', '', 0, '', '', '', 'SRI THOMAS ASYIANI', 'JOKO SUTOTO', '82226941583', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80005145', 'MAWAR11', '', 'GUSTIAN PURNOMO', '0000-00-00', 'Pria', '', '81289042715', 'GUSTIAN.1991@GMAIL.COM', 'TK', 'Indonesia', '3.22E+15', 'Kp. Pasir Meong Rt 01/04 Cililin Bandung', '32', 'Jawa Barat', '', 'CILILIN', NULL, NULL, '40562', 'Non Papua', 'YA', 'YA', 'SMA', '', '1243796602', '', '', 1, 'ANGGOTA', 4, 'RIDGE CAMP', '', 0, '', '', '', 'SOLIHAT', 'U.M. PURNOMO', '81221906102', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80005146', 'MAWAR11', '', 'SOLIHIN', '0000-00-00', 'Pria', '', '81383984534', '', 'TK', 'Indonesia', '1.80E+15', 'Suka Baru RT 003 RW 002 Kec.Ranengahan Kab. Lampung Selatan, Lampung', '16', 'Sumatera Selatan', '', 'RANENGAHAN', NULL, NULL, '', 'Non Papua', 'YA', 'YA', 'SMK', '', '1243796883', '', '', 1, 'ANGGOTA', 4, 'RIDGE CAMP', '', 0, '', '', '', 'ARYAH', 'ABDUL MUIN', '85219693424', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80005147', 'MAWAR11', '', 'RASLIN', '0000-00-00', 'Pria', '', '85340747049', '', 'TK', 'Indonesia', '7.31E+15', 'Dusun Bunga eja Ds. Tukamasea Kec. Bantimurung Kab. Maros Sulsel', '73', 'Sulawesi Selatan', '', 'BANTI MURUNG', NULL, NULL, '90561', 'Non Papua', 'YA', 'YA', 'SMA', '', '1243796139', '', '', 1, 'ANGGOTA', 4, 'RIDGE CAMP', '', 0, '', '', '', 'HJ. MERA', 'RAUPE', '85340652853', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80005148', 'MAWAR11', '', 'CANDRA DWI WAHYUDI', '0000-00-00', 'Pria', '', '82324707462', '', 'TK', 'Indonesia', '3.31E+15', 'Jl. Teri Rt. 03/13 Cilacap Selatan Jateng', '33', 'Jawa Tengah', '', 'JOGONALAN', NULL, NULL, '57452', 'Non Papua', 'YA', 'YA', 'SMA', '', '1243796973', '', '', 1, 'ANGGOTA', 4, 'RIDGE CAMP', '', 0, '', '', '', 'SUMINARNI', 'CARMIN SURYO YUWONO', '87803852478', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80005150', 'MAWAR11', '', 'SUDIRMAN', '0000-00-00', 'Pria', '', '85399470060', '', 'K1', 'Indonesia', '7.31E+15', 'Batiling,Labakkang 003/002 Batara', '73', 'Sulawesi Selatan', '', 'Labakkang', NULL, NULL, '', 'Non Papua', 'YA', 'YA', 'SMA', '', '1243796703', '', '', 1, 'ANGGOTA', 2, 'GORONG-GORONG', 'NUR AFNI THAHIR', 2, 'NUR SAYYIDAH NAFISAH', 'MUHAMAD AFIQ ABID', '', 'HASNA', 'SUBUH', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80005152', 'MAWAR11', '', 'SUHARYANTO GIMON', '0000-00-00', 'Pria', '', '82316133838', 'WAWANGIMON@GMAIL.COM', 'TK', 'Indonesia', '3.22E+15', 'Blok Komando No.12 Rt.05 Rw.07 Kel. Galanggang Kec. Batujajar Bandung Barat', '32', 'Jawa Barat', '', 'BATUJAJAR', NULL, NULL, '95373', 'Non Papua', 'YA', 'YA', 'SMA', '', '1243796589', '', '', 1, 'ANGGOTA', 4, 'RIDGE CAMP', '', 0, '', '', '', 'MARLINA WANTANIA', 'EDY GIMON', '85340054955', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80005153', 'MAWAR11', '', 'ALLEN KOMALING', '0000-00-00', 'Pria', '', '8114958060', 'A.KOMALING@HOTMAIL.COM', 'TK', 'Indonesia', '7.10E+15', 'Paslaten Jaga 2', '71', 'Sulawesi Utara', '', 'KAKAS', NULL, NULL, '95682', 'Non Papua', 'YA', 'YA', 'SMA', '', '1243796545', '', '', 1, 'ANGGOTA', 3, 'MULKI', '', 0, '', '', '', 'LINDA MAMOTO', 'WELLY KOMALING', '82395294282', '82190876919', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80005154', 'MAWAR11', '', 'RIBYO TRI ARYANTO', '0000-00-00', 'Pria', '', '81327102086', '', 'TK', 'Indonesia', '3.31E+15', 'Nanasan Rt.002 Rw.003 Malangjiwan Colomadu Karanganyar ', '33', 'Jawa Tengah', '', 'COLOMADU', NULL, NULL, '57177', 'Non Papua', 'YA', 'YA', 'SMA', '', '1243797175', '', '', 1, 'ANGGOTA', 4, 'RIDGE CAMP', '', 0, '', '', '', 'DARYANI', 'KUSAIRI', '87712343686', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80005155', 'MAWAR11', '', 'AWAL', '0000-00-00', 'Pria', '', '82239181396', '', 'TK', 'Indonesia', '7.31E+15', 'Bontowa Rt.01 Kel.Labakkan Pangkep Sulsel', '73', 'Sulawesi Selatan', '', 'LABAKKANG', NULL, NULL, '90653', 'Non Papua', 'YA', 'YA', 'SMA', '', '1243797096', '', '', 1, 'ANGGOTA', 4, 'RIDGE CAMP', '', 0, '', '', '', 'SALMAH', 'HAMKA', '85256235423', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80005156', 'MAWAR11', '', 'AHMAT SUPRIYONO', '0000-00-00', 'Pria', '', '81293962839', '', 'TK', 'Indonesia', '3.51E+15', 'Jl. Arjuna 1/15 Rt. 03/024 Lumajang Jatim', '35', 'Jawa Timur', '', 'LUMAJANG', NULL, NULL, '67311', 'Non Papua', 'YA', 'YA', 'SMK', '', '1243796523', '', '', 4, 'ADM. OPERATOR', 4, 'RIDGE CAMP', '', 0, '', '', '', 'MUJIATI', 'SUWARDI', '85336085606', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80005157', 'MAWAR11', '', 'JIJANG SARIPUDDIN', '0000-00-00', 'Pria', '', '82227488855', '', 'K1', 'Indonesia', '3.22E+15', 'Kp. Dayenn Luhur Rt.002 Rw.006 Kec. Cililin Kel. Batulayan Bandung', '32', 'Jawa Barat', '', 'CILILIN', NULL, NULL, '40562', 'Non Papua', 'YA', 'YA', 'SMA', '', '1243796196', '', '', 1, 'ANGGOTA', 4, 'RIDGE CAMP', 'NENDEN RENGGANIS', 1, 'AULIA IZZATUNNISA', '', '', 'IYAM', 'TOHA', '81322458102', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80005158', 'MAWAR11', '', 'MUHAMMAD FADLI', '0000-00-00', 'Pria', '', '81230978442', '', 'TK', 'Indonesia', '7.31E+15', 'Banggae Kel. Bonto Langkasa Kec. Minahasa Tene Kab. Pangkep Sulsel', '73', 'Sulawesi Selatan', '', 'MINAHASA', NULL, NULL, '90618', 'Non Papua', 'YA', 'YA', 'SMA', '', '1243796466', '', '', 1, 'ANGGOTA', 4, 'RIDGE CAMP', '', 0, '', '', '', 'MARHANA', 'SYARIFUDDIN', '82187864311', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80005159', 'MAWAR11', '', 'M ISA ANSORI', '0000-00-00', 'Pria', '', '81221763863', 'M.ISAANSORI94@GMAIL.COM', 'K0', 'Indonesia', '3.22E+15', 'Kp.Bobojong Rt 01 Rw 02 Ds. Mukapayung Kec.Cililin Kab. Bandung Barat', '32', 'Jawa Barat', '', 'CILILIN', NULL, NULL, '40562', 'Non Papua', 'YA', 'YA', 'SMA', '', '1243796725', '', '', 4, 'ADM. OPERATOR', 3, 'MULKI', 'AI YUNI NURFARIDA', 0, '', '', '', 'AI CUCU JUARIAH', 'USEP SAPRUDIN', '81221878573', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80005160', 'MAWAR11', '', 'AHMAD HASAN', '0000-00-00', 'Pria', '', '81367512657', '', 'TK', 'Indonesia', '1.80E+15', 'Banjarmasin Rt.01/01 Penengahan Lampung Selatan', '16', 'Sumatera Selatan', '', 'PENENGAHAN', NULL, NULL, '35592', 'Non Papua', 'YA', 'YA', 'SMA', '', '1243796321', '', '', 1, 'ANGGOTA', 4, 'RIDGE CAMP', '', 0, '', '', '', 'ROKIYAH', 'A.SIKIN', '85211390824', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80005161', 'MAWAR11', '', 'DANI ISKANDAR', '0000-00-00', 'Pria', '', '81294341422', '', 'K0', 'Indonesia', '3.60E+15', 'KP Salabentar,Majasari 002/006 Cilaja', '36', 'Banten', '', 'Majasari', NULL, NULL, '', 'Non Papua', 'YA', 'YA', 'SMA', '', '1243796308', '', '', 1, 'ANGGOTA', 2, 'GORONG-GORONG', 'RIZKA WULANDARI', 0, '', '', '', 'NURHASANAH', 'MAMAN SUPARMAN', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80005162', 'MAWAR11', '', 'SURIADI HASNA', '0000-00-00', 'Pria', '', '81344019147', '', 'TK', 'Indonesia', '7.31E+15', 'Panritae Ds.Parenreng Segeri Pangkep Sulsel ', '73', 'Sulawesi Selatan', '', 'SEGERI', NULL, NULL, '90655', 'Non Papua', 'YA', 'YA', 'SMA', '', '1243797208', '', '', 1, 'ANGGOTA', 4, 'RIDGE CAMP', '', 0, '', '', '', 'HASNA', 'BASRI', '8.23E+11', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80005165', 'MAWAR11', '', 'HENDRA NASUTION', '0000-00-00', 'Pria', '', '85231798777', 'HENDRANAST75@GMAIL.COM', 'K2', 'Indonesia', '3.51E+15', 'DsN.Baloli,000/000 Baebunta', '16', 'Sulawesi Selatan', '', 'Baebunta', NULL, NULL, '', 'Non Papua', 'YA', 'YA', 'S1', '', '1243796049', '', '', 6, 'GENERAL MANAGER', 2, 'GORONG-GORONG', 'SUSANTI JAYA', 2, 'NASWA NASUTION', 'QISYA NASUTION', '', 'KEMALAWATI(ALMH)', 'H.MASKUDDIN(ALM)', '82347621917', '82110516171', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80005166', 'MAWAR11', '', 'JUSTARDI', '0000-00-00', 'Pria', '', '82221157190', '', 'TK', 'Indonesia', '3.17E+15', 'Jl. Kemang Barat III Kel. Bangka Kec. Mampang Jak-Sel', '31', 'DKI Jakarta', '', 'MAMPANG', NULL, NULL, '12790', 'Non Papua', 'YA', 'YA', 'SMP', '', '1243796319', '', '', 1, 'ANGGOTA', 4, 'RIDGE CAMP', '', 0, '', '', '', 'MASRIA', 'ALM. DJATMIKO', '81210377965', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06');
INSERT INTO `data_pegawai` (`nip`, `branch`, `supervisor`, `nama_lengkap`, `tanggal_lahir`, `jenis_kelamin`, `no_telp`, `no_hp`, `email`, `status_pernikahan`, `kewarganegaraan`, `no_ktp`, `alamat`, `provinsi`, `provinsi_nama`, `kota`, `kota_nama`, `kecamatan`, `kelurahan`, `kode_pos`, `suku`, `literasi_membaca`, `literasi_menulis`, `pendidikan`, `riwayat_penyakit`, `bpjs_kesehatan`, `bpjs_ketenagakerjaan`, `asurasi`, `jenis_jabatan`, `jenis_jabatan_nama`, `jenis_divisi`, `jenis_divisi_nama`, `nama_pasangan`, `jumlah_anak`, `nama_anak_1`, `nama_anak_2`, `nama_anak_3`, `nama_ibu`, `nama_ayah`, `kontak_keluarga_1`, `kontak_keluarga_2`, `instansi_terakhir`, `pangkat`, `jabatan`, `status`, `catatan_kinerja`, `masa_kontrak_mulai`, `masa_kontrak_selesai`, `tanggal_bergabung`, `created_at`, `updated_at`) VALUES
('80005167', 'MAWAR11', '', 'FERALDY REVINDO SOMBA', '0000-00-00', 'Pria', '', '81240393237', '', 'TK', 'Indonesia', '7.10E+15', 'Lingkungan II Kel. Luaan Kec. Tondano Timur', '71', 'Sulawesi Utara', '', 'TONDANO TIMUR', NULL, NULL, '95614', 'Non Papua', 'YA', 'YA', 'SMA', '', '1243797129', '', '', 1, 'ANGGOTA', 4, 'RIDGE CAMP', '', 0, '', '', '', 'MELVA.M.M.KUSSOY', 'ROBBY.F.SOMBA', '82188254929', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80005168', 'MAWAR11', '', 'ANDRI SAIPULOH', '0000-00-00', 'Pria', '', '81286326067', '', 'K0', 'Indonesia', '3.18E+15', 'JL.Gandaria II,004/002 Pekayon', '31', 'Jakarta Timur', '', 'Pasar Rebo', NULL, NULL, '', 'Non Papua', 'YA', 'YA', 'SMA', '', '1243797017', '', '', 1, 'ANGGOTA', 2, 'GORONG-GORONG', 'DINDA NURHIDAYAH', 0, '', '', '', 'SHOPIA', 'DANENG', '82298881604', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80005170', 'MAWAR11', '', 'KUN HARYADI', '0000-00-00', 'Pria', '', '82111654599', 'KUNARYA15@GMAIL.COM', 'K2', 'Indonesia', '3.37E+14', 'Truko 003/005 Surokonto Kulon Pageruyung Kendal', '33', 'Jawa Tengah', '', 'PAGERUYUNG', NULL, NULL, '511361', 'Non Papua', 'YA', 'YA', 'SMA', '', '1243796534', '', '', 1, 'ANGGOTA', 5, 'FAMILY SHOOPING', 'WINARSIH', 2, 'RESTY DEVI KUSUMANINGRUDI', 'ARYA BAYU NUGROHO', '', 'MISTINI', 'KASMANTO SULISTIONO', '81329208183', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80005171', 'MAWAR11', '', 'BAGAS KATON', '0000-00-00', 'Pria', '', '85290973545', 'KATONBAGAS88@YAHOO.COM', 'TK', 'Indonesia', '3.31E+15', 'Barenglor Rt 05 Rw 06 Barenglor Klaten Utara', '33', 'Jawa Tengah', '', 'KLATEN UTARA', NULL, NULL, '57438', 'Non Papua', 'YA', 'YA', 'SMA', '', '1243796141', '', '', 4, 'ADM. OPERATOR', 3, 'MULKI', '', 0, '', '', '', 'SRI RAHAYU', 'DARYANTO', '85290973543', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80005173', 'MAWAR11', '', 'RENGGA KUSUMAATMAJA', '0000-00-00', 'Pria', '', '81344029019', 'RENGGA_KUSUMAATJA@FMI.COM / RENGGAKUSUMAATMAJA@GMAIL.COM', 'TK', 'Indonesia', '3.27E+15', 'Jl. Papanggungan No.C 11 KPAD Pindad Selatan Rt.003 Rw.011 Kel. Sukapura Kec. Kiara Condong Kota Madya bandung', '32', 'Jawa Barat', '', 'KIARA CONDONG', NULL, NULL, '40284', 'Non Papua', 'YA', 'YA', 'SMA', '', '1243796444', '', '', 4, 'ADM. OPERATOR', 4, 'RIDGE CAMP', '', 0, '', '', '', 'NELCE LUSYE WANTANIA', 'HENDARTO', '85244609665', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80005215', 'MAWAR11', '', 'FRANGKY MONGILALA', '0000-00-00', 'Pria', '', '82245573759', '', 'K1', 'Indonesia', '7.10E+15', 'Paslaten', '71', 'Sulawesi Utara', '', 'Kakas', NULL, NULL, '', 'Non Papua', 'YA', 'YA', 'SMA', '', '1243796433', '', '', 1, 'ANGGOTA', 2, 'GORONG-GORONG', 'MARLEIN G NGANTUNG', 2, 'AXL. M', 'JEREMY', '', 'JETJE TOAR', 'DIDI. M', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80005216', 'MAWAR11', '', 'DARWIN BONAR HASUDUNGAN', '0000-00-00', 'Pria', '', '81297805332', 'DARWINBONAR83@GMAIL.COM', 'TK', 'Indonesia', '3.18E+15', 'Cipinang Besar Selatan Rt.02/06 no.26 Jaktim', '31', 'DKI Jakarta', '', 'JATI NEGARA', NULL, NULL, '13410', 'Non Papua', 'YA', 'YA', 'SMA', '', '1243796837', '', '', 1, 'ANGGOTA', 4, 'RIDGE CAMP', '', 0, '', '', '', 'NURLY ROMINAH SIHALONG', 'B.K. SIMARMATA', '82112451320', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80005217', 'MAWAR11', '', 'RUDI BANJARNAHAR', '0000-00-00', 'Pria', '', '82182760880', '', 'TK', 'Indonesia', '1.50E+15', 'Jl. SMA 64 Rt.002 Rw.003 No.124 Kel. Cipayung Jaktim', '31', 'DKI Jakarta', '', '', NULL, NULL, '13840', 'Non Papua', 'YA', 'YA', 'SMK', '', '1243797039', '', '', 1, 'ANGGOTA', 4, 'RIDGE CAMP', '', 0, '', '', '', 'RENGSI', 'PARASIAN BANJARNAHOR', '81383254421', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80005224', 'MAWAR11', '', 'RISAL ', '0000-00-00', 'Pria', '', '85298093507', '', 'TK', 'Indonesia', '7.31E+15', 'Bontomatene Segeri Sulsel', '73', 'Sulawesi Selatan', '', 'SEGERI', NULL, NULL, '90653', 'Non Papua', 'YA', 'YA', 'SMA', '', '1243796736', '', '', 1, 'ANGGOTA', 4, 'RIDGE CAMP', '', 0, '', '', '', 'HJ. RUSNIAH', 'ABD. LATIF', '85298351783', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80005225', 'MAWAR11', '', 'NOLDY KRESTANI KOMBAITAN', '0000-00-00', 'Pria', '', '85398157779', 'ODYWASENG@GMAIL.COM', 'K2', 'Indonesia', '7.10E+15', 'Jaga II Kel. Touhelet Kec. Kakas Minahasa Sulut', '71', 'Sulawesi Utara', '', 'KAKAS', NULL, NULL, '95682', 'Non Papua', 'YA', 'YA', 'SMA', '', '1243796409', '', '', 1, 'ANGGOTA', 4, 'RIDGE CAMP', 'MEITI S. LONTAAN', 2, 'DION BRILLEE KOMBAITAN', 'CHELSEA WULANDARI KOMBAITAN', '', 'ANATJE PANGALILA', 'EDDY KOMBAITAN', '82346907986', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80005256', 'MAWAR11', '', 'SLAMET WARNOKO', '0000-00-00', 'Pria', '', '81248179881', '                                   -', 'K1', 'Indonesia', '3.33E+15', 'Wanamulya,Pemalang', '33', 'Jawa Tengah', '', 'PEMALANG', NULL, NULL, '52318', 'Non Papua', 'YA', 'YA', 'SMP', '', '1243797153', '', '', 2, 'GEN FORMAN', 3, 'MULKI', 'DARMINAH', 5, 'ANGGUN TRI PUTRI AGUSNIAR', 'ANGGER OKTAVIAN WIJANARKO', 'ARJUNA JULIAN ADI SANJAYA', 'SAWIYAH', 'CARLAN', '85290973626', '81227198394', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80005257', 'MAWAR11', '', 'ANDRI WIJAYA', '0000-00-00', 'Pria', '', '82246699181', '', 'K1', 'Indonesia', '3.67E+15', 'Bendungan Cilegon Banten', '36', 'Banten', '', 'CILEGON', NULL, NULL, '42417', 'Non Papua', 'YA', 'YA', 'SMP', '', '1243796512', '', '', 1, 'ANGGOTA', 4, 'RIDGE CAMP', 'AWALIYAH', 1, 'MUHAMAD ALDRI', '', '', 'SULHAH', 'M. ALWI', '82311506511', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80005258', 'MAWAR11', '', 'TATOK PRIHANDONO', '0000-00-00', 'Pria', '', '81232663782', '', 'K0', 'Indonesia', '1.80E+15', 'Tulung Itik 1,004/001 Gunung Sari', '16', 'Sumatrera Selatan', '', 'Gunung Sugeh', NULL, NULL, '', 'Non Papua', 'YA', 'YA', 'SMA', '', '1243796793', '', '', 1, 'ANGGOTA', 4, 'RIDGE CAMP', 'NURUL FITRI KHUMAIRAH', 0, '', '', '', 'KHORYATI', 'SUJITO', '82371295075', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80005259', 'MAWAR11', '', 'AKHMAD SOLIHIN', '0000-00-00', 'Pria', '', '81248608285', '', 'K1', 'Indonesia', '3.60E+15', 'Sobong,002/002 Palurahan,Pandeglang', '36', 'Banten', '', 'Kaduh Hejo', NULL, NULL, '', 'Non Papua', 'YA', 'YA', 'SMA', '', '1243797197', '', '', 1, 'ANGGOTA', 2, 'GORONG-GORONG', 'FITRIANA', 0, '', '', '', 'JAINAM(ALMH)', 'SUNTARA', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80005291', 'MAWAR11', '', 'PANDU BUDI. P', '0000-00-00', 'Pria', '', '81344105906', '', 'TK', 'Indonesia', '3.37E+15', 'Mloyokusuman,Pasar Kliwon 001/012 Mbaluarti', '33', 'Jawa Tengah', '', 'Pasar Kliwon', NULL, NULL, '', 'Non Papua', 'YA', 'YA', 'SMA', '', '1243797107', '', '', 1, 'ANGGOTA', 2, 'GORONG-GORONG', '', 0, '', '', '', 'SRI LESTARI', 'BUDI SUDARMADI', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80005430', 'MAWAR11', '', 'SUPRIADI', '0000-00-00', 'Pria', '', '81213734057', '', 'TK', 'Indonesia', '7.30E+15', 'Palangisang Balleanging Ujung Loe  Bulukumba Sul-Sel', '73', 'Sulawesi Selatan', '', 'UJUNG LOE', NULL, NULL, '92551', 'Non Papua', 'YA', 'YA', 'S1', '', '1243796422', '', '', 1, 'ANGGOTA', 4, 'RIDGE CAMP', '', 0, '', '', '', 'HALO', 'MODDING', '82344480298', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80005431', 'MAWAR11', '', 'AGUS SASMITA', '0000-00-00', 'Pria', '', '82198080266', '', 'K2', 'Indonesia', '3.28E+15', 'Jl. Karya Bakti Rt.021 Rw.001 Gandul Cinere Depok Jabar', '32', 'Jawa Barat', '', 'CINERE', NULL, NULL, '16512', 'Non Papua', 'YA', 'YA', 'SMK', '', '1243796128', '', '', 1, 'ANGGOTA', 4, 'RIDGE CAMP', 'SITI ROHAYAH', 2, 'MUHAMMAD RIZKI SASMITA', 'MUHAMMAD ARYA SASMITA', '', 'RUMNAH', 'SAID', '82311937486', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80005441', 'MAWAR11', '', 'ROLAND VERNANDO ROMPAS', '0000-00-00', 'Pria', '', '82393040967', '', 'TK', 'Indonesia', '7.10E+15', 'Ds.Talikuran Jaga I Kec.Kakas Minahasa Sulut', '71', 'Sulawesi Utara', '', 'KAKAS', NULL, NULL, '95682', 'Non Papua', 'YA', 'YA', 'S1', '', '1243796073', '', '', 1, 'ANGGOTA', 4, 'RIDGE CAMP', '', 0, '', '', '', 'JENNY LONTAAN', 'FRANS ROMPAS', '85256074333', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80005775', 'MAWAR11', '', 'FEBRI RAMADHAN', '0000-00-00', 'Pria', '', '81344105736', 'FEBRIRHAMADAN790@GMAIL.COM', 'K1', 'Indonesia', '1.80E+15', 'Kerenceng,03/004 Kebon Sari', '', 'Cilegon', '', 'Citangkil', NULL, NULL, '', 'Non Papua', 'YA', 'YA', 'SMA', '', '1243796286', '', '', 1, 'ANGGOTA', 2, 'GORONG-GORONG', 'UNIATUL AHRA', 1, 'MAUDY IMTIAZ', '', '', 'SITI KATMINAH', 'OTONG(ALM)', '81373925991', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80005932', 'MAWAR11', '', 'AHMAD SAPARI', '0000-00-00', 'Pria', '', '81322080604', '', 'K3', 'Indonesia', '3.22E+15', 'Kp. Bobojong Rt.003 Rw.002 Ds. Muka Payung Kec. Cililin Bandung Barat', '32', 'Jawa Barat', '', 'CILILIN', NULL, NULL, '40562', 'Non Papua', 'YA', 'YA', 'SMP', '', '1243796084', '', '', 8, 'STAFF OPERASIONAL', 4, 'RIDGE CAMP', 'YATI KUSMIATI', 5, 'ANDI MUSLIM', 'DIKI RINALDI', 'ANDRI WAHYUDI', 'KARTIJA', 'JAKARIA', '82126618047', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80005933', 'MAWAR11', '', 'SUBIYANTO', '0000-00-00', 'Pria', '', '81288251166', '', 'K1', 'Indonesia', '3.22E+15', 'Puri Sentosa Blok D2/66 Rt 02 Rw 06 Cikarang .Bekasi.Jawabarat ', '32', 'Jawabarat', '', 'CIKARANG PUSAT', NULL, NULL, '', 'Non Papua', 'YA', 'YA', 'SMA', '', '1243796343', '', '', 1, 'ANGGOTA', 5, 'FAMILY SHOOPING', 'HERLINA', 1, 'ANDINI SEPTRIYASA RINJANI', '', '', 'SRI SUBARDINI', 'SUTRISNO WAGIMIN', '81289555381', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80005934', 'MAWAR11', '', 'SIMPATI LAGENDA', '0000-00-00', 'Pria', '', '81287558863', 'SIMPATILAGENDA@GMAIL.COM', 'TK', 'Indonesia', '1.80E+15', 'Desa Suka Baru RT 001 RW 001 Kel sukabaru Kec Penengahan Kab Lampung Selatan ', '16', 'Sumatera Selatan', '', 'PENENGAHAN', NULL, NULL, '35592', 'Non Papua', 'YA', 'YA', 'SMK', '', '1243796591', '', '', 4, 'ADM. OPERATOR', 4, 'RIDGE CAMP', '', 0, '', '', '', 'ELA YUNAITI', 'RUSLI IBRAHIM', '81379449218', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80005935', 'MAWAR11', '', 'WELLYVER RIDWAN', '0000-00-00', 'Pria', '', '81224439075', 'WELYRIDWAN@GMAIL.COM', 'K2', 'Indonesia', '1.67E+15', 'Jl. Yos Sudarso Rt. 21 Inauga, Mimika Baru', '94', 'PAPUA', '', 'MIMIKA BARU', NULL, NULL, '99910', 'Non Papua', 'YA', 'YA', 'SMA', '', '1243796051', '', '', 5, 'SUPERINTEDENT', 4, 'RIDGE CAMP', 'SRI ROHAYAH', 2, 'IGO PUTRA', 'VITO AKBAR', '', 'RUSMAWATI', 'M. HASAN ANSAL', '82114245512', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80005936', 'MAWAR11', '', 'KADIS', '0000-00-00', 'Pria', '', '81359329528', '', 'K2', 'Indonesia', '3.50E+15', 'Rt.01/12 Sidoharjo Pacitan Jawa Timur', '35', 'Jawa Timur', '', 'PACITAN', NULL, NULL, '63514', 'Non Papua', 'YA', 'YA', 'SMP', '', '1243796995', '', '', 7, 'STAFF ADMINISTRASI', 4, 'RIDGE CAMP', 'WIWIK RUWIYATI', 2, 'INTAN HARYADI', 'IVAN YUNAN SAPUTRA', '', 'ALMH. BONIYEM', 'ALM. TUMIJAN', '82143707226', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80005938', 'MAWAR11', '', 'WARAS', '0000-00-00', 'Pria', '', '81290191659', 'W.HADI.SUCIPTO@GMAIL.COM', 'K1', 'Indonesia', '3.20E+15', 'Perumahan Taman Firdaus,Blok E1 No 47', '32', 'Jawa Barat', '', 'CIBARUSA KOTA', NULL, NULL, '17340', 'Non Papua', 'YA', 'YA', 'SMA', '', '1078958384', '', '', 5, 'SUPERINTENDENT', 3, 'MULKI', 'NURHARIANTI', 3, 'TONI CIPTIANDRA CSP', 'TOMI A', 'VIKA VADILA VIRGINIA', 'WAGINI ', 'SUPERNO', '81299405779', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80005939', 'MAWAR11', '', 'KOYO', '0000-00-00', 'Pria', '', '8121548167', '', 'K3', 'Indonesia', '3.31E+15', 'Sukoharjo Jateng', '33', 'Jawa Tengah', '', 'KARTOSURO', NULL, NULL, '', 'Non Papua', 'YA', 'YA', 'SMP', '', '', '', '', 2, 'GEN FORMAN', 3, 'MULKI', 'PARIYEM', 4, 'EKA OKTAVIA NINGSIH', 'DWI ARIEBS W', 'TRI YANUARIANTO', 'SITI ASIAH', 'NASRIP', '85290973607', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80005941', 'MAWAR11', '', 'WALUYO', '0000-00-00', 'Pria', '', '81293925232', '', 'K2', 'Indonesia', '3.30E+15', 'Kp.Kecila Rt.002 Rw.005 Ds.Kecila Kec.Kemranjen', '33', 'Jawa Tengah', '', 'KEMRANJEN', NULL, NULL, '53194', 'Non Papua', 'YA', 'YA', 'SMA', '', '1243797074', '', '', 1, 'ANGGOTA', 4, 'RIDGE CAMP', 'SRI HARYANI', 2, 'WAHYU WISNU MURTI', 'WIWIT ATRIYANI PRATIWI', '', 'SUWARTI', 'ALM. WAQIMAH WONGSO P DWIRO', '8.11E+11', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80005942', 'MAWAR11', '', 'AMIR ALAMSYAH', '0000-00-00', 'Pria', '', '81291177147', '', 'K3', 'Indonesia', '3.27E+14', 'Asrama Paskhas No.1 Rt 06 Rw 04 Kota Bogor Selatan.Bogor', '32', 'Jawabarat', '', 'BOGOR SELATAN', NULL, NULL, '16134', 'Non Papua', 'YA', 'YA', 'SMA', '', '', '', '', 1, 'ANGGOTA', 5, 'FAMILY SHOOPING', 'AMY YULIE WHIDIARTHY', 5, 'LINGGA SERYANDANA PUTERA', 'CHANDRA RAMDHANI PUTERA', 'ARYO ADRYANSAH PUTERA', 'SARNAH', 'ANWAR', '81291177145', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80006003', 'MAWAR11', '', 'M.RAGENT ALBERTO', '0000-00-00', 'Pria', '', '81248391067', 'MOHAMMEDREAGENTALBERTO@GMAIL.COM', 'TK', 'Indonesia', '1.67E+15', 'Lorong Serasan I,034/012 Plaju Ulu', '16', 'Sumatra Selatan', '', 'Plaju', NULL, NULL, '', 'Non Papua', 'YA', 'YA', 'SMA', '', '1243796692', '', '', 1, 'ANGGOTA', 2, 'GORONG-GORONG', '', 0, '', '', '', 'YULI LESMANA. S', 'SUHARNO', '82186083939', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80006004', 'MAWAR11', '', 'AGUS SETIAWAN PRAKOSO', '0000-00-00', 'Pria', '', '82113444091', '', 'TK', 'Indonesia', '3.18E+15', 'Kp Besar Rt. 04/08 Cipinang Besar Jaktim', '31', 'DKI Jakarta', '', 'JATI NEGARA', NULL, NULL, '13410', 'Non Papua', 'YA', 'YA', 'SMA', '', '1243797118', '', '', 1, 'ANGGOTA', 4, 'RIDGE CAMP', '', 0, '', '', '', 'DWI FITRIANTI', 'ALM. ACHMAD ZAZULI', '81318131781', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80006008', 'MAWAR11', '', 'ANDIKA', '0000-00-00', 'Pria', '', '85290973654', '', 'TK', 'Indonesia', '3.30E+15', 'Jalan Teri,Rt 03 Rw 13 Cilacap , Cilacap Selatan', '33', 'Jawa Tengah', '', 'CILACAP SELATAN', NULL, NULL, '', 'Non Papua', 'YA', 'YA', 'SMA', '', '00.012.343796769', '', '', 1, 'ANGGOTA', 3, 'MULKI', '', 0, '', '', '', 'NGADINAH', 'TIMAN', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80006009', 'MAWAR11', '', 'ANGGA DWI FIRMA FEBRIAN', '0000-00-00', 'Pria', '', '82232810142', '', 'TK', 'Indonesia', '3.51E+15', 'Dsn Kerajan RT 05 RW 05 Ds, Tapan rejo, Muncar Banyuwangi', '35', 'Jawa Timur', '', 'MUNCAR', NULL, NULL, '68742', 'Non Papua', 'YA', 'YA', 'SMA', '', '1243796242', '', '', 1, 'ANGGOTA', 4, 'RIDGE CAMP', '', 0, '', '', '', 'MASLKHIKATUN', 'ALM. WAKIDI', '85335276062', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80006075', 'MAWAR11', '', 'SLAMET HARYADI', '0000-00-00', 'Pria', '', '81291177146', '', 'K3', 'Indonesia', '3.21E+15', 'Dusun PON Rt.11/04 Ciganda Mekar Kuningan Jabar', '32', 'Jawa Barat', '', 'CIGANDA MEKAR', NULL, NULL, '', 'Non Papua', 'YA', 'YA', 'SMA', '', '1243796231', '', '', 1, 'ANGGOTA', 4, 'RIDGE CAMP', 'CICIH KURNIASIH', 3, 'SALMAN AL - FARISIE', 'RAMADHANIE', 'SANDY AHMAD YUSUF', 'ALM. MA''RIFAH', 'ALM. SUMINO', '85294247985', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80006076', 'MAWAR11', '', 'SAENAL ABIDIN', '0000-00-00', 'Pria', '', '85216357866', '', 'TK', 'Indonesia', '7.31E+15', 'Bonto Mate''ne Rt. 01/01 Segeri Pangkep Sul-Sel', '73', 'Sulawesi Selatan', '', 'SEGERI', NULL, NULL, '', 'Non Papua', 'YA', 'YA', 'SMA', '', '1243796668', '', '', 1, 'ANGGOTA', 2, 'GORONG-GORONG', '', 0, '', '', '', 'SARMIAH', 'TARUDDIN', '85242266956', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80006184', 'MAWAR11', '', 'IIN DRAMARTA PUTRA', '0000-00-00', 'Pria', '', '81283399491', 'IIN396@YAHOO.CO.ID', 'TK', 'Indonesia', '1.80E+15', 'Ds. Penengahan Kec Penengahan RT 002 RW 003 Kab Lampung Selatan', '16', 'Sumatera Selatan', '', 'PENENGAHAN', NULL, NULL, '35592', 'Non Papua', 'YA', 'YA', 'SMA', '', '1243796501', '', '', 1, 'ANGGOTA', 4, 'RIDGE CAMP', '', 0, '', '', '', 'MARLINA', 'NAFLI', '82180343917', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80006185', 'MAWAR11', '', 'ISHAKA', '0000-00-00', 'Pria', '', '82339505859', '', 'K3', 'Indonesia', '5.21E+15', 'Bima-NTB', '52', 'NTB', '', 'WOHA', NULL, NULL, '', 'Non Papua', 'YA', 'YA', 'SMA', '', '1243796264', '', '', 1, 'ANGGOTA', 4, 'RIDGE CAMP', 'YULIANDA', 3, 'TEDY LAKSMANA', 'M. SUHAIMIN', 'RAHMATUL ARIF', 'SALMAH', 'H. AKARIM', '82339024797', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80006186', 'MAWAR11', '', 'DEDE YAHYA', '0000-00-00', 'Pria', '', '81210930071', '', 'K1', 'Indonesia', '3.60E+15', 'Pandeglang Blok Ciekek Melati Pandeglang Banten', '36', 'Banten', '', 'MAJASARI', NULL, NULL, '42191', 'Non Papua', 'YA', 'YA', 'SMP', '', '1243796448', '', '', 1, 'ANGGOTA', 4, 'RIDGE CAMP', 'TATI MARYATI', 1, 'SATRIO SUGANI', '', '', 'ALMH. KHADJAH', 'ALM. DAWA', '87773566997', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80006187', 'MAWAR11', '', 'BUDI RIVAI SIAGIAN', '0000-00-00', 'Pria', '', '81289500212', 'BUDI.SIAGIAN24@GMAIL.COM', 'K0', 'Indonesia', '3.67E+15', 'Kel, Pinang, Kec Pinang Tangerang', '36', 'Banten', '', 'PINANG', NULL, NULL, '15145', 'Non Papua', 'YA', 'YA', 'SMA', '', '1243796332', '', '', 1, 'ANGGOTA', 4, 'RIDGE CAMP', 'EVA N. MANURUNG', 0, '', '', '', 'DORTIA NURHAIDA SIREGAR', 'TASMAN ALFRED SIAGIAN', '82124999818', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80006188', 'MAWAR11', '', 'NUR AHMAD EFENDI', '0000-00-00', 'Pria', '', '81248374111', '', 'TK', 'Indonesia', '3.50E+15', 'Rt.002 Rw.002 Ploso Punung Pacitan Jatim', '35', 'Jawa Timur', '', 'PACITAN', NULL, NULL, '63553', 'Non Papua', 'YA', 'YA', 'SMK', '', '1243796782', '', '', 1, 'ANGGOTA', 4, 'RIDGE CAMP', '', 0, '', '', '', 'SUWARTI', 'MA''RUF ', '81938778308', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80006189', 'MAWAR11', '', 'AGUN SETIAWAN', '0000-00-00', 'Pria', '', '81286326511', '', 'TK', 'Indonesia', '7.31E+15', 'Bonto Mate''ne Rt01/01 Pangkep Sul-Sel', '73', 'Sulawesi Selatan', '', 'SEGERI', NULL, NULL, '90655', 'Non Papua', 'YA', 'YA', 'SMA', '', '1243796567', '', '', 1, 'ANGGOTA', 4, 'RIDGE CAMP', '', 0, '', '', '', 'MARDIA', 'AMIR', '8.55E+11', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80006190', 'MAWAR11', '', 'AQUINO QOES PRATOWO', '0000-00-00', 'Pria', '', '82116782730', 'AUINO.KOES05@GMAIL.COM', 'K1', 'Indonesia', '3.22E+15', 'Perum Batujajar Indah Blok A2 No.41 Rt.003 Rw.15 Batujajar', '32', 'Jawa Barat', '', 'BATUJAJAR', NULL, NULL, '40561', 'Non Papua', 'YA', 'YA', 'SMK', '', '1243796984', '', '', 1, 'ANGGOTA', 4, 'RIDGE CAMP', '', 1, 'HAYKAL QUIN APRILIANO', '', '', 'MANIK ISWATI', 'VIN EDI PRATOWO', '82136000910', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80006192', 'MAWAR11', '', 'AFRIZAL RIDHO CAHYO PURNOMO', '0000-00-00', 'Pria', '', '85290976492', '', 'TK', 'Indonesia', '3.30E+15', 'Jl. Penyu No. 136 Cilacap Selatan Jateng', '33', 'Jawa Tengah', '', 'CILACAP SELATAN', NULL, NULL, '53211', 'Non Papua', 'YA', 'YA', 'SMA', '', '1243796297', '', '', 1, 'ANGGOTA', 4, 'RIDGE CAMP', '', 0, '', '', '', 'MARSIYANI', 'DADUT GUNTUR SUTOP', '81329601625', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80006193', 'MAWAR11', '', 'HENDRIAWAN', '0000-00-00', 'Pria', '', '82113056145', '', 'K0', 'Indonesia', '3.27E+15', 'Sukasari Rt 03 Rt 01 , Ds. Sukasari , Kec. Bogor Timur . Bogor', '32', 'Jawabarat', '', 'BOGOR TIMUR', NULL, NULL, '16142', 'Non Papua', 'YA', 'YA', 'SMA', '', '1243796499', '', '', 1, 'ANGGOTA', 3, 'MULKI', 'ATIK WIDA ASTUTI', 0, '', '', '', 'RUSKILAH', 'MUSTARIP', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80006194', 'MAWAR11', '', 'AGUS MAINDOKA', '0000-00-00', 'Pria', '', '82199127060', '', 'K2', 'Indonesia', '7.10E+15', 'Jaga IV Kel. Tounelet Kec. Kakas Minahasa', '71', 'Sulawesi Utara', '', 'KAKAS', NULL, NULL, '95682', 'Non Papua', 'YA', 'YA', 'SMK', '', '1243796804', '', '', 1, 'ANGGOTA', 4, 'RIDGE CAMP', 'ARNE SUMERAH', 2, 'INDAH NATALIA MAINDOKA', 'GREGEN YUEN MAINDOKA', '', 'SANTJE LISANGAN ', 'PITER MAINDOKA (WAFAT)', '81243679131', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80006195', 'MAWAR11', '', 'ANWAR', '0000-00-00', 'Pria', '', '82113091060', 'ANWAR.DOMPU@YAHOO.COM', 'K0', 'Indonesia', '3.18E+15', 'Kp. Gempol Rt.004 Rw.001 Kel. Lawang Gintung Kec. Bogor', '32', 'Jawa Barat', '', 'BOGOR', NULL, NULL, '13910', 'Non Papua', 'YA', 'YA', 'SMK', '', '1243796556', '', '', 1, 'ANGGOTA', 4, 'RIDGE CAMP', 'LINA', 0, '', '', '', 'SALMAH', 'ALM. ISMAIL SE', '81281090281', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80006196', 'MAWAR11', '', 'DANY MULYAWAN', '0000-00-00', 'Pria', '', '81248404858', 'DHANILMAR11@GMAIL.COM', 'K1', 'Indonesia', '', 'Ciledug Indah Ii Blok .E 31 No.25 Ds . Pedurenan Tangerang , Banten', '36', 'Banten', '', 'KARANG TENGAH', NULL, NULL, '15158', 'Non Papua', 'YA', 'YA', 'SMA', '', '1243796163', '', '', 1, 'ANGGOTA', 5, 'FAMILY SHOOPING', 'YULIANI', 1, 'ALIVIA RAHMA NURJAMIL', '', '', 'R.EUIS SHOLIHAT', 'R.BOY SUDARMA', '82110802575', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80006197', 'MAWAR11', '', 'MANSYUR .L', '0000-00-00', 'Pria', '', '8234523803', '', 'TK', 'Indonesia', '7.30E+15', 'Palangisang Rt 01/01 Bulukumba Sul-Sel', '73', 'Sulawesi Selatan', '', 'UJUNG LOE', NULL, NULL, '93551', 'Non Papua', 'YA', 'YA', 'S1', '', '1243796859', '', '', 1, 'ANGGOTA', 4, 'RIDGE CAMP', '', 0, '', '', '', 'RUHAEDA', 'LAHAMID', '85299325266', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80006297', 'MAWAR11', '', 'ABDULROHMAN', '0000-00-00', 'Pria', '', '82199160069', 'ROHMANADJA59@YAHOO.CO.ID', 'TK', 'Indonesia', '1.80E+15', 'Banjarmasin,Lampung Selatan', '16', 'Sumatera Selatan', '', 'PENENGAHAN', NULL, NULL, '35592', 'Non Papua', 'YA', 'YA', 'SMA', '', '1858560208', '', '', 1, 'ANGGOTA', 3, 'MULKI', '', 0, '', '', '', 'SUHARTI', 'AHMADD DUNI', '81377616820', '85939917907', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80006299', 'MAWAR11', '', 'SUWARNO', '0000-00-00', 'Pria', '', '81383644011', '', 'K1', 'Indonesia', '3.60E+15', '', '', '', '', '', NULL, NULL, '', 'Non Papua', 'YA', 'YA', 'SMP', '', '', '', '', 2, 'GEN FORMAN', 2, 'GORONG-GORONG', 'SULASIH', 2, 'DARMAWAN SUGIARTO', 'RIZKI NUR SUNJAYA', '', 'SUNYATI', 'JUMADI(ALM)', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80006300', 'MAWAR11', '', 'RUSLI', '0000-00-00', 'Pria', '', '82310400423', '', 'TK', 'Indonesia', '1.80E+15', 'Desa Pisang, RT/RW 001/001, Kelurahan Pisang, Kecamatan Penengahan, Kabupaten Lampung Selatan', '16', 'Sumatera Selatan', '', 'PENENGAHAN', NULL, NULL, '35592', 'Non Papua', 'YA', 'YA', 'SMK', '', '1858562155', '', '', 1, 'ANGGOTA', 4, 'RIDGE CAMP', '', 0, '', '', '', 'ROHAYA', 'RJ. JAWALUDIN', '82375824437', '82306559611', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80006301', 'MAWAR11', '', 'SUPARDI', '0000-00-00', 'Pria', '', '85246061551', '', 'K3', 'Indonesia', '3.30E+15', 'JL. Kartadja 1, RT/RW 003/003, Kelurahan Mersi, Kecamatan Purwokerto Timur', '33', 'Jawa Tengah', '', 'PURWOKERTO TIMUR', NULL, NULL, '53112', 'Non Papua', 'YA', 'YA', 'SMA', '', '1089157217', '', '', 2, 'GEN FORMAN', 4, 'RIDGE CAMP', 'SITI MARYAM', 3, 'DIMA FITRIYANI', 'YULI TRESNAWATI', 'ALFI NADHIANA', 'SUPARTINI', 'SUWARNO', '82226690460', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80006302', 'MAWAR11', '', 'RICHARD J KROMA', '0000-00-00', 'Pria', '', '82187558279', 'RICHARD.KROMA07@GMAIL.COM', 'TK', 'Indonesia', '7.10E+13', 'Jaga V Tounelet Kakas Minahasa', '71', 'Sulawesi Utara', '', 'KAKAS', NULL, NULL, '', 'Non Papua', 'YA', 'YA', 'SMA', '', '1858557137', '', '', 1, 'ANGGOTA', 5, 'FAMILY SHOOPING', '', 0, '', '', '', 'NORMA RAWUNG', 'SANTIAGO KROMA', '82238451972', '85256495790', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80006322', 'MAWAR11', '', 'MUHAMMAD YAZID', '0000-00-00', 'Pria', '', '81286208607', '', 'K3', 'Indonesia', '1.51E+15', 'Dusun Malangan, RT/RW 001/002, Kelurahan Ngasinan, Kecamatan Susukan', '36', 'Banten', '', 'SUSUKAN', NULL, NULL, '50777', 'Non Papua', 'YA', 'YA', 'SMP', '', '1858567612', '', '', 2, 'GEN FORMAN', 4, 'RIDGE CAMP', 'AFRITATINI', 4, 'SANTI YULIAWATI', 'NUR SITI HALIMAH', 'YULIANA SAFARA', 'SITI MUSLIMAH', 'SO''IM', '82310404259', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80006327', 'MAWAR11', '', 'HIDAYATULLOH', '0000-00-00', 'Pria', '', '81343304988', '', 'TK', 'Indonesia', '1.80E+15', 'Desa Banjar masin, RT/RW 009/003, Kelurahan Banjarmasin, Kecamatan Penengahan ', '16', 'Sumatera Selatan', '', 'PENENGAHAN', NULL, NULL, '35591', 'Non Papua', 'YA', 'YA', 'SMK', '', '1858963162', '', '', 1, 'ANGGOTA', 4, 'RIDGE CAMP', '', 0, '', '', '', 'NURAINI', 'UJANG KOSASIH', '81297867650', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80006329', 'MAWAR11', '', 'DENI SULFIAN', '0000-00-00', 'Pria', '', '85319594780', '', 'TK', 'Indonesia', '1.80E+15', 'Desa Suka Baru, RT/RW 003/002, Kelurahan Sukabaru, Kecamatan Penengahan', '16', 'Sumatera Selatan', '', 'PENENGAHAN', NULL, NULL, '35591', 'Non Papua', 'YA', 'YA', 'SMA', '', '1858947028', '', '', 1, 'ANGGOTA', 4, 'RIDGE CAMP', '', 0, '', '', '', 'KARINAH', 'MANSUR', '82176792736', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80006331', 'MAWAR11', '', 'BASARUDIN EFENDI', '0000-00-00', 'Pria', '', '82123289785', '', 'K3', 'Indonesia', '1.80E+15', 'Banjarmasin,Lampung Selatan', '16', 'Sumatera Selatan', '', 'PENENGAHAN', NULL, NULL, '35591', 'Non Papua', 'YA', 'YA', 'SMA', '', '1858559275', '', '', 1, 'ANGGOTA', 5, 'FAMILY SHOOPING', 'DAHLIA', 3, 'THAARIQ EFENDI', 'FAIRUS MAHARDIKA', 'AURA NURUL PUTRI', 'JUMILAH', 'ASEP AHMAD', '81366159485', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80006332', 'MAWAR11', '', 'ADI SURYA SUPRIATNA', '0000-00-00', 'Pria', '', '81240682657', '', 'TK', 'Indonesia', '3.60E+15', 'JL. Anggrek IV No. 18, RT/RW 004/004, Kelurahan Kramatwatu, Kecamatan Kramatwatu ', '36', 'Banten', '', 'KRAMATWATU', NULL, NULL, '42161', 'Non Papua', 'YA', 'YA', 'SMA', '', '', '14027072264', '', 1, 'ANGGOTA', 4, 'RIDGE CAMP', '', 0, '', '', '', 'MIMIN MINTARSIH', 'ATONG SUGIARTO', '81293832656', '85289687547', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80006451', 'MAWAR11', '', 'SALIKIN', '0000-00-00', 'Pria', '', '85290973567', 'SALIKIN.SK71@GMAIL.COM', 'K2', 'Indonesia', '3.30E+15', 'JL.Mesjid Smampir Selarang Kesubihan Cilacap Jateng', '33', 'Jawa Tengah', '', 'KESUGIHAN', NULL, NULL, '53274', 'Non Papua', 'YA', 'YA', 'SMP', '', '1243796916', '', '', 2, 'GEN FORMAN', 4, 'RIDGE CAMP', 'SITI BASIROH ', 2, 'SOCHIBUL ROHWI', 'HERY KURNIAWAN', '', 'SUWUH', 'MADYAKUN', '82136358739', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80006536', 'MAWAR11', '', 'JUJU JUMIAT', '0000-00-00', 'Pria', '', '82115550462', '', 'K3', 'Indonesia', '3.18E+15', 'Jl. Surti Kanti No.57 A Halim Perdana Kusuma Dirgantara III Jaktim', '31', 'DKI Jakarta', '', 'MAKASAR', NULL, NULL, '40574', 'Non Papua', 'YA', 'YA', 'STM', '', '1243796927', '', '', 2, 'GEN FORMAN', 4, 'RIDGE CAMP', 'WIWIK P. INDRATI', 3, 'ARDITIYA EKA NOVIARNI', 'PRATAMA ADI', 'RAISA OKTAVIANI PUTRI', 'KESHA', 'UDUNG', '81298088618', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80006537', 'MAWAR11', '', 'SUGIYO', '0000-00-00', 'Pria', '', '81226695200', '', 'K1', 'Indonesia', '3.31E+15', 'Ngampal 032-008 Kebonromo', '33', 'Jawa Tengah', '', 'Ngampal', NULL, NULL, '', 'Non Papua', 'YA', 'YA', 'SMP', '', '1243796771', '', '', 2, 'GEN FORMAN', 2, 'GORONG-GORONG', 'DJUATI', 2, 'YOYOK HERMINTARSO', 'NIVIA DEWI PRATIWI', '', 'SUKINEM (ALMH)', 'KARIYO PAWIRO (ALM)', '81326147259', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80006593', 'MAWAR11', '', 'YUSUF', '0000-00-00', 'Pria', '', '81329085719', 'YUSUF.MS1957@GMAIL.COM ', 'K3', 'Indonesia', '3.31E+15', 'Bolon Rt 02 Rw 02 Bolon Kolomaiju Karanganyar', '33', 'Jawa Tengah', '', 'KARANGANYAR', NULL, NULL, '57178', 'Non Papua', 'YA', 'YA', 'SMA', '', '1243796387', '', '', 2, 'GEN FORMAN', 3, 'MULKI', 'SITY SULASTRI', 3, 'YUANITA', 'WINDHA', 'VIVI', 'TUMINAH', 'KARTOINANGUN', '81329178584', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80006596', 'MAWAR11', '', 'MASERUN', '0000-00-00', 'Pria', '', '85290973538', '', 'K3', 'Indonesia', '3.51E+15', 'Dusun Srono Rt 001 Rw 012 Desa Kbaman Banyuwangi', '35', 'Jawa Timur', '', 'SRONO', NULL, NULL, '68471', 'Non Papua', 'YA', 'YA', 'SMP', '', '1243796681', '', '', 2, 'GEN FORMAN', 4, 'RIDGE CAMP', 'MUNTAMAH', 3, 'RONY FTRIANTO', 'NDARU TUTUS PRIYOHANDOKO', 'SILVIA TRIA JINIAR', 'SAMIRAH', 'TOIRIN', '81330387445', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80006599', 'MAWAR11', '', 'MULYONO', '0000-00-00', 'Pria', '', '8222616523', '', 'TK', 'Indonesia', '3.31E+15', 'Ompon Rt.002 Rw.009 Jl. Dahlia Karanganyar, Surakarta, Jateng  ', '33', 'Jawa Tengah', '', 'KARANG ANYAR', NULL, NULL, '87711', 'Non Papua', 'YA', 'YA', 'SMA', '', '1243796095', '', '', 1, 'ANGGOTA', 4, 'RIDGE CAMP', '', 0, '', '', '', 'WIJILESTARI', 'GOATLAY', '82138883869', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80006602', 'MAWAR11', '', 'DIKI RENALDI', '0000-00-00', 'Pria', '', '82216388800', '', 'K1', 'Indonesia', '3.22E+15', 'Kebon Jahe,002/014 Cipare', '36', 'Banten', '', 'Serang', NULL, NULL, '', 'Non Papua', 'YA', 'YA', 'SMA', '', '1243796455', '', '', 1, 'ANGGOTA', 2, 'GORONG-GORONG', 'HESTY ALIYANTI', 0, '', '', '', 'YATI KUSMIATI', 'AHCMAD SAPARI', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80006894', 'MAWAR11', '', 'JONI HARYANTO', '0000-00-00', 'Pria', '', '82238063266', '', 'TK', 'Indonesia', '3.50E+15', 'Ds.Gemaharjo Tegalombo Pacitan Jatim', '35', 'Jawa Timur', '', 'TEGAL LOMBO', NULL, NULL, '63582', 'Non Papua', 'YA', 'YA', 'SMA', '', '1243796905', '', '', 1, 'ANGGOTA', 4, 'RIDGE CAMP', '', 0, '', '', '', 'MARIYEM', 'MISGIRAN', '82331666248', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80006895', 'MAWAR11', '', 'AZIS SUANTO', '0000-00-00', 'Pria', '', '81285242750', 'RANTAIULAMPUNJG@GMAIL.COM', 'TK', 'Indonesia', '1.81E+15', 'Dusun 1 Suka Negeri RT/RW 001/001 Kelurahan Sukanegeri, Kecamatan Gunung Labuhan, Kabupaten Way Kanan, Lampung', '16', 'Sumatera Selatan', '', 'GUNUNG LABUHAN', NULL, NULL, '34768', 'Non Papua', 'YA', 'YA', 'SMA', '', '', '', '', 1, 'ANGGOTA', 4, 'RIDGE CAMP', '', 0, '', '', '', 'BAHUNA', 'SULAIMAN', '85377076247', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80006896', 'MAWAR11', '', 'DAVID KORDAK', '0000-00-00', 'Pria', '', '85213303839', 'DAVIDKORDAK27@GMAIL.COM', 'TK', 'Indonesia', '7.11E+15', 'Poopo Utara - Jaga II, Kelurahan Poopo Utara, Kecamatan Ranoyapo', '71', 'Sulawesi Utara', '', 'RANOYAPO', NULL, NULL, '95999', 'Non Papua', 'YA', 'YA', 'SMA', '', '907373613', '', '', 1, 'ANGGOTA', 4, 'RIDGE CAMP', '', 0, '', '', '', 'MEITI TALUMEWA', 'JANNY KORDAK', '81244056392', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80007043', 'MAWAR11', '', 'DENI HENDRAWAN', '0000-00-00', 'Pria', '', '82111651875', '', 'K1', 'Indonesia', '3.17E+14', 'Kp.Kalibata Rt 06 Rw 08 N0 29 Dki Jakarta', '31', 'Dki Jakarta', '', 'JAGAKARSA', NULL, NULL, '12640', 'Non Papua', 'YA', 'YA', 'SMA', '', '1243796951', '', '', 1, 'ANGGOTA', 5, 'FAMILY SHOOPING', '', 1, 'K BAYU UTOMO', '', '', 'SRI SUNARTI', 'MOH SUWANDI', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80007044', 'MAWAR11', '', 'YAYI SHOLEH', '0000-00-00', 'Pria', '', '8524400604', '', 'K3', 'Indonesia', '3.20E+15', 'Babakan Fakultas Rt.001 Rw.004 Tegal Lega Bogor ', '32', 'Jawa Barat', '', 'DRAMAGA', NULL, NULL, '16680', 'Non Papua', 'YA', 'YA', 'SMK', '', '1243796411', '', '', 1, 'ANGGOTA', 4, 'RIDGE CAMP', 'SITI HALIMAH', 3, 'JIBRIL PUTRA SHOLEH', 'WIJAYA KUSUMA PUTRA SHOLEH', 'MIKAIL PUTRA SHOLEH', 'SUMARNI', 'SARONI', '-', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80007045', 'MAWAR11', '', 'FAISAL', '0000-00-00', 'Pria', '', '82291151561', 'FAISALLAPLE93@GMAIL.COM', 'TK', 'Indonesia', '7.31E+15', 'Batiling Ds. Batara Kec. Labakkang Kab. Pangkep Sulsel', '73', 'Sulawesi Selatan', '', 'LABAKKANG', NULL, NULL, '90653', 'Non Papua', 'YA', 'YA', 'SMA', '', '1243796613', '', '', 1, 'ANGGOTA', 4, 'RIDGE CAMP', '', 0, '', '', '', 'NURLIYA', 'RUMA', '85256164337', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80007577', 'MAWAR11', '', 'ARDY TIMBULENG', '0000-00-00', 'Pria', '', '82213101960', 'AYRTONZENA@YAHOO.COM', 'TK', 'Indonesia', '7.17E+15', 'Kel,Paslaten Dua Lingk Vi', '71', 'Sulawesi Utara', '', 'TOMOHON TIMUR', NULL, NULL, '', 'Non Papua', 'YA', 'YA', 'SMA', '', '1451308342', '', '', 4, 'ADM. OPERATOR', 3, 'MULKI', '', 0, '', '', '', 'AGUSTIEN LASUT', 'DANNY AROR', '85256444162', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80007587', 'MAWAR11', '', 'RIVELINO BRAIRY KUSSOY', '0000-00-00', 'Pria', '', '85340233296', '', 'TK', 'Indonesia', '7.10E+15', 'Jl. Walanda Maramis No. 140 Kel. Kendis lingkungan IV, kec. Tondano Timur, Kab. Minahasa, sulawesi utara', '71', 'Sulawesi Utara', '', 'TONDANO TIMUR', NULL, NULL, '95613', 'Non Papua', 'YA', 'YA', 'SMA', '', '1451306125', '', '', 1, 'ANGGOTA', 4, 'RIDGE CAMP', '', 0, '', '', '', 'JACQUALINE', 'ALEXANDER ', '81283388181', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80007588', 'MAWAR11', '', 'JAINUDIN', '0000-00-00', 'Pria', '', '8124374170', '', 'K1', 'Indonesia', '9.54E+14', 'Ds Talibau RT 13 RW 07 Kec Woha Kab Bima NTB', '52', 'NTB', '', 'WOHA', NULL, NULL, '84172', 'Non Papua', 'YA', 'YA', 'SMA', '', '1243796477', '', '', 1, 'ANGGOTA', 4, 'RIDGE CAMP', 'ERNAWATI', 2, 'DIDI HARTONO', '', '', 'SALMAH', 'H.A.KARIM', '82341307600', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80007589', 'MAWAR11', '', 'IRWAN', '0000-00-00', 'Pria', '', '81344640349', '', 'TK', 'Indonesia', '7.31E+15', 'Citta Rt 001 / Rw 007 Desa Bontomatene Kec.Segeri', '73', 'Sulawesi Selatan', '', 'SEGERI', NULL, NULL, '90655', 'Non Papua', 'YA', 'YA', 'SMA', '', '', '', '', 1, 'ANGGOTA', 4, 'RIDGE CAMP', '', 0, '', '', '', 'IMUNA MUNAWARAH', 'ARIFIN', '81344006344', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80007685', 'MAWAR11', '', 'YAHYA', '0000-00-00', 'Pria', '', '81310590972', '', 'K1', 'Indonesia', '3.60E+15', 'JL.Maleo III ASR.Grup 1 Kopasus', '36', 'Banten', '', 'Taktakan', NULL, NULL, '', 'Non Papua', 'YA', 'YA', 'SMA', '', '', '', '', 2, 'GEN FORMAN', 2, 'GORONG-GORONG', 'DJUMRIANI', 3, 'RIZKI CHANDRA YADI', 'AA MULYADI SYAHPUTRA', 'RIVAT ALVIANDI DANISWARA', 'SARIYAH(ALMH)', 'SARPAI(ALM)', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80007687', 'MAWAR11', '', 'PURYANTO', '0000-00-00', 'Pria', '', '81272716060', '', 'K1', 'Indonesia', '1.87E+15', 'Jl. Kraimun Jawa GG.Wisma I Blok A.12 LKI', '16', 'Sumatera Selatan', '', 'Sukarame', NULL, NULL, '', 'Non Papua', 'YA', 'YA', 'SMA', '', '', '', '', 2, 'GEN FORMAN', 2, 'GORONG-GORONG', 'SUBAIDAH', 1, 'DWI BUDI PRASETYO', '', '', 'SAKIEM', 'PANUT (ALM)', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80007692', 'MAWAR11', '', 'DEDE. HERYANA', '0000-00-00', 'Pria', '', '82113336650', '', 'TK', 'Indonesia', '3.67E+15', 'Lebak Jero,22/08 Taktakan ', '36', 'Banten', '', 'Taktakan', NULL, NULL, '', 'Non Papua', 'YA', 'YA', 'SMA', '', '1243796185', '', '', 1, 'ANGGOTA', 2, 'GORONG-GORONG', '', 0, '', '', '', 'LISWANTI', 'BAKRI KALLA', '85210944704', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80008013', 'MAWAR11', '', 'YUSUF BOKKO', '0000-00-00', 'Pria', '', '81242341510', '', 'K1', 'Indonesia', '7.33E+15', 'Asrama KODIM K.19,Rantepao 001/-,rantapao', '16', 'Sulawesi Selatan', '', 'Rantepao', NULL, NULL, '', 'Non Papua', 'YA', 'YA', 'SMP', '', '1104081513', '', '', 3, 'KOOR. LAP', 2, 'GORONG-GORONG', 'YUSTINA TA''DUNG', 3, 'ELISA WIRAYUDHANINGSI', 'MUTIARA DEWANTI', 'ANA YULIANA SOMBO', 'KORLINA LUMA', 'SAMPE BOLONG(ALM)', '82349498874', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80008026', 'MAWAR11', '', 'ROLAND RORONG', '0000-00-00', 'Pria', '', '82199577681', 'TERZYOTINK@GMAIL.COM', 'TK', 'Indonesia', '3.17E+14', 'Bantar Jati Rt 05 Rw 02 Setu Cipayung Jakarta Timur', '31', 'Dki Jakarta', '', 'CIPAYUNG', NULL, NULL, '', 'Non Papua', 'YA', 'YA', 'SMA', '', '450932827', '', '', 1, 'ANGGOTA', 5, 'FAMILY SHOOPING', '', 0, '', '', '', 'RITA ASTUTI', 'MAX RORONG', '2184973774', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80008194', 'MAWAR11', '', 'RUDI PURNOMO', '0000-00-00', 'Pria', '', '85244020535', 'RUDIP@GMAIL.COM', 'K1', 'Indonesia', '3.33E+15', 'Ds.Beji Rt.04/14 Taman Pemalang Jateng', '33', 'Jawa Tengah', '', 'TAMAN', NULL, NULL, '52361', 'Non Papua', 'YA', 'YA', 'SMK', '', '1243796062', '', '', 1, 'ANGGOTA', 4, 'RIDGE CAMP', '', 1, 'SYAKI SAPUTRA MULIAWAN', '', '', 'SUEMI', 'SANAP SANUSI', '85225128316', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80008196', 'MAWAR11', '', 'ASHABUL YAMIN', '0000-00-00', 'Pria', '', '82311380204', '', 'K1', 'Indonesia', '1.80E+15', 'Kampung Baru RT/RW 002/002 , Desa kampung baru, kec. Penengahan, Kab. Lampung selatan ', '16', 'Sumatera Selatan', '', 'PENENGAHAN', NULL, NULL, '35592', 'Non Papua', 'YA', 'YA', 'SMA', '', '1861773366', '', '', 1, 'ANGGOTA', 4, 'RIDGE CAMP', 'ELMA SAFITRI', 1, 'FATHIR ABDILAH PRATAMA', '', '', 'ALMUNAWAROH', 'MADDUNI', '81373988397', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80008198', 'MAWAR11', '', 'BAPERSON', '0000-00-00', 'Pria', '', '82347059064', 'BAPERSONANDI23@GMAIL.COM', 'K2', 'Indonesia', '7.31E+15', 'Btn.Himalaya Garderi Blok B3 No3 .', '72', 'Sulawesi Tengah', '', 'MANAWOLA', NULL, NULL, '94362', 'Non Papua', 'YA', 'YA', 'SMA', '', '1243797028', '', '', 2, 'GEN FORMAN', 3, 'MULKI', '', 2, 'FADHEL MUHAMAD', 'ADIBAH ARDELIA', '', 'SINARTI YAHYA', 'PATTOLA', '85241331171', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80008281', 'MAWAR11', '', 'SATIYO UTOMO', '0000-00-00', 'Pria', '', '81382047219', '', 'K1', 'Indonesia', '3.67E+15', 'Komplek Taman Pesona Blok E8 .01 Lialang Taktakan Kodya Serang Banten', '36', 'Banten', '', 'Taktakan', NULL, NULL, '', 'Non Papua', 'YA', 'YA', 'S1', '', '', '', '', 5, 'SUPERINTEDENT', 2, 'GORONG-GORONG', 'N.KUSNAWIYAH', 2, 'FERLY WAHYU WIBOWO', 'BONDAN WICAKSONO', '', 'PAIJEM', 'ADMO DIKORO (ALM)', '85213316710', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80008589', 'MAWAR11', '', 'SS HALAYYUDI', '0000-00-00', 'Pria', '', '81354698760', 'AHMAD.YURI98@GMAIL.COM', 'K1', 'Indonesia', '7.37E+15', 'Btn Citra Daya Permai 2, Jl-Torpedo 2 B.8 N0.5 Makasar', '16', 'Sulawesi Selatan', '', 'BIRING KANAYA', NULL, NULL, '90242', 'Non Papua', 'YA', 'YA', 'S1', '', '1243796758', '', '', 1, 'ANGGOTA', 5, 'FAMILY SHOOPING', 'TUSRINA', 1, 'ACHMAD YURIANSYAH', '', '', 'NURAENI D', 'MUH SAID', '82291598396', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80009488', 'MAWAR11', '', 'SAFRIANTO', '0000-00-00', 'Pria', '', '82148553062', '', 'TK', 'Indonesia', '6.10E+15', 'Komp. Pemda Sumur pecung baru, No 215. Rt 001 Rw 020, Desa Sumur Pecung Kec. Serang', '36', 'Banten', '', 'SERANG', NULL, NULL, '', 'Non Papua', 'YA', 'YA', 'SMA', '', '', '', '', 1, 'ANGGOTA', 4, 'RIDGE CAMP', '', 0, '', '', '', 'URAY SRI NILAWATI', 'IMAM ROHIB', '82199048872', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80009492', 'MAWAR11', '', 'ALBERTUS RENO ANTONIO', '0000-00-00', 'Pria', '', '82284612398', '', 'TK', 'Indonesia', '3.31E+16', 'DS. NGLINNGGI RT/RW. 003/ 008 KEL. KLATEN SELATAN KAB. KLATEN', '33', 'Jawa Tengah', '', 'KLATEN SELATAN', NULL, NULL, '57422', 'Non Papua', 'YA', 'YA', 'SMA', '', '', '', '', 1, 'ANGGOTA', 4, 'RIDGE CAMP', '', 0, '', '', '', 'Y.SRIMULYANI', 'V. HARDIANTO', '81336198370', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80009493', 'MAWAR11', '', 'ALI', '0000-00-00', 'Pria', '', '82137203111', '', 'K1', 'Indonesia', '3.32E+15', 'Desa Tanjung,Kedungtuban 003/002 Tanjung', '33', 'Jawa Tengah', '', 'Kedungtuban', NULL, NULL, '', 'Non Papua', 'YA', 'YA', 'SMP', '', '1104334266', '', '', 2, 'GEN FORMAN', 2, 'GORONG-GORONG', 'DARMINI', 2, 'YENI PUSPARINGA', 'JODI TRIAMBODO', '', 'SALIMAH(ALMH)', 'MUNAJI(ALM)', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80009494', 'MAWAR11', '', 'ANDREW KOMALING', '0000-00-00', 'Pria', '', '81270214451', '', 'TK', 'Indonesia', '7.10E+15', 'Tounelet Jaga 5 kec.Kakas', '71', 'Sulawesi Utara', '', 'Kakas', NULL, NULL, '', 'Non Papua', 'YA', 'YA', 'SMA', '', '1243797085', '', '', 1, 'ANGGOTA', 2, 'GORONG-GORONG', '', 0, '', '', '', 'ANGEL KUHU', 'DENNY KALENGKONGAN', '81244070004', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('80009497', 'MAWAR11', '', 'PARWOTO', '0000-00-00', 'Pria', '', '81390460669', '', 'K2', 'Indonesia', '3.32E+16', 'Mbalunsau Dagaran No.19 Rt 01 Rw 07 Cepu. Blora .Jateng', '33', 'Jawa Tengah', '', 'CEPU', NULL, NULL, '', 'Non Papua', 'YA', 'YA', 'SMP', '', '', '', '', 2, 'GEN FORMAN', 5, 'FAMILY SHOOPING', 'SRIPRIHATI', 2, 'EVI GURNIA PUSPITASARI', 'AMELIA KHUSUMA PRATIWI', '', 'SANEM', 'MARTOREJO', '81225262028', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('V. 141274', 'MAWAR11', '', 'SAIDI', '0000-00-00', 'Pria', '', '82398758693', '', 'K1', 'Indonesia', '3.60E+15', 'Kelapa Dua Rt.OO3/OO7', '36', 'Banten', '', 'Serang', NULL, NULL, '', 'Non Papua', 'YA', 'YA', 'SMA', '', '', '', '', 2, 'GEN FORMAN', 2, 'GORONG-GORONG', 'ENI ROSHAIMI', 1, 'TRI BAMBANG P', '', '', 'MURTINI', 'KARTO REJO (ALM)', '', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('V134168', 'MAWAR11', '', 'EPI HERLIYADI', '0000-00-00', 'Pria', '', '81280259333', '', 'K3', 'Indonesia', '3.60E+15', 'Pesona Cilegon Blok C2 No.14 Rt.13/04 Bojonegara Cilegon', '36', 'Banten', '', 'BOJO NEGARA', NULL, NULL, '', 'Non Papua', 'YA', 'YA', 'SMP', '', '1243796106', '', '', 2, 'GEN FORMAN', 4, 'RIDGE CAMP', 'SULAEMI', 6, 'ERIC HERMAWAN', 'LIA HERYANI', 'EMAN SUKMA HERLIYADI', 'YOYOH RAKAYAH', 'ASID KUSWEDI', '85290973653', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('V134203', 'MAWAR11', '', 'HERRY SUMARTONO', '0000-00-00', 'Pria', '', '82239157393', 'H.SUMATONO.HS@GMAIL.COM', 'K0', 'Indonesia', '3.22E+15', 'Kp. Sukarame Rt.004 Rw.16 Kec. Cipatat Kab. Bandung Barat', '32', 'Jawa Barat', '', 'CIPATAT', NULL, NULL, '40554', 'Non Papua', 'YA', 'YA', 'SMK', '', '1243796152', '', '', 4, 'ADM. OPERATOR', 4, 'RIDGE CAMP', 'RIANI WIDIASTUTI', 0, '', '', '', 'SITI HASANAH', 'ALM. JAMES MARGONO', '81321624001', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06'),
('V142912', 'MAWAR11', '', 'BAGUS PRASETIO', '0000-00-00', 'Pria', '', '81344127740', 'PRASTIOBAGUS4@GMAIL.COM', 'TK', 'Indonesia', '3.17E+15', 'Kembangan Jakbar Rt 010 Rw 004 ', '31', 'DKI Jakarta', '', 'KEMBANGAN', NULL, NULL, '15310', 'Non Papua', 'YA', 'YA', 'SMA', '', '1890968848', '', '', 1, 'ANGGOTA', 4, 'RIDGE CAMP', '', 0, '', '', '', 'TRI AIDA SAKURAWATI', 'BUDI SANTOSO', '81285755444', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06');
INSERT INTO `data_pegawai` (`nip`, `branch`, `supervisor`, `nama_lengkap`, `tanggal_lahir`, `jenis_kelamin`, `no_telp`, `no_hp`, `email`, `status_pernikahan`, `kewarganegaraan`, `no_ktp`, `alamat`, `provinsi`, `provinsi_nama`, `kota`, `kota_nama`, `kecamatan`, `kelurahan`, `kode_pos`, `suku`, `literasi_membaca`, `literasi_menulis`, `pendidikan`, `riwayat_penyakit`, `bpjs_kesehatan`, `bpjs_ketenagakerjaan`, `asurasi`, `jenis_jabatan`, `jenis_jabatan_nama`, `jenis_divisi`, `jenis_divisi_nama`, `nama_pasangan`, `jumlah_anak`, `nama_anak_1`, `nama_anak_2`, `nama_anak_3`, `nama_ibu`, `nama_ayah`, `kontak_keluarga_1`, `kontak_keluarga_2`, `instansi_terakhir`, `pangkat`, `jabatan`, `status`, `catatan_kinerja`, `masa_kontrak_mulai`, `masa_kontrak_selesai`, `tanggal_bergabung`, `created_at`, `updated_at`) VALUES
('V145741', 'MAWAR11', '', 'SULAM TAUFIK', '0000-00-00', 'Pria', '', '82324455757', '', 'TK', 'Indonesia', '3.18E+15', 'Cipinang Melayu, RT/RW 006/001, Kelurahan Cipinang Melayu, Kecamatan Makasar', '31', 'DKI Jakarta', '', 'MAKASAR', NULL, NULL, '13620', 'Non Papua', 'YA', 'YA', 'SMA', '', '1218995493', '', '', 1, 'ANGGOTA', 4, 'RIDGE CAMP', '', 0, '', '', '', 'SUPANGAH', 'IMAM S', '81317116380', '', '', '', '', NULL, NULL, '0000-00-00', '0000-00-00', '0000-00-00', '2016-04-18 07:05:06', '2016-04-18 07:05:06');

-- --------------------------------------------------------

--
-- Table structure for table `data_provinsi`
--

CREATE TABLE `data_provinsi` (
  `id` varchar(2) NOT NULL,
  `name` varchar(256) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_provinsi`
--

INSERT INTO `data_provinsi` (`id`, `name`) VALUES
('11', 'ACEH'),
('12', 'SUMATERA UTARA'),
('13', 'SUMATERA BARAT'),
('14', 'RIAU'),
('15', 'JAMBI'),
('16', 'SUMATERA SELATAN'),
('17', 'BENGKULU'),
('18', 'LAMPUNG'),
('19', 'KEPULAUAN BANGKA BELITUNG'),
('21', 'KEPULAUAN RIAU'),
('31', 'DKI JAKARTA'),
('32', 'JAWA BARAT'),
('33', 'JAWA TENGAH'),
('34', 'DI YOGYAKARTA'),
('35', 'JAWA TIMUR'),
('36', 'BANTEN'),
('51', 'BALI'),
('52', 'NUSA TENGGARA BARAT'),
('53', 'NUSA TENGGARA TIMUR'),
('61', 'KALIMANTAN BARAT'),
('62', 'KALIMANTAN TENGAH'),
('63', 'KALIMANTAN SELATAN'),
('64', 'KALIMANTAN TIMUR'),
('65', 'KALIMANTAN UTARA'),
('71', 'SULAWESI UTARA'),
('72', 'SULAWESI TENGAH'),
('73', 'SULAWESI SELATAN'),
('74', 'SULAWESI TENGGARA'),
('75', 'GORONTALO'),
('76', 'SULAWESI BARAT'),
('81', 'MALUKU'),
('82', 'MALUKU UTARA'),
('91', 'PAPUA BARAT'),
('94', 'PAPUA');

-- --------------------------------------------------------

--
-- Table structure for table `insiden_pegawai`
--

CREATE TABLE `insiden_pegawai` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `url` text,
  `nip` varchar(128) DEFAULT NULL,
  `tipe` varchar(64) DEFAULT NULL,
  `deskripsi` text,
  `tempat_terjadi` varchar(256) DEFAULT NULL,
  `waktu_terjadi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `waktu_laporan` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `photo_id` varchar(256) DEFAULT NULL,
  `pelapor_nama` varchar(512) DEFAULT NULL,
  `pelapor_akun` varchar(512) DEFAULT NULL,
  `pelapor_nip` varchar(128) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kinerja_pegawai`
--

CREATE TABLE `kinerja_pegawai` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nip` varchar(128) DEFAULT NULL,
  `nama_penugasan` varchar(256) DEFAULT NULL,
  `keterangan` text,
  `catatan_kinerja` text,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ms_branch`
--

CREATE TABLE `ms_branch` (
  `kode_branch` int(11) NOT NULL,
  `nama_branch` varchar(256) DEFAULT NULL,
  `warna_branch` varchar(128) DEFAULT NULL,
  `deskripsi_branch` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ms_branch`
--

INSERT INTO `ms_branch` (`kode_branch`, `nama_branch`, `warna_branch`, `deskripsi_branch`, `created_at`) VALUES
(1, 'MAWAR11', '#A6D279', 'Cabang Mawar 11', '2016-04-18 12:53:46'),
(2, 'MS', '#B59FDF', 'Cabang MS', '2016-04-18 12:53:46');

-- --------------------------------------------------------

--
-- Table structure for table `ms_divisi`
--

CREATE TABLE `ms_divisi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_jabatan` int(11) NOT NULL,
  `kode_divisi` int(11) NOT NULL,
  `nama_jabatan` varchar(256) DEFAULT NULL,
  `nama_divisi` varchar(256) DEFAULT NULL,
  `deskripsi_divisi` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ms_divisi`
--

INSERT INTO `ms_divisi` (`id`, `kode_jabatan`, `kode_divisi`, `nama_jabatan`, `nama_divisi`, `deskripsi_divisi`, `created_at`) VALUES
(1, 1, 1, 'ANGGOTA', 'TERMINAL', 'ANGGOTA - TERMINAL', '2016-06-07 13:31:59'),
(2, 1, 2, 'ANGGOTA', 'GORONG-GORONG', 'ANGGOTA - GORONG-GORONG', '2016-06-07 13:32:00'),
(3, 1, 3, 'ANGGOTA', 'MULKI', 'ANGGOTA - MULKI', '2016-06-07 13:32:00'),
(4, 1, 4, 'ANGGOTA', 'RIDGE CAMP', 'ANGGOTA - RIDGE CAMP', '2016-06-07 13:32:00'),
(5, 1, 5, 'ANGGOTA', 'FAMILY SHOPPING', 'ANGGOTA - FAMILY SHOPPING', '2016-06-07 13:32:00'),
(6, 2, 1, 'GEN FORMAN', 'TERMINAL', 'GEN FORMAN - TERMINAL', '2016-06-07 13:32:00'),
(7, 2, 2, 'GEN FORMAN', 'GORONG-GORONG', 'GEN FORMAN - GORONG-GORONG', '2016-06-07 13:32:00'),
(8, 2, 3, 'GEN FORMAN', 'MULKI', 'GEN FORMAN - MULKI', '2016-06-07 13:32:00'),
(9, 2, 4, 'GEN FORMAN', 'RIDGE CAMP', 'GEN FORMAN - RIDGE CAMP', '2016-06-07 13:32:00'),
(10, 2, 5, 'GEN FORMAN', 'FAMILY SHOPPING', 'GEN FORMAN - FAMILY SHOPPING', '2016-06-07 13:32:00'),
(11, 3, 1, 'KOOR. LAP', 'TERMINAL', 'KOOR. LAP - TERMINAL', '2016-06-07 13:32:00'),
(12, 3, 2, 'KOOR. LAP', 'GORONG-GORONG', 'KOOR. LAP - GORONG-GORONG', '2016-06-07 13:32:00'),
(13, 3, 3, 'KOOR. LAP', 'MULKI', 'KOOR. LAP - MULKI', '2016-06-07 13:32:00'),
(14, 3, 4, 'KOOR. LAP', 'RIDGE CAMP', 'KOOR. LAP - RIDGE CAMP', '2016-06-07 13:32:00'),
(15, 3, 5, 'KOOR. LAP', 'FAMILY SHOPPING', 'KOOR. LAP - FAMILY SHOPPING', '2016-06-07 13:32:00'),
(16, 4, 1, 'ADM. OPERATOR', 'TERMINAL', 'ADM. OPERATOR - TERMINAL', '2016-06-07 13:32:00'),
(17, 4, 2, 'ADM. OPERATOR', 'GORONG-GORONG', 'ADM. OPERATOR - GORONG-GORONG', '2016-06-07 13:32:00'),
(18, 4, 3, 'ADM. OPERATOR', 'MULKI', 'ADM. OPERATOR - MULKI', '2016-06-07 13:32:00'),
(19, 4, 4, 'ADM. OPERATOR', 'RIDGE CAMP', 'ADM. OPERATOR - RIDGE CAMP', '2016-06-07 13:32:00'),
(20, 4, 5, 'ADM. OPERATOR', 'FAMILY SHOPPING', 'ADM. OPERATOR - FAMILY SHOPPING', '2016-06-07 13:32:00'),
(21, 5, 1, 'SUPERINTEDENT', 'TERMINAL', 'SUPERINTEDENT - TERMINAL', '2016-06-07 13:32:00'),
(22, 5, 2, 'SUPERINTEDENT', 'GORONG-GORONG', 'SUPERINTEDENT - GORONG-GORONG', '2016-06-07 13:32:00'),
(23, 5, 3, 'SUPERINTEDENT', 'MULKI', 'SUPERINTEDENT - MULKI', '2016-06-07 13:32:00'),
(24, 5, 4, 'SUPERINTEDENT', 'RIDGE CAMP', 'SUPERINTEDENT - RIDGE CAMP', '2016-06-07 13:32:00'),
(25, 5, 5, 'SUPERINTEDENT', 'FAMILY SHOPPING', 'SUPERINTEDENT - FAMILY SHOPPING', '2016-06-07 13:32:00'),
(26, 6, 1, 'GENERAL MANAGER', 'TERMINAL', 'GENERAL MANAGER - TERMINAL', '2016-06-07 13:32:00'),
(27, 6, 2, 'GENERAL MANAGER', 'GORONG-GORONG', 'GENERAL MANAGER - GORONG-GORONG', '2016-06-07 13:32:00'),
(28, 6, 3, 'GENERAL MANAGER', 'MULKI', 'GENERAL MANAGER - MULKI', '2016-06-07 13:32:00'),
(29, 6, 4, 'GENERAL MANAGER', 'RIDGE CAMP', 'GENERAL MANAGER - RIDGE CAMP', '2016-06-07 13:32:00'),
(30, 6, 5, 'GENERAL MANAGER', 'FAMILY SHOPPING', 'GENERAL MANAGER - FAMILY SHOPPING', '2016-06-07 13:32:00');

-- --------------------------------------------------------

--
-- Table structure for table `ms_jabatan`
--

CREATE TABLE `ms_jabatan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(256) DEFAULT NULL,
  `deskripsi_jabatan` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ms_jabatan`
--

INSERT INTO `ms_jabatan` (`id`, `kode_jabatan`, `nama_jabatan`, `deskripsi_jabatan`, `created_at`) VALUES
(14, 1, 'ANGGOTA', 'ANGGOTA', '2016-03-11 02:05:05'),
(15, 2, 'GEN FORMAN', 'GEN FORMAN', '2016-03-11 02:05:05'),
(16, 3, 'KOOR. LAP', 'KOOR. LAP', '2016-03-11 02:05:05'),
(17, 4, 'ADM. OPERATOR', 'ADM. OPERATOR', '2016-03-11 02:05:05'),
(18, 5, 'SUPERINTEDENT', 'SUPERINTEDENT', '2016-03-11 02:05:05'),
(19, 6, 'GENERAL MANAGER', 'GENERAL MANAGER', '2016-03-11 02:05:05');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset`
--

CREATE TABLE `password_reset` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(256) NOT NULL,
  `token` varchar(256) DEFAULT NULL,
  `confirmed` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `setting_aplikasi_boolean`
--

CREATE TABLE `setting_aplikasi_boolean` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` int(11) NOT NULL,
  `value` tinyint(1) DEFAULT '0',
  `description` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting_aplikasi_boolean`
--

INSERT INTO `setting_aplikasi_boolean` (`id`, `code`, `value`, `description`, `created_at`, `updated_at`) VALUES
(1, 101, 0, 'true for registration is active', '2016-06-29 21:04:26', '2016-06-20 15:19:19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nip` varchar(128) NOT NULL,
  `name` varchar(512) DEFAULT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(128) NOT NULL,
  `remember_token` varchar(128) DEFAULT NULL,
  `superadmin` tinyint(1) DEFAULT '0',
  `role_1` tinyint(1) DEFAULT '0',
  `role_2` tinyint(1) DEFAULT '0',
  `role_3` tinyint(1) DEFAULT '0',
  `role_4` tinyint(1) DEFAULT '0',
  `role_5` tinyint(1) DEFAULT '0',
  `role_6` tinyint(1) DEFAULT '0',
  `role_7` tinyint(1) DEFAULT '0',
  `role_8` tinyint(1) DEFAULT '0',
  `role_9` tinyint(1) DEFAULT '0',
  `role_10` tinyint(1) DEFAULT '0',
  `role_11` tinyint(1) DEFAULT '0',
  `role_12` tinyint(1) DEFAULT '0',
  `role_13` tinyint(1) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nip`, `name`, `email`, `password`, `remember_token`, `superadmin`, `role_1`, `role_2`, `role_3`, `role_4`, `role_5`, `role_6`, `role_7`, `role_8`, `role_9`, `role_10`, `role_11`, `role_12`, `role_13`, `created_at`, `updated_at`) VALUES
(15, '1306413953', 'Taufiq Vahruddin V2', 'taufiq@astrnt.co', '$2y$10$grceCo0Za6CwtmUcjp8cn.abbQDl5E24QYwgTo5Zo55ZgQPSnhiDC', 'w4A1PNfJo9B4fmrbwoSb6Vlyq3WP3ImgWk420YTZe0iXARJ8KsADzgYduO9C', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2016-06-26 03:36:25', '2016-06-25 20:36:25'),
(17, '1306413952', 'Taufiq Bahruddin', 'taufiky@gmail.com', '$2y$10$TLCh2MmPHh.NxbrW082nLu02p60UQJcVxqjqngv/Gzp/ZOJO8WxHy', 'cmgNlboBz2ahU3JC3OEG5rP3r53g43XQrs4SBAUK2MbQ50yXGvyfURxNecsX', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2016-06-30 12:18:15', '2016-06-30 05:18:15'),
(20, '1306413954', 'Taufiq Bahruddin V3', 'taufiq.bahruddin@yahoo.com', '$2y$10$f7PQ5FDwJNcIy5X99Gf2Vuib76yHgZB.rEvcRRm/9j32xtrra6kEG', NULL, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2016-06-26 12:56:16', '2016-06-25 21:09:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_cuti`
--
ALTER TABLE `data_cuti`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `data_kota`
--
ALTER TABLE `data_kota`
  ADD PRIMARY KEY (`id`,`id_provinsi`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `data_pegawai`
--
ALTER TABLE `data_pegawai`
  ADD PRIMARY KEY (`nip`),
  ADD UNIQUE KEY `nip` (`nip`);

--
-- Indexes for table `data_provinsi`
--
ALTER TABLE `data_provinsi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `insiden_pegawai`
--
ALTER TABLE `insiden_pegawai`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `kinerja_pegawai`
--
ALTER TABLE `kinerja_pegawai`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `ms_branch`
--
ALTER TABLE `ms_branch`
  ADD PRIMARY KEY (`kode_branch`);

--
-- Indexes for table `ms_divisi`
--
ALTER TABLE `ms_divisi`
  ADD PRIMARY KEY (`kode_jabatan`,`kode_divisi`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `ms_jabatan`
--
ALTER TABLE `ms_jabatan`
  ADD PRIMARY KEY (`kode_jabatan`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `kode_jabatan` (`kode_jabatan`);

--
-- Indexes for table `password_reset`
--
ALTER TABLE `password_reset`
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `setting_aplikasi_boolean`
--
ALTER TABLE `setting_aplikasi_boolean`
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `nip` (`nip`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_cuti`
--
ALTER TABLE `data_cuti`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `insiden_pegawai`
--
ALTER TABLE `insiden_pegawai`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kinerja_pegawai`
--
ALTER TABLE `kinerja_pegawai`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ms_divisi`
--
ALTER TABLE `ms_divisi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `ms_jabatan`
--
ALTER TABLE `ms_jabatan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `password_reset`
--
ALTER TABLE `password_reset`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `setting_aplikasi_boolean`
--
ALTER TABLE `setting_aplikasi_boolean`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
