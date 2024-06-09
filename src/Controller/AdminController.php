<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ConsultationRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(ConsultationRepository $consultationRepository): Response
    {
        $consultations = $consultationRepository->findAll();

        return $this->render('admin/index.html.twig', [
            'consultations' => $consultations,
        ]);
    }
    #[Route('/admin/{id}', name: 'app_admin_id_consultation')]
    public function getConsultation(ConsultationRepository $consultationRepository, int $id): JsonResponse
    {
        $consultation = $consultationRepository->find($id);

        if (!$consultation) {
            return new JsonResponse(['error' => 'Consultation not found'], Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse([
            'id' => $consultation->getId(),
            'name' => $consultation->getName(),
            'lastName' => $consultation->getLastName(),
            'email' => $consultation->getEmail(),
            'phoneNumber' => $consultation->getPhoneNumber(),
            'profession' => $consultation->getProfession(),
            'postalAddress' => $consultation->getPostalAddress(),
            'city' => $consultation->getCity(),
            'postalCode' => $consultation->getPostalCode(),
            'meetingDate' => $consultation->getMeetingDate()->format('Y-m-d'),
            'meetingHour' => $consultation->getMeetingHour()->format('H:i'),
            'type' => $consultation->getType(),
        ]);
    }


    #[Route('/admin/consultation/{id}', name: 'delete_consultation')]
    public function deleteConsultation(int $id, ConsultationRepository $consultationRepository, EntityManagerInterface $entityManager): Response
    {
        $consultation = $consultationRepository->find($id);

        if ($consultation) {
            $entityManager->remove($consultation);
            $entityManager->flush();
            return $this->redirectToRoute('app_admin');
        }

        return new Response();
    }
}
