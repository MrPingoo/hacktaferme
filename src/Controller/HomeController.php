<?php

// src/Controller/HomeController.php
namespace App\Controller;

use App\Entity\Parcelle;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Data\VoiceRSS;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_site")
     */
    public function home()
    {
        return $this->render('home.html.twig');
    }

    /**
     * @Route("/test", name="app_site_test")
     */
    public function test(Request $request)
    {
        return $this->render('test.html.twig');
    }

    /**
     * @Route("/parcellaire", name="app_site_parcellaire")
     */
    public function parcellaire(Request $request)
    {
        $parcelles = $this->getDoctrine()
            ->getRepository(Parcelle::class)
            ->findAll();

        foreach ($parcelles as $p) {
            $arrayOfBoundaries[] = json_decode($p->getCoordinates());
        }

        return $this->render('parcellaire.html.twig', [
            'parcelles' => $parcelles,
            'boundaries' => $arrayOfBoundaries
        ]);
    }

    /**
     * @Route("/mon-compte", name="app_site_compte")
     */
    public function compte(Request $request)
    {
        return $this->render('moncompte.html.twig');
    }

    /**
     * @Route("/voice", name="app_site_voice")
     */
    public function voice(Request $request)
    {
        $phrase = $request->get('tts');
        $tts = new VoiceRSS();
        $voice = $tts->speech([
            'key' => '423d0edfd6194fd386c8c32d32b991ff',
            'hl' => 'fr-fr',
            'src' => $phrase,
            'r' => '0',
            'c' => 'mp3',
            'f' => '44khz_16bit_stereo',
            'ssml' => 'false',
            'b64' => 'true'
        ]);

        return new Response('<audio src="' . $voice['response'] . '" autoplay="autoplay"></audio>');
        //return $this->render('test.html.twig');
    }
}