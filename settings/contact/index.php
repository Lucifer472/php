<?php include("../../config.php");
include("../../admin/scripts/db.php");

try {
    // SQL query to fetch data from the "form" table
    $sql = "SELECT * FROM forms";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // Fetch and display the data
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Extract unique categories
    $uniqueCategories = [];

    foreach ($data as $item) {
        $category = $item["category"];

        // Check if the category is not already in the uniqueCategories array
        if (!in_array($category, $uniqueCategories)) {
            $uniqueCategories[] = $category;
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

try {
    // SQL query to fetch data from the "form" table
    $sql = "SELECT * FROM rto ORDER BY id ASC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // Fetch and display the data
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
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
    <link rel="canonical" href="<?= $url ?>/settings/contact" />
    <script type="application/ld+json">
    {
        "@context": "http://schema.org",
        "@type": "WebSite",
        "name": "Setting & Help | <?= $mainTitle ?>",
        "url": "<?= $url ?>/settings/contact",
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
    <meta property="og:title" content="Setting & Help | <?= $mainTitle ?>" />
    <meta property="og:description"
        content="Welcome to <?= $mainTitle ?>, your trusted companion on the road to success in RTO exams across India. We offer a comprehensive platform designed to help you prepare effectively for your upcoming driving license and learner's permit tests. Whether you're aiming to pass the learner's test or upgrade your license, our extensive collection of RTO mock tests and practice questions provides the perfect training ground. Gain the knowledge, confidence, and skills you need to excel in your RTO exams, with instant feedback, in-depth explanations, and real exam simulations. Start your journey towards safe and informed driving today with <?= $mainTitle ?>." />
    <meta property="og:image" content="<?= $url ?>/asset/preview.png" />
    <meta property="og:url" content=" <?= $url ?>/settings/contact" />
    <meta property="og:type" content="website" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="Setting & Help | <?= $mainTitle ?>" />
    <meta name="twitter:description"
        content="Welcome to <?= $mainTitle ?>, your trusted companion on the road to success in RTO exams across India. We offer a comprehensive platform designed to help you prepare effectively for your upcoming driving license and learner's permit tests. Whether you're aiming to pass the learner's test or upgrade your license, our extensive collection of RTO mock tests and practice questions provides the perfect training ground. Gain the knowledge, confidence, and skills you need to excel in your RTO exams, with instant feedback, in-depth explanations, and real exam simulations. Start your journey towards safe and informed driving today with <?= $mainTitle ?>." />
    <meta name="twitter:image" content="<?= $url ?>/asset/preview.png" />
    <meta name="twitter:url" content="<?= $url ?>/settings/contact" />
    <?php echo $header ?>
    <title>Setting & Help |
        <?= $mainTitle ?>
    </title>
</head>

<body>
    <main class="bg-slate-100 w-full">
        <!-- navbar -->
        <?php include("../../components/navbar.php"); ?>
        <!-- top section  -->
        <section class="w-full bg-gray-200/80 border-b-[1px] border-gray-200 py-6">
            <div class="global-container flex items-start justify-evenly flex-col">
                <h1 class="my-4 text-4xl font-medium text-black">Settings & Help</h1>
                <h2 class="text-xl font-normal text-black">Forms, RTO office information and more</h2>
            </div>
        </section>
        <section class="w-full bg-white py-8">
            <div class="w-full px-4 py-2 flex items-center justify-center global-container">
                <div class="lg:grid lg:grid-cols-6 lg:gap-4 w-full">
                    <div class="hidden lg:block lg:col-span-2 w-full max-h-fit">
                        <div class="shadow-xl border border-gray-200 rounded-md w-full">
                            <ul class="flex items-start justify-center flex-col cursor-pointer w-full">
                                <li
                                    class="flex items-center gap-2 px-6 py-4 hover:bg-gray-100 w-full border-l-2 border-white hover:border-black transition-all duration-300 formBtns ">
                                    <img src="<?php echo $url ?>/asset/icons/note.svg" alt="" class="w-8 h-8">
                                    Forms
                                </li>
                                <li
                                    class="flex items-center gap-2 px-6 py-4 hover:bg-gray-100 w-full border-l-2 border-white hover:border-black transition-all duration-300 formBtns">
                                    <img src="<?php echo $url ?>/asset/icons/process.svg" alt="" class="w-8 h-8">
                                    Process of Driving License
                                </li>
                                <li
                                    class="flex items-center gap-2 px-6 py-4 hover:bg-gray-100 w-full border-l-2 border-white hover:border-black transition-all duration-300 formBtns">
                                    <img src="<?php echo $url ?>/asset/icons/office.svg" alt="" class="w-8 h-8">
                                    RTO Offices
                                </li>
                                <li
                                    class="flex items-center gap-2 px-6 py-4 hover:bg-gray-100 w-full border-l-2 border-white hover:border-black transition-all duration-300 formBtns settingBtnSelected">
                                    <img src="<?php echo $url ?>/asset/social/contact.svg" alt="" class="w-8 h-8">
                                    Contact Us
                                </li>
                                <li
                                    class="flex items-center gap-2 px-6 py-4 hover:bg-gray-100 w-full border-l-2 border-white hover:border-black transition-all duration-300 formBtns">
                                    <img src="<?php echo $url ?>/asset/icons/report.svg" alt="" class="w-8 h-8">
                                    Disclaimer
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="lg:col-span-4 w-full">
                        <div
                            class="shadow-xl border border-gray-200 rounded-md py-2 px-6 w-full flex items-start justify-start flex-col">
                            <!-- forms  -->
                            <div class="hidden flex-col w-full items-start justify-start mainFormClass">
                                <div
                                    class="flex items-center justify-start gap-2 py-2 border-b-2 border-gray-300 w-full cursor-pointer formsClass">
                                    <img src="<?php echo $url ?>/asset/icons/note.svg" alt="" class="w-8 h-8">
                                    <h1 class="text-2xl font-medium">Forms</h1>
                                </div>
                                <ul class="flex items-start justify-center flex-col cursor-pointer w-full">
                                    <?php
                                    foreach ($uniqueCategories as $c) {
                                        echo '<li
                                        class="flex flex-col items-center justify-start gap-2 border-b border-gray-200 py-4 w-full">
                                            <div class="forms flex items-center justify-start w-full gap-2">
                                                <img src="' . $url . '/asset/icons/arrow-right.svg" alt=""
                                    class="w-6 h-6 rotate-0 transition-transform duration-300">
                                    ' . $c . '
                            </div>
                            <ul class="flex flex-col items-center justify-start gap-2 w-full px-8 closed">';
                                        foreach ($data as $d) {
                                            if ($d['category'] == $c) {
                                                echo '<li class="w-full py-2">
                                    <a href="' . $d['link'] . '" target="_blank" class="text-blue-500 text-sm">
                                        ' . $d['name'] . '
                                    </a>
                                </li>';
                                            }
                                        }
                                        echo '
                            </ul>
                            </li>';

                                    }
                                    ?>
                                </ul>
                            </div>
                            <!-- process  -->
                            <div class="flex-col w-full items-start justify-start mainFormClass hidden">
                                <div
                                    class="flex items-center justify-start gap-2 py-2 border-b-2 border-gray-300 w-full cursor-pointer formsClass">
                                    <img src="<?php echo $url ?>/asset/icons/note.svg" alt="" class="w-8 h-8">
                                    <h1 class="text-2xl font-medium">Process of Driving License</h1>
                                </div>
                                <ul class="flex items-start justify-center flex-col cursor-pointer w-full">
                                    <li
                                        class="flex flex-col items-center justify-start gap-2 border-b border-gray-200 py-4 w-full">
                                        <div class="forms flex items-center justify-start w-full gap-2">
                                            <img src="<?php echo $url ?>/asset/icons/arrow-right.svg" alt=""
                                                class="w-6 h-6 rotate-0 transition-transform duration-300">
                                            Learner's licence
                                        </div>
                                        <ul
                                            class="flex flex-col items-start justify-center gap-2 w-full px-8 closed list-disc">
                                            <h3 class="py-2 text-gray-500 font-semibold">Need for a Driving Licence</h3>
                                            <li class="w-full py-2">
                                                No person shall drive a motor vehicle in any public place unless he
                                                holds an effective driving licence issued to him by the Licensing
                                                Authority, authorising him to drive the vehicle.
                                            </li>
                                            <h3 class="py-2 text-gray-500 font-semibold">Licensing Authorities</h3>
                                            <li class="w-full py-2">
                                                The Joint Commissioner/ Deputy Commissioner and the Regional Transport
                                                Officers are the Licensing Authorities. The Administrative Officers and
                                                Motor Vehicle Inspectors are the Additional Licensing Authorities.
                                            </li>
                                            <h3 class="py-2 text-gray-500 font-semibold">Age limit to obtain Driving
                                                Licence</h3>
                                            <li class="w-full py-2">
                                                An applicant who has completed sixteen years of age is eligible to apply
                                                for a driving licence to drive a motor cycle with engine capacity below
                                                55 cc subject to the condition that the parent or guardian should
                                                furnish a declaration in the manner prescribed.
                                            </li>
                                            <li class="w-full py-2">
                                                The applicant who has completed the age of eighteen years of age is
                                                eligible to apply for a driving licence to drive a motor vehicle other
                                                than a transport vehicle.
                                            </li>
                                            <li class="w-full py-2">
                                                An applicant who has completed twenty years of age will be eligible for
                                                applying for a licence to drive a transport vehicle.
                                            </li>
                                        </ul>
                                    </li>
                                    <li
                                        class="flex flex-col items-center justify-start gap-2 border-b border-gray-200 py-4 w-full">
                                        <div class="forms flex items-center justify-start w-full gap-2">
                                            <img src="<?php echo $url ?>/asset/icons/arrow-right.svg" alt=""
                                                class="w-6 h-6 rotate-0 transition-transform duration-300">
                                            Renewal Licence
                                        </div>
                                        <ul
                                            class="flex flex-col items-start justify-center gap-2 w-full px-8 closed list-disc">
                                            <li class="w-full py-2">
                                                An application for renewal shall be entertained not more than one month
                                                before the date of expiry of the licence. If the application is late for
                                                more than five years after the date of expiry of the licence, the
                                                applicant should undergo all the formalities to obtain a fresh licence.
                                            </li>
                                            <li class="w-full py-2">
                                                If the application for renewal is made previous to, or not more than 30
                                                days after the date of expiry of the licence, the renewal will be made
                                                with effect from the date of its expiry. If the application is made more
                                                than 30 days after the date of expiry of the licence, the renewal will
                                                be made with effect from the date of receipt of proper application. In
                                                such cases a fee of Rs. 30/- will be realised.
                                            </li>
                                            <h3 class="py-2 text-gray-500 font-semibold">Requirements</h3>
                                            <li class="w-full py-2">
                                                Driving Licence
                                            </li>
                                            <li class="w-full py-2">
                                                Application Form no 9.
                                            </li>
                                            <li class="w-full py-2">
                                                Form 1 (Self declaration as to the physical fitness for Non-Transport
                                                Vehicles). <br>
                                                OR <br>
                                                Form 1A (Medical Certificate for Transport Vehicles only).
                                            </li>
                                            <li class="w-full py-2">
                                                Fees as prescribed along with user charges
                                            </li>
                                        </ul>
                                    </li>
                                    <li
                                        class="flex flex-col items-center justify-start gap-2 border-b border-gray-200 py-4 w-full">
                                        <div class="forms flex items-center justify-start w-full gap-2">
                                            <img src="<?php echo $url ?>/asset/icons/arrow-right.svg" alt=""
                                                class="w-6 h-6 rotate-0 transition-transform duration-300">
                                            Duplicate Driving Licence
                                        </div>
                                        <ul
                                            class="flex flex-col items-start justify-center gap-2 w-full px-8 closed list-disc">
                                            <h3 class="py-2 text-gray-500 font-semibold">Duplicate Licence</h3>
                                            <h3 class="py-2 text-gray-500 font-semibold">A duplicate driving licence
                                                will be issued in the following circumstances</h3>
                                            <li class="w-full py-2">
                                                When the licence is lost or destroyed
                                            </li>
                                            <li class="w-full py-2">
                                                When the licence is defaced or torn or completely written up
                                            </li>
                                            <li class="w-full py-2">
                                                When the photograph affixed to the licence requires replacement
                                            </li>
                                            <h3 class="py-2 text-gray-500 font-semibold">Requirements</h3>
                                            <li class="w-full py-2">
                                                Application in Form - LLD
                                            </li>
                                            <li class="w-full py-2">
                                                Application Form no 9.
                                            </li>
                                            <li class="w-full py-2">
                                                Original licence written or defaced if available.
                                            </li>
                                            <li class="w-full py-2">
                                                Attested photocopies of DL if available in case of loss of licence.
                                            </li>
                                            <li class="w-full py-2">
                                                Fees as prescribed along with user charges
                                            </li>
                                        </ul>
                                    </li>
                                    <li
                                        class="flex flex-col items-center justify-start gap-2 border-b border-gray-200 py-4 w-full">
                                        <div class="forms flex items-center justify-start w-full gap-2">
                                            <img src="<?php echo $url ?>/asset/icons/arrow-right.svg" alt=""
                                                class="w-6 h-6 rotate-0 transition-transform duration-300">
                                            Addition of Class
                                        </div>
                                        <ul
                                            class="flex flex-col items-start justify-center gap-2 w-full px-8 closed list-disc">
                                            <h3 class="py-2 text-gray-500 font-semibold">Addition to a new Class of
                                                Vehicle to a Driving Licence</h3>

                                            <li class="w-full py-2">
                                                A person holding a driving licence for Motor Cycle may similarly apply
                                                for addition of a light motor vehicle at any time.
                                            </li>
                                            <h3 class="py-2 text-gray-500 font-semibold">Requirements</h3>
                                            <li class="w-full py-2">
                                                Valid Driving Licence.
                                            </li>
                                            <li class="w-full py-2">
                                                Valid Learners' Licence for the category.
                                            </li>
                                            <li class="w-full py-2">
                                                Application in Form No.8.
                                            </li>
                                            <li class="w-full py-2">
                                                Form No. 1.(Self declaration as to the physical fitness for Non-
                                                Transport vehicles only).
                                            </li>
                                            <li class="w-full py-2">
                                                Form No 1A (Medical Certificate-for Transport Vehicles only).
                                            </li>
                                            <li class="w-full py-2">
                                                Fees as prescribed along with user charges.
                                            </li>
                                        </ul>
                                    </li>
                                    <li
                                        class="flex flex-col items-center justify-start gap-2 border-b border-gray-200 py-4 w-full">
                                        <div class="forms flex items-center justify-start w-full gap-2">
                                            <img src="<?php echo $url ?>/asset/icons/arrow-right.svg" alt=""
                                                class="w-6 h-6 rotate-0 transition-transform duration-300">
                                            International Driving licence or Permit
                                        </div>
                                        <ul
                                            class="flex flex-col items-start justify-center gap-2 w-full px-8 closed list-disc">
                                            <h3 class="py-2 text-gray-500 font-semibold">International Driving Permit
                                            </h3>

                                            <li class="w-full py-2">
                                                International Driving Permit will be issued to an applicant who holds a
                                                valid Indian Licence and who is a resident of India. The application
                                                shall be made in or in writing to the RTO within whose jurisdiction the
                                                applicant resides, specifying the countries to be visited and the
                                                duration of stay etc.
                                            </li>
                                            <h3 class="py-2 text-gray-500 font-semibold">Requirements</h3>
                                            <li class="w-full py-2">
                                                Valid driving Licence held by the applicant and copies thereon.
                                            </li>
                                            <li class="w-full py-2">
                                                Copies of Passport, Visa ( where applicable) and Air ticket for
                                                verification.
                                            </li>
                                            <li class="w-full py-2">
                                                Fees as prescribed along with user charges.
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <!-- offeces  -->
                            <div class="flex-col w-full items-start justify-start mainFormClass hidden">
                                <div
                                    class="flex items-center justify-start gap-2 py-2 border-b-2 border-gray-300 w-full cursor-pointer formsClass">
                                    <img src="<?php echo $url ?>/asset/icons/note.svg" alt="" class="w-8 h-8">
                                    <h1 class="text-2xl font-medium">RTO Offices</h1>
                                </div>
                                <ul class="flex items-start justify-center flex-col cursor-pointer w-full">
                                    <?php
                                    foreach ($results as $r) {
                                        echo '<li
                                        class="flex flex-col items-center justify-start gap-2 border-b border-gray-200 py-4 w-full">
                                        <div class="forms flex items-center justify-start w-full gap-2">
                                            <img src="' . $url . '/asset/icons/arrow-right.svg" alt=""
                                    class="w-6 h-6 rotate-0 transition-transform duration-300">
                                    ' . $r['name'] . '
                            </div>
                            <ul class="flex flex-col items-start justify-center gap-2 w-full px-8 closed">
                                <li class="w-full py-2">
                                    <a href="' . $r['map'] . '" class="flex items-center justify-start gap-1 text-blue-500">
                                        <img src="' . $url . '/asset/icons/location.svg" alt="">
                                        ' . $r['address'] . '
                                    </a>
                                </li>
                                <li class="w-full py-2">
                                    <a href="tel:' . $r['number'] . '" class="flex items-center justify-start gap-1">
                                        <img src="' . $url . '/asset/icons/call.svg" alt="">
                                        ' . $r['number'] . '
                                    </a>
                                </li>
                            </ul>
                            </li>';
                                    }

                                    ?>

                                </ul>
                            </div>
                            <!-- contact us -->
                            <div class="flex-col w-full items-start justify-start mainFormClass flex">
                                <div
                                    class="flex items-center justify-start gap-2 py-2 border-b-2 border-gray-300 w-full cursor-pointer formsClass">
                                    <img src="<?php echo $url ?>/asset/icons/note.svg" alt="" class="w-8 h-8">
                                    <h1 class="text-2xl font-medium">Contact Us</h1>
                                </div>
                                <div class="w-full">
                                    <form class="grid grid-cols-2 gap-4 cursor-pointer w-full py-4">
                                        <div class="col-span-1 w-full relative input-label">
                                            <input type="text" name="name" id="name"
                                                class="w-full border-b border-gray-500 focus:outline-none text-lg px-2 py-1 focus:border-green-500 valid:border-green-500 transition-colors duration-300"
                                                required>
                                            <label for="name"
                                                class="absolute top-0 left-[2px] px-2 py-1 text-lg transition-all duration-300 label-hover">Name</label>
                                        </div>
                                        <div class="col-span-1 w-full relative input-label">
                                            <input type="email" name="email" id="email"
                                                class="w-full border-b border-gray-500 focus:outline-none text-lg px-2 py-1 focus:border-green-500 valid:border-green-500 transition-colors duration-300"
                                                required>
                                            <label for="email"
                                                class="absolute top-0 left-[2px] px-2 py-1 text-lg transition-all duration-300 label-hover">Email</label>
                                        </div>
                                        <div class="col-span-1 w-full relative input-label">
                                            <input type="tel" name="number" id="number"
                                                class="w-full border-b border-gray-500 focus:outline-none text-lg px-2 py-1 focus:border-green-500 valid:border-green-500 transition-colors duration-300"
                                                required>
                                            <label for="number"
                                                class="absolute top-0 left-[2px] px-2 py-1 text-lg transition-all duration-300 label-hover">Mobile
                                                No.</label>
                                        </div>
                                        <div class="col-span-1 w-full relative input-label">
                                            <input type="text" name="city" id="city"
                                                class="w-full border-b border-gray-500 focus:outline-none text-lg px-2 py-1 focus:border-green-500 valid:border-green-500 transition-colors duration-300"
                                                required>
                                            <label for="city"
                                                class="absolute top-0 left-[2px] px-2 py-1 text-lg transition-all duration-300 label-hover">City</label>
                                        </div>
                                        <div class="col-span-2 w-full">
                                            <label for="message" class="px-2 py-1 text-lg">Message</label>
                                            <textarea type="text" name="message" id="message"
                                                class="w-full border-b border-gray-500 focus:outline-none text-lg px-2 py-1 focus:border-green-500 valid:border-green-500 transition-colors duration-300 resize-none"
                                                required></textarea>
                                        </div>
                                        <div class="col-span-2 w-full flex items-center justify-center">
                                            <button type="submit"
                                                class="px-8 py-4 bg-yellow-300 hover:bg-yellow-400 rounded-md text-lg">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- Disclaimer -->
                            <div class="flex-col w-full items-start justify-start mainFormClass hidden">
                                <div
                                    class="flex items-center justify-start gap-2 py-2 border-b-2 border-gray-300 w-full cursor-pointer formsClass">
                                    <img src="<?php echo $url ?>/asset/icons/note.svg" alt="" class="w-8 h-8">
                                    <h1 class="text-2xl font-medium">Disclaimer</h1>
                                </div>
                                <div class="w-full">
                                    <p class="w-full py-2">This test is only for public awareness. Though all efforts
                                        have been made to ensure the accuracy of the content, the same should not be
                                        construed as a statement of law or used for any legal purposes. This application
                                        accepts no responsibility in relation to the accuracy, completeness, usefulness
                                        or otherwise, of the contents. Users are advised to verify/check any information
                                        with the Transport Department.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="w-full h-[450px] bg-white"></section>
        <!-- footer -->
        <?php include("../../components/footer.php"); ?>
    </main>

    <script src="<?php echo $url ?>/main.js"></script>
</body>

</html>