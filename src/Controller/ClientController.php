<?php

namespace App\Controller;

use App\Entity\Consultation;
use App\Form\ConsultationType;
use App\Repository\ConsultationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ClientController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('client/index.html.twig', []);
    }
    
    #[Route('/etude', name: 'app_etude')]
    public function etude(): Response
    {
        return $this->render('client/etude.html.twig', []);
    }
    #[Route('/immigration', name: 'app_immigration')]
    public function immigration(): Response
    {
        return $this->render('client/immigration.html.twig', []);
    }
    #[Route('/visa-visiteur', name: 'app_visa_visiteur')]
    public function visaVisiteur(): Response
    {
        return $this->render('client/visaVisiteur.html.twig', []);
    }
    #[Route('/travail', name: 'app_travail')]
    public function travail(): Response
    {
        return $this->render('client/travail.html.twig', []);
    }
    #[Route('/contact', name: 'app_contact')]
    public function contact(): Response
    {
        return $this->render('client/contact.html.twig', []);
    }
    // #[Route('/about', name: 'app_about')]
    // public function about(): Response
    // {
    //     return $this->render('client/about.html.twig', []);
    // }


    #[Route('/getConsultation', name: 'app_get_consultation')]
    public function getConsultation(Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ConsultationType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Process the form data, e.g., saving to the database
            $consultation = $form->getData();
            $entityManager->persist($consultation);
            $entityManager->flush();

            // Redirect to a success page or perform other actions
            return $this->redirectToRoute('app_home');
        }

        return $this->render('client/getConsultation.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route('/get-all-consultations/{date}', name: 'app_get_all_consultations')]
    public function getAllConsultationsByDate(ConsultationRepository $consultationRepository, $date): JsonResponse
    {
        // Convert date string to DateTime object
        $dateTime = \DateTime::createFromFormat('Y-m-d', $date);
        if (!$dateTime) {
            return new JsonResponse(['error' => 'Invalid date format.'], JsonResponse::HTTP_BAD_REQUEST);
        }

        // Fetch meeting hours for the given date
        $meetingHours = $consultationRepository->findMeetingHoursByDate($dateTime);

        // Return JSON response with meeting hours
        return new JsonResponse($meetingHours);
    }
}
