-- Adminer 4.8.1 MySQL 11.5.2-MariaDB-ubu2404 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `addresses`;
CREATE TABLE `addresses` (
                             `id` int(11) NOT NULL AUTO_INCREMENT,
                             `street` varchar(255) NOT NULL,
                             `descriptive_number` int(11) NOT NULL,
                             `city` varchar(255) NOT NULL,
                             `postal_code` int(11) NOT NULL,
                             PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

INSERT INTO `addresses` (`id`, `street`, `descriptive_number`, `city`, `postal_code`) VALUES
                                                                                          (72,	'Borová',	720,	'Zuberec',	27),
                                                                                          (73,	'Zuberec',	379,	'Zuberec',	2732),
                                                                                          (74,	'Borová',	469,	'Zuberec',	2732),
                                                                                          (75,	'Pod Kyčerou ',	173,	'Zuberec',	2732),
                                                                                          (76,	'Borová',	0,	'Zuberec',	2732),
                                                                                          (77,	'Borová',	22222,	'aaaaaaa',	333),
                                                                                          (78,	'errrrrrr',	22222,	'Zuberec',	333),
                                                                                          (79,	'errrrrrr',	0,	'Zuberec',	333),
                                                                                          (80,	'ff',	3,	'ff',	3),
                                                                                          (81,	'ff',	0,	'ff',	3),
                                                                                          (82,	'Nad Vrškami',	867,	'Zuberec',	2732),
                                                                                          (83,	'športovcov',	1182,	'Dolný Kubín ',	2601),
                                                                                          (84,	'Spálena ',	870,	'Zuberec',	2732),
                                                                                          (85,	'Borová',	445,	'Zuberec',	2732),
                                                                                          (86,	'Kubinhola ',	345,	'Dolný Kubín ',	2601),
                                                                                          (87,	'Kubinhola ',	0,	'Dolný Kubín ',	2601),
                                                                                          (88,	'Zuberec',	850,	'Zuberec',	2732),
                                                                                          (89,	'breztová',	498,	'Zuberec',	2732),
                                                                                          (90,	'brestová',	0,	'Zuberec',	2732),
                                                                                          (91,	'Spálena ',	0,	'Zuberec',	2732),
                                                                                          (92,	'Borová',	0,	'Zuberec',	27),
                                                                                          (93,	'Zuberec',	0,	'Zuberec',	2732),
                                                                                          (94,	'Nad Vrškami',	0,	'Zuberec',	2732),
                                                                                          (95,	'a',	1,	'a',	1),
                                                                                          (96,	'a',	3,	'a',	3),
                                                                                          (97,	'k',	9,	'k',	9),
                                                                                          (98,	'lllllll',	88,	'llll',	88),
                                                                                          (99,	'kkk',	88,	'kk',	88),
                                                                                          (100,	'g',	5,	'g',	5),
                                                                                          (101,	'b',	5,	'b',	5),
                                                                                          (102,	'b',	0,	'b',	9),
                                                                                          (103,	'm',	9,	'm',	8),
                                                                                          (104,	'j',	9,	'j',	9),
                                                                                          (105,	'x',	2,	'x',	3),
                                                                                          (106,	'Na Skanzen',	122,	'Zuberec',	2732),
                                                                                          (107,	'aaa',	11,	'aaa',	11),
                                                                                          (108,	'aa',	1,	'aa',	1),
                                                                                          (109,	'aa',	11,	'aa',	11),
                                                                                          (110,	'a',	0,	'a',	1),
                                                                                          (111,	'Pod Kyčerou ',	0,	'Zuberec',	2732),
                                                                                          (112,	'a',	1,	'a',	2),
                                                                                          (113,	'sss',	22,	'sss',	22),
                                                                                          (114,	'gg',	22,	'gg',	33),
                                                                                          (115,	'sss',	3,	'ss',	3),
                                                                                          (116,	'a',	2,	'a',	2),
                                                                                          (117,	'aaa',	1111,	'aa',	1111),
                                                                                          (118,	'dsd',	33,	'sdd',	333),
                                                                                          (119,	'ss',	33,	'dd',	33),
                                                                                          (120,	'ss',	4,	'ss',	4),
                                                                                          (121,	'aaa',	22,	'aaa',	222),
                                                                                          (122,	'aa',	33,	'aa',	33),
                                                                                          (123,	'aaa',	32,	'aa',	22),
                                                                                          (124,	'aa',	22,	'aa',	22),
                                                                                          (125,	's',	3,	'd',	3),
                                                                                          (126,	'e',	2,	'e',	2),
                                                                                          (127,	'qwer',	123,	'qwe',	123),
                                                                                          (128,	'asdf',	123,	'123',	123),
                                                                                          (129,	'roroj',	1234,	'aaaa',	345),
                                                                                          (130,	'aaaa',	1111,	'aaa',	1111),
                                                                                          (131,	'aa',	111,	'aaa',	123),
                                                                                          (132,	'g',	2,	'g',	2),
                                                                                          (133,	'w',	3333,	'w',	333),
                                                                                          (134,	'aaa',	123,	'aaa',	123),
                                                                                          (135,	'aaaa',	2,	'a',	2),
                                                                                          (136,	'hhh',	3,	'hh',	3),
                                                                                          (137,	'Borová',	3,	'Zuberec',	333),
                                                                                          (138,	'x',	4,	'x',	4),
                                                                                          (139,	's',	2,	's',	2),
                                                                                          (140,	'c',	3,	'c',	3),
                                                                                          (141,	'g',	4,	'g',	4),
                                                                                          (142,	'dsa',	1,	'ss',	1),
                                                                                          (143,	'a',	1,	'Zuberec',	333),
                                                                                          (144,	'd',	3,	'd',	3),
                                                                                          (145,	's',	4,	's',	4),
                                                                                          (146,	'f',	4,	'f',	4),
                                                                                          (147,	'brestová',	3,	'Zuberec',	2732),
                                                                                          (148,	'Nad Vrškami',	1,	'Zuberec',	2732),
                                                                                          (149,	'ecdcgrcf',	9987,	'cdkjsbcgrechf',	98728),
                                                                                          (150,	'KOSXjaix',	867,	'ctzdsgvct',	897385),
                                                                                          (151,	'cdsfcrew',	98,	'fasfcewgfr',	76690),
                                                                                          (152,	'Zuberec',	3,	'Zuberec',	2732),
                                                                                          (153,	'KOSXjaix',	1,	'ctzdsgvct',	897385),
                                                                                          (154,	'a',	3,	'a',	32),
                                                                                          (155,	'a',	3,	'a',	33),
                                                                                          (156,	'Borová',	4,	'Zuberec',	27),
                                                                                          (157,	'Zuberec',	55,	'Zuberec',	2732),
                                                                                          (158,	'Borová',	7,	'Zuberec',	2732),
                                                                                          (159,	'cdsfcrew',	983,	'fasfcewgfr',	76690),
                                                                                          (160,	'cdsfcrew',	98333333,	'fasfcewgfr',	76690),
                                                                                          (161,	'Na Skanzen',	1222,	'Zuberec',	2732),
                                                                                          (162,	'Zuberec',	34,	'Zuberec',	2732),
                                                                                          (163,	' d vgbg',	98,	' fg ghjnhg',	9766),
                                                                                          (164,	' d vgbg',	98,	' fg ghjnhg',	97660),
                                                                                          (165,	'Borová',	4,	'Zuberec',	2732),
                                                                                          (166,	'cdsfcrew',	983,	'fasfcewgfr',	7669),
                                                                                          (167,	'cdsfcrew',	983,	'fasfcewgfr',	76),
                                                                                          (168,	'aa',	2,	'a',	2222),
                                                                                          (169,	'a',	3,	'a',	33333),
                                                                                          (170,	'Pod Kyčerou ',	173,	'Zuberec',	27325),
                                                                                          (171,	'Borová',	7,	'Zuberec',	27324),
                                                                                          (172,	'Borová',	4,	'Zuberec',	27324),
                                                                                          (173,	'Zuberec',	55,	'Zuberec',	27324),
                                                                                          (174,	'aaaaaa',	3333,	'aaaaaa',	33333),
                                                                                          (175,	'aa',	2,	'a',	22223),
                                                                                          (176,	'Na Skanzen',	1222,	'Zuberec',	27320),
                                                                                          (177,	'Zuberec',	34,	'Zuberec',	27320),
                                                                                          (178,	'brestová',	3,	'Zuberec',	27320),
                                                                                          (179,	'aa',	2,	'a',	22255);

DROP TABLE IF EXISTS `images`;
CREATE TABLE `images` (
                          `id` int(11) NOT NULL AUTO_INCREMENT,
                          `path` varchar(255) NOT NULL,
                          `restaurant_id` int(11) DEFAULT NULL,
                          `post_id` int(11) DEFAULT NULL,
                          PRIMARY KEY (`id`),
                          KEY `fk_images_restaurant` (`restaurant_id`),
                          KEY `fk_images_post` (`post_id`),
                          CONSTRAINT `fk_images_post` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
                          CONSTRAINT `fk_images_restaurant` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

INSERT INTO `images` (`id`, `path`, `restaurant_id`, `post_id`) VALUES
                                                                    (18,	'50395236274197-kwq9cq4b.jpg',	28,	NULL),
                                                                    (36,	'53492705422827-Vila-Zuberec-wellness-virivka.jpg',	NULL,	19),
                                                                    (37,	'53654300961685-400730519.jpg',	NULL,	20),
                                                                    (38,	'54203649862546-600.jpg',	NULL,	21),
                                                                    (39,	'54593102546579-14_RohaceSpalena_Winter.jpg',	NULL,	22),
                                                                    (40,	'54935065316032-d31a0a0d751.jpg',	NULL,	23),
                                                                    (43,	'55724444497580-Skanzen-Zuberec-2.jpg',	NULL,	25),
                                                                    (44,	'56110760947862-Brestovska_3Stanik.jpg',	NULL,	26),
                                                                    (45,	'73136271085378-100.jpg',	NULL,	29),
                                                                    (83,	'28664482949475-uploads_zlavadna.sk_deal_images_2024_1011_670912b6e5efe.jpeg',	27,	NULL),
                                                                    (120,	'15813207317550-tarzania.jpg',	NULL,	29),
                                                                    (121,	'16585356467103-Múzeum_oravskej_dediny_Zuberec_-_Brestová_(10).jpg',	NULL,	25),
                                                                    (122,	'16607693925599-csm_zuberec9_22c9eeef07.jpg',	NULL,	25),
                                                                    (123,	'16632633114267-IMG_20200822_111603-1000x660.jpg',	NULL,	25),
                                                                    (124,	'16639727177426-Muzeum_oravskej_dediny_1.jpg',	NULL,	25),
                                                                    (125,	'16735598366453-muzeum-oravskej-dediny (1).webp',	NULL,	25),
                                                                    (126,	'17007813249802-csm_zuberec9_22c9eeef07.jpg',	NULL,	29),
                                                                    (127,	'17054633777036-IMG_20200822_111603-1000x660.jpg',	NULL,	29),
                                                                    (128,	'17579881578978-csm_zuberec9_22c9eeef07.jpg',	NULL,	29),
                                                                    (140,	'15813207317550-tarzania.jpg',	NULL,	29),
                                                                    (151,	'49195527490282-sindlovec3.jpg',	26,	NULL),
                                                                    (154,	'28701044796003-kycer-burger (1).jpg',	25,	NULL),
                                                                    (162,	'18862488252519-csm_zuberec9_22c9eeef07.jpg',	NULL,	25),
                                                                    (163,	'18862530768016-IMG_20200822_111603-1000x660.jpg',	NULL,	25),
                                                                    (164,	'18862546165541-Muzeum_oravskej_dediny_1.jpg',	NULL,	25),
                                                                    (166,	'22305793807393-csm_zuberec9_22c9eeef07.jpg',	NULL,	99);

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
                         `id` int(11) NOT NULL AUTO_INCREMENT,
                         `name` varchar(255) NOT NULL,
                         `description` text DEFAULT NULL,
                         `season` enum('leto','zima','celoročne') NOT NULL,
                         `category` enum('activity','relax','šport') NOT NULL,
                         `id_address` int(11) DEFAULT NULL,
                         `opening_hours` varchar(255) DEFAULT NULL,
                         `main_image_id` int(11) DEFAULT NULL,
                         PRIMARY KEY (`id`),
                         KEY `fk_main_image` (`main_image_id`),
                         CONSTRAINT `fk_main_image` FOREIGN KEY (`main_image_id`) REFERENCES `images` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

INSERT INTO `posts` (`id`, `name`, `description`, `season`, `category`, `id_address`, `opening_hours`, `main_image_id`) VALUES
                                                                                                                            (19,	'Vila Zuberec',	'wellness - vírivka, sauna',	'celoročne',	'relax',	148,	'Friday	11 AM–10 PM\r\nSaturday	11 AM–10 PM\r\nSunday	11 AM–10 PM\r\nMonday\r\n(Epiphany)\r\n11 AM–10 PM\r\nHoliday opening hours\r\nTuesday	11 AM–10 PM\r\nWednesday	11 AM–10 PM\r\nThursday	11 AM–10 PM',	NULL),
                                                                                                                            (20,	'Koliba Josu ',	'plávanie, vírivka ',	'celoročne',	'relax',	74,	': \r\nFriday	8 AM–8 PM\r\nSaturday	8 AM–8 PM\r\nSunday	8 AM–10 PM\r\nMonday\r\n(Epiphany)\r\n8 AM–8 PM\r\nHours might differ\r\nTuesday	8 AM–8 PM\r\nWednesday	8 AM–8 PM\r\nThursday	8 AM–8 PM',	NULL),
                                                                                                                            (21,	'AquaRelax',	'vírivka, tobogány, šmykľavky, bazén',	'celoročne',	'relax',	83,	'Friday	8 AM–8 PM\r\nSaturday	12–8 PM\r\nSunday	12–8 PM\r\nMonday\r\n(Epiphany)\r\n8 AM–8 PM\r\nHours might differ\r\nTuesday	8 AM–8 PM\r\nWednesday	8 AM–8 PM\r\nThursday	8 AM–12 AM\r\n',	NULL),
                                                                                                                            (22,	'Spálena ',	'Lyžovanie',	'zima',	'šport',	91,	' \r\nFriday	9 AM–4 PM\r\nSaturday	9 AM–4 PM\r\nSunday	9 AM–4 PM\r\nMonday\r\n(Epiphany)\r\n9 AM–4 PM\r\nHours might differ\r\nTuesday	9 AM–4 PM\r\nWednesday	9 AM–4 PM\r\nThursday	9 AM–4 PM',	NULL),
                                                                                                                            (23,	'Janovky ',	'Lyžovanie',	'zima',	'šport',	85,	'Friday	8 AM–8 PM\r\nSaturday	12–8 PM\r\nSunday	12–8 PM\r\nMonday 8 AM–8 PM\r\nTuesday	8 AM–8 PM\r\nWednesday	8 AM–8 PM\r\nThursday	8 AM–12 AM',	NULL),
                                                                                                                            (25,	'Múzeum oravskej dediny',	'Ľudová architektúra v prekrásnom prostredí Roháčov',	'celoročne',	'activity',	177,	'Friday	8 AM–3:30 PM\r\nSaturday	8 AM–3:30 PM\r\nSunday	8 AM–3:30 PM\r\nMonday 8 AM–3:30 PM\r\nHoliday opening hours\r\nTuesday	8 AM–3:30 PM\r\nWednesday	8 AM–3:30 PM\r\nThursday	8 AM–3:30 PM\r\n',	43),
                                                                                                                            (26,	'Brestovska jaskyňa ',	'jaskyňa plná zaujímavých veci ',	'leto',	'activity',	178,	'Friday	8 AM–8 PM\r\nSaturday	12–8 PM\r\nSunday	12–8 PM\r\nMonday\r\n(Epiphany)\r\n8 AM–8 PM\r\nHours might differ\r\nTuesday	8 AM–8 PM\r\nWednesday	8 AM–8 PM\r\nThursday	8 AM–12 AM\r\n',	NULL),
                                                                                                                            (29,	'Tarzániaaa',	'Chcete sa cítiť voľný zviera z džungle? Čo tak, stať sa aspoň na čas opicou, ktorá môže preskakovať zo stromu na strom a zažívať nadšenie z voľného pohybu? Ale pozor nebude to také jednoduché ako sa na prvý pohľad zdá.\r\n\r\nAj na opice čakajú v korunách stromov rôzne prekážky, ktoré musia prekonávať. Príďte si vyskúšať či ich aj vy zvládnete a dostanete sa do cieľa.\r\n\r\nZ bezpečnostných dôvodov sa môžu po trati pohybovať iba osoby nad 150 cm alebo menšie v sprievode 2 dospelých osôb. Pripravili sme ale i lanovú dráhu pre malé opičky, na ktorej nebudú v ničom zaostávať za tými dospelými.',	'leto',	'activity',	176,	'pondelok	10–18\r\nutorok	10–18\r\nstreda	10–18\r\nštvrtok	10–18\r\npiatok	10–18\r\nsobota	10–18\r\nnedeľa	10–18',	45),
                                                                                                                            (95,	'xwshdfjcvev',	'cedvtrbtn',	'zima',	'activity',	149,	'vdfevgfvbefvff',	NULL),
                                                                                                                            (99,	'aa',	'ggg',	'leto',	'activity',	179,	'g',	NULL);

DROP TABLE IF EXISTS `restaurants`;
CREATE TABLE `restaurants` (
                               `id` int(11) NOT NULL AUTO_INCREMENT,
                               `name` varchar(255) NOT NULL,
                               `id_address` int(11) NOT NULL,
                               `phone_number` int(11) NOT NULL,
                               `opening_hours` text NOT NULL,
                               `url_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_slovak_ci NOT NULL,
                               PRIMARY KEY (`id`),
                               KEY `id_address` (`id_address`),
                               CONSTRAINT `restaurants_ibfk_2` FOREIGN KEY (`id_address`) REFERENCES `addresses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `restaurants` (`id`, `name`, `id_address`, `phone_number`, `opening_hours`, `url_address`) VALUES
                                                                                                           (25,	'Kyčer Burger',	172,	904689641,	'Friday	11 AM–11 PM\r\nSaturday	11 AM–11 PM\r\nSunday	11 AM–10 PM\r\nMonday\r\n(Epiphany)\r\n11 AM–10 PM\r\nHoliday opening hours\r\nTuesday	11 AM–10 PM\r\nWednesday	11 AM–10 PM\r\nThursday	11 AM–10 PM\r\n',	'https://www.kycerburger.sk'),
                                                                                                           (26,	'Šindlovec',	173,	903509670,	'Friday	8 AM–8 PM\r\nSaturday	8 AM–8 PM\r\nSunday	8 AM–8 PM\r\nMonday\r\n(Epiphany)\r\n8 AM–8 PM\r\nHours might differ\r\nTuesday	8 AM–8 PM\r\nWednesday	8 AM–8 PM\r\nThursday	8 AM–8 PM',	'https://sindlovec.sk/penzion-sindlovec/restauracia'),
                                                                                                           (27,	'Koliba Josu ',	171,	435395133,	'Friday	8 AM–8 PM\r\nSaturday	8 AM–8 PM\r\nSunday	8 AM–10 PM\r\nMonday\r\n(Epiphany)\r\n8 AM–8 PM\r\nHours might differ\r\nTuesday	8 AM–8 PM\r\nWednesday	8 AM–8 PM\r\nThursday	8 AM–8 PM',	'http://www.kolibajosu.sk/sk/koliba/restauracia'),
                                                                                                           (28,	'Oravska izba ',	170,	951618271,	' \r\nFriday	11 AM–10 PM\r\nSaturday	11 AM–10 PM\r\nSunday	11 AM–10 PM\r\nMonday\r\n(Epiphany)\r\n11 AM–10 PM\r\nHoliday opening hours\r\nTuesday	11 AM–10 PM\r\nWednesday	11 AM–10 PM\r\nThursday	11 AM–10 PM',	'https://menu.oravskaizbazuberec.sk');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
                         `id` int(11) NOT NULL AUTO_INCREMENT,
                         `username` varchar(50) NOT NULL,
                         `passwordHash` varchar(255) NOT NULL,
                         PRIMARY KEY (`id`),
                         UNIQUE KEY `Username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

INSERT INTO `users` (`id`, `username`, `passwordHash`) VALUES
                                                           (5,	'admin',	'$2y$10$ZN/7f5jCMXv.Cl0sWSYRvOiMmcsj59QDyzlD64/R2Ma.mH6X5Cu2a'),
                                                           (6,	'adm',	'$2y$10$Seeh7sYCrXH1Ri6iA8qzXOZGw8Kx2E8QS8JFj0Uy7FkNGnX6AqaTu'),
                                                           (7,	'a',	'$2y$10$j9XExvP3Z.oeXO7NtNumiuE9o/2mHxS.XPmcGdLr/C1kqWfXHieX.'),
                                                           (8,	'admm',	'$2y$10$QnBnjeJm0Vv/ZDdLJazJu.h8cpuUpuzWhExwo03zN6PH3/BXwwnma'),
                                                           (9,	'adm124',	'$2y$10$QaxvXgW9LarRvvXjlEgM8.LgbBPpJOH9upcAWb5DSrxWowmlVTkmm'),
                                                           (16,	'borsik',	'$2y$10$Jt9g65SSEx.nY1S0cy3ZYuR.QplSbPGATdXiZGhaDxvKQwBtEs1pS'),
                                                           (17,	'petakova',	'$2y$10$mG5vgB9CAA0e4xPH1fZVC.YzbX24OPh6tf6m6QvSsxmLuJY0f.T8O'),
                                                           (18,	'bernatakova',	'$2y$10$mhveUsXEteSp98p7RK2r8ObPSNgHy/pI8/Cw1mRZmgM1f7JY81CJy'),
                                                           (20,	'daniel',	'$2y$10$6aXPuPPxp33GzvGWKPMpV.Z5J2OoRiOE.84YPpBxwdCb0u4Tu3inG'),
                                                           (22,	'adam',	'$2y$10$4RtofBme1Njko.DwEnNiWuywqVZNHxU4BB6LL8kpWnjx5iSCMIE7i');

-- 2025-02-06 19:07:54