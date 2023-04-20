<form action="vendor/create.php" method="post" enctype = "multipart/form-data">
    <h3>Create new product</h3>
    <p>Photo</p>
    <input type="file" name="photo">
    <p>Title</p>
    <input type="text" name="title">
    <p>Price</p> <br>
    <input type="number" name="price">
    <p>Description</p> <br>
    <textarea name="description"></textarea> <br>
    <button type="submit">Create new product</button>
</form>