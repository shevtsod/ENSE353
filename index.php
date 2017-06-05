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
            <h2>Course Links</h2>
            <ul>
                <li><a href="#" onclick="openModal('ense353')" id="ense353">ENSE353</a></li>
            </ul>
        </div>

        <div class="section" id="other-links">
            <h2>Other Links</h2>
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

    <div id="modal-ense353" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close" onclick="closeModal('ense353')">&times;</span>
                <h2>ENSE353 Links</h2>
            </div>
            <a href="info.php">PHPinfo</a>
        </div>
    </div>

    <!-- Font Awesome Icons -->
    <script src="https://use.fontawesome.com/3cfb94c310.js"></script>
    <script src="js/index.js"></script>
</body>
</html>
