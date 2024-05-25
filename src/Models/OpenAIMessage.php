<?php

namespace Jonaspoelmans\LaravelGpt\Models;

use InvalidArgumentException;

class OpenAIMessage
{
    // the role
    protected $role;
    protected $content;

    /**
     * OpenAIMessage constructor.
     *
     * @param string $role The role of the message, must be 'user', 'assistant', or 'system'.
     * @param string $content The content of the message.
     * @throws InvalidArgumentException If the role is invalid.
     */
    public function __construct(string $role, string $content) {
        $this->validateRole($role);

        $this->role = $role;
        $this->content = $content;
    }

    /**
     * Validate the role of the message.
     *
     * @param string $role The role to validate.
     * @throws InvalidArgumentException If the role is not 'user', 'assistant', or 'system'.
     */
    private function validateRole(string $role) {
        if (!in_array($role, ['user', 'assistant', 'system'])) {
            throw new InvalidArgumentException("Role must be either 'user', 'assistant' or 'system'.");
        }
    }

    /**
     * Convert the message to an array.
     *
     * @return array The message as an array.
     */
    public function convertToArray() {
        return [
            'role' => $this->role,
            'content' => $this->content,
        ];
    }

    /**
     * Get the role of the message.
     *
     * @return string The role of the message.
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the role of the message.
     *
     * @param string $role The new role of the message.
     * @throws InvalidArgumentException if the role is invalid.
     */
    public function setRole($role): void
    {
        $this->validateRole($role);

        $this->role = $role;
    }

    /**
     * Get the content of the message.
     *
     * @return string The content of the message.
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the content of the message.
     *
     * @param string $content The new content of the message.
     */
    public function setContent($content): void
    {
        $this->content = $content;
    }
}
