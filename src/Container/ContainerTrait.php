<?php

namespace Donquixote\Containerkit\Container;

use Donquixote\Containerkit\Exception\ContainerException;

/**
 * The traits allow to make the private $buffer variable available to all
 * the container base classes, but hide it from the actual implementations.
 */
trait ContainerTrait {

  /**
   * @var mixed[]
   */
  private $buffer = array();

  /**
   * @param string $key
   *
   * @return mixed
   *
   * @throws \RuntimeException
   */
  function __get($key) {
    if (array_key_exists($key, $this->buffer)) {
      return $this->buffer[$key];
    }
    $method = 'get_' . $key;
    if (!method_exists($this, $method)) {
      $key_safe = check_plain($key);
      throw new ContainerException("Service or value for '$key_safe' already set.");
    }
    return $this->buffer[$key] = $this->$method();
  }

}
