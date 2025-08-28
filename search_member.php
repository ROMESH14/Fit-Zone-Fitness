<?php
$conn = mysqli_connect("localhost", "root", "", "mydb");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$results = [];
if (isset($_POST['search'])) {
    $keyword = mysqli_real_escape_string($conn, $_POST['keyword']);
    $query = "SELECT * FROM registration WHERE 
              firstname LIKE '%$keyword%' OR 
              lastname LIKE '%$keyword%' OR 
              email LIKE '%$keyword%' OR 
              contact LIKE '%$keyword%'";
    $results = mysqli_query($conn, $query);
}
?>

<!DOCTYPE html>
<html>
<head>
<header class="hero">
      <h1>Member Manager</h1>
      <p>Workout routines, healthy eating, and fitness motivation.</p>
    </header>
  <hr><br><br>
    <title>Search Members</title>
    <link rel="stylesheet" href="search_member.css">
</head>
<body>
    <div class="search-container">
        <h2>Search Gym Members</h2>
        <form method="POST">
            <input type="text" name="keyword" placeholder="Search by name, email or contact..." required>
            <button type="submit" name="search">Search</button>
        </form>

        <?php if (!empty($results) && mysqli_num_rows($results) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Age</th>
                        <th>Weight</th>
                        <th>Gender</th>
                        <th>Email</th>
                        <th>Contact</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($results)): ?>
                        <tr>
                            <td><?= $row['firstname'] ?></td>
                            <td><?= $row['lastname'] ?></td>
                            <td><?= $row['age'] ?></td>
                            <td><?= $row['wight'] ?></td>
                            <td><?= $row['gender'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td><?= $row['contact'] ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php elseif (isset($_POST['search'])): ?>
            <p>No members found.</p>
        <?php endif; ?>
    </div>
    <a href="admin.html" class="back-btn">← Back to Admin Page</a>
</body>
</html>
