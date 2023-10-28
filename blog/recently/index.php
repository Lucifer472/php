<?php
include("../../config.php");
include("../../admin/scripts/db.php");
$uri = $_SERVER['REQUEST_URI'];

// Parse the URL to extract path and query
$parsedUrl = parse_url($uri);

// Get the path from the parsed URL
$path = $parsedUrl['path'];

// Remove the leading and trailing slashes from the path
$pathWithoutSlashes = trim($path, '/');

// Extract the slug from the path
$currentPage = explode('/', $pathWithoutSlashes)[2];
try {
    if (!$currentPage) {
        $currentPage = 1;
    }
    $perPage = 16;
    $offset = ($currentPage - 1) * $perPage;
    // SQL query to fetch 4 blogs from each ENUM category and the 5 most recently added blogs
    $sql = "SELECT * FROM blogs ORDER BY id DESC LIMIT $perPage OFFSET $offset";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Welcome to <?= $mainTitle ?>, your trusted companion on the road to success in RTO exams across India. We offer a comprehensive platform designed to help you prepare effectively for your upcoming driving license and learner's permit tests. Whether you're aiming to pass the learner's test or upgrade your license, our extensive collection of RTO mock tests and practice questions provides the perfect training ground. Gain the knowledge, confidence, and skills you need to excel in your RTO exams, with instant feedback, in-depth explanations, and real exam simulations. Start your journey towards safe and informed driving today with <?= $mainTitle ?>." />
    <meta name="keywords"
        content="RTO mock test, RTO exam preparation, Driving license test, Learner's permit practice, Indian RTO exams, Driving license practice test, Road safety quiz, Vehicle rules test, RTO practice questions, Regional Transport Office, Driving test simulator, RTO exam pattern, Traffic rules quiz, Motor vehicle knowledge, Indian driving license, Practice RTO questions, Traffic signs and signals, Road safety tips, License renewal test, Indian road regulations" />
    <meta name="robots" content="index, follow" />
    <link rel="canonical" href="<?= $url ?>/blog/recently" />
    <script type="application/ld+json">
    {
        "@context": "http://schema.org",
        "@type": "WebSite",
        "name": "Recently Added Blogs | <?= $mainTitle ?>",
        "url": "<?= $url ?>/blog/recently",
        "description": "Welcome to <?= $mainTitle ?>, your trusted companion on the road to success in RTO exams across India. We offer a comprehensive platform designed to help you prepare effectively for your upcoming driving license and learner's permit tests. Whether you're aiming to pass the learner's test or upgrade your license, our extensive collection of RTO mock tests and practice questions provides the perfect training ground. Gain the knowledge, confidence, and skills you need to excel in your RTO exams, with instant feedback, in-depth explanations, and real exam simulations. Start your journey towards safe and informed driving today with <?= $mainTitle ?>.",
        "publisher": {
            "@type": "Organization",
            "name": "Truepub Media",
            "logo": {
                "@type": "ImageObject",
                "url": "<?= $url ?>/asset/logo.svg",
                "width": 40,
                "height": 41
            }
        }
    }
    </script>
    <meta property="og:title" content="Recently Added Blogs | <?= $mainTitle ?>" />
    <meta property="og:description"
        content="Welcome to <?= $mainTitle ?>, your trusted companion on the road to success in RTO exams across India. We offer a comprehensive platform designed to help you prepare effectively for your upcoming driving license and learner's permit tests. Whether you're aiming to pass the learner's test or upgrade your license, our extensive collection of RTO mock tests and practice questions provides the perfect training ground. Gain the knowledge, confidence, and skills you need to excel in your RTO exams, with instant feedback, in-depth explanations, and real exam simulations. Start your journey towards safe and informed driving today with <?= $mainTitle ?>." />
    <meta property="og:image" content="<?= $url ?>/asset/preview.png" />
    <meta property="og:url" content="<?= $url ?>/blog/recently" />
    <meta property="og:type" content="website" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="Recently Added Blogs | <?= $mainTitle ?>" />
    <meta name="twitter:description"
        content="Welcome to <?= $mainTitle ?>, your trusted companion on the road to success in RTO exams across India. We offer a comprehensive platform designed to help you prepare effectively for your upcoming driving license and learner's permit tests. Whether you're aiming to pass the learner's test or upgrade your license, our extensive collection of RTO mock tests and practice questions provides the perfect training ground. Gain the knowledge, confidence, and skills you need to excel in your RTO exams, with instant feedback, in-depth explanations, and real exam simulations. Start your journey towards safe and informed driving today with <?= $mainTitle ?>." />
    <meta name="twitter:image" content="<?= $url ?>/asset/preview.png" />
    <meta name="twitter:url" content="<?= $url ?>/blog/recently" />
    <?php echo $header ?>
    <title>Recently Added Blogs |
        <?= $mainTitle ?>
    </title>
</head>

<body>
    <main class="bg-slate-100 w-full">
        <!-- navbar -->
        <?php include("../../components/navbar.php"); ?>
        <!-- List page body -->
        <section class="w-full h-full">
            <div class="bg-white global-container w-full">
                <div class="flex flex-col items-center justify-center w-full my-6">
                    <div class="my-2 flex flex-col items-start justify-start w-full">
                        <div class="w-full border-b-2 border-blue-400">
                            <h1 class="px-4 py-2 text-2xl font-medium">Recently Added:</h1>
                        </div>
                        <div class="flex items-center justify-evenly gap-4 flex-wrap p-2 w-full">
                            <?php
                            if (count($results) == 0) {
                                echo '<div class="w-full h-full min-h-[300px] flex gap-4 items-center justify-center flex-col"><h1 class="text-2xl font-semibold">No Blog Found</h1>
                                <a href="' . $url . '" class="px-6 py-2 bg-blue-500 text-white hover:bg-blue-600 shadow-lg">Home</a></div>';
                            } else {
                                foreach ($results as $r) {
                                    echo '<article
                                    class="flex flex-col items-start justify-start w-full sm:w-[300px] h-[450px] bg-white cursor-pointer shadow-lg"
                                    onclick="openUrlInNewTab(`' . $url . '/blog/' . $r['url'] . '`)">';
                                    echo '<figure class="w-full sm:w-[300px] h-[250px]">
                                        <img src="' . $url . $r['imgUrl'] . '" alt=""
                                            class="object-cover w-full h-[250px]">
                                    </figure>';
                                    echo '<div class="px-4 py-6 flex flex-col items-start justify-start gap-4 h-full">
                                            <h2 class="text-gray-600 font-semibold leading-6 text-lg hover:underline">' . truncateText(str_replace('"', '', $r['title']), 60) . '</h2>
                                            <a href="' . $url . "/author/" . $r['author'] . '" class="text-sm font-medium text-gray-400 hover:underline">' . $r['author_name'] . '</a>
                                            <div class="h-full flex items-end">
                                                <div class="flex items-center gap-1">
                                                    <time datetime="2023-10-18" class="text-gray-500 text-base font-bold" datetime="' . $r['date'] . '">' . $r['date'] . '</time>
                                                    <span class="h-2 w-2 bg-gray-300 rounded-full"></span>
                                                    <a href="' . $url . "/category/" . $r['category'] . '" class="text-gray-500 text-base font-bold hover:underline">' . $r['category'] . '</a>
                                                </div>
                                        </div>
                                    </div>';
                                    echo '</article>';
                                }
                            }
                            ?>
                        </div>
                        <div class="w-full flex items-center justify-center gap-4 my-4">
                            <?php
                            if (!($currentPage < 2)) {
                                echo '
                            <a href=' . $url . '/blog/recently/' . ($currentPage - 1) . ' class="px-6 py-2 bg-blue-500 text-white hover:bg-blue-600 shadow-lg">Back</a>';
                            } ?>
                            <span class="px-6 py-2 bg-blue-500 text-white hover:bg-blue-600 shadow-lg">
                                <?= $currentPage ?>
                            </span>
                            <?php
                            $nextPage = $currentPage + 1;
                            $hasNextPage = false; // Initialize as false
                            
                            // Check if there are more blogs beyond the current page
                            $sqlCount = "SELECT COUNT(*) FROM blogs"; // Count all blogs
                            $stmtCount = $conn->prepare($sqlCount);
                            $stmtCount->execute();
                            $totalBlogs = $stmtCount->fetchColumn();

                            if ($totalBlogs > $currentPage * $perPage) {
                                $hasNextPage = true;
                            }

                            // Close the database connection
                            $conn = null;

                            if ($hasNextPage) {
                                echo '<a href=' . $url . "/blog/recently/" . ($currentPage + 1) . '
                            class="px-6 py-2 bg-blue-500 text-white hover:bg-blue-600 shadow-lg">Next</a>';
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- footer -->
        <?php include("../../components/footer.php"); ?>
    </main>
    <script src="<?php echo $url ?>/main.js"></script>
    <script>
        console.log(<?= json_encode($results) ?>)

        function openUrlInNewTab(url) {
            if (url) {
                window.open(url, '_blank');
            }
        }
    </script>
</body>

</html>