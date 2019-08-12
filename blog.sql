-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2019 at 01:07 AM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(4) NOT NULL,
  `category_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_title`) VALUES
(8, 'java'),
(10, 'bootstrap'),
(11, 'Javascript'),
(12, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(3) NOT NULL,
  `post_comment_id` int(3) NOT NULL,
  `user_username` varchar(255) NOT NULL,
  `comment_name` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(255) NOT NULL DEFAULT 'draft',
  `comment_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_comment_id`, `user_username`, `comment_name`, `comment_content`, `comment_status`, `comment_date`) VALUES
(1, 7, 'arjol1', 'arjol bega', 'test1!', 'draft', '2019-08-06 10:17:03'),
(2, 7, 'arjol1', 'arjol bega', 'test2', 'draft', '2019-07-15 23:46:17'),
(3, 7, 'arjol1', 'arjol bega', 'test3', 'draft', '2019-07-16 00:02:58'),
(4, 7, 'arjol1', 'arjol bega', 'test4', 'draft', '2019-07-15 23:37:19'),
(5, 7, 'arjol1', 'arjol bega', 'test 5', 'draft', '2019-07-16 00:09:41'),
(6, 7, 'arjol1', 'arjol bega', 'test 6', 'draft', '2019-08-06 10:17:33'),
(8, 1, 'arjol1', 'arjol bega', 'Java comment', 'draft', '2019-07-29 14:50:49'),
(9, 1, 'arjol1', 'arjol bega', 'second coomment', 'draft', '2019-07-29 14:51:17'),
(17, 7, 'arjol1', 'arjol bega', 'test', 'draft', '2019-08-06 10:50:21');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(3) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_category_id` int(3) NOT NULL,
  `post_content` text NOT NULL,
  `post_image` text NOT NULL,
  `post_date` text NOT NULL,
  `post_status` varchar(255) NOT NULL DEFAULT 'draft'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_title`, `post_author`, `post_category_id`, `post_content`, `post_image`, `post_date`, `post_status`) VALUES
