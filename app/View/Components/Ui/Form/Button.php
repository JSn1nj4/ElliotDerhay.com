<?php

namespace App\View\Components\Ui\Form;

use App\View\Components\Ui\Enums\FormButtonShape;
use App\View\Components\Ui\Enums\FormButtonStyle;
use App\View\Components\Ui\Enums\FormButtonType;
use Illuminate\View\Component;

class Button extends Component
{
	private array $colors = [
		'red' => [
			'outline' => [
				'text-red-800',
				'hover:text-red-600',
				'active:text-red-600',
				'dark:text-red-500',
				'dark:hover:text-white',
				'dark:active:text-white',
				'dark:hover:bg-red-500/20',
				'outline',
				'outline-1',
				'outline-red-800',
				'hover:outline-red-600',
				'active:outline-red-600',
				'dark:outline-red-600',
				'dark:hover:outline-red-800',
				'dark:active:outline-red-800',
			],
			'solid' => [
				'bg-red-800',
				'hover:bg-gray-600/50',
				'text-white',
				'hover:text-black',
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
				'outline',
				'outline-1',
				'outline-sea-green-800',
				'hover:outline-sea-green-600',
				'active:outline-sea-green-600',
				'dark:outline-sea-green-600',
				'dark:hover:outline-sea-green-800',
				'dark:active:outline-sea-green-800',
			],
			'solid' => [
				'bg-sea-green-800',
				'hover:bg-gray-600/50',
				'text-white',
				'hover:text-black',
				'dark:bg-sea-green-600',
				'dark:hover:bg-gray-700/50',
				'dark:text-black',
				'dark:hover:text-white'
			],
		],
		'teal' => [
			'outline' => [
				'text-teal-600',
				'hover:text-teal-800',
				'active:text-teal-800',
				'dark:text-teal-500',
				'dark:hover:text-white',
				'dark:active:text-white',
				'dark:hover:bg-teal-500/20',
				'outline',
				'outline-1',
				'outline-teal-800',
				'hover:outline-teal-600',
				'active:outline-teal-600',
				'dark:outline-teal-600',
				'dark:hover:outline-teal-800',
				'dark:active:outline-teal-800',
			],
			'solid' => [
				'bg-teal-800',
				'hover:bg-gray-600/50',
				'text-white',
				'hover:text-black',
				'dark:bg-teal-600',
				'dark:hover:bg-gray-700/50',
				'dark:text-black',
				'dark:hover:text-white'
			],
		],
		'yellow' => [
			'outline' => [
				'text-yellow-600',
				'hover:text-yellow-800',
				'active:text-yellow-800',
				'dark:text-yellow-500',
				'dark:hover:text-white',
				'dark:active:text-white',
				'dark:hover:bg-yellow-500/20',
				'outline',
				'outline-1',
				'outline-yellow-800',
				'hover:outline-yellow-600',
				'active:outline-yellow-600',
				'dark:outline-yellow-600',
				'dark:hover:outline-yellow-800',
				'dark:active:outline-yellow-800',
			],
			'solid' => [
				'bg-yellow-800',
				'hover:bg-gray-600/50',
				'text-white',
				'hover:text-black',
				'dark:bg-yellow-600',
				'dark:hover:bg-gray-700/50',
				'dark:text-black',
				'dark:hover:text-white',
			],
		],
	];

	private array $shapes = [
		'round' => 'rounded-full',
		'rounded' => 'rounded',
		'square' => 'rounded-none',
	];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
		private string $color = 'sea-green',
		private FormButtonStyle $buttonStyle = FormButtonStyle::Solid,
		public FormButtonType $buttonType = FormButtonType::Submit,
		private FormButtonShape $shape = FormButtonShape::Rounded,
		public ?string $form = null,
		private string $width = 'w-auto',
		private ?string $fontSize = null,
	)
    {
        //
    }

	public function classes(): string
	{
		$classes = [
			$this->width,
			$this->colors(),
			'transition-colors',
			'dark:transition-colors',
			'duration-300',
			$this->shapes[$this->shape->value],
			'px-3',
			'py-1',
		];

		if(!is_null($this->fontSize)) $classes[] = $this->fontSize;

		return implode(' ', $classes);
	}

	private function colors(): string
	{
		return implode(' ', $this->colors[$this->color][$this->buttonStyle->value]);
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
