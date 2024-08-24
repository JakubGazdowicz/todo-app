<?php

describe('TestPest', function () {
    it('testPest', function () {
        $response = $this->get('/');

        $response->assertStatus(200);
    });
});


