-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2015 at 10:56 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `boardgamegeek`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(6, 'Board Game'),
(7, 'Card Game');

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE IF NOT EXISTS `games` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `min_num_players` int(11) NOT NULL,
  `max_num_players` int(11) NOT NULL,
  `min_play_minutes` int(11) NOT NULL,
  `max_play_minutes` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`id`, `name`, `description`, `min_num_players`, `max_num_players`, `min_play_minutes`, `max_play_minutes`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'Catan', '<p>In <span style="font-weight: bold;">Catan </span>(formerly the Settlers of <span style="font-weight: bold;">Catan</span>), players try to be the dominant force on the island of Catan by building settlements, cities, and roads. On each turn dice are rolled to determine what resources the island produces. Players collect these resources (cards) - wood, grain, brick, sheep, or stone - to build up their civilizations to get to 10 victory points and win the game.</p>\r\n\r\n<p>Setup includes randomly placing large hexagonal tiles (each showing a resource or the desert) in a honeycomb shape and surrounding them with water tiles, some of which contain ports of exchange. Number disks, which will correspond to die rolls (two 6-sided dice are used), are placed on each resource tile. Each player is given two settlements (think: houses) and roads (sticks) which are, in turn, placed on intersections and borders of the resource tiles. Players collect a hand of resource cards based on which hex tiles their last-placed house is adjacent to. A robber pawn is placed on the desert tile.</p>\r\n\r\n<p>A turn consists of possibly playing a development card, rolling the dice, everyone (perhaps) collecting resource cards based on the roll and position of houses (or upgraded cities - think: hotels) unless a 7 is rolled, turning in resource cards (if possible and desired) for improvements, trading cards at a port, and trading resource cards with other players. If a 7 is rolled, the active player moves the robber to a new hex tile and steals resource cards from other players who have built structures adjacent to that tile.</p>\r\n\r\n<p>Points are accumulated by building settlements and cities, having the longest road and the largest army (from some of the development cards), and gathering certain development cards that simply award victory points. When a player has gathered 10 points (some of which may be held in secret), he announces his total and claims the win.</p>\r\n\r\n<p>Catan has won multiple awards and is one of the most popular games in recent history due to its amazing ability to appeal to experienced gamers as well as those new to the hobby.</p>\r\n\r\n<p>Die Siedler von Catan was originally published by Kosmos and has gone through multiple editions. It was licensed by Mayfair and has undergone four editions as The Settlers of Catan. In 2015, it was formally renamed Catan to better represent itself as the core and base game of the Catan series. It has been re-published in two travel editions, portable edition and compact edition, as a special gallery edition (replaced in 2009 with a family edition), as an anniversary wooden edition, as a deluxe 3D collector''s edition, in the basic Simply Catan, as a beginner version, and with an entirely new theme in Japan and Asia as Settlers of Catan: Rockman Edition. Numerous spin-offs and expansions have also been made for the game.</p>\r\n\r\n<p>The Settlers of Catan is the original game in the Catan Series.</p>', 3, 4, 60, 120, 6, '2015-11-13 17:51:00', '2015-11-27 21:55:59'),
(27, 'Bohnanza', '<p style="margin-top: 10px; padding: 0px; font-family: verdana, ''lucida grande'', arial, sans-serif; font-size: 12px; line-height: 14.772px;"><strong style="font-style: inherit;">Bohnanza</strong>&nbsp;is the first in the&nbsp;<a class="" href="https://boardgamegeek.com/wiki/page/Bohnanza_series#" style="color: rgb(0, 0, 136);">Bohnanza family</a>&nbsp;of games and has been published in&nbsp;<a class="" href="https://boardgamegeek.com/wiki/page/Bohnanza_editions#" style="color: rgb(0, 0, 136);">several different editions</a>.</p><p style="margin-top: 10px; padding: 0px; font-family: verdana, ''lucida grande'', arial, sans-serif; font-size: 12px; line-height: 14.772px;">As card games go, this one is quite revolutionary. Perhaps its oddest feature is that you cannot rearrange your hand, as you need to play the cards in the order that you draw them. The cards are colorful depictions of beans in various descriptive poses, and the object is to make coins by planting fields (sets) of these beans and then harvesting them. To help players match their cards up, the game features extensive trading and deal making.</p><p style="margin-top: 10px; padding: 0px; font-family: verdana, ''lucida grande'', arial, sans-serif; font-size: 12px; line-height: 14.772px;">The original German edition supports 3-5 players.</p><p style="margin-top: 10px; padding: 0px; font-family: verdana, ''lucida grande'', arial, sans-serif; font-size: 12px; line-height: 14.772px;">The newest English version is from&nbsp;<a href="https://boardgamegeek.com/boardgamepublisher/3/rio-grande-games" style="color: rgb(0, 0, 136);">Rio Grande Games</a>&nbsp;and it comes with the&nbsp;<a href="https://boardgamegeek.com/boardgameexpansion/467/bohnanza-erweiterungs-set" style="color: rgb(0, 0, 136);">first edition of the first German expansion</a>&nbsp;included in a slightly oversized box. One difference in the contents, however, is that bean #22''s&nbsp;<em style="font-weight: inherit;">Weinbrandbohne</em>&nbsp;(Brandy Bean) was replaced by the&nbsp;<em style="font-weight: inherit;">Wachsbohne</em>, or Wax Bean. This edition includes rules for up to seven players, like the&nbsp;<em style="font-weight: inherit;"><a href="https://boardgamegeek.com/boardgameexpansion/467/bohnanza-erweiterungs-set" style="color: rgb(0, 0, 136);">Erweiterungs-Set</a></em>, but also adapts the two-player rules of&nbsp;<em style="font-weight: inherit;"><a href="https://boardgamegeek.com/boardgame/980/al-cabohne" style="color: rgb(0, 0, 136);">Al Cabohne</a></em>&nbsp;in order to allow two people to play&nbsp;<em style="font-weight: inherit;">Bohnanza</em>.</p>', 2, 7, 45, 45, 7, '2015-11-27 21:55:20', '2015-11-27 21:55:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
