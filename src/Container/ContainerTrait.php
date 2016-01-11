<?php

namespace Donquixote\Containerkit\Container;

use Donquixote\Containerkit\Exception\ContainerException;

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
