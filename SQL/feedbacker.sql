-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 02, 2010 at 05:50 PM
-- Server version: 5.1.36
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hack`
--

-- --------------------------------------------------------

--
-- Table structure for table `feedback_ideas`
--

CREATE TABLE IF NOT EXISTS `feedback_ideas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `idea` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `votes` int(11) unsigned NOT NULL DEFAULT '1',
  `comments` int(11) NOT NULL DEFAULT '0',
  `auth_id` bigint(20) unsigned NOT NULL,
  `sub_date` datetime NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `admin_id` bigint(20) NOT NULL,
  `admin_comment` longtext NOT NULL,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `description` (`idea`,`description`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `feedback_ideas`
--

INSERT INTO `feedback_ideas` (`id`, `idea`, `description`, `votes`, `comments`, `auth_id`, `sub_date`, `status`, `admin_id`, `admin_comment`) VALUES
(1, 'allow us to sell apps with real money!', 'His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What''s happened to me? " he thought. It wasn''t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls\r\nHis many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What''s happened to me? " he thought. It wasn''t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls', 5516, 1231, 1, '2009-12-28 21:02:02', 3, 1, 'Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione'),
(2, 'make 10k the start sum of money', 'Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur?\r\n\r\nQuis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\r\n\r\nAt vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.\r\n\r\nEt harum quidem rerum facilis est et expedita distinctio.', 324712, 123213, 2, '2009-12-29 00:22:02', 2, 1, 'To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it?'),
(3, 'make the stats visible', 'Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.\r\n\r\nSed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione ', 316411, 3215, 3, '2009-12-29 00:22:44', 1, 1, 'Amazingly few discotheques provide jukeboxes. My girl wove six dozen plaid jackets before she quit. Six big devils from Japan quickly forgot how to waltz.'),
(4, 'make more banks', 'A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.\r\n\r\nEven the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.\r\n\r\nThe Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen.', 65286, 89897, 2, '2009-12-28 00:25:58', 0, 1, 'Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur?'),
(5, 'i want hardware', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.\r\n\r\nSeparated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.', 389, 21, 5, '2009-12-20 00:26:38', 4, 1, 'No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful.'),
(6, 'I have this crazy idea let''s fuck', ' The bedding was hardly able to cover it and seemed ready to slide off any moment.\r\n\r\nHis many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What''s happened to me? " he thought.\r\n\r\nIt wasn''t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls.\r\n\r\nA collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.', 57, 200, 6, '2009-12-20 00:38:45', 0, 0, ''),
(7, 'qw easd as', 'd zsd zxc asdasd', 178, 123324, 1, '2009-12-20 01:27:48', 4, 0, ''),
(8, 'w eqwe qwe asd ', 'zsd z casdaas', 67, 3, 2, '2009-12-20 00:26:38', 3, 0, ''),
(9, ' awe asdas', 'd aqw easdqwe', 100016, 1231, 2, '2009-12-28 00:25:58', 2, 0, ''),
(10, 'qweqweqw easdasd', 'we asd qweqwe', 389, 3, 1, '2009-12-29 00:22:44', 4, 0, ''),
(11, 'qweqwe asd asd zxczx', 'fdg er tdf gdfgert', 79, 342, 2, '2009-12-28 21:02:02', 3, 0, ''),
(12, 'qwe qwe a', 'w edasd asd asdas', 5509, 345, 3, '2009-12-30 00:26:38', 6, 0, ''),
(13, 'i want to fuck you biatch', 'giceste ce', 9, 0, 0, '2010-01-06 20:48:57', 0, 0, ''),
(14, 'i want to fuck you biatch', 'giceste ce', 8, 0, 0, '2010-01-06 20:49:01', 0, 0, ''),
(15, 'i wish i would be taller', '<p> His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What''s happened to me? " he thought.</p><p> It wasn''t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls.</p><p> A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.</p><p> It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer.</p>', 2, 0, 0, '2010-01-06 20:53:26', 0, 0, ''),
(16, 'fuck', 'sad', 1, 0, 0, '2010-01-06 20:54:48', 0, 0, ''),
(17, 'ma ma lasi', 'sadweqwe qwe qwe', 1, 0, 0, '2010-01-06 20:54:58', 0, 0, ''),
(18, 'ba boule', 'sadweqwe qwe qwe', 1, 0, 0, '2010-01-06 20:55:41', 0, 0, ''),
(19, 'prostule ce esti', 'sugi pula', 2, 0, 0, '2010-01-06 20:59:44', 1, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `feedback_votes`
--

CREATE TABLE IF NOT EXISTS `feedback_votes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `idea_id` bigint(20) NOT NULL,
  `voter_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=63 ;

--
-- Dumping data for table `feedback_votes`
--

INSERT INTO `feedback_votes` (`id`, `idea_id`, `voter_id`) VALUES
(1, 11, 0),
(2, 8, 0),
(3, 11, 0),
(4, 11, 0),
(5, 9, 0),
(6, 1, 0),
(7, 3, 0),
(8, 4, 0),
(9, 2, 0),
(10, 2, 0),
(11, 3, 0),
(12, 4, 0),
(13, 1, 0),
(14, 9, 0),
(15, 11, 0),
(16, 8, 0),
(17, 6, 0),
(18, 11, 0),
(19, 8, 0),
(20, 6, 0),
(21, 9, 0),
(22, 1, 0),
(23, 4, 0),
(24, 3, 0),
(25, 2, 0),
(26, 1, 0),
(27, 9, 0),
(28, 11, 0),
(29, 8, 0),
(30, 6, 0),
(31, 9, 0),
(32, 11, 0),
(33, 8, 0),
(34, 9, 0),
(35, 9, 0),
(36, 4, 0),
(37, 3, 0),
(38, 2, 0),
(39, 1, 0),
(40, 6, 0),
(41, 8, 0),
(42, 11, 0),
(43, 3, 0),
(44, 3, 0),
(45, 1, 0),
(46, 13, 0),
(47, 14, 0),
(48, 13, 0),
(49, 14, 0),
(50, 13, 0),
(51, 14, 0),
(52, 13, 0),
(53, 14, 0),
(54, 13, 0),
(55, 2, 0),
(56, 3, 0),
(57, 2, 0),
(58, 2, 0),
(59, 3, 0),
(60, 15, 0),
(61, 19, 0),
(62, 11, 0);
