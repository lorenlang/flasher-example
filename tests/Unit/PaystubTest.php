<?php

namespace Tests\Unit;

use App\Paystub;
use Tests\TestCase;

class PaystubTest extends TestCase
{

    protected $paystub;
    protected $paystub2;


    protected function setUp(): void
    {
        parent::setUp();
        $this->paystub  = Paystub::find('DD0000532');
        $this->paystub2 = Paystub::find('DD0055231');
    }


    public function testPaystubBelongsToTheCorrectEmployee()
    {
        $employee = $this->paystub->employee;
        $this->assertInstanceOf('App\Employee', $employee);
        $this->assertEquals('46828', $employee->EmployeeNumber);
        $employee = $this->paystub2->employee;
        $this->assertInstanceOf('App\Employee', $employee);
        $this->assertEquals('279072', $employee->EmployeeNumber);
    }


    public function testPaystubHasCorrectDeposit()
    {
        $deposit = $this->paystub->deposit;
        $this->assertInstanceOf('App\PaystubDeposit', $deposit);
        $this->assertEquals($this->paystub->CheckNumber, $deposit->CheckNumber);
        $deposit = $this->paystub2->deposit;
        $this->assertInstanceOf('App\PaystubDeposit', $deposit);
        $this->assertEquals($this->paystub2->CheckNumber, $deposit->CheckNumber);
    }


    public function testPaystubHasCorrectTaxes()
    {
        $taxes = $this->paystub->taxes;
        $this->assertContainsOnlyInstancesOf('App\PaystubTax', $taxes);
        $this->assertCount(6, $taxes);
        $this->assertEquals(1202.34, $taxes->sum('TaxAmount'));
        $taxes = $this->paystub2->taxes;
        $this->assertContainsOnlyInstancesOf('App\PaystubTax', $taxes);
        $this->assertCount(6, $taxes);
        $this->assertEquals(253.01, $taxes->sum('TaxAmount'));
    }


    public function testPaystubHasCorrectEarnings()
    {
        $earnings = $this->paystub->earnings;
        $this->assertContainsOnlyInstancesOf('App\PaystubEarning', $earnings);
        $this->assertCount(1, $earnings);
        $this->assertEquals(173.33, $earnings->sum('UnitsToPay'));
        $this->assertEquals(5227.83, $earnings->sum('EarnedAmount'));
        $earnings = $this->paystub2->earnings;
        $this->assertContainsOnlyInstancesOf('App\PaystubEarning', $earnings);
        $this->assertCount(4, $earnings);
        $this->assertEquals(1273.60, $earnings->sum('EarnedAmount'));
        $this->assertEquals(80, $earnings->sum('UnitsToPay'));
    }


    public function testPaystubHasCorrectDeductions()
    {
        $deductions = $this->paystub->deductions;
        $this->assertContainsOnlyInstancesOf('App\PaystubDeduction', $deductions);
        $this->assertCount(3, $deductions);
        $this->assertEquals(904.77, $deductions->sum('DeductionAmount'));
        $deductions = $this->paystub2->deductions;
        $this->assertContainsOnlyInstancesOf('App\PaystubDeduction', $deductions);
        $this->assertCount(2, $deductions);
        $this->assertEquals(122.94, $deductions->sum('DeductionAmount'));
    }


    public function testPaystubHasCorrectBenefits()
    {
        $benefits = $this->paystub->benefits;
        $this->assertContainsOnlyInstancesOf('App\PaystubBenefit', $benefits);
        $this->assertCount(7, $benefits);
        $this->assertEquals(1370.13, $benefits->sum('BenefitAmount'));
        $benefits = $this->paystub2->benefits;
        $this->assertContainsOnlyInstancesOf('App\PaystubBenefit', $benefits);
        $this->assertCount(1, $benefits);
        $this->assertEquals(25.47, $benefits->sum('BenefitAmount'));
    }


    public function testPaystubHasCorrectSickvac()
    {
        $sickvac = $this->paystub->sickvac;
        $this->assertContainsOnlyInstancesOf('App\PaystubSickVac', $sickvac);
        $this->assertCount(0, $sickvac);
        $this->assertEquals(0, $sickvac->sum('TimeAvailable'));
        $sickvac = $this->paystub2->sickvac;
        $this->assertContainsOnlyInstancesOf('App\PaystubSickVac', $sickvac);
        $this->assertCount(2, $sickvac);
        $this->assertEquals(582.32, $sickvac->sum('TimeAvailable'));
    }

}
