<?php

trait HttpResponse {
    public function jsonResponse($data) {
        echo json_encode($data);
    }
}

?>