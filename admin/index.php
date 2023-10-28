<?php
session_start(); // Start the session

include("../config.php");
include("./scripts/db.php");
if (isset($_SESSION["email"])) {
    $email = $_SESSION["email"];
} elseif (isset($_SESSION["statusMsg"])) {
    $statusMsg = $_SESSION['statusMsg'];
}
try {
    // Construct the SQL query to fetch ENUM values
    $sql = "SHOW COLUMNS FROM blogs WHERE Field = 'category'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        // Extract ENUM values from the result
        $enum_values = $result['Type'];

        // Parse ENUM values into an array
        preg_match_all("/'([^']+)'/", $enum_values, $matches);
        $values = $matches[1];
    } else {
        echo "ENUM column not found.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Close the database connection
$conn = null;


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@2.28.1"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/header@2.7.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/list@1.8.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/image@2.3.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/quote@2.5.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/paragraph@2.10.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/table@2.2.2"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/underline@1.1.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/marker@1.3.0"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <?php echo $header ?>
    <title>Admin Panel</title>
</head>

<body>
    <?php

    if (isset($email)) {
        ?>
        <!-- main admin panel  -->
        <main class="w-full h-full bg-slate-50">
            <section class="flex items-start justify-center px-4 py-5 w-full">
                <div
                    class="flex items-start justify-start flex-col gap-2 shadow-xl max-w-[850px] w-full min-h-[400px] px-6 py-4 rounded-md typo-graph bg-white">
                    <h1 class="py-2 text-xl font-semibold border-b border-gray-400 w-full">Add Blog Here!</h1>
                    <div class="flex flex-col items-start justify-center gap-4 w-full">
                        <div class="flex items-center justify-start gap-2 w-full border border-gray-300 rounded-md p-2">
                            <label for="title" class="min-w-fit">Blog Title:</label>
                            <input type="text" name="title" id="title" class="w-full border-none focus:outline-none">
                        </div>
                        <div class="flex items-center justify-start gap-2 w-full border border-gray-300 rounded-md p-2">
                            <label for="url" class="min-w-fit">Blog Url:</label>
                            <input type="text" name="url" id="url" class="w-full border-none focus:outline-none">
                        </div>
                        <div class="flex items-center justify-start gap-2 w-full border border-gray-300 rounded-md p-2">
                            <label for="desc" class="min-w-fit">Blog Description:</label>
                            <input type="text" name="desc" id="desc" class="w-full border-none focus:outline-none">
                        </div>
                        <div class="flex items-center justify-start gap-2 w-full border border-gray-300 rounded-md p-2">
                            <label for="keywords" class="min-w-fit">Blog Keywords:</label>
                            <input type="text" name="keywords" id="keywords" class="w-full border-none focus:outline-none">
                        </div>
                        <div class="flex items-center justify-start gap-2 w-full border border-gray-300 rounded-md p-2">
                            <label for="author" class="min-w-fit">Author username:</label>
                            <input type="text" name="author" id="author" class="w-full border-none focus:outline-none">
                        </div>
                        <div class="flex items-center justify-start gap-2 w-full border border-gray-300 rounded-md p-2">
                            <label for="category" class="min-w-fit">Blog category:</label>
                            <select name="category" id="category" class="bg-white px-2">
                                <?php
                                foreach ($values as $v) {
                                    echo ' <option class="capitalize" value="' . $v . '">' . $v . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="w-full border border-gray-300 py-6 rounded-lg">
                        <div id="editorjs"></div>
                    </div>
                    <button class="px-6 py-4 bg-blue-400 text-white m-2 rounded-md font-semibold hover:bg-blue-500"
                        id="blog-submit">Submit</button>
                </div>
            </section>
        </main>
        <script>
            let editor; // Declare editor in a broader scope
            document.addEventListener("DOMContentLoaded", function () {
                editor = new EditorJS({
                    holder: 'editorjs',
                    logLevel: 'ERROR',
                    tools: {
                        header: {
                            class: Header,
                            inlineToolbar: true
                        },
                        paragraph: {
                            class: Paragraph,
                            inlineToolbar: true,
                        },
                        Marker: {
                            class: Marker,
                            inlineToolbar: true,
                        },
                        Underline: {
                            class: Underline,
                            inlineToolbar: true,
                        },
                        list: {
                            class: List,
                            inlineToolbar: true,
                        },
                        quote: Quote,
                        table: {
                            class: Table,
                            inlineToolbar: true,
                        },
                        image: {
                            class: ImageTool,
                            config: {
                                endpoints: {
                                    byFile: '<?= $url ?>/admin/scripts/upload.php', // Your backend file uploader endpoint
                                    byUrl: '<?= $url ?>/admin/scripts/upload.php', // Your endpoint that provides uploading by URL
                                },
                            },
                        },
                    },
                });
            });

            document.getElementById("blog-submit").addEventListener("click", () => {
                const title = document.getElementById("title").value;
                const desc = document.getElementById("desc").value;
                const keywords = document.getElementById("keywords").value;
                const author = document.getElementById("author").value;
                const url = document.getElementById("url").value;
                const category = document.getElementById("category").value;
                console.log(category);
                if (editor) {
                    editor.save()
                        .then((outputData) => {
                            // Send the data to the server
                            fetch('./scripts/blogAdd.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                },
                                body: JSON.stringify({
                                    blog: outputData.blocks,
                                    title,
                                    desc,
                                    keywords,
                                    author,
                                    url,
                                    category
                                }),
                            })
                                .then(response => response.text()) // Parse the response as text
                                .then(data => {
                                    console.log(data);
                                    if (data === "Data inserted successfully!") {
                                        alert("Blog Created Successfully");
                                        // Reset the editor
                                        editor.isReady.then(() => {
                                            editor.blocks.clear();
                                            // Reset input field values
                                            document.getElementById("title").value = "";
                                            document.getElementById("desc").value = "";
                                            document.getElementById("keywords").value = "";
                                            document.getElementById("author").value = "";
                                            document.getElementById("url").value = "";
                                            document.getElementById("category").value = "";
                                        });
                                    } else {
                                        alert("Error creating the blog");
                                    }
                                })
                                .catch(err => {
                                    console.error('Error:', err);
                                });
                        })
                        .catch((err) => {
                            console.log(err);
                        });
                } else {
                    console.log("Editor is not yet initialized.");
                }
            });
        </script>
    <?php } else { ?>
        <!-- login system -->
        <main class="w-[100vw] h-[100vh] bg-slate-50 flex items-center justify-center">
            <section class="global-container">
                <div class="p-1 m-1 md:p-4 md:m-4  bg-white border-t-2 border-blue-400 flex items-center justify-center flex-col"
                    id="login-main">
                    <h2 class="my-2 text-md font-semibold">Login</h2>
                    <form action="<?= $url ?>/admin/login.php" class="flex items-center justify-center gap-4 flex-col"
                        method="post">
                        <div class="border-[1px] border-gray-400 p-2 rounded-md flex items-center justify-center gap-1">
                            <label for="email">Email :</label>
                            <input type="text" id="email" name="email" class="w-[200px] md:w-[400px] focus:outline-none">
                        </div>
                        <div class="border-[1px] border-gray-400 p-2 rounded-md flex items-center justify-center gap-1">
                            <label for="password">Password :</label>
                            <input type="password" id="password" name="password"
                                class="w-[170px] md:w-[370px] focus:outline-none">
                        </div>
                        <!-- Google reCAPTCHA box -->
                        <div class="g-recaptcha" data-sitekey="6LfMMLsoAAAAAEhSLl2zMpFUGMpLbHbApZ0f7EOM"></div>
                        <?php if (!empty($statusMsg)) { ?>
                            <p class="status-msg <?php echo $status; ?>">
                                <?php echo $statusMsg; ?>
                            </p>
                        <?php } ?>
                        <input class="px-4 py-2 bg-gray-700 rounded-lg text-white hover:bg-black transition" type="submit"
                            name="submit" value="SUBMIT">
                    </form>
                </div>
            </section>
        </main>
    <?php } ?>

</body>

</html>