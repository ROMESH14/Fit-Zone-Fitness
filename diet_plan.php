<?php
$conn = mysqli_connect("localhost", "root", "", "mydb");
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['add'])) {
  $day = $_POST['day'];
  $meal = $_POST['meal'];
  $time = $_POST['time'];
  $calories  = $_POST['calories'];
  $sql = "INSERT INTO diet_plans (day, meal, time, calories ) VALUES ('$day', '$meal', '$time', '$calories ')";
  mysqli_query($conn, $sql);
  header("Location: diet_plan.php");
  exit;
}

if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  mysqli_query($conn, "DELETE FROM diet_plans WHERE id=$id");
  header("Location: diet_plan.php");
  exit;
}

$workouts = mysqli_query($conn, "SELECT * FROM diet_plans ORDER BY FIELD(day,'Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday')");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Diet Plan Manager</title>
  <link rel="stylesheet" href="diet_plan.css">
</head>
<body>
<header class="hero">
      <h1>Diet Plan Manager</h1>
      <p>Workout routines, healthy eating, and fitness motivation.</p>
    </header>
  <hr><br><br>
  <h1> Add Diet Plan </h1>
  <form method="POST" class="form-section">
    <input type="text" name="day" placeholder="Day (e.g., Monday)" required>
    <input type="text" name="meal" placeholder="meal" required>
    <input type="text" name="time" placeholder="time" required>
    <input type="text" name="calories" placeholder="calories" required>
    <button type="submit" name="add">Add plan</button>
  </form>
  <br><br><hr><br><br>
  <h1> View / Delete Diet Plan</h1>
  <div class="table-section">
    <?php if (mysqli_num_rows($workouts) > 0): ?>
      <table>
        <thead>
          <tr>
            <th>Day</th>
            <th>Meal </th>
            <th>time</th>
            <th>calories</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = mysqli_fetch_assoc($workouts)) : ?>
            <tr>
              <td><?= $row['day'] ?></td>
              <td><?= $row['meal'] ?></td>
              <td><?= $row['time'] ?></td>
              <td><?= $row['calories'] ?></td>
              <td>
                <a href="?delete=<?= $row['id'] ?>" class="delete-btn" onclick="return confirm('Delete this plan?')">Delete</a>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
      <br>
      <a href="admin.html" class="back-btn">← Back to Admin Page</a>
    <?php else: ?>
      <p>No plan found.</p>
    <?php endif; ?>
  </div>
</body>
</html>
