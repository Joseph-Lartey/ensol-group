<?php
require_once __DIR__ . '/../includes/config.php';
requireLogin();

// Get all jobs with pagination
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage = 20;
$offset = ($page - 1) * $perPage;

// Get total count
$totalCount = $pdo->query("SELECT COUNT(*) FROM job_postings")->fetchColumn();
$totalPages = ceil($totalCount / $perPage);

// Get jobs
$stmt = $pdo->prepare("
    SELECT id, title, subsidiary, category, location, job_type, is_active, created_at 
    FROM job_postings 
    ORDER BY created_at DESC 
    LIMIT ? OFFSET ?
");
$stmt->execute([$perPage, $offset]);
$jobs = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Jobs | Ensol Careers Admin</title>
    <link rel="icon" type="image/png" href="../assets/favicon.png">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="admin-layout">
        <!-- Sidebar -->
        <aside class="admin-sidebar">
            <div class="admin-sidebar-header">
                <img src="../assets/ensol_logo.jpg" alt="Ensol" class="admin-logo">
                <h3>Careers Admin</h3>
            </div>

            <nav class="admin-nav">
                <a href="dashboard.php" class="admin-nav-item">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
                <a href="news-list.php" class="admin-nav-item">
                    <i class="fas fa-newspaper"></i>
                    <span>News Articles</span>
                </a>
                <a href="jobs-list.php" class="admin-nav-item active">
                    <i class="fas fa-briefcase"></i>
                    <span>Job Postings</span>
                </a>
                <a href="job-editor.php" class="admin-nav-item">
                    <i class="fas fa-plus-circle"></i>
                    <span>New Job</span>
                </a>
                <a href="../index.php" class="admin-nav-item" target="_blank">
                    <i class="fas fa-globe"></i>
                    <span>View Website</span>
                </a>
            </nav>

            <div class="admin-sidebar-footer">
                <div class="admin-user-info">
                    <i class="fas fa-user-circle"></i>
                    <span><?php echo htmlspecialchars($_SESSION['admin_username'] ?? 'Admin'); ?></span>
                </div>
                <a href="logout.php" class="admin-logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="admin-main">
            <div class="admin-header">
                <h1>All Job Postings</h1>
                <p>Manage open positions across the Ensol Group</p>

                <?php if (isset($_SESSION['success_msg'])): ?>
                    <div class="alert alert-success" style="margin-top: 15px; background: #d4edda; color: #155724; padding: 10px; border-radius: 4px;">
                        <?php
                        echo htmlspecialchars($_SESSION['success_msg']);
                        unset($_SESSION['success_msg']);
                        ?>
                    </div>
                <?php endif; ?>
                <?php if (isset($_SESSION['error_msg'])): ?>
                    <div class="alert alert-danger" style="margin-top: 15px; background: #f8d7da; color: #721c24; padding: 10px; border-radius: 4px;">
                        <?php
                        echo htmlspecialchars($_SESSION['error_msg']);
                        unset($_SESSION['error_msg']);
                        ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Jobs Table -->
            <div class="admin-content-box">
                <div class="content-box-header">
                    <h2>Job Postings (<?php echo $totalCount; ?>)</h2>
                    <a href="job-editor.php" class="btn btn-primary">
                        <i class="fas fa-plus"></i> New Job
                    </a>
                </div>

                <div class="articles-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Subsidiary</th>
                                <th>Category</th>
                                <th>Location</th>
                                <th>Status</th>
                                <th>Date Posted</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($jobs as $job): ?>
                                <tr>
                                    <td class="article-title"><?php echo htmlspecialchars($job['title']); ?></td>
                                    <td><span class="category-badge" style="background:#f0f0f0; color:#333; border: 1px solid #ddd;"><?php echo htmlspecialchars($job['subsidiary']); ?></span></td>
                                    <td><?php echo htmlspecialchars($job['category']); ?></td>
                                    <td><?php echo htmlspecialchars($job['location']); ?></td>
                                    <td>
                                        <?php if ($job['is_active']): ?>
                                            <span class="status-badge status-published">Available</span>
                                        <?php else: ?>
                                            <span class="status-badge status-draft">Unavailable</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo date('M d, Y', strtotime($job['created_at'])); ?></td>
                                    <td class="table-actions">
                                        <?php if (!$job['is_active']): ?>
                                            <button onclick="toggleActive(<?php echo $job['id']; ?>, this)" class="btn-action btn-publish" title="Make Available" style="background: #d4edda; color: #28a745;">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        <?php else: ?>
                                            <button onclick="toggleActive(<?php echo $job['id']; ?>, this)" class="btn-action btn-unpublish" title="Make Unavailable" style="background: #fff3cd; color: #856404;">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        <?php endif; ?>
                                        <a href="job-editor.php?id=<?php echo $job['id']; ?>" class="btn-action btn-edit" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="job-delete.php" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this job posting?');">
                                            <input type="hidden" name="id" value="<?php echo $job['id']; ?>">
                                            <button type="submit" class="btn-action btn-delete" title="Delete" style="background: none; border: none; cursor: pointer;">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                            <?php if (empty($jobs)): ?>
                                <tr>
                                    <td colspan="7" class="text-center" style="padding: 40px;">
                                        No job postings yet. <a href="job-editor.php">Create your first job posting</a>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <?php if ($totalPages > 1): ?>
                    <div style="padding: 20px; text-align: center;">
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <a href="?page=<?php echo $i; ?>"
                                class="btn <?php echo $i === $page ? 'btn-primary' : 'btn-secondary'; ?>"
                                style="margin: 0 4px;">
                                <?php echo $i; ?>
                            </a>
                        <?php endfor; ?>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>

    <script>
        async function toggleActive(jobId, button) {
            const row = button.closest('tr');
            const statusBadge = row.querySelector('.status-badge');

            button.disabled = true;
            const originalHTML = button.innerHTML;
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';

            try {
                const response = await fetch('job-toggle-active.php?id=' + jobId);
                const data = await response.json();

                if (data.success) {
                    // Update status badge
                    if (data.is_active) {
                        statusBadge.className = 'status-badge status-published';
                        statusBadge.textContent = 'Available';
                        button.style.background = '#fff3cd';
                        button.style.color = '#856404';
                        button.title = 'Make Unavailable';
                        button.innerHTML = '<i class="fas fa-times"></i>';
                    } else {
                        statusBadge.className = 'status-badge status-draft';
                        statusBadge.textContent = 'Unavailable';
                        button.style.background = '#d4edda';
                        button.style.color = '#28a745';
                        button.title = 'Make Available';
                        button.innerHTML = '<i class="fas fa-check"></i>';
                    }
                } else {
                    alert('Error: ' + data.message);
                    button.innerHTML = originalHTML;
                }
            } catch (error) {
                alert('An error occurred. Please try again.');
                button.innerHTML = originalHTML;
            }

            button.disabled = false;
        }
    </script>
</body>

</html>