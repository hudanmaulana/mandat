-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 02, 2019 at 02:46 PM
-- Server version: 5.6.38
-- PHP Version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `merbabudev_manajemen_data`
--

-- --------------------------------------------------------

--
-- Table structure for table `dataFidusia`
--

CREATE TABLE `dataFidusia` (
  `id` int(11) NOT NULL,
  `no_kontrak` varchar(20) NOT NULL,
  `ketegori_fidusia` varchar(100) NOT NULL,
  `jenis_fidusia` varchar(100) NOT NULL,
  `jk_pemberiFidusia` varchar(100) NOT NULL,
  `jenis_penggunaa` varchar(100) NOT NULL,
  `nama_pemberi` varchar(80) NOT NULL,
  `nik_pemberi` varchar(50) NOT NULL,
  `telp_pemberi` varchar(20) NOT NULL,
  `alamat_pemberi` text NOT NULL,
  `pos_pemberi` varchar(10) NOT NULL,
  `prov_pemberi` varchar(50) NOT NULL,
  `kab_pemberi` varchar(100) NOT NULL,
  `kec_pemberi` varchar(100) NOT NULL,
  `kel_pemberi` varchar(100) NOT NULL,
  `rt_pemberi` varchar(10) NOT NULL,
  `rw_pemberi` varchar(10) NOT NULL,
  `nama_debitur` varchar(80) NOT NULL,
  `kategori_penerimaFidusia` varchar(100) NOT NULL,
  `subKategori_penerima` varchar(100) NOT NULL,
  `nama_penerima` varchar(80) NOT NULL,
  `npwp_penerima` varchar(50) NOT NULL,
  `telp_penerima` varchar(20) NOT NULL,
  `alamat_penerima` text NOT NULL,
  `pos_penerima` varchar(10) NOT NULL,
  `prov_penerima` varchar(100) NOT NULL,
  `kab_penerima` varchar(100) NOT NULL,
  `kec_penerima` varchar(100) NOT NULL,
  `kel_penerima` varchar(100) NOT NULL,
  `rt_penerima` varchar(10) NOT NULL,
  `rw_penerima` varchar(10) NOT NULL,
  `nomor_akta` varchar(50) NOT NULL,
  `tgl_akta` date NOT NULL,
  `nama_notaris` varchar(80) NOT NULL,
  `kedudukan_notaris` varchar(100) NOT NULL,
  `isi_perjanjian` text NOT NULL,
  `nilai_penjaminFidusia` varchar(10) NOT NULL,
  `berdasarkan` text NOT NULL,
  `waktu_perjanjianAwal` date NOT NULL,
  `waktu_perjanjianAhir` date NOT NULL,
  `kategori_objek` varchar(100) NOT NULL,
  `jumlah_roda` text NOT NULL,
  `merk_objek` varchar(30) NOT NULL,
  `tipe_objek` varchar(80) NOT NULL,
  `no_rangka` varchar(100) NOT NULL,
  `no_mesin` varchar(100) NOT NULL,
  `bukti_objek` text NOT NULL,
  `nilai_objek` int(11) NOT NULL,
  `nilai_penjamin` int(11) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'terupload',
  `field_1` varchar(200) NOT NULL,
  `field_2` varchar(200) NOT NULL,
  `alasan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dataFidusia`
--

INSERT INTO `dataFidusia` (`id`, `no_kontrak`, `ketegori_fidusia`, `jenis_fidusia`, `jk_pemberiFidusia`, `jenis_penggunaa`, `nama_pemberi`, `nik_pemberi`, `telp_pemberi`, `alamat_pemberi`, `pos_pemberi`, `prov_pemberi`, `kab_pemberi`, `kec_pemberi`, `kel_pemberi`, `rt_pemberi`, `rw_pemberi`, `nama_debitur`, `kategori_penerimaFidusia`, `subKategori_penerima`, `nama_penerima`, `npwp_penerima`, `telp_penerima`, `alamat_penerima`, `pos_penerima`, `prov_penerima`, `kab_penerima`, `kec_penerima`, `kel_penerima`, `rt_penerima`, `rw_penerima`, `nomor_akta`, `tgl_akta`, `nama_notaris`, `kedudukan_notaris`, `isi_perjanjian`, `nilai_penjaminFidusia`, `berdasarkan`, `waktu_perjanjianAwal`, `waktu_perjanjianAhir`, `kategori_objek`, `jumlah_roda`, `merk_objek`, `tipe_objek`, `no_rangka`, `no_mesin`, `bukti_objek`, `nilai_objek`, `nilai_penjamin`, `status`, `field_1`, `field_2`, `alasan`) VALUES
(1, 'e221312', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', '', '', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', 0, 0, 'reject', '', '', 'qweqw ewqeqw'),
(2, '12312e', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', '', '', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', 0, 0, 'terkirim', 'Hyper_-_Responsive_Bootstrap_4_Admin_Dashboard2.pdf', '', 'terkirim');

-- --------------------------------------------------------

--
-- Table structure for table `dataSertifikat`
--

CREATE TABLE `dataSertifikat` (
  `no_sertifikat` varchar(50) NOT NULL,
  `billid` int(10) NOT NULL,
  `jasa` decimal(20,0) NOT NULL,
  `pnbp` decimal(20,0) NOT NULL,
  `tot_biaya` decimal(20,0) NOT NULL,
  `field_1` varchar(200) NOT NULL,
  `field_2` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dataSertifikat`
--

INSERT INTO `dataSertifikat` (`no_sertifikat`, `billid`, `jasa`, `pnbp`, `tot_biaya`, `field_1`, `field_2`) VALUES
('123445656', 8901, '100001', '200001', '300001', '', ''),
('4324', 3423, '0', '4', '432', 'das.pdf', 'Hyper_-_Responsive_Bootstrap_4_Admin_Dashboard3.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `dataUser`
--

CREATE TABLE `dataUser` (
  `id` int(11) NOT NULL,
  `nama` varchar(80) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `otoritas` int(2) NOT NULL,
  `usernameFidusia` varchar(100) DEFAULT NULL,
  `passFidusia` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `doRegis`
--

CREATE TABLE `doRegis` (
  `user` int(11) NOT NULL,
  `done` int(11) NOT NULL,
  `idData` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rn_groups`
--

CREATE TABLE `rn_groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `groups_slug` varchar(100) NOT NULL,
  `groups_parent` int(11) NOT NULL,
  `groups_lineage` longtext NOT NULL,
  `groups_deep` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rn_groups`
--

INSERT INTO `rn_groups` (`id`, `name`, `description`, `groups_slug`, `groups_parent`, `groups_lineage`, `groups_deep`) VALUES
(1, 'admin', 'Administrator', '0', 0, '00001', 0),
(2, 'members', 'General User', '0', 0, '00002', 0);

-- --------------------------------------------------------

--
-- Table structure for table `rn_login_attempts`
--

CREATE TABLE `rn_login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rn_logs`
--

CREATE TABLE `rn_logs` (
  `id` int(11) NOT NULL,
  `log` text,
  `type` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rn_notification`
--

CREATE TABLE `rn_notification` (
  `notification_id` bigint(20) NOT NULL,
  `notification_type` varchar(50) NOT NULL,
  `notification_user` bigint(20) NOT NULL,
  `notification_parent` bigint(20) NOT NULL,
  `notification_desc` tinytext NOT NULL,
  `notification_status` varchar(10) NOT NULL,
  `notification_icon` varchar(50) NOT NULL,
  `notification_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rn_setting`
--

CREATE TABLE `rn_setting` (
  `setting_id` bigint(20) NOT NULL,
  `setting_type` varchar(60) CHARACTER SET utf8 NOT NULL,
  `setting_name` varchar(60) CHARACTER SET utf8 NOT NULL,
  `setting_value` text CHARACTER SET utf8 NOT NULL,
  `setting_desc` varchar(100) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rn_setting`
--

INSERT INTO `rn_setting` (`setting_id`, `setting_type`, `setting_name`, `setting_value`, `setting_desc`) VALUES
(1, 'cpanel', 'default', 'defaultback', ''),
(104, 'dashboard_logo', 'site_logo', 'logo-colored@2x.png', ''),
(111, 'dashboard_setting', 'site_title', 'Manajemen Data', ''),
(112, 'dashboard_setting', 'site_keyword', 'Reponesia', ''),
(113, 'dashboard_setting', 'site_description', 'Manajemen Data By Reponesia', ''),
(114, 'dashboard_setting', 'tagline', 'Tagline Reponesia', ''),
(115, 'dashboard_setting', 'company_name', 'Reponesia, PT', ''),
(116, 'dashboard_setting', 'company_address', 'Semarang, ID', ''),
(117, 'front-customize', 'Primary Menu', '21', 'menu');

-- --------------------------------------------------------

--
-- Table structure for table `rn_users`
--

CREATE TABLE `rn_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `salt` varchar(200) NOT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `user_subscribe` tinyint(1) DEFAULT '1',
  `company` varchar(100) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `date_birth` date DEFAULT NULL,
  `display_name` varchar(150) DEFAULT NULL,
  `bio` text,
  `gender` varchar(100) DEFAULT NULL,
  `avatar` varchar(250) DEFAULT 'avatar.png',
  `facebook` varchar(150) DEFAULT NULL,
  `twitter` varchar(100) DEFAULT NULL,
  `instagram` varchar(200) NOT NULL,
  `google_plus` varchar(150) DEFAULT NULL,
  `google_id` varchar(100) DEFAULT NULL,
  `current_location` varchar(200) DEFAULT NULL,
  `cover` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `token` char(36) DEFAULT NULL,
  `province_id` varchar(10) DEFAULT NULL,
  `city_id` varchar(10) DEFAULT NULL,
  `postal_code` varchar(10) DEFAULT NULL,
  `email_verified` tinyint(1) NOT NULL DEFAULT '0',
  `phone_verified` tinyint(1) NOT NULL DEFAULT '0',
  `is_login` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rn_users`
--

INSERT INTO `rn_users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `salt`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `user_subscribe`, `company`, `mobile`, `date_birth`, `display_name`, `bio`, `gender`, `avatar`, `facebook`, `twitter`, `instagram`, `google_plus`, `google_id`, `current_location`, `cover`, `address`, `token`, `province_id`, `city_id`, `postal_code`, `email_verified`, `phone_verified`, `is_login`) VALUES
(1, '127.0.0.1', 'admin', '$2y$12$PzXu8/.1XADH8wOh1K8J3.BffgXh9ExvvIzKL86hSjkkdpCzmbZ/.', 'admin@admin.com', NULL, '', '', NULL, NULL, NULL, NULL, NULL, 1268889823, 1562041384, 1, 1, 'Reponesia', '0', NULL, 'Mimin WebDev', NULL, NULL, 'avatar.png', NULL, NULL, '', NULL, NULL, 'Jl kaliwiru vi no 35 Candisari, Kota Semarang', '', NULL, 'd539fd1f-d863-40b6-9115-12af2d72f712', NULL, NULL, NULL, 0, 0, 0),
(2, '', 'suplier2', '$2y$10$LGbiGzFznuLeNSGN.itEm.7lq.YEgd/t1UDEb63WyHIqPR4tLkN66', 'sup@gmail.com', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 1557247566, 1557247566, 1, 1, NULL, '0493289423', NULL, 'suplier bambang', NULL, 'male', 'avatar.png', NULL, NULL, '', NULL, NULL, 'jakarta', '', NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(3, '', 'supliernaruto', '$2y$10$dGRY0Uy5jO6UzZzFHwMsBuKAoIpXkRaDgLvJtXNG3cnEwrnfB61bu', 'naruto@gmail.com', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 1557909894, 1557909894, 1, 1, NULL, '042392342', NULL, 'bapak naruto', NULL, 'male', 'avatar.png', NULL, NULL, '', NULL, NULL, 'smg', '', NULL, NULL, NULL, NULL, NULL, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `rn_users_groups`
--

CREATE TABLE `rn_users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rn_users_groups`
--

INSERT INTO `rn_users_groups` (`id`, `user_id`, `group_id`) VALUES
(38, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dataFidusia`
--
ALTER TABLE `dataFidusia`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dataUser`
--
ALTER TABLE `dataUser`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doRegis`
--
ALTER TABLE `doRegis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `data_yang_diregister` (`idData`),
  ADD KEY `notaris_yang_meregister` (`user`);

--
-- Indexes for table `rn_groups`
--
ALTER TABLE `rn_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rn_login_attempts`
--
ALTER TABLE `rn_login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rn_notification`
--
ALTER TABLE `rn_notification`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `rn_setting`
--
ALTER TABLE `rn_setting`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `rn_users`
--
ALTER TABLE `rn_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_email` (`email`),
  ADD UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  ADD UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  ADD UNIQUE KEY `uc_remember_selector` (`remember_selector`);

--
-- Indexes for table `rn_users_groups`
--
ALTER TABLE `rn_users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dataFidusia`
--
ALTER TABLE `dataFidusia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `dataUser`
--
ALTER TABLE `dataUser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doRegis`
--
ALTER TABLE `doRegis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rn_groups`
--
ALTER TABLE `rn_groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rn_login_attempts`
--
ALTER TABLE `rn_login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rn_notification`
--
ALTER TABLE `rn_notification`
  MODIFY `notification_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rn_setting`
--
ALTER TABLE `rn_setting`
  MODIFY `setting_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `rn_users`
--
ALTER TABLE `rn_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rn_users_groups`
--
ALTER TABLE `rn_users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `doRegis`
--
ALTER TABLE `doRegis`
  ADD CONSTRAINT `data_yang_diregister` FOREIGN KEY (`idData`) REFERENCES `dataFidusia` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `notaris_yang_meregister` FOREIGN KEY (`user`) REFERENCES `dataUser` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `rn_users_groups`
--
ALTER TABLE `rn_users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `rn_groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `rn_users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
