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
        $tweetsByMonths = $this->getTweetsByMonths();

        $searchTerm = null;

        if($this->getRequest()->query->has('q') && $this->getRequest()->query->get('q') != '') {
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

        $pagination = $this->getPagination($tweets);

        $favorited = $this->getFavoritedTweets();

        list($totalClients, $clients) = $this->getClientsInfo();

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
            'pagination' => $pagination,
            'totalFollowers' => $this->getTotalFollowers(),
        );
    }

    /**
     * @Route("/favorites")
     * @Template()
     */
    public function favoritesAction()
    {
        $tweetsByMonths = $this->getTweetsByMonths();

        $allTweets = $this->getAllTweets();

        $tweets = $this->getDoctrine()
            ->getRepository('WysowArchiveMyTweetsBundle:Tweet')->findAllByCreatedAtDesc(true);

        $pagination = $this->getPagination($tweets);

        list($totalClients, $clients) = $this->getClientsInfo();

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
            'pagination' => $pagination,
            'totalFollowers' => $this->getTotalFollowers(),
        );
    }

    /**
     * @Route("/archive/{year}/{month}")
     * @Template()
     */
    public function archiveAction($year, $month)
    {
        $monthYearDate = new DateTime($year.'-'.$month.'-01');

        $tweetsByMonths = $this->getTweetsByMonths();

        $allTweets = $this->getAllTweets();

        $favorited = $this->getFavoritedTweets();

        $tweets = $this->getDoctrine()
            ->getRepository('WysowArchiveMyTweetsBundle:Tweet')->findByYearAndMonth($year, $month);

        $pagination = $this->getPagination($tweets);

        list($totalClients, $clients) = $this->getClientsInfo();

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
            'pagination' => $pagination,
            'totalFollowers' => $this->getTotalFollowers(),
        );
    }

    /**
     * @Route("/client/{client}")
     * @Template()
     */
    public function clientAction($client)
    {
        $tweetsByMonths = $this->getTweetsByMonths();

        $allTweets = $this->getAllTweets();

        $favorited = $this->getFavoritedTweets();

        $tweets = $this->getDoctrine()
            ->getRepository('WysowArchiveMyTweetsBundle:Tweet')->findAllByClient($client);

        $pagination = $this->getPagination($tweets);

        list($totalClients, $clients) = $this->getClientsInfo();

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
            'pagination' => $pagination,
            'totalFollowers' => $this->getTotalFollowers(),
        );
    }

    /**
     * @Route("/followers")
     * @Template()
     */
    public function followersAction()
    {
        $followers = $this
            ->getDoctrine()
            ->getRepository('WysowArchiveMyTweetsBundle:Follower')->findAll()
        ;

        $pagination = $this->getPagination($followers);

        $searchTerm = null;

        $tweetsByMonths = $this->getTweetsByMonths();

        $allTweets = $this->getAllTweets();

        $favorited = $this->getFavoritedTweets();

        list($totalClients, $clients) = $this->getClientsInfo();

        return array(
            'gravatarEmail' => $this->get('service_container')
                ->getParameter('wysow_archive_my_tweets.gravatar.email'),
            'searchTerm' => $searchTerm,
            'followers' => $followers,
            'pagination' => $pagination,
            'total' => count($allTweets),
            'totalFavorited' => count($favorited),
            'tweetsByMonths' => $tweetsByMonths,
            'totalClients' => $totalClients,
            'clients' => $clients,
            'totalFollowers' => count($followers),
        );
    }

    private function getTweetsByMonths()
    {
        return $this->getDoctrine()
            ->getRepository('WysowArchiveMyTweetsBundle:Tweet')->getTweetsByMonths();
    }

    private function getAllTweets()
    {
        return $this->getDoctrine()
            ->getRepository('WysowArchiveMyTweetsBundle:Tweet')->findAllByCreatedAtDesc();
    }

    private function getFavoritedTweets()
    {
        return $this->getDoctrine()
            ->getRepository('WysowArchiveMyTweetsBundle:Tweet')->findByFavorited(true);
    }

    private function getPagination($objects)
    {
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $objects,
            $this->get('request')->query->get('page', 1),
            30
        );

        if (isset($objects[0]) && get_class($objects[0]) == 'Wysow\ArchiveMyTweetsBundle\Entity\Tweet') {
            $pagination->setTemplate('WysowArchiveMyTweetsBundle::tweetsPagination.html.twig');
        } else {
            $pagination->setTemplate('WysowArchiveMyTweetsBundle::followersPagination.html.twig');
        }


        return $pagination;
    }

    private function getClientsInfo()
    {
        $totalClients = $this->getDoctrine()
            ->getRepository('WysowArchiveMyTweetsBundle:Tweet')->getTotalClients();

        $clients = $this->getDoctrine()
            ->getRepository('WysowArchiveMyTweetsBundle:Tweet')->getClients();

        return array($totalClients, $clients);
    }

    private function getTotalFollowers()
    {
        $followers = $this
            ->getDoctrine()
            ->getRepository('WysowArchiveMyTweetsBundle:Follower')->findAll()
        ;

        return count($followers);
    }
}
