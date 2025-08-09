#!/usr/bin/env bash

if ! command -v ddev >/dev/null; then
	echo 'installing "ddev" is required for this script';
	exit 1
fi

ddev composer install

ddev pnpm install
