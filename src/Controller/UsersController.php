<?php

namespace App\Controller;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Entity\User;
use App\Entity\Agent;
use App\Form\UserFormType;

use App\Form\AgentFormType;
use App\Repository\AgentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UsersController extends AbstractController
{
    /**
     * @Route("/users", name="users")
     */
    public function index()
    {
        return $this->render('users/index.html.twig');
    }

    /**
     * @Route("/users/psgouv/telechargement", name="users_imprime")
     */
    public function imprime()
    {
        return $this->render('users/psgouv/imprime.html.twig');
    }


    /**
     * @Route("/users/psgouv/inscription", name="users_agent")
     */
    public function ajoutAgent(Request $request, EntityManagerInterface $entityManager)
    {
        $user = new User;
        $user = $this->getUser();
        $form = $this->createForm(UserFormType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //   $agent->setUsers($this->getUser());

            // On récupère les images transmises
            $matricule = $form->get('matricule')->getData();


            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('users_imprime');
        }

        return $this->render('users/psgouv/inscription.html.twig', [
            'form' => $form->createView(),
            'users' => $user
        ]);
    }

    /**
     * @Route("/users/psgouv/edit/{id}", name="users_agent_edit")
     */
    public function editAnnonce(User $user, Request $request, EntityManagerInterface $entityManager)
    {
        $this->denyAccessUnlessGranted('user_edit', $user);
        $form = $this->createForm(UserFormType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // On récupère les images transmises
            $matricule = $form->get('matricule')->getData();


            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('users_imprime');
        }

        return $this->render('users/psgouv/inscription.html.twig', [
            'form' => $form->createView(),
            'user' => $user
        ]);
    }

    /**
     * @Route("/users/data/download", name="users_data_download")
     */
    public function usersDataDownload()
    {
        // On définit les options du PDF
        $pdfOptions = new Options();
        // Police par défaut
        $pdfOptions->set('defaultFont', 'Arial');
        $pdfOptions->setIsRemoteEnabled(true);

        // On instancie Dompdf
        $dompdf = new Dompdf($pdfOptions);
        $context = stream_context_create([
            'ssl' => [
                'verify_peer' => FALSE,
                'verify_peer_name' => FALSE,
                'allow_self_signed' => TRUE
            ]
        ]);
        $dompdf->setHttpContext($context);

        // On génère le html
        $html = $this->renderView('users/download.html.twig');

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // On génère un nom de fichier
        $fichier = 'user-data-' . $this->getUser()->getId() . '.pdf';

        // On envoie le PDF au navigateur
        $dompdf->stream($fichier, [
            'Attachment' => true
        ]);

        return new Response();
    }
}
