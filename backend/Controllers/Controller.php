<?php

class Controller {
    use HttpResponse;

    public function index() {
        echo 'This is PHP server PHP:' . phpversion();
    }
}

?>