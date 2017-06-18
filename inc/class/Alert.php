<?php
/**
 * Light Cloud © 2017
 * Developed by Roch Blondiaux
 * www.roch-blondiaux.com
 *
 * All rights reserved. This file or any portion thereof MUST contain the following copyrights.
 */

class Alert
{
  private $title;
  private $content;
  private $icon;
  private $redirect;
  private $time;
  private $url;
  private $type;

  public function __construct($title, $content, $icon, $type)
  {
    $this->setTitle($title);
    $this->setContent($content);
    $this->setIcon($icon);
    $this->setType($type);
  }

  public function setRedirection($time, $url)
  {
    $this->setRedirect(true);
    $this->setTime($time);
    $this->setUrl($url);
  }

  public function render()
  {
    if($this->getRedirect()){
      return '<div class="alert alert-' . $this->getType() . ' alert-dismissible fade in" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">×</span>
          </button>
          <strong><i class="' . $this->getIcon() . '"></i> ' . $this->getTitle() . '</strong><br>
          ' . $this->getContent() . '
      </div>

      <script>
        setTimeout(function(){
          window.location.href = "' . $this->getUrl() . '";
        }, ' . intval($this->getTime()) * 1000  . ');
      </script>
      ';
    }else{
      return '<div class="alert alert-' . $this->getType() . ' alert-dismissible fade in" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">×</span>
          </button>
          <strong><i class="' . $this->getIcon() . '"></i> ' . $this->getTitle() . '</strong><br>
          ' . $this->getContent() . '
      </div>';
    }
  }

    /**
     * Get the value of title
     *
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @param mixed title
     *
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of Content
     *
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of Content
     *
     * @param mixed content
     *
     * @return self
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the value of Icon
     *
     * @return mixed
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Set the value of Icon
     *
     * @param mixed icon
     *
     * @return self
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Get the value of Redirect
     *
     * @return mixed
     */
    public function getRedirect()
    {
        return $this->redirect;
    }

    /**
     * Set the value of Redirect
     *
     * @param mixed redirect
     *
     * @return self
     */
    public function setRedirect($redirect)
    {
        $this->redirect = $redirect;

        return $this;
    }

    /**
     * Get the value of Time
     *
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set the value of Time
     *
     * @param mixed time
     *
     * @return self
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get the value of Url
     *
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set the value of Url
     *
     * @param mixed url
     *
     * @return self
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }


    /**
     * Get the value of Type
     *
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of Type
     *
     * @param mixed type
     *
     * @return self
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

}
