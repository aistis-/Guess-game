<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Question;
use AppBundle\Form\Type\QuestionType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Question controller.
 */
class QuestionController extends Controller
{
    /**
     * Index and new game action.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/", name="new_game")
     */
    public function indexAction()
    {
        return $this->render(':questions:new_game.html.twig');
    }

    /**
     * Main game action.
     *
     * @param Question $question
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/game", name="game_start")
     * @Route("/game/{question}", name="game", requirements={"question": "\d+"})
     */
    public function gameAction(Question $question = null)
    {
        if (null === $question) {

            // Hard coded first question id
            $question = $this->getDoctrine()->getRepository('AppBundle:Question')->find(1);

            if (null === $question) {
                return $this->redirect($this->generateUrl('new_question'));
            }
        }

        return $this->render(':questions:ask.html.twig', ['question' => $question]);
    }

    /**
     * Guess action.
     *
     * @param Question $question
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/game/{question}/guess", name="guess", requirements={"question": "\d+"})
     */
    public function guessAction(Question $question)
    {
        return $this->render(':questions:guess.html.twig', ['question' => $question]);
    }

    /**
     * New question create action.
     *
     * @param Request $request
     * @param Question $question
     * @param boolean $answeredYes
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/question/{question}/{answeredYes}", name="new_question",
     *      defaults={"question" = null, "answeredYes" = true}
     * )
     */
    public function newQuestionAction(Request $request, $question, $answeredYes)
    {
        $form = $this->createForm(new QuestionType());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newQuestion = $form->getData();

            $question = $this->getDoctrine()->getRepository('AppBundle:Question')->find($question);

            if (null !== $question) {
                $answeredYes = (bool) $answeredYes;

                dump($question);

                if ($answeredYes) {
                    $question->setNextQuestionYes($newQuestion);
                } else {
                    $question->setNextQuestionNo($newQuestion);
                }
            }

            $this->getDoctrine()->getManager()->persist($newQuestion);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirect($this->generateUrl('new_game'));
        }

        return $this->render(':questions:new_question.html.twig', ['form' => $form->createView()]);
    }
}
