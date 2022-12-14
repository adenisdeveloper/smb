<?php
/**
 * Copyright (c) 2015 Raman Deep Bajwa <dbajwa763@gmail.com>
 * This file is licensed under the Licensed under the MIT license:
 * http://opensource.org/licenses/MIT
 */

namespace Tecnovix\SMB;

use Tecnovix\SMB\Exception\InvalidPathException;

abstract class AbstractShare implements IShare {
	/** @var string[] */
	private $forbiddenCharacters;

	public function __construct() {
		$this->forbiddenCharacters = ['?', '<', '>', ':', '*', '|', '"', chr(0), "\n", "\r"];
	}

	/**
	 * @param string $path
	 * @throws InvalidPathException
	 */
	protected function verifyPath(string $path): void {
		foreach ($this->forbiddenCharacters as $char) {
			if (strpos($path, $char) !== false) {
				throw new InvalidPathException('Invalid path, "' . $char . '" is not allowed');
			}
		}
	}

	/**
	 * @param string[] $charList
	 */
	public function setForbiddenChars(array $charList): void {
		$this->forbiddenCharacters = $charList;
	}
}
