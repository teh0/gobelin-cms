<?php


namespace App\Entity;


class SearchField
{
    /**
     * @var string
     */
    protected $field;

    /**
     * @var string | null
     */
    protected $value;

    /**
     * @return string
     */
    public function getField(): string
    {
        return $this->field;
    }

    /**
     * @param string $field
     *
     * @return SearchField
     */
    public function setField(string $field): SearchField
    {
        $this->field = $field;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getValue(): ?string
    {
        return $this->value ? $this->value : '';
    }

    /**
     * @param string|null $value
     *
     * @return SearchField
     */
    public function setValue(?string $value): SearchField
    {
        $this->value = $value;
        return $this;
    }

}