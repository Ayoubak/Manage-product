<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{

    private $em;
    private $productRepository;
    protected $requestStack;

    public function __construct(EntityManagerInterface $em, ProductRepository $productRepository, RequestStack $requestStack)
    {
        $this->em = $em;
        $this->productRepository = $productRepository;
        $this->requestStack = $requestStack;
    }

    #[Route('/', name: 'app_home', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'products' => $this->productRepository->findAll(),
        ]);
    }

    #[Route('/product/add', name: 'product_create')]
    public function create(): Response
    {
        $form = $this->createForm(ProductType::class);
        $form->handleRequest($this->requestStack->getCurrentRequest());
        if ($form->isSubmitted() && $form->isValid()) {
            $product = $form->getData();
            $this->em->persist($product);
            $this->em->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->render('product/detail.html.twig', [
            'product' => $form->createView(),
            'action' => 'Créer'
        ]);
    }

    #[Route('/product/{id}', name: 'product_update')]
    public function update(Product $product): Response
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($this->requestStack->getCurrentRequest());
        if ($form->isSubmitted() && $form->isValid()) {
            $product = $form->getData();
            $this->em->persist($product);
            $this->em->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->render('product/detail.html.twig', [
            'product' => $form->createView(),
            'action'  => 'Actualiser'
        ]);
    }

    #[Route('/product/delete/{id}', name: 'product_delete')]
    public function delete($id): Response
    {
        $product = $this->productRepository->find($id);
        $this->em->remove($product);
        $this->em->flush();

        return $this->redirectToRoute('app_home');
    }
}
