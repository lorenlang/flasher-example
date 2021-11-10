<?php

namespace Tests\Unit;

use App\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;


class EmployeeTest extends TestCase
{

    protected $employee;


    protected function setUp(): void
    {
        parent::setUp();
        $this->employee = Employee::find('46828');
    }


    public function testEmployeeIsEmployeeObject()
    {
        $this->assertInstanceOf('App\Employee', $this->employee);
    }


    public function testEmployeeHasCorrectAttributes()
    {
        $this->assertEquals('46828', $this->employee->EmployeeNumber);
        $this->assertEquals('Lang', $this->employee->LastName);
        $this->assertEquals('Loren', $this->employee->FirstName);
        $this->assertEquals('K', $this->employee->MiddleName);
        $this->assertEquals('', $this->employee->Nickname);
        $this->assertEquals('', $this->employee->AltName);
        $this->assertEquals('', $this->employee->Suffix);
        $this->assertEquals('Loren K Lang', $this->employee->DisplayName);
        $this->assertEquals('276480873', $this->employee->SSN);
        $this->assertEquals('M', $this->employee->Gender);
        $this->assertEquals('loren.lang@asbury.edu', $this->employee->Email);
        $this->assertEquals('', $this->employee->HomePhone);
        $this->assertEquals('', $this->employee->OtherPhone);
        $this->assertEquals('1965-11-08', $this->employee->DOB);
        $this->assertEquals('117 Lee Ct', $this->employee->Address1);
        $this->assertEquals('', $this->employee->Address2);
        $this->assertEquals('', $this->employee->Address3);
        $this->assertEquals('Harrodsburg', $this->employee->City);
        $this->assertEquals('KY', $this->employee->State);
        $this->assertEquals('40330', $this->employee->Zip);
        $this->assertEquals('', $this->employee->Country);
        $this->assertEquals('Web Programmer', $this->employee->JobDescription);
    }


    public function testEmployeeHasCorrectFirstPaystub()
    {
        $paystub = $this->employee->paystubs->first();
        $this->assertInstanceOf('App\PayStub', $paystub);
        $this->assertTrue($this->employee->is($paystub->employee));
        $this->assertEquals('DD0000532', $paystub->CheckNumber);
    }


    public function testEmployeeHasBenefitObject()
    {
        $benefit = $this->employee->benefits->first();
        $this->assertInstanceOf('App\EmployeeBenefit', $benefit);
        $this->assertTrue($this->employee->is($benefit->employee));
    }


    public function testEmployeeHasDependentObject()
    {
        $dependent = $this->employee->dependents->first();
        $this->assertInstanceOf('App\EmployeeDependent', $dependent);
        $this->assertTrue($this->employee->is($dependent->employee));
    }


    public function testEmployeeHasCorrectAvatarBasedOnNameLength()
    {
        $this->assertEquals('/images/avatars/user_m_1.png', $this->employee->avatar());
        $this->employee->FirstName = 'XXXX';
        $this->assertEquals('/images/avatars/user_m_5.png', $this->employee->avatar());
        $this->employee->FirstName = 'XXX';
        $this->assertEquals('/images/avatars/user_m_4.png', $this->employee->avatar());
        $this->employee->FirstName = 'XX';
        $this->assertEquals('/images/avatars/user_m_3.png', $this->employee->avatar());
        $this->employee->FirstName = 'X';
        $this->assertEquals('/images/avatars/user_m_2.png', $this->employee->avatar());
        $this->employee->Gender = 'F';
        $this->employee->FirstName = 'XXXXX';
        $this->assertEquals('/images/avatars/user_f_1.png', $this->employee->avatar());
        $this->employee->FirstName = 'XXXX';
        $this->assertEquals('/images/avatars/user_f_5.png', $this->employee->avatar());
        $this->employee->FirstName = 'XXX';
        $this->assertEquals('/images/avatars/user_f_4.png', $this->employee->avatar());
        $this->employee->FirstName = 'XX';
        $this->assertEquals('/images/avatars/user_f_3.png', $this->employee->avatar());
        $this->employee->FirstName = 'X';
        $this->assertEquals('/images/avatars/user_f_2.png', $this->employee->avatar());
    }


}
