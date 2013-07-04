<?php

namespace Wysow\ArchiveMyTweetsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tweet
 *
 * @ORM\Table(name="tweets")
 * @ORM\Entity(repositoryClass="Wysow\ArchiveMyTweetsBundle\Entity\TweetRepository")
 */
class Tweet
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="bigint", nullable=false)
     */
    private $userId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var string
     *
     * @ORM\Column(name="tweet", type="string", length=140, nullable=true)
     */
    private $tweet;

    /**
     * @var string
     *
     * @ORM\Column(name="source", type="string", length=255, nullable=true)
     */
    private $source;

    /**
     * @var boolean
     *
     * @ORM\Column(name="truncated", type="boolean", nullable=true)
     */
    private $truncated;

    /**
     * @var boolean
     *
     * @ORM\Column(name="favorited", type="boolean", nullable=true)
     */
    private $favorited;

    /**
     * @var integer
     *
     * @ORM\Column(name="in_reply_to_status_id", type="bigint", nullable=true)
     */
    private $inReplyToStatusId;

    /**
     * @var integer
     *
     * @ORM\Column(name="in_reply_to_user_id", type="bigint", nullable=true)
     */
    private $inReplyToUserId;

    /**
     * @var string
     *
     * @ORM\Column(name="in_reply_to_screen_name", type="string", length=15, nullable=true)
     */
    private $inReplyToScreenName;

    /**
     * Set id
     *
     * @param  integer $id
     * @return Tweets
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set userId
     *
     * @param  integer $userId
     * @return Tweets
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set createdAt
     *
     * @param  \DateTime $createdAt
     * @return Tweets
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set tweet
     *
     * @param  string $tweet
     * @return Tweets
     */
    public function setTweet($tweet)
    {
        $this->tweet = $tweet;

        return $this;
    }

    /**
     * Get tweet
     *
     * @return string
     */
    public function getTweet()
    {
        return $this->tweet;
    }

    /**
     * Set source
     *
     * @param  string $source
     * @return Tweets
     */
    public function setSource($source)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Get source
     *
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Set truncated
     *
     * @param  boolean $truncated
     * @return Tweets
     */
    public function setTruncated($truncated)
    {
        $this->truncated = $truncated;

        return $this;
    }

    /**
     * Get truncated
     *
     * @return boolean
     */
    public function getTruncated()
    {
        return $this->truncated;
    }

    /**
     * Set favorited
     *
     * @param  boolean $favorited
     * @return Tweets
     */
    public function setFavorited($favorited)
    {
        $this->favorited = $favorited;

        return $this;
    }

    /**
     * Get favorited
     *
     * @return boolean
     */
    public function getFavorited()
    {
        return $this->favorited;
    }

    /**
     * Set inReplyToStatusId
     *
     * @param  integer $inReplyToStatusId
     * @return Tweets
     */
    public function setInReplyToStatusId($inReplyToStatusId)
    {
        $this->inReplyToStatusId = $inReplyToStatusId;

        return $this;
    }

    /**
     * Get inReplyToStatusId
     *
     * @return integer
     */
    public function getInReplyToStatusId()
    {
        return $this->inReplyToStatusId;
    }

    /**
     * Set inReplyToUserId
     *
     * @param  integer $inReplyToUserId
     * @return Tweets
     */
    public function setInReplyToUserId($inReplyToUserId)
    {
        $this->inReplyToUserId = $inReplyToUserId;

        return $this;
    }

    /**
     * Get inReplyToUserId
     *
     * @return integer
     */
    public function getInReplyToUserId()
    {
        return $this->inReplyToUserId;
    }

    /**
     * Set inReplyToScreenName
     *
     * @param  string $inReplyToScreenName
     * @return Tweets
     */
    public function setInReplyToScreenName($inReplyToScreenName)
    {
        $this->inReplyToScreenName = $inReplyToScreenName;

        return $this;
    }

    /**
     * Get inReplyToScreenName
     *
     * @return string
     */
    public function getInReplyToScreenName()
    {
        return $this->inReplyToScreenName;
    }

    public function getLinkedTweet()
    {
        // props to: http://davidwalsh.name/linkify-twitter-feed

        // linkify URLs
        $status_text = preg_replace(
            '/(https?:\/\/\S+)/',
            '<a href="\1">\1</a>',
            $this->tweet
        );

        // linkify twitter users
        $status_text = preg_replace(
            '/(^|\s)(@(\w+))/',
            '\1<a href="http://twitter.com/\3">\2</a>',
            $status_text
        );

        // linkify tags
        $status_text = preg_replace(
            '/(^|\s)(#(\S+))/',
            '\1<a href="http://search.twitter.com/search?q=%23\3">\2</a>',
            $status_text
        );

        return $status_text;
    }

    /**
     * Loads this object from an array.
     */
    public function loadArray($t) {
        $this->id = $t['id'];
        $this->userId = $t['user']['id'];
        $this->createdAt = new \DateTime(date('Y-m-d H:i:s', strtotime($t['created_at'])));
        $this->tweet = $t['text'];
        $this->source = $t['source'];
        $this->truncated = ($t['truncated']) ? '1' : '0';
        $this->favorited = ($t['favorited']) ? '1' : '0';
        $this->inReplyToStatusId = $t['in_reply_to_status_id'];
        $this->inReplyToUserId = $t['in_reply_to_user_id'];
        $this->inReplyToScreenName = $t['in_reply_to_screen_name'];

    }

    /**
     * Loads this object from another object decoded from JSON.
     */
    public function loadJsonObject($t) {

        $this->id                       = $t->id;
        $this->inReplyToStatusId    = (isset($t->in_reply_to_status_id)) ? $t->in_reply_to_status_id : null;
        $this->inReplyToUserId      = (isset($t->in_reply_to_user_id)) ? $t->in_reply_to_user_id : null;
        $this->retweetedStatusId      = (isset($t->retweeted_status)) ? $t->retweeted_status->id : null;
        $this->retweetedStatusUserId = (isset($t->retweeted_status)) ? $t->retweeted_status->user->id : null;
        $this->createdAt               = new \DateTime(date('Y-m-d H:i:s', strtotime($t->created_at)));
        $this->source                   = $t->source;
        $this->tweet                    = $t->text;
        $this->userId                  = $t->user->id;
        // Not included in JSON
        $this->favorited                = 0;
        $this->truncated                = 0;

    }
}
