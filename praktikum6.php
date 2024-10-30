<!-- mufti -->
<?php
// Array to hold the list of items
$items = [
    ['id' => 1, 'name' => 'Buku', 'category' => 'Alat Tulis', 'price' => 20000],
    ['id' => 2, 'name' => 'Pulpen', 'category' => 'Alat Tulis', 'price' => 5000]
];
// Handling form submission to add new item
if (isset($_POST['add'])) {
    $newId = count($items) + 1;
    $newItem = [
        'id' => $newId,
        'name' => $_POST['name'],
        'category' => $_POST['category'],
        'price' => $_POST['price']
    ];
    $items[] = $newItem;
}
// Handling deletion of item
if (isset($_GET['delete'])) {
    $idToDelete = $_GET['delete'];
    foreach ($items as $key => $item) {
        if ($item['id'] == $idToDelete) {
            unset($items[$key]);
            break;
        }
    }
}
// Handling editing of item
if (isset($_POST['edit'])) {
    $idToEdit = $_POST['id'];
    foreach ($items as &$item) {
        if ($item['id'] == $idToEdit) {
            $item['name'] = $_POST['name'];
            $item['category'] = $_POST['category'];
            $item['price'] = $_POST['price'];
            break;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inventory Management</title>
</head>
<body>
    <!-- Form to Add New Item -->
    <h3>Tambah Barang</h3>
    <form method="POST">
        <label>Nama Barang:</label>
        <input type="text" name="name" required><br>
        <label>Kategori Barang:</label>
        <input type="text" name="category" required><br>
        <label>Harga Barang:</label>
        <input type="number" name="price" required><br>
        <input type="submit" name="add" value="Tambah Barang">
    </form>
    <!-- Table to Display Items -->
    <h3>Daftar Barang</h3>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama Barang</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($items as $item): ?>
            <tr>
                <td><?= $item['id'] ?></td>
                <td><?= $item['name'] ?></td>
                <td><?= $item['category'] ?></td>
                <td><?= $item['price'] ?></td>
                <td>
                    <a href="edit.php?id=<?= $item['id'] ?>">Edit</a> |
                    <a href="?delete=<?= $item['id'] ?>" onclick="return confirm('Yakin hapus barang?')">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>