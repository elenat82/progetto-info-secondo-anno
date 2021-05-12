-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 12, 2021 alle 23:20
-- Versione del server: 10.4.8-MariaDB
-- Versione PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `taliequadri`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `artisti`
--

CREATE TABLE `artisti` (
  `id_artista` int(11) NOT NULL,
  `nome_artista` varchar(255) NOT NULL,
  `cognome_artista` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `artisti`
--

INSERT INTO `artisti` (`id_artista`, `nome_artista`, `cognome_artista`) VALUES
(1, 'Claudio', 'Monetti'),
(2, 'Vincenzo', 'Goghi'),
(3, 'Paolo', 'Picassi'),
(4, 'Camillo', 'Pissarri'),
(5, 'Edoardo', 'Degassi'),
(6, 'Federica', 'Zandomeneghi'),
(7, 'Gustavo', 'Callebotti'),
(8, 'Gianfederico', 'Bazilli'),
(9, 'Pieraugusto', 'Reneri');

-- --------------------------------------------------------

--
-- Struttura della tabella `indirizzi`
--

CREATE TABLE `indirizzi` (
  `id_indirizzo` int(11) NOT NULL,
  `tipo_indirizzo` enum('f','s','a') NOT NULL COMMENT 'fatturazione, spedizione o altro',
  `nome_indirizzo` varchar(255) NOT NULL,
  `via` varchar(255) NOT NULL,
  `civico` varchar(5) NOT NULL,
  `cap` varchar(6) NOT NULL,
  `comune` varchar(255) NOT NULL,
  `provincia` varchar(3) NOT NULL,
  `stato_indirizzo` varchar(255) NOT NULL,
  `telefono` varchar(255) NOT NULL,
  `id_utente` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `indirizzi`
--

INSERT INTO `indirizzi` (`id_indirizzo`, `tipo_indirizzo`, `nome_indirizzo`, `via`, `civico`, `cap`, `comune`, `provincia`, `stato_indirizzo`, `telefono`, `id_utente`) VALUES
(1, 'f', 'Mario Rossi', 'via Roma', '1', '10100', 'Torino', 'TO', 'Italia', '349-5683652', 'mariorossi@gmail.com'),
(2, 's', 'Mario Rossi', 'via Garibaldi', '100', '10100', 'Torino', 'TO', 'Italia', '011-456554', 'mariorossi@gmail.com'),
(3, 'a', 'Mario Rossi c/o Azienda s.r.l.', 'piazza Castello', '10', '10100', 'Torino', 'TO', 'Italia', '011-555999', 'mariorossi@gmail.com');

-- --------------------------------------------------------

--
-- Struttura della tabella `metodipagamento`
--

CREATE TABLE `metodipagamento` (
  `id_metodo_pag` int(11) NOT NULL,
  `nome_metodo_pag` varchar(255) NOT NULL,
  `icona_metodo_pag` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `metodipagamento`
--

INSERT INTO `metodipagamento` (`id_metodo_pag`, `nome_metodo_pag`, `icona_metodo_pag`) VALUES
(1, 'PayPal', 'fab fa-paypal'),
(2, 'Carta', 'far fa-credit-card');

-- --------------------------------------------------------

--
-- Struttura della tabella `ordini`
--

CREATE TABLE `ordini` (
  `numero_ordine` varchar(9) NOT NULL,
  `data_ordine` date NOT NULL,
  `totale_ordine` int(11) NOT NULL,
  `tipo_pag_ord` int(11) NOT NULL,
  `id_stato_ord` int(11) NOT NULL,
  `id_utente` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `ordini`
--

INSERT INTO `ordini` (`numero_ordine`, `data_ordine`, `totale_ordine`, `tipo_pag_ord`, `id_stato_ord`, `id_utente`) VALUES
('JHAMHWDZI', '2018-07-26', 3700, 1, 3, 'annaverdi@gmail.com'),
('UDKQVHHQR', '2020-11-13', 2400, 2, 2, 'annaverdi@gmail.com');

-- --------------------------------------------------------

--
-- Struttura della tabella `quadri`
--

CREATE TABLE `quadri` (
  `sku` varchar(5) NOT NULL,
  `titolo` varchar(255) NOT NULL,
  `prezzo` int(11) NOT NULL,
  `sconto` int(11) DEFAULT NULL,
  `finale` int(11) DEFAULT NULL COMMENT 'prezzo scontato',
  `immagine` varchar(255) NOT NULL COMMENT 'nome del file immagine',
  `mappa` varchar(500) NOT NULL COMMENT 'url della mappa di Google',
  `id_artista` int(11) NOT NULL,
  `id_stile` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `quadri`
--

INSERT INTO `quadri` (`sku`, `titolo`, `prezzo`, `sconto`, `finale`, `immagine`, `mappa`, `id_artista`, `id_stile`) VALUES
('CM05', 'Claude Monet - Regate ad Argenteuil', 980, 20, 784, 'Claude_Monet_Regate_ad_Argenteuil.jpg', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5249.459823451702!2d2.3254409539862473!3d48.86336048175756!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e671d877937b0f%3A0xb975fcfa192f84d4!2sMuseo%20del%20Louvre!5e0!3m2!1sit!2sit!4v1610993007617!5m2!1sit!2sit', 1, 1),
('CP01', 'Camille Pissarro - Le Grand Noyer a l\'Hermitage', 1000, NULL, NULL, 'Camille_Pissarro_Le_grand_noyer_a_l_Hermitage.jpg', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2482.662188378091!2d-0.12914528350033988!3d51.51941327963724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48761b323093d307%3A0x2fb199016d5642a7!2sBritish%20Museum!5e0!3m2!1sit!2sit!4v1610993245879!5m2!1sit!2sit', 1, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `stati_ordine`
--

CREATE TABLE `stati_ordine` (
  `id_stato_ordine` int(11) NOT NULL,
  `nome_stato_ordine` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `stati_ordine`
--

INSERT INTO `stati_ordine` (`id_stato_ordine`, `nome_stato_ordine`) VALUES
(1, 'Ricevuto'),
(2, 'In lavorazione'),
(3, 'Evaso'),
(4, 'Rifiutato');

-- --------------------------------------------------------

--
-- Struttura della tabella `stili`
--

CREATE TABLE `stili` (
  `id_stile` int(11) NOT NULL,
  `nome_stile` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `stili`
--

INSERT INTO `stili` (`id_stile`, `nome_stile`) VALUES
(1, 'impressionismo'),
(2, 'cubismo'),
(3, 'puntinismo'),
(4, 'futurismo'),
(5, 'iperrealismo'),
(6, 'pop art'),
(7, 'surrealismo'),
(8, 'naif');

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE `utenti` (
  `email` varchar(255) NOT NULL COMMENT 'identificativo univoco utente',
  `nome_utente` varchar(255) NOT NULL,
  `cognome_utente` varchar(255) NOT NULL,
  `password` varchar(16) NOT NULL,
  `datanascita` date NOT NULL,
  `sesso` enum('m','f','a') NOT NULL COMMENT 'maschio, femmina o altro',
  `ruolo` enum('a','u') NOT NULL COMMENT 'amministratore o utente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`email`, `nome_utente`, `cognome_utente`, `password`, `datanascita`, `sesso`, `ruolo`) VALUES
('annaverdi@gmail.com', 'Anna', 'Verdi', 'annaverdi', '1994-02-15', 'f', 'u'),
('mariorossi@gmail.com', 'Mario', 'Rossi', 'mariorossi', '1981-05-02', 'm', 'a');

-- --------------------------------------------------------

--
-- Struttura della tabella `wishlist`
--

CREATE TABLE `wishlist` (
  `id_wishlist` int(11) NOT NULL,
  `nome_wishlist` varchar(255) NOT NULL,
  `id_utente` varchar(255) NOT NULL,
  `sku_quadro` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `wishlist`
--

INSERT INTO `wishlist` (`id_wishlist`, `nome_wishlist`, `id_utente`, `sku_quadro`) VALUES
(1, 'Lista nozze', 'annaverdi@gmail.com', 'CM05'),
(2, 'Casa al mare', 'annaverdi@gmail.com', 'CP01');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `artisti`
--
ALTER TABLE `artisti`
  ADD PRIMARY KEY (`id_artista`);

--
-- Indici per le tabelle `indirizzi`
--
ALTER TABLE `indirizzi`
  ADD PRIMARY KEY (`id_indirizzo`),
  ADD KEY `fk` (`id_utente`);

--
-- Indici per le tabelle `metodipagamento`
--
ALTER TABLE `metodipagamento`
  ADD PRIMARY KEY (`id_metodo_pag`);

--
-- Indici per le tabelle `ordini`
--
ALTER TABLE `ordini`
  ADD PRIMARY KEY (`numero_ordine`) USING BTREE,
  ADD KEY `fk_utente` (`id_utente`),
  ADD KEY `fk_stato` (`id_stato_ord`),
  ADD KEY `fk_pagamento` (`tipo_pag_ord`);

--
-- Indici per le tabelle `quadri`
--
ALTER TABLE `quadri`
  ADD PRIMARY KEY (`sku`),
  ADD UNIQUE KEY `sku` (`sku`),
  ADD KEY `fk` (`id_artista`),
  ADD KEY `fk_stile` (`id_stile`);

--
-- Indici per le tabelle `stati_ordine`
--
ALTER TABLE `stati_ordine`
  ADD PRIMARY KEY (`id_stato_ordine`);

--
-- Indici per le tabelle `stili`
--
ALTER TABLE `stili`
  ADD PRIMARY KEY (`id_stile`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`email`);

--
-- Indici per le tabelle `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id_wishlist`),
  ADD KEY `fk` (`id_utente`),
  ADD KEY `fk_quadro` (`sku_quadro`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `artisti`
--
ALTER TABLE `artisti`
  MODIFY `id_artista` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT per la tabella `indirizzi`
--
ALTER TABLE `indirizzi`
  MODIFY `id_indirizzo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `metodipagamento`
--
ALTER TABLE `metodipagamento`
  MODIFY `id_metodo_pag` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `stati_ordine`
--
ALTER TABLE `stati_ordine`
  MODIFY `id_stato_ordine` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `stili`
--
ALTER TABLE `stili`
  MODIFY `id_stile` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT per la tabella `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id_wishlist` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `indirizzi`
--
ALTER TABLE `indirizzi`
  ADD CONSTRAINT `indirizzi_ibfk_1` FOREIGN KEY (`id_utente`) REFERENCES `utenti` (`email`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `ordini`
--
ALTER TABLE `ordini`
  ADD CONSTRAINT `ordini_ibfk_1` FOREIGN KEY (`id_utente`) REFERENCES `utenti` (`email`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ordini_ibfk_2` FOREIGN KEY (`id_stato_ord`) REFERENCES `stati_ordine` (`id_stato_ordine`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ordini_ibfk_3` FOREIGN KEY (`tipo_pag_ord`) REFERENCES `metodipagamento` (`id_metodo_pag`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `quadri`
--
ALTER TABLE `quadri`
  ADD CONSTRAINT `quadri_ibfk_1` FOREIGN KEY (`id_artista`) REFERENCES `artisti` (`id_artista`) ON UPDATE CASCADE,
  ADD CONSTRAINT `quadri_ibfk_2` FOREIGN KEY (`id_stile`) REFERENCES `stili` (`id_stile`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`id_utente`) REFERENCES `utenti` (`email`) ON UPDATE CASCADE,
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`sku_quadro`) REFERENCES `quadri` (`sku`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
