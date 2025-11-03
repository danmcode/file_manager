<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Select extends Component
{
    public $options;
    public $selected;
    public $disabled;

    /**
     * Crear un nuevo componente.
     *
     * @param array|\Illuminate\Support\Collection $options
     * @param mixed|null $selected
     * @param bool $disabled
     */
    public function __construct($options = [], $selected = null, $disabled = false)
    {
        $this->options = $options;
        $this->selected = $selected;
        $this->disabled = $disabled;
    }

    public function render()
    {
        return view('components.select');
    }
}