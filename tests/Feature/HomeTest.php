<?php


it('see text', function () {
    $response = $this->get('/');
    
    $response->assertOk();
    
    // Check for visible content that should be rendered server-side
    $response->assertSee('Willkommen in unserem Hilfe-Center');

    

});