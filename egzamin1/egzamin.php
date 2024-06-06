<?php
session_start();

$host = 'localhost';
$db = 'egzamin';
$user = 'root';
$pass = '';

$conn = new mysqli("localhost","root","","egzamin");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['register'])) {
        $username = $conn->real_escape_string($_POST['username']);
        $email = $conn->real_escape_string($_POST['email']);
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        if ($password !== $confirm_password) {
            $message = "Passwords do not match";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            if ($stmt) {
                $stmt->bind_param("sss", $username, $email, $hashed_password);
                if ($stmt->execute()) {
                    $_SESSION['username'] = $username;
                    header('Location: egzamin.php');
                    exit();
                } else {
                    $message = "Username or email already exists";
                }
                $stmt->close();
            } else {
                $message = "Failed to prepare statement";
            }
        }
    } elseif (isset($_POST['login'])) {
        $username = $conn->real_escape_string($_POST['username']);
        $password = $_POST['password'];

        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        if ($stmt) {
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['username'] = $user['username'];
                header('Location: egzamin.php');
                exit();
            } else {
                $message = "Invalid username or password";
            }
            $stmt->close();
        } else {
            $message = "Failed to prepare statement";
        }
    } elseif (isset($_POST['update_email'])) {
        $new_email = $conn->real_escape_string($_POST['email']);
        $stmt = $conn->prepare("UPDATE users SET email = ? WHERE username = ?");
        if ($stmt) {
            $stmt->bind_param("ss", $new_email, $_SESSION['username']);
            if ($stmt->execute()) {
                $message = "Email updated successfully";
            } else {
                $message = "Failed to update email";
            }
            $stmt->close();
        } else {
            $message = "Failed to prepare statement";
        }
    } elseif (isset($_POST['update_password'])) {
        $new_password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        if ($new_password === $confirm_password) {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE users SET password = ? WHERE username = ?");
            if ($stmt) {
                $stmt->bind_param("ss", $hashed_password, $_SESSION['username']);
                if ($stmt->execute()) {
                    $message = "Password updated successfully";
                } else {
                    $message = "Failed to update password";
                }
                $stmt->close();
            } else {
                $message = "Failed to prepare statement";
            }
        } else {
            $message = "Passwords do not match";
        }
    } elseif (isset($_POST['delete_account'])) {
        $stmt = $conn->prepare("DELETE FROM users WHERE username = ?");
        if ($stmt) {
            $stmt->bind_param("s", $_SESSION['username']);
            if ($stmt->execute()) {
                session_destroy();
                header('Location: egzamin.php');
                exit();
            } else {
                $message = "Failed to delete account";
            }
            $stmt->close();
        } else {
            $message = "Failed to prepare statement";
        }
    } elseif (isset($_POST['logout'])) {
        session_destroy();
        header('Location: egzamin.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Egzamin</title>
</head>
<body>
    <h2>Witaj na SuperMegaStronce</h2>
    <?php if (isset($_SESSION['username'])): ?>
        <p>Welcome, <?= htmlspecialchars($_SESSION['username']); ?>!</p>
        <?php if (!empty($message)): ?>
            <p style="color: green;"><?= htmlspecialchars($message); ?></p>
        <?php endif; ?>
        <form method="POST">
            <label for="email">New Email</label>
            <input type="email" name="email" required>
            <button type="submit" name="update_email">Update Email</button>
        </form>
        <form method="POST">
            <label for="password">New Password</label>
            <input type="password" name="password" required>
            <br>
            <label for="confirm_password">Confirm New Password</label>
            <input type="password" name="confirm_password" required>
            <button type="submit" name="update_password">Update Password</button>
        </form>
        <form method="POST">
            <button type="submit" name="delete_account">Delete Account</button>
        </form>
        <form method="POST">
            <button type="submit" name="logout">Logout</button>
        </form>
    <?php else: ?>
        <h2>Register</h2>
        <?php if (!empty($message)): ?>
            <p style="color: red;"><?= htmlspecialchars($message); ?></p>
        <?php endif; ?>
        <form method="POST">
            <label for="username">Username</label>
            <input type="text" name="username" required>
            <br>
            <label for="email">Email</label>
            <input type="email" name="email" required>
            <br>
            <label for="password">Password</label>
            <input type="password" name="password" required>
            <br>
            <label for="confirm_password">Confirm Password</label>
            <input type="password" name="confirm_password" required>
            <br>
            <button type="submit" name="register">Register</button>
        </form>

        <h2>Login</h2>
        <form method="POST">
            <label for="username">Username</label>
            <input type="text" name="username" required>
            <br>
            <label for="password">Password</label>
            <input type="password" name="password" required>
            <br>
            <button type="submit" name="login">Login</button>
        </form>
    <?php endif; ?>
</body>
</html>

<?php
$conn->close();
?>
