<?php
try {
    $sql = "SELECT blogs.*, author.name AS author_name FROM blogs LEFT JOIN author ON blogs.author = author.username ORDER BY blogs.id DESC LIMIT 8";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>
<section class="w-full h-full">
    <div class="global-container px-4 py-2 my-2 w-full">
        <div class="w-full my-2 border-b-2 border-black">
            <h1 class="text-xl font-semibold text-gray-800">Recently Added</h1>
        </div>
        <div class="flex flex-wrap justify-center gap-2 w-full">
            <?php foreach ($results as $row):
                $cleanedTitle = str_replace('"', '', $row['title']);
                ?>
            <article
                class="flex flex-col items-start justify-start w-full sm:w-[300px] h-[450px] bg-white cursor-pointer textHover shadow-lg">
                <figure class="w-full sm:w-[300px] h-[250px]"
                    onclick="openUrlInNewTab(`<?php echo $url ?>/blog/<?= $row['url'] ?>`)">
                    <img src="<?php echo $url . $row['imgUrl'] ?>" alt="" class="object-cover w-full h-[250px]">
                </figure>
                <div class="px-4 py-6 flex flex-col items-start justify-start gap-4 h-full">
                    <h2 class="text-gray-600 font-semibold leading-6 text-lg hover:underline"
                        onclick="openUrlInNewTab(`<?php echo $url ?>/blog/<?= $row['url'] ?>`)">
                        <?= truncateText($cleanedTitle, 60) ?>
                    </h2>
                    <div class="flex items-center justify-start gap-1">
                        <a class="text-sm font-medium text-gray-400 hover:underline"
                            href="<?= $url . '/author/' . strtolower($row['author']) ?>">
                            <?= $row['author_name'] ?>
                        </a>
                        <span class="h-2 w-2 bg-gray-300 rounded-full"></span>
                        <a href="<?= $url . '/category/' . strtolower($row['category']) ?>"
                            class="text-sm font-medium text-gray-400 hover:underline">
                            <?= $row['category'] ?>
                        </a>
                    </div>
                    <div class="h-full flex items-end">
                        <time datetime="<?= $row['date'] ?>" class="text-gray-500 text-base font-bold">
                            <?= $row['date'] ?>
                        </time>
                    </div>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<script>
function openUrlInNewTab(url) {
    if (url) {
        window.open(url, '_blank');
    }
}
</script>