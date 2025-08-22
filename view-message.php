<?php
session_start();
require 'dbconnect.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login_form.php');
    exit;
}

$message = '';
$contact = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // --- DELETE OPERATION ---
    if (isset($_POST['delete']) && isset($_POST['contact_id'])) {
        $contact_id = intval($_POST['contact_id']);

        // Delete row by id
        $stmt = $conn->prepare("DELETE FROM contact WHERE Id = ? LIMIT 1");
        $stmt->bind_param("i", $contact_id);
        if ($stmt->execute()) {
            $message = "Message deleted successfully.";
            $contact = null; // Clear displayed data after deletion
        } else {
            $message = "Failed to delete record from database.";
        }
        $stmt->close();



        // --- UPDATE OPERATION ---
    } elseif (isset($_POST['update']) && isset($_POST['contact_id']) && isset($_POST['new_message'])) {
        $contact_id = intval($_POST['contact_id']);
        $new_message = trim($_POST['new_message']);
        $stmt = $conn->prepare("UPDATE contact SET message = ? WHERE id = ? LIMIT 1");
        $stmt->bind_param("si", $new_message, $contact_id);
        if ($stmt->execute()) {
            $message = "Message updated successfully.";
            // Re-fetch updated contact
            $stmt->close();
            $stmt = $conn->prepare("SELECT * FROM contact WHERE id = ? LIMIT 1");
            $stmt->bind_param("i", $contact_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $contact = $result->fetch_assoc();
            $stmt->close();
        } else {
            $message = "Failed to update message.";
            $stmt->close();
        }

        // --- SEARCH OPERATION ---
    } elseif (isset($_POST['search']) && isset($_POST['search_email'])) {
        $search_email = trim($_POST['search_email']);
        if (filter_var($search_email, FILTER_VALIDATE_EMAIL)) {
            $stmt = $conn->prepare("SELECT * FROM contact WHERE email = ? LIMIT 1");
            $stmt->bind_param("s", $search_email);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $contact = $result->fetch_assoc();
            } else {
                $message = "No message found for this email.";
            }
            $stmt->close();
        } else {
            $message = "Enter a valid email.";
        }
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete']) && isset($_POST['contact_id'])) {
        $contact_id = intval($_POST['contact_id']);
        $stmt = $conn->prepare("DELETE FROM contact WHERE Id = ? LIMIT 1");
        $stmt->bind_param("i", $contact_id);
        if ($stmt->execute()) {
            $message = "Message deleted successfully.";
        } else {
            $message = "Failed to delete message.";
        }
        $stmt->close();
    } elseif (isset($_POST['update']) && isset($_POST['contact_id']) && isset($_POST['new_message'])) {
        $contact_id = intval($_POST['contact_id']);
        $new_message = trim($_POST['new_message']);
        $stmt = $conn->prepare("UPDATE contact SET message = ? WHERE Id = ? LIMIT 1");
        $stmt->bind_param("si", $new_message, $contact_id);
        if ($stmt->execute()) {
            $message = "Message updated successfully.";
        } else {
            $message = "Failed to update message.";
        }
        $stmt->close();
    }
}

// Fetch all messages
$sql = "SELECT Id, name, email, message FROM contact ORDER BY Id ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>View & Manage Your Message</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-eduwell-style.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/lightbox.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function toggleUpdateForm(id) {
            var displaySpan = document.getElementById('messageDisplay-' + id);
            var updateForm = document.getElementById('updateForm-' + id);

            if (updateForm.style.display === 'none' || updateForm.style.display === '') {
                displaySpan.style.display = 'none';
                updateForm.style.display = 'block'; // block better than inline here because form elements by default block-level
            } else {
                displaySpan.style.display = 'inline';
                updateForm.style.display = 'none';
            }
        }

        function confirmDelete() {
            return confirm("Are you sure you want to delete this message?");
        }

        function showUpdateForm() {
            document.getElementById('messageDisplay').style.display = 'none';
            document.getElementById('updateForm').style.display = 'block';
        }

        function cancelUpdate() {
            document.getElementById('updateForm').style.display = 'none';
            document.getElementById('messageDisplay').style.display = 'block';
        }
    </script>
</head>

