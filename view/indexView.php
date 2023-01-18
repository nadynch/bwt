<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="https://cookieless.MySite.com/favicon.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Conferences</title>
<style>
        input {
            margin-top: 5px;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header clearfix">
        <nav>
            <ul class="nav nav-pills float-right">
                <li class="nav-item">
                    <a class="btn btn-outline-dark" href="../index.php?controller=conferences&action=new">Create new conference</a>
                </li>
                <li class="nav-item">
                </li>
            </ul>
        </nav>
        <h3 class="text-muted">Conferences<br></h3>
    </div>

    <div class="jumbotron">
        <table class="table table-striped">
            <thead class="thead-dark">
            <tr>
                <th scope="col"> </th>
                <th scope="col">Title</th>
                <th scope="col">Date</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <?php foreach ($data["conferences"] as $conference) { ?>
                <td><?php echo $conference["ConferenceID"]; ?></td>
                <td><?php echo $conference["ConferenceTitle"]; ?> </td>
                <td><?php echo $conference["ConferenceDate"]; ?></td>
                <td>
                    <a href="../index.php?controller=conferences&action=detail&id=<?php echo $conference['ConferenceID']; ?>" class="btn btn-outline-info">Show detail</a>
                    <a  href="../index.php?controller=conferences&action=edit&id=<?php echo $conference['ConferenceID']; ?>" class="btn btn-outline-secondary">Edit</a>
                    <a href="../index.php?controller=conferences&action=delete&id=<?php echo $conference['ConferenceID']; ?>" class="btn btn-outline-danger">Delete</a>
                </td>
            </tr>
            <?php } ?>
            </tbody>
        </table>

    </div>
</div>

<footer class="page-footer font-small blue">
<hr/>
    <div class="footer-copyright text-center py-3">© Nadiia Shkurenko 2023
    </div>

</footer>
</body>
</html>