<?php

namespace Lrt\SiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\DiExtraBundle\Annotation as DI;
use Lrt\SiteBundle\Entity\Article;
use Lrt\SiteBundle\Form\ArticleHandler;
use Lrt\SiteBundle\Form\Type\ArticleType;

/**
 * Article controller.
 *
 * @Route("/article")
 */
class ArticleController extends Controller
{
    /** @DI\Inject("security.context") */
    public $sc;

    /** @DI\Inject("doctrine.orm.entity_manager") */
    public $em;

    /**
     * Lists all Article entities.
     *
     * @Route("/", name="article")
     * @Template()
     */
    public function indexAction()
    {
        $entities = $this->em->getRepository('SiteBundle:Article')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Article entity.
     *
     * @Route("/{id}/show", name="article_show")
     * @Template()
     */
    public function showAction($id)
    {
        $entity = $this->em->getRepository('SiteBundle:Article')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Article entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Article entity.
     *
     * @Route("/new", name="article_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Article();

        $form   = $this->createForm(new ArticleType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Article entity.
     *
     * @Route("/create", name="article_create")
     * @Method("POST")
     * @Template("SiteBundle:Article:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $user = $this->sc->getToken()->getUser();

        $article  = new Article();
        $article->setUser($user);

        $form = $this->createForm(new ArticleType(), $article);

        $formHandler = new ArticleHandler($form, $this->getRequest(), $this->em);

        if($formHandler->process())
        {
            return $this->redirect($this->generateUrl('article_show', array('id' => $article->getId())));
        }

        return array('entity' => $article,'form' => $form->createView());
    }

    /**
     * Displays a form to edit an existing Article entity.
     *
     * @Route("/{id}/edit", name="article_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $entity = $this->em->getRepository('SiteBundle:Article')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Article entity.');
        }

        $editForm = $this->createForm(new ArticleType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Article entity.
     *
     * @Route("/{id}/update", name="article_update")
     * @Method("POST")
     * @Template("SiteBundle:Article:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $entity = $this->em->getRepository('SiteBundle:Article')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Article entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ArticleType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid())
        {
            $this->em->persist($entity);
            $this->em->flush();

            return $this->redirect($this->generateUrl('article_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Article entity.
     *
     * @Route("/{id}/delete", name="article_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {

            $entity = $this->em->getRepository('SiteBundle:Article')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Article entity.');
            }

            $this->em->remove($entity);
            $this->em->flush();
        }

        return $this->redirect($this->generateUrl('article'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
