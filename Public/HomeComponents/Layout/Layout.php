<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <title>Mini social network</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />

    <style>
        :root {
            --common-bg: #cbd9dd;
        }

        .body {
            background-color: #ecf0f1;
        }

        .search-bar {
            width: 90% !important;
        }

        .common-bg {
            background-color: var(--common-bg);
        }

        .bg-search-bar {
            background-color: var(--common-bg);
        }

        .home-list-question-left {
            min-height: 300px;
        }

        .home-list-filter-right {
            min-height: 300px;
        }
    </style>
</head>

<body class="body">

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#"><i class="fab fa-quora"></i> Mini-Q2A</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav w-100">
                <li class="nav-item active">
                    <a class="nav-link" href="#"> <i class="fa fa-home"></i> Trang chủ <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-question"></i> Danh dách câu hỏi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"> <i class="far fa-chart-bar"></i> Bảng xếp hạng</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                </li> -->

                <li class="nav-item ml-auto">
                    <a class="nav-link" href="#"> <i class="fas fa-key"></i> Đăng nhập</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="#"> <i class="fas fa-registered"></i> Đăng ký</a>
                </li>
            </ul>
        </div>
    </nav>


    <!-- Content  -->

    <div class="container">

        <!-- Search Bar -->

        <form class="form-inline bg-search-bar my-3  p-3 rounded-lg" method="GET">
            <div class="form-group w-100 d-flex justify-content-between">
                <input type="text" name="txtSearchBar" id="txtSearchBar" class="form-control w-100" placeholder="Tìm câu hỏi" aria-describedby="">
            </div>
        </form>



        <!-- Home content  -->

        <div class="common-bg w-100 min-vh-100 my-3 d-flex">


            <div class="home-list-question-left w-75 bg-danger mr-3 "></div>
            <div class="home-list-filter-right w-25 bg-info"></div>

        </div>


    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

</body>

</html>