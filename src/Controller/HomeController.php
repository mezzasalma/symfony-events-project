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
    return $this->render('index.html.twig', [
      'next_events' => $eventRepository->findNextEvents(),
    ]);
  }
}
