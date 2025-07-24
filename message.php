<?php
session_start();
require 'dbconnect.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login_form.php');
    exit;
}

$message = '';

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
    <title>All Messages</title>
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
    </script>

</head>

<body class="bg-light">
    <div class="container mt-5">
        <h2 class="mb-4 text-center">All Messages</h2>

        <?php if ($message): ?>
            <div class="alert alert-info"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>