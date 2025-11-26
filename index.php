<?php
// index.php - Login
session_start();
include 'includes/db.php';

if (isset($_SESSION['admin'])) {
    header('Location: dashboard.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $conn->real_escape_string($_POST['email']);
    $pass  = $conn->real_escape_string($_POST['password']);

    $res = $conn->query("SELECT * FROM users WHERE Email='$email' AND Password='$pass'");
    if ($res && $res->num_rows > 0) {
        $_SESSION['admin'] = $email;
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Incorrect email or password';
    }
}
include 'includes/header.php';
?>
<div class="card center-card">
  <h2>Admin Login</h2>
  <form method="post" class="form">
    <label>Email</label>
    <input name="email" type="email" required>
    <label>Password</label>
    <input name="password" type="password" required>
    <button class="btn primary" type="submit">Login</button>
  </form>
  <?php if($error): ?>
    <p class="error"><?=htmlspecialchars($error)?></p>
  <?php endif; ?>
  <p class="note">Default admin: admin@gmail.com / 12345</p>
</div>
<?php include 'includes/footer.php'; ?>
