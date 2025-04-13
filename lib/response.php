<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"])."/core/lib/init.php");

class Response {
    private $data;

    public function __construct() {
        $this->data = [];
    }

    public function status($code) {
        $this->data["status1"] = $code;
    }

    public function message($message) {
        $this->data["message"] = $message;
    }

    public function data($key, $val) {
        $this->data["data"][$key] = $val;
    }

    public function throw() {
        exit(json_encode($this->data));
    }
}