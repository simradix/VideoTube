<?php

class VideoGridItem {

    // $video       - Video object
    // $largeMode   -
    private $video, $largeMode;

    public function __construct($video, $largeMode) {
        $this->video = $video;
        $this->largeMode = $largeMode;
    }

    /**
     * Get Thumbnail component and Details component and with them
     * create a thumbnail component that links to the related video clip.
     */
    public function create() {
        $thumbnail = $this->createThumbnail();
        $details = $this->createDetails();
        $url = "watch.php?id=" . $this->video->getId();

        return "<a href='$url'>
                    <div class='videoGridItem'>
                        $thumbnail
                        $details
                    </div>
                </a>";
    }

    /**
     * Get the thumbnail image from the Video object,
     * get the duration of the video and put them
     * into a thumbnail component.
     */
    private function createThumbnail() {

        $thumbnail = $this->video->getThumbnail();
        $duration = $this->video->getDuration();

        return "<div class='thumbnail'>
                    <img src='$thumbnail'>
                    <div class='duration'>
                        <span>$duration</span>
                    </div>
                </div>";

    }

    /**
     * Get the title, username, views, and timestamp from the Video object
     * Get video description from VideoGridItem's createDescription method
     * Bunddle the above into the Details component that goes under the
     * Thumbnail component.
     */
    private function createDetails() {
        $title = $this->video->getTitle();
        $username = $this->video->getUploadedBy();
        $views = $this->video->getViews();
        $timestamp = $this->video->getTimeStamp();

        $description = $this->createDescription();

        return "<div class='details'>
                    <h3 class='title'>$title</h3>
                    <span class='username'>$username</span>
                    <div class='stats'>
                        <span class='viewCount'>$views views - </span>
                        <span class='timeStamp'>$timestamp</span>
                    </div>
                    $description
                </div>";
    }


    /**
     * Get video description from the Video object.
     * If the video its viewed in large mode do not display video description.
     * If description is to long to be displayd entirely under the thumbnail
     * then cut a short part from it an abreviated with '...'
     */
    private function createDescription() {
        if(!$this->largeMode) {
            return "";
        }
        else {
            $description = $this->video->getDescription();
            $description = (strlen($description) > 350) ?
                substr($description, 0, 347) . "..."
                :
                $description;
            return "<span class='description'>$description</span>";
        }
    }

}
?>
