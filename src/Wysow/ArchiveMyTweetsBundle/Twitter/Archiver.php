<?php

namespace Wysow\ArchiveMyTweetsBundle\Twitter;

use TijsVerkoyen\Twitter\Twitter as TwitterBase;
use Wysow\ArchiveMyTweetsBundle\Entity\Tweet;
use Doctrine\ORM\EntityManager;

class Archiver {

    private $twitter, $username, $em;

    public function __construct(TwitterBase $twitter, $oauthToken, $oauthSecret, EntityManager $em, $username)
    {
        $this->twitter = $twitter;
        $this->twitter->setOAuthToken($oauthToken);
        $this->twitter->setOAuthTokenSecret($oauthSecret);

        $this->em = $em;
        $this->username = $username;
    }

    public function archive() {
        // this should use a maximum of 16 API calls if the user has 3200+ tweets

        // api params
        $maxId              = null;
        $sinceId            = null;
        $userId             = null; // not needed if using screen name
        $screenName         = $this->username;
        $count              = 200;
        $trimUser           = null;
        $excludeReplies     = false;
        $contributorDetails = true;
        $includeRts         = true;

        // loop variables
        $str            = '';
        $page           = 1;
        $gotResults     = true;
        $apiCalls       = 0;
        $tweetsFound    = 0;
        $numAdded       = 0;
        $exceptionCount = 0;
        $numTweetsAdded = 0;
        $numExceptions  = 0;
        $maxExceptions  = 25; // don't get stuck in the loop if twitter is down

        while ($gotResults) {
            try {
                $tweetResults = $this->twitter->statusesUserTimeline($userId, $screenName, $sinceId, $count, $maxId, $trimUser, $excludeReplies, $contributorDetails, $includeRts);
                $apiCalls++;

                $numResults = count($tweetResults);
                $tweetsFound += $numResults;

                if ($numResults == 0) {
                    $str .= 'NO tweets on page ' . $page . ", exiting.\n";
                    $gotResults = false;
                } else {

                    $newestTweet = $tweetResults[0];
                    $oldestTweet = end($tweetResults);

                    $str .= $numResults . ' tweets on page ' . $page . " (oldest: ".$oldestTweet['id'].", newest: ".$newestTweet['id'].")\n";

                    $page++;

                    // add these tweets to the database
                    foreach ($tweetResults as $t) {
                        $tweet = new Tweet();
                        $tweet->loadArray($t);
                        $this->em->merge($tweet);
                    }
                    $this->em->flush();

                    if ($numResults === false) {
                        $str .= 'ERROR INSERTING TWEETS INTO DATABASE';
                    } else if ( $numResults == 0 ) {
                        $str .= 'Zero tweets added.' . "\n";
                    } else {
                        $str .= $numResults . ' tweets added.' . "\n";
                        $numAdded += $numResults;
                    }

                    // set max ID to the ID of the oldest tweet we've received, minus 1
                    // be mindful of 32 bit platforms
                    $maxId = $this->decrement64BitInteger($oldestTweet['id']);

                }

                // check if we've reached the rate limit
                $rate = $this->twitter->applicationRateLimitStatus();
                if(isset($rate['remaining']) && isset($rate['limit'])) {
                    $str .= $rate['remaining'] . '/' . $rate['limit'] . "\n";
                    if ($rate['remaining'] <= 0) {
                        $str .= 'API limit reached. Try again later.' . "\n";
                        $gotResults = false;
                    }
                }
            } catch (\Exception $e) {
                $str .= 'Exception: ' . $e->getMessage() . "\n";

                $numExceptions++;

                // break out to avoid infinite looping while twitter is down
                if ($numExceptions >= $maxExceptions) {
                    $str .= 'Too many connection errors. Twitter may be down. Try again later.' . "\n";
                    $gotResults = false;
                }
            }
        }

        $str .= $apiCalls . ' API calls, ' . $tweetsFound . ' tweets found, '.$numAdded.' tweets saved' . "\n";

        return $str;
    }

