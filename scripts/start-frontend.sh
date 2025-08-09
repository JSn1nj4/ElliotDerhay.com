#!/usr/bin/env bash
if ! command -v ddev >/dev/null; then
	echo 'installing "ddev" is required for this script';
	exit 1
fi

if [ "$(ddev st -j | jq '.raw.status|startswith("stopped")')" = "true" ]; then
	echo 'please start your ddev project before running this script'
	exit 1
fi

ddev pnpm dev
