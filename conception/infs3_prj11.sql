

CREATE TABLE `ActeOuProduit` (
  `id` int(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `PU_TTC` double NOT NULL
)


CREATE TABLE `Animal` (
  `animalId` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `birthDay` date NOT NULL,
  `deathDay` date DEFAULT NULL,
  `comment` varchar(256) DEFAULT NULL,
  `userId` varchar(50) NOT NULL,
  `threatId` int(11) NOT NULL,
  `genderId` int(11) NOT NULL,
  `raceId` int(11) NOT NULL,
  `dress` varchar(255) DEFAULT NULL,
  `weight` varchar(50) DEFAULT NULL,
  `tatoo` varchar(6) DEFAULT NULL,
  `chip` varchar(19) DEFAULT NULL
)

CREATE TABLE `Command` (
  `commandId` varchar(50) NOT NULL,
  `commandPrice` decimal(15,2) NOT NULL,
  `commandDate` date DEFAULT NULL
)

CREATE TABLE `Concern` (
  `meetingId` varchar(50) NOT NULL,
  `timeSlotId` int(11) NOT NULL
)

CREATE TABLE `Content` (
  `productId` int(11) NOT NULL,
  `commandId` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL
)

CREATE TABLE `GenderStatus` (
  `genderId` int(11) NOT NULL,
  `genderName` varchar(50) NOT NULL
)

CREATE TABLE `Horaire` (
  `userId` varchar(50) NOT NULL,
  `timeSlotId` int(11) NOT NULL
)

CREATE TABLE `Meeting` (
  `meetingId` varchar(50) NOT NULL,
  `meetingDate` date NOT NULL,
  `isPayed` int(11) NOT NULL DEFAULT 0,
  `price` double(25,2) DEFAULT NULL,
  `userId` varchar(50) NOT NULL,
  `animalId` varchar(50) DEFAULT NULL,
  `vetoId` varchar(50) NOT NULL,
  `speciesId` int(11) DEFAULT NULL
)

CREATE TABLE `News` (
  `newsId` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `dateNews` date NOT NULL,
  `userId` varchar(50) NOT NULL
)

CREATE TABLE `Products` (
  `productId` int(11) NOT NULL,
  `productName` varchar(50) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `quantityLimit` int(11) NOT NULL
)

CREATE TABLE `Race` (
  `raceId` int(11) NOT NULL,
  `raceName` varchar(50) NOT NULL,
  `speciesId` int(11) NOT NULL
)

CREATE TABLE `Species` (
  `speciesId` int(11) NOT NULL,
  `speciesName` varchar(50) NOT NULL
)

CREATE TABLE `Threat` (
  `threatId` int(11) NOT NULL,
  `threatName` varchar(50) NOT NULL
)

CREATE TABLE `TimeSlot` (
  `timeSlotId` int(11) NOT NULL,
  `startHour` time DEFAULT NULL,
  `endHour` time DEFAULT NULL,
  `dayName` varchar(50) NOT NULL,
  `typeId` int(11) NOT NULL
)

CREATE TABLE `TimeSlotType` (
  `typeId` int(11) NOT NULL,
  `typeName` varchar(50) NOT NULL
)

CREATE TABLE `Users` (
  `userId` varchar(50) NOT NULL,
  `cp` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `rue` varchar(50) DEFAULT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(256) CHARACTER SET utf8 NOT NULL,
  `isAdmin` int(11) NOT NULL DEFAULT 0,
  `isVeto` int(11) NOT NULL DEFAULT 0,
  `comment` varchar(256) DEFAULT NULL
)

CREATE TABLE `Vaccinated` (
  `idVaccine` varchar(50) NOT NULL,
  `idAnimal` varchar(50) NOT NULL,
  `dateVaccine` date NOT NULL
)

CREATE TABLE `Vaccine` (
  `idVaccine` varchar(50) NOT NULL,
  `idSpecies` varchar(50) NOT NULL,
  `vaccineName` varchar(255) NOT NULL
)

--
-- Index pour la table `ActeOuProduit`
--
ALTER TABLE `ActeOuProduit`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Animal`
--
ALTER TABLE `Animal`
  ADD PRIMARY KEY (`animalId`),
  ADD KEY `userId` (`userId`),
  ADD KEY `ThreatId` (`threatId`),
  ADD KEY `genderId` (`genderId`),
  ADD KEY `raceId` (`raceId`);

--
-- Index pour la table `Command`
--
ALTER TABLE `Command`
  ADD PRIMARY KEY (`commandId`);

--
-- Index pour la table `Concern`
--
ALTER TABLE `Concern`
  ADD PRIMARY KEY (`meetingId`,`timeSlotId`),
  ADD KEY `concern_fk_timeslot` (`timeSlotId`);

--
-- Index pour la table `Content`
--
ALTER TABLE `Content`
  ADD PRIMARY KEY (`productId`,`commandId`),
  ADD KEY `commandId` (`commandId`);

--
-- Index pour la table `GenderStatus`
--
ALTER TABLE `GenderStatus`
  ADD PRIMARY KEY (`genderId`);

--
-- Index pour la table `Horaire`
--
ALTER TABLE `Horaire`
  ADD PRIMARY KEY (`userId`,`timeSlotId`),
  ADD KEY `timeSlotId` (`timeSlotId`);

--
-- Index pour la table `Meeting`
--
ALTER TABLE `Meeting`
  ADD PRIMARY KEY (`meetingId`),
  ADD KEY `userId` (`userId`),
  ADD KEY `animalId` (`animalId`),
  ADD KEY `fk_vetoId` (`vetoId`),
  ADD KEY `speciesId` (`speciesId`);

--
-- Index pour la table `News`
--
ALTER TABLE `News`
  ADD PRIMARY KEY (`newsId`),
  ADD KEY `userId` (`userId`);

--
-- Index pour la table `Products`
--
ALTER TABLE `Products`
  ADD PRIMARY KEY (`productId`);

--
-- Index pour la table `Race`
--
ALTER TABLE `Race`
  ADD PRIMARY KEY (`raceId`),
  ADD KEY `speciesId` (`speciesId`);

--
-- Index pour la table `Species`
--
ALTER TABLE `Species`
  ADD PRIMARY KEY (`speciesId`);

--
-- Index pour la table `Threat`
--
ALTER TABLE `Threat`
  ADD PRIMARY KEY (`threatId`);

--
-- Index pour la table `TimeSlot`
--
ALTER TABLE `TimeSlot`
  ADD PRIMARY KEY (`timeSlotId`),
  ADD KEY `typeId` (`typeId`);

--
-- Index pour la table `TimeSlotType`
--
ALTER TABLE `TimeSlotType`
  ADD PRIMARY KEY (`typeId`);

--
-- Index pour la table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`userId`);

--
-- Index pour la table `Vaccinated`
--
ALTER TABLE `Vaccinated`
  ADD PRIMARY KEY (`idVaccine`,`idAnimal`);

--
-- Index pour la table `Vaccine`
--
ALTER TABLE `Vaccine`
  ADD PRIMARY KEY (`idVaccine`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `ActeOuProduit`
--
ALTER TABLE `ActeOuProduit`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT pour la table `TimeSlot`
--
ALTER TABLE `TimeSlot`
  MODIFY `timeSlotId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=221;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Animal`
--
ALTER TABLE `Animal`
  ADD CONSTRAINT `Animal_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `Users` (`userId`),
  ADD CONSTRAINT `Animal_ibfk_2` FOREIGN KEY (`ThreatId`) REFERENCES `Threat` (`ThreatId`),
  ADD CONSTRAINT `Animal_ibfk_3` FOREIGN KEY (`genderId`) REFERENCES `GenderStatus` (`genderId`),
  ADD CONSTRAINT `Animal_ibfk_4` FOREIGN KEY (`raceId`) REFERENCES `Race` (`raceId`);

--
-- Contraintes pour la table `Concern`
--
ALTER TABLE `Concern`
  ADD CONSTRAINT `Concern_ibfk_1` FOREIGN KEY (`meetingId`) REFERENCES `Meeting` (`meetingId`),
  ADD CONSTRAINT `Concern_ibfk_2` FOREIGN KEY (`timeSlotId`) REFERENCES `TimeSlot` (`timeSlotId`),
  ADD CONSTRAINT `concern_fk_meeting` FOREIGN KEY (`meetingId`) REFERENCES `Meeting` (`meetingId`),
  ADD CONSTRAINT `concern_fk_timeslot` FOREIGN KEY (`timeSlotId`) REFERENCES `TimeSlot` (`timeSlotId`);

--
-- Contraintes pour la table `Content`
--
ALTER TABLE `Content`
  ADD CONSTRAINT `Content_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `Products` (`productId`),
  ADD CONSTRAINT `Content_ibfk_2` FOREIGN KEY (`commandId`) REFERENCES `Command` (`commandId`);

--
-- Contraintes pour la table `Horaire`
--
ALTER TABLE `Horaire`
  ADD CONSTRAINT `Horaire_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `Users` (`userId`),
  ADD CONSTRAINT `Horaire_ibfk_2` FOREIGN KEY (`timeSlotId`) REFERENCES `TimeSlot` (`timeSlotId`);

--
-- Contraintes pour la table `Meeting`
--
ALTER TABLE `Meeting`
  ADD CONSTRAINT `Meeting_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `Users` (`userId`),
  ADD CONSTRAINT `Meeting_ibfk_2` FOREIGN KEY (`animalId`) REFERENCES `Animal` (`animalId`),
  ADD CONSTRAINT `Meeting_ibfk_3` FOREIGN KEY (`speciesId`) REFERENCES `Species` (`speciesId`),
  ADD CONSTRAINT `fk_vetoId` FOREIGN KEY (`vetoId`) REFERENCES `Users` (`userId`);

--
-- Contraintes pour la table `News`
--
ALTER TABLE `News`
  ADD CONSTRAINT `News_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `Users` (`userId`);

--
-- Contraintes pour la table `Race`
--
ALTER TABLE `Race`
  ADD CONSTRAINT `Race_ibfk_1` FOREIGN KEY (`speciesId`) REFERENCES `Species` (`speciesId`);

--
-- Contraintes pour la table `TimeSlot`
--
ALTER TABLE `TimeSlot`
  ADD CONSTRAINT `TimeSlot_ibfk_1` FOREIGN KEY (`typeId`) REFERENCES `TimeSlotType` (`typeId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
