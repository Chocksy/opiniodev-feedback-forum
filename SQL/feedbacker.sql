/*
SQLyog Ultimate - MySQL GUI v8.22 
MySQL - 5.1.36-community-log : Database - hack
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
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `feedback_comments` */

insert  into `feedback_comments`(`id`,`idea_id`,`user_id`,`comment`,`date`) values (1,2,2,'sexy motherfucker here sir','2010-02-21 01:44:00');
insert  into `feedback_comments`(`id`,`idea_id`,`user_id`,`comment`,`date`) values (2,2,2,'I want to fuck you so bad motherfucker','2010-02-21 02:01:26');
insert  into `feedback_comments`(`id`,`idea_id`,`user_id`,`comment`,`date`) values (3,2,2,'I want to know you better so tell me more','2010-02-21 02:03:17');
insert  into `feedback_comments`(`id`,`idea_id`,`user_id`,`comment`,`date`) values (4,2,2,'One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin.He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment.His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. &#34;What&#39;s happened to me? &#34; he thought. It wasn&#39;t a dream.His room, a proper human room although a little too small, lay peacefully between its four familiar walls.','2010-02-21 02:03:38');
insert  into `feedback_comments`(`id`,`idea_id`,`user_id`,`comment`,`date`) values (5,2,2,'One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin.He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment.His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. &#34;What&#39;s happened to me? &#34; he thought. It wasn&#39;t a dream.His room, a proper human room although a little too small, lay peacefully between its four familiar walls.A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad.&#34;How about if I sleep a little bit longer and forget all this nonsense&#34;, he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn&#39;t get into that position. However hard he threw himself onto his right, he always rolled back to where he was.He must have tried it a hundred times, shut his eyes so that he wouldn&#39;t have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. &#34;Oh, God&#34;, he thought, &#34;what a strenuous career it is that I&#39;ve chosen! Travelling day in and day out. ','2010-02-21 02:04:00');
insert  into `feedback_comments`(`id`,`idea_id`,`user_id`,`comment`,`date`) values (6,2,4,'Hai sa facem un test si cu razvanica asta','2010-02-21 02:07:39');
insert  into `feedback_comments`(`id`,`idea_id`,`user_id`,`comment`,`date`) values (7,2,4,'Testing the shit','2010-02-21 02:08:27');
insert  into `feedback_comments`(`id`,`idea_id`,`user_id`,`comment`,`date`) values (8,3,2,'I want to fuck you in the ass','2010-02-24 01:53:06');
insert  into `feedback_comments`(`id`,`idea_id`,`user_id`,`comment`,`date`) values (9,3,2,'He i was thinking','2010-02-24 01:53:15');
insert  into `feedback_comments`(`id`,`idea_id`,`user_id`,`comment`,`date`) values (10,3,2,'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, ','2010-02-24 01:53:50');
insert  into `feedback_comments`(`id`,`idea_id`,`user_id`,`comment`,`date`) values (11,3,2,'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque pequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, ','2010-02-24 01:53:59');
insert  into `feedback_comments`(`id`,`idea_id`,`user_id`,`comment`,`date`) values (12,3,2,'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoqu','2010-02-24 01:54:03');
insert  into `feedback_comments`(`id`,`idea_id`,`user_id`,`comment`,`date`) values (13,3,2,'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoqu','2010-02-24 01:54:09');
insert  into `feedback_comments`(`id`,`idea_id`,`user_id`,`comment`,`date`) values (14,19,2,'hai sa tio dau','2010-02-24 01:57:53');
insert  into `feedback_comments`(`id`,`idea_id`,`user_id`,`comment`,`date`) values (15,19,2,'Hai sa iti zic ceva turcule ce esti :)','2010-03-06 01:34:51');
insert  into `feedback_comments`(`id`,`idea_id`,`user_id`,`comment`,`date`) values (16,25,2,'Yes bitch give it to me now. :)','2010-03-06 01:35:23');

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
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

/*Data for the table `feedback_ideas` */

