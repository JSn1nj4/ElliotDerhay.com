<?php

namespace App\DataTransferObjects;

class TtlDTO
{
	public function __construct(private int $seconds) {}

	public function days(int $days): self
	{
		return $this->hours($days * 24);
	}

	public function hours(int $hours): self
	{
		return $this->minutes($hours * 60);
	}

	public function minutes(int $minutes): self
	{
		return $this->seconds($minutes * 60);
	}

	public function seconds(int $seconds): self
	{
		$this->seconds = $seconds;

		return $this;
	}

	public function get(): int
	{
		return $this->seconds;
	}
}
