<?php
namespace Iterator\Filter;

class ExtensionFilter extends \FilterIterator
{
  private $selectedExtensions = array();

  public function __construct(\Iterator $iterator, $selectedExtensions)
  {
    parent::__construct($iterator);
    $this->selectedExtensions = $selectedExtensions;
  }

  public function accept()
  {
    $el = $this->getInnerIterator()->current();
    return $el->isFile() && (empty($this->selectedExtensions) || in_array($el->getExtension(), $this->selectedExtensions));
  }
}
