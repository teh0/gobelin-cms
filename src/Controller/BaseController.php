<?php


namespace App\Controller;


use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;

class BaseController extends AbstractController
{
    protected function validateAndSubmittedForm(FormInterface $form)
    {
        return $form->isSubmitted() && $form->isValid();
    }

    protected function getEntityManager(): ObjectManager
    {
        return $this->getDoctrine()->getManager();
    }
}