    public function archiveFavorites()
    {
        // this should use a maximum of 16 API calls if the user has 3200+ tweets

        // api params
        $maxId              = null;
        $sinceId            = null;
        $userId             = null; // not needed if using screen name
        $screenName         = $this->username;
        $count              = 200;
        $trimUser           = null;
        $excludeReplies     = false;
        $contributorDetails = true;
        $includeRts         = true;
        $includeEntities    = true;

        // loop variables
        $str            = '';
        $page           = 1;
        $gotResults     = true;
        $apiCalls       = 0;
        $tweetsFound    = 0;
        $numAdded       = 0;
        $exceptionCount = 0;
        $numTweetsAdded = 0;
        $numExceptions  = 0;
        $maxExceptions  = 25; // don't get stuck in the loop if twitter is down

        while ($gotResults) {
            try {
                $tweetResults = $this->twitter->favoritesList($userId, $screenName, $count, $sinceId, $maxId, $includeEntities);
                $apiCalls++;

                $numResults = count($tweetResults);
                $tweetsFound += $numResults;

                if ($numResults == 0) {
                    $str .= 'NO FAVORITES tweets on page ' . $page . ", exiting.\n";
                    $gotResults = false;
                } else {
                    $newestTweet = $tweetResults[0];
                    $oldestTweet = end($tweetResults);

                    $str .= $numResults . ' favorites tweets on page ' . $page . " (oldest: ".$oldestTweet['id'].", newest: ".$newestTweet['id'].")\n";

                    $page++;

                    // add these tweets to the database
                    foreach ($tweetResults as $t) {
                        $tweet = new Tweet();
                        $tweet->loadArray($t);
                        $this->em->merge($tweet);
                    }
                    $this->em->flush();

                    if ($numResults === false) {
                        $str .= 'ERROR INSERTING FAVORITES TWEETS INTO DATABASE';
                    } else if ( $numResults == 0 ) {
                        $str .= 'Zero favorites tweets added.' . "\n";
                    } else {
                        $str .= $numResults . ' favorites tweets added.' . "\n";
                        $numAdded += $numResults;
                    }

                    // set max ID to the ID of the oldest tweet we've received, minus 1
                    // be mindful of 32 bit platforms
                    $maxId = $this->decrement64BitInteger($oldestTweet['id']);

                }

                // check if we've reached the rate limit
                $rate = $this->twitter->applicationRateLimitStatus();
                if(isset($rate['remaining']) && isset($rate['limit'])) {
                    $str .= $rate['remaining'] . '/' . $rate['limit'] . "\n";
                    if ($rate['remaining'] <= 0) {
                        $str .= 'API limit reached. Try again later.' . "\n";
                        $gotResults = false;
                    }
                }
            } catch (\Exception $e) {
                $str .= 'Exception: ' . $e->getMessage() . "\n";

                $numExceptions++;

                // break out to avoid infinite looping while twitter is down
                if ($numExceptions >= $maxExceptions) {
                    $str .= 'Too many connection errors. Twitter may be down. Try again later.' . "\n";
                    $gotResults = false;
                }
            }
        }

        $str .= $apiCalls . ' API calls, ' . $tweetsFound . ' favorites tweets found, '.$numAdded.' favorites tweets saved' . "\n";

        return $str;
    }

    /**
     * Subtracts 1 from the given integer, with support for 32 bit systems.
     * Note the return value is a string and not an int.
     *
     *
     * @param string $int A positive, non-zero integer represented as a string.
     * @return string
     */
    public function decrement64BitInteger($int) {

        if (PHP_INT_SIZE == 8) {
            return (string) ((int)$int - 1);
        } else {

            $str = (string) $int;

            // 1 and 0 are special cases with this method
            if ($str == 1 || $str == 0) return (string) ($str - 1);

                // Determine if number is negative
                $negative = $str[0] == '-';

                // Strip sign and leading zeros
                $str = ltrim($str, '0-+');

                // Loop characters backwards
                for ($i = strlen($str) - 1; $i >= 0; $i--) {

                if ($negative) { // Handle negative numbers

                    if ($str[$i] < 9) {
                        $str[$i] = $str[$i] + 1;
                        break;
                    } else {
                        $str[$i] = 0;
                    }

                } else { // Handle positive numbers

                    if ($str[$i]) {
                        $str[$i] = $str[$i] - 1;
                        break;
                    } else {
                        $str[$i] = 9;
                    }

                }

            }

            return ($negative ? '-' : '').ltrim($str, '0');

        }
    }

    /**
     * Imports tweets from the JSON files in a downloaded Twitter Archive
     *
     * @param string $directory The directory to look for Twitter .js files.
     * @return string Returns a string with informational output.
     * @author awhalen
     */
    public function importJSON($directory) {

        $str = 'Importing from Twitter Archive JS Files...' . "\n";

        if (!is_dir($directory)) {
            return $str . 'Could not import from official Twitter archive. Not a valid directory: ' . $directory . "\n";
        }

        $jsFiles = glob($directory . "/*.js");
        if (count($jsFiles)) {

            // find all JS files and grab the tweets from each one
            foreach ($jsFiles as $filename) {
                $tweets = $this->getTweetsInJsonFile($filename);
                if ($tweets != false) {
                    $numFoundTweets = count($tweets);
                    $plural = ($numFoundTweets == 1) ? '' : 's';
                    $str .= basename($filename) . ': found '.$numFoundTweets.' tweet' . $plural . "\n";

                    // add
                    $numAdded = 0;
                    try {
                        $result = $this->em->flush();
                    } catch(\Doctrine_Exception $e) {
                        if($e->getErrorCode() !== $duplicateKeyCode){
                            throw $e;
                        }
                    }

                    if ($result === false) {
                        $str .= 'ERROR INSERTING INTO DATABASE';
                    } else if ($result == 0) {
                        $str .= 'No new tweets found.' . "\n";
                    } else {
                        $numAdded += $result;
                        $str .= 'Added new tweets: ' . $result . "\n";
                    }

                } else {
                    $str .= $filename . ': No tweets found' . "\n";
                }
            }

            $str .= 'JS import done. Added tweets: ' . $numAdded . "\n";

        } else {

            $str .= 'No Twitter Archive JS files found.' . "\n";

        }

        return $str;

    }

    /**
     * Returns an array of Tweet objects that are populated from a Twitter JSON file.
     *
     * @return array|false
     */
    public function getTweetsInJsonFile($filename) {

        $tweets = array();

        $jsonString = @file_get_contents($filename);
        if ($jsonString === false) {
            return false;
        }

        // the twitter format includes extra JS code, but we just want the JSON array
        $pattern = '/\[.*\]/s';
        $matchError = preg_match($pattern, $jsonString, $matches);
        // $matchError can be zero or false if not found or there was a failure
        if (!$matchError) {
            return false;
        }
        $jsonArrayString = $matches[0];

        $jsonTweets = json_decode($jsonArrayString);
        foreach ($jsonTweets as $tweet) {
            $t = new Tweet();
            $t->loadJsonObject($tweet);
            $this->em->persist($t);
            $tweets[] = $t;
        }

        return $tweets;

    }
}