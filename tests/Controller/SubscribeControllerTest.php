<?php

declare(strict_types=1);

namespace App\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

final class SubscribeControllerTest extends WebTestCase
{
    public function testDisplaySubscriptionForm(): void
    {
        $client = self::createClient();
        $crawler = $client->request('GET', '/subscribe');
        self::assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $form = $crawler->selectButton('Subscribe')->form();
        foreach (['name', 'email', 'categories'] as $fieldName) {
            self::assertTrue($form->has($fieldName));
        }
    }
}