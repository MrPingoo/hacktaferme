<?php

namespace App\Controller;

use App\Entity\Parcelle;
use App\Entity\Product;
use App\Entity\Work;
use App\Entity\WorkParcelle;
use App\Entity\WorkProduct;
use App\Form\WorkType;
use App\Form\WorkEditType;
use App\Repository\WorkRepository;
use Doctrine\DBAL\Types\FloatType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/work")
 */
class WorkController extends AbstractController
{

    CONST PREVISION = 0;
    CONST EN_COURS = 1;
    CONST FINALISE = 2;
    CONST VALIDE = 3;
    CONST TRANSMIS = 4;

    /**
     * @Route("/", name="work_index", methods="GET")
     */
    public function index(WorkRepository $workRepository): Response
    {
        return $this->render('work/index.html.twig', ['works' => $workRepository->findAll()]);
    }

    /**
     * @Route("/new", name="work_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $work = new Work();
        $form = $this->createForm(WorkType::class, $work);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($work);
            $em->flush();

            return $this->redirectToRoute('work_index');
        }

        return $this->render('work/new.html.twig', [
            'work' => $work,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="work_show", methods="GET")
     */
    public function show(Work $work): Response
    {
        return $this->render('work/show.html.twig', ['work' => $work]);
    }

    /**
     * @Route("/{id}/edit", name="work_edit", methods="GET|POST")
     */
    public function edit(Request $request, Work $work): Response
    {
        $defaultData = array('message' => 'Type your message here');

        $form = $this->createForm(WorkEditType::class, $work);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('work_edit', ['id' => $work->getId()]);
        }

        return $this->render('work/edit.html.twig', [
            'work' => $work,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/delete", name="work_delete")
     */
    public function delete(Request $request, Work $work): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($work);
        $em->flush();

        return $this->redirectToRoute('work_index');
    }

    /**
     * @Route("/step/1/", name="work_step_un", methods="GET|POST")
     *
     */
    public function stepUnSansID(Request $request): Response
    {
        $work = new Work();
        $defaultData = array('message' => '');
        $form = $this->createFormBuilder($defaultData)
            ->add('product', HiddenType::class)
            ->add('send', SubmitType::class)
            ->getForm();
        $form->handleRequest($request);
        $workProduct = $this->stepUn($request, $work, $form);

        if($workProduct){
            return $this->redirectToRoute('work_step_deux', ['id' => $work->getId(), 'workproduct' => $workProduct->getId()]);
        } else {
            return $this->render('work/step_1.html.twig', [
                'work' => $work,
                'form' => $form->createView(),
            ]);
        }
    }

    /**
     * @Route("/step/1/{id}", name="work_step_un_avec_id", methods="GET|POST")
     */
    public function stepUnAvecID(Request $request, Work $work)
    {
        $defaultData = array('message' => '');
        $form = $this->createFormBuilder($defaultData)
            ->add('product', HiddenType::class)
            ->add('send', SubmitType::class)
            ->getForm();
        $form->handleRequest($request);
        $workProduct = $this->stepUn($request, $work, $form);

        if($workProduct){
            return $this->redirectToRoute('work_step_deux', ['id' => $work->getId(), 'workproduct' => $workProduct->getId()]);
        } else {
            return $this->render('work/step_1.html.twig', [
                'work' => $work,
                'form' => $form->createView()
            ]);
        }

    }

    public function stepUn(Request $request, $work, $form)
    {
        // $form = $this->createForm(WorkType::class, $work);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            /*$product = $this->getDoctrine()
                ->getRepository(Product::class)
                ->findOneBy(['code' => $data['product']]);

            if (!$product) {
                return $this->redirectToRoute('product_new', ['code' => $data['product']]);
            } else {*/
                $work->setStatus(0);
                $work->setDateBegin(new \DateTime());
                $work->setIdFMIS(0);
                $em = $this->getDoctrine()->getManager();
                $em->persist($work);
                $em->flush();

                $skip = false;
                // Case Menthe
                    $product = $this->getDoctrine()
                        ->getRepository(Product::class)
                        ->findOneBy(['code' => '3092718618735']);

                    $exists = $this->getDoctrine()
                        ->getRepository(WorkProduct::class)
                        ->findOneBy(['work' => $work, 'product' => $product]);

                    if(!$exists){
                        /** @var $work Work */
                        $workProduct = new WorkProduct();
                        /** @var $product Product */
                        $workProduct->setProduct($product);
                        $workProduct->setWork($work);
                        $workProduct->setQuantity($product->getQuantity());
                        $em->persist($workProduct);
                        $em->flush();

                        $skip = true;
                    }

                if(!$skip){
                    // Case Sucre de canne
                    $product = $this->getDoctrine()
                        ->getRepository(Product::class)
                        ->findOneBy(['code' => '3250390218975']);

                    $exists = $this->getDoctrine()
                        ->getRepository(WorkProduct::class)
                        ->findOneBy(['work' => $work, 'product' => $product]);

                    if(!$exists){
                        /** @var $work Work */
                        $workProduct = new WorkProduct();
                        /** @var $product Product */
                        $workProduct->setProduct($product);
                        $workProduct->setWork($work);
                        $workProduct->setQuantity($product->getQuantity());
                        $em->persist($workProduct);
                        $em->flush();

                        $skip = true;
                    }
                }

                if(!$skip){
                    // Case Rhum
                    $product = $this->getDoctrine()
                        ->getRepository(Product::class)
                        ->findOneBy(['code' => '3012991302039']);

                    $exists = $this->getDoctrine()
                        ->getRepository(WorkProduct::class)
                        ->findOneBy(['work' => $work, 'product' => $product]);

                    if(!$exists){
                        /** @var $work Work */
                        $workProduct = new WorkProduct();
                        /** @var $product Product */
                        $workProduct->setProduct($product);
                        $workProduct->setWork($work);
                        $workProduct->setQuantity($product->getQuantity());
                        $em->persist($workProduct);
                        $em->flush();

                        $skip = true;
                    }
                }

                if(!$skip){
                    // Case Limonade
                    $product = $this->getDoctrine()
                        ->getRepository(Product::class)
                        ->findOneBy(['code' => '3551720022683']);

                    $exists = $this->getDoctrine()
                        ->getRepository(WorkProduct::class)
                        ->findOneBy(['work' => $work, 'product' => $product]);

                    if(!$exists){
                        /** @var $work Work */
                        $workProduct = new WorkProduct();
                        /** @var $product Product */
                        $workProduct->setProduct($product);
                        $workProduct->setWork($work);
                        $workProduct->setQuantity($product->getQuantity());
                        $em->persist($workProduct);
                        $em->flush();

                        $skip = true;
                    }
                }

                return $workProduct;
            //}
        }
        return null;
    }


    /**
     * @Route("/step/2/{id}/{workproduct}", name="work_step_deux", methods="GET|POST")
     */
    public function stepDeux(Request $request, Work $work, WorkProduct $workproduct): Response
    {
        $work->setStatus(self::EN_COURS);
        $work->setDateBegin(new \DateTime());
        $work->setIdFMIS(0);
        $em = $this->getDoctrine()->getManager();
        $em->persist($work);
        $em->flush();

        $product = $workproduct->getProduct();

        // $form = $this->createForm(WorkType::class, $work);
        $defaultData = array('message' => '');

        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->findOneBy(['id' => $workproduct->getProduct()->getId()]);
        $form = $this->createFormBuilder($defaultData)
            //->add('quantity', NumberType::class, ['data' => $product->getQuantity()])
            ->add('new', SubmitType::class)
            ->add('next', SubmitType::class)
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            /** @var $work Work */
            //$workproduct->setQuantity($data['quantity']);
            //$em->persist($workproduct);
            //$em->flush();

            if ('new' === $form->getClickedButton()->getName()) {
                return $this->redirectToRoute('work_step_un_avec_id', ['id' => $work->getId()]);
            } else {
                return $this->redirectToRoute('work_step_trois', ['id' => $work->getId()]);
            }
        }

        return $this->render('work/step_2.html.twig', [
            'work' => $work,
            'form' => $form->createView(),
            'product' => $product
        ]);
    }

