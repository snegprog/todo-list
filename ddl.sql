CREATE TABLE `tasks` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(512) NOT NULL DEFAULT '' COMMENT 'Название задачи',
  `description` varchar(2048) NOT NULL DEFAULT '' COMMENT 'Описание задачи',
  `status` int unsigned NOT NULL DEFAULT 0 COMMENT 'Статус исполнения задачи',
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, -- Просто значение по умолчанию. Значение по умолчанию не желательно при кластере
  `update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,-- Просто значение по умолчанию. Значение по умолчанию не желательно при кластере
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

LOCK TABLES `tasks` WRITE;
INSERT INTO tasks (name, status) VALUE ('один', 1);
INSERT INTO tasks (name, status) VALUE ('два', 1);
INSERT INTO tasks (name, status) VALUE ('три', 1);
INSERT INTO tasks (name, status) VALUE ('четыре', 1);
INSERT INTO tasks (name, status) VALUE ('пять', 1);
INSERT INTO tasks (name, status) VALUE ('шесть', 1);
UNLOCK TABLES;

