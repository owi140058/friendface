<?php
    
require_once __DIR__.'/../delegates/auth_delegate.php';
require_once __DIR__.'/../delegates/info_delegate.php';
    
class InfoDelegateTest extends \PHPUnit\Framework\TestCase {
    
    public function setUp() {
        parent::setUp();
        $this->id = 1;
        $this->name = "Peter";
        $this->email = "peter@home.com";
    }
    
    public function tearDown() {
        parent::tearDown();
        update_info(1, "Mark", "mark@facebook.com");
    }
    
    public function testUpdateInfo() {
        $user = get_user_by_email("peter@home.com");
        $this->assertEquals($user, null);
        
        update_info($this->id, $this->name, $this->email);
        $user = get_user_by_email("peter@home.com");
        $this->assertEquals($user['id'], 1);
        $this->assertEquals($user['name'], "Peter");
    }
    
}

?>