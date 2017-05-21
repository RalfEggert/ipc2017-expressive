SET FOREIGN_KEY_CHECKS=0;
START TRANSACTION;

DROP TABLE IF EXISTS `customer`;

CREATE TABLE IF NOT EXISTS `customer` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `status` enum('new','approved','blocked') NOT NULL,
  `first_name` varchar(64) NOT NULL,
  `last_name` varchar(64) NOT NULL,
  `country` char(2) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

INSERT INTO `customer` (`id`, `date`, `status`, `first_name`, `last_name`, `country`, `email`, `password`) VALUES
(1, '2017-05-21 07:13:22', 'new', 'Sebastian', 'Kappel', 'de', 'sebastian@kappel.de', '$2y$10$HyizHhdxyOL/3ymghfdCNui7CBuhDyL1aIzKJbgLcg9HEQsvhQuma'),
(2, '2017-05-21 07:13:54', 'blocked', 'Birgit', 'Beike', 'de', 'birgit@beike.de', '$2y$10$5s4qEzltE5.cLVvZ6waDDeASmmrE1/jSTkGZ2r8KbxSqneIbuFnZq'),
(3, '2017-05-21 07:14:38', 'approved', 'Robert', 'Decker', 'de', 'robert@decker.de', '$2y$10$oTquAQvCHW3Xfqh/N4Qq5.QM9m9skwXj3gLQHScsvPTY72ZjCJ.2u'),
(4, '2017-05-21 07:15:11', 'approved', 'Christine', 'Grunewald', 'de', 'christine@grunewald.de', '$2y$10$Q1molP0Iqz/gQx/.uBmZXOrZkNVknVl8YwGyf1dI6J8CMgN6CRhoa'),
(5, '2017-05-21 07:15:44', 'approved', 'Kerstin', 'Eisenberg', 'at', 'kerstin@eisenberg.at', '$2y$10$0rOyYk1BQSCuNo0SPbXWae2GhQPLmumFyNP6R1XfzO3OkPlqXofR2'),
(6, '2017-05-21 07:15:18', 'approved', 'Johanna', 'Koertig', 'at', 'johanna@koertig.at', '$2y$10$h9fCa/hv3PdmF5LWa1l9tuobAZ20K1qIZBMC8HrZmmEPnFuXGPMpa'),
(7, '2017-05-21 07:16:53', 'approved', 'Eric', 'Daecher', 'at', 'eric@daecher.at', '$2y$10$sNwrv7qXzfQSrsCrov1RKOtL1Eau4iYBPt1h1GWC.6aSfGenjJZn6'),
(8, '2017-05-21 07:17:23', 'approved', 'Erik', 'Lemann', 'ch', 'erik@lemann.ch', '$2y$10$RObRTpPCfNzSUQhxSMVUsu1OcC2mKosXs5Nl7V54lLe8aJFAeCBJ'),
(9, '2017-05-21 07:17:48', 'approved', 'Andreas', 'Dresner', 'ch', 'andreas@dresner.ch', '$2y$10$W/LLsZoPDFBEQouMUTffkeOOiAGKz9qCoQ82ierCYcHR9yI3ca5OS'),
(10, '2017-05-21 07:18:19', 'approved', 'Erik', 'Bürger', 'de', 'erik@buerger.de', '$2y$10$CmTrfC/f/UTrauAnyzs/P.NJ.sjJxXG1DVttUk57amgOzRlTvK.fy'),
(11, '2017-05-21 07:18:59', 'blocked', 'Marie', 'Mehler', 'de', 'marie@mehler.de', '$2y$10$SbKhL2fbsdpE7btJKHseEeIkYKSn/.XlBOJJBVsCq3FEQUp/SgesS'),
(12, '2017-05-21 07:19:25', 'approved', 'Dieter', 'Mayer', 'at', 'dieter@mayer.at', '$2y$10$CLUOysGWJVVvGcwNciXIS.aUAU4kdXc1rGFRmfQYX9/8QI3HAy8Wa');

SET FOREIGN_KEY_CHECKS=1;
COMMIT;
