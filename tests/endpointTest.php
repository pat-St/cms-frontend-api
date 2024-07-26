<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class EndpointTest extends TestCase
{
    public function testImputValidation(): void
    {
        require_once("../html/util/endpoint.php");
        $input_path = "invalid";
        ob_start();
        callEndpoint($input_path); 
        $output = ob_get_clean();
        echo $output;

        $this->assertEquals("unable to find: ". $input_path, $output);
    }
}
?>