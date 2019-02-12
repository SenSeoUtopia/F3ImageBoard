-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 12, 2019 at 07:56 AM
-- Server version: 5.5.25
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `f3imageboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `bans`
--

CREATE TABLE `bans` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ip` varchar(255) NOT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `remove` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `boards`
--

CREATE TABLE `boards` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `show_contry_flag` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Japanese Culture', NULL, NULL),
(2, 'Video Games', NULL, NULL),
(3, 'Creative', NULL, NULL),
(4, 'Other', NULL, NULL),
(5, 'Misc.', NULL, NULL),
(6, 'Adult', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `emoji`
--

CREATE TABLE `emoji` (
  `id` int(11) NOT NULL,
  `value` tinytext NOT NULL,
  `code` tinytext NOT NULL,
  `text` tinytext NOT NULL,
  `emoji_type` varchar(40) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `emoji`
--

INSERT INTO `emoji` (`id`, `value`, `code`, `text`, `emoji_type`, `created_at`, `updated_at`) VALUES
(1, ':smile:', 'smile', 'Smile', 'normal', '2018-04-18 11:05:49', '2018-04-18 11:05:49'),
(2, ':laughing:', 'laughing', 'Laughing', 'normal', '2018-04-18 11:05:49', '2018-04-18 11:05:49'),
(3, ':blush:', 'blush', 'Blush', 'normal', '2018-04-18 11:05:49', '2018-04-18 11:05:49'),
(4, ':smiley:', 'smiley', 'Smiley', 'normal', '2018-04-18 11:05:49', '2018-04-18 11:05:49'),
(5, ':relaxed:', 'relaxed', 'Relaxed', 'normal', '2018-04-18 11:05:49', '2018-04-18 11:05:49'),
(6, ':smirk:', 'smirk', 'Smirk', 'normal', '2018-04-18 11:05:49', '2018-04-18 11:05:49'),
(7, ':heart_eyes:', 'heart_eyes', 'Heart Eyes', 'normal', '2018-04-18 11:05:49', '2018-04-18 11:05:49'),
(8, ':kissing_heart:', 'kissing_heart', 'Kissing Heart', 'normal', '2018-04-18 11:05:49', '2018-04-18 11:05:49'),
(9, ':kissing_closed_eyes:', 'kissing_closed_eyes', 'Kissing Closed Eyes', 'normal', '2018-04-18 11:05:49', '2018-04-18 11:05:49'),
(10, ':flushed:', 'flushed', 'Flushed', 'normal', '2018-04-18 11:05:49', '2018-04-18 11:05:49'),
(11, ':relieved:', 'relieved', 'Relieved', 'normal', '2018-04-18 11:05:49', '2018-04-18 11:05:49'),
(12, ':satisfied:', 'satisfied', 'Satisfied', 'normal', '2018-04-18 11:05:49', '2018-04-18 11:05:49'),
(13, ':grin:', 'grin', 'Grin', 'normal', '2018-04-18 11:05:49', '2018-04-18 11:05:49'),
(14, ':wink:', 'wink', 'Wink', 'normal', '2018-04-18 11:05:49', '2018-04-18 11:05:49'),
(15, ':stuck_out_tongue_winking_eye:', 'stuck_out_tongue_winking_eye', 'Stuck Out Tongue Winking Eye', 'normal', '2018-04-18 11:05:49', '2018-04-18 11:05:49'),
(16, ':stuck_out_tongue_closed_eyes:', 'stuck_out_tongue_closed_eyes', 'Stuck Out Tongue Closed Eyes', 'normal', '2018-04-18 11:05:49', '2018-04-18 11:05:49'),
(17, ':grinning:', 'grinning', 'Grinning', 'normal', '2018-04-18 11:05:49', '2018-04-18 11:05:49'),
(18, ':kissing:', 'kissing', 'Kissing', 'normal', '2018-04-18 11:05:49', '2018-04-18 11:05:49'),
(19, ':kissing_smiling_eyes:', 'kissing_smiling_eyes', 'Kissing Smiling Eyes', 'normal', '2018-04-18 11:05:49', '2018-04-18 11:05:49'),
(20, ':stuck_out_tongue:', 'stuck_out_tongue', 'Stuck Out Tongue', 'normal', '2018-04-18 11:05:49', '2018-04-18 11:05:49'),
(21, ':sleeping:', 'sleeping', 'Sleeping', 'normal', '2018-04-18 11:05:50', '2018-04-18 11:05:50'),
(22, ':worried:', 'worried', 'Worried', 'normal', '2018-04-18 11:05:50', '2018-04-18 11:05:50'),
(23, ':frowning:', 'frowning', 'Frowning', 'normal', '2018-04-18 11:05:50', '2018-04-18 11:05:50'),
(24, ':anguished:', 'anguished', 'Anguished', 'normal', '2018-04-18 11:05:50', '2018-04-18 11:05:50'),
(25, ':open_mouth:', 'open_mouth', 'Open Mouth', 'normal', '2018-04-18 11:05:50', '2018-04-18 11:05:50'),
(26, ':grimacing:', 'grimacing', 'Grimacing', 'normal', '2018-04-18 11:05:50', '2018-04-18 11:05:50'),
(27, ':confused:', 'confused', 'Confused', 'normal', '2018-04-18 11:05:50', '2018-04-18 11:05:50'),
(28, ':hushed:', 'hushed', 'Hushed', 'normal', '2018-04-18 11:05:50', '2018-04-18 11:05:50'),
(29, ':expressionless:', 'expressionless', 'Expressionless', 'normal', '2018-04-18 11:05:50', '2018-04-18 11:05:50'),
(30, ':unamused:', 'unamused', 'Unamused', 'normal', '2018-04-18 11:05:50', '2018-04-18 11:05:50'),
(31, ':sweat_smile:', 'sweat_smile', 'Sweat Smile', 'normal', '2018-04-18 11:05:50', '2018-04-18 11:05:50'),
(32, ':sweat:', 'sweat', 'Sweat', 'normal', '2018-04-18 11:05:50', '2018-04-18 11:05:50'),
(33, ':weary:', 'weary', 'Weary', 'normal', '2018-04-18 11:05:50', '2018-04-18 11:05:50'),
(34, ':pensive:', 'pensive', 'Pensive', 'normal', '2018-04-18 11:05:50', '2018-04-18 11:05:50'),
(35, ':disappointed:', 'disappointed', 'Disappointed', 'normal', '2018-04-18 11:05:50', '2018-04-18 11:05:50'),
(36, ':confounded:', 'confounded', 'Confounded', 'normal', '2018-04-18 11:05:50', '2018-04-18 11:05:50'),
(37, ':fearful:', 'fearful', 'Fearful', 'normal', '2018-04-18 11:05:50', '2018-04-18 11:05:50'),
(38, ':cold_sweat:', 'cold_sweat', 'Cold Sweat', 'normal', '2018-04-18 11:05:50', '2018-04-18 11:05:50'),
(39, ':persevere:', 'persevere', 'Persevere', 'normal', '2018-04-18 11:05:50', '2018-04-18 11:05:50'),
(40, ':cry:', 'cry', 'Cry', 'normal', '2018-04-18 11:05:50', '2018-04-18 11:05:50'),
(41, ':sob:', 'sob', 'Sob', 'normal', '2018-04-18 11:05:50', '2018-04-18 11:05:50'),
(42, ':joy:', 'joy', 'Joy', 'normal', '2018-04-18 11:05:50', '2018-04-18 11:05:50'),
(43, ':astonished:', 'astonished', 'Astonished', 'normal', '2018-04-18 11:05:50', '2018-04-18 11:05:50'),
(44, ':scream:', 'scream', 'Scream', 'normal', '2018-04-18 11:05:50', '2018-04-18 11:05:50'),
(45, ':tired_face:', 'tired_face', 'Tired Face', 'normal', '2018-04-18 11:05:50', '2018-04-18 11:05:50'),
(46, ':angry:', 'angry', 'Angry', 'normal', '2018-04-18 11:05:50', '2018-04-18 11:05:50'),
(47, ':rage:', 'rage', 'Rage', 'normal', '2018-04-18 11:05:50', '2018-04-18 11:05:50'),
(48, ':triumph:', 'triumph', 'Triumph', 'normal', '2018-04-18 11:05:50', '2018-04-18 11:05:50'),
(49, ':sleepy:', 'sleepy', 'Sleepy', 'normal', '2018-04-18 11:05:50', '2018-04-18 11:05:50'),
(50, ':yum:', 'yum', 'Yum', 'normal', '2018-04-18 11:05:50', '2018-04-18 11:05:50'),
(51, ':mask:', 'mask', 'Mask', 'normal', '2018-04-18 11:05:50', '2018-04-18 11:05:50'),
(52, ':sunglasses:', 'sunglasses', 'Sunglasses', 'normal', '2018-04-18 11:05:50', '2018-04-18 11:05:50'),
(53, ':dizzy_face:', 'dizzy_face', 'Dizzy Face', 'normal', '2018-04-18 11:05:50', '2018-04-18 11:05:50'),
(54, ':imp:', 'imp', 'Imp', 'normal', '2018-04-18 11:05:51', '2018-04-18 11:05:51'),
(55, ':smiling_imp:', 'smiling_imp', 'Smiling Imp', 'normal', '2018-04-18 11:05:51', '2018-04-18 11:05:51'),
(56, ':neutral_face:', 'neutral_face', 'Neutral Face', 'normal', '2018-04-18 11:05:51', '2018-04-18 11:05:51'),
(57, ':no_mouth:', 'no_mouth', 'No Mouth', 'normal', '2018-04-18 11:05:51', '2018-04-18 11:05:51'),
(58, ':innocent:', 'innocent', 'Innocent', 'normal', '2018-04-18 11:05:51', '2018-04-18 11:05:51'),
(59, ':alien:', 'alien', 'Alien', 'normal', '2018-04-18 11:05:51', '2018-04-18 11:05:51'),
(60, ':yellow_heart:', 'yellow_heart', 'Yellow Heart', 'normal', '2018-04-18 11:05:51', '2018-04-18 11:05:51'),
(61, ':blue_heart:', 'blue_heart', 'Blue Heart', 'normal', '2018-04-18 11:05:51', '2018-04-18 11:05:51'),
(62, ':purple_heart:', 'purple_heart', 'Purple Heart', 'normal', '2018-04-18 11:05:51', '2018-04-18 11:05:51'),
(63, ':heart:', 'heart', 'Heart', 'normal', '2018-04-18 11:05:51', '2018-04-18 11:05:51'),
(64, ':green_heart:', 'green_heart', 'Green Heart', 'normal', '2018-04-18 11:05:51', '2018-04-18 11:05:51'),
(65, ':broken_heart:', 'broken_heart', 'Broken Heart', 'normal', '2018-04-18 11:05:51', '2018-04-18 11:05:51'),
(66, ':heartbeat:', 'heartbeat', 'Heartbeat', 'normal', '2018-04-18 11:05:51', '2018-04-18 11:05:51'),
(67, ':heartpulse:', 'heartpulse', 'Heartpulse', 'normal', '2018-04-18 11:05:51', '2018-04-18 11:05:51'),
(68, ':two_hearts:', 'two_hearts', 'Two Hearts', 'normal', '2018-04-18 11:05:51', '2018-04-18 11:05:51'),
(69, ':revolving_hearts:', 'revolving_hearts', 'Revolving Hearts', 'normal', '2018-04-18 11:05:51', '2018-04-18 11:05:51'),
(70, ':cupid:', 'cupid', 'Cupid', 'normal', '2018-04-18 11:05:51', '2018-04-18 11:05:51'),
(71, ':sparkling_heart:', 'sparkling_heart', 'Sparkling Heart', 'normal', '2018-04-18 11:05:51', '2018-04-18 11:05:51'),
(72, ':sparkles:', 'sparkles', 'Sparkles', 'normal', '2018-04-18 11:05:51', '2018-04-18 11:05:51'),
(73, ':star:', 'star', 'Star', 'normal', '2018-04-18 11:05:51', '2018-04-18 11:05:51'),
(74, ':star2:', 'star2', 'Star2', 'normal', '2018-04-18 11:05:51', '2018-04-18 11:05:51'),
(75, ':dizzy:', 'dizzy', 'Dizzy', 'normal', '2018-04-18 11:05:51', '2018-04-18 11:05:51'),
(76, ':boom:', 'boom', 'Boom', 'normal', '2018-04-18 11:05:51', '2018-04-18 11:05:51'),
(77, ':anger:', 'anger', 'Anger', 'normal', '2018-04-18 11:05:51', '2018-04-18 11:05:51'),
(78, ':exclamation:', 'exclamation', 'Exclamation', 'normal', '2018-04-18 11:05:51', '2018-04-18 11:05:51'),
(79, ':question:', 'question', 'Question', 'normal', '2018-04-18 11:05:51', '2018-04-18 11:05:51'),
(80, ':grey_exclamation:', 'grey_exclamation', 'Grey Exclamation', 'normal', '2018-04-18 11:05:51', '2018-04-18 11:05:51'),
(81, ':grey_question:', 'grey_question', 'Grey Question', 'normal', '2018-04-18 11:05:51', '2018-04-18 11:05:51'),
(82, ':zzz:', 'zzz', 'Zzz', 'normal', '2018-04-18 11:05:51', '2018-04-18 11:05:51'),
(83, ':dash:', 'dash', 'Dash', 'normal', '2018-04-18 11:05:51', '2018-04-18 11:05:51'),
(84, ':sweat_drops:', 'sweat_drops', 'Sweat Drops', 'normal', '2018-04-18 11:05:51', '2018-04-18 11:05:51'),
(85, ':notes:', 'notes', 'Notes', 'normal', '2018-04-18 11:05:51', '2018-04-18 11:05:51'),
(86, ':musical_note:', 'musical_note', 'Musical Note', 'normal', '2018-04-18 11:05:52', '2018-04-18 11:05:52'),
(87, ':fire:', 'fire', 'Fire', 'normal', '2018-04-18 11:05:52', '2018-04-18 11:05:52'),
(88, ':poop:', 'poop', 'Poop', 'normal', '2018-04-18 11:05:52', '2018-04-18 11:05:52'),
(89, ':thumbsup:', 'thumbsup', 'Thumbsup', 'normal', '2018-04-18 11:05:52', '2018-04-18 11:05:52'),
(90, ':thumbsdown:', 'thumbsdown', 'Thumbsdown', 'normal', '2018-04-18 11:05:52', '2018-04-18 11:05:52'),
(91, ':ok_hand:', 'ok_hand', 'Ok Hand', 'normal', '2018-04-18 11:05:52', '2018-04-18 11:05:52'),
(92, ':punch:', 'punch', 'Punch', 'normal', '2018-04-18 11:05:52', '2018-04-18 11:05:52'),
(93, ':fist:', 'fist', 'Fist', 'normal', '2018-04-18 11:05:52', '2018-04-18 11:05:52'),
(94, ':v:', 'v', 'V', 'normal', '2018-04-18 11:05:52', '2018-04-18 11:05:52'),
(95, ':wave:', 'wave', 'Wave', 'normal', '2018-04-18 11:05:52', '2018-04-18 11:05:52'),
(96, ':hand:', 'hand', 'Hand', 'normal', '2018-04-18 11:05:52', '2018-04-18 11:05:52'),
(97, ':open_hands:', 'open_hands', 'Open Hands', 'normal', '2018-04-18 11:05:52', '2018-04-18 11:05:52'),
(98, ':point_up:', 'point_up', 'Point Up', 'normal', '2018-04-18 11:05:52', '2018-04-18 11:05:52'),
(99, ':point_down:', 'point_down', 'Point Down', 'normal', '2018-04-18 11:05:52', '2018-04-18 11:05:52'),
(100, ':point_left:', 'point_left', 'Point Left', 'normal', '2018-04-18 11:05:52', '2018-04-18 11:05:52'),
(101, ':point_right:', 'point_right', 'Point Right', 'normal', '2018-04-18 11:05:52', '2018-04-18 11:05:52'),
(102, ':raised_hands:', 'raised_hands', 'Raised Hands', 'normal', '2018-04-18 11:05:52', '2018-04-18 11:05:52'),
(103, ':pray:', 'pray', 'Pray', 'normal', '2018-04-18 11:05:52', '2018-04-18 11:05:52'),
(104, ':point_up_2:', 'point_up_2', 'Point Up 2', 'normal', '2018-04-18 11:05:52', '2018-04-18 11:05:52'),
(105, ':clap:', 'clap', 'Clap', 'normal', '2018-04-18 11:05:52', '2018-04-18 11:05:52'),
(106, ':muscle:', 'muscle', 'Muscle', 'normal', '2018-04-18 11:05:52', '2018-04-18 11:05:52'),
(107, ':walking:', 'walking', 'Walking', 'normal', '2018-04-18 11:05:52', '2018-04-18 11:05:52'),
(108, ':runner:', 'runner', 'Runner', 'normal', '2018-04-18 11:05:52', '2018-04-18 11:05:52'),
(109, ':couple:', 'couple', 'Couple', 'normal', '2018-04-18 11:05:52', '2018-04-18 11:05:52'),
(110, ':family:', 'family', 'Family', 'normal', '2018-04-18 11:05:52', '2018-04-18 11:05:52'),
(111, ':two_men_holding_hands:', 'two_men_holding_hands', 'Two Men Holding Hands', 'normal', '2018-04-18 11:05:52', '2018-04-18 11:05:52'),
(112, ':two_women_holding_hands:', 'two_women_holding_hands', 'Two Women Holding Hands', 'normal', '2018-04-18 11:05:52', '2018-04-18 11:05:52'),
(113, ':dancer:', 'dancer', 'Dancer', 'normal', '2018-04-18 11:05:52', '2018-04-18 11:05:52'),
(114, ':dancers:', 'dancers', 'Dancers', 'normal', '2018-04-18 11:05:52', '2018-04-18 11:05:52'),
(115, ':ok_woman:', 'ok_woman', 'Ok Woman', 'normal', '2018-04-18 11:05:53', '2018-04-18 11:05:53'),
(116, ':no_good:', 'no_good', 'No Good', 'normal', '2018-04-18 11:05:53', '2018-04-18 11:05:53'),
(117, ':information_desk_person:', 'information_desk_person', 'Information Desk Person', 'normal', '2018-04-18 11:05:53', '2018-04-18 11:05:53'),
(118, ':raised_hand:', 'raised_hand', 'Raised Hand', 'normal', '2018-04-18 11:05:53', '2018-04-18 11:05:53'),
(119, ':bride_with_veil:', 'bride_with_veil', 'Bride With Veil', 'normal', '2018-04-18 11:05:53', '2018-04-18 11:05:53'),
(120, ':person_with_pouting_face:', 'person_with_pouting_face', 'Person With Pouting Face', 'normal', '2018-04-18 11:05:53', '2018-04-18 11:05:53'),
(121, ':person_frowning:', 'person_frowning', 'Person Frowning', 'normal', '2018-04-18 11:05:53', '2018-04-18 11:05:53'),
(122, ':bow:', 'bow', 'Bow', 'normal', '2018-04-18 11:05:53', '2018-04-18 11:05:53'),
(123, ':couplekiss:', 'couplekiss', 'Couplekiss', 'normal', '2018-04-18 11:05:53', '2018-04-18 11:05:53'),
(124, ':couple_with_heart:', 'couple_with_heart', 'Couple With Heart', 'normal', '2018-04-18 11:05:53', '2018-04-18 11:05:53'),
(125, ':massage:', 'massage', 'Massage', 'normal', '2018-04-18 11:05:53', '2018-04-18 11:05:53'),
(126, ':haircut:', 'haircut', 'Haircut', 'normal', '2018-04-18 11:05:53', '2018-04-18 11:05:53'),
(127, ':nail_care:', 'nail_care', 'Nail Care', 'normal', '2018-04-18 11:05:53', '2018-04-18 11:05:53'),
(128, ':boy:', 'boy', 'Boy', 'normal', '2018-04-18 11:05:53', '2018-04-18 11:05:53'),
(129, ':girl:', 'girl', 'Girl', 'normal', '2018-04-18 11:05:53', '2018-04-18 11:05:53'),
(130, ':woman:', 'woman', 'Woman', 'normal', '2018-04-18 11:05:53', '2018-04-18 11:05:53'),
(131, ':man:', 'man', 'Man', 'normal', '2018-04-18 11:05:53', '2018-04-18 11:05:53'),
(132, ':baby:', 'baby', 'Baby', 'normal', '2018-04-18 11:05:53', '2018-04-18 11:05:53'),
(133, ':older_woman:', 'older_woman', 'Older Woman', 'normal', '2018-04-18 11:05:53', '2018-04-18 11:05:53'),
(134, ':older_man:', 'older_man', 'Older Man', 'normal', '2018-04-18 11:05:53', '2018-04-18 11:05:53'),
(135, ':person_with_blond_hair:', 'person_with_blond_hair', 'Person With Blond Hair', 'normal', '2018-04-18 11:05:53', '2018-04-18 11:05:53'),
(136, ':man_with_gua_pi_mao:', 'man_with_gua_pi_mao', 'Man With Gua Pi Mao', 'normal', '2018-04-18 11:05:53', '2018-04-18 11:05:53'),
(137, ':man_with_turban:', 'man_with_turban', 'Man With Turban', 'normal', '2018-04-18 11:05:53', '2018-04-18 11:05:53'),
(138, ':construction_worker:', 'construction_worker', 'Construction Worker', 'normal', '2018-04-18 11:05:53', '2018-04-18 11:05:53'),
(139, ':cop:', 'cop', 'Cop', 'normal', '2018-04-18 11:05:53', '2018-04-18 11:05:53'),
(140, ':angel:', 'angel', 'Angel', 'normal', '2018-04-18 11:05:53', '2018-04-18 11:05:53'),
(141, ':princess:', 'princess', 'Princess', 'normal', '2018-04-18 11:05:53', '2018-04-18 11:05:53'),
(142, ':smiley_cat:', 'smiley_cat', 'Smiley Cat', 'normal', '2018-04-18 11:05:53', '2018-04-18 11:05:53'),
(143, ':smile_cat:', 'smile_cat', 'Smile Cat', 'normal', '2018-04-18 11:05:53', '2018-04-18 11:05:53'),
(144, ':heart_eyes_cat:', 'heart_eyes_cat', 'Heart Eyes Cat', 'normal', '2018-04-18 11:05:53', '2018-04-18 11:05:53'),
(145, ':kissing_cat:', 'kissing_cat', 'Kissing Cat', 'normal', '2018-04-18 11:05:53', '2018-04-18 11:05:53'),
(146, ':smirk_cat:', 'smirk_cat', 'Smirk Cat', 'normal', '2018-04-18 11:05:53', '2018-04-18 11:05:53'),
(147, ':scream_cat:', 'scream_cat', 'Scream Cat', 'normal', '2018-04-18 11:05:54', '2018-04-18 11:05:54'),
(148, ':crying_cat_face:', 'crying_cat_face', 'Crying Cat Face', 'normal', '2018-04-18 11:05:54', '2018-04-18 11:05:54'),
(149, ':joy_cat:', 'joy_cat', 'Joy Cat', 'normal', '2018-04-18 11:05:54', '2018-04-18 11:05:54'),
(150, ':pouting_cat:', 'pouting_cat', 'Pouting Cat', 'normal', '2018-04-18 11:05:54', '2018-04-18 11:05:54'),
(151, ':japanese_ogre:', 'japanese_ogre', 'Japanese Ogre', 'normal', '2018-04-18 11:05:54', '2018-04-18 11:05:54'),
(152, ':japanese_goblin:', 'japanese_goblin', 'Japanese Goblin', 'normal', '2018-04-18 11:05:54', '2018-04-18 11:05:54'),
(153, ':see_no_evil:', 'see_no_evil', 'See No Evil', 'normal', '2018-04-18 11:05:54', '2018-04-18 11:05:54'),
(154, ':hear_no_evil:', 'hear_no_evil', 'Hear No Evil', 'normal', '2018-04-18 11:05:54', '2018-04-18 11:05:54'),
(155, ':speak_no_evil:', 'speak_no_evil', 'Speak No Evil', 'normal', '2018-04-18 11:05:54', '2018-04-18 11:05:54'),
(156, ':guardsman:', 'guardsman', 'Guardsman', 'normal', '2018-04-18 11:05:54', '2018-04-18 11:05:54'),
(157, ':skull:', 'skull', 'Skull', 'normal', '2018-04-18 11:05:54', '2018-04-18 11:05:54'),
(158, ':feet:', 'feet', 'Feet', 'normal', '2018-04-18 11:05:54', '2018-04-18 11:05:54'),
(159, ':lips:', 'lips', 'Lips', 'normal', '2018-04-18 11:05:54', '2018-04-18 11:05:54'),
(160, ':kiss:', 'kiss', 'Kiss', 'normal', '2018-04-18 11:05:54', '2018-04-18 11:05:54'),
(161, ':droplet:', 'droplet', 'Droplet', 'normal', '2018-04-18 11:05:54', '2018-04-18 11:05:54'),
(162, ':ear:', 'ear', 'Ear', 'normal', '2018-04-18 11:05:54', '2018-04-18 11:05:54'),
(163, ':eyes:', 'eyes', 'Eyes', 'normal', '2018-04-18 11:05:54', '2018-04-18 11:05:54'),
(164, ':nose:', 'nose', 'Nose', 'normal', '2018-04-18 11:05:54', '2018-04-18 11:05:54'),
(165, ':tongue:', 'tongue', 'Tongue', 'normal', '2018-04-18 11:05:54', '2018-04-18 11:05:54'),
(166, ':love_letter:', 'love_letter', 'Love Letter', 'normal', '2018-04-18 11:05:54', '2018-04-18 11:05:54'),
(167, ':bust_in_silhouette:', 'bust_in_silhouette', 'Bust In Silhouette', 'normal', '2018-04-18 11:05:54', '2018-04-18 11:05:54'),
(168, ':busts_in_silhouette:', 'busts_in_silhouette', 'Busts In Silhouette', 'normal', '2018-04-18 11:05:54', '2018-04-18 11:05:54'),
(169, ':speech_balloon:', 'speech_balloon', 'Speech Balloon', 'normal', '2018-04-18 11:05:54', '2018-04-18 11:05:54'),
(170, ':thought_balloon:', 'thought_balloon', 'Thought Balloon', 'normal', '2018-04-18 11:05:54', '2018-04-18 11:05:54'),
(171, ':sunny:', 'sunny', 'Sunny', 'normal', '2018-04-18 11:05:54', '2018-04-18 11:05:54'),
(172, ':umbrella:', 'umbrella', 'Umbrella', 'normal', '2018-04-18 11:05:54', '2018-04-18 11:05:54'),
(173, ':cloud:', 'cloud', 'Cloud', 'normal', '2018-04-18 11:05:54', '2018-04-18 11:05:54'),
(174, ':snowflake:', 'snowflake', 'Snowflake', 'normal', '2018-04-18 11:05:54', '2018-04-18 11:05:54'),
(175, ':snowman:', 'snowman', 'Snowman', 'normal', '2018-04-18 11:05:54', '2018-04-18 11:05:54'),
(176, ':zap:', 'zap', 'Zap', 'normal', '2018-04-18 11:05:54', '2018-04-18 11:05:54'),
(177, ':cyclone:', 'cyclone', 'Cyclone', 'normal', '2018-04-18 11:05:54', '2018-04-18 11:05:54'),
(178, ':foggy:', 'foggy', 'Foggy', 'normal', '2018-04-18 11:05:54', '2018-04-18 11:05:54'),
(179, ':ocean:', 'ocean', 'Ocean', 'normal', '2018-04-18 11:05:54', '2018-04-18 11:05:54'),
(180, ':cat:', 'cat', 'Cat', 'normal', '2018-04-18 11:05:54', '2018-04-18 11:05:54'),
(181, ':dog:', 'dog', 'Dog', 'normal', '2018-04-18 11:05:55', '2018-04-18 11:05:55'),
(182, ':mouse:', 'mouse', 'Mouse', 'normal', '2018-04-18 11:05:55', '2018-04-18 11:05:55'),
(183, ':hamster:', 'hamster', 'Hamster', 'normal', '2018-04-18 11:05:55', '2018-04-18 11:05:55'),
(184, ':rabbit:', 'rabbit', 'Rabbit', 'normal', '2018-04-18 11:05:55', '2018-04-18 11:05:55'),
(185, ':wolf:', 'wolf', 'Wolf', 'normal', '2018-04-18 11:05:55', '2018-04-18 11:05:55'),
(186, ':frog:', 'frog', 'Frog', 'normal', '2018-04-18 11:05:55', '2018-04-18 11:05:55'),
(187, ':tiger:', 'tiger', 'Tiger', 'normal', '2018-04-18 11:05:55', '2018-04-18 11:05:55'),
(188, ':koala:', 'koala', 'Koala', 'normal', '2018-04-18 11:05:55', '2018-04-18 11:05:55'),
(189, ':bear:', 'bear', 'Bear', 'normal', '2018-04-18 11:05:55', '2018-04-18 11:05:55'),
(190, ':pig:', 'pig', 'Pig', 'normal', '2018-04-18 11:05:55', '2018-04-18 11:05:55'),
(191, ':pig_nose:', 'pig_nose', 'Pig Nose', 'normal', '2018-04-18 11:05:55', '2018-04-18 11:05:55'),
(192, ':cow:', 'cow', 'Cow', 'normal', '2018-04-18 11:05:55', '2018-04-18 11:05:55'),
(193, ':boar:', 'boar', 'Boar', 'normal', '2018-04-18 11:05:55', '2018-04-18 11:05:55'),
(194, ':monkey_face:', 'monkey_face', 'Monkey Face', 'normal', '2018-04-18 11:05:55', '2018-04-18 11:05:55'),
(195, ':monkey:', 'monkey', 'Monkey', 'normal', '2018-04-18 11:05:55', '2018-04-18 11:05:55'),
(196, ':horse:', 'horse', 'Horse', 'normal', '2018-04-18 11:05:55', '2018-04-18 11:05:55'),
(197, ':racehorse:', 'racehorse', 'Racehorse', 'normal', '2018-04-18 11:05:55', '2018-04-18 11:05:55'),
(198, ':camel:', 'camel', 'Camel', 'normal', '2018-04-18 11:05:55', '2018-04-18 11:05:55'),
(199, ':sheep:', 'sheep', 'Sheep', 'normal', '2018-04-18 11:05:55', '2018-04-18 11:05:55'),
(200, ':elephant:', 'elephant', 'Elephant', 'normal', '2018-04-18 11:05:55', '2018-04-18 11:05:55'),
(201, ':panda_face:', 'panda_face', 'Panda Face', 'normal', '2018-04-18 11:05:55', '2018-04-18 11:05:55'),
(202, ':snake:', 'snake', 'Snake', 'normal', '2018-04-18 11:05:55', '2018-04-18 11:05:55'),
(203, ':bird:', 'bird', 'Bird', 'normal', '2018-04-18 11:05:55', '2018-04-18 11:05:55'),
(204, ':baby_chick:', 'baby_chick', 'Baby Chick', 'normal', '2018-04-18 11:05:55', '2018-04-18 11:05:55'),
(205, ':hatched_chick:', 'hatched_chick', 'Hatched Chick', 'normal', '2018-04-18 11:05:55', '2018-04-18 11:05:55'),
(206, ':hatching_chick:', 'hatching_chick', 'Hatching Chick', 'normal', '2018-04-18 11:05:55', '2018-04-18 11:05:55'),
(207, ':chicken:', 'chicken', 'Chicken', 'normal', '2018-04-18 11:05:55', '2018-04-18 11:05:55'),
(208, ':penguin:', 'penguin', 'Penguin', 'normal', '2018-04-18 11:05:55', '2018-04-18 11:05:55'),
(209, ':turtle:', 'turtle', 'Turtle', 'normal', '2018-04-18 11:05:55', '2018-04-18 11:05:55'),
(210, ':bug:', 'bug', 'Bug', 'normal', '2018-04-18 11:05:55', '2018-04-18 11:05:55'),
(211, ':honeybee:', 'honeybee', 'Honeybee', 'normal', '2018-04-18 11:05:55', '2018-04-18 11:05:55'),
(212, ':ant:', 'ant', 'Ant', 'normal', '2018-04-18 11:05:55', '2018-04-18 11:05:55'),
(213, ':beetle:', 'beetle', 'Beetle', 'normal', '2018-04-18 11:05:55', '2018-04-18 11:05:55'),
(214, ':snail:', 'snail', 'Snail', 'normal', '2018-04-18 11:05:56', '2018-04-18 11:05:56'),
(215, ':octopus:', 'octopus', 'Octopus', 'normal', '2018-04-18 11:05:56', '2018-04-18 11:05:56'),
(216, ':tropical_fish:', 'tropical_fish', 'Tropical Fish', 'normal', '2018-04-18 11:05:56', '2018-04-18 11:05:56'),
(217, ':fish:', 'fish', 'Fish', 'normal', '2018-04-18 11:05:56', '2018-04-18 11:05:56'),
(218, ':whale:', 'whale', 'Whale', 'normal', '2018-04-18 11:05:56', '2018-04-18 11:05:56'),
(219, ':whale2:', 'whale2', 'Whale2', 'normal', '2018-04-18 11:05:56', '2018-04-18 11:05:56'),
(220, ':dolphin:', 'dolphin', 'Dolphin', 'normal', '2018-04-18 11:05:56', '2018-04-18 11:05:56'),
(221, ':cow2:', 'cow2', 'Cow2', 'normal', '2018-04-18 11:05:56', '2018-04-18 11:05:56'),
(222, ':ram:', 'ram', 'Ram', 'normal', '2018-04-18 11:05:56', '2018-04-18 11:05:56'),
(223, ':rat:', 'rat', 'Rat', 'normal', '2018-04-18 11:05:56', '2018-04-18 11:05:56'),
(224, ':water_buffalo:', 'water_buffalo', 'Water Buffalo', 'normal', '2018-04-18 11:05:56', '2018-04-18 11:05:56'),
(225, ':tiger2:', 'tiger2', 'Tiger2', 'normal', '2018-04-18 11:05:56', '2018-04-18 11:05:56'),
(226, ':rabbit2:', 'rabbit2', 'Rabbit2', 'normal', '2018-04-18 11:05:56', '2018-04-18 11:05:56'),
(227, ':dragon:', 'dragon', 'Dragon', 'normal', '2018-04-18 11:05:56', '2018-04-18 11:05:56'),
(228, ':goat:', 'goat', 'Goat', 'normal', '2018-04-18 11:05:56', '2018-04-18 11:05:56'),
(229, ':rooster:', 'rooster', 'Rooster', 'normal', '2018-04-18 11:05:56', '2018-04-18 11:05:56'),
(230, ':dog2:', 'dog2', 'Dog2', 'normal', '2018-04-18 11:05:56', '2018-04-18 11:05:56'),
(231, ':pig2:', 'pig2', 'Pig2', 'normal', '2018-04-18 11:05:56', '2018-04-18 11:05:56'),
(232, ':mouse2:', 'mouse2', 'Mouse2', 'normal', '2018-04-18 11:05:56', '2018-04-18 11:05:56'),
(233, ':ox:', 'ox', 'Ox', 'normal', '2018-04-18 11:05:56', '2018-04-18 11:05:56'),
(234, ':dragon_face:', 'dragon_face', 'Dragon Face', 'normal', '2018-04-18 11:05:56', '2018-04-18 11:05:56'),
(235, ':blowfish:', 'blowfish', 'Blowfish', 'normal', '2018-04-18 11:05:56', '2018-04-18 11:05:56'),
(236, ':crocodile:', 'crocodile', 'Crocodile', 'normal', '2018-04-18 11:05:56', '2018-04-18 11:05:56'),
(237, ':dromedary_camel:', 'dromedary_camel', 'Dromedary Camel', 'normal', '2018-04-18 11:05:56', '2018-04-18 11:05:56'),
(238, ':leopard:', 'leopard', 'Leopard', 'normal', '2018-04-18 11:05:56', '2018-04-18 11:05:56'),
(239, ':cat2:', 'cat2', 'Cat2', 'normal', '2018-04-18 11:05:56', '2018-04-18 11:05:56'),
(240, ':poodle:', 'poodle', 'Poodle', 'normal', '2018-04-18 11:05:56', '2018-04-18 11:05:56'),
(241, ':paw_prints:', 'paw_prints', 'Paw Prints', 'normal', '2018-04-18 11:05:56', '2018-04-18 11:05:56'),
(242, ':bouquet:', 'bouquet', 'Bouquet', 'normal', '2018-04-18 11:05:56', '2018-04-18 11:05:56'),
(243, ':cherry_blossom:', 'cherry_blossom', 'Cherry Blossom', 'normal', '2018-04-18 11:05:56', '2018-04-18 11:05:56'),
(244, ':tulip:', 'tulip', 'Tulip', 'normal', '2018-04-18 11:05:56', '2018-04-18 11:05:56'),
(245, ':four_leaf_clover:', 'four_leaf_clover', 'Four Leaf Clover', 'normal', '2018-04-18 11:05:56', '2018-04-18 11:05:56'),
(246, ':rose:', 'rose', 'Rose', 'normal', '2018-04-18 11:05:56', '2018-04-18 11:05:56'),
(247, ':sunflower:', 'sunflower', 'Sunflower', 'normal', '2018-04-18 11:05:56', '2018-04-18 11:05:56'),
(248, ':hibiscus:', 'hibiscus', 'Hibiscus', 'normal', '2018-04-18 11:05:57', '2018-04-18 11:05:57'),
(249, ':maple_leaf:', 'maple_leaf', 'Maple Leaf', 'normal', '2018-04-18 11:05:57', '2018-04-18 11:05:57'),
(250, ':leaves:', 'leaves', 'Leaves', 'normal', '2018-04-18 11:05:57', '2018-04-18 11:05:57'),
(251, ':fallen_leaf:', 'fallen_leaf', 'Fallen Leaf', 'normal', '2018-04-18 11:05:57', '2018-04-18 11:05:57'),
(252, ':herb:', 'herb', 'Herb', 'normal', '2018-04-18 11:05:57', '2018-04-18 11:05:57'),
(253, ':mushroom:', 'mushroom', 'Mushroom', 'normal', '2018-04-18 11:05:57', '2018-04-18 11:05:57'),
(254, ':cactus:', 'cactus', 'Cactus', 'normal', '2018-04-18 11:05:57', '2018-04-18 11:05:57'),
(255, ':palm_tree:', 'palm_tree', 'Palm Tree', 'normal', '2018-04-18 11:05:57', '2018-04-18 11:05:57'),
(256, ':evergreen_tree:', 'evergreen_tree', 'Evergreen Tree', 'normal', '2018-04-18 11:05:57', '2018-04-18 11:05:57'),
(257, ':deciduous_tree:', 'deciduous_tree', 'Deciduous Tree', 'normal', '2018-04-18 11:05:57', '2018-04-18 11:05:57'),
(258, ':chestnut:', 'chestnut', 'Chestnut', 'normal', '2018-04-18 11:05:57', '2018-04-18 11:05:57'),
(259, ':seedling:', 'seedling', 'Seedling', 'normal', '2018-04-18 11:05:57', '2018-04-18 11:05:57'),
(260, ':blossom:', 'blossom', 'Blossom', 'normal', '2018-04-18 11:05:57', '2018-04-18 11:05:57'),
(261, ':ear_of_rice:', 'ear_of_rice', 'Ear Of Rice', 'normal', '2018-04-18 11:05:57', '2018-04-18 11:05:57'),
(262, ':shell:', 'shell', 'Shell', 'normal', '2018-04-18 11:05:57', '2018-04-18 11:05:57'),
(263, ':globe_with_meridians:', 'globe_with_meridians', 'Globe With Meridians', 'normal', '2018-04-18 11:05:57', '2018-04-18 11:05:57'),
(264, ':sun_with_face:', 'sun_with_face', 'Sun With Face', 'normal', '2018-04-18 11:05:57', '2018-04-18 11:05:57'),
(265, ':full_moon_with_face:', 'full_moon_with_face', 'Full Moon With Face', 'normal', '2018-04-18 11:05:57', '2018-04-18 11:05:57'),
(266, ':new_moon_with_face:', 'new_moon_with_face', 'New Moon With Face', 'normal', '2018-04-18 11:05:57', '2018-04-18 11:05:57'),
(267, ':new_moon:', 'new_moon', 'New Moon', 'normal', '2018-04-18 11:05:57', '2018-04-18 11:05:57'),
(268, ':waxing_crescent_moon:', 'waxing_crescent_moon', 'Waxing Crescent Moon', 'normal', '2018-04-18 11:05:57', '2018-04-18 11:05:57'),
(269, ':first_quarter_moon:', 'first_quarter_moon', 'First Quarter Moon', 'normal', '2018-04-18 11:05:57', '2018-04-18 11:05:57'),
(270, ':waxing_gibbous_moon:', 'waxing_gibbous_moon', 'Waxing Gibbous Moon', 'normal', '2018-04-18 11:05:57', '2018-04-18 11:05:57'),
(271, ':full_moon:', 'full_moon', 'Full Moon', 'normal', '2018-04-18 11:05:57', '2018-04-18 11:05:57'),
(272, ':waning_gibbous_moon:', 'waning_gibbous_moon', 'Waning Gibbous Moon', 'normal', '2018-04-18 11:05:57', '2018-04-18 11:05:57'),
(273, ':last_quarter_moon:', 'last_quarter_moon', 'Last Quarter Moon', 'normal', '2018-04-18 11:05:57', '2018-04-18 11:05:57'),
(274, ':waning_crescent_moon:', 'waning_crescent_moon', 'Waning Crescent Moon', 'normal', '2018-04-18 11:05:57', '2018-04-18 11:05:57'),
(275, ':last_quarter_moon_with_face:', 'last_quarter_moon_with_face', 'Last Quarter Moon With Face', 'normal', '2018-04-18 11:05:57', '2018-04-18 11:05:57'),
(276, ':first_quarter_moon_with_face:', 'first_quarter_moon_with_face', 'First Quarter Moon With Face', 'normal', '2018-04-18 11:05:58', '2018-04-18 11:05:58'),
(277, ':moon:', 'moon', 'Moon', 'normal', '2018-04-18 11:05:58', '2018-04-18 11:05:58'),
(278, ':earth_africa:', 'earth_africa', 'Earth Africa', 'normal', '2018-04-18 11:05:58', '2018-04-18 11:05:58'),
(279, ':earth_americas:', 'earth_americas', 'Earth Americas', 'normal', '2018-04-18 11:05:58', '2018-04-18 11:05:58'),
(280, ':earth_asia:', 'earth_asia', 'Earth Asia', 'normal', '2018-04-18 11:05:58', '2018-04-18 11:05:58'),
(281, ':volcano:', 'volcano', 'Volcano', 'normal', '2018-04-18 11:05:58', '2018-04-18 11:05:58'),
(282, ':milky_way:', 'milky_way', 'Milky Way', 'normal', '2018-04-18 11:05:58', '2018-04-18 11:05:58'),
(283, ':partly_sunny:', 'partly_sunny', 'Partly Sunny', 'normal', '2018-04-18 11:05:58', '2018-04-18 11:05:58'),
(284, ':bamboo:', 'bamboo', 'Bamboo', 'normal', '2018-04-18 11:05:58', '2018-04-18 11:05:58'),
(285, ':gift_heart:', 'gift_heart', 'Gift Heart', 'normal', '2018-04-18 11:05:58', '2018-04-18 11:05:58'),
(286, ':dolls:', 'dolls', 'Dolls', 'normal', '2018-04-18 11:05:58', '2018-04-18 11:05:58'),
(287, ':school_satchel:', 'school_satchel', 'School Satchel', 'normal', '2018-04-18 11:05:58', '2018-04-18 11:05:58'),
(288, ':mortar_board:', 'mortar_board', 'Mortar Board', 'normal', '2018-04-18 11:05:58', '2018-04-18 11:05:58'),
(289, ':flags:', 'flags', 'Flags', 'normal', '2018-04-18 11:05:58', '2018-04-18 11:05:58'),
(290, ':fireworks:', 'fireworks', 'Fireworks', 'normal', '2018-04-18 11:05:58', '2018-04-18 11:05:58'),
(291, ':sparkler:', 'sparkler', 'Sparkler', 'normal', '2018-04-18 11:05:58', '2018-04-18 11:05:58'),
(292, ':wind_chime:', 'wind_chime', 'Wind Chime', 'normal', '2018-04-18 11:05:58', '2018-04-18 11:05:58'),
(293, ':rice_scene:', 'rice_scene', 'Rice Scene', 'normal', '2018-04-18 11:05:58', '2018-04-18 11:05:58'),
(294, ':jack_o_lantern:', 'jack_o_lantern', 'Jack O Lantern', 'normal', '2018-04-18 11:05:58', '2018-04-18 11:05:58'),
(295, ':ghost:', 'ghost', 'Ghost', 'normal', '2018-04-18 11:05:58', '2018-04-18 11:05:58'),
(296, ':santa:', 'santa', 'Santa', 'normal', '2018-04-18 11:05:58', '2018-04-18 11:05:58'),
(297, ':8ball:', '8ball', '8ball', 'normal', '2018-04-18 11:05:58', '2018-04-18 11:05:58'),
(298, ':alarm_clock:', 'alarm_clock', 'Alarm Clock', 'normal', '2018-04-18 11:05:58', '2018-04-18 11:05:58'),
(299, ':apple:', 'apple', 'Apple', 'normal', '2018-04-18 11:05:58', '2018-04-18 11:05:58'),
(300, ':art:', 'art', 'Art', 'normal', '2018-04-18 11:05:58', '2018-04-18 11:05:58'),
(301, ':baby_bottle:', 'baby_bottle', 'Baby Bottle', 'normal', '2018-04-18 11:05:58', '2018-04-18 11:05:58'),
(302, ':balloon:', 'balloon', 'Balloon', 'normal', '2018-04-18 11:05:58', '2018-04-18 11:05:58'),
(303, ':banana:', 'banana', 'Banana', 'normal', '2018-04-18 11:05:58', '2018-04-18 11:05:58'),
(304, ':bar_chart:', 'bar_chart', 'Bar Chart', 'normal', '2018-04-18 11:05:58', '2018-04-18 11:05:58'),
(305, ':baseball:', 'baseball', 'Baseball', 'normal', '2018-04-18 11:05:58', '2018-04-18 11:05:58'),
(306, ':basketball:', 'basketball', 'Basketball', 'normal', '2018-04-18 11:05:58', '2018-04-18 11:05:58'),
(307, ':bath:', 'bath', 'Bath', 'normal', '2018-04-18 11:05:58', '2018-04-18 11:05:58'),
(308, ':bathtub:', 'bathtub', 'Bathtub', 'normal', '2018-04-18 11:05:58', '2018-04-18 11:05:58'),
(309, ':battery:', 'battery', 'Battery', 'normal', '2018-04-18 11:05:59', '2018-04-18 11:05:59'),
(310, ':beer:', 'beer', 'Beer', 'normal', '2018-04-18 11:05:59', '2018-04-18 11:05:59'),
(311, ':beers:', 'beers', 'Beers', 'normal', '2018-04-18 11:05:59', '2018-04-18 11:05:59'),
(312, ':bell:', 'bell', 'Bell', 'normal', '2018-04-18 11:05:59', '2018-04-18 11:05:59'),
(313, ':bento:', 'bento', 'Bento', 'normal', '2018-04-18 11:05:59', '2018-04-18 11:05:59'),
(314, ':bicyclist:', 'bicyclist', 'Bicyclist', 'normal', '2018-04-18 11:05:59', '2018-04-18 11:05:59'),
(315, ':bikini:', 'bikini', 'Bikini', 'normal', '2018-04-18 11:05:59', '2018-04-18 11:05:59'),
(316, ':birthday:', 'birthday', 'Birthday', 'normal', '2018-04-18 11:05:59', '2018-04-18 11:05:59'),
(317, ':black_joker:', 'black_joker', 'Black Joker', 'normal', '2018-04-18 11:05:59', '2018-04-18 11:05:59'),
(318, ':black_nib:', 'black_nib', 'Black Nib', 'normal', '2018-04-18 11:05:59', '2018-04-18 11:05:59'),
(319, ':blue_book:', 'blue_book', 'Blue Book', 'normal', '2018-04-18 11:05:59', '2018-04-18 11:05:59'),
(320, ':bomb:', 'bomb', 'Bomb', 'normal', '2018-04-18 11:05:59', '2018-04-18 11:05:59'),
(321, ':bookmark:', 'bookmark', 'Bookmark', 'normal', '2018-04-18 11:05:59', '2018-04-18 11:05:59'),
(322, ':bookmark_tabs:', 'bookmark_tabs', 'Bookmark Tabs', 'normal', '2018-04-18 11:05:59', '2018-04-18 11:05:59'),
(323, ':books:', 'books', 'Books', 'normal', '2018-04-18 11:05:59', '2018-04-18 11:05:59'),
(324, ':boot:', 'boot', 'Boot', 'normal', '2018-04-18 11:05:59', '2018-04-18 11:05:59'),
(325, ':bowling:', 'bowling', 'Bowling', 'normal', '2018-04-18 11:05:59', '2018-04-18 11:05:59'),
(326, ':bread:', 'bread', 'Bread', 'normal', '2018-04-18 11:05:59', '2018-04-18 11:05:59'),
(327, ':briefcase:', 'briefcase', 'Briefcase', 'normal', '2018-04-18 11:05:59', '2018-04-18 11:05:59'),
(328, ':bulb:', 'bulb', 'Bulb', 'normal', '2018-04-18 11:05:59', '2018-04-18 11:05:59'),
(329, ':cake:', 'cake', 'Cake', 'normal', '2018-04-18 11:05:59', '2018-04-18 11:05:59'),
(330, ':calendar:', 'calendar', 'Calendar', 'normal', '2018-04-18 11:05:59', '2018-04-18 11:05:59'),
(331, ':calling:', 'calling', 'Calling', 'normal', '2018-04-18 11:06:00', '2018-04-18 11:06:00'),
(332, ':camera:', 'camera', 'Camera', 'normal', '2018-04-18 11:06:00', '2018-04-18 11:06:00'),
(333, ':candy:', 'candy', 'Candy', 'normal', '2018-04-18 11:06:00', '2018-04-18 11:06:00'),
(334, ':card_index:', 'card_index', 'Card Index', 'normal', '2018-04-18 11:06:00', '2018-04-18 11:06:00'),
(335, ':cd:', 'cd', 'Cd', 'normal', '2018-04-18 11:06:00', '2018-04-18 11:06:00'),
(336, ':chart_with_downwards_trend:', 'chart_with_downwards_trend', 'Chart With Downwards Trend', 'normal', '2018-04-18 11:06:00', '2018-04-18 11:06:00'),
(337, ':chart_with_upwards_trend:', 'chart_with_upwards_trend', 'Chart With Upwards Trend', 'normal', '2018-04-18 11:06:00', '2018-04-18 11:06:00'),
(338, ':cherries:', 'cherries', 'Cherries', 'normal', '2018-04-18 11:06:00', '2018-04-18 11:06:00'),
(339, ':chocolate_bar:', 'chocolate_bar', 'Chocolate Bar', 'normal', '2018-04-18 11:06:00', '2018-04-18 11:06:00'),
(340, ':christmas_tree:', 'christmas_tree', 'Christmas Tree', 'normal', '2018-04-18 11:06:00', '2018-04-18 11:06:00'),
(341, ':clapper:', 'clapper', 'Clapper', 'normal', '2018-04-18 11:06:00', '2018-04-18 11:06:00'),
(342, ':clipboard:', 'clipboard', 'Clipboard', 'normal', '2018-04-18 11:06:00', '2018-04-18 11:06:00'),
(343, ':closed_book:', 'closed_book', 'Closed Book', 'normal', '2018-04-18 11:06:00', '2018-04-18 11:06:00'),
(344, ':closed_lock_with_key:', 'closed_lock_with_key', 'Closed Lock With Key', 'normal', '2018-04-18 11:06:00', '2018-04-18 11:06:00'),
(345, ':closed_umbrella:', 'closed_umbrella', 'Closed Umbrella', 'normal', '2018-04-18 11:06:00', '2018-04-18 11:06:00'),
(346, ':clubs:', 'clubs', 'Clubs', 'normal', '2018-04-18 11:06:00', '2018-04-18 11:06:00'),
(347, ':cocktail:', 'cocktail', 'Cocktail', 'normal', '2018-04-18 11:06:00', '2018-04-18 11:06:00'),
(348, ':coffee:', 'coffee', 'Coffee', 'normal', '2018-04-18 11:06:00', '2018-04-18 11:06:00'),
(349, ':computer:', 'computer', 'Computer', 'normal', '2018-04-18 11:06:00', '2018-04-18 11:06:00'),
(350, ':confetti_ball:', 'confetti_ball', 'Confetti Ball', 'normal', '2018-04-18 11:06:00', '2018-04-18 11:06:00'),
(351, ':cookie:', 'cookie', 'Cookie', 'normal', '2018-04-18 11:06:00', '2018-04-18 11:06:00'),
(352, ':corn:', 'corn', 'Corn', 'normal', '2018-04-18 11:06:00', '2018-04-18 11:06:00'),
(353, ':credit_card:', 'credit_card', 'Credit Card', 'normal', '2018-04-18 11:06:00', '2018-04-18 11:06:00'),
(354, ':crown:', 'crown', 'Crown', 'normal', '2018-04-18 11:06:00', '2018-04-18 11:06:00'),
(355, ':crystal_ball:', 'crystal_ball', 'Crystal Ball', 'normal', '2018-04-18 11:06:00', '2018-04-18 11:06:00'),
(356, ':curry:', 'curry', 'Curry', 'normal', '2018-04-18 11:06:00', '2018-04-18 11:06:00'),
(357, ':custard:', 'custard', 'Custard', 'normal', '2018-04-18 11:06:01', '2018-04-18 11:06:01'),
(358, ':dango:', 'dango', 'Dango', 'normal', '2018-04-18 11:06:01', '2018-04-18 11:06:01'),
(359, ':dart:', 'dart', 'Dart', 'normal', '2018-04-18 11:06:01', '2018-04-18 11:06:01'),
(360, ':date:', 'date', 'Date', 'normal', '2018-04-18 11:06:01', '2018-04-18 11:06:01'),
(361, ':diamonds:', 'diamonds', 'Diamonds', 'normal', '2018-04-18 11:06:01', '2018-04-18 11:06:01'),
(362, ':dollar:', 'dollar', 'Dollar', 'normal', '2018-04-18 11:06:01', '2018-04-18 11:06:01'),
(363, ':door:', 'door', 'Door', 'normal', '2018-04-18 11:06:01', '2018-04-18 11:06:01'),
(364, ':doughnut:', 'doughnut', 'Doughnut', 'normal', '2018-04-18 11:06:01', '2018-04-18 11:06:01'),
(365, ':dress:', 'dress', 'Dress', 'normal', '2018-04-18 11:06:01', '2018-04-18 11:06:01'),
(366, ':dvd:', 'dvd', 'Dvd', 'normal', '2018-04-18 11:06:01', '2018-04-18 11:06:01'),
(367, ':e_mail:', 'e_mail', 'E Mail', 'normal', '2018-04-18 11:06:01', '2018-04-18 11:06:01'),
(368, ':egg:', 'egg', 'Egg', 'normal', '2018-04-18 11:06:01', '2018-04-18 11:06:01'),
(369, ':eggplant:', 'eggplant', 'Eggplant', 'normal', '2018-04-18 11:06:01', '2018-04-18 11:06:01'),
(370, ':electric_plug:', 'electric_plug', 'Electric Plug', 'normal', '2018-04-18 11:06:01', '2018-04-18 11:06:01'),
(371, ':email:', 'email', 'Email', 'normal', '2018-04-18 11:06:01', '2018-04-18 11:06:01'),
(372, ':euro:', 'euro', 'Euro', 'normal', '2018-04-18 11:06:01', '2018-04-18 11:06:01'),
(373, ':eyeglasses:', 'eyeglasses', 'Eyeglasses', 'normal', '2018-04-18 11:06:01', '2018-04-18 11:06:01'),
(374, ':fax:', 'fax', 'Fax', 'normal', '2018-04-18 11:06:01', '2018-04-18 11:06:01'),
(375, ':file_folder:', 'file_folder', 'File Folder', 'normal', '2018-04-18 11:06:01', '2018-04-18 11:06:01'),
(376, ':fish_cake:', 'fish_cake', 'Fish Cake', 'normal', '2018-04-18 11:06:01', '2018-04-18 11:06:01'),
(377, ':fishing_pole_and_fish:', 'fishing_pole_and_fish', 'Fishing Pole And Fish', 'normal', '2018-04-18 11:06:01', '2018-04-18 11:06:01'),
(378, ':flashlight:', 'flashlight', 'Flashlight', 'normal', '2018-04-18 11:06:01', '2018-04-18 11:06:01'),
(379, ':floppy_disk:', 'floppy_disk', 'Floppy Disk', 'normal', '2018-04-18 11:06:01', '2018-04-18 11:06:01'),
(380, ':flower_playing_cards:', 'flower_playing_cards', 'Flower Playing Cards', 'normal', '2018-04-18 11:06:01', '2018-04-18 11:06:01'),
(381, ':football:', 'football', 'Football', 'normal', '2018-04-18 11:06:01', '2018-04-18 11:06:01'),
(382, ':fork_and_knife:', 'fork_and_knife', 'Fork And Knife', 'normal', '2018-04-18 11:06:01', '2018-04-18 11:06:01'),
(383, ':fried_shrimp:', 'fried_shrimp', 'Fried Shrimp', 'normal', '2018-04-18 11:06:01', '2018-04-18 11:06:01'),
(384, ':fries:', 'fries', 'Fries', 'normal', '2018-04-18 11:06:01', '2018-04-18 11:06:01'),
(385, ':game_die:', 'game_die', 'Game Die', 'normal', '2018-04-18 11:06:01', '2018-04-18 11:06:01'),
(386, ':gem:', 'gem', 'Gem', 'normal', '2018-04-18 11:06:01', '2018-04-18 11:06:01'),
(387, ':gift:', 'gift', 'Gift', 'normal', '2018-04-18 11:06:01', '2018-04-18 11:06:01'),
(388, ':golf:', 'golf', 'Golf', 'normal', '2018-04-18 11:06:01', '2018-04-18 11:06:01'),
(389, ':grapes:', 'grapes', 'Grapes', 'normal', '2018-04-18 11:06:01', '2018-04-18 11:06:01'),
(390, ':green_apple:', 'green_apple', 'Green Apple', 'normal', '2018-04-18 11:06:01', '2018-04-18 11:06:01'),
(391, ':green_book:', 'green_book', 'Green Book', 'normal', '2018-04-18 11:06:02', '2018-04-18 11:06:02'),
(392, ':guitar:', 'guitar', 'Guitar', 'normal', '2018-04-18 11:06:02', '2018-04-18 11:06:02'),
(393, ':gun:', 'gun', 'Gun', 'normal', '2018-04-18 11:06:02', '2018-04-18 11:06:02'),
(394, ':hamburger:', 'hamburger', 'Hamburger', 'normal', '2018-04-18 11:06:02', '2018-04-18 11:06:02'),
(395, ':hammer:', 'hammer', 'Hammer', 'normal', '2018-04-18 11:06:02', '2018-04-18 11:06:02'),
(396, ':handbag:', 'handbag', 'Handbag', 'normal', '2018-04-18 11:06:02', '2018-04-18 11:06:02'),
(397, ':headphones:', 'headphones', 'Headphones', 'normal', '2018-04-18 11:06:02', '2018-04-18 11:06:02'),
(398, ':hearts:', 'hearts', 'Hearts', 'normal', '2018-04-18 11:06:02', '2018-04-18 11:06:02'),
(399, ':high_brightness:', 'high_brightness', 'High Brightness', 'normal', '2018-04-18 11:06:02', '2018-04-18 11:06:02'),
(400, ':high_heel:', 'high_heel', 'High Heel', 'normal', '2018-04-18 11:06:02', '2018-04-18 11:06:02'),
(401, ':hocho:', 'hocho', 'Hocho', 'normal', '2018-04-18 11:06:02', '2018-04-18 11:06:02'),
(402, ':honey_pot:', 'honey_pot', 'Honey Pot', 'normal', '2018-04-18 11:06:02', '2018-04-18 11:06:02'),
(403, ':horse_racing:', 'horse_racing', 'Horse Racing', 'normal', '2018-04-18 11:06:02', '2018-04-18 11:06:02'),
(404, ':hourglass:', 'hourglass', 'Hourglass', 'normal', '2018-04-18 11:06:02', '2018-04-18 11:06:02'),
(405, ':hourglass_flowing_sand:', 'hourglass_flowing_sand', 'Hourglass Flowing Sand', 'normal', '2018-04-18 11:06:02', '2018-04-18 11:06:02'),
(406, ':ice_cream:', 'ice_cream', 'Ice Cream', 'normal', '2018-04-18 11:06:02', '2018-04-18 11:06:02'),
(407, ':icecream:', 'icecream', 'Icecream', 'normal', '2018-04-18 11:06:02', '2018-04-18 11:06:02'),
(408, ':inbox_tray:', 'inbox_tray', 'Inbox Tray', 'normal', '2018-04-18 11:06:02', '2018-04-18 11:06:02'),
(409, ':incoming_envelope:', 'incoming_envelope', 'Incoming Envelope', 'normal', '2018-04-18 11:06:02', '2018-04-18 11:06:02'),
(410, ':iphone:', 'iphone', 'Iphone', 'normal', '2018-04-18 11:06:02', '2018-04-18 11:06:02'),
(411, ':jeans:', 'jeans', 'Jeans', 'normal', '2018-04-18 11:06:02', '2018-04-18 11:06:02'),
(412, ':key:', 'key', 'Key', 'normal', '2018-04-18 11:06:02', '2018-04-18 11:06:02'),
(413, ':kimono:', 'kimono', 'Kimono', 'normal', '2018-04-18 11:06:02', '2018-04-18 11:06:02'),
(414, ':ledger:', 'ledger', 'Ledger', 'normal', '2018-04-18 11:06:02', '2018-04-18 11:06:02'),
(415, ':lemon:', 'lemon', 'Lemon', 'normal', '2018-04-18 11:06:02', '2018-04-18 11:06:02'),
(416, ':lipstick:', 'lipstick', 'Lipstick', 'normal', '2018-04-18 11:06:02', '2018-04-18 11:06:02'),
(417, ':lock:', 'lock', 'Lock', 'normal', '2018-04-18 11:06:02', '2018-04-18 11:06:02'),
(418, ':lock_with_ink_pen:', 'lock_with_ink_pen', 'Lock With Ink Pen', 'normal', '2018-04-18 11:06:02', '2018-04-18 11:06:02'),
(419, ':lollipop:', 'lollipop', 'Lollipop', 'normal', '2018-04-18 11:06:02', '2018-04-18 11:06:02'),
(420, ':loop:', 'loop', 'Loop', 'normal', '2018-04-18 11:06:02', '2018-04-18 11:06:02'),
(421, ':loudspeaker:', 'loudspeaker', 'Loudspeaker', 'normal', '2018-04-18 11:06:02', '2018-04-18 11:06:02'),
(422, ':low_brightness:', 'low_brightness', 'Low Brightness', 'normal', '2018-04-18 11:06:02', '2018-04-18 11:06:02'),
(423, ':mag:', 'mag', 'Mag', 'normal', '2018-04-18 11:06:03', '2018-04-18 11:06:03'),
(424, ':mag_right:', 'mag_right', 'Mag Right', 'normal', '2018-04-18 11:06:03', '2018-04-18 11:06:03'),
(425, ':mahjong:', 'mahjong', 'Mahjong', 'normal', '2018-04-18 11:06:03', '2018-04-18 11:06:03'),
(426, ':mailbox:', 'mailbox', 'Mailbox', 'normal', '2018-04-18 11:06:03', '2018-04-18 11:06:03'),
(427, ':mailbox_closed:', 'mailbox_closed', 'Mailbox Closed', 'normal', '2018-04-18 11:06:03', '2018-04-18 11:06:03'),
(428, ':mailbox_with_mail:', 'mailbox_with_mail', 'Mailbox With Mail', 'normal', '2018-04-18 11:06:03', '2018-04-18 11:06:03'),
(429, ':mailbox_with_no_mail:', 'mailbox_with_no_mail', 'Mailbox With No Mail', 'normal', '2018-04-18 11:06:03', '2018-04-18 11:06:03'),
(430, ':mans_shoe:', 'mans_shoe', 'Mans Shoe', 'normal', '2018-04-18 11:06:03', '2018-04-18 11:06:03'),
(431, ':meat_on_bone:', 'meat_on_bone', 'Meat On Bone', 'normal', '2018-04-18 11:06:03', '2018-04-18 11:06:03'),
(432, ':mega:', 'mega', 'Mega', 'normal', '2018-04-18 11:06:03', '2018-04-18 11:06:03'),
(433, ':melon:', 'melon', 'Melon', 'normal', '2018-04-18 11:06:03', '2018-04-18 11:06:03'),
(434, ':memo:', 'memo', 'Memo', 'normal', '2018-04-18 11:06:03', '2018-04-18 11:06:03'),
(435, ':microphone:', 'microphone', 'Microphone', 'normal', '2018-04-18 11:06:03', '2018-04-18 11:06:03'),
(436, ':microscope:', 'microscope', 'Microscope', 'normal', '2018-04-18 11:06:03', '2018-04-18 11:06:03'),
(437, ':minidisc:', 'minidisc', 'Minidisc', 'normal', '2018-04-18 11:06:03', '2018-04-18 11:06:03'),
(438, ':money_with_wings:', 'money_with_wings', 'Money With Wings', 'normal', '2018-04-18 11:06:03', '2018-04-18 11:06:03'),
(439, ':moneybag:', 'moneybag', 'Moneybag', 'normal', '2018-04-18 11:06:03', '2018-04-18 11:06:03'),
(440, ':mountain_bicyclist:', 'mountain_bicyclist', 'Mountain Bicyclist', 'normal', '2018-04-18 11:06:03', '2018-04-18 11:06:03'),
(441, ':movie_camera:', 'movie_camera', 'Movie Camera', 'normal', '2018-04-18 11:06:03', '2018-04-18 11:06:03'),
(442, ':musical_keyboard:', 'musical_keyboard', 'Musical Keyboard', 'normal', '2018-04-18 11:06:03', '2018-04-18 11:06:03'),
(443, ':musical_score:', 'musical_score', 'Musical Score', 'normal', '2018-04-18 11:06:03', '2018-04-18 11:06:03'),
(444, ':mute:', 'mute', 'Mute', 'normal', '2018-04-18 11:06:03', '2018-04-18 11:06:03'),
(445, ':name_badge:', 'name_badge', 'Name Badge', 'normal', '2018-04-18 11:06:03', '2018-04-18 11:06:03'),
(446, ':necktie:', 'necktie', 'Necktie', 'normal', '2018-04-18 11:06:03', '2018-04-18 11:06:03'),
(447, ':newspaper:', 'newspaper', 'Newspaper', 'normal', '2018-04-18 11:06:03', '2018-04-18 11:06:03'),
(448, ':no_bell:', 'no_bell', 'No Bell', 'normal', '2018-04-18 11:06:03', '2018-04-18 11:06:03'),
(449, ':notebook:', 'notebook', 'Notebook', 'normal', '2018-04-18 11:06:03', '2018-04-18 11:06:03'),
(450, ':notebook_with_decorative_cover:', 'notebook_with_decorative_cover', 'Notebook With Decorative Cover', 'normal', '2018-04-18 11:06:03', '2018-04-18 11:06:03'),
(451, ':nut_and_bolt:', 'nut_and_bolt', 'Nut And Bolt', 'normal', '2018-04-18 11:06:03', '2018-04-18 11:06:03'),
(452, ':oden:', 'oden', 'Oden', 'normal', '2018-04-18 11:06:03', '2018-04-18 11:06:03'),
(453, ':open_file_folder:', 'open_file_folder', 'Open File Folder', 'normal', '2018-04-18 11:06:03', '2018-04-18 11:06:03'),
(454, ':orange_book:', 'orange_book', 'Orange Book', 'normal', '2018-04-18 11:06:03', '2018-04-18 11:06:03'),
(455, ':outbox_tray:', 'outbox_tray', 'Outbox Tray', 'normal', '2018-04-18 11:06:03', '2018-04-18 11:06:03'),
(456, ':page_facing_up:', 'page_facing_up', 'Page Facing Up', 'normal', '2018-04-18 11:06:03', '2018-04-18 11:06:03'),
(457, ':page_with_curl:', 'page_with_curl', 'Page With Curl', 'normal', '2018-04-18 11:06:04', '2018-04-18 11:06:04'),
(458, ':pager:', 'pager', 'Pager', 'normal', '2018-04-18 11:06:04', '2018-04-18 11:06:04'),
(459, ':paperclip:', 'paperclip', 'Paperclip', 'normal', '2018-04-18 11:06:04', '2018-04-18 11:06:04'),
(460, ':peach:', 'peach', 'Peach', 'normal', '2018-04-18 11:06:04', '2018-04-18 11:06:04'),
(461, ':pear:', 'pear', 'Pear', 'normal', '2018-04-18 11:06:04', '2018-04-18 11:06:04'),
(462, ':pencil2:', 'pencil2', 'Pencil2', 'normal', '2018-04-18 11:06:04', '2018-04-18 11:06:04'),
(463, ':phone:', 'phone', 'Phone', 'normal', '2018-04-18 11:06:04', '2018-04-18 11:06:04'),
(464, ':pill:', 'pill', 'Pill', 'normal', '2018-04-18 11:06:04', '2018-04-18 11:06:04'),
(465, ':pineapple:', 'pineapple', 'Pineapple', 'normal', '2018-04-18 11:06:04', '2018-04-18 11:06:04'),
(466, ':pizza:', 'pizza', 'Pizza', 'normal', '2018-04-18 11:06:04', '2018-04-18 11:06:04'),
(467, ':postal_horn:', 'postal_horn', 'Postal Horn', 'normal', '2018-04-18 11:06:04', '2018-04-18 11:06:04'),
(468, ':postbox:', 'postbox', 'Postbox', 'normal', '2018-04-18 11:06:04', '2018-04-18 11:06:04'),
(469, ':pouch:', 'pouch', 'Pouch', 'normal', '2018-04-18 11:06:04', '2018-04-18 11:06:04'),
(470, ':poultry_leg:', 'poultry_leg', 'Poultry Leg', 'normal', '2018-04-18 11:06:04', '2018-04-18 11:06:04'),
(471, ':pound:', 'pound', 'Pound', 'normal', '2018-04-18 11:06:04', '2018-04-18 11:06:04'),
(472, ':purse:', 'purse', 'Purse', 'normal', '2018-04-18 11:06:04', '2018-04-18 11:06:04'),
(473, ':pushpin:', 'pushpin', 'Pushpin', 'normal', '2018-04-18 11:06:04', '2018-04-18 11:06:04'),
(474, ':radio:', 'radio', 'Radio', 'normal', '2018-04-18 11:06:04', '2018-04-18 11:06:04'),
(475, ':ramen:', 'ramen', 'Ramen', 'normal', '2018-04-18 11:06:04', '2018-04-18 11:06:04'),
(476, ':ribbon:', 'ribbon', 'Ribbon', 'normal', '2018-04-18 11:06:04', '2018-04-18 11:06:04'),
(477, ':rice:', 'rice', 'Rice', 'normal', '2018-04-18 11:06:04', '2018-04-18 11:06:04'),
(478, ':rice_ball:', 'rice_ball', 'Rice Ball', 'normal', '2018-04-18 11:06:04', '2018-04-18 11:06:04'),
(479, ':rice_cracker:', 'rice_cracker', 'Rice Cracker', 'normal', '2018-04-18 11:06:04', '2018-04-18 11:06:04'),
(480, ':ring:', 'ring', 'Ring', 'normal', '2018-04-18 11:06:04', '2018-04-18 11:06:04'),
(481, ':rugby_football:', 'rugby_football', 'Rugby Football', 'normal', '2018-04-18 11:06:04', '2018-04-18 11:06:04'),
(482, ':running_shirt_with_sash:', 'running_shirt_with_sash', 'Running Shirt With Sash', 'normal', '2018-04-18 11:06:04', '2018-04-18 11:06:04'),
(483, ':sake:', 'sake', 'Sake', 'normal', '2018-04-18 11:06:04', '2018-04-18 11:06:04'),
(484, ':sandal:', 'sandal', 'Sandal', 'normal', '2018-04-18 11:06:04', '2018-04-18 11:06:04'),
(485, ':satellite:', 'satellite', 'Satellite', 'normal', '2018-04-18 11:06:04', '2018-04-18 11:06:04'),
(486, ':saxophone:', 'saxophone', 'Saxophone', 'normal', '2018-04-18 11:06:05', '2018-04-18 11:06:05'),
(487, ':scissors:', 'scissors', 'Scissors', 'normal', '2018-04-18 11:06:05', '2018-04-18 11:06:05'),
(488, ':scroll:', 'scroll', 'Scroll', 'normal', '2018-04-18 11:06:05', '2018-04-18 11:06:05'),
(489, ':seat:', 'seat', 'Seat', 'normal', '2018-04-18 11:06:05', '2018-04-18 11:06:05'),
(490, ':shaved_ice:', 'shaved_ice', 'Shaved Ice', 'normal', '2018-04-18 11:06:05', '2018-04-18 11:06:05'),
(491, ':shirt:', 'shirt', 'Shirt', 'normal', '2018-04-18 11:06:05', '2018-04-18 11:06:05'),
(492, ':shower:', 'shower', 'Shower', 'normal', '2018-04-18 11:06:05', '2018-04-18 11:06:05'),
(493, ':ski:', 'ski', 'Ski', 'normal', '2018-04-18 11:06:05', '2018-04-18 11:06:05'),
(494, ':smoking:', 'smoking', 'Smoking', 'normal', '2018-04-18 11:06:05', '2018-04-18 11:06:05');
INSERT INTO `emoji` (`id`, `value`, `code`, `text`, `emoji_type`, `created_at`, `updated_at`) VALUES
(495, ':snowboarder:', 'snowboarder', 'Snowboarder', 'normal', '2018-04-18 11:06:05', '2018-04-18 11:06:05'),
(496, ':soccer:', 'soccer', 'Soccer', 'normal', '2018-04-18 11:06:05', '2018-04-18 11:06:05'),
(497, ':sound:', 'sound', 'Sound', 'normal', '2018-04-18 11:06:05', '2018-04-18 11:06:05'),
(498, ':space_invader:', 'space_invader', 'Space Invader', 'normal', '2018-04-18 11:06:05', '2018-04-18 11:06:05'),
(499, ':spades:', 'spades', 'Spades', 'normal', '2018-04-18 11:06:05', '2018-04-18 11:06:05'),
(500, ':spaghetti:', 'spaghetti', 'Spaghetti', 'normal', '2018-04-18 11:06:05', '2018-04-18 11:06:05'),
(501, ':speaker:', 'speaker', 'Speaker', 'normal', '2018-04-18 11:06:05', '2018-04-18 11:06:05'),
(502, ':stew:', 'stew', 'Stew', 'normal', '2018-04-18 11:06:05', '2018-04-18 11:06:05'),
(503, ':straight_ruler:', 'straight_ruler', 'Straight Ruler', 'normal', '2018-04-18 11:06:05', '2018-04-18 11:06:05'),
(504, ':strawberry:', 'strawberry', 'Strawberry', 'normal', '2018-04-18 11:06:05', '2018-04-18 11:06:05'),
(505, ':surfer:', 'surfer', 'Surfer', 'normal', '2018-04-18 11:06:05', '2018-04-18 11:06:05'),
(506, ':sushi:', 'sushi', 'Sushi', 'normal', '2018-04-18 11:06:05', '2018-04-18 11:06:05'),
(507, ':sweet_potato:', 'sweet_potato', 'Sweet Potato', 'normal', '2018-04-18 11:06:05', '2018-04-18 11:06:05'),
(508, ':swimmer:', 'swimmer', 'Swimmer', 'normal', '2018-04-18 11:06:05', '2018-04-18 11:06:05'),
(509, ':syringe:', 'syringe', 'Syringe', 'normal', '2018-04-18 11:06:05', '2018-04-18 11:06:05'),
(510, ':tada:', 'tada', 'Tada', 'normal', '2018-04-18 11:06:05', '2018-04-18 11:06:05'),
(511, ':tanabata_tree:', 'tanabata_tree', 'Tanabata Tree', 'normal', '2018-04-18 11:06:05', '2018-04-18 11:06:05'),
(512, ':tangerine:', 'tangerine', 'Tangerine', 'normal', '2018-04-18 11:06:05', '2018-04-18 11:06:05'),
(513, ':tea:', 'tea', 'Tea', 'normal', '2018-04-18 11:06:05', '2018-04-18 11:06:05'),
(514, ':telephone_receiver:', 'telephone_receiver', 'Telephone Receiver', 'normal', '2018-04-18 11:06:05', '2018-04-18 11:06:05'),
(515, ':telescope:', 'telescope', 'Telescope', 'normal', '2018-04-18 11:06:05', '2018-04-18 11:06:05'),
(516, ':tennis:', 'tennis', 'Tennis', 'normal', '2018-04-18 11:06:05', '2018-04-18 11:06:05'),
(517, ':toilet:', 'toilet', 'Toilet', 'normal', '2018-04-18 11:06:05', '2018-04-18 11:06:05'),
(518, ':tomato:', 'tomato', 'Tomato', 'normal', '2018-04-18 11:06:05', '2018-04-18 11:06:05'),
(519, ':tophat:', 'tophat', 'Tophat', 'normal', '2018-04-18 11:06:05', '2018-04-18 11:06:05'),
(520, ':triangular_ruler:', 'triangular_ruler', 'Triangular Ruler', 'normal', '2018-04-18 11:06:05', '2018-04-18 11:06:05'),
(521, ':trophy:', 'trophy', 'Trophy', 'normal', '2018-04-18 11:06:06', '2018-04-18 11:06:06'),
(522, ':tropical_drink:', 'tropical_drink', 'Tropical Drink', 'normal', '2018-04-18 11:06:06', '2018-04-18 11:06:06'),
(523, ':trumpet:', 'trumpet', 'Trumpet', 'normal', '2018-04-18 11:06:06', '2018-04-18 11:06:06'),
(524, ':tv:', 'tv', 'Tv', 'normal', '2018-04-18 11:06:06', '2018-04-18 11:06:06'),
(525, ':unlock:', 'unlock', 'Unlock', 'normal', '2018-04-18 11:06:06', '2018-04-18 11:06:06'),
(526, ':vhs:', 'vhs', 'Vhs', 'normal', '2018-04-18 11:06:06', '2018-04-18 11:06:06'),
(527, ':video_camera:', 'video_camera', 'Video Camera', 'normal', '2018-04-18 11:06:06', '2018-04-18 11:06:06'),
(528, ':video_game:', 'video_game', 'Video Game', 'normal', '2018-04-18 11:06:06', '2018-04-18 11:06:06'),
(529, ':violin:', 'violin', 'Violin', 'normal', '2018-04-18 11:06:06', '2018-04-18 11:06:06'),
(530, ':watch:', 'watch', 'Watch', 'normal', '2018-04-18 11:06:06', '2018-04-18 11:06:06'),
(531, ':watermelon:', 'watermelon', 'Watermelon', 'normal', '2018-04-18 11:06:06', '2018-04-18 11:06:06'),
(532, ':wine_glass:', 'wine_glass', 'Wine Glass', 'normal', '2018-04-18 11:06:06', '2018-04-18 11:06:06'),
(533, ':womans_clothes:', 'womans_clothes', 'Womans Clothes', 'normal', '2018-04-18 11:06:06', '2018-04-18 11:06:06'),
(534, ':womans_hat:', 'womans_hat', 'Womans Hat', 'normal', '2018-04-18 11:06:06', '2018-04-18 11:06:06'),
(535, ':wrench:', 'wrench', 'Wrench', 'normal', '2018-04-18 11:06:06', '2018-04-18 11:06:06'),
(536, ':yen:', 'yen', 'Yen', 'normal', '2018-04-18 11:06:06', '2018-04-18 11:06:06'),
(537, ':aerial_tramway:', 'aerial_tramway', 'Aerial Tramway', 'normal', '2018-04-18 11:06:06', '2018-04-18 11:06:06'),
(538, ':airplane:', 'airplane', 'Airplane', 'normal', '2018-04-18 11:06:06', '2018-04-18 11:06:06'),
(539, ':ambulance:', 'ambulance', 'Ambulance', 'normal', '2018-04-18 11:06:06', '2018-04-18 11:06:06'),
(540, ':anchor:', 'anchor', 'Anchor', 'normal', '2018-04-18 11:06:06', '2018-04-18 11:06:06'),
(541, ':articulated_lorry:', 'articulated_lorry', 'Articulated Lorry', 'normal', '2018-04-18 11:06:06', '2018-04-18 11:06:06'),
(542, ':atm:', 'atm', 'Atm', 'normal', '2018-04-18 11:06:06', '2018-04-18 11:06:06'),
(543, ':bank:', 'bank', 'Bank', 'normal', '2018-04-18 11:06:06', '2018-04-18 11:06:06'),
(544, ':barber:', 'barber', 'Barber', 'normal', '2018-04-18 11:06:06', '2018-04-18 11:06:06'),
(545, ':beginner:', 'beginner', 'Beginner', 'normal', '2018-04-18 11:06:06', '2018-04-18 11:06:06'),
(546, ':bike:', 'bike', 'Bike', 'normal', '2018-04-18 11:06:06', '2018-04-18 11:06:06'),
(547, ':blue_car:', 'blue_car', 'Blue Car', 'normal', '2018-04-18 11:06:06', '2018-04-18 11:06:06'),
(548, ':boat:', 'boat', 'Boat', 'normal', '2018-04-18 11:06:06', '2018-04-18 11:06:06'),
(549, ':bridge_at_night:', 'bridge_at_night', 'Bridge At Night', 'normal', '2018-04-18 11:06:06', '2018-04-18 11:06:06'),
(550, ':bullettrain_front:', 'bullettrain_front', 'Bullettrain Front', 'normal', '2018-04-18 11:06:06', '2018-04-18 11:06:06'),
(551, ':bullettrain_side:', 'bullettrain_side', 'Bullettrain Side', 'normal', '2018-04-18 11:06:06', '2018-04-18 11:06:06'),
(552, ':bus:', 'bus', 'Bus', 'normal', '2018-04-18 11:06:06', '2018-04-18 11:06:06'),
(553, ':busstop:', 'busstop', 'Busstop', 'normal', '2018-04-18 11:06:06', '2018-04-18 11:06:06'),
(554, ':car:', 'car', 'Car', 'normal', '2018-04-18 11:06:07', '2018-04-18 11:06:07'),
(555, ':carousel_horse:', 'carousel_horse', 'Carousel Horse', 'normal', '2018-04-18 11:06:07', '2018-04-18 11:06:07'),
(556, ':checkered_flag:', 'checkered_flag', 'Checkered Flag', 'normal', '2018-04-18 11:06:07', '2018-04-18 11:06:07'),
(557, ':church:', 'church', 'Church', 'normal', '2018-04-18 11:06:07', '2018-04-18 11:06:07'),
(558, ':circus_tent:', 'circus_tent', 'Circus Tent', 'normal', '2018-04-18 11:06:07', '2018-04-18 11:06:07'),
(559, ':city_sunrise:', 'city_sunrise', 'City Sunrise', 'normal', '2018-04-18 11:06:07', '2018-04-18 11:06:07'),
(560, ':city_sunset:', 'city_sunset', 'City Sunset', 'normal', '2018-04-18 11:06:07', '2018-04-18 11:06:07'),
(561, ':construction:', 'construction', 'Construction', 'normal', '2018-04-18 11:06:07', '2018-04-18 11:06:07'),
(562, ':convenience_store:', 'convenience_store', 'Convenience Store', 'normal', '2018-04-18 11:06:07', '2018-04-18 11:06:07'),
(563, ':crossed_flags:', 'crossed_flags', 'Crossed Flags', 'normal', '2018-04-18 11:06:07', '2018-04-18 11:06:07'),
(564, ':department_store:', 'department_store', 'Department Store', 'normal', '2018-04-18 11:06:07', '2018-04-18 11:06:07'),
(565, ':european_castle:', 'european_castle', 'European Castle', 'normal', '2018-04-18 11:06:07', '2018-04-18 11:06:07'),
(566, ':european_post_office:', 'european_post_office', 'European Post Office', 'normal', '2018-04-18 11:06:07', '2018-04-18 11:06:07'),
(567, ':factory:', 'factory', 'Factory', 'normal', '2018-04-18 11:06:07', '2018-04-18 11:06:07'),
(568, ':ferris_wheel:', 'ferris_wheel', 'Ferris Wheel', 'normal', '2018-04-18 11:06:07', '2018-04-18 11:06:07'),
(569, ':fire_engine:', 'fire_engine', 'Fire Engine', 'normal', '2018-04-18 11:06:07', '2018-04-18 11:06:07'),
(570, ':fountain:', 'fountain', 'Fountain', 'normal', '2018-04-18 11:06:07', '2018-04-18 11:06:07'),
(571, ':fuelpump:', 'fuelpump', 'Fuelpump', 'normal', '2018-04-18 11:06:07', '2018-04-18 11:06:07'),
(572, ':helicopter:', 'helicopter', 'Helicopter', 'normal', '2018-04-18 11:06:07', '2018-04-18 11:06:07'),
(573, ':hospital:', 'hospital', 'Hospital', 'normal', '2018-04-18 11:06:07', '2018-04-18 11:06:07'),
(574, ':hotel:', 'hotel', 'Hotel', 'normal', '2018-04-18 11:06:07', '2018-04-18 11:06:07'),
(575, ':hotsprings:', 'hotsprings', 'Hotsprings', 'normal', '2018-04-18 11:06:07', '2018-04-18 11:06:07'),
(576, ':house:', 'house', 'House', 'normal', '2018-04-18 11:06:07', '2018-04-18 11:06:07'),
(577, ':house_with_garden:', 'house_with_garden', 'House With Garden', 'normal', '2018-04-18 11:06:07', '2018-04-18 11:06:07'),
(578, ':japan:', 'japan', 'Japan', 'normal', '2018-04-18 11:06:07', '2018-04-18 11:06:07'),
(579, ':japanese_castle:', 'japanese_castle', 'Japanese Castle', 'normal', '2018-04-18 11:06:07', '2018-04-18 11:06:07'),
(580, ':light_rail:', 'light_rail', 'Light Rail', 'normal', '2018-04-18 11:06:07', '2018-04-18 11:06:07'),
(581, ':love_hotel:', 'love_hotel', 'Love Hotel', 'normal', '2018-04-18 11:06:07', '2018-04-18 11:06:07'),
(582, ':minibus:', 'minibus', 'Minibus', 'normal', '2018-04-18 11:06:07', '2018-04-18 11:06:07'),
(583, ':monorail:', 'monorail', 'Monorail', 'normal', '2018-04-18 11:06:07', '2018-04-18 11:06:07'),
(584, ':mount_fuji:', 'mount_fuji', 'Mount Fuji', 'normal', '2018-04-18 11:06:07', '2018-04-18 11:06:07'),
(585, ':mountain_cableway:', 'mountain_cableway', 'Mountain Cableway', 'normal', '2018-04-18 11:06:07', '2018-04-18 11:06:07'),
(586, ':mountain_railway:', 'mountain_railway', 'Mountain Railway', 'normal', '2018-04-18 11:06:07', '2018-04-18 11:06:07'),
(587, ':moyai:', 'moyai', 'Moyai', 'normal', '2018-04-18 11:06:07', '2018-04-18 11:06:07'),
(588, ':office:', 'office', 'Office', 'normal', '2018-04-18 11:06:08', '2018-04-18 11:06:08'),
(589, ':oncoming_automobile:', 'oncoming_automobile', 'Oncoming Automobile', 'normal', '2018-04-18 11:06:08', '2018-04-18 11:06:08'),
(590, ':oncoming_bus:', 'oncoming_bus', 'Oncoming Bus', 'normal', '2018-04-18 11:06:08', '2018-04-18 11:06:08'),
(591, ':oncoming_police_car:', 'oncoming_police_car', 'Oncoming Police Car', 'normal', '2018-04-18 11:06:08', '2018-04-18 11:06:08'),
(592, ':oncoming_taxi:', 'oncoming_taxi', 'Oncoming Taxi', 'normal', '2018-04-18 11:06:08', '2018-04-18 11:06:08'),
(593, ':performing_arts:', 'performing_arts', 'Performing Arts', 'normal', '2018-04-18 11:06:08', '2018-04-18 11:06:08'),
(594, ':police_car:', 'police_car', 'Police Car', 'normal', '2018-04-18 11:06:08', '2018-04-18 11:06:08'),
(595, ':post_office:', 'post_office', 'Post Office', 'normal', '2018-04-18 11:06:08', '2018-04-18 11:06:08'),
(596, ':railway_car:', 'railway_car', 'Railway Car', 'normal', '2018-04-18 11:06:08', '2018-04-18 11:06:08'),
(597, ':rainbow:', 'rainbow', 'Rainbow', 'normal', '2018-04-18 11:06:08', '2018-04-18 11:06:08'),
(598, ':rocket:', 'rocket', 'Rocket', 'normal', '2018-04-18 11:06:08', '2018-04-18 11:06:08'),
(599, ':roller_coaster:', 'roller_coaster', 'Roller Coaster', 'normal', '2018-04-18 11:06:08', '2018-04-18 11:06:08'),
(600, ':rotating_light:', 'rotating_light', 'Rotating Light', 'normal', '2018-04-18 11:06:08', '2018-04-18 11:06:08'),
(601, ':round_pushpin:', 'round_pushpin', 'Round Pushpin', 'normal', '2018-04-18 11:06:08', '2018-04-18 11:06:08'),
(602, ':rowboat:', 'rowboat', 'Rowboat', 'normal', '2018-04-18 11:06:08', '2018-04-18 11:06:08'),
(603, ':school:', 'school', 'School', 'normal', '2018-04-18 11:06:08', '2018-04-18 11:06:08'),
(604, ':ship:', 'ship', 'Ship', 'normal', '2018-04-18 11:06:08', '2018-04-18 11:06:08'),
(605, ':slot_machine:', 'slot_machine', 'Slot Machine', 'normal', '2018-04-18 11:06:08', '2018-04-18 11:06:08'),
(606, ':speedboat:', 'speedboat', 'Speedboat', 'normal', '2018-04-18 11:06:08', '2018-04-18 11:06:08'),
(607, ':stars:', 'stars', 'Stars', 'normal', '2018-04-18 11:06:08', '2018-04-18 11:06:08'),
(608, ':station:', 'station', 'Station', 'normal', '2018-04-18 11:06:08', '2018-04-18 11:06:08'),
(609, ':statue_of_liberty:', 'statue_of_liberty', 'Statue Of Liberty', 'normal', '2018-04-18 11:06:08', '2018-04-18 11:06:08'),
(610, ':steam_locomotive:', 'steam_locomotive', 'Steam Locomotive', 'normal', '2018-04-18 11:06:08', '2018-04-18 11:06:08'),
(611, ':sunrise:', 'sunrise', 'Sunrise', 'normal', '2018-04-18 11:06:08', '2018-04-18 11:06:08'),
(612, ':sunrise_over_mountains:', 'sunrise_over_mountains', 'Sunrise Over Mountains', 'normal', '2018-04-18 11:06:08', '2018-04-18 11:06:08'),
(613, ':suspension_railway:', 'suspension_railway', 'Suspension Railway', 'normal', '2018-04-18 11:06:08', '2018-04-18 11:06:08'),
(614, ':taxi:', 'taxi', 'Taxi', 'normal', '2018-04-18 11:06:08', '2018-04-18 11:06:08'),
(615, ':tent:', 'tent', 'Tent', 'normal', '2018-04-18 11:06:08', '2018-04-18 11:06:08'),
(616, ':ticket:', 'ticket', 'Ticket', 'normal', '2018-04-18 11:06:08', '2018-04-18 11:06:08'),
(617, ':tokyo_tower:', 'tokyo_tower', 'Tokyo Tower', 'normal', '2018-04-18 11:06:08', '2018-04-18 11:06:08'),
(618, ':tractor:', 'tractor', 'Tractor', 'normal', '2018-04-18 11:06:08', '2018-04-18 11:06:08'),
(619, ':traffic_light:', 'traffic_light', 'Traffic Light', 'normal', '2018-04-18 11:06:08', '2018-04-18 11:06:08'),
(620, ':train2:', 'train2', 'Train2', 'normal', '2018-04-18 11:06:08', '2018-04-18 11:06:08'),
(621, ':tram:', 'tram', 'Tram', 'normal', '2018-04-18 11:06:08', '2018-04-18 11:06:08'),
(622, ':triangular_flag_on_post:', 'triangular_flag_on_post', 'Triangular Flag On Post', 'normal', '2018-04-18 11:06:09', '2018-04-18 11:06:09'),
(623, ':trolleybus:', 'trolleybus', 'Trolleybus', 'normal', '2018-04-18 11:06:09', '2018-04-18 11:06:09'),
(624, ':truck:', 'truck', 'Truck', 'normal', '2018-04-18 11:06:09', '2018-04-18 11:06:09'),
(625, ':vertical_traffic_light:', 'vertical_traffic_light', 'Vertical Traffic Light', 'normal', '2018-04-18 11:06:09', '2018-04-18 11:06:09'),
(626, ':warning:', 'warning', 'Warning', 'normal', '2018-04-18 11:06:09', '2018-04-18 11:06:09'),
(627, ':wedding:', 'wedding', 'Wedding', 'normal', '2018-04-18 11:06:09', '2018-04-18 11:06:09'),
(628, ':jp:', 'jp', 'Jp', 'normal', '2018-04-18 11:06:09', '2018-04-18 11:06:09'),
(629, ':kr:', 'kr', 'Kr', 'normal', '2018-04-18 11:06:09', '2018-04-18 11:06:09'),
(630, ':cn:', 'cn', 'Cn', 'normal', '2018-04-18 11:06:09', '2018-04-18 11:06:09'),
(631, ':us:', 'us', 'Us', 'normal', '2018-04-18 11:06:09', '2018-04-18 11:06:09'),
(632, ':fr:', 'fr', 'Fr', 'normal', '2018-04-18 11:06:09', '2018-04-18 11:06:09'),
(633, ':es:', 'es', 'Es', 'normal', '2018-04-18 11:06:09', '2018-04-18 11:06:09'),
(634, ':it:', 'it', 'It', 'normal', '2018-04-18 11:06:09', '2018-04-18 11:06:09'),
(635, ':ru:', 'ru', 'Ru', 'normal', '2018-04-18 11:06:09', '2018-04-18 11:06:09'),
(636, ':gb:', 'gb', 'Gb', 'normal', '2018-04-18 11:06:09', '2018-04-18 11:06:09'),
(637, ':de:', 'de', 'De', 'normal', '2018-04-18 11:06:09', '2018-04-18 11:06:09'),
(638, ':100:', '100', '100', 'normal', '2018-04-18 11:06:09', '2018-04-18 11:06:09'),
(639, ':1234:', '1234', '1234', 'normal', '2018-04-18 11:06:09', '2018-04-18 11:06:09'),
(640, ':a:', 'a', 'A', 'normal', '2018-04-18 11:06:09', '2018-04-18 11:06:09'),
(641, ':ab:', 'ab', 'Ab', 'normal', '2018-04-18 11:06:09', '2018-04-18 11:06:09'),
(642, ':abc:', 'abc', 'Abc', 'normal', '2018-04-18 11:06:09', '2018-04-18 11:06:09'),
(643, ':abcd:', 'abcd', 'Abcd', 'normal', '2018-04-18 11:06:09', '2018-04-18 11:06:09'),
(644, ':accept:', 'accept', 'Accept', 'normal', '2018-04-18 11:06:09', '2018-04-18 11:06:09'),
(645, ':aquarius:', 'aquarius', 'Aquarius', 'normal', '2018-04-18 11:06:09', '2018-04-18 11:06:09'),
(646, ':aries:', 'aries', 'Aries', 'normal', '2018-04-18 11:06:09', '2018-04-18 11:06:09'),
(647, ':arrow_backward:', 'arrow_backward', 'Arrow Backward', 'normal', '2018-04-18 11:06:09', '2018-04-18 11:06:09'),
(648, ':arrow_double_down:', 'arrow_double_down', 'Arrow Double Down', 'normal', '2018-04-18 11:06:09', '2018-04-18 11:06:09'),
(649, ':arrow_double_up:', 'arrow_double_up', 'Arrow Double Up', 'normal', '2018-04-18 11:06:09', '2018-04-18 11:06:09'),
(650, ':arrow_down:', 'arrow_down', 'Arrow Down', 'normal', '2018-04-18 11:06:09', '2018-04-18 11:06:09'),
(651, ':arrow_down_small:', 'arrow_down_small', 'Arrow Down Small', 'normal', '2018-04-18 11:06:09', '2018-04-18 11:06:09'),
(652, ':arrow_forward:', 'arrow_forward', 'Arrow Forward', 'normal', '2018-04-18 11:06:09', '2018-04-18 11:06:09'),
(653, ':arrow_heading_down:', 'arrow_heading_down', 'Arrow Heading Down', 'normal', '2018-04-18 11:06:09', '2018-04-18 11:06:09'),
(654, ':arrow_heading_up:', 'arrow_heading_up', 'Arrow Heading Up', 'normal', '2018-04-18 11:06:09', '2018-04-18 11:06:09'),
(655, ':arrow_left:', 'arrow_left', 'Arrow Left', 'normal', '2018-04-18 11:06:09', '2018-04-18 11:06:09'),
(656, ':arrow_lower_left:', 'arrow_lower_left', 'Arrow Lower Left', 'normal', '2018-04-18 11:06:10', '2018-04-18 11:06:10'),
(657, ':arrow_lower_right:', 'arrow_lower_right', 'Arrow Lower Right', 'normal', '2018-04-18 11:06:10', '2018-04-18 11:06:10'),
(658, ':arrow_right:', 'arrow_right', 'Arrow Right', 'normal', '2018-04-18 11:06:10', '2018-04-18 11:06:10'),
(659, ':arrow_right_hook:', 'arrow_right_hook', 'Arrow Right Hook', 'normal', '2018-04-18 11:06:10', '2018-04-18 11:06:10'),
(660, ':arrow_up:', 'arrow_up', 'Arrow Up', 'normal', '2018-04-18 11:06:10', '2018-04-18 11:06:10'),
(661, ':arrow_up_down:', 'arrow_up_down', 'Arrow Up Down', 'normal', '2018-04-18 11:06:10', '2018-04-18 11:06:10'),
(662, ':arrow_up_small:', 'arrow_up_small', 'Arrow Up Small', 'normal', '2018-04-18 11:06:10', '2018-04-18 11:06:10'),
(663, ':arrow_upper_left:', 'arrow_upper_left', 'Arrow Upper Left', 'normal', '2018-04-18 11:06:10', '2018-04-18 11:06:10'),
(664, ':arrow_upper_right:', 'arrow_upper_right', 'Arrow Upper Right', 'normal', '2018-04-18 11:06:10', '2018-04-18 11:06:10'),
(665, ':arrows_clockwise:', 'arrows_clockwise', 'Arrows Clockwise', 'normal', '2018-04-18 11:06:10', '2018-04-18 11:06:10'),
(666, ':arrows_counterclockwise:', 'arrows_counterclockwise', 'Arrows Counterclockwise', 'normal', '2018-04-18 11:06:10', '2018-04-18 11:06:10'),
(667, ':b:', 'b', 'B', 'normal', '2018-04-18 11:06:10', '2018-04-18 11:06:10'),
(668, ':baby_symbol:', 'baby_symbol', 'Baby Symbol', 'normal', '2018-04-18 11:06:10', '2018-04-18 11:06:10'),
(669, ':baggage_claim:', 'baggage_claim', 'Baggage Claim', 'normal', '2018-04-18 11:06:10', '2018-04-18 11:06:10'),
(670, ':ballot_box_with_check:', 'ballot_box_with_check', 'Ballot Box With Check', 'normal', '2018-04-18 11:06:10', '2018-04-18 11:06:10'),
(671, ':bangbang:', 'bangbang', 'Bangbang', 'normal', '2018-04-18 11:06:10', '2018-04-18 11:06:10'),
(672, ':black_circle:', 'black_circle', 'Black Circle', 'normal', '2018-04-18 11:06:10', '2018-04-18 11:06:10'),
(673, ':black_square_button:', 'black_square_button', 'Black Square Button', 'normal', '2018-04-18 11:06:10', '2018-04-18 11:06:10'),
(674, ':cancer:', 'cancer', 'Cancer', 'normal', '2018-04-18 11:06:11', '2018-04-18 11:06:11'),
(675, ':capital_abcd:', 'capital_abcd', 'Capital Abcd', 'normal', '2018-04-18 11:06:11', '2018-04-18 11:06:11'),
(676, ':capricorn:', 'capricorn', 'Capricorn', 'normal', '2018-04-18 11:06:11', '2018-04-18 11:06:11'),
(677, ':chart:', 'chart', 'Chart', 'normal', '2018-04-18 11:06:11', '2018-04-18 11:06:11'),
(678, ':children_crossing:', 'children_crossing', 'Children Crossing', 'normal', '2018-04-18 11:06:11', '2018-04-18 11:06:11'),
(679, ':cinema:', 'cinema', 'Cinema', 'normal', '2018-04-18 11:06:11', '2018-04-18 11:06:11'),
(680, ':cl:', 'cl', 'Cl', 'normal', '2018-04-18 11:06:11', '2018-04-18 11:06:11'),
(681, ':clock1:', 'clock1', 'Clock1', 'normal', '2018-04-18 11:06:11', '2018-04-18 11:06:11'),
(682, ':clock10:', 'clock10', 'Clock10', 'normal', '2018-04-18 11:06:11', '2018-04-18 11:06:11'),
(683, ':clock1030:', 'clock1030', 'Clock1030', 'normal', '2018-04-18 11:06:11', '2018-04-18 11:06:11'),
(684, ':clock11:', 'clock11', 'Clock11', 'normal', '2018-04-18 11:06:11', '2018-04-18 11:06:11'),
(685, ':clock1130:', 'clock1130', 'Clock1130', 'normal', '2018-04-18 11:06:11', '2018-04-18 11:06:11'),
(686, ':clock12:', 'clock12', 'Clock12', 'normal', '2018-04-18 11:06:11', '2018-04-18 11:06:11'),
(687, ':clock1230:', 'clock1230', 'Clock1230', 'normal', '2018-04-18 11:06:11', '2018-04-18 11:06:11'),
(688, ':clock130:', 'clock130', 'Clock130', 'normal', '2018-04-18 11:06:11', '2018-04-18 11:06:11'),
(689, ':clock2:', 'clock2', 'Clock2', 'normal', '2018-04-18 11:06:11', '2018-04-18 11:06:11'),
(690, ':clock230:', 'clock230', 'Clock230', 'normal', '2018-04-18 11:06:11', '2018-04-18 11:06:11'),
(691, ':clock3:', 'clock3', 'Clock3', 'normal', '2018-04-18 11:06:11', '2018-04-18 11:06:11'),
(692, ':clock330:', 'clock330', 'Clock330', 'normal', '2018-04-18 11:06:11', '2018-04-18 11:06:11'),
(693, ':clock4:', 'clock4', 'Clock4', 'normal', '2018-04-18 11:06:11', '2018-04-18 11:06:11'),
(694, ':clock430:', 'clock430', 'Clock430', 'normal', '2018-04-18 11:06:11', '2018-04-18 11:06:11'),
(695, ':clock5:', 'clock5', 'Clock5', 'normal', '2018-04-18 11:06:11', '2018-04-18 11:06:11'),
(696, ':clock530:', 'clock530', 'Clock530', 'normal', '2018-04-18 11:06:11', '2018-04-18 11:06:11'),
(697, ':clock6:', 'clock6', 'Clock6', 'normal', '2018-04-18 11:06:11', '2018-04-18 11:06:11'),
(698, ':clock630:', 'clock630', 'Clock630', 'normal', '2018-04-18 11:06:11', '2018-04-18 11:06:11'),
(699, ':clock7:', 'clock7', 'Clock7', 'normal', '2018-04-18 11:06:11', '2018-04-18 11:06:11'),
(700, ':clock730:', 'clock730', 'Clock730', 'normal', '2018-04-18 11:06:11', '2018-04-18 11:06:11'),
(701, ':clock8:', 'clock8', 'Clock8', 'normal', '2018-04-18 11:06:11', '2018-04-18 11:06:11'),
(702, ':clock830:', 'clock830', 'Clock830', 'normal', '2018-04-18 11:06:11', '2018-04-18 11:06:11'),
(703, ':clock9:', 'clock9', 'Clock9', 'normal', '2018-04-18 11:06:11', '2018-04-18 11:06:11'),
(704, ':clock930:', 'clock930', 'Clock930', 'normal', '2018-04-18 11:06:11', '2018-04-18 11:06:11'),
(705, ':congratulations:', 'congratulations', 'Congratulations', 'normal', '2018-04-18 11:06:11', '2018-04-18 11:06:11'),
(706, ':cool:', 'cool', 'Cool', 'normal', '2018-04-18 11:06:11', '2018-04-18 11:06:11'),
(707, ':copyright:', 'copyright', 'Copyright', 'normal', '2018-04-18 11:06:11', '2018-04-18 11:06:11'),
(708, ':curly_loop:', 'curly_loop', 'Curly Loop', 'normal', '2018-04-18 11:06:11', '2018-04-18 11:06:11'),
(709, ':currency_exchange:', 'currency_exchange', 'Currency Exchange', 'normal', '2018-04-18 11:06:11', '2018-04-18 11:06:11'),
(710, ':customs:', 'customs', 'Customs', 'normal', '2018-04-18 11:06:11', '2018-04-18 11:06:11'),
(711, ':diamond_shape_with_a_dot_inside:', 'diamond_shape_with_a_dot_inside', 'Diamond Shape With A Dot Inside', 'normal', '2018-04-18 11:06:11', '2018-04-18 11:06:11'),
(712, ':do_not_litter:', 'do_not_litter', 'Do Not Litter', 'normal', '2018-04-18 11:06:12', '2018-04-18 11:06:12'),
(713, ':eight:', 'eight', 'Eight', 'normal', '2018-04-18 11:06:12', '2018-04-18 11:06:12'),
(714, ':eight_pointed_black_star:', 'eight_pointed_black_star', 'Eight Pointed Black Star', 'normal', '2018-04-18 11:06:12', '2018-04-18 11:06:12'),
(715, ':eight_spoked_asterisk:', 'eight_spoked_asterisk', 'Eight Spoked Asterisk', 'normal', '2018-04-18 11:06:12', '2018-04-18 11:06:12'),
(716, ':end:', 'end', 'End', 'normal', '2018-04-18 11:06:12', '2018-04-18 11:06:12'),
(717, ':fast_forward:', 'fast_forward', 'Fast Forward', 'normal', '2018-04-18 11:06:12', '2018-04-18 11:06:12'),
(718, ':five:', 'five', 'Five', 'normal', '2018-04-18 11:06:12', '2018-04-18 11:06:12'),
(719, ':four:', 'four', 'Four', 'normal', '2018-04-18 11:06:12', '2018-04-18 11:06:12'),
(720, ':free:', 'free', 'Free', 'normal', '2018-04-18 11:06:12', '2018-04-18 11:06:12'),
(721, ':gemini:', 'gemini', 'Gemini', 'normal', '2018-04-18 11:06:12', '2018-04-18 11:06:12'),
(722, ':hash:', 'hash', 'Hash', 'normal', '2018-04-18 11:06:12', '2018-04-18 11:06:12'),
(723, ':heart_decoration:', 'heart_decoration', 'Heart Decoration', 'normal', '2018-04-18 11:06:12', '2018-04-18 11:06:12'),
(724, ':heavy_check_mark:', 'heavy_check_mark', 'Heavy Check Mark', 'normal', '2018-04-18 11:06:12', '2018-04-18 11:06:12'),
(725, ':heavy_division_sign:', 'heavy_division_sign', 'Heavy Division Sign', 'normal', '2018-04-18 11:06:12', '2018-04-18 11:06:12'),
(726, ':heavy_dollar_sign:', 'heavy_dollar_sign', 'Heavy Dollar Sign', 'normal', '2018-04-18 11:06:12', '2018-04-18 11:06:12'),
(727, ':heavy_minus_sign:', 'heavy_minus_sign', 'Heavy Minus Sign', 'normal', '2018-04-18 11:06:12', '2018-04-18 11:06:12'),
(728, ':heavy_multiplication_x:', 'heavy_multiplication_x', 'Heavy Multiplication X', 'normal', '2018-04-18 11:06:12', '2018-04-18 11:06:12'),
(729, ':heavy_plus_sign:', 'heavy_plus_sign', 'Heavy Plus Sign', 'normal', '2018-04-18 11:06:12', '2018-04-18 11:06:12'),
(730, ':id:', 'id', 'Id', 'normal', '2018-04-18 11:06:12', '2018-04-18 11:06:12'),
(731, ':ideograph_advantage:', 'ideograph_advantage', 'Ideograph Advantage', 'normal', '2018-04-18 11:06:12', '2018-04-18 11:06:12'),
(732, ':information_source:', 'information_source', 'Information Source', 'normal', '2018-04-18 11:06:12', '2018-04-18 11:06:12'),
(733, ':interrobang:', 'interrobang', 'Interrobang', 'normal', '2018-04-18 11:06:12', '2018-04-18 11:06:12'),
(734, ':keycap_ten:', 'keycap_ten', 'Keycap Ten', 'normal', '2018-04-18 11:06:12', '2018-04-18 11:06:12'),
(735, ':koko:', 'koko', 'Koko', 'normal', '2018-04-18 11:06:12', '2018-04-18 11:06:12'),
(736, ':large_blue_circle:', 'large_blue_circle', 'Large Blue Circle', 'normal', '2018-04-18 11:06:12', '2018-04-18 11:06:12'),
(737, ':large_blue_diamond:', 'large_blue_diamond', 'Large Blue Diamond', 'normal', '2018-04-18 11:06:12', '2018-04-18 11:06:12'),
(738, ':large_orange_diamond:', 'large_orange_diamond', 'Large Orange Diamond', 'normal', '2018-04-18 11:06:12', '2018-04-18 11:06:12'),
(739, ':left_luggage:', 'left_luggage', 'Left Luggage', 'normal', '2018-04-18 11:06:12', '2018-04-18 11:06:12'),
(740, ':left_right_arrow:', 'left_right_arrow', 'Left Right Arrow', 'normal', '2018-04-18 11:06:12', '2018-04-18 11:06:12'),
(741, ':leftwards_arrow_with_hook:', 'leftwards_arrow_with_hook', 'Leftwards Arrow With Hook', 'normal', '2018-04-18 11:06:12', '2018-04-18 11:06:12'),
(742, ':leo:', 'leo', 'Leo', 'normal', '2018-04-18 11:06:12', '2018-04-18 11:06:12'),
(743, ':libra:', 'libra', 'Libra', 'normal', '2018-04-18 11:06:12', '2018-04-18 11:06:12'),
(744, ':link:', 'link', 'Link', 'normal', '2018-04-18 11:06:12', '2018-04-18 11:06:12'),
(745, ':m:', 'm', 'M', 'normal', '2018-04-18 11:06:12', '2018-04-18 11:06:12'),
(746, ':mens:', 'mens', 'Mens', 'normal', '2018-04-18 11:06:12', '2018-04-18 11:06:12'),
(747, ':metro:', 'metro', 'Metro', 'normal', '2018-04-18 11:06:12', '2018-04-18 11:06:12'),
(748, ':mobile_phone_off:', 'mobile_phone_off', 'Mobile Phone Off', 'normal', '2018-04-18 11:06:12', '2018-04-18 11:06:12'),
(749, ':negative_squared_cross_mark:', 'negative_squared_cross_mark', 'Negative Squared Cross Mark', 'normal', '2018-04-18 11:06:12', '2018-04-18 11:06:12'),
(750, ':new:', 'new', 'New', 'normal', '2018-04-18 11:06:12', '2018-04-18 11:06:12'),
(751, ':ng:', 'ng', 'Ng', 'normal', '2018-04-18 11:06:13', '2018-04-18 11:06:13'),
(752, ':nine:', 'nine', 'Nine', 'normal', '2018-04-18 11:06:13', '2018-04-18 11:06:13'),
(753, ':no_bicycles:', 'no_bicycles', 'No Bicycles', 'normal', '2018-04-18 11:06:13', '2018-04-18 11:06:13'),
(754, ':no_entry:', 'no_entry', 'No Entry', 'normal', '2018-04-18 11:06:13', '2018-04-18 11:06:13'),
(755, ':no_entry_sign:', 'no_entry_sign', 'No Entry Sign', 'normal', '2018-04-18 11:06:13', '2018-04-18 11:06:13'),
(756, ':no_mobile_phones:', 'no_mobile_phones', 'No Mobile Phones', 'normal', '2018-04-18 11:06:13', '2018-04-18 11:06:13'),
(757, ':no_pedestrians:', 'no_pedestrians', 'No Pedestrians', 'normal', '2018-04-18 11:06:13', '2018-04-18 11:06:13'),
(758, ':no_smoking:', 'no_smoking', 'No Smoking', 'normal', '2018-04-18 11:06:13', '2018-04-18 11:06:13'),
(759, ':non_potable_water:', 'non_potable_water', 'Non Potable Water', 'normal', '2018-04-18 11:06:13', '2018-04-18 11:06:13'),
(760, ':o:', 'o', 'O', 'normal', '2018-04-18 11:06:13', '2018-04-18 11:06:13'),
(761, ':o2:', 'o2', 'O2', 'normal', '2018-04-18 11:06:13', '2018-04-18 11:06:13'),
(762, ':ok:', 'ok', 'Ok', 'normal', '2018-04-18 11:06:13', '2018-04-18 11:06:13'),
(763, ':on:', 'on', 'On', 'normal', '2018-04-18 11:06:13', '2018-04-18 11:06:13'),
(764, ':one:', 'one', 'One', 'normal', '2018-04-18 11:06:13', '2018-04-18 11:06:13'),
(765, ':ophiuchus:', 'ophiuchus', 'Ophiuchus', 'normal', '2018-04-18 11:06:13', '2018-04-18 11:06:13'),
(766, ':parking:', 'parking', 'Parking', 'normal', '2018-04-18 11:06:13', '2018-04-18 11:06:13'),
(767, ':part_alternation_mark:', 'part_alternation_mark', 'Part Alternation Mark', 'normal', '2018-04-18 11:06:13', '2018-04-18 11:06:13'),
(768, ':passport_control:', 'passport_control', 'Passport Control', 'normal', '2018-04-18 11:06:13', '2018-04-18 11:06:13'),
(769, ':pisces:', 'pisces', 'Pisces', 'normal', '2018-04-18 11:06:13', '2018-04-18 11:06:13'),
(770, ':potable_water:', 'potable_water', 'Potable Water', 'normal', '2018-04-18 11:06:13', '2018-04-18 11:06:13'),
(771, ':put_litter_in_its_place:', 'put_litter_in_its_place', 'Put Litter In Its Place', 'normal', '2018-04-18 11:06:13', '2018-04-18 11:06:13'),
(772, ':radio_button:', 'radio_button', 'Radio Button', 'normal', '2018-04-18 11:06:13', '2018-04-18 11:06:13'),
(773, ':recycle:', 'recycle', 'Recycle', 'normal', '2018-04-18 11:06:13', '2018-04-18 11:06:13'),
(774, ':red_circle:', 'red_circle', 'Red Circle', 'normal', '2018-04-18 11:06:13', '2018-04-18 11:06:13'),
(775, ':registered:', 'registered', 'Registered', 'normal', '2018-04-18 11:06:13', '2018-04-18 11:06:13'),
(776, ':repeat:', 'repeat', 'Repeat', 'normal', '2018-04-18 11:06:13', '2018-04-18 11:06:13'),
(777, ':repeat_one:', 'repeat_one', 'Repeat One', 'normal', '2018-04-18 11:06:13', '2018-04-18 11:06:13'),
(778, ':restroom:', 'restroom', 'Restroom', 'normal', '2018-04-18 11:06:13', '2018-04-18 11:06:13'),
(779, ':rewind:', 'rewind', 'Rewind', 'normal', '2018-04-18 11:06:13', '2018-04-18 11:06:13'),
(780, ':sa:', 'sa', 'Sa', 'normal', '2018-04-18 11:06:13', '2018-04-18 11:06:13'),
(781, ':sagittarius:', 'sagittarius', 'Sagittarius', 'normal', '2018-04-18 11:06:13', '2018-04-18 11:06:13'),
(782, ':scorpius:', 'scorpius', 'Scorpius', 'normal', '2018-04-18 11:06:13', '2018-04-18 11:06:13'),
(783, ':secret:', 'secret', 'Secret', 'normal', '2018-04-18 11:06:13', '2018-04-18 11:06:13'),
(784, ':seven:', 'seven', 'Seven', 'normal', '2018-04-18 11:06:13', '2018-04-18 11:06:13'),
(785, ':signal_strength:', 'signal_strength', 'Signal Strength', 'normal', '2018-04-18 11:06:13', '2018-04-18 11:06:13'),
(786, ':six:', 'six', 'Six', 'normal', '2018-04-18 11:06:13', '2018-04-18 11:06:13'),
(787, ':six_pointed_star:', 'six_pointed_star', 'Six Pointed Star', 'normal', '2018-04-18 11:06:13', '2018-04-18 11:06:13'),
(788, ':small_blue_diamond:', 'small_blue_diamond', 'Small Blue Diamond', 'normal', '2018-04-18 11:06:14', '2018-04-18 11:06:14'),
(789, ':small_orange_diamond:', 'small_orange_diamond', 'Small Orange Diamond', 'normal', '2018-04-18 11:06:14', '2018-04-18 11:06:14'),
(790, ':small_red_triangle:', 'small_red_triangle', 'Small Red Triangle', 'normal', '2018-04-18 11:06:14', '2018-04-18 11:06:14'),
(791, ':small_red_triangle_down:', 'small_red_triangle_down', 'Small Red Triangle Down', 'normal', '2018-04-18 11:06:14', '2018-04-18 11:06:14'),
(792, ':soon:', 'soon', 'Soon', 'normal', '2018-04-18 11:06:14', '2018-04-18 11:06:14'),
(793, ':sos:', 'sos', 'Sos', 'normal', '2018-04-18 11:06:14', '2018-04-18 11:06:14'),
(794, ':symbols:', 'symbols', 'Symbols', 'normal', '2018-04-18 11:06:14', '2018-04-18 11:06:14'),
(795, ':taurus:', 'taurus', 'Taurus', 'normal', '2018-04-18 11:06:14', '2018-04-18 11:06:14'),
(796, ':three:', 'three', 'Three', 'normal', '2018-04-18 11:06:14', '2018-04-18 11:06:14'),
(797, ':tm:', 'tm', 'Tm', 'normal', '2018-04-18 11:06:14', '2018-04-18 11:06:14'),
(798, ':top:', 'top', 'Top', 'normal', '2018-04-18 11:06:14', '2018-04-18 11:06:14'),
(799, ':trident:', 'trident', 'Trident', 'normal', '2018-04-18 11:06:14', '2018-04-18 11:06:14'),
(800, ':twisted_rightwards_arrows:', 'twisted_rightwards_arrows', 'Twisted Rightwards Arrows', 'normal', '2018-04-18 11:06:14', '2018-04-18 11:06:14'),
(801, ':two:', 'two', 'Two', 'normal', '2018-04-18 11:06:14', '2018-04-18 11:06:14'),
(802, ':u5272:', 'u5272', 'U5272', 'normal', '2018-04-18 11:06:14', '2018-04-18 11:06:14'),
(803, ':u5408:', 'u5408', 'U5408', 'normal', '2018-04-18 11:06:14', '2018-04-18 11:06:14'),
(804, ':u55b6:', 'u55b6', 'U55b6', 'normal', '2018-04-18 11:06:14', '2018-04-18 11:06:14'),
(805, ':u6307:', 'u6307', 'U6307', 'normal', '2018-04-18 11:06:14', '2018-04-18 11:06:14'),
(806, ':u6708:', 'u6708', 'U6708', 'normal', '2018-04-18 11:06:14', '2018-04-18 11:06:14'),
(807, ':u6709:', 'u6709', 'U6709', 'normal', '2018-04-18 11:06:14', '2018-04-18 11:06:14'),
(808, ':u6e80:', 'u6e80', 'U6e80', 'normal', '2018-04-18 11:06:14', '2018-04-18 11:06:14'),
(809, ':u7121:', 'u7121', 'U7121', 'normal', '2018-04-18 11:06:14', '2018-04-18 11:06:14'),
(810, ':u7533:', 'u7533', 'U7533', 'normal', '2018-04-18 11:06:14', '2018-04-18 11:06:14'),
(811, ':u7981:', 'u7981', 'U7981', 'normal', '2018-04-18 11:06:14', '2018-04-18 11:06:14'),
(812, ':u7a7a:', 'u7a7a', 'U7a7a', 'normal', '2018-04-18 11:06:14', '2018-04-18 11:06:14'),
(813, ':underage:', 'underage', 'Underage', 'normal', '2018-04-18 11:06:14', '2018-04-18 11:06:14'),
(814, ':up:', 'up', 'Up', 'normal', '2018-04-18 11:06:14', '2018-04-18 11:06:14'),
(815, ':vibration_mode:', 'vibration_mode', 'Vibration Mode', 'normal', '2018-04-18 11:06:14', '2018-04-18 11:06:14'),
(816, ':virgo:', 'virgo', 'Virgo', 'normal', '2018-04-18 11:06:14', '2018-04-18 11:06:14'),
(817, ':vs:', 'vs', 'Vs', 'normal', '2018-04-18 11:06:14', '2018-04-18 11:06:14'),
(818, ':wavy_dash:', 'wavy_dash', 'Wavy Dash', 'normal', '2018-04-18 11:06:14', '2018-04-18 11:06:14'),
(819, ':wc:', 'wc', 'Wc', 'normal', '2018-04-18 11:06:14', '2018-04-18 11:06:14'),
(820, ':wheelchair:', 'wheelchair', 'Wheelchair', 'normal', '2018-04-18 11:06:14', '2018-04-18 11:06:14'),
(821, ':white_check_mark:', 'white_check_mark', 'White Check Mark', 'normal', '2018-04-18 11:06:14', '2018-04-18 11:06:14'),
(822, ':white_circle:', 'white_circle', 'White Circle', 'normal', '2018-04-18 11:06:14', '2018-04-18 11:06:14'),
(823, ':white_flower:', 'white_flower', 'White Flower', 'normal', '2018-04-18 11:06:14', '2018-04-18 11:06:14'),
(824, ':white_square_button:', 'white_square_button', 'White Square Button', 'normal', '2018-04-18 11:06:14', '2018-04-18 11:06:14'),
(825, ':womens:', 'womens', 'Womens', 'normal', '2018-04-18 11:06:14', '2018-04-18 11:06:14'),
(826, ':x:', 'x', 'X', 'normal', '2018-04-18 11:06:14', '2018-04-18 11:06:14'),
(827, ':zero:', 'zero', 'Zero', 'normal', '2018-04-18 11:06:15', '2018-04-18 11:06:15'),
(828, ':FeelsBlobMan:', 'FeelsBlobMan', 'FeelsBlobMan', 'blobs', '2018-04-18 12:37:17', '2018-04-18 12:37:17'),
(829, ':b1nzyblob:', 'b1nzyblob', 'b1nzyblob', 'blobs', '2018-04-18 12:37:17', '2018-04-18 12:37:17'),
(830, ':b4nzyblob:', 'b4nzyblob', 'b4nzyblob', 'blobs', '2018-04-18 12:37:17', '2018-04-18 12:37:17'),
(831, ':blob0w0:', 'blob0w0', 'blob0w0', 'blobs', '2018-04-18 12:37:17', '2018-04-18 12:37:17'),
(832, ':blobamused:', 'blobamused', 'blobamused', 'blobs', '2018-04-18 12:37:17', '2018-04-18 12:37:17'),
(833, ':blobangel:', 'blobangel', 'blobangel', 'blobs', '2018-04-18 12:37:17', '2018-04-18 12:37:17'),
(834, ':blobangery:', 'blobangery', 'blobangery', 'blobs', '2018-04-18 12:37:17', '2018-04-18 12:37:17'),
(835, ':blobangry:', 'blobangry', 'blobangry', 'blobs', '2018-04-18 12:37:17', '2018-04-18 12:37:17'),
(836, ':blobastonished:', 'blobastonished', 'blobastonished', 'blobs', '2018-04-18 12:37:17', '2018-04-18 12:37:17'),
(837, ':blobawkward:', 'blobawkward', 'blobawkward', 'blobs', '2018-04-18 12:37:17', '2018-04-18 12:37:17'),
(838, ':blobaww:', 'blobaww', 'blobaww', 'blobs', '2018-04-18 12:37:17', '2018-04-18 12:37:17'),
(839, ':blobbandage:', 'blobbandage', 'blobbandage', 'blobs', '2018-04-18 12:37:17', '2018-04-18 12:37:17'),
(840, ':blobblush:', 'blobblush', 'blobblush', 'blobs', '2018-04-18 12:37:17', '2018-04-18 12:37:17'),
(841, ':blobbowing:', 'blobbowing', 'blobbowing', 'blobs', '2018-04-18 12:37:18', '2018-04-18 12:37:18'),
(842, ':blobcheeky:', 'blobcheeky', 'blobcheeky', 'blobs', '2018-04-18 12:37:18', '2018-04-18 12:37:18'),
(843, ':blobcheer:', 'blobcheer', 'blobcheer', 'blobs', '2018-04-18 12:37:18', '2018-04-18 12:37:18'),
(844, ':blobconfounded:', 'blobconfounded', 'blobconfounded', 'blobs', '2018-04-18 12:37:18', '2018-04-18 12:37:18'),
(845, ':blobconfused:', 'blobconfused', 'blobconfused', 'blobs', '2018-04-18 12:37:18', '2018-04-18 12:37:18'),
(846, ':blobcool:', 'blobcool', 'blobcool', 'blobs', '2018-04-18 12:37:18', '2018-04-18 12:37:18'),
(847, ':blobcouncil:', 'blobcouncil', 'blobcouncil', 'blobs', '2018-04-18 12:37:18', '2018-04-18 12:37:18'),
(848, ':blobcouple:', 'blobcouple', 'blobcouple', 'blobs', '2018-04-18 12:37:18', '2018-04-18 12:37:18'),
(849, ':blobcowboy:', 'blobcowboy', 'blobcowboy', 'blobs', '2018-04-18 12:37:18', '2018-04-18 12:37:18'),
(850, ':blobcry:', 'blobcry', 'blobcry', 'blobs', '2018-04-18 12:37:18', '2018-04-18 12:37:18'),
(851, ':blobdancer:', 'blobdancer', 'blobdancer', 'blobs', '2018-04-18 12:37:18', '2018-04-18 12:37:18'),
(852, ':blobdead:', 'blobdead', 'blobdead', 'blobs', '2018-04-18 12:37:18', '2018-04-18 12:37:18'),
(853, ':blobderpy:', 'blobderpy', 'blobderpy', 'blobs', '2018-04-18 12:37:18', '2018-04-18 12:37:18'),
(854, ':blobdetective:', 'blobdetective', 'blobdetective', 'blobs', '2018-04-18 12:37:18', '2018-04-18 12:37:18'),
(855, ':blobdevil:', 'blobdevil', 'blobdevil', 'blobs', '2018-04-18 12:37:18', '2018-04-18 12:37:18'),
(856, ':blobdizzy:', 'blobdizzy', 'blobdizzy', 'blobs', '2018-04-18 12:37:18', '2018-04-18 12:37:18'),
(857, ':blobdrool:', 'blobdrool', 'blobdrool', 'blobs', '2018-04-18 12:37:18', '2018-04-18 12:37:18'),
(858, ':blobexpressionless:', 'blobexpressionless', 'blobexpressionless', 'blobs', '2018-04-18 12:37:18', '2018-04-18 12:37:18'),
(859, ':blobeyes:', 'blobeyes', 'blobeyes', 'blobs', '2018-04-18 12:37:18', '2018-04-18 12:37:18'),
(860, ':blobfacepalm:', 'blobfacepalm', 'blobfacepalm', 'blobs', '2018-04-18 12:37:18', '2018-04-18 12:37:18'),
(861, ':blobfearful:', 'blobfearful', 'blobfearful', 'blobs', '2018-04-18 12:37:18', '2018-04-18 12:37:18'),
(862, ':blobfistbumpL:', 'blobfistbumpL', 'blobfistbumpL', 'blobs', '2018-04-18 12:37:18', '2018-04-18 12:37:18'),
(863, ':blobfistbumpR:', 'blobfistbumpR', 'blobfistbumpR', 'blobs', '2018-04-18 12:37:18', '2018-04-18 12:37:18'),
(864, ':blobflushed:', 'blobflushed', 'blobflushed', 'blobs', '2018-04-18 12:37:18', '2018-04-18 12:37:18'),
(865, ':blobfrown:', 'blobfrown', 'blobfrown', 'blobs', '2018-04-18 12:37:18', '2018-04-18 12:37:18'),
(866, ':blobfrowning:', 'blobfrowning', 'blobfrowning', 'blobs', '2018-04-18 12:37:18', '2018-04-18 12:37:18'),
(867, ':blobfrowningbig:', 'blobfrowningbig', 'blobfrowningbig', 'blobs', '2018-04-18 12:37:18', '2018-04-18 12:37:18'),
(868, ':blobglare:', 'blobglare', 'blobglare', 'blobs', '2018-04-18 12:37:18', '2018-04-18 12:37:18'),
(869, ':blobgo:', 'blobgo', 'blobgo', 'blobs', '2018-04-18 12:37:18', '2018-04-18 12:37:18'),
(870, ':blobgrin:', 'blobgrin', 'blobgrin', 'blobs', '2018-04-18 12:37:18', '2018-04-18 12:37:18'),
(871, ':blobhammer:', 'blobhammer', 'blobhammer', 'blobs', '2018-04-18 12:37:18', '2018-04-18 12:37:18'),
(872, ':blobhearteyes:', 'blobhearteyes', 'blobhearteyes', 'blobs', '2018-04-18 12:37:18', '2018-04-18 12:37:18'),
(873, ':blobhero:', 'blobhero', 'blobhero', 'blobs', '2018-04-18 12:37:18', '2018-04-18 12:37:18'),
(874, ':blobhighfive:', 'blobhighfive', 'blobhighfive', 'blobs', '2018-04-18 12:37:18', '2018-04-18 12:37:18'),
(875, ':blobhug:', 'blobhug', 'blobhug', 'blobs', '2018-04-18 12:37:18', '2018-04-18 12:37:18'),
(876, ':blobhyperthink:', 'blobhyperthink', 'blobhyperthink', 'blobs', '2018-04-18 12:37:18', '2018-04-18 12:37:18'),
(877, ':blobhyperthinkfast:', 'blobhyperthinkfast', 'blobhyperthinkfast', 'blobs', '2018-04-18 12:37:18', '2018-04-18 12:37:18'),
(878, ':blobhypesquad:', 'blobhypesquad', 'blobhypesquad', 'blobs', '2018-04-18 12:37:18', '2018-04-18 12:37:18'),
(879, ':blobidea:', 'blobidea', 'blobidea', 'blobs', '2018-04-18 12:37:18', '2018-04-18 12:37:18'),
(880, ':blobjoy:', 'blobjoy', 'blobjoy', 'blobs', '2018-04-18 12:37:18', '2018-04-18 12:37:18'),
(881, ':blobkiss:', 'blobkiss', 'blobkiss', 'blobs', '2018-04-18 12:37:18', '2018-04-18 12:37:18'),
(882, ':blobkissblush:', 'blobkissblush', 'blobkissblush', 'blobs', '2018-04-18 12:37:19', '2018-04-18 12:37:19'),
(883, ':blobkissheart:', 'blobkissheart', 'blobkissheart', 'blobs', '2018-04-18 12:37:19', '2018-04-18 12:37:19'),
(884, ':bloblul:', 'bloblul', 'bloblul', 'blobs', '2018-04-18 12:37:19', '2018-04-18 12:37:19'),
(885, ':blobmelt:', 'blobmelt', 'blobmelt', 'blobs', '2018-04-18 12:37:19', '2018-04-18 12:37:19'),
(886, ':blobmoustache:', 'blobmoustache', 'blobmoustache', 'blobs', '2018-04-18 12:37:19', '2018-04-18 12:37:19'),
(887, ':blobnauseated:', 'blobnauseated', 'blobnauseated', 'blobs', '2018-04-18 12:37:19', '2018-04-18 12:37:19'),
(888, ':blobnervous:', 'blobnervous', 'blobnervous', 'blobs', '2018-04-18 12:37:19', '2018-04-18 12:37:19'),
(889, ':blobneutral:', 'blobneutral', 'blobneutral', 'blobs', '2018-04-18 12:37:19', '2018-04-18 12:37:19'),
(890, ':blobninja:', 'blobninja', 'blobninja', 'blobs', '2018-04-18 12:37:19', '2018-04-18 12:37:19'),
(891, ':blobnogood:', 'blobnogood', 'blobnogood', 'blobs', '2018-04-18 12:37:19', '2018-04-18 12:37:19'),
(892, ':blobnom:', 'blobnom', 'blobnom', 'blobs', '2018-04-18 12:37:19', '2018-04-18 12:37:19'),
(893, ':blobnomcookie:', 'blobnomcookie', 'blobnomcookie', 'blobs', '2018-04-18 12:37:19', '2018-04-18 12:37:19'),
(894, ':blobnomouth:', 'blobnomouth', 'blobnomouth', 'blobs', '2018-04-18 12:37:19', '2018-04-18 12:37:19'),
(895, ':blobok:', 'blobok', 'blobok', 'blobs', '2018-04-18 12:37:19', '2018-04-18 12:37:19'),
(896, ':blobokhand:', 'blobokhand', 'blobokhand', 'blobs', '2018-04-18 12:37:19', '2018-04-18 12:37:19'),
(897, ':blobonfire:', 'blobonfire', 'blobonfire', 'blobs', '2018-04-18 12:37:19', '2018-04-18 12:37:19'),
(898, ':blobopenmouth:', 'blobopenmouth', 'blobopenmouth', 'blobs', '2018-04-18 12:37:19', '2018-04-18 12:37:19'),
(899, ':bloboro:', 'bloboro', 'bloboro', 'blobs', '2018-04-18 12:37:19', '2018-04-18 12:37:19'),
(900, ':bloboutage:', 'bloboutage', 'bloboutage', 'blobs', '2018-04-18 12:37:19', '2018-04-18 12:37:19'),
(901, ':blobowo:', 'blobowo', 'blobowo', 'blobs', '2018-04-18 12:37:19', '2018-04-18 12:37:19'),
(902, ':blobowoevil:', 'blobowoevil', 'blobowoevil', 'blobs', '2018-04-18 12:37:19', '2018-04-18 12:37:19'),
(903, ':blobparty:', 'blobparty', 'blobparty', 'blobs', '2018-04-18 12:37:19', '2018-04-18 12:37:19'),
(904, ':blobpatrol:', 'blobpatrol', 'blobpatrol', 'blobs', '2018-04-18 12:37:19', '2018-04-18 12:37:19'),
(905, ':blobpats:', 'blobpats', 'blobpats', 'blobs', '2018-04-18 12:37:19', '2018-04-18 12:37:19'),
(906, ':blobpeek:', 'blobpeek', 'blobpeek', 'blobs', '2018-04-18 12:37:19', '2018-04-18 12:37:19'),
(907, ':blobpensive:', 'blobpensive', 'blobpensive', 'blobs', '2018-04-18 12:37:19', '2018-04-18 12:37:19'),
(908, ':blobpin:', 'blobpin', 'blobpin', 'blobs', '2018-04-18 12:37:19', '2018-04-18 12:37:19'),
(909, ':blobpolice:', 'blobpolice', 'blobpolice', 'blobs', '2018-04-18 12:37:19', '2018-04-18 12:37:19'),
(910, ':blobpoliceangry:', 'blobpoliceangry', 'blobpoliceangry', 'blobs', '2018-04-18 12:37:19', '2018-04-18 12:37:19'),
(911, ':blobpray:', 'blobpray', 'blobpray', 'blobs', '2018-04-18 12:37:19', '2018-04-18 12:37:19'),
(912, ':blobrofl:', 'blobrofl', 'blobrofl', 'blobs', '2018-04-18 12:37:19', '2018-04-18 12:37:19'),
(913, ':blobrollingeyes:', 'blobrollingeyes', 'blobrollingeyes', 'blobs', '2018-04-18 12:37:19', '2018-04-18 12:37:19'),
(914, ':blobross:', 'blobross', 'blobross', 'blobs', '2018-04-18 12:37:19', '2018-04-18 12:37:19'),
(915, ':blobsad:', 'blobsad', 'blobsad', 'blobs', '2018-04-18 12:37:19', '2018-04-18 12:37:19'),
(916, ':blobsalute:', 'blobsalute', 'blobsalute', 'blobs', '2018-04-18 12:37:19', '2018-04-18 12:37:19'),
(917, ':blobscream:', 'blobscream', 'blobscream', 'blobs', '2018-04-18 12:37:19', '2018-04-18 12:37:19'),
(918, ':blobshrug:', 'blobshrug', 'blobshrug', 'blobs', '2018-04-18 12:37:19', '2018-04-18 12:37:19'),
(919, ':blobsleeping:', 'blobsleeping', 'blobsleeping', 'blobs', '2018-04-18 12:37:19', '2018-04-18 12:37:19'),
(920, ':blobsleepless:', 'blobsleepless', 'blobsleepless', 'blobs', '2018-04-18 12:37:20', '2018-04-18 12:37:20'),
(921, ':blobsmile:', 'blobsmile', 'blobsmile', 'blobs', '2018-04-18 12:37:20', '2018-04-18 12:37:20'),
(922, ':blobsmilehappy:', 'blobsmilehappy', 'blobsmilehappy', 'blobs', '2018-04-18 12:37:20', '2018-04-18 12:37:20'),
(923, ':blobsmilehappyeyes:', 'blobsmilehappyeyes', 'blobsmilehappyeyes', 'blobs', '2018-04-18 12:37:20', '2018-04-18 12:37:20'),
(924, ':blobsmileopenmouth:', 'blobsmileopenmouth', 'blobsmileopenmouth', 'blobs', '2018-04-18 12:37:20', '2018-04-18 12:37:20'),
(925, ':blobsmileopenmouth2:', 'blobsmileopenmouth2', 'blobsmileopenmouth2', 'blobs', '2018-04-18 12:37:20', '2018-04-18 12:37:20'),
(926, ':blobsmilesweat:', 'blobsmilesweat', 'blobsmilesweat', 'blobs', '2018-04-18 12:37:20', '2018-04-18 12:37:20'),
(927, ':blobsmilesweat2:', 'blobsmilesweat2', 'blobsmilesweat2', 'blobs', '2018-04-18 12:37:20', '2018-04-18 12:37:20'),
(928, ':blobsmiley:', 'blobsmiley', 'blobsmiley', 'blobs', '2018-04-18 12:37:20', '2018-04-18 12:37:20'),
(929, ':blobsmirk:', 'blobsmirk', 'blobsmirk', 'blobs', '2018-04-18 12:37:20', '2018-04-18 12:37:20'),
(930, ':blobsneezing:', 'blobsneezing', 'blobsneezing', 'blobs', '2018-04-18 12:37:20', '2018-04-18 12:37:20'),
(931, ':blobsnuggle:', 'blobsnuggle', 'blobsnuggle', 'blobs', '2018-04-18 12:37:20', '2018-04-18 12:37:20'),
(932, ':blobsob:', 'blobsob', 'blobsob', 'blobs', '2018-04-18 12:37:20', '2018-04-18 12:37:20'),
(933, ':blobsplosion:', 'blobsplosion', 'blobsplosion', 'blobs', '2018-04-18 12:37:20', '2018-04-18 12:37:20'),
(934, ':blobspy:', 'blobspy', 'blobspy', 'blobs', '2018-04-18 12:37:20', '2018-04-18 12:37:20'),
(935, ':blobstop:', 'blobstop', 'blobstop', 'blobs', '2018-04-18 12:37:20', '2018-04-18 12:37:20'),
(936, ':blobsunglasses:', 'blobsunglasses', 'blobsunglasses', 'blobs', '2018-04-18 12:37:20', '2018-04-18 12:37:20'),
(937, ':blobsurprised:', 'blobsurprised', 'blobsurprised', 'blobs', '2018-04-18 12:37:20', '2018-04-18 12:37:20'),
(938, ':blobsweats:', 'blobsweats', 'blobsweats', 'blobs', '2018-04-18 12:37:20', '2018-04-18 12:37:20'),
(939, ':blobteefs:', 'blobteefs', 'blobteefs', 'blobs', '2018-04-18 12:37:20', '2018-04-18 12:37:20'),
(940, ':blobthinking:', 'blobthinking', 'blobthinking', 'blobs', '2018-04-18 12:37:20', '2018-04-18 12:37:20'),
(941, ':blobthinkingcool:', 'blobthinkingcool', 'blobthinkingcool', 'blobs', '2018-04-18 12:37:20', '2018-04-18 12:37:20'),
(942, ':blobthinkingdown:', 'blobthinkingdown', 'blobthinkingdown', 'blobs', '2018-04-18 12:37:20', '2018-04-18 12:37:20'),
(943, ':blobthinkingeyes:', 'blobthinkingeyes', 'blobthinkingeyes', 'blobs', '2018-04-18 12:37:20', '2018-04-18 12:37:20'),
(944, ':blobthinkingfast:', 'blobthinkingfast', 'blobthinkingfast', 'blobs', '2018-04-18 12:37:20', '2018-04-18 12:37:20'),
(945, ':blobthinkingglare:', 'blobthinkingglare', 'blobthinkingglare', 'blobs', '2018-04-18 12:37:20', '2018-04-18 12:37:20'),
(946, ':blobthinkingsmirk:', 'blobthinkingsmirk', 'blobthinkingsmirk', 'blobs', '2018-04-18 12:37:20', '2018-04-18 12:37:20'),
(947, ':blobthonkang:', 'blobthonkang', 'blobthonkang', 'blobs', '2018-04-18 12:37:20', '2018-04-18 12:37:20'),
(948, ':blobthumbsdown:', 'blobthumbsdown', 'blobthumbsdown', 'blobs', '2018-04-18 12:37:20', '2018-04-18 12:37:20'),
(949, ':blobthumbsup:', 'blobthumbsup', 'blobthumbsup', 'blobs', '2018-04-18 12:37:20', '2018-04-18 12:37:20'),
(950, ':blobtilt:', 'blobtilt', 'blobtilt', 'blobs', '2018-04-18 12:37:20', '2018-04-18 12:37:20'),
(951, ':blobtired:', 'blobtired', 'blobtired', 'blobs', '2018-04-18 12:37:20', '2018-04-18 12:37:20'),
(952, ':blobtongue:', 'blobtongue', 'blobtongue', 'blobs', '2018-04-18 12:37:20', '2018-04-18 12:37:20'),
(953, ':blobtonguewink:', 'blobtonguewink', 'blobtonguewink', 'blobs', '2018-04-18 12:37:20', '2018-04-18 12:37:20'),
(954, ':blobtriumph:', 'blobtriumph', 'blobtriumph', 'blobs', '2018-04-18 12:37:20', '2018-04-18 12:37:20'),
(955, ':blobugh:', 'blobugh', 'blobugh', 'blobs', '2018-04-18 12:37:20', '2018-04-18 12:37:20'),
(956, ':blobunamused:', 'blobunamused', 'blobunamused', 'blobs', '2018-04-18 12:37:20', '2018-04-18 12:37:20'),
(957, ':blobunsure:', 'blobunsure', 'blobunsure', 'blobs', '2018-04-18 12:37:20', '2018-04-18 12:37:20'),
(958, ':blobupset:', 'blobupset', 'blobupset', 'blobs', '2018-04-18 12:37:20', '2018-04-18 12:37:20'),
(959, ':blobupsidedown:', 'blobupsidedown', 'blobupsidedown', 'blobs', '2018-04-18 12:37:20', '2018-04-18 12:37:20'),
(960, ':blobuwu:', 'blobuwu', 'blobuwu', 'blobs', '2018-04-18 12:37:21', '2018-04-18 12:37:21'),
(961, ':blobwaitwhat:', 'blobwaitwhat', 'blobwaitwhat', 'blobs', '2018-04-18 12:37:21', '2018-04-18 12:37:21'),
(962, ':blobwave:', 'blobwave', 'blobwave', 'blobs', '2018-04-18 12:37:21', '2018-04-18 12:37:21'),
(963, ':blobwavereverse:', 'blobwavereverse', 'blobwavereverse', 'blobs', '2018-04-18 12:37:21', '2018-04-18 12:37:21'),
(964, ':blobweary:', 'blobweary', 'blobweary', 'blobs', '2018-04-18 12:37:21', '2018-04-18 12:37:21'),
(965, ':blobwhistle:', 'blobwhistle', 'blobwhistle', 'blobs', '2018-04-18 12:37:21', '2018-04-18 12:37:21'),
(966, ':blobwink:', 'blobwink', 'blobwink', 'blobs', '2018-04-18 12:37:21', '2018-04-18 12:37:21'),
(967, ':blobwoah:', 'blobwoah', 'blobwoah', 'blobs', '2018-04-18 12:37:21', '2018-04-18 12:37:21'),
(968, ':blobxd:', 'blobxd', 'blobxd', 'blobs', '2018-04-18 12:37:21', '2018-04-18 12:37:21'),
(969, ':blobyum:', 'blobyum', 'blobyum', 'blobs', '2018-04-18 12:37:21', '2018-04-18 12:37:21'),
(970, ':blobzippermouth:', 'blobzippermouth', 'blobzippermouth', 'blobs', '2018-04-18 12:37:21', '2018-04-18 12:37:21'),
(971, ':bolb', 'bolb', 'bolb', 'normal', '2018-04-18 12:37:21', '2018-04-18 12:37:21'),
(972, ':doggoblob:', 'doggoblob', 'doggoblob', 'blobs', '2018-04-18 12:37:21', '2018-04-18 12:37:21');
INSERT INTO `emoji` (`id`, `value`, `code`, `text`, `emoji_type`, `created_at`, `updated_at`) VALUES
(973, ':gentleblob:', 'gentleblob', 'gentleblob', 'blobs', '2018-04-18 12:37:21', '2018-04-18 12:37:21'),
(974, ':googlebee', 'googlebee', 'googlebee', 'normal', '2018-04-18 12:37:21', '2018-04-18 12:37:21'),
(975, ':googleblueheart', 'googleblueheart', 'googleblueheart', 'normal', '2018-04-18 12:37:21', '2018-04-18 12:37:21'),
(976, ':googlecake', 'googlecake', 'googlecake', 'normal', '2018-04-18 12:37:21', '2018-04-18 12:37:21'),
(977, ':googlecat', 'googlecat', 'googlecat', 'normal', '2018-04-18 12:37:21', '2018-04-18 12:37:21'),
(978, ':googlecatface', 'googlecatface', 'googlecatface', 'normal', '2018-04-18 12:37:21', '2018-04-18 12:37:21'),
(979, ':googlecatheart', 'googlecatheart', 'googlecatheart', 'normal', '2018-04-18 12:37:21', '2018-04-18 12:37:21'),
(980, ':googledog', 'googledog', 'googledog', 'normal', '2018-04-18 12:37:21', '2018-04-18 12:37:21'),
(981, ':googlefire', 'googlefire', 'googlefire', 'normal', '2018-04-18 12:37:21', '2018-04-18 12:37:21'),
(982, ':googleghost', 'googleghost', 'googleghost', 'normal', '2018-04-18 12:37:21', '2018-04-18 12:37:21'),
(983, ':googlegun', 'googlegun', 'googlegun', 'normal', '2018-04-18 12:37:21', '2018-04-18 12:37:21'),
(984, ':googlemuscleL', 'googlemuscleL', 'googlemuscleL', 'normal', '2018-04-18 12:37:21', '2018-04-18 12:37:21'),
(985, ':googlemuscleR', 'googlemuscleR', 'googlemuscleR', 'normal', '2018-04-18 12:37:21', '2018-04-18 12:37:21'),
(986, ':googlepenguin', 'googlepenguin', 'googlepenguin', 'normal', '2018-04-18 12:37:21', '2018-04-18 12:37:21'),
(987, ':googlerabbit', 'googlerabbit', 'googlerabbit', 'normal', '2018-04-18 12:37:21', '2018-04-18 12:37:21'),
(988, ':googleredheart', 'googleredheart', 'googleredheart', 'normal', '2018-04-18 12:37:21', '2018-04-18 12:37:21'),
(989, ':googlesheep', 'googlesheep', 'googlesheep', 'normal', '2018-04-18 12:37:21', '2018-04-18 12:37:21'),
(990, ':googlesnake', 'googlesnake', 'googlesnake', 'normal', '2018-04-18 12:37:21', '2018-04-18 12:37:21'),
(991, ':googleturtle', 'googleturtle', 'googleturtle', 'normal', '2018-04-18 12:37:21', '2018-04-18 12:37:21'),
(992, ':googlewhale', 'googlewhale', 'googlewhale', 'normal', '2018-04-18 12:37:21', '2018-04-18 12:37:21'),
(993, ':jakeblob:', 'jakeblob', 'jakeblob', 'blobs', '2018-04-18 12:37:21', '2018-04-18 12:37:21'),
(994, ':kirblob:', 'kirblob', 'kirblob', 'blobs', '2018-04-18 12:37:21', '2018-04-18 12:37:21'),
(995, ':nellyblob:', 'nellyblob', 'nellyblob', 'blobs', '2018-04-18 12:37:21', '2018-04-18 12:37:21'),
(996, ':nikoblob:', 'nikoblob', 'nikoblob', 'blobs', '2018-04-18 12:37:21', '2018-04-18 12:37:21'),
(997, ':photoblob:', 'photoblob', 'photoblob', 'blobs', '2018-04-18 12:37:21', '2018-04-18 12:37:21'),
(998, ':pikablob:', 'pikablob', 'pikablob', 'blobs', '2018-04-18 12:37:21', '2018-04-18 12:37:21'),
(999, ':pusheenblob:', 'pusheenblob', 'pusheenblob', 'blobs', '2018-04-18 12:37:21', '2018-04-18 12:37:21'),
(1000, ':rainblob:', 'rainblob', 'rainblob', 'blobs', '2018-04-18 12:37:22', '2018-04-18 12:37:22'),
(1001, ':rickblob:', 'rickblob', 'rickblob', 'blobs', '2018-04-18 12:37:22', '2018-04-18 12:37:22'),
(1002, ':thinkingwithblobs:', 'thinkingwithblobs', 'thinkingwithblobs', 'blobs', '2018-04-18 12:37:22', '2018-04-18 12:37:22'),
(1003, ':wolfiriblob:', 'wolfiriblob', 'wolfiriblob', 'blobs', '2018-04-18 12:37:22', '2018-04-18 12:37:22'),
(1004, ':wumpusblob:', 'wumpusblob', 'wumpusblob', 'blobs', '2018-04-18 12:37:22', '2018-04-18 12:37:22');

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` int(10) UNSIGNED NOT NULL,
  `board_id` int(10) UNSIGNED NOT NULL,
  `thread_id` int(10) UNSIGNED NOT NULL,
  `op_img` tinyint(1) DEFAULT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `file_hash` text,
  `file_name` text NOT NULL,
  `file_name_only` text,
  `file_type` tinytext,
  `original_name` text NOT NULL,
  `size` int(11) NOT NULL,
  `pixels` varchar(255) NOT NULL,
  `photo_type` varchar(40) NOT NULL DEFAULT 'image',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `is_thread` tinyint(1) DEFAULT NULL,
  `spoiler` tinyint(1) DEFAULT NULL,
  `board_id` int(10) UNSIGNED NOT NULL,
  `thread_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `has_file` tinyint(1) DEFAULT NULL,
  `content` text,
  `email` text,
  `subject` text,
  `user_name` varchar(255) DEFAULT 'Anonymous',
  `password` text,
  `ip` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `reason` text,
  `ip` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `value` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `title`, `value`, `created_at`, `updated_at`) VALUES
(1, 'site_title', 'My Imageboard', '2018-10-31 17:39:19', '2018-10-31 17:39:19'),
(2, 'site_description', NULL, '2018-10-31 17:47:06', '2018-10-31 17:47:06'),
(3, 'site_keyword', NULL, '2018-10-31 17:49:20', '2018-10-31 17:49:20'),
(4, 'enable_recaptcha', '0', '2018-10-31 17:49:20', '2018-10-31 17:49:20'),
(5, 'recaptcha_key', '', '2018-10-31 17:49:20', '2018-10-31 17:49:20'),
(6, 'recaptcha_secret', '', '2018-10-31 17:49:20', '2018-10-31 17:49:20'),
(7, 'maintenance', NULL, '2018-10-31 17:49:20', '2018-10-31 17:49:20'),
(8, 'footer', 'All trademarks and copyrights on this page are owned by their respective parties. Images uploaded are the responsibility of the Poster. Comments are owned by the Poster.', '2018-10-31 17:50:34', '2018-10-31 17:50:34');

-- --------------------------------------------------------

--
-- Table structure for table `threads`
--

CREATE TABLE `threads` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` text,
  `board_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL,
  `is_admin` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bans`
--
ALTER TABLE `bans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `boards`
--
ALTER TABLE `boards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emoji`
--
ALTER TABLE `emoji`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `photos_thread_id_foreign` (`thread_id`),
  ADD KEY `photos_post_id_foreign` (`post_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_board_id_foreign` (`board_id`),
  ADD KEY `posts_thread_id_foreign` (`thread_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `threads`
--
ALTER TABLE `threads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `threads_board_id_foreign` (`board_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bans`
--
ALTER TABLE `bans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `boards`
--
ALTER TABLE `boards`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `emoji`
--
ALTER TABLE `emoji`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1005;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `threads`
--
ALTER TABLE `threads`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `photos_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `photos_thread_id_foreign` FOREIGN KEY (`thread_id`) REFERENCES `threads` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_board_id_foreign` FOREIGN KEY (`board_id`) REFERENCES `boards` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `posts_thread_id_foreign` FOREIGN KEY (`thread_id`) REFERENCES `threads` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `threads`
--
ALTER TABLE `threads`
  ADD CONSTRAINT `threads_board_id_foreign` FOREIGN KEY (`board_id`) REFERENCES `boards` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