(1, 'Java Tip', 'arjol bega', 8, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores laudantium voluptas voluptatibus. A accusantium ad autem minus necessitatibus officiis reiciendis vel! Blanditiis dignissimos eos eveniet hic id nihil porro provident!', 'java2.png', '2019-06-27 10:05:48', 'published'),
(2, 'Bootstrap tip', 'arjol bega', 10, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam libero orci, condimentum id lectus non, malesuada efficitur lectus. Phasellus erat nulla, venenatis et felis sit amet, maximus venenatis ligula. Sed sit amet sodales purus. Quisque cursus imperdiet gravida. Nulla tincidunt vel urna nec consectetur. Nunc vel nibh orci. Phasellus neque nisi, volutpat nec egestas nec, mattis nec enim. Donec lacinia imperdiet mauris vel laoreet. Suspendisse mattis ac nisl eu imperdiet. Nullam ullamcorper imperdiet gravida. Sed vestibulum at nisl et iaculis. Aenean ac orci quis ex ullamcorper tempus elementum eu nulla. Aliquam ac ex purus. Nunc rhoncus dui ut tortor aliquet tristique.', 'bootstrap.jpg', '2019-06-21 13:40:53', 'draft'),
(5, 'Java Tip 2 edited', 'arjol bega', 8, 'Suspendisse volutpat sem ligula, a dignissim tortor eleifend ut. Maecenas ipsum nisi, bibendum quis diam vel, commodo accumsan turpis. Duis fermentum feugiat nisl quis auctor. Cras vel eros mi. Mauris mattis lectus eget accumsan vestibulum. Suspendisse quis quam nunc. In pellentesque arcu id libero rhoncus gravida. In hac habitasse platea dictumst. Nam tristique erat quis consectetur tempor. Nunc malesuada metus ac mi mattis, ac auctor velit bibendum. Maecenas quis facilisis velit, sit amet aliquet metus. In semper vestibulum libero, placerat vehicula sem molestie non. Praesent lectus metus, mattis a eleifend sit amet, fermentum nec diam.', 'java.jpeg', '2019-06-20 14:55:47', 'draft'),
(6, 'Bootstrap tip 2', 'arjol bega', 10, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris molestie efficitur urna quis rhoncus. Mauris at dolor eu velit lacinia mollis. Quisque mollis.', 'bootstrap.jpg', '2019-06-21 13:40:45', 'draft'),
(7, 'Javascript tip 1', 'arjol bega', 11, 'Quisque a nunc luctus, cursus orci eget, egestas risus. Ut vel orci consequat, ornare nulla ac, efficitur tortor. Duis facilisis enim rhoncus, dictum neque et, elementum velit. Cras vel est sapien. Vestibulum mauris metus, placerat sit amet felis vitae, tristique tristique dolor. Maecenas quis commodo dui. Pellentesque in nibh sapien. Ut sapien nunc, scelerisque quis pellentesque quis, pulvinar sit amet nibh. Curabitur gravida purus sed pharetra porta. Pellentesque id mattis elit. Etiam eget nibh quis orci fringilla ornare eu consequat sem. Pellentesque porttitor, turpis ut efficitur ultrices, massa tortor ornare justo, eget aliquet ante dui eget lorem. Donec blandit, mauris quis vestibulum cursus, tellus diam facilisis enim, vel dignissim magna lacus a arcu. Phasellus vitae dolor.', 'javascript2.jpg', '2019-06-21 13:37:36', 'draft'),
(8, 'Javascript tip 2', 'arjol bega', 11, 'Quisque a nunc luctus, cursus orci eget, egestas risus. Ut vel orci consequat, ornare nulla ac, efficitur tortor. Duis facilisis enim rhoncus, dictum neque et, elementum velit. Cras vel est sapien. Vestibulum mauris metus, placerat sit amet felis vitae, tristique tristique dolor. Maecenas quis commodo dui. Pellentesque in nibh sapien. Ut sapien nunc, scelerisque quis pellentesque quis, pulvinar sit amet nibh. Curabitur gravida purus sed pharetra porta. Pellentesque id mattis elit. Etiam eget nibh quis orci fringilla ornare eu consequat sem. Pellentesque porttitor, turpis ut efficitur ultrices, massa tortor ornare justo, eget aliquet ante dui eget lorem. Donec blandit, mauris quis vestibulum cursus, tellus diam facilisis enim, vel dignissim magna lacus a arcu. Phasellus vitae dolor.', 'javascript1.png', '2019-06-21 13:39:18', 'draft'),
(9, 'Java Tip 3 edited!!!', 'arjol bega', 8, 'Quisque a nunc luctus, cursus orci eget, egestas risus. Ut vel orci consequat, ornare nulla ac, efficitur tortor. Duis facilisis enim rhoncus, dictum neque et, elementum velit. Cras vel est sapien. Vestibulum mauris metus, placerat sit amet felis vitae, tristique tristique dolor. Maecenas quis commodo dui. Pellentesque in nibh sapien. Ut sapien nunc, scelerisque quis pellentesque quis, pulvinar sit amet nibh. Curabitur gravida purus sed pharetra porta. Pellentesque id mattis elit. Etiam eget nibh quis orci fringilla ornare eu consequat sem. Pellentesque porttitor, turpis ut efficitur ultrices, massa tortor ornare justo, eget aliquet ante dui eget lorem. Donec blandit, mauris quis vestibulum cursus, tellus diam facilisis enim, vel dignissim magna lacus a arcu. Phasellus vitae dolor.', 'java.jpeg', '2019-06-27 09:12:05', 'published'),
(19, 'bootstrap!!!!!!!!!!!', 'arjol bega', 10, 'lorem!', 'bootstrap-illustration.png', '2019-07-04 09:19:26', 'published');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(3) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `email`, `username`, `password`, `role`) VALUES
(1, 'arjol', 'bega', 'arjolbega1@gmail.com', 'arjol1', '$2y$10$JfeRmhgcoChbrBo2QabEPOZNOZ3/Knf6Oya1Z5BMItNTxruLfCpVm', 'admin'),
(2, 'admin2', 'admin2', 'admin@gmail.com', 'admin2', '$2y$12$HQ.XXxkmH0hnfsYfaz1JHe.mVXKWZ6N0qgsMO1nKRPeVSLTzEeoD.', 'subscriber'),
(3, 'test', 'test', 'test1@hotmail.com', 'testAdmin', '$2y$12$V5qL/Syh0aWyDOBJtuoyeuZcPZA6T5uytUlwrzfG23tHV5fQKSki.', 'subscriber');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`,`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
