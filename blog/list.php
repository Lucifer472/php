<?php
include("../config.php");
include("../admin/scripts/db.php");

function categoryFind($conn)
{
    $sql = "SHOW COLUMNS FROM blogs WHERE Field = 'category'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    // Extract ENUM values from the result
    $enum_values = $result['Type'];

    // Parse ENUM values into an array
    preg_match_all("/'([^']+)'/", $enum_values, $matches);
    $values = $matches[1];

    return $values;
}

$cat = categoryFind($conn);

try {
    $limitBlog = (count($cat) * 4) + 1;
    // SQL query to fetch 4 blogs from each ENUM category and the 5 most recently added blogs
    $sql = "
        SELECT * FROM (
        SELECT blogs.*, author.name AS author_name, ROW_NUMBER() OVER (PARTITION BY category ORDER BY id DESC) AS rn 
        FROM blogs 
        LEFT JOIN author ON blogs.author = author.username
    ) AS ranked_blogs
    WHERE rn <= 4
    ORDER BY id DESC
    LIMIT $limitBlog;
    ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Close the database connection
$conn = null;

$recently = [];
$skipFirst = true;

foreach ($results as $r) {
    if ($skipFirst) {
        $skipFirst = false;
    } elseif (count($recently) < 4) {
        $recently[] = $r;
    }
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
    <link rel="canonical" href="<?= $url ?>/blog" />
    <script type="application/ld+json">
    {
        "@context": "http://schema.org",
        "@type": "WebSite",
        "name": "Blog Page | <?= $mainTitle ?>",
        "url": "<?= $url ?>/blog",
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
    <meta property="og:title" content="Blog Page | <?= $mainTitle ?>" />
    <meta property="og:description"
        content="Welcome to <?= $mainTitle ?>, your trusted companion on the road to success in RTO exams across India. We offer a comprehensive platform designed to help you prepare effectively for your upcoming driving license and learner's permit tests. Whether you're aiming to pass the learner's test or upgrade your license, our extensive collection of RTO mock tests and practice questions provides the perfect training ground. Gain the knowledge, confidence, and skills you need to excel in your RTO exams, with instant feedback, in-depth explanations, and real exam simulations. Start your journey towards safe and informed driving today with <?= $mainTitle ?>." />
    <meta property="og:image" content="<?= $url ?>/asset/preview.png" />
    <meta property="og:url" content="<?= $url ?>/blog" />
    <meta property="og:type" content="website" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="Blog Page | <?= $mainTitle ?>" />
    <meta name="twitter:description"
        content="Welcome to <?= $mainTitle ?>, your trusted companion on the road to success in RTO exams across India. We offer a comprehensive platform designed to help you prepare effectively for your upcoming driving license and learner's permit tests. Whether you're aiming to pass the learner's test or upgrade your license, our extensive collection of RTO mock tests and practice questions provides the perfect training ground. Gain the knowledge, confidence, and skills you need to excel in your RTO exams, with instant feedback, in-depth explanations, and real exam simulations. Start your journey towards safe and informed driving today with <?= $mainTitle ?>." />
    <meta name="twitter:image" content="<?= $url ?>/asset/preview.png" />
    <meta name="twitter:url" content="<?= $url ?>/blog" />
    <?php echo $header ?>
    <title>Blog Page |
        <?= $mainTitle ?>
    </title>
</head>

<body>
    <main class="bg-slate-100 w-full">
        <!-- navbar -->
        <?php include("../components/navbar.php"); ?>
        <!-- List page body -->
        <section class="w-full h-full">
            <div class="bg-white global-container w-full">
                <div class="flex flex-col items-center justify-center w-full my-6">
                    <div class="mb-4 shadow-xl border border-gray-200 w-full">
                        <article class="flex flex-col md:grid md:grid-cols-5 w-full">
                            <figure class="md:col-span-2 w-full h-[200px] sm:h-[350px] md:h-full">
                                <img src="<?= $url . $results[0]['imgUrl'] ?>" alt=""
                                    class="w-full h-full object-cover">
                            </figure>
                            <div class="md:col-span-3 flex flex-col items-start justify-start px-4 py-6 gap-6">
                                <h1 class="text-2xl font-semibold cursor-default">
                                    <?= truncateText(str_replace('"', '', $results[0]['title']), 90) ?>
                                </h1>
                                <div class="flex items-center justify-start gap-1">
                                    <a href="<?= $url . '/author/' . $results[0]['author'] ?>"><span itemprop="name"
                                            class="text-gray-500 font-medium text-sm">
                                            <?= $results[0]['author_name'] ?>
                                        </span></a>
                                    <span class="w-2 h-2 rounded-full bg-gray-300"></span>
                                    <a href="<?= $url . '/category/' . $results[0]['category'] ?>"
                                        class="text-gray-500 font-medium text-sm">
                                        <?= $results[0]['category'] ?>
                                    </a>
                                    <span class=" w-2 h-2 rounded-full bg-gray-300"></span>
                                    <time datetime="" class="text-gray-500 font-medium text-sm"
                                        datetime="<?= $results[0]['date'] ?>">
                                        <?= $results[0]['date'] ?>
                                    </time>
                                </div>
                                <p class="text-lg font-medium text-gray-700">
                                    <?= str_replace('"', '', $results[0]['description']) ?>
                                </p>
                                <div class="h-full flex items-end">
                                    <a href="<?= $url . '/blog/' . $results[0]['url'] ?>"
                                        class="flex-end text-xl font-semibold text-black border-b-4 border-blue-400 transition-colors hover:border-red-400">Read
                                        More!</a>
                                </div>
                            </div>
                        </article>
                    </div>
                    <div class="mt-4 flex flex-col items-start justify-start w-full">
                        <div class="w-full border-b-2 border-blue-400">
                            <h1 class="px-4 py-2 text-2xl font-medium">Recently Added:</h1>
                        </div>
                        <div class="flex items-center justify-between gap-4 flex-wrap p-2 w-full">
                            <?php foreach ($recently as $r) {
                                echo '<article
                                    class="flex flex-col items-start justify-start w-full sm:w-[300px] h-[450px] bg-white cursor-pointer shadow-lg"
                                    onclick="openUrlInNewTab(`' . $url . '/blog/' . $r['url'] . '`)">';
                                echo '<figure class="w-full sm:w-[300px] h-[250px]">
                                        <img src="' . $url . $r['imgUrl'] . '" alt=""
                                            class="object-cover w-full h-[250px]">
                                    </figure>';
                                echo '<div class="px-4 py-6 flex flex-col items-start justify-start gap-4 h-full">
                                            <h2 class="text-gray-600 font-semibold leading-6 text-lg hover:underline">' . truncateText(str_replace('"', '', $r['title']), 50) . '</h2>
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
                            ?>
                        </div>
                        <div class="w-full flex items-center justify-center my-4">
                            <a href='<?= $url . "/blog/recently/" ?>'
                                class="px-6 py-2 bg-blue-500 text-white hover:bg-blue-600 shadow-lg">View
                                More</a>
                        </div>
                    </div>
                    <?php
                    foreach ($cat as $c) {
                        echo '
                    <div class="flex flex-col items-start justify-start w-full">
                        <div class="w-full border-b-2 border-blue-400">
                            <h1 class="px-4 py-2 text-2xl font-medium">' . $c . '</h1>
                        </div>
                        <div class="flex items-center justify-between gap-4 flex-wrap p-2 w-full my-4">
                        ';
                        $i = 0;
                        foreach ($results as $r) {
                            if ($r['category'] == $c) {
                                echo '<article
                                    class="flex flex-col items-start justify-start w-full sm:w-[300px] h-[450px] bg-white cursor-pointer shadow-lg"
                                    onclick="openUrlInNewTab(`' . $url . '/blog/' . $r['url'] . '`)">';
                                echo '<figure class="w-full sm:w-[300px] h-[250px]">
                                        <img src="' . $url . $r['imgUrl'] . '" alt=""
                                            class="object-cover w-full h-[250px]">
                                    </figure>';
                                echo '<div class="px-4 py-6 flex flex-col items-start justify-start gap-4 h-full">
                                            <h2 class="text-gray-600 font-semibold leading-6 text-lg hover:underline">' . truncateText(str_replace('"', '', $r['title']), 50) . '</h2>
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
                                $i++;
                            }
                        }
                        if ($i == 0) {
                            echo '
                        </div><h1 class="w-full text-center my-4 text-2xl font-medium capitalize">sorry No Blog Found!</h1>';
                        } elseif ($i == 4) {
                            echo '
                        </div>
                        <div class="w-full flex items-center justify-center my-4">
                            <a href="' . $url . '/category/' . $c . '" class="px-6 py-2 bg-blue-500 text-white hover:bg-blue-600 shadow-lg">View
                                More</a>
                        </div>
                        ';
                        } else {
                            echo '
                        </div>';
                        }
                    }
                    ?>
                </div>
            </div>
        </section>
        <!-- footer -->
        <?php include("../components/footer.php"); ?>
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