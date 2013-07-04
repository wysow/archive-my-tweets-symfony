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

        $tweets = $this->getDoctrine()
            ->getRepository('WysowArchiveMyTweetsBundle:Tweet')->findAllByCreatedAtDesc();

        $favorited = $this->getDoctrine()
            ->getRepository('WysowArchiveMyTweetsBundle:Tweet')->findByFavorited(true);

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
            'total' => count($tweets),
            'totalFavorited' => count($favorited),
            'tweetsByMonths' => $tweetsByMonths,
            'totalClients' => $totalClients,
            'clients' => $clients,
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
            ->getRepository('WysowArchiveMyTweetsBundle:Tweet')->findByFavorited(true);

        $totalClients = $this->getDoctrine()
            ->getRepository('WysowArchiveMyTweetsBundle:Tweet')->getTotalClients();

        $clients = $this->getDoctrine()
            ->getRepository('WysowArchiveMyTweetsBundle:Tweet')->getClients();

        $searchTerm = null;

        return array(
            'gravatarEmail' => $this->get('service_container')
                ->getParameter('gravatar_email'),
            'searchTerm' => $searchTerm,
            'tweets' => $tweets,
            'total' => count($allTweets),
            'totalFavorited' => count($tweets),
            'tweetsByMonths' => $tweetsByMonths,
            'totalClients' => $totalClients,
            'clients' => $clients,
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

        $totalClients = $this->getDoctrine()
            ->getRepository('WysowArchiveMyTweetsBundle:Tweet')->getTotalClients();

        $clients = $this->getDoctrine()
            ->getRepository('WysowArchiveMyTweetsBundle:Tweet')->getClients();

        $searchTerm = null;

        return array(
            'gravatarEmail' => $this->get('service_container')
                ->getParameter('gravatar_email'),
            'searchTerm' => $searchTerm,
            'tweets' => $tweets,
            'total' => count($allTweets),
            'totalFavorited' => count($favorited),
            'tweetsByMonths' => $tweetsByMonths,
            'totalClients' => $totalClients,
            'clients' => $clients,
            'monthYearDate' => $monthYearDate,
        );
    }
}
