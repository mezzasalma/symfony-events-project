<?php

namespace App\Controller;

use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController {
  /**
   * @Route("/", name="index", methods={"GET"})
   */
  public function index(EventRepository $eventRepository): Response
  {
    /** @var \App\Entity\User $user */
    $user = $this->getUser();
    return $this->render('index.html.twig', [
      'user' => $user,
      'next_events' => $eventRepository->findNextEventsActive(6),
    ]);
  }
}
