<?php

interface AccountInterface {
    public function deposit($amount);
    public function withdraw($amount);
    public function getBalance();
}


class BankAccount implements AccountInterface
{
    const MIN_BALANCE = 0;

    protected $balance;
    protected $currency;

    public function __construct($currency, $initialBalance = self::MIN_BALANCE)
    {
        $this->currency = $currency;
        $this->balance = $initialBalance;
    }

    /**
     * @throws Exception
     */
    public function deposit($amount)
    {
        if ($amount <= 0) {
            throw new Exception("Incorrect amount for deposit");
        }
        $this->balance += $amount;
    }

    /**
     * @throws Exception
     */
    public function withdraw($amount)
    {
        if ($amount <= 0) {
            throw new Exception("Incorrect amount for withdrawal");
        }

        if ($amount > $this->balance) {
            throw new Exception("Not enough money");
        }

        $this->balance -= $amount;
    }

    public function getBalance()
    {
        return $this->balance . " " . $this->currency;
    }
}


class SavingsAccount extends BankAccount
{
    public static $interestRate = 0.05;

    public function applyInterest()
    {
        $interest = $this->balance * self::$interestRate;
        $this->balance += $interest;
    }
}


try {
    $account1 = new BankAccount("USD", 100);
    $account1->deposit(50);
    echo "Account balance: " . $account1->getBalance() . PHP_EOL;

    $account1->withdraw(30);
    echo "After withdrawal: " . $account1->getBalance() . PHP_EOL;

    $account1->withdraw(150);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . PHP_EOL;
}

try {
    $account2 = new SavingsAccount("EUR", 200);
    echo "Start savings balance: " . $account2->getBalance() . PHP_EOL;

    $account2->applyInterest();
    echo "After applying interest: " . $account2->getBalance() . PHP_EOL;

    $account2->withdraw(50);
    echo "After withdrawal: " . $account2->getBalance() . PHP_EOL;
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . PHP_EOL;
}
