-- Manual one-shot (non-idempotent). Prefer: docker compose run --rm migrate

SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `admin_group`;
DROP TABLE IF EXISTS `banner_stat`;
DROP TABLE IF EXISTS `banner_photo`;
DROP TABLE IF EXISTS `banners`;
DROP TABLE IF EXISTS `banner_place`;
DROP TABLE IF EXISTS `banner_pages`;
DROP TABLE IF EXISTS `basket`;
DROP TABLE IF EXISTS `news_photo`;
DROP TABLE IF EXISTS `news_history`;
DROP TABLE IF EXISTS `news`;
DROP TABLE IF EXISTS `orders_link_tovar`;
DROP TABLE IF EXISTS `orders`;
DROP TABLE IF EXISTS `reviews`;
DROP TABLE IF EXISTS `tovars_link_rub`;
DROP TABLE IF EXISTS `tovars`;
DROP TABLE IF EXISTS `works_photo`;
DROP TABLE IF EXISTS `works_mini`;

ALTER TABLE `articles` DROP COLUMN `groups_id`, DROP COLUMN `guid`;
ALTER TABLE `articles_img` DROP COLUMN `x`, DROP COLUMN `y`, DROP COLUMN `width`, DROP COLUMN `height`, DROP COLUMN `sort`;
ALTER TABLE `users` DROP COLUMN `surname`, DROP COLUMN `adress`, DROP COLUMN `lord`, DROP COLUMN `name`, DROP COLUMN `phone`, DROP COLUMN `url`;
ALTER TABLE `works` DROP COLUMN `FK_user`, DROP COLUMN `title`, DROP COLUMN `keywords`, DROP COLUMN `description`;
ALTER TABLE `pages` DROP COLUMN `gruppa`;
ALTER TABLE `rubricator` DROP COLUMN `parent`, DROP COLUMN `status`, DROP COLUMN `title`, DROP COLUMN `keywords`, DROP COLUMN `description`, DROP COLUMN `seo`, DROP COLUMN `class`;

SET FOREIGN_KEY_CHECKS = 1;
