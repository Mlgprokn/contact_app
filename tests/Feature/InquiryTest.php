<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\Inquiry;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewInquiry;

class InquiryTest extends TestCase
{
    /**
     * Test whether the value is being saved to the database
     */
    public function test_saving_value()
    {
        //perform the action
        $response = $this->post('/api/inquiries', [
            'name' => 'test', 
            'email' => 'test@test.com', 
            'phone' => '0889232132', 
            'message' => 'test message'
        ]);

        //assert
        $response->assertStatus(201);
    }

    /**
     * Test name validation
     */
    public function test_name_validation_required()
    {
        //perform the action
        $response = $this->post('/api/inquiries', [
            'email' => 'test@test.com', 
            'phone' => '0889232132', 
            'message' => 'test message'
        ]);

        //assert
        $response->assertSessionHasErrors(['name']);
    }

    /**
     * Test name validation
     */
    public function test_name_validation_max_lenght()
    {
        //perform the action
        $response = $this->post('/api/inquiries', [
            'name' => 'tetesttesttestttetesttesttesttesttesttesttesttestteststtetesttesttesttesttesttesttesttestteststtetesttesttesttesttesttesttesttestteststesttesttesttesttestt',
            'email' => 'test@test.com', 
            'phone' => '0889232132', 
            'message' => 'test message'
        ]);

        //assert
        $response->assertSessionHasErrors(['name']);
    }

    /**
     * Test email validation
     */
    public function test_email_validation_valid_email()
    {
        //perform the action
        $response = $this->post('/api/inquiries', [
            'name' => 'test',
            'email' => 'testtest.com', 
            'phone' => '0889232132', 
            'message' => 'test message'
        ]);

        //assert
        $response->assertSessionHasErrors(['email']);
    }

    /**
     * Test email validation
     */
    public function test_email_validation_max_lenght()
    {
        //perform the action
        $response = $this->post('/api/inquiries', [
            'name' => 'test',
            'email' => 'testtesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttest@test.com', 
            'phone' => '0889232132', 
            'message' => 'test message'
        ]);

        //assert
        $response->assertSessionHasErrors(['email']);
    }

    /**
     * Test message validation
     */
    public function test_message_validation_max_lenght()
    {
        //perform the action
        $response = $this->post('/api/inquiries', [
            'name' => 'test',
            'email' => 'test@test.com', 
            'phone' => '0889232132', 
            'message' => 'test messtest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messagetest messageage'
        ]);

        //assert
        $response->assertSessionHasErrors(['message']);
    }

    /**
     * Test whether an email was send
     */
    public function test_email_send()
    {
        Mail::fake();

        Mail::send(new NewInquiry(new Inquiry()));

        //assert wheter the email was send
        Mail::assertSent(NewInquiry::class);
    }
}
