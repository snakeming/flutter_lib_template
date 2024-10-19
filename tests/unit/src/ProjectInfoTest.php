<?php
namespace PHPTDD\src;
use PHPUnit\Framework\TestCase;
use SMFlutterLibTemplate\ProjectInfo;

class ProjectInfoTest extends TestCase {

    private $pi=null;
    /**
     * This code will run before each test executes
     * @return void
     */
    protected function setUp(): void {
        $this->pi=new ProjectInfo('dart_geo_string');
    }


    /**
     * @covers SMFlutterLibTemplate\ProjectInfo::__construct
     **/
    public function testProjectInfo__construct() {
        self::assertEquals(true, $this->pi instanceof ProjectInfo);
    }

    /**
     * @covers SMFlutterLibTemplate\ProjectInfo::projectRootPath
     **/
    public function testProjectInfoProjectRootPath() {
        $path = $this->pi->projectRootPath();
        // the path should ends with 'dart_gep_string'
        $this->assertStringEndsWith('dart_geo_string', $path);
    }
}
