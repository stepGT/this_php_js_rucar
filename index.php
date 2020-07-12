<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap-4.5.0.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>RUCar</title>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col">
            <form>
                <div class="form-group">
                    <label for="this_rucar_mark">Выберите марку</label>
                    <select class="form-control" name="this_rucar_mark"
                            id="this_rucar_mark"></select>
                </div>
                <div class="form-group">
                    <label for="this_rucar_model">Выберите модель</label>
                    <select disabled class="form-control" name="this_rucar_model"
                            id="this_rucar_model"></select>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="js/jquery-3.5.1.js"></script>
<!--<script src="js/popper-1.16.0.js"></script>-->
<script src="js/bootstrap-4.5.0.js"></script>
<script src="frontend/script.js"></script>
</body>
</html>