<?php

namespace Paul\TimelineBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Paul\TimelineBundle\Entity\Post;
use Paul\TimelineBundle\Form\Type\PostType;
use Symfony\Component\HttpFoundation\Request;

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
        return $this->render('PaulTimelineBundle:Post:list.html.twig');
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request)
    {
        $post = new Post();
        $form = $this->createForm(new PostType(), $post);

        if ('POST' == $request->getMethod()) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();

                $em->persist($post);
                $em->flush();
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
}
