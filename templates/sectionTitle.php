<?php

class sectiontitle
{
  private $mainTitle;
  private $subTitle;

  public function __construct($mainTitle, $subTitle)
  {
    $this->mainTitle = $mainTitle;
    $this->subTitle = $subTitle;
  }

  public function render()
  {
    echo "<h2 class='sectiontitle'>
            <span class='main'>{$this->mainTitle}</span>
            <span class='sub'>{$this->subTitle}</span>
          </h2>";
  }
}
