-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2025 at 09:59 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portfolio_platform`
--

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `project_image_path` varchar(255) DEFAULT NULL,
  `technologies` varchar(255) DEFAULT NULL,
  `project_link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `user_id`, `title`, `description`, `project_image_path`, `technologies`, `project_link`) VALUES
(1, 1, 'webdevelopment', 'jfkdfkagkfaskjfafa', 'uploads/projects/68edecece0447_CV_AI_page-0001.jpg', 'HTML,CSS,JavaScript', NULL),
(2, 2, 'Data science', 'jhjhsakdjas', 'uploads/projects/68eded6e8f2e7_EMPATHY.jpg', 'python', NULL),
(3, 3, 'dfh', 'iwant to become a datascientist', '', 'a,a,asf,ds,,sdf', NULL),
(4, 6, 'Meet', 'web development', 'uploads/projects/68edf1fa8cd9f_EMPATHY.jpg', 'HTML,CSS,JavaScript,php,mysql', NULL),
(5, 7, 'datascientist', 'adgfgfb sgbvc  ghbfdczbv fdbvfc', 'uploads/projects/68edf5acddad5_Screenshot 2025-09-28 165643.png', 'a,a,asf,ds,,sdf', NULL),
(6, 8, 'Kalpesh', 'WD KA BADSHAH', 'uploads/projects/68edfa709244f_p1.png', 'LOKO NE CODU BANAVAVA', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `skill_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `user_id`, `skill_name`) VALUES
(1, 7, 'css,javascript,php,dart,python');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `bio` text DEFAULT NULL,
  `profile_image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password_hash`, `bio`, `profile_image_path`, `created_at`, `updated_at`) VALUES
(1, 'XYZ', 'xyz@gmail.com', '$2y$10$bI5uNcbZmG2YrMt6Mm5yIejEdWX3xueta1c.AyWTdKTBAlqcssED6', NULL, NULL, '2025-10-14 06:22:56', '2025-10-14 06:22:56'),
(2, 'Kalpesh', 'kalpesh@gmail.com', '$2y$10$2JW1rmhP5K2qpDeK6Ml.8..TF7UqJ6t4QPUog01vS0v3m0JQ0IOH6', NULL, NULL, '2025-10-14 06:26:51', '2025-10-14 06:26:51'),
(3, 'abc', 'abc@gmail', '$2y$10$b8mxNlCLqC5m0bMGxtbePOExmcK.Hy/0O0fKdbcwBX6xvABJUIyxG', NULL, NULL, '2025-10-14 06:30:24', '2025-10-14 06:30:24'),
(6, 'meet', 'meet@gmail.com', '$2y$10$Pi9ATTAIZp8myHVmt4J9AORGLbh9x/AsMeZwD/zPVMdofDNeS6ni6', 'developer', 'uploads/profiles/68edf222ec90a_mysign.jpg', '2025-10-14 06:45:43', '2025-10-14 06:48:02'),
(7, 'rajveer', 'rajveer@gmail.com', '$2y$10$FAVK40wvYHse9TUwot7AcuehCioQj2kjZVRDzKuxsUVdtsqxIuHAO', 'hello i am rajveer', 'uploads/profiles/68edf5ec4900a_p1.png', '2025-10-14 07:01:53', '2025-10-14 07:04:12'),
(8, 'xyz', 'xyz@gmail', '$2y$10$exs2N7skugZUApCjZriygud0W3Zd.Utxpe9Ay87qHVufoYE7ARjAG', NULL, NULL, '2025-10-14 07:22:24', '2025-10-14 07:22:24');

-- --------------------------------------------------------

--
-- Table structure for table `user_projects`
--

CREATE TABLE `user_projects` (
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `project_title` varchar(150) NOT NULL,
  `project_description` text NOT NULL,
  `project_image` varchar(255) DEFAULT NULL,
  `project_technologies` varchar(255) DEFAULT NULL,
  `project_link` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_projects`
--

INSERT INTO `user_projects` (`project_id`, `user_id`, `project_title`, `project_description`, `project_image`, `project_technologies`, `project_link`, `created_at`) VALUES
(1, 7, 'abc', 'agfdbveadr', 'uploads/projects/68edf91972219_bc.jpg', 'html,css', '', '2025-10-14 07:17:45'),
(2, 8, 'DATASCIENCE', 'TO PREDICT CYBER CRIME', 'uploads/projects/68edfad3541f9_Screenshot_2024-12-17-20-48-41-96_99c04817c0de5652397fc8b56c3b3817.jpg', 'Python and machine learning', '', '2025-10-14 07:25:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_projects`
--
ALTER TABLE `user_projects`
  ADD PRIMARY KEY (`project_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_projects`
--
ALTER TABLE `user_projects`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `skills`
--
ALTER TABLE `skills`
  ADD CONSTRAINT `skills_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_projects`
--
ALTER TABLE `user_projects`
  ADD CONSTRAINT `user_projects_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
