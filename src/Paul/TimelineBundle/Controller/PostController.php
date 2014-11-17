<?php

namespace Paul\TimelineBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Paul\TimelineBundle\Entity\Post;
use Paul\TimelineBundle\Form\Type\PostType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


/**
 * Class PostController
 * @author Mackendy <aaa@aaa.com>
 * @package Paul\TimelineBundle\Controller
 */
class PostController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction()
    {
        $post = $this->getDoctrine()
                    ->getManager()
                    ->getRepository('PaulTimelineBundle:Post')
                    ->findBy(array('published'=>TRUE));

        return $this->render('PaulTimelineBundle:Post:list.html.twig',array(
            'posts'=>$post,
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request)
    {
        //je crée un objet
        $post = new Post();
        // je crée mon formulaire et je le lie à mon objet
        $form = $this->createForm(new PostType(), $post);

        //Je vérifie que ma methode est un POST
        if ('POST' == $request->getMethod()) {
            // le formulaire attrape la requete
            $form->handleRequest($request);
            // je verifie que mon post est valid
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                // add automatiquement l'author (username) à l'entité post
                $userManager = $this->container->get('fos_user.user_manager');
                $user = $userManager->findUserByUsername($this->container->get('security.context')
                    ->getToken()
                    ->getUser());
                $post->setAuthor($user);

                $em->persist($post);
                $em->flush();
                // Je renvoie un message de succes
                $this->get('session')->getFlashBag()->add('success', 'Le post a bien été enregistrer.');
                return $this->redirect($this->generateUrl('post_list'));
            } else {
                $this->get('session')->getFlashBag()->add('error', 'Veuillez corriger vos erreur');
                // var_dump($form->getErrorsAsString());
            }
        }

        return $this->render('PaulTimelineBundle:Post:create.html.twig', array(
            'form' => $form->createView(),
            'post' => $post,
        ));
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewAction(Post $post)
    {
        return $this->render('PaulTimelineBundle:Post:view.html.twig',array(
            'post'=> $post,
        ));
    }
}
