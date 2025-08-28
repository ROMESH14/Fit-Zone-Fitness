<?php
$conn = mysqli_connect("localhost", "root", "", "mydb");
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Handle add
if (isset($_POST['add'])) {
  $day = $_POST['day'];
  $exercise = $_POST['exercise'];
  $sets = $_POST['sets'];
  $reps = $_POST['reps'];
  $sql = "INSERT INTO workouts (day, exercise, sets, reps) VALUES ('$day', '$exercise', '$sets', '$reps')";
  mysqli_query($conn, $sql);
  header("Location: workout.php");
  exit;
}

// Handle delete
if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  mysqli_query($conn, "DELETE FROM workouts WHERE id=$id");
  header("Location: workout.php");
  exit;
}

// Fetch workouts
$workouts = mysqli_query($conn, "SELECT * FROM workouts ORDER BY FIELD(day,'Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday')");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Workout Manager</title>
  <link rel="stylesheet" href="workout.css">
</head>
<header class="hero">
      <h1>Workout Manager</h1>
      <p>Workout routines, healthy eating, and fitness motivation.</p>
    </header>
  <hr><br><br>
  <h1> Add Workout </h1>
  <form method="POST" class="form-section">
    <input type="text" name="day" placeholder="Day (e.g., Monday)" required>
    <input type="text" name="exercise" placeholder="Exercise" required>
    <input type="text" name="sets" placeholder="Sets" required>
    <input type="text" name="reps" placeholder="Reps" required>
    <button type="submit" name="add">Add Workout</button>
  </form>
  <br><br><hr><br><br>
  <h1> View / Delete Workout</h1>
  <div class="table-section">
    <?php if (mysqli_num_rows($workouts) > 0): ?>
      <table>
        <thead>
          <tr>
            <th>Day</th>
            <th>Exercise</th>
            <th>Sets</th>
            <th>Reps</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = mysqli_fetch_assoc($workouts)) : ?>
            <tr>
              <td><?= $row['day'] ?></td>
              <td><?= $row['exercise'] ?></td>
              <td><?= $row['sets'] ?></td>
              <td><?= $row['reps'] ?></td>
              <td>
                <a href="?delete=<?= $row['id'] ?>" class="delete-btn" onclick="return confirm('Delete this workout?')">Delete</a>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
      <br>
      <a href="admin.html" class="back-btn">← Back to Admin Page</a>
    <?php else: ?>
      <p>No workouts found.</p>
    <?php endif; ?>
  </div>
</body>
</html>
