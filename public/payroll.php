<?php
    session_start();
    include 'database/db.php';

    if (isset($_SESSION["admin_name"])) {
        $admin_name = $_SESSION["admin_name"];
    }

    $sql = "SELECT * FROM payroll";
    $query = mysqli_query($con, $sql);

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (isset($_GET['action'])) {
            $action = $_GET['action'];
            
            // Perform different actions based on the button clicked
            if ($action === 'view') {
                // Redirect to view.php
                header('Location: view.php?id=' . $_GET['id']);
                exit();
            } elseif ($action === 'edit') {
                // Redirect to edit.php
                header('Location: edit.php?id=' . $_GET['id']);
                exit();
            } elseif ($action === 'delete') {
                // Redirect to delete.php
                header('Location: delete.php?id=' . $_GET['id']);
                exit();
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body class="grid place-items-center min-h-screen bg-main-2">
    <div class="w-11/12 flex bg-white shadow-2xl rounded-lg">
        <div class="w-[20%]">
            <div class="flex flex-col items-center py-5 mb-10">
                <img src="../src/img/dp.jpg" alt="" width="130" height="130" class="rounded-[50%] mb-2 bg-main">
                <div class="flex items-center gap-2">
                    <p class="text-lg font-semibold"><?php echo $admin_name ?></p>
                    <button id="toggle" onclick="toggleLogout()">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M137.4 374.6c12.5 12.5 32.8 12.5 45.3 0l128-128c9.2-9.2 11.9-22.9 6.9-34.9s-16.6-19.8-29.6-19.8L32 192c-12.9 0-24.6 7.8-29.6 19.8s-2.2 25.7 6.9 34.9l128 128z"/></svg>
                    </button>
                </div>
                <button onclick="window.location.href='logout.php'" id="logout" class="w-2/4 bg-slate-500 text-white rounded-md text-sm py-1 hidden">Logout</button>   
            </div>
            <div class="flex flex-col mb-48">
                <button onclick="window.location.href='dashboard.php'" class="w-full text-left flex items-center gap-2 hover:bg-main-2 hover:text-white px-4 py-3 transition-all"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M543.8 287.6c17 0 32-14 32-32.1c1-9-3-17-11-24L512 185V64c0-17.7-14.3-32-32-32H448c-17.7 0-32 14.3-32 32v36.7L309.5 7c-6-5-14-7-21-7s-15 1-22 8L10 231.5c-7 7-10 15-10 24c0 18 14 32.1 32 32.1h32v69.7c-.1 .9-.1 1.8-.1 2.8V472c0 22.1 17.9 40 40 40h16c1.2 0 2.4-.1 3.6-.2c1.5 .1 3 .2 4.5 .2H160h24c22.1 0 40-17.9 40-40V448 384c0-17.7 14.3-32 32-32h64c17.7 0 32 14.3 32 32v64 24c0 22.1 17.9 40 40 40h24 32.5c1.4 0 2.8 0 4.2-.1c1.1 .1 2.2 .1 3.3 .1h16c22.1 0 40-17.9 40-40V455.8c.3-2.6 .5-5.3 .5-8.1l-.7-160.2h32z"/></svg><p>Home</p></button>
                <button onclick="window.location.href='add_employee.php'" class="w-full text-left flex items-center gap-2 hover:bg-main-2 hover:text-white px-4 py-3 transition-all"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M184 48H328c4.4 0 8 3.6 8 8V96H176V56c0-4.4 3.6-8 8-8zm-56 8V96H64C28.7 96 0 124.7 0 160v96H192 320 512V160c0-35.3-28.7-64-64-64H384V56c0-30.9-25.1-56-56-56H184c-30.9 0-56 25.1-56 56zM512 288H320v32c0 17.7-14.3 32-32 32H224c-17.7 0-32-14.3-32-32V288H0V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V288z"/></svg><p>Employees</p></button>
                <button onclick="window.location.href='payroll.php'" class="w-full text-left flex items-center gap-2 hover:bg-main-2 hover:text-white px-4 py-3 transition-all"><svg xmlns="http://www.w3.org/2000/svg" height="16" width="18" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M64 64C28.7 64 0 92.7 0 128V384c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V128c0-35.3-28.7-64-64-64H64zm64 320H64V320c35.3 0 64 28.7 64 64zM64 192V128h64c0 35.3-28.7 64-64 64zM448 384c0-35.3 28.7-64 64-64v64H448zm64-192c-35.3 0-64-28.7-64-64h64v64zM288 160a96 96 0 1 1 0 192 96 96 0 1 1 0-192z"/></svg><p>Payroll</p></button>
            </div>
            <div class="px-4 py-6">
                <p class=" text-sm">Need help?</p>
                <a href="#" class="text-sm">companyname@gmail.com</a>
            </div>
        </div>
        <div class="bg-slate-100 rounded-tr-lg rounded-br-lg w-[80%]">
            <div class="w-11/12 mx-auto mt-10">
                <h1 class="mb-4 text-lg font-semibold">Payroll</h1>
                <button onclick="window.location.href='payroll_add.php'" class="px-6 py-1 bg-main-2 text-white float-right mb-10">Add</button>
                <div class=" clear-both">
                    <table class="w-full text-center">
                        <tr>
                            <th class="py-3">Pay Date</th>
                            <th>Pay period</th>
                            <th>Gross pay</th>
                            <th>Net pay</th>
                            <th>Employee</th>
                            <th>Status</th>
                        </tr>
                        <?php
                            while($row = mysqli_fetch_assoc($query)){
                            $gross = $row['gross_pay'];
                            $net = $row['net_pay'];

                            $grossString = (string) $gross;
                            $netString = (string) $net;
                        ?>
                        <tr class="bg-slate-200">
                            <form action="" method="GET">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <td class="py-3"><?php echo $row['end_date']; ?></td>
                                <td>
                                    <?php
                                        echo $row['start_date'] . " to " . $row['end_date']; 
                                    ?>
                                </td>
                                <td><?php 
                                if (strlen($grossString) == 4) {
                                    // Add comma after the first number
                                    $grossString = substr($grossString, 0, 1) . ',' . substr($grossString, 1);
                                } elseif (strlen($grossString) == 5) {
                                    // Add comma after the second number
                                    $grossString = substr($grossString, 0, 2) . ',' . substr($grossString, 2);
                                }

                                echo $grossString;
                                ?></td>
                                <td><?php 
                                
                                if (strlen($netString) == 4) {
                                    // Add comma after the first number
                                    $netString = substr($netString, 0, 1) . ',' . substr($netString, 1);
                                } elseif (strlen($netString) == 5) {
                                    // Add comma after the second number
                                    $netString = substr($netString, 0, 2) . ',' . substr($netString, 2);
                                }

                                echo $netString;
                                
                                ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td>Complete</td>
                            </form>
                        <?php
                            }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>