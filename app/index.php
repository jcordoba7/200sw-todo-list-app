<?php 
    // initialize errors variable
	$errors = "";
    
    // connect to database
	$db_conn = mysqli_connect($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PSSWD'], $_ENV['DB_NAME']);

    // insert a quote if submit button is clicked
	if (isset($_POST['submit']))
    {
		if (empty($_POST['task'])) {
			$errors = "You must fill in the task";
		}else{
			$task = $_POST['task'];
			$sql = "INSERT INTO tasks (task) VALUES ('$task')";
			mysqli_query($db_conn, $sql);
			header('location: index.php');
		}
	}

    // delete task
    if (isset($_GET['del_task']))
    {
        $id = $_GET['del_task'];

        mysqli_query($db_conn, "DELETE FROM tasks WHERE id=".$id);
        header('location: index.php');
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>ToDo List Application PHP and MySQL</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="heading">
		<h2 style="font-style: 'Hervetica';">ToDo List Application</h2>
    </div>
    <div class="heading">    
        <h3 style="font-style: 'Hervetica'; margin: 10px">
            <?php
                echo "Hostname: " . gethostname();
            ?>
        </h3>
	</div>
	<form method="post" action="index.php" class="input_form">
        <?php if (isset($errors)) { ?>
            <p><?php echo $errors; ?></p>
        <?php } ?>
		<input type="text" name="task" class="task_input">
		<button type="submit" name="submit" id="add_btn" class="add_btn">Add Task</button>
	</form>

    <table>
        <thead>
            <tr>
                <th>N°</th>
                <th>Tasks</th>
                <th style="width: 60px;">Action</th>
            </tr>
        </thead>

        <tbody>
            <?php 
            $tasks = mysqli_query($db_conn, "SELECT * FROM tasks");

            while ($row = mysqli_fetch_array($tasks)) { ?>
                <tr>
                    <td> <?php echo $row['id']; ?> </td>
                    <td class="task"> <?php echo $row['task']; ?> </td>
                    <td class="delete"> 
                        <a href="index.php?del_task=<?php echo $row['id'] ?>">-</a> 
                    </td>
                </tr>
            <?php } ?>	
        </tbody>
    </table>
</body>
</html>