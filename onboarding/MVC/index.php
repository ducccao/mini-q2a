<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>

<body>
    <h1>Home Onboard MVC</h1>

    <a href="/onboarding/MVC/index.php?action=list">Danh sach sinh vien</a>
    <a href="/onboarding/MVC/index.php?keyword=Son&action=search">Tim kiem ten</a>


    <?php





    use controllers\HomeController;

    require_once("./controllers/HomeController.php");
    require_once("./controllers/sinhvien.controller.php");
    require_once("./models/sinhvien.model.php");

    $action = "";

    if (isset($_REQUEST["action"])) {
        $action = $_REQUEST["action"];
    }

    switch ($action) {
        case 'list':
            $controller = new SinhVienController();
            $controller->listAll();
            break;
        case "search":
            $controller = new SinhVienController();
            $keyword = $_REQUEST["keyword"];
            $controller->search($keyword);
            break;
        default:
            $controller = new HomeController();
            $controller->index();
            break;
    }

    ?>
</body>

</html>