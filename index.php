<?php
include 'db.php';




if(isset($_GET['id'])){
  $del_id=$_GET['id'];

  $delsql="delete from test where id='$del_id'";
  $delresult=mysqli_query($conn,$delsql);


if($delresult)
{
  header("location:index.php?delete=1");
}

}

if($_SERVER['REQUEST_METHOD']==="POST")
{
$name=$_POST['name'];
$email=$_POST['email'];
$desc=$_POST['message'];


// Handle image
$image = $_FILES['image']['name'];
$tmp = $_FILES['image']['tmp_name'];

$target = "media/" . basename($image);

if(move_uploaded_file($tmp,$target)){
    $sql="INSERT INTO test (name,email,descc,image) values('$name','$email','$desc','$image')";
    $result=mysqli_query($conn,$sql);
    
    header("location:index.php?success=1");
    exit();
}



}
?>



<?php
if (isset($_GET['success'])) {
    echo "<p style='color:green;'>✅ Data inserted successfully!</p>";
}
?>
<?php
if (isset($_GET['delete'])) {
    echo "<p style='color:green;'>✅ Data deleted successfully!</p>";
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

    <form action="index.php" method="post" enctype="multipart/form-data">

        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name"><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email"><br><br>

        <label for="message">Message:</label><br>
        <textarea id="message" name="message" rows="4" cols="40"></textarea><br><br>

        <label for="message">upload a pic</label><br>
        <input type="file" name="image" >
        <br><br>
        <input type="submit">
    </form>













    
<h2>submmited record</h2>
<table>
<tr>
<th>Name</th>
<th>email</th>
<th>desc</th>
<th>image</th>
<th>ACTION</th>
</tr>




<?php
$selectsql="select * from test";
$selectresult=mysqli_query($conn,$selectsql);
$num=mysqli_num_rows($selectresult);

if($num>0){

    while($row=mysqli_fetch_assoc($selectresult)){
        echo "<tr> 
        <td>{$row['name']}</td> 
        <td>{$row['email']}</td>
        <td>{$row['descc']}</td>
        <td><img src='media/{$row['image']}' alt='Image' height='60'></td>

        <td><a href='index.php?id={$row['id']}' onclick='return confirm(\"Are you sure want to delete?\")'>Delete</a></td>
        <td><a href='update.php?updateid={$row['id']}' onclick='return confirm(\"Are you sure want to update?\")'>update</a></td>

        </tr>";


        // echo"<tr>
        //       <td>{$row['name']}</td>
        //       <td>{$row['email']}</td>
        //       <td>{$row['descc']}</td>
        //       <td><img src='media/{$row['image']}'>
        //       <td><a href='index.php?delid={$row['id']}'>delete</a></td>
        //       <td><a href='update.php?updateid={$row['id']}'>update</a></td>
        //      </tr>"; 


           
        //    echo "<tr>
        //    <td>" . $row['name'] . "</td>
        //    <td>" . $row['email'] . "</td>
        //    <td>" . $row['descc'] . "</td>
        //    <td><img src='" . $row['image'] . "'></td>
        //    </tr>";
           
    }
}


?>












</table>




</body>
</html>
