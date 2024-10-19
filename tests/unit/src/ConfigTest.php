<?php
namespace PHPTDD\src;
use PHPUnit\Framework\TestCase;
use SMFlutterLibTemplate\Config;

class ConfigTest extends TestCase {

    /**
     * This code will run before each test executes
     * @return void
     */
    protected function setUp(): void {

    }

    /**
     * This code will run after each test executes
     * @return void
     */
    protected function tearDown(): void {

    }

    /**
     * @covers SMFlutterLibTemplate\Config::rootPath
     **/
    public function testConfigRootPath() {
        $path = Config::rootPath();
        // the path should ends with 'flutter_lib_template'
        $this->assertStringEndsWith('flutter_lib_template', $path);
    }
}