<body class="bg-light">
    <?php include 'include/header.php' ?>
    <br><br><br><br><br>
    <div class="container mt-5">
        <h2 class="mb-4 text-center text-primary">Search Your Message</h2>
        <?php if ($message): ?>
            <div class="alert alert-info text-center"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>

        <?php if (!$contact): ?>
            <form method="POST" class="mb-5">
                <div class="mb-3">
                    <label for="search_email" class="form-label">Enter your Email</label>
                    <input type="email" class="form-control" id="search_email" name="search_email" required>
                </div>
                <div class="text-center">
                    <button type="submit" name="search" class="btn btn-primary">Search Message</button>
                </div>
            </form>
        <?php endif; ?>

        <?php if ($contact): ?>
            <div id="messageDisplay" class="card shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($contact['name']); ?></h5>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($contact['email']); ?></p>
                    <p><strong>Message:</strong> <?php echo nl2br(htmlspecialchars($contact['message'])); ?></p>
                    <button class="btn btn-warning me-2" onclick="showUpdateForm()">Update</button>
                    <form method="POST" class="d-inline" onsubmit="return confirmDelete();">
                        <input type="hidden" name="contact_id" value="<?php echo (int)$contact['Id']; ?>">
                        <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>

            <!-- Update Form (hidden by default) -->
            <div id="updateForm" style="display:none;" class="card shadow-sm p-4">
                <form method="POST">
                    <h5>Update Your Message</h5>
                    <div class="mb-3">
                        <textarea name="new_message" rows="5" class="form-control" required><?php echo htmlspecialchars($contact['message']); ?></textarea>
                    </div>
                    <input type="hidden" name="contact_id" value="<?php echo (int)$contact['Id']; ?>">
                    <button type="submit" name="update" class="btn btn-success me-2">Save Changes</button>
                    <button type="button" class="btn btn-secondary" onclick="cancelUpdate()">Cancel</button>
                </form>
            </div>
        <?php endif; ?>
    </div>

    <!-- Update form End -->

    <!-- All messages display  -->
    <div class="container mt-5">
        <h2 class="mb-4 text-center">All Messages</h2>

        <?php if ($result->num_rows > 0): ?>
            <table class="table table-bordered table-striped align-middle text-center">
                <thead class="table-primary">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td>
                                <span id="messageDisplay-<?php echo $row['Id']; ?>">
                                    <?php echo nl2br(htmlspecialchars($row['message'])); ?>
                                </span>
                                <!-- Update Form: Hidden by default -->
                                <form id="updateForm-<?php echo $row['Id']; ?>" method="POST" style="display:none;">
                                    <input type="hidden" name="contact_id" value="<?php echo $row['Id']; ?>">
                                    <textarea name="new_message" rows="2" class="form-control form-control-sm d-inline" style="width:260px;display:inline-block;" required><?php echo htmlspecialchars($row['message']); ?></textarea>
                                    <button type="submit" name="update" class="btn btn-sm btn-success ms-1">Save</button>
                                    <button type="button" class="btn btn-sm btn-secondary ms-1" onclick="toggleUpdateForm(<?php echo $row['Id']; ?>)">Cancel</button>
                                </form>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-warning" onclick="toggleUpdateForm(<?php echo $row['Id']; ?>)">Update</button>
                                <form method="POST" class="d-inline" onsubmit="return confirmDelete();">
                                    <input type="hidden" name="contact_id" value="<?php echo $row['Id']; ?>">
                                    <button type="submit" name="delete" class="btn btn-sm btn-danger ms-1">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

        <?php else: ?>
            <p class="text-center">No messages found.</p>
        <?php endif; ?>
    </div>
    

    <!-- Footer Start  -->
    <footer class="site-footer">
    <div class="footer-container">
      <div class="col-lg-12 social-icons-wrapper">
        <ul class="social-icons">
          <li><a href="#"><i class="fa fa-facebook"></i></a></li>
          <li><a href="#"><i class="fa fa-twitter"></i></a></li>
          <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
          <li><a href="#"><i class="fa fa-rss"></i></a></li>
          <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
        </ul>
      </div>
      <!-- About -->
      <div class="footer-box">
        <h3>Cambridge International School</h3>
        <p>Empowering students with knowledge, discipline, and values since 1995.</p>
      </div>

      <!-- Quick Links -->
      <div class="footer-box">
        <h4>Quick Links</h4>
        <ul>
          <li><a href="index.php #top">Home</a></li>
          <li><a href="about-us.php">About Us</a></li>
          <li><a href="index.php #testimonials">Testimonials</a></li>
          <li><a href="Gallery.php">Gallery</a></li>
          <li><a href="contact.php">Contact</a></li>
        </ul>
      </div>

      <!-- Contact Info -->
      <div class="footer-box">
        <h4>Contact Us</h4>
        <p><strong>Address:</strong> Shahpur Bus Stand, Talheri Buzurg, Saharanpur</p>
        <p><strong>Phone:</strong> +91 9876543210</p>
        <p><strong>Email:</strong> info@cambridgeschool.com</p>
      </div>

    </div>

    <hr>
    <p class="footer-bottom">&copy; 2025 Cambridge International School. All rights reserved.</p>
  </footer>
</body>

</html>