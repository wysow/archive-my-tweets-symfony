<?php

namespace Wysow\ArchiveMyTweetsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use \DateTime;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        $tweetsByMonths = $this->getDoctrine()
            ->getRepository('WysowArchiveMyTweetsBundle:Tweet')->getTweetsByMonths();

        $searchTerm = null;

        if($this->getRequest()->query->has('q')) {
            $allTweets = $this->getDoctrine()
                ->getRepository('WysowArchiveMyTweetsBundle:Tweet')->findAllByCreatedAtDesc();

            $searchTerm = $this->getRequest()->query->get('q');

            // searching in tweets
            $tweets = $this->getDoctrine()
                ->getRepository('WysowArchiveMyTweetsBundle:Tweet')->getSearchResults($searchTerm);
        } else {
            $tweets = $this->getDoctrine()
                ->getRepository('WysowArchiveMyTweetsBundle:Tweet')->findAllByCreatedAtDesc();
        }

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $tweets,
            $this->get('request')->query->get('page', 1),
            30
        );
        $pagination->setTemplate('WysowArchiveMyTweetsBundle::pagination.html.twig');

        $favorited = $this->getDoctrine()
            ->getRepository('WysowArchiveMyTweetsBundle:Tweet')->findByFavorited(true);

        $totalClients = $this->getDoctrine()
            ->getRepository('WysowArchiveMyTweetsBundle:Tweet')->getTotalClients();

        $clients = $this->getDoctrine()
            ->getRepository('WysowArchiveMyTweetsBundle:Tweet')->getClients();

        return array(
            'gravatarEmail' => $this->get('service_container')
                ->getParameter('wysow_archive_my_tweets.gravatar.email'),
            'searchTerm' => $searchTerm,
            'tweets' => $tweets,
            'total' => isset($allTweets) ? count($allTweets) : count($tweets),
            'totalFavorited' => count($favorited),
            'tweetsByMonths' => $tweetsByMonths,
            'totalClients' => $totalClients,
            'clients' => $clients,
            'pagination' => $pagination
        );
    }

    /**
     * @Route("/favorites")
     * @Template()
     */
    public function favoritesAction()
    {
        $tweetsByMonths = $this->getDoctrine()
            ->getRepository('WysowArchiveMyTweetsBundle:Tweet')->getTweetsByMonths();

        $allTweets = $this->getDoctrine()
            ->getRepository('WysowArchiveMyTweetsBundle:Tweet')->findAllByCreatedAtDesc();

        $tweets = $this->getDoctrine()
            ->getRepository('WysowArchiveMyTweetsBundle:Tweet')->findAllByCreatedAtDesc(true);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $tweets,
            $this->get('request')->query->get('page', 1),
            30
        );
        $pagination->setTemplate('WysowArchiveMyTweetsBundle::pagination.html.twig');

        $totalClients = $this->getDoctrine()
            ->getRepository('WysowArchiveMyTweetsBundle:Tweet')->getTotalClients();

        $clients = $this->getDoctrine()
            ->getRepository('WysowArchiveMyTweetsBundle:Tweet')->getClients();

        $searchTerm = null;

        return array(
            'gravatarEmail' => $this->get('service_container')
                ->getParameter('wysow_archive_my_tweets.gravatar.email'),
            'searchTerm' => $searchTerm,
            'tweets' => $tweets,
            'total' => count($allTweets),
            'totalFavorited' => count($tweets),
            'tweetsByMonths' => $tweetsByMonths,
            'totalClients' => $totalClients,
            'clients' => $clients,
            'pagination' => $pagination
        );
    }

    /**
     * @Route("/archive/{year}/{month}")
     * @Template()
     */
    public function archiveAction($year, $month)
    {
        $monthYearDate = new DateTime($year.'-'.$month.'-01');
        $tweetsByMonths = $this->getDoctrine()
            ->getRepository('WysowArchiveMyTweetsBundle:Tweet')->getTweetsByMonths();

        $allTweets = $this->getDoctrine()
            ->getRepository('WysowArchiveMyTweetsBundle:Tweet')->findAllByCreatedAtDesc();

        $favorited = $this->getDoctrine()
            ->getRepository('WysowArchiveMyTweetsBundle:Tweet')->findByFavorited(true);

        $tweets = $this->getDoctrine()
            ->getRepository('WysowArchiveMyTweetsBundle:Tweet')->findByYearAndMonth($year, $month);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $tweets,
            $this->get('request')->query->get('page', 1),
            30
        );
        $pagination->setTemplate('WysowArchiveMyTweetsBundle::pagination.html.twig');

        $totalClients = $this->getDoctrine()
            ->getRepository('WysowArchiveMyTweetsBundle:Tweet')->getTotalClients();

        $clients = $this->getDoctrine()
            ->getRepository('WysowArchiveMyTweetsBundle:Tweet')->getClients();

        $searchTerm = null;

        return array(
            'gravatarEmail' => $this->get('service_container')
                ->getParameter('wysow_archive_my_tweets.gravatar.email'),
            'searchTerm' => $searchTerm,
            'tweets' => $tweets,
            'total' => count($allTweets),
            'totalFavorited' => count($favorited),
            'tweetsByMonths' => $tweetsByMonths,
            'totalClients' => $totalClients,
            'clients' => $clients,
            'monthYearDate' => $monthYearDate,
            'pagination' => $pagination
        );
    }

    /**
     * @Route("/client/{client}")
     * @Template()
     */
    public function clientAction($client)
    {
        $tweetsByMonths = $this->getDoctrine()
            ->getRepository('WysowArchiveMyTweetsBundle:Tweet')->getTweetsByMonths();

        $allTweets = $this->getDoctrine()
            ->getRepository('WysowArchiveMyTweetsBundle:Tweet')->findAllByCreatedAtDesc();

        $favorited = $this->getDoctrine()
            ->getRepository('WysowArchiveMyTweetsBundle:Tweet')->findByFavorited(true);

        $tweets = $this->getDoctrine()
            ->getRepository('WysowArchiveMyTweetsBundle:Tweet')->findAllByClient($client);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $tweets,
            $this->get('request')->query->get('page', 1),
            30
        );
        $pagination->setTemplate('WysowArchiveMyTweetsBundle::pagination.html.twig');

        $totalClients = $this->getDoctrine()
            ->getRepository('WysowArchiveMyTweetsBundle:Tweet')->getTotalClients();

        $clients = $this->getDoctrine()
            ->getRepository('WysowArchiveMyTweetsBundle:Tweet')->getClients();

        $searchTerm = null;

        return array(
            'gravatarEmail' => $this->get('service_container')
                ->getParameter('wysow_archive_my_tweets.gravatar.email'),
            'searchTerm' => $searchTerm,
            'tweets' => $tweets,
            'total' => count($allTweets),
            'totalFavorited' => count($favorited),
            'tweetsByMonths' => $tweetsByMonths,
            'totalClients' => $totalClients,
            'clients' => $clients,
            'clientName' => $client,
            'pagination' => $pagination
        );
    }
}
