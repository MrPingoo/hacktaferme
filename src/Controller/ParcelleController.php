<?php

namespace App\Controller;

use App\Entity\Parcelle;
use App\Form\ParcelleType;
use App\Repository\ParcelleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/parcelle")
 */
class ParcelleController extends AbstractController
{
    /**
     * @Route("/", name="parcelle_index", methods="GET")
     */
    public function index(ParcelleRepository $parcelleRepository): Response
    {
        return $this->render('parcelle/index.html.twig', ['parcelles' => $parcelleRepository->findAll()]);
    }

    /**
     * @Route("/new", name="parcelle_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $parcelle = new Parcelle();
        $form = $this->createForm(ParcelleType::class, $parcelle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($parcelle);
            $em->flush();

            return $this->redirectToRoute('parcelle_index');
        }

        return $this->render('parcelle/new.html.twig', [
            'parcelle' => $parcelle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="parcelle_show", methods="GET")
     */
    public function show(Parcelle $parcelle): Response
    {
        return $this->render('parcelle/show.html.twig', ['parcelle' => $parcelle]);
    }

    /**
     * @Route("/{id}/edit", name="parcelle_edit", methods="GET|POST")
     */
    public function edit(Request $request, Parcelle $parcelle): Response
    {
        $form = $this->createForm(ParcelleType::class, $parcelle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('parcelle_edit', ['id' => $parcelle->getId()]);
        }

        return $this->render('parcelle/edit.html.twig', [
            'parcelle' => $parcelle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="parcelle_delete", methods="DELETE")
     */
    public function delete(Request $request, Parcelle $parcelle): Response
    {
        if ($this->isCsrfTokenValid('delete'.$parcelle->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($parcelle);
            $em->flush();
        }

        return $this->redirectToRoute('parcelle_index');
    }
}
