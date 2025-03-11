<?php
// admin.php - View all contact form submissions
// Add these lines for error reporting during development
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Basic authentication for security
// IMPORTANT: Change these credentials before using in production
$admin_username = "admin";
$admin_password = "password123";

// Check if authentication is provided
if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) || 
    $_SERVER['PHP_AUTH_USER'] != $admin_username || $_SERVER['PHP_AUTH_PW'] != $admin_password) {
    header('WWW-Authenticate: Basic realm="Admin Access"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Authentication required to access this page.';
    exit;
}

// Database connection parameters
$servername = "localhost";
$username = "root"; // Default phpMyAdmin username
$password = ""; // Default is empty for XAMPP/WAMP
$dbname = "contact_form";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare SQL statement to retrieve all submissions
$sql = "SELECT * FROM submissions ORDER BY submission_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Submissions - Admin Panel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            padding-top: 2rem;
            background-color: #f9f9f9;
        }
        .container {
            max-width: 1200px;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
        }
        .card-header {
            background: linear-gradient(135deg, #4361ee, #3a0ca3);
            color: white;
            border-radius: 10px 10px 0 0 !important;
            padding: 1rem;
        }
        .table th {
            background-color: #f8f9fa;
        }
        .badge {
            font-size: 0.8rem;
        }
        .empty-state {
            padding: 3rem;
            text-align: center;
            color: #6c757d;
        }
        .message-cell {
            max-width: 300px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .modal-body pre {
            white-space: pre-wrap;
            background-color: #f8f9fa;
            padding: 1rem;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="mb-0">Contact Form Submissions</h3>
                <a href="index.php" class="btn btn-light btn-sm">Back to Website</a>
            </div>
            <div class="card-body">
                <?php
                if ($result->num_rows > 0) {
                    echo '<div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Subject</th>
                                        <th>Message</th>
                                        <th>Date</th>
                                        <th>IP Address</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>';
                    
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        $date = new DateTime($row["submission_date"]);
                        $formatted_date = $date->format('M d, Y h:i A');
                        
                        echo '<tr>
                                <td>' . $row["id"] . '</td>
                                <td>' . htmlspecialchars($row["name"]) . '</td>
                                <td><a href="mailto:' . htmlspecialchars($row["email"]) . '">' . htmlspecialchars($row["email"]) . '</a></td>
                                <td>' . htmlspecialchars($row["subject"]) . '</td>
                                <td class="message-cell">' . htmlspecialchars($row["message"]) . '</td>
                                <td><span class="badge bg-secondary">' . $formatted_date . '</span></td>
                                <td>' . $row["ip_address"] . '</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary view-btn" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#messageModal" 
                                        data-name="' . htmlspecialchars($row["name"]) . '"
                                        data-email="' . htmlspecialchars($row["email"]) . '"
                                        data-subject="' . htmlspecialchars($row["subject"]) . '"
                                        data-message="' . htmlspecialchars($row["message"]) . '"
                                        data-date="' . $formatted_date . '">
                                        View
                                    </button>
                                </td>
                            </tr>';
                    }
                    
                    echo '</tbody>
                        </table>
                    </div>';
                } else {
                    echo '<div class="empty-state">
                            <i class="fas fa-inbox fa-3x mb-3"></i>
                            <h4>No submissions yet</h4>
                            <p>When visitors submit the contact form, their messages will appear here.</p>
                        </div>';
                }
                
                // Close connection
                $conn->close();
                ?>
            </div>
            <div class="card-footer text-muted">
                <div class="d-flex justify-content-between align-items-center">
                    <span>Total entries: <?php echo $result->num_rows; ?></span>
                    <span>Last updated: <?php echo date('M d, Y h:i A'); ?></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Message Modal -->
    <div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="messageModalLabel">Message Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <strong>From:</strong> <span id="modal-name"></span> (<span id="modal-email"></span>)
                    </div>
                    <div class="mb-3">
                        <strong>Subject:</strong> <span id="modal-subject"></span>
                    </div>
                    <div class="mb-3">
                        <strong>Date:</strong> <span id="modal-date"></span>
                    </div>
                    <div class="mb-3">
                        <strong>Message:</strong>
                        <pre id="modal-message"></pre>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a id="reply-link" href="mailto:" class="btn btn-primary">Reply</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Handle modal data
        const messageModal = document.getElementById('messageModal');
        if (messageModal) {
            messageModal.addEventListener('show.bs.modal', event => {
                const button = event.relatedTarget;
                const name = button.getAttribute('data-name');
                const email = button.getAttribute('data-email');
                const subject = button.getAttribute('data-subject');
                const message = button.getAttribute('data-message');
                const date = button.getAttribute('data-date');
                
                document.getElementById('modal-name').textContent = name;
                document.getElementById('modal-email').textContent = email;
                document.getElementById('modal-subject').textContent = subject;
                document.getElementById('modal-message').textContent = message;
                document.getElementById('modal-date').textContent = date;
                
                const replyLink = document.getElementById('reply-link');
                replyLink.href = `mailto:${email}?subject=Re: ${subject}`;
            });
        }
    </script>
</body>
</html>