    /**
     * @Route("/step/3/{id}/", name="work_step_trois", methods="GET|POST")
     */
    public function stepTrois(Request $request, Work $work): Response
    {
        $parcelles = $this->getDoctrine()
            ->getRepository(Parcelle::class)
            ->findAll();

        foreach ($parcelles as $p) {
            $arrayOfBoundaries[] = json_decode($p->getCoordinates());
        }

        $parcelle = $this->getDoctrine()
            ->getRepository(Parcelle::class)
            ->findOneBy(['id' => 1]);

        $defaultData = ['message' => ''];
        $form = $this->createFormBuilder($defaultData)
            ->add('parcelle', HiddenType::class, ['data' => $parcelle->getId()])
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $data = $form->getData();
            /** @var $workParcelle WorkParcelle */
            $workParcelle = new WorkParcelle();
            $workParcelle->setParcelle($parcelle);
            $workParcelle->setWork($work);
            $workParcelle->setSurface($parcelle->getSurface());
            $em->persist($workParcelle);
            $em->flush();

            return $this->redirectToRoute('work_step_quatre', ['id' => $work->getId()]);
        }

        return $this->render('work/step_3.html.twig', [
            'work' => $work,
            'form' => $form->createView(),
            'parcelle' => $parcelle,
            'boundaries' => $arrayOfBoundaries
        ]);
    }

    /**
     * @Route("/step/4/{id}/", name="work_step_quatre", methods="GET|POST")
     */
    public function stepQuatre(Request $request, Work $work): Response
    {
        $parcelle = $this->getDoctrine()
            ->getRepository(Parcelle::class)
            ->findOneBy(['id' => 1]);

        $parcelles = $this->getDoctrine()
            ->getRepository(Parcelle::class)
            ->findAll();

        $parcelle = $this->getDoctrine()
            ->getRepository(Parcelle::class)
            ->findOneBy(['id' => 1]);

        foreach ($parcelles as $p) {
            $arrayOfBoundaries[] = json_decode($p->getCoordinates());
        }

        return $this->render('work/step_4.html.twig', [
            'work' => $work,
            'parcelle' => $parcelle,
            'boundaries' => $arrayOfBoundaries
        ]);
    }

    /**
     * @Route("/step/5/{id}/", name="work_step_cinq", methods="GET|POST")
     */
    public function stepCinq(Request $request, Work $work): Response
    {
        $em = $this->getDoctrine()->getManager();
        $work->setStatus(self::FINALISE);
        $em->persist($work);
        $em->flush();

        return $this->render('work/step_6.html.twig', [
            'work' => $work
        ]);
    }


    /**
     * @Route("/step/5/{id}/", name="work_step_cinq", methods="GET|POST")
     */
    /*public function stepCinq(Request $request, Work $work): Response
    {

        return $this->render('work/step_5.html.twig', [
            'work' => $work
        ]);
    }*/
}
