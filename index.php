<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
    <meta name="theme-color" content="#000000">
    <title>Daniel Shevtsov</title>
    <link rel="stylesheet" href="css/index.css">
    <!-- Roboto Font by Google Fonts (https://fonts.google.com/specimen/Roboto) -->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>
<body>
    <div id="content">
        <div class="section" id="title">
            <h1>Daniel Shevtsov</h1>
            <p>
                Software Systems Engineering student at the University of Regina
            </p>
        </div>

        <div class="section" id="course-links">
            <h2>Courses</h2>
            <ul>
                <li><a href="javascript:void(0)" onclick="openModal('modal-ense215')" id="ense353">CS215</a></li>
                <li><a href="javascript:void(0)" onclick="openModal('modal-ense353')" id="ense353">ENSE353</a></li>
            </ul>
        </div>

        <div class="section" id="other-links">
            <h2>Other</h2>
            <ul>
                <li>
                    <a href="https://github.com/shevtsod"><i class="fa fa-github fa-2x" aria-hidden="true"></i></a>
                </li>
            </ul>         
        </div>
    </div>

    <footer>
        &copy; Copyright <?php echo date("Y"); ?>, Daniel Shevtsov
    </footer>

    <div id="modal-ense215" class="modal" style="display: none;">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close" onclick="closeModal('modal-ense215')">&times;</span>
                <h2>CS215</h2>
            </div>
            <h4>Web and Database Programming (Summer 2016)</h4>
            <ul>
                <li><a href="CS215/lab1.php">Lab 1</a></li>
                <li><a href="CS215/lab2.php">Lab 2</a></li>
                <li><a href="CS215/lab3.php">Lab 3</a></li>
                <li><a href="CS215/lab4.php">Lab 4</a></li>
                <li><a href="CS215/lab5.php">Lab 5</a></li>
                <li><a href="CS215/lab6.php">Lab 6</a></li>
                <li><a href="CS215/lab7.php">Lab 7</a></li>
                <li><a href="CS215/lab8.php">Lab 8</a></li>
                <li><a href="CS215/lab9.php">Lab 9</a></li>
                <li><a href="CS215/lab10.php">Lab 10</a></li>
                <li><a href="CS215/lab11.php">Lab 11</a></li>
                <li><a href="CS215/lab12.php">Lab 12</a></li>
            </ul>       
        </div>
    </div>

    <div id="modal-ense353" class="modal" style="display: none;">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close" onclick="closeModal('modal-ense353')">&times;</span>
                <h2>ENSE353</h2>
            </div>
            <h4>Software Design and Architecture (Summer 2017)</h4>
            <ul>
                <li><a href="ENSE353/lab3/info.php">Lab 3 - PHPinfo</a></li>
                <li><a href="webmail">Lab 6 - Webmail</a></li>
                <li><a href="ENSE353/assignment/index.php">Subscription Service Assignment</a></li>
            </ul>           
        </div>
    </div>

    <!-- Font Awesome Icons -->
    <script src="https://use.fontawesome.com/3cfb94c310.js"></script>
    <script src="js/index.js"></script>
</body>
</html>
