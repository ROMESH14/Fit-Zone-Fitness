<?php
$conn = mysqli_connect("localhost", "root", "", "mydb");
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Handle add
if (isset($_POST['add'])) {
  $day = $_POST['day'];
  $class = $_POST['class'];
  $time = $_POST['time'];
  $instructor = $_POST['instructor'];
  $sql = "INSERT INTO add_class (day, class, time, instructor) VALUES ('$day', '$class', '$time', '$instructor')";
  mysqli_query($conn, $sql);
  header("Location: add_class.php");
  exit;
}

// Handle delete
if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  mysqli_query($conn, "DELETE FROM add_class WHERE id=$id");
  header("Location: add_class.php");
  exit;
}

// Fetch workouts
$workouts = mysqli_query($conn, "SELECT * FROM add_class ORDER BY FIELD(day,'Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday')");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Class Manager</title>
  <link rel="stylesheet" href="add_class.css">
</head>
<header class="hero">
      <h1>Class Manager</h1>
      <p>Workout routines, healthy eating, and fitness motivation.</p>
    </header>
  <hr><br><br>
  <h1> Add Class </h1>
  <form method="POST" class="form-section">
    <input type="text" name="day" placeholder="Day " required>
    <input type="text" name="class" placeholder="class" required>
    <input type="text" name="time" placeholder="time" required>
    <input type="text" name="instructor" placeholder="instructor" required>
    <button type="submit" name="add">Add class</button>
  </form>
  <br><br><hr><br><br>
  <h1> View / Delete Class</h1>
  <div class="table-section">
    <?php if (mysqli_num_rows($workouts) > 0): ?>
      <table>
        <thead>
          <tr>
            <th>Day</th>
            <th>Class</th>
            <th>time</th>
            <th>Instructor</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = mysqli_fetch_assoc($workouts)) : ?>
            <tr>
              <td><?= $row['day'] ?></td>
              <td><?= $row['class'] ?></td>
              <td><?= $row['time'] ?></td>
              <td><?= $row['instructor'] ?></td>
              <td>
                <a href="?delete=<?= $row['id'] ?>" class="delete-btn" onclick="return confirm('Delete this class?')">Delete</a>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
      <br>
      <a href="admin.html" class="back-btn">← Back to Admin Page</a>
    <?php else: ?>
      <p>No Class found.</p>
    <?php endif; ?>
  </div>
</body>
</html>
