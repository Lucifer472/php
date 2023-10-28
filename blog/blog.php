<?php
include("../config.php");
include("../admin/scripts/db.php");
try {
    $sql = "SELECT blogs.*, author.name AS author_name FROM blogs LEFT JOIN author ON blogs.author = author.username WHERE url = '$slug'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($results) == 0) {
        header("Location: $url");
    }
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
    <meta name="description" content="<?= str_replace('"', '', $results[0]['description']) ?>" />
    <meta name="keywords" content="<?= str_replace('"', '', $results[0]['keyword']) ?>" />
    <meta name="robots" content="index, follow" />
    <link rel="canonical" href="<?= $url . "/blog/" . $results[0]['url'] ?>" />
    <script type="application/ld+json">
    {
        "@context": "http://schema.org",
        "@type": "BlogPosting",
        "mainEntityOfPage": {
            "@type": "WebPage",
            "@id": "<?= $url . "/blog/" . $results[0]['url'] ?>"
        },
        "headline": "<?= str_replace('"', '', $results[0]["title"]) ?>",
        "datePublished": "<?= $results[0]["date"] ?>",
        "dateModified": "<?= $results[0]["date"] ?>",
        "author": {
            "@type": "Person",
            "name": "<?= $results[0]["author_name"] ?>"
        },
        "publisher": {
            "@type": "Organization",
            "name": "<?= $mainTitle ?>",
            "logo": {
                "@type": "ImageObject",
                "url": "<?= $url ?>/asset/logo.svg",
                "width": 40,
                "height": 61
            }
        },
        "description": "<?= str_replace('"', '', $results[0]['description']) ?>",
        "image": {
            "@type": "ImageObject",
            "url": "<?= $url . $results[0]['imgUrl'] ?>",
            "width": 800,
            "height": 600
        }
    }
    </script>
    <meta property="og:title" content="<?= str_replace('"', '', $results[0]["title"]) . " | " . $mainTitle ?>" />
    <meta property="og:description" content="<?= str_replace('"', '', $results[0]['description']) ?>" />
    <meta property="og:image" content="<?= $url . $results[0]['imgUrl'] ?>" />
    <meta property="og:url" content="<?= $url . "/blog/" . $results[0]['url'] ?>" />
    <meta property="og:type" content="website" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="<?= str_replace('"', '', $results[0]["title"]) . " | " . $mainTitle ?>" />
    <meta name="twitter:description" content="<?= str_replace('"', '', $results[0]['description']) ?>" />
    <meta name="twitter:image" content="<?= $url . $results[0]['imgUrl'] ?>" />
    <meta name="twitter:url" content="<?= $url . "/blog/" . $results[0]['url'] ?>" />
    <?php echo $header ?>
    <title>
        <?= str_replace('"', '', $results[0]["title"]) . " | " . $mainTitle ?>
    </title>
</head>

<body>
    <main class="bg-slate-100 w-full">
        <!-- navbar -->
        <?php include("../components/navbar.php"); ?>
        <!-- Blog page body -->
        <section class="w-full h-full">
            <div class="bg-white  global-container w-full">
                <article class="flex flex-col gap-2 p-2 w-full">
                    <div class="flex items-center justify-center my-8">
                        <h1 class="text-xl sm:text-2xl lg:text-4xl xl:text-6xl font-bold text-gray-700 px-4">
                            <?= str_replace('"', '', $results[0]["title"]) ?>
                        </h1>
                    </div>
                    <div class="border-y-2 border-black py-4 px-2 flex items-center justify-between">
                        <a class="" href="<?= $url . '/author/' . strtolower($results[0]['author']) ?>">
                            <span class="text-lg font-medium text-blue-600 underline cursor-pointer">
                                <?= $results[0]["author_name"] ?>
                            </span>
                        </a>
                        <div class="flex items-center gap-2">
                            <a href="<?= $url . '/category/' . strtolower($results[0]['category']) ?>"
                                class="text-lg font-medium text-black underline ">
                                <?= $results[0]['category'] ?>
                            </a>
                            <span class="h-2 w-2 bg-gray-300 rounded-full"></span>
                            <time datetime="<?= $results[0]["date"] ?>" class="text-black font-medium text-lg">
                                <?= $results[0]["date"] ?>
                            </time>
                        </div>
                    </div>
                    <div class="mt-4 max-w-[750px] mx-auto blog-styles">
                        <?php
                        foreach ($results as $row) {
                            $blog = json_decode($row["blog"], true);
                            foreach ($blog as $b) {

                                switch ($b["type"]) {
                                    case "paragraph":
                                        echo "<p>
                                                " . $b["data"]["text"] . "
                                            </p>";
                                        break;
                                    case "image":
                                        echo "<img src=" . $url . $b["data"]["file"]["url"] . " alt=" . $b["id"] . ">";
                                        break;
                                    case "header":
                                        switch ($b["data"]["level"]) {
                                            case 1:
                                                echo "<h1>" . $b["data"]["text"] . "</h1>";
                                                break;
                                            case 2:
                                                echo "<h2>" . $b["data"]["text"] . "</h2>";
                                                break;
                                            case 3:
                                                echo "<h3>" . $b["data"]["text"] . "</h3>";
                                                break;
                                            case 4:
                                                echo "<h4>" . $b["data"]["text"] . "</h4>";
                                                break;
                                            case 5:
                                                echo "<h6>" . $b["data"]["text"] . "</h6>";
                                                break;
                                            default:
                                                echo "<h6>" . $b["data"]["text"] . "</h6>";
                                        }
                                        ;
                                        break;
                                    case "list":
                                        if ($b["data"]["style"] == "unordered") {
                                            echo "<ul>";
                                            foreach ($b["data"]["items"] as $list) {
                                                echo "<li>" . $list . "</li>";
                                            }
                                            ;
                                            echo "</ul>";
                                        } else {
                                            echo "<ol>";
                                            foreach ($b["data"]["items"] as $list) {
                                                echo "<li>" . $list . "</li>";
                                            }
                                            ;
                                            echo "</ol>";
                                        }
                                        ;
                                        break;
                                    case "quote":
                                        echo "<blockquote>
                                                " . $b["data"]["text"] . "
                                            </blockquote>";
                                        break;
                                    case "table":
                                        $l = true;
                                        echo "<table>";
                                        foreach ($b["data"]["content"] as $table) {
                                            echo "<tr>";
                                            if ($l) {
                                                foreach ($table as $t) {
                                                    echo "<th>" . $t . "</th>";
                                                }
                                                $l = false;
                                            } else {
                                                foreach ($table as $t) {
                                                    echo "<td>" . $t . "</td>";
                                                }
                                            }
                                            echo "</tr>";
                                        }
                                        echo "</table>";
                                }
                                ;
                            }
                        }
                        ;
                        echo " <script>console.log(" . json_encode($blog) . ")</script>"
                            ?>
                    </div>
                </article>
            </div>
        </section>
        <!-- footer -->
        <?php include("../components/footer.php"); ?>
    </main>
    <script src="<?php echo $url ?>/main.js"></script>
</body>

</html>