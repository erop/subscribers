<?php

declare(strict_types=1);

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class SubscribeController extends AbstractController
{
    /**
     * @Route("/subscribe", name="subscribe", methods={"GET"})
     */
    public function subscribe(): Response
    {
        return $this->render('subscription/subscription_form.html.twig');
    }
}