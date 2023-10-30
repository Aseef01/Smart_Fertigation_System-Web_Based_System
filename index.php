<?php include 'templates/header.php';

if(isset($_POST['sign-in'])) {
    $error = validate($_POST);
}

?>
<style>
    @media (max-width: 768px) { 
        .login-page {
            width: 90%;
            height: 60vh;
        }
        .login-page .left-side img {
            width: 40%;
            /*top: 7%;
            left: 50%;
            transform: translateX(-50%);*/*/
        }
        .top-side-login {
            width: 80%;
            flex-direction: column;
/*            background: red;*/
/*            display: flex;*/
/*            align-items: unset;*/
/*            position: absolute;*/
            top: 7%;
            left: 50%;
            transform: translateX(-50%);
        }
        .top-side-login h4 {
            margin: 10px 0 0;
/*            font-size: 0.825rem;*/
/*            font-weight: bold;*/
        }
        .login-page .left-side form {
            width: 80%;
            top: 35%;
            transform: translateX(-50%);
        }
        .login-page .left-side form h1, .login-page .left-side form h4 {
            text-align: center;
        }
        .login-page .left-side {
            width: 100%;
        }
        .login-page .right-side {
            display: none;
        }
    }
    @media (max-height: 768px) { 
        .login-page {
            height: 68%;
        }
    }
    @media (max-height: 670px) {
        .login-page {
            height: 75%;
        }
    }
</style>
    <div class="login-page">
        <div class="left-side">
            <div class="top-side-login">
                <img src="images/logo.png" alt="Jabatan Pertanian">
                <h4 class="name-system">Smart Fertigation System (SFS)</h4>
            </div>
            <!-- <form action="user_management_page.php" method="post"> -->
            <form action="" method="post">
                <h1>Welcome back</h1>
                <h4>Welcome back! Please enter your details.</h4>
                <?php if(isset($error)) : ?>
                    <span class="error"><?= $error ?></span>
                <?php endif; ?>
                    <!-- <span class="error">Invalid username or password</span> -->
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
                <!-- <a href="#">Forget password</a> -->
                <button type="submit" name="sign-in">Sign In</button>
            </form>
        </div>
        <div class="right-side">
        </div>
    </div>

<?php include 'templates/footer.php' ?>