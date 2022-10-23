<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 *
 */
class CompanyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if company index page is rendered.
     *
     * @return void
     */
    public function test_company_index_page_rendered(): void
    {
        $this->authorizedAccess('/companies');

    }

    public function test_company_index_page_unauthorized(): void
    {
        $this->unauthorizedAccess('/companies');
    }

    public function test_company_create_page_rendered(): void{
        $this->authorizedAccess('/companies/create');
    }

    public function test_company_create_page_unauthorized(): void{
        $this->unauthorizedAccess('/companies/create');
    }

    public function test_add_new_company(): void{
        $this->login();
        $this->post('/companies', [
            'name' => 'New',
            'email' => 'new@email.com',
            'address' => 'address'
        ])->assertStatus(302)->assertRedirect('/companies');

        $this->assertDatabaseHas('companies', [
            'name' => 'new',
            'email' => 'new@email.com',
            'address' => 'address'
        ]);
    }

    public function test_company_edit_page_rendered(): void{
        $company = $this->createCompany();

        $this->authorizedAccess("/companies/{$company->id}/edit");
    }

    public function test_company_edit_page_unauthorized(): void{
        $company = $this->createCompany();

        $this->unauthorizedAccess("/companies/{$company->id}");
    }

    public function test_edit_company_data(): void{
        $this->login();

        $company = $this->createCompany();

        $this->put("/companies/{$company->id}", [
            'name' => 'update',
            'email' => 'update@email.com',
            'address' => 'update address'
        ])->assertStatus(302)->assertRedirect('/companies');

        $this->assertDatabaseHas('companies',[
            'name' => 'update',
            'email' => 'update@email.com',
            'address' => 'update address'
        ]);
    }


    /**
     * @dataProvider invalidCompanies
     *
     * @return void
     */
    public function test_invalid_company_data_input($invalidData, $invalidField): void{
        $this->login();
        $this->post('/companies', $invalidData)
            ->assertSessionHasErrors($invalidField)
            ->assertStatus(302);

        $this->assertDatabaseCount('companies', 0);

        $company = $this->createCompany();
        $this->put("/companies/{$company->id}", $invalidData)
            ->assertSessionHasErrors($invalidField)
            ->assertStatus(302);
    }

    public function invalidCompanies(): array
    {
        return [
            [
                ['name' => 'new', 'email' => 'test@email.com'],
                ['address']
            ],
            [
                ['name' => 'new', 'address' => 'address'],
                ['email']
            ],
            [
                ['email' => 'test@email.com', 'address' => 'address'],
                ['name']
            ],
        ];
    }

    public function login(){
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'password'
        ]);

    }

    public function createCompany(){
        return Company::factory()->create();
    }

    public function unauthorizedAccess($link){
        $this->get($link)->assertStatus(302)->assertRedirect('/login');
        $this->assertGuest();
    }

    public function authorizedAccess($link){
        $this->login();

        $this->get($link)->assertStatus(200);
    }
}