insert  into `feedback_ideas`(`id`,`idea`,`description`,`votes`,`comments`,`auth_id`,`sub_date`,`status`,`admin_id`,`admin_comment`) values (1,'allow us to sell apps with real money!','His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. \"What\'s happened to me? \" he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls\r\nHis many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. \"What\'s happened to me? \" he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls',5518,0,1,'2009-12-28 21:02:02',3,1,'Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione');
insert  into `feedback_ideas`(`id`,`idea`,`description`,`votes`,`comments`,`auth_id`,`sub_date`,`status`,`admin_id`,`admin_comment`) values (2,'make 10k the start sum of money','Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur?\r\n\r\nQuis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\r\n\r\nAt vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.\r\n\r\nEt harum quidem rerum facilis est et expedita distinctio.',324722,7,2,'2009-12-29 00:22:02',2,1,'To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it?');
insert  into `feedback_ideas`(`id`,`idea`,`description`,`votes`,`comments`,`auth_id`,`sub_date`,`status`,`admin_id`,`admin_comment`) values (3,'make the stats visible','Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.\r\n\r\nSed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione ',316414,6,3,'2009-12-29 00:22:44',1,1,'Amazingly few discotheques provide jukeboxes. My girl wove six dozen plaid jackets before she quit. Six big devils from Japan quickly forgot how to waltz.');
insert  into `feedback_ideas`(`id`,`idea`,`description`,`votes`,`comments`,`auth_id`,`sub_date`,`status`,`admin_id`,`admin_comment`) values (4,'make more banks','A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.\r\n\r\nEven the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.\r\n\r\nThe Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen.',65289,0,2,'2009-12-28 00:25:58',0,1,'Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur?');
insert  into `feedback_ideas`(`id`,`idea`,`description`,`votes`,`comments`,`auth_id`,`sub_date`,`status`,`admin_id`,`admin_comment`) values (5,'i want hardware','Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.\r\n\r\nSeparated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.',389,0,5,'2009-12-20 00:26:38',4,1,'No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful.');
insert  into `feedback_ideas`(`id`,`idea`,`description`,`votes`,`comments`,`auth_id`,`sub_date`,`status`,`admin_id`,`admin_comment`) values (6,'I have this crazy idea let\'s fuck',' The bedding was hardly able to cover it and seemed ready to slide off any moment.\r\n\r\nHis many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. \"What\'s happened to me? \" he thought.\r\n\r\nIt wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls.\r\n\r\nA collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.',58,0,6,'2009-12-20 00:38:45',0,0,'');
insert  into `feedback_ideas`(`id`,`idea`,`description`,`votes`,`comments`,`auth_id`,`sub_date`,`status`,`admin_id`,`admin_comment`) values (7,'qw easd as','d zsd zxc asdasd',178,0,1,'2009-12-20 01:27:48',4,0,'');
insert  into `feedback_ideas`(`id`,`idea`,`description`,`votes`,`comments`,`auth_id`,`sub_date`,`status`,`admin_id`,`admin_comment`) values (8,'w eqwe qwe asd ','zsd z casdaas',67,0,2,'2009-12-20 00:26:38',3,0,'');
insert  into `feedback_ideas`(`id`,`idea`,`description`,`votes`,`comments`,`auth_id`,`sub_date`,`status`,`admin_id`,`admin_comment`) values (9,' awe asdas','d aqw easdqwe',100019,0,2,'2009-12-28 00:25:58',2,0,'');
insert  into `feedback_ideas`(`id`,`idea`,`description`,`votes`,`comments`,`auth_id`,`sub_date`,`status`,`admin_id`,`admin_comment`) values (10,'qweqweqw easdasd','we asd qweqwe',389,0,1,'2009-12-29 00:22:44',4,0,'');
insert  into `feedback_ideas`(`id`,`idea`,`description`,`votes`,`comments`,`auth_id`,`sub_date`,`status`,`admin_id`,`admin_comment`) values (11,'qweqwe asd asd zxczx','fdg er tdf gdfgert',80,0,2,'2009-12-28 21:02:02',3,0,'');
insert  into `feedback_ideas`(`id`,`idea`,`description`,`votes`,`comments`,`auth_id`,`sub_date`,`status`,`admin_id`,`admin_comment`) values (12,'qwe qwe a','w edasd asd asdas',5509,0,3,'2009-12-30 00:26:38',6,0,'');
insert  into `feedback_ideas`(`id`,`idea`,`description`,`votes`,`comments`,`auth_id`,`sub_date`,`status`,`admin_id`,`admin_comment`) values (13,'i want to fuck you biatch','giceste ce',9,0,0,'2010-01-06 20:48:57',0,0,'');
insert  into `feedback_ideas`(`id`,`idea`,`description`,`votes`,`comments`,`auth_id`,`sub_date`,`status`,`admin_id`,`admin_comment`) values (14,'i want to fuck you biatch','giceste ce',8,0,0,'2010-01-06 20:49:01',0,0,'');
insert  into `feedback_ideas`(`id`,`idea`,`description`,`votes`,`comments`,`auth_id`,`sub_date`,`status`,`admin_id`,`admin_comment`) values (15,'i wish i would be taller','<p> His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. \"What\'s happened to me? \" he thought.</p><p> It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls.</p><p> A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.</p><p> It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer.</p>',2,0,0,'2010-01-06 20:53:26',0,0,'');
insert  into `feedback_ideas`(`id`,`idea`,`description`,`votes`,`comments`,`auth_id`,`sub_date`,`status`,`admin_id`,`admin_comment`) values (16,'fuck','sad',1,0,0,'2010-01-06 20:54:48',0,0,'');
insert  into `feedback_ideas`(`id`,`idea`,`description`,`votes`,`comments`,`auth_id`,`sub_date`,`status`,`admin_id`,`admin_comment`) values (17,'ma ma lasi','sadweqwe qwe qwe',1,0,0,'2010-01-06 20:54:58',0,0,'');
insert  into `feedback_ideas`(`id`,`idea`,`description`,`votes`,`comments`,`auth_id`,`sub_date`,`status`,`admin_id`,`admin_comment`) values (18,'ba boule','sadweqwe qwe qwe',1,0,0,'2010-01-06 20:55:41',0,0,'');
insert  into `feedback_ideas`(`id`,`idea`,`description`,`votes`,`comments`,`auth_id`,`sub_date`,`status`,`admin_id`,`admin_comment`) values (19,'prostule ce esti','sugi pula',2,2,0,'2010-01-06 20:59:44',1,0,'');
insert  into `feedback_ideas`(`id`,`idea`,`description`,`votes`,`comments`,`auth_id`,`sub_date`,`status`,`admin_id`,`admin_comment`) values (20,'sda','',1,0,0,'2010-02-12 00:40:40',0,0,'');
insert  into `feedback_ideas`(`id`,`idea`,`description`,`votes`,`comments`,`auth_id`,`sub_date`,`status`,`admin_id`,`admin_comment`) values (21,'errwerwe wer wer we','r wer sdf sd fsdf',1,0,0,'2010-02-12 00:41:19',0,0,'');
insert  into `feedback_ideas`(`id`,`idea`,`description`,`votes`,`comments`,`auth_id`,`sub_date`,`status`,`admin_id`,`admin_comment`) values (22,'aasd','ewewewewe',1,0,0,'2010-02-16 16:50:07',0,0,'');
insert  into `feedback_ideas`(`id`,`idea`,`description`,`votes`,`comments`,`auth_id`,`sub_date`,`status`,`admin_id`,`admin_comment`) values (23,'asd asd asd','as dw asd sad',1,0,0,'2010-02-20 19:46:27',0,0,'');
insert  into `feedback_ideas`(`id`,`idea`,`description`,`votes`,`comments`,`auth_id`,`sub_date`,`status`,`admin_id`,`admin_comment`) values (24,'qweqwe','asd asd asdasd',1,0,0,'2010-02-20 20:25:27',0,0,'');
insert  into `feedback_ideas`(`id`,`idea`,`description`,`votes`,`comments`,`auth_id`,`sub_date`,`status`,`admin_id`,`admin_comment`) values (25,'you want to fuck my pussy?','I want to let you know',1,1,0,'2010-02-21 14:17:54',0,0,'');

