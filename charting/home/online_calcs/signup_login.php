<?php
/* Edited top work with PHP7 :JWX */
include ('constants.php');

$background_color = BACKGROUND_COLOR;
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title><?php echo YOUR_URL; ?> login</title>
        <meta name="description" content="<?php echo YOUR_URL; ?> Website">
        <meta name="keywords" content="<?php echo YOUR_URL; ?> Website">

        <link href="styles.css" rel="stylesheet" type="text/css" />

        <style type='text/css'>
            h5
            {
                FONT-WEIGHT: 400; FONT-SIZE: 10px; COLOR: #000000; FONT-FAMILY: Verdana, Arial, sans-serif
            }
            .pa_textbox
            {
                FONT-WEIGHT: 400; FONT-SIZE: 11px; COLOR: #000000; FONT-FAMILY: Verdana, Arial, sans-serif
            }
            .pa_LinksText
            {
                FONT-SIZE: 10px; COLOR: #000000; FONT-FAMILY: Verdana, Arial, sans-serif; TEXT-DECORATION: none
            }
            INPUT.pa_button1
            {
                width: 540px; BORDER-TOP-WIDTH: 1px; FONT-WEIGHT: bold; BORDER-LEFT-WIDTH: 1px; FONT-SIZE: 11px; BORDER-LEFT-COLOR: #ff9eb9; BACKGROUND: #b70000 no-repeat 5px 3px; BORDER-BOTTOM-WIDTH: 1px; BORDER-BOTTOM-COLOR: #990049; COLOR: #ffffff; BORDER-TOP-COLOR: #ff9eb9; FONT-FAMILY: Verdana, Arial, sans-serif; BORDER-RIGHT-WIDTH: 1px; BORDER-RIGHT-COLOR: #990049
            }
            INPUT.pa_button2
            {
                width: 190px; BORDER-TOP-WIDTH: 1px; FONT-WEIGHT: bold; BORDER-LEFT-WIDTH: 1px; FONT-SIZE: 11px; BORDER-LEFT-COLOR: #ff9eb9; BACKGROUND: #b70000 no-repeat 5px 3px; BORDER-BOTTOM-WIDTH: 1px; BORDER-BOTTOM-COLOR: #990049; COLOR: #ffffff; BORDER-TOP-COLOR: #ff9eb9; FONT-FAMILY: Verdana, Arial, sans-serif; BORDER-RIGHT-WIDTH: 1px; BORDER-RIGHT-COLOR: #990049
            }
        </style>
    </head>

    <body text="#000000" link="#0000FF" vlink="#ff0000" bgcolor="<?php echo $background_color; ?>">

        <div id="header"><img src="images/dummy_logo.jpg" alt="<?php echo YOUR_URL; ?>" /></div>

        <div id="content">
            In order to process your astrological information we need you to sign up as a free member. We will keep all your data safe for you. It will also be easy from now on to add other family members or friends in case you want to check them out. Signing up does not entail any obligations on your part other than entering the birth information. We will never sell or disclose any of your personal details to anybody else. Thank you for your interest in my work. I send you my best.
        </div>

        <div id="content">
            <table width="99%" bgcolor="<?php echo $background_color; ?>" cellspacing='0' cellpadding='3' border="0">
                <tr>
                    <td>
                        <form name='form1' action="process_new.php" method="post" target="_blank">
                            <table cellSpacing='3' cellPadding='0' border='0'>
                                <tr>
                                    <td colspan='3' align='center'>
                                        <h4><center>New to <?php echo YOUR_URL; ?>?<br>Sign up for FREE</center></h4>
                                    </td>
                                </tr>

                                <tr>
                                    <td align='right' colspan='2'>
                                        <span class=pa_textbox>Choose a username:&nbsp;</span>
                                    </td>
                                    <td align='left' colspan='1'>
                                        <input class=pa_textbox maxLength=12 size=17 name=username>
                                    </td>
                                </tr>

                                <tr>
                                    <td align='right' colspan='2'>
                                        <span class=pa_textbox>Choose a password:&nbsp;</span>
                                    </td>
                                    <td align='left' colspan='1'>
                                        <input class=pa_textbox type=password maxLength=16 size=17 name=password1>
                                    </td>
                                </tr>

                                <tr>
                                    <td align='right' colspan='2'>
                                        <span class=pa_textbox>Confirm password:&nbsp;</span>
                                    </td>
                                    <td align='left' colspan='1'>
                                        <input class=pa_textbox type=password maxLength=16 size=17 name=password2>
                                    </td>
                                </tr>

                                <tr>
                                    <td align='right' colspan='2'>
                                        <span class=pa_textbox>E-mail:&nbsp;</span>
                                    </td>
                                    <td align=left colspan='1'>
                                        <input class=pa_textbox maxLength=40 size=46 name=email>
                                    </td>
                                </tr>
                            </table>
                            <br><br><br><input class=pa_button1 type="submit" value="Register me as a new member">
                        </form>
                    </td>

                    <td width="25" bgcolor="<?php echo $background_color; ?>">&nbsp;</td>

                    <td>
                        <form name="form2" action="login.php" method="post" target="_blank">
                            <table cellSpacing='3' cellPadding='0' border='0'>
                                <tr>
                                    <td colspan='3' align='center'>
                                        <h4><center>Current Member?<br>
                                                Sign in here</center><br></h4>
                                    </td>
                                </tr>

                                <tr>
                                    <td align='right' colspan='2'>
                                        <span class=pa_textbox>Username:&nbsp;</span>
                                    </td>
                                    <td align='left' colspan='1'>
                                        <?php
                                        $username = "";
                                        if (isset($_COOKIE['u_name']))
                                            $username = $_COOKIE['u_name'];
                                        echo "<input class='pa_textbox' type='text' maxLength='12' size='17' name='username' VALUE='$username'>";
                                        ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td align='right' colspan='2'>
                                        <span class=pa_textbox>Password:&nbsp;</span>
                                    </td>
                                    <td align='left' colspan='1'>
                                        <?php
                                        $password = "";
                                        if (isset($_COOKIE['u_pw']))
                                            $password = $_COOKIE['u_pw'];
                                        echo "<input class='pa_textbox' type='password' maxLength='16' size='17' name='password' VALUE='$password'>";
                                        ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td align='center' colspan='3'>
                                        <span class='pa_textbox'><A href="forgotpassword.php"><br><br>Forgot your password?</A></span>
                                    </td>
                                </tr>

                            </table>
                            <br><input class='pa_button2' type=submit value='Log me in'>
                        </form>
                    </td>
                </tr>
            </table>

            <p>&nbsp;</p>

        </div>

    <br><br>

    <div id="footer">
        &copy;<?php echo COPYRIGHT_DATE . "&nbsp;&nbsp;" . YOUR_URL; ?>&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;<a href="privacy.php">Privacy Policy</a></div>

</body>
</html>
