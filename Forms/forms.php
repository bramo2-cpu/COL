
<?php
class forms{

    private function submit_button($text){
        print "<input type='submit' value='$text'>";
    }

    public function signup(){
        ?>
        <h2>Sign Up Form</h2>
        <form action='form.php' method='post'>
            Name: <input type='text' name='name'><br><br>
            Email: <input type='email' name='email'><br><br>
            Password: <input type='password' name='password'><br><br>
            <?php $this->submit_button('Sign Up'); ?> <a>Already a member? <a href='signin.php'>Login here</a></a>
        </form>
        <?php
    }

    public function login(){
        ?>
        <h2>Login Form</h2>
        <form action='form.php' method='post'>
            Email: <input type='email' name='email'><br><br>
            Password: <input type='password' name='password'><br><br>
            <?php $this->submit_button('Login'); ?> <a>Not a member? <a href='index.php'>Sign up here</a></a>
        </form>
        <?php
    }
}
