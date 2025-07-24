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
?>

<!DOCTYPE html>
<html>

<head>
    <title>View & Manage Your Message</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
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
</body>

</html>