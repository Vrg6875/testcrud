<?php
include 'db.php';

if (isset($_GET['updateid'])) {
    $id = $_GET['updateid'];

    $sql = "SELECT * FROM test WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $desc = $_POST['message'];

    // Check if new image uploaded
    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];
        $target = "media/" . basename($image);
        move_uploaded_file($tmp, $target);
    } 
    else {
        // Use existing image if no new image uploaded
        $image = $row['image'];
    }

    $updateSql = "UPDATE test SET name='$name', email='$email', descc='$desc', image='$image' WHERE id=$id";
    $result3 = mysqli_query($conn, $updateSql);

    if ($result3) {
        header("Location: update.php?updateid=$id&update=true");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

// Show success message
if (isset($_GET['update']) && $_GET['update'] == 'true') {
    echo "<p style='color: green;'>✅ Your data was updated successfully!</p>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Basic Form</title>
</head>
<body>

    <h2>Contact Form</h2>

    <form action="" method="post" enctype="multipart/form-data">

        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>"> <br><br>
\
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>"> <br><br>

        <label for="message">Message:</label><br>
        <textarea id="message" name="message" rows="4" cols="40"><?php echo $row['descc']; ?></textarea><br><br>

        <label for="message">Upload a pic</label><br>
        <input type="file" name="image"><br>
        <?php 
        if (!empty($row['image'])): 
        ?>
            <img src="media/<?php echo $row['image']; ?>" height="60"><br>
        <?php
     endif;
      ?>
        <br>
        <input type="submit" value="Update">
    </form>

</body>
</html>
