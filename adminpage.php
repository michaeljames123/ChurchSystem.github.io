<!DOCTYPE html>
<html>
	<head>
		<!-- You can Include your CSS here-->
		<style>
			/* Sidebar Div */
			body {
            display: flex;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        /* Sidebar Div */
        div {
            color: #fff;
            width: 250px;
            padding-left: 20px;
            height: 100vh;
            background-image: linear-gradient(30deg, #11cf4d, #055e21);
           
        }
        /* Div header */
        div h2 {
            padding: 40px 0 0 0;
            cursor: pointer;
        }
        /* Div links */
        div a {
            font-size: 14px;
            color: #fff;
            display: block;
            padding: 12px;
            padding-left: 30px;
            text-decoration: none;
            outline: none;
        }
        /* Div link on hover */
        div a:hover {
            color: #56ff38;
            background: #fff;
            position: relative;
            background-color: #fff;
            border-top-left-radius: 22px;
            border-bottom-left-radius: 22px;
        }
		        /* Sidebar Div */
				.sidebar {
            color: #fff;
            width: 250px;
            padding: 20px;
            height: 100%; /* Full height */
            background-image: linear-gradient(30deg, #11cf4d, #055e21);
            border-top-right-radius: 0px;
            position: fixed; /* Fixed sidebar */
            overflow-y: auto; /* Scroll if content overflows */
        }

        /* Sidebar Header */
        .sidebar h2 {
            text-align: center; /* Center sidebar header */
            font-size: 24px; /* Larger font for header */
            font-weight: bold; /* Bold header */
            margin-bottom: 20px; /* Space below header */
        }

        /* Sidebar links */
        .sidebar a {
            font-size: 16px; /* Increased font size */
            color: #fff;
            display: block;
            padding: 12px;
            text-decoration: none;
            transition: background-color 0.3s; /* Smooth transition */
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

		</style>
	</head>
	<body>
        <title>Admin

        </title>
		<div>
			<!-- Div Header-->
			<h2>Admin</h2>
			<!-- Links in Div -->
			<a href="bookings.php"> Bookings </a>
			<a href="schedules.php"> Schedules </a>
			<a href="users.php"> Users </a>
			<a href="log_out.php"> Log out </a>
		</div>
    
	</body>
</html>
