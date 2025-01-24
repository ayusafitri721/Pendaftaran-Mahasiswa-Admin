<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400&family=Open+Sans:wght@400&family=Poppins:wght@300&display=swap" rel="stylesheet">
    <style>
    
    body {
    margin: 0;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: 'Poppins', sans-serif;
    background: url('itb.png.jpg') no-repeat center center fixed; 
    background-size: cover; 
    color: #fff;
}

/* Main Login Container */
.login-container {
    background: rgba(101, 168, 223, 0.6);
    border-radius: 20px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
    padding: 40px;
    max-width: 500px;
    text-align: center;
    backdrop-filter: blur(15px); 
}

.login-container h3 {
    margin-bottom: 10px;
    font-family: 'Lora', serif; 
    font-size: 2rem;
    color: #00b5e2; 
}


.login-container p:first-of-type {
    font-family: 'Lora', serif; 
    font-size: 1rem;
    margin-bottom: 25px;
    color: #ffffff;
}



.form-group {
    position: relative;
    margin-bottom: 20px;
}

.form-group input {
    width: 100%;
    padding: 15px 50px; 
    border: 2px solid #006a8e;
    border-radius: 30px;
    background: rgba(0, 153, 204, 0.1);
    color: #333; /* Dark text for input */
    outline: none;
    font-size: 1rem; /* Larger font for inputs */
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

.form-group input:hover {
    border-color: #005f7f; /* Darker blue on hover */
}

.form-group input:focus {
    box-shadow: 0 0 10px rgba(0, 153, 204, 0.7); /* Blue glow effect */
}

.form-group input::placeholder {
    color: rgba(0, 0, 0, 0.7); /* Darker placeholder text for better readability */
}

.form-group .icon {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: rgba(0, 0, 0, 0.5); /* Darker icon color */
    font-size: 1.5rem; /* Bigger icon size */
}

/* Button Styling */
.btn-primary {
    width: 100%;
    border: none;
    border-radius: 30px;
    padding: 15px;
    font-size: 1rem;
    background-color: #006a8e; /* Dark Blue Background */
    color: #fff;
    cursor: pointer;
    transition: background 0.3s ease, transform 0.2s ease;
}

.btn-primary:hover {
    background-color: #005f7f; /* Darker blue on hover */
    transform: translateY(-2px); /* Subtle lift effect */
}

/* Footer Styling */
.footer-text {
    margin-top: 20px;
    font-family: 'Open Sans', sans-serif; /* Clean and modern */
    font-size: 0.9rem;
    color: rgba(255, 255, 255, 0.9);
}

.footer-text a {
    color: #fff;
    text-decoration: underline;
}

.footer-text a:hover {
    text-decoration: none;
}


    </style>
</head>

<body>
    <div class="login-container">
        <h3>WELCOME</h3>
        <p>Login to your account</p>
        <form action="../process/login.php" method="POST">
            <div class="form-group">
                <span class="icon">&#128100;</span>
                <input type="text" id="username" name="username" placeholder="Username" required>
            </div>
            <div class="form-group">
                <span class="icon">&#128274;</span>
                <input type="password" id="password" name="password" placeholder="Password" required>
            </div>
            <button type="submit" class="btn-primary">Login</button>
        </form>
        <p class="footer-text">Don't you have an account? <a href="registrasi.php">Sign up</a></p>
    </div>
</body>

</html>