<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class FormInput extends Component
{
    public $id;
    public $name;
    public $type;
    public $label;
    public $required;
    public $pattern;
    public $title;
    public $autofocus;

    /**
     * Create a new component instance.
     *
     * @param string $id
     * @param string $name
     * @param string $type
     * @param string $label
     * @param bool $required
     * @param string|null $pattern
     * @param string|null $title
     * @param bool $autofocus
     */
    public function __construct(
        $id,
        $name,
        $type = 'text',
        $label = '',
        $required = true,
        $pattern = null,
        $title = null,
        $autofocus = false
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
        $this->label = $label;
        $this->required = $required;
        $this->pattern = $pattern;
        $this->title = $title;
        $this->autofocus = $autofocus;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.forms.input-field');
    }
}