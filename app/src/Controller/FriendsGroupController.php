<?php

namespace App\Controller;

use App\Entity\FriendsGroup;
use App\Form\FriendsGroupType;
use App\Repository\FriendsGroupRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/friends/group")
 */
class FriendsGroupController extends AbstractController
{
    /**
     * @Route("/", name="friends_group_index", methods={"GET"})
     */
    public function index(FriendsGroupRepository $friendsGroupRepository): Response
    {
        return $this->render('friends_group/index.html.twig', [
            'friends_groups' => $friendsGroupRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="friends_group_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $friendsGroup = new FriendsGroup();
        $form = $this->createForm(FriendsGroupType::class, $friendsGroup);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($friendsGroup);
            $entityManager->flush();

            return $this->redirectToRoute('friends_group_index');
        }

        return $this->render('friends_group/new.html.twig', [
            'friends_group' => $friendsGroup,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="friends_group_show", methods={"GET"})
     */
    public function show(FriendsGroup $friendsGroup): Response
    {
        return $this->render('friends_group/show.html.twig', [
            'friends_group' => $friendsGroup,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="friends_group_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, FriendsGroup $friendsGroup): Response
    {
        $form = $this->createForm(FriendsGroupType::class, $friendsGroup);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('friends_group_index');
        }

        return $this->render('friends_group/edit.html.twig', [
            'friends_group' => $friendsGroup,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="friends_group_delete", methods={"DELETE"})
     */
    public function delete(Request $request, FriendsGroup $friendsGroup): Response
    {
        if ($this->isCsrfTokenValid('delete'.$friendsGroup->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($friendsGroup);
            $entityManager->flush();
        }

        return $this->redirectToRoute('friends_group_index');
    }
}
