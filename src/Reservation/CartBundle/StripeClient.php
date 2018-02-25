<?php

namespace Reservation\CartBundle;

use Doctrine\ORM\EntityManager;
use Stripe\ApiResource;
use Stripe\Customer;
use Stripe\Invoice;
use UserBundle\Entity\User;

class StripeClient
{
    private $em;

    public function __construct(string $secretKey = "sk_test_cmHlewUEjcBi8FuyxxRLFEQN", EntityManager $em)
    {
        $this->em = $em;

        dump($secretKey);
        \Stripe\Stripe::setApiKey($secretKey);
    }

    public function createCustomer(User $user, $paymentToken)
    {
        /** @var Customer $customer */
        $customer = \Stripe\Customer::create([
            'email' => $user->getEmail(),
            'source' => $paymentToken,
        ]);
        $user->setStripeCustomerId($customer->id);

        dump($user);
        $this->em->persist($user);
        $this->em->flush($user);

        return $customer;
    }

    public function updateCustomerCard(User $user, $paymentToken)
    {
        /** @var Customer $customer */
        $customer = \Stripe\Customer::retrieve($user->getStripeCustomerId());

        $customer->source = $paymentToken;
        $customer->save();
    }

    /**
     * @param $amount
     * @param User $user
     * @param $description
     */
    public function createInvoiceItem($amount, User $user, $description)
    {
        return \Stripe\InvoiceItem::create([
            "amount" => $amount,
            "currency" => "usd",
            "customer" => $user->getStripeCustomerId(),
            "description" => $description
        ]);
    }

    /**
     * @param User $user
     * @param bool $payImmediately
     * @return Invoice
     */
    public function createInvoice(User $user, $payImmediately = true): Invoice
    {
        /** @var Invoice $invoice */
        $invoice = \Stripe\Invoice::create(array(
            "customer" => $user->getStripeCustomerId()
        ));

        if ($payImmediately) {
            // guarantee it charges *right* now
            $invoice->pay();
        }

        return $invoice;
    }
}
