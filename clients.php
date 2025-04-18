<?php

session_start(); // Start the session

// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit; 
}

?>
<!DOCTYPE html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faida-Investment - Clients</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">
                <h1 class="logo">Faida-Investment Firm</h1>
            </div>
            <ul class="navbar-items">
                <li><a href="index.php">Home</a></li>
                <li><a href="clients.php">Client</a></li>
                <li><a href="investment.php">Investment</a></li>
                <li><a href="portfolio.php">Portfolio</a></li>
                <li><a href="logout.php" class="btn" style="background-color: #dc3545;">Logout</a></li>
            </ul>
        </nav>
    </header>
    <section id="client">
        <div class="title">
            <div>
                <h1>Clients</h1>
            </div>
            <div>
                <button class="add-button" id="addClientBtn">+ Add Client</button>
            </div>
        </div>
    </section>
    <section id="client">
        <div class="search-container">
            <input type="search" placeholder="Search..." class="search-input">
            <button class="search-button">Search</button>
        </div>
    </section>
    <section id="client">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Client ID</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Registration Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $servername = "localhost"; 
                    $username = "root";     
                    $password = "kali12345678"; 
                    $dbname = "Faida_Investment_Firm";

                    $conn = new mysqli($servername, $username, $password, $dbname);
                    if ($conn->connect_error) {
                        echo "<tr><td colspan='6'>Connection Failed: " . htmlspecialchars($conn->connect_error) . "</td></tr>";
                    } else {
                        $sql = "SELECT Client_ID, Client_Name, Gender, Email, Phone_Number, Registration_Date FROM Clients_Table ORDER BY Registration_Date DESC";
                        $result = $conn->query($sql);
                        if ($result && $result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row["Client_ID"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["Client_Name"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["Gender"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["Email"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["Phone_Number"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["Registration_Date"]) . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>No clients found</td></tr>";
                        }
                        $conn->close();
                    }
                ?>
            </tbody>
        </table>
    </section><br><br><br><br>
    <div class="popup-overlay" id="popupForm">
        <div class="popup-form">
            <div class="form-header">
                <h2>Add New Client</h2>
                <button class="close-btn" id="closePopupBtn">&times;</button>
            </div>
            <form id="clientForm" action="./phpcode/process_client.php" method="POST">
                 <div class="form-group"> 
                    <label for="clientID" >Client ID</label> 
                    <input type="text" id="clientID" name="Client_ID" required> 
                </div>
                 <div class="form-group"> 
                    <label for="clientName" name="">Full Name</label> 
                    <input type="text" id="clientName" name="Client_Name" required> 
                </div>
                 <div class="form-group"> 
                    <label for="Gender">Gender</label> 
                    <select id="Gender" name="Gender" required> 
                        <option value="">Select Gender</option> 
                        <option value="Male">Male</option> 
                        <option value="Female">Female</option> 
                    </select> 
                </div>
                <div class="form-group"> 
                    <label for="clientEmail">Email</label> 
                    <input type="email" id="clientEmail" name="Email" required> 
                </div>
                <div class="form-group"> 
                    <label for="clientPhone">Phone Number</label> 
                    <input type="text" id="clientPhone" name="Phone_Number" required> 
                </div>
                <div class="form-group"> 
                    <label for="clientRegDate">Registration Date</label> 
                    <input type="date" id="clientRegDate" name="Registration_Date" required> 
                </div>
                <div class="form-actions"> 
                    <button type="button" class="cancel-btn" id="cancelFormBtn">Cancel</button> 
                    <button type="submit" class="submit-btn">Add Client</button> 
                </div>
            </form>
        </div>
    </div>
    <footer>
        <div class="footer-section">
            <div class="footer">
                <div class="footer1">
                    <h2>About Us</h2>
                    <p> Faida-Investment Firm is a leading financial investment firm in the Middle East. Our mission is to provide clients with the tools and insights they need to make informed financial decisions. </p>
                </div>
                <div class="footer1">
                    <h2>Contact Us</h2>
                    <p> Email: <a href="mailto:faida@investment.com">faida@investment.com</a> </p>
                    <p> Phone: <a href="tel:+254 769 634 770">+254 769 634 770</a> </p>
                </div>
                <div class="footer1">
                    <h2>Quick Links</h2>
                     <ul> <li><a href="index.php">Home</a></li>
                        <li><a href="clients.php">Client</a></li>       
                        <li><a href="investment.php">Investment</a></li> 
                        <li><a href="portfolio.php">Portfolio</a></li>   
                    </ul>
                </div>
            </div>
            <p class="bottom-footer">&copy; Faida-Investment Firm 2025. All rights reserved.</p>
        </div>
    </footer>
    <script src="main.js"></script>
</body>
</html>
