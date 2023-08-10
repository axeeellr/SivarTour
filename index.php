<?php include 'php/controlador.php'; ?>
<?php 
    if (isset($_SESSION['isLogin'])) {
        ?>
            <style type="text/css">
                .header__nav{
                    display: none;
                }
            </style>
        <?php
    }else {
        ?>
            <style type="text/css">
                .option:nth-child(2), .option:nth-child(3){
                    display: none;
                }
            </style>
        <?php
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Google Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300&display=swap" rel="stylesheet">
    <!--CSS-->

    <!--Frameworks-->
    <script src="https://cdn.jsdelivr.net/npm/kute.js@2.1.2/dist/kute.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/awesomplete/1.1.2/awesomplete.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/awesomplete/1.1.2/awesomplete.min.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" charset="utf-8"></script>
    <script src="js/mapoid.js"></script>

    <script src="js/jquery.rwdImageMaps.js"></script>
    <script src="js/jquery.rwdImageMaps.min.js"></script>

    <!--FontAwesome-->
    <script src="https://kit.fontawesome.com/61fb4717c0.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<style><?php include 'css/index.css' ?></style>
<body>
    <div class="area" >
        <ul class="circles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div >
    <div class="loader__container">
        <div class="loader"></div>
    </div>
    <header class="header">
        <div class="header__logo"><img src="img/logo.png"></div>
        <nav class="header__nav">
            <form method="post" class="header__ul">
                <input type="submit" name="goLogin" class="header__li" value="Registrarse">
                <input type="submit" name="goLogin" class="header__li" value="Iniciar Sesión">
            </form>
        </nav>
        <div class="options__menu">
            <div class="option notifications">
                <div class="option__title">
                    <i class="fa-regular fa-bell"></i>
                    <h3>Notificaciones</h3>
                    <i class="hideNotis fa-solid fa-chevron-down"></i>
                </div>
                <div class="option__info__container hide">
                    <div class="option__info">
                        <i class="fa-solid fa-xmark close"></i>
                        <h4>Publicación rechazada</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi maiores ipsum dolorum.</p>
                    </div>
                    <div class="option__info">
                        <i class="fa-solid fa-xmark close"></i>
                        <h4>Publicación aceptada</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi maiores ipsum dolorum.</p>
                    </div>
                </div>
            </div>
            <div class="option profile">
                <i class="fa-regular fa-circle-user"></i>
                <h3>Mi perfil</h3>
            </div>
            <div class="option favorites">
                <i class="fa-regular fa-star"></i>
                <h3>Mis favoritos</h3>
            </div>
            <div class="option translate">
                <input type="checkbox" id="cambiar">
                <label for="cambiar">aquí se cambia el idioma</label>
            </div>
        </div>
        <div class="header__options">
            <!--<a href="profile.php" class="profile"><i class="fa-regular fa-circle-user"></i></a>-->
            <!--<i class="fa-solid fa-globe"></i>-->
            <i class="fa-solid fa-bars-staggered showMenu"></i>
        </div>
    </header>

    <div class="hero">

        <div class="hero__container">
            <img src="img/explora.png" alt="" class="hero__text">
            <svg id="visual" viewBox="0 0 960 540"  xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1">
                <g transform="translate(447.1003487837197 265.51596821062077)">
                    <path id="blob1"
                        d="M150.6 -128.1C195.6 -105.6 232.8 -52.8 227.1 -5.7C221.5 41.5 173 83 128 111.6C83 140.3 41.5 156.2 3.8 152.4C-33.9 148.6 -67.9 125.2 -96.7 96.5C-125.5 67.9 -149.3 33.9 -158.1 -8.8C-167 -51.6 -160.9 -103.2 -132.1 -125.7C-103.2 -148.2 -51.6 -141.6 0.6 -142.2C52.8 -142.8 105.6 -150.6 150.6 -128.1"
                        fill="#ED735C">
                    </path>
                </g>
                <g transform="translate(483.8593365141332 273.18306880966463)" style="visibility: hidden;">
                    <path id="blob2"
                        d="M142.8 -144.5C178.1 -107.5 195.1 -53.7 200 4.9C205 63.6 197.9 127.3 162.6 160.3C127.3 193.3 63.6 195.6 15.9 179.7C-31.8 163.8 -63.6 129.6 -107.1 96.6C-150.6 63.6 -205.8 31.8 -209 -3.2C-212.2 -38.2 -163.4 -76.4 -119.9 -113.4C-76.4 -150.4 -38.2 -186.2 7.8 -194C53.7 -201.7 107.5 -181.5 142.8 -144.5"
                        fill="#ED735C">
                    </path>
                </g>
            </svg>
        </div>
        <button class="hero__button">COMENZAR &nbsp;<i class="fa-sharp fa-solid fa-arrow-right"></i></button>
    </div>
    <hr>
    <div class="map">
        <div class="map__info">
            <h1>EXPLORA YA!</h1>
            <p>Encontrar lugares turísticos nunca había sido tan fácil, ahora puedes seleccionar un departamento y encontrar los lugares turísticos que se encuentran en el. Pruébalo!</p>
        </div>
        <div class="map__img">
            <img src="img/map.png" usemap="#imagemap" class="mapimg">
            <map name="imagemap">
                <area class="department" alt="Santa Ana" title="Santa Ana" href="department.php?places=Santa Ana" coords="519,63,536,49,568,33,596,42,625,14,640,31,665,47,692,69,700,88,716,106,730,111,734,130,722,166,685,182,686,213,683,229,647,243,616,270,614,297,595,334,600,352,628,355,617,389,621,412,591,429,573,452,577,472,577,500,572,523,559,542,492,507,464,514,439,498,416,477,395,452,367,451,381,412,388,382,370,361,358,334,356,309,374,278,413,242,437,228,478,221,508,205,522,205,536,188,520,161,513,150,508,122,492,112,480,115,480,101,496,92,501,82,483,71,487,59,503,52" shape="poly">
                <area class="department" alt="Ahuachapán" title="Ahuachapán" href="department.php?places=Ahuachapán" coords="351,345,362,363,381,375,374,402,367,420,360,451,310,462,307,473,323,487,314,506,303,536,309,566,293,578,282,623,261,630,222,600,208,603,181,628,162,626,56,586,72,575,72,561,56,543,58,517,81,490,86,476,120,465,129,427,146,418,169,407,204,382,215,368,227,349,249,352,266,338,282,331,303,344,332,354" shape="poly">
                <area class="department" alt="Sonsonate" title="Sonsonate" href="department.php?places=Sonsonate" coords="392,459,367,461,319,467,330,481,330,495,317,523,319,569,317,581,305,588,294,625,261,641,219,613,185,638,275,694,296,747,344,751,386,744,437,756,485,708,492,671,512,661,510,638,538,599,565,574,575,567,489,516,473,530,459,532,411,484,399,468" shape="poly">
                <area class="department" alt="Chalatenango" title="Chalatenango" href="department.php?places=Chalatenango" coords="681,45,718,59,741,68,760,65,769,79,817,95,831,95,863,59,873,77,870,100,882,112,907,118,919,146,914,162,955,195,967,213,976,224,1008,218,1013,229,1045,239,1068,296,1106,294,1115,303,1147,296,1151,310,1144,324,1151,338,1184,352,1184,367,1158,374,1135,374,1112,395,1080,397,1069,407,1050,402,1032,418,999,412,981,418,946,416,933,409,921,360,909,345,889,335,836,322,805,331,787,324,769,335,752,328,730,331,709,326,695,317,653,328,640,342,603,340,612,310,626,307,621,278,649,254,681,248,695,231,695,211,695,188,720,183,730,179,741,144,745,119,739,105,713,91" shape="poly">
                <area class="department" alt="La Libertad" title="La Libertad" href="department.php?places=La Libertad" coords="692,327,674,338,662,338,651,348,642,355,633,362,628,385,630,405,632,417,609,436,593,440,580,454,586,470,586,484,586,507,586,527,572,539,580,558,586,567,579,587,561,590,552,610,522,634,527,645,522,663,501,685,499,710,455,758,489,765,512,772,623,772,667,786,695,786,808,837,806,816,813,802,805,791,789,786,782,795,745,753,752,726,743,708,752,685,741,675,734,659,748,650,734,631,715,617,715,602,706,588,720,567,722,542,722,530,739,491,746,445,755,435,723,421,725,403,713,362,713,345,697,341" shape="poly">
                <area class="department" alt="San Salvador" title="San Salvador" href="department.php?places=San Salvador" coords="826,336,805,350,785,343,769,350,741,343,722,357,734,386,741,403,736,416,769,430,768,440,755,451,752,502,734,527,736,573,720,589,729,603,739,619,755,624,762,652,750,666,762,679,759,707,768,721,762,746,773,774,785,774,805,781,819,753,820,732,805,702,808,686,847,684,863,670,854,627,868,612,907,612,877,550,868,557,843,527,840,516,824,516,806,495,826,476,835,469,805,435,798,412,806,386" shape="poly">
                <area class="department" alt="La Unión" title="La Unión" href="department.php?places=La Unión" coords="1779,477,1799,484,1809,469,1830,474,1852,477,1866,467,1880,463,1890,481,1899,493,1913,497,1933,527,1950,541,1950,567,1935,576,1935,597,1933,610,1919,636,1915,696,1903,717,1889,758,1887,769,1903,790,1919,788,1936,802,1938,823,1913,827,1894,848,1866,845,1867,829,1852,830,1829,850,1825,876,1823,898,1834,917,1855,922,1866,936,1887,951,1871,982,1834,1002,1774,1028,1776,1042,1795,1057,1753,1057,1661,1041,1666,1021,1702,991,1703,935,1717,917,1703,901,1721,867,1719,850,1700,809,1719,797,1715,779,1710,738,1730,730,1758,703,1758,680,1775,666,1774,631,1786,606,1775,594,1756,583,1786,548,1793,534,1781,509,1791,498" shape="poly">
                <area class="department" alt="Morazán" title="Morazán" href="department.php?places=Morazán" coords="1555,395,1590,405,1606,409,1647,393,1666,396,1672,435,1696,451,1710,472,1714,490,1719,499,1739,488,1760,479,1776,493,1772,509,1776,534,1742,591,1740,605,1763,603,1760,631,1765,649,1749,668,1746,693,1709,725,1647,732,1629,721,1633,698,1604,684,1578,684,1525,638,1527,621,1557,603,1559,580,1536,557,1523,531,1543,518,1532,449,1543,446,1567,442,1576,426,1555,412" shape="poly">
                <area class="department" alt="Usulután" title="Usulután" href="department.php?places=Usulután" coords="1331,1033,1288,1026,1257,1010,1174,1002,1100,980,1096,968,1110,963,1126,952,1158,919,1168,908,1153,889,1183,839,1195,821,1207,747,1228,738,1230,721,1274,712,1283,701,1294,685,1303,670,1350,634,1370,634,1387,650,1400,659,1421,659,1428,666,1419,680,1428,694,1416,703,1419,740,1426,751,1430,783,1417,790,1421,807,1409,843,1421,848,1419,873,1417,887,1440,904,1449,919,1479,924,1490,920,1484,934,1472,952,1469,964,1470,984,1477,993,1502,986,1514,982,1506,963,1511,941,1522,949,1537,949,1553,968,1546,991,1550,1002,1580,1005,1599,1021,1620,1047,1583,1046,1560,1055,1460,1042,1474,1032,1463,1012,1440,1007,1428,1012,1428,1023,1407,1039,1391,1040,1389,1023,1398,1009,1345,968,1326,974,1329,991,1343,1007,1315,1000,1311,984,1306,968,1292,956,1269,956,1237,949,1214,945,1216,961,1184,957,1165,963,1151,972,1151,984,1191,991,1214,996,1228,987,1251,982,1267,991,1279,1005,1271,1012" shape="poly">
                <area class="department" alt="San Vicente" title="San Vicente" href="department.php?places=San Vicente" coords="1085,979,1087,963,1100,952,1121,943,1133,922,1149,913,1138,894,1146,873,1161,852,1170,838,1181,815,1197,744,1209,737,1220,725,1221,710,1237,710,1269,702,1283,679,1296,656,1336,633,1324,615,1303,594,1262,590,1251,578,1237,569,1209,552,1195,555,1181,552,1174,557,1140,548,1103,564,1089,566,1082,573,1057,574,1043,613,1054,626,1048,634,1025,650,1031,665,1031,695,1068,705,1078,710,1091,753,1096,762,1082,808,1096,830,1110,844,1115,859,1117,869,1115,881,1112,892,1106,906,1105,922,1092,933,1080,945,1069,970" shape="poly">
                <area class="department" alt="Cuscatlán" title="Cuscatlán" href="department.php?places=Cuscatlán" coords="836,334,822,355,826,369,820,384,810,406,813,419,826,435,845,458,850,467,847,475,824,489,831,498,847,497,854,504,854,516,868,535,882,537,941,645,953,643,962,655,978,661,992,648,1016,638,1038,624,1032,613,1048,574,1038,560,997,546,999,527,981,512,962,509,946,493,946,479,939,463,972,429,944,426,930,417,919,403,914,371,903,348,849,334" shape="poly">
                <area class="department" alt="La Paz" title="La Paz" href="department.php?places=La Paz" coords="912,622,880,622,868,629,872,638,872,648,875,664,854,694,819,698,829,723,836,746,824,758,817,779,828,800,817,813,822,821,819,836,1020,940,1031,943,1059,963,1094,920,1085,901,1098,887,1101,859,1087,836,1078,823,1073,798,1083,763,1076,747,1059,712,1023,701,1016,659,1006,650,988,673,955,663,939,655" shape="poly">
                <area class="department" alt="San Miguel" title="San Miguel" href="department.php?places=San Miguel" coords="1345,498,1355,505,1371,497,1384,498,1391,486,1405,482,1422,484,1433,484,1451,491,1454,481,1474,482,1486,482,1489,468,1505,465,1516,459,1527,477,1532,502,1509,518,1516,535,1518,551,1527,560,1546,574,1546,588,1518,601,1511,618,1512,643,1525,652,1537,666,1557,682,1564,694,1583,693,1608,693,1618,700,1617,723,1629,737,1701,735,1707,751,1707,776,1692,798,1685,809,1705,857,1687,892,1703,916,1694,923,1691,980,1657,1015,1648,1036,1631,1043,1590,1001,1553,987,1562,966,1550,951,1548,941,1525,934,1511,932,1498,939,1493,958,1500,971,1482,976,1477,951,1500,918,1491,904,1472,909,1456,909,1428,881,1433,835,1417,831,1431,808,1433,794,1438,747,1426,736,1426,711,1442,704,1435,681,1437,648,1424,642,1417,649,1394,646,1382,625,1366,619,1332,619,1332,602,1320,602,1313,593,1313,563,1329,556,1327,540,1338,533" shape="poly">
                <area class="department" alt="Cabañas" title="Cabañas" href="department.php?places=Cabañas" coords="995,426,979,431,972,445,953,461,953,472,953,486,965,495,981,502,995,511,1009,521,1004,537,1023,546,1045,557,1057,565,1080,557,1091,553,1129,541,1145,537,1165,541,1181,542,1207,539,1225,551,1255,562,1258,574,1278,581,1306,581,1301,564,1318,548,1317,537,1327,528,1338,486,1322,452,1327,421,1313,398,1285,401,1274,398,1256,378,1242,378,1228,369,1212,369,1172,384,1156,392,1138,389,1124,403,1108,406,1087,412,1082,424,1059,419,1050,429,1031,438,1009,428" shape="poly">
            </map>
        </div>
    </div>
    <footer class="footer">
        <div class="waves">
            <div class="wave" id="wave1"></div>
            <div class="wave" id="wave2"></div>
            <div class="wave" id="wave3"></div>
            <div class="wave" id="wave4"></div>
        </div>
        <ul class="social-icon">
            <li class="social-icon__item"><a class="social-icon__link" href="#"><i class="fa-brands fa-instagram"></i></a></li>
            <li class="social-icon__item"><a class="social-icon__link" href="#"><i class="fa-regular fa-envelope"></i></a></li>
        </ul>
        <ul class="menu">
            <li class="menu__item"><a class="menu__link" href="#">Inicio</a></li>
            <li class="menu__item"><a class="menu__link" href="#">Acerca de</a></li>
            <li class="menu__item"><a class="menu__link" href="#">FAQ</a></li>
            <li class="menu__item"><a class="menu__link" href="#">Contáctanos</a></li>
        </ul>
    </footer>
    
    <script>
        $(document).ready(function(e) {
            $('img[usemap]').rwdImageMaps();
        });
    </script>
    
    <script>
        $("map[name=imagemap]").mapoid({
            fillColor:'#ed735c',
            fillOpacity: 1,
            strokeColor: '#ed735c',
            strokeWidth: 1.5,
            fadeTime: 500,
        });
    </script>

    <script>
        const tween = KUTE.fromTo(
          '#blob1',
          { path: '#blob1' },
          { path: '#blob2' },
          { repeat: 999, duration: 3000, yoyo: true }
        ).start();
    </script>
    <script>
        document.querySelector('.hero__button').addEventListener('click', function(e){
            location.href = 'filtered.php';
        });

        document.querySelector('.profile').addEventListener('click', function(e){
            location.href = 'profile.php';
        });

        document.querySelector('.showMenu').addEventListener('click', function(e){
            document.querySelector('.options__menu').classList.toggle('show');
            document.querySelector('.showMenu').classList.toggle('black');
        });

        document.querySelector('.hideNotis').addEventListener('click', function(e){
            document.querySelector('.option__info__container').classList.toggle('hide');
            document.querySelector('.hideNotis').classList.toggle('fa-chevron-down');
            document.querySelector('.hideNotis').classList.toggle('fa-chevron-right');
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Obtenemos todas las áreas del mapa
            const areas = document.querySelectorAll('area');

            // Recorremos cada área y agregamos un evento de clic
            areas.forEach(area => {
                area.addEventListener('click', function() {
                    // Obtenemos el atributo 'href' de cada área y redireccionamos a la página correspondiente
                    const targetPage = area.getAttribute('href');
                    window.location.href = targetPage;
                });
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
        const loaderContainer = document.querySelector(".loader__container");
        loaderContainer.style.display = "none"; // Ocultar el loader después de que la página se haya cargado completamente
        });
    </script>
</body>

</html>