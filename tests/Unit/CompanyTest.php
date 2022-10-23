<?php

namespace Tests\Unit;

use App\Models\Company;
use PHPUnit\Framework\TestCase;

class CompanyTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_name_is_uppercase()
    {
        $company = new Company(['name' => 'coca cola']);
        $this->assertEquals('COCA COLA', $company->name);
    }

    public function test_name_is_saved_lowercase(){
        $company = new Company();
        $company->name = 'Coca Cola';

        $attributes = $company->getAttributes();

        $this->assertEquals('coca cola', $attributes['name']);
    }

    public function test_address_is_uppercase(){
        $company = new Company(['address' => 'address']);
        $this->assertEquals('ADDRESS', $company->address);
    }

    public function test_address_is_saved_lowercase(){
        $company = new Company();
        $company->address = 'Address';

        $attributes = $company->getAttributes();

        $this->assertEquals('address', $attributes['address']);
    }
}
