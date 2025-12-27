<?php
include "header.php";
include "db.php"; 

// Initialize $students to avoid undefined variable warning
$students = [];

try {
    $sql = "SELECT * FROM students";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "<p style='color:red;'>Database error: " . $e->getMessage() . "</p>";
}
?>

<h2>Student List</h2>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Course</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($students) && is_array($students)): ?>
            <?php foreach ($students as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']); ?></td>
                    <td><?= htmlspecialchars($row['name']); ?></td>
                    <td><?= htmlspecialchars($row['email']); ?></td>
                    <td><?= htmlspecialchars($row['course']); ?></td>
                    <td>
                        <form action="edit.php" method="get" style="display:inline-block;">
                            <input type="hidden" name="id" value="<?= $row['id']; ?>">
                            <button type="submit" class="btn edit">Edit</button>
                        </form>
                        <form action="delete.php" method="get" style="display:inline-block;">
                            <input type="hidden" name="id" value="<?= $row['id']; ?>">
                            <button type="submit" class="btn delete">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" style="text-align:center;">No students found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<form action="add.php" method="get" style="text-align:center; margin-top:20px;">
    <button type="submit" class="btn add-new">Add New Student</button>
</form>

<?php include "footer.php"; ?>
