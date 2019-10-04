<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <div>Contact Book PHP CRUD</div>

    <!-- Require Process PHP -->
    <?php require_once 'process.php'; ?>

    <!-- Show Message -->
    <?php if (isset($_SESSION['message'])) : ?>
        <div>
            <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
                ?>
        </div>
    <?php endif ?>


    <!-- Connect To Database -->
    <?php
    $mysqli = new mysqli('localhost', 'root', '123456', 'crud') or die(mysqli_error($mysqli));
    $result = $mysqli->query('SELECT * FROM user');
    ?>

    <!-- Fetch Data from Database -->
    <?php while ($row = $result->fetch_assoc()) : ?>
        <div>
            <?php echo $row['name']; ?>
            <?php echo $row['location'] ?>
            <a href="index.php?edit=<?php echo $row['id'] ?>">Edit</a>
            <a href="process.php?delete=<?php echo $row['id']; ?>">Delete</a>
        </div>
    <?php endwhile ?>

    <form actions="process.php" method="POST">
        <input type="text" name="name" placeholder="Your Name" value="<?php echo $name ?>">
        <input type="text" name="location" placeholder="Your Location" value="<?php echo $location ?>">

        <?php if ($update == true) : ?>
            <button type="submit" name="update">Update</button>
        <?php else : ?>
            <button type="submit" name="save">Save</button>
        <?php endif ?>

        <input type="hidden" name="id" value="<?php echo $id ?>">
    </form>
</body>

</html>