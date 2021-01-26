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
 * @Route("/")
 */
class SiteController extends AbstractController
{
    /**
     * @Route("/", name="site_index", methods={"GET"})
     */
    public function index(): Response
    {
        return $this->render('main/main_page.html.twig');
    }
}