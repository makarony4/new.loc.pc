<?php
echo "<tr>";


while ($row = mysqli_fetch_assoc($products)) {
    ?>
    <tr>
        <td><?=$row['id']?></td>
        <td><?=$row['title']?></td>
        <td><?=$row['price']?></td>
        <td><?=$row['description']?></td>
        <td><img src="<?=$row['photo']?>" width="100" height="100"></td>
        <td><a href="update.php?id=<?=mysqli_real_escape_string($connect,$row['id'])?>">Update</a></td>
        <td><a href="vendor/delete.php?id=<?=mysqli_real_escape_string($connect, $row['id'])?>">Delete</a> </td>
        <td><a href="product_stats.php?id=<?=$row['id']?>">Stats by product</a></td>
    <?php
}
echo "aaaa";
?>

