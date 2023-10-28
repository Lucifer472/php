<?php include("../config.php");
include("../admin/scripts/db.php");

// SQL query
$sql = "SELECT * FROM test ORDER BY RAND() LIMIT 15";

try {
    // Prepare the query
    $stmt = $conn->prepare($sql);

    // Execute the query
    $stmt->execute();

    // Fetch data and save it in an array of associative arrays
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($data)) {
        foreach ($data as $row) {
            $result[] = array(
                "id" => $row["id"],
                "question" => $row["question"],
                "img" => $row["img"],
                "opt1" => $row["opt1"],
                "opt2" => $row["opt2"],
                "opt3" => $row["opt3"],
                "Answer" => $row["Answer"]
            );
        }
    } else {
        echo "No records found in the 'test' table.";
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
    <link rel="canonical" href="<?= $url ?>/exam" />
    <script type="application/ld+json">
    {
        "@context": "http://schema.org",
        "@type": "WebSite",
        "name": "Exam | <?= $mainTitle ?>",
        "url": "<?= $url ?>/exam",
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
    <meta property="og:title" content="Exam | <?= $mainTitle ?>" />
    <meta property="og:description"
        content="Welcome to <?= $mainTitle ?>, your trusted companion on the road to success in RTO exams across India. We offer a comprehensive platform designed to help you prepare effectively for your upcoming driving license and learner's permit tests. Whether you're aiming to pass the learner's test or upgrade your license, our extensive collection of RTO mock tests and practice questions provides the perfect training ground. Gain the knowledge, confidence, and skills you need to excel in your RTO exams, with instant feedback, in-depth explanations, and real exam simulations. Start your journey towards safe and informed driving today with <?= $mainTitle ?>." />
    <meta property="og:image" content="<?= $url ?>/asset/preview.png" />
    <meta property="og:url" content="<?= $url ?>/exam" />
    <meta property="og:type" content="website" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="Exam | <?= $mainTitle ?>" />
    <meta name="twitter:description"
        content="Welcome to <?= $mainTitle ?>, your trusted companion on the road to success in RTO exams across India. We offer a comprehensive platform designed to help you prepare effectively for your upcoming driving license and learner's permit tests. Whether you're aiming to pass the learner's test or upgrade your license, our extensive collection of RTO mock tests and practice questions provides the perfect training ground. Gain the knowledge, confidence, and skills you need to excel in your RTO exams, with instant feedback, in-depth explanations, and real exam simulations. Start your journey towards safe and informed driving today with <?= $mainTitle ?>." />
    <meta name="twitter:image" content="<?= $url ?>/asset/preview.png" />
    <meta name="twitter:url" content="<?= $url ?>/exam" />
    <?php echo $header ?>
    <title>Exam |
        <?= $mainTitle ?>
    </title>
</head>

<body>
    <main class="bg-slate-100 w-full">
        <!-- navbar -->
        <?php include("../components/navbar.php"); ?>
        <!-- title  -->
        <section class="w-full bg-gray-200/80 border-b-[1px] border-gray-200 py-6">
            <div class="global-container flex items-start justify-evenly flex-col">
                <h1 class="my-4 text-4xl font-medium text-black" id="title">RTO EXAM</h1>
                <h2 class="text-xl font-normal text-black" id="subTitle">List of questions & answers and meaning of road
                    signs</h2>
            </div>
        </section>
        <section class="w-full min-h-[650px] bg-white">
            <div class="p-4 w-full flex items-center justify-center global-container">
                <div class="flex flex-col items-center justify-center w-full" id="main-question">
                    <div class="flex flex-col items-center justify-between w-full gap-1 sm:gap-2 md:gap-4 mb-6">
                        <div
                            class="flex items-center sm:items-start justify-center sm:justify-between gap-1 sm:gap-2 md:gap-4 w-full">
                            <div class="flex items-center justify-start gap-1 sm:gap-2 md:gap-4 w-full">
                                <div class="flex items-center justify-center rounded-full bg-gray-50">
                                    <canvas id="timer-border">
                                    </canvas>
                                </div>
                                <div class="text-gray-600 text-base sm:text-lg px-1 sm:px-2 my-2" id="questionCount">
                                </div>
                            </div>
                            <!-- write and wrong  -->
                            <div class="flex items-center justify-end gap-1 w-[70%] sm:w-fit">
                                <span
                                    class="rounded-md bg-green-400 flex items-center justify-center gap-1 sm:gap-2 px-2 py-1 sm:px-4 sm:py-2 text-white">
                                    <img src="<?php echo $url ?>/asset/true.svg" alt="Correct" class="fill-white">
                                    <p id="correct" class="text-base sm:text-lg"></p>
                                </span>
                                <span
                                    class="rounded-md bg-red-400 flex items-center justify-center gap-1 sm:gap-2 px-2 py-1 sm:px-4 sm:py-2 text-white">
                                    <img src="<?php echo $url ?>/asset/wrong.svg" alt="Wrong" class="fill-white">
                                    <p id="wrong" class="text-base sm:text-lg"></p>
                                </span>
                            </div>
                        </div>
                        <div class="w-full flex flex-col items-start justify-start px-6 py-4">
                            <div>Q. <span class="text-xl text-black font-medium" id="questionItself"></span></div>
                            <figure class="my-2" id="questionImg">

                            </figure>
                        </div>
                    </div>
                    <!-- question and answer  -->
                    <form class="flex items-center justify-center w-full flex-col gap-2" id="main-form">
                        <label for="btn1"
                            class="flex items-center justify-start gap-4 px-6 py-4 border border-gray-300 rounded-md w-full hover:border-black">
                            <span>1</span>
                            <p class="que text-left"></p>
                            <input type="radio" name="answer-option" id="btn1" value="1" class="hidden">
                        </label>
                        <label for="btn2"
                            class="flex items-center justify-start gap-4 px-6 py-4 border border-gray-300 rounded-md w-full hover:border-black">
                            <span>2</span>
                            <p class="que text-left"></p>
                            <input type="radio" name="answer-option" id="btn2" value="2" class="hidden">
                        </label>
                        <label for="btn3"
                            class="flex items-center justify-start gap-4 px-6 py-4 border border-gray-300 rounded-md w-full hover:border-black">
                            <span>3</span>
                            <p class="que text-left"></p>
                            <input type="radio" name="answer-option" id="btn3" value="3" class="hidden">
                        </label>
                        <div class="text-center w-full bg-red-200 border-2 border-red-400 text-red-600 hidden"
                            id="err-msg"></div>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-400 hover:bg-blue-500 font-medium rounded-md text-white">Next
                            Question
                            ></button>
                    </form>
                </div>
                <div class="hidden items-center flex-col justify-center w-full" id="score-board">
                    <div class="flex flex-col items-start justify-start gap-4 w-full" id="score-board-child">
                    </div>
                    <div class="flex items-center justify-between w-full">
                        <a href="<?php echo $url ?>/exam"
                            class="px-6 py-4 text-lg bg-blue-400 m-2 border border-gray-200 hover:bg-blue-500 rounded-md text-white">Try
                            Again</a>
                        <a href="<?php echo $url ?>"
                            class="px-6 py-4 text-lg bg-blue-400 m-2 border border-gray-200 hover:bg-blue-500 rounded-md text-white">Go
                            Back</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- floating Model  -->
        <section class="fixed top-0 left-0 w-full h-full bg-gray-700/30" id="exam-modal">
            <div class="w-full h-full flex items-center justify-center p-4">
                <div
                    class="w-full md:max-w-[66%] lg:max-w-[44%] xl:max-w-[33%] h-fit bg-slate-50 rounded-md shadow-xl ">
                    <div class="w-full flex flex-col items-start justify-start">
                        <div class="px-6 py-4 border-b border-gray-300 w-full">
                            <h2 class="text-xl font-medium">Instructions</h2>
                        </div>
                        <div class="px-6 py-4 flex items-start justify-start flex-col gap-4">
                            <span class="text-justify font-medium text-gray-700">Subject like Rules and Regulations of
                                traffic, and traffic signage's are included in
                                the test.</span>
                            <span class="text-justify font-medium text-gray-700">15 questions are asked in the test at
                                random, out of which 11 questions are required
                                to be answered correctly to pass the test.</span>
                            <span class="text-justify font-medium text-gray-700">48 seconds are allowed to answer each
                                question.</span>
                            <button
                                class="w-full flex items-center justify-center py-4 bg-blue-400 shadow-md rounded-md text-white"
                                id="start-exam">
                                START EXAM
                            </button>
                            <a href="<?php echo $url ?>"
                                class="w-full flex items-center justify-center py-4 bg-blue-400 shadow-md rounded-md text-white">
                                Home
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="hidden fixed top-0 left-0 w-full h-full bg-gray-700/30" id="final-modal">
            <div class="w-full h-full flex items-center justify-center p-4">
                <div
                    class="w-full md:max-w-[66%] lg:max-w-[44%] xl:max-w-[33%] h-fit bg-slate-50 rounded-md shadow-xl ">
                    <div class="w-full flex flex-col items-start justify-start">
                        <div class="px-6 py-4 border-b border-gray-300 w-full">
                            <h2 class="text-xl font-medium">Result</h2>
                        </div>
                        <div class="px-6 py-4 flex items-start justify-start flex-col gap-4 w-full">
                            <span class="text-justify font-medium text-gray-700 line-data"></span>
                            <span class="text-justify font-medium text-gray-700 line-data"></span>
                            <span class="text-justify font-medium text-gray-700 line-data"></span>
                            <button
                                class="w-full flex items-center justify-center py-4 bg-blue-400 shadow-md rounded-md text-white"
                                id="view-result">
                                View Result
                            </button>
                            <a href="<?php echo $url ?>"
                                class="w-full flex items-center justify-center py-4 bg-blue-400 shadow-md rounded-md text-white">
                                Go Home
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- footer -->
        <?php include("../components/footer.php"); ?>
    </main>
    <script src="<?php echo $url ?>/main.js"></script>
    <script>
        const mainDiv = document.getElementById("main-question");
        const finalModal = document.getElementById("final-modal");
        const viewResult = document.getElementById("view-result");
        const scoreBoard = document.getElementById("score-board");
        const scoreBoardChild = document.getElementById("score-board-child");
        const answerData = [];
        const lines = document.querySelectorAll(".line-data");
        const data = <?php echo json_encode($data) ?>;
        let i = 0;
        let correctAns = 0;

        const checkFinal = (main, i, data) => {
            if (i === data.length) {
                clearInterval(countdown);
                main.classList.remove("flex");
                main.classList.add("hidden");
                finalModal.classList.remove("hidden");
                if (correctAns > 10) {
                    lines[0].innerText = "Congratulations! You have successfully passed the Learner License Exam!";
                } else {
                    lines[0].innerText = "We are sorry, but you have failed the Learner License Exam.";
                }
                lines[1].innerText =
                    `There were a total of ${data.length} questions, and you got ${correctAns} questions right.`;
                lines[2].innerText = `You got ${i - correctAns} questions wrong.`;
            } else {
                return false;
            }
        }


        const c = document.getElementById("timer-border");
        // Function to set canvas dimensions based on screen size
        function setCanvasSize() {
            if (window.innerWidth < 400) {
                c.width = 48;
                c.height = 48;
                fonts = "16px Roboto";
                line = 3;
                arc = [24, 22];
                fill = [10, 30, 15, 30];
            } else {
                c.width = 64;
                c.height = 64;
                fonts = "24px Roboto";
                line = 4;
                arc = [32, 30];
                fill = [12, 40, 18, 40];
            }
        }
        setCanvasSize();
        window.addEventListener('resize', setCanvasSize);
        const ctx = c.getContext("2d");

        let sec = 48;
        let arcAngle = 2;
        let countdown;

        const resetTimer = () => {
            clearInterval(countdown);
            sec = 47;
            arcAngle = 1.958;
            countdown = setInterval(drawTimer, 1000);
        };

        const drawTimer = () => {
            ctx.clearRect(0, 0, c.width, c.height);

            ctx.beginPath();
            ctx.arc(arc[0], arc[0], arc[1], 0, Math.PI * arcAngle, false);
            ctx.lineWidth = line;
            ctx.font = fonts;
            if (sec >= 10) {
                ctx.strokeStyle = "#007aff";
                ctx.stroke();
                ctx.fillStyle = "#007aff";
                ctx.fillText(sec + " s", fill[0], fill[1]);
            } else {
                ctx.strokeStyle = "red";
                ctx.stroke();
                ctx.fillStyle = "red";
                ctx.fillText(sec + " s", fill[2], fill[3]);
            }

            if (sec === 0) {
                clearInterval(countdown);
                checkFinal(mainDiv, i, data);
                data[i].userInput = 4;
                answerData.push(data[i]);
                i++;
                resetTimer();
                queAnsFunc(data, i, correctAns);
            } else {
                sec--;
                arcAngle -= 0.0416;
            }
        };

        const elements = {
            questionItself: document.getElementById("questionItself"),
            questionCount: document.getElementById("questionCount"),
            questionImg: document.getElementById("questionImg"),
            correct: document.getElementById("correct"),
            wrong: document.getElementById("wrong"),
            que: document.querySelectorAll(".que"),
            btn1: document.getElementById("btn1"),
            btn2: document.getElementById("btn2"),
            btn3: document.getElementById("btn3"),
        };
        const queGen = (data) => {
            // Fade out elements
            elements.questionItself.style.opacity = 0;
            elements.que.forEach((que) => {
                que.style.opacity = 0;
            });

            setTimeout(() => {
                // Update the content
                elements.questionItself.innerText = data.question;
                if (document.querySelector(".isImg") && elements.questionImg) {
                    document.querySelector(".isImg").parentNode.removeChild(document.querySelector(".isImg"));
                }
                if (data.img !== null) {
                    const imgElement = document.createElement("img");
                    imgElement.src = `<?php echo $url ?>/asset/traficSign/${data.img}`;
                    imgElement.alt = data.id;
                    imgElement.classList.add("w-16", "isImg");
                    elements.questionImg.appendChild(imgElement);
                }
                elements.que[0].innerText = data.opt1;
                elements.que[1].innerText = data.opt2;
                elements.que[2].innerText = data.opt3;

                // Fade in elements
                elements.questionItself.style.opacity = 1;
                elements.que.forEach((que) => {
                    que.style.opacity = 1;
                });
            }, 500); // Adjust the delay (in milliseconds) to match your CSS transition duration
        };


        const checkAns = (num, data) => {
            if (num == data.Answer) {
                answerData.push(data);
                correctAns++;
            } else {
                data.userInput = num;
                answerData.push(data);
            }
            i++;
            resetTimer();
        };

        const queAnsFunc = (data, i, correctAns) => {
            queGen(data[i]);
            elements.questionCount.innerText = `Questions ${i + 1}/15:`;
            elements.wrong.innerText = i - correctAns;
            elements.correct.innerText = correctAns;
        };

        const startExam = document.getElementById("start-exam");
        const examModal = document.getElementById("exam-modal");

        startExam.addEventListener("click", () => {
            examModal.classList.add("exam-modal-animated");

            setTimeout(() => {
                examModal.classList.add("hidden");
                queAnsFunc(data, i, correctAns);
                countdown = setInterval(drawTimer, 1000);
                drawTimer();
            }, 600);
        });

        const chekLabel = [elements.btn1, elements.btn2, elements.btn3];
        const labels = document.querySelectorAll("#main-form label");

        function resetRadioButtons() {
            const radioButtons = document.querySelectorAll('#main-form input[type="radio"]');
            radioButtons.forEach((radio) => {
                radio.checked = false;
            });
        }

        chekLabel.forEach((l, index) => {
            l.addEventListener("click", () => {
                labels[0].classList.remove("chekedAns");
                labels[1].classList.remove("chekedAns");
                labels[2].classList.remove("chekedAns");
                labels[index].classList.add("chekedAns");
            });
        });

        document.getElementById("main-form").addEventListener('submit', (e) => {
            e.preventDefault();
            const input = e.target['answer-option'].value;
            if (input == "") {
                document.getElementById("err-msg").classList.remove("hidden");
                document.getElementById("err-msg").innerText = "Please Select any One Option!"
            } else {
                document.getElementById("err-msg").classList.add("hidden");
                checkAns(input, data[i]);
                checkFinal(mainDiv, i, data);
                labels[0].classList.remove("chekedAns");
                labels[1].classList.remove("chekedAns");
                labels[2].classList.remove("chekedAns");
                resetRadioButtons();
                queAnsFunc(data, i, correctAns);
            }
        })
        // scoreBord:
        function createQuestionElement(data) {
            // Check for Correct Answer
            let correctAnsText;
            let userAnswer;
            switch (data.Answer) {
                case "1":
                    correctAnsText = data.opt1;
                    break;
                case "2":
                    correctAnsText = data.opt2;
                    break;
                case "3":
                    correctAnsText = data.opt3;
                    break;
                default:
                    correctAnsText = "It was Correct Ans!";
            };
            if (data.userInput) {
                switch (data.userInput) {
                    case "1":
                        userAnswer = data.opt1;
                        break;
                    case "2":
                        userAnswer = data.opt2;
                        break;
                    case "3":
                        userAnswer = data.opt3;
                        break;
                    default:
                        userAnswer = "Not Answered!";
                };
            }

            // Create the main container
            const container = document.createElement('div');
            container.classList.add('flex', 'flex-col', 'items-start', 'justify-start', 'gap-4', 'w-full', 'border-b',
                'border-gray-200');

            // Create the first div with images and text
            const topDiv = document.createElement('div');
            topDiv.classList.add('flex', 'items-center', 'justify-center', 'gap-2');
            // Create the first image element
            const Image = document.createElement('img');
            if (data.userInput) {
                Image.src = '../asset/wrong-red.svg';
                Image.alt = '';
                Image.classList.add('w-8', 'h-8', 'p-1', 'rounded-full', 'border', 'border-red-600');
            } else {
                Image.src = '../asset/true-green.svg';
                Image.alt = '';
                Image.classList.add('w-8', 'h-8', 'p-1', 'rounded-full', 'border', 'border-green-600');
            }

            // Create the text element
            const questionText = document.createElement('span');
            questionText.textContent = `Q. ${data.question}`;
            questionText.classList.add('text-xl', 'font-medium');

            // Append elements to the top div
            topDiv.appendChild(Image);
            topDiv.appendChild(questionText);

            // Append the top div to the main container
            container.appendChild(topDiv);

            if (data.img != null) {
                // Create the second div with the image
                const imgDiv = document.createElement('div');
                imgDiv.classList.add('flex', 'items-start', 'justify-start', 'ml-12', 'w-full');

                // Create the image element within the second div
                const questionImage = document.createElement('img');
                questionImage.src = `<?php echo $url ?>/asset/traficSign/${data.img}`;
                questionImage.alt = data.img;
                questionImage.classList.add('w-16', 'h-16');

                // Append the image to the second div
                imgDiv.appendChild(questionImage);

                // Append the second div to the main container
                container.appendChild(imgDiv);
            };

            // Create the third div with text elements
            const textDiv = document.createElement('div');
            textDiv.classList.add('flex', 'flex-col', 'items-start', 'justify-start', 'gap-2', 'w-full');
            if (data.userInput) {
                // Create the first text element
                const rightAnswerText = document.createElement('p');
                rightAnswerText.textContent = `Right Answer: ${correctAnsText}`;
                rightAnswerText.classList.add('text-green-600', 'font-normal', 'text-lg');

                // Create the second text element
                const yourAnswerText = document.createElement('p');
                yourAnswerText.textContent = `Your Answer: ${userAnswer}`;
                yourAnswerText.classList.add('text-red-600', 'font-normal', 'text-lg');
                // Append text elements to the third div
                textDiv.appendChild(rightAnswerText);
                textDiv.appendChild(yourAnswerText);
            } else {
                // Create the first text element
                const rightAnswerText = document.createElement('p');
                rightAnswerText.textContent = `Right Answer: ${correctAnsText}`;
                rightAnswerText.classList.add('text-green-600', 'font-normal', 'text-lg');
                // Append text elements to the third div
                textDiv.appendChild(rightAnswerText);
            }

            // Append the third div to the main container
            container.appendChild(textDiv);

            return container;
        }

        viewResult.addEventListener("click", () => {
            finalModal.classList.add("hidden");
            scoreBoard.classList.remove("hidden");
            scoreBoard.classList.add("flex");

            document.getElementById("title").innerText = "Scoreboard";
            document.getElementById("subTitle").innerText =
                "Time and question bound test exactly same as actual RTO Test";

            answerData.forEach((a) => {
                scoreBoardChild.appendChild(createQuestionElement(a));
            })
        });
    </script>
</body>

</html>