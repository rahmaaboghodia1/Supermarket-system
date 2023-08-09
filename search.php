<?php
$searchQuery = '';
if (isset($_POST['search'])) {
    $searchQuery = trim($_POST['search']);
}

?>
<form method="POST">
    <input type="text" name="search" placeholder="Search products" value="<?php echo $searchQuery; ?>">
    <button type="submit">Search</button>
</form>
<?php

if ($searchQuery === '') {
    $sql = "SELECT * FROM products";
} else {
    $searchQueryForSql = "%" . $conn->real_escape_string($searchQuery) . "%";
    $sql = "SELECT * FROM products WHERE name LIKE '{$searchQueryForSql}'";
}

$result = $conn->query($sql);
