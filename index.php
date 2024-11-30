<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./output.css" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <section class="h-screen w-screen bg-slate-600 flex items-center justify-center flex-col">
        <form action="add.php" method="post" class="">
            <section class="flex items-center justify-center flex-col">
            <label for="input">TODO LIST</label>
            <input type="text" id="input" name="input" placeholder="Add a new todo" required class=" rounded p-4 m-4">
            <button class="cssbuttons-io-button" type="submit">
            <svg
                height="24"
                width="24"
                viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path d="M0 0h24v24H0z" fill="none"></path>
                <path d="M11 11V5h2v6h6v2h-6v6h-2v-6H5v-2z" fill="currentColor"></path>
            </svg>
            <span>Add</span>
            </button>
            </section>
        </form>
        <ul class=" w-full m-8 p-4 flex flex-col justify-center items-center">
            <?php require 'read.php'; ?>
        </ul>
    </section>
</body>

</html>