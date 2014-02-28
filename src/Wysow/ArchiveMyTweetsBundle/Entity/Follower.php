<?php

namespace Wysow\ArchiveMyTweetsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Follower
 *
 * @ORM\Table(name="followers")
 * @ORM\Entity(repositoryClass="Wysow\ArchiveMyTweetsBundle\Entity\FollowerRepository")
 */
class Follower
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="id_str", type="string", length=255, nullable=false)
     */
    private $idStr;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="screen_name", type="string", length=255, nullable=false)
     */
    private $screenName;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=255, nullable=false)
     */
    private $location;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var boolean
     *
     * @ORM\Column(name="protected", type="boolean", nullable=false)
     */
    private $protected;

    /**
     * @var integer
     *
     * @ORM\Column(name="followers_count", type="integer", nullable=false)
     */
    private $followersCount;

    /**
     * @var integer
     *
     * @ORM\Column(name="friends_count", type="integer", nullable=false)
     */
    private $friendsCount;

    /**
     * @var integer
     *
     * @ORM\Column(name="listed_count", type="integer", nullable=false)
     */
    private $listedCount;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var integer
     *
     * @ORM\Column(name="favourites_count", type="integer", nullable=false)
     */
    private $favouritesCount;

    /**
     * @var integer
     *
     * @ORM\Column(name="utc_offset", type="integer", nullable=true)
     */
    private $utcOffset;

    /**
     * @var string
     *
     * @ORM\Column(name="time_zone", type="string", length=255, nullable=true)
     */
    private $timeZone;

    /**
     * @var boolean
     *
     * @ORM\Column(name="geo_enabled", type="boolean", nullable=false)
     */
    private $geoEnabled;

    /**
     * @var boolean
     *
     * @ORM\Column(name="verified", type="boolean", nullable=false)
     */
    private $verified;

    /**
     * @var integer
     *
     * @ORM\Column(name="statuses_count", type="integer", nullable=false)
     */
    private $statusesCount;

    /**
     * @var string
     *
     * @ORM\Column(name="lang", type="string", length=5, nullable=false)
     */
    private $lang;

    /**
     * @var boolean
     *
     * @ORM\Column(name="contributors_enabled", type="boolean", nullable=false)
     */
    private $contributorsEnabled;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_translator", type="boolean", nullable=false)
     */
    private $isTranslator;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_translation_enabled", type="boolean", nullable=false)
     */
    private $isTranslationEnabled;

    /**
     * @var string
     *
     * @ORM\Column(name="profile_background_color", type="string", length=6, nullable=false)
     */
    private $profileBackgroundColor;

    /**
     * @var string
     *
     * @ORM\Column(name="profile_background_image_url", type="string", length=255, nullable=false)
     */
    private $profileBackgroundImageUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="profile_background_image_url_https", type="string", length=255, nullable=false)
     */
    private $profileBackgroundImageUrlHttps;

    /**
     * @var boolean
     *
     * @ORM\Column(name="profile_background_tile", type="boolean", nullable=false)
     */
    private $profileBackgroundTile;

    /**
     * @var string
     *
     * @ORM\Column(name="profile_image_url", type="string", length=255, nullable=false)
     */
    private $profileImageUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="profile_image_url_https", type="string", length=255, nullable=false)
     */
    private $profileImageUrlHttps;

    /**
     * @var string
     *
     * @ORM\Column(name="profile_banner_url", type="string", length=255, nullable=true)
     */
    private $profileBannerUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="profile_link_color", type="string", length=6, nullable=false)
     */
    private $profileLinkColor;

    /**
     * @var string
     *
     * @ORM\Column(name="profile_sidebar_border_color", type="string", length=6, nullable=false)
     */
    private $profileSidebarBorderColor;

    /**
     * @var string
     *
     * @ORM\Column(name="profile_sidebar_fill_color", type="string", length=6, nullable=false)
     */
    private $profileSidebarFillColor;

    /**
     * @var string
     *
     * @ORM\Column(name="profile_text_color", type="string", length=6, nullable=false)
     */
    private $profileTextColor;

    /**
     * @var boolean
     *
     * @ORM\Column(name="profile_use_background_image", type="boolean", nullable=false)
     */
    private $profileUseBackgroundImage;

    /**
     * @var boolean
     *
     * @ORM\Column(name="default_profile", type="boolean", nullable=false)
     */
    private $defaultProfile;

    /**
     * @var boolean
     *
     * @ORM\Column(name="default_profile_image", type="boolean", nullable=false)
     */
    private $defaultProfileImage;

    /**
     * @var boolean
     *
     * @ORM\Column(name="following", type="boolean", nullable=false)
     */
    private $following;

    /**
     * @var boolean
     *
     * @ORM\Column(name="follow_request_sent", type="boolean", nullable=false)
     */
    private $followRequestSent;

    /**
     * @var boolean
     *
     * @ORM\Column(name="notifications", type="boolean", nullable=false)
     */
    private $notifications;

    /**
     * Set id
     *
     * @param integer $id
     * @return Follower
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
     * Set idStr
     *
     * @param string $idStr
     * @return Follower
     */
    public function setIdStr($idStr)
    {
        $this->idStr = $idStr;

        return $this;
    }

    /**
     * Get idStr
     *
     * @return string
     */
    public function getIdStr()
    {
        return $this->idStr;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Follower
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set screenName
     *
     * @param string $screenName
     * @return Follower
     */
    public function setScreenName($screenName)
    {
        $this->screenName = $screenName;

        return $this;
    }

    /**
     * Get screenName
     *
     * @return string
     */
    public function getScreenName()
    {
        return $this->screenName;
    }

    /**
     * Set location
     *
     * @param string $location
     * @return Follower
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Follower
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Follower
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set protected
     *
     * @param boolean $protected
     * @return Follower
     */
    public function setProtected($protected)
    {
        $this->protected = $protected;

        return $this;
    }

    /**
     * Get protected
     *
     * @return boolean
     */
    public function getProtected()
    {
        return $this->protected;
    }

    /**
     * Set followersCount
     *
     * @param integer $followersCount
     * @return Follower
     */
    public function setFollowersCount($followersCount)
    {
        $this->followersCount = $followersCount;

        return $this;
    }

    /**
     * Get followersCount
     *
     * @return integer
     */
    public function getFollowersCount()
    {
        return $this->followersCount;
    }

    /**
     * Set friendsCount
     *
     * @param integer $friendsCount
     * @return Follower
     */
    public function setFriendsCount($friendsCount)
    {
        $this->friendsCount = $friendsCount;

        return $this;
    }

    /**
     * Get friendsCount
     *
     * @return integer
     */
    public function getFriendsCount()
    {
        return $this->friendsCount;
    }

    /**
     * Set listedCount
     *
     * @param integer $listedCount
     * @return Follower
     */
    public function setListedCount($listedCount)
    {
        $this->listedCount = $listedCount;

        return $this;
    }

    /**
     * Get listedCount
     *
     * @return integer
     */
    public function getListedCount()
    {
        return $this->listedCount;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Follower
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
     * Set favouritesCount
     *
     * @param integer $favouritesCount
     * @return Follower
     */
    public function setFavouritesCount($favouritesCount)
    {
        $this->favouritesCount = $favouritesCount;

        return $this;
    }

    /**
     * Get favouritesCount
     *
     * @return integer
     */
    public function getFavouritesCount()
    {
        return $this->favouritesCount;
    }

    /**
     * Set utcOffset
     *
     * @param integer $utcOffset
     * @return Follower
     */
    public function setUtcOffset($utcOffset)
    {
        $this->utcOffset = $utcOffset;

        return $this;
    }

    /**
     * Get utcOffset
     *
     * @return integer
     */
    public function getUtcOffset()
    {
        return $this->utcOffset;
    }

    /**
     * Set timeZone
     *
     * @param string $timeZone
     * @return Follower
     */
    public function setTimeZone($timeZone)
    {
        $this->timeZone = $timeZone;

        return $this;
    }

    /**
     * Get timeZone
     *
     * @return string
     */
    public function getTimeZone()
    {
        return $this->timeZone;
    }

    /**
     * Set geoEnabled
     *
     * @param boolean $geoEnabled
     * @return Follower
     */
    public function setGeoEnabled($geoEnabled)
    {
        $this->geoEnabled = $geoEnabled;

        return $this;
    }

    /**
     * Get geoEnabled
     *
     * @return boolean
     */
    public function getGeoEnabled()
    {
        return $this->geoEnabled;
    }

    /**
     * Set verified
     *
     * @param boolean $verified
     * @return Follower
     */
    public function setVerified($verified)
    {
        $this->verified = $verified;

        return $this;
    }

    /**
     * Get verified
     *
     * @return boolean
     */
    public function getVerified()
    {
        return $this->verified;
    }

    /**
     * Set statusesCount
     *
     * @param integer $statusesCount
     * @return Follower
     */
    public function setStatusesCount($statusesCount)
    {
        $this->statusesCount = $statusesCount;

        return $this;
    }

    /**
     * Get statusesCount
     *
     * @return integer
     */
    public function getStatusesCount()
    {
        return $this->statusesCount;
    }

    /**
     * Set lang
     *
     * @param string $lang
     * @return Follower
     */
    public function setLang($lang)
    {
        $this->lang = $lang;

        return $this;
    }

    /**
     * Get lang
     *
     * @return string
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * Set contributorsEnabled
     *
     * @param boolean $contributorsEnabled
     * @return Follower
     */
    public function setContributorsEnabled($contributorsEnabled)
    {
        $this->contributorsEnabled = $contributorsEnabled;

        return $this;
    }

    /**
     * Get contributorsEnabled
     *
     * @return boolean
     */
    public function getContributorsEnabled()
    {
        return $this->contributorsEnabled;
    }

    /**
     * Set isTranslator
     *
     * @param boolean $isTranslator
     * @return Follower
     */
    public function setIsTranslator($isTranslator)
    {
        $this->isTranslator = $isTranslator;

        return $this;
    }

    /**
     * Get isTranslator
     *
     * @return boolean
     */
    public function getIsTranslator()
    {
        return $this->isTranslator;
    }

    /**
     * Set isTranslationEnabled
     *
     * @param boolean $isTranslationEnabled
     * @return Follower
     */
    public function setIsTranslationEnabled($isTranslationEnabled)
    {
        $this->isTranslationEnabled = $isTranslationEnabled;

        return $this;
    }

    /**
     * Get isTranslationEnabled
     *
     * @return boolean
     */
    public function getIsTranslationEnabled()
    {
        return $this->isTranslationEnabled;
    }

    /**
     * Set profileBackgroundColor
     *
     * @param string $profileBackgroundColor
     * @return Follower
     */
    public function setProfileBackgroundColor($profileBackgroundColor)
    {
        $this->profileBackgroundColor = $profileBackgroundColor;

        return $this;
    }

    /**
     * Get profileBackgroundColor
     *
     * @return string
     */
    public function getProfileBackgroundColor()
    {
        return $this->profileBackgroundColor;
    }

    /**
     * Set profileBackgroundImageUrl
     *
     * @param string $profileBackgroundImageUrl
     * @return Follower
     */
    public function setProfileBackgroundImageUrl($profileBackgroundImageUrl)
    {
        $this->profileBackgroundImageUrl = $profileBackgroundImageUrl;

        return $this;
    }

    /**
     * Get profileBackgroundImageUrl
     *
     * @return string
     */
    public function getProfileBackgroundImageUrl()
    {
        return $this->profileBackgroundImageUrl;
    }

    /**
     * Set profileBackgroundImageUrlHttps
     *
     * @param string $profileBackgroundImageUrlHttps
     * @return Follower
     */
    public function setProfileBackgroundImageUrlHttps($profileBackgroundImageUrlHttps)
    {
        $this->profileBackgroundImageUrlHttps = $profileBackgroundImageUrlHttps;

        return $this;
    }

    /**
     * Get profileBackgroundImageUrlHttps
     *
     * @return string
     */
    public function getProfileBackgroundImageUrlHttps()
    {
        return $this->profileBackgroundImageUrlHttps;
    }

    /**
     * Set profileBackgroundTile
     *
     * @param boolean $profileBackgroundTile
     * @return Follower
     */
    public function setProfileBackgroundTile($profileBackgroundTile)
    {
        $this->profileBackgroundTile = $profileBackgroundTile;

        return $this;
    }

    /**
     * Get profileBackgroundTile
     *
     * @return boolean
     */
    public function getProfileBackgroundTile()
    {
        return $this->profileBackgroundTile;
    }

    /**
     * Set profileImageUrl
     *
     * @param string $profileImageUrl
     * @return Follower
     */
    public function setProfileImageUrl($profileImageUrl)
    {
        $this->profileImageUrl = $profileImageUrl;

        return $this;
    }

    /**
     * Get profileImageUrl
     *
     * @return string
     */
    public function getProfileImageUrl()
    {
        return $this->profileImageUrl;
    }

    /**
     * Set profileImageUrlHttps
     *
     * @param string $profileImageUrlHttps
     * @return Follower
     */
    public function setProfileImageUrlHttps($profileImageUrlHttps)
    {
        $this->profileImageUrlHttps = $profileImageUrlHttps;

        return $this;
    }

    /**
     * Get profileImageUrlHttps
     *
     * @return string
     */
    public function getProfileImageUrlHttps()
    {
        return $this->profileImageUrlHttps;
    }

    /**
     * Set profileBannerUrl
     *
     * @param string $profileBannerUrl
     * @return Follower
     */
    public function setProfileBannerUrl($profileBannerUrl)
    {
        $this->profileBannerUrl = $profileBannerUrl;

        return $this;
    }

    /**
     * Get profileBannerUrl
     *
     * @return string
     */
    public function getProfileBannerUrl()
    {
        return $this->profileBannerUrl;
    }

    /**
     * Set profileLinkColor
     *
     * @param string $profileLinkColor
     * @return Follower
     */
    public function setProfileLinkColor($profileLinkColor)
    {
        $this->profileLinkColor = $profileLinkColor;

        return $this;
    }

    /**
     * Get profileLinkColor
     *
     * @return string
     */
    public function getProfileLinkColor()
    {
        return $this->profileLinkColor;
    }

    /**
     * Set profileSidebarBorderColor
     *
     * @param string $profileSidebarBorderColor
     * @return Follower
     */
    public function setProfileSidebarBorderColor($profileSidebarBorderColor)
    {
        $this->profileSidebarBorderColor = $profileSidebarBorderColor;

        return $this;
    }

    /**
     * Get profileSidebarBorderColor
     *
     * @return string
     */
    public function getProfileSidebarBorderColor()
    {
        return $this->profileSidebarBorderColor;
    }

    /**
     * Set profileSidebarFillColor
     *
     * @param string $profileSidebarFillColor
     * @return Follower
     */
    public function setProfileSidebarFillColor($profileSidebarFillColor)
    {
        $this->profileSidebarFillColor = $profileSidebarFillColor;

        return $this;
    }

    /**
     * Get profileSidebarFillColor
     *
     * @return string
     */
    public function getProfileSidebarFillColor()
    {
        return $this->profileSidebarFillColor;
    }

    /**
     * Set profileTextColor
     *
     * @param string $profileTextColor
     * @return Follower
     */
    public function setProfileTextColor($profileTextColor)
    {
        $this->profileTextColor = $profileTextColor;

        return $this;
    }

    /**
     * Get profileTextColor
     *
     * @return string
     */
    public function getProfileTextColor()
    {
        return $this->profileTextColor;
    }

    /**
     * Set profileUseBackgroundImage
     *
     * @param boolean $profileUseBackgroundImage
     * @return Follower
     */
    public function setProfileUseBackgroundImage($profileUseBackgroundImage)
    {
        $this->profileUseBackgroundImage = $profileUseBackgroundImage;

        return $this;
    }

    /**
     * Get profileUseBackgroundImage
     *
     * @return boolean
     */
    public function getProfileUseBackgroundImage()
    {
        return $this->profileUseBackgroundImage;
    }

    /**
     * Set defaultProfile
     *
     * @param boolean $defaultProfile
     * @return Follower
     */
    public function setDefaultProfile($defaultProfile)
    {
        $this->defaultProfile = $defaultProfile;

        return $this;
    }

    /**
     * Get defaultProfile
     *
     * @return boolean
     */
    public function getDefaultProfile()
    {
        return $this->defaultProfile;
    }

    /**
     * Set defaultProfileImage
     *
     * @param boolean $defaultProfileImage
     * @return Follower
     */
    public function setDefaultProfileImage($defaultProfileImage)
    {
        $this->defaultProfileImage = $defaultProfileImage;

        return $this;
    }

    /**
     * Get defaultProfileImage
     *
     * @return boolean
     */
    public function getDefaultProfileImage()
    {
        return $this->defaultProfileImage;
    }

    /**
     * Set following
     *
     * @param boolean $following
     * @return Follower
     */
    public function setFollowing($following)
    {
        $this->following = $following;

        return $this;
    }

    /**
     * Get following
     *
     * @return boolean
     */
    public function getFollowing()
    {
        return $this->following;
    }

    /**
     * Set followRequestSent
     *
     * @param boolean $followRequestSent
     * @return Follower
     */
    public function setFollowRequestSent($followRequestSent)
    {
        $this->followRequestSent = $followRequestSent;

        return $this;
    }

    /**
     * Get followRequestSent
     *
     * @return boolean
     */
    public function getFollowRequestSent()
    {
        return $this->followRequestSent;
    }

    /**
     * Set notifications
     *
     * @param boolean $notifications
     * @return Follower
     */
    public function setNotifications($notifications)
    {
        $this->notifications = $notifications;

        return $this;
    }

    /**
     * Get notifications
     *
     * @return boolean
     */
    public function getNotifications()
    {
        return $this->notifications;
    }

    /**
     * Loads this object from an array.
     */
    public function loadArray($f) {
        $this->id = $f['id'];
        $this->idStr = $f['id_str'];
        $this->name = $f['name'];
        $this->screenName = $f['screen_name'];
        $this->location = $f['location'];
        $this->url = $f['url'];
        $this->description = $f['description'];
        $this->protected = $f['protected'];
        $this->followersCount = $f['followers_count'];
        $this->friendsCount = $f['friends_count'];
        $this->listedCount = $f['listed_count'];
        $this->createdAt = new \DateTime(date('Y-m-d H:i:s', strtotime($f['created_at'])));;
        $this->favouritesCount = $f['favourites_count'];
        $this->utcOffset = $f['utc_offset'];
        $this->timeZone = $f['time_zone'];
        $this->geoEnabled = $f['geo_enabled'];
        $this->verified = $f['verified'];
        $this->statusesCount = $f['statuses_count'];
        $this->lang = $f['lang'];
        $this->contributorsEnabled = $f['contributors_enabled'];
        $this->isTranslator = $f['is_translator'];
        $this->isTranslationEnabled = $f['is_translation_enabled'];
        $this->profileBackgroundColor = $f['profile_background_color'];
        $this->profileBackgroundImageUrl = $f['profile_background_image_url'];
        $this->profileBackgroundImageUrlHttps = $f['profile_background_image_url_https'];
        $this->profileBackgroundTile = $f['profile_background_tile'];
        $this->profileImageUrl = $f['profile_image_url'];
        $this->profileImageUrlHttps = $f['profile_image_url_https'];
        $this->profileLinkColor = $f['profile_link_color'];
        $this->profileSidebarBorderColor = $f['profile_sidebar_border_color'];
        $this->profileSidebarFillColor = $f['profile_sidebar_fill_color'];
        $this->profileTextColor = $f['profile_text_color'];
        $this->profileUseBackgroundImage = $f['profile_use_background_image'];
        $this->defaultProfile = $f['default_profile'];
        $this->defaultProfileImage = $f['default_profile_image'];
        $this->following = $f['following'];
        $this->followRequestSent = $f['follow_request_sent'];
        $this->notifications = $f['notifications'];
    }

    /**
     * Loads this object from another object decoded from JSON.
     */
    public function loadJsonObject($f) {
        // TODO
    }
}
