<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
</head>



<body>
<style>
    @media (min-width: 768px) {
            .rest-pxy {
                padding-left: 0px!important;
                padding-bottom: 0px!important;
            }
        }
</style>
<div class="container-fluid rest-pxy">
    <div class="row">
        
        <div class="col-md-3 rest-pxy"> <?php require_once('sidebar.php') ?></div>
        <div class="col-md-9 ">
            <div class="row">
                <div class="col-12">
                    <header><?php require_once('header.php') ?></header>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <main class="col-md-12 col-sm-12 overflow-auto h-100">
                        <div class="bg-light border rounded-3 p-3">
                            <h2 class="text-center">Bienvenido</h2>
                        </div>
                    </main>
                </div>
            </div>
        </div>

    </div>
</div>


</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</html>