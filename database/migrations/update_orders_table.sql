-- Обновляем таблицу order
ALTER TABLE `order`
ADD COLUMN `delivery_method` ENUM('pickup', 'courier') NOT NULL AFTER `price`,
ADD COLUMN `payment_method` ENUM('card_courier', 'cash_courier') NOT NULL AFTER `delivery_method`,
ADD COLUMN `address` TEXT NULL AFTER `payment_method`,
ADD COLUMN `comment` TEXT NULL AFTER `address`,
ADD COLUMN `status` ENUM('pending', 'processing', 'completed', 'cancelled') DEFAULT 'pending' AFTER `comment`;

-- Обновляем таблицу element_order
ALTER TABLE `element_order`
ADD COLUMN `price` DECIMAL(10, 2) NOT NULL AFTER `quantity`; 