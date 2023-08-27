#!/usr/bin/env bash

function command_exists() {
	command -v "$1" &>/dev/null
}

function print_msg() {
	if command_exists "notify-send"; then
		notify-send "Lando" "$1"
	fi

	echo "$1"
}

if ! command_exists "lando"; then
	echo "'lando' was not found in your \$PATH. Aborting startup."
fi

if [ $(command lando list --format json | jq '.|length') -le "1" ]; then
	command lando start
	print_msg "elliotderhay running"
	command lando dev
else
	print_msg "elliotderhay already running - check if dev script is running too"
fi
