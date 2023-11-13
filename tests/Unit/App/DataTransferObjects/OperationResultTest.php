<?php

use App\DataTransferObjects\OperationResult;

it('returns an OperationResult for a successful operation')
	->expect(new OperationResult(true, 'operation succeeded'))
	->toBeInstanceOf(OperationResult::class)
	->toHaveProperty('succeeded', true)
	->toHaveProperty('message', 'operation succeeded');

it('returns an OperationResult for a failed operation')
	->expect(new OperationResult(false, 'operation failed'))
	->toBeInstanceOf(OperationResult::class)
	->toHaveProperty('succeeded', false)
	->toHaveProperty('message', 'operation failed');
