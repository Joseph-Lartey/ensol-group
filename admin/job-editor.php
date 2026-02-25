<?php
require_once __DIR__ . '/../includes/config.php';
requireLogin();

$editMode = false;
$job = null;

// Check if editing existing job
if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("SELECT * FROM job_postings WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $job = $stmt->fetch();
    $editMode = $job ? true : false;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $editMode ? 'Edit' : 'Create'; ?> Job Posting | Ensol Admin</title>
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
                <a href="jobs-list.php" class="admin-nav-item">
                    <i class="fas fa-briefcase"></i>
                    <span>Job Postings</span>
                </a>
                <a href="job-editor.php" class="admin-nav-item active">
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
            <div class="editor-container">
                <div class="admin-header">
                    <h1><?php echo $editMode ? 'Edit Job Posting' : 'Create New Job Posting'; ?></h1>
                    <p><?php echo $editMode ? 'Update your job details below' : 'Fill in the details to create a new open position'; ?></p>
                </div>

                <form id="job-form" action="job-save.php" method="POST" class="editor-form">
                    <input type="hidden" name="id" value="<?php echo $job['id'] ?? ''; ?>">

                    <div class="form-group">
                        <label for="title">Job Title *</label>
                        <input type="text" id="title" name="title" class="form-control"
                            placeholder="e.g. Senior Operations Manager"
                            value="<?php echo htmlspecialchars($job['title'] ?? ''); ?>" required>
                    </div>

                    <div style="display: flex; gap: 20px;">
                        <div class="form-group" style="flex: 1;">
                            <label for="subsidiary">Subsidiary *</label>
                            <select id="subsidiary" name="subsidiary" class="form-control" required>
                                <option value="">Select subsidiary</option>
                                <option value="Ensol Group" <?php echo ($job['subsidiary'] ?? '') === 'Ensol Group' ? 'selected' : ''; ?>>Ensol Group</option>
                                <option value="Ensol Energy" <?php echo ($job['subsidiary'] ?? '') === 'Ensol Energy' ? 'selected' : ''; ?>>Ensol Energy</option>
                                <option value="Southey Contracting" <?php echo ($job['subsidiary'] ?? '') === 'Southey Contracting' ? 'selected' : ''; ?>>Southey Contracting</option>
                                <option value="Ensol Engineering" <?php echo ($job['subsidiary'] ?? '') === 'Ensol Engineering' ? 'selected' : ''; ?>>Ensol Engineering</option>
                            </select>
                        </div>

                        <div class="form-group" style="flex: 1;">
                            <label for="category">Category *</label>
                            <select id="category" name="category" class="form-control" required>
                                <option value="">Select category</option>
                                <option value="Engineering" <?php echo ($job['category'] ?? '') === 'Engineering' ? 'selected' : ''; ?>>Engineering</option>
                                <option value="Management" <?php echo ($job['category'] ?? '') === 'Management' ? 'selected' : ''; ?>>Management</option>
                                <option value="Operations" <?php echo ($job['category'] ?? '') === 'Operations' ? 'selected' : ''; ?>>Operations</option>
                                <option value="Maintenance & Technical" <?php echo ($job['category'] ?? '') === 'Maintenance & Technical' ? 'selected' : ''; ?>>Maintenance & Technical</option>
                                <option value="Finance & Admin" <?php echo ($job['category'] ?? '') === 'Finance & Admin' ? 'selected' : ''; ?>>Finance & Admin</option>
                            </select>
                        </div>
                    </div>

                    <div style="display: flex; gap: 20px;">
                        <div class="form-group" style="flex: 1;">
                            <label for="location">Location *</label>
                            <input type="text" id="location" name="location" class="form-control"
                                placeholder="e.g. Accra, Ghana"
                                value="<?php echo htmlspecialchars($job['location'] ?? ''); ?>" required>
                        </div>

                        <div class="form-group" style="flex: 1;">
                            <label for="job_type">Job Type *</label>
                            <select id="job_type" name="job_type" class="form-control" required>
                                <option value="">Select job type</option>
                                <option value="Full-time" <?php echo ($job['job_type'] ?? '') === 'Full-time' ? 'selected' : ''; ?>>Full-time</option>
                                <option value="Part-time" <?php echo ($job['job_type'] ?? '') === 'Part-time' ? 'selected' : ''; ?>>Part-time</option>
                                <option value="Contract" <?php echo ($job['job_type'] ?? '') === 'Contract' ? 'selected' : ''; ?>>Contract</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description">Job Description *</label>
                        <textarea id="description" name="description" class="form-control" rows="8"
                            placeholder="Describe the role, responsibilities, and benefits..."
                            required><?php echo htmlspecialchars($job['description'] ?? ''); ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="requirements">Requirements *</label>
                        <textarea id="requirements" name="requirements" class="form-control" rows="8"
                            placeholder="List qualifications, experience needed, and skills..."
                            required><?php echo htmlspecialchars($job['requirements'] ?? ''); ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="application_link">Application Form Link (Optional)</label>
                        <input type="url" id="application_link" name="application_link" class="form-control"
                            placeholder="e.g. https://docs.google.com/forms/... (Leave blank to use email)"
                            value="<?php echo htmlspecialchars($job['application_link'] ?? ''); ?>">
                    </div>

                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="is_active" value="1"
                                <?php echo ($job['is_active'] ?? true) ? 'checked' : ''; ?>>
                            Job is Available (Accepting Applications)
                        </label>
                    </div>

                    <div class="form-actions">
                        <a href="jobs-list.php" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary" id="submit-btn">
                            <i class="fas fa-save"></i> <?php echo $editMode ? 'Update' : 'Create'; ?> Job
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>

</html>