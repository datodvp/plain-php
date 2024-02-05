<?php

trait HttpResponse {
    public function jsonResponse($data, string $message = 'success') {
        echo json_encode([
            'data' => $data,
            'message' => $message
        ]);
    }
}

?>