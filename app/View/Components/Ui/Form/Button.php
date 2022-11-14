<?php

namespace App\View\Components\Ui\Form;

use App\View\Components\Ui\Enums\FormButtonStyle;
use App\View\Components\Ui\Enums\FormButtonType;
use Illuminate\View\Component;

class Button extends Component
{
	private array $colors = [
		'red' => [
			'outline' => [
				'text-red-600',
				'hover:text-red-800',
				'active:text-red-800',
				'dark:text-red-500',
				'dark:hover:text-white',
				'dark:active:text-white',
				'dark:hover:bg-red-500/20',
			],
			'solid' => [
				'dark:bg-red-600',
				'dark:hover:bg-red-800/70',
				'dark:text-black',
				'dark:hover:text-red-200'
			],
		],
		'sea-green' => [
			'outline' => [
				'text-sea-green-600',
				'hover:text-sea-green-800',
				'active:text-sea-green-800',
				'dark:text-sea-green-500',
				'dark:hover:text-white',
				'dark:active:text-white',
				'dark:hover:bg-sea-green-500/20',
			],
			'solid' => [
				'dark:bg-sea-green-600',
				'dark:hover:bg-gray-700/50',
				'dark:text-black',
				'dark:hover:text-white'
			],
		],
	];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
		private string $color = 'sea-green',
		private FormButtonStyle $style = FormButtonStyle::Solid,
		public FormButtonType $type = FormButtonType::Submit,
	)
    {
        //
    }

	public function classes(): string
	{
		return "w-full {$this->colors()} transition-colors dark:transition-colors duration-300 rounded px-3 py-1 text-2xl";
	}

	private function colors(): string
	{
		return implode(' ', $this->colors[$this->color][$this->style->value]);
	}

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.ui.form.button');
    }
}