/*Table structure for table `feedback_votes` */

CREATE TABLE `feedback_votes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `idea_id` bigint(20) NOT NULL,
  `voter_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `feedback_votes` */

insert  into `feedback_votes`(`id`,`idea_id`,`voter_id`) values (1,2,5);
insert  into `feedback_votes`(`id`,`idea_id`,`voter_id`) values (2,3,5);
insert  into `feedback_votes`(`id`,`idea_id`,`voter_id`) values (3,9,5);
insert  into `feedback_votes`(`id`,`idea_id`,`voter_id`) values (4,4,5);
insert  into `feedback_votes`(`id`,`idea_id`,`voter_id`) values (5,2,2);
insert  into `feedback_votes`(`id`,`idea_id`,`voter_id`) values (6,9,1);
insert  into `feedback_votes`(`id`,`idea_id`,`voter_id`) values (7,3,1);
insert  into `feedback_votes`(`id`,`idea_id`,`voter_id`) values (8,2,1);
insert  into `feedback_votes`(`id`,`idea_id`,`voter_id`) values (9,4,1);
insert  into `feedback_votes`(`id`,`idea_id`,`voter_id`) values (10,1,1);
insert  into `feedback_votes`(`id`,`idea_id`,`voter_id`) values (11,11,1);

/*Table structure for table `players` */

CREATE TABLE `players` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `joindate` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `players` */

insert  into `players`(`id`,`username`,`email`,`password`,`joindate`) values (1,'Chocksy','chocksy@gmail.com','razvan','2010-02-20');
insert  into `players`(`id`,`username`,`email`,`password`,`joindate`) values (2,'Chocksy','chocksy@gmail.com','c9e0b830ff18645849b8dbab57e477b5','2010-02-20');
insert  into `players`(`id`,`username`,`email`,`password`,`joindate`) values (3,'asdasd','asdas@asd.com','a8f5f167f44f4964e6c998dee827110c','2010-02-20');
insert  into `players`(`id`,`username`,`email`,`password`,`joindate`) values (4,'razvanica','razu@gmail.com','c9e0b830ff18645849b8dbab57e477b5','2010-02-21');
insert  into `players`(`id`,`username`,`email`,`password`,`joindate`) values (5,'raz','raz@asd.com','83fe374b531acc087ca01b2c65845389','2010-04-10');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
