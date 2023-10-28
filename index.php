<?php
include("./config.php");
include("./admin/scripts/db.php");
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
    <link rel="canonical" href="<?= $url ?>" />
    <script type="application/ld+json">
    {
        "@context": "http://schema.org",
        "@type": "WebSite",
        "name": "<?= $mainTitle ?>",
        "url": "<?= $url ?>",
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
    <meta property="og:title" content="<?= $mainTitle ?>" />
    <meta property="og:description"
        content="Welcome to <?= $mainTitle ?>, your trusted companion on the road to success in RTO exams across India. We offer a comprehensive platform designed to help you prepare effectively for your upcoming driving license and learner's permit tests. Whether you're aiming to pass the learner's test or upgrade your license, our extensive collection of RTO mock tests and practice questions provides the perfect training ground. Gain the knowledge, confidence, and skills you need to excel in your RTO exams, with instant feedback, in-depth explanations, and real exam simulations. Start your journey towards safe and informed driving today with <?= $mainTitle ?>." />
    <meta property="og:image" content="<?= $url ?>/asset/preview.png" />
    <meta property="og:url" content="<?= $url ?>" />
    <meta property="og:type" content="website" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="<?= $mainTitle ?>" />
    <meta name="twitter:description"
        content="Welcome to <?= $mainTitle ?>, your trusted companion on the road to success in RTO exams across India. We offer a comprehensive platform designed to help you prepare effectively for your upcoming driving license and learner's permit tests. Whether you're aiming to pass the learner's test or upgrade your license, our extensive collection of RTO mock tests and practice questions provides the perfect training ground. Gain the knowledge, confidence, and skills you need to excel in your RTO exams, with instant feedback, in-depth explanations, and real exam simulations. Start your journey towards safe and informed driving today with <?= $mainTitle ?>." />
    <meta name="twitter:image" content="<?= $url ?>/asset/preview.png" />
    <meta name="twitter:url" content="<?= $url ?>" />
    <?php echo $header ?>
    <title>
        <?= $mainTitle ?>
    </title>
</head>

<body>
    <main class="bg-slate-100 w-full">
        <!-- navbar -->
        <?php include("./components/navbar.php"); ?>
        <!-- home page body -->
        <section class="w-full min-h-[500px] h-full">
            <div class="flex items-center justify-center min-h-[500px] w-full global-container">
                <div class="flex flex-col lg:grid grid-cols-5">
                    <div class="col-span-3 flex items-center justify-center flex-col gap-4 p-4">
                        <h1
                            class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-black text-center otherFontStyle">
                            The driving test practice that will help you ace your <span class="text-blue-600">RTO</span>
                            exam
                        </h1>
                        <h2 class="text-lg sm:text-xl md:text-2xl lg:text-3xl font-medium text-black text-center">
                            Available
                            for major
                            states of India in English, Hindi and
                            native languages.</h2>
                        <div>
                            <a href="<?php echo $url ?>/exam"
                                class="px-8 py-4 bg-blue-500 flex items-center justify-center gap-2 rounded-md hover:bg-blue-600 font-semibold text-white">
                                <figure>
                                    <img src="<?php echo $url ?>/asset/icons/exam black.svg" alt="">
                                </figure>
                                Start Exam
                            </a>
                        </div>
                    </div>
                    <div class="col-span-2">
                        <img src="<?= $url ?>/asset/img/lic2.webp" alt="" class="object-contain w-full h-full">
                    </div>
                </div>
            </div>
        </section>
        <!-- home page middle links -->
        <section class="bg-white w-full py-12">
            <div class="flex flex-col items-center justify-center gap-6 global-container">
                <div class="mt-8">
                    <h2 class="text-xl md:text-2xl lg:text-4xl text-center text-black font-medium">Awesome Features</h2>
                </div>
                <div class="mt-8 p-2 w-full">
                    <div class="grid grid-cols-1 md:grid-cols-3 items-center justify-center gap-2">
                        <a href="<?php echo $url ?>/questionbank"
                            class="col-span-1 flex flex-col items-center justify-center gap-4 p-4 hover:shadow-xl transition-shadow duration-300 cursor-pointer">
                            <figure>
                                <img src="<?php echo $url ?>/asset/img/book.png" alt="Book" class="w-20">
                            </figure>
                            <h2 class="text-black font-medium text-lg text-center">Question Bank</h2>
                            <p class="text-gray-700 font-light text-center">List of questions & answers and meaning of
                                road signs
                            </p>
                            <span class="flex items-center justify-center gap-2 text-black font-bold">Read More <figure>
                                    <img src="<?php echo $url ?>/asset/icons/arrow-left.svg" alt="">
                                </figure></span>
                        </a>
                        <a href="<?php echo $url ?>/exam"
                            class="col-span-1 flex flex-col items-center justify-center gap-4 p-4 hover:shadow-xl transition-shadow duration-300 cursor-pointer">
                            <figure>
                                <img src="<?php echo $url ?>/asset/img/exam.png" alt="Exam" class="w-20">
                            </figure>
                            <h2 class="text-black font-medium text-lg text-center">Exams</h2>
                            <p class="text-gray-700 font-light text-center">Test you're Skills Against our Mock RTO Exam
                                to better uderstand you're level
                            </p>
                            <span class="col-span-1 flex items-center justify-center gap-2 text-black font-bold">Read
                                More <figure>
                                    <img src="<?php echo $url ?>/asset/icons/arrow-left.svg" alt="">
                                </figure></span>
                        </a>
                        <a href="<?= $url ?>/blog"
                            class="flex flex-col items-center justify-center gap-4 p-4 hover:shadow-xl transition-shadow duration-300 cursor-pointer">
                            <figure>
                                <img src="<?php echo $url ?>/asset/img/more.png" alt="more" class="w-20">
                            </figure>
                            <h2 class="text-black font-medium text-lg text-center">Blogs</h2>
                            <p class="text-gray-700 font-light text-center">Latest Blogs and News Releted to RTO and
                                Driving Licence.
                            </p>
                            <span class="flex items-center justify-center gap-2 text-black font-bold">Read More <figure>
                                    <img src="<?php echo $url ?>/asset/icons/arrow-left.svg" alt="">
                                </figure></span>
                        </a>
                    </div>
                </div>

            </div>
        </section>
        <!-- Blog Section -->
        <?php include("./components/blog.php"); ?>
        <!-- footer -->
        <?php include("./components/footer.php"); ?>
    </main>
    <script src="<?php echo $url ?>/main.js"></script>
</body>

</html>