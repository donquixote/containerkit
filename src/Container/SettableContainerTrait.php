<?php

namespace Donquixote\Containerkit\Container;

use Donquixote\Containerkit\Exception\ContainerException;

/**
 * The traits allow to make the private $buffer variable available to all
 * the container base classes, but hide it from the actual implementations.
 */
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
