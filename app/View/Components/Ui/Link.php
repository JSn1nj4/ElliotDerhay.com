<?php

namespace App\View\Components\Ui;

use App\View\Components\Ui\Enums\FormButtonShape;
use App\View\Components\Ui\Enums\LinkStyle;
use Illuminate\View\Component;

class Link extends Component
{
	private array $colors = [
		'red' => [
			'button-outline' => [
				'text-red-800',
				'hover:text-red-600',
				'active:text-red-600',
				'dark:text-red-500',
				'dark:hover:text-white',
				'dark:active:text-white',
				'dark:hover:bg-red-500/20',
			],
			'button-solid' => [
				'bg-red-800',
				'hover:bg-neutral-600/50',
				'text-white',
				'hover:text-black',
				'dark:bg-red-600',
				'dark:hover:bg-red-800/70',
				'dark:text-black',
				'dark:hover:text-red-200'
			],
			'plain' => [
				'text-red-600',
				'hover:text-red-800',
				'active:text-red-800',
				'dark:text-red-500',
				'dark:hover:text-white',
				'dark:active:text-white',
			],

		],
		'seaGreen' => [
			'button-outline' => [
				'text-seaGreen-800',
				'hover:text-seaGreen-600',
				'active:text-seaGreen-600',
				'dark:text-seaGreen-500',
				'dark:hover:text-white',
				'dark:active:text-white',
				'dark:hover:bg-seaGreen-500/20',
			],
			'button-solid' => [
				'bg-seaGreen-800',
				'hover:bg-neutral-600/50',
				'text-white',
				'hover:text-black',
				'dark:bg-seaGreen-600',
				'dark:hover:bg-neutral-700/50',
				'dark:text-black',
				'dark:hover:text-white'
			],
			'plain' => [
				'text-seaGreen-600',
				'hover:text-seaGreen-800',
				'active:text-seaGreen-800',
				'dark:text-seaGreen-500',
				'dark:hover:text-white',
				'dark:active:text-white',
			],
		],
		'teal' => [
			'button-outline' => [
				'text-teal-600',
				'hover:text-teal-800',
				'active:text-teal-800',
				'dark:text-teal-500',
				'dark:hover:text-white',
				'dark:active:text-white',
				'dark:hover:bg-teal-500/20',
			],
			'button-solid' => [
				'bg-teal-800',
				'hover:bg-neutral-600/50',
				'text-white',
				'hover:text-black',
				'dark:bg-teal-600',
				'dark:hover:bg-neutral-700/50',
				'dark:text-black',
				'dark:hover:text-white'
			],
			'plain' => [
				'text-teal-600',
				'hover:text-teal-800',
				'active:text-teal-800',
				'dark:text-teal-500',
				'dark:hover:text-white',
				'dark:active:text-white',
			],
		],
		'yellow' => [
			'button-outline' => [
				'text-yellow-800',
				'hover:text-yellow-800/50',
				'active:text-yellow-800/50',
				'dark:text-yellow-500',
				'dark:hover:text-white',
				'dark:active:text-white',
				'dark:hover:bg-yellow-500/20',
			],
			'button-solid' => [
				'bg-yellow-800',
				'hover:bg-neutral-600/50',
				'text-white',
				'hover:text-black',
				'dark:bg-yellow-600',
				'dark:hover:bg-neutral-700/50',
				'dark:text-black',
				'dark:hover:text-white'
			],
			'plain' => [
				'text-yellow-600',
				'hover:text-yellow-800',
				'active:text-yellow-800',
				'dark:text-yellow-500',
				'dark:hover:text-white',
				'dark:active:text-white',
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
		public ?string $alt = null,
		private ?string $color = 'seaGreen',
		public string $href = '#',
		private LinkStyle $linkStyle = LinkStyle::Plain,
		private FormButtonShape $shape = FormButtonShape::Rounded,
		public ?string $title = null,
		private string $width = 'w-auto',
		private ?string $fontSize = null,
	)
    {
        //
    }

	private function colors(): string
	{
		return implode(' ', $this->colors[$this->color][$this->linkStyle->value]);
	}

	public function classes(): string
	{
		$classes = [
			$this->width,
			$this->colors(),
			'transition-colors',
			'dark:transition-colors',
			'duration-300',
			'text-center',
		];

		if(!is_null($this->fontSize)) $classes[] = $this->fontSize;

		return implode(' ', [...$classes, ...match ($this->linkStyle) {
			LinkStyle::ButtonSolid => [
				'px-3',
				'py-1',
				$this->shapes[$this->shape->value],
			],
			LinkStyle::ButtonOutline => [
				'px-3',
				'py-1',
				'outline',
				'outline-1',
				$this->shapes[$this->shape->value],
			],
			default => [],
		}]);
	}

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.ui.link');
    }
}
