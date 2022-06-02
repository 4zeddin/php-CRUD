<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <?php require_once 'process.php';?>
    <?php require_once 'conn.php';?>
    <?php if (isset($_SESSION['msg'])) : ?>
        <div class="alert alert-<?php echo $_SESSION['msg_type']; ?> d-flex align-items-center alert-dismissible fade show" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img">
                <use xlink:href="#check-circle-fill" />
            </svg>
            <?php
            echo $_SESSION["msg"];
            unset($_SESSION["msg"]);
            ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif ?>
    <div class="container">

        <div class="card mx-auto mt-4" style="width: 18rem;">
            <div class="card-body">
                <form action="process.php" method="POST">
                    <input type="hidden" name="id" value="<?php if (isset($_GET['edit'])){ echo $id; }?>">
                    <div class="mb-3">
                        <label>Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" placeholder="enter your full name" value="<?php if (isset($_GET['edit'])){ echo $name; }?>" required="required">
                    </div>
                    <div class="mb-3">
                        <label>Age <span class="text-danger">*</span></label>
                        <input type="number" name="age" class="form-control" placeholder="enter your age" value="<?php if (isset($_GET['edit'])){ echo $age; }?>" required="required">
                    </div>
                    <div class="mb-3">
                        <label>Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" placeholder="name@example.com" value="<?php if (isset($_GET['edit'])){ echo $email; }?>" required="required">
                    </div>
                    <div class="mb-3">
                        <?php if (isset($_GET['edit'])) : ?>
                            <button type="submit" class="btn btn-outline-primary" name="update">update</button>
                        <?php else : ?>
                            <button type="submit" class="btn btn-outline-success" name="save">Save</button>
                        <?php endif ?>
                    </div>
                </form>
            </div>
        </div>

        <table class="table table-light table-striped mt-5 border">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <Tbody>
            <?php
            $result = $mysqli->query("SELECT*FROM data") or die($mysqli->error);

            while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['age']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td>
                        <a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-primary">Edit</a>
                        <a href="process.php?delete=<?php echo $row['id']; ?>" class=" btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php } ?>
            </Tbody>      
        </table>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>
