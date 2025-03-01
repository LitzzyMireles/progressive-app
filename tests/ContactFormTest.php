<?php

use PHPUnit\Framework\TestCase;

class ContactFormTest extends TestCase
{
    public function testValidationFailsWithEmptyData()
    {
        $_POST = []; // Simula envío vacío
        ob_start(); // Captura la salida
        include 'contact.php'; // Tu archivo PHP
        $output = ob_get_clean(); // Obtiene la respuesta

        $response = json_decode($output, true);
        $this->assertEquals("error", $response['status']);
        $this->assertEquals("Todos los campos son obligatorios.", $response['message']);
    }

    public function testValidationPassesWithCorrectData()
    {
        $_POST = [
            'name' => 'Juan Pérez',
            'number' => '5551234567',
            'guest' => '100',
            'event' => 'Boda',
            'message' => 'Quiero cotización.'
        ];
        ob_start();
        include 'contact.php';
        $output = ob_get_clean();

        $response = json_decode($output, true);
        $this->assertEquals("success", $response['status']);
    }
}
