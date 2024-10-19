<?php
namespace PHPTDD\src;
use PHPUnit\Framework\TestCase;
use SMFlutterLibTemplate\ProjectSourceHelper;

class ProjectSourceHelperTest extends TestCase {

    
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
     * @covers SMFlutterLibTemplate\ProjectSourceHelper::getBuildProjectSequence
     **/
    public function testProjectSourceHelperGetBuildProjectSequence() {
        $sequence = ProjectSourceHelper::getBuildProjectSequence();
        // the sequence should be an array
        $this->assertIsArray($sequence);
        // it should contains 'dart_geo_string' (one of the project name)
        $this->assertContains('dart_geo_string', $sequence);

    }
}
