<?php

namespace Donquixote\Containerkit\Container;

use Donquixote\Containerkit\Exception\ContainerException;

trait SettableContainerTrait {

  use ContainerTrait;

  /**
   * @param string $key
   * @param object $value
   *
   * @throws \Donquixote\Containerkit\Exception\ContainerException
   */
  function __set($key, $value) {
    if (array_key_exists($key, $this->buffer)) {
      $key_safe = check_plain($key);
      throw new ContainerException("Service or value for '$key_safe' already set.");
    }
    $this->buffer[$key] = $value;
  }

}
