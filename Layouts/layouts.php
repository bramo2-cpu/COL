<?php
class layouts {
    public function heading($conf) {
        print "<h1>Welcome to {$conf['site_name']}</h1>";
    }
    public function footer($conf) {
        print "<footer>Copyrights &copy; " . date("Y") . " {$conf['site_name']}. All rights reserved.</footer>";
    }   
}