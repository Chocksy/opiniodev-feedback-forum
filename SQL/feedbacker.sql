/*
SQLyog Ultimate - MySQL GUI v8.22 
MySQL - 5.1.36-community-log : Database - feedbacker
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `feedback_comments` */

CREATE TABLE `feedback_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idea_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` longtext NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

/*Data for the table `feedback_comments` */

insert  into `feedback_comments`(`id`,`idea_id`,`user_id`,`comment`,`date`) values (1,2,2,'sexy motherfucker here sir','2010-02-21 01:44:00'),(2,2,2,'I want to fuck you so bad motherfucker','2010-02-21 02:01:26'),(3,2,2,'I want to know you better so tell me more','2010-02-21 02:03:17'),(4,2,2,'One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin.He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment.His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. &#34;What&#39;s happened to me? &#34; he thought. It wasn&#39;t a dream.His room, a proper human room although a little too small, lay peacefully between its four familiar walls.','2010-02-21 02:03:38'),(5,2,2,'One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin.He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment.His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. &#34;What&#39;s happened to me? &#34; he thought. It wasn&#39;t a dream.His room, a proper human room although a little too small, lay peacefully between its four familiar walls.A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad.&#34;How about if I sleep a little bit longer and forget all this nonsense&#34;, he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn&#39;t get into that position. However hard he threw himself onto his right, he always rolled back to where he was.He must have tried it a hundred times, shut his eyes so that he wouldn&#39;t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. &#34;Oh, God&#34;, he thought, &#34;what a strenuous career it is that I&#39;ve chosen! Travelling day in and day out. ','2010-02-21 02:04:00'),(6,2,4,'Hai sa facem un test si cu razvanica asta','2010-02-21 02:07:39'),(7,2,4,'Testing the shit','2010-02-21 02:08:27'),(8,3,2,'I want to fuck you in the ass','2010-02-24 01:53:06'),(9,3,2,'He i was thinking','2010-02-24 01:53:15'),(10,3,2,'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, ','2010-02-24 01:53:50'),(11,3,2,'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque pequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, ','2010-02-24 01:53:59'),(12,3,2,'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoqu','2010-02-24 01:54:03'),(13,3,2,'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoqu','2010-02-24 01:54:09'),(14,19,2,'hai sa tio dau','2010-02-24 01:57:53'),(15,19,2,'Hai sa iti zic ceva turcule ce esti :)','2010-03-06 01:34:51'),(16,25,2,'Yes bitch give it to me now. :)','2010-03-06 01:35:23'),(17,1,1,'caca maca','2011-06-24 02:18:48'),(18,6,6,'sa ma sugi','2011-06-24 02:20:41'),(19,27,6,'Interesanta idee! Multumesc','2011-06-24 02:50:09'),(25,5,6,'se suge','2011-06-27 16:00:39'),(26,5,6,'asdw aw easd asd a&#10;w dasd asdasdad w e q we a sd as d asdaw&#10; a&#10;sd asd waew asd','2011-06-27 16:01:09'),(27,5,6,'No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. &#10;No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. &#10;No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. &#10;No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. ','2011-06-27 16:01:19');

/*Table structure for table `feedback_ideas` */

CREATE TABLE `feedback_ideas` (
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
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

/*Data for the table `feedback_ideas` */

insert  into `feedback_ideas`(`id`,`idea`,`description`,`votes`,`comments`,`auth_id`,`sub_date`,`status`,`admin_id`,`admin_comment`) values (1,'allow us to sell apps with real money!','His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. \"What\'s happened to me? \" he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls\r\nHis many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. \"What\'s happened to me? \" he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls',5519,6,2,'2009-12-28 21:02:02',3,1,'Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione '),(2,'make 10k the start sum of money','Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur?\r\n\r\nQuis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\r\n\r\nAt vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.\r\n\r\nEt harum quidem rerum facilis est et expedita distinctio.',324722,7,2,'2009-12-29 00:22:02',4,1,'To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it?'),(5,'i want hardware','Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.\r\n\r\nSeparated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.',389,3,5,'2011-06-20 00:26:38',1,1,'No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful.'),(12,'qwe qwe a','w edasd asd asdas',5509,0,3,'2009-12-30 00:26:38',6,0,''),(30,'o noua idee!','Pentru ca le-am sters pe restu!!',2,0,3,'2011-06-26 19:02:20',1,0,'Ia sa o vedem!');

/*Table structure for table `feedback_votes` */

CREATE TABLE `feedback_votes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `idea_id` bigint(20) NOT NULL,
  `voter_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Data for the table `feedback_votes` */

insert  into `feedback_votes`(`id`,`idea_id`,`voter_id`) values (1,2,5),(2,3,5),(3,9,5),(4,4,5),(5,2,2),(6,9,1),(7,3,1),(8,2,1),(9,4,1),(10,1,1),(11,11,1),(12,3,2),(13,29,6),(14,27,6),(15,29,2),(16,27,2),(17,1,2),(18,4,2),(19,30,6);

/*Table structure for table `members` */

CREATE TABLE `members` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `joindate` date NOT NULL,
  `admin` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `members` */

insert  into `members`(`id`,`username`,`email`,`password`,`joindate`,`admin`) values (2,'Chocksy','admin@ajaxmasters.com','c9e0b830ff18645849b8dbab57e477b5','2010-02-20',0),(3,'asdasd','asdas@asd.com','a8f5f167f44f4964e6c998dee827110c','2010-02-20',0),(4,'razvanica','razu@gmail.com','c9e0b830ff18645849b8dbab57e477b5','2010-02-21',0),(5,'raz','raz@asd.com','83fe374b531acc087ca01b2c65845389','2010-04-10',0),(6,'admin','chocksy@gmail.com','21232f297a57a5a743894a0e4a801fc3','1999-01-01',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
