<?php
include("../config.php");
include("../admin/scripts/db.php");

$uri = $_SERVER['REQUEST_URI'];

// Parse the URL to extract path and query
$parsedUrl = parse_url($uri);

// Get the path from the parsed URL
$path = $parsedUrl['path'];

// Remove the leading and trailing slashes from the path
$pathWithoutSlashes = trim($path, '/');

// Extract the slug from the path
$author = explode('/', $pathWithoutSlashes)[1];

try {

    // Prepare the SQL statement
    $stmt = $conn->prepare("SELECT * FROM author WHERE username = :username");
    $stmt->bindParam(':username', $author);

    // Execute the query
    $stmt->execute();

    // Fetch the data
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result == null) {
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
    <meta name="description"
        content="Welcome to <?= $mainTitle ?>, your trusted companion on the road to success in RTO exams across India. We offer a comprehensive platform designed to help you prepare effectively for your upcoming driving license and learner's permit tests. Whether you're aiming to pass the learner's test or upgrade your license, our extensive collection of RTO mock tests and practice questions provides the perfect training ground. Gain the knowledge, confidence, and skills you need to excel in your RTO exams, with instant feedback, in-depth explanations, and real exam simulations. Start your journey towards safe and informed driving today with <?= $mainTitle ?>." />
    <meta name="keywords"
        content="RTO mock test, RTO exam preparation, Driving license test, Learner's permit practice, Indian RTO exams, Driving license practice test, Road safety quiz, Vehicle rules test, RTO practice questions, Regional Transport Office, Driving test simulator, RTO exam pattern, Traffic rules quiz, Motor vehicle knowledge, Indian driving license, Practice RTO questions, Traffic signs and signals, Road safety tips, License renewal test, Indian road regulations" />
    <meta name="robots" content="index, follow" />
    <link rel="canonical" href="<?= $url . "/author/" . $result['username'] ?>" />
    <script type="application/ld+json">
    < script type = "application/ld+json" > {
        "@context": "http://schema.org",
        "@type": "Person",
        "name": "<?= $result["name"] ?>",
        "url": "<?= $url . "/author/" . $result['username'] ?>",
        "image": "<?= $url . $result["img"] ?>",
        "jobTitle": "Author",
        "description": "<?= $result["bio"] ?>",
        "worksFor": {
            "@type": "Organization",
            "name": "<?= $mainTitle ?>",
            "logo": {
                "@type": "ImageObject",
                "url": "<?= $url ?>/asset/logo.svg",
                "width": 40,
                "height": 41
            }
        }
    }
    </script>

    </script>
    <meta property="og:title" content="Author Page | <?= $result["name"] ?>" />
    <meta property="og:description"
        content="Welcome to <?= $mainTitle ?>, your trusted companion on the road to success in RTO exams across India. We offer a comprehensive platform designed to help you prepare effectively for your upcoming driving license and learner's permit tests. Whether you're aiming to pass the learner's test or upgrade your license, our extensive collection of RTO mock tests and practice questions provides the perfect training ground. Gain the knowledge, confidence, and skills you need to excel in your RTO exams, with instant feedback, in-depth explanations, and real exam simulations. Start your journey towards safe and informed driving today with <?= $mainTitle ?>." />
    <meta property="og:image" content="<?= $url ?>/asset/preview.png" />
    <meta property="og:url" content="<?= $url . "/author/" . $result['username'] ?>" />
    <meta property="og:type" content="website" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="Author Page | <?= $result["name"] ?>" />
    <meta name="twitter:description"
        content="Welcome to <?= $mainTitle ?>, your trusted companion on the road to success in RTO exams across India. We offer a comprehensive platform designed to help you prepare effectively for your upcoming driving license and learner's permit tests. Whether you're aiming to pass the learner's test or upgrade your license, our extensive collection of RTO mock tests and practice questions provides the perfect training ground. Gain the knowledge, confidence, and skills you need to excel in your RTO exams, with instant feedback, in-depth explanations, and real exam simulations. Start your journey towards safe and informed driving today with <?= $mainTitle ?>." />
    <meta name="twitter:image" content="<?= $url ?>/asset/preview.png" />
    <meta name="twitter:url" content="<?= $url . "/author/" . $result['username'] ?>" />
    <?php echo $header ?>
    <title>Author Page |
        <?= $result["name"] ?>
    </title>
</head>

<body>
    <main class="bg-slate-100 w-full">
        <!-- navbar -->
        <?php include("../components/navbar.php"); ?>
        <!-- home page body -->
        <section class="w-full h-full">
            <div class="global-container w-full bg-white my-6">
                <div class="flex flex-col items-center justify-center gap-6 w-full h-full min-h-[600px]">
                    <figure class="relative h-32 w-32 rounded-full">
                        <img src="<?= $url . $result["img"] ?>" alt="" class="rounded-full h-full w-full object-cover">
                    </figure>
                    <span class="text-lg font-medium text-black">
                        <?= $result["name"] ?>
                    </span>
                    <div class="flex items-center justify-center gap-1">
                        <span class="text-gray-500 text-sm">
                            <?= $result["gender"] ?>
                        </span>
                        <span class="w-2 h-2 bg-gray-300 rounded-full"></span>
                        <time class="text-gray-500 text-sm">
                            <?= $result["dob"] ?>
                        </time>
                    </div>
                    <p class="max-w-[600px] text-center text-gray-600">
                        <?= $result["bio"] ?>
                    </p>
                    <div class="flex items-center justify-center gap-2">
                        <a href="<?= $result["facebook"] ?>">
                            <svg width="50px" height="50px" viewBox="0 0 48 48" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <circle cx="24" cy="24" r="20" fill="#3B5998" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M29.315 16.9578C28.6917 16.8331 27.8498 16.74 27.3204 16.74C25.8867 16.74 25.7936 17.3633 25.7936 18.3607V20.1361H29.3774L29.065 23.8137H25.7936V35H21.3063V23.8137H19V20.1361H21.3063V17.8613C21.3063 14.7453 22.7708 13 26.4477 13C27.7252 13 28.6602 13.187 29.8753 13.4363L29.315 16.9578Z"
                                    fill="white" />
                            </svg>
                        </a>
                        <a href="<?= $result["linked"] ?>">
                            <svg width="50px" height="50px" viewBox="0 0 48 48" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <circle cx="24" cy="24" r="20" fill="#0077B5" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M18.7747 14.2839C18.7747 15.529 17.8267 16.5366 16.3442 16.5366C14.9194 16.5366 13.9713 15.529 14.0007 14.2839C13.9713 12.9783 14.9193 12 16.3726 12C17.8267 12 18.7463 12.9783 18.7747 14.2839ZM14.1199 32.8191V18.3162H18.6271V32.8181H14.1199V32.8191Z"
                                    fill="white" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M22.2393 22.9446C22.2393 21.1357 22.1797 19.5935 22.1201 18.3182H26.0351L26.2432 20.305H26.3322C26.9254 19.3854 28.4079 17.9927 30.8101 17.9927C33.7752 17.9927 35.9995 19.9502 35.9995 24.219V32.821H31.4922V24.7838C31.4922 22.9144 30.8404 21.6399 29.2093 21.6399C27.9633 21.6399 27.2224 22.4999 26.9263 23.3297C26.8071 23.6268 26.7484 24.0412 26.7484 24.4574V32.821H22.2411V22.9446H22.2393Z"
                                    fill="white" />
                            </svg>
                        </a>
                        <a href="<?= $result["instagram"] ?>">
                            <svg width="50px" height="50px" viewBox="0 0 48 48" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <circle cx="24" cy="24" r="20" fill="#C13584" />
                                <path
                                    d="M24 14.1622C27.2041 14.1622 27.5837 14.1744 28.849 14.2321C30.019 14.2855 30.6544 14.481 31.0773 14.6453C31.6374 14.863 32.0371 15.123 32.457 15.5429C32.877 15.9629 33.137 16.3626 33.3547 16.9227C33.519 17.3456 33.7145 17.981 33.7679 19.1509C33.8256 20.4163 33.8378 20.7958 33.8378 23.9999C33.8378 27.2041 33.8256 27.5836 33.7679 28.849C33.7145 30.019 33.519 30.6543 33.3547 31.0772C33.137 31.6373 32.877 32.0371 32.4571 32.457C32.0371 32.8769 31.6374 33.1369 31.0773 33.3546C30.6544 33.519 30.019 33.7144 28.849 33.7678C27.5839 33.8255 27.2044 33.8378 24 33.8378C20.7956 33.8378 20.4162 33.8255 19.151 33.7678C17.981 33.7144 17.3456 33.519 16.9227 33.3546C16.3626 33.1369 15.9629 32.8769 15.543 32.457C15.1231 32.0371 14.863 31.6373 14.6453 31.0772C14.481 30.6543 14.2855 30.019 14.2321 28.849C14.1744 27.5836 14.1622 27.2041 14.1622 23.9999C14.1622 20.7958 14.1744 20.4163 14.2321 19.1509C14.2855 17.981 14.481 17.3456 14.6453 16.9227C14.863 16.3626 15.123 15.9629 15.543 15.543C15.9629 15.123 16.3626 14.863 16.9227 14.6453C17.3456 14.481 17.981 14.2855 19.151 14.2321C20.4163 14.1744 20.7959 14.1622 24 14.1622ZM24 12C20.741 12 20.3323 12.0138 19.0524 12.0722C17.7752 12.1305 16.9028 12.3333 16.1395 12.63C15.3504 12.9366 14.6812 13.3469 14.0141 14.0141C13.3469 14.6812 12.9366 15.3504 12.63 16.1395C12.3333 16.9028 12.1305 17.7751 12.0722 19.0524C12.0138 20.3323 12 20.741 12 23.9999C12 27.259 12.0138 27.6676 12.0722 28.9475C12.1305 30.2248 12.3333 31.0971 12.63 31.8604C12.9366 32.6495 13.3469 33.3187 14.0141 33.9859C14.6812 34.653 15.3504 35.0633 16.1395 35.3699C16.9028 35.6666 17.7752 35.8694 19.0524 35.9277C20.3323 35.9861 20.741 35.9999 24 35.9999C27.259 35.9999 27.6677 35.9861 28.9476 35.9277C30.2248 35.8694 31.0972 35.6666 31.8605 35.3699C32.6496 35.0633 33.3188 34.653 33.9859 33.9859C34.653 33.3187 35.0634 32.6495 35.37 31.8604C35.6667 31.0971 35.8695 30.2248 35.9278 28.9475C35.9862 27.6676 36 27.259 36 23.9999C36 20.741 35.9862 20.3323 35.9278 19.0524C35.8695 17.7751 35.6667 16.9028 35.37 16.1395C35.0634 15.3504 34.653 14.6812 33.9859 14.0141C33.3188 13.3469 32.6496 12.9366 31.8605 12.63C31.0972 12.3333 30.2248 12.1305 28.9476 12.0722C27.6677 12.0138 27.259 12 24 12Z"
                                    fill="white" />
                                <path
                                    d="M24.0059 17.8433C20.6026 17.8433 17.8438 20.6021 17.8438 24.0054C17.8438 27.4087 20.6026 30.1675 24.0059 30.1675C27.4092 30.1675 30.1681 27.4087 30.1681 24.0054C30.1681 20.6021 27.4092 17.8433 24.0059 17.8433ZM24.0059 28.0054C21.7968 28.0054 20.0059 26.2145 20.0059 24.0054C20.0059 21.7963 21.7968 20.0054 24.0059 20.0054C26.2151 20.0054 28.0059 21.7963 28.0059 24.0054C28.0059 26.2145 26.2151 28.0054 24.0059 28.0054Z"
                                    fill="white" />
                                <path
                                    d="M31.8507 17.5963C31.8507 18.3915 31.206 19.0363 30.4107 19.0363C29.6154 19.0363 28.9707 18.3915 28.9707 17.5963C28.9707 16.801 29.6154 16.1562 30.4107 16.1562C31.206 16.1562 31.8507 16.801 31.8507 17.5963Z"
                                    fill="white" />
                            </svg>
                        </a>
                        <a href="<?= $result["twitter"] ?>">
                            <svg width="50px" height="50px" viewBox="0 0 48 48" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <circle cx="24" cy="24" r="20" fill="#1DA1F2" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M36 16.3086C35.1177 16.7006 34.1681 16.9646 33.1722 17.0838C34.1889 16.4742 34.9697 15.5095 35.3368 14.36C34.3865 14.9247 33.3314 15.3335 32.2107 15.5551C31.3123 14.5984 30.0316 14 28.6165 14C25.8975 14 23.6928 16.2047 23.6928 18.9237C23.6928 19.3092 23.7368 19.6852 23.8208 20.046C19.7283 19.8412 16.1005 17.8805 13.6719 14.9015C13.2479 15.6287 13.0055 16.4742 13.0055 17.3766C13.0055 19.0845 13.8735 20.5916 15.1958 21.4747C14.3878 21.4491 13.6295 21.2275 12.9647 20.8587V20.9203C12.9647 23.3066 14.663 25.296 16.9141 25.7496C16.5013 25.8616 16.0661 25.9224 15.6174 25.9224C15.2998 25.9224 14.991 25.8912 14.6902 25.8336C15.3166 27.7895 17.1357 29.2134 19.2899 29.2534C17.6052 30.5733 15.4822 31.3612 13.1751 31.3612C12.7767 31.3612 12.3848 31.338 12 31.2916C14.1791 32.6884 16.7669 33.5043 19.5475 33.5043C28.6037 33.5043 33.5562 26.0016 33.5562 19.4956C33.5562 19.282 33.5522 19.0693 33.5418 18.8589C34.5049 18.1629 35.34 17.2958 36 16.3086Z"
                                    fill="white" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <!-- Blog Section -->
        <?php include("../components/blog.php"); ?>
        <!-- footer -->
        <?php include("../components/footer.php"); ?>
    </main>
    <script src="<?php echo $url ?>/main.js"></script>
</body>

</html>