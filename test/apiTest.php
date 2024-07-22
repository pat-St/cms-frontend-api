<?php

require_once "../html/api.php";

use PHPUnit\Framework\TestCase;

final class ApiTest extends TestCase
{
    public function inputValidate(): void
    {
        $_GET = array();
        $_GET["path"] = "invalid";
        
        ob_start();
        include '../src/api.php';
        $output = ob_get_clean();

        $this->assert(TRUE);
        // $apiEndpoint = exec("src/api.php");
    }
}