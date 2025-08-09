#!/usr/bin/env bash
if ! command -v ddev >/dev/null; then
	echo 'installing "ddev" is required for this script';
	exit 1
fi

if ! command -v jq >/dev/null; then
	echo 'parsing the ddev status output requires the "jq" cli program'
	exit 1
fi

if ! command -v sed >/dev/null; then
	echo 'the cli program "sed" is needed to update the client port for vite'
	exit 1
fi

if [ "$(ddev st -j | jq '.raw.status|startswith("stopped")')" = "true" ]; then
	echo 'please start your ddev project before running this script'
	exit 1
fi

VITE_CLIENTPORT="$(ddev st -j | jq '.raw.services.web.host_ports_mapping[] | select(.exposed_port=="5173").host_port')"

sed -i~ "/^VITE_SERVER_HMR_CLIENTPORT=/s/=.*/=$VITE_CLIENTPORT/" .env
