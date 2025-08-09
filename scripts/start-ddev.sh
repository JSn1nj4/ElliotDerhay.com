#!/usr/bin/env bash
if ! command -v ddev >/dev/null; then
	echo 'installing "ddev" is required for this script';
	exit 1
fi

if ! command -v jq >/dev/null; then
	echo 'parsing the ddev status output requires the jq cli program'
	exit 1
fi

if [ "$(ddev st -j | jq '.raw.status|startswith("running")')" = "true" ]; then
	echo 'ddev project is already running'
	exit 0
fi

ddev start
