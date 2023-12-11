-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2023 at 11:22 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moja_strona`
--

-- --------------------------------------------------------

--
-- Table structure for table `page_list`
--

CREATE TABLE `page_list` (
  `id` int(11) NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `page_content` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `page_list`
--

INSERT INTO `page_list` (`id`, `page_title`, `page_content`, `status`) VALUES
(2, 'ELT', '<div class=\"text-container\">\r\n          <h2>\r\n            <p>Ekstremalnie Wielki Teleskop (ELT) to największy teleskop optyczny na świecie, który jest obecnie w budowie na pustyni Atakama w Chile. ELT będzie miał zwierciadło główne o średnicy 39,3 m, co jest pięć razy więcej niż największe zwierciadła obecnie używane w teleskopach optycznych.</p>\r\n            <p>Budowa ELT rozpoczęła się w 2014 roku i ma potrwać do 2027 roku. W 2023 roku budowa jest w zaawansowanym stadium, a większość elementów teleskopu jest już wyprodukowana lub jest w trakcie produkcji.</p>\r\n            Budowa ELT\r\n            <br><br>\r\n            ELT będzie składał się z trzech głównych elementów: \r\n            \r\n            <ul>\r\n                <li>\r\n                    Zwierciadło główne będzie składać się z 798 sześciokątnych segmentów, które zostaną połączone w jednolitą powierzchnię.\r\n                    <br>\r\n                    <figure>\r\n                        <img src=\"img/Zwierciadlo-ELT.jpg\" alt=\"Opis zdjęcia\">\r\n                        <figcaption>\r\n                            Zwierciadło główne ELT\r\n                        </figcaption>\r\n                    </figure>\r\n                    \r\n                </li>\r\n                <li>\r\n                    Teleskop optyczny będzie składał się z systemu soczewek i luster, które skupiają światło z gwiazd i innych obiektów na matrycy kamery.\r\n                    <figure>\r\n                        <img src=\"img/teleskop optyczny ELT.jpg\" alt=\"Opis zdjęcia\">\r\n                        <figcaption>\r\n                            Teleskop optyczny ELT\r\n                        </figcaption>\r\n                    </figure>\r\n                </li>\r\n                <li>\r\n                    System optyczny adaptacyjny będzie kompensował zakłócenia atmosferyczne, aby zapewnić wyraźny obraz obiektów obserwowanych przez teleskop.\r\n                    <figure>\r\n                        <img src=\"img/Schemat systemu optycznego ELT.jpg\" alt=\"Opis zdjęcia\">\r\n                        <figcaption>\r\n                            Schemat systemu optycznego ELT\r\n                        </figcaption>\r\n                    </figure>\r\n                </li>\r\n            </ul>\r\n            <p> mają nadzieję, że ELT pozwoli im na dokonanie przełomowych odkryć w astronomii. Teleskop będzie w stanie obserwować obiekty, które są zbyt słabe lub zbyt odległe, aby można je było zobaczyć za pomocą mniejszych teleskopów. ELT będzie również w stanie obserwować w zakresie światła podczerwonego, który pozwala na zobaczenie obiektów, które są zasłonięte przez chmury pyłu lub gazu.</p>\r\n\r\n            <p>ELT ma szansę zrewolucjonizować naszą wiedzę o wszechświecie. Teleskop może pomóc astronomom zrozumieć, jak powstały i ewoluowały gwiazdy i galaktyki. ELT może również pomóc astronomom w poszukiwaniu planet pozasłonecznych, które mogą być zdolne do podtrzymywania życia.</p>\r\n            <br><br>\r\n            Polska w ELT\r\n            <br><br>\r\n            <p>Polska jest jednym z krajów partnerskich projektu ELT. Polska firma Astrium Space Systems, obecnie Airbus Defence and Space, wyprodukowała 150 z 798 segmentów zwierciadła głównego. Polska firma Astronika dostarczyła również systemy optyczne dla teleskopu.</p>\r\n            <br><br>\r\n            Planowane otwarcie ELT\r\n            <br><br>\r\n            <p>ELT ma zostać otwarty w 2027 roku. Po uruchomieniu teleskop będzie dostępny dla astronomów z całego świata.</p>\r\n            \r\n        </h2>\r\n        </div>\r\n      </div>', 1),
(3, 'Jowisz', '\r\n        <div class=\"text-container\">\r\n          <h2>\r\n            <b>Ostatnie uderzenie w Jowisza</b>\r\n\r\n            <p>28 sierpnia 2023 roku astronomowie amatorzy zarejestrowali świetlne zjawisko w atmosferze Jowisza. Jest to prawdopodobnie uderzenie małej planetoidy lub komety w atmosferę największej planety Układu Słonecznego.</p>\r\n\r\n            <p>Zdjęcie zjawiska wykonał astronom amator z Japonii. Na zdjęciu widać jasny błysk światła, który trwał około sekundy. Błysk był spowodowany przez wyzwolenie energii podczas zderzenia.</p>\r\n\r\n            <p>Naukowcy szacują, że obiekt, który uderzył w Jowisza, miał średnicę około 10 metrów. Uderzenie uwolniło energię odpowiadającą około 100 megatonom trotylu.</p>\r\n\r\n            <p>Uderzenia w Jowisza zdarzają się regularnie. Atmosfera Jowisza jest tak duża i gęsta, że ​​jest w stanie pochłonąć zderzenia z obiektami o średnicy nawet kilku kilometrów. </p>\r\n            <figure>\r\n              <img src=\"img/Jowisz.jpg\" width=\"400\" height=\"auto\">\r\n              <figcaption>\r\n                ASTEROIDA UDERZA W JOWISZA!\r\n              </figcaption>\r\n          </figure>\r\n          <p>Uderzenia w Jowisza są ważne dla astronomów, ponieważ mogą dostarczyć informacji o skład chemiczny i strukturze atmosfery Jowisza.</p>\r\n          </h2>\r\n        </div>', 1),
(4, 'SpaceX', '\r\n        <div class=\"text-container\">\r\n          <h2>\r\n            <p>SpaceX, firma założona przez Elona Muska, jest jednym z wiodących firm w branży kosmicznej. W 2023 roku SpaceX kontynuuje rozwój swoich programów kosmicznych, w tym Starlink, Starship i Dragon.</p>\r\n            <br>\r\n            <b>Program Starlink</b>\r\n            <p>Program Starlink obejmuje konstelację tysięcy satelitów telekomunikacyjnych, które zapewniają dostęp do internetu na całym świecie. W 2023 roku SpaceX uruchomił ponad 2000 satelitów Starlink, a liczba ta stale rośnie. SpaceX planuje zapewnić dostęp do internetu dla ponad 500 milionów osób na całym świecie do 2025 roku. </p>\r\n            <figure>\r\n              <img src=\"img/starlink.jpg\" width=\"400\" height=\"auto\">\r\n              <figcaption>\r\n                Konstelacja satelitów Starlink\r\n              </figcaption>\r\n            </figure>\r\n            <br>\r\n            <b>Program Starship</b>\r\n            <p>Program Starship obejmuje nową rakietę wielokrotnego użytku, która ma być w stanie transportować ludzi i ładunki na Księżyc i Marsa. W 2023 roku SpaceX przeprowadził kilka testów prototypów Starship, w tym jeden udany lot suborbitalny. SpaceX planuje uruchomić pierwszą misję orbitalną Starship w 2024 roku. </p>\r\n            <figure>\r\n              <img src=\"img/starship.jpg\" width=\"400\" height=\"auto\">\r\n              <figcaption>\r\n                Prototyp rakiety Starship\r\n              </figcaption>\r\n            </figure>\r\n            <br>\r\n            <b>Program Dragon</b>\r\n            <p>Program Dragon obejmuje kapsułę kosmiczną, która jest używana do transportu ludzi i ładunków na Międzynarodową Stację Kosmiczną. W 2023 roku SpaceX przeprowadził kilka misji Dragona na ISS, w tym jedną misję załogową. SpaceX planuje kontynuować wykonywanie misji Dragona na ISS przez co najmniej kilka lat. </p>\r\n            <figure>\r\n              <img src=\"img/kapsula.jpg\" width=\"400\" height=\"auto\">\r\n              <figcaption>\r\n                Kapsuła kosmiczna Dragon\r\n              </figcaption>\r\n            </figure>\r\n            <p>Ogólnie rzecz biorąc, SpaceX ma dobry rok w 2023 roku. Firma kontynuuje rozwój swoich programów kosmicznych i osiąga znaczne postępy. SpaceX jest w dobrej pozycji, aby stać się wiodącą firmą w branży kosmicznej w nadchodzących latach.</p>\r\n          </h2>\r\n        </div>\r\n', 1),
(5, 'Mars', '\r\n        <div class=\"text-container\">\r\n          <h2>\r\n          <p>Mars jest od dawna obiektem zainteresowania naukowców i badaczy. W ostatnich latach nastąpił znaczny postęp w badaniach Marsa, dzięki czemu naukowcy odkryli nowe informacje o historii, geologii i potencjale dla życia na Czerwonej Planecie.</p>\r\n          <br>\r\n          <b>Oto niektóre z najnowszych odkryć i misji badawczych na Marsie:</b>\r\n          <ul>\r\n            <li>NASA Mars 2020: Ta misja wystrzeliła w 2020 roku i wylądowała na Marsie w lutym 2021 roku. Misja wysłała na powierzchnię łazik Perseverance, który przeprowadził badania geologiczne i środowiskowe Marsa. Łazik Perseverance odkrył dowody na to, że Mars kiedyś był znacznie bardziej wilgotny i przyjazny dla życia.\r\n              <figure>\r\n                <img src=\"img/lazik.png\" width=\"400\" height=\"auto\">\r\n                <figcaption>\r\n                  Łazik Perseverance na Marsie\r\n                </figcaption>\r\n            </figure>\r\n            </li>\r\n            <li>\r\n              Chińska misja Tianwen-1: Ta misja wystrzeliła w 2020 roku i osiągnęła orbitę Marsa w lutym 2021 roku. Misja wysłała na powierzchnię łazik Zhurong, który przeprowadził badania geologiczne i środowiskowe Marsa. Łazik Zhurong odkrył dowody na to, że Mars kiedyś miał aktywne wulkany i rzeki.\r\n              <figure>\r\n                <img src=\"img/lazik_z.jpg\" width=\"400\" height=\"auto\">\r\n                <figcaption>\r\n                  Łazik Zhurong na Marsie\r\n                </figcaption>\r\n            </figure>\r\n\r\n            </li>\r\n            <li>\r\n              Europejska misja ExoMars Rover: Ta misja wystrzeliła w 2022 roku i ma wylądować na Marsie w 2023 roku. Misja wysłała na powierzchnię łazik Rosalind Franklin, który przeprowadzi badania geologiczne i środowiskowe Marsa. Łazik Rosalind Franklin będzie szukał dowodów na życie na Marsie.\r\n            </li>\r\n            <figure>\r\n              <img src=\"img/lazik_r.jpg\" width=\"400\" height=\"auto\">\r\n              <figcaption>\r\n                Łazik Perseverance na Marsie\r\n              </figcaption>\r\n          </figure>\r\n          </ul>\r\n          \r\n          <p>Te odkrycia i misje badawcze są kamieniami milowymi w badaniach Marsa. Pomagają one naukowcom lepiej zrozumieć historię i geologię Marsa, a także potencjał dla życia na Czerwonej Planecie.</p>\r\n          \r\n          <p>W nadchodzących latach planowane są dalsze misje badawcze Marsa. W 2024 roku NASA planuje wysłać na Marsa łazik o nazwie Mars Sample Return, który zabierze próbki skał i gleby z powierzchni Marsa na Ziemię do dalszych badań.</p>\r\n        \r\n          <p>Te misje pomogą naukowcom lepiej zrozumieć Marsa i odpowiedzieć na pytanie, czy kiedykolwiek istniało życie na Czerwonej Planecie.</p>\r\n        </h2>\r\n        </div>', 1),
(6, 'IDK', '\r\n        <div class=\"text-container\">\r\n          <h2>\r\n            <b>Ostatnie uderzenie w Jowisza</b>\r\n\r\n            <p>28 sierpnia 2023 roku astronomowie amatorzy zarejestrowali świetlne zjawisko w atmosferze Jowisza. Jest to prawdopodobnie uderzenie małej planetoidy lub komety w atmosferę największej planety Układu Słonecznego.</p>\r\n\r\n            <p>Zdjęcie zjawiska wykonał astronom amator z Japonii. Na zdjęciu widać jasny błysk światła, który trwał około sekundy. Błysk był spowodowany przez wyzwolenie energii podczas zderzenia.</p>\r\n\r\n            <p>Naukowcy szacują, że obiekt, który uderzył w Jowisza, miał średnicę około 10 metrów. Uderzenie uwolniło energię odpowiadającą około 100 megatonom trotylu.</p>\r\n\r\n            <p>Uderzenia w Jowisza zdarzają się regularnie. Atmosfera Jowisza jest tak duża i gęsta, że ​​jest w stanie pochłonąć zderzenia z obiektami o średnicy nawet kilku kilometrów. </p>\r\n            <figure>\r\n              <img src=\"img/Jowisz.jpg\" width=\"400\" height=\"auto\">\r\n              <figcaption>\r\n                ASTEROIDA UDERZA W JOWISZA!\r\n              </figcaption>\r\n          </figure>\r\n          <p>Uderzenia w Jowisza są ważne dla astronomów, ponieważ mogą dostarczyć informacji o skład chemiczny i strukturze atmosfery Jowisza.</p>\r\n          </h2>\r\n        </div>\r\n\r\n      </div>', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `page_list`
--
ALTER TABLE `page_list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `page_list`
--
ALTER TABLE `page_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
