<?php


namespace App;


class AdditionVideoList
{
    public $groupId = null;
    public $videos = null;

    public function __construct($oldAdditionVideoList)
    {
        if ($oldAdditionVideoList) {
            $this->groupId = $oldAdditionVideoList->groupId;
            $this->videos = $oldAdditionVideoList->videos;
        }
    }

    public function addVideoToAdditionVideoList($groupId, $video)
    {
        if (!$this->groupId) {
            $this->groupId = $groupId;
        }
        if ($this->videos) {
            if (array_key_exists($video->id, $this->videos)) {
                dd('da them video nay');
            }
        }
        $this->videos[$video->id] = $video;
    }

    public function removeVideoFromAdditionVideoList($videoId)
    {
        if ($this->videos) {
            if (array_key_exists($videoId, $this->videos)) {
                unset($this->videos[$videoId]);
            }
        }
    }
}
