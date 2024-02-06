<?php

trait HttpResponse {
    public function jsonResponse($data, string $message = '') {
        echo json_encode([
            'data' => $data,
            'message' => $message
        ]);
    }
}

?>