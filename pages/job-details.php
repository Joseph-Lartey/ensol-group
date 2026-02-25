<?php
require_once __DIR__ . '/../includes/config.php';

// Get job by slug
$slug = isset($_GET['slug']) ? trim($_GET['slug']) : '';

if (empty($slug)) {
    header('Location: career.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM job_postings WHERE slug = ?");
$stmt->execute([$slug]);
$job = $stmt->fetch();

if (!$job) {
    header('Location: career.php');
    exit;
}

function getSubsidiaryLogo($subsidiary)
{
    switch (trim($subsidiary)) {
        case 'Ensol Energy':
            return '../assets/ensol_energy.jpeg';
        case 'Southey Contracting':
            return '../assets/Southey_no_background.png';
        case 'Ensol Engineering':
            return '../assets/ensol_enginerring.jpeg';
        default:
            return '../assets/ensol_logo.jpg';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($job['title']); ?> | Careers | Ensol Group</title>
    <link rel="icon" type="image/png" href="../assets/favicon.png">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../styles.css">

    <style>
        .job-detail-wrapper {
            background-color: #fafafa;
            min-height: 80vh;
            padding: 8rem 1rem 4rem;
            font-family: 'Inter', sans-serif;
        }

        .job-detail-container {
            max-width: 900px;
            margin: 0 auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            overflow: hidden;
            border: 1px solid #eaeaea;
        }

        .job-header {
            padding: 3rem 4rem 2rem;
            border-bottom: 1px solid #eaeaea;
            position: relative;
        }

        .back-link {
            position: absolute;
            top: 1.5rem;
            left: 2rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #666;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: color 0.3s;
        }

        .back-link:hover {
            color: var(--vivid-red);
        }

        .job-header-top {
            display: flex;
            align-items: flex-start;
            gap: 2rem;
            margin-top: 1.5rem;
        }

        .job-logo {
            width: 80px;
            height: 80px;
            background: #fff;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border: 1px solid #eaeaea;
            padding: 10px;
        }

        .job-logo img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .job-title-area {
            flex: 1;
        }

        .job-title-area h1 {
            font-family: 'Merriweather', serif;
            font-size: 2.2rem;
            color: #222;
            margin-bottom: 0.5rem;
        }

        .job-company {
            font-size: 1.1rem;
            color: #555;
            font-weight: 500;
            margin-bottom: 1.5rem;
        }

        .job-meta-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .meta-tag {
            background: #f4f4f4;
            color: #444;
            padding: 0.4rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .meta-tag i {
            color: #888;
        }

        .badge-available {
            background: #e6f4ea;
            color: #1e8e3e;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            display: inline-flex;
            align-items: center;
        }

        .badge-unavailable {
            background: #fce8e6;
            color: #d93025;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            display: inline-flex;
            align-items: center;
        }

        .job-body {
            padding: 3rem 4rem;
        }

        .section-title {
            font-size: 1.3rem;
            color: #222;
            font-weight: 600;
            margin-bottom: 1.2rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #f0f0f0;
            display: inline-block;
        }

        .job-content-block {
            color: #444;
            line-height: 1.8;
            margin-bottom: 2.5rem;
            font-size: 1.05rem;
        }

        .job-content-block p {
            margin-bottom: 1rem;
        }

        .job-content-block ul {
            padding-left: 1.5rem;
            margin-bottom: 1rem;
        }

        .job-content-block li {
            margin-bottom: 0.5rem;
        }

        .apply-box {
            background: #fcfcfc;
            border: 1px solid #eaeaea;
            border-radius: 8px;
            padding: 2.5rem;
            text-align: center;
            margin-top: 2rem;
        }

        .apply-box h3 {
            font-size: 1.4rem;
            margin-bottom: 1rem;
            color: #222;
        }

        .apply-box p {
            color: #666;
            margin-bottom: 1.5rem;
        }

        .btn-apply {
            display: inline-block;
            background: var(--vivid-red);
            color: #fff;
            padding: 1rem 3rem;
            border-radius: 30px;
            font-weight: 600;
            font-size: 1.1rem;
            text-decoration: none;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(220, 22, 9, 0.3);
        }

        .btn-apply:hover {
            background: #b01207;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(220, 22, 9, 0.4);
            color: #fff;
        }

        @media (max-width: 768px) {
            .job-header {
                padding: 2rem;
            }

            .job-header-top {
                flex-direction: column;
                gap: 1rem;
            }

            .job-body {
                padding: 2rem;
            }

            .job-title-area h1 {
                font-size: 1.8rem;
            }
        }
    </style>
</head>

<body>
    <!-- Header Navigation -->
    <header class="header" id="header">
        <div class="container">
            <nav class="navbar">
                <a href="../index.php" class="logo">
                    <img src="../assets/ensol_logo.jpg" alt="Ensol Group Logo">
                </a>

                <ul class="nav-links" id="nav-links">
                    <li><a href="../index.php" class="nav-link">Home</a></li>
                    <li><a href="about.php" class="nav-link">About us</a></li>
                    <li><a href="services.php" class="nav-link">Services</a></li>
                    <li><a href="clients.php" class="nav-link">Clients</a></li>
                    <li><a href="news.php" class="nav-link">News</a></li>
                    <li><a href="career.php" class="nav-link active">Career</a></li>
                    <li><a href="contact.php" class="nav-link btn-contact">Contact Us</a></li>
                </ul>

                <button class="hamburger" id="hamburger" aria-label="Toggle navigation">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </button>
            </nav>
        </div>
    </header>

    <div class="job-detail-wrapper">
        <div class="job-detail-container animate-on-scroll">

            <div class="job-header">
                <a href="career.php" class="back-link">
                    <i class="fas fa-arrow-left"></i> Back to all jobs
                </a>

                <div class="job-header-top">
                    <div class="job-logo">
                        <img src="<?php echo getSubsidiaryLogo($job['subsidiary']); ?>" alt="<?php echo htmlspecialchars($job['subsidiary']); ?>">
                    </div>

                    <div class="job-title-area">
                        <h1><?php echo htmlspecialchars($job['title']); ?></h1>
                        <div class="job-company"><?php echo htmlspecialchars($job['subsidiary']); ?></div>

                        <div class="job-meta-tags">
                            <span class="meta-tag"><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($job['location']); ?></span>
                            <span class="meta-tag"><i class="fas fa-briefcase"></i> <?php echo htmlspecialchars($job['job_type']); ?></span>
                            <span class="meta-tag"><i class="fas fa-layer-group"></i> <?php echo htmlspecialchars($job['category']); ?></span>
                            <span class="meta-tag"><i class="far fa-clock"></i> Posted <?php echo date('M d, Y', strtotime($job['created_at'])); ?></span>

                            <?php if ($job['is_active']): ?>
                                <span class="badge-available">Available</span>
                            <?php else: ?>
                                <span class="badge-unavailable">Unavailable</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="job-body">
                <h2 class="section-title">Job Description</h2>
                <div class="job-content-block">
                    <?php echo nl2br(htmlspecialchars($job['description'])); ?>
                </div>

                <h2 class="section-title">Requirements & Qualifications</h2>
                <div class="job-content-block">
                    <?php echo nl2br(htmlspecialchars($job['requirements'])); ?>
                </div>

                <div class="apply-box">
                    <?php if (!$job['is_active']): ?>
                        <h3>Currently Unavailable</h3>
                        <p>This position is no longer accepting applications.</p>
                        <button class="btn-apply" disabled style="opacity: 0.5; cursor: not-allowed;">
                            Closed
                        </button>
                    <?php else: ?>
                        <h3>Interested in this role?</h3>

                        <?php if (!empty($job['application_link'])): ?>
                            <p>Click the button below to proceed to the application form.</p>
                            <a href="<?php echo htmlspecialchars($job['application_link']); ?>" target="_blank" class="btn-apply">
                                Apply Now <i class="fas fa-external-link-alt" style="margin-left: 8px;"></i>
                            </a>
                        <?php else: ?>
                            <p>Send your CV and cover letter to our HR department citing the job title in the subject line.</p>
                            <?php
                            // Construct mailto link
                            $subject = rawurlencode("Application: " . $job['title'] . " - " . $job['subsidiary']);
                            $body = rawurlencode("Hello HR Team,\n\nI am writing to apply for the " . $job['title'] . " position at " . $job['subsidiary'] . ".\n\nPlease find my CV and details attached.\n\nBest regards,\n[Your Name]");
                            $mailto = "mailto:hr@ensolgroup.com.gh?subject={$subject}&body={$body}";
                            ?>
                            <a href="<?php echo $mailto; ?>" class="btn-apply">
                                Apply Now <i class="fas fa-paper-plane" style="margin-left: 8px;"></i>
                            </a>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>

    <?php include __DIR__ . '/../includes/footer.php'; ?>

    <script src="../script.js"></script>
</body>

</html>