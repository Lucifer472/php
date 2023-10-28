<?php
include("../config.php");
include("../admin/scripts/db.php");
// Question Bank
$questionQuery = "SELECT question, answer FROM questionbank";
$questionStmt = $conn->prepare($questionQuery);
$questionStmt->execute();
$questionResult = $questionStmt->fetchAll(PDO::FETCH_ASSOC);

// Signs
$signQuery = "SELECT sign, signTitle FROM sign";
$signStmt = $conn->prepare($signQuery);
$signStmt->execute();
$signResult = $signStmt->fetchAll(PDO::FETCH_ASSOC);
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
    <link rel="canonical" href="<?= $url ?>/questionbank" />
    <script type="application/ld+json">
    {
        "@context": "http://schema.org",
        "@type": "WebSite",
        "name": "Question Bank | <?= $mainTitle ?>",
        "url": "<?= $url ?>/questionbank",
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
    <meta property="og:title" content="Question Bank | <?= $mainTitle ?>" />
    <meta property="og:description"
        content="Welcome to <?= $mainTitle ?>, your trusted companion on the road to success in RTO exams across India. We offer a comprehensive platform designed to help you prepare effectively for your upcoming driving license and learner's permit tests. Whether you're aiming to pass the learner's test or upgrade your license, our extensive collection of RTO mock tests and practice questions provides the perfect training ground. Gain the knowledge, confidence, and skills you need to excel in your RTO exams, with instant feedback, in-depth explanations, and real exam simulations. Start your journey towards safe and informed driving today with <?= $mainTitle ?>." />
    <meta property="og:image" content="<?= $url ?>/asset/preview.png" />
    <meta property="og:url" content="<?= $url ?>/questionbank" />
    <meta property="og:type" content="website" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="Question Bank | <?= $mainTitle ?>" />
    <meta name="twitter:description"
        content="Welcome to <?= $mainTitle ?>, your trusted companion on the road to success in RTO exams across India. We offer a comprehensive platform designed to help you prepare effectively for your upcoming driving license and learner's permit tests. Whether you're aiming to pass the learner's test or upgrade your license, our extensive collection of RTO mock tests and practice questions provides the perfect training ground. Gain the knowledge, confidence, and skills you need to excel in your RTO exams, with instant feedback, in-depth explanations, and real exam simulations. Start your journey towards safe and informed driving today with <?= $mainTitle ?>." />
    <meta name="twitter:image" content="<?= $url ?>/asset/preview.png" />
    <meta name="twitter:url" content="<?= $url ?>/questionbank" />
    <?php echo $header ?>
    <title>
        Question Bank |
        <?= $mainTitle ?>
    </title>
</head>

<body>
    <main class="bg-slate-100 w-full">
        <!-- navbar -->
        <?php include("../components/navbar.php"); ?>
        <!-- question section  -->
        <section class="w-full bg-gray-200/80 border-b-[1px] border-gray-200 py-6">
            <div class="global-container flex items-start justify-evenly flex-col">
                <h1 class="my-4 text-4xl font-medium text-black">RTO EXAM</h1>
                <h2 class="text-xl font-normal text-black">List of questions & answers and meaning of road signs</h2>
            </div>
        </section>
        <section class="w-full bg-white py-6">
            <div class="global-container py-2">
                <div class="flex flex-col items-center justify-center w-full">
                    <div class="w-full flex flex-col items-center justify-center p-1 sm:p-2 md:p-4">
                        <div class="grid grid-cols-2 w-full relative">
                            <button
                                class="col-span-1 text-base sm:text-lg md:text-xl font-medium py-4 border-x border-gray-200"
                                id="queBtn">
                                Questions</button>
                            <button
                                class="col-span-1 text-base sm:text-lg md:text-xl font-medium py-4 border-b border-gray-200"
                                id="sinBtn">
                                Traffic
                                Sings</button>
                            <div class="absolute w-[50%] h-[4px] bg-blue-400 top-0 left-0 transition-all duration-500"
                                id="indicator"></div>
                        </div>
                        <div class="w-full" style="display: block;" id="questions">
                            <div class="p-4 border-x border-b border-gray-200 w-full ani-fadeIn">
                                <?php
                                if (!empty($questionResult)) {
                                    $num = 1;
                                    foreach ($questionResult as $row) {
                                        $question = $row['question'];
                                        $answer = $row['answer'];

                                        echo '<div class="flex flex-col items-start justify-start gap-4 py-2 border-b border-gray-200">';
                                        echo '<h1 class="text-left font-medium text-black text-sm md:text-base"><span>' . $num . '. </span>' . $question . '</h1>';
                                        echo '<p class="text-left font-medium text-gray-600 text-sm md:text-base"><span>A. </span>' . $answer . '</p>';
                                        echo '</div';
                                        $num++;
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="w-full" style="display: none;" id="sign">
                        <div class="p-2 md:p-4 border-x border-b border-gray-200 w-full ani-fadeIn">
                            <div class="grid grid-cols-1 sm:grid-cols-2 items-center justify-center p-2 md:p-4">
                                <?php
                                    if (!empty($signResult)) {
                                        $num = 1;
                                        foreach ($signResult as $row) {
                                            $sign = $row['sign'];
                                            $title = $row['signTitle'];

                                            echo '<div class="flex items-center justify-start gap-2 px-2 py-4 border border-gray-200 ' . ($num % 2 == 0 ? "bg-slate-100" : "") . '">';
                                            echo '<span class="text-lg font-medium">' . $num . '. </span>';
                                            echo '<img src="' . $url . '/asset/traficSign/' . $sign . '" alt="' . $title . '" class="w-12 sm:w-16 md:w-20">';
                                            echo '<p class="text-base sm:text-lg md:text-xl font-semibold">' . $title . '</p>';
                                            echo '</div>';
                                            $num++;
                                        }
                                    }
                                    ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
        <!-- footer -->
        <?php include("../components/footer.php"); ?>
    </main>
    <script src="<?php echo $url ?>/main.js"></script>
</body>

</html>