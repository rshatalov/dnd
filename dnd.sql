-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 29, 2014 at 06:45 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dnd`
--

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE IF NOT EXISTS `tables` (
  `dm_uid` varchar(13) DEFAULT NULL,
  `dm_user_name` varchar(30) DEFAULT NULL,
  `tid` varchar(13) NOT NULL DEFAULT '',
  `table_name` varchar(30) DEFAULT NULL,
  `table_desc` text,
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`dm_uid`, `dm_user_name`, `tid`, `table_name`, `table_desc`) VALUES
('53b1fd5a3e6d2', 'olga', '53b248bef3c71', '1st battle', 'battle desc');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE IF NOT EXISTS `units` (
  `uid` varchar(13) NOT NULL DEFAULT '',
  `status` varchar(20) DEFAULT NULL,
  `type` varchar(15) DEFAULT NULL,
  `user_id` varchar(13) DEFAULT NULL,
  `monster_id` varchar(13) DEFAULT NULL,
  `user_name` varchar(30) DEFAULT NULL,
  `name` varchar(30) DEFAULT NULL,
  `size` varchar(3) DEFAULT NULL,
  `race` varchar(30) DEFAULT NULL,
  `alignment` varchar(30) DEFAULT NULL,
  `divinity` varchar(30) DEFAULT NULL,
  `class` text,
  `level` varchar(30) DEFAULT NULL,
  `age` varchar(30) DEFAULT NULL,
  `sex` varchar(30) DEFAULT NULL,
  `height` varchar(30) DEFAULT NULL,
  `weight` varchar(30) DEFAULT NULL,
  `eyes_color` varchar(30) DEFAULT NULL,
  `hair_color` varchar(30) DEFAULT NULL,
  `skin_color` varchar(30) DEFAULT NULL,
  `strength` varchar(30) DEFAULT NULL,
  `dexterity` varchar(30) DEFAULT NULL,
  `force` varchar(30) DEFAULT NULL,
  `intelligence` varchar(30) DEFAULT NULL,
  `wisdom` varchar(30) DEFAULT NULL,
  `charism` varchar(30) DEFAULT NULL,
  `resistance_at_damage` varchar(30) DEFAULT NULL,
  `speed` varchar(30) DEFAULT NULL,
  `var_initiative` varchar(30) DEFAULT NULL,
  `natural_armor` varchar(30) DEFAULT NULL,
  `deflection_armor` varchar(30) DEFAULT NULL,
  `var_armor` varchar(30) DEFAULT NULL,
  `max_hp` int(11) DEFAULT NULL,
  `actual_hp` int(11) DEFAULT NULL,
  `tempra_base` int(11) DEFAULT NULL,
  `tempra_magia` int(11) DEFAULT NULL,
  `tempra_vari` int(11) DEFAULT NULL,
  `tempra_temp` int(11) DEFAULT NULL,
  `riflessi_base` int(11) DEFAULT NULL,
  `riflessi_magia` int(11) DEFAULT NULL,
  `riflessi_vari` int(11) DEFAULT NULL,
  `riflessi_temp` int(11) DEFAULT NULL,
  `volonta_base` int(11) DEFAULT NULL,
  `volonta_magia` int(11) DEFAULT NULL,
  `volonta_vari` int(11) DEFAULT NULL,
  `volonta_temp` int(11) DEFAULT NULL,
  `attaco_base` int(11) DEFAULT NULL,
  `res_inc` int(11) DEFAULT NULL,
  `lotta_vari` int(11) DEFAULT NULL,
  `attacco_mischia_1` text,
  `danni_mischia_1` int(11) DEFAULT NULL,
  `critico_mischia_1` int(11) DEFAULT NULL,
  `magico_mischia_1` int(11) DEFAULT NULL,
  `mani_mischia_1` int(11) DEFAULT NULL,
  `gittata_mischia_1` text,
  `malus_mischia_1` int(11) DEFAULT NULL,
  `perfetto_mischia_1` int(11) DEFAULT NULL,
  `tipo_mischia_1` text,
  `note_mischia_1` text,
  `bm_mischia_1` int(11) DEFAULT NULL,
  `taglia_mischia_1` text,
  `attacco_mischia_2` text,
  `danni_mischia_2` int(11) DEFAULT NULL,
  `critico_mischia_2` int(11) DEFAULT NULL,
  `magico_mischia_2` int(11) DEFAULT NULL,
  `mani_mischia_2` int(11) DEFAULT NULL,
  `gittata_mischia_2` text,
  `malus_mischia_2` int(11) DEFAULT NULL,
  `perfetto_mischia_2` int(11) DEFAULT NULL,
  `tipo_mischia_2` text,
  `note_mischia_2` text,
  `bm_mischia_2` int(11) DEFAULT NULL,
  `taglia_mischia_2` text,
  `attacco_mischia_3` text,
  `danni_mischia_3` int(11) DEFAULT NULL,
  `critico_mischia_3` int(11) DEFAULT NULL,
  `magico_mischia_3` int(11) DEFAULT NULL,
  `mani_mischia_3` int(11) DEFAULT NULL,
  `gittata_mischia_3` text,
  `malus_mischia_3` int(11) DEFAULT NULL,
  `perfetto_mischia_3` int(11) DEFAULT NULL,
  `tipo_mischia_3` text,
  `note_mischia_3` text,
  `bm_mischia_3` int(11) DEFAULT NULL,
  `taglia_mischia_3` text,
  `attacco_distanza_1` text,
  `danni_distanza_1` int(11) DEFAULT NULL,
  `critico_distanza_1` int(11) DEFAULT NULL,
  `magico_distanza_1` int(11) DEFAULT NULL,
  `potente_distanza_1` int(11) DEFAULT NULL,
  `gittata_distanza_1` text,
  `malus_distanza_1` int(11) DEFAULT NULL,
  `perfetto_distanza_1` int(11) DEFAULT NULL,
  `tipo_distanza_1` text,
  `note_distanza_1` text,
  `bm_distanza_1` int(11) DEFAULT NULL,
  `taglia_distanza_1` text,
  `attacco_distanza_2` text,
  `danni_distanza_2` int(11) DEFAULT NULL,
  `critico_distanza_2` int(11) DEFAULT NULL,
  `magico_distanza_2` int(11) DEFAULT NULL,
  `potente_distanza_2` int(11) DEFAULT NULL,
  `gittata_distanza_2` text,
  `malus_distanza_2` int(11) DEFAULT NULL,
  `perfetto_distanza_2` int(11) DEFAULT NULL,
  `tipo_distanza_2` text,
  `note_distanza_2` text,
  `bm_distanza_2` int(11) DEFAULT NULL,
  `taglia_distanza_2` text,
  `acrobazia_check` varchar(7) DEFAULT NULL,
  `acrobazia_gradi` int(11) DEFAULT NULL,
  `acrobazia_vari` int(11) DEFAULT NULL,
  `add_animali_check` text,
  `add_animali_gradi` int(11) DEFAULT NULL,
  `add_animali_vari` int(11) DEFAULT NULL,
  `artigianato1_check` text,
  `artigianato1_name` text,
  `artigianato1_gradi` int(11) DEFAULT NULL,
  `artigianato1_vari` int(11) DEFAULT NULL,
  `artigianato2_check` text,
  `artigianato2_name` text,
  `artigianato2_gradi` int(11) DEFAULT NULL,
  `artigianato2_vari` int(11) DEFAULT NULL,
  `artigianato3_check` text,
  `artigianato3_name` text,
  `artigianato3_gradi` int(11) DEFAULT NULL,
  `artigianato3_vari` int(11) DEFAULT NULL,
  `art_fuga_check` text,
  `art_fuga_gradi` int(11) DEFAULT NULL,
  `art_fuga_vari` int(11) DEFAULT NULL,
  `ascoltare_check` text,
  `ascoltare_gradi` int(11) DEFAULT NULL,
  `ascoltare_vari` int(11) DEFAULT NULL,
  `camuffare_check` text,
  `camuffare_gradi` int(11) DEFAULT NULL,
  `camuffare_vari` int(11) DEFAULT NULL,
  `cavalcare_check` text,
  `cavalcare_gradi` int(11) DEFAULT NULL,
  `cavalcare_vari` int(11) DEFAULT NULL,
  `cercare_check` text,
  `cercare_gradi` int(11) DEFAULT NULL,
  `cercare_vari` int(11) DEFAULT NULL,
  `concentrazione_check` text,
  `concentrazione_gradi` int(11) DEFAULT NULL,
  `concentrazione_vari` int(11) DEFAULT NULL,
  `conoscenze1_check` text,
  `conoscenze1_name` text,
  `conoscenze1_gradi` int(11) DEFAULT NULL,
  `conoscenze1_vari` int(11) DEFAULT NULL,
  `conoscenze2_check` text,
  `conoscenze2_name` text,
  `conoscenze2_gradi` int(11) DEFAULT NULL,
  `conoscenze2_vari` int(11) DEFAULT NULL,
  `conoscenze3_check` text,
  `conoscenze3_name` text,
  `conoscenze3_gradi` int(11) DEFAULT NULL,
  `conoscenze3_vari` int(11) DEFAULT NULL,
  `conoscenze4_check` text,
  `conoscenze4_name` text,
  `conoscenze4_gradi` int(11) DEFAULT NULL,
  `conoscenze4_vari` int(11) DEFAULT NULL,
  `conoscenze5_check` text,
  `conoscenze5_name` text,
  `conoscenze5_gradi` int(11) DEFAULT NULL,
  `conoscenze5_vari` int(11) DEFAULT NULL,
  `decifrare_check` text,
  `decifrare_gradi` int(11) DEFAULT NULL,
  `decifrare_vari` int(11) DEFAULT NULL,
  `diplomazia_check` text,
  `diplomazia_gradi` int(11) DEFAULT NULL,
  `diplomazia_vari` int(11) DEFAULT NULL,
  `disattivare_check` text,
  `disattivare_gradi` int(11) DEFAULT NULL,
  `disattivare_vari` int(11) DEFAULT NULL,
  `equilibrio_check` text,
  `equilibrio_gradi` int(11) DEFAULT NULL,
  `equilibrio_vari` int(11) DEFAULT NULL,
  `falsificare_check` text,
  `falsificare_gradi` int(11) DEFAULT NULL,
  `falsificare_vari` int(11) DEFAULT NULL,
  `guarire_check` text,
  `guarire_gradi` int(11) DEFAULT NULL,
  `guarire_vari` int(11) DEFAULT NULL,
  `intimidre_check` text,
  `intimidre_gradi` int(11) DEFAULT NULL,
  `intimidre_vari` int(11) DEFAULT NULL,
  `intrattenere1_check` text,
  `intrattenere1_name` text,
  `intrattenere1_gradi` int(11) DEFAULT NULL,
  `intrattenere1_vari` int(11) DEFAULT NULL,
  `intrattenere2_check` text,
  `intrattenere2_name` text,
  `intrattenere2_gradi` int(11) DEFAULT NULL,
  `intrattenere2_vari` int(11) DEFAULT NULL,
  `intrattenere3_check` text,
  `intrattenere3_name` text,
  `intrattenere3_gradi` int(11) DEFAULT NULL,
  `intrattenere_vari` int(11) DEFAULT NULL,
  `muoversi_check` text,
  `muoversi_gradi` int(11) DEFAULT NULL,
  `muoversi_vari` int(11) DEFAULT NULL,
  `nascondersi_check` text,
  `nascondersi_gradi` int(11) DEFAULT NULL,
  `nascondersi_vari` int(11) DEFAULT NULL,
  `nuotare_check` text,
  `nuotare_gradi` int(11) DEFAULT NULL,
  `nuotare_vari` int(11) DEFAULT NULL,
  `osservare_check` text,
  `osservare_gradi` int(11) DEFAULT NULL,
  `osservare_vari` int(11) DEFAULT NULL,
  `percepiri_check` text,
  `percepiri_gradi` int(11) DEFAULT NULL,
  `percepiri_vari` int(11) DEFAULT NULL,
  `professione1_check` text,
  `professione1_name` text,
  `professione1_gradi` int(11) DEFAULT NULL,
  `professione1_vari` int(11) DEFAULT NULL,
  `professione2_check` text,
  `professione2_name` text,
  `professione2_gradi` int(11) DEFAULT NULL,
  `professione2_vari` int(11) DEFAULT NULL,
  `raccogliere_check` text,
  `raccogliere_gradi` int(11) DEFAULT NULL,
  `raccogliere_vari` int(11) DEFAULT NULL,
  `rapidita_check` text,
  `rapidita_gradi` int(11) DEFAULT NULL,
  `rapidita_vari` int(11) DEFAULT NULL,
  `saltare_check` text,
  `saltare_gradi` int(11) DEFAULT NULL,
  `saltare_vari` int(11) DEFAULT NULL,
  `sapienza_check` text,
  `sapienza_gradi` int(11) DEFAULT NULL,
  `sapienza_vari` int(11) DEFAULT NULL,
  `scalare_check` text,
  `scalare_gradi` int(11) DEFAULT NULL,
  `scalare_vari` int(11) DEFAULT NULL,
  `scassinare_check` text,
  `scassinare_gradi` int(11) DEFAULT NULL,
  `scassinare_vari` int(11) DEFAULT NULL,
  `sopravvivenza_check` text,
  `sopravvivenza_gradi` int(11) DEFAULT NULL,
  `sopravvivenza_vari` int(11) DEFAULT NULL,
  `corde_check` text,
  `corde_gradi` int(11) DEFAULT NULL,
  `corde_vari` int(11) DEFAULT NULL,
  `ogetti_check` text,
  `ogetti_gradi` int(11) DEFAULT NULL,
  `ogetti_vari` int(11) DEFAULT NULL,
  `valutare_check` text,
  `valutare_gradi` int(11) DEFAULT NULL,
  `valutare_vari` int(11) DEFAULT NULL,
  `unknown1_check` text,
  `unknown1_fname` text,
  `unknown1_name` text,
  `unknown1_gradi` int(11) DEFAULT NULL,
  `unknown1_vari` int(11) DEFAULT NULL,
  `unknown2_check` text,
  `unknown2_fname` text,
  `unknown2_name` text,
  `unknown2_gradi` int(11) DEFAULT NULL,
  `unknown2_vari` int(11) DEFAULT NULL,
  `unknown3_check` text,
  `unknown3_fname` text,
  `unknown3_name` text,
  `unknown3_gradi` int(11) DEFAULT NULL,
  `unknown3_vari` int(11) DEFAULT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`uid`, `status`, `type`, `user_id`, `monster_id`, `user_name`, `name`, `size`, `race`, `alignment`, `divinity`, `class`, `level`, `age`, `sex`, `height`, `weight`, `eyes_color`, `hair_color`, `skin_color`, `strength`, `dexterity`, `force`, `intelligence`, `wisdom`, `charism`, `resistance_at_damage`, `speed`, `var_initiative`, `natural_armor`, `deflection_armor`, `var_armor`, `max_hp`, `actual_hp`, `tempra_base`, `tempra_magia`, `tempra_vari`, `tempra_temp`, `riflessi_base`, `riflessi_magia`, `riflessi_vari`, `riflessi_temp`, `volonta_base`, `volonta_magia`, `volonta_vari`, `volonta_temp`, `attaco_base`, `res_inc`, `lotta_vari`, `attacco_mischia_1`, `danni_mischia_1`, `critico_mischia_1`, `magico_mischia_1`, `mani_mischia_1`, `gittata_mischia_1`, `malus_mischia_1`, `perfetto_mischia_1`, `tipo_mischia_1`, `note_mischia_1`, `bm_mischia_1`, `taglia_mischia_1`, `attacco_mischia_2`, `danni_mischia_2`, `critico_mischia_2`, `magico_mischia_2`, `mani_mischia_2`, `gittata_mischia_2`, `malus_mischia_2`, `perfetto_mischia_2`, `tipo_mischia_2`, `note_mischia_2`, `bm_mischia_2`, `taglia_mischia_2`, `attacco_mischia_3`, `danni_mischia_3`, `critico_mischia_3`, `magico_mischia_3`, `mani_mischia_3`, `gittata_mischia_3`, `malus_mischia_3`, `perfetto_mischia_3`, `tipo_mischia_3`, `note_mischia_3`, `bm_mischia_3`, `taglia_mischia_3`, `attacco_distanza_1`, `danni_distanza_1`, `critico_distanza_1`, `magico_distanza_1`, `potente_distanza_1`, `gittata_distanza_1`, `malus_distanza_1`, `perfetto_distanza_1`, `tipo_distanza_1`, `note_distanza_1`, `bm_distanza_1`, `taglia_distanza_1`, `attacco_distanza_2`, `danni_distanza_2`, `critico_distanza_2`, `magico_distanza_2`, `potente_distanza_2`, `gittata_distanza_2`, `malus_distanza_2`, `perfetto_distanza_2`, `tipo_distanza_2`, `note_distanza_2`, `bm_distanza_2`, `taglia_distanza_2`, `acrobazia_check`, `acrobazia_gradi`, `acrobazia_vari`, `add_animali_check`, `add_animali_gradi`, `add_animali_vari`, `artigianato1_check`, `artigianato1_name`, `artigianato1_gradi`, `artigianato1_vari`, `artigianato2_check`, `artigianato2_name`, `artigianato2_gradi`, `artigianato2_vari`, `artigianato3_check`, `artigianato3_name`, `artigianato3_gradi`, `artigianato3_vari`, `art_fuga_check`, `art_fuga_gradi`, `art_fuga_vari`, `ascoltare_check`, `ascoltare_gradi`, `ascoltare_vari`, `camuffare_check`, `camuffare_gradi`, `camuffare_vari`, `cavalcare_check`, `cavalcare_gradi`, `cavalcare_vari`, `cercare_check`, `cercare_gradi`, `cercare_vari`, `concentrazione_check`, `concentrazione_gradi`, `concentrazione_vari`, `conoscenze1_check`, `conoscenze1_name`, `conoscenze1_gradi`, `conoscenze1_vari`, `conoscenze2_check`, `conoscenze2_name`, `conoscenze2_gradi`, `conoscenze2_vari`, `conoscenze3_check`, `conoscenze3_name`, `conoscenze3_gradi`, `conoscenze3_vari`, `conoscenze4_check`, `conoscenze4_name`, `conoscenze4_gradi`, `conoscenze4_vari`, `conoscenze5_check`, `conoscenze5_name`, `conoscenze5_gradi`, `conoscenze5_vari`, `decifrare_check`, `decifrare_gradi`, `decifrare_vari`, `diplomazia_check`, `diplomazia_gradi`, `diplomazia_vari`, `disattivare_check`, `disattivare_gradi`, `disattivare_vari`, `equilibrio_check`, `equilibrio_gradi`, `equilibrio_vari`, `falsificare_check`, `falsificare_gradi`, `falsificare_vari`, `guarire_check`, `guarire_gradi`, `guarire_vari`, `intimidre_check`, `intimidre_gradi`, `intimidre_vari`, `intrattenere1_check`, `intrattenere1_name`, `intrattenere1_gradi`, `intrattenere1_vari`, `intrattenere2_check`, `intrattenere2_name`, `intrattenere2_gradi`, `intrattenere2_vari`, `intrattenere3_check`, `intrattenere3_name`, `intrattenere3_gradi`, `intrattenere_vari`, `muoversi_check`, `muoversi_gradi`, `muoversi_vari`, `nascondersi_check`, `nascondersi_gradi`, `nascondersi_vari`, `nuotare_check`, `nuotare_gradi`, `nuotare_vari`, `osservare_check`, `osservare_gradi`, `osservare_vari`, `percepiri_check`, `percepiri_gradi`, `percepiri_vari`, `professione1_check`, `professione1_name`, `professione1_gradi`, `professione1_vari`, `professione2_check`, `professione2_name`, `professione2_gradi`, `professione2_vari`, `raccogliere_check`, `raccogliere_gradi`, `raccogliere_vari`, `rapidita_check`, `rapidita_gradi`, `rapidita_vari`, `saltare_check`, `saltare_gradi`, `saltare_vari`, `sapienza_check`, `sapienza_gradi`, `sapienza_vari`, `scalare_check`, `scalare_gradi`, `scalare_vari`, `scassinare_check`, `scassinare_gradi`, `scassinare_vari`, `sopravvivenza_check`, `sopravvivenza_gradi`, `sopravvivenza_vari`, `corde_check`, `corde_gradi`, `corde_vari`, `ogetti_check`, `ogetti_gradi`, `ogetti_vari`, `valutare_check`, `valutare_gradi`, `valutare_vari`, `unknown1_check`, `unknown1_fname`, `unknown1_name`, `unknown1_gradi`, `unknown1_vari`, `unknown2_check`, `unknown2_fname`, `unknown2_name`, `unknown2_gradi`, `unknown2_vari`, `unknown3_check`, `unknown3_fname`, `unknown3_name`, `unknown3_gradi`, `unknown3_vari`) VALUES
('53b3501ecf5ce', '1', 'monster', '53b1fd5a3e6d2', NULL, 'olga', 'Orc', 'P', 'fds', 'lkj', 'jl', 'klj', '89', 'lkj', 'lkj', 'ljk', 'l;h', 'hklh', 'khl', 'khlkhklh', '18', '21', '23', '20', '33', '20', '8', '88', '6', '2', '3', '4', 555, 55, 3, 1, 2, 4, 1, 4, 6, 8, 2, 5, 7, 9, 2, 2, 1, 'fs', 4, 5, 3, 4, '5', 2, 3, '6', 'fgd', 4, 's', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'checked', 43, 6, 'checked', 1, 2, NULL, 'd1', 3, 4, 'checked', '2', 5, 6, 'checked', '3', 7, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('53b350543c212', '1', 'monster', '53b1fd5a3e6d2', '53b3501ecf5ce', 'olga', 'Orc', 'S', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 56, 565, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('53b35054dfcb1', '1', 'monster', '53b1fd5a3e6d2', '53b3501ecf5ce', 'olga', 'Orc', 'S', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 56, 565, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('53b35055243fe', '1', 'monster', '53b1fd5a3e6d2', '53b3501ecf5ce', 'olga', 'Orc', 'S', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 56, 565, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('53bc6f84566e0', '0', 'monster', '53b1fd5a3e6d2', NULL, 'olga', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `uid` varchar(13) NOT NULL DEFAULT '',
  `email` varchar(50) DEFAULT NULL,
  `pswd` varchar(32) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  `user_name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `email`, `pswd`, `type`, `user_name`) VALUES
('53b1fd5a3e6d2', 'vasilenin@mail.ru', 'b0baee9d279d34fa1dfd71aadb908c3f', 'dm', 'olga');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
