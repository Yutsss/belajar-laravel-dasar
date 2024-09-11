<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EncryptionTest extends TestCase
{
    public function testEncryption()
    {
        $encrypt = encrypt('Hello Yuta');
        $decrypt = decrypt($encrypt);

        $this->assertEquals('Hello Yuta', $decrypt);
    }
